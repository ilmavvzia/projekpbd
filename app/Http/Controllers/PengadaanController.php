<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengadaan;
use App\Models\DetailPengadaan;
use App\Models\Vendor;
use App\Models\Barang;

class PengadaanController extends Controller
{
    /**
     * Menampilkan daftar transaksi pengadaan
     */
    public function index()
    {
        $pengadaans = Pengadaan::with(['vendor', 'user'])
            ->orderBy('timestamp', 'desc')
            ->paginate(10);

        return view('pengadaan.index', compact('pengadaans'));
    }

    /**
     * Menampilkan form pembuatan pengadaan baru
     */
    public function create()
    {
        // Mengambil vendor yang aktif (status = '1' atau 'A')
        $vendors = Vendor::where('status', '1')->orWhere('status', 'A')->get();
        
        // Mengambil barang yang aktif
        $barangs = Barang::where('status', 1)->get();

        return view('pengadaan.create', compact('vendors', 'barangs'));
    }

    /**
     * Menyimpan data pengadaan beserta detailnya ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_idvendor' => 'required|exists:vendor,idvendor',
            'items'           => 'required|array|min:1',
            'items.*.idbarang' => 'required|exists:barang,idbarang',
            'items.*.harga_satuan' => 'required|numeric|min:0',
            'items.*.jumlah'       => 'required|numeric|min:1',
        ], [
            'vendor_idvendor.required' => 'Pilih vendor terlebih dahulu.',
            'items.required'           => 'Minimal satu barang harus ditambahkan.',
            'items.*.idbarang.required' => 'Barang harus dipilih.',
            'items.*.harga_satuan.min' => 'Harga satuan tidak boleh negatif.',
            'items.*.jumlah.min'       => 'Jumlah barang minimal 1.',
        ]);

        try {
            DB::beginTransaction();

            // 1. Hitung subtotal akumulasi dari seluruh item
            $subtotalNilai = 0;
            foreach ($request->items as $item) {
                $subtotalNilai += ($item['harga_satuan'] * $item['jumlah']);
            }

            // PPN 11% (sesuaikan jika ada ketentuan persentase lain)
            $ppn = (int) round($subtotalNilai * 0.11);
            $totalNilai = $subtotalNilai + $ppn;

            // 2. Simpan Header Pengadaan
            $pengadaan = Pengadaan::create([
    'timestamp'       => now(),
    'iduser'          => Auth::id() ?? 1,
    'status'          => 'A',
    'vendor_idvendor' => $request->vendor_idvendor,
    'subtotal_nilai'  => $subtotalNilai,
    'ppn'             => $ppn,
    'total_nilai'     => $totalNilai,
]);

            // 3. Simpan Detail Pengadaan per item
            foreach ($request->items as $item) {
                $subTotalItem = $item['harga_satuan'] * $item['jumlah'];

                DetailPengadaan::create([
                    'harga_satuan' => $item['harga_satuan'],
                    'jumlah'       => $item['jumlah'],
                    'sub_total'    => $subTotalItem,
                    'idbarang'     => $item['idbarang'],
                    'idpengadaan'  => $pengadaan->idpengadaan,
                ]);
            }

            DB::commit();

            return redirect()->route('pengadaan.show', $pengadaan->idpengadaan)
                ->with('success', 'Transaksi pengadaan berhasil disimpan.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan pengadaan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan rincian detail satu transaksi pengadaan
     */
    public function show($id)
    {
        $pengadaan = Pengadaan::with([
            'vendor',
            'user',
            'detailPengadaan.barang.satuan'
        ])->findOrFail($id);

        return view('pengadaan.show', compact('pengadaan'));
    }
    
    /**
     * Menghitung subtotal dan total pengadaan menggunakan MySQL Function
     */
    public function hitung(Request $request)
    {
        $request->validate([
            'harga'  => 'required|numeric|min:0',
            'jumlah' => 'required|numeric|min:1',
            'ppn'    => 'required|numeric|min:0',
        ]);

        // Menghitung subtotal menggunakan function MySQL
        $hasilSubtotal = DB::select(
            'SELECT fn_hitung_subtotal(?, ?) AS subtotal',
            [$request->harga, $request->jumlah]
        );

        $subtotal = $hasilSubtotal[0]->subtotal;

        // Menghitung total akhir menggunakan function MySQL
        $hasilTotal = DB::select(
            'SELECT fn_total_final_pengadaan(?, ?) AS total',
            [$subtotal, $request->ppn]
        );

        $total = $hasilTotal[0]->total;

        $harga = $request->harga;
        $jumlah = $request->jumlah;
        $ppn = $request->ppn;

        return view('pengadaan.index', compact(
            'harga',
            'jumlah',
            'ppn',
            'subtotal',
            'total'
        ));
    }

}