<?php
// Get id from URL to delete that user
$id = $_GET['produkid'];
 
// Delete user row from table based on given id
$result = mysqli_query($koneksi, "DELETE FROM `produk` WHERE `produkID` ='$id'");
 
// After delete redirect to Home, so that latest user list will be displayed.
echo "
<script>
alert('Data  DiHapus');
document.location.href ='?page=produk/crud_barang';
</script>";

?>