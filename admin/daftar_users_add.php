<?php
session_start();
$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
}

include './koneksi.php';
$id_buku = isset($_GET['ibk']) ? $_GET['ibk'] : '';


// include './partials/query_details.php';
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
                        Tambah Daftar User
                    </h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="./daftar_users.php" class="btn btn-sm btn-danger mb-3">Kembali</a>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Tambah Daftar User
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <?php
                                    include './partials/daftar_users_add.php';
                                    ?>
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