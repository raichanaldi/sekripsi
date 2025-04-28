<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Laporan Diterima - SMART Damkar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #B22222; /* merah damkar */
            padding-top: 20px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            text-align: center;
        }

        .sidebar ul li a,
        .sidebar ul li form button {
            color: white;
            text-decoration: none;
            font-size: 16px;
            background: none;
            border: none;
            width: 100%;
            display: block;
            cursor: pointer;
        }

        .sidebar ul li:hover {
            background-color: #8B0000;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #fdf3f3;
        }

        .content h2 {
            color: #8B0000;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #FF6347; /* oranye damkar */
            color: white;
        }

        tr:hover {
            background-color: #ffe5e5;
        }

        .action-button {
            padding: 6px 12px;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        .btn-detail {
            background-color: #3498DB;
        }

        .btn-hapus {
            background-color: #E74C3C;
        }

        .btn-detail:hover, .btn-hapus:hover {
            opacity: 0.85;
        }

        .footer {
            background-color: #B22222;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            left: 250px;
            width: calc(100% - 250px);
        }
    </style>
</head>
<body>

<div class="sidebar">
        <div>
            <h2>SMART Damkar</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('laporan.masuk') }}">Laporan Masuk</a></li>
                <li><a href="{{ route('admin.laporan.diterima') }}">Laporan Diterima</a></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h2>Laporan Diterima</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelapor</th>
                    <th>Lokasi</th>
                    <th>Tanggal Laporan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporanDiterima as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $laporan->nama_pelapor }}</td>
                        <td>{{ $laporan->nama_lokasi }}</td>
                        <td>{{ $laporan->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            <a href="{{ route('laporan.show', $laporan->id) }}" class="action-button btn-detail">Lihat Detail</a>
                            <form action="{{ route('laporan.hapus', $laporan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-button btn-hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination links -->
        <div class="pagination">
            {{ $laporanDiterima->links() }}
        </div>
    </div>

    <div class="footer">
        &copy; 2025 SMART Damkar Kabupaten Temanggung
    </div>

</body>
</html>
