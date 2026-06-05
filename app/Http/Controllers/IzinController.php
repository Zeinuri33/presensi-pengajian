<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Kepalakamar;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    //
    public function index(Request $request)
    {
        $tanggal = $request->input('tanggal') ?? now()->toDateString();

        $izin = Izin::with('kepalakamar')
            ->whereDate('tanggal', $tanggal)
            ->orderBy('tanggal')
            ->get();


        return view('absensi.izin.index', compact('izin', 'tanggal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nokartu' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $kepalakamar = Kepalakamar::where('nokartu', $request->nokartu)->first();

        if (!$kepalakamar) {
            return back()->with('error', 'NIS tidak ditemukan.');
        }

        $sudah = Izin::where('kepalakamar_id', $kepalakamar->id)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($sudah) {
            return back()->with('error', 'Santri ini sudah memiliki izin di tanggal tersebut.');
        }

        Izin::create([
            'kepalakamar_id' => $kepalakamar->id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success', 'Data izin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        $izin = Izin::findOrFail($id);

        // Cek apakah sudah ada izin di tanggal tersebut selain dirinya sendiri
        $cekDuplikat = Izin::where('kepalakamar_id', $izin->kepalakamar_id)
            ->whereDate('tanggal', $request->tanggal)
            ->where('id', '!=', $izin->id)
            ->exists();

        if ($cekDuplikat) {
            return back()->with('error', 'Sudah ada izin untuk tanggal ini.');
        }

        $izin->update([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan
        ]);

        return back()->with('success', 'Izin berhasil diperbarui.');
    }
}
