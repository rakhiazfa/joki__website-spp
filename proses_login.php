<?php

require_once __DIR__ . '/config/konfigurasi.php';
require_once __DIR__ . '/database/koneksi.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username = '$username' LIMIT 1");
$petugas = $query->fetch_assoc();

if ($petugas) {

    $cek_password = md5(SALT . $password . SALT) === $petugas['password'];

    if ($cek_password) {

        $_SESSION['user'] = $petugas;

        header('Location:' . BASE_URL);
        die();
    } else {

        echo "
            <script>
                alert('Username atau password salah.');
                window.location.href = '" . BASE_URL . "/login.php';
            </script>
        ";
    }
} else {

    echo "
        <script>
            alert('Username atau password salah.');
            window.location.href = '" . BASE_URL . "/login.php';
        </script>
    ";
}
