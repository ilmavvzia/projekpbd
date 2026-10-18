<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('role.index', compact('roles'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
        ]);

        Role::create($request->only('nama_role'));

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $role = Role::findOrFail($id);

        return view('role.edit', compact('role'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only('nama_role'));

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.index')
            ->with('success', 'Role berhasil dihapus.');
    }
}
