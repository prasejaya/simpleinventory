-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2016 at 06:57 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE IF NOT EXISTS `tbl_barang` (
  `kd_barang` varchar(5) NOT NULL,
  `nm_barang` varchar(20) NOT NULL,
  `stok` int(10) NOT NULL,
  `harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`kd_barang`, `nm_barang`, `stok`, `harga`) VALUES
('B-001', 'Notebook', 1, 4000000),
('B-002', 'dandang 1 kg', 0, 90000),
('B-003', 'Printer', 13, 750000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE IF NOT EXISTS `tbl_pelanggan` (
  `kd_pelanggan` varchar(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nm_pelanggan` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `notelp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`kd_pelanggan`, `username`, `nm_pelanggan`, `alamat`, `email`, `notelp`) VALUES
('P-001', 'sardjito', 'RS. Sardjito', 'Kompleks UGM', 'mail@sardjito.com', '098765432'),
('P-002', 'ibis', 'Hotel Ibis', 'Malioboro', 'mail@ibis-hotel.com', '098765432'),
('P-006', 'jun', 'jun', 'twes', '', 'tes');

--
-- Triggers `tbl_pelanggan`
--
DELIMITER //
CREATE TRIGGER `after_insertpelanggan` AFTER INSERT ON `tbl_pelanggan`
 FOR EACH ROW BEGIN
    INSERT INTO tbl_user values (new.kd_pelanggan,new.username,md5(new.username),'pelanggan'); 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pemilik`
--

CREATE TABLE IF NOT EXISTS `tbl_pemilik` (
  `kd_pemilik` varchar(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nm_pemilik` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `notelp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pemilik`
--

INSERT INTO `tbl_pemilik` (`kd_pemilik`, `username`, `nm_pemilik`, `alamat`, `email`, `notelp`) VALUES
('A-001', 'admin', 'Fatah', 'Madura', 'fatah@gmail.com', '09877654');

--
-- Triggers `tbl_pemilik`
--
DELIMITER //
CREATE TRIGGER `after_insertpemilik` AFTER INSERT ON `tbl_pemilik`
 FOR EACH ROW BEGIN
    INSERT INTO tbl_user values (new.kd_pemilik,new.username,md5(new.username),'admin'); 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengumuman`
--

CREATE TABLE IF NOT EXISTS `tbl_pengumuman` (
`idpengumuman` bigint(20) unsigned NOT NULL,
  `idpenjualan` varchar(5) NOT NULL,
  `idpelanggan` varchar(5) NOT NULL,
  `isbaca` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_pengumuman`
--

INSERT INTO `tbl_pengumuman` (`idpengumuman`, `idpenjualan`, `idpelanggan`, `isbaca`) VALUES
(1, 'O-001', 'P-002', '0'),
(2, 'O-002', 'P-002', '0'),
(3, 'O-003', 'P-002', '0'),
(4, 'O-004', 'P-002', '0'),
(5, 'O-005', 'P-002', '0'),
(6, 'O-006', 'P-001', '0'),
(7, 'O-007', 'P-002', '0'),
(8, 'O-009', 'P-004', '0'),
(9, 'O-012', 'P-004', '0'),
(10, 'O-013', 'P-006', '1'),
(11, 'O-014', 'P-006', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_penjualan_detail` (
  `kd_penjualan` varchar(5) NOT NULL,
  `kd_barang` varchar(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan_detail`
--

INSERT INTO `tbl_penjualan_detail` (`kd_penjualan`, `kd_barang`, `qty`) VALUES
('O-001', 'B-001', 2),
('O-001', 'B-002', 3),
('O-002', 'B-002', 2),
('O-002', 'B-003', 3),
('O-003', 'B-002', 3),
('O-004', 'B-002', 4),
('O-005', 'B-002', 1),
('O-006', 'B-003', 1),
('O-007', 'B-002', 1),
('O-007', 'B-001', 5),
('O-008', 'B-003', 2),
('O-008', 'B-002', 2),
('O-010', 'B-001', 5),
('O-011', 'B-003', 1),
('O-012', 'B-001', 1),
('O-008', 'B-001', 1),
('O-008', 'B-002', 1),
('O-009', 'B-003', 2),
('O-010', 'B-001', 2),
('O-010', 'B-002', 5),
('O-011', 'B-002', 3),
('O-012', 'B-001', 5),
('O-013', 'B-002', 1),
('O-014', 'B-001', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan_header`
--

CREATE TABLE IF NOT EXISTS `tbl_penjualan_header` (
  `kd_penjualan` varchar(5) NOT NULL,
  `kd_pelanggan` varchar(10) NOT NULL,
  `total_harga` int(20) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `kd_pegawai` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_penjualan_header`
--

INSERT INTO `tbl_penjualan_header` (`kd_penjualan`, `kd_pelanggan`, `total_harga`, `tanggal_penjualan`, `kd_pegawai`) VALUES
('O-001', 'P-002', 9800000, '2014-06-20', 'K-001'),
('O-002', 'P-002', 3450000, '2016-07-10', 'K-001'),
('O-003', 'P-002', 1800000, '2016-07-23', 'K-001'),
('O-004', 'P-002', 2400000, '2016-08-07', '0'),
('O-005', 'P-002', 600000, '2016-08-09', '0'),
('O-006', 'P-001', 750000, '2016-08-14', '0'),
('O-007', 'P-002', 20600000, '2016-08-15', '0'),
('O-009', 'P-004', 1500000, '2016-08-16', '0'),
('O-012', 'P-004', 20000000, '2016-08-16', '0'),
('O-013', 'P-006', 90000, '2016-08-19', '0'),
('O-014', 'P-006', 8000000, '2016-08-19', '0');

--
-- Triggers `tbl_penjualan_header`
--
DELIMITER //
CREATE TRIGGER `tad_pengumuman` AFTER DELETE ON `tbl_penjualan_header`
 FOR EACH ROW BEGIN
    delete from tbl_pengumuman where idpenjualan = old.kd_penjualan; 
END
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER `tia_pengumuman` AFTER INSERT ON `tbl_penjualan_header`
 FOR EACH ROW BEGIN
    INSERT INTO tbl_pengumuman values (new.kd_penjualan,new.kd_pelanggan,'0'); 
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `iduser` varchar(5) NOT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `level` enum('pelanggan','admin') DEFAULT 'pelanggan'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`iduser`, `username`, `password`, `level`) VALUES
('A-001', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('P-001', 'sardjito', 'fdc01a6a799432fa313cab74a8b281b4', 'pelanggan'),
('P-002', 'ibis', '6aa15c808c05fbf8f2c82dfb218ac9ac', 'pelanggan'),
('P-003', 'fatah', '3a01ef5567481080ac2135340b6749e1', 'pelanggan'),
('P-004', 'gun', '5161ebb0cce4b7987ba8b6935d60a180', 'pelanggan'),
('P-005', 'avatar', 'aaca0f5eb4d2d98a6ce6dffa99f8254b', 'pelanggan'),
('P-006', 'jun', '6b5843ce9d2d0599c3e3ce6d59c1551f', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
 ADD PRIMARY KEY (`kd_barang`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
 ADD PRIMARY KEY (`kd_pelanggan`);

--
-- Indexes for table `tbl_pemilik`
--
ALTER TABLE `tbl_pemilik`
 ADD PRIMARY KEY (`kd_pemilik`), ADD UNIQUE KEY `kd_pemilik` (`kd_pemilik`);

--
-- Indexes for table `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
 ADD PRIMARY KEY (`idpengumuman`), ADD UNIQUE KEY `idpengumuman` (`idpengumuman`);

--
-- Indexes for table `tbl_penjualan_header`
--
ALTER TABLE `tbl_penjualan_header`
 ADD PRIMARY KEY (`kd_penjualan`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
 ADD PRIMARY KEY (`iduser`), ADD UNIQUE KEY `iduser` (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_pengumuman`
--
ALTER TABLE `tbl_pengumuman`
MODIFY `idpengumuman` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
