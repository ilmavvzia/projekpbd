
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>
<body>
    <h1>Tambah User</h1>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <p>
            <label>Username</label><br>
            <input type="text" name="username"
                   value="{{ old('username') }}" required>
            @error('username') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
            @error('password') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Role</label><br>
            <select name="idrole" required>
                <option value="">-- Pilih Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->idrole }}"
                        @selected(old('idrole') == $role->idrole)>
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            </select>
            @error('idrole') <span>{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('user.index') }}">Kembali</a>
</body>
</html>
