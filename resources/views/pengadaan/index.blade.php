
@extends('layouts.app')

@section('title', 'Pengadaan Barang')

@section('content')
<div class="panel">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <div>
            <h2>Pengadaan Barang</h2>
            <p>Daftar transaksi pengadaan barang dari vendor.</p>
        </div>

        <a href="{{ route('pengadaan.create') }}" class="btn">
            + Tambah Pengadaan
        </a>
    </div>

    @if(session('success'))
        <div class="empty" style="margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="empty" style="margin-bottom: 15px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pengadaan</th>
                    <th>Tanggal</th>
                    <th>Vendor</th>
                    <th>Subtotal</th>
                    <th>PPN</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengadaans as $index => $pengadaan)
                    <tr>
                        <td>{{ $pengadaans->firstItem() + $index }}</td>
                        <td>#{{ $pengadaan->idpengadaan }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($pengadaan->timestamp)->format('d-m-Y H:i') }}
                        </td>
                        <td>{{ $pengadaan->vendor->nama_vendor ?? '-' }}</td>
                        <td>
                            Rp {{ number_format($pengadaan->subtotal_nilai, 0, ',', '.') }}
                        </td>
                        <td>
                            Rp {{ number_format($pengadaan->ppn, 0, ',', '.') }}
                        </td>
                        <td>
                            <strong>
                                Rp {{ number_format($pengadaan->total_nilai, 0, ',', '.') }}
                            </strong>
                        </td>
                        <td>
                            @if($pengadaan->status == 'A')
                                <span>Aktif / Diajukan</span>
                            @elseif($pengadaan->status == 'S')
                                <span>Selesai Diterima</span>
                            @else
                                <span>{{ $pengadaan->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pengadaan.show', $pengadaan->idpengadaan) }}"
                               class="btn btn-secondary">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="empty">
                            Belum ada transaksi pengadaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pengadaans->hasPages())
        <div style="margin-top: 20px;">
            {{ $pengadaans->links() }}
        </div>
    @endif
</div>
@endsection
