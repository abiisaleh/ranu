<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? null;
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">C Plaza Electronik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link <?= ($uri1 == 'dashboard') ? 'active' : '' ?>" id="navDashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/produk" class="nav-link <?= ($uri1 == 'produk') ? 'active' : '' ?>" id="navProduk">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Produk
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/kriteria" class="nav-link <?= ($uri1 == 'kriteria') ? 'active' : '' ?>" id="navKriteria">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kriteria
                            <span class="right badge badge-danger">SMART</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/pesanan" class="nav-link <?= ($uri1 == 'pesanan') ? 'active' : '' ?>" id="navPesanan">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Pesanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin/laporan" class="nav-link <?= ($uri1 == 'laporan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>