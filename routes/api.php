<?php

use App\Http\Controllers\kendaraanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('fetch-data', [kendaraanController::class, 'apidata'])->name('fetch.data');
