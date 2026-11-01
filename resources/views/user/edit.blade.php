
@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="panel">
    <h2>Edit User</h2>
    <p>Ubah informasi akun dan role pengguna.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update', $user->iduser) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username', $user->username) }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Password Baru</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Kosongkan jika tidak ingin mengubah password"
            >
            <small>Kosongkan kolom ini jika password tidak ingin diubah.</small>
        </div>

        <div class="form-group">
            <label for="idrole">Role</label>
            <select id="idrole" name="idrole" required>
                @foreach ($roles as $role)
                    <option
                        value="{{ $role->idrole }}"
                        {{ old('idrole', $user->idrole) == $role->idrole ? 'selected' : '' }}
                    >
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Simpan Perubahan</button>

        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            Batal
        </a>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
