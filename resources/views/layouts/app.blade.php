<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Tambahkan stylesheet atau link ke CSS di sini -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <header>
        <!-- Contoh header -->
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.logout') }}">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Tempat untuk konten dinamis -->
        @yield('content')
    </main>

    <footer>
        <!-- Contoh footer -->
        <p>© 2025 SMART Damkar Kabupaten Temanggung</p>
    </footer>

</body>
</html>

