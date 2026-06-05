<?php

namespace App\Http\Controllers;

use App\Models\Harilibur;
use Illuminate\Http\Request;

class LiburController extends Controller
{
    //
    public function index()
    {
        $libur = Harilibur::orderByDesc('mulai')->get();

        return view('absensi.libur.index', compact('libur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mulai' => 'required|date',
            'sampai' => 'required|date|after_or_equal:mulai',
            'keterangan' => 'nullable|string'
        ]);

        Harilibur::create($request->all());

        return back()->with('success', 'Hari Libur pengajian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mulai' => 'required|date',
            'sampai' => 'required|date|after_or_equal:mulai',
            'keterangan' => 'nullable|string'
        ]);

        $libur = Harilibur::findOrFail($id);

        $libur->update([
            'mulai' => $request->mulai,
            'sampai' => $request->sampai,
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Hari libur pengajian berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $libur = Harilibur::findOrFail($id);
        $libur->delete();

        return back()->with('success', 'Hari libur pengajian berhasil dihapus.');
    }

}
