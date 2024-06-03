<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\kendaraan;
use Illuminate\Support\Facades\Auth;



class PemilikController extends Controller
{
    public function index()
    {
        $title = 'Rs Apps';
        $kendaraan = kendaraan::all(); //Perlu pemisahan view
        $pemilik = Pemilik::with(['provinsiRelation', 'kabupatenRelation', 'kecamatanRelation', 'desaRelation'])->get();

        return view('superadmin.pemilik', compact('pemilik','kendaraan','title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'noPol' => 'required',
            'namaPemilik' => 'required',
            'alamat' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten' => 'required',
            'provinsi' => 'required',
            'kodePos'=> 'required',
        ]);

        $user = Auth::user()->username;


        $pemilik = new Pemilik();
        $pemilik->no_polisi = $validatedData['noPol'];
        $pemilik->nama_pemilik = $validatedData['namaPemilik'];
        $pemilik->alamat = $validatedData['alamat'];
        $pemilik->provinsi = $validatedData['provinsi'];
        $pemilik->kab = $validatedData['kabupaten'];
        $pemilik->kec = $validatedData['kecamatan'];
        $pemilik->kel_des = $validatedData['desa'];
        $pemilik->kode_pos = $validatedData['kodePos'];
        $pemilik->rt = $request['rt'];
        $pemilik->rw = $request['rw'];
        $pemilik->created_by = $user;
        $pemilik->updated_by = $user;
        $pemilik->save();

        return response()->json(['message' => 'Data pemilik berhasil disimpan']);
    }

    public function destroy(Request $request)
    {
        $id =  $request['pemilikId'];

        Pemilik::findOrFail($id)->delete();

        return response()->json(['message' => 'Data pemilik berhasil dihapus']);

    }
}
