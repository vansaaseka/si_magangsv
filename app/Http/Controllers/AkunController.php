<?php

namespace App\Http\Controllers;

use App\Models\AjuanMagang;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class AkunController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //menampilkan tabel
    public function indexmahasiswa()
    {
        $mahasiswa = User::all();
        $prodi = Unit::all();
        $pengajuan = AjuanMagang::all();

        if (Auth()->user()->role == 2) {
            $activePage = 'manajemenuser';
            return view('cdc\ManajemenUser\tampilMahasiswa', compact('activePage', 'mahasiswa', 'prodi', 'pengajuan'));
        } else {
            abort(403);
        }
    }

    public function indexcdc()
    {
        $cdc = User::all();

        if (Auth()->user()->role == 2) {
            return view('cdc\ManajemenUser\tampilCDC', compact('cdc'));
        } else {
            abort(403);
        }
    }

    public function indexadmin()
    {
        $admin = User::all();

        if (Auth()->user()->role == 2) {
            return view('cdc\ManajemenUser\tampilAdmin', compact('admin'));
        } else {
            abort(403);
        }
    }

    public function indexdekanat()
    {
        $dekan = User::all();

        if (Auth()->user()->role == 2) {
            return view('cdc\ManajemenUser\tampilDekanat', compact('dekan'));
        } else {
            abort(403);
        }
    }

    //modal tambah
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nim' => 'required',
            'role' => 'required',
            'unit' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $akun = new user;
        $akun->name = $request->input('name');
        $akun->email = $request->input('email');
        $akun->role = $request->input('role');
        $akun->status = $request->input('status');
        $akun->unit_id = $request->input('unit_id');
        $akun->password = Hash::make($request->password);

        $akun->save();
        //return nya ngikut role nya aja, klo mhs ya mhs tok
        if ($akun->role == 1) {
            return redirect()->route('tampilmahasiswa')->with('toast_success', 'Data Berhasil Tersimpan');
        } elseif ($akun->role == 2) {
            return redirect()->route('tampilcdc')->with('toast_success', 'Data Berhasil Tersimpan');
        } elseif ($akun->role == 3) {
            return redirect()->route('tampiladmin')->with('toast_success', 'Data Berhasil Tersimpan');
        } elseif ($akun->role == 4) {
            return redirect()->route('tampildekanat')->with('toast_success', 'Data Berhasil Tersimpan');
        }
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->update($request->all());
        if ($data->role == 1) {
            return redirect()->route('tampilmahasiswa')->with('toast_success', 'Data Berhasil Diupdate');
        } elseif ($data->role == 2) {
            return redirect()->route('tampilcdc')->with('toast_success', 'Data Berhasil Diupdate');
        } elseif ($data->role == 3) {
            return redirect()->route('tampiladmin')->with('toast_success', 'Data Berhasil Diupdate');
        } elseif ($data->role == 4) {
            return redirect()->route('tampildekanat')->with('toast_success', 'Data Berhasil Diupdate');
        }
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        if ($data->role == 1) {
            return redirect()->route('tampilmahasiswa');
        } elseif ($data->role == 2) {
            return redirect()->route('tampilcdc');
        } elseif ($data->role == 3) {
            return redirect()->route('tampiladmin');
        } elseif ($data->role == 4) {
            return redirect()->route('tampildekanat');
        }
    }

    public function ubahstatus($id)
    {
        $data = User::find($id);
        $status_sekarang = $data->status;
        if ($status_sekarang == 1) {
            $data->where('id', $id)->update([
                'status' => 0

            ]);
        } else {
            $data->where('id', $id)->update([
                'status' => 1
            ]);
        }
        if ($status_sekarang == 0) {
        }

        if ($data->role == 1) {
            return redirect()->route('tampilmahasiswa');
        } elseif ($data->role == 2) {
            return redirect()->route('tampilcdc');
        } elseif ($data->role == 3) {
            return redirect()->route('tampiladmin');
        } elseif ($data->role == 4) {
            return redirect()->route('tampildekanat');
        }
    }

    public function ubahpassword(Request $request)
    {
        $this->validate($request, [

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'current_password' => ['required']
        ]);

        if (Hash::check($request->current_password, auth()->user()->password)) {
            // auth()->user()->update(['password' =>Hash::make($request->password)]);
            // Alert::success('Sukses', 'Password Berhasil Diubah');
            return back();
        }

        throw ValidationException::withMessages([
            'current_password' => 'Password tidak sesuai dengan data password'

        ]);
    }
}
