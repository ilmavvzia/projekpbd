
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>

    <form action="{{ route('user.update', $user->iduser) }}"
          method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Username</label><br>
            <input type="text" name="username"
                   value="{{ old('username', $user->username) }}" required>
            @error('username') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Password Baru (kosongkan jika tidak diubah)</label><br>
            <input type="password" name="password">
            @error('password') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Role</label><br>
            <select name="idrole" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->idrole }}"
                        @selected(old('idrole', $user->idrole) == $role->idrole)>
                        {{ $role->nama_role }}
                    </option>
                @endforeach
            </select>
            @error('idrole') <span>{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('user.index') }}">Kembali</a>
</body>
</html>
