<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Vendor</title>
</head>
<body>
    <h1>Tambah Vendor</h1>

    <form action="{{ route('vendor.store') }}" method="POST">
        @csrf

        <p>
            <label>Nama Vendor</label><br>
            <input type="text" name="nama_vendor"
                   value="{{ old('nama_vendor') }}" required>
            @error('nama_vendor')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label>Badan Hukum</label><br>
            <select name="badan_hukum" required>
                <option value="">-- Pilih --</option>
                <option value="Y" @selected(old('badan_hukum') == 'Y')>Y - Ya</option>
                <option value="T" @selected(old('badan_hukum') == 'T')>T - Tidak</option>
            </select>
            @error('badan_hukum')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required>
                <option value="">-- Pilih --</option>
                <option value="A" @selected(old('status') == 'A')>A - Aktif</option>
                <option value="N" @selected(old('status') == 'N')>N - Nonaktif</option>
            </select>
            @error('status')
                <span>{{ $message }}</span>
            @enderror
        </p>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('vendor.index') }}">Kembali</a>
</body>
</html>