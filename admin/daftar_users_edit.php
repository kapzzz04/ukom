<?php
session_start();
$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
}

include './koneksi.php';
include './partials/query.php';
$id_users = $_GET['iss'];
$id_users = isset($_GET['iss']) ? $_GET['iss'] : '';
$users = query("SELECT * FROM users WHERE id = '$id_users'");


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
                        Edit Daftar Users
                    </h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="./daftar_users.php" class="btn btn-sm btn-danger mb-3">Kembali</a>
                            <h6 class="m-0 font-weight-bold text-primary">
                                Edit Daftar Users
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table>
                                    <form action="./partials/daftar_users_edit_act.php" method="post"
                                        enctype="multipart/form-data">
                                        <?php foreach ($users as $key =>$data) : ?>
                                        <div class="form-group">
                                            <label for="nama_us">Nama Users</label>
                                            <input type="text" name="user" class="form-control" id="nama_us"
                                                value="<?php echo htmlspecialchars($data['name']); ?>">
                                            <input type="hidden" name="iss" id="iss"
                                                value="<?php echo htmlspecialchars($data['id']); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_us">Email</label>
                                            <input type="text" name="email" class="form-control" id="nama_us"
                                                value="<?php echo htmlspecialchars($data['email']); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role</label>
                                            <select name="role" class="form-control" id="role">
                                                <option value="admin"
                                                    <?= ($data['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                <option value="user"
                                                    <?= ($data['role'] == 'user') ? 'selected' : ''; ?>>User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_us">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" id="nama_us"
                                                value="<?php echo htmlspecialchars($data['alamat']); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kot">Kota</label>
                                            <input type="text" name="kota" class="form-control" id="kot"
                                                value="<?php echo htmlspecialchars($data['kota']); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="kp">Kode Pos</label>
                                            <input type="text" name="kode_pos" class="form-control" id="kp"
                                                value="<?php echo htmlspecialchars($data['kode_pos']); ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                                    </form>
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php
    include './partials/script.php';
    ?>
</body>

</html>