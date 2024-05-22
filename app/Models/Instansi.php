<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_instansi',
        'kategori_instansi_id',
        'no_telpon',
        'alamat_surat',
        'alamat_instansi'
    ];

    public function ajuanmagangs()
    {
        return $this->hasMany(AjuanMagang::class, 'instansi_id');
    }

    public function kategoriinstansis()
    {
        return $this->hasMany(KategoriInstansi::class, 'kategori_instansi_id');
    }
}
