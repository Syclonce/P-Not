<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\kendaraan;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;



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

        // Perlu Improve detail Alamat
        $address = $validatedData['alamat'] . ', ' .
                   $validatedData['desa'] . ', ' .
                   $validatedData['kecamatan'] . ', ' .
                   $validatedData['kodePos'];
        

        $client = new Client();
        $apiKey = 'AhQXcTxku41cvwtxg1VIrHx3YcM_hi_7r7peMHPYQht_1tf98FMY-WHW-q6FogCr';
        $response = $client->get('http://dev.virtualearth.net/REST/v1/Locations', [
            'query' => [
                'query' => $address,
                'key' => $apiKey
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (!empty($data['resourceSets'][0]['resources'])) {
            $location = $data['resourceSets'][0]['resources'][0]['point']['coordinates'];
            $longitude = $location[1];
            $latitude = $location[0];

            $pemilik->longitude = $longitude;
            $pemilik->latitude = $latitude;
            $pemilik->save();
        }

        return response()->json(['message' => 'Data pemilik berhasil disimpan', 'address' => $address]);
    }

    public function update(Request $request)
    {
        $id =  $request['editIdPemilik'];
        $user = Auth::user()->username;

        $validatedData = $request->validate([
            'editNoPol' => 'required',
            'editnamaPemilik' => 'required',
            'editAlamat' => 'required',
            'editDesa' => 'required',
            'editKecamatan' => 'required',
            'editKabupaten' => 'required',
            'editProvinsi' => 'required',
            'editKodePos'=> 'required',
        ]);


        $pemilik = Pemilik::findOrFail($id);
        $pemilik->no_polisi = $validatedData['editNoPol'];
        $pemilik->nama_pemilik = $validatedData['editnamaPemilik'];
        $pemilik->alamat = $validatedData['editAlamat'];
        $pemilik->provinsi = $validatedData['editProvinsi'];
        $pemilik->kab = $validatedData['editKabupaten'];
        $pemilik->kec = $validatedData['editKecamatan'];
        $pemilik->kel_des = $validatedData['editDesa'];
        $pemilik->kode_pos = $validatedData['editKodePos'];
        $pemilik->rt = $request['editRt'];
        $pemilik->rw = $request['editRw'];
        $pemilik->updated_by = $user;
        $pemilik->update();

        return response()->json(['message' => 'Data pemilik berhasil diperbarui']);

    }

    public function destroy(Request $request)
    {
        $id =  $request['pemilikId'];

        Pemilik::findOrFail($id)->delete();

        return response()->json(['message' => 'Data pemilik berhasil dihapus']);

    }
}
