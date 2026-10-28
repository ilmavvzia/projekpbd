```php
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Satuan</title>
</head>
<body>
    <h1>Data Satuan</h1>

    <a href="{{ route('satuan.create') }}">+ Tambah Satuan</a>
    |
    <a href="{{ url('/') }}">Kembali ke Dashboard</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
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
                        <a href="{{ route('satuan.edit', $item->idsatuan) }}">
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
                                onclick="return confirm('Yakin ingin menghapus satuan ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data satuan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
```