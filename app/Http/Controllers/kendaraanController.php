<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\kendaraan;
use App\Models\mkendaraan;
use App\Models\Pemilik;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class kendaraanController extends Controller
{

    public function index()
    {
        $title = 'Rs Apps';
        // return view('superadmin.kendaraan', compact('title'));

        $kendaraan = kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])->get();

        return view('superadmin.kendaraan', compact('kendaraan', 'title'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'addPemilikKendaraan' => 'required|unique:kendaraan,pemilik_id',
            'addModelKendaraan' => 'required',
            'addTanggalPajak' => 'required|date',
            'addTanggalStnk' => 'required|date',
        ],[
            'addPemilikKendaraan.required' => 'Pemilik Kendaraan tidak boleh kosong',
            'addPemilikKendaraan.unique' => 'Pemilik Kendaraan sudah terdaftar.',
            'addModelKendaraan.required' => 'Model Kendaraan tidak boleh kosong.',
            'addTanggalPajak.required' => 'Tanggal Akhir Pajak tidak boleh kosong.',
            'addTanggalPajak.date' => 'Format Tanggal Akhir Pajak tidak valid.',
            'addTanggalStnk.required' => 'Tanggal Akhir STNK tidak boleh kosong.',
            'addTanggalStnk.date' => 'Format Tanggal Akhir STNK tidak valid.',
        ]);

        $user = Auth::user()->username;

        $tglPajak = Carbon::parse($validatedData['addTanggalPajak']);
        $tglStnk = Carbon::parse($validatedData['addTanggalStnk']);

        $kendaraan = new kendaraan();
        $kendaraan->pemilik_id = $validatedData['addPemilikKendaraan'];
        $kendaraan->merek_kendaraan_id = $validatedData['addModelKendaraan'];
        $kendaraan->tgl_pajak = $tglPajak->format('Y-m-d');
        $kendaraan->tgl_stnk = $tglStnk->format('Y-m-d');;
        $kendaraan->tgl_bayar_pajak = $tglPajak->format('Y-m-d');
        $kendaraan->tgl_bayar_stnk = $tglStnk->format('Y-m-d');
        $kendaraan->status_bayar_pajak = $this->calculateStatus($tglPajak);
        $kendaraan->status_bayar_stnk = $this->calculateStatus($tglStnk );
        $kendaraan->created_by = $user;
        $kendaraan->updated_by = $user;

        $kendaraan->save();

        return response()->json(['message' => 'Data kendaraan berhasil disimpan']);
    }

    public function update(Request $request)
    {
        $id =  $request['editIdKendaraan'];

        $kendaraan = kendaraan::findOrFail($id);

        $validatedData = $request->validate([
            'editPemilikKendaraan' => [
                'required',
                Rule::unique('kendaraan', 'pemilik_id')->ignore($id),
            ],
            'editModelKendaraan' => 'required',
            'editTanggalPajak' => 'required|date',
            'editTanggalStnk' => 'required|date',
        ], [
            'editPemilikKendaraan.required' => 'Pemilik Kendaraan tidak boleh kosong',
            'editPemilikKendaraan.unique' => 'Pemilik Kendaraan sudah terdaftar.',
            'editModelKendaraan.required' => 'Model Kendaraan tidak boleh kosong.',
            'editTanggalPajak.required' => 'Tanggal Akhir Pajak tidak boleh kosong.',
            'editTanggalPajak.date' => 'Format Tanggal Akhir Pajak tidak valid.',
            'editTanggalStnk.required' => 'Tanggal Akhir STNK tidak boleh kosong.',
            'editTanggalStnk.date' => 'Format Tanggal Akhir STNK tidak valid.',
        ]);

        $user = Auth::user()->username;

        $tglPajak = Carbon::parse($validatedData['editTanggalPajak']);
        $tglStnk = Carbon::parse($validatedData['editTanggalStnk']);

        $kendaraan->pemilik_id = $validatedData['editPemilikKendaraan'];
        $kendaraan->merek_kendaraan_id = $validatedData['editModelKendaraan'];
        $kendaraan->tgl_pajak = Carbon::parse($validatedData['editTanggalPajak'])->format('Y-m-d');
        $kendaraan->tgl_stnk = Carbon::parse($validatedData['editTanggalStnk'])->format('Y-m-d');
        $kendaraan->tgl_bayar_pajak = Carbon::parse($validatedData['editTanggalPajak'])->format('Y-m-d');
        $kendaraan->tgl_bayar_stnk = Carbon::parse($validatedData['editTanggalStnk'])->format('Y-m-d');
        $kendaraan->status_bayar_pajak = $this->calculateStatus($tglPajak);
        $kendaraan->status_bayar_stnk = $this->calculateStatus($tglStnk );
        $kendaraan->updated_by = $user;
        $kendaraan->update();

        return response()->json(['message' => 'Data kendaraan berhasil diperbarui']);
    }

    private function calculateStatus($date)
    {
        $daysDifference = Carbon::now()->diffInDays(Carbon::parse($date), false);

        if ($daysDifference > 30) {
            return '1';
        } elseif ($daysDifference <= 30 && $daysDifference >= 0) {
            return '2';
        } elseif ($daysDifference >= -30 && $daysDifference < 0) {
            return '3';
        } else {
            return '4';
        }
    }

    private function calculateStatusSuspend($currentDate,$date)
    {
        $daysDifference = $currentDate->diffInDays(Carbon::parse($date), false);

        if ($daysDifference > 30) {
            return '1';
        } elseif ($daysDifference <= 30 && $daysDifference >= 0) {
            return '2';
        } elseif ($daysDifference >= -30 && $daysDifference < 0) {
            return '3';
        } else {
            return '4';
        }
    }

    public function updatePaidStatus(Request $request)
    {
        $id =  $request['setPaidId'];

        $kendaraan = kendaraan::findOrFail($id);

        $user = Auth::user()->username;

        $tglAkhirPajak = Carbon::parse($request['setPaidTanggalPajak']);
        $tglBayarPajak = Carbon::parse($request['statusTanggalBayar']);

        // Perpanjangan Tanggal Pajak
        $tglPajak = $tglAkhirPajak->copy()->addYear()->format('Y-m-d');
        $tglPajakStnk = $tglAkhirPajak->copy()->addYear(5)->format('Y-m-d');


        if ($request['setPaidJenis'] == 'pajak' && $request['setPaidStatus'] == 'paid') {
            $kendaraan->tgl_pajak = $tglPajak;
            $kendaraan->tgl_bayar_pajak = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->updated_by = $user;
            $kendaraan->update();

            $kendaraan->status_bayar_pajak = $this->calculateStatus($tglPajak);
            $kendaraan->update();
        }

        if ($request['setPaidJenis'] == 'stnk' && $request['setPaidStatus'] == 'paid') {
            $kendaraan->tgl_stnk = $tglPajakStnk;
            $kendaraan->tgl_bayar_stnk = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->updated_by = $user;
            $kendaraan->update();

            $kendaraan->status_bayar_stnk = $this->calculateStatus($tglPajakStnk);
            $kendaraan->update();
        }


        if ($request['setPaidJenis'] == 'pajak' && $request['setPaidStatus'] == 'suspend') {
            $kendaraan->tgl_bayar_pajak = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->updated_by = $user;
            $kendaraan->status_bayar_pajak = $this->calculateStatusSuspend($tglBayarPajak,$tglAkhirPajak);
            $kendaraan->update();

        }

        if ($request['setPaidJenis'] == 'stnk' && $request['setPaidStatus'] == 'suspend') {
            $kendaraan->tgl_bayar_stnk = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->updated_by = $user;
            $kendaraan->status_bayar_stnk = $this->calculateStatusSuspend($tglBayarPajak,$tglAkhirPajak);
            $kendaraan->update();
        }

        return response()->json(['message' => 'Status pajak kendaraan berhasil diperbarui']);
    }


    public function destroy(Request $request)
    {
        $id =  $request['deleteId'];

        kendaraan::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data kendaraan berhasil dihapus.');
    }

    public function downloadPDF($id)
    {
        $kendaraan = Kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])
        ->findOrFail($id);

         // Define the paper size and orientation for mPDF
    $pdfOptions = [
        'format' => 'f4', // You can also use 'letter', 'legal', etc.
        'orientation' => 'P' // 'P' for Portrait and 'L' for Landscape
    ];

        // Pass the options to the loadView method
    $pdf = FacadePdf::loadView('pdf.surat', compact('kendaraan'))
    ->setPaper($pdfOptions['format'], $pdfOptions['orientation']);

    return $pdf->stream('kendaraan-' . $kendaraan->id . '.pdf');
    }

    public function downloadPDFs($id)
    {
        $kendaraan = Kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])
        ->findOrFail($id);

         // Define the paper size and orientation for mPDF
    $pdfOptions = [
        'format' => 'f4', // You can also use 'letter', 'legal', etc.
        'orientation' => 'P' // 'P' for Portrait and 'L' for Landscape
    ];

        // Pass the options to the loadView method
    $pdf = FacadePdf::loadView('pdf.surats', compact('kendaraan'))
    ->setPaper($pdfOptions['format'], $pdfOptions['orientation']);

    return $pdf->stream('kendaraan-' . $kendaraan->id . '.pdf');
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
        $data = kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])->get();
        // $data = kendaraan::all();

        return response()->json(['data' => $data]);
    }

    public function getPemilik()
    {
        $data = Pemilik::all();

        return response()->json(['data' => $data]);
    }

    public function getModel()
    {
        $data = mkendaraan::all();

        return response()->json(['data' => $data]);
    }
}
