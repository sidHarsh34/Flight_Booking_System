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
-- Table structure for table `b_tripregister`
--

CREATE TABLE `b_tripregister` (
  `id` int(11) NOT NULL,
  `tripid` varchar(50) NOT NULL,
  `tfrom` varchar(25) NOT NULL,
  `tto` varchar(25) NOT NULL,
  `username` varchar(30) NOT NULL,
  `triptype` varchar(30) NOT NULL,
  `reasonfortravel` varchar(300) NOT NULL,
  `modeoftravel` varchar(15) NOT NULL,
  `departuredate` date NOT NULL,
  `returndate` date NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `vendoremail` varchar(45) NOT NULL,
  `selectionupload` varchar(255) DEFAULT NULL,
  `ticketupload` varchar(255) DEFAULT NULL,
  `invoiceupload` varchar(255) DEFAULT NULL,
  `appliedflag` int(11) DEFAULT NULL,
  `financeid` int(11) NOT NULL,
  `approvedstatus` int(11) DEFAULT NULL,
  `financestatus` int(11) DEFAULT NULL,
  `rejectremark` varchar(1000) DEFAULT NULL,
  `updatedby` varchar(30) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `b_tripregister`
--

INSERT INTO `b_tripregister` (`id`, `tripid`, `tfrom`, `tto`, `username`, `triptype`, `reasonfortravel`, `modeoftravel`, `departuredate`, `returndate`, `remarks`, `vendoremail`, `selectionupload`, `ticketupload`, `invoiceupload`, `appliedflag`, `financeid`, `approvedstatus`, `financestatus`, `rejectremark`, `updatedby`, `updatedon`) VALUES
(1, 'F-2023-00001', 'AHMEDABAD', 'CHENNAI', 'INMAKPAR', '', 'for business purpose', 'Flight', '2023-06-29', '0000-00-00', 'Business Class', 'sidharsh349@gmail.com', NULL, NULL, 'adminupload/649171745bc8a_background.jpg', 0, 0, 0, 0, NULL, '', '2023-06-23 18:18:16'),
(2, 'F-2023-00002', 'AHMEDABAD', 'CHENNAI', 'INMAKPAR', '', 'for business purpose', 'Flight', '2023-06-29', '0000-00-00', 'Business Class', 'sidharsh349@gmail.com', NULL, 'adminupload/6491cd77e5ece_SEW-Logo.png', 'adminupload/649b18f67be5e_background.jpg', 0, 0, 1, 1, NULL, '', '2023-06-30 23:13:30'),
(3, 'F-2023-00003', 'BARODA', 'RAIPUR', 'admin', '', 'b', 'Flight', '2023-06-20', '0000-00-00', ' b', 'tajanisr03@gmail.com', '', '', '', 0, 0, 0, 0, NULL, '', '2023-06-08 05:48:08'),
(4, 'F-2023-00004', 'BARODA PLANT', 'BARODA', 'admin', '', 'gvfkj', 'Flight', '2023-06-14', '0000-00-00', 'gvk', 'harshusid78@gmail.com', '', '', '', 0, 0, 0, 0, NULL, '', '2023-06-08 05:50:53'),
(45, 'F-2023-00036', 'BARODA', 'RAIPUR', 'INMAKPAR', 'Round', 'sdf', 'Flight', '2023-06-28', '2023-06-30', 'sdfg', 'sidharsh349@gmail.com', 'userupload/649c6d4d6439f_Screenshot (22).png', 'adminupload/649c8ad7dd3ef_Screenshot (22).png', 'adminupload/649c2e9b39a2a_Screenshot (22).png', NULL, 0, 1, NULL, NULL, '', '2023-06-28 19:32:39'),
(46, 'F-2023-00037', 'RAIPUR', 'BARODA', 'INMAKPAR', 'One-Way', 'sdf', 'Flight', '2023-06-30', '0000-00-00', 'sdfg', 'sidharsh349@gmail.com', NULL, 'adminupload/649d474120c2c_Screenshot (22).png', 'adminupload/649d49fe239df_Screenshot (22).png', NULL, 0, 1, NULL, NULL, '', '2023-06-30 21:22:16'),
(47, 'F-2023-00038', 'BARODA', 'KOLHAPUR', 'INMAKPAR', 'One Way', 'cdsv', 'Flight', '2023-06-29', '0000-00-00', 'vfd', 'sidharsh349@gmail.com', 'userupload/649c6847ca0c2_Screenshot (22).png', 'adminupload/649d49e21bef1_Screenshot (22).png', 'adminupload/649d4a91a64ba_Screenshot (22).png', NULL, 0, 1, NULL, NULL, '', '2023-06-29 09:52:31'),
(48, 'F-2023-00039', 'BARODA', 'KOLHAPUR', 'INMAKPAR', 'One Way', 'cdsv', 'Flight', '2023-06-29', '0000-00-00', 'vfd', 'sidharsh349@gmail.com', 'userupload/649c6a469d69a_Screenshot (22).png', 'adminupload/649f4c745e17e_background.jpg', 'adminupload/649f4fc720d3a_SEW-Logo.png', NULL, 0, NULL, NULL, NULL, '', '2023-06-30 21:57:27'),
(49, 'F-2023-00040', 'BARODA', 'KOLHAPUR', 'INMAKPAR', 'One Way', 'cdsv', 'Flight', '2023-06-29', '0000-00-00', 'vfd', 'sidharsh349@gmail.com', 'userupload/649c72d7310bd_Screenshot (22).png', NULL, 'adminupload/649974b1191b1_SEW-Logo.png', NULL, 0, 0, NULL, NULL, '', '2023-06-29 17:47:04'),
(50, 'F-2023-00041', 'BARODA', 'KOLHAPUR', 'INMAKPAR', 'One Way', 'cdsv', 'Flight', '2023-06-29', '0000-00-00', 'vfd', 'sidharsh349@gmail.com', 'userupload/649c737b44cd4_Screenshot (22).png', 'adminupload/649d4b9be07d6_Screenshot (22).png', NULL, NULL, 0, NULL, NULL, NULL, '', '2023-06-30 21:05:32'),
(51, 'F-2023-00042', 'BARODA', 'CHANDIGARH', 'INMAKPAR', 'Round', 'zvcb v ', 'Flight', '2023-06-27', '2023-06-28', 'xcfdvb', 'sidharsh349@gmail.com', NULL, 'adminupload/649d4beeaddb4_Screenshot (22).png', NULL, NULL, 0, NULL, NULL, NULL, '', '2023-06-30 21:22:28'),
(52, 'F-2023-00043', 'CHANDIGARH', 'BARODA', 'INMAKPAR', 'One-Way', 'zvcb v ', 'Flight', '2023-06-28', '0000-00-00', 'xcfdvb', 'sidharsh349@gmail.com', 'userupload/649c6ae22e188_Screenshot (22).png', 'adminupload/649f48addf266_slidebg.jpg', NULL, NULL, 0, 1, NULL, NULL, '', '2023-06-30 21:27:21'),
(53, 'F-2023-00044', 'NASHIK', 'BARODA', 'INPALHAR', 'One Way', 'sc', 'Flight', '2023-06-30', '0000-00-00', '', 'harshusid78@gmail.com', 'userupload/649c1e925b866_Screenshot (22).png', NULL, NULL, NULL, 0, 0, NULL, 'mari marji', '', '2023-06-30 23:29:05'),
(54, 'F-2023-00045', 'JAMSHEDPUR', 'BARODA', 'INMAKPAR', 'One Way', 'feer', 'Flight', '2023-06-30', '0000-00-00', '', 'sidharsh349@gmail.com', 'userupload/649c748dac2df_Screenshot (22).png', 'adminupload/649f501108dc3_background.jpg', 'adminupload/649d4d4303bbe_Screenshot (22).png', NULL, 0, 1, NULL, NULL, '', '2023-06-30 21:58:41'),
(55, 'F-2023-00046', 'JAMSHEDPUR', 'BARODA', 'INMAKPAR', 'One Way', 'csd', 'Flight', '2023-06-29', '0000-00-00', 's', 'sidharsh349@gmail.com', 'userupload/649c784b44b24_Screenshot (22).png', 'adminupload/649d50859dc75_Screenshot (22).png', 'adminupload/649d509d33250_Screenshot (22).png', NULL, 0, 1, NULL, NULL, '', '2023-06-29 09:36:51'),
(56, 'F-2023-00047', 'NASHIK', 'BARODA', 'INMAKPAR', 'One Way', 'gk', 'Flight', '2023-07-07', '0000-00-00', '', 'sidharsh349@gmail.com', 'userupload/649c75ec58912_Screenshot (22).png', 'adminupload/649d4d2ecd682_Screenshot (22).png', NULL, NULL, 0, 1, NULL, NULL, '', '2023-06-29 09:21:56'),
(57, 'F-2023-00048', 'MUMBAI', 'BARODA', 'INPALHAR', 'One Way', 'sdfvfd', 'Flight', '2023-07-07', '0000-00-00', 'csd', 'sidharsh349@gmail.com', NULL, 'adminupload/649d4dc4a9d81_Screenshot (22).png', 'adminupload/649d4f95c8ce6_Screenshot (22).png', NULL, 0, 1, NULL, NULL, '', '2023-06-29 09:32:28'),
(58, 'F-2023-00049', 'NASHIK', 'BARODA', 'INPALHAR', 'One Way', 'dfg', 'Flight', '2023-06-30', '0000-00-00', '', 'sidharsh349@gmail.com', NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, '', '2023-06-28 19:50:39'),
(59, 'F-2023-00050', 'KOLHAPUR', 'BARODA', 'INPALHAR', 'One Way', 'fcsd', 'Flight', '2023-06-30', '0000-00-00', '', 'sidharsh349@gmail.com', NULL, 'adminupload/649d4cfc3d32b_Screenshot (22).png', NULL, NULL, 0, 1, NULL, NULL, '', '2023-06-29 17:33:51'),
(60, 'F-2023-00051', 'NASHIK', 'BARODA', 'INPALHAR', 'One Way', 'dews', 'Flight', '2023-07-08', '0000-00-00', '', 'sidharsh349@gmail.com', 'userupload/649c8099ead8d_Screenshot (22).png', 'adminupload/649d46eb17ccb_Screenshot (22).png', NULL, NULL, 0, 1, NULL, NULL, '', '2023-06-29 08:55:07'),
(61, 'F-2023-00052', 'LUCKNOW', 'BARODA', 'INSHABIJ', 'One Way', 'vdf', 'Flight', '2023-06-30', '0000-00-00', 'vd', 'sidharsh349@gmail.com', 'userupload/649d553d7c3bf_Screenshot (22).png', 'adminupload/649d559071338_Screenshot (22).png', 'adminupload/649d55d1c7454_Screenshot (22).png', NULL, 0, NULL, NULL, NULL, '', '2023-06-29 09:59:03'),
(62, 'F-2023-00022', 'BARODA', 'INDORE', 'INMAKPAR', 'Round', 'mari marji', 'Flight', '2023-07-06', '2023-07-13', 'dsfvdcb', 'sidharsh349@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', '2023-06-30 22:49:38'),
(63, 'F-2023-00023', 'INDORE', 'BARODA', 'INMAKPAR', 'One-Way', 'mari marji', 'Flight', '2023-07-13', '0000-00-00', 'dsfvdcb', 'sidharsh349@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', '2023-06-30 22:49:38'),
(64, 'F-2023-00024', 'BARODA', 'KOLKATA', 'INMAKPAR', 'One Way', 'rg', 'Flight', '2023-07-20', '0000-00-00', '', 'sidharsh349@gmail.com', 'userupload/649f5e845ed18_slidebg.jpg', 'adminupload/649f5f7415b76_background.jpg', NULL, NULL, 0, 1, 1, NULL, '', '2023-06-30 23:11:21'),
(65, 'F-2023-00025', 'BARODA', 'KOLKATA', 'INMAKPAR', 'One Way', 'rg', 'Flight', '2023-07-20', '0000-00-00', '', 'sidharsh349@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, '', '2023-06-30 22:57:44'),
(66, 'F-2023-00026', 'BARODA', 'FARIDABAD ', 'INMAKPAR', 'One Way', 'hmn', 'Flight', '2023-07-28', '0000-00-00', '', 'sidharsh349@gmail.com', NULL, NULL, NULL, NULL, 0, 0, 0, 'ekla ekla maja karva nai java dau', '', '2023-06-30 23:30:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_tripregister`
--
ALTER TABLE `b_tripregister`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_tripregister`
--
ALTER TABLE `b_tripregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
