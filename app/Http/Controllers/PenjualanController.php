<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Menampilkan data penjualan.
     */
    public function index()
    {
        $penjualan = DB::select('CALL sp_tampil_penjualan()');

        $detail_penjualan = DB::select(
            'CALL sp_tampil_detail_penjualan()'
        );

        return view('penjualan.index', compact(
            'penjualan',
            'detail_penjualan'
        ));
    }

    
public function create()
{
    $barangs = DB::table('barang')
        ->where('status', 1)
        ->orderBy('nama')
        ->get();

    $users = DB::table('user')
        ->orderBy('username')
        ->get();

    $margins = DB::table('margin_penjualan')
        ->where('status', 1)
        ->orderBy('persen')
        ->get();

    return view('penjualan.create', compact(
        'barangs',
        'users',
        'margins'
    ));
}


public function store(Request $request)
{
    $request->validate([
        'iduser' => 'required|exists:user,iduser',
        'idmargin_penjualan' => 'required|exists:margin_penjualan,idmargin_penjualan',
        'idbarang' => 'required|exists:barang,idbarang',
        'jumlah' => 'required|integer|min:1',
    ]);

    try {
        DB::transaction(function () use ($request) {

            // Mengambil data barang
            $barang = DB::table('barang')
                ->where('idbarang', $request->idbarang)
                ->where('status', 1)
                ->first();

            if (!$barang) {
                throw new \Exception('Barang tidak aktif atau tidak ditemukan.');
            }

            // Mengambil data margin aktif
            $margin = DB::table('margin_penjualan')
                ->where('idmargin_penjualan', $request->idmargin_penjualan)
                ->where('status', 1)
                ->first();

            if (!$margin) {
                throw new \Exception('Margin tidak aktif atau tidak ditemukan.');
            }

            // Menghitung subtotal barang
            $harga = $barang->harga;
            $jumlah = $request->jumlah;
            $subtotal = $harga * $jumlah;

            // Menghitung margin
            $nilai_margin = $subtotal * ($margin->persen / 100);

            // Menghitung subtotal setelah margin
            $subtotal_akhir = $subtotal + $nilai_margin;

            // Menghitung PPN (asumsi 11%)
            $ppn = round($subtotal_akhir * 0.11);

            // Menghitung total akhir
            $total = $subtotal_akhir + $ppn;

            // Menyimpan transaksi utama
            $idpenjualan = DB::table('penjualan')->insertGetId([
                'created_at' => now(),
                'subtotal_nilai' => $subtotal_akhir,
                'ppn' => $ppn,
                'total_nilai' => $total,
                'iduser' => $request->iduser,
                'idmargin_penjualan' => $request->idmargin_penjualan,
            ]);

            // Menyimpan detail transaksi
            DB::table('detail_penjualan')->insert([
                'harga_satuan' => $harga,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
                'idpenjualan' => $idpenjualan,
                'idbarang' => $barang->idbarang,
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi penjualan berhasil disimpan.');

    } catch (\Exception $e) {

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Penjualan gagal: ' . $e->getMessage());
    }
}


    public function show(string $id)
{
    $penjualan = DB::table('penjualan')
        ->leftJoin('user', 'penjualan.iduser', '=', 'user.iduser')
        ->leftJoin(
            'margin_penjualan',
            'penjualan.idmargin_penjualan',
            '=',
            'margin_penjualan.idmargin_penjualan'
        )
        ->where('penjualan.idpenjualan', $id)
        ->select(
            'penjualan.*',
            'user.username',
            'margin_penjualan.persen'
        )
        ->first();

    if (!$penjualan) {
        return redirect()
            ->route('penjualan.index')
            ->with('error', 'Data penjualan tidak ditemukan.');
    }

    $detail_penjualan = DB::table('detail_penjualan')
        ->leftJoin(
            'barang',
            'detail_penjualan.idbarang',
            '=',
            'barang.idbarang'
        )
        ->where('detail_penjualan.idpenjualan', $id)
        ->select(
            'detail_penjualan.*',
            'barang.nama as nama_barang'
        )
        ->get();

    return view('penjualan.show', compact(
        'penjualan',
        'detail_penjualan'
    ));
}

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
