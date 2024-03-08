<?php
session_start();
include_once "../../koneksi_database/koneksi.php";

$id_t = $_GET['pejuid'];
$pela =$_GET['pelaID']; 


$pembeli = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelangganID ='$pela'");
$data = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE penjualanID ='$id_t'");
$tk = mysqli_query($koneksi, "SELECT * FROM toko");

$data_pemebeli = mysqli_fetch_assoc($pembeli);
$toko = mysqli_fetch_assoc($tk);
$transaksi = mysqli_fetch_assoc($data);

$detail = mysqli_query($koneksi, "SELECT detail_penjualan.*, produk.nama_produk, produk.harga
FROM detail_penjualan 
INNER JOIN produk ON detail_penjualan.produkID = produk.produkID 
WHERE detail_penjualan.penjualanID = '$id_t'");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Toko</title>
    <style>
        body {
            color: #a7a7a7;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            window.print();
        });
    </script>
</head>

<body>
    <div align="center">
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr>
                <th style="text-transform: uppercase;">
                    <?php echo $toko['nama'] ?><br>
                    <?php echo $toko['alamat'] ?>
                </th>
            </tr>
            <tr align="center">
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td style="text-transform: capitalize;"><?php echo $transaksi['tanggal_penjualan'] ?> <?php echo $transaksi['kasir'] ?></td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="3" cellspacing="0">
            <?php while ($rew = mysqli_fetch_array($detail)) { ?>
                <tr>
                    <td><?php echo $rew['nama_produk'] ?></td>
                    <td><?php echo $rew['jumlah_produk'] ?></td>
                    <td align="right"><?php echo number_format($rew['harga']) ?></td>
                    <td align="right"><?php echo number_format($rew['subtotal']) ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4">
                    <hr>
                </td>
            </tr>
            <tr>
                <td align="right" colspan="3">Total</td>
                <td align="right"><?php echo number_format($transaksi['total_harga'] ) ?></td>
            </tr>
            <tr>
                <td align="right" colspan="3">Bayar</td>
                <td align="right"><?php echo number_format($transaksi['bayar']) ?></td>
            </tr>
            <tr>
                <td align="right" colspan="3">Kembali</td> 
                <td align="right"><?php echo number_format($transaksi['kembali']) ?></td>
            </tr>

        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <th style="text-transform: uppercase;">=========TERIMA KASIH <?php echo $data_pemebeli['nama_pelanggan'] ?>=========</th>
            </tr>
        </table>
    </div>
</body>

</html>