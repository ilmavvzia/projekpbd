<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BarangController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('satuan', SatuanController::class);
Route::resource('barang', BarangController::class);
