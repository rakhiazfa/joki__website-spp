<?php

require_once __DIR__ . '/config/konfigurasi.php';

unset($_SESSION['user']);

header('Location:' . BASE_URL . '/login.php');
die();
