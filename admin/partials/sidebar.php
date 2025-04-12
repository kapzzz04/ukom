<?php
// Ambil URL saat ini
$current_page = basename($_SERVER['PHP_SELF']);
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-secret"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> <?= $_SESSION['admin_username'] ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if ($current_page == 'index.php') echo 'active'; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="./daftar_buku.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Buku</span></a>
                <a class="collapse-item" href="./kategori.php">
                    <i class="fas fa-fw fa-list"></i>
                    <span>Kategori</span></a>
                <a class="collapse-item" href="./pesan_baru.php">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Message</span>
                </a>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Daftar Tamu -->
    <li class="nav-item <?php if ($current_page == 'daftar_users.php') echo 'active'; ?>">
        <a class="nav-link" href="./daftar_users.php">
            <i class="fas fa-fw fa-users"></i>
            <span>Daftar Users</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Peminjaman -->
    <li class="nav-item <?php if ($current_page == 'orders.php') echo 'active'; ?>">
        <a class="nav-link" href="./orders.php">
            <i class="fas fa-fw fa-hands-helping"></i>
            <span>Orders</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>