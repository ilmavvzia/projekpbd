<?php

namespace App\Http\Controllers;

use App\Models\MarginPenjualan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarginPenjualanController extends Controller
{
    // Menampilkan data margin penjualan menggunakan SP
    public function index()
    { //Menampilkan persentase margin, status, username, serta informasi waktu pembuatan dan perubahan.
        $margins = DB::select('CALL sp_tampil_margin_penjualan()'); //gabungkan tabel margin dan user

        return view('margin_penjualan.index', compact('margins'));
    }

    // Menampilkan form tambah margin penjualan
    public function create()
    {
        $users = User::all();

        return view('margin_penjualan.create', compact('users'));
    }

    // Menyimpan data margin penjualan baru
    public function store(Request $request)
    {
        $request->validate([
            'persen' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:0,1',
            'iduser' => 'required|exists:user,iduser',
        ]);

        MarginPenjualan::create([
            'persen' => $request->persen,
            'status' => $request->status,
            'iduser' => $request->iduser,
        ]);

        return redirect()
            ->route('margin_penjualan.index')
            ->with('success', 'Margin penjualan berhasil ditambahkan.');
    }

    // Menampilkan form edit margin penjualan
    public function edit(string $id)
    {
        $margin = MarginPenjualan::findOrFail($id);
        $users = User::all();

        return view(
            'margin_penjualan.edit',
            compact('margin', 'users')
        );
    }

    // Memperbarui data margin penjualan
    public function update(Request $request, string $id)
    {
        $request->validate([
            'persen' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:0,1',
            'iduser' => 'required|exists:user,iduser',
        ]);

        $margin = MarginPenjualan::findOrFail($id);

        $margin->update([
            'persen' => $request->persen,
            'status' => $request->status,
            'iduser' => $request->iduser,
        ]);

        return redirect()
            ->route('margin_penjualan.index')
            ->with('success', 'Margin penjualan berhasil diperbarui.');
    }

    // Menghapus data margin penjualan
    public function destroy(string $id)
    {
        $margin = MarginPenjualan::findOrFail($id);
        $margin->delete();

        return redirect()
            ->route('margin_penjualan.index')
            ->with('success', 'Margin penjualan berhasil dihapus.');
    }
}
