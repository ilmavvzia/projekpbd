
@extends('layouts.app')

@section('title', 'Tambah Vendor - Toko Kita')

@section('content')

    <h1>Tambah Vendor</h1>
    <p class="sub">Masukkan informasi vendor atau pemasok baru.</p>

    @if ($errors->any())
        <div class="panel">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="panel">
        <form action="{{ route('vendor.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_vendor">Nama Vendor</label>
                <input
                    type="text"
                    id="nama_vendor"
                    name="nama_vendor"
                    value="{{ old('nama_vendor') }}"
                    placeholder="Masukkan nama vendor"
                    required
                >
                @error('nama_vendor')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="badan_hukum">Badan Hukum</label>
                <select id="badan_hukum" name="badan_hukum" required>
                    <option value="">-- Pilih Badan Hukum --</option>
                    <option value="Y" {{ old('badan_hukum') == 'Y' ? 'selected' : '' }}>
                        Y - Ya
                    </option>
                    <option value="T" {{ old('badan_hukum') == 'T' ? 'selected' : '' }}>
                        T - Tidak
                    </option>
                </select>
                @error('badan_hukum')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status Vendor</label>
                <select id="status" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="A" {{ old('status') == 'A' ? 'selected' : '' }}>
                        A - Aktif
                    </option>
                    <option value="N" {{ old('status') == 'N' ? 'selected' : '' }}>
                        N - Nonaktif
                    </option>
                </select>
                @error('status')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">
                Simpan Vendor
            </button>

            <a href="{{ url('/') }}" class="btn-secondary">
                Kembali ke Dashboard
            </a>
        </form>
    </div>

@endsection
