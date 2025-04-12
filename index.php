<?php
session_start();
require './koneksi.php';
include './admin/partials/query.php';

$user = $_SESSION['name_user'];

if(!isset($user)){
   header('location:login.php');
}


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Toko Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css" />

    <!-- style input quantity -->
    <style>
    .quantity-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .description {
        max-height: 80px;
        /* Batas tinggi deskripsi */
        overflow: hidden;
        text-overflow: ellipsis;
        /* Tambahkan ... jika teks kepanjangan */
        white-space: pre-line;
        /* Agar format baris baru tetap terlihat */
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
    }

    /* Tombol Mengambang */
    .floating-btn {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #0d6efd;
        color: white;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        transition: background-color 0.3s, transform 0.3s;
    }

    .floating-btn:hover {
        background-color: #0b5ed7;
        transform: scale(1.1);
    }

    .floating-btn i {
        font-size: 24px;
    }
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-2">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">
                    <span class="text-primary">Buku</span><span class="text-warning">Mart</span>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Pilih Kategori
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                    <li><a class="dropdown-item" href="?category=">Semua</a></li>
                                    <li><a class="dropdown-item" href="?category=Komik">Komik</a></li>
                                    <li><a class="dropdown-item" href="?category=Novel">Novel</a></li>
                                    <li><a class="dropdown-item" href="?category=Biografi">Biografi</a></li>
                                    <li><a class="dropdown-item" href="?category=Non-Fiksi">Non-Fiksi</a></li>
                                    <li><a class="dropdown-item" href="?category=Fiksi">Fiksi</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <form class="d-flex justify-content-between align-items-center w-50 ">
                        <input id="searchInput" class="form-control me-2" type="search"
                            placeholder="Cari buku favorit" />
                        <button class="btn btn-outline-secondary" type="button">🔍</button>
                    </form>

                    <a href="add_to_cart.php" class="btn btn-outline-dark ms-3"> 🛒 </a>

                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="./transaksi.php">Status Pesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./logout.php">logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- benner -->
        <div class="carousel-inner text-center bg-primary text-white p-3 fs-4">
            <div class="bg-primary text-white">
                <div class="card-body text-center py-5">
                    <h1 class="display-5 mb-3">
                        <i class="bi bi-emoji-smile-fill me-2"></i> Haii, <span
                            class="fw-bold"><?=  $_SESSION['name_user']?></span>
                    </h1>
                    <p class="lead">Selamat datang kembali! Semoga harimu menyenangkan 😊</p>
                </div>
            </div>
            <div class="carousel-item active">
                <p>
                    📚 Selamat datang di BukuMart! Temukan buku favoritmu dengan harga
                    terbaik! ✨
                </p>
            </div>
            <div class="carousel-item">
                <p>🚀 Dapatkan diskon spesial untuk buku pilihan setiap minggu!</p>
            </div>
            <div class="carousel-item">
                <p>🎁 Gratis ongkir untuk pembelian di atas Rp200.000!</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-lg-3 text-center">
                    <h5>Kategori Buku</h5>
                    <ul class="list-group">
                        <li class="list-group-item">Fiksi</li>
                        <li class="list-group-item">Non-Fiksi</li>
                        <li class="list-group-item">Komik</li>
                        <li class="list-group-item">Novel</li>
                        <li class="list-group-item">Biografi</li>
                    </ul>

                </div>
                <!-- Card Template -->
                <?php 

                $category = $_GET['category'] ?? '';

                foreach ($buku_join as $product) : 
                if ($category && $product['name'] !== $category) continue; ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 book-card">
                    <div class="card">
                        <img src="<?php echo 'img/'.$product['image']; ?>" class="card-img-top" alt="Product Image" />
                        <div class="card-body">
                            <h5 class="card-title book-item"><?php echo $product['title']; ?></h5>
                            <div class="description">
                                <?php echo nl2br($product['description']); ?>
                            </div>
                            <!-- Menampilkan 100 karakter pertama -->
                            <p class="price">
                                Rp
                                <?php echo number_format($product['price'], 0, ',', '.'); ?>
                            </p>
                            <p><span><strong>Stok :</strong> </span><?php echo $product['stock']; ?></p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookModal"
                                onclick="showBookDetail('<?php echo $product['title']; ?>', '<?php echo $product['author']; ?>', 'Rp <?php echo number_format($product['price'], 0, ',', '.'); ?>', '<?php echo $product['id_book']; ?>', '<?php echo $_SESSION['user_id']; ?>', '<?php echo $product['stock']; ?>')">
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Modal Form Tambah ke Keranjang -->
        <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-red" id="bookTitle">Detail Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="cartForm" action="add_to_cart_act.php" method="POST">
                            <input type="hidden" name="user_id" id="user_id" />
                            <input type="hidden" name="book_id" id="book_id" />
                            <p><strong>Penulis:</strong> <span id="bookAuthor"></span></p>
                            <p><strong>Harga:</strong> <span id="bookPrice"></span></p>
                            <p><strong>Stock:</strong> <span id="quantity"></span></p>
                            <div class="quantity-container">
                                <label for="quantity">Jumlah:</label>
                                <input type="number" name="quantity" id="quantity" class="quantity-input" value="1"
                                    min="1" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Tutup
                                </button>
                                <button type="submit" class="btn btn-success">
                                    Konfirmasi Tambah Keranjang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <!-- Footer -->
        <footer class="bg-dark text-light py-4 mt-5 border-top border-secondary">
            <div class="container text-center">
                <h5 class="fw-bold mb-2">BukuMart</h5>
                <p class="small mb-3">
                    &copy; <?= date('Y'); ?> BukuMart. Semua Hak Dilindungi.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="#" class="text-light text-decoration-none fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light text-decoration-none fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light text-decoration-none fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light text-decoration-none fs-5"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </footer>

        <!-- Tombol Mengambang -->
        <a href="pesan.php" class="floating-btn" title="Kirim Pesan ke Admin">
            <i class="bi bi-chat-dots-fill"></i>
        </a>


        <script>
        const searchInput = document.getElementById('searchInput');
        const bookCards = document.querySelectorAll('.book-card');

        searchInput.addEventListener('keyup', function() {
            const query = this.value.toLowerCase();

            bookCards.forEach(function(card) {
                const title = card.querySelector('.book-item').textContent.toLowerCase();
                card.style.display = title.includes(query) ? '' : 'none';
            });
        });


        function showBookDetail(title, author, price, bookId, userId, stock) {
            document.getElementById("bookTitle").innerText = title;
            document.getElementById("bookAuthor").innerText = author;
            document.getElementById("bookPrice").innerText = price;
            document.getElementById("book_id").value = bookId;
            document.getElementById("user_id").value = userId;
            document.getElementById("quantity").innerText = stock;
        }
        </script>
    </div>




</body>

</html>