<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SMART Damkar Temanggung</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Roboto', sans-serif; margin: 0; display: flex; min-height: 100vh; }
        .sidebar { width: 240px; background: #e63946; color: #fff; display: flex; flex-direction: column; }
        .sidebar h2 { padding: 20px; margin: 0; background: #d62839; text-align: center; }
        .sidebar a { color: white; padding: 15px 20px; display: block; text-decoration: none; }
        .sidebar a:hover { background: #a4161a; }
        .content { flex-grow: 1; padding: 20px; background: #f7f7f7; }
        .logout { margin-top: auto; background: #a4161a; text-align: center; }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>SMART Damkar</h2>
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <a href="{{ route('laporan.masuk') }}">Laporan Masuk</a>
    <form action="{{ route('logout') }}" method="POST" class="logout">
        @csrf
        <button type="submit" style="width:100%;border:none;padding:15px;background:#a4161a;color:white;cursor:pointer;">Logout</button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
