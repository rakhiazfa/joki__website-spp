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

$tahun = htmlspecialchars($_POST['tahun']);
$nominal = htmlspecialchars($_POST['nominal']);

if ($tahun == '' || $nominal == '') {

    echo "
        <script>
            alert('Silahkan lengkapi formulir !!');
            window.location.href = '" . BASE_URL . "/admin/spp/tambah.php';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "INSERT INTO spp (tahun, nominal) VALUES (
    '$tahun', '$nominal'
)");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil menambahkan data spp.');
            window.location.href = '" . BASE_URL . "/admin/spp';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal menambahkan data spp !!');
            window.location.href = '" . BASE_URL . "/admin/spp/tambah.php';
        </script>
    ";
}
