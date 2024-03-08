<?php
// kodingan excel yt bapa bapa

include "../../koneksi_database/koneksi.php";

$start_date = $_GET['tanggal_A'];
$end_date = $_GET['tanggal_Ak'];

$laporan = mysqli_query($koneksi, "SELECT detail_penjualan.*, 
        detail_penjualan.*, 
        produk.nama_produk, 
        produk.harga,
        penjualan.tanggal_penjualan,
        penjualan.kasir,
        pelanggan.nama_pelanggan
        FROM detail_penjualan 
        INNER JOIN produk ON detail_penjualan.produkID = produk.produkID
        INNER JOIN penjualan ON detail_penjualan.penjualanID = penjualan.penjualanID
        INNER JOIN pelanggan ON penjualan.pelangganID = pelanggan.pelangganID
        WHERE penjualan.tanggal_penjualan BETWEEN '$start_date' AND '$end_date';");

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan-kasir.xls");

?>

<table border="1" align="center" cellpadding="5">
    <thead style="background-color: green; color: white;">
        <tr>
            <th>NO</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Nama Pelanggan</th>
            <th>Nama Barang</th>
            <th>Qty</th>
            <th>Harga Satuan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_harga = 0; // Initialize total price variable
        $no = 1; // Initialize row counter

        if (isset($laporan)) {
            while ($lapor = mysqli_fetch_array($laporan)) {
                $total_harga += $lapor['harga']; // Add the price of each product to the total price

                // Display table rows
                echo "<tr>";
                echo "<td>{$no}</td>";
                echo "<td>{$lapor['tanggal_penjualan']}</td>";
                echo "<td>{$lapor['kasir']}</td>";
                echo "<td>{$lapor['nama_pelanggan']}</td>";
                echo "<td>{$lapor['nama_produk']}</td>";
                echo "<td>{$lapor['jumlah_produk']}</td>";
                echo "<td>" . number_format($lapor['harga'], 2) . "</td>"; // Format harga using number_format
                echo "</tr>";

                $no++; // Increment row counter
            }
        } else {
            echo "<tr><td colspan='7'>No data available</td></tr>";
        }
        ?>
    </tbody>
    <!-- Inside the table footer -->
    <tfoot style="background-color: yellow;">
        <tr>
            <td colspan="6" align="right">Total : </td>
            <td><?php echo number_format($total_harga, 2); ?></td> <!-- Format total_harga using number_format -->
        </tr>
    </tfoot>
</table>