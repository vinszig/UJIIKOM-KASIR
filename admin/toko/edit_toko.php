<?php

$edit_ini = mysqli_query($koneksi, "SELECT * FROM toko");

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
            <h1>Edit Toko</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="?page=dashboard" class="active">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Edit Toko</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="form-edit">
                <form action="toko/aksi_edit.php" method="post">
                    <?php while ($edit_data_toko = mysqli_fetch_array($edit_ini)) { ?>
                        <label for="nama_toko">Nama Toko</label><br>
                        <input type="text" name="nama_toko" id="nama_toko" value="<?php echo $edit_data_toko['nama']; ?>"><br><br>
                        <label for="edit_alamat_toko">Alamat</label><br>
                        <textarea name="edit_alamat_toko" id="edit_alamat_toko" cols="45" rows="10"><?php echo $edit_data_toko['alamat']; ?></textarea><br><br>
                        <input type="submit" value="Ubah" name="edit_data_toko">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</main>