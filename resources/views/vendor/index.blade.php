
@extends('layouts.app')

@section('title', 'Data Vendor - Toko Kita')

@section('content')

    <h1>Data Vendor</h1>
    <p class="sub">Kelola data pemasok atau vendor toko.</p>

    @if (session('success'))
        <div class="panel">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="panel">
            {{ session('error') }}
        </div>
    @endif

    <div class="panel">
        <a href="{{ route('vendor.create') }}" class="btn">
            + Tambah Vendor
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
                    <th>Nama Vendor</th>
                    <th>Badan Hukum</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->idvendor }}</td>
                        <td>{{ $vendor->nama_vendor }}</td>
                        <td>
                            {{ $vendor->badan_hukum == 'Y' ? 'Ya' : 'Tidak' }}
                        </td>
                        <td>
                            {{ $vendor->status == 'A' ? 'Aktif' : 'Nonaktif' }}
                        </td>
                        <td>
                            <a href="{{ route('vendor.edit', $vendor->idvendor) }}"
                               class="btn-secondary">
                                Edit
                            </a>

                            <form
                                action="{{ route('vendor.destroy', $vendor->idvendor) }}"
                                method="POST"
                                style="display:inline"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-secondary"
                                    onclick="return confirm('Yakin ingin menghapus vendor ini?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada data vendor.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
