<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Role</title>
</head>
<body>
    <h1>Tambah Role</h1>

    <form action="{{ route('role.store') }}" method="POST">
        @csrf

        <label>Nama Role</label>
        <input type="text" name="nama_role"
               value="{{ old('nama_role') }}" required>

        @error('nama_role')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('role.index') }}">Kembali</a>
</body>
</html>
