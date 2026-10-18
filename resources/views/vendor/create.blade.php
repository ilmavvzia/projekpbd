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
            @error('nama_vendor') <p>{{ $message }}</p> @enderror
        </p>

        <p>
            <label>Badan Hukum</label><br>
            <select name="badan_hukum" required>
                <option value="">-- Pilih --</option>
                <option value="P" @selected(old('badan_hukum') == 'P')>P</option>
                <option value="C" @selected(old('badan_hukum') == 'C')>C</option>
            </select>
            @error('badan_hukum') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required>
                <option value="">-- Pilih --</option>
                <option value="A" @selected(old('status') == 'A')>A</option>
                <option value="N" @selected(old('status') == 'N')>N</option>
            </select>
            @error('status') <span>{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('vendor.index') }}">Kembali</a>
</body>
</html>
