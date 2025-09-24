<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= esc($title) ?></title>

    <!-- icon title -->
    <link rel="icon" href="<?= base_url('assets/img/logo-baru.jpg') ?>" type="image/x-icon">

    <!-- font -->
    <link rel="preload" href="<?= base_url('assets/fonts/centurygothic.ttf') ?>"
        as="font" type="font/ttf" crossorigin>
    <!-- cdn fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/r-3.0.2/b-3.0.2/b-html5-3.0.2/b-colvis-3.0.2/datatables.min.css" rel="stylesheet">

    <style>
        @font-face {
            font-family: "Gothic";
            src: url('../../../../public/assets/fonts/centurygothic.ttf');
        }

        body {
            font-family: 'Gothic' !important;
        }

        .chart-card {
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .06);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 6px 18px rgba(2, 6, 23, .05);
            margin-bottom: 16px;
        }

        .chart-wrap {
            position: relative;
            height: 320px;
        }

        /* === OFFSET KE KANAN SEDIKIT === */
        :root {
            --submenu-offset: 10px;
        }

        /* ganti 10px sesuai selera */

        .sidebar {
            overflow: visible;
        }

        .sidebar .nav-item {
            position: relative;
        }

        /* Overlay submenu (normal / sidebar lebar) */
        .sidebar .nav-item>.collapsing,
        .sidebar .nav-item>.collapse.show {
            position: absolute;
            top: calc(100% - .25rem);
            left: var(--submenu-offset);
            /* geser ke kanan */
            width: calc(100% - var(--submenu-offset));
            /* biar nggak kepotong */
            z-index: 1045;
            background: #fff;
            border-radius: .35rem;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
        }

        /* Optional: segitiga kecil penunjuk ke link induk */
        .sidebar .nav-item>.collapse.show::before,
        .sidebar .nav-item>.collapsing::before {
            content: "";
            position: absolute;
            top: -6px;
            left: calc(var(--submenu-offset) + 12px);
            border: 6px solid transparent;
            border-bottom-color: #fff;
            filter: drop-shadow(0 1px 1px rgba(0, 0, 0, .1));
        }

        /* Batasi tinggi isi submenu bila panjang */
        .sidebar .collapse-inner {
            max-height: 60vh;
            overflow: auto;
        }

        /* Saat sidebar di-collapse (mode icon saja), atur offset & lebar fixed */
        .sidebar.toggled .nav-item>.collapsing,
        .sidebar.toggled .nav-item>.collapse.show {
            left: 4.5rem;
            /* geser lebih jauh supaya keluar dari bar sempit */
            width: 14rem;
            /* lebar panel submenu saat collapsed */
        }
    </style>
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
                <div class="sidebar-brand-icon">
                    <img class="sidebar-card-illustration mb-2" src="<?= base_url('assets/img/navbar-logo-new.png') ?>" alt="PKK LEBAK DENOK">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php $isActive = ($sub_judul === 'Dashboard'); ?>
            <li class="nav-item <?= $isActive ? 'active' : '' ?>">
                <a class="nav-link <?= $isActive ? ' active' : '' ?>"
                    href="<?= base_url('admin/dashboard') ?>"
                    <?= $isActive ? 'aria-current="page"' : '' ?>>
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <!-- Data Tanaman -->
            <li class="nav-item <?= (($sub_judul ?? '') === 'Tanamanku') ? 'active' : '' ?>">
                <a class="nav-link <?= (($sub_judul ?? '') === 'Tanamanku') ? 'active' : '' ?>"
                    href="<?= site_url('admin/tanamanku') ?>"
                    <?= (($sub_judul ?? '') === 'Tanamanku') ? 'aria-current="page"' : '' ?>>
                    <i class="fas fa-fw fa-seedling"></i>
                    <span>Data Tanaman</span>
                </a>
            </li>

            <!-- Data Quiz -->
            <li class="nav-item <?= (($sub_judul ?? '') === 'Quiz') ? 'active' : '' ?>">
                <a class="nav-link <?= (($sub_judul ?? '') === 'Quiz') ? 'active' : '' ?>"
                    href="<?= site_url('admin/quiz') ?>"
                    <?= (($sub_judul ?? '') === 'Quiz') ? 'aria-current="page"' : '' ?>>
                    <i class="fas fa-fw fa-question-circle"></i>
                    <span>Data Quiz</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline bg-soft-green">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <!-- Page Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column min-vh-100">

            <!-- Main Content -->
            <div id="content" class="flex-grow-1">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Alerts Center</h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary"><i class="fas fa-file-alt text-white"></i></div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success"><i class="fas fa-donate text-white"></i></div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= esc(session()->get('username')) ?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('assets/uploads/avatars/' . esc(session()->get('img_admin'))) ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item <?= $sub_judul === 'Profile' ? ' active' : '' ?>" href="<?= base_url('admin/profile') ?>"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>

                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->