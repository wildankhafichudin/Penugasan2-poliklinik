<?php
session_start();

// Periksa apakah dokter sudah login
if (!isset($_SESSION['id'])) {
    header("Location: Login-Dokter.php");
    exit;
}

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "poliklinikbk";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari session
$nama = $_SESSION['nama'];
$nama_poli = isset($_SESSION['nama_poli']) ? $_SESSION['nama_poli'] : 'Tidak Diketahui'; // Default jika nama_poli tidak tersedia

// Ambil data pasien yang akan diperiksa berdasarkan nomor antrian yang ada
$query = "SELECT dp.no_antrian, p.nama AS pasien, dp.keluhan 
          FROM daftar_poli dp
          JOIN pasien p ON dp.id_pasien = p.id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Pasien</title>
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
            font-size: 30px;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            color: black;
            text-align: center;
            background-color:rgb(255, 255, 255);
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn-periksa {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }

        .btn-periksa:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard Dokter</h2>
        <a href="Dashboard-Dokter.php">Home</a>
        <a href="Profil-Dokter.php">Profil Saya</a>
        <a href="Dokter-Periksa-Pasien.php">Periksa Pasien</a>
        <a href="jadwalPeriksa.php">Jadwal Periksa</a>
        <a href="#">Riwayat Pasien</a>
        <a href="Logout-Dokter.php">Logout</a>
    </div>

    <div class="content1">
        <h1>Daftar Pasien yang Akan Diperiksa</h1>
        <table>
            <thead>
                <tr>
                    <th>No Antrian</th>
                    <th>Pasien</th>
                    <th>Keluhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['no_antrian'] . "</td>
                                <td>" . $row['pasien'] . "</td>
                                <td>" . $row['keluhan'] . "</td>
                                <td><button class='btn-periksa' onclick='periksaPasien(" . $row['no_antrian'] . ")'>Periksa</button></td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada pasien yang akan diperiksa.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function periksaPasien(noAntrian) {
            // Lakukan aksi periksa pasien, misalnya update status periksa pasien
            if (confirm('Apakah Anda yakin ingin memeriksa pasien dengan No Antrian: ' + noAntrian + '?')) {
                window.location.href = "Periksa-Pasien.php?no_antrian=" + noAntrian; // Redirect ke halaman periksa_pasien.php
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
