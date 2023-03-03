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
    header('Location:' . BASE_URL . '/admin/petugas');
    die();
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE level = 'petugas' AND id_petugas = '$id' LIMIT 1");

$petugas = $query->fetch_assoc();

$nama_petugas = htmlspecialchars($_POST['nama_petugas']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$new_nama_petugas = $nama_petugas === '' ? $petugas['nama_petugas'] : $nama_petugas;
$new_username = $username === '' ? $petugas['username'] : $username;
$new_password = $password === '' ? $petugas['password'] : md5(SALT . $password . SALT);

$query = mysqli_query($koneksi, "UPDATE petugas 
SET nama_petugas = '$new_nama_petugas', username = '$new_username', password = '$new_password' 
WHERE id_petugas = '$id'");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil memperbarui data petugas.');
            window.location.href = '" . BASE_URL . "/admin/petugas/edit.php?id=$id';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal memperbarui data petugas.');
            window.location.href = '" . BASE_URL . "/admin/petugas/edit.php?id=$id';
        </script>
    ";
}
