<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebakaran - Smart Damkar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #e63946, #1d3557); /* Gradien merah dan biru gelap untuk tema Damkar */
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
            border: 2px solid #e63946; /* Red Border to emphasize Fire theme */
        }

        h2 {
            text-align: center;
            color: #e63946; /* Fire Red color */
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        input[type="text"], textarea, input[type="file"] {
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

        button {
            width: 100%;
            padding: 12px;
            background-color: #e63946; /* Fire Red color */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #d62839; /* Darker red on hover */
        }

        .location-inputs {
            display: flex;
            justify-content: space-between;
        }

        .location-inputs input {
            width: 48%;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .success-message {
            color: green;
            font-size: 16px;
            margin-bottom: 15px;
        }

        /* Adding a firetruck icon at the top for better branding */
        .firetruck-icon {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            text-decoration: none;
            color: #e63946;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Firetruck icon to represent Damkar theme -->
    <img src="https://www.example.com/firetruck-icon.png" alt="Firetruck" class="firetruck-icon">

    <h2>Laporan Kebakaran - Smart Damkar</h2>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error-message">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input type="text" name="nama_pelapor" placeholder="Nama Pelapor" value="{{ old('nama_pelapor') }}" required>
        </div>

        <div class="form-group">
            <input type="text" name="nama_lokasi" placeholder="Nama Lokasi" value="{{ old('nama_lokasi') }}" required>
        </div>

        <div class="form-group">
            <textarea name="keterangan" placeholder="Keterangan Kejadian" required>{{ old('keterangan') }}</textarea>
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

    <a href="/" class="back-link">&#8592; Kembali ke Halaman Utama</a>
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
