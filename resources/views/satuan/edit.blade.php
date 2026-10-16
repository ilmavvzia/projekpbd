
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Satuan</title>
</head>
<body>
    <h1>Edit Data Satuan</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('satuan.update', $satuan->idsatuan) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nama_satuan">Nama Satuan:</label>
        <input
            type="text"
            id="nama_satuan"
            name="nama_satuan"
            value="{{ old('nama_satuan', $satuan->nama_satuan) }}"
            maxlength="45"
            required
        >

        <br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="1" {{ old('status', $satuan->status) == 1 ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="0" {{ old('status', $satuan->status) == 0 ? 'selected' : '' }}>
                Tidak Aktif
            </option>
        </select>

        <br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="{{ route('satuan.index') }}">Kembali ke Daftar Satuan</a>
</body>
</html>
