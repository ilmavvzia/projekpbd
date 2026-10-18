<?php

namespace App\Http\Controllers;

use App\Models\MarginPenjualan;
use App\Models\User;
use Illuminate\Http\Request;

class MarginPenjualanController extends Controller
{
    public function index()
    {
        $margins = MarginPenjualan::with('user')->get();

        return view('margin_penjualan.index', compact('margins'));
    }

    public function create()
    {
        $users = User::all();

        return view('margin_penjualan.create', compact('users'));
    }

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

        return redirect()->route('margin_penjualan.index')
            ->with('success', 'Margin penjualan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $margin = MarginPenjualan::findOrFail($id);
        $users = User::all();

        return view('margin_penjualan.edit', compact('margin', 'users'));
    }

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

        return redirect()->route('margin_penjualan.index')
            ->with('success', 'Margin penjualan berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $margin = MarginPenjualan::findOrFail($id);
        $margin->delete();

        return redirect()->route('margin_penjualan.index')
            ->with('success', 'Margin penjualan berhasil dihapus.');
    }
}
