<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMART Damkar</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #2C3E50;
            height: 100vh;
            padding-top: 20px;
        }
        .sidebar h2 {
            color: white;
            text-align: center;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
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
        /* Content */
        .content {
            padding: 20px;
            width: 100%;
        }
        .content h1 {
            color: #2C3E50;
        }
        .content p {
            font-size: 18px;
            color: #7F8C8D;
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

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('laporan.masuk') }}">Laporan Masuk</a></li>
            <li><a href="{{ route('laporan.diterima') }}">Laporan Diterima</a></li>
            <li>
                <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:white; cursor:pointer; padding:0;">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="content">
        <h1>Selamat Datang, Admin!</h1>
        <p>Selamat datang di sistem SMART Damkar Kabupaten Temanggung.</p>
        <p>Gunakan sidebar untuk mengelola laporan kebakaran dan bencana.</p>
    </div>

    <div class="footer">
        &copy; 2025 SMART Damkar Kabupaten Temanggung
    </div>

</body>
</html>
