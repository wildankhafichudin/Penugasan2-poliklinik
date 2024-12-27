<?php
session_start();

// Periksa apakah pasien sudah login
if (!isset($_SESSION['id'])) {
    header("Location: Login-Pasien.php");
    exit;
}

// Ambil data dari session
$no_rm = $_SESSION['no_rm'];
$nama = $_SESSION['nama'];

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "poliklinikbk");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data dokter, poli, dan jadwal periksa
$query = "SELECT d.nama AS nama_dokter, p.nama_poli, j.hari, j.jam_mulai, j.jam_selesai
          FROM jadwal_periksa j
          JOIN dokter d ON d.id = j.id_dokter
          JOIN poli p ON p.id = d.id_poli";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien</title>
    <style>
                      * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            height: 100%;
            background-color: #003873;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #001743;
            color: #ffffff;
        }

        .header h2 {
          position: relative;
          margin-left: 80px;
          margin: 0;
          font-size: 24px;
        }

        .header .right {
          display: flex;
          align-items: center;
          gap: 15px;
        }

        .header .logout {
          background-color: #ff4d4d;
          border: none;
          padding: 8px 16px;
          color: white;
          font-weight: bold;
          border-radius: 5px;
          cursor: pointer;
          text-transform: uppercase;
        }

        .content1 {
          margin-top: 100px;
          text-align: center;
          margin-top: 20px;
        }

        .content1 h1 {
          font-size: 32px;
          margin: 10px 0;
        }

        .content1 h3 {
          font-size: 30px;
          margin: 5px 0;
          color: #ffcc00;
        }

        .main-content {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          padding: 20px;
          height: 500px;
          background-color: #ffffff;
          margin-top: 30px;
        }

        .explanation {
          font-family: Arial, sans-serif;
          text-align: center;
          margin-bottom: 50px;
          font-size: 18px;
          color: rgb(0, 0, 0);
          padding: 0 20px;
          width: 60%;
        }

        .card h2 {
          margin: 0;
          margin-top: 20px;
          font-size: 24px;
          color: white;
        }

        .card .btn {
          margin-top: 30px;
          background-color: #ffcc00;
          color: #003873;
          border: none;
          padding: 10px 20px;
          font-size: 16px;
          font-weight: bold;
          border-radius: 5px;
          cursor: pointer;
          text-transform: uppercase;
        }

        .header p {
            font-size: 1.5em;
            font-weight: bold;
        }

        .content1 {
            height: 300px;
            margin: 50px 0;
        }

        .content1 h1 {
            padding-top: 70px;
            font-size: 50px;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .content1 a {
            font-size: 1.2em;
            text-decoration: none;
            color: white;
            padding: 10px 20px;
        }

        .cards-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 20px;
            width: 90%;
        }

        .card {
          display: flex;
          flex-direction: column;
          align-items: center;
          width: 30%;
          padding: 20px;
          border-radius: 10px;
          background-color: rgb(16, 73, 164);
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          text-align: center;
        }

        .card h2 {
            font-size: 30px;
            color: #ffffff;
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
            background-color:rgb(255, 255, 255);
        }

        .footer {
            background-color: #000000;
            height: 100px;
            text-align: center;
            padding: 40px 60px;
            color: #ffffff;
            font-size: 15px;
            text-align: center;
        }
        /* Tambahkan style untuk tabel */
        .content2 table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        .content2 table th, .content2 table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        .content2 table th {
            background-color:rgb(201, 130, 0);
            font-size: 20px;
            color: black;
            font-weight: bold;
        }

        .content2 h1 {
            text-align: center;
            margin-top: 20px;
            color: #ffffff;
        }
    </style>
</head>
<body>
  <!-- Header -->
  <div class="header">
    <h2>Dashboard Pasien</h2>
    <div class="right">
      <span>No Rekam Medis Anda : <?php echo htmlspecialchars($no_rm); ?></span>
      <button class="logout" onclick="window.location.href='Logout-Pasien.php'">Keluar</button>
    </div>
  </div>

  <!-- Content 1 -->
  <div class="content1">
    <h1>Selamat Datang!</h1>
    <h3><?php echo htmlspecialchars($nama); ?></h3>
  </div>

  <!-- Content 2 -->
  <div class="content2">
    <h1>Jadwal Praktikum Dokter</h1>
    <table>
      <thead>
        <tr>
          <th>Nama Dokter</th>
          <th>Poli</th>
          <th>Hari</th>
          <th>Jam Mulai</th>
          <th>Jam Selesai</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['nama_dokter']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_poli']) . "</td>";
                echo "<td>" . htmlspecialchars($row['hari']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jam_mulai']) . "</td>";
                echo "<td>" . htmlspecialchars($row['jam_selesai']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data jadwal periksa.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <p class="explanation">
      Silakan mendaftar ke poliklinik yang Anda butuhkan dengan menekan tombol 'Daftar' di bawah ini. 
      Pastikan data Anda telah diperbarui dan lengkap untuk mempermudah proses pendaftaran.
    </p>
    <div class="cards-container">
        <div class="card">
            <h2>Poli Anak</h2>
            <a href="Daftar-Poli Anak.php" class="btn">Daftar</a>
        </div>
        <div class="card">
            <h2>Poli Umum</h2>
            <a href="Daftar-Poli Umum.php" class="btn">Daftar</a>
        </div>
        <div class="card">
            <h2>Poli Gigi</h2>
            <a href="Daftar-Poli Gigi.php" class="btn">Daftar</a>
        </div>
    </div>
  </div>

  <footer class="footer">
      © 2024 All Rights Reserved - Wildan Khafichudin
  </footer>

</body>
</html>
<?php
// Tutup koneksi database
$conn->close();
?>
