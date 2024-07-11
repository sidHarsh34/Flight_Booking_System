-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 01:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flightbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `b_emp`
--

CREATE TABLE `b_emp` (
  `id` int(3) NOT NULL,
  `tripid` varchar(45) NOT NULL,
  `colleague` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `b_emp`
--

INSERT INTO `b_emp` (`id`, `tripid`, `colleague`) VALUES
(68, 'F-2023-00001', 'PARIMAL MAKWANA'),
(69, 'F-2023-00001', 'MAZUANCHARY JACOB ABRAHAM'),
(70, 'F-2023-00001', 'TUKARAM GHODKE'),
(71, 'F-2023-00001', 'SAYAN MUKHERJEE'),
(72, 'F-2023-00002', 'PARIMAL MAKWANA'),
(73, 'F-2023-00002', 'MAZUANCHARY JACOB ABRAHAM'),
(74, 'F-2023-00002', 'TUKARAM GHODKE'),
(75, 'F-2023-00002', 'SAYAN MUKHERJEE'),
(76, 'F-2023-00003', 'VASUDEVAN SRINIVASAN'),
(77, 'F-2023-00003', 'MAZUANCHARY JACOB ABRAHAM'),
(78, 'F-2023-00003', 'ALKESH MISTRY'),
(79, 'F-2023-00003', 'TUKARAM GHODKE'),
(80, 'F-2023-00003', 'SAYAN MUKHERJEE'),
(81, 'F-2023-00004', 'MAYUR DHARMADHIKARI'),
(82, 'F-2023-00004', 'SHANMUGHA  PRABHU'),
(83, 'F-2023-00005', 'BIJAL SHAH'),
(84, 'F-2023-00005', 'MAYUR DHARMADHIKARI'),
(85, 'F-2023-00003', 'SHANMUGHA  PRABHU'),
(86, 'F-2023-00006', 'BIJAL SHAH'),
(87, 'F-2023-00006', 'ANANT KENDURKAR'),
(88, 'F-2023-00006', 'MAYUR DHARMADHIKARI'),
(89, 'F-2023-00007', 'BIJAL SHAH'),
(90, 'F-2023-00007', 'ANANT KENDURKAR'),
(91, 'F-2023-00007', 'MAYUR DHARMADHIKARI'),
(92, 'F-2023-00016', 'SAYAN MUKHERJEE'),
(93, 'F-2023-00017', 'SAYAN MUKHERJEE'),
(94, 'F-2023-00020', 'SUBODH LADWA'),
(95, 'F-2023-00021', 'SUBODH LADWA'),
(96, 'F-2023-00050', 'SUBHA BEGUR SUBRAMANYA'),
(97, 'F-2023-00050', 'PARTHASARATHI RAY'),
(99, 'F-2023-00024', 'BIJAL SHAH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_emp`
--
ALTER TABLE `b_emp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_emp`
--
ALTER TABLE `b_emp`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
