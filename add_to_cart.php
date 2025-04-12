<?php
session_start();
require './koneksi.php';
include './admin/partials/query.php';
$user = $_SESSION['name_user'];

if(!isset($user)){
   header('location:login.php');
}


$user_id = $_SESSION['user_id'];
$cartss = query("SELECT * FROM carts JOIN books ON carts.book_id = books.id_book WHERE carts.user_id = $user_id");

// hapus satu item di keranjang
if(isset($_GET['carys'])) {
    $id = $_GET["carys"];
    $queryMb = "DELETE FROM carts WHERE id_carts = $id";
    delete($queryMb);

     // reaksi setelah berhasil delete
  header('Location: add_to_cart.php');
  exit;

//   menghapus semua keranjang berdasarkan id_user
} else if(isset($_GET['carxs'])) {
    $queryMb = "DELETE FROM carts WHERE user_id = $user_id";
    delete($queryMb);

     // reaksi setelah berhasil delete
  header('Location: add_to_cart.php');
  exit;
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
    </style>

</head>

<body>
    <div class="wrapper">
        <!-- Header -->
        <!-- nav -->
        <?php
    include './partials/nav.php';
    ?>
        <!-- end -->

        <!-- benner -->
        <div class="carousel-inner text-center bg-primary text-white p-3 fs-4">
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
            <h2 class="text-center mb-4">Keranjang Belanja</h2>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                    $no = 1;
                    $totalHarga = 0;
                    foreach ($cartss as $item) : 
                        $total = $item['price'] * $item['quantity'];
                        $totalHarga += $total;
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $item['title']; ?></td>
                            <td>Rp <?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>Rp <?php echo number_format($total, 0, ',', '.'); ?></td>
                            <td><a href="?carys=<?= $item['id_carts']; ?>"
                                    onclick="javascript:return confirm('Hapus Keranjang ?');"
                                    class="btn-remove">Hapus</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total Harga:</th>
                            <th colspan="2">Rp <?php echo number_format($totalHarga, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="text-end">
                <a href="?carxs" onclick="javascript:return confirm('Hapus Semua Keranjang ?');"
                    class="btn btn-danger">Kosongkan
                    Keranjang</a>
            </div>
        </div>

        <!-- Form Alamat -->
        <div class="card">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow-lg border-0 rounded-4">
                            <div class="card-header bg-primary text-white rounded-top-4">
                                <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman</h5>
                            </div>
                            <div class="card-body">
                                <form action="proses_chekout.php" method="POST" enctype="multipart/form-data">
                                    <!-- Nama Penerima (Wajib) -->
                                    <div class="mb-3">
                                        <label for="nama" class="form-label fw-semibold">👤 Nama Penerima <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Contoh: xixixix" required>
                                    </div>

                                    <!-- Alamat (Opsional) -->
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label fw-semibold">🏠 Alamat Lengkap
                                            (Opsional)</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                            placeholder="Isi jika ingin mengubah alamat utama anda yang awal anda daftar akun sebelum masuk"></textarea>
                                    </div>

                                    <!-- Kota dan Kode Pos (Opsional) -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="kota" class="form-label fw-semibold">🌆 Kota (Opsional)</label>
                                            <input type="text" class="form-control" id="kota" name="kota"
                                                placeholder="Contoh: Surabaya">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="kode_pos" class="form-label fw-semibold">📮 Kode Pos
                                                (Opsional)</label>
                                            <input type="text" class="form-control" id="kode_pos" name="kode_pos"
                                                placeholder="Contoh: 60293">
                                        </div>
                                    </div>

                                    <!-- Spacer -->
                                    <hr class="my-4">

                                    <!-- Metode Pembayaran (Wajib) -->
                                    <div class="mb-3">
                                        <label for="metode" class="form-label fw-semibold">💳 Metode Pembayaran <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="metode" name="metode" required
                                            onchange="toggleBukti()">
                                            <option value="">-- Pilih Metode Pembayaran --</option>
                                            <option value="gopay">GoPay</option>
                                            <option value="shopee">ShopeePay</option>
                                            <option value="dana">Dana</option>
                                            <option value="bca">Transfer BCA</option>
                                            <option value="cod">COD (Bayar di Tempat)</option>
                                        </select>
                                    </div>

                                    <!-- Info nomor rekening / e-wallet -->
                                    <div class="mb-3" id="infoPembayaran" style="display: none;">
                                        <label class="form-label fw-semibold">📱 Nomor Pembayaran</label>
                                        <input type="text" name="nomorPembayaran" class="form-control"
                                            id="nomorPembayaran" readonly onclick="this.select()" />
                                        <small class="text-muted">Klik untuk menyalin nomor pembayaran</small>
                                    </div>

                                    <!-- Upload bukti pembayaran -->
                                    <div class="mb-3" id="buktiBayarContainer" style="display: none;">
                                        <label for="bukti_bayar" class="form-label fw-semibold">📷 Upload Bukti
                                            Pembayaran <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar"
                                            accept="image/*">
                                    </div>

                                    <!-- User ID -->
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

                                    <!-- Submit -->
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success px-4">
                                            <i class="fas fa-check-circle me-1"></i> Checkout
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end alamat -->
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


    <script>
    function toggleBukti() {
        const metode = document.getElementById("metode").value;
        const buktiContainer = document.getElementById("buktiBayarContainer");
        const infoPembayaran = document.getElementById("infoPembayaran");
        const nomorInput = document.getElementById("nomorPembayaran");
        const buktiInput = document.getElementById("bukti_bayar");

        if (metode === "cod" || metode === "") {
            buktiContainer.style.display = "none";
            infoPembayaran.style.display = "none";
            nomorInput.value = "-";

            // Set bukti bayar jadi "-" dengan membuat hidden input sementara
            if (!document.getElementById("dummy_bukti")) {
                const dummy = document.createElement("input");
                dummy.type = "hidden";
                dummy.name = "bukti_bayar_dummy";
                dummy.value = "-";
                dummy.id = "dummy_bukti";
                document.querySelector("form").appendChild(dummy);
            }
        } else {
            buktiContainer.style.display = "block";
            infoPembayaran.style.display = "block";
            const dummyBukti = document.getElementById("dummy_bukti");
            if (dummyBukti) dummyBukti.remove(); // hapus input dummy jika bukan COD

            switch (metode) {
                case "gopay":
                case "shopee":
                case "dana":
                    nomorInput.value = "0892929982";
                    break;
                case "bca":
                    nomorInput.value = "827738838";
                    break;
            }
        }
    }
    </script>

</body>

</html>