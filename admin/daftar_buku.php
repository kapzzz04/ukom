<?php
session_start();
$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
}

include './koneksi.php';
include './partials/query.php';
if(isset($_GET['ibook'])) {
    $id = $_GET["ibook"];
    $queryMb = "DELETE FROM books WHERE id_book = $id";
    delete($queryMb);

     // reaksi setelah berhasil delete
  header('Location: daftar_buku.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include './partials/head.php';
?>

<style>
#tableTersedia {
    z-index: 3 !important;
}

.dt-buttons {
    position: relative;
    top: 20px;
    left: 10px;
    z-index: 1000;
}

.dt-button.btn-primary {
    background-color: #007bff !important;
    border-color: #007bff !important;
}

@media only screen and (max-width: 600px) {
    #tableTersedia {
        z-index: 3 !important;
    }

    .dt-buttons {
        position: relative;
        top: -6px;
        padding: 5px 30px;
        display: block;
        margin: 0 auto !important;
        left: -20px;
        z-index: 1000 !important;
    }
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
                        Daftar Buku
                    </h1>
                    <ul class="nav nav-pills mb-3 d-flex justify-content-start" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                Tersedia
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">
                                Habis
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <?php
                        include './partials/buku_tersedia.php';
                        ?>
                        <?php
                        include './partials/buku_habis.php';
                        ?>
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

    <script>
    $(document).ready(function() {
        $("#tableTersedia").DataTable();
    });
    $(document).ready(function() {
        $("#tableHabis").DataTable();
    });
    </script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>