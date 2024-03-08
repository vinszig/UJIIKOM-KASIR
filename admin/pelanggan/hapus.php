<?php
// id dari link
$id = $_GET['produkid'];
 
// Delete user
$result = mysqli_query($koneksi, "DELETE FROM `pelanggan` WHERE `pelangganID` ='$id'");
 

echo "
<script>
alert('Data  DiHapus');
document.location.href ='?page=pelanggan/pelanggan';
</script>";

?>