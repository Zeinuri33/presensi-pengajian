<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = User::latest()->get();
        $role = Role::all();

        return view('user.user.index', compact('user', 'role'));
    }

    public function store(Request $request)
    {
        $avatarName = null;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatars', $avatar->hashName());
            $avatarName = $avatar->hashName();
        }

        $user = User::create([
            'avatar' => $avatarName,
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);


        return back()->with('success', 'Data berhasil disimpan');
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $avatarName = $user->avatar; // Default: pakai avatar lama

        // Handle jika ada upload avatar baru
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar->storeAs('public/avatars', $avatar->hashName());

            // Hapus avatar lama jika ada
            if ($user->avatar) {
                Storage::delete('public/avatars/' . $user->avatar);
            }

            $avatarName = $avatar->hashName();
        }

        // Update data dasar
        $user->update([
            'avatar' => $avatarName,
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'username' => $request->username,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        // Update role
        $user->syncRoles($request->role);

        return back()->with('success', 'Data berhasil diperbarui');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

}
