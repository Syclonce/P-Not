<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PejabatController extends Controller
{
    public function index()
    {
        $title = 'Rs Apps';
        $namapejabat = Pejabat::all();

        return view('superadmin.pejabat', compact('title', 'namapejabat'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $user = Auth::user()->username;


        $pejabat = new Pejabat();
        $pejabat->nama_pejabat = $validatedData['nama'];
        $pejabat->save();

        return response()->json(['message' => 'Data Nama Pejabat berhasil disimpan']);
    }

    public function destroy(Request $request)
    {
        $id = $request['pejabatId'];

        Pejabat::findOrFail($id)->delete();

        return response()->json(['message' => 'Data pemilik berhasil dihapus']);
    }
}
