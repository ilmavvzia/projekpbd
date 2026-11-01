
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Toko Kita')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,800&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --ink: #1c2736;
            --paper: #f5f2ea;
            --card: #ffffff;
            --line: #e3ddcf;
            --text: #1c2736;
            --muted: #6a7383;
            --accent: #2563eb;
            --accent-soft: #e8effd;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'IBM Plex Sans', sans-serif;
            background: var(--paper);
            color: var(--text);
            display: grid;
            grid-template-columns: 232px 1fr;
            min-height: 100vh;
        }

        aside {
            background: var(--ink);
            color: #dfe5ee;
            padding: 32px 18px;
            min-height: 100vh;
        }

        .brand {
            font-family: 'Fraunces', serif;
            font-size: 26px;
            font-weight: 800;
            color: #60a5fa;
            padding: 0 10px;
        }

        .brand-sub {
            font-size: 13px;
            color: #8c97a8;
            padding: 0 10px 28px;
        }

        nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        nav a {
            color: inherit;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 8px;
            border-left: 3px solid transparent;
        }

        nav a:hover { background: rgba(255,255,255,.06); }

        nav a.active {
            background: rgba(37,99,235,.22);
            border-left-color: var(--accent);
            color: white;
        }

        main {
            padding: 36px 40px 60px;
            min-width: 0;
        }

        h1, h2 {
            font-family: 'Fraunces', serif;
        }

        h1 { font-size: 34px; margin: 0 0 8px; }

        .sub { color: var(--muted); margin-bottom: 28px; }

        .panel {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .table-wrap {
            background: var(--card);
            border: 1px solid var(--line);
            border-radius: 18px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid var(--line);
        }

        th { color: var(--muted); font-size: 13px; }

        tbody tr:hover { background: var(--accent-soft); }

        input, select {
            padding: 10px 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
            width: 100%;
            font: inherit;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .form-group { margin-bottom: 18px; }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border: 0;
            border-radius: 8px;
            background: var(--accent);
            color: white;
            text-decoration: none;
            cursor: pointer;
            font: inherit;
        }

        .btn-secondary { display: inline-block;
    padding: 12px 16px;
    margin-left: 8px;
    background: #e9e5f5;
    color: #30245c;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
}

.btn-secondary:hover {
    background: #dcd4f2;
}

        .empty {
            text-align: center;
            color: var(--muted);
            padding: 35px;
        }

        @media(max-width: 900px) {
            body { grid-template-columns: 1fr; }
            aside { min-height: auto; }
            nav { flex-direction: row; flex-wrap: wrap; }
            main { padding: 24px 16px; }
        }
    </style>
</head>

<body>
    <aside>
        <div class="brand">Toko Kita</div>
        <div class="brand-sub">Pengelolaan toko</div>

        <nav>
            <a href="{{ url('/') }}">Dashboard</a>
            <a href="{{ route('barang.index') }}">Barang</a>
            <a href="{{ route('satuan.index') }}">Satuan</a>
            <a href="{{ route('role.index') }}">Role</a>
            <a href="{{ route('user.index') }}">User</a>
            <a href="{{ route('vendor.index') }}">Vendor</a>
            <a href="{{ route('pengadaan.index') }}">Pengadaan</a>
            <a href="{{ route('penerimaan.index') }}"
               class="{{ request()->is('penerimaan*') ? 'active' : '' }}">
                Penerimaan
            </a>
            <a href="{{ route('margin_penjualan.index') }}">Margin Penjualan</a>
        </nav>
    </aside>

    <main>
        @yield('content')
    </main>
</body>
</html>
