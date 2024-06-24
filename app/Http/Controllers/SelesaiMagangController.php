<?php

namespace App\Http\Controllers;

use App\Models\AjuanMagang;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SelesaiMagangController extends Controller
{
    public function index()
    {
        $selesaimagang = AjuanMagang::all();

        if (Auth::user()->role_id == '1') {
            $selesaimagang = AjuanMagang::where('user_id', auth()->id())->get();

            $activePage = 'selesaimagang';
            return view('mahasiswa.selesaimagang', compact('selesaimagang', 'activePage'));
        } elseif (Auth::user()->role_id == '2') {

            $selesaimagang = AjuanMagang::all();

            $activePage = 'selesaimagang';
            return view('cdc.Pengajuan.dokumen', compact('selesaimagang', 'activePage'));
        } elseif (Auth::user()->role_id == '3') {

            $selesaimagang = AjuanMagang::all();

            $activePage = 'selesaimagang';
            return view('admin.dokumen', compact('selesaimagang', 'activePage'));
        }
    }

    public function update(Request $request)
    {
        $nilaimagang = new AjuanMagang();
        if ($request->hasFile('file_nilai')) {
            $file = $request->file('file_nilai');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/nilaimagang', $filename);
            $nilaimagang->file_nilai = $filename;
        } else {
            $nilaimagang->file_nilai = null;
        }

        $nilaimagang->save();

        $laporanakhir = new AjuanMagang();
        if ($request->hasFile('laporan_akhir')) {
            $file = $request->file('laporan_akhir');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/laporanakhir', $filename);
            $laporanakhir->laporan_akhir = $filename;
        } else {
            $laporanakhir->laporan_akhir = null;
        }

        $laporanakhir->save();
    }
}
