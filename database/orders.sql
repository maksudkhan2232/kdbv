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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `OrderNo` varchar(255) NOT NULL,
  `OrderDate` date NOT NULL,
  `OrderStatus` varchar(255) NOT NULL,
  `SubValue` int(11) NOT NULL,
  `ShippingCharges` int(11) NOT NULL,
  `Tax` int(11) NOT NULL,
  `TotalValue` int(11) NOT NULL,
  `BillingName` varchar(255) NOT NULL,
  `BillingEmail` varchar(255) NOT NULL,
  `BillingPhone` varchar(255) NOT NULL,
  `BillingAddress` text NOT NULL,
  `BillingCity` varchar(255) NOT NULL,
  `BillingState` varchar(255) NOT NULL,
  `BillingZipCode` varchar(255) NOT NULL,
  `BillingNote` text,
  `GSTNo` varchar(255) NOT NULL,
  `isDifferentShipping` int(1) NOT NULL,
  `ShippingName` varchar(255) NOT NULL,
  `ShippingEmail` varchar(255) NOT NULL,
  `ShippingAddress` varchar(255) NOT NULL,
  `ShippingCity` varchar(255) NOT NULL,
  `ShippingState` varchar(255) NOT NULL,
  `ShippingZipCode` varchar(255) NOT NULL,
  `Remark` text NOT NULL,
  `created_datetime` datetime NOT NULL,
  `CreatedBy` varchar(55) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `LastModifiedBy` varchar(55) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
