
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
</head>
<body>
    <h1>Data User</h1>

    <a href="{{ route('user.create') }}">+ Tambah User</a>
    <a href="{{ url('/') }}">Kembali ke Dashboard</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->iduser }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role?->nama_role ?? '-' }}</td>
                    <td>
                        <a href="{{ route('user.edit', $user->iduser) }}">Edit</a>

                        <form action="{{ route('user.destroy', $user->iduser) }}"
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus user ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada data user.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
