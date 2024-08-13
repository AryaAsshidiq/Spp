<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('Admin/dashboard');
                case 'kepala_sekolah':
                    return redirect()->intended('Kepsek/dashboard');
                case 'siswa':
                    return redirect()->intended('Siswa/dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors('Peran pengguna tidak dikenali.');
            }
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan kesalahan
        return redirect()->route('login')->with('error', 'Username atau password salah.');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}