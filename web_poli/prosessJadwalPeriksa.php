<?php
session_start();

// Periksa apakah dokter sudah login
if (!isset($_SESSION['id'])) {
    header("Location: Login-Dokter.php");
    exit;
}

// Ambil ID dokter dari session
$id_dokter = $_SESSION['id'];

// Periksa apakah data form sudah dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $hari = isset($_POST['hari']) ? trim($_POST['hari']) : '';
    $jam_mulai = isset($_POST['jam_mulai']) ? trim($_POST['jam_mulai']) : '';
    $jam_selesai = isset($_POST['jam_selesai']) ? trim($_POST['jam_selesai']) : '';
    $status = isset($_POST['statusJadwal']) ? trim($_POST['statusJadwal']) : '';

    // Validasi data
    if (empty($hari) || empty($jam_mulai) || empty($jam_selesai) || empty($status)) {
        echo "<script>alert('Semua field harus diisi!'); window.location.href = 'JadwalPeriksa.php';</script>";
        exit;
    }

    // Pastikan format waktu valid
    if (!preg_match('/^([01]?\d|2[0-3]):[0-5]\d$/', $jam_mulai) || !preg_match('/^([01]?\d|2[0-3]):[0-5]\d$/', $jam_selesai)) {
        echo "<script>alert('Format waktu tidak valid! Gunakan format HH:MM.'); window.location.href = 'JadwalPeriksa.php';</script>";
        exit;
    }

    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'poliklinikbk'); // Ganti 'nama_database' dengan nama database Anda

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk menyimpan data jadwal periksa
    $stmt = $conn->prepare("INSERT INTO jadwal_periksa (id_dokter, hari, jam_mulai, jam_selesai, statusJadwal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id_dokter, $hari, $jam_mulai, $jam_selesai, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Jadwal periksa berhasil disimpan!'); window.location.href = 'JadwalPeriksa.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan jadwal periksa: " . $stmt->error . "'); window.location.href = 'JadwalPeriksa.php';</script>";
    }

    // Tutup koneksi
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Metode pengiriman tidak valid!'); window.location.href = 'JadwalPeriksa.php';</script>";
    exit;
}
?>
