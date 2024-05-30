<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;
    protected $table = 'pemilik';
    protected $fillable = [
        'no_polisi',
        'nama_pemilik',
        'alamat',
        'rt',
        'rw',
        'kel_des',
        'kec',
        'kab',
        'provinsi',
        'kode_pos',
    ];
}
