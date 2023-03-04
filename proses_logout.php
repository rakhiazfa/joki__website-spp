<?php

require_once __DIR__ . '/config/konfigurasi.php';

unset($_SESSION['user']);
unset($_SESSION['siswa']);

header('Location:' . BASE_URL . '/login.php');
die();
