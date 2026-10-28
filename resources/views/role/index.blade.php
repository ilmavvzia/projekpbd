<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Role</title>
</head>
<body>
    <h1>Data Role</h1>

    <a href="{{ route('role.create') }}">+ Tambah Role</a>
    |
    <a href="{{ url('/') }}">Kembali ke Dashboard</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
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
                        <a href="{{ route('role.edit', $item->idrole) }}">
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
                                onclick="return confirm('Yakin ingin menghapus role ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Belum ada data role.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
```