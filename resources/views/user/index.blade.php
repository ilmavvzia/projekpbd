
@extends('layouts.app')

@section('title', 'Data User')

@section('content')
<div class="panel">
    <div class="row" style="justify-content: space-between; align-items: center;">
        <div>
            <h2>Data User</h2>
            <p>Kelola akun pengguna dan role pada aplikasi.</p>
        </div>

        <div class="row">
            <a href="{{ route('user.create') }}" class="btn">
                + Tambah User
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
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $item)
                    <tr>
                        <td>{{ $item->iduser }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->nama_role ?? '-' }}</td>
                        <td>
                            <a href="{{ route('user.edit', $item->iduser) }}"
                               class="btn btn-secondary">
                                Edit
                            </a>

                            <form
                                action="{{ route('user.destroy', $item->iduser) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn"
                                    onclick="return confirm('Yakin ingin menghapus user ini?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty">
                            Belum ada data user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
