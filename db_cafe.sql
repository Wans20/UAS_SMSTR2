-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 05:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftarmember`
--

CREATE TABLE `daftarmember` (
  `idmember` int(11) NOT NULL,
  `kode_member` varchar(9) DEFAULT NULL,
  `nm_member` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `tgl_daftar` datetime DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hakakses_menu`
--

CREATE TABLE `hakakses_menu` (
  `id_hakakses` int(11) NOT NULL,
  `idmenu` int(11) DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_kategoriproduk`
--

CREATE TABLE `mst_kategoriproduk` (
  `idkategori` int(11) NOT NULL,
  `nmkategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kategoriproduk`
--

INSERT INTO `mst_kategoriproduk` (`idkategori`, `nmkategori`) VALUES
(5, 'Coffee'),
(6, 'non_coffe');

-- --------------------------------------------------------

--
-- Table structure for table `mst_menu`
--

CREATE TABLE `mst_menu` (
  `idmenu` int(11) NOT NULL,
  `kode_menu` varchar(8) NOT NULL,
  `nmmenu` varchar(25) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_menu`
--

INSERT INTO `mst_menu` (`idmenu`, `kode_menu`, `nmmenu`, `link`) VALUES
(2011, 'M2022001', 'User Login', 'mod_userlogin'),
(2012, 'M2022002', 'Member', 'mod_member'),
(2013, 'M2022003', 'Menu', 'mod_menu'),
(2014, 'M2022004', 'Kategori produk', 'mod_kategoriproduk'),
(2015, 'M2022005', 'Produk', 'mod_produk'),
(2016, 'M2022006', 'Transaksi', 'mod_transaksi'),
(2017, 'M2022007', 'coba', 'mod_cooba');

-- --------------------------------------------------------

--
-- Table structure for table `mst_produk`
--

CREATE TABLE `mst_produk` (
  `idproduk` int(11) NOT NULL,
  `nmproduk` varchar(50) NOT NULL,
  `gambar` varchar(25) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_produk`
--

INSERT INTO `mst_produk` (`idproduk`, `nmproduk`, `gambar`, `idkategori`, `harga`, `stock`, `deskripsi`) VALUES
(9, 'f', '3.jpg', 5, 2, 1, '<p>bvbxw</p>'),
(10, 'kopi', 'latte.jpg', 5, 2000, 1, '<p>enak</p>');

-- --------------------------------------------------------

--
-- Table structure for table `mst_userlogin`
--

CREATE TABLE `mst_userlogin` (
  `iduser` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_userlogin`
--

INSERT INTO `mst_userlogin` (`iduser`, `username`, `nama_lengkap`, `password`, `is_active`) VALUES
(1, 'pegawai', 'Santoso', '202cb962ac59075b964b07152d234b70', 1),
(6, 'santri', 'Agung', '202cb962ac59075b964b07152d234b70', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftarmember`
--
ALTER TABLE `daftarmember`
  ADD PRIMARY KEY (`idmember`);

--
-- Indexes for table `hakakses_menu`
--
ALTER TABLE `hakakses_menu`
  ADD PRIMARY KEY (`id_hakakses`),
  ADD KEY `idmenu_fk` (`idmenu`),
  ADD KEY `iduser_fk` (`iduser`);

--
-- Indexes for table `mst_kategoriproduk`
--
ALTER TABLE `mst_kategoriproduk`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `mst_menu`
--
ALTER TABLE `mst_menu`
  ADD PRIMARY KEY (`idmenu`);

--
-- Indexes for table `mst_produk`
--
ALTER TABLE `mst_produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `fk_id_kategori` (`idkategori`);

--
-- Indexes for table `mst_userlogin`
--
ALTER TABLE `mst_userlogin`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftarmember`
--
ALTER TABLE `daftarmember`
  MODIFY `idmember` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hakakses_menu`
--
ALTER TABLE `hakakses_menu`
  MODIFY `id_hakakses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mst_kategoriproduk`
--
ALTER TABLE `mst_kategoriproduk`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mst_menu`
--
ALTER TABLE `mst_menu`
  MODIFY `idmenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2018;

--
-- AUTO_INCREMENT for table `mst_produk`
--
ALTER TABLE `mst_produk`
  MODIFY `idproduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `mst_userlogin`
--
ALTER TABLE `mst_userlogin`
  MODIFY `iduser` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hakakses_menu`
--
ALTER TABLE `hakakses_menu`
  ADD CONSTRAINT `idmenu_fk` FOREIGN KEY (`idmenu`) REFERENCES `mst_menu` (`idmenu`),
  ADD CONSTRAINT `iduser_fk` FOREIGN KEY (`iduser`) REFERENCES `mst_userlogin` (`iduser`);

--
-- Constraints for table `mst_produk`
--
ALTER TABLE `mst_produk`
  ADD CONSTRAINT `fk_id_kategori` FOREIGN KEY (`idkategori`) REFERENCES `mst_kategoriproduk` (`idkategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
