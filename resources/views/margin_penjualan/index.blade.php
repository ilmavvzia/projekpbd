
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Margin Penjualan</title>
</head>
<body>
    <h1>Data Margin Penjualan</h1>

    <a href="{{ route('margin_penjualan.create') }}">+ Tambah Margin</a>
    <a href="{{ url('/') }}">Kembali ke Dashboard</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
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
                        <a href="{{ route('margin_penjualan.edit', $margin->idmargin_penjualan) }}">
                            Edit
                        </a>

                        <form
                            action="{{ route('margin_penjualan.destroy', $margin->idmargin_penjualan) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Yakin ingin menghapus margin ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data margin.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
