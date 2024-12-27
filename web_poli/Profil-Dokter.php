<?php
session_start();

// Periksa apakah pasien sudah login
if (!isset($_SESSION['id'])) {
    header("Location: Login-Dokter.php");
    exit;
}

// Ambil data dari session
$nama = $_SESSION['nama'];
$passwordDokter = isset($_SESSION['passwordDokter']) ? $_SESSION['passwordDokter'] : 'Tidak Diketahui';
$nama_poli = isset($_SESSION['nama_poli']) ? $_SESSION['nama_poli'] : 'Tidak Diketahui';
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
            align-items: center;
            padding: 20px;
            background-color: #003873;
            color: #ffffff;
            flex: 1;
            overflow-y: auto;
        }

        .card {
            background-color: #001743;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: left;
            cursor: pointer;
        }

        .card h3 {
            font-size: 40px;
            margin-bottom: 30px;
        }
        
        .card h4 {
            line-height: 130%;
        }

        .card p {
            font-size: 18px;
            margin: 5px 0;
        }

        .form-container {
            background-color: #ffffff;
            color: #000;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .form-container h3 {
            font-size: 40px;
            margin-bottom: 30px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 15%;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        //Mendapatkan data card ke form input
        function fillForm(nama, password) {
            document.getElementById('nama').value = nama;
            document.getElementById('passwordDokter').value = password;
        }
    </script>
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

    <!-- Main Content -->
    <div class="content1">
        <!-- Card Dokter -->
        <div class="card" onclick="fillForm('<?php echo htmlspecialchars($nama); ?>', '<?php echo htmlspecialchars($passwordDokter); ?>')">
            <h3>Profil Dokter</h3>
            <h4>Nama : <?php echo htmlspecialchars($nama); ?></h4>
            <h4>Password : <?php echo htmlspecialchars($passwordDokter); ?></h4>
            <h4>Poli : <?php echo htmlspecialchars($nama_poli); ?></h4>
        </div>

        <!-- Form Update Data Dokter -->
        <div class="form-container">
            <h3>Update Data Dokter</h3>
            <form action="UpdateProfil-Dokter.php" method="POST">
                <div class="form-group">
                    <label for="nama">Nama Lengkap :</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap/Gelar Baru">
                </div>

                <div class="form-group">
                    <label for="passwordDokter">Password :</label>
                    <input type="text" id="passwordDokter" name="passwordDokter" placeholder="Masukkan Password Dokter Baru">
                </div>

                <div class="form-group">
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
