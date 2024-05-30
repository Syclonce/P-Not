<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;

class WilayahController extends Controller
{
    public function getProvinsi()
    {
        $data = Provinsi::all();
        return response()->json(['data' => $data]);
    }

    public function getKabupaten($kode_provinsi = null)
    {
        if (empty($kode_provinsi)) {
            $data = [];
        } else {
            $data = Kabupaten::where('kode_provinsi', $kode_provinsi)->get();
        }
        return response()->json(['data' => $data]);
    }

    public function getKecamatan($kode_kabupaten = null)
    {
        if(empty($kode_kabupaten)) {
            $data = [];
        } else {
            $data = Kecamatan::where('kode_kabupaten', $kode_kabupaten)->get();
        }
        return response()->json(['data' => $data]);
    }

    public function getDesa($kode_kecamatan = null)
    {
        if (empty($kode_kecamatan)) {
            $data = [];
        } else {
            $data = Desa::where('kode_kecamatan', $kode_kecamatan)->get();
        }
        return response()->json(['data' => $data]);
    }
}
