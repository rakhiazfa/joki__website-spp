<?php

require_once __DIR__ . '/config/konfigurasi.php';
require_once __DIR__ . '/database/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location:' . BASE_URL . '/login.php');
    die();
}

if (!isset($_GET['id']) || $_GET['id'] == '') {
    header('Location:' . BASE_URL . '/riwayat_transaksi');
    die();
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM pembayaran 
JOIN siswa ON pembayaran.nisn = siswa.nisn 
LEFT JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
WHERE id_pembayaran = '$id' LIMIT 1");
$transaksi = $query->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-spacing: 0;
            text-align: left;
        }

        table th,
        table td {
            padding: 0.5rem;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 0.5rem 1rem;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 3rem 1rem;
        }

        @media screen and (min-width: 768px) {
            .container {
                padding: 3rem 3rem;
            }
        }

        @media screen and (min-width: 1024px) {
            .container {
                max-width: 1280px;
            }
        }
    </style>

    <title></title>
</head>

<body>

    <div class="container">

        <h1 style="text-transform: uppercase; text-align: center;">BUKTI TRANSAKSI SMK BALAI PERGURUAN PUTRI BANDUNG</h1>
        <br>
        <h3 style="text-transform: uppercase; text-align: center;">Jl. Van Deventer No. 14 Bandung</h3>
        <br>

        <hr>

        <br>

        <table>
            <tr>
                <th style="width: 150px;">Nama</th>
                <th>: <?php echo $transaksi['nama'] ?></th>
            </tr>
            <tr>
                <th style="width: 150px;">Kelas</th>
                <th>: <?php echo $transaksi['nama_kelas'] ?? '' ?> <?php echo $transaksi['kompetensi_keahlian'] ?? '' ?></th>
            </tr>
        </table>

        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah Yang Dibayar</th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <td>1</td>
                    <td><?php echo $transaksi['tgl_bayar'] ?></td>
                    <td><?php echo number_format($transaksi['jumlah_bayar']) ?></td>
                </tr>
            </thead>
        </table>

    </div>

    <!-- <script>
        window.print();

        window.onafterprint = function() {
            window.location.href = '<?php echo BASE_URL . '/riwayat_transaksi' ?>';
        };
    </script> -->

</body>

</html>