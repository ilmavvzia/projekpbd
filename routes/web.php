<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MarginPenjualanController;
use App\Http\Controllers\PengadaanController;


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
Route::get('/tes-function', function () {
    $subtotal = DB::select(
        'SELECT fn_hitung_subtotal(?, ?) AS hasil',
        [10000, 5]
    );

    $total = DB::select(
        'SELECT fn_hitung_total_final(?, ?) AS hasil',
        [100000, 11000]
    );

    $pengadaan = DB::select(
        'SELECT fn_total_final_pengadaan(?, ?) AS hasil',
        [100000, 11000]
    );

    return response()->json([
        'subtotal' => $subtotal[0]->hasil,
        'total_final' => $total[0]->hasil,
        'total_final_pengadaan' => $pengadaan[0]->hasil,
    ]);
});

Route::get('/pengadaan', [PengadaanController::class, 'index'])
    ->name('pengadaan.index');

Route::post('/pengadaan/hitung', [PengadaanController::class, 'hitung'])
    ->name('pengadaan.hitung');
