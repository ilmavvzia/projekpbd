
@extends('layouts.app')

@section('title', 'Data Barang - Toko Kita')

@section('content')

    <h1>Data Barang</h1>
    <p class="sub">Kelola data barang yang tersedia di toko.</p>

    @if (session('success'))
        <div class="panel">
            {{ session('success') }}
        </div>
    @endif

    <div class="panel">
        <a href="{{ route('barang.create') }}" class="btn">
            + Tambah Barang
        </a>
        <a href="{{ url('/') }}" class="btn-secondary">
            Kembali ke Dashboard
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Status</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($barang as $item)
                    <tr>
                        <td>{{ $item->idbarang }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nama_satuan ?? '-' }}</td>
                        <td>
                            {{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                        </td>
                        <td>
                            Rp{{ number_format($item->harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td>
                            <a href="{{ route('barang.edit', $item->idbarang) }}"
                               class="btn-secondary">
                                Edit
                            </a>

                            <form
                                action="{{ route('barang.destroy', $item->idbarang) }}"
                                method="POST"
                                style="display:inline"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-secondary"
                                    onclick="return confirm('Yakin ingin menghapus barang ini?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">
                            Belum ada data barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
