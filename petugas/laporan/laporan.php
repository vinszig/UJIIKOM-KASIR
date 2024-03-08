<?php

// chat gpt

// Initialize flag to indicate if date range is specified
$dateSpecified = false;

// Initialize start and end dates with today's date
$start_date = date("Y-m-d");
$end_date = date("Y-m-d");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if date inputs are not empty
    if (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
        // Retrieve selected date range
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Adjust SQL query to include WHERE clause for date range
        $laporan = mysqli_query($koneksi, "SELECT detail_penjualan.*, 
        produk.nama_produk, 
        produk.harga,
        penjualan.tanggal_penjualan,
        penjualan.kasir
        FROM detail_penjualan 
        INNER JOIN produk ON detail_penjualan.produkID = produk.produkID
        INNER JOIN penjualan ON detail_penjualan.penjualanID = penjualan.penjualanID
        WHERE penjualan.tanggal_penjualan BETWEEN '$start_date' AND '$end_date';");

        // Set flag to indicate date range is specified
        $dateSpecified = true;
    }
}
?>

<main>
    <div class="head-title">
        <!-- navigasi mini -->
        <div class="left">
            <ul class="breadcrumb">
                <li>
                    <a href="?page=dashboard" class="active">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Pencetakan Laporan</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="todo">
            <form method="POST" action="">
                <div class="head">
                    <h5>
                        PERIODE : &nbsp; <input type="date" name="start_date" id="start_date" value="<?php echo $start_date; ?>"> s/d
                        <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>"> <button type="submit">CARI</button>
                    </h5>
                </div>
            </form>
        </div>
    </div>

    <div class="table-data">
        <div class="laporan">
            <div class="head">
                <h3>KERANJANG</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Tanggal</th>
                        <th>Kasir</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_harga = 0; // Initialize total price variable
                    $no = 1; // Initialize row counter

                    if (isset($laporan)) {
                        while ($lapor = mysqli_fetch_array($laporan)) {
                            $total_harga += $lapor['subtotal']; // Add the price of each product to the total price

                            // Display table rows
                            echo "<tr>";
                            echo "<td>{$no}</td>";
                            echo "<td>{$lapor['tanggal_penjualan']}</td>";
                            echo "<td>{$lapor['kasir']}</td>";
                            echo "<td>{$lapor['nama_produk']}</td>";
                            echo "<td>{$lapor['jumlah_produk']}</td>";
                            echo "<td>" . number_format($lapor['subtotal'], 2) . "</td>"; // Format harga using number_format
                            echo "</tr>";

                            $no++; // Increment row counter
                        }
                    } else {
                        echo "<tr><td colspan='6' style='color:blue;'>Cari Tanggal Yang Tepat atau Data Memang Tidak Ada</td></tr>";
                    }
                    ?>
                </tbody>
                <!-- Inside the table footer -->
                <tfoot>
                    <tr>
                        <td colspan="5">Total:</td>
                        <td><?php echo number_format($total_harga, 2); ?></td> <!-- Format total_harga using number_format -->
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>

    <div class="table-data">
        <div class="todo">
            <h5>
                <a href="./laporan/laporan_exel.php?tanggal_A=<?php echo $start_date; ?>&tanggal_Ak=<?php echo $end_date; ?>" class="btn-exel" target="_blank">
                    <i class='bx bx-list-plus'></i>
                    <span class="text">Download Exel</span>
                </a>
            </h5>
        </div>
    </div>


</main>