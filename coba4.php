<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Floating Button Pesan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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

    <!-- Konten Halaman -->
    <div class="container mt-5">
        <h1>Selamat Datang di Toko Buku</h1>
        <p>Temukan berbagai koleksi buku favorit Anda di sini.</p>
        <!-- Konten lainnya -->
    </div>

    <!-- Tombol Mengambang -->
    <a href="pesan.php" class="floating-btn" title="Kirim Pesan ke Admin">
        <i class="bi bi-chat-dots-fill"></i>
    </a>

    <!-- Bootstrap Bundle dengan Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>