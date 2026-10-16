
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Barang</title>
</head>
<body>
    <h1>Tambah Data Barang</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('barang.store') }}" method="POST">
        @csrf

        <label for="jenis">Jenis:</label>
        <input
            type="text"
            id="jenis"
            name="jenis"
            value="{{ old('jenis') }}"
            maxlength="1"
        >

        <br><br>

        <label for="nama">Nama Barang:</label>
        <input
            type="text"
            id="nama"
            name="nama"
            value="{{ old('nama') }}"
            maxlength="45"
            required
        >

        <br><br>

        <label for="idsatuan">Satuan:</label>
        <select id="idsatuan" name="idsatuan">
            <option value="">-- Pilih Satuan --</option>

            @foreach ($satuan as $item)
                <option
                    value="{{ $item->idsatuan }}"
                    {{ old('idsatuan') == $item->idsatuan ? 'selected' : '' }}
                >
                    {{ $item->nama_satuan }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>

        <br><br>

        <label for="harga">Harga:</label>
        <input
            type="number"
            id="harga"
            name="harga"
            value="{{ old('harga') }}"
            min="0"
            required
        >

        <br><br>

        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="{{ route('barang.index') }}">Kembali ke Daftar Barang</a>
</body>
</html>
