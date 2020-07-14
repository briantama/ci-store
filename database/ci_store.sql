-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 15, 2020 at 12:06 AM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-26+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `M_MasterGroup`
--

CREATE TABLE `M_MasterGroup` (
  `CodeGroupID` varchar(15) NOT NULL,
  `GroupName` varchar(100) NOT NULL,
  `Description` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_MasterGroup`
--

INSERT INTO `M_MasterGroup` (`CodeGroupID`, `GroupName`, `Description`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('GRP-000001', 'Makanan', 'Makanan Saja', 'Y', 'brian', '2020-05-28 00:00:00', 'brian', '2020-07-06 19:14:05'),
('GRP-000002', 'Minuman', 'minuman ringan', 'Y', 'brian', '2020-05-28 00:00:00', 'brian', '2020-05-28 00:00:00'),
('GRP-000003', 'Obat', 'Obat', 'Y', 'brian', '2020-05-29 17:09:00', 'brian', '2020-05-29 17:09:00'),
('GRP-000004', 'Deterjen', 'Pencuci Pakaian', 'Y', 'brian', '2020-05-29 17:11:18', 'brian', '2020-05-31 02:29:16'),
('GRP-000005', 'Pembalut/Pempers', 'Aneka Pembalut', 'Y', 'brian', '2020-05-29 17:16:11', 'brian', '2020-05-30 16:52:22'),
('GRP-000006', 'Parfume', 'Pewangi Pakaian', 'Y', 'brian', '2020-05-29 17:26:49', 'brian', '2020-05-30 12:34:47'),
('GRP-000007', 'Plastik', 'Kantong Plastik', 'Y', 'brian', '2020-05-29 17:28:01', 'brian', '2020-05-30 18:17:58'),
('GRP-000008', 'Pembersih Lantai', '', 'Y', 'brian', '2020-05-31 02:33:32', 'brian', '2020-05-31 02:33:32'),
('GRP-000009', 'Sabun Mandi', 'Macam-macam Sabun', 'Y', 'brian', '2020-05-31 02:35:06', 'brian', '2020-05-31 03:16:56'),
('GRP-000010', 'Sayuran', 'Aneka Sayuran', 'Y', 'brian', '2020-05-31 03:18:06', 'brian', '2020-05-31 03:18:06'),
('GRP-000011', 'Buah', 'Buah-buahan', 'N', 'brian', '2020-05-31 03:38:44', 'brian', '2020-06-14 05:39:09'),
('GRP-000012', 'pcx', '', 'Y', 'brian', '2020-06-14 05:38:48', 'brian', '2020-06-14 05:38:48'),
('GRP-000013', 'okkkkkk', '', 'Y', 'brian', '2020-06-14 05:52:19', 'brian', '2020-06-14 05:52:19'),
('GRP-000014', 'gsgss', '', 'N', 'brian', '2020-06-15 10:19:02', 'brian', '2020-06-19 11:18:35'),
('GRP-000015', 'aaaa', '', 'Y', 'brian', '2020-06-15 17:33:39', 'brian', '2020-06-15 17:33:39'),
('GRP-000016', 'oo', 'Aaaa', 'N', 'brian', '2020-06-16 15:27:07', 'brian', '2020-06-16 15:27:14'),
('GRP-000017', 'QQ122', '', 'Y', 'brian', '2020-06-16 16:01:50', 'brian', '2020-06-16 16:01:50'),
('GRP-000018', 'aaaa', 'Aaa', 'Y', 'brian', '2020-06-16 16:43:48', 'brian', '2020-06-16 16:43:48'),
('GRP-000019', 'aaaa', 'A11111', 'Y', 'brian', '2020-06-19 11:15:00', 'brian', '2020-06-19 11:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `M_MasterItem`
--

CREATE TABLE `M_MasterItem` (
  `ItemID` varchar(12) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `GroupID` varchar(12) NOT NULL,
  `ShortItem` varchar(10) NOT NULL,
  `PurchasePrice` double NOT NULL,
  `SellingPrice` double NOT NULL,
  `Stock` double NOT NULL,
  `ItemImage` varchar(200) NOT NULL,
  `Description` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_MasterItem`
--

INSERT INTO `M_MasterItem` (`ItemID`, `ItemName`, `GroupID`, `ShortItem`, `PurchasePrice`, `SellingPrice`, `Stock`, `ItemImage`, `Description`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('ITM-000001', 'Wafer Tanggo Coklat', 'GRP-000001', 'WFGC', 1500, 2000, 95, 'tanggo.jpg', '', 'Y', 'brian', '2020-06-06 14:11:05', 'brian', '2020-07-12 20:39:46'),
('ITM-000002', 'Susu Ultra Milk Vanila', 'GRP-000002', 'SUMV', 4500, 5000, 50, 'b0de2b6fd6d03b9c077af85accd9deec.jpg', '', 'Y', 'brian', '2020-06-06 16:50:46', 'brian', '2020-07-12 20:37:43'),
('ITM-000003', 'Panadol Blue 500mg', 'GRP-000003', 'PB5G', 8300, 8400, 12, 'panadol-blue.jpg', '', 'Y', 'brian', '2020-06-07 07:28:49', 'brian', '2020-07-12 20:38:41'),
('ITM-000004', 'Rinso Anti Noda 1.8g', 'GRP-000004', 'RAN1.8G', 51700, 54000, 45, 'RINSO.jpg', '', 'Y', 'brian', '2020-06-13 08:32:05', 'brian', '2020-07-12 20:38:17'),
('ITM-000005', 'Mamy Poko Pants L', 'GRP-000005', 'MPKL', 46100, 47000, 10, 'mamy-popok.jpg', '', 'Y', 'brian', '2020-06-16 15:28:18', 'brian', '2020-07-12 20:31:57'),
('ITM-000006', 'Wafer Tanggo Vanila', 'GRP-000001', 'WTV', 1500, 2000, 95, 'tango-vanila.jpg', '', 'Y', 'brian', '2020-07-12 20:35:10', 'brian', '2020-07-12 20:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `M_MasterSupplier`
--

CREATE TABLE `M_MasterSupplier` (
  `SupplierID` varchar(15) NOT NULL,
  `SupplierName` varchar(100) NOT NULL,
  `Description` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_MasterSupplier`
--

INSERT INTO `M_MasterSupplier` (`SupplierID`, `SupplierName`, `Description`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('SUP-000001', 'PT. Tiga Jaya Abadi', 'Abadi Jaya', 'Y', 'brian', '2020-05-31 07:01:09', 'efi', '2020-07-05 22:20:44'),
('SUP-000002', 'PT. Aneka Food', 'Oke', 'Y', 'brian', '2020-05-31 07:34:59', 'brian', '2020-06-12 16:15:59'),
('SUP-000003', 'PT. Lantas Jaya', '', 'Y', 'brian', '2020-06-13 15:39:23', 'brian', '2020-06-14 04:58:59'),
('SUP-000004', 'CV. Berdaya Makmur', '', 'Y', 'brian', '2020-06-13 15:40:41', 'brian', '2020-06-14 04:50:16'),
('SUP-000005', 'PT. Perkasa Food', '', 'Y', 'brian', '2020-06-14 04:46:54', 'brian', '2020-06-14 04:46:54'),
('SUP-000006', 'CV. Abadi Rasa', '', 'Y', 'brian', '2020-06-14 04:51:09', 'brian', '2020-06-14 04:51:09'),
('SUP-000007', 'PT. Mlutijaya Food', '', 'Y', 'brian', '2020-06-14 04:59:35', 'brian', '2020-06-14 04:59:35'),
('SUP-000008', 'PT. Anugerah Extra', '', 'Y', 'brian', '2020-06-14 05:09:17', 'brian', '2020-06-14 05:09:17'),
('SUP-000009', 'PT. Sinar Dua Jaya', '', 'Y', 'brian', '2020-06-14 05:13:01', 'brian', '2020-06-14 05:13:01'),
('SUP-000010', 'test', '', 'Y', 'brian', '2020-06-14 05:19:15', 'brian', '2020-06-14 05:19:15'),
('SUP-000011', 'pc', '', 'Y', 'brian', '2020-06-14 05:20:20', 'brian', '2020-06-14 05:20:20'),
('SUP-000012', 'oklah', '', 'Y', 'brian', '2020-06-14 05:28:13', 'brian', '2020-06-14 05:28:13'),
('SUP-000013', 'tsts', '', 'Y', 'brian', '2020-06-14 05:31:01', 'brian', '2020-06-14 05:31:01'),
('SUP-000014', '123', '', 'Y', 'brian', '2020-06-14 21:59:53', 'brian', '2020-06-14 21:59:53'),
('SUP-000015', 'okkkk', '', 'N', 'brian', '2020-06-16 15:25:21', 'brian', '2020-06-16 15:25:37'),
('SUP-000016', 'AQ1Q1', '', 'Y', 'brian', '2020-06-16 16:01:29', 'brian', '2020-06-16 16:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `M_Setupprint`
--

CREATE TABLE `M_Setupprint` (
  `SettupprintID` int(11) NOT NULL,
  `SetupHeader` longtext NOT NULL,
  `SetupFooter` longtext NOT NULL,
  `SetupImage` varchar(300) NOT NULL,
  `SetupImageShow` varchar(1) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Setupprint`
--

INSERT INTO `M_Setupprint` (`SettupprintID`, `SetupHeader`, `SetupFooter`, `SetupImage`, `SetupImageShow`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(2, 'Bryn Store <br>\r\nJl. Ujung Berung Khayalan Tinggi Blok 69 No.99 <br>\r\nNpwp : 9999.6666.7777.888', 'Terima Kasih <br>\r\nBarang yang sudah di beli tidak dapat dikembalikan atau ditukar', 'online-store.png', 'Y', 'Y', 'brian', '2020-07-11 12:06:14', 'brian', '2020-07-12 19:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `M_Setupprofile`
--

CREATE TABLE `M_Setupprofile` (
  `SetupprofileID` int(11) NOT NULL,
  `SetupTitle` varchar(200) NOT NULL,
  `SetupName` varchar(300) NOT NULL,
  `SetupDescription` longtext NOT NULL,
  `SetupImageDasbor` varchar(1) NOT NULL,
  `SetupImage` varchar(200) NOT NULL,
  `SetupImageLogo` varchar(300) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_Setupprofile`
--

INSERT INTO `M_Setupprofile` (`SetupprofileID`, `SetupTitle`, `SetupName`, `SetupDescription`, `SetupImageDasbor`, `SetupImage`, `SetupImageLogo`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(2, 'Aplikasi Toko Bryn', 'B STORE', 'aplikasi toko sederhana', 'Y', '1892627.png', 'online-store.png', 'Y', 'brian', '2020-07-05 23:55:10', 'brian', '2020-07-12 19:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `M_User`
--

CREATE TABLE `M_User` (
  `AdminID` int(11) NOT NULL,
  `AdminName` varchar(100) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varbinary(50) NOT NULL,
  `SuperUser` varchar(1) NOT NULL,
  `AdminImage` longtext NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(30) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(30) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `M_User`
--

INSERT INTO `M_User` (`AdminID`, `AdminName`, `DateOfBirth`, `email`, `UserName`, `Password`, `SuperUser`, `AdminImage`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
(2, 'abrian Inf', '2020-01-10', 'abriantama@gmail.com', 'brian', 0x6362643434663862356234386135316637646162393861626364663435643465, 'Y', 'logo-tutwuri-handayani-ardi-madi-blog-11.png', 'Y', 'admin', '2020-01-10 16:37:32', 'brian', '2020-07-12 15:00:15'),
(6, 'efira', '1994-02-05', 'efivara.stelax@gmail.com', 'efi', 0x6139353835656532366239396230326664313934363539303266326664346435, 'N', '', 'Y', 'brian', '2020-05-09 15:01:43', 'efi', '2020-07-05 21:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `T_PurchaseOrder`
--

CREATE TABLE `T_PurchaseOrder` (
  `PurchaseOrderID` varchar(20) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `SupplierID` varchar(20) NOT NULL,
  `TotalPurchase` double NOT NULL,
  `Status` varchar(1) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_PurchaseOrder`
--

INSERT INTO `T_PurchaseOrder` (`PurchaseOrderID`, `PurchaseDate`, `SupplierID`, `TotalPurchase`, `Status`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('PCO-2007-000001', '2020-07-12', 'SUP-000005', 461000, '5', 'Y', 'brian', '2020-07-12 20:31:51', 'brian', '2020-07-12 20:31:57'),
('PCO-2007-000002', '2020-07-12', 'SUP-000004', 300000, '5', 'Y', 'brian', '2020-07-12 20:33:17', 'brian', '2020-07-12 20:35:29'),
('PCO-2007-000003', '2020-07-12', 'SUP-000003', 225000, '5', 'Y', 'brian', '2020-07-12 20:37:38', 'brian', '2020-07-12 20:37:43'),
('PCO-2007-000004', '2020-07-12', 'SUP-000009', 2326500, '5', 'Y', 'brian', '2020-07-12 20:38:14', 'brian', '2020-07-12 20:38:17'),
('PCO-2007-000005', '2020-07-12', 'SUP-000008', 99600, '5', 'Y', 'brian', '2020-07-12 20:38:40', 'brian', '2020-07-12 20:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `T_PurchaseOrderDetail`
--

CREATE TABLE `T_PurchaseOrderDetail` (
  `PurchaseOrderID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `PurchasePrice` double NOT NULL,
  `Amount` double NOT NULL,
  `Total` double NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_PurchaseOrderDetail`
--

INSERT INTO `T_PurchaseOrderDetail` (`PurchaseOrderID`, `ItemID`, `PurchasePrice`, `Amount`, `Total`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('PCO-2007-000001', 'ITM-000005', 46100, 10, 461000, 'Y', 'brian', '2020-07-12 20:31:51', 'brian', '2020-07-12 20:31:51'),
('PCO-2007-000002', 'ITM-000001', 1500, 100, 150000, 'Y', 'brian', '2020-07-12 20:33:17', 'brian', '2020-07-12 20:33:17'),
('PCO-2007-000002', 'ITM-000006', 1500, 100, 150000, 'Y', 'brian', '2020-07-12 20:35:26', 'brian', '2020-07-12 20:35:26'),
('PCO-2007-000003', 'ITM-000002', 4500, 50, 225000, 'Y', 'brian', '2020-07-12 20:37:38', 'brian', '2020-07-12 20:37:38'),
('PCO-2007-000004', 'ITM-000004', 51700, 45, 2326500, 'Y', 'brian', '2020-07-12 20:38:14', 'brian', '2020-07-12 20:38:14'),
('PCO-2007-000005', 'ITM-000003', 8300, 12, 99600, 'Y', 'brian', '2020-07-12 20:38:40', 'brian', '2020-07-12 20:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `T_Sale`
--

CREATE TABLE `T_Sale` (
  `SaleID` varchar(20) NOT NULL,
  `SaleDate` date NOT NULL,
  `TotalSale` double NOT NULL,
  `Status` varchar(1) NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_Sale`
--

INSERT INTO `T_Sale` (`SaleID`, `SaleDate`, `TotalSale`, `Status`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('SAL-2007-000001', '2020-07-12', 20000, '5', 'Y', 'brian', '2020-07-12 20:39:31', 'brian', '2020-07-12 20:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `T_SaleDetail`
--

CREATE TABLE `T_SaleDetail` (
  `SaleID` varchar(20) NOT NULL,
  `ItemID` varchar(20) NOT NULL,
  `SellingPrice` double NOT NULL,
  `Amount` double NOT NULL,
  `Total` double NOT NULL,
  `IsActive` varchar(1) NOT NULL,
  `EntryBy` varchar(20) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `LastUpdateBy` varchar(20) NOT NULL,
  `LastUpdateDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `T_SaleDetail`
--

INSERT INTO `T_SaleDetail` (`SaleID`, `ItemID`, `SellingPrice`, `Amount`, `Total`, `IsActive`, `EntryBy`, `EntryDate`, `LastUpdateBy`, `LastUpdateDate`) VALUES
('SAL-2007-000001', 'ITM-000001', 2000, 5, 10000, 'Y', 'brian', '2020-07-12 20:39:42', 'brian', '2020-07-12 20:39:42'),
('SAL-2007-000001', 'ITM-000006', 2000, 5, 10000, 'Y', 'brian', '2020-07-12 20:39:31', 'brian', '2020-07-12 20:39:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `M_MasterGroup`
--
ALTER TABLE `M_MasterGroup`
  ADD PRIMARY KEY (`CodeGroupID`);

--
-- Indexes for table `M_MasterItem`
--
ALTER TABLE `M_MasterItem`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `M_MasterSupplier`
--
ALTER TABLE `M_MasterSupplier`
  ADD PRIMARY KEY (`SupplierID`);

--
-- Indexes for table `M_Setupprint`
--
ALTER TABLE `M_Setupprint`
  ADD PRIMARY KEY (`SettupprintID`);

--
-- Indexes for table `M_Setupprofile`
--
ALTER TABLE `M_Setupprofile`
  ADD PRIMARY KEY (`SetupprofileID`);

--
-- Indexes for table `M_User`
--
ALTER TABLE `M_User`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `T_PurchaseOrder`
--
ALTER TABLE `T_PurchaseOrder`
  ADD PRIMARY KEY (`PurchaseOrderID`);

--
-- Indexes for table `T_PurchaseOrderDetail`
--
ALTER TABLE `T_PurchaseOrderDetail`
  ADD PRIMARY KEY (`PurchaseOrderID`,`ItemID`);

--
-- Indexes for table `T_Sale`
--
ALTER TABLE `T_Sale`
  ADD PRIMARY KEY (`SaleID`);

--
-- Indexes for table `T_SaleDetail`
--
ALTER TABLE `T_SaleDetail`
  ADD PRIMARY KEY (`SaleID`,`ItemID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `M_Setupprint`
--
ALTER TABLE `M_Setupprint`
  MODIFY `SettupprintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `M_Setupprofile`
--
ALTER TABLE `M_Setupprofile`
  MODIFY `SetupprofileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `M_User`
--
ALTER TABLE `M_User`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
