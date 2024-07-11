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
-- Table structure for table `b_location`
--

CREATE TABLE `b_location` (
  `id` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `brcode` varchar(4) NOT NULL,
  `branchemailid` varchar(255) NOT NULL DEFAULT 'itsupport@seweurodriveindia.com',
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `b_location`
--

INSERT INTO `b_location` (`id`, `location`, `brcode`, `branchemailid`, `status`) VALUES
(1, 'BARODA', 'BRDB', 'baroda.sales@seweurodriveindia.com', 0),
(2, 'CHENNAI', 'CHNB', 'chennai.sales@seweurodriveindia.com', 0),
(3, 'AHMEDABAD', 'AHMB', 'ahmedabad@seweurodriveindia.com\n', 0),
(4, 'BANGALORE', 'BAGB', 'banglore@seweurodriveindia.com', 0),
(5, 'BARODA PLANT', 'BRDC', 'baroda.sales@seweurodriveindia.com', 0),
(6, 'CHENNAI PLANT', 'CHNC', 'itsupport@seweurodriveindia.com', 0),
(7, 'CHANDIGARH', 'CHDB', 'itsupport@seweurodriveindia.com', 0),
(8, 'COIMBATORE', 'COIB', 'coimbatore@seweurodriveindia.com', 0),
(9, 'CUTTACK', 'CUTB', 'raipur@seweurodriveindia.com', 0),
(10, 'DELHI', 'DELB', 'delhi@seweurodriveindia.com', 0),
(11, 'HYDERABAD', 'HYDB', 'hydarabad@seweurodriveindia.com', 0),
(12, 'JAMSHEDPUR', 'JAMB', 'raipur@seweurodriveindia.com', 0),
(13, 'KOLKATA', 'KOLB', 'kolkata@seweurodriveindia.com', 0),
(14, 'LUCKNOW', 'LUCB', 'delhi@seweurodriveindia.com', 0),
(15, 'MUMBAI', 'MUMB', 'mumbai@seweurodriveindia.com', 0),
(16, 'NASHIK', 'NASB', 'mumbai@seweurodriveindia.com', 0),
(17, 'PUNE', 'PUNB', 'pune@seweurodriveindia.com', 0),
(18, 'RAIPUR', 'RAIB', 'raipur@seweurodriveindia.com', 0),
(19, 'SRIPERUMBUDUR', 'SPEB', 'chennai.sales@seweurodriveindia.com', 0),
(20, 'KOLHAPUR', 'PUNB', 'salespune@seweurodriveindia.com', 0),
(21, 'BELLARY', 'BAGB', 'banglore@seweurodriveindia.com', 0),
(22, 'RANCHI', 'RAIB', 'raipur@seweurodriveindia.com', 0),
(23, 'TRICHY', 'COIB', 'coimbatore@seweurodriveindia.com', 0),
(24, 'ROPAR', 'DELB', 'delhi@seweurodriveindia.com', 0),
(25, 'GANDHIDHAM', 'AHMB', 'ahmedabad@seweurodriveindia.com\r\n', 0),
(26, 'NAVI MUMBAI', 'MUMB', 'mumbai@seweurodriveindia.com', 0),
(27, 'GURGAON', 'GURB', 'delhi@seweurodriveindia.com', 0),
(28, 'VIJAYAWADA', 'VIJB', 'hydarabad@seweurodriveindia.com', 0),
(29, 'CHAKAN', 'CHAB', 'pune@seweurodriveindia.com', 0),
(30, 'POR', 'PORB', 'baroda.sales@seweurodriveindia.com', 0),
(31, 'POR PLANT', 'PORP', 'barodagrp@seweurodriveindia.com', 0),
(32, 'SRIPERUMBUDUR PLANT', 'SPEP', 'chennaigrp@seweurodriveindia.com', 0),
(33, 'BHOSARI', 'BHOB', 'bhosari@seweurodriveindia.com', 0),
(34, 'CHAKAN PLANT', 'PUNC', 'itsupport@seweurodriveindia.com', 0),
(35, 'INDORE', 'INDB', 'baroda.sales@seweurodriveindia.com', 0),
(36, 'AURANGABAD', 'PUNB', 'pune@seweurodriveindia.com', 0),
(37, 'ELECTRONIC CITY', 'BAGB', 'banglore@seweurodriveindia.com', 0),
(38, 'PEENYA', 'PEEB', 'bangalore@seweurodriveindia.com', 0),
(39, 'VISAKAPATNAM', 'HYDB', 'hyderabad.sales@seweurodriveindia.com', 0),
(40, 'RAJKOT', 'AHMB', 'ahmedabad@seweurodriveindia.com\r\n', 0),
(41, 'FARIDABAD ', 'DELB', 'delhi@seweurodriveindia.com', 0),
(42, 'PONDICHERRY', 'PONB', 'chennai.sales@seweurodriveindia.com', 0),
(43, 'VADODARA', 'BRDB', 'baroda.sales@seweurodriveindia.com', 0),
(44, 'JAIPUR', 'JAIB', 'delhi@seweurodriveindia.com', 0),
(45, 'COCHIN', 'COCB', 'coimbatore@seweurodriveindia.com', 0),
(46, 'GANDHINAGAR', 'GANB', 'ahmedabad@seweurodriveindia.com\r\n', 0),
(47, 'LUDHIANA ', 'LUDB', 'delhi@seweurodriveindia.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_location`
--
ALTER TABLE `b_location`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_location`
--
ALTER TABLE `b_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
