<?php
session_start();
$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
}

include './koneksi.php';
include './partials/query.php';
$book_id = $_GET['id_bkk'];
$book_id = isset($_GET['id_bkk']) ? $_GET['id_bkk'] : '';
$books = query("SELECT * FROM books 
                JOIN categories ON books.category_id = categories.id 
                WHERE books.id_book = '$book_id'");
?>

<!DOCTYPE html>
<html lang="en">
<?php
include './partials/head.php';
?>

<style>
table {
    width: 100%;
    border-collapse: collapse;
}

th,
td {
    border: 1px solid #ddd;
    padding: 8px;
}

th {
    background-color: transparent;
    text-align: left;
}

td {
    text-align: left;
}
</style>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        include './partials/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php
                include './partials/topbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Contents -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 d-flex flex-row justify-content-between align-items-center">
                        Edit Daftar Buku
                    </h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="./daftar_buku.php" class="btn btn-sm btn-danger mb-3">Kembali</a>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Edit Daftar Buku
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>

                                    <form action="./partials/daftar_buku_edit_act.php" method="POST"
                                        enctype="multipart/form-data">

                                        <?php foreach ($books as $key =>$data): ?>
                                        <!-- Hidden ID Buku -->
                                        <input type="hidden" name="id_book" value="<?= $data['id_book']; ?>">

                                        <div class="form-group">
                                            <label for="category_id">Kategori</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <!-- Ganti value dengan ID kategori dari database -->
                                                <option value="1" <?= $data['category_id'] == 1 ? 'selected' : '' ?>>
                                                    Komik</option>
                                                <option value="2" <?= $data['category_id'] == 2 ? 'selected' : '' ?>>
                                                    Novel</option>
                                                <option value="3" <?= $data['category_id'] == 3 ? 'selected' : '' ?>>
                                                    Biografi</option>
                                                <option value="4" <?= $data['category_id'] == 4 ? 'selected' : '' ?>>
                                                    Fiksi</option>
                                                <option value="5" <?= $data['category_id'] == 5 ? 'selected' : '' ?>>
                                                    Non-Fiksi</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">Judul Buku</label>
                                            <input type="text" name="title" id="title" class="form-control"
                                                value="<?= htmlspecialchars($data['title']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="author">Penulis</label>
                                            <input type="text" name="author" id="author" class="form-control"
                                                value="<?= htmlspecialchars($data['author']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="publisher">Penerbit</label>
                                            <input type="text" name="publisher" id="publisher" class="form-control"
                                                value="<?= htmlspecialchars($data['publisher']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Harga</label>
                                            <input type="number" name="price" id="price" class="form-control"
                                                value="<?= htmlspecialchars($data['price']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="stock">Stok</label>
                                            <input type="number" name="stock" id="stock" class="form-control"
                                                value="<?= htmlspecialchars($data['stock']); ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea name="description" id="description" class="form-control"
                                                required><?= htmlspecialchars($data['description']); ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">Gambar Buku (Abaikan jika tidak diganti)</label>
                                            <input type="file" name="image" id="image" class="form-control"
                                                accept="image/*">
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 mt-3">Simpan
                                            Perubahan</button>
                                    </form>
                                    <?php endforeach; ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include './partials/footer.php';
            ?>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php
    include './partials/script.php';
    ?>
</body>

</html>