<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\kendaraan;


class kendaraanController extends Controller
{

    public function index()
    {
        $title = 'Rs Apps';
        // return view('superadmin.kendaraan', compact('title'));

        $kendaraan = kendaraan::all();
        return view('superadmin.kendaraan', compact('kendaraan', 'title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'noPolisi' => 'required|unique:kendaraan,no_pol',
            'namaPemilik' => 'required',
            'namaMerk' => 'required',
            'namaModel' => 'required',
            'kodeMerk' => 'required',
            'tahunBuat' => 'required',
            'tanggalPajak' => 'required',
            'tanggalStnk' => 'required',
        ]);

        $kendaraan = new kendaraan();
        $kendaraan->no_pol = $validatedData['noPolisi'];
        $kendaraan->nama_pem = $validatedData['namaPemilik'];
        $kendaraan->merek = $validatedData['namaMerk'];
        $kendaraan->model = $validatedData['namaModel'];
        $kendaraan->kode_merek = $validatedData['kodeMerk'];
        $kendaraan->tgl_buat = Carbon::parse($validatedData['tahunBuat'])->format('Y-m-d');
        $kendaraan->tgl_pajak = Carbon::parse($validatedData['tanggalPajak'])->format('Y-m-d');
        $kendaraan->tgl_stnk = Carbon::parse($validatedData['tanggalStnk'])->format('Y-m-d');
        $kendaraan->save();

        return redirect()->back()->with('success', 'Data kendaraan berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());
        return redirect()->back()->with('success', 'Data kendaraan berhasil diperbarui.');
    }
}
