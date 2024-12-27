<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "poliklinikbk";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
$nama = $_POST['nama'];
$passwordDokter = $_POST['passwordDokter'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$id_poli = $_POST['id_poli'];

// Validasi apakah id_poli ada di tabel poli
$check_poli_sql = "SELECT id FROM poli WHERE id = ?";
$stmt = $conn->prepare($check_poli_sql);
$stmt->bind_param("i", $id_poli);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // id_poli valid, lanjutkan insert data
    $insert_sql = "INSERT INTO dokter (nama, passwordDokter, alamat, no_hp, id_poli) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ssssi", $nama, $passwordDokter, $alamat, $no_hp, $id_poli);

    if ($stmt->execute()) {
        echo "Data berhasil disimpan!";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Error: id_poli tidak valid. Pastikan id_poli ada di tabel poli.";
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
