<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengadaanController extends Controller
{
    public function index()
    {
        return view('pengadaan.index');
    }

    public function hitung(Request $request)
    {
        $request->validate([
            'harga' => 'required|integer|min:0',
            'jumlah' => 'required|integer|min:1',
            'ppn' => 'required|integer|min:0',
        ]);

        // Memanggil function MySQL untuk menghitung subtotal
        $hasilSubtotal = DB::select(
            'SELECT fn_hitung_subtotal(?, ?) AS hasil',
            [
                $request->harga,
                $request->jumlah
            ]
        );

        $subtotal = $hasilSubtotal[0]->hasil;

        // Memanggil function MySQL untuk menghitung total akhir
        $hasilTotal = DB::select(
            'SELECT fn_total_final_pengadaan(?, ?) AS hasil',
            [
                $subtotal,
                $request->ppn
            ]
        );

        $total = $hasilTotal[0]->hasil;

        return view('pengadaan.index', [
            'subtotal' => $subtotal,
            'total' => $total,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'ppn' => $request->ppn,
        ]);
    }
}
