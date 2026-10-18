<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Role</title>
</head>
<body>
    <h1>Edit Role</h1>

    <form action="{{ route('role.update', $role->idrole) }}"
          method="POST">
        @csrf
        @method('PUT')

        <label>Nama Role</label>
        <input type="text" name="nama_role"
               value="{{ old('nama_role', $role->nama_role) }}"
               required>

        @error('nama_role')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('role.index') }}">Kembali</a>
</body>
</html>
