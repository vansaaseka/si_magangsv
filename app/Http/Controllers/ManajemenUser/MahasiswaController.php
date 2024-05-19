<?php

namespace App\Http\Controllers\ManajemenUser;

use App\Http\Controllers\Controller;
use App\Models\AjuanMagang;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mahasiswa = User::all()->pluck('units');
        $prodi = Unit::all();
        $pengajuan = AjuanMagang::all();


        // $roles = Auth()->user()->role_id;
        // dd($prodi);

        if (Auth()->user()->role_id == 2) {
            $activePage = 'manajemenuser';
            return view('cdc.ManajemenUser.tampilMahasiswa', compact('activePage', 'mahasiswa', 'prodi', 'pengajuan'));
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'nim' => 'required',
            'no_wa' => 'required',
            'role' => 'required',
            'unit' => 'required',
            'password' => 'required',
        ]);

        $akun = new user;
        $akun->name = $request->input('name');
        $akun->nim = $request->input('nim');
        $akun->nomor = $request->input('no_wa');
        $akun->role = $request->input('role');
        $akun->status = $request->input('status');
        $akun->unit_id = $request->input('unit_id');
        $akun->password = Hash::make($request->password);

        $akun->save();
        if ($akun->role_id == 2) {
            return redirect()->route('datamahasiswa.')->with('toast_success', 'Data Berhasil Tersimpan');
        } else {
            abort(404);
        }
    }


    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->update($request->all());
        if ($data->role_id == 2) {
            return redirect()->route('datamahasiswa.')->with('toast_success', 'Data Berhasil Diupdate');
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $data->delete();
        if ($data->role_id == 2) {
            return redirect()->route('datamahasiswa.');
        } else {
            abort(404);
        }
    }

    public function ubahstatus($id)
    {
        $data = User::find($id);
        $status_sekarang = $data->status;
        if ($status_sekarang == 2) {
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

        if ($data->role_id == 2) {
            return redirect()->route('datamahaiswa.');
        } else {
            abort(404);
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
