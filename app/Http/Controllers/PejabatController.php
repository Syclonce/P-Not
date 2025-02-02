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
            'nip' => 'required',
        ]);

        $user = Auth::user()->username;


        $pejabat = new Pejabat();
        $pejabat->nama_pejabat = $validatedData['nama'];
        $pejabat->nip_pejabat = $validatedData['nip'];
        $pejabat->save();

        return response()->json(['message' => 'Data Nama Pejabat berhasil disimpan']);
    }

    public function update(Request $request)
    {
        $id =  $request['meditpejabaId'];
        $user = Auth::user()->username;

        $validatedData = $request->validate([
            'meditpModel' => 'required',
            'meditnModel' => 'required',
        ]);


        $pemilik = Pejabat::findOrFail($id);
        $pemilik->nama_pejabat = $validatedData['meditpModel'];
        $pemilik->nip_pejabat = $validatedData['medinpModel'];
        $pemilik->update();

        return response()->json(['message' => 'Data pemilik berhasil diperbarui']);
    }

    public function destroy(Request $request)
    {
        $id = $request['pejabatId'];

        Pejabat::findOrFail($id)->delete();

        return response()->json(['message' => 'Data pemilik berhasil dihapus']);
    }
}
