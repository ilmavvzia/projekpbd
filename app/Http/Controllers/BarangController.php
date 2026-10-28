<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barang = DB::select('CALL sp_tampil_barang_aktif()');

        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $satuan = Satuan::all();

        return view('barang.create', compact('satuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'nullable|size:1',
            'nama' => 'required|max:45',
            'idsatuan' => 'nullable|exists:satuan,idsatuan',
            'status' => 'required|in:0,1',
            'harga' => 'required|integer|min:0',
        ]);

        Barang::create($request->only([
            'jenis', 'nama', 'idsatuan', 'status', 'harga'
        ]));

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $satuan = Satuan::all();

        return view('barang.edit', compact('barang', 'satuan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis' => 'nullable|size:1',
            'nama' => 'required|max:45',
            'idsatuan' => 'nullable|exists:satuan,idsatuan',
            'status' => 'required|in:0,1',
            'harga' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->update($request->only([
            'jenis', 'nama', 'idsatuan', 'status', 'harga'
        ]));

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')
            ->with('success', 'Data barang berhasil dihapus.');
    }
}
