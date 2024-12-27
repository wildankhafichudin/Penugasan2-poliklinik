<?php
session_start();

// Periksa apakah ID Pasien sudah ada di session
if (!isset($_SESSION['id'])) {
    header("Location: Login-Pasien.php");
    echo "Error: ID Pasien tidak ditemukan. Silakan login terlebih dahulu.";
    exit;
}

// Fungsi untuk menghasilkan nomor antrian
function generateNomorAntrian($id_pasien) {
  // Ambil nomor antrian terakhir dari database (misalnya, berdasarkan ID pasien)
  // Misalnya kita akan mengambil nomor antrian terakhir dan menambahkannya dengan 1
  global $conn; // Menggunakan koneksi global jika dibutuhkan

  // Jika tidak ada nomor antrian sebelumnya, mulai dari 000
  $lastAntrian = $row['last_antrian'] ?? 0;

  // Generate nomor antrian baru dengan format 3 digit
  $newAntrian = str_pad($lastAntrian + 1, 3, "0", STR_PAD_LEFT);

  return $newAntrian;
}

// Auto-generate nomor antrian
$nomor_antrian = generateNomorAntrian($_SESSION['id']);


// Koneksi ke database
$servername = "localhost"; // Sesuaikan dengan konfigurasi database Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "poliklinikbk"; // Sesuaikan dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data jadwal dari tabel jadwal_periksa
$sql = "SELECT id, hari, jam_mulai, jam_selesai FROM jadwal_periksa";
$result = $conn->query($sql);

$jadwal_options = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jadwal_options[] = $row;
    }
} else {
    echo "Tidak ada jadwal yang tersedia.";
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Daftar Poli</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <script>
    function validateForm() {
      var keluhan = document.forms["poliForm"]["keluhan"].value;

      if (keluhan == "") {
        alert("Harap isi keluhan Anda!");
        return false;
      }

      return true;
    }

    function updateJadwal() {
      var dokterId = document.getElementById("id_dokter").value;
      var jadwalSelect = document.getElementById("id_jadwal");

      // Reset jadwal options
      jadwalSelect.innerHTML = "";

      // Fetch jadwal based on dokter
      fetch("getJadwal.php?dokterId=" + dokterId)
        .then(response => response.json())
        .then(data => {
          data.forEach(jadwal => {
            var option = document.createElement("option");
            option.value = jadwal.id;
            option.textContent = `Hari: ${jadwal.hari} | Jam: ${jadwal.jam_mulai} - ${jadwal.jam_selesai}`;
            jadwalSelect.appendChild(option);
          });
        });
    }
  </script>
</head>
<style>
/* CSS yang sama seperti sebelumnya */
body {
  font-family: Arial, sans-serif;
  background-color: #003873;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
}

.header {
  font-family: 'Montserrat', sans-serif;
  color: white;
  font-size: 35px;
  text-align: center;
}

.caption {
  font-family: 'Montserrat', sans-serif;
  color: white;
  font-size: 15px;
  text-align: center;
  margin-bottom: 20px; 
}

.login-container {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  width: 400px;
}

input[type="text"], select {
  width: 90%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
}

button {
  background-color: #4CAF50; /* Hijau */
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.form-footer {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.form-footer p {
  margin: 0;
  margin-left: 10px;
}

.form-footer a {
  color: #007bff;
  text-decoration: none;
  margin-left: 5px;
}

.form-footer a:hover {
  text-decoration: underline;
}
</style>
<body>
  <div class="header">
    <h2>Periksa Ke Poli</h2>
  </div>

  <div class="login-container">
    <form name="poliForm" action="prosessDaftarPoli.php" method="post" onsubmit="return validateForm()">
      <!-- Field ID Pasien -->
      <label for="id">ID Pasien:</label>
      <input type="text" name="id" id="id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>" readonly>

      <!-- Field Jadwal Praktikum -->
      <label for="id_jadwal">Jadwal Praktik:</label>
      <select name="id_jadwal" id="id_jadwal" required>
        <option value="">Pilih Jadwal</option>
        <?php foreach ($jadwal_options as $jadwal): ?>
          <option value="<?php echo $jadwal['id']; ?>">
            Hari: <?php echo $jadwal['hari']; ?> | Jam: <?php echo $jadwal['jam_mulai']; ?> - <?php echo $jadwal['jam_selesai']; ?>
          </option>
        <?php endforeach; ?>
      </select>

      <!-- Field Keluhan -->
      <label for="keluhan">Keluhan:</label>
      <input type="text" name="keluhan" id="keluhan" placeholder="Masukkan keluhan Anda" oninput="" required>

      <!-- Field No Antrian -->
      <label for="no_antrian">Nomor Antrian:</label>
      <input type="text" name="no_antrian" id="no_antrian" value="<?php echo htmlspecialchars($nomor_antrian); ?>" readonly>

      <button type="submit">Daftar</button>
    </form>
  </div>

  <div class="caption">
    <p>Jika Anda adalah Pasien Baru, Maka Masukan Data Diri Anda untuk Mendaftarkan Akun Anda.</p>
    <p>Jika sudah pernah membuat Akun, silahkan langsung memilih opsi "Masuk"</p>
  </div>
</body>
</html>
