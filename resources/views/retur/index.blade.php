
@extends('layouts.app')

@section('title', 'Data Retur - Toko Kita')

@section('content')

    <h1>Data Retur Penjualan</h1>
    <p class="sub">Kelola transaksi retur barang.</p>

    @if (session('success'))
        <div class="panel">
            {{ session('success') }}
        </div>
    @endif

    <div class="panel">
        <a href="{{ route('retur.create') }}" class="btn">
            + Tambah Retur
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID Retur</th>
                    <th>Tanggal</th>
                    <th>ID Penerimaan</th>
                    <th>ID User</th>
                    <th>Detail Barang</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($retur as $r)
                    <tr>
                        <td>{{ $r->idretur }}</td>
                        <td>{{ $r->created_at }}</td>
                        <td>{{ $r->idpenerimaan }}</td>
                        <td>{{ $r->username }}</td>
                        <td>
                            @forelse ($r->details as $detail)
                                Barang: {{ $detail->nama_barang }}<br>
                                Jumlah: {{ $detail->jumlah }}<br>
                                Alasan: {{ $detail->alasan }}<br><br>
                            @empty
                                Belum ada detail.
                            @endforelse
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada data retur.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
