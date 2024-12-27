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
    $nama_poli = $_POST["nama_poli"];
    $keterangan = $_POST["keterangan"];

    // Periksa apakah ini operasi update atau delete
    if (isset($_POST['update'])) {
        // Menggunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("UPDATE poli SET 
                                nama_poli = ?, 
                                keterangan = ? 
                                WHERE id = ?");
        $stmt->bind_param("ssi", $nama_poli, $keterangan, $id);

        if ($stmt->execute()) {
            echo "Data berhasil diperbarui.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
       } 
    }

    // Periksa apakah ini operasi delete
    if (isset($_POST['delete'])) {
        // Hapus baris terkait di tabel dokter
        $stmt = $conn->prepare("DELETE FROM dokter WHERE id_poli = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Hapus baris di tabel poli
        $stmt = $conn->prepare("DELETE FROM poli WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
$conn->close();
?>
