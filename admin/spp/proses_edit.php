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

if (!isset($_GET['id']) || $_GET['id'] == '') {
    header('Location:' . BASE_URL . '/admin/spp');
    die();
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp = '$id' LIMIT 1");
$spp = $query->fetch_assoc();

$tahun = htmlspecialchars($_POST['tahun']);
$nominal = htmlspecialchars($_POST['nominal']);

$new_tahun = $tahun === '' ? $spp['tahun'] : $tahun;
$new_nominal = $nominal === '' ? $spp['nominal'] : $nominal;

$query = mysqli_query($koneksi, "UPDATE spp 
SET tahun = '$new_tahun', nominal = '$new_nominal' 
WHERE id_spp = '$id'");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil memperbarui data spp.');
            window.location.href = '" . BASE_URL . "/admin/spp/edit.php?id=$id';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal memperbarui data spp !!');
            window.location.href = '" . BASE_URL . "/admin/spp/edit.php?id=$id';
        </script>
    ";
}
