<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mkendaraan extends Model
{
    use HasFactory;
    protected $table = 'merek_kendaraan';
    protected $fillable = [
        'merek',
        'model',
        'kode_merek',
        'tgl_buat',
    ];
}
