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

// Ambil data pasien berdasarkan no_antrian
$no_antrian = isset($_GET['no_antrian']) ? $_GET['no_antrian'] : ''; // Ambil no_antrian dari URL

$query_pasien = "SELECT dp.no_antrian, p.nama AS pasien, dp.keluhan, dp.id AS id_daftar_poli, p.id AS id_pasien
                 FROM daftar_poli dp
                 JOIN pasien p ON dp.id_pasien = p.id";

$result_pasien = $conn->query($query_pasien);

// Cek jika data pasien tidak ditemukan
if ($result_pasien->num_rows == 0) {
    echo "Pasien dengan nomor antrian tersebut tidak ditemukan.";
    exit;
}

$pasien = $result_pasien->fetch_assoc();

// Ambil daftar obat
$query_obat = "SELECT id, nama_obat, harga FROM obat";
$result_obat = $conn->query($query_obat);

// Proses form saat disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pasien = $_POST['id'];
    $id_daftar_poli = $_POST['id_daftar_poli'];
    $tanggal_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['catatan'];
    $id_obat = $_POST['obat'];

    // Validasi jika obat dipilih
    if (empty($id_obat)) {
        echo "Obat harus dipilih.";
        exit;
    }

    // Ambil harga obat
    $query_harga_obat = "SELECT harga FROM obat WHERE id = '$id_obat'";
    $result_harga = $conn->query($query_harga_obat);

    // Cek jika harga obat tidak ditemukan
    if ($result_harga->num_rows == 0) {
        echo "Harga obat tidak ditemukan.";
        exit;
    }

    $harga_obat = $result_harga->fetch_assoc()['harga'];

    // Biaya jasa dokter
    $biaya_jasa_dokter = 150000;

    // Total harga
    $biaya_periksa = $harga_obat + $biaya_jasa_dokter;

    // Simpan data pemeriksaan ke database
    $query_insert = "INSERT INTO periksa (id, tgl_periksa, catatan, biaya_periksa)
                     VALUES ('$id_daftar_poli', '$tanggal_periksa', '$catatan', '$biaya_periksa')";

    if ($conn->query($query_insert)) {
        echo "<script>alert('Pemeriksaan berhasil dilakukan!'); window.location.href = 'Periksa-Pasien.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Periksa Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Form Pemeriksaan Pasien</h2>
    <form method="POST" action="Periksa-Pasien.php?no_antrian=<?php echo $pasien['no_antrian']; ?>">
        
        <label for="pasien">Nama Pasien</label>
        <input type="text" id="pasien" name="pasien" value="<?php echo $pasien['pasien']; ?>" disabled>
        
        <label for="tanggal_periksa">Tanggal Periksa</label>
        <input type="date" id="tanggal_periksa" name="tgl_periksa" required>
        
        <label for="catatan">Catatan</label>
        <textarea id="catatan" name="catatan" rows="4" required></textarea>
        
        <label for="obat">Obat</label>
        <select id="obat" name="obat" required>
            <option value="">Pilih Obat</option>
            <?php
            while ($row = $result_obat->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "' data-harga='" . $row['harga'] . "'>" . $row['nama_obat'] . " - Rp. " . number_format($row['harga'], 0, ',', '.') . "</option>";
            }
            ?>
        </select>
        
        <label for="biaya_periksa">Total Harga</label>
        <input type="text" id="biaya_periksa" name="biaya_periksa" value="Rp. 150.000" disabled>
        
        <button type="submit">Simpan Pemeriksaan</button>
    </form>
</div>

<script>
    // Update total harga saat obat dipilih
    document.getElementById('obat').addEventListener('change', function() {
        var hargaObat = parseFloat(this.options[this.selectedIndex].getAttribute('data-harga')) || 0;
        var biayaJasaDokter = 150000;
        var totalHarga = hargaObat + biayaJasaDokter;
        document.getElementById('biaya_periksa').value = 'Rp. ' + totalHarga.toLocaleString();
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
