
@extends('layouts.app')

@section('title', 'Data Penerimaan - Toko Kita')

@section('content')

    <h1>Data Penerimaan Barang</h1>
    <p class="sub">Kelola transaksi penerimaan barang dari pemasok.</p>

    @if (session('success'))
        <div class="panel">
            {{ session('success') }}
        </div>
    @endif

    <div class="panel">
        <a href="{{ route('penerimaan.create') }}" class="btn">
            + Tambah Penerimaan
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID Penerimaan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>ID User</th>
                    <th>Detail Barang</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($penerimaan as $p)
                    <tr>
                        <td>{{ $p->idpenerimaan }}</td>
                        <td>{{ $p->created_at }}</td>
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->iduser }}</td>
                        <td>
                            @foreach ($p->details as $detail)
                                ID Barang: {{ $detail->barang_idbarang }}<br>
                                Jumlah: {{ $detail->jumlah_terima }}
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada data penerimaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
