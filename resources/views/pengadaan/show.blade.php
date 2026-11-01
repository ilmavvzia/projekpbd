@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Rincian Pengadaan #{{ $pengadaan->idpengadaan }}</h4>
            <span class="text-muted">Tanggal: {{ \Carbon\Carbon::parse($pengadaan->timestamp)->translatedFormat('d F Y, H:i') }} WIB</span>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('pengadaan.index') }}" class="btn btn-outline-secondary">Kembali</a>
            <button onclick="window.print()" class="btn btn-primary">Cetak Dokumen</button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <!-- Informasi Header -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white font-weight-bold">Ringkasan Dokumen</div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="text-muted" style="width: 40%;">ID Pengadaan</td>
                            <td>: <strong>#{{ $pengadaan->idpengadaan }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Vendor</td>
                            <td>: {{ $pengadaan->vendor->nama_vendor ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Petugas Input</td>
                            <td>: {{ $pengadaan->user->username ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Status Transaksi</td>
                            <td>: 
                                @if($pengadaan->status == 'A')
                                    <span class="badge bg-primary">Aktif / Diajukan</span>
                                @elseif($pengadaan->status == 'S')
                                    <span class="badge bg-success">Selesai Diterima</span>
                                @else
                                    <span class="badge bg-secondary">{{ $pengadaan->status }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabel Detail Barang -->
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white font-weight-bold">Daftar Barang yang Dipesan</div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 5%;" class="text-center">No</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Satuan</th>
                                    <th class="text-end">Harga Beli</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengadaan->detailPengadaan as $index => $detail)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $detail->barang->nama ?? 'Barang tidak ditemukan' }}</strong>
                                            <br>
                                            <small class="text-muted">Kode: {{ $detail->idbarang }}</small>
                                        </td>
                                        <td class="text-center">{{ $detail->barang->satuan->nama_satuan ?? '-' }}</td>
                                        <td class="text-end">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $detail->jumlah }}</td>
                                        <td class="text-end">Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-3 text-muted">Tidak ada rincian item pengadaan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="5" class="text-end">Subtotal Nilai:</th>
                                    <th class="text-end">Rp {{ number_format($pengadaan->subtotal_nilai, 0, ',', '.') }}</th>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-end">PPN:</th>
                                    <th class="text-end">Rp {{ number_format($pengadaan->ppn, 0, ',', '.') }}</th>
                                </tr>
                                <tr class="table-active">
                                    <th colspan="5" class="text-end h6 mb-0">Total Keseluruhan:</th>
                                    <th class="text-end h6 mb-0 text-primary">Rp {{ number_format($pengadaan->total_nilai, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection