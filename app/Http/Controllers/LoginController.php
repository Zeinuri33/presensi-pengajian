<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Tampilkan halaman login
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Login menggunakan Auth::attempt()
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/'); // Redirect jika sukses
        }

        // Jika gagal, kembali ke halaman login dengan error
        return back()->withErrors(['login' => 'Username atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }

    // Mengubah default login menggunakan username
    public function username()
    {
        return 'username';
    }
}
