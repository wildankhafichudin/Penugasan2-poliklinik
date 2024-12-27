<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "poliklinikbk");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan form dikirimkan dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $no_antrian = isset($_POST['no_antrian']) ? $_POST['no_antrian'] : null;
    $tanggal_periksa = isset($_POST['tanggal_periksa']) ? $_POST['tanggal_periksa'] : null;
    $catatan = isset($_POST['catatan']) ? $_POST['catatan'] : null;
    $total_harga = isset($_POST['total_harga']) ? $_POST['total_harga'] : null;

    // Cek apakah $no_antrian tersedia
    if ($no_antrian) {
        // Query untuk mendapatkan id_daftar_poli berdasarkan no_antrian
        $query_daftar_poli = "SELECT id FROM daftar_poli WHERE no_antrian = '$no_antrian'";
        $result_daftar_poli = $conn->query($query_daftar_poli);

        // Cek apakah data ditemukan
        if ($result_daftar_poli && $result_daftar_poli->num_rows > 0) {
            $id_daftar_poli = $result_daftar_poli->fetch_assoc()['id'];

            // Query untuk menyimpan data ke tabel periksa
            $query_insert = "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) 
                             VALUES ('$id_daftar_poli', '$tanggal_periksa', '$catatan', '$total_harga')";

            if ($conn->query($query_insert)) {
                echo "<script>alert('Pemeriksaan berhasil disimpan!'); window.location.href = 'Dokter-Periksa-Pasien.php';</script>";
            } else {
                echo "Error saat menyimpan data pemeriksaan: " . $conn->error;
            }
        } else {
            echo "Nomor antrian tidak ditemukan di daftar poli.";
        }
    } else {
        echo "Nomor antrian tidak disediakan.";
    }
} else {
    echo "Form tidak dikirimkan dengan metode POST.";
}
?>
