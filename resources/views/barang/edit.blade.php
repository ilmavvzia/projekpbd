
@extends('layouts.app')

@section('title', 'Edit Barang - Toko Kita')

@section('content')

    <h1>Edit Data Barang</h1>
    <p class="sub">Perbarui informasi barang yang tersimpan.</p>

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
        <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="jenis">Jenis Barang</label>
                <select id="jenis" name="jenis" required>
                    <option value="">-- Pilih Jenis Barang --</option>

                    <option value="A" {{ old('jenis', $barang->jenis) == 'A' ? 'selected' : '' }}>
                        A
                    </option>

                    <option value="B" {{ old('jenis', $barang->jenis) == 'B' ? 'selected' : '' }}>
                        B
                    </option>

                    <option value="C" {{ old('jenis', $barang->jenis) == 'C' ? 'selected' : '' }}>
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
                    value="{{ old('nama', $barang->nama) }}"
                    maxlength="45"
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
                            {{ old('idsatuan', $barang->idsatuan) == $item->idsatuan ? 'selected' : '' }}
                        >
                            {{ $item->nama_satuan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="1" {{ old('status', $barang->status) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0" {{ old('status', $barang->status) == 0 ? 'selected' : '' }}>
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
                    value="{{ old('harga', $barang->harga) }}"
                    min="0"
                    required
                >
            </div>

            <button type="submit" class="btn">
                Simpan Perubahan
            </button>

            <a href="{{ url('/') }}" class="btn-secondary">
                Kembali ke Dashboard
            </a>
        </form>
    </div>

@endsection
