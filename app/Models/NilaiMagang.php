<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiMagang extends Model
{
    use HasFactory;

    protected $fillable =[
        'ajuan_magang_id',
        'kriteria_nilai_id'
    ];

    public function ajuanmagangs() {
        return $this->hasMany(AjuanMagang::class);
    }

    public function kriterianilais() {
        return $this->hasMany(KriteriaNilai::class);
    }
}
