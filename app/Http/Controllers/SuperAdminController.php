<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Pemilik;
use Illuminate\Support\Facades\DB;
use  Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

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



    public function userrolepremesion()
    {
        $users = User::get();
        return view('superadmin.users', ['users' => $users]);

    }
    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('superadmin.useredit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required'
        ]);
        $user->syncRoles($request->roles);

        // var_dump($request);
        return redirect()->route('user.role-premesion')->with('status', 'Permissions added to role');

    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('user.role-premesion')->with('status', 'Permissions added to role');
    }
}
