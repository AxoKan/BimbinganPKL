-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 05:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bimbingan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi_guru`
--

CREATE TABLE `absensi_guru` (
  `id_absensi2` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `Kehadiran` enum('hadir','Tidak hadir') DEFAULT NULL,
  `Jurusan` enum('RPL','BDP','AKL') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_guru`
--

INSERT INTO `absensi_guru` (`id_absensi2`, `tanggal`, `nama`, `Kehadiran`, `Jurusan`) VALUES
(7, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(8, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(9, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(10, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(11, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(12, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(13, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(14, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(15, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(16, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(17, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(18, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(19, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(20, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(21, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(22, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(23, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(24, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(25, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(26, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(27, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(28, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(29, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(30, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(31, '2024-09-22', 'Miftahul Ilmi', 'hadir', 'RPL'),
(32, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(33, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'RPL'),
(34, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(35, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(36, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(37, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(38, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(39, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(40, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(41, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(42, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(43, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(44, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(45, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(46, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(47, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(48, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(49, '2024-09-22', 'Treako', 'hadir', 'AKL'),
(50, '2024-09-22', 'Desi Nataliza Br Simarta', 'hadir', 'AKL');

-- --------------------------------------------------------

--
-- Table structure for table `absensi_siswa`
--

CREATE TABLE `absensi_siswa` (
  `id_absensi1` int(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `Kehadiran` enum('hadir','Tidak hadir') DEFAULT NULL,
  `Jurusan` enum('RPL','BDP','AKL') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi_siswa`
--

INSERT INTO `absensi_siswa` (`id_absensi1`, `tanggal`, `nama`, `Kehadiran`, `Jurusan`) VALUES
(1, '2024-09-17', 'Aja', 'hadir', 'AKL');

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan_1`
--

CREATE TABLE `bimbingan_1` (
  `id_bimbingan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `Siswa` int(11) DEFAULT NULL,
  `Jurusan` enum('RPL','BDP','AKL') DEFAULT NULL,
  `Pembimbing1` int(11) DEFAULT NULL,
  `topik` text DEFAULT NULL,
  `siap_bimbing1` enum('Pending','Terima','Tolak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bimbingan_1`
--

INSERT INTO `bimbingan_1` (`id_bimbingan`, `tanggal`, `Siswa`, `Jurusan`, `Pembimbing1`, `topik`, `siap_bimbing1`) VALUES
(1, '2024-09-12', 3, 'RPL', 2, 'adadada', 'Terima'),
(2, '2024-09-12', 4, 'BDP', 4, 'adadada', 'Terima'),
(3, '2024-09-12', 5, 'AKL', 3, 'adadada', 'Tolak'),
(4, '2024-09-12', 5, 'AKL', 3, 'adadada', 'Terima'),
(5, '2024-09-12', 3, 'RPL', 2, 'adadada', 'Terima'),
(7, '2024-09-22', 3, 'RPL', 2, 'aku sudan,siap', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan_2`
--

CREATE TABLE `bimbingan_2` (
  `id_bimbingan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `Siswa` int(11) DEFAULT NULL,
  `Jurusan` enum('RPL','BDP','AKL') DEFAULT NULL,
  `Pembimbing1` int(11) DEFAULT NULL,
  `topik` text DEFAULT NULL,
  `siap_bimbing1` enum('Pending','Terima','Tolak') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bimbingan_2`
--

INSERT INTO `bimbingan_2` (`id_bimbingan`, `tanggal`, `Siswa`, `Jurusan`, `Pembimbing1`, `topik`, `siap_bimbing1`) VALUES
(1, '2024-09-12', 4, 'BDP', 1, 'adadada', 'Tolak'),
(2, '2024-09-12', 3, 'RPL', 1, 'adadada', 'Terima'),
(3, '2024-09-12', 5, 'AKL', 1, 'adadadadadsfsdsdsdfsf', 'Tolak'),
(4, '2024-09-12', 3, 'RPL', 1, 'adadada', 'Tolak');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `namaG` varchar(255) DEFAULT NULL,
  `jurusanG` enum('RPL','BDP','AKL','-') DEFAULT NULL,
  `INDO` enum('INDO','-') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `namaG`, `jurusanG`, `INDO`) VALUES
(1, 'Desi Nataliza Br Simarta', '-', 'INDO'),
(2, 'Miftahul Ilmi', 'RPL', '-'),
(3, 'Treako', 'AKL', '-'),
(4, 'hi', 'BDP', '-');

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id_logo` int(11) NOT NULL,
  `nama_Logo` varchar(255) DEFAULT NULL,
  `logos` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id_logo`, `nama_Logo`, `logos`, `icon`) VALUES
(1, 'PKL Permata Harapan', 'images.png', 'images.png');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `NIS` int(11) DEFAULT NULL,
  `NamaS` varchar(255) DEFAULT NULL,
  `JurusanS` enum('RPL','BDP','AKL') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `NIS`, `NamaS`, `JurusanS`) VALUES
(3, 22161007, 'Budhi Jayanto', 'RPL'),
(4, 22161001, 'Gatau', 'BDP'),
(5, 22161002, 'Aja', 'AKL');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `NamaA` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Level` enum('Pembimbing2','Pembimbing1','Siswa','admin') DEFAULT NULL,
  `Jurusan` enum('RPL','AKL','BDP','-') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `foto`, `NamaA`, `Username`, `Password`, `Level`, `Jurusan`) VALUES
(1, 'download.jpeg', 'Miftahul Ilmi', 'Pembimbing1', 'b671efeb49ef5aa808b7840d16f9aa60', 'Pembimbing1', 'RPL'),
(2, 'download.jpeg', 'Desi Nataliza Br Simarta', 'Pembimbing2', '2e209d361fa982c0723e09bb13e66055', 'Pembimbing2', 'RPL'),
(3, 'download.jpeg', 'Budhi Jayanto', 'Axo', '801c14f07f9724229175b8ef8b4585a8', 'Siswa', 'RPL'),
(4, 'download.jpeg', 'Gatau', 'Gatau', '801c14f07f9724229175b8ef8b4585a8', 'Siswa', 'AKL'),
(5, 'download.jpeg', 'Aja', 'Aja', '801c14f07f9724229175b8ef8b4585a8', 'Siswa', 'BDP'),
(6, 'download.jpeg', 'Treako', 'Pembimbing3', 'b671efeb49ef5aa808b7840d16f9aa60', 'Pembimbing1', 'AKL'),
(7, 'download.jpeg', 'Desi Nataliza Br Simarta', 'Pembimbing4', '2e209d361fa982c0723e09bb13e66055', 'Pembimbing2', 'AKL'),
(8, 'download.jpeg', 'Desi Nataliza Br Simarta', 'Pembimbing5', '2e209d361fa982c0723e09bb13e66055', 'Pembimbing2', 'BDP'),
(9, 'download.jpeg', 'hi', 'Pembimbing6', 'b671efeb49ef5aa808b7840d16f9aa60', 'Pembimbing1', 'BDP'),
(10, 'download.jpeg', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  ADD PRIMARY KEY (`id_absensi2`);

--
-- Indexes for table `absensi_siswa`
--
ALTER TABLE `absensi_siswa`
  ADD PRIMARY KEY (`id_absensi1`);

--
-- Indexes for table `bimbingan_1`
--
ALTER TABLE `bimbingan_1`
  ADD PRIMARY KEY (`id_bimbingan`);

--
-- Indexes for table `bimbingan_2`
--
ALTER TABLE `bimbingan_2`
  ADD PRIMARY KEY (`id_bimbingan`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id_logo`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi_guru`
--
ALTER TABLE `absensi_guru`
  MODIFY `id_absensi2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `absensi_siswa`
--
ALTER TABLE `absensi_siswa`
  MODIFY `id_absensi1` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bimbingan_1`
--
ALTER TABLE `bimbingan_1`
  MODIFY `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bimbingan_2`
--
ALTER TABLE `bimbingan_2`
  MODIFY `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id_logo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
