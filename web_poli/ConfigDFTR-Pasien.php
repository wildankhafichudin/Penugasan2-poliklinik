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
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_ktp = $_POST['no_ktp'];
$no_hp = $_POST['no_hp'];
$passwordPasien = $_POST['passwordPasien'];

// Mendapatkan tanggal saat ini
$tanggalSekarang = date("Ym-");

// Mendapatkan No Urut terakhir dari database untuk hari ini
$sql = "SELECT no_rm FROM pasien WHERE no_rm LIKE '$tanggalSekarang%' ORDER BY no_rm DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $lastNoUrut = intval(substr($row['no_rm'], 8)) + 1; // Mengambil No Urut dan menambah 1
} else {
    $lastNoUrut = 1; // Jika belum ada data, mulai dari 1
}

// Membuat No Rekam Medis
$no_rekam_medis = $tanggalSekarang . str_pad($lastNoUrut, 3, "0", STR_PAD_LEFT);

// Menyiapkan SQL untuk memasukkan data
$sql = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp, passwordPasien, no_rm) VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp', '$passwordPasien','$no_rekam_medis')";

if ($conn->query($sql) === TRUE) {
    echo "Data berhasil disimpan! No Rekam Medis: $no_rekam_medis";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
