<?php

$id = $_GET['produkid'];
$edit_ini = mysqli_query($koneksi, "SELECT * FROM produk WHERE produkID ='$id'");

?>

<style>
    .table-data .order .form-edit{
        margin: 10px 300px;
    }
    .table-data .order .form-edit input{
        width: 350px;
    }
    @media screen and (max-width: 768px) {
        .table-data .order .form-edit{
            margin: 10px 20px;
        }
        .table-data .order .form-edit input{
            width: 250px;
        }
    }
</style>
<main>
    <div class="head-title">
        <!-- navigasi mini -->
        <div class="left">
            <h1>Edit Produk</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="?page=dashboard" class="active">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Edit Produk</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="form-edit">
                <form action="produk/aksi_edit.php" method="post">
                    <?php while ($edit_data_produk = mysqli_fetch_array($edit_ini)) { ?>
                        <label>Produk ID</label><br>
                        <input type="text" name="edit_id" value="<?php echo $edit_data_produk['produkID'] ?>" readonly><br><br>
                        <label for="edit_nama">Nama Produk</label><br>
                        <input type="text" name="edit_nama" id="edit_nama" value="<?php echo $edit_data_produk['nama_produk']; ?>" readonly><br><br>
                        <label for="edit_harga">Harga Produk</label><br>
                        <input type="number" name="edit_harga" id="edit_harga" value="<?php echo $edit_data_produk['harga']; ?>" readonly><br><br>
                        <label for="edit_stok">Stok Produk</label><br>
                        <input type="number" name="edit_stok" id="edit_stok" value="<?php echo $edit_data_produk['stok']; ?>"><br><br>
                        <input type="submit" value="Ubah" name="edit_data">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</main>