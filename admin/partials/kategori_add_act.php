<?php
// Include file koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kategori= $_POST['kategori'];

    // Query untuk INSERT data ke dalam tabel books
    $query = "INSERT INTO categories (name) VALUES ('$kategori')";
    // Eksekusi query
    if (mysqli_query($con, $query)) {
        // Redirect ke halaman sukses atau tampilkan pesan
        echo '<script>alert("Tambah Data Kategori"); window.location.href = "../kategori.php";</script>';
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}

// Tutup koneksi database
mysqli_close($con);