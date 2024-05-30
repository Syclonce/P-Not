<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use App\Models\kendaraan;


class PemilikController extends Controller
{
    public function index()
    {
        $title = 'Rs Apps';
        $kendaraan = kendaraan::all(); //Perlu pemisahan view

        $pemilik = Pemilik::all();
        return view('superadmin.pemilik', compact('pemilik','kendaraan','title'));
    }
}
