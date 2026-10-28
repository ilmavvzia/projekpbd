
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
</head>
<body>
    <h1>Data Barang</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('barang.create') }}">Tambah Barang</a>

    <br><br>

    <table border="1" cellpadding="8">
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
                    <td>{{ $item->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>Rp{{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $item->idbarang) }}">
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
                                onclick="return confirm('Yakin ingin menghapus barang ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
