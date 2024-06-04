<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $fillable = [
        'pemilik_id',
        'merek_kendaraan_id',
        'tgl_buat',
        'tgl_pajak',
        'tgl_stnk',
    ];

    public function pemilikRelation()
    {
        return $this->belongsTo(Pemilik::class, 'pemilik_id','id');
    }

    public function merekKendaraanRelation()
    {
        return $this->belongsTo(mkendaraan::class, 'merek_kendaraan_id','id');
    }
}
