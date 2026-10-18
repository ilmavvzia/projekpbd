<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Master</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        h1 {
            margin-bottom: 8px;
        }

        h2 {
            margin-top: 35px;
            font-size: 21px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 25px;
        }

        .menu-master {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }

        .menu-master a {
            padding: 11px 16px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .menu-master a:hover {
            background: #1d4ed8;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .card {
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        }

        .card p {
            margin: 0 0 12px;
            color: #666;
        }

        .card h3 {
            margin: 0;
            font-size: 30px;
            color: #2563eb;
        }

        .table-container {
            overflow-x: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
        }

        th, td {
            padding: 12px 14px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #2563eb;
            color: white;
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .empty {
            text-align: center;
            color: #777;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            color: #777;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <h1>Dashboard Data Master</h1>
    <p class="subtitle">
        Sistem Informasi Pengelolaan Data Master
    </p>

    <!-- Menu navigasi -->
    <nav class="menu-master">
        <a href="{{ url('/') }}">Dashboard</a>
        <a href="{{ route('barang.index') }}">Barang</a>
        <a href="{{ route('satuan.index') }}">Satuan</a>
        <a href="{{ route('role.index') }}">Role</a>
        <a href="{{ route('user.index') }}">User</a>
        <a href="{{ route('vendor.index') }}">Vendor</a>
        <a href="{{ route('margin_penjualan.index') }}">
            Margin Penjualan
        </a>
    </nav>

    <!-- Ringkasan jumlah data -->
    <h2>Ringkasan Data Master</h2>

    <div class="cards">
        <div class="card">
            <p>Total Barang</p>
            <h3>{{ $barang->count() }}</h3>
        </div>

        <div class="card">
            <p>Total Satuan</p>
            <h3>{{ $satuan->count() }}</h3>
        </div>

        <div class="card">
            <p>Total Role</p>
            <h3>{{ $role->count() }}</h3>
        </div>

        <div class="card">
            <p>Total User</p>
            <h3>{{ $user->count() }}</h3>
        </div>

        <div class="card">
            <p>Total Vendor</p>
            <h3>{{ $vendor->count() }}</h3>
        </div>

        <div class="card">
            <p>Total Margin</p>
            <h3>{{ $margin->count() }}</h3>
        </div>
    </div>

    <!-- Tabel Barang dari VIEW v_brg -->
    <h2>Data Barang</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Jenis</th>
                    <th>Nama Barang</th>
                    <th>Nama Satuan</th>
                    <th>Status</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barang as $item)
                    <tr>
                        <td>{{ $item->idbarang }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nama_satuan ?? '-' }}</td>
                        <td>{{ $item->status }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada data barang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Satuan dari VIEW v_satuan -->
    <h2>Data Satuan</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Satuan</th>
                    <th>Nama Satuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($satuan as $item)
                    <tr>
                        <td>{{ $item->idsatuan }}</td>
                        <td>{{ $item->nama_satuan }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty">
                            Belum ada data satuan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Role dari VIEW v_role -->
    <h2>Data Role</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Role</th>
                    <th>Nama Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($role as $item)
                    <tr>
                        <td>{{ $item->idrole }}</td>
                        <td>{{ $item->nama_role }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="empty">
                            Belum ada data role.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel User dari VIEW v_user -->
    <h2>Data User</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Username</th>
                    <th>Nama Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $item)
                    <tr>
                        <td>{{ $item->iduser }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->nama_role ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="empty">
                            Belum ada data user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Vendor dari VIEW v_vendor -->
    <h2>Data Vendor</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Vendor</th>
                    <th>Nama Vendor</th>
                    <th>Badan Hukum</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vendor as $item)
                    <tr>
                        <td>{{ $item->idvendor }}</td>
                        <td>{{ $item->nama_vendor }}</td>
                        <td>{{ $item->badan_hukum }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="empty">
                            Belum ada data vendor.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tabel Margin Penjualan dari VIEW v_mrg_penjualan -->
    <h2>Data Margin Penjualan</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Margin</th>
                    <th>Tanggal Dibuat</th>
                    <th>Persentase</th>
                    <th>Status</th>
                    <th>Username</th>
                    <th>Tanggal Diperbarui</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($margin as $item)
                    <tr>
                        <td>{{ $item->idmargin_penjualan }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->persen }}%</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->username ?? '-' }}</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada data margin.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        Dashboard Sistem Informasi Data Master
    </div>

</body>
</html>
