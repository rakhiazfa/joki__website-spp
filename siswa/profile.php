<?php

require_once __DIR__ . '/../config/konfigurasi.php';
require_once __DIR__ . '/../database/koneksi.php';

if (!isset($_SESSION['siswa'])) {
    header('Location:' . BASE_URL . '/siswa/login.php');
    die();
}

$nisn = $_SESSION['siswa']['nisn'];

$query = mysqli_query($koneksi, "SELECT * FROM siswa 
LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
WHERE siswa.nisn = '$nisn'");
$siswa = $query->fetch_assoc();

$transaksi = [];

$query = mysqli_query($koneksi, "SELECT * FROM pembayaran 
LEFT JOIN siswa ON pembayaran.nisn = siswa.nisn 
LEFT JOIN spp ON pembayaran.id_spp = spp.id_spp 
WHERE siswa.nisn = '$nisn' ORDER BY id_pembayaran DESC");

while ($row = $query->fetch_assoc()) {

    array_push($transaksi, $row);
}

$kelas = [];

$query = mysqli_query($koneksi, "SELECT * FROM kelas ORDER BY id_kelas DESC");

while ($row = $query->fetch_assoc()) {

    array_push($kelas, $row);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Saya | Pembayaran SPP</title>

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
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo BASE_URL . '/assets/dist/img/logo.png' ?>" alt="LOGO" height="60" width="60">
        </div> -->

        <?php include __DIR__ . '/../templates/topbar.php' ?>

        <?php include __DIR__ . '/../templates/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section>

                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Profile Saya</h1>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

            <section class="content">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?php echo BASE_URL . '/siswa/proses_edit_profile.php' ?>" method="post">

                                        <div class="row">

                                            <div class="input-group mb-3 col-md-6">
                                                <input type="text" class="form-control" name="nisn" value="<?php echo $siswa['nisn'] ?>" placeholder="NISN" readonly>
                                            </div>

                                            <div class="input-group mb-3 col-md-6">
                                                <input type="text" class="form-control" name="nis" value="<?php echo $siswa['nis'] ?>" placeholder="NIS" readonly>
                                            </div>

                                            <div class="input-group mb-3 col-md-6">
                                                <input type="text" class="form-control" name="nama" value="<?php echo $siswa['nama'] ?>" placeholder="Nama Siswa">
                                            </div>

                                            <div class="input-group mb-3 col-md-6">
                                                <select name="id_kelas" class="form-control">
                                                    <?php foreach ($kelas as $item) { ?>
                                                        <option value="<?php echo $item['id_kelas'] ?>" <?php echo $item['id_kelas'] == $siswa['id_kelas'] ? 'selected' : '' ?>>
                                                            <?php echo ($item['nama_kelas'] ?? '') . ' ' . ($item['kompetensi_keahlian'] ?? '') ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="input-group mb-3 col-md-12">
                                                <input type="number" class="form-control" name="no_telp" value="<?php echo $siswa['no_telp'] ?>" placeholder="Nomor Telepon Siswa">
                                            </div>

                                            <div class="input-group mb-3 col-md-12">
                                                <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat Siswa"><?php echo $siswa['alamat'] ?></textarea>
                                            </div>

                                            <div class="input-group mb-3 col-md-12">
                                                <input type="text" class="form-control" name="password" value="<?php echo $siswa['password'] ?>" placeholder="Kata Sandi">
                                            </div>

                                        </div>

                                        <div class="row d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary btn-block">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    <script src="<?php echo BASE_URL . '/assets/plugins/jquery/jquery.min.js' ?>"></script>
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