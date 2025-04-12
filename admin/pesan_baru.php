<?php
session_start();
include './koneksi.php';
include './partials/query.php';

$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
}

if(isset($_GET['ktg'])) {
    $id = $_GET["ktg"];
    $queryMb = "DELETE FROM pesan_baru WHERE id_pesan = $id";
    delete($queryMb);

     // reaksi setelah berhasil delete
  header('Location: pesan_baru.php');
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
                        Keluh Kesah User
                    </h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Keluh Kesah User</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tableMurid" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Subjek</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 

                                        $no = 1;
                                        foreach ($pesan_baru as $i) : ?>
                                        <tr class="text-center">
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $i['nama']; ?></td>
                                            <td><?php echo $i['email']; ?></td>
                                            <td><?php echo $i['subjek']; ?></td>
                                            <td class="d-flex flex-row align-items-center justify-content-center">
                                                <a href="./pesan_baru_details.php?id=<?= $i['id_pesan']; ?>"
                                                    class="btn btn-sm btn-primary mr-lg-3 mr-2"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="?ktg=<?= $i['id_pesan']; ?>"
                                                    onclick="javascript:return confirm('Hapus Data Pesan ?');"
                                                    class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>

                                    </tbody>
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

    <script>
    $(document).ready(function() {
        $("#tableMurid").DataTable();
    });
    </script>
</body>

</html>