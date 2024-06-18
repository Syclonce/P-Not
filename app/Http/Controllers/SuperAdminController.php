<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Pemilik;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    //
    public function index()
    {
        $title = 'Rs Apps';
        $kendaraan = Kendaraan::all();
        $countKadaluarsa = DB::table('kendaraan')
            ->where('tgl_stnk', '<=', DB::raw('CURDATE()'))
            ->count();
        $countKadaluarsap = Kendaraan::where('tgl_pajak', '<=', today())->count();
        $totalKendaraan = Kendaraan::count();
        $totalUsers = Pemilik::count();

        // Mendapatkan tanggal sekarang
        $today = Carbon::today()->toDateString();

        // Mendapatkan tanggal 30 hari dari sekarang
        $date30DaysLater = Carbon::today()->addDays(30)->toDateString();

        $relasikendaraan = kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])->get()->toArray();

        $tglstnkdash = kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])->where('status_bayar_stnk', '=', 4)->where('tgl_stnk', '=', $today)->get();
        $tglpajakkdash = kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])->where('status_bayar_pajak', '=', 4)->where('tgl_pajak', '=', $today)->get();

        $tglstnkdasht = kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])->where('status_bayar_stnk', '=', 2)->where('tgl_stnk', '=', $today)->get();
        $tglpajakkdasht = kendaraan::with(['pemilikRelation', 'merekKendaraanRelation'])->where('status_bayar_pajak', '=', 2)->where('tgl_pajak', '=', $today)->get();



        return view('superadmin.index', compact('title', 'countKadaluarsa', 'kendaraan', 'countKadaluarsap', 'totalKendaraan', 'totalUsers', 'tglpajakkdasht', 'tglstnkdasht', 'relasikendaraan', 'tglstnkdash', 'tglpajakkdash'));
    }

    public function roles()
    {
        $title = 'Rs Apps';

        $roles = Role::all();
        return view('superadmin.roles', compact('title','roles'));
    }

    public function rolesadd(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'guard' => 'required',
        ]);

        $roles = new Role();
        $roles->name = $validatedData['nama'];
        $roles->guard_name = $validatedData['guard'];
        $roles->save();

        return redirect()->back()->with('success', 'Data kendaraan berhasil disimpan.');
    }

    public function roleupdate(Request $request)
    {
        $id =  $request['meditroleId'];

        $roles = Role::findOrFail($id);
        $roles->name = $request['meditroleModel'];
        $roles->guard_name = $request['meditguardModel'];
        $roles->update();

        return redirect()->back()->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function rolesdelet(Request $request)
    {
        $id =  $request['roleid'];

        Role::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
