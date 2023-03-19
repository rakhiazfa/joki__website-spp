<?php

require_once __DIR__ . '/../config/konfigurasi.php';
require_once __DIR__ . '/../database/koneksi.php';

$nisn = htmlspecialchars($_POST['nisn']);
$password = htmlspecialchars($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn = '$nisn' LIMIT 1");
$siswa = $query->fetch_assoc();

if ($siswa) {

    if ($siswa['password'] == $password) {
        $_SESSION['siswa'] = $siswa;

        header('Location:' . BASE_URL . '/siswa');
        die();
    } else {
        echo "
        <script>
            alert('Kata sandi salah !!');
            window.location.href = '" . BASE_URL . "/siswa/login.php';
        </script>
    ";
    }
} else {

    echo "
        <script>
            alert('NISN tidak ditemukan !!');
            window.location.href = '" . BASE_URL . "/siswa/login.php';
        </script>
    ";
}
