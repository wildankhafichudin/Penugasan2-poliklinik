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

        .form-group input,
        .form-group select {
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
        function populateForm(id, hari, jam_mulai, jam_selesai, statusJadwal) {
            document.getElementById("id").value = id;
            document.getElementById("hari").value = hari;
            document.getElementById("jam_mulai").value = jam_mulai;
            document.getElementById("jam_selesai").value = jam_selesai;
            document.getElementById("statusJadwal").value = statusJadwal;
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
        <div class="form-container">
            <h3>Input Jadwal Periksa</h3>
            <form action="prosessJadwalPeriksa.php" method="POST">
                <!-- ID Dokter -->
                <div class="form-group">
                    <label for="id">ID Dokter</label>
                    <input type="text" id="id" name="id" value="<?php echo $_SESSION['id']; ?>" readonly>
                </div>

                <!-- Hari -->
                <div class="form-group">
                    <label for="hari">Hari</label>
                    <select id="hari" name="hari" required>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>

                <!-- Jam Mulai -->
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" step="60" required>
                </div>

                <!-- Jam Selesai -->
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" step="60" required>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="statusJadwal" name="statusJadwal" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" value="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
