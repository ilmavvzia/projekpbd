@extends('layouts.app') {{-- Ganti dengan layout template Anda, misal: adminlte, master, dll --}}

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Buat Transaksi Pengadaan Baru</h4>
        <a href="{{ route('pengadaan.index') }}" class="btn btn-outline-secondary btn-sm">Kembali ke Daftar</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengadaan.store') }}" method="POST" id="form-pengadaan">
        @csrf

        <div class="row">
            <!-- Informasi Header Pengadaan -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white font-weight-bold">Informasi Vendor</div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label class="form-label" for="vendor_idvendor">Pilih Vendor <span class="text-danger">*</span></label>
                            <select name="vendor_idvendor" id="vendor_idvendor" class="form-select @error('vendor_idvendor') is-invalid @enderror" required>
                                <option value="">-- Pilih Vendor --</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->idvendor }}" {{ old('vendor_idvendor') == $vendor->idvendor ? 'selected' : '' }}>
                                        {{ $vendor->nama_vendor }}
                                    </option>
                                @endforeach
                            </select>
                            @error('vendor_idvendor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Tanggal Pengadaan</label>
                            <input type="text" class="form-control" value="{{ date('d F Y') }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Barang -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">Rincian Barang</span>
                        <button type="button" class="btn btn-primary btn-sm" id="btn-tambah-baris">+ Tambah Baris Barang</button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0" id="tabel-detail">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 35%;">Barang</th>
                                        <th style="width: 25%;">Harga Satuan (Rp)</th>
                                        <th style="width: 15%;">Jumlah</th>
                                        <th style="width: 20%;">Subtotal (Rp)</th>
                                        <th style="width: 5%;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="item-row">
                                        <td>
                                            <select name="items[0][idbarang]" class="form-select select-barang" required>
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach($barangs as $barang)
                                                    <option value="{{ $barang->idbarang }}" data-harga="{{ $barang->harga ?? 0 }}">
                                                        {{ $barang->nama }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="items[0][harga_satuan]" class="form-control input-harga" min="0" value="0" required>
                                        </td>
                                        <td>
                                            <input type="number" name="items[0][jumlah]" class="form-control input-jumlah" min="1" value="1" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control input-subtotal text-end" value="0" readonly>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-hapus" onclick="hapusBaris(this)">×</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Panel Rekapitulasi Pembayaran -->
                    <div class="card-footer bg-white">
                        <div class="row justify-content-end">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal Nilai:</span>
                                    <strong id="label-subtotal">Rp 0</strong>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">PPN (11%):</span>
                                    <strong id="label-ppn">Rp 0</strong>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex justify-content-between">
                                    <span class="h6 mb-0">Total Keseluruhan:</span>
                                    <strong class="h6 mb-0 text-primary" id="label-total">Rp 0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-success px-4">Simpan Pengadaan</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
let rowIndex = 1;

// Opsi barang dalam bentuk template string
const barangOptions = `
    <option value="">-- Pilih Barang --</option>
    @foreach($barangs as $barang)
        <option value="{{ $barang->idbarang }}" data-harga="{{ $barang->harga ?? 0 }}">
            {{ $barang->nama }}
        </option>
    @endforeach
`;

document.getElementById('btn-tambah-baris').addEventListener('click', function() {
    const tbody = document.querySelector('#tabel-detail tbody');
    const tr = document.createElement('tr');
    tr.className = 'item-row';
    tr.innerHTML = `
        <td>
            <select name="items[${rowIndex}][idbarang]" class="form-select select-barang" required>
                ${barangOptions}
            </select>
        </td>
        <td>
            <input type="number" name="items[${rowIndex}][harga_satuan]" class="form-control input-harga" min="0" value="0" required>
        </td>
        <td>
            <input type="number" name="items[${rowIndex}][jumlah]" class="form-control input-jumlah" min="1" value="1" required>
        </td>
        <td>
            <input type="text" class="form-control input-subtotal text-end" value="0" readonly>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-outline-danger btn-sm btn-hapus" onclick="hapusBaris(this)">×</button>
        </td>
    `;
    tbody.appendChild(tr);
    rowIndex++;
});

function hapusBaris(btn) {
    const rows = document.querySelectorAll('#tabel-detail tbody .item-row');
    if (rows.length > 1) {
        btn.closest('tr').remove();
        hitungTotalSemua();
    } else {
        alert('Minimal harus menyisakan 1 baris item.');
    }
}

// Event Delegation untuk mendeteksi perubahan input harga, jumlah, dan pilihan barang
document.querySelector('#tabel-detail').addEventListener('input', function(e) {
    if (e.target.classList.contains('input-harga') || e.target.classList.contains('input-jumlah')) {
        hitungBaris(e.target.closest('tr'));
    }
});

document.querySelector('#tabel-detail').addEventListener('change', function(e) {
    if (e.target.classList.contains('select-barang')) {
        const row = e.target.closest('tr');
        const selectedOption = e.target.options[e.target.selectedIndex];
        const defaultHarga = selectedOption.getAttribute('data-harga') || 0;
        
        row.querySelector('.input-harga').value = defaultHarga;
        hitungBaris(row);
    }
});

function hitungBaris(row) {
    const harga = parseFloat(row.querySelector('.input-harga').value) || 0;
    const jumlah = parseFloat(row.querySelector('.input-jumlah').value) || 0;
    const subtotal = harga * jumlah;

    row.querySelector('.input-subtotal').value = new Intl.NumberFormat('id-ID').format(subtotal);
    hitungTotalSemua();
}

function hitungTotalSemua() {
    let grandSubtotal = 0;
    const rows = document.querySelectorAll('#tabel-detail tbody .item-row');

    rows.forEach(row => {
        const harga = parseFloat(row.querySelector('.input-harga').value) || 0;
        const jumlah = parseFloat(row.querySelector('.input-jumlah').value) || 0;
        grandSubtotal += (harga * jumlah);
    });

    const ppn = Math.round(grandSubtotal * 0.11);
    const total = grandSubtotal + ppn;

    document.getElementById('label-subtotal').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandSubtotal);
    document.getElementById('label-ppn').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(ppn);
    document.getElementById('label-total').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}
</script>
@endsection