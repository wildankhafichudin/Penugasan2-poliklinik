<?php
session_start(); // Memulai sesi

// Hapus semua sesi
session_unset();
session_destroy();

// Redirect ke halaman login
header('Location: login-Admin.php');
exit;
?>
