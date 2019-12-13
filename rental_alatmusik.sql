-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 03:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_alatmusik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Abbiyu Distira', 'abbiyukd', 'ca2ee674c4d38ea2d2a67b4c2b90ea08');

-- --------------------------------------------------------

--
-- Table structure for table `alatmusik`
--

CREATE TABLE `alatmusik` (
  `id_alatmusik` int(11) NOT NULL,
  `merk` varchar(25) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `harga_sewa` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alatmusik`
--

INSERT INTO `alatmusik` (`id_alatmusik`, `merk`, `tipe`, `jenis`, `harga_sewa`, `status`) VALUES
(1, 'Yamaha', 'APX 500II', 'Gitar Akustik', '250000', 'Disewa'),
(2, 'Fender', 'American Ultra Telecaster', 'Gitar Elektrik', '100000', 'Masih'),
(3, 'Squier', 'Standard Stratocaster', 'Gitar Elektrik', '50000', 'Disewa'),
(4, 'Yamaha', ' PSR-EW410', 'Keyboard', '250000', 'Disewa'),
(5, 'Cort', 'Classic TC', 'Gitar Elektrik', '250000', 'Masih'),
(7, 'Ibanez', 'RG8570Z', 'Gitar Elektrik', '350000', 'Masih');

-- --------------------------------------------------------

--
-- Stand-in structure for view `alatmusikxtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `alatmusikxtransaksi` (
`id_transaksi` int(11)
,`id_alatmusik` int(11)
,`jenis` varchar(20)
,`merk` varchar(25)
,`tipe` varchar(50)
,`tgl_pinjam` date
,`tgl_kembali` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `detailtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `detailtransaksi` (
`id_transaksi` int(11)
,`nama` varchar(50)
,`no_hp` varchar(13)
,`jenis` varchar(20)
,`merk` varchar(25)
,`tipe` varchar(50)
,`tgl_pinjam` date
,`tgl_kembali` date
,`total_harga` double
);

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `id_penyewa` varchar(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(75) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyewa`
--

INSERT INTO `penyewa` (`id_penyewa`, `nama`, `alamat`, `no_hp`) VALUES
('21120117140010', 'Abbiyu Distira', 'Jl. Maerasari No. 25b', '082141890500'),
('21120117140025', 'Kurnia Majid', 'Rangkil, Gunungpati', '082123456789'),
('21120117150010', 'John Mayer', 'Beverly Hills, USA', '089287654322');

-- --------------------------------------------------------

--
-- Stand-in structure for view `penyewaxtransaksi`
-- (See below for the actual view)
--
CREATE TABLE `penyewaxtransaksi` (
`id_transaksi` int(11)
,`id_penyewa` varchar(25)
,`nama` varchar(50)
,`alamat` varchar(75)
,`no_hp` varchar(13)
,`tgl_pinjam` date
,`tgl_kembali` date
);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_alatmusik` int(11) NOT NULL,
  `id_penyewa` varchar(25) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_alatmusik`, `id_penyewa`, `tgl_pinjam`, `tgl_kembali`) VALUES
(13, 3, '21120117150010', '2019-12-03', '2019-12-05'),
(14, 1, '21120117140010', '2019-12-02', '2019-12-05'),
(15, 4, '21120117140025', '2019-12-04', '2019-12-05');

-- --------------------------------------------------------

--
-- Structure for view `alatmusikxtransaksi`
--
DROP TABLE IF EXISTS `alatmusikxtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `alatmusikxtransaksi`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`alatmusik`.`id_alatmusik` AS `id_alatmusik`,`alatmusik`.`jenis` AS `jenis`,`alatmusik`.`merk` AS `merk`,`alatmusik`.`tipe` AS `tipe`,`transaksi`.`tgl_pinjam` AS `tgl_pinjam`,`transaksi`.`tgl_kembali` AS `tgl_kembali` from (`alatmusik` join `transaksi` on((`alatmusik`.`id_alatmusik` = `transaksi`.`id_alatmusik`))) ;

-- --------------------------------------------------------

--
-- Structure for view `detailtransaksi`
--
DROP TABLE IF EXISTS `detailtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `detailtransaksi`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`penyewa`.`nama` AS `nama`,`penyewa`.`no_hp` AS `no_hp`,`alatmusik`.`jenis` AS `jenis`,`alatmusik`.`merk` AS `merk`,`alatmusik`.`tipe` AS `tipe`,`transaksi`.`tgl_pinjam` AS `tgl_pinjam`,`transaksi`.`tgl_kembali` AS `tgl_kembali`,((to_days(`transaksi`.`tgl_kembali`) - to_days(`transaksi`.`tgl_pinjam`)) * `alatmusik`.`harga_sewa`) AS `total_harga` from ((`penyewa` join `transaksi` on((`penyewa`.`id_penyewa` = `transaksi`.`id_penyewa`))) join `alatmusik` on((`transaksi`.`id_alatmusik` = `alatmusik`.`id_alatmusik`))) ;

-- --------------------------------------------------------

--
-- Structure for view `penyewaxtransaksi`
--
DROP TABLE IF EXISTS `penyewaxtransaksi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `penyewaxtransaksi`  AS  select `transaksi`.`id_transaksi` AS `id_transaksi`,`penyewa`.`id_penyewa` AS `id_penyewa`,`penyewa`.`nama` AS `nama`,`penyewa`.`alamat` AS `alamat`,`penyewa`.`no_hp` AS `no_hp`,`transaksi`.`tgl_pinjam` AS `tgl_pinjam`,`transaksi`.`tgl_kembali` AS `tgl_kembali` from (`penyewa` join `transaksi` on((`penyewa`.`id_penyewa` = `transaksi`.`id_penyewa`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alatmusik`
--
ALTER TABLE `alatmusik`
  ADD PRIMARY KEY (`id_alatmusik`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`id_penyewa`),
  ADD UNIQUE KEY `no_hp` (`no_hp`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `Fk_alatmusik` (`id_alatmusik`),
  ADD KEY `Fk_penyewa` (`id_penyewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alatmusik`
--
ALTER TABLE `alatmusik`
  MODIFY `id_alatmusik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `Fk_alatmusik` FOREIGN KEY (`id_alatmusik`) REFERENCES `alatmusik` (`id_alatmusik`),
  ADD CONSTRAINT `Fk_penyewa` FOREIGN KEY (`id_penyewa`) REFERENCES `penyewa` (`id_penyewa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
