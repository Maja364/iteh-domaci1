-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2023 at 05:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon_lepote`
--

-- --------------------------------------------------------

--
-- Table structure for table `tretmani`
--

CREATE TABLE `tretmani` (
  `id_tretmana` int(11) NOT NULL,
  `naziv_tretmana` varchar(255) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `id_usluge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tretmani`
--

INSERT INTO `tretmani` (`id_tretmana`, `naziv_tretmana`, `trajanje`, `cena`, `id_usluge`) VALUES
(1, 'Feniranje', 30, 500, 1),
(2, 'Sisanje', 60, 1000, 1),
(3, 'Farbanje', 120, 2000, 1),
(4, 'Preliv', 120, 1500, 1),
(5, 'Balayage', 120, 1800, 1),
(6, 'Osnovni manikir', 45, 700, 2),
(7, 'Gel lak', 60, 1000, 2),
(8, 'Nadogradnja', 90, 1200, 2),
(9, 'Izlivanje', 90, 1500, 2),
(10, 'Klasican pedikir', 45, 1000, 3),
(11, 'Gel lak', 90, 1200, 3),
(12, 'Higijenski tretman', 30, 1800, 4),
(13, 'Hemijski piling', 30, 2000, 4),
(14, 'depilacija ruku', 10, 300, 5),
(15, 'depilacija nogu', 15, 400, 5),
(16, 'depilacija nausnica', 5, 200, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'maja', 'maja');

-- --------------------------------------------------------

--
-- Table structure for table `vrste_usluga`
--

CREATE TABLE `vrste_usluga` (
  `id_usluge` int(11) NOT NULL,
  `naziv_usluge` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vrste_usluga`
--

INSERT INTO `vrste_usluga` (`id_usluge`, `naziv_usluge`) VALUES
(1, 'Frizer'),
(2, 'Manikir'),
(3, 'Pedikir'),
(4, 'Kozmeticar'),
(5, 'Depilacija');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tretmani`
--
ALTER TABLE `tretmani`
  ADD PRIMARY KEY (`id_tretmana`),
  ADD KEY `spoljni_kljuc` (`id_usluge`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vrste_usluga`
--
ALTER TABLE `vrste_usluga`
  ADD PRIMARY KEY (`id_usluge`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tretmani`
--
ALTER TABLE `tretmani`
  MODIFY `id_tretmana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vrste_usluga`
--
ALTER TABLE `vrste_usluga`
  MODIFY `id_usluge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tretmani`
--
ALTER TABLE `tretmani`
  ADD CONSTRAINT `spoljni_kljuc` FOREIGN KEY (`id_usluge`) REFERENCES `vrste_usluga` (`id_usluge`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
