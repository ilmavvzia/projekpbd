
@extends('layouts.app')

@section('title', 'Data Satuan')

@section('content')
<div class="panel">
    <div class="row" style="justify-content: space-between; align-items: center;">
        <div>
            <h2>Data Satuan</h2>
            <p>Kelola data satuan barang yang tersedia.</p>
        </div>

        <div class="row">
            <a href="{{ route('satuan.create') }}" class="btn">
                + Tambah Satuan
            </a>
            <a href="{{ url('/') }}" class="btn btn-secondary">
                Kembali ke Dashboard
            </a>
        </div>
    </div>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID Satuan</th>
                    <th>Nama Satuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($satuan as $item)
                    <tr>
                        <td>{{ $item->idsatuan }}</td>
                        <td>{{ $item->nama_satuan }}</td>
                        <td>
                            {{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                        </td>
                        <td>
                            <a href="{{ route('satuan.edit', $item->idsatuan) }}"
                               class="btn btn-secondary">
                                Edit
                            </a>

                            <form
                                action="{{ route('satuan.destroy', $item->idsatuan) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn"
                                    onclick="return confirm('Yakin ingin menghapus satuan ini?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty">
                            Belum ada data satuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
