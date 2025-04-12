<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BukuMart - Portal Buku Terpercaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
    body {
        background-color: #eef1f5;
        font-family: 'Arial', sans-serif;
    }

    header {
        background-color: #2a2f4a;
        color: white;
        padding: 30px 0;
        text-align: center;
    }

    .nav-custom {
        background-color: #3d4160;
    }

    .nav-custom .nav-link {
        color: #fff !important;
        font-weight: bold;
    }

    .welcome-section {
        background-color: #f4f4f4;
        padding: 80px 0;
        text-align: center;
    }

    .book-item {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        overflow: hidden;
    }

    .book-item img {
        height: 250px;
        object-fit: cover;
    }

    .book-item .card-body {
        padding: 20px;
    }

    .highlight-article {
        background-color: #fff;
        padding: 50px;
        border-radius: 10px;
        margin-top: 70px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
    }
    </style>
</head>

<body>
    <?php session_start(); require './koneksi.php'; include './admin/partials/query.php'; if(!isset($_SESSION['name_user'])) header('location:login.php'); $user = $_SESSION['name_user']; ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <!-- Logo + Tagline -->
            <div class="d-flex align-items-center me-4">
                <img src="img/harry_potter.jpeg" alt="Logo" width="40" class="me-2">
                <a class="navbar-brand fw-bold text-primary" href="#">BukuMart</a>
            </div>

            <!-- Toggle for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu + Search + Action -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <!-- Kategori Menu -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-dark" href="#">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#koleksi">Koleksi Buku</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#rekomendasi">Rekomendasi</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#hubungi">Hubungi Kami</a></li>
                </ul>

                <!-- Pencarian -->
                <form class="d-flex me-3" action="search.php" method="GET">
                    <input class="form-control form-control-sm me-2" type="search" name="keyword"
                        placeholder="Cari buku..." aria-label="Search">
                    <button class="btn btn-sm btn-outline-primary" type="submit">Cari</button>
                </form>

                <!-- Action -->
                <a href="add_to_cart.php" class="btn btn-sm btn-primary me-2">🛒 Keranjang</a>
                <a href="logout.php" class="btn btn-sm btn-outline-danger">Keluar</a>
            </div>
        </div>
    </nav>


    <header>
        <h1>Selamat Datang di BukuMart</h1>
        <p>Belanja Buku Lebih Mudah, Cepat, dan Terpercaya!</p>
    </header>

    <section class="welcome-section">
        <div class="container">
            <h2 class="mb-4">Koleksi Terbaru Kami</h2>
            <div class="row">
                <?php $kategoriDipilih = $_GET['category'] ?? ''; foreach ($buku_join as $buku): if ($kategoriDipilih && $buku['name'] !== $kategoriDipilih) continue; ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="book-item">
                        <img src="img/<?= $buku['image']; ?>" class="w-100" alt="<?= $buku['title']; ?>">
                        <div class="card-body">
                            <h5><?= $buku['title']; ?></h5>
                            <p class="text-muted small">Penulis: <?= $buku['author']; ?></p>
                            <p class="fw-bold text-success">Rp <?= number_format($buku['price'], 0, ',', '.'); ?></p>
                            <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#bookModal" data-id="<?= $buku['id_book']; ?>"
                                data-title="<?= $buku['title']; ?>" data-author="<?= $buku['author']; ?>"
                                data-price="<?= $buku['price']; ?>" data-stock="<?= $buku['stock']; ?>">Tambah ke
                                Keranjang</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="container highlight-article" id="tips">
        <h3 class="mb-3">Tips Memilih Buku yang Cocok untuk Kamu</h3>
        <p>
            Memilih buku yang sesuai dapat membuatmu lebih semangat membaca. Mulailah dari genre yang kamu minati,
            seperti fiksi, sejarah, atau motivasi. Baca sinopsis, cek review dari pembaca lain, dan jangan ragu untuk
            mencoba penulis baru. Yang penting, pilih buku yang membuatmu nyaman dan penasaran ingin terus membacanya!
        </p>
    </section>

    <div class="modal fade" id="bookModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Informasi Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="add_to_cart_act.php" method="POST">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
                        <input type="hidden" name="book_id" id="bookId">
                        <p><strong>Judul:</strong> <span id="modalBookTitle"></span></p>
                        <p><strong>Penulis:</strong> <span id="modalBookAuthor"></span></p>
                        <p><strong>Harga:</strong> <span id="modalBookPrice"></span></p>
                        <p><strong>Stok:</strong> <span id="modalBookStock"></span></p>
                        <label for="quantity">Jumlah:</label>
                        <input type="number" name="quantity" class="form-control" min="1" value="1">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">+ Masukkan Keranjang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center text-white py-4" style="background-color:#3d4160">
        <div class="container">
            <p class="mb-1">BukuMart &copy; <?= date('Y'); ?>. All rights reserved.</p>
            <small>Temukan buku favoritmu dengan mudah, aman, dan cepat.</small>
        </div>
    </footer>

    <script>
    const bookModal = document.getElementById('bookModal');
    bookModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        document.getElementById('bookId').value = button.getAttribute('data-id');
        document.getElementById('modalBookTitle').textContent = button.getAttribute('data-title');
        document.getElementById('modalBookAuthor').textContent = button.getAttribute('data-author');
        document.getElementById('modalBookPrice').textContent = 'Rp ' + parseInt(button.getAttribute(
            'data-price')).toLocaleString('id-ID');
        document.getElementById('modalBookStock').textContent = button.getAttribute('data-stock');
    });
    </script>
</body>

</html>