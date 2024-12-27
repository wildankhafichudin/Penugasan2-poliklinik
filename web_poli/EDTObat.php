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
    $nama_obat = $_POST["nama_obat"];
    $kemasan = $_POST["kemasan"];
    $harga = $_POST["harga"];

    // Periksa apakah ini operasi update atau delete
    if (isset($_POST['update'])) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("UPDATE obat SET 
                                nama_obat = ?, 
                                kemasan = ?, 
                                harga = ? 
                                WHERE id = ?");
        $stmt->bind_param("sssi", $nama_obat, $kemasan, $harga, $id);

        if ($stmt->execute()) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("DELETE FROM obat WHERE id = ?");
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
