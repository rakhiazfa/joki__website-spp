<?php

require_once __DIR__ . '/../../config/konfigurasi.php';
require_once __DIR__ . '/../../database/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . '/login.php');
    die();
}

if ($_SESSION['user']['level'] !== 'admin') {
    header('Location:' . BASE_URL . '/petugas');
    die();
}

$siswa = [];

$query = mysqli_query($koneksi, "SELECT * FROM siswa LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas ORDER BY nisn DESC");

while ($row = $query->fetch_assoc()) {

    array_push($siswa, $row);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Siswa | Pembayaran SPP</title>
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

    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css' ?>">
    <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css' ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo BASE_URL . '/assets/dist/img/logo.png' ?>" alt="LOGO" height="60" width="60">
        </div> -->

        <?php include __DIR__ . '/../../templates/topbar.php' ?>

        <?php include __DIR__ . '/../../templates/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section>

                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Daftar Siswa</h1>
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
                                <div class="card-header">
                                    <h3 class="card-title">Daftar Siswa</h3>
                                    <div class="card-tools">
                                        <a href="<?php echo BASE_URL . '/admin/siswa/tambah.php' ?>" class="btn btn-primary">
                                            Tambah Siswa
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped dataTable dtr-inline collapsed" id="siswa">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th>NISN</th>
                                                <th>NIS</th>
                                                <th>Nama Siswa</th>
                                                <th>Kelas</th>
                                                <th>Alamat</th>
                                                <th>No telepon</th>
                                                <th style="width: 40px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1 ?>
                                            <?php foreach ($siswa as $item) { ?>
                                                <tr>
                                                    <td><?php echo $nomor++ ?></td>
                                                    <td><?php echo $item['nisn'] ?? '' ?></td>
                                                    <td><?php echo $item['nis'] ?? '' ?></td>
                                                    <td><?php echo $item['nama'] ?? '' ?></td>
                                                    <td>
                                                        <?php echo ($item['nama_kelas'] ?? '') . ' ' . ($item['kompetensi_keahlian'] ?? '') ?>
                                                    </td>
                                                    <td><?php echo $item['alamat'] ?? '' ?></td>
                                                    <td><?php echo $item['no_telp'] ?? '' ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center" style="gap: 1rem;">
                                                            <a class="btn btn-primary p-1" href="<?php echo BASE_URL . '/admin/siswa/detail.php?nisn=' . $item['nisn'] ?>">
                                                                Detail
                                                            </a>

                                                            <a class="btn btn-primary p-1" href="<?php echo BASE_URL . '/admin/siswa/edit.php?nisn=' . $item['nisn'] ?>">Edit</a>

                                                            <a class="btn btn-danger p-1" onclick="return confirm('Yakin ingin menghapus data ini?')" href="<?php echo BASE_URL . '/admin/siswa/proses_hapus.php?nisn=' . $item['nisn'] ?>">
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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

    <script src="<?php echo BASE_URL . '/assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-buttons/js/buttons.html5.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-buttons/js/buttons.print.min.js' ?>"></script>
    <script src="<?php echo BASE_URL . '/assets/plugins/datatables-buttons/js/buttons.colVis.min.js' ?>"></script>

    <script>
        $(function() {
            $("#siswa").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": []
            }).buttons().container().appendTo('#siswa_wrapper .col-md-6:eq(0)');

        });
    </script>
</body>

</html>