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

if (!isset($_GET['nisn']) || $_GET['nisn'] == '') {
    header('Location:' . BASE_URL . '/admin/siswa');
    die();
}

$nisn = $_GET['nisn'];

$query = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn = '$nisn'");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil menghapus data siswa.');
            window.location.href = '" . BASE_URL . "/admin/siswa';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal menghapus data siswa !!');
            window.location.href = '" . BASE_URL . "/admin/siswa';
        </script>
    ";
}
