<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuan = Satuan::all();

        return view('satuan.index', compact('satuan'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|max:45',
            'status' => 'required|in:0,1',
        ]);

        Satuan::create($request->only([
            'nama_satuan',
            'status',
        ]));

        return redirect()->route('satuan.index')
            ->with('success', 'Data satuan berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $satuan = Satuan::findOrFail($id);

        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_satuan' => 'required|max:45',
            'status' => 'required|in:0,1',
        ]);

        $satuan = Satuan::findOrFail($id);

        $satuan->update($request->only([
            'nama_satuan',
            'status',
        ]));

        return redirect()->route('satuan.index')
            ->with('success', 'Data satuan berhasil diubah.');
    }

    public function destroy(string $id)
    {
        $satuan = Satuan::findOrFail($id);

        $satuan->delete();

        return redirect()->route('satuan.index')
            ->with('success', 'Data satuan berhasil dihapus.');
    }
}
