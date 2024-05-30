<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\kendaraan;
use App\Models\mkendaraan;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


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

    public function update(Request $request)
    {
        $id =  $request['editId'];

        $kendaraan = kendaraan::findOrFail($id);

        $kendaraan->no_pol = $request['no_pol'];
        $kendaraan->nama_pem = $request['nama_pem'];
        $kendaraan->merek = $request['merek'];
        $kendaraan->model = $request['model'];
        $kendaraan->kode_merek = $request['kode_merek'];
        $kendaraan->tgl_buat = Carbon::parse($request['tgl_buat'])->format('Y-m-d');
        $kendaraan->tgl_pajak = Carbon::parse($request['tgl_pajak'])->format('Y-m-d');
        $kendaraan->tgl_stnk = Carbon::parse($request['tgl_stnk'])->format('Y-m-d');
        $kendaraan->update();

        return redirect()->back()->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $id =  $request['deleteId'];

        kendaraan::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data kendaraan berhasil dihapus.');
    }

    public function downloadPDF($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $pdf = FacadePdf::loadView('pdf.kendaraan', compact('kendaraan'));
        return $pdf->download('kendaraan-' . $kendaraan->id . '.pdf');
    }


    public function mekendaran()
    {
        $title = 'Rs Apps';
        // return view('superadmin.kendaraan', compact('title'));

        $kendaraan = mkendaraan::all();
        return view('superadmin.merekkendaraan', compact('kendaraan', 'title'));
    }


    public function mstore(Request $request)
    {
        $validatedData = $request->validate([
            'namaMerk' => 'required',
            'namaModel' => 'required',
            'kodeMerk' => 'required|unique:merek_kendaraan,kode_merek',
            'tahunBuat' => 'required',
        ]);

        $mkendaraan = new mkendaraan();
        $mkendaraan->merek = $validatedData['namaMerk'];
        $mkendaraan->model = $validatedData['namaModel'];
        $mkendaraan->kode_merek = $validatedData['kodeMerk'];
        $mkendaraan->tgl_buat = Carbon::parse($validatedData['tahunBuat'])->format('Y-m-d');
        $mkendaraan->save();

        return redirect()->back()->with('success', 'Data kendaraan berhasil disimpan.');
    }

    public function mupdate(Request $request)
    {
        $id =  $request['editId'];

        $kendaraan = mkendaraan::findOrFail($id);
        $kendaraan->merek = $request['merek'];
        $kendaraan->model = $request['model'];
        $kendaraan->kode_merek = $request['kode_merek'];
        $kendaraan->tgl_buat = Carbon::parse($request['tgl_buat'])->format('Y-m-d');
        $kendaraan->update();

        return redirect()->back()->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function mdestroy(Request $request)
    {
        $id =  $request['deleteId'];

        mkendaraan::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data kendaraan berhasil dihapus.');
    }
    public function apidata()
    {
        $data = kendaraan::all();

        return response()->json(['data' => $data]);
    }
}
