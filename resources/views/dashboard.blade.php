<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>Dashboard Toko Kita</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,800&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
:root{
  --ink:#1c2736; --paper:#f5f2ea; --card:#ffffff; --line:#e3ddcf;
  --text:#1c2736; --muted:#6a7383; --accent:#2563eb; --accent-soft:#e8effd;
  --ok:#2f7d57; --ok-soft:#dcefe4; --off:#a9473a; --off-soft:#f6dfdb;
}
@media (prefers-color-scheme: dark){
  :root:not([data-theme="light"]){
    --ink:#0b1018; --paper:#121923; --card:#1a2330; --line:#2a3646;
    --text:#eef2f7; --muted:#9aa6b6; --accent:#60a5fa; --accent-soft:#1e2a44;
    --ok-soft:#1d3a2c; --off-soft:#3d2421;
  }
}
[hidden]{display:none !important}
*{box-sizing:border-box}
body{
  margin:0; font-family:'IBM Plex Sans',system-ui,sans-serif;
  background:var(--paper); color:var(--text);
  display:grid; grid-template-columns:232px 1fr; min-height:100vh; line-height:1.5;
}
h1,h2,.big{font-family:'Fraunces',Georgia,serif; font-weight:800; margin:0; letter-spacing:-.01em}

/* Sidebar */
aside{background:var(--ink); color:#dfe5ee; padding:32px 18px; position:sticky; top:0; height:100vh}
.brand{font-family:'Fraunces',Georgia,serif; font-size:26px; font-weight:800; color:var(--accent); padding:0 10px}
.brand-sub{font-size:13px; color:#8c97a8; padding:0 10px 28px}
nav{display:flex; flex-direction:column; gap:4px}
nav a{color:inherit; text-decoration:none; padding:10px 12px; border-radius:8px; font-size:15px; border-left:3px solid transparent}
nav a:hover{background:rgba(255,255,255,.06)}
nav a[aria-current="page"]{background:rgba(37,99,235,.22); border-left-color:var(--accent); color:#fff}
a:focus-visible, button:focus-visible, input:focus-visible{outline:2px solid var(--accent); outline-offset:2px}

/* Main */
main{padding:36px 40px 60px; min-width:0}
header.top{display:flex; justify-content:space-between; align-items:flex-end; gap:16px; flex-wrap:wrap; margin-bottom:28px}
h1{font-size:38px}
.sub{color:var(--muted); margin:4px 0 0}
.date{color:var(--muted); font-size:14px}

/* Hero */
.hero{display:grid; grid-template-columns:1.1fr 1.4fr; gap:20px; margin-bottom:20px}
.hero-num{background:var(--accent); color:#ffffff; border-radius:18px; padding:30px 32px;
  display:flex; flex-direction:column; justify-content:space-between; min-height:250px}
.hero-num .big{font-size:128px; line-height:.9}
.hero-num p{margin:0; font-size:16px; font-weight:500}
.panel{background:var(--card); border:1px solid var(--line); border-radius:18px; padding:24px}
.panel h2{font-size:20px; margin-bottom:4px}
.panel .hint{color:var(--muted); font-size:14px; margin:0 0 18px}

/* Grafik margin */
.bars{display:flex; align-items:flex-end; gap:12px; height:170px; padding-top:10px}
.bar{flex:1; display:flex; flex-direction:column; align-items:center; justify-content:flex-end; height:100%; min-width:0}
.bar-fill{width:100%; max-width:64px; background:var(--ink); border-radius:8px 8px 3px 3px; position:relative}
.bar-fill span{position:absolute; top:-24px; left:50%; transform:translateX(-50%); font-size:13px; font-weight:600; white-space:nowrap}
.bar small{margin-top:8px; font-size:12px; color:var(--muted); white-space:nowrap}
.bar.on .bar-fill{background:var(--accent)}

/* Statistik */
.stats{display:grid; grid-template-columns:repeat(auto-fit,minmax(150px,1fr)); gap:14px; margin-bottom:32px}
.stat{background:var(--card); border:1px solid var(--line); border-radius:14px; padding:16px 18px}
.stat b{display:block; font-family:'Fraunces',Georgia,serif; font-size:30px; font-weight:600; color:var(--accent)}
.stat span{color:var(--muted); font-size:14px}

/* Tabel */
.toolbar{display:flex; justify-content:space-between; align-items:center; gap:14px; flex-wrap:wrap; margin-bottom:14px}
.tabs{display:flex; gap:6px; flex-wrap:wrap}
.tabs button{font:inherit; font-size:14px; border:1px solid var(--line); background:var(--card); color:var(--text);
  padding:8px 14px; border-radius:999px; cursor:pointer}
.tabs button[aria-selected="true"]{background:var(--accent); color:#fff; border-color:var(--accent)}
input[type="search"]{font:inherit; font-size:14px; padding:9px 14px; border-radius:999px; border:1px solid var(--line);
  background:var(--card); color:var(--text); min-width:220px}
.table-wrap{background:var(--card); border:1px solid var(--line); border-radius:18px; overflow-x:auto}
table{width:100%; border-collapse:collapse; min-width:560px}
th,td{padding:14px 18px; text-align:left; border-bottom:1px solid var(--line); white-space:nowrap}
th{font-size:13px; font-weight:600; color:var(--muted)}
tbody tr:hover{background:var(--accent-soft)}
tbody tr:last-child td{border-bottom:0}
td.num{font-variant-numeric:tabular-nums; text-align:right}
th.num{text-align:right}
.pill{display:inline-block; padding:3px 10px; border-radius:999px; font-size:13px; font-weight:500}
.pill.on{background:var(--ok-soft); color:var(--ok)}
.pill.off{background:var(--off-soft); color:var(--off)}
.empty{text-align:center; color:var(--muted); padding:40px 18px}
footer{margin-top:36px; color:var(--muted); font-size:13px; text-align:center}

@media (max-width:900px){
  body{grid-template-columns:1fr}
  aside{position:static; height:auto; padding:20px 16px}
  .brand-sub{padding-bottom:14px}
  nav{flex-direction:row; overflow-x:auto; gap:6px}
  nav a{white-space:nowrap; border-left:0; border-bottom:3px solid transparent; border-radius:8px 8px 0 0}
  nav a[aria-current="page"]{border-bottom-color:var(--accent)}
  .hero{grid-template-columns:1fr}
}
@media (max-width:600px){
  main{padding:22px 16px 40px}
  h1{font-size:30px}
  .hero-num .big{font-size:96px}
}
@media (prefers-reduced-motion:no-preference){
  .hero-num{animation:rise .5s ease-out both}
  @keyframes rise{from{opacity:0; transform:translateY(8px)} to{opacity:1; transform:none}}
}
</style>
</head>
<body>

@php
  $aktif = fn($path) => request()->is($path) ? 'aria-current="page"' : '';
  $pill  = fn($s) => $s === 'aktif' ? 'on' : 'off';
  $maxPersen = $margin->max('persen') ?: 1;
  $barangAktif = $barang->where('status', 'aktif')->count();
@endphp

<aside>
  <div class="brand">Toko Kita</div>
  <div class="brand-sub">Pengelolaan toko</div>
  <nav aria-label="Menu utama">
    <a href="{{ url('/') }}" {!! request()->is('/') ? 'aria-current="page"' : '' !!}>Dashboard</a>
    <a href="{{ route('barang.index') }}" {!! $aktif('barang*') !!}>Barang</a>
    <a href="{{ route('satuan.index') }}" {!! $aktif('satuan*') !!}>Satuan</a>
    <a href="{{ route('role.index') }}" {!! $aktif('role*') !!}>Role</a>
    <a href="{{ route('user.index') }}" {!! $aktif('user*') !!}>User</a>
    <a href="{{ route('vendor.index') }}" {!! $aktif('vendor*') !!}>Vendor</a>
    <a href="{{ route('pengadaan.index') }}" {!! $aktif('pengadaan*') !!}>Pengadaan</a>
    <a href="{{ route('penerimaan.index') }}" {!! $aktif('penerimaan*') !!}>Penerimaan</a>
    <a href="{{ route('margin_penjualan.index') }}" {!! $aktif('margin*') !!}>Margin Penjualan</a>
  </nav>
</aside>

<main>
  <header class="top">
    <div>
      <h1>Halo, selamat datang</h1>
      <p class="sub">Ringkasan data master toko hari ini</p>
    </div>
    <div class="date">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</div>
  </header>

  <section class="hero" aria-label="Ringkasan utama">
    <div class="hero-num">
      <p>Produk aktif di katalog</p>
      <div class="big">{{ $barang->count() }}</div>
      <p>{{ $barangAktif }} aktif, {{ $barang->count() - $barangAktif }} nonaktif dari total {{ $barang->count() }} barang</p>
    </div>

    <div class="panel">
      <h2>Margin penjualan</h2>
      <p class="hint">Persentase margin per aturan. Batang biru berarti aturan aktif.</p>
      <div class="bars">
        @forelse ($margin as $m)
          <div class="bar {{ $m->status === 'aktif' ? 'on' : '' }}">
            <div class="bar-fill" style="height: {{ ($m->persen / $maxPersen) * 100 }}%">
              <span>{{ $m->persen }}%</span>
            </div>
            <small>{{ \Carbon\Carbon::parse($m->created_at)->format('d M') }}</small>
          </div>
        @empty
          <p class="empty">Belum ada data margin.</p>
        @endforelse
      </div>
    </div>
  </section>

  <section class="stats" aria-label="Jumlah data">
    <div class="stat"><b>{{ $satuan->count() }}</b><span>Total Satuan</span></div>
    <div class="stat"><b>{{ $role->count() }}</b><span>Total Role</span></div>
    <div class="stat"><b>{{ $user->count() }}</b><span>Total User</span></div>
    <div class="stat"><b>{{ $vendor->count() }}</b><span>Total Vendor</span></div>
    <div class="stat"><b>{{ $margin->count() }}</b><span>Total Margin</span></div>
  </section>

  <section>
    <div class="toolbar">
      <div class="tabs" role="tablist" id="tabs">
        <button type="button" role="tab" data-tab="barang" aria-selected="true">Barang</button>
        <button type="button" role="tab" data-tab="satuan" aria-selected="false">Satuan</button>
        <button type="button" role="tab" data-tab="role" aria-selected="false">Role</button>
        <button type="button" role="tab" data-tab="user" aria-selected="false">User</button>
        <button type="button" role="tab" data-tab="vendor" aria-selected="false">Vendor</button>
        <button type="button" role="tab" data-tab="margin" aria-selected="false">Margin</button>
      </div>
      <input type="search" id="q" placeholder="Cari di tabel…" aria-label="Cari data">
    </div>

    {{-- Barang --}}
    <div class="table-wrap tab-panel" id="panel-barang">
      <table>
        <thead><tr>
          <th>ID Barang</th><th>Jenis</th><th>Nama Barang</th><th>Nama Satuan</th><th>Status</th><th class="num">Harga</th>
        </tr></thead>
        <tbody>
          @forelse ($barang as $item)
            <tr data-row>
              <td>{{ $item->idbarang }}</td>
              <td>{{ $item->jenis }}</td>
              <td>{{ $item->nama }}</td>
              <td>{{ $item->nama_satuan ?? '-' }}</td>
              <td><span class="pill {{ $pill($item->status) }}">{{ $item->status }}</span></td>
              <td class="num">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            </tr>
          @empty
            <tr><td colspan="6" class="empty">Belum ada data barang.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Satuan --}}
    <div class="table-wrap tab-panel" id="panel-satuan" hidden>
      <table>
        <thead><tr>
          <th>ID Satuan</th><th>Nama Satuan</th><th>Status</th>
        </tr></thead>
        <tbody>
          @forelse ($satuan as $item)
            <tr data-row>
              <td>{{ $item->idsatuan }}</td>
              <td>{{ $item->nama_satuan }}</td>
              <td><span class="pill {{ $pill($item->status) }}">{{ $item->status }}</span></td>
            </tr>
          @empty
            <tr><td colspan="3" class="empty">Belum ada data satuan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Role --}}
    <div class="table-wrap tab-panel" id="panel-role" hidden>
      <table>
        <thead><tr>
          <th>ID Role</th><th>Nama Role</th>
        </tr></thead>
        <tbody>
          @forelse ($role as $item)
            <tr data-row>
              <td>{{ $item->idrole }}</td>
              <td>{{ $item->nama_role }}</td>
            </tr>
          @empty
            <tr><td colspan="2" class="empty">Belum ada data role.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- User --}}
    <div class="table-wrap tab-panel" id="panel-user" hidden>
      <table>
        <thead><tr>
          <th>ID User</th><th>Username</th><th>Nama Role</th>
        </tr></thead>
        <tbody>
          @forelse ($user as $item)
            <tr data-row>
              <td>{{ $item->iduser }}</td>
              <td>{{ $item->username }}</td>
              <td>{{ $item->nama_role ?? '-' }}</td>
            </tr>
          @empty
            <tr><td colspan="3" class="empty">Belum ada data user.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Vendor --}}
    <div class="table-wrap tab-panel" id="panel-vendor" hidden>
      <table>
        <thead><tr>
          <th>ID Vendor</th><th>Nama Vendor</th><th>Badan Hukum</th><th>Status</th>
        </tr></thead>
        <tbody>
          @forelse ($vendor as $item)
            <tr data-row>
              <td>{{ $item->idvendor }}</td>
              <td>{{ $item->nama_vendor }}</td>
              <td>{{ $item->badan_hukum }}</td>
              <td><span class="pill {{ $pill($item->status) }}">{{ $item->status }}</span></td>
            </tr>
          @empty
            <tr><td colspan="4" class="empty">Belum ada data vendor.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Margin --}}
    <div class="table-wrap tab-panel" id="panel-margin" hidden>
      <table>
        <thead><tr>
          <th>ID Margin</th><th>Tanggal Dibuat</th><th class="num">Persentase</th><th>Status</th><th>Username</th><th>Tanggal Diperbarui</th>
        </tr></thead>
        <tbody>
          @forelse ($margin as $item)
            <tr data-row>
              <td>{{ $item->idmargin_penjualan }}</td>
              <td>{{ $item->created_at }}</td>
              <td class="num">{{ $item->persen }}%</td>
              <td><span class="pill {{ $pill($item->status) }}">{{ $item->status }}</span></td>
              <td>{{ $item->username ?? '-' }}</td>
              <td>{{ $item->updated_at }}</td>
            </tr>
          @empty
            <tr><td colspan="6" class="empty">Belum ada data margin.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </section>

  <footer>Dashboard Sistem Informasi Data Master</footer>
</main>

<script>
  const tabs = document.querySelectorAll('#tabs button');
  const search = document.getElementById('q');

  function showTab(key) {
    tabs.forEach(b => b.setAttribute('aria-selected', b.dataset.tab === key));
    document.querySelectorAll('.tab-panel').forEach(p => p.hidden = p.id !== 'panel-' + key);
    search.value = '';
    filterRows();
  }

  function filterRows() {
    const q = search.value.trim().toLowerCase();
    document.querySelectorAll('.tab-panel:not([hidden]) tbody tr[data-row]').forEach(tr => {
      tr.hidden = q !== '' && !tr.textContent.toLowerCase().includes(q);
    });
  }

  tabs.forEach(b => b.addEventListener('click', () => showTab(b.dataset.tab)));
  search.addEventListener('input', filterRows);
</script>
</body>
</html>