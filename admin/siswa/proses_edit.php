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

$query = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas = '$id' LIMIT 1");
$kelas = $query->fetch_assoc();

$nama_kelas = htmlspecialchars($_POST['nama_kelas']);
$kompetensi_keahlian = htmlspecialchars($_POST['kompetensi_keahlian']);

$new_nama_kelas = $nama_kelas === '' ? $kelas['nama_kelas'] : $nama_kelas;
$new_kompetensi_keahlian = $kompetensi_keahlian === '' ? $kelas['kompetensi_keahlian'] : $kompetensi_keahlian;

$query = mysqli_query($koneksi, "UPDATE kelas 
SET nama_kelas = '$new_nama_kelas', kompetensi_keahlian = '$new_kompetensi_keahlian' 
WHERE id_kelas = '$id'");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil memperbarui data kelas.');
            window.location.href = '" . BASE_URL . "/admin/kelas/edit.php?id=$id';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal memperbarui data kelas !!');
            window.location.href = '" . BASE_URL . "/admin/kelas/edit.php?id=$id';
        </script>
    ";
}
