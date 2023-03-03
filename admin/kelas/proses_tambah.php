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

$nama_kelas = htmlspecialchars($_POST['nama_kelas']);
$kompetensi_keahlian = htmlspecialchars($_POST['kompetensi_keahlian']);

if ($nama_kelas == '' || $kompetensi_keahlian == '') {

    echo "
        <script>
            alert('Silahkan lengkapi formulir !!');
            window.location.href = '" . BASE_URL . "/admin/kelas/tambah.php';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas, kompetensi_keahlian) VALUES (
    '$nama_kelas', '$kompetensi_keahlian'
)");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil menambahkan data kelas.');
            window.location.href = '" . BASE_URL . "/admin/kelas';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal menambahkan data kelas !!');
            window.location.href = '" . BASE_URL . "/admin/kelas/tambah.php';
        </script>
    ";
}
