<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'ajuan_magang_id',
        'judul_logbook',
        'tanggal',
        'deskripsi'
    ];

    public function ajuanmagangs()
    {
        return $this->belongsTo(AjuanMagang::class, 'logbook_id');
    }

    public function anggotas()
    {
        return $this->belongsToMany(Anggota::class, 'ajuan_magang', 'id_anggota', 'id_logbook');
    }
}
