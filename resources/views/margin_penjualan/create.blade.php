
@extends('layouts.app')

@section('title', 'Tambah Margin Penjualan')

@section('content')
<div class="panel">
    <h2>Tambah Margin Penjualan</h2>
    <p>Masukkan persentase margin, status, dan user yang mengelola margin.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('margin_penjualan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="persen">Persentase Margin (%)</label>
            <input
                type="number"
                id="persen"
                name="persen"
                min="0"
                max="100"
                step="0.01"
                value="{{ old('persen') }}"
                placeholder="Contoh: 10 atau 15.5"
                required
            >
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="iduser">User</label>
            <select id="iduser" name="iduser" required>
                <option value="">-- Pilih User --</option>

                @foreach ($users as $user)
                    <option
                        value="{{ $user->iduser }}"
                        {{ old('iduser') == $user->iduser ? 'selected' : '' }}
                    >
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Simpan Margin</button>

        <a href="{{ route('margin_penjualan.index') }}" class="btn btn-secondary">
            Batal
        </a>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
