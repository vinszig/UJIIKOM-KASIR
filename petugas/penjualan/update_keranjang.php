<?php 
session_start();

$qty =$_POST['qty'];

print_r($_SESSION['cart']);

foreach($_SESSION['cart'] as $key => $value){
    $_SESSION['cart'][$key]['qty'] =$qty[$key];
}

header('location:../?page=penjualan/penjualan');

?>