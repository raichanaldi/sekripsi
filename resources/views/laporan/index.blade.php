<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebakaran - Smart Damkar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .location-inputs {
            display: flex;
            justify-content: space-between;
        }

        .location-inputs input {
            width: 48%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Laporan Kebakaran - Smart Damkar</h2>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="nama_pelapor" placeholder="Nama Pelapor" required>
        </div>

        <div class="form-group">
            <input type="text" name="nama_lokasi" placeholder="Nama Lokasi" required>
        </div>

        <div class="form-group">
            <textarea name="keterangan" placeholder="Keterangan Kejadian" required></textarea>
        </div>

        <div class="form-group">
            <input type="file" name="foto">
        </div>

        <div class="form-group location-inputs">
            <input type="text" name="latitude" id="latitude" placeholder="Latitude" readonly required>
            <input type="text" name="longitude" id="longitude" placeholder="Longitude" readonly required>
        </div>

        <button type="submit">Kirim Laporan</button>
    </form>
</div>

<script>
if(navigator.geolocation){
    navigator.geolocation.getCurrentPosition(function(position){
        document.getElementById('latitude').value = position.coords.latitude;
        document.getElementById('longitude').value = position.coords.longitude;
    }, function(){
        alert("Gagal mendeteksi lokasi.");
    });
} else {
    alert("Geolocation tidak didukung browser Anda.");
}
</script>

</body>
</html>
