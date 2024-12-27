<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Obat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f9;
            color: #333;
        }

        .sidebar {
            width: 250px;
            background-color:rgb(0, 56, 115);
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .sidebar h2 {
            padding-top: 5px;
            text-align: left;
            margin-bottom: 30px;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            margin: 10px 0;
            padding: 5px;
            border-radius: 5px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #007bff;
        }

        .main-content {
            position: relative;
            flex-grow: 1;
            padding: 20px;
            padding-top: 200px;
        }

        .main-content h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #003873;
        }

        .cards-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .card {
            width: 350px;
            padding: 20px;
            border-radius: 10px;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card h2 {
            font-size: 1.2em;
            margin-bottom: 15px;
            color: #003873;
        }

        .card p {
            font-size: 1em;
            margin-bottom: 20px;
            color: #333;
        }

        .card a {
            display: inline-block;
            text-decoration: none;
            color: white;
            background-color: #0056b3;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .card a:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Project Poliklinik</h2>
        <a href="Dashboard-Admin.html">Dashboard</a>
        <a href="Dokter.php">Dokter</a>
        <a href="Poli.php">Poli</a>
        <a href="Pasien.php">Pasien</a>
        <a href="Obat.php">Obat</a>
        <a href="Logout.php">Logout</a>
    </div>
    <div class="main-content">
        <h1>Halaman Obat</h1>
        <div class="cards-container">
            <div class="card">
                <h2>Tambah Obat</h2>
                <p>Tambahkan Daftar Obat Baru.</p>
                <a href="Daftar-Obat.php">Tambah Obat</a>
            </div>
            <div class="card">
                <h2>Edit Data Obat</h2>
                <p>Perbarui Informasi Obat.</p>
                <a href="DataEdit-Obat.php">Edit Data Obat</a>
            </div>
        </div>
    </div>
</body>
</html>
