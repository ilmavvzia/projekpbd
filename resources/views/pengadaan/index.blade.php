<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadaan Barang</title>
</head>
<body>
    <h1>Pengadaan Barang</h1>

    <form action="{{ route('pengadaan.hitung') }}" method="POST">
        @csrf

        <div>
            <label>Harga Satuan</label>
            <input type="number" name="harga"
                   min="0" value="{{ old('harga', $harga ?? '') }}"
                   required>
        </div>

        <div>
            <label>Jumlah Barang</label>
            <input type="number" name="jumlah"
                   min="1" value="{{ old('jumlah', $jumlah ?? '') }}"
                   required>
        </div>

        <div>
            <label>Nominal PPN (Rp)</label>
            <input type="number" name="ppn"
                   min="0" value="{{ old('ppn', $ppn ?? 0) }}"
                   required>
        </div>

        <button type="submit">Hitung Total</button>
    </form>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @isset($subtotal)
        <hr>
        <h2>Hasil Perhitungan</h2>
        <p>Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
        <p>PPN: Rp{{ number_format($ppn, 0, ',', '.') }}</p>
        <p>Total Pengadaan: Rp{{ number_format($total, 0, ',', '.') }}</p>
    @endisset
</body>
</html>
