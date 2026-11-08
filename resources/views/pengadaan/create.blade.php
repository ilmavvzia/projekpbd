
@extends('layouts.app')

@section('title', 'Tambah Pengadaan')

@section('content')
<div class="panel">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <div>
            <h2>Tambah Pengadaan Barang</h2>
            <p>Catat pembelian barang dari vendor.</p>
        </div>

        <a href="{{ route('pengadaan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="empty">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="empty" style="margin-bottom:15px;">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengadaan.store') }}" method="POST" id="form-pengadaan">
        @csrf

        <h3>Informasi Pengadaan</h3>

        <div class="form-group">
            <label for="vendor_idvendor">Vendor</label>
            <select name="vendor_idvendor" id="vendor_idvendor" required>
                <option value="">-- Pilih Vendor --</option>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->idvendor }}"
                        {{ old('vendor_idvendor') == $vendor->idvendor ? 'selected' : '' }}>
                        {{ $vendor->nama_vendor }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Tanggal Pengadaan</label>
            <input type="text" value="{{ date('d-m-Y') }}" readonly>
        </div>

        <hr>

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">
            <h3>Rincian Barang</h3>
            <button type="button" class="btn" id="btn-tambah-baris">
                + Tambah Barang
            </button>
        </div>

        <div class="table-wrap">
            <table id="tabel-detail">
                <thead>
                    <tr>
                        <th>Barang</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Jumlah</th>
                        <th>Subtotal (Rp)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="item-row">
                        <td>
                            <select name="items[0][idbarang]" class="select-barang" required>
                                <option value="">-- Pilih Barang --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->idbarang }}"
                                        data-harga="{{ $barang->harga ?? 0 }}">
                                        {{ $barang->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <input type="number"
                                name="items[0][harga_satuan]"
                                class="input-harga"
                                min="0" value="0" required>
                        </td>

                        <td>
                            <input type="number"
                                name="items[0][jumlah]"
                                class="input-jumlah"
                                min="1" value="1" required>
                        </td>

                        <td>
                            <input type="text"
                                class="input-subtotal"
                                value="Rp 0" readonly>
                        </td>

                        <td>
                            <button type="button"
                                class="btn btn-secondary btn-hapus"
                                onclick="hapusBaris(this)">
                                Hapus
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="max-width:350px; margin:25px 0 25px auto;">
            <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
                <strong>Subtotal Nilai:</strong>
                <strong id="label-subtotal">Rp 0</strong>
            </div>

            <div style="display:flex; justify-content:space-between; margin-bottom:12px;">
                <strong>PPN (11%):</strong>
                <strong id="label-ppn">Rp 0</strong>
            </div>

            <hr>

            <div style="display:flex; justify-content:space-between;">
                <strong>Total Pengadaan:</strong>
                <strong id="label-total">Rp 0</strong>
            </div>
        </div>

        <button type="submit" class="btn">
            Simpan Pengadaan
        </button>

        <a href="{{ route('pengadaan.index') }}" class="btn btn-secondary">
            Batal
        </a>
    </form>
</div>

<script>
let rowIndex = 1;

const barangOptions = `
    <option value="">-- Pilih Barang --</option>
    @foreach($barangs as $barang)
        <option value="{{ $barang->idbarang }}"
            data-harga="{{ $barang->harga ?? 0 }}">
            {{ $barang->nama }}
        </option>
    @endforeach
`;

document.getElementById('btn-tambah-baris').addEventListener('click', function () {
    const tbody = document.querySelector('#tabel-detail tbody');
    const tr = document.createElement('tr');

    tr.className = 'item-row';

    tr.innerHTML = `
        <td>
            <select name="items[${rowIndex}][idbarang]" class="select-barang" required>
                ${barangOptions}
            </select>
        </td>
        <td>
            <input type="number" name="items[${rowIndex}][harga_satuan]"
                class="input-harga" min="0" value="0" required>
        </td>
        <td>
            <input type="number" name="items[${rowIndex}][jumlah]"
                class="input-jumlah" min="1" value="1" required>
        </td>
        <td>
            <input type="text" class="input-subtotal" value="Rp 0" readonly>
        </td>
        <td>
            <button type="button" class="btn btn-secondary"
                onclick="hapusBaris(this)">Hapus</button>
        </td>
    `;

    tbody.appendChild(tr);
    rowIndex++;
});

function hapusBaris(button) {
    const rows = document.querySelectorAll('#tabel-detail tbody .item-row');

    if (rows.length > 1) {
        button.closest('tr').remove();
        hitungTotalSemua();
    } else {
        alert('Minimal harus ada satu barang.');
    }
}

document.querySelector('#tabel-detail').addEventListener('input', function (e) {
    if (e.target.classList.contains('input-harga') ||
        e.target.classList.contains('input-jumlah')) {
        hitungBaris(e.target.closest('tr'));
    }
});

document.querySelector('#tabel-detail').addEventListener('change', function (e) {
    if (e.target.classList.contains('select-barang')) {
        const row = e.target.closest('tr');
        const option = e.target.options[e.target.selectedIndex];

        row.querySelector('.input-harga').value =
            option.getAttribute('data-harga') || 0;

        hitungBaris(row);
    }
});

function formatRupiah(angka) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
}

function hitungBaris(row) {
    const harga = Number(row.querySelector('.input-harga').value) || 0;
    const jumlah = Number(row.querySelector('.input-jumlah').value) || 0;

    const subtotal = harga * jumlah;

    row.querySelector('.input-subtotal').value = formatRupiah(subtotal);

    hitungTotalSemua();
}

function hitungTotalSemua() {
    let subtotal = 0;

    document.querySelectorAll('#tabel-detail tbody .item-row').forEach(row => {
        const harga = Number(row.querySelector('.input-harga').value) || 0;
        const jumlah = Number(row.querySelector('.input-jumlah').value) || 0;

        subtotal += harga * jumlah;
    });

    const ppn = Math.round(subtotal * 0.11);
    const total = subtotal + ppn;

    document.getElementById('label-subtotal').innerText = formatRupiah(subtotal);
    document.getElementById('label-ppn').innerText = formatRupiah(ppn);
    document.getElementById('label-total').innerText = formatRupiah(total);
}
</script>
@endsection
