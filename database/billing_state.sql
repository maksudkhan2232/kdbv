-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 08:15 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kdbv`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_state`
--

CREATE TABLE `billing_state` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_state`
--

INSERT INTO `billing_state` (`id`, `name`, `status`) VALUES
(1, 'Andaman and Nicobar Islands', 1),
(2, 'Andhra Pradesh', 1),
(3, 'Arunachal Pradesh', 1),
(4, 'Assam', 1),
(5, 'Bihar', 1),
(6, 'Chandigarh', 1),
(7, 'Chhattisgarh', 1),
(8, 'Dadra and Nagar Haveli', 1),
(9, 'Daman and Diu', 1),
(10, 'Delhi', 1),
(11, 'Goa', 1),
(12, 'Gujarat', 1),
(13, 'Haryana', 1),
(14, 'Himachal Pradesh', 1),
(15, 'Jammu and Kashmir', 1),
(16, 'Jharkhand', 1),
(17, 'Karnataka', 1),
(18, 'Kenmore', 1),
(19, 'Kerala', 1),
(20, 'Lakshadweep', 1),
(21, 'Madhya Pradesh', 1),
(22, 'Maharashtra', 1),
(23, 'Manipur', 1),
(24, 'Meghalaya', 1),
(25, 'Mizoram', 1),
(26, 'Nagaland', 1),
(27, 'Narora', 1),
(28, 'Natwar', 1),
(29, 'Odisha', 1),
(30, 'Paschim Medinipur', 1),
(31, 'Pondicherry', 1),
(32, 'Punjab', 1),
(33, 'Rajasthan', 1),
(34, 'Sikkim', 1),
(35, 'Tamil Nadu', 1),
(36, 'Telangana', 1),
(37, 'Tripura', 1),
(38, 'Uttar Pradesh', 1),
(39, 'Uttarakhand', 1),
(40, 'Vaishali', 1),
(41, 'West Bengal', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_state`
--
ALTER TABLE `billing_state`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_state`
--
ALTER TABLE `billing_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
