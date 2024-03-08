-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2024 at 08:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latihan_ujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `detailID` int NOT NULL,
  `penjualanID` int NOT NULL,
  `produkID` int NOT NULL,
  `jumlah_produk` int NOT NULL,
  `subtotal` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`detailID`, `penjualanID`, `produkID`, `jumlah_produk`, `subtotal`) VALUES
(1, 20, 4, 1, '125000000'),
(3, 23, 7, 1, '9800000'),
(4, 23, 1, 1, '1500000'),
(5, 24, 1, 5, '7500000'),
(6, 25, 4, 1, '125000000'),
(7, 25, 1, 2, '3000000'),
(9, 27, 1, 1, '1500000'),
(10, 28, 1, 1, '1500000'),
(11, 29, 8, 1, '1200000');

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE `organisasi` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` text NOT NULL,
  `password` varchar(15) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`id`, `username`, `nama`, `password`, `level`) VALUES
(1, 'admin', 'adam', 'qwerty', 'admin'),
(2, 'aldi', 'aldi muhammad', '12345678', 'pegawai'),
(8, 'max', 'max verstappen', 'f1isone', 'pegawai'),
(9, 'bn666', 'jaya abadi', 'triplesix', 'pegawai'),
(10, 'niscaya', 'Anisa Maharani', '123', 'pegawai'),
(11, 'prian', 'prian', '123', 'pegawai');

--
-- Triggers `organisasi`
--
DELIMITER $$
CREATE TRIGGER `update_penjualan_organisasi` AFTER UPDATE ON `organisasi` FOR EACH ROW BEGIN
    UPDATE penjualan
    SET kasir = NEW.nama
    WHERE kasir = OLD.nama;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelangganID` int NOT NULL,
  `nama_pelanggan` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelangganID`, `nama_pelanggan`, `alamat`, `nomor_telepon`) VALUES
(3, 'Pelanggan Tercinta', 'Planet Bumi', '12121212'),
(4, 'pranowo', 'Laut mediosa', '1616161616'),
(5, 'maman abdulrahman', 'DKI Jakarta', '+62896788811'),
(6, 'cristiano ronaldo', 'Ngawi, Jawa Timur', '+62896788811'),
(7, 'michael john', 'rancaekek', '+1 12428888');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualanID` int NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `pelangganID` int DEFAULT NULL,
  `bayar` bigint NOT NULL,
  `kembali` bigint NOT NULL,
  `kasir` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualanID`, `tanggal_penjualan`, `total_harga`, `pelangganID`, `bayar`, `kembali`, `kasir`) VALUES
(20, '2024-03-06', '125000000', 3, 125000000, 0, 'aldi muhammad'),
(23, '2024-03-07', '11300000', 6, 11500000, 200000, 'adam'),
(24, '2024-03-07', '7500000', 5, 8000000, 500000, 'adam'),
(25, '2024-03-07', '128000000', 7, 130000000, 2000000, 'adam'),
(27, '2024-03-07', '1500000', 3, 1600000, 100000, 'adam'),
(28, '2024-03-07', '1500000', 3, 1600000, 100000, 'adam'),
(29, '2024-03-07', '1200000', 3, 1200000, 0, 'prian');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produkID` int NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produkID`, `nama_produk`, `harga`, `stok`) VALUES
(1, '32S3U Cooca', '1500000', 46),
(2, 'NGR2209CAA LG', '33500000', 10),
(3, '43S25KP Toshiba', '2850000', 15),
(4, 'Neo Qled 8k Samsung', '125000000', 4),
(7, 'Smart TV Polytron 4k', '9800000', 10),
(8, 'TV XIomi', '1200000', 4);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `nama` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`nama`, `alamat`) VALUES
('vinzig store', 'atlantis dekat samudra pasifik, benua tenggelam sundaland');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`detailID`),
  ADD KEY `penjualanID` (`penjualanID`),
  ADD KEY `produkID` (`produkID`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelangganID`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualanID`),
  ADD KEY `pelangganID` (`pelangganID`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produkID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `detailID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelangganID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualanID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produkID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`penjualanID`) REFERENCES `penjualan` (`penjualanID`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`pelangganID`) REFERENCES `pelanggan` (`pelangganID`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
