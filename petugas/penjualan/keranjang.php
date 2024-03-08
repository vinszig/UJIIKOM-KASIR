<?php 

if(isset($_POST['produkID'])){
    $idB =$_POST['produkID'];
    $qty =$_POST['qty'];
    $jual = mysqli_query($koneksi,"SELECT * FROM produk WHERE produkID='$idB'");
    $B =mysqli_fetch_assoc($jual);

    $barang = [
        'id' => $B['produkID'],
        'nama' => $B['nama_produk'],
        'harga' => $B['harga'],
        'qty' => $qty
    ];
    
    $_SESSION['cart'][]=$barang;
    krsort($_SESSION['cart']);

    header('location:?page=penjualan/penjualan');
}

?>