<?php
session_start();
include './koneksi.php';
include './partials/query.php';

$admin_user = $_SESSION['admin_username'] ?? '';

// Jika belum login, arahkan ke login page
if (!$admin_user) {
    header('location:login.php');
    exit;
}

if(isset($_GET['dd'])) {
    $id = $_GET["dd"];
    $queryMb = "DELETE FROM orders WHERE id = $id";
    delete($queryMb);

     // reaksi setelah berhasil delete
  header('Location: orders.php');
  exit;
}

// Ambil semua order beserta data user dan buku
$orders = query("SELECT 
    o.id AS order_id,
    u.name AS nama_user,
    GROUP_CONCAT(b.title ORDER BY b.title SEPARATOR ', ') AS judul_buku,
    GROUP_CONCAT(oi.quantity ORDER BY b.title SEPARATOR ', ') AS quantity,
    GROUP_CONCAT(CONCAT(b.title, ' (', oi.quantity, ')') SEPARATOR ', ') AS daftar_buku,
    o.total_price,
    o.status,
    o.created_at
FROM orders o
JOIN users u ON o.user_id = u.id
JOIN order_items oi ON oi.order_id = o.id
JOIN books b ON oi.book_id = b.id_book
GROUP BY o.id
ORDER BY o.created_at DESC
");
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
                    <h1 class="h3 mb-4 text-gray-800 d-flex flex-row justify-content-between align-items-center">
                        Daftar Order
                    </h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama User</th>
                                            <th>Judul Buku</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($orders as $order) :
                                        ?>
                                        <tr class="text-center">
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($order['nama_user']); ?></td>
                                            <td><?= htmlspecialchars($order['daftar_buku']); ?></td>
                                            <td><?= $order['quantity']; ?></td>
                                            <td>Rp <?= number_format($order['total_price'], 0, ',', '.'); ?></td>
                                            <td>

                                                <span class="badge 
                                    <?= $order['status'] == 'completed' ? 'bg-success' : 
                                        ($order['status'] == 'pending' ? 'bg-warning text-dark' : 'bg-danger'); ?>">
                                                    <?= ucfirst($order['status']); ?>
                                            </td>

                                            <td class="d-flex flex-row align-items-center justify-content-center">
                                                <a href="./orders_details.php?oid=<?= $order['order_id']; ?>"
                                                    class="btn btn-sm btn-primary mr-lg-2 mr-2">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="./orders_edit.php?oid=<?= $order['order_id']; ?>"
                                                    class="btn btn-sm btn-success mr-lg-2 mr-2">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="?dd=<?= $order['order_id']; ?>"
                                                    onclick="javascript:return confirm('Hapus data order ini?');"
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
            </div>

            <?php include './partials/footer.php'; ?>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

    <?php include './partials/script.php'; ?>

</body>

</html>