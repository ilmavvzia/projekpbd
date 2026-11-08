
@extends('layouts.app')

@section('title', 'Penjualan Barang')

@section('content')
<div class="panel">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2>Penjualan Barang</h2>
            <p>Daftar transaksi penjualan barang.</p>
        </div>

        <a href="{{ route('penjualan.create') }}" class="btn">
            + Tambah Penjualan
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Penjualan</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Margin</th>
                    <th>Subtotal</th>
                    <th>PPN</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($penjualan as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>#{{ $p->idpenjualan }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y H:i') }}
                        </td>
                        <td>{{ $p->username ?? '-' }}</td>
                        <td>{{ $p->persen ?? 0 }}%</td>
                        <td>
                            Rp {{ number_format($p->subtotal_nilai, 0, ',', '.') }}
                        </td>
                        <td>
                            Rp {{ number_format($p->ppn, 0, ',', '.') }}
                        </td>
                        <td>
                            <strong>
                                Rp {{ number_format($p->total_nilai, 0, ',', '.') }}
                            </strong>
                        </td>
                        <td>
                            <a href="{{ route('penjualan.show', $p->idpenjualan) }}"
                               class="btn btn-secondary">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty">
                            Belum ada transaksi penjualan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="panel" style="margin-top: 20px;">
    <div style="margin-bottom: 20px;">
        <h2>Detail Penjualan</h2>
        <p>Daftar barang yang tercatat dalam transaksi penjualan.</p>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Detail</th>
                    <th>ID Penjualan</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($detail_penjualan as $index => $d)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->iddetail_penjualan }}</td>
                        <td>#{{ $d->idpenjualan }}</td>
                        <td>{{ $d->nama_barang ?? '-' }}</td>
                        <td>
                            Rp {{ number_format($d->harga_satuan, 0, ',', '.') }}
                        </td>
                        <td>{{ $d->jumlah }}</td>
                        <td>
                            Rp {{ number_format($d->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada detail penjualan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
