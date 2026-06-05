<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\Arsip\Suratmasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuratmasukController extends Controller
{
    //
    public function index()
    {
        $masuk = Suratmasuk::latest()->get();

        return view('arsip.suratmasuk.index', compact('masuk'));
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
            $path = $file->storeAs('suratmasuk', $filename, 'public');

            $data['file'] = $path;
        }

        Suratmasuk::create($data);

        return back()->with('success', 'Data Surat Masuk berhasil ditambahkan.');
    }


    public function update(Request $request, $id)
    {
        $surat = Suratmasuk::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            // Nama file: hasil slug dari nomor
            $filename = Str::slug($request->perihal) . '.' . $ext;

            $path = $file->storeAs('suratmasuk', $filename, 'public');

            // Hapus file lama jika ada
            if ($surat->file && \Storage::disk('public')->exists($surat->file)) {
                \Storage::disk('public')->delete($surat->file);
            }

            $data['file'] = $path;
        }

        $surat->update($data);

        return back()->with('success', 'Data Surat Masuk berhasil diperbarui.');
    }


    public function hapus($id)
    {
        $masuk = Suratmasuk::findOrFail($id);

        // Hapus file dari storage jika ada
        if ($masuk->file && \Storage::disk('public')->exists($masuk->file)) {
            \Storage::disk('public')->delete($masuk->file);
        }

        // Hapus data dari database
        $masuk->delete();

        return back()->with('success', 'Data Surat Masuk berhasil dihapus.');
    }

}
