<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "poliklinikbk");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form (pastikan form mengirimkan data dengan metode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan variabel $no_antrian diambil dari input pengguna
    $no_antrian = isset($_POST['no_antrian']) ? $_POST['no_antrian'] : null;
    $tanggal_periksa = isset($_POST['tanggal_periksa']) ? $_POST['tanggal_periksa'] : null;
    $catatan = isset($_POST['catatan']) ? $_POST['catatan'] : null;
    $total_harga = isset($_POST['total_harga']) ? $_POST['total_harga'] : null;

    if ($no_antrian) {
        // Query untuk mendapatkan id_daftar_poli berdasarkan no_antrian
        $query_daftar_poli = "SELECT id FROM daftar_poli WHERE no_antrian = '$no_antrian'";
        $result_daftar_poli = $conn->query($query_daftar_poli);

        if ($result_daftar_poli && $result_daftar_poli->num_rows > 0) {
            $id_daftar_poli = $result_daftar_poli->fetch_assoc()['id'];

            // Simpan data pemeriksaan ke database
            $query_insert = "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa)
                             VALUES ('$id_daftar_poli', '$tanggal_periksa', '$catatan', '$total_harga')";
            
            if ($conn->query($query_insert)) {
                echo "<script>alert('Pemeriksaan berhasil dilakukan!'); window.location.href = 'Dokter-Periksa-Pasien.php';</script>";
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
