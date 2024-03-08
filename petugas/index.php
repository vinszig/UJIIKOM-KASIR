<?php
session_start();

require '../koneksi_database/koneksi.php';
$petugas = $_SESSION['username'];
$user = mysqli_query($koneksi, "SELECT * FROM organisasi WHERE username = '$petugas'");
$row = mysqli_fetch_assoc($user);


// cek apakah yang mengakses halaman ini sudah login dan berlevel petugas
if (empty($_SESSION['level']) || $_SESSION['level'] !== "pegawai") {
	header("location:../form/");
	exit(); // menghentikan eksekusi kode setelah mengarahkan header
} else {
	// Jika sudah login dan levelnya adalah "petugas", lanjutkan eksekusi halaman ini
}

//ini buat hitung pegawai
$jumlah_pegawai = "SELECT COUNT(*) as total FROM organisasi WHERE level='pegawai'";
$pegawai = $koneksi->query($jumlah_pegawai);
if ($pegawai) {
	// Ambil hasil query
	$row_pegawai = $pegawai->fetch_assoc();
	$total_pegawai = $row_pegawai['total'];
} else {
	// Jika query gagal dieksekusi
	$total_pegawai = 0;
}
$pegawai->free();

//ini buat hitung produk
$jumlah_produk = "SELECT COUNT(*) as total FROM produk";
$produk = $koneksi->query($jumlah_produk);
if ($produk) {
	// Ambil hasil query
	$row_produk = $produk->fetch_assoc();
	$total_produk = $row_produk['total'];
} else {
	// Jika query gagal dieksekusi
	$total_produk = 0;
}

$produk->free();


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/popup_form.css">

	<title>PETUGAS KASIR</title>
</head>

<body>


	<!-- SIDEBAR Atas-->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bx-calculator'></i>
			<span class="text">petugas Kasir</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="?page=dashboard">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="?page=produk/crud_barang">
					<i class='bx bxs-package'></i>
					<span class="text">Produk</span>
				</a>
			</li>
			<li>
				<a href="?page=penjualan/penjualan">
					<i class='bx bx-money'></i>
					<span class="text">Penjualan</span>
				</a>
			</li>
			<li>
				<a href="?page=laporan/laporan">
					<i class='bx bx-file'></i>
					<span class="text">Laporan</span>
				</a>
			</li>

			<!-- bagian bawah sidebar-->
		</ul>
		<ul class="side-menu">
			
			<li>
				<a href="../form/logout.php" class="logout" onclick="return confirm('LogOut ??')">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<a href="#" class="profile">
				<img src="../img/cashierlogo.png">
			</a>
		</nav>
		<!-- NAVBAR -->
		<!-- suapaya gak ribet dan rapih link -->
		<?php
		if (isset($_GET["page"]) && $_GET["page"] != "home") {
			if (file_exists(htmlentities($_GET["page"]) . ".php")) {
				include(htmlentities(($_GET["page"]) . ".php"));
			} else {
				include("404.php");
			}
		} else {
			include("dashboard.php");
		}
		?>
		<!-- MAIN -->

	</section>
	<script src="../js/script.js"></script>
</body>

</html>