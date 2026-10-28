<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function index()
{
    $vendors = DB::select('CALL sp_tampil_vendor()');

    return view('vendor.index', compact('vendors'));
}

    public function create()
    {
        return view('vendor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:100',
            'badan_hukum' => 'required|in:Y,T',
            'status' => 'required|in:A,N',
        ]);

        Vendor::create($request->only([
            'nama_vendor',
            'badan_hukum',
            'status',
        ]));

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $vendor = Vendor::findOrFail($id);

        return view('vendor.edit', compact('vendor'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_vendor' => 'required|string|max:100',
            'badan_hukum' => 'required|in:Y,T',
            'status' => 'required|in:A,N',
        ]);

        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->only([
            'nama_vendor',
            'badan_hukum',
            'status',
        ]));

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor berhasil dihapus.');
    }
}
