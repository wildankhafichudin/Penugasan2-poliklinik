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
    $passwordDokter = $_POST["passwordDokter"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_hp"];

    // Periksa apakah ini operasi update atau delete
    if (isset($_POST['update'])) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("UPDATE dokter SET 
                                nama = ?, 
                                passwordDokter = ?, 
                                alamat = ?, 
                                no_hp = ? 
                                WHERE id = ?");
        $stmt->bind_param("ssssi", $nama, $passwordDokter, $alamat, $no_hp, $id);

        if ($stmt->execute()) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("DELETE FROM dokter WHERE id = ?");
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
