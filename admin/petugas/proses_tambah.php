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

$nama_petugas = htmlspecialchars($_POST['nama_petugas']);
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

if ($nama_petugas == '' || $username == '' || $password == '') {

    echo "
        <script>
            alert('Silahkan lengkapi formulir !!');
            window.location.href = '" . BASE_URL . "/admin/petugas/tambah.php';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username = '$username' LIMIT 1");
$petugas = $query->fetch_assoc();

if ($petugas) {

    echo "
        <script>
            alert('Username telah digunakan !!');
            window.location.href = '" . BASE_URL . "/admin/petugas/tambah.php';
        </script>
    ";
    die();
}

$password = md5(SALT . $password . SALT);

$query = mysqli_query($koneksi, "INSERT INTO petugas (nama_petugas, username, password, level) VALUES (
    '$nama_petugas', '$username', '$password', 'petugas'
)");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil menambahkan data petugas.');
            window.location.href = '" . BASE_URL . "/admin/petugas';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal menambahkan data petugas !!');
            window.location.href = '" . BASE_URL . "/admin/petugas/tambah.php';
        </script>
    ";
}
