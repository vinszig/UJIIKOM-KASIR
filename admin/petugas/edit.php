<?php

$id = $_GET['id'];
$edit_ini = mysqli_query($koneksi, "SELECT * FROM organisasi WHERE level='pegawai' and id ='$id'");

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
            <h1>Edit Pegawai</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="?page=dashboard" class="active">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Edit Pegawai</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-data">
        <div class="order">
            <div class="form-edit">
                <form action="petugas/aksi_edit.php" method="post">
                    <?php while ($edit_data_pegawai = mysqli_fetch_array($edit_ini)) { ?>
                        <label>ID</label><br>
                        <input type="text" name="edit_id" value="<?php echo $edit_data_pegawai['id'] ?>" readonly><br><br>
                        <label for="edit_username">Username</label><br>
                        <input type="text" name="edit_username" id="edit_username" value="<?php echo $edit_data_pegawai['username']; ?>"><br><br>
                        <label for="edit_nama_pegawai">Nama</label><br>
                        <input type="text" name="edit_nama_pegawai" id="edit_nama_pegawai" value="<?php echo $edit_data_pegawai['nama']; ?>"><br><br>
                        <label for="edit_password">Password</label><br>
                        <input type="text" name="edit_password" id="edit_password" value="<?php echo $edit_data_pegawai['password']; ?>"><br><br>
                        <input type="submit" value="Ubah" name="edit_data_pegawai">
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</main>