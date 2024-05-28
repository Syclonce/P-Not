<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SuperAdminController extends Controller
{
    //
    public function index()
    {
        $title = 'Rs Apps';
        return view('superadmin.index', compact('title'));
    }
}
