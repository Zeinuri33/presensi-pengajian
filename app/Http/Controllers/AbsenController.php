<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Asrama;
use App\Models\Harilibur;
use App\Models\Izin;
use App\Models\Kepalakamar;
use App\Models\Pembinaan;
use App\Models\Semester;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function beranda()
    {
        $persentase = [];

        // Loop 3 bulan terakhir (0 = bulan ini, 1 = bulan lalu, dst.)
        for ($i = 11; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i)->month;
            $tahun = Carbon::now()->subMonths($i)->year;

            $startOfMonth = Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
            $endOfMonth = Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

            $tanggalAktif = collect();
            $current = $startOfMonth->copy();

            while ($current <= $endOfMonth) {
                // Hari biasa kecuali Selasa (2) dan Jumat (5)
                if (!in_array($current->dayOfWeek, [2, 5])) {
                    $isLibur = Harilibur::whereDate('mulai', '<=', $current)
                        ->whereDate('sampai', '>=', $current)
                        ->exists();

                    if (!$isLibur) {
                        $tanggalAktif->push($current->toDateString());
                    }
                }
                $current->addDay();
            }

            $jumlahHariAktif = $tanggalAktif->count();
            $jumlahKepala = Kepalakamar::count();

            // Jumlah absensi valid di bulan tersebut
            $jumlahAbsen = Absen::whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulan)
                ->count();

            $maksimalHadir = $jumlahKepala * $jumlahHariAktif;

            $persentaseHadir = $maksimalHadir > 0
                ? round(($jumlahAbsen / $maksimalHadir) * 100, 2)
                : 0;

            $persentase[] = [
                'bulan' => Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('M Y'),
                'persen' => $persentaseHadir
            ];
        }

        return view('beranda', compact('persentase'));
    }


    public function absen()
    {
        $today = Carbon::today();

        $latestAbsens = Absen::with('kepalakamar')
            ->whereDate('tanggal', $today)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('absen', compact('latestAbsens'));
    }

    public function kepala(Request $request)
    {
        $tanggal = $request->input('tanggal') ?? now()->toDateString();
        $daerahList = Asrama::select('daerah')->distinct()->pluck('daerah');

        $kepalakamar = Absen::with('kepalakamar')
            ->whereDate('tanggal', $tanggal)
            ->whereHas('kepalakamar', fn($q) => $q->where('jabatan', 'Kepala Kamar'))
            ->orderBy('jam')
            ->get();

        return view('absensi.index', compact('kepalakamar', 'tanggal', 'daerahList'));
    }

    public function wakil(Request $request)
    {
        $tanggal = $request->input('tanggal') ?? now()->toDateString();
        $daerahList = Asrama::select('daerah')->distinct()->pluck('daerah');

        $wakilkamar = Absen::with('kepalakamar')
            ->whereDate('tanggal', $tanggal)
            ->whereHas('kepalakamar', fn($q) => $q->where('jabatan', 'Wakil Kamar'))
            ->orderBy('jam')
            ->get();

        return view('absensi.index', compact('wakilkamar', 'tanggal', 'daerahList'));
    }


    //
    public function store(Request $request)
    {
        $request->validate([
            'nokartu' => 'required|numeric'
        ]);

        $kepalakamar = Kepalakamar::where('nokartu', $request->nokartu)->first();

        if (!$kepalakamar) {
            return back()->with('error', 'KTS tidak terdaftar sebagai kepala kamar atau wakil kepala kamar .');
        }


        $now = now(); // waktu saat ini
        $tanggalHariIni = $now->toDateString();
        $hari = $now->translatedFormat('l'); // 'Senin', 'Selasa', dst.

        // Batas jam absen: maksimal pukul 07:00
        $jamBatas = $now->copy()->setTime(7, 0);
        if ($now->gt($jamBatas)) {
            return back()->with('error', 'Batas waktu absen telah lewat (maks. jam 07:00).');
        }

        // Cek hari libur
        if (in_array($hari, ['Selasa', 'Jumat'])) {
            return back()->with('error', "Hari Selasa dan Jumat libur, tidak ada pengajian.");
        }

        // Cek hari libur dari tabel hari_libur
        $libur = Harilibur::whereDate('mulai', '<=', $tanggalHariIni)
            ->whereDate('sampai', '>=', $tanggalHariIni)
            ->exists();

        if ($libur) {
            return back()->with('error', "Hari ini pengajian diliburkan.");
        }



        // Cek apakah sudah absen hari ini
        $sudahAbsen = Absen::where('kepalakamar_id', $kepalakamar->id)
            ->whereDate('tanggal', $tanggalHariIni)
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Anda sudah absen hari ini.');
        }

        // Cek apakah ada izin hari ini
        $adaIzin = Izin::where('kepalakamar_id', $kepalakamar->id)
            ->whereDate('tanggal', $tanggalHariIni)
            ->exists();

        if ($adaIzin) {
            return back()->with('error', 'Anda telah mengajukan izin hari ini dan tidak perlu absen.');
        }

        // Simpan absen
        Absen::create([
            'kepalakamar_id' => $kepalakamar->id,
            'tanggal' => $tanggalHariIni,
            'jam' => $now->format('H:i:s'),
        ]);

        return back()->with('success', 'Kehadiran Ust. '.$kepalakamar->nama.' berhasil dicatat, semoga barokah.');
    }


    public function susulan(Request $request)
    {
        $request->validate([
            'identitas' => 'required', // bisa NIS atau KTS
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
        ]);

        // Cari berdasarkan NIS atau No Kartu
        $kepalakamar = Kepalakamar::where('nokartu', $request->identitas)
            ->orWhere('nis', $request->identitas)
            ->first();

        if (!$kepalakamar) {
            return back()->with('error', "NIS atau KTS tidak terdaftar sebagai kepala atau wakil kamar.");
        }

        $tanggal = $request->tanggal;
        $jam = $request->jam;

        // Cek apakah sudah pernah absen
        $sudahAbsen = Absen::where('kepalakamar_id', $kepalakamar->id)
            ->whereDate('tanggal', $tanggal)
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', "Yang bersangkutan sudah absen di tanggal tersebut.");
        }

        // Simpan absen
        Absen::create([
            'kepalakamar_id' => $kepalakamar->id,
            'tanggal' => $tanggal,
            'jam' => $jam,
        ]);

        return back()->with('success', "Absen susulan berhasil ditambahkan.");
    }


    public function hapus($id)
    {
        $absen = Absen::findOrFail($id);
        $absen->delete();

        return back()->with('success', 'Data absen berhasil dihapus.');
    }


    public function tidakHadir(Request $request)
    {
        $tanggal = $request->tanggal ?? Carbon::now()->toDateString();
        $tanggalCarbon = Carbon::parse($tanggal);
        $now = Carbon::now();
        $jamBatas = Carbon::createFromFormat('H:i', '07:00');

        // ✅ Cegah tampil jika tanggal belum terjadi
        if ($tanggalCarbon->isFuture()) {
            return view('absensi.ketidakhadiran.index', [
                'tanggal' => $tanggal,
                'tidakhadir' => collect(),
                'message' => 'Tanggal ini belum masuk jadwal absen.'
            ]);
        }

        // ✅ Hanya tampilkan tidak hadir setelah jam 07:00 (khusus untuk hari ini)
        if ($tanggalCarbon->isToday() && $now->lt($jamBatas)) {
            return view('absensi.ketidakhadiran.index', [
                'tanggal' => $tanggal,
                'tidakhadir' => collect(),
                'message' => 'List ketidakhadiran akan ditampilkan setelah batas waktu absen (07:00).'
            ]);
        }

        // ✅ Cek hari libur
        $isLibur = Harilibur::whereDate('mulai', '<=', $tanggal)
            ->whereDate('sampai', '>=', $tanggal)
            ->exists();

        if ($isLibur || in_array($tanggalCarbon->dayOfWeek, [2, 5])) {
            return view('absensi.ketidakhadiran.index', [
                'tanggal' => $tanggal,
                'tidakhadir' => collect(),
                'message' => 'Hari ini adalah hari libur pengajian.'
            ]);
        }

        // ✅ Ambil ID yang sudah absen atau izin
        $absenIds = Absen::whereDate('tanggal', $tanggal)->pluck('kepalakamar_id');
        $izinIds = Izin::whereDate('tanggal', $tanggal)->pluck('kepalakamar_id');

        // ✅ Ambil yang tidak hadir (tidak absen dan tidak izin)
        $tidakhadir = Kepalakamar::whereNotIn('id', $absenIds->merge($izinIds))
        ->with(['pembinaan' => function ($query) use ($tanggal) {
            $query->whereDate('tanggal', $tanggal);
        }])
        ->orderBy('jabatan')
        ->get();


        return view('absensi.ketidakhadiran.index', compact('tanggal', 'tidakhadir'));
    }

    public function tandaiPembinaan(Request $request, $id)
    {
        $kepala = Kepalakamar::findOrFail($id);

        Pembinaan::create([
            'kepalakamar_id' => $kepala->id,
            'tanggal' => $request->tanggal
        ]);

        return back()->with('success', 'Yang bersangkutan ditandai sudah pembinaan.');
    }

    public function rekapKehadiran(Request $request)
    {
        $bulan = (int) ($request->bulan ?? now()->month);
        $tahun = (int) ($request->tahun ?? now()->year);

        if ($bulan < 1 || $bulan > 12) {
            abort(400, 'Bulan tidak valid.');
        }

        $query = Kepalakamar::query();

        if ($request->jabatan) {
            $query->where('jabatan', $request->jabatan);
        }

        // daftar default daerah
        $defaultDaerah = [
            'Sunan Maulana Malik Ibrahim',
            'Sunan Ampel',
            'Sunan Bonang',
            'Sunan Giri',
            'Sunan Drajat',
            'Sunan Kalijogo',
            'Sunan Kudus',
            'Sunan Murya',
            'Sunan Gunung Jati(Unit I)',
            'Sunan Gunung Jati(Unit II Atas)',
            "I'dadiyah",
        ];

        // filter daerah
        if ($request->filled('daerah')) {
            $query->whereHas('asrama', function ($q) use ($request) {
                $q->where('daerah', $request->daerah);
            });
        } else {
            $query->whereHas('asrama', function ($q) use ($defaultDaerah) {
                $q->whereIn('daerah', $defaultDaerah);
            });
        }

        // Buat array tanggal dalam bulan
        $tanggalHari = collect(range(1, Carbon::create($tahun, $bulan)->daysInMonth))
            ->map(fn($tgl) => Carbon::createFromDate($tahun, $bulan, $tgl)->format('Y-m-d'));

        // Ambil semua hari libur berdasarkan range tanggal
        $tanggalLibur = [];
        $hariliburData = Harilibur::whereDate('mulai', '<=', Carbon::create($tahun, $bulan)->endOfMonth())
            ->whereDate('sampai', '>=', Carbon::create($tahun, $bulan)->startOfMonth())
            ->get();

        foreach ($hariliburData as $libur) {
            try {
                $mulai = Carbon::parse($libur->mulai);
                $sampai = Carbon::parse($libur->sampai);

                foreach (CarbonPeriod::create($mulai, $sampai) as $date) {
                    $tanggalLibur[] = $date->format('Y-m-d');
                }
            } catch (\Exception $e) {
                dump('Gagal parsing libur:', $libur, $e->getMessage());
            }
        }

        $kepalaKamar = $query->get()->map(function ($kk) use ($tanggalHari, $tanggalLibur) {
            $hadirTanggal = Absen::where('kepalakamar_id', $kk->id)
                ->whereIn('tanggal', $tanggalHari)
                ->pluck('tanggal')
                ->map(fn($tgl) => Carbon::parse($tgl)->toDateString())
                ->toArray();

            $izinTanggal = Izin::where('kepalakamar_id', $kk->id)
                ->whereIn('tanggal', $tanggalHari)
                ->pluck('tanggal')
                ->map(fn($tgl) => Carbon::parse($tgl)->toDateString())
                ->toArray();

            $rekap = [];
            $hadirCount = 0;

            foreach ($tanggalHari as $tgl) {
                $carbonTanggal = Carbon::parse($tgl);
                $hari = $carbonTanggal->dayOfWeek;
                $isLibur = in_array($tgl, $tanggalLibur);
                $isSelasaJumat = in_array($hari, [2, 5]);
                $isFuture = $carbonTanggal->isFuture();

                if ($isLibur || $isSelasaJumat || $isFuture) {
                    $rekap[$tgl] = '';
                    continue;
                }

                if (in_array($tgl, $hadirTanggal)) {
                    $rekap[$tgl] = 'H';
                    $hadirCount++;
                } elseif (in_array($tgl, $izinTanggal)) {
                    $rekap[$tgl] = 'I';
                } else {
                    $rekap[$tgl] = 'A';
                }
            }

            $totalHariAktif = collect($tanggalHari)->reject(function ($tgl) use ($tanggalLibur) {
                $hari = Carbon::parse($tgl)->dayOfWeek;
                return in_array($tgl, $tanggalLibur) || in_array($hari, [2, 5]);
            })->count();

            $kk->rekap = $rekap;
            $kk->persentase = $totalHariAktif > 0 ? round(($hadirCount / $totalHariAktif) * 100, 2) : 0;

            return $kk;
        });

        // Ambil semua data pembinaan
        $pembinaan = Pembinaan::select('kepalakamar_id', 'tanggal')->get();

        $blokHijau = [];
        foreach ($pembinaan as $item) {
            $blokHijau[$item->kepalakamar_id][$item->tanggal] = true;
        }

        $pdf = Pdf::loadView('absensi.rekap.kehadiran', [
            'kepalaKamar'   => $kepalaKamar,
            'tanggalHari'   => $tanggalHari,
            'tanggalLibur'  => $tanggalLibur,
            'bulan'         => $bulan,
            'tahun'         => $tahun,
            'blokHijau'     => $blokHijau,
            'request'       => $request,
        ])->setPaper([0, 0, 612.00, 936.00], 'landscape');

        return $pdf->stream('rekap-kehadiran-' . $bulan . '-' . $tahun . '.pdf');
    }


    public function rekapKetidakhadiran(Request $request)
    {
        $bulan = (int) ($request->bulan ?? now()->month);
        $tahun = (int) ($request->tahun ?? now()->year);
        $jabatan = $request->jabatan;

        $query = Kepalakamar::query();

        if ($jabatan) {
            $query->where('jabatan', $jabatan);
        }

        $kepalaKamar = $query->get()->map(function ($kk) use ($bulan, $tahun) {
            $tanggalHari = collect(range(1, Carbon::create($tahun, $bulan)->daysInMonth))
                ->map(fn($tgl) => Carbon::createFromDate($tahun, $bulan, $tgl)->format('Y-m-d'));

            $hadirTanggal = Absen::where('kepalakamar_id', $kk->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->pluck('tanggal')
                ->map(fn($tgl) => Carbon::parse($tgl)->toDateString())
                ->toArray();

            $izinTanggal = Izin::where('kepalakamar_id', $kk->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->pluck('tanggal')
                ->map(fn($tgl) => Carbon::parse($tgl)->toDateString())
                ->toArray();

            // Ambil tanggal libur + selasa/jumat
            $tanggalLibur = Harilibur::whereDate('mulai', '<=', Carbon::create($tahun, $bulan)->endOfMonth())
                ->whereDate('sampai', '>=', Carbon::create($tahun, $bulan)->startOfMonth())
                ->get()
                ->flatMap(function ($item) {
                    return CarbonPeriod::create($item->mulai, $item->sampai)
                        ->map(fn ($date) => $date->format('Y-m-d'));
                })
                ->unique()
                ->toArray();

            // Hanya tanggal aktif
            $tanggalValid = $tanggalHari->reject(function ($tgl) use ($tanggalLibur) {
                $hari = Carbon::parse($tgl)->dayOfWeek;
                return in_array($hari, [2, 5]) || in_array($tgl, $tanggalLibur); // Selasa, Jumat, dan libur
            });

            $jumlahHadir = count(array_intersect($tanggalValid->toArray(), $hadirTanggal));
            $jumlahIzin = count(array_intersect($tanggalValid->toArray(), $izinTanggal));
            $jumlahAlpha = $tanggalValid->count() - ($jumlahHadir + $jumlahIzin);

            $jumlahPembinaan = Pembinaan::where('kepalakamar_id', $kk->id)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->count();

            $kk->jumlah_tidak_hadir = $jumlahAlpha;
            $kk->jumlah_pembinaan = $jumlahPembinaan;
            $kk->sisa_pembinaan = $jumlahAlpha - $jumlahPembinaan;
            $kk->kamar = $kk->asrama->nama ?? '-';

            return $kk;
        })->filter(fn($kk) => $kk->jumlah_tidak_hadir > 0)->values(); // hanya yang tidak hadir

        return Pdf::loadView('absensi.rekap.ketidakhadiran', [
            'data' => $kepalaKamar,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'request' => $request
        ])
        ->setPaper('F4', 'portrait')
        ->stream('laporan-ketidakhadiran-' . $bulan . '-' . $tahun . '.pdf');
    }

    public function suratPanggilanPerHari(Request $request, $id)
    {
        $tanggal = $request->tanggal;

        if (!$tanggal) {
            abort(400, 'Tanggal harus disediakan.');
        }

        $kepala = Kepalakamar::with('asrama')->findOrFail($id);

        // Cek kehadiran dan izin
        $hadir = Absen::where('kepalakamar_id', $id)->whereDate('tanggal', $tanggal)->exists();
        $izin = Izin::where('kepalakamar_id', $id)->whereDate('tanggal', $tanggal)->exists();

        // Cek libur dan hari tertentu
        $hari = Carbon::parse($tanggal)->dayOfWeek;
        $isLibur = HariLibur::whereDate('mulai', '<=', $tanggal)->whereDate('sampai', '>=', $tanggal)->exists();

        if ($hadir || $izin || $isLibur || in_array($hari, [2, 5])) {
            return redirect()->back()->with('info', 'Santri tidak memenuhi syarat untuk dipanggil pada tanggal tersebut.');
        }

        $data = [
            'nama' => $kepala->nama,
            'jabatan' => $kepala->jabatan,
            'asrama' => $kepala->asrama->asrama ?? '-',
            'kode' => $kepala->asrama->kode ?? '-',
            'tanggal' => $tanggal,
        ];

        return Pdf::loadView('absensi.panggilan', compact('data'))
            ->setPaper('A5', 'portrait')
            ->stream("panggilan-{$kepala->nama}-{$tanggal}.pdf");

    }

    public function pembinaan(Request $request)
    {
        $tanggal = $request->input('tanggal');

        $query = Pembinaan::with('kepalakamar');

        if ($tanggal) {
            // Filter hanya kalau tanggal dipilih
            $query->whereDate('tanggal', $tanggal);
        }

        // Urutkan dari terbaru
        $pembinaan = $query->orderBy('tanggal', 'desc')->get();

        return view('absensi.pembinaan.index', compact('pembinaan', 'tanggal'));
    }
    public function hapuspembinaan($id)
    {
        $pembinaan = Pembinaan::findOrFail($id);

        $pembinaan->delete();

        return back()->with('success', 'Pembinaan berhasil dihapus');
    }

    public function ket(Request $request)
    {
        // Semua semester untuk dropdown
        $semesters = Semester::orderBy('dari_tgl', 'asc')->get();

        // Jika user pilih semester lewat filter
        if ($request->filled('semester_id')) {
            $semester = Semester::find($request->semester_id);
        } else {
            // Cari semester aktif
            $semester = Semester::where('dari_tgl', '<=', now())
                ->where('sampai_tgl', '>=', now())
                ->first();

            // Jika tidak ada semester aktif → ambil terdekat
            if (!$semester) {
                $semester = Semester::orderByRaw("
                    LEAST(ABS(DATEDIFF(dari_tgl, ?)), ABS(DATEDIFF(sampai_tgl, ?)))
                ", [now(), now()])
                ->first();
            }
        }

        if (!$semester) {
            return back()->with('error', 'Tidak ada data semester.');
        }

        // 2. Ambil semua tanggal semester (kecuali libur, Selasa, Jumat)
        $dates = [];
        $start = Carbon::parse($semester->dari_tgl);
        $end   = Carbon::parse($semester->sampai_tgl);

        // daftar libur
        $hariliburs = [];
        foreach (Harilibur::all() as $hl) {
            $mulai = Carbon::parse($hl->mulai);
            $sampai = Carbon::parse($hl->sampai);

            for ($d = $mulai->copy(); $d->lte($sampai); $d->addDay()) {
                $hariliburs[] = $d->toDateString();
            }
        }

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $hari = $date->dayOfWeekIso; // 1=Senin ... 7=Minggu

            if (
                in_array($date->toDateString(), $hariliburs) ||
                $hari == 2 || // Selasa
                $hari == 5    // Jumat
            ) {
                continue;
            }

            $dates[] = $date->toDateString();
        }

        // 3. Ambil kepala kamar + filter sesuai opsi
        $kepalakamar = Kepalakamar::with([
                'absens' => function ($q) use ($dates) {
                    $q->whereIn('tanggal', $dates);
                },
                'pembinaan' => function ($q) use ($dates) {
                    $q->whereIn('tanggal', $dates);
                }
            ])
            ->get();

        // default filter: hanya yang hadir penuh
        if ($request->filter !== 'all') {
            $kepalakamar = $kepalakamar->filter(function ($kk) use ($dates) {
                // ambil semua tanggal hadir (✅ absens)
                $hadirAbsens = $kk->absens->pluck('tanggal')->toArray();

                // ambil semua tanggal pembinaan (🟦)
                $hadirPembinaan = $kk->pembinaan->pluck('tanggal')->toArray();

                // gabungkan semua tanggal hadir
                $totalHadir = collect($hadirAbsens)
                    ->merge($hadirPembinaan)
                    ->unique()
                    ->values()
                    ->toArray();

                // kepala kamar valid hanya jika hadir di semua tanggal wajib
                return count($totalHadir) === count($dates);
            });
        }

        return view('absensi.ket.index', compact('kepalakamar', 'semester', 'dates', 'semesters'));
    }


    public function cetakAktif(Request $request)
    {
        // Sama seperti fungsi ket()
        if ($request->filled('semester_id')) {
            $semester = Semester::find($request->semester_id);
        } else {
            $semester = Semester::where('dari_tgl', '<=', now())
                ->where('sampai_tgl', '>=', now())
                ->first();

            if (!$semester) {
                $semester = Semester::orderByRaw("
                    LEAST(ABS(DATEDIFF(dari_tgl, ?)), ABS(DATEDIFF(sampai_tgl, ?)))
                ", [now(), now()])
                ->first();
            }
        }

        if (!$semester) {
            return back()->with('error', 'Tidak ada semester.');
        }

        // daftar tanggal wajib hadir
        $dates = [];
        $start = Carbon::parse($semester->dari_tgl);
        $end   = Carbon::parse($semester->sampai_tgl);

        // daftar libur (pakai range mulai–sampai)
        $hariliburs = [];
        foreach (Harilibur::all() as $hl) {
            $mulai = Carbon::parse($hl->mulai);
            $sampai = Carbon::parse($hl->sampai);

            for ($d = $mulai->copy(); $d->lte($sampai); $d->addDay()) {
                $hariliburs[] = $d->toDateString();
            }
        }

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $hari = $date->dayOfWeekIso; // 1=Senin ... 7=Minggu

            if (
                in_array($date->toDateString(), $hariliburs) ||
                $hari == 2 || // Selasa
                $hari == 5    // Jumat
            ) {
                continue;
            }

            $dates[] = $date->toDateString();
        }

        // $kepalakamar = Kepalakamar::with([
        //         'absens' => function ($q) use ($dates) {
        //             $q->whereIn('tanggal', $dates);
        //         },
        //         'pembinaan' => function ($q) use ($dates) {
        //             $q->whereIn('tanggal', $dates);
        //         }
        //     ])
        //     ->get()
        //     ->filter(function ($kk) use ($dates) {
        //         $hadirAbsens = $kk->absens->pluck('tanggal')->toArray();
        //         $hadirPembinaan = $kk->pembinaan->pluck('tanggal')->toArray();

        //         $totalHadir = collect($hadirAbsens)
        //             ->merge($hadirPembinaan)
        //             ->unique()
        //             ->values()
        //             ->toArray();

        //         return count($totalHadir) === count($dates);
        //     });

        $kepalakamar = Kepalakamar::with([
            'absens' => function ($q) use ($dates) {
                $q->whereIn('tanggal', $dates);
            },
            'pembinaan' => function ($q) use ($dates) {
                $q->whereIn('tanggal', $dates);
            }
        ])
        ->get();


        $pdf = Pdf::loadView(
            'absensi.ket.pdf',
            compact('kepalakamar', 'semester')
        )->setPaper('A5', 'portrait');

        return $pdf->stream("surat_keterangan_aktif_semester_{$semester->id}.pdf");
    }

    public function cetakAktifPerKk(Request $request, $id)
    {
        // Sama seperti fungsi ket()
        if ($request->filled('semester_id')) {
            $semester = Semester::find($request->semester_id);
        } else {
            $semester = Semester::where('dari_tgl', '<=', now())
                ->where('sampai_tgl', '>=', now())
                ->first();

            if (!$semester) {
                $semester = Semester::orderByRaw("
                    LEAST(ABS(DATEDIFF(dari_tgl, ?)), ABS(DATEDIFF(sampai_tgl, ?)))
                ", [now(), now()])
                ->first();
            }
        }

        if (!$semester) {
            return back()->with('error', 'Tidak ada semester.');
        }

        // Ambil kepala kamar
        $kepalakamar = Kepalakamar::with(['absens', 'pembinaan'])->findOrFail($id);

        // Daftar tanggal wajib (tanpa selasa, jumat, libur)
        $dates = [];
        $start = Carbon::parse($semester->dari_tgl);
        $end   = Carbon::parse($semester->sampai_tgl);

        $hariliburs = [];
        foreach (Harilibur::all() as $hl) {
            $mulai = Carbon::parse($hl->mulai);
            $sampai = Carbon::parse($hl->sampai);
            for ($d = $mulai->copy(); $d->lte($sampai); $d->addDay()) {
                $hariliburs[] = $d->toDateString();
            }
        }

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $hari = $date->dayOfWeekIso;
            if (
                in_array($date->toDateString(), $hariliburs) ||
                $hari == 2 || $hari == 5
            ) {
                continue;
            }
            $dates[] = $date->toDateString();
        }

        // Gabungkan hadir absens + pembinaan
        $hadirAbsens = $kepalakamar->absens->pluck('tanggal')->toArray();
        $hadirPembinaan = $kepalakamar->pembinaan->pluck('tanggal')->toArray();
        $totalHadir = collect($hadirAbsens)->merge($hadirPembinaan)->unique()->values()->toArray();

        $lengkap = (count($totalHadir) === count($dates));


        $pdf = Pdf::loadView('absensi.ket.pdf', compact('kepalakamar', 'semester'))
          ->setPaper('a5', 'portrait'); // atau 'landscape'
          
        return $pdf->stream('Surat_Keterangan_Aktif_'.$kepalakamar->nama.'.pdf');

    }


    

    public function detail(Request $request, $id)
    {
        // Semua semester untuk dropdown
        $semesters = Semester::orderBy('dari_tgl', 'asc')->get();

        // Jika user pilih semester lewat filter
        if ($request->filled('semester_id')) {
            $semester = Semester::find($request->semester_id);
        } else {
            // Cari semester aktif
            $semester = Semester::where('dari_tgl', '<=', now())
                ->where('sampai_tgl', '>=', now())
                ->first();

            // Jika tidak ada semester aktif → ambil terdekat
            if (!$semester) {
                $semester = Semester::orderByRaw("
                    LEAST(ABS(DATEDIFF(dari_tgl, ?)), ABS(DATEDIFF(sampai_tgl, ?)))
                ", [now(), now()])
                ->first();
            }
        }

        if (!$semester) {
            return back()->with('error', 'Tidak ada data semester.');
        }

        // 2. Ambil semua tanggal semester (kecuali libur, Selasa, Jumat)
        $dates = [];
        $start = Carbon::parse($semester->dari_tgl);
        $end   = Carbon::parse($semester->sampai_tgl);

        // daftar libur
        $hariliburs = [];
        foreach (Harilibur::all() as $hl) {
            $mulai = Carbon::parse($hl->mulai);
            $sampai = Carbon::parse($hl->sampai);

            for ($d = $mulai->copy(); $d->lte($sampai); $d->addDay()) {
                $hariliburs[] = $d->toDateString();
            }
        }

        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $hari = $date->dayOfWeekIso; // 1=Senin ... 7=Minggu

            if (
                in_array($date->toDateString(), $hariliburs) ||
                $hari == 2 || // Selasa
                $hari == 5    // Jumat
            ) {
                continue;
            }

            $dates[] = $date->toDateString();
        }

        // Ambil kepala kamar + absens
        $kk = Kepalakamar::with(['absens' => function ($q) use ($dates) {
            $q->whereIn('tanggal', $dates);
        }])
        ->findOrFail($id);

        // Hitung data
        $hadir = 0;
        $pembinaan = 0;
        $tidakHadir = 0;
        $tanggalTidakHadir = [];
        $tanggalPembinaan  = [];

        foreach ($dates as $tanggal) {
            $absen = $kk->absens->where('tanggal', $tanggal)->first();
            $pb    = $kk->pembinaan->where('tanggal', $tanggal)->first();

            if ($absen) {
                // anggap hadir hanya jika ada absensi
                $hadir++;
            } else {
                // kalau tidak ada absensi → tetap tidak hadir
                $tidakHadir++;
                $tanggalTidakHadir[] = $tanggal;
            }

            // catat pembinaan hanya sebagai informasi tambahan
            if ($pb) {
                $pembinaan++;
                $tanggalPembinaan[] = $tanggal;
            }
        }

        $totalHari = count($dates);
        $totalHadir = $hadir; // hanya absensi yang dihitung hadir
        $persentase = $totalHari > 0 ? round(($totalHadir / $totalHari) * 100, 2) : 0;

        return view('absensi.detail', compact(
            'kk',
            'hadir',
            'pembinaan',
            'tidakHadir',
            'tanggalTidakHadir',
            'tanggalPembinaan',
            'persentase',
            'totalHari',
            'semesters',
            'semester'
        ));

    }




}
