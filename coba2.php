<?php
session_start();
require './koneksi.php';
include './admin/partials/query.php';

$user_id = $_SESSION['user_id'];
$cartss = query("SELECT * FROM carts JOIN books ON carts.book_id = books.id_book WHERE carts.user_id = $user_id");

if (isset($_GET['remove'])) {
    $id = $_GET["remove"];
    delete("DELETE FROM carts WHERE id_carts = $id");
    header('Location: add_to_cart.php');
    exit;
} elseif (isset($_GET['clear'])) {
    delete("DELETE FROM carts WHERE user_id = $user_id");
    header('Location: add_to_cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keranjang | BukuMart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f9;
    }

    .nav-custom {
        background: linear-gradient(to right, #6a11cb, #2575fc);
    }

    .nav-custom .nav-link,
    .nav-custom .navbar-brand {
        color: #fff !important;
    }

    .table-cart {
        background-color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border-radius: 10px;
        padding: 20px;
    }

    .btn-remove {
        color: #fff;
        background-color: #e74c3c;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-remove:hover {
        background-color: #c0392b;
    }
    </style>
</head>

<body>

    <!-- Navbar -->


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">BukuMart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#artikel">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link" href="#promo">Promo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                </ul>
                <a href="add_to_cart.php" class="btn btn-outline-light me-2">🛒 Keranjang</a>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h3 class="text-center mb-4">🛍️ Daftar Belanja Anda</h3>
        <div class="table-cart">
            <table class="table table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Buku</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        $no = 1;
        $totalHarga = 0;
        foreach ($cartss as $item) :
          $subtotal = $item['price'] * $item['quantity'];
          $totalHarga += $subtotal;
        ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($item['title']); ?></td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.'); ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>Rp <?= number_format($subtotal, 0, ',', '.'); ?></td>
                        <td>
                            <a href="?remove=<?= $item['id_carts']; ?>" class="btn-remove"
                                onclick="return confirm('Hapus item ini?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <th colspan="4" class="text-end">Total</th>
                        <th colspan="2">Rp <?= number_format($totalHarga, 0, ',', '.'); ?></th>
                    </tr>
                </tfoot>
            </table>

            <div class="d-flex justify-content-end mt-3 gap-2">
                <a href="?clear" class="btn btn-danger"
                    onclick="return confirm('Yakin kosongkan semua item?')">Kosongkan Semua</a>
                <a href="chk.php" class="btn btn-success">Lanjut ke Checkout</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-light pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row text-center text-md-start">
                <!-- Logo dan Deskripsi -->
                <div class="col-md-4 mb-4">
                    <h4 class="fw-bold text-warning">Buku<span class="text-primary">Mart</span></h4>
                    <p class="small">
                        Platform toko buku online terpercaya untuk semua kalangan. Temukan buku impianmu hanya di
                        BukuMart!
                    </p>
                </div>

                <!-- Navigasi -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Navigasi Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#kategori" class="text-light text-decoration-none">Kategori Buku</a></li>
                        <li><a href="#artikel" class="text-light text-decoration-none">Artikel</a></li>
                        <li><a href="#tentang" class="text-light text-decoration-none">Tentang Kami</a></li>
                        <li><a href="login.php" class="text-light text-decoration-none">Masuk</a></li>
                    </ul>
                </div>

                <!-- Media Sosial -->
                <div class="col-md-4 mb-4">
                    <h5 class="fw-bold">Ikuti Kami</h5>
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>

            <hr class="bg-light" />
            <div class="text-center small">
                &copy; <?= date('Y'); ?> BukuMart. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>