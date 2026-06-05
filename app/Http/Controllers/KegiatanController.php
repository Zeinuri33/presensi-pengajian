<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Presensi;
use App\Models\Kepalakamar;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KegiatanController extends Controller
{
    //
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();

        foreach ($kegiatan as $item) {

            // =========================
            // QUERY DASAR PESERTA
            // =========================
            if ($item->peserta === 'Kepala Kamar') {
                $pesertaQuery = Kepalakamar::where('jabatan', 'Kepala Kamar');
            } elseif ($item->peserta === 'Wakil Kamar') {
                $pesertaQuery = Kepalakamar::where('jabatan', 'Wakil Kamar');
            } elseif ($item->peserta === 'Kepala dan Wakil') {
                $pesertaQuery = Kepalakamar::query();
            } else {
                $pesertaQuery = Kepalakamar::whereNull('id');
            }

            // =========================
            // 🔒 FILTER LINGKUP KEGIATAN
            // =========================
            if ($item->lingkup === 'Pusat') {
                $pesertaQuery->whereHas('asrama', function ($q) {
                    $q->where('wilayah', 'Pusat');
                });
            } elseif ($item->lingkup === 'Cabang') {
                $pesertaQuery->whereHas('asrama', function ($q) {
                    $q->where('wilayah', 'Cabang');
                });
            }
            // "Pusat dan Cabang" → tidak difilter

            // =========================
            // HITUNG PESERTA
            // =========================
            $totalPeserta = $pesertaQuery->count();

            // Hadir hanya yang sesuai peserta + lingkup
            $jumlahHadir = Presensi::where('kegiatan_id', $item->id)
                ->whereIn('nokartu', $pesertaQuery->pluck('nokartu'))
                ->count();

            $jumlahTidakHadir = max($totalPeserta - $jumlahHadir, 0);
            $persentase = $totalPeserta > 0
                ? round(($jumlahHadir / $totalPeserta) * 100, 1)
                : 0;

            // =========================
            // TAMBAHKAN KE OBJEK
            // =========================
            $item->hadir = $jumlahHadir;
            $item->tidak_hadir = $jumlahTidakHadir;
            $item->persentase = $persentase;
        }

        return view('kegiatan.index', compact('kegiatan'));
    }


    public function store(Request $request)
    {
        Kegiatan::create($request->all());

        return back()->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findorFail($id);
        $kegiatan->update($request->all());

        return back()->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $kegiatan = Kegiatan::findorFail($id);
        $kegiatan->delete();

        return back()->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function detail($id)
{
    $kegiatan = Kegiatan::findOrFail($id);

    $daerahFilter = request('daerah');
    $jabatanFilter = request('jabatan');
    $statusFilter = request('status');

    // Tentukan peserta utama sesuai kegiatan
    if ($kegiatan->peserta === 'Kepala Kamar') {
        $pesertaQuery = KepalaKamar::where('jabatan', 'Kepala Kamar');
        $filterableJabatan = ['Kepala Kamar'];
    } elseif ($kegiatan->peserta === 'Wakil Kamar') {
        $pesertaQuery = KepalaKamar::where('jabatan', 'Wakil Kamar');
        $filterableJabatan = ['Wakil Kamar'];
    } elseif ($kegiatan->peserta === 'Kepala dan Wakil') {
        $pesertaQuery = KepalaKamar::query();
        $filterableJabatan = ['Kepala Kamar', 'Wakil Kamar'];
    } else {
        $pesertaQuery = KepalaKamar::whereNull('id');
        $filterableJabatan = [];
    }

    // 🔒 FILTER LINGKUP KEGIATAN (DITAMBAHKAN)
    if ($kegiatan->lingkup === 'Pusat') {
        $pesertaQuery->whereHas('asrama', function ($q) {
            $q->where('wilayah', 'Pusat');
        });
    } elseif ($kegiatan->lingkup === 'Cabang') {
        $pesertaQuery->whereHas('asrama', function ($q) {
            $q->where('wilayah', 'Cabang');
        });
    }
    // jika "Pusat dan Cabang" → tidak difilter

    // Filter daerah (opsional)
    if ($daerahFilter) {
        $pesertaQuery->whereHas('asrama', function ($q) use ($daerahFilter) {
            $q->where('daerah', $daerahFilter);
        });
    }

    // Filter jabatan jika kegiatan = "Kepala dan Wakil"
    if ($jabatanFilter && $kegiatan->peserta === 'Kepala dan Wakil') {
        $pesertaQuery->where('jabatan', $jabatanFilter);
    }

    $peserta = $pesertaQuery->with('asrama')->get();

    // Cek presensi
    $presensiNis = Presensi::where('kegiatan_id', $kegiatan->id)
        ->pluck('nokartu')
        ->toArray();

    $semuaPeserta = $peserta->map(function ($p) use ($presensiNis) {
        return [
            'nama' => $p->nama,
            'foto' => $p->foto,
            'nis' => $p->nis,
            'jabatan' => $p->jabatan,
            'asrama' => $p->asrama->asrama,
            'kode' => $p->asrama->kode,
            'daerah' => optional($p->asrama)->daerah ?? 'Tidak Diketahui',
            'status' => in_array($p->nokartu, $presensiNis) ? 'Hadir' : 'Tidak Hadir',
        ];
    });

    // Filter status kehadiran
    if ($statusFilter) {
        $semuaPeserta = $semuaPeserta
            ->filter(fn ($p) => $p['status'] === $statusFilter)
            ->values();
    }

    // Rekap berdasarkan jabatan
    $kelompokJabatan = $semuaPeserta->groupBy('jabatan');

    $rekapJabatan = $kelompokJabatan->map(function ($pesertaPerJabatan) {
        $total = $pesertaPerJabatan->count();
        $hadir = $pesertaPerJabatan->where('status', 'Hadir')->count();
        $tidakHadir = $pesertaPerJabatan->where('status', 'Tidak Hadir')->count();
        $persen = $total > 0 ? round(($hadir / $total) * 100, 1) : 0;

        return [
            'total' => $total,
            'hadir' => $hadir,
            'tidak_hadir' => $tidakHadir,
            'persentase' => $persen,
        ];
    });

    // Total keseluruhan
    $jumlahPeserta = $semuaPeserta->count();
    $jumlahHadir = $semuaPeserta->where('status', 'Hadir')->count();
    $jumlahTidakHadir = $semuaPeserta->where('status', 'Tidak Hadir')->count();
    $persentase = $jumlahPeserta > 0
        ? round(($jumlahHadir / $jumlahPeserta) * 100, 1)
        : 0;

    // Ambil daftar daerah (opsional untuk form filter)
    $daerahList = \App\Models\Asrama::select('daerah')->distinct()->pluck('daerah');

    return view('kegiatan.detail', compact(
        'kegiatan', 'semuaPeserta',
        'jumlahHadir', 'jumlahTidakHadir', 'jumlahPeserta', 'persentase',
        'daerahList', 'daerahFilter', 'jabatanFilter', 'statusFilter',
        'filterableJabatan', 'rekapJabatan'
    ));
}


    public function cetak($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $daerahFilter = request('daerah');
        $jabatanFilter = request('jabatan');

        // Validasi wajib memilih daerah
        if (!$daerahFilter) {
            return redirect()->back()->with('error', 'Silakan pilih daerah terlebih dahulu sebelum mencetak PDF.');
        }

        // Query peserta berdasarkan jenis kegiatan
        if ($kegiatan->peserta === 'Kepala Kamar') {
            $pesertaQuery = Kepalakamar::where('jabatan', 'Kepala Kamar');
        } elseif ($kegiatan->peserta === 'Wakil Kamar') {
            $pesertaQuery = Kepalakamar::where('jabatan', 'Wakil Kamar');
        } else {
            $pesertaQuery = Kepalakamar::query();
        }

        // Filter berdasarkan daerah
        $pesertaQuery->whereHas('asrama', function ($q) use ($daerahFilter) {
            $q->where('daerah', $daerahFilter);
        });

        // Filter jabatan (jika kegiatan "Kepala dan Wakil")
        if ($jabatanFilter && $kegiatan->peserta === 'Kepala dan Wakil') {
            $pesertaQuery->where('jabatan', $jabatanFilter);
        }

        // Ambil peserta dan relasi asrama
        $peserta = $pesertaQuery->with('asrama')->get();

        // Urutkan peserta berdasarkan nama asrama + nomor di akhir
        $peserta = $peserta->sortBy(function ($item) {
            $asramaName = $item->asrama->asrama ?? '';
            // Pisahkan nama dan angka: contoh "I'dadiyah No.12"
            preg_match('/^(.*?)(\d+)$/', trim($asramaName), $matches);
            $nama = $matches[1] ?? $asramaName;
            $angka = isset($matches[2]) ? (int) $matches[2] : 0;

            return [$nama, $angka];
        })->values(); // Reset index

        // NIS yang sudah presensi
        $presensiNis = Presensi::where('kegiatan_id', $kegiatan->id)->pluck('nokartu')->toArray();

        // Rekap daftar hadir
        $rekapDaftarHadir = $peserta->map(function ($item, $i) use ($presensiNis) {
            return [
                'no' => $i + 1,
                'nis' => $item->nis,
                'nama' => $item->nama,
                'asrama' => $item->asrama->asrama ?? '-',
                'kode' => $item->asrama->kode ?? '-',
                'status' => in_array($item->nokartu, $presensiNis) ? 'Hadir' : 'Tidak Hadir',
            ];
        });

        // Hitung total hadir dan tidak hadir
        $jumlahHadir = $rekapDaftarHadir->where('status', 'Hadir')->count();
        $jumlahTidakHadir = $rekapDaftarHadir->where('status', 'Tidak Hadir')->count();

        // Cetak PDF
        $pdf = Pdf::loadView('kegiatan.cetak', compact(
            'kegiatan',
            'rekapDaftarHadir',
            'jumlahHadir',
            'jumlahTidakHadir'
        ))->setPaper('A4', 'portrait');

        return $pdf->stream('daftar-hadir-kegiatan.pdf');
    }




}
