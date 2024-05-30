<?php

use App\Http\Controllers\kendaraanController;
use App\Http\Controllers\WilayahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('fetch-data', [kendaraanController::class, 'apidata'])->name('fetch.data');
Route::get('provinsi', [WilayahController::class, 'getProvinsi']);
Route::get('kabupaten/{kode_provinsi?}', [WilayahController::class, 'getKabupaten']);
Route::get('kecamatan/{kode_kabupaten?}', [WilayahController::class, 'getKecamatan']);
Route::get('desa/{kode_kecamatan?}', [WilayahController::class, 'getDesa']);
