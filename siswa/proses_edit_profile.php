<?php

require_once __DIR__ . '/../config/konfigurasi.php';
require_once __DIR__ . '/../database/koneksi.php';

if (!isset($_SESSION['siswa'])) {
    header('Location:' . BASE_URL . '/siswa/login.php');
    die();
}

$nisn = $_POST['nisn'];

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn = '$nisn' LIMIT 1");
$siswa = $query->fetch_assoc();

$nisn = htmlspecialchars($_POST['nisn']);
$nis = htmlspecialchars($_POST['nis']);
$nama = htmlspecialchars($_POST['nama']);
$id_kelas = htmlspecialchars($_POST['id_kelas']);
$alamat = htmlspecialchars($_POST['alamat']);
$no_telp = htmlspecialchars($_POST['no_telp']);
$password = htmlspecialchars($_POST['password']);

$new_nisn = $nisn === '' ? $siswa['nisn'] : $nisn;
$new_nis = $nis === '' ? $siswa['nis'] : $nis;
$new_nama = $nama === '' ? $siswa['nama'] : $nama;
$new_id_kelas = $id_kelas === '' ? $siswa['id_kelas'] : $id_kelas;
$new_alamat = $alamat === '' ? $siswa['alamat'] : $alamat;
$new_no_telp = $no_telp === '' ? $siswa['no_telp'] : $no_telp;
$new_password = $password === '' ? $siswa['password'] : $password;

$query = mysqli_query($koneksi, "UPDATE siswa 
SET nama = '$new_nama', nisn = '$new_nisn', nis = '$new_nis', no_telp = '$new_no_telp', id_kelas = '$new_id_kelas', alamat = '$new_alamat', password = '$new_password'  
WHERE nisn = '$nisn'");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil memperbarui data siswa.');
            window.location.href = '" . BASE_URL . "/siswa/profile.php';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal memperbarui data siswa !!');
            window.location.href = '" . BASE_URL . "/siswa/profile.php';
        </script>
    ";
}
