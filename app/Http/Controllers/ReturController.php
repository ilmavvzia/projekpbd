<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    
public function index()
{
    $retur = DB::select('CALL sp_tampil_retur()');

    $detailRetur = DB::select('CALL sp_tampil_detail_retur()');

    foreach ($retur as $r) {
        $r->details = array_values(array_filter(
            $detailRetur,
            function ($d) use ($r) {
                return $d->idretur == $r->idretur;
            }
        ));
    }

    return view('retur.index', compact('retur'));
}


    
public function create()
{
    $detailPenerimaan = DB::select("
        SELECT
            dp.iddetail_penerimaan,
            dp.idpenerimaan,
            dp.barang_idbarang,
            b.nama AS nama_barang,
            dp.jumlah_terima
        FROM detail_penerimaan dp
        JOIN barang b
            ON dp.barang_idbarang = b.idbarang
        ORDER BY dp.idpenerimaan DESC
    ");

    $users = DB::select("
        SELECT iduser, username
        FROM user
    ");

    return view('retur.create', compact(
        'detailPenerimaan',
        'users'
    ));
}


    
public function store(Request $request)
{
    $request->validate([
        'iduser' => 'required|exists:user,iduser',
        'iddetail_penerimaan' => 'required|exists:detail_penerimaan,iddetail_penerimaan',
        'jumlah' => 'required|integer|min:1',
        'alasan' => 'required|string|max:200',
    ]);

    try {
        DB::transaction(function () use ($request) {

            // Ambil data detail penerimaan
            $detail = DB::table('detail_penerimaan')
                ->where('iddetail_penerimaan', $request->iddetail_penerimaan)
                ->lockForUpdate()
                ->first();

            if (!$detail) {
                throw new \Exception('Data penerimaan tidak ditemukan.');
            }

            // Hitung jumlah yang sudah pernah diretur
            $sudahDiretur = DB::table('detail_retur')
                ->where('iddetail_penerimaan', $request->iddetail_penerimaan)
                ->sum('jumlah');

            $sisa = $detail->jumlah_terima - $sudahDiretur;

            if ($request->jumlah > $sisa) {
                throw new \Exception(
                    "Jumlah retur melebihi sisa barang. Sisa barang: $sisa"
                );
            }

            // Simpan transaksi utama retur
            $idretur = DB::table('retur')->insertGetId([
                'created_at' => now(),
                'idpenerimaan' => $detail->idpenerimaan,
                'iduser' => $request->iduser,
            ]);

            // Simpan detail retur
            DB::table('detail_retur')->insert([
                'jumlah' => $request->jumlah,
                'alasan' => $request->alasan,
                'idretur' => $idretur,
                'iddetail_penerimaan' => $request->iddetail_penerimaan,
            ]);
        });

        return redirect()
            ->route('retur.index')
            ->with('success', 'Data retur berhasil disimpan!');

    } catch (\Exception $e) {

        return back()
            ->withInput()
            ->withErrors(['error' => $e->getMessage()]);
    }
}


    public function show(string $id)
    {
        //
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
