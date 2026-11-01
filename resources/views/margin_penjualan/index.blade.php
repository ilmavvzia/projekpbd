
@extends('layouts.app')

@section('title', 'Data Margin Penjualan')

@section('content')
<div class="panel">
    <div class="row" style="justify-content: space-between; align-items: center;">
        <div>
            <h2>Data Margin Penjualan</h2>
            <p>Kelola persentase margin yang digunakan dalam transaksi penjualan.</p>
        </div>

        <div class="row">
            <a href="{{ route('margin_penjualan.create') }}" class="btn">
                + Tambah Margin
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
                    <th>ID Margin</th>
                    <th>Persen</th>
                    <th>Status</th>
                    <th>ID User</th>
                    <th>Nama User</th>
                    <th>Dibuat</th>
                    <th>Diperbarui</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($margins as $margin)
                    <tr>
                        <td>{{ $margin->idmargin_penjualan }}</td>
                        <td>{{ $margin->persen }}%</td>
                        <td>
                            {{ $margin->status_deskripsi == 1 ? 'Aktif' : 'Tidak Aktif' }}
                        </td>
                        <td>{{ $margin->iduser ?? '-' }}</td>
                        <td>{{ $margin->username ?? '-' }}</td>
                        <td>{{ $margin->created_at }}</td>
                        <td>{{ $margin->updated_at }}</td>
                        <td>
                            <a
                                href="{{ route('margin_penjualan.edit', $margin->idmargin_penjualan) }}"
                                class="btn btn-secondary"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('margin_penjualan.destroy', $margin->idmargin_penjualan) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn"
                                    onclick="return confirm('Yakin ingin menghapus margin ini?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="empty">
                            Belum ada data margin penjualan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
