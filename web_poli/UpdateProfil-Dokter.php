<?php
session_start();

// Periksa apakah dokter sudah login
if (!isset($_SESSION['id'])) {
    header("Location: Login-Dokter.php");
    exit;
}

// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "poliklinikbk";

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dokter dari session
$id_dokter = $_SESSION['id'];

// Periksa apakah form telah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_baru = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $password_baru = isset($_POST['passwordDokter']) ? trim($_POST['passwordDokter']) : '';

    // Validasi input
    if (empty($nama_baru) && empty($password_baru)) {
        echo "<script>alert('Harap isi setidaknya salah satu field untuk diperbarui!'); window.location.href='Dashboard-Dokter.php';</script>";
        exit;
    }

    // Query untuk memperbarui data dokter
    $query = "UPDATE dokter SET ";
    $updates = [];

    if (!empty($nama_baru)) {
        $updates[] = "nama = '" . $conn->real_escape_string($nama_baru) . "'";
    }

    if (!empty($password_baru)) {
        $updates[] = "passwordDokter = '" . $conn->real_escape_string($password_baru) . "'";
    }

    $query .= implode(", ", $updates);
    $query .= " WHERE id = '" . $conn->real_escape_string($id_dokter) . "'";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        // Perbarui data di session jika nama diperbarui
        if (!empty($nama_baru)) {
            $_SESSION['nama'] = $nama_baru;
        }

        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='Dashboard-Dokter.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "'); window.location.href='Dashboard-Dokter.php';</script>";
    }
}

// Tutup koneksi
$conn->close();
?>
