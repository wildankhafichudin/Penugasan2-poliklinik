<?php
// Konfigurasi database
$servername = "localhost";
$username = "root"; // Ganti dengan username database kamu
$password = ""; // Ganti dengan password database kamu
$dbname = "poliklinikbk"; // Ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
if (isset($_POST['nama_poli']) && isset($_POST['keterangan'])) {
    $nama_poli = $_POST['nama_poli'];
    $keterangan = $_POST['keterangan'];

    // Menyiapkan SQL untuk memasukkan data
    $sql = "INSERT INTO poli (nama_poli, keterangan) VALUES ('$nama_poli', '$keterangan')";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Data form tidak lengkap!";
}

// Menutup koneksi
$conn->close();
?>
