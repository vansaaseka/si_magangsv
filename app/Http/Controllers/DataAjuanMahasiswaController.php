<?php

namespace App\Http\Controllers;

use App\Models\AjuanMagang;
use App\Models\Anggota;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $dataajuan = AjuanMagang::whereIn('status', ['proses validasi', 'siap download'])->get();

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



    public function update(Request $request, $id)
    {
       if (Auth::user()->role_id == '1') {
        $request->validate([
            'nama_file' => 'nullable|file|mimes:pdf|max:4084',
        ]);

        $dataajuan = AjuanMagang::findOrFail($id);

        $dataajuan->update(['jenis_ajuan' => 'jenis_perbaikan']);

        if ($request->hasFile('nama_file')) {
            $file = $request->file('nama_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/proposal', $filename);

            if (!empty($dataajuan->proposals->nama_file)) {
                $oldProposalPath = public_path('storage/proposal/' . $dataajuan->proposals->nama_file);
                if (file_exists($oldProposalPath)) {
                    unlink($oldProposalPath);
                }
            }

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

        $dataajuan->komentar_status = $komentarStatus;
        $dataajuan->save();

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    } else if(Auth::user()->role_id == '3') {
        $dataajuan = AjuanMagang::findOrFail($id);
        $request->validate([
            'status' => 'required|array',
        ]);

        $status = $request->input('status');
        $dataajuan->update(['status' => 'siap download']);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }
    }


    public function store(Request $request, $id)
    {
        if (Auth::user()->role_id == '3') {
            $request->validate([
                'nama_file' => 'required|file',
                'surat_pengantar' => 'required|file',
            ]);

            DB::transaction(function () use ($request, $id) {
                // Ambil data proposal
                $proposal = Proposal::findOrFail($id);

                // Simpan file nama_file
                if ($request->hasFile('nama_file')) {
                    $file = $request->file('nama_file');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/proposal', $filename);

                    // Hapus file lama jika ada
                    if ($proposal->nama_file) {
                        Storage::delete('public/proposal/' . $proposal->nama_file);
                    }

                    $proposal->nama_file = $filename;
                }

                // Simpan file surat_pengantar
                if ($request->hasFile('surat_pengantar')) {
                    $file = $request->file('surat_pengantar');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/surat_pengantar', $filename);
                    $ajuan = AjuanMagang::where('proposal_id', $proposal->id)->firstOrFail();

                    // Hapus file lama jika ada
                    if ($ajuan->surat_pengantar) {
                        Storage::delete('public/surat_pengantar/' . $ajuan->surat_pengantar);
                    }

                    $ajuan->surat_pengantar = $filename;
                    $ajuan->save();
                }

                $proposal->save();
            });

            return redirect()->back()->with('success', 'Data berhasil diupdate.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
    }



    public function delete(Request $request, $id)
    {
        $dataajuan = AjuanMagang::findOrFail($id);

        $proposalPath = public_path('storage/proposal/' . $dataajuan->proposals->nama_file);
        if (file_exists($proposalPath)) {
            unlink($proposalPath);
        }

        $dataajuan->proposals()->delete();

        $dataajuan->delete();

        return redirect()->back()->with('success', 'Data pengajuan berhasil dihapus.');
    }

}
