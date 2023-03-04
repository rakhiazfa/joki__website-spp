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

$transaksi = [];

$query = mysqli_query($koneksi, "SELECT * FROM pembayaran 
LEFT JOIN siswa ON pembayaran.nisn = siswa.nisn 
LEFT JOIN spp ON pembayaran.id_spp = spp.id_spp 
ORDER BY id_pembayaran DESC");

while ($row = $query->fetch_assoc()) {

    array_push($transaksi, $row);
}

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

        <h1 style="text-transform: uppercase; text-align: center;">LAPORAN TRANSAKSI SMK BALAI PERGURUAN PUTRI BANDUNG</h1>
        <br>
        <h3 style="text-transform: uppercase; text-align: center;">Jl. Van Deventer No. 14 Bandung</h3>
        <br>

        <hr>

        <br>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th style="width: 10px">No</th>
                    <th>NISN</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal Bayar</th>
                    <th>Jumlah Bayar</th>
                    <th>Sisa Yang Harus Dibayar</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor = 1 ?>

                <?php foreach ($transaksi as $item) { ?>

                    <tr>
                        <td><?php echo $nomor++ ?></td>
                        <td><?php echo $item['nisn'] ?? '' ?></td>
                        <td><?php echo $item['nama'] ?? '' ?></td>
                        <td>
                            <?php echo date('d F Y', strtotime($item['tgl_bayar'])) ?>
                        </td>
                        <td><?php echo number_format($item['jumlah_bayar'] ?? 0) ?></td>
                        <td>
                            <?php if (isset($item['sisa_bayar']) && $item['sisa_bayar'] <= 0) { ?>
                                <div class="badge badge-success">Lunas</div>
                            <?php } else { ?>
                                <?php echo number_format($item['sisa_bayar'] ?? 0) ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <script>
        window.print();

        window.onafterprint = function() {
            window.location.href = '<?php echo BASE_URL . '/riwayat_transaksi' ?>';
        };
    </script>

</body>

</html>