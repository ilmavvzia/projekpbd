
@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@if(session('error'))
    <div class="empty" style="margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="empty" style="margin-bottom: 15px;">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@section('content')
<div class="panel">
    <div style="margin-bottom: 20px;">
        <h2>Tambah Penjualan</h2>
        <p>Masukkan informasi transaksi penjualan barang.</p>
    </div>

    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Kasir</label>
            <select name="iduser" required>
                <option value="">-- Pilih Kasir --</option>
                @foreach($users as $user)
                    <option value="{{ $user->iduser }}">
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Margin Penjualan</label>
            <select name="idmargin_penjualan" required>
                <option value="">-- Pilih Margin --</option>
                @foreach($margins as $margin)
                    <option value="{{ $margin->idmargin_penjualan }}">
                        {{ $margin->persen }}%
                    </option>
                @endforeach
            </select>
        </div>

        <hr>

        <h3>Barang yang Dijual</h3>

        <div style="margin-bottom: 15px;">
            <label>Barang</label>
            <select name="idbarang" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->idbarang }}">
                        {{ $barang->nama }} - 
                        Rp {{ number_format($barang->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label>Jumlah</label>
            <input
                type="number"
                name="jumlah"
                min="1"
                required
            >
        </div>

        <button type="submit" class="btn">
            Simpan Penjualan
        </button>

        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
