<?php

require_once __DIR__ . '/config/konfigurasi.php';
require_once __DIR__ . '/database/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . '/login.php');
    die();
}

if ($_SESSION['user']['level'] !== 'admin') {
    header('Location:' . BASE_URL . '/petugas');
    die();
}

$query = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_uang_spp FROM pembayaran");
$total_uang_spp = $query->fetch_assoc()['total_uang_spp'] ?? 0;

$query = mysqli_query($koneksi, "SELECT COUNT(*) AS count FROM petugas WHERE level = 'petugas'");
$total_petugas = $query->fetch_assoc()['count'] ?? 0;

$query = mysqli_query($koneksi, "SELECT COUNT(*) AS count FROM siswa");
$total_siswa = $query->fetch_assoc()['count'] ?? 0;

$query = mysqli_query($koneksi, "SELECT COUNT(*) AS count FROM pembayaran");
$total_transaksi = $query->fetch_assoc()['count'] ?? 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Pembayaran SPP</title>
    <link rel="shortcut icon" href="assets/dist/img/rrr.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/plugins/fontawesome-free/css/all.min.css' ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/dist/css/adminlte.min.css' ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css' ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo BASE_URL . '/assets/dist/img/rrr.png' ?>" alt="LOGO" height="60" width="60">
        </div>

        <?php include __DIR__ . '/templates/topbar.php' ?>

        <?php include __DIR__ . '/templates/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section>

                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Dashboard</h1>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <section class="content">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo 'Rp.'. number_format($total_uang_spp) ?></h3>

                                    <p>Total Uang SPP Masuk</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $total_petugas ?></h3>

                                    <p>Jumlah Petugas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $total_siswa ?></h3>

                                    <p>Jumlah Siswa</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-alt"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php echo $total_transaksi ?></h3>

                                    <p>Jumlah Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class='nav-icon fas fa-file-invoice'></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                </div>

            </section>

        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#">Ragil Anugraha</a>.</strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo BASE_URL . '/assets/plugins/bootstrap/js/bootstrap.bundle.min.js' ?>"></script>
    <!-- Moment JS -->
    <script src="<?php echo BASE_URL . '/assets/plugins/moment/moment.min.js' ?>"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo BASE_URL . '/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo BASE_URL . '/assets/dist/js/adminlte.min.js' ?>"></script>
</body>

</html>