<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poliklinik - Tambah Obat</title>
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
            var nama_obat = document.forms["FormObat"]["nama_obat"].value;
            var kemasan = document.forms["FormObat"]["kemasan"].value;
            var harga = document.forms["FormObat"]["harga"].value;

            if (nama_obat == "" || kemasan == "" || harga == "") {
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
        <h1>Tambah Obat</h1>
        <div class="form-container">
            <form class="FormObat" action="DFTRObat.php" method="POST">
                <label for="nama_obat">Nama Obat:</label>
                <input type="text" id="nama_obat" name="nama_obat" placeholder="Masukkan Nama Obat" required>

                <label for="kemasan">Kemasan:</label>
                <select id="kemasan" name="kemasan" required>
                    <option value="" disabled selected>Pilih Jenis Kemasan</option>
                    <option value="Ampul">Ampul</option>
                    <option value="Blister">Blister</option>
                    <option value="Botol">Botol</option>
                    <option value="Sachet">Sachet</option>
                    <option value="Strip">Strip</option>
                    <option value="Vial">Vial</option>
                </select>

                <label for="harga">Harga:</label>
                <input type="text" id="harga" name="harga" placeholder="Masukkan Harga Obat" required>

                <div class="button-container">
                    <button type="submit" class="btn-update" name="submit" value="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
