
@extends('layouts.app')

@section('title', 'Tambah Barang - Toko Kita')

@section('content')

    <h1>Tambah Data Barang</h1>
    <p class="sub">Masukkan informasi barang baru ke dalam sistem.</p>

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
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="jenis">Jenis Barang</label>
                <select id="jenis" name="jenis" required>
                    <option value="">-- Pilih Jenis Barang --</option>

                    <option value="A" {{ old('jenis') == 'A' ? 'selected' : '' }}>
                        A
                    </option>

                    <option value="B" {{ old('jenis') == 'B' ? 'selected' : '' }}>
                        B
                    </option>

                    <option value="C" {{ old('jenis') == 'C' ? 'selected' : '' }}>
                        C
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="nama">Nama Barang</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    maxlength="45"
                    placeholder="Masukkan nama barang"
                    required
                >
            </div>

            <div class="form-group">
                <label for="idsatuan">Satuan</label>
                <select id="idsatuan" name="idsatuan" required>
                    <option value="">-- Pilih Satuan --</option>

                    @foreach ($satuan as $item)
                        <option
                            value="{{ $item->idsatuan }}"
                            {{ old('idsatuan') == $item->idsatuan ? 'selected' : '' }}
                        >
                            {{ $item->nama_satuan }}
                        </option>
                    @endforeach
                </select>
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

            <div class="form-group">
                <label for="harga">Harga Barang</label>
                <input
                    type="number"
                    id="harga"
                    name="harga"
                    value="{{ old('harga') }}"
                    min="0"
                    placeholder="Masukkan harga barang"
                    required
                >
            </div>

            <button type="submit" class="btn">
                Simpan Barang
            </button>

            <a href="{{ url('/') }}" class="btn-secondary">
                Kembali ke Dashboard
            </a>
        </form>
    </div>

@endsection
