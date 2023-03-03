<?php

require_once __DIR__ . '/config/konfigurasi.php';
require_once __DIR__ . '/database/koneksi.php';

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username = '$username' LIMIT 1");
$petugas = $query->fetch_assoc();
