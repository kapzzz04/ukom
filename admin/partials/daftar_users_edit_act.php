<?php
// Koneksi ke database
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $id_us = $_POST['iss'];
    $name = $_POST['user'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $kode_pos = $_POST['kode_pos'];   


    // Validasi data
    if (empty($id_us)) {
        echo '<script>alert("Data tidak lengkap."); window.history.back();</script>';
        exit();
    }
    // Query untuk memperbarui data
    $query = "UPDATE users SET name = '$name', email = '$email', alamat = '$alamat', role = '$role', kode_pos = '$kode_pos', kota = '$kota' WHERE id = '$id_us'";
     // Eksekusi query
     if (mysqli_query($con, $query)) {
        $affectedRows = mysqli_affected_rows($con);
        if ($affectedRows > 0) {
            echo '<script>alert("Update Data Users Berhasil"); window.location.href = "../daftar_users.php";</script>';
        }
    } else {
        echo '<script>alert("Error: ' . mysqli_error($con) . '"); window.history.back();</script>';
    }
    // Tutup koneksi
    mysqli_close($con);
} else {
    echo '<script>alert("Metode request tidak valid."); window.history.back();</script>';
}