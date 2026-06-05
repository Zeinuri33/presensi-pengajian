<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\Kepalakamar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KepalaKamarController extends Controller
{
    //
    public function index()
    {
        $kepalakamar = Kepalakamar::latest()->get();
        $asrama = Asrama::all();

        return view('asrama.kepalakamar.index', compact('kepalakamar' , 'asrama'));
    }

    public function wakil()
    {
        $wakilkamar = Kepalakamar::latest()->get();
        $asrama = Asrama::all();

        return view('asrama.wakilkamar.index', compact('wakilkamar' , 'asrama'));
    }

    public function store(Request $request)
    {
        // Cek apakah NIS sudah ada di tabel kepala_kamars
        if ($request->nokartu) {
            $cekKTS = Kepalakamar::where('nokartu', $request->nokartu)->first();

            if ($cekKTS) {
                return back()->with('error', 'KTS ini sudah digunakan.');
            }
        }

        $namafoto = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto->storeAs('public/kepalakamar', $foto->hashName());
            $namafoto = $foto->hashName();
        }

        $asrama = Asrama::findOrFail($request->asrama_id);

        $existing = $asrama->kepalakamar()
            ->where('jabatan', $request->jabatan)
            ->first();

        if ($existing) {
            return back()->with('error', "Asrama ini sudah memiliki santri dengan jabatan {$request->jabatan}.");
        }

        Kepalakamar::create([
            'nokartu' => $request->nokartu,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'asrama_id' => $request->asrama_id,
            'foto' => $namafoto
        ]);

        return back()->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $kepalakamar = Kepalakamar::findOrFail($id);
        $asrama = Asrama::all();

        return view('asrama.kepalakamar.edit', compact('kepalakamar', 'asrama'));
    }

    public function update(Request $request, $id)
    {
        $kepalakamar = KepalaKamar::findOrFail($id);

        // Cek apakah ada NIS yang sama di entri lain
        if ($request->nokartu) {
            $cekKTS = Kepalakamar::where('nokartu', $request->nokartu)
                ->where('id', '!=', $id)
                ->first();

            if ($cekKTS) {
                return back()->with('error', 'KTS ini sudah digunakan.');
            }
        }


        // Validasi jabatan duplikat di asrama yang sama, kecuali jika baris yang sama
        $cekDuplikat = KepalaKamar::where('asrama_id', $request->asrama_id)
            ->where('jabatan', $request->jabatan)
            ->where('id', '!=', $kepalakamar->id)
            ->exists();

        if ($cekDuplikat) {
            return back()->with('error', "Asrama ini sudah memiliki santri dengan jabatan {$request->jabatan}.");
        }

        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto->storeAs('public/kepalakamar', $foto->hashName());

            // Hapus foto lama jika ada
            if ($kepalakamar->foto) {
                Storage::delete('public/kepalakamar/' . $kepalakamar->foto);
            }

            $kepalakamar->update([
                'foto' => $foto->hashName(),
                'nokartu' => $request->nokartu,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'asrama_id' => $request->asrama_id
            ]);
        } else {
            $kepalakamar->update([
                'nis' => $request->nis,
                'nokartu' => $request->nokartu,
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
                'asrama_id' => $request->asrama_id
            ]);
        }

        // Redirect sesuai jabatan
        if ($request->jabatan == 'Kepala Kamar') {
            return redirect('/kepalakamar')->with('success', 'Data berhasil diperbarui');
        } elseif ($request->jabatan == 'Wakil Kamar') {
            return redirect('/wakilkamar')->with('success', 'Data berhasil diperbarui');
        }

        // Fallback jika jabatan tidak dikenali
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function hapus($id)
    {
        $kepalakamar = Kepalakamar::findOrFail($id);

        Storage::delete('public/kepalakamar/'. $kepalakamar->foto);

        $kepalakamar->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    public function cetakKA(Request $request)
    {
        $kepalakamar = Kepalakamar::query()
            ->select('kepalakamars.*')
            ->join('asramas', 'asramas.id', '=', 'kepalakamars.asrama_id')

            // WAJIB hanya Kepala Kamar
            ->where('kepalakamars.jabatan', 'Kepala Kamar')

            // Filter Wilayah
            ->when($request->wilayah, function ($q) use ($request) {
                $q->where('asramas.wilayah', $request->wilayah);
            })

            // Filter Daerah
            ->when($request->daerah, function ($q) use ($request) {
                $q->where('asramas.daerah', $request->daerah);
            })

            // PRIORITAS WILAYAH
            ->orderByRaw("
                CASE 
                    WHEN asramas.wilayah = 'Pusat' THEN 1
                    WHEN asramas.wilayah = 'Cabang' THEN 2
                    ELSE 3
                END
            ")

            // URUT HURUF KODE
            ->orderByRaw("REGEXP_REPLACE(asramas.kode, '[0-9]', '') ASC")

            // URUT ANGKA KODE
            ->orderByRaw("CAST(REGEXP_REPLACE(asramas.kode, '[^0-9]', '') AS UNSIGNED) ASC")

            ->orderBy('kepalakamars.nama')
            ->with('asrama')
            ->get();

        $pdf = Pdf::loadView(
            'asrama.kepalakamar.cetak',
            compact('kepalakamar')
        )->setPaper('A4', 'portrait');

        $namaFile = 'data-kepala-kamar';

        if ($request->wilayah) {
            $namaFile .= '-asrama-' . strtolower($request->wilayah);
        } elseif ($request->daerah) {
            $namaFile .= '-asrama-' . str_replace(' ', '-', strtolower($request->daerah));
        }

        $namaFile .= '.pdf';

        return $pdf->stream($namaFile);
    }

    public function cetakWK(Request $request)
    {
        $kepalakamar = Kepalakamar::query()
            ->select('kepalakamars.*')
            ->join('asramas', 'asramas.id', '=', 'kepalakamars.asrama_id')

            // WAJIB hanya Kepala Kamar
            ->where('kepalakamars.jabatan', 'Wakil Kamar')

            // Filter Wilayah
            ->when($request->wilayah, function ($q) use ($request) {
                $q->where('asramas.wilayah', $request->wilayah);
            })

            // Filter Daerah
            ->when($request->daerah, function ($q) use ($request) {
                $q->where('asramas.daerah', $request->daerah);
            })

            // PRIORITAS WILAYAH
            ->orderByRaw("
                CASE 
                    WHEN asramas.wilayah = 'Pusat' THEN 1
                    WHEN asramas.wilayah = 'Cabang' THEN 2
                    ELSE 3
                END
            ")

            // URUT HURUF KODE
            ->orderByRaw("REGEXP_REPLACE(asramas.kode, '[0-9]', '') ASC")

            // URUT ANGKA KODE
            ->orderByRaw("CAST(REGEXP_REPLACE(asramas.kode, '[^0-9]', '') AS UNSIGNED) ASC")

            ->orderBy('kepalakamars.nama')
            ->with('asrama')
            ->get();

        $pdf = Pdf::loadView(
            'asrama.wakilkamar.cetak',
            compact('kepalakamar')
        )->setPaper('A4', 'portrait');

        $namaFile = 'data-wakil-kepala-kamar';

        if ($request->wilayah) {
            $namaFile .= '-asrama-' . strtolower($request->wilayah);
        } elseif ($request->daerah) {
            $namaFile .= '-asrama-' . str_replace(' ', '-', strtolower($request->daerah));
        }

        $namaFile .= '.pdf';

        return $pdf->stream($namaFile);
    }

    public function verifikasi()
    {
        // HALAMAN SELALU KOSONG
        return view('postel.verifikasi', [
            'kepalakamar' => null
        ]);
    }

    public function verifikasiCari(Request $request)
    {
        $request->validate([
            'nokartu' => 'required'
        ]);

        $kepalakamar = Kepalakamar::where('nokartu', $request->nokartu)->first();
        if (!$kepalakamar) {
            return back()
                ->with('error', 'KTS/El-Santri tidak terdaftar sebagai Kepala Kamar atau Wakil Kepala Kamar.');
        }

        return redirect()
            ->route('postel.verifikasi')
            ->with('kepalakamar', $kepalakamar);
    }

}
