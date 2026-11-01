<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penerimaan;
use App\Models\DetailPenerimaan;
use App\Models\Barang;
use App\Models\User;

class PenerimaanController extends Controller
{
    public function index()
    {
        $penerimaan = Penerimaan::with('details')->get();

        return view('penerimaan.index', compact('penerimaan'));
    }

    public function create()
    {
        $barang = Barang::where('status', 1)->get();
        $user = User::all();

        return view('penerimaan.create', compact('barang', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'barang_idbarang' => 'required|exists:barang,idbarang',
            'jumlah_terima' => 'required|integer|min:1',
            'harga_satuan_terima' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {

            $penerimaan = Penerimaan::create([
                'created_at' => now(),
                'status' => 'A',
                'idpengadaan' => null,
                'iduser' => $request->iduser,
            ]);

            DetailPenerimaan::create([
                'idpenerimaan' => $penerimaan->idpenerimaan,
                'barang_idbarang' => $request->barang_idbarang,
                'jumlah_terima' => $request->jumlah_terima,
                'harga_satuan_terima' => $request->harga_satuan_terima,
                'sub_total_terima' => $request->jumlah_terima * $request->harga_satuan_terima,
            ]);
            // Memperbarui harga barang berdasarkan harga penerimaan
Barang::where('idbarang', $request->barang_idbarang)
    ->update([
        'harga' => $request->harga_satuan_terima
    ]);
        });

        return redirect()->route('penerimaan.index')
            ->with('success', 'Penerimaan barang berhasil disimpan.');
    }
}