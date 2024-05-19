<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nim'
    ];


    public function ajuanmagangs()
    {
        return $this->hasMany(Ajuanmagang::class, 'anggota_id', 'id');
    }

}
