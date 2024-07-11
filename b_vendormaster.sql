-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 01:33 AM
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
-- Table structure for table `b_vendormaster`
--

CREATE TABLE `b_vendormaster` (
  `id` int(11) NOT NULL,
  `vendorname` varchar(15) NOT NULL,
  `vendormobile` bigint(10) NOT NULL,
  `vendoremail` varchar(45) NOT NULL,
  `supportregion` varchar(20) NOT NULL,
  `category` varchar(15) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT 'Active',
  `updatedby` varchar(30) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `b_vendormaster`
--

INSERT INTO `b_vendormaster` (`id`, `vendorname`, `vendormobile`, `vendoremail`, `supportregion`, `category`, `status`, `updatedby`, `updatedon`) VALUES
(1, 'Magan Sheth', 9898123098, 'harshusid78@gmail.com', 'Chakan', 'Flight', 'Active', 'Manthan Kapadia', '2023-06-08 00:39:06'),
(2, 'HArsh', 9913273370, 'sidharsh349@gmail.com', 'Por', 'Flight', 'Active', '', '2023-06-28 11:37:38'),
(3, 'Shaw Elbort', 9825470645, 'siddhparaharsh7@gmail.com', 'Sriperumbudur', 'Flight', 'Active', '', '2023-06-08 23:18:37'),
(4, 'Dhriti Shah', 9328135022, 'dhriti180503@gmail.com', 'Tapukara', 'Flight', 'Active', '', '2023-06-09 00:22:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_vendormaster`
--
ALTER TABLE `b_vendormaster`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_vendormaster`
--
ALTER TABLE `b_vendormaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
