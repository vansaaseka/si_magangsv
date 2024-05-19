<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaNilai extends Model
{
    use HasFactory;

    protected $fillable =[
        'nilai_magang_id',
        'nama_nilai',
        'deskripsi'
    ];

    public function nilaimagangs() {
        return $this->belongsTo(NilaiMagang::class);
    }
}
