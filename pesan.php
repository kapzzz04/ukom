<?php
session_start();
require './koneksi.php';
$user = $_SESSION['name_user'];

if(!isset($user)){
   header('location:login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Ambil dan bersihkan data dari form
$nama   = htmlspecialchars(strip_tags(trim($_POST['nama'])));
$email  = htmlspecialchars(strip_tags(trim($_POST['email'])));
$subjek = htmlspecialchars(strip_tags(trim($_POST['subjek'])));
$pesan  = htmlspecialchars(strip_tags(trim($_POST['pesan'])));
$id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

   
    // Query untuk INSERT data ke dalam tabel books
    $query = "INSERT INTO pesan_baru (id_user, nama, email, subjek, isi_pesan, tanggal_kirim)
                VALUES ('$id_user', '$nama', '$email', '$subjek', '$pesan', NOW())";
    // Eksekusi query
    if (mysqli_query($con, $query)) {
        // Redirect ke halaman sukses atau tampilkan pesan
        echo '<script>alert("Pesan Berhasil Terkirim"); window.location.href = "./pesan.php";</script>';
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($con);
    }
}

// Tutup koneksi database
mysqli_close($con);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hubungi Kami - BukuMart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Navbar -->
        <?php include './partials/nav.php'; ?>
        <!-- Banner -->
        <div class="carousel-inner text-center bg-primary text-white p-3 fs-4">
            <div class="carousel-item active">
                <p>📩 Punya pertanyaan? Kirim pesan ke kami dan tim BukuMart akan segera membalas!</p>
            </div>
        </div>

        <!-- Form Pesan -->
        <div class="container my-5">
            <h2 class="text-center mb-4">Hubungi Kami</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0 rounded-4">
                        <div class="card-header bg-primary text-white rounded-top-4">
                            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Formulir Pesan</h5>
                        </div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label fw-semibold">👤 Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama lengkap" required />
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">📧 Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="contoh@email.com" required />
                                </div>
                                <div class="mb-3">
                                    <label for="subjek" class="form-label fw-semibold">📌 Subjek</label>
                                    <input type="text" class="form-control" id="subjek" name="subjek"
                                        placeholder="Topik pesan Anda" required />
                                </div>
                                <div class="mb-3">
                                    <label for="pesan" class="form-label fw-semibold">✉️ Pesan</label>
                                    <textarea class="form-control" id="pesan" name="pesan" rows="4"
                                        placeholder="Tulis pesan Anda di sini..." required></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success px-4"><i
                                            class="fas fa-paper-plane me-1"></i> Kirim Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer bg-dark text-white p-3 text-center mt-4">
            <p>&copy; 2025 BukuMart. Semua Hak Dilindungi.</p>
            <div>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                <a href="#" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
            </div>
        </footer>
    </div>
</body>

</html>