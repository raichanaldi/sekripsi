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
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #B22222; /* merah damkar */
            padding-top: 20px;
            flex-shrink: 0;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            text-align: center;
        }

        .sidebar ul li a, .sidebar ul li form button {
            color: white;
            text-decoration: none;
            display: block;
            background: none;
            border: none;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }

        .sidebar ul li:hover {
            background-color: #8B0000; /* merah gelap */
        }

        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: #fdf3f3;
        }

        .content h1 {
            color: #8B0000;
        }

        .content p {
            font-size: 18px;
            color: #5c5c5c;
        }

        .chart-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 40px;
            max-width: 100%;
        }

        canvas {
            width: 100% !important;
            height: 400px !important;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            width: calc(100% - 250px);
            background-color: #B22222;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
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

    <!-- Content -->
    <div class="content">
        <h1>Selamat Datang, Admin!</h1>
        <p>Kelola laporan kebakaran dan bencana melalui sistem SMART Damkar Temanggung.</p>

        <div class="chart-container">
            <h2 style="text-align:center;">Grafik Laporan Masuk per Bulan</h2>
            <canvas id="chartLaporan"></canvas>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        &copy; 2025 SMART Damkar Kabupaten Temanggung
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataLaporan = @json($dataBulan);

        const ctx = document.getElementById('chartLaporan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Laporan Masuk',
                    data: dataLaporan,
                    backgroundColor: 'rgba(255, 69, 0, 0.7)', // oranye merah
                    borderColor: 'rgba(178, 34, 34, 1)', // merah damkar
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
