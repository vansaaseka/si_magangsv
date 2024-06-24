<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Ambil hanya email dan password dari request
        $credentials = $request->only('email', 'password');

        // Validasi input
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        // Cari pengguna berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        // Periksa apakah pengguna ditemukan dan statusnya adalah 1
        if ($user && $user->status == 1) {
            // Coba autentikasi pengguna
            if (Auth::attempt($credentials)) {
                // Jika autentikasi berhasil dan role_id adalah 1 (mahasiswa)
                if ($user->role_id == 1) {
                    return redirect()->route('dashboard');
                }
                if ($user->role_id == 2) {
                    return redirect()->route('dashboard');
                }
                if ($user->role_id == 3) {
                    return redirect()->route('dashboard');
                }
                if ($user->role_id == 4) {
                    return redirect()->route('dashboard');
                }
                if ($user->role_id == 5) {
                    return redirect()->route('editprofile');
                }
                // Tambahkan logika tambahan jika diperlukan untuk peran lain
            } else {
                return redirect()->route('login')->with('error', 'Email atau password salah.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Akun tidak aktif atau tidak ditemukan.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
