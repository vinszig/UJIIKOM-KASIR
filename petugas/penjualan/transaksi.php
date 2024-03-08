<?php
session_start();
include_once "../../koneksi_database/koneksi.php";
$bayar  = preg_replace('/\D/', '', $_POST['bayar']);

$tanggal_penjualan = date('Y-m-d H:i:s');
$total_harga = $_POST['total'];
$kasir__ = $_SESSION['username']; 
$kueri_kasir = mysqli_query($koneksi, "SELECT `nama` FROM `organisasi` WHERE username = '$kasir__'");
$kokookok = mysqli_fetch_assoc($kueri_kasir);
$kasir = $kokookok['nama'];
$member = $_POST['pelangganID'];
$kembali = $bayar - $total_harga;

mysqli_query($koneksi, "INSERT INTO `penjualan`(`tanggal_penjualan`, `total_harga`,`pelangganID`,`bayar`, `kembali`, `kasir`) 
            VALUES ('$tanggal_penjualan','$total_harga','$member','$bayar','$kembali','$kasir')");

$id_transaksi = mysqli_insert_id($koneksi);

foreach ($_SESSION['cart'] as $key => $value) {
    $produkId = $value['id'];
    $harga = $value['harga'];
    $qty = $value['qty'];
    $subtotal = $harga * $qty;

    mysqli_query($koneksi, "INSERT INTO `detail_penjualan`(`penjualanID`, `produkID`, `jumlah_produk`, `subtotal`) 
    VALUES ('$id_transaksi','$produkId','$qty','$subtotal')");

    //pengurang stok barang
    $stok = mysqli_query($koneksi, "SELECT `stok` FROM `produk` WHERE `produkID`='$produkId'");
    $s_row = mysqli_fetch_assoc($stok);
    $currentStok = $s_row['stok'];

    // stok dikurangi pembelian
    $newStok = $currentStok - $qty;

    // Update databse
    mysqli_query($koneksi, "UPDATE `produk` SET `stok`='$newStok' WHERE `produkID`='$produkId'");
}

$_SESSION['cart'] = [];

header('location:../penjualan/transaksi_selesai.php?pejuid=' . $id_transaksi . '&pelaID=' . $member);
