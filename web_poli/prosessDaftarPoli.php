<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "poliklinikbk";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pasien = $_POST['id'];
    $id_jadwal = $_POST['id_jadwal']; // Pastikan 'id_jadwal' di form
    $keluhan = $_POST['keluhan'];

    // Ambil nomor antrian terakhir berdasarkan jadwal yang sama
    $query = "SELECT MAX(no_antrian) AS last_antrian FROM daftar_poli WHERE id_jadwal = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_jadwal);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Jika tidak ada nomor antrian sebelumnya, mulai dari 001
    $lastAntrian = $row['last_antrian'] ?? '000'; // Jika kosong, set ke '000'

    // Increment nomor antrian terakhir dan format menjadi 3 digit
    $newAntrian = str_pad((intval($lastAntrian) + 1), 3, "0", STR_PAD_LEFT); // Format nomor antrian menjadi 3 digit

    // Masukkan data ke tabel
    $insertQuery = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("iiss", $id_pasien, $id_jadwal, $keluhan, $newAntrian);

    if ($stmt->execute()) {
        echo "Pendaftaran berhasil! Nomor antrian Anda adalah: " . $newAntrian;
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
