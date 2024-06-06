<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\kendaraan;
use App\Models\mkendaraan;
use App\Models\Pemilik;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Auth;

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
            'addPemilikKendaraan' => 'required',
            'addModelKendaraan' => 'required',
            'addTanggalPajak' => 'required',
            'addTanggalStnk' => 'required',
        ]);

        $user = Auth::user()->username;

        $tglPajak = Carbon::parse($validatedData['addTanggalPajak']);
        $tglStnk = Carbon::parse($validatedData['addTanggalStnk']);

        $currentDate = Carbon::now();
        $thirtyDaysBefore = $currentDate->copy()->subDays(30);

        if ($tglPajak->greaterThan($currentDate)) {
            $statusPajak = '1';
        } elseif ($tglPajak->between($thirtyDaysBefore, $currentDate)) {
            $statusPajak = '2';
        } else {
            $statusPajak = '3';
        }

        if ($tglStnk->greaterThan($currentDate)) {
            $statusStnk = '1';
        } elseif ($tglStnk->between($thirtyDaysBefore, $currentDate)) {
            $statusStnk = '2';
        } else {
            $statusStnk = '3';
        }

        $kendaraan = new kendaraan();
        $kendaraan->pemilik_id = $validatedData['addPemilikKendaraan'];
        $kendaraan->merek_kendaraan_id = $validatedData['addModelKendaraan'];
        $kendaraan->tgl_pajak = Carbon::parse($validatedData['addTanggalPajak'])->format('Y-m-d');
        $kendaraan->tgl_stnk = Carbon::parse($validatedData['addTanggalStnk'])->format('Y-m-d');
        $kendaraan->tgl_bayar_pajak = Carbon::parse($validatedData['addTanggalPajak'])->format('Y-m-d');
        $kendaraan->tgl_bayar_stnk = Carbon::parse($validatedData['addTanggalStnk'])->format('Y-m-d');
        $kendaraan->status_bayar_pajak = $statusPajak;
        $kendaraan->status_bayar_stnk = $statusStnk;
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
            'editPemilikKendaraan' => 'required',
            'editModelKendaraan' => 'required',
            'editTanggalPajak' => 'required',
            'editTanggalStnk' => 'required',
        ]);

        $user = Auth::user()->username;

        $tglPajak = Carbon::parse($validatedData['editTanggalPajak']);
        $tglStnk = Carbon::parse($validatedData['editTanggalStnk']);

        $currentDate = Carbon::now();
        $thirtyDaysBefore = $currentDate->copy()->subDays(30);

        if ($tglPajak->greaterThan($currentDate)) {
            $statusPajak = '1';
        } elseif ($tglPajak->between($thirtyDaysBefore, $currentDate)) {
            $statusPajak = '2';
        } else {
            $statusPajak = '3';
        }

        if ($tglStnk->greaterThan($currentDate)) {
            $statusStnk = '1';
        } elseif ($tglStnk->between($thirtyDaysBefore, $currentDate)) {
            $statusStnk = '2';
        } else {
            $statusStnk = '3';
        }

        $kendaraan->pemilik_id = $validatedData['editPemilikKendaraan'];
        $kendaraan->merek_kendaraan_id = $validatedData['editModelKendaraan'];
        $kendaraan->tgl_pajak = Carbon::parse($validatedData['editTanggalPajak'])->format('Y-m-d');
        $kendaraan->tgl_stnk = Carbon::parse($validatedData['editTanggalStnk'])->format('Y-m-d');
        $kendaraan->tgl_bayar_pajak = Carbon::parse($validatedData['editTanggalPajak'])->format('Y-m-d');
        $kendaraan->tgl_bayar_stnk = Carbon::parse($validatedData['editTanggalStnk'])->format('Y-m-d');
        $kendaraan->status_bayar_pajak = $statusPajak;
        $kendaraan->status_bayar_stnk = $statusStnk;
        $kendaraan->updated_by = $user;
        $kendaraan->update();

        return response()->json(['message' => 'Data kendaraan berhasil diperbarui']);
    }

    public function updatePaidStatus(Request $request)
    {
        $id =  $request['setPaidId'];

        $kendaraan = kendaraan::findOrFail($id);

        $user = Auth::user()->username;

        $tglAkhirPajak = Carbon::parse($request['setPaidTanggalPajak']);
        $tglBayarPajak = Carbon::parse($request['statusTanggalBayar']);

        $tglPajak = $tglAkhirPajak->copy()->addYear()->format('Y-m-d');
        $tglPajakStnk = $tglAkhirPajak->copy()->addYear(5)->format('Y-m-d');

        $thirtyDaysLater = $tglAkhirPajak->copy()->addDays(30);



        if ($request['setPaidJenis'] == 'pajak' && $request['setPaidStatus'] == 'paid') {
            $kendaraan->tgl_pajak = $tglPajak;
            $kendaraan->tgl_bayar_pajak = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->status_bayar_pajak = '1';
            $kendaraan->updated_by = $user;
            $kendaraan->update();
        }

        if ($request['setPaidJenis'] == 'stnk' && $request['setPaidStatus'] == 'paid') {
            $kendaraan->tgl_stnk = $tglPajakStnk;
            $kendaraan->tgl_bayar_stnk = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->status_bayar_stnk = '1';
            $kendaraan->updated_by = $user;
            $kendaraan->update();
        }

        if ($request['setPaidJenis'] == 'pajak' && $request['setPaidStatus'] == 'wait') {
            if ($tglBayarPajak->greaterThanOrEqualTo($thirtyDaysLater)) {
                $statusPajak = '3';
            } else {
                $statusPajak = '2';
            }
            $kendaraan->tgl_bayar_pajak = $tglBayarPajak;
            $kendaraan->status_bayar_pajak = $statusPajak;
            $kendaraan->updated_by = $user;
            $kendaraan->update();
        }

        if ($request['setPaidJenis'] == 'stnk' && $request['setPaidStatus'] == 'wait') {
            if ($tglBayarPajak->greaterThanOrEqualTo($thirtyDaysLater)) {
                $statusPajak = '3';
            } else {
                $statusPajak = '2';
            }
            $kendaraan->tgl_bayar_stnk = $tglBayarPajak;
            $kendaraan->status_bayar_stnk = $statusPajak;
            $kendaraan->updated_by = $user;
            $kendaraan->update();
        }

        if ($request['setPaidJenis'] == 'pajak' && $request['setPaidStatus'] == 'suspend') {
            $kendaraan->tgl_bayar_pajak = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->status_bayar_pajak = '3';
            $kendaraan->updated_by = $user;
            $kendaraan->update();
        }

        if ($request['setPaidJenis'] == 'stnk' && $request['setPaidStatus'] == 'suspend') {
            $kendaraan->tgl_bayar_stnk = Carbon::parse($request['statusTanggalBayar'])->format('Y-m-d');
            $kendaraan->status_bayar_stnk = '3';
            $kendaraan->updated_by = $user;
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
