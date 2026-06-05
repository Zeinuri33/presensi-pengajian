<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\Kepalakamar;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KhidmahController extends Controller
{
    //
    public function jadwal(Request $request)
    {
        // Bulan & Tahun (default bulan ini)
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $awalBulan = Carbon::create($tahun, $bulan, 1);
        $daysInMonth = $awalBulan->daysInMonth;

        /**
         * AMBIL PETUGAS WILAYAH PUSAT
         * ➜ ABS selalu di urutan paling akhir
         */
        $petugas = Kepalakamar::query()
            ->select('kepalakamars.*')
            ->join('asramas', 'asramas.id', '=', 'kepalakamars.asrama_id')
            ->where('asramas.wilayah', 'Pusat')
            ->whereIn('kepalakamars.jabatan', ['Kepala Kamar', 'Wakil Kamar'])

            // 🔥 ABS paling akhir
            ->orderByRaw("
                CASE 
                    WHEN asramas.kode LIKE 'ABS%' THEN 1
                    ELSE 0
                END
            ")

            // Urut huruf kode (A, B, C)
            ->orderByRaw("REGEXP_REPLACE(asramas.kode, '[0-9]', '') ASC")

            // Urut angka (1,2,10)
            ->orderByRaw("CAST(REGEXP_REPLACE(asramas.kode, '[^0-9]', '') AS UNSIGNED) ASC")

            ->orderBy('kepalakamars.nama')
            ->with('asrama')
            ->get();

        /**
         * GROUP PER ASRAMA
         */
        $kelompokAsrama = [];

        foreach ($petugas as $p) {
            $id = $p->asrama_id;

            if (!isset($kelompokAsrama[$id])) {
                $kelompokAsrama[$id] = [
                    'asrama' => $p->asrama,
                    'kepala' => [],
                    'wakil'  => [],
                ];
            }

            if ($p->jabatan === 'Kepala Kamar') {
                $kelompokAsrama[$id]['kepala'][] = $p;
            } else {
                $kelompokAsrama[$id]['wakil'][] = $p;
            }
        }

        $pasanganAsrama = collect($kelompokAsrama)->values();
        $totalAsrama = $pasanganAsrama->count();

        if ($totalAsrama === 0) {
            return view('khidmah.jadwal', [
                'jadwal' => [],
                'bulan'  => $bulan,
                'tahun'  => $tahun
            ]);
        }

        /**
         * 🔁 INDEX LANJUTAN ANTAR BULAN
         * Anchor: 1 Januari 2026
         */
        $anchor = Carbon::create(2026, 1, 1);
        $totalHariSebelumnya = max(
            0,
            $anchor->diffInDays($awalBulan, false)
        );

        // 1 hari = 3 shift, 1 shift = 2 asrama
        $idx = ($totalHariSebelumnya * 3 * 2) % $totalAsrama;

        /**
         * BUAT JADWAL
         */
        $jadwal = [];
        $shifts = ['Pagi', 'Siang', 'Malam'];

        for ($day = 1; $day <= $daysInMonth; $day++) {
            foreach ($shifts as $shift) {

                $a1 = $pasanganAsrama[$idx % $totalAsrama];
                $a2 = $pasanganAsrama[($idx + 1) % $totalAsrama];

                $jadwal[] = [
                    'tanggal' => Carbon::create($tahun, $bulan, $day)->format('Y-m-d'),
                    'shift'   => $shift,

                    'pair1' => [
                        'asrama' => $a1['asrama'],
                        'kepala' => $a1['kepala'][0] ?? null,
                        'wakil'  => $a1['wakil'][0] ?? null,
                    ],

                    'pair2' => [
                        'asrama' => $a2['asrama'],
                        'kepala' => $a2['kepala'][0] ?? null,
                        'wakil'  => $a2['wakil'][0] ?? null,
                    ],
                ];

                // geser 2 asrama tiap shift
                $idx += 2;
            }
        }

        return view('khidmah.jadwal', compact(
            'jadwal',
            'bulan',
            'tahun'
        ));
    }


    public function cetakJadwal(Request $request)
    {
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $awalBulan = Carbon::create($tahun, $bulan, 1);
        $daysInMonth = $awalBulan->daysInMonth;

        /**
     * 🔁 ROTASI DIMULAI 1 JANUARI 2026
        */
        $anchor = Carbon::create(2026, 1, 1);

        // jika bulan sebelum Januari 2026, paksa 0
        $totalHariSebelumnya = max(0, $anchor->diffInDays($awalBulan));

        // 1 HARI = 6 KODE ASRAMA
        $shiftIndex = $totalHariSebelumnya * 6;

        /**
         * Ambil ASRAMA PUSAT (urut A1, A2, B1, dst)
         */
        $asramas = \App\Models\Asrama::query()
            ->where('wilayah', 'Pusat')

            // 1️⃣ ABS selalu paling akhir
            ->orderByRaw("
                CASE 
                    WHEN kode LIKE 'ABS%' THEN 1
                    ELSE 0
                END
            ")

            // 2️⃣ Urut huruf (A, B, C, ...)
            ->orderByRaw("REGEXP_REPLACE(kode, '[0-9]', '') ASC")

            // 3️⃣ Urut angka (1,2,10)
            ->orderByRaw("CAST(REGEXP_REPLACE(kode, '[^0-9]', '') AS UNSIGNED) ASC")

            ->pluck('kode')
            ->values();


        $jadwal = [];

        Carbon::setLocale('id');

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $tanggal = Carbon::create($tahun, $bulan, $day);

            $jadwal[$tanggal->translatedFormat('d F Y')] = [
                'Pagi'  => $asramas[$shiftIndex % $asramas->count()] . ' & ' . $asramas[($shiftIndex + 1) % $asramas->count()],
                'Siang' => $asramas[($shiftIndex + 2) % $asramas->count()] . ' & ' . $asramas[($shiftIndex + 3) % $asramas->count()],
                'Malam' => $asramas[($shiftIndex + 4) % $asramas->count()] . ' & ' . $asramas[($shiftIndex + 5) % $asramas->count()],
            ];

            $shiftIndex += 6;
        }

        $pdf = Pdf::loadView('khidmah.cetak', [
                'jadwal'      => $jadwal,
                'bulanTahun' => $awalBulan->translatedFormat('F Y'),
            ])
            ->setPaper([0, 0, 595, 935], 'portrait'); // F4

        return $pdf->stream(
            'jadwal-khidmat-' . strtolower($awalBulan->format('F-Y')) . '.pdf'
        );

    }

    public function cetakPresensi(Request $request)
    {
        // ===============================
        // BULAN & TAHUN
        // ===============================
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        $awalBulan   = Carbon::create($tahun, $bulan, 1);
        $daysInMonth = $awalBulan->daysInMonth;

        Carbon::setLocale('id');

        // ===============================
        // 🔁 ROTASI DIMULAI 1 JANUARI 2026
        // ===============================
        $anchor = Carbon::create(2026, 1, 1);

        $totalHariSebelumnya = max(
            0,
            $anchor->diffInDays($awalBulan, false)
        );

        // 1 hari = 3 shift, 1 shift = 2 asrama
        $idx = $totalHariSebelumnya * 3 * 2;

        // ===============================
        // AMBIL PETUGAS PUSAT (FIX)
        // ===============================
        $petugas = Kepalakamar::query()
            ->join('asramas', 'asramas.id', '=', 'kepalakamars.asrama_id')
            ->where('asramas.wilayah', 'Pusat')
            ->whereIn('kepalakamars.jabatan', ['Kepala Kamar', 'Wakil Kamar'])

            ->select(
                'kepalakamars.*',
                'asramas.kode as kode_asrama' // ⬅️ AMAN, STRING
            )

            // ABS selalu terakhir
            ->orderByRaw("
                CASE 
                    WHEN asramas.kode LIKE 'ABS%' THEN 1
                    ELSE 0
                END
            ")
            ->orderByRaw("REGEXP_REPLACE(asramas.kode, '[0-9]', '') ASC")
            ->orderByRaw("CAST(REGEXP_REPLACE(asramas.kode, '[^0-9]', '') AS UNSIGNED) ASC")
            ->orderBy('kepalakamars.nama')
            ->get();

        // ===============================
        // GROUP PER ASRAMA (FIX)
        // ===============================
        $kelompokAsrama = [];

        foreach ($petugas as $p) {
            $id = $p->asrama_id;

            if (!isset($kelompokAsrama[$id])) {
                $kelompokAsrama[$id] = [
                    'kode'   => $p->kode_asrama, // ⬅️ TIDAK ERROR
                    'kepala' => null,
                    'wakil'  => null,
                ];
            }

            if ($p->jabatan === 'Kepala Kamar') {
                $kelompokAsrama[$id]['kepala'] = $p;
            } else {
                $kelompokAsrama[$id]['wakil'] = $p;
            }
        }

        $asramas = collect($kelompokAsrama)->values();
        $totalAsrama = $asramas->count();

        if ($totalAsrama < 2) {
            abort(404, 'Asrama tidak cukup');
        }

        // ===============================
        // SUSUN JADWAL
        // ===============================
        $jadwal = [];
        $shifts = ['Pagi', 'Siang', 'Malam'];

        for ($day = 1; $day <= $daysInMonth; $day++) {

            $tanggal = Carbon::create($tahun, $bulan, $day)->format('Y-m-d');

            foreach ($shifts as $shift) {

                $a1 = $asramas[$idx % $totalAsrama];
                $a2 = $asramas[($idx + 1) % $totalAsrama];

                $jadwal[] = [
                    'tanggal' => $tanggal,
                    'shift'   => $shift,

                    'pair1' => [
                        'asrama' => $a1['kode'],
                        'kepala' => $a1['kepala'],
                        'wakil'  => $a1['wakil'],
                    ],

                    'pair2' => [
                        'asrama' => $a2['kode'],
                        'kepala' => $a2['kepala'],
                        'wakil'  => $a2['wakil'],
                    ],
                ];

                $idx += 2;
            }
        }

        // ===============================
        // CETAK PDF
        // ===============================
        $pdf = Pdf::loadView('khidmah.absen', [
                'jadwal'      => $jadwal,
                'bulanTahun' => $awalBulan->translatedFormat('F Y'),
            ])
            ->setPaper([0, 0, 595, 935], 'portrait'); // F4

        return $pdf->stream(
            'presensi-khidmat-' . strtolower($awalBulan->format('F-Y')) . '.pdf'
        );

    }


    
    
}
