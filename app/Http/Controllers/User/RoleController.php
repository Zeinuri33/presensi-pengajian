<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::latest()->get();

        return view('user.role.index', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $role = Role::create(['name' => $request->name]);

        if ($request->permissions) {
            $role->syncPermissions($request->permissions);
        }

        return back()->with('success', 'Peran berhasil ditambahkan');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role, $id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('user.role.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function perbarui(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->name = $request->name;

        if (!$role->save()) {
            return back()->with('error', 'Gagal menyimpan data role.');
        }

        $role->syncPermissions($request->permissions ?? []);

        return back()->with('success', 'Peran dan Akses berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();

        return back()->with('success', 'Peran berhasil dihapus');

    }
}
