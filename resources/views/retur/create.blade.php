
@extends('layouts.app')

@section('title', 'Tambah Retur - Toko Kita')

@section('content')

    <h1>Tambah Retur</h1>
    <p class="sub">Catat pengembalian barang dari transaksi penerimaan.</p>

    @if ($errors->any())
        <div class="panel">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="panel">
        <form action="{{ route('retur.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Pengguna</label>
                <select name="iduser" required>
                    <option value="">-- Pilih Pengguna --</option>

                    @foreach ($users as $user)
                        <option value="{{ $user->iduser }}">
                            {{ $user->username }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Detail Penerimaan / Barang</label>
                <select name="iddetail_penerimaan" required>
                    <option value="">-- Pilih Barang --</option>

                    @foreach ($detailPenerimaan as $detail)
                        <option value="{{ $detail->iddetail_penerimaan }}">
                            Penerimaan #{{ $detail->idpenerimaan }}
                            - {{ $detail->nama_barang }}
                            - Jumlah diterima: {{ $detail->jumlah_terima }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Jumlah Retur</label>
                <input
                    type="number"
                    name="jumlah"
                    min="1"
                    required
                    placeholder="Masukkan jumlah barang"
                >
            </div>

            <div class="form-group">
                <label>Alasan Retur</label>
                <textarea
                    name="alasan"
                    required
                    maxlength="200"
                    placeholder="Masukkan alasan pengembalian barang"
                ></textarea>
            </div>

            <button type="submit" class="btn">
                Simpan Retur
            </button>

            <a href="{{ route('retur.index') }}" class="btn">
                Kembali
            </a>
        </form>
    </div>

@endsection
