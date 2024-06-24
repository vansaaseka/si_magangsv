<?php

namespace App\Http\Controllers;

use App\Models\AjuanMagang;
use App\Models\BuktiMagang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class DataBuktiController extends Controller
{
    public function bukti()
    {
        if (Auth::user()->role_id == '2') {
            // $databukti = BuktiMagang::where('user_id', 1)->get();

            $databukti = AjuanMagang::all();
            // dd($databukti);
            $activePage = 'dokumen';
            return view('cdc.pengajuan.dokumen', compact('databukti', 'activePage'));
        } elseif (Auth::user()->role_id == '3') {
            $databukti = AjuanMagang::all();
            $activePage = 'dokumen';
            return view('admin.dokumen', compact('databukti', 'activePage'));
        }
    }

    public function store(Request $request, $id)
    {
        if (Auth::user()->role_id == '3') {
            $request->validate([
                'surat_tugas' => 'required|file',
            ]);

            DB::transaction(function () use ($request, $id) {
                $ajuan = AjuanMagang::findOrFail($id);

                // Simpan file surat_tugas
                if ($request->hasFile('surat_tugas')) {
                    // Hapus file lama jika ada
                    if ($ajuan->surat_tugas) {
                        Storage::delete('public/surat_tugas/' . $ajuan->surat_tugas);
                    }

                    $file = $request->file('surat_tugas');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/surat_tugas', $filename);

                    $ajuan->surat_tugas = $filename;
                    $ajuan->save();
                }
            });

            return redirect()->back()->with('success', 'Data berhasil diupdate.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
    }
}
