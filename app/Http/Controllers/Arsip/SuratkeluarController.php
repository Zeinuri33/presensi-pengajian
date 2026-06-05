<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\Arsip\Suratkeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuratkeluarController extends Controller
{
    //
    //
    public function index()
    {
        $keluar = Suratkeluar::latest()->get();

        return view('arsip.suratkeluar.index', compact('keluar'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            // Gunakan slug dari 'nomor' untuk nama file
            $filename = Str::slug($request->perihal) . '.' . $ext;

            // Simpan file ke folder storage/app/public/suratmasuk
            $path = $file->storeAs('suratkeluar', $filename, 'public');

            $data['file'] = $path;
        }

        Suratkeluar::create($data);

        return back()->with('success', 'Data Surat Keluar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $surat = Suratkeluar::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            // Nama file: hasil slug dari nomor
            $filename = Str::slug($request->perihal) . '.' . $ext;

            $path = $file->storeAs('suratkeluar', $filename, 'public');

            // Hapus file lama jika ada
            if ($surat->file && \Storage::disk('public')->exists($surat->file)) {
                \Storage::disk('public')->delete($surat->file);
            }

            $data['file'] = $path;
        }

        $surat->update($data);

        return back()->with('success', 'Data Surat Keluar berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $keluar = Suratkeluar::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($keluar->file && \Storage::disk('public')->exists($keluar->file)) {
            \Storage::disk('public')->delete($keluar->file);
        }

        // Hapus data dari database
        $keluar->delete();

        return back()->with('success', 'Data Surat Keluar berhasil dihapus.');
    }
}
