<?php
include 'koneksi.php';
session_start();

// Cek apakah yang login adalah admin
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
} else {
    // Kalau bukan admin, bisa arahkan ke halaman lain atau tampilkan pesan
    echo "Hanya admin yang bisa logout lewat halaman ini.";
}
?>