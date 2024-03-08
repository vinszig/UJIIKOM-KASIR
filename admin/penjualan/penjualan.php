<?php
$barang = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok > 0");
$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE pelangganID != 3;");

$sum = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += $value['harga'] * $value['qty'];
    }
};

// print_r($_SESSION)
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
                    <a class="active" href="#">Penjualan</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="todo">
            <form action="?page=penjualan/keranjang" method="post">
                <input type="text" id="search" placeholder="Cari barang...">
                <select id="produkSelect" name="produkID">
                    <option value="">Pilih Barang</option>
                    <?php while ($roow = mysqli_fetch_array($barang)) { ?>
                        <option value="<?php echo $roow['produkID'] ?>">
                            <p align="right"><?php echo $roow['nama_produk'] ?> | Stok: <?php echo $roow['stok'] ?></p>
                        </option>
                    <?php } ?>
                </select>
                <input type="number" name="qty" placeholder="Jumlah" required>
                <button type="submit">Tambah</button>
            </form>
        </div>
    </div>

    </script>
    <script>
        const searchInput = document.getElementById('search');
        const produkSelect = document.getElementById('produkSelect');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();
            const options = produkSelect.options;

            for (let i = 0; i < options.length; i++) {
                const option = options[i];
                const text = option.text.toLowerCase();

                if (text.includes(searchTerm)) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            }
        });
    </script>
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>KERANJANG</h3>
            </div>
            <form action="penjualan/update_keranjang.php" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (empty($_SESSION['cart'])) {
                            echo "Silakan Pilih Barang <br><br>";
                        } else {
                            foreach ($_SESSION['cart'] as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $value['nama'] ?></td>
                                    <td><?php echo number_format($value['harga']) ?></td>
                                    <td class="qty"><input type="number" name="qty[]" value="<?php echo $value['qty'] ?>"></td>
                                    <td><?php echo number_format($value['qty'] * $value['harga']) ?></td>
                                    <td><a href="penjualan/hapus_keranjang.php?id=<?php echo $value['id'] ?>"><i class='bx bxs-trash-alt'></i></a></td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
                <br>
                <hr><br>
                <p style="text-align: left;">
                    <input type="submit" value="Update qty" class="update_qty">
                    <a href="?page=penjualan/reset_keranjang">Reset Keranjang<i class='bx bx-reset'></i></a>
                </p>
            </form>
        </div>
        <div class="todo">
            <div class="pembayaran">
                <h4>Total Harga :</h4>
                <center>
                    <h3 style="margin: 0 auto;">Rp. <?php echo number_format($sum); ?></h3>
                </center><br>
                <h4>Di Bayar :</h4>
                <form action="penjualan/transaksi.php" method="post">
                    <input type="hidden" name="total" value="<?php echo $sum; ?>">
                    <h3> <input type="text" name="bayar" id="bayar" placeholder="jumlah bayar"></h3>
                    <select name="pelangganID">
                        <option value="3">Member ?</option>
                        <?php while ($member = mysqli_fetch_array($pelanggan)) { ?>
                            <option value="<?php echo $member['pelangganID'] ?>"><?php echo $member['nama_pelanggan'] ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit">Bayar</button>
                </form>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    //inisial intputan
    var bayar = document.getElementById('bayar');

    bayar.addEventListener('keyup', function(e) {
        bayar.value = formatRupiah(this.value, 'Rp. ');
        // harga = cleanRupiah (dengan rupiah.value);
        // calculate(harga,service.value);
    });

    // format untuk mmebuat anagka menjadi rupiah
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return (prefix || 'Rp.') + rupiah;
    }


    function cleanRupiah(rupiah) {
        var clean = rupiah.replace(/\D/g, '');
        return clean;
        // console.log(clean);

    }
</script>