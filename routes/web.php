<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\kendaraanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\websetController;
use App\Http\Controllers\PemilikController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::middleware(['auth', 'verified', 'role:Super-Admin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin');
    Route::get('kendaraan', [kendaraanController::class, 'index'])->name('kendaraan');
    Route::post('kendaraan/store', [KendaraanController::class, 'store'])->name('kendaraan.store');
    Route::post('kendaraan/update', [KendaraanController::class, 'update'])->name('kendaraan.update');
    Route::post('kendaraan/destroy', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');
    Route::get('kendaraan/download-pdf/{id}', [KendaraanController::class, 'downloadPDF'])->name('download-pdf');
    Route::get('kendaraan/download-pdfs/{id}', [KendaraanController::class, 'downloadPDFs'])->name('download-pdfs');
    Route::get('kendaraan/get-pemilik', [KendaraanController::class, 'getPemilik'])->name('get-pemilik');
    Route::get('kendaraan/get-model', [KendaraanController::class, 'getModel'])->name('get-model');
    Route::post('kendaraan/update-paid-status', [KendaraanController::class, 'updatePaidStatus'])->name('update-paid-status');


    Route::get('mkendaraan', [kendaraanController::class, 'mekendaran'])->name('mkendaraan');
    Route::post('mkendaraan/store', [KendaraanController::class, 'mstore'])->name('mkendaraan.store');
    Route::post('mkendaraan/update', [KendaraanController::class, 'mupdate'])->name('mkendaraan.update');
    Route::post('mkendaraan/destroy', [KendaraanController::class, 'mdestroy'])->name('mkendaraan.destroy');

    Route::get('pemilik', [PemilikController::class, 'index'])->name('pemilik');
    Route::post('pemilik/store', [PemilikController::class, 'store'])->name('pemilik.store');
    Route::post('pemilik/update', [PemilikController::class, 'update'])->name('pemilik.update');
    Route::post('pemilik/destroy', [PemilikController::class, 'destroy'])->name('pemilik.destroy');


    Route::get('pejabat', [PejabatController::class, 'index'])->name('pejabat');
    Route::post('pejabat/store', [PejabatController::class, 'store'])->name('pejabat.store');
    Route::post('pejabat/update', [PejabatController::class, 'update'])->name('pejabat.update');
    Route::post('pejabat/destroy', [PejabatController::class, 'destroy'])->name('pejabat.destroy');


    Route::get('setweb', [websetController::class, 'index'])->name('setweb');
    Route::post('setweb/update', [websetController::class, 'updates'])->name('setweb.update');
});
Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

// Route::get('user', function () {
//     return '<h1> user </h1>';
// })->middleware(['auth', 'verified', 'role:User|Super-Admin']);

require __DIR__ . '/auth.php';
