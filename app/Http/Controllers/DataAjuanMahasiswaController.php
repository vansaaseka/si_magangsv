<?php

namespace App\Http\Controllers;

use App\Models\AjuanMagang;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAjuanMahasiswaController extends Controller
{
    public function index()
    {


        if(Auth::user()->role_id == '1'){
            $dataajuan = AjuanMagang::where('user_id', auth()->id())->get();

            return view('mahasiswa.dataajuan', compact('dataajuan'));

        }elseif (Auth::user()->role_id == '2') {

            $dataajuan = AjuanMagang::all();

            $activePage = 'pengajuan';
            return view('cdc.Pengajuan.datapengajuan', compact('dataajuan', 'activePage'));

        }elseif (Auth::user()->role_id == '3') {
            $dataajuan = AjuanMagang::where('status', 'proses validasi')->get();
            $activePage = 'pengajuan';

            $anggotas = collect();

            foreach ($dataajuan as $ajuan) {
                if (!empty($ajuan->anggota_id)) {
                    $anggotaIds = json_decode($ajuan->anggota_id, true);
                    foreach ($anggotaIds as $anggotaId) {
                        $anggota = Anggota::find($anggotaId['id']);
                        if ($anggota) {
                            $anggotas->push($anggota);
                        }
                    }
                }
            }

            return view('admin.datapengajuan', compact('dataajuan', 'activePage', 'anggotas'));

        }
    }


    public function show($id)
{
    // Get the ajuan magang record
    $ajuanMagang = AjuanMagang::find($id);

    // Decode the anggota_id array
    $anggotaIds = json_decode($ajuanMagang->anggota_id, true);

    // Get the anggota data based on the anggota_id array
    $anggotas = Anggota::whereIn('id', $anggotaIds)->get();

    return response()->json($anggotas);
}

    public function update(Request $request, $id)
    {
       if (Auth::user()->role_id == '1') {
        $request->validate([
            'nama_file' => 'nullable|file|mimes:pdf|max:4084',
        ]);

        $dataajuan = AjuanMagang::findOrFail($id);

        // Update jenis ajuan
        $dataajuan->update(['jenis_ajuan' => 'jenis_perbaikan']);

        // Cek apakah ada file proposal yang diunggah
        if ($request->hasFile('nama_file')) {
            $file = $request->file('nama_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/proposal', $filename);

            // Hapus file proposal lama dari sistem penyimpanan
            if (!empty($dataajuan->proposals->nama_file)) {
                $oldProposalPath = public_path('storage/proposal/' . $dataajuan->proposals->nama_file);
                if (file_exists($oldProposalPath)) {
                    unlink($oldProposalPath);
                }
            }

            // Update nama file proposal baru
            $dataajuan->proposals()->update(['nama_file' => $filename]);
        }

        return redirect()->back()->with('success', 'Data pengajuan berhasil diubah.');
    } elseif (Auth::user()->role_id == '2') {
        $dataajuan = AjuanMagang::findOrFail($id);

        $request->validate([
            'status' => 'required|array',
            'komentar_status' => 'required|string|max:255',
        ]);

        $status = $request->input('status');
        $komentarStatus = $request->input('komentar_status');

        if (in_array('proses validasi', $status)) {
            $dataajuan->update(['status' => 'proses validasi']);
        } elseif (in_array('perbaikan proposal', $status)) {
            $dataajuan->update(['status' => 'perbaikan proposal']);
        }

        // Menyimpan komentar status
        $dataajuan->komentar_status = $komentarStatus;
        $dataajuan->save();

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
    }


    public function delete(Request $request, $id)
    {
        $dataajuan = AjuanMagang::findOrFail($id);

        // Hapus file proposal dari sistem penyimpanan
        $proposalPath = public_path('storage/proposal/' . $dataajuan->proposals->nama_file);
        if (file_exists($proposalPath)) {
            unlink($proposalPath); // Hapus file dari sistem
        }

        // Hapus relasi proposal terlebih dahulu
        $dataajuan->proposals()->delete();

        // Hapus data AjuanMagang
        $dataajuan->delete();

        return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus.');
    }

}
