
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Satuan</title>
</head>
<body>
    <h1>Tambah Data Satuan</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('satuan.store') }}" method="POST">
        @csrf

        <label for="nama_satuan">Nama Satuan:</label>
        <input
            type="text"
            id="nama_satuan"
            name="nama_satuan"
            value="{{ old('nama_satuan') }}"
            maxlength="45"
            required
        >

        <br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>

        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('satuan.index') }}">Kembali ke Daftar Satuan</a>
</body>
</html>
