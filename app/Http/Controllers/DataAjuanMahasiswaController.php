<?php

namespace App\Http\Controllers;

use App\Models\AjuanMagang;
use App\Models\Anggota;
use App\Models\Proposal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class DataAjuanMahasiswaController extends Controller
{
    public function index()
    {
        $users = User::all();

        if (Auth::user()->role_id == '1') {
            $dataajuan = AjuanMagang::where('user_id', auth()->id())->get();

            return view('mahasiswa.dataajuan', compact('dataajuan'));
        } elseif (Auth::user()->role_id == '2') {

            $dataajuan = AjuanMagang::all();

            $activePage = 'pengajuan';
            return view('cdc.Pengajuan.datapengajuan', compact('dataajuan', 'activePage'));
        } elseif (Auth::user()->role_id == '3') {
            $dataajuan = AjuanMagang::whereIn('status', ['proses validasi', 'siap download'])->get();

            $activePage = 'pengajuan';
            return view('admin.datapengajuan', compact('dataajuan', 'activePage'));
        } elseif (Auth::user()->role_id == '4') {
            $dataajuan = AjuanMagang::whereIn('status', ['proses validasi', 'siap download'])->get();

            $activePage = 'pengajuan';
            return view('dekanat.datapengajuan', compact('dataajuan', 'activePage'));
        } elseif (Auth::user()->role_id == 5) {
            // Dosen melihat ajuan magang yang terkait dengan mereka
            $dataajuan = AjuanMagang::where('dosen_pembimbing', Auth::user()->id)->get();
            $activePage = 'pengajuan';

            return view('dosen.datapengajuan', compact('dataajuan', 'activePage'));

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
        } else if (Auth::user()->role_id == '3') {
            $dataajuan = AjuanMagang::findOrFail($id);
            $request->validate([
                'status' => 'required|array',
            ]);

            $status = $request->input('status');
            $dataajuan->update(['status' => 'siap download']);

            return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
        } else if (Auth::user()->role_id == '5') {
            $dataajuan = AjuanMagang::findOrFail($id);

            $request->validate([
                'status' => 'required|array',
            ]);

            $status = $request->input('status');

            if (in_array('selesai magang', $status)) {
                $dataajuan->update(['status' => 'selesai magang']);
            }

            $dataajuan->save();

            return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
        }
    }

    public function approve(Request $request, $id)
    {
        $dataajuan = AjuanMagang::findOrFail($id);

        $request->validate([
            'verified' => 'required',
        ]);

        $dataajuan->update(['verified' => 'approve final']);
        $dataajuan->update(['status' => 'siap download']);

        Carbon::setLocale('id');

        $dataTemplate = [
            'name' => $dataajuan->users->name,
            'nim' => $dataajuan->users->nim,
            'prodi' => $dataajuan->users->units->nama_prodi,
            'nama_instansi' => $dataajuan->instansis->nama_instansi,
            'alamat_surat' => $dataajuan->instansis->alamat_surat,
            'alamat_instansi' => $dataajuan->instansis->alamat_instansi,
            'judul_proposal' => $dataajuan->proposals->judul_proposal,
            'dosen_pembimbing' => $dataajuan->dosen_pembimbing,
            'tanggal_mulai' => Carbon::parse($dataajuan->tanggal_mulai)->translatedFormat('d F Y'),
            'tanggal_selesai' => Carbon::parse($dataajuan->tanggal_selesai)->translatedFormat('d F Y'),
        ];

        $templatePath = public_path('tamplate.docx');
        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValues($dataTemplate);

        $fileName = 'surat_pengantar_' . $dataajuan->users->name;
        $outputPath = public_path($fileName . '.docx');
        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }

    public function store(Request $request, $id)
    {
        if (Auth::user()->role_id == '3') {
            $request->validate([
                'nama_file' => 'required|file',
                'surat_pengantar' => 'required|file',
                'surat_tugas' => 'required|file|mimes:pdf|max:2048',
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

                // Simpan file surat_tugas
                if ($request->hasFile('surat_tugas')) {
                    $file = $request->file('surat_tugas');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/surat_tugas', $filename);

                    // Hapus file lama jika ada
                    if ($proposal->ajuan->surat_tugas) {
                        Storage::delete('public/surat_tugas/' . $proposal->ajuan->surat_tugas);
                    }

                    $proposal->ajuan->surat_tugas = $filename;
                    $proposal->ajuan->save();
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

    public function upload(Request $request, $id)
    {
        $ajuanMagang = AjuanMagang::find($id);

        if (!$ajuanMagang) {
            return redirect()->back()->with('error', 'Data ajuan magang tidak ditemukan.');
        }

        if ($request->hasFile('file_nilai')) {
            $fileNilai = $request->file('file_nilai');
            $filenameNilai = time() . '_' . $fileNilai->getClientOriginalName();
            $fileNilai->storeAs('public/nilaimagang', $filenameNilai);
            $ajuanMagang->file_nilai = $filenameNilai;
        }

        if ($request->hasFile('laporan_akhir')) {
            $fileLaporanAkhir = $request->file('laporan_akhir');
            $filenameLaporanAkhir = time() . '_' . $fileLaporanAkhir->getClientOriginalName();
            $fileLaporanAkhir->storeAs('public/laporanakhir', $filenameLaporanAkhir);
            $ajuanMagang->laporan_akhir = $filenameLaporanAkhir;
        }

        $ajuanMagang->save();

        return redirect()->back()->with('success', 'Nilai dan laporan akhir berhasil diupload.');
    }

    public function surattugas(Request $request, $id)
    {
        if (Auth::user()->role_id == '3') {
            $request->validate([
                'surat_tugas' => 'required|file|mimes:pdf|max:2048',
            ]);

            DB::transaction(function () use ($request, $id) {
                // Cari ajuan magang berdasarkan $id
                $ajuan = AjuanMagang::findOrFail($id);

                // Simpan file surat_tugas
                if ($request->hasFile('surat_tugas')) {
                    $file = $request->file('surat_tugas');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->storeAs('public/surat_tugas', $filename);

                    // Hapus file lama jika ada
                    if ($ajuan->surat_tugas) {
                        Storage::delete('public/surat_tugas/' . $ajuan->surat_tugas);
                    }

                    $ajuan->surat_tugas = $filename;
                    $ajuan->save();
                }
            });

            return redirect()->back()->with('success', 'Surat Tugas berhasil diupload.');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
    }
}
