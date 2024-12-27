<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik - Daftar Pasien</title>
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
    function populateForm(id, nama, alamat, no_ktp, no_hp, passwordPasien, no_rm) {
        document.getElementById("id").value = id;
        document.getElementById("nama").value = nama;
        document.getElementById("alamat").value = alamat;
        document.getElementById("no_ktp").value = no_ktp;
        document.getElementById("no_hp").value = no_hp;
        document.getElementById("passwordPasien").value = passwordPasien;
        document.getElementById("no_rm").value = no_rm;
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
        <h1>Daftar Pasien</h1>
        <div class="form-container">
            <form action="DFTRPasien.php" method="POST">

                <label for="nama">Nama Pasien:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Pasien" required>

                <label for="alamat">Alamat:</label>
                <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat Pasien" required>

                <label for="no_ktp">No KTP:</label>
                <input type="text" id="no_ktp" name="no_ktp" placeholder="Masukkan Nomor KTP" required>

                <label for="no_hp">No HP:</label>
                <input type="text" id="no_hp" name="no_hp" placeholder="Masukkan Nomor HP Pasien" required>

                <label for="passwordPasien">Password:</label>
                <input type="text" id="passwordPasien" name="passwordPasien" placeholder="Masukkan Password Pasien" required>

                <label for="no_rm">No Rekam Medis:</label>
                <input type="text" id="no_rm" name="no_rm" placeholder="Masukkan Nomor Rekam Medis" readonly>

                <div class="button-container">
                    <button type="submit" class="btn-update" name="submit" value="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
