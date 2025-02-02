<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\kendaraanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\websetController;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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




Route::middleware(['auth', 'verified', 'role:PKB'])->group(function () {
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


    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::post('permissions/store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::post('permissions/update', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/destroy', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::get('role', [RoleController::class, 'index'])->name('role');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::post('role/update', [RoleController::class, 'update'])->name('role.update');
    Route::post('role/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('role/{roleId}/give', [RoleController::class, 'addPermissionToRole'])->name('role.give');
    Route::put('role/{roleId}/give', [RoleController::class, 'givePermissionToRole'])->name('role.give.put');




    Route::get('user/role-premesion', [SuperAdminController::class, 'userrolepremesion'])->name('user.role-premesion');
    Route::get('user/role-premesion/{user}/edit', [SuperAdminController::class, 'edit'])->name('user.role-premesions');
    Route::put('user/role-premesion/{user}/edit', [SuperAdminController::class, 'update'])->name('user.role-premesion.edit');
    Route::get('user/role-premesion/{user}', [SuperAdminController::class, 'destroy'])->name('user.role-premesion.del');

});



Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

// Route::get('user', function () {
//     return '<h1> user </h1>';
// })->middleware(['auth', 'verified', 'role:User|Super-Admin']);

require __DIR__ . '/auth.php';
