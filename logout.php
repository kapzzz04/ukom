<?php

include 'koneksi.php';
session_start();

// Cek apakah yang login adalah user
if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
} else {
    // Kalau bukan user, bisa arahkan ke halaman lain atau tampilkan pesan
    echo "Hanya user yang bisa logout lewat halaman ini.";
}


?>