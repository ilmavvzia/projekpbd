
@extends('layouts.app')

@section('title', 'Data Role')

@section('content')
<div class="panel">
    <div class="row" style="justify-content: space-between; align-items: center;">
        <div>
            <h2>Data Role</h2>
            <p>Kelola role atau hak akses pengguna aplikasi.</p>
        </div>

        <div class="row">
            <a href="{{ route('role.create') }}" class="btn">
                + Tambah Role
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
                    <th>ID Role</th>
                    <th>Nama Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($roles as $item)
                    <tr>
                        <td>{{ $item->idrole }}</td>
                        <td>{{ $item->nama_role }}</td>
                        <td>
                            <a href="{{ route('role.edit', $item->idrole) }}"
                               class="btn btn-secondary">
                                Edit
                            </a>

                            <form
                                action="{{ route('role.destroy', $item->idrole) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn"
                                    onclick="return confirm('Yakin ingin menghapus role ini?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty">
                            Belum ada data role.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
