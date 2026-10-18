<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:45|unique:user,username',
            'password' => 'required|string|min:6',
            'idrole' => 'required|exists:role,idrole',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'idrole' => $request->idrole,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:45|unique:user,username,' . $user->iduser . ',iduser',
            'password' => 'nullable|string|min:6',
            'idrole' => 'required|exists:role,idrole',
        ]);

        $data = [
            'username' => $request->username,
            'idrole' => $request->idrole,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
