<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //

    public function index()
    {
        $permission = Permission::latest()->get();

        return view('user.permission.index', compact('permission'));
    }

    public function store(Request $request)
    {
        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        return back()->with('success', 'Askes berhasil ditambahkan');

    }

    public function update(Request $request, Permission $permission)
    {
        $permission->update(['name'=> $request->name]);

        return back()->with('success', 'Akses berhasil diperbarui');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return back()->with('success', 'Akses berhasil dihapus');
    }

}
