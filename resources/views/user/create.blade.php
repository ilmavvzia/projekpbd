
@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="panel">
    <h2>Tambah User</h2>
    <p>Tambahkan akun pengguna dan tentukan role yang dimiliki.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                placeholder="Masukkan username"
                required
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required
            >
        </div>

        <div class="form-group">
            <label for="idrole">Role</label>
            <select id="idrole" name="idrole" required>
                <option value="">-- Pilih Role --</option>

                @foreach ($roles as $role)
                    <option
                        value="{{ $role->idrole }}"
                        {{ old('idrole') == $role->idrole ? 'selected' : '' }}
                    >
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Simpan User</button>

        <a href="{{ route('user.index') }}" class="btn btn-secondary">
            Batal
        </a>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
