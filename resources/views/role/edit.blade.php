
@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="panel">
    <h2>Edit Role</h2>
    <p>Ubah nama role atau hak akses pengguna aplikasi.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('role.update', $role->idrole) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_role">Nama Role</label>
            <input
                type="text"
                id="nama_role"
                name="nama_role"
                value="{{ old('nama_role', $role->nama_role) }}"
                required
            >

            @error('nama_role')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan Perubahan</button>

        <a href="{{ route('role.index') }}" class="btn btn-secondary">
            Batal
        </a>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
