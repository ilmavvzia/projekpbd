
@extends('layouts.app')

@section('title', 'Tambah Satuan')

@section('content')
<div class="panel">
    <h2>Tambah Data Satuan</h2>
    <p>Masukkan informasi satuan barang yang baru.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('satuan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_satuan">Nama Satuan</label>
            <input
                type="text"
                id="nama_satuan"
                name="nama_satuan"
                value="{{ old('nama_satuan') }}"
                maxlength="45"
                placeholder="Contoh: Pcs, Box, Kg"
                required
            >
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </select>
        </div>

        <button type="submit" class="btn">Simpan Satuan</button>
        <a href="{{ route('satuan.index') }}" class="btn btn-secondary">
            Batal
        </a>
        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
