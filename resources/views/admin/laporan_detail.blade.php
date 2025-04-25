<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Kebakaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .map-link {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
            font-size: 16px;
        }

        .map-link:hover {
            text-decoration: underline;
        }

        img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Detail Laporan Kebakaran</h2>

    <div class="form-group">
        <p><strong>Nama Pelapor:</strong> {{ $laporan->nama_pelapor }}</p>
        <p><strong>Lokasi:</strong> {{ $laporan->nama_lokasi }}</p>
        <p><strong>Waktu Lapor:</strong> {{ $laporan->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Deskripsi:</strong> {{ $laporan->keterangan }}</p>
    </div>

    <div class="form-group">
        <p><strong>Foto Kejadian:</strong></p>
        <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto Kejadian" style="max-width:100%; border-radius:8px;">

    </div>

    <div class="form-group">
        <p><strong>Pos Damkar yang Bertugas:</strong> {{ $laporan->posDamkar->nama }}</p>
    </div>

    <div class="form-group">
        <p><strong>Akses Lokasi Kejadian:</strong></p>
        <a class="map-link" target="_blank"
           href="https://www.google.com/maps/search/?api=1&query={{ $laporan->latitude }},{{ $laporan->longitude }}">
           Lihat di Google Maps
        </a>
    </div>

    <div class="form-group">
        <p><strong>Rute dari Pos Damkar:</strong></p>
        <a class="map-link" target="_blank"
           href="https://www.google.com/maps/dir/?api=1&origin={{ $laporan->posDamkar->latitude }},{{ $laporan->posDamkar->longitude }}&destination={{ $laporan->latitude }},{{ $laporan->longitude }}">
           Lihat Rute di Google Maps
        </a>
    </div>

    <!-- Kembali Button -->
    <a href="{{ route('laporan.masuk') }}" class="back-button">Kembali</a>
</div>

</body>
</html>
