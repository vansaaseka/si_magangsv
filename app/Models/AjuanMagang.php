<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjuanMagang extends Model
{
    use HasFactory;

    protected $table = 'ajuan_magangs';

    protected $fillable = [
        'user_id',
        'tahun_ajaran_semester_id',
        'instansi_id',
        'bukti_magang_id',
        'anggota_id',
        'proposal_id',
        'laporan_akhir',
        'angkatan',
        'surat_pengantar',
        'surat_tugas',
        'jenis_ajuan',
        'status',
        'bobot_sks',
        'file_nilai',
        'tanggal_mulai',
        'tanggal_selesai',
        'jenis_kegiatan',
        'dosen_pembimbing',
        'verified',
        'surat_selesai'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tahunajaransemesters()
    {
        return $this->belongsTo(TahunAjaranSemester::class, 'tahun_ajaran_semester_id', 'id');
    }

    public function proposals()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id', 'id');
    }

    public function anggotas()
    {
        return $this->belongsToMany(Anggota::class, 'kelompok', 'id_ajuan_magang', 'id_anggota');
    }

    public function instansis()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id', 'id');
    }

    public function buktimagangs()
    {
        return $this->hasOne(BuktiMagang::class, 'ajuan_id', 'id');
    }

}
