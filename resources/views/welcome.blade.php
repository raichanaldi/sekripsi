<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Smart Damkar Kabupaten Temanggung</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 800px;
        }
        .image-container {
            flex: 1;
        }
        img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .content {
            flex: 1;
            text-align: center; /* Center the text */
            margin-left: 20px;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .button {
            background-color: #e63946;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px 0;
            transition: background-color 0.3s;
            width: 100%;
        }
        .button:hover {
            background-color: #d62839;
        }
        .button-secondary {
            background-color: #457b9d;
        }
        .button-secondary:hover {
            background-color: #1d3557;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="image-container">
        <img src="https://i.pinimg.com/736x/4e/2c/a1/4e2ca15c0c8b471014ee501781308fcf.jpg" alt="Fire Truck">
    </div>
    <div class="content">
        <div class="header">SMART DAMKAR KABUPATEN TEMANGGUNG</div>
        <button class="button" onclick="window.location.href='{{ route('laporan.index') }}'">Buat Laporan</button>
        <button class="button button-secondary" onclick="window.location.href='{{ route('admin.login') }}'">Admin</button>
    </div>
</div>

</body>
</html>