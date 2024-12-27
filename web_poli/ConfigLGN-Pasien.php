<?php
session_start();

// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "poliklinikbk";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $passwordPasien = $_POST['passwordPasien'];

    // Query untuk memeriksa login
    $sql = "SELECT id, no_rm, nama FROM pasien WHERE nama = ? AND passwordPasien = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama, $passwordPasien);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika login berhasil
        $pasien = $result->fetch_assoc();
        $_SESSION['id'] = $pasien['id'];
        $_SESSION['no_rm'] = $pasien['no_rm'];
        $_SESSION['nama'] = $pasien['nama'];

        // Redirect ke Dashboard Pasien
        header("Location: Dashboard-Pasien.php");
        exit;
    } else {
        echo "Login gagal. Nama atau password salah.";
    }
}

// Cek jika form login dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $passwordPasien = $_POST['passwordPasien'];

    // Query untuk mencocokkan data pasien
    $sql = "SELECT * FROM pasien WHERE nama = ? AND passwordPasien = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama, $passwordPasien);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil, set session
        $_SESSION['nama'] = $nama;
        header("Location: Dashboard-Pasien.html"); // Redirect ke halaman dashboard
        exit;
    } else {
        // Login gagal
        echo "<script>alert('Nama atau password salah!'); window.location.href = 'Login-Pasien.php';</script>"; // Redirect ke halaman login
    }
    

    $stmt->close();
}

$conn->close();
?>
