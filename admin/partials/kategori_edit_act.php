<?php
// Include file koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kategori= $_POST['kategori'];
    $id_cs= $_POST['iss'];



    // Query untuk INSERT data ke dalam tabel books
    $query = "UPDATE categories SET name = '$kategori' WHERE id = '$id_cs'";
    // Eksekusi query
    if (mysqli_query($con, $query)) {
        // Redirect ke halaman sukses atau tampilkan pesan
        echo '<script>alert("Update Data Kategori"); window.location.href = "../kategori.php";</script>';
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}

// Tutup koneksi database
mysqli_close($con);