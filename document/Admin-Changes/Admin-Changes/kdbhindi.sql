-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2022 at 02:08 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kdbhindi`
--

-- --------------------------------------------------------

--
-- Table structure for table `offerzone`
--

CREATE TABLE `offerzone` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offerzone`
--

INSERT INTO `offerzone` (`id`, `name`, `image`, `document`, `status`, `created_at`, `updated_at`) VALUES
(9, 'tyty', 'eve_1659437969.jpg', '16594379905829701.xlsx', 1, '2022-08-02 16:29:50', '2022-08-02 16:29:50'),
(10, 'swsss', 'eve_1659439811.jpg', '1659439824212436350.jpg', 1, '2022-08-02 17:00:24', '2022-08-02 17:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `trending`
--

CREATE TABLE `trending` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trending`
--

INSERT INTO `trending` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'f3f1e62d04893bd423e11f5ed9a204a8.jpg', '2022-07-12 17:15:36', '2022-08-01 17:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `welcomenote`
--

CREATE TABLE `welcomenote` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `welcomenote`
--

INSERT INTO `welcomenote` (`id`, `image`, `title`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, '6dc9a23a59ce7113e9048c59de1302c8.jpg', 'Get the Product Delivered Daily', 'Give me your email and you will be daily updated with the latest product & detail!', 1, '2022-07-12 17:15:36', '2022-08-02 17:37:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `offerzone`
--
ALTER TABLE `offerzone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trending`
--
ALTER TABLE `trending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `welcomenote`
--
ALTER TABLE `welcomenote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `offerzone`
--
ALTER TABLE `offerzone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `welcomenote`
--
ALTER TABLE `welcomenote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
