<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Margin</title>
</head>
<body>
    <h1>Tambah Margin Penjualan</h1>

    <form action="{{ route('margin_penjualan.store') }}" method="POST">
        @csrf

        <p>
            <label>Persentase Margin (%)</label><br>
            <input type="number" name="persen" min="0" max="100"
                   step="0.01" value="{{ old('persen') }}" required>
            @error('persen') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required>
                <option value="1" @selected(old('status') == '1')>Aktif (1)</option>
                <option value="0" @selected(old('status') == '0')>Tidak Aktif (0)</option>
            </select>
            @error('status') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>User</label><br>
            <select name="iduser" required>
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->iduser }}"
                        @selected(old('iduser') == $user->iduser)>
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
            @error('iduser') <span>{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('margin_penjualan.index') }}">Kembali</a>
</body>
</html>
