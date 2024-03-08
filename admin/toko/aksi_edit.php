<?php
include '../../koneksi_database/koneksi.php';

// Check if form is submitted
if(isset($_POST['edit_data_toko'])) {
    // Retrieve form data
    $toko_nama = $_POST['nama_toko'];
    $alamat_toko = $_POST['edit_alamat_toko'];
    
    // Sanitize inputs to prevent SQL injection
    $toko_nama = mysqli_real_escape_string($koneksi, $toko_nama);
    $alamat_toko = mysqli_real_escape_string($koneksi, $alamat_toko);
    
    // Update the database
    $query = "UPDATE `toko` SET `nama`='$toko_nama',`alamat`='$alamat_toko'";
    $result = mysqli_query($koneksi, $query);
    
    if($result) {
        echo "
        <script>
        alert('Berhasil Di Ubah');
        document.location.href ='../?page=toko/edit_toko';
        </script>";
        exit(); // Ensure script execution stops after redirection
    } else {
        echo "Error updating data: " . mysqli_error($koneksi);
    }
}
?>
