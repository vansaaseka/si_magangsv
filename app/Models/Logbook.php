<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $fillable =[
        'ajuan_logbook_id',
        'judul_logbook',
        'tanggal',
        'deskripsi'
    ];

    public function ajuanlogbooks() {
        return $this->belongsTo(AjuanLogbook::class);
    }
}
