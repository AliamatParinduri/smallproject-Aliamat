-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 12, 2021 at 11:38 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smallproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transkrip_nilai`
--

CREATE TABLE `detail_transkrip_nilai` (
  `kd_detail` int(11) NOT NULL,
  `kd_transkrip_nilai` varchar(10) NOT NULL,
  `kd_matkul` varchar(10) NOT NULL,
  `mutu_matkul` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `kd_jurusan` varchar(10) NOT NULL,
  `nm_jurusan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`kd_jurusan`, `nm_jurusan`) VALUES
('KJR-001', 'Sistem Informasi'),
('KJR-002', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `no_mahasiswa` varchar(10) NOT NULL,
  `nm_mahasiswa` varchar(50) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `jurusan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`no_mahasiswa`, `nm_mahasiswa`, `semester`, `jurusan`) VALUES
('122100001', 'Aliamat Parinduri', '1', 'KJR-001');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `kd_mata_kuliah` varchar(10) NOT NULL,
  `semester` varchar(2) NOT NULL,
  `nm_matkul` varchar(50) NOT NULL,
  `sks` tinyint(1) NOT NULL,
  `jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`kd_mata_kuliah`, `semester`, `nm_matkul`, `sks`, `jurusan`) VALUES
('KDMK-001', '2', 'Dasar Pemrograman', 4, 'KJR-001'),
('KDMK-002', '1', 'Logika dan Algoritma', 4, 'KJR-001');

-- --------------------------------------------------------

--
-- Table structure for table `transkrip_nilai`
--

CREATE TABLE `transkrip_nilai` (
  `kd_transkrip_nilai` varchar(10) NOT NULL,
  `no_mahasiswa` varchar(10) NOT NULL,
  `nm_mahasiswa` varchar(50) NOT NULL,
  `semester` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transkrip_nilai`
--
ALTER TABLE `detail_transkrip_nilai`
  ADD PRIMARY KEY (`kd_detail`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`kd_jurusan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`no_mahasiswa`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`kd_mata_kuliah`);

--
-- Indexes for table `transkrip_nilai`
--
ALTER TABLE `transkrip_nilai`
  ADD PRIMARY KEY (`kd_transkrip_nilai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transkrip_nilai`
--
ALTER TABLE `detail_transkrip_nilai`
  MODIFY `kd_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
