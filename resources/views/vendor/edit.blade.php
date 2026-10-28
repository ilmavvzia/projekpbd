<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Vendor</title>
</head>
<body>
    <h1>Edit Vendor</h1>

    <form action="{{ route('vendor.update', $vendor->idvendor) }}"
          method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Nama Vendor</label><br>
            <input type="text" name="nama_vendor"
                   value="{{ old('nama_vendor', $vendor->nama_vendor) }}" required>
            @error('nama_vendor') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Badan Hukum</label><br>
            <select name="badan_hukum" required>
                <option value="Y" @selected(old('badan_hukum', $vendor->badan_hukum) == 'Y')>P</option>
                <option value="T" @selected(old('badan_hukum', $vendor->badan_hukum) == 'T')>C</option>
            </select>
            @error('badan_hukum') <span>{{ $message }}</span> @enderror
        </p>

        <p>
            <label>Status</label><br>
            <select name="status" required>
                <option value="A" @selected(old('status', $vendor->status) == 'A')>A</option>
                <option value="N" @selected(old('status', $vendor->status) == 'N')>N</option>
            </select>
            @error('status') <span>{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="{{ route('vendor.index') }}">Kembali</a>
</body>
</html>
