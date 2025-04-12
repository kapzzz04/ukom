<?php
session_start();
$admin_user = $_SESSION['admin_username'];

if(!isset($admin_user)){
   header('location:login.php');
   exit;
}

include './koneksi.php';
include './partials/query.php';

$id_order = isset($_GET['oid']) ? $_GET['oid'] : '';
$order = query("SELECT * FROM orders WHERE id = '$id_order'");

if (empty($order)) {
    echo "Order tidak ditemukan.";
    exit;
}

$data = $order[0];
?>

<!DOCTYPE html>
<html lang="en">
<?php include './partials/head.php'; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include './partials/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include './partials/topbar.php'; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Status Order</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="./partials/orders_edit_act.php" method="post">
                                <input type="hidden" name="iod" value="<?= $data['id']; ?>">
                                <div class="form-group">
                                    <label for="status">Status Order</label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="pending"
                                            <?= ($data['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="canceled"
                                            <?= ($data['status'] == 'canceled') ? 'selected' : ''; ?>>Dibatalkan
                                        </option>
                                        <option value="completed"
                                            <?= ($data['status'] == 'completed') ? 'selected' : ''; ?>>Selesai</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Update Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php include './partials/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <?php include './partials/script.php'; ?>
</body>

</html>