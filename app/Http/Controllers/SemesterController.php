<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    //
    public function index()
    {
        $semester = Semester::latest()->get();

        return view('semester.index', compact('semester'));
    }

    public function store(Request $request)
    {
        Semester::create($request->all());

        return back()->with('success', 'Data Semester berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);

        $semester->update($request->all());

        return back()->with('success', 'Data Semester berhasil diperbarui.');
    }

    public function hapus($id)
    {
        $semester = Semester::findOrFail($id);

        $semester->delete();

        return back()->with('success', 'Data Semester berhasil dihapus');
    }
}
