
@extends('layouts.app')

@section('title', 'Tambah Penerimaan - Toko Kita')

@section('content')

    <h1>Tambah Penerimaan Barang</h1>
    <p class="sub">Masukkan informasi barang yang diterima.</p>

    <div class="panel">
        <form action="{{ route('penerimaan.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="iduser">Petugas Penerima</label>
                <select name="iduser" id="iduser" required>
                    <option value="">-- Pilih Petugas --</option>
                    @foreach ($user as $u)
                        <option value="{{ $u->iduser }}">
                            {{ $u->username ?? $u->iduser }}
                        </option>
                    @endforeach
                </select>
                @error('iduser')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="barang_idbarang">Barang</label>
                <select name="barang_idbarang" id="barang_idbarang" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach ($barang as $b)
                        <option value="{{ $b->idbarang }}">
                            {{ $b->nama }}
                        </option>
                    @endforeach
                </select>
                @error('barang_idbarang')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_terima">Jumlah Diterima</label>
                <input type="number" name="jumlah_terima"
                    id="jumlah_terima" min="1" required>
                @error('jumlah_terima')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="harga_satuan_terima">Harga Satuan Terima</label>
                <input type="number" name="harga_satuan_terima"
                    id="harga_satuan_terima" min="0" required>
                @error('harga_satuan_terima')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn">Simpan Penerimaan</button>
            <a href="{{ route('penerimaan.index') }}" class="btn-secondary">
                Kembali
            </a>
        </form>
    </div>

@endsection
