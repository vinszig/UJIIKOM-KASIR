<?php
include '../../koneksi_database/koneksi.php';

// tombol submir=t
if(isset($_POST['edit_data'])) {
    $edit_nama = $_POST['edit_nama'];
    $edit_harga = $_POST['edit_harga'];
    $edit_stok = $_POST['edit_stok'];
    
    // cegah sql injeksi
    $edit_nama = mysqli_real_escape_string($koneksi, $edit_nama);
    $edit_harga = mysqli_real_escape_string($koneksi, $edit_harga);
    $edit_stok = mysqli_real_escape_string($koneksi, $edit_stok);
    
    // Update database
    $id = $_POST['edit_id'];
    $query = "UPDATE `produk` SET `nama_produk`='$edit_nama', `harga`='$edit_harga', `stok`='$edit_stok' WHERE `produkID`='$id'";
    $result = mysqli_query($koneksi, $query);
    
    if($result) {
        echo "
        <script>
        alert('Berhasil Di Ubah');
        document.location.href ='../?page=produk/crud_barang';
        </script>";
        exit(); 
    } else {
        echo "Error updating data: " . mysqli_error($koneksi);
    }
}
?>
