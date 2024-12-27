<?php
session_start();
session_destroy();
header("Location: Login-Dokter.php");
exit;
?>