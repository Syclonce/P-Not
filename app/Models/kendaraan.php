<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $fillable = [
        'no_pol',
        'nama_pem',
        'merek',
        'model',
        'kode_merek',
        'tgl_buat',
        'tgl_pajak',
        'tgl_stnk',
    ];
}
