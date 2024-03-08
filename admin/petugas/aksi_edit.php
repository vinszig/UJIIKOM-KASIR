<?php
include '../../koneksi_database/koneksi.php';

// tombol submit di form
if(isset($_POST['edit_data_pegawai'])) {
    
    $edit_username = $_POST['edit_username'];
    $edit_nama_pegawai = $_POST['edit_nama_pegawai'];
    $edit_password = $_POST['edit_password'];
    
    //mencegah injeksi sql 
    $edit_username = mysqli_real_escape_string($koneksi, $edit_username);
    $edit_nama_pegawai = mysqli_real_escape_string($koneksi, $edit_nama_pegawai);
    $edit_password = mysqli_real_escape_string($koneksi, $edit_password);
    
    // Update  database
    $id = $_POST['edit_id'];
    $query = "UPDATE `organisasi` SET `username`='$edit_username',`nama`='$edit_nama_pegawai',`password`='$edit_password' 
    WHERE id ='$id'";
    $result = mysqli_query($koneksi, $query);
    
    if($result) {
        echo "
        <script>
        alert('Berhasil Di Ubah');
        document.location.href ='../?page=petugas/crud_pegawai';
        </script>";
        exit(); 
    } else {
        echo "Error updating data: " . mysqli_error($koneksi);
    }
}
?>
