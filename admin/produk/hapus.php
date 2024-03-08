<?php
// id di link
$id = $_GET['produkid'];
 
// Delete sql
$result = mysqli_query($koneksi, "DELETE FROM `produk` WHERE `produkID` ='$id'");
 

echo "
<script>
alert('Data  DiHapus');
document.location.href ='?page=produk/crud_barang';
</script>";

?>