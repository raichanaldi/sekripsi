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
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #2C3E50;
            padding-top: 20px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            padding: 15px;
            text-align: center;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }
        .sidebar ul li:hover {
            background-color: #34495E;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .content h2 {
            color: #2C3E50;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .content table, th, td {
            border: 1px solid #ddd;
        }
        .content th, td {
            padding: 10px;
            text-align: left;
        }
        .content th {
            background-color: #f2f2f2;
        }
        .action-button {
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-right: 5px;
        }
        .btn-detail { background-color: #3498DB; }
        .btn-hapus { background-color: #E74C3C; }
        .btn-detail:hover, .btn-hapus:hover {
            opacity: 0.8;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #2C3E50;
            color: white;
            text-align: center;
            padding: 10px;
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
                <li><a href="{{ route('laporan.diterima') }}">Laporan Diterima</a></li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
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
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
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
    </div>

    <div class="footer">
        &copy; 2025 SMART Damkar Temanggung
    </div>

</body>
</html>