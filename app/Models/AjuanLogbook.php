<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjuanLogbook extends Model
{
    use HasFactory;

    protected $fillable =[
        'ajuan_magang_id',
        'logbook_id'
    ];

    public function ajuanmagangs() {
        return $this->hasMany(AjuanMagang::class);
    }

    public function logbooks() {
        return $this->hasMany(Logbook::class);
    }
}
