<?php
include('./koneksi.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $book_id = intval($_POST['book_id']);
    $qty_input = intval($_POST['quantity']);

    if (empty($user_id) || empty($book_id) || empty($qty_input)) {
        echo '<script>alert("Data tidak lengkap."); window.history.back();</script>';
        exit();
    }

    // Ambil stok dari buku
    $stok_data = query("SELECT stock FROM books WHERE id_book = $book_id");
    if (count($stok_data) === 0) {
        echo '<script>alert("Buku tidak ditemukan."); window.history.back();</script>';
        exit();
    }
    $stok = intval($stok_data[0]['stock']);

    // Ambil jumlah di keranjang jika sudah ada
    $cart_data = query("SELECT quantity FROM carts WHERE user_id = $user_id AND book_id = $book_id");
    $cart_qty = count($cart_data) > 0 ? intval($cart_data[0]['quantity']) : 0;

    // Hitung total jika ditambahkan
    $total_qty = $qty_input + $cart_qty;

    if ($total_qty > $stok) {
        echo '<script>alert("Stok tidak mencukupi untuk jumlah yang Anda pesan."); window.location.href = "index.php";</script>';
        exit();
    }

    // Proses tambah/update keranjang
    if ($cart_qty > 0) {
        $query = "UPDATE carts SET quantity = quantity + $qty_input WHERE user_id = $user_id AND book_id = $book_id";
    } else {
        $query = "INSERT INTO carts (user_id, book_id, quantity, added_at) VALUES ($user_id, $book_id, $qty_input, CURRENT_TIMESTAMP())";
    }

    if (mysqli_query($con, $query)) {
        echo '<script>alert("Berhasil menambahkan ke keranjang."); window.location.href = "add_to_cart.php";</script>';
    } else {
        echo '<script>alert("Gagal menambahkan ke keranjang: ' . mysqli_error($con) . '"); window.history.back();</script>';
    }

    mysqli_close($con);
} else {
    echo '<script>alert("Metode request tidak valid."); window.history.back();</script>';
}