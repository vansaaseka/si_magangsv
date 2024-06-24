<?php

namespace App\Http\Controllers;

use App\Models\AjuanMagang;
use App\Models\Logbook;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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



    public function updateNilai(Request $request, $id)
    {

        // Cari data yang akan di-update
        $nilaimagang = AjuanMagang::findOrFail($id);

        // Simpan file PDF baru
        if ($request->hasFile('file_nilai')) {
            // Hapus file lama jika ada
            if ($nilaimagang->file_nilai) {
                Storage::disk('public')->delete($nilaimagang->file_nilai);
            }

            // Simpan file baru dan dapatkan path-nya
            $pdfPath = $request->file('file_nilai')->store('nilaimagang', 'public');

            // Update data dengan path file baru
            $nilaimagang->file_nilai = $pdfPath;
        }

        // Simpan perubahan
        $nilaimagang->save();

        // Kembalikan respons
        return redirect()->route('datapengajuan.index')->with('success', 'Nilai magang berhasil diupdate.');
    }
    public function updateLaporanAkhir(Request $request, $id)
    {

        // Cari data yang akan di-update
        $nilaimagang = AjuanMagang::findOrFail($id);

        // Simpan file PDF baru
        if ($request->hasFile('laporan_akhir')) {
            // Hapus file lama jika ada
            if ($nilaimagang->laporan_akhir) {
                Storage::disk('public')->delete($nilaimagang->laporan_akhir);
            }

            // Simpan file baru dan dapatkan path-nya
            $pdfPath = $request->file('laporan_akhir')->store('laporan_akhir', 'public');

            // Update data dengan path file baru
            $nilaimagang->laporan_akhir = $pdfPath;
        }

        // Simpan perubahan
        $nilaimagang->save();

        // Kembalikan respons
        return redirect()->route('datapengajuan.index')->with('success', 'Laporan Akhir magang berhasil diupdate.');
    }

    public function suratTugas(Request $request, $id)
    {
        $ajuanmagang = AjuanMagang::findOrFail($id);

        if ($request->hasFile('surat_selesai')) {
            if ($ajuanmagang->surat_selesai) {
                Storage::disk('public')->delete($ajuanmagang->surat_selesai);
            }

            $pdfPath = $request->file('surat_selesai')->store('surat_selesai', 'public');

            $ajuanmagang->surat_selesai = $pdfPath;
        }

        $ajuanmagang->save();

        return redirect()->route('datapengajuan.index')->with('success', 'Surat Selesai magang berhasil diupdate.');
    }



}
