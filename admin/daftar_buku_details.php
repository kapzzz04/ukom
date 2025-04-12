<?php 
session_start();
$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
}
require './koneksi.php';
include './partials/query.php';

$book_id = $_GET['id'];
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 d-flex flex-row justify-content-between align-items-center">
                        Detail Buku
                    </h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="./daftar_buku.php" class="btn btn-sm btn-danger mb-3">Kembali</a>
                            <h6 class="m-0 font-weight-bold text-primary">Detail Buku</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <?php foreach ($books as $key =>$data) : ?>
                                    <tr>
                                        <th>ID Buku</th>
                                        <td><?php echo $data['id_book']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Judul Buku</th>
                                        <td><?php echo $data['title']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Kategori</th>
                                        <td><?php echo $data['name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Author</th>
                                        <td><?php echo $data['author']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>Rp <?php echo number_format($data['price'], 0, ',', '.'); ?></td>

                                    </tr>
                                    <tr>
                                        <th>Stok buku</th>
                                        <td><?php echo $data['stock']; ?></td>
                                    </tr>
                                    <?php endforeach ?>
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

    <?php
  include './partials/script.php';
  ?>
</body>

</html>