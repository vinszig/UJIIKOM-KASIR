<?php 
session_start();

$id =$_GET['id'];

$cart =$_SESSION['cart'];

// mengambil data seacra spesifik
$kera = array_filter($cart,function ($var) use ($id) {
    return ($var['id']==$id);
});

foreach($kera as $key => $value){
    unset($_SESSION['cart'][$key]);
}

$_SESSION['cart'] = array_values($_SESSION['cart']);

header('location:../?page=penjualan/penjualan');

?>