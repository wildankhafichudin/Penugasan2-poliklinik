<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poliklinikbk";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data poli
$sql = "SELECT id, nama_poli FROM poli";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik - Daftar Dokter</title>
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
            background-color: rgb(0, 56, 115);
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
            flex-grow: 1;
            padding: 20px;
        }

        .main-content h1 {
            margin-bottom: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin: 20px auto;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input,
        .form-container select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            padding: 10px;
            background-color: #0056b3;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            width: 100px;
        }

        .form-container button:hover {
            background-color: #007bff;
        }
    </style>
    <script>
        function validateForm() {
            var nama = document.forms["FormDaftarDokter"]["nama"].value;
            var passwordDokter = document.forms["FormDaftarDokter"]["passwordDokter"].value;
            var alamat = document.forms["FormDaftarDokter"]["alamat"].value;
            var no_hp = document.forms["FormDaftarDokter"]["no_hp"].value;
            var id_poli = document.forms["FormDaftarDokter"]["id_poli"].value;

            if (nama == "" || passwordDokter == "" || alamat == "" || no_hp == "" || id_poli == "") {
                alert("Lengkapi Formulir Yang Masih Kosong!");
                return false;
            }

            return true;
        }
    </script>
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
        <h1>Daftar Dokter</h1>
        <div class="form-container">
            <form name="FormDaftarDokter" action="DFTRDokter.php" method="POST" onsubmit="return validateForm()">
                <label for="nama">Nama Dokter:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Dokter" required>

                <label for="passwordDokter">Password:</label>
                <input type="text" id="passwordDokter" name="passwordDokter" placeholder="Masukkan Password Dokter" required>

                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat Dokter" required>

                <label for="no_hp">No HP:</label>
                <input type="text" id="no_hp" name="no_hp" placeholder="Masukkan nomor HP Dokter" required>

                <label for="id_poli">Poli:</label>
                <select id="id_poli" name="id_poli" required>
                    <option value="">Pilih Poli</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nama_poli'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada data poli</option>";
                    }
                    ?>
                </select>

                <button type="submit" name="daftar" value="daftar">Daftar</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();
?>
