
@extends('layouts.app')

@section('title', 'Pengadaan Barang')

@section('content')
<div class="panel">
    <h2>Pengadaan Barang</h2>
    <p>Hitung subtotal dan total biaya pengadaan barang berdasarkan harga, jumlah, dan nominal PPN.</p>

    @if ($errors->any())
        <div class="empty">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengadaan.hitung') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="harga">Harga Satuan (Rp)</label>
            <input
                type="number"
                id="harga"
                name="harga"
                min="0"
                value="{{ old('harga', $harga ?? '') }}"
                placeholder="Masukkan harga satuan"
                required
            >
        </div>

        <div class="form-group">
            <label for="jumlah">Jumlah Barang</label>
            <input
                type="number"
                id="jumlah"
                name="jumlah"
                min="1"
                value="{{ old('jumlah', $jumlah ?? '') }}"
                placeholder="Masukkan jumlah barang"
                required
            >
        </div>

        <div class="form-group">
            <label for="ppn">Nominal PPN (Rp)</label>
            <input
                type="number"
                id="ppn"
                name="ppn"
                min="0"
                value="{{ old('ppn', $ppn ?? 0) }}"
                placeholder="Masukkan nominal PPN"
                required
            >
        </div>

        <button type="submit" class="btn">Hitung Total</button>
        <a href="{{ url('/') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </form>

    @isset($subtotal)
        <div class="divider"></div>

        <h3>Hasil Perhitungan</h3>

        <div class="form-group">
            <label>Subtotal</label>
            <p>Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
        </div>

        <div class="form-group">
            <label>PPN</label>
            <p>Rp{{ number_format($ppn, 0, ',', '.') }}</p>
        </div>

        <div class="form-group">
            <label>Total Pengadaan</label>
            <h2>Rp{{ number_format($total, 0, ',', '.') }}</h2>
        </div>
    @endisset
</div>
@endsection
