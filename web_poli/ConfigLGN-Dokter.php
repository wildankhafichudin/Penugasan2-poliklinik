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
    $nama = $_POST['nama'];
    $passwordDokter = $_POST['passwordDokter'];

    // Query untuk mencocokkan data dokter dan mendapatkan nama_poli
    $sql = "SELECT d.id, d.nama, d.passwordDokter, p.nama_poli 
            FROM dokter d
            JOIN poli p ON d.id_poli = p.id
            WHERE d.nama = ? AND d.passwordDokter = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nama, $passwordDokter);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil, set session
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['passwordDokter'] = $row['passwordDokter'];
        $_SESSION['nama_poli'] = $row['nama_poli'];
        header("Location: Dashboard-Dokter.php");
        exit;
    } else {
        // Login gagal
        echo "<script>alert('Nama atau password salah!'); window.location.href = 'Login-Dokter.php';</script>"; // Redirect ke halaman login
    }

    $stmt->close();
}

$conn->close();
?>
