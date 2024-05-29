<?php

use App\Http\Controllers\kendaraanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
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
});

// Route::get('admin', function () {
//     Route::get('/', [SuperAdminController::class, 'index'])->name('superadmin');
//     Route::get('/kendaraan', [kendaraanController::class, 'index'])->name('kendaraan');
// })->middleware(['auth', 'verified', 'role:Admin|Super-Admin']);

// Route::get('user', function () {
//     return '<h1> user </h1>';
// })->middleware(['auth', 'verified', 'role:User|Super-Admin']);

require __DIR__ . '/auth.php';
