<?php
// Include file koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $judul_buku = $_POST['Judul_Buku'];
    $penulis = $_POST['Penulis'];
    $publisher = $_POST['Publisher'];
    $price = $_POST['price'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jum_buk'];
    $desc = $_POST['komentar'];

    // $direktori = dirname(__DIR__) . "/img/"; // Ambil path dari 'admin' ke 'img'
    $direktori = dirname(__DIR__, 2) . "/img/"; // Naik 2 folder dari 'partials' lalu masuk ke 'img'
    $gambar = str_replace(' ', '_', $_FILES['file']['name']); // Hapus spasi dari nama file
    move_uploaded_file($_FILES['file']['tmp_name'], $direktori . $gambar);


    // Query untuk INSERT data ke dalam tabel books
    $query = "INSERT INTO books (category_id, title, author, publisher, price, stock, description, image, created_at)
                VALUES ('$kategori', '$judul_buku', '$penulis', '$publisher', '$price', '$jumlah', '$desc', '$gambar', NOW())";
    // Eksekusi query
    if (mysqli_query($con, $query)) {
        // Redirect ke halaman sukses atau tampilkan pesan
        echo '<script>alert("Tambah Data Buku Berhasil"); window.location.href = "../daftar_buku.php";</script>';
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}

// Tutup koneksi database
mysqli_close($con);