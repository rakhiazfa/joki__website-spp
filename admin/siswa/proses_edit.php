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

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn = '$nisn' LIMIT 1");
$siswa = $query->fetch_assoc();

$nisn = htmlspecialchars($_POST['nisn']);
$nis = htmlspecialchars($_POST['nis']);
$nama = htmlspecialchars($_POST['nama']);
$id_kelas = htmlspecialchars($_POST['id_kelas']);
$alamat = htmlspecialchars($_POST['alamat']);
$no_telp = htmlspecialchars($_POST['no_telp']);

$new_nisn = $nisn === '' ? $siswa['nisn'] : $nisn;
$new_nis = $nis === '' ? $siswa['nis'] : $nis;
$new_nama = $nama === '' ? $siswa['nama'] : $nama;
$new_id_kelas = $id_kelas === '' ? $siswa['id_kelas'] : $id_kelas;
$new_alamat = $alamat === '' ? $siswa['alamat'] : $alamat;
$new_no_telp = $no_telp === '' ? $siswa['no_telp'] : $no_telp;

$query = mysqli_query($koneksi, "UPDATE siswa 
SET nama = '$new_nama', nisn = '$new_nisn', nis = '$new_nis', no_telp = '$new_no_telp', id_kelas = '$new_id_kelas', alamat = '$new_alamat' 
WHERE nisn = '$nisn'");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil memperbarui data siswa.');
            window.location.href = '" . BASE_URL . "/admin/siswa/edit.php?nisn=$nisn';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal memperbarui data siswa !!');
            window.location.href = '" . BASE_URL . "/admin/siswa/edit.php?nisn=$nisn';
        </script>
    ";
}
