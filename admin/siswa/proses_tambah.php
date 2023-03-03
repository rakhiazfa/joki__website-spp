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

$nisn = htmlspecialchars($_POST['nisn']);
$nis = htmlspecialchars($_POST['nis']);
$nama = htmlspecialchars($_POST['nama']);
$id_kelas = htmlspecialchars($_POST['id_kelas']);
$no_telp = htmlspecialchars($_POST['no_telp']);
$alamat = htmlspecialchars($_POST['alamat']);

if ($nisn == '' || $nis == '' || $nama == '' || $id_kelas == '' || $no_telp == '' || $alamat == '') {

    echo "
        <script>
            alert('Silahkan lengkapi formulir !!');
            window.location.href = '" . BASE_URL . "/admin/siswa/tambah.php';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn = '$nisn' LIMIT 1");
$siswa = $query->fetch_assoc();

if ($siswa) {

    echo "
        <script>
            alert('NISN telah digunakan !!');
            window.location.href = '" . BASE_URL . "/admin/siswa/tambah.php';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis = '$nis' LIMIT 1");
$siswa = $query->fetch_assoc();

if ($siswa) {

    echo "
        <script>
            alert('NIS telah digunakan !!');
            window.location.href = '" . BASE_URL . "/admin/siswa/tambah.php';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "INSERT INTO siswa (nisn, nis, nama, id_kelas, no_telp, alamat) VALUES (
    '$nisn', '$nis', '$nama', '$id_kelas', '$no_telp', '$alamat'
)");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil menambahkan data siswa.');
            window.location.href = '" . BASE_URL . "/admin/siswa';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal menambahkan data siswa !!');
            window.location.href = '" . BASE_URL . "/admin/siswa/tambah.php';
        </script>
    ";
}
