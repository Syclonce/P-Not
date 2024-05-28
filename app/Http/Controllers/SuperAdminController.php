<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    //
    public function index()
    {
        $title = 'Rs Apps';
        $kendaraan = Kendaraan::all();
        $countKadaluarsa = DB::table('kendaraan')
            ->where('tgl_stnk', '<', DB::raw('CURDATE()'))
            ->count();
        $countKadaluarsap = Kendaraan::where('tgl_pajak', '<', today())->count();
        $totalKendaraan = Kendaraan::count();
        $totalUsers = User::count();


        // Mendapatkan tanggal sekarang
        $today = Carbon::today()->toDateString();

        // Mendapatkan tanggal 30 hari dari sekarang
        $date30DaysLater = Carbon::today()->addDays(30)->toDateString();

        // Mengambil data kendaraan di mana tanggal pajak atau tanggal STNK akan jatuh tempo dalam 30 hari dari tanggal saat ini
        $kendaraans = Kendaraan::where(function ($query) use ($today, $date30DaysLater) {
            $query->where('tgl_pajak', '>=', $today)
                ->where('tgl_pajak', '<=', $date30DaysLater);
        })
            ->orWhere(function ($query) use ($today, $date30DaysLater) {
                $query->where('tgl_stnk', '>=', $today)
                    ->where('tgl_stnk', '<=', $date30DaysLater);
            })
            ->get();
        $kendaraanss = Kendaraan::whereDate('tgl_pajak', '<', today())
            ->orWhere('tgl_stnk', '<', today())
            ->get();

        return view('superadmin.index', compact('title', 'countKadaluarsa', 'kendaraan', 'countKadaluarsap', 'totalKendaraan', 'totalUsers', 'kendaraans', 'kendaraanss'));
    }
}
