
@extends('layouts.app')

@section('title', 'Edit Satuan')

@section('content')
<div class="panel">
    <h2>Edit Data Satuan</h2>
    <p>Ubah informasi satuan barang pada formulir berikut.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('satuan.update', $satuan->idsatuan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_satuan">Nama Satuan</label>
            <input
                type="text"
                id="nama_satuan"
                name="nama_satuan"
                value="{{ old('nama_satuan', $satuan->nama_satuan) }}"
                maxlength="45"
                required
            >
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="1"
                    {{ old('status', $satuan->status) == '1' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0"
                    {{ old('status', $satuan->status) == '0' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </select>
        </div>

        <button type="submit" class="btn">Simpan Perubahan</button>

        <a href="{{ route('satuan.index') }}" class="btn btn-secondary">
            Batal
        </a>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
