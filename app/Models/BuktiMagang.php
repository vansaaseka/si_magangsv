<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiMagang extends Model
{
    use HasFactory;

    protected $fillable = [
        'jawaban',
        'nama_file',
    ];

    public function ajuanmagangs()
    {
        return $this->belongsTo(AjuanMagang::class, 'id_ajuans', 'id');
    }

}

