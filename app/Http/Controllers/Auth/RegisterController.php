<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Unit;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;

class RegisterController extends Controller
{


    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'nim' => ['required', 'string', 'max:20',],
    //         'unit' => ['required', 'string', 'max:255'],
    //         'no_wa' => ['required', 'string', 'max:15'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    public function showRegistrationForm()
    {
        $prodi = Unit::all();
        return view('auth.register', compact('prodi'));
    }

    public function register(Request $request)
    {
        $dataVal = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20'],
            'no_wa' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string'],
            'prodi_id' => ['required', 'string'],
        ]);

        User::create([
            'name' => $dataVal['name'],
            'prodi_id' => $dataVal['prodi_id'],
            'email' => $dataVal['email'],
            'password' =>  Hash::make($request->input('password')),
            'role_id' => 1,
            'nim' => $dataVal['nim'],
            'no_wa' => $dataVal['no_wa']
        ]);

        return redirect()->route('login');
    }
}