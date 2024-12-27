<?php
// Konfigurasi database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "poliklinikbk"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari form
    $id = $_POST["id"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $no_ktp = $_POST["no_ktp"];
    $no_hp = $_POST["no_hp"];
    $passwordPasien = $_POST["passwordPasien"];
    $no_rm = $_POST["no_rm"];

    // Periksa apakah ini operasi update atau delete
    if (isset($_POST['update'])) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("UPDATE pasien SET 
                                nama = ?, 
                                alamat = ?, 
                                no_ktp = ?, 
                                no_hp = ?, 
                                passwordPasien = ?
                                WHERE id = ?");
        $stmt->bind_param("sssssi", $nama, $alamat, $no_ktp, $no_hp, $passwordPasien, $id);

        if ($stmt->execute()) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("DELETE FROM pasien WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>
