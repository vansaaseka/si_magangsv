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
        $credentials = $request->only('email', 'password');

        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $user = User::where('email', $credentials['email'])->first();
        $users = User::all()->first();

        if ($user && $user->status == 1) {
            // Coba autentikasi pengguna
            if (Auth::attempt($credentials)) {
                $activePage = 'settings';
                if ($user->role_id == 1) {
                    if (is_null($user->nim) || is_null($user->no_wa)) {
                        return view('mahasiswa.dashboard', compact('users', 'activePage'));
                    }
                } elseif ($user->role_id == 2) {
                    if (is_null($user->nip) || is_null($user->no_wa)) {
                        return view('Cdc.layouts.settings', compact('users', 'activePage'));
                    }
                } elseif ($user->role_id == 3) {
                    if (is_null($user->nip) || is_null($user->no_wa)) {
                        return view('admin.layouts.settings', compact('users', 'activePage'));
                    }
                } elseif ($user->role_id == 4) {
                    if (is_null($user->nip) || is_null($user->no_wa)) {
                        return view('dekanat.layouts.settings', compact('users', 'activePage'));
                    }
                } elseif ($user->role_id == 5) {
                    if (is_null($user->nip) || is_null($user->no_wa)) {
                        return redirect()->route('editprofile');
                    }
                }
                return redirect()->route('dashboard');
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
