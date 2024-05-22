<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjuanMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tahun_ajaran_semester_id',
        'instansi_id',
        'anggota_id',
        'proposal_id',
        'laporan_akhir_id',
        'angkatan',
        'surat_pengantar',
        'jenis_ajuan',
        'bukti_magang',
        'status',
        'bobot_sks',
        'file_nilai',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_kegiatan',
        'dosen_pembimbing', 'verified',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tahunajaransemesters()
    {
        return $this->belongsTo(TahunAjaranSemester::class);
    }

    public function proposals()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }

    public function nilaimagangs()
    {
        return $this->belongsTo(NilaiMagang::class);
    }

    public function ajuanlogbooks()
    {
        return $this->belongsTo(Logbook::class);
    }

    public function laporanakhirs()
    {
        return $this->hasOne(LaporanAkhir::class);
    }

    public function anggotas()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id');
    }

    public function instansis()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id', 'id');
    }
}
