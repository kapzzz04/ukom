<?php
session_start();
require './koneksi.php';
include './admin/partials/query.php';
$user = $_SESSION['name_user'];

if(!isset($user)){
   header('location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $kode_pos = $_POST['kode_pos'];
    $metode = $_POST['metode'];
    $pembayaran = $_POST['nomorPembayaran'];

    // Cek apakah ketiganya terisi
    if (!empty($alamat) && !empty($kota) && !empty($kode_pos)) {
        // Escape input untuk keamanan
        $alamat = mysqli_real_escape_string($con, $alamat);
        $kota = mysqli_real_escape_string($con, $kota);
        $kode_pos = mysqli_real_escape_string($con, $kode_pos);

        // Update data alamat user
        $update_user = "UPDATE users 
                        SET alamat = '$alamat', kota = '$kota', kode_pos = '$kode_pos'
                        WHERE id = $user_id";
        mysqli_query($con, $update_user);
    }

    // Ambil data keranjang user
    $cart_items = query("SELECT * FROM carts 
                         JOIN books ON carts.book_id = books.id_book 
                         WHERE carts.user_id = $user_id");

    // Cek apakah keranjang kosong
    if (empty($cart_items)) {
        echo "<script>alert('Keranjang kamu kosong. Tambahkan buku terlebih dahulu.'); window.location.href='add_to_cart.php';</script>";
        exit;
    }

    // Hitung total harga
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['price'] * $item['quantity'];
    }

    $nomor_pembayaran = ($metode === "cod") ? "-" : $_POST['nomorPembayaran'];
    $bukti_pembayaran = ($metode === "cod") ? "-" : $_FILES['bukti_bayar']['name'];

    // ... proses upload jika bukan cod
    if ($metode !== "cod" && isset($_FILES['bukti_bayar']['tmp_name'])) {
            $direktori = __DIR__ . "/img/";
            $gambar = str_replace(' ', '_', $_FILES['bukti_bayar']['name']); // Hapus spasi dari nama file
            move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], $direktori . $gambar);
    }

    // Simpan ke tabel orders
    $insert_order = "INSERT INTO orders (user_id, total_price, status, created_at, nama_penerima, metode_pembayaran, nomor_pembayaran, bukti_pembayaran)
                     VALUES ($user_id, $total_price, 'pending', NOW(), '$nama', '$metode', '$pembayaran', '$gambar')";
    mysqli_query($con, $insert_order);
    $order_id = mysqli_insert_id($con);

    // Simpan ke tabel order_items dan kurangi stok
    foreach ($cart_items as $item) {
        $book_id = $item['book_id'];
        $quantity = $item['quantity'];
        $price_each = $item['price'];

        // Simpan item
        $insert_item = "INSERT INTO order_items (order_id, book_id, quantity, price_each)
                        VALUES ($order_id, $book_id, $quantity, $price_each)";
        mysqli_query($con, $insert_item);

        // Kurangi stok buku
        $update_stok = "UPDATE books SET stock = stock - $quantity WHERE id_book = $book_id";
        mysqli_query($con, $update_stok);
    }

    // Hapus keranjang
    $delete_cart = "DELETE FROM carts WHERE user_id = $user_id";
    mysqli_query($con, $delete_cart);

    // Redirect ke halaman transaksi
    header('Location: transaksi.php');
    exit;
}
?>