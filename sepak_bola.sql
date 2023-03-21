-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 04:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sepak_bola`
--

-- --------------------------------------------------------

--
-- Table structure for table `klasemen`
--

CREATE TABLE `klasemen` (
  `id` int(11) NOT NULL,
  `klub` varchar(100) NOT NULL,
  `ma` int(5) NOT NULL DEFAULT 0,
  `me` int(5) NOT NULL DEFAULT 0,
  `s` int(5) NOT NULL DEFAULT 0,
  `k` int(5) NOT NULL DEFAULT 0,
  `gm` int(5) NOT NULL DEFAULT 0,
  `gk` int(5) NOT NULL DEFAULT 0,
  `point` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasemen`
--

INSERT INTO `klasemen` (`id`, `klub`, `ma`, `me`, `s`, `k`, `gm`, `gk`, `point`) VALUES
(6, 'Arema', 2, 1, 0, 1, 2, 2, 3),
(7, 'Persib', 2, 2, 0, 0, 4, 0, 6),
(8, 'Persija', 2, 0, 0, 2, 0, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `klub`
--

CREATE TABLE `klub` (
  `nama` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klub`
--

INSERT INTO `klub` (`nama`, `kota`) VALUES
('Arema', 'Malang'),
('Persib', 'Bandung'),
('Persija', 'Jakarta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `klasemen`
--
ALTER TABLE `klasemen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `klub` (`klub`);

--
-- Indexes for table `klub`
--
ALTER TABLE `klub`
  ADD PRIMARY KEY (`nama`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klasemen`
--
ALTER TABLE `klasemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `klasemen`
--
ALTER TABLE `klasemen`
  ADD CONSTRAINT `klasemen_ibfk_1` FOREIGN KEY (`klub`) REFERENCES `klub` (`nama`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
