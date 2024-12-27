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

// Cek jika form login dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameAdmin = $_POST['usernameAdmin'];
    $passwordAdmin = $_POST['passwordAdmin'];

    // Query untuk mencocokkan data pasien
    $sql = "SELECT * FROM users WHERE usernameAdmin = ? AND passwordAdmin = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usernameAdmin, $passwordAdmin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil, set session
        $_SESSION['usernameAdmin'] = $usernameAdmin;
        header("Location: Dashboard-Admin.html"); // Redirect ke halaman dashboard
        exit;
    } else {
        // Login gagal
        echo "<script>alert('Nama atau password salah!'); window.location.href = 'Login-Admin.php';</script>"; // Redirect ke halaman login
    }
    

    $stmt->close();
}

$conn->close();
?>
