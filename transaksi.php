<?php
session_start();
require './koneksi.php';
include './admin/partials/query.php';
$user = $_SESSION['name_user'];


if(!isset($user)){
   header('location:login.php');
}

$user_id = $_SESSION['user_id'];

// Ambil data pesanan user
$orders = query("SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Tambahkan ini di <head> untuk Bootstrap dan Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- nav -->
    <?php
    include './partials/nav.php';
    ?>
    <!-- end -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Riwayat Transaksi</h2>
        <div class="d-flex align-items-center">
            <!-- Ikon Pesan -->
            <a href="pesan.php" class="text-black position-relative me-3" title="Kirim Pesan ke Admin">
                <i class="bi bi-chat-dots-fill fs-4"></i>
            </a>
            <!-- (opsional) Nama user atau tombol logout -->
            <span class="text-black">Hai, <?= $_SESSION['name_user'] ?></span>
        </div>

        <?php if (count($orders) > 0) : ?>
        <?php foreach ($orders as $order) : ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <strong>ID Pesanan:</strong> <?= $order['id']; ?> |
                <strong>Status:</strong> <span class="badge 
                                    <?= $order['status'] == 'completed' ? 'bg-success' : 
                                        ($order['status'] == 'pending' ? 'bg-warning text-dark' : 'bg-danger'); ?>">
                    <?= ucfirst($order['status']); ?>
                </span> |

                <strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($order['created_at'])); ?>
            </div>
            <div class="card-body">
                <?php
                    $order_id = $order['id'];
                    $items = query("SELECT order_items.*, books.title 
                                    FROM order_items 
                                    JOIN books ON order_items.book_id = books.id_book 
                                    WHERE order_id = $order_id");
                    ?>
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            $total = 0;
                            foreach ($items as $item): 
                                $subtotal = $item['price_each'] * $item['quantity'];
                                $total += $subtotal;
                            ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $item['title']; ?></td>
                            <td>Rp <?= number_format($item['price_each'], 0, ',', '.'); ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total Harga:</th>
                            <th>Rp <?= number_format($total, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else : ?>
        <div class="alert alert-info text-center">Belum ada transaksi yang dilakukan.</div>
        <?php endif; ?>
    </div>
</body>

</html>