<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MarginPenjualanController;


Route::get('/', function () {
    $barang = DB::table('v_brg')->get();
    $satuan = DB::table('v_satuan')->get();
    $role = DB::table('v_role')->get();
    $user = DB::table('v_user')->get();
    $vendor = DB::table('v_vendor')->get();
    $margin = DB::table('v_mrg_penjualan')->get();

    return view('dashboard', compact(
        'barang',
        'satuan',
        'role',
        'user',
        'vendor',
        'margin'
    ));
});


Route::resource('barang', BarangController::class);
Route::resource('satuan', SatuanController::class);
Route::resource('role', RoleController::class);
Route::resource('user', UserController::class);
Route::resource('vendor', VendorController::class);
Route::resource('margin_penjualan', MarginPenjualanController::class);
