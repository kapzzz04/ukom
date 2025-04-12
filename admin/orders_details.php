<?php 
session_start();
$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
}
require './koneksi.php';
include './partials/query.php';

$id_order = $_GET['oid'];
$order = query("SELECT 
            o.*,
            u.name AS nama_user,
            GROUP_CONCAT(CONCAT(b.title, ' (', oi.quantity, ')') SEPARATOR ', ') AS daftar_buku,
            u.alamat,
            u.kota,
            u.kode_pos
        FROM orders o
        JOIN users u ON o.user_id = u.id
        JOIN order_items oi ON oi.order_id = o.id
        JOIN books b ON oi.book_id = b.id_book
        WHERE o.id = $id_order
        GROUP BY o.id
        ORDER BY o.created_at DESC");

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
                        Detail Order
                    </h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="./orders.php" class="btn btn-sm btn-danger mb-3">Kembali</a>
                            <h6 class="m-0 font-weight-bold text-primary">Detail Order</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <?php foreach ($order as $key =>$data) : ?>
                                    <tr>
                                        <th>ID Order</th>
                                        <td><?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nama Penerima</th>
                                        <td><?php echo $data['nama_penerima']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Daftar Buku</th>
                                        <td><?php echo $data['daftar_buku']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td><?php echo $data['total_price']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Metode Pembayaran</th>
                                        <td><?php echo $data['metode_pembayaran']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Pembayaran</th>
                                        <td>
                                            <?php  echo $data['nomor_pembayaran']; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td><?php 
        echo $data['alamat'] . ', ' . $data['kota'] . ' ' . $data['kode_pos'];
        ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>
                                            <?php  echo $data['created_at']; ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <td>
                                            <img src="<?php echo '../img/'.$data['bukti_pembayaran']; ?>"
                                                class="card-img-top img-fluid rounded"
                                                style="max-width: 300px; height: auto;" alt="Bukti Pembayaran" />

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span class="badge 
                                    <?= $data['status'] == 'completed' ? 'bg-success' : 
                                        ($data['status'] == 'pending' ? 'bg-warning text-dark' : 'bg-danger'); ?>">
                                                <?= ucfirst($data['status']); ?></td>
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