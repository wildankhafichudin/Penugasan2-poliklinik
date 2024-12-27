<?php
session_start();

// Periksa apakah pasien sudah login
if (!isset($_SESSION['id'])) {
    header("Location: Login-Dokter.php");
    exit;
}

// Ambil data dari session
$nama = $_SESSION['nama'];
$nama_poli = isset($_SESSION['nama_poli']) ? $_SESSION['nama_poli'] : 'Tidak Diketahui'; // Default jika nama_poli tidak tersedia
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            background-color: #003873;
        }

        .sidebar {
            width: 250px;
            background-color: #001743;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
            height: 100%;
        }

        .sidebar h2 {
            position: relative;
            margin-left: 80px;
            margin: 0;
            font-size: 24px;
            margin-top: 30px;
            margin-bottom: 150px;
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

        .content1 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #003873;
            color: #ffffff;
            flex: 1;
        }

        .content1 h1 {
            font-size: 80px;
            margin: 10px 0;
        }

        .content1 h3 {
            font-size: 50px;
            margin: 5px 0;
            color: #ffcc00;
        }

        .content1 h4 {
            font-size: 25px;
            margin: 5px 0;
            color: #ffcc00;
        }

        .footer {
            background-color: #000000;
            text-align: center;
            padding: 20px;
            color: #ffffff;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
      <h2>Dashboard Dokter</h2>
        <a href="Dashboard-Dokter.php">Home</a>
        <a href="Profil-Dokter.php">Profil Saya</a>
        <a href="Dokter-Periksa Pasien.php">Periksa Pasien</a>
        <a href="jadwalPeriksa.php">Jadwal Periksa</a>
        <a href="#">Riwayat Pasien</a>
        <a href="Logout-Dokter.php">Logout</a>
    </div>
    <div class="content1">
        <h1>Selamat Datang!</h1>
        <h3><?php echo htmlspecialchars($nama); ?></h3>
        <h4>Poli Anda : <?php echo htmlspecialchars($nama_poli); ?></h4>
    </div>
</body>
</html>
