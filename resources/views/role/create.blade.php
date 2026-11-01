
@extends('layouts.app')

@section('title', 'Tambah Role')

@section('content')
<div class="panel">
    <h2>Tambah Role</h2>
    <p>Tambahkan role atau hak akses baru untuk pengguna aplikasi.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('role.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_role">Nama Role</label>
            <input
                type="text"
                id="nama_role"
                name="nama_role"
                value="{{ old('nama_role') }}"
                placeholder="Contoh: Superadmin, Kasir"
                required
            >

            @error('nama_role')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Role</button>

        <a href="{{ route('role.index') }}" class="btn btn-secondary">
            Batal
        </a>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
