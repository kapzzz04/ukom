<?php
// Include file koneksi ke database
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $status = $_POST['status'];
    $order_id = $_POST['iod'];

    // Query untuk UPDATE status di tabel orders
    $query = "UPDATE orders SET status = '$status' WHERE id = '$order_id'";

    // Eksekusi query
    if (mysqli_query($con, $query)) {
        echo '<script>alert("Status pesanan berhasil diperbarui!"); window.location.href = "../orders.php";</script>';
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}

// Tutup koneksi database
mysqli_close($con);
?>