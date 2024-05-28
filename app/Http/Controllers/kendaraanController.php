<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kendaraanController extends Controller
{
    //
    public function index()
    {
        $title = 'Rs Apps';
        return view('superadmin.kendaraan', compact('title'));
    }
}
