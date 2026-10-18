<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Vendor</title>
</head>
<body>
    <h1>Data Vendor</h1>

    <a href="{{ route('vendor.create') }}">+ Tambah Vendor</a>
    <a href="{{ url('/') }}">Kembali ke Dashboard</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
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
                    <td>{{ $vendor->badan_hukum }}</td>
                    <td>{{ $vendor->status }}</td>
                    <td>
                        <a href="{{ route('vendor.edit', $vendor->idvendor) }}">Edit</a>

                        <form action="{{ route('vendor.destroy', $vendor->idvendor) }}"
                              method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus vendor ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Belum ada data vendor.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
