<?php

require_once __DIR__ . '/../config/konfigurasi.php';
require_once __DIR__ . '/../database/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . '/login.php');
    die();
}

$id_petugas = $_SESSION['user']['id_petugas'];
$nisn = htmlspecialchars($_POST['nisn'] ?? '');
$tgl_bayar = htmlspecialchars($_POST['tgl_bayar'] ?? '');
$jumlah_bayar = htmlspecialchars($_POST['jumlah_bayar'] ?? '');

$bulan_dibayar = date('m', strtotime($tgl_bayar));
$tahun_dibayar = date('Y', strtotime($tgl_bayar));

$query = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun = '$tahun_dibayar'");
$spp = $query->fetch_assoc();

if (!$spp) {

    echo "
        <script>
            alert('Data SPP tidak ditemukan !!');
            window.location.href = '" . BASE_URL . "/transaksi';
        </script>
    ";
    die();
}

if ($nisn == '' || $tgl_bayar == '' || $jumlah_bayar == '') {

    echo "
        <script>
            alert('Silahkan lengkapi formulir !!');
            window.location.href = '" . BASE_URL . "/transaksi';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_dibayar FROM pembayaran 
WHERE nisn = '$nisn' AND tahun_dibayar = '$tahun_dibayar'");
$total_dibayar = $query->fetch_assoc()['total_dibayar'] ?? 0;

$id_spp = $spp['id_spp'];
$sisa_bayar = $spp['nominal'] - $total_dibayar - $jumlah_bayar;

if ($spp['nominal'] - $total_dibayar == 0) {

    echo "
        <script>
            alert('Siswa telah melunasi SPP !!');
            window.location.href = '" . BASE_URL . "/transaksi';
        </script>
    ";
    die();
}

$query = mysqli_query($koneksi, "INSERT INTO pembayaran (id_petugas, nisn, tgl_bayar, tahun_dibayar, bulan_dibayar, id_spp, jumlah_bayar, sisa_bayar) VALUES (
    '$id_petugas', '$nisn', '$tgl_bayar', '$tahun_dibayar', '$bulan_dibayar', '$id_spp', '$jumlah_bayar', '$sisa_bayar'
)");

if (mysqli_affected_rows($koneksi) > 0) {

    echo "
        <script>
            alert('Berhasil menambahkan data transaksi.');
            window.location.href = '" . BASE_URL . "/riwayat_transaksi';
        </script>
    ";
} else {

    echo "
        <script>
            alert('Gagal menambahkan data transaksi !!');
            window.location.href = '" . BASE_URL . "/transaksi';
        </script>
    ";
}
