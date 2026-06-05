<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Presensi;
use App\Models\Kepalakamar;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    //
    public function form($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        // Ambil 5 presensi terakhir untuk kegiatan ini
        $terakhirPresensi = Presensi::where('kegiatan_id', $id)
            ->orderByDesc('waktu_absen')
            ->with('kepalakamar') // relasi ke KepalaKamar
            ->limit(5)
            ->get();

        return view('kegiatan.presensi', compact('kegiatan' , 'terakhirPresensi'));
    }

    public function submit(Request $request, $id)
    {
        $request->validate([
            'nokartu' => 'required',
        ]);

        $kegiatan = Kegiatan::findOrFail($id);
        $now = now();

        $kepalakamar = Kepalakamar::where('nokartu', $request->nokartu)->first();

        // 🔐 Validasi NIS berdasarkan peserta kegiatan
        if ($kegiatan->peserta === 'Kepala Kamar') {
            if (!$kepalakamar || $kepalakamar->jabatan !== 'Kepala Kamar') {
                return back()->with('error', 'Hanya Kepala Kamar yang bisa absen untuk kegiatan ini.');
            }
        } elseif ($kegiatan->peserta === 'Wakil Kamar') {
            if (!$kepalakamar || $kepalakamar->jabatan !== 'Wakil Kamar') {
                return back()->with('error', 'Hanya Wakil Kamar yang bisa absen untuk kegiatan ini.');
            }
        } elseif ($kegiatan->peserta === 'Kepala dan Wakil') {
            if (!$kepalakamar) {
                return back()->with('error', 'KTS tidak terdaftar sebagai Kepala atau Wakil Kamar.');
            }
        } else {
            return back()->with('error', 'Jenis peserta kegiatan tidak valid.');
        }

        // 🔒 Validasi lingkup kegiatan
        if ($kegiatan->lingkup === 'Pusat') {

            if (!$kepalakamar || $kepalakamar->asrama->wilayah !== 'Pusat') {
                return back()->with(
                    'error',
                    'Kegiatan ini hanya untuk Kepala/Wakil Kepala Kamar Asrama Pusat.'
                );
            }

        } elseif ($kegiatan->lingkup === 'Cabang') {

            if (!$kepalakamar || $kepalakamar->asrama->wilayah !== 'Cabang') {
                return back()->with(
                    'error',
                    'Kegiatan ini hanya untuk Kepala/Wakil Kepala Kamar Asrama Cabang.'
                );
            }

        } elseif ($kegiatan->lingkup === 'Pusat dan Cabang') {
            // ✅ Semua boleh presensi (tidak perlu validasi wilayah)
        }



        // ⏱ Validasi waktu absen
        $mulai = \Carbon\Carbon::parse($kegiatan->tanggal . ' ' . $kegiatan->waktu);
        $batas = \Carbon\Carbon::parse($kegiatan->tanggal . ' ' . $kegiatan->batasabsen);

        if ($now->lt($mulai)) {
            return back()->with('error', 'Belum masuk waktu absen untuk kegiatan ' . $kegiatan->kegiatan . '.');
        }

        if ($now->gt($batas)) {
            return back()->with('error', 'Waktu absen telah berakhir untuk kegiatan ' . $kegiatan->kegiatan . '.');
        }

        // ❗ Cek apakah sudah absen
        $sudahPresensi = Presensi::where('kegiatan_id', $id)->where('nokartu', $request->nokartu)->exists();
        if ($sudahPresensi) {
            return back()->with('error', 'Anda sudah absen untuk kegiatan ' . $kegiatan->kegiatan . '.');
        }

        // ✅ Simpan presensi
        Presensi::create([
            'kegiatan_id' => $id,
            'nokartu' => $request->nokartu,
            'waktu_absen' => $now,
        ]);

        return back()->with('success', 'Absen berhasil untuk kegiatan ' . $kegiatan->kegiatan . '.');
    }



}
