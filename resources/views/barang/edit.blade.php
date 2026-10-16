
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
</head>
<body>
    <h1>Edit Data Barang</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('barang.update', $barang->idbarang) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="jenis">Jenis:</label>
        <input
            type="text"
            id="jenis"
            name="jenis"
            value="{{ old('jenis', $barang->jenis) }}"
            maxlength="1"
        >

        <br><br>

        <label for="nama">Nama Barang:</label>
        <input
            type="text"
            id="nama"
            name="nama"
            value="{{ old('nama', $barang->nama) }}"
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
                    {{ old('idsatuan', $barang->idsatuan) == $item->idsatuan ? 'selected' : '' }}
                >
                    {{ $item->nama_satuan }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="1" {{ old('status', $barang->status) == 1 ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="0" {{ old('status', $barang->status) == 0 ? 'selected' : '' }}>
                Tidak Aktif
            </option>
        </select>

        <br><br>

        <label for="harga">Harga:</label>
        <input
            type="number"
            id="harga"
            name="harga"
            value="{{ old('harga', $barang->harga) }}"
            min="0"
            required
        >

        <br><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="{{ route('barang.index') }}">Kembali ke Daftar Barang</a>
</body>
</html>
