
@extends('layouts.app')

@section('title', 'Edit Vendor')

@section('content')
<div class="panel">
    <h2>Edit Vendor</h2>
    <p>Ubah informasi vendor pada formulir berikut.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('vendor.update', $vendor->idvendor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_vendor">Nama Vendor</label>
            <input
                type="text"
                id="nama_vendor"
                name="nama_vendor"
                value="{{ old('nama_vendor', $vendor->nama_vendor) }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="badan_hukum">Badan Hukum</label>
            <select id="badan_hukum" name="badan_hukum" required>
                <option value="Y" {{ old('badan_hukum', $vendor->badan_hukum) == 'Y' ? 'selected' : '' }}>Ya</option>
                <option value="T" {{ old('badan_hukum', $vendor->badan_hukum) == 'T' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="A" {{ old('status', $vendor->status) == 'A' ? 'selected' : '' }}>Aktif</option>
                <option value="N" {{ old('status', $vendor->status) == 'N' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button type="submit" class="btn">Simpan Perubahan</button>
        <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Batal</a>
        <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </form>
</div>
@endsection
