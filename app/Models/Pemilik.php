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

    public function provinsiRelation()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi','kode');
    }

    public function kabupatenRelation()
    {
        return $this->belongsTo(Kabupaten::class, 'kab','kode');
    }

    public function kecamatanRelation()
    {
        return $this->belongsTo(Kecamatan::class, 'kec','kode');
    }

    public function desaRelation()
    {
        return $this->belongsTo(Desa::class, 'kel_des','kode');
    }

}
