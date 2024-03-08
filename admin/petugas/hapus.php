<?php
// id dari link
$id = $_GET['id'];
 
// Delete 
$result = mysqli_query($koneksi, "DELETE FROM `organisasi` WHERE level='pegawai' and `id` ='$id'");
 
echo "
<script>
alert('Data  DiHapus');
document.location.href ='?page=petugas/crud_pegawai';
</script>";

?>