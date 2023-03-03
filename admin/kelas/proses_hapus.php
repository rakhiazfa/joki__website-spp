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
    header('Location:' . BASE_URL . '/admin/kelas');
    die();
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas = '$id'");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil menghapus data kelas.');
            window.location.href = '" . BASE_URL . "/admin/kelas';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal menghapus data kelas !!');
            window.location.href = '" . BASE_URL . "/admin/kelas';
        </script>
    ";
}
