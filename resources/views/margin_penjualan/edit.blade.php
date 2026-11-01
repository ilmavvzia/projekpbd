
@extends('layouts.app')

@section('title', 'Edit Margin Penjualan')

@section('content')
<div class="panel">
    <h2>Edit Margin Penjualan</h2>
    <p>Ubah persentase margin, status, atau user yang mengelola margin.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('margin_penjualan.update', $margin->idmargin_penjualan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="persen">Persentase Margin (%)</label>
            <input
                type="number"
                id="persen"
                name="persen"
                min="0"
                max="100"
                step="0.01"
                value="{{ old('persen', $margin->persen) }}"
                required
            >
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="1"
                    {{ old('status', $margin->status) == '1' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0"
                    {{ old('status', $margin->status) == '0' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>
            </select>
        </div>

        <div class="form-group">
            <label for="iduser">User</label>
            <select id="iduser" name="iduser" required>
                @foreach ($users as $user)
                    <option
                        value="{{ $user->iduser }}"
                        {{ old('iduser', $margin->iduser) == $user->iduser ? 'selected' : '' }}
                    >
                        {{ $user->username }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn">Simpan Perubahan</button>

        <a href="{{ route('margin_penjualan.index') }}" class="btn btn-secondary">
            Batal
        </a>

        <a href="{{ url('/') }}" class="btn btn-secondary">
            Kembali ke Dashboard
        </a>
    </form>
</div>
@endsection
