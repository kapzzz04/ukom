<?php
include('../koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi data dari form
    $id_book     = htmlspecialchars($_POST['id_book']);
    $category_id = htmlspecialchars($_POST['category_id']);
    $title       = htmlspecialchars($_POST['title']);
    $author      = htmlspecialchars($_POST['author']);
    $publisher   = htmlspecialchars($_POST['publisher']);
    $price       = htmlspecialchars($_POST['price']);
    $stock       = htmlspecialchars($_POST['stock']);
    $description = htmlspecialchars($_POST['description']);
    $image       = $_FILES['image']['name'];

    // Validasi field wajib
    if (
        empty($id_book) || empty($category_id) || empty($title) || empty($author) || empty($publisher) ||
        empty($price) || empty($stock) || empty($description)
    ) {
        echo '<script>alert("Semua field harus diisi."); window.history.back();</script>';
        exit;
    }

    // Cek apakah ada gambar baru di-upload
    if (!empty($image)) {
        $direktori = dirname(__DIR__, 2) . "/img/"; // Naik 2 folder dari 'partials' lalu masuk ke 'img'
        $gambar = str_replace(' ', '_', $_FILES['image']['name']); // Hapus spasi dari nama file
        move_uploaded_file($_FILES['image']['tmp_name'], $direktori . $gambar);

        // Update semua data termasuk image
        $query = "UPDATE books SET 
                    category_id = '$category_id',
                    title = '$title',
                    author = '$author',
                    publisher = '$publisher',
                    price = '$price',
                    stock = '$stock',
                    description = '$description',
                    image = '$gambar',
                    created_at = NOW()
                  WHERE id_book = '$id_book'";
    } else {
        // Jika tidak ada gambar baru
        $query = "UPDATE books SET 
                    category_id = '$category_id',
                    title = '$title',
                    author = '$author',
                    publisher = '$publisher',
                    price = '$price',
                    stock = '$stock',
                    description = '$description',
                    created_at = NOW()
                  WHERE id_book = '$id_book'";
    }

    if (mysqli_query($con, $query)) {
        echo '<script>alert("Data buku berhasil diperbarui!"); window.location.href = "../daftar_buku.php";</script>';
    } else {
        echo '<script>alert("Gagal memperbarui data: ' . mysqli_error($con) . '"); window.history.back();</script>';
    }

    mysqli_close($con);
} else {
    echo '<script>alert("Permintaan tidak valid."); window.history.back();</script>';
}