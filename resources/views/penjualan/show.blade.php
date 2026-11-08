
@extends('layouts.app')

@section('title', 'Detail Penjualan')

@section('content')
<div class="panel">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2>Detail Penjualan #{{ $penjualan->idpenjualan }}</h2>
            <p>Informasi lengkap transaksi penjualan.</p>
        </div>

        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <h3>Informasi Transaksi</h3>

    <div class="table-wrap">
        <table>
            <tr>
                <th>ID Penjualan</th>
                <td>#{{ $penjualan->idpenjualan }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ $penjualan->created_at }}</td>
            </tr>
            <tr>
                <th>Kasir</th>
                <td>{{ $penjualan->username ?? '-' }}</td>
            </tr>
            <tr>
                <th>Margin</th>
                <td>{{ $penjualan->persen ?? 0 }}%</td>
            </tr>
            <tr>
                <th>Subtotal</th>
                <td>Rp {{ number_format($penjualan->subtotal_nilai, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>PPN</th>
                <td>Rp {{ number_format($penjualan->ppn, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>
                    <strong>
                        Rp {{ number_format($penjualan->total_nilai, 0, ',', '.') }}
                    </strong>
                </td>
            </tr>
        </table>
    </div>

    <h3 style="margin-top: 25px;">Barang yang Dijual</h3>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($detail_penjualan as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->nama_barang ?? '-' }}</td>
                        <td>
                            Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                        </td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>
                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Tidak ada detail barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
