-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2022 at 07:32 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `org_password` varchar(255) DEFAULT NULL,
  `mo_number` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `user_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-master, 1-user',
  `firm_name` varchar(255) DEFAULT NULL,
  `slogan` varchar(255) DEFAULT NULL,
  `address` text,
  `cemail` varchar(255) DEFAULT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `org_password`, `mo_number`, `image`, `status`, `user_type`, `firm_name`, `slogan`, `address`, `cemail`, `contactno`, `facebook`, `twitter`, `instagram`, `linkedin`, `website`, `youtube`, `pinterest`, `create_at`, `update_at`) VALUES
(1, 'KD Bhindi Jewellers', 'kssadmin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '9228253285', '42251_team-img04.jpg', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-02-20 00:00:00', '2022-07-12 05:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `ads_category`
--

CREATE TABLE `ads_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads_category`
--

INSERT INTO `ads_category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home', 1, '2021-06-05 12:32:50', '2022-07-20 15:34:05'),
(3, 'Treding', 1, '2021-06-05 12:33:06', '2022-07-20 15:34:16'),
(4, 'Menu', 1, '2021-06-05 12:33:20', '2022-07-20 15:34:36'),
(5, 'Education', 1, '2021-06-05 12:33:59', '2021-06-05 12:33:59'),
(6, 'Business', 1, '2021-06-05 12:34:11', '2021-06-05 12:34:11'),
(7, 'Service', 1, '2021-06-05 12:34:18', '2021-06-05 16:49:06'),
(9, 'Doctor', 1, '2021-08-19 11:34:52', '2021-08-19 11:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `weblink` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '1 - active , 0 - deactive',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `name`, `city`, `category`, `weblink`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shubhkamna Design Studio', 'Ahmedabad', '1,6', NULL, '81217_5.jpg', 1, '2021-06-02 12:50:30', '2021-06-07 08:22:03'),
(3, 'Rajubhai Dosawala', 'Junagadh', '1,3', NULL, '12691_4.jpg', 1, '2021-06-04 11:25:15', '2021-06-07 08:11:14'),
(4, 'Big Sale', 'Junagadh', '1,3,4,5,6,7', NULL, '75567_3.jpg', 1, '2021-06-04 13:11:27', '2021-06-07 08:10:22'),
(5, 'Diwali Celebration', 'junagadh', '1,4,5', NULL, '16328_1.jpg', 1, '2021-06-04 13:12:17', '2021-06-07 08:09:54'),
(6, 'Jai Ambe Jewellery ', 'Rajkot', '1,4,6', NULL, '36710_1.jpg', 1, '2021-06-04 17:22:37', '2021-06-07 08:08:37'),
(7, 'fastrack watches', 'junagadh', '1,5', NULL, '29450_3.jpg', 1, '2021-06-04 17:23:02', '2021-06-07 08:09:09'),
(8, 'Raymond Collection', 'Rajkot', '3,6', NULL, '92601_2.jpg', 1, '2021-06-04 17:29:27', '2022-05-07 11:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `billing_city`
--

CREATE TABLE `billing_city` (
  `CityID` int(11) NOT NULL,
  `City_Name` varchar(30) NOT NULL,
  `StateID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_city`
--

INSERT INTO `billing_city` (`CityID`, `City_Name`, `StateID`) VALUES
(1, 'Bombuflat', 1),
(2, 'Garacharma', 1),
(3, 'Port Blair', 1),
(4, 'Rangat', 1),
(5, 'Addanki', 2),
(6, 'Adivivaram', 2),
(7, 'Adoni', 2),
(8, 'Aganampudi', 2),
(9, 'Ajjaram', 2),
(10, 'Akividu', 2),
(11, 'Akkarampalle', 2),
(12, 'Akkayapalle', 2),
(13, 'Akkireddipalem', 2),
(14, 'Alampur', 2),
(15, 'Amalapuram', 2),
(16, 'Amudalavalasa', 2),
(17, 'Amur', 2),
(18, 'Anakapalle', 2),
(19, 'Anantapur', 2),
(20, 'Andole', 2),
(21, 'Atmakur', 2),
(22, 'Attili', 2),
(23, 'Avanigadda', 2),
(24, 'Badepalli', 2),
(25, 'Badvel', 2),
(26, 'Balapur', 2),
(27, 'Bandarulanka', 2),
(28, 'Banganapalle', 2),
(29, 'Bapatla', 2),
(30, 'Bapulapadu', 2),
(31, 'Belampalli', 2),
(32, 'Bestavaripeta', 2),
(33, 'Betamcherla', 2),
(34, 'Bhattiprolu', 2),
(35, 'Bhimavaram', 2),
(36, 'Bhimunipatnam', 2),
(37, 'Bobbili', 2),
(38, 'Bombuflat', 2),
(39, 'Bommuru', 2),
(40, 'Bugganipalle', 2),
(41, 'Challapalle', 2),
(42, 'Chandur', 2),
(43, 'Chatakonda', 2),
(44, 'Chemmumiahpet', 2),
(45, 'Chidiga', 2),
(46, 'Chilakaluripet', 2),
(47, 'Chimakurthy', 2),
(48, 'Chinagadila', 2),
(49, 'Chinagantyada', 2),
(50, 'Chinnachawk', 2),
(51, 'Chintalavalasa', 2),
(52, 'Chipurupalle', 2),
(53, 'Chirala', 2),
(54, 'Chittoor', 2),
(55, 'Chodavaram', 2),
(56, 'Choutuppal', 2),
(57, 'Chunchupalle', 2),
(58, 'Cuddapah', 2),
(59, 'Cumbum', 2),
(60, 'Darnakal', 2),
(61, 'Dasnapur', 2),
(62, 'Dauleshwaram', 2),
(63, 'Dharmavaram', 2),
(64, 'Dhone', 2),
(65, 'Dommara Nandyal', 2),
(66, 'Dowlaiswaram', 2),
(67, 'East Godavari Dist.', 2),
(68, 'Eddumailaram', 2),
(69, 'Edulapuram', 2),
(70, 'Ekambara kuppam', 2),
(71, 'Eluru', 2),
(72, 'Enikapadu', 2),
(73, 'Fakirtakya', 2),
(74, 'Farrukhnagar', 2),
(75, 'Gaddiannaram', 2),
(76, 'Gajapathinagaram', 2),
(77, 'Gajularega', 2),
(78, 'Gajuvaka', 2),
(79, 'Gannavaram', 2),
(80, 'Garacharma', 2),
(81, 'Garimellapadu', 2),
(82, 'Giddalur', 2),
(83, 'Godavarikhani', 2),
(84, 'Gopalapatnam', 2),
(85, 'Gopalur', 2),
(86, 'Gorrekunta', 2),
(87, 'Gudivada', 2),
(88, 'Gudur', 2),
(89, 'Guntakal', 2),
(90, 'Guntur', 2),
(91, 'Guti', 2),
(92, 'Hindupur', 2),
(93, 'Hukumpeta', 2),
(94, 'Ichchapuram', 2),
(95, 'Isnapur', 2),
(96, 'Jaggayyapeta', 2),
(97, 'Jallaram Kamanpur', 2),
(98, 'Jammalamadugu', 2),
(99, 'Jangampalli', 2),
(100, 'Jarjapupeta', 2),
(101, 'Kadiri', 2),
(102, 'Kaikalur', 2),
(103, 'Kakinada', 2),
(104, 'Kallur', 2),
(105, 'Kalyandurg', 2),
(106, 'Kamalapuram', 2),
(107, 'Kamareddi', 2),
(108, 'Kanapaka', 2),
(109, 'Kanigiri', 2),
(110, 'Kanithi', 2),
(111, 'Kankipadu', 2),
(112, 'Kantabamsuguda', 2),
(113, 'Kanuru', 2),
(114, 'Karnul', 2),
(115, 'Katheru', 2),
(116, 'Kavali', 2),
(117, 'Kazipet', 2),
(118, 'Khanapuram Haveli', 2),
(119, 'Kodar', 2),
(120, 'Kollapur', 2),
(121, 'Kondapalem', 2),
(122, 'Kondapalle', 2),
(123, 'Kondukur', 2),
(124, 'Kosgi', 2),
(125, 'Kothavalasa', 2),
(126, 'Kottapalli', 2),
(127, 'Kovur', 2),
(128, 'Kovurpalle', 2),
(129, 'Kovvur', 2),
(130, 'Krishna', 2),
(131, 'Kuppam', 2),
(132, 'Kurmannapalem', 2),
(133, 'Kurnool', 2),
(134, 'Lakshettipet', 2),
(135, 'Lalbahadur Nagar', 2),
(136, 'Machavaram', 2),
(137, 'Macherla', 2),
(138, 'Machilipatnam', 2),
(139, 'Madanapalle', 2),
(140, 'Madaram', 2),
(141, 'Madhuravada', 2),
(142, 'Madikonda', 2),
(143, 'Madugule', 2),
(144, 'Mahabubnagar', 2),
(145, 'Mahbubabad', 2),
(146, 'Malkajgiri', 2),
(147, 'Mamilapalle', 2),
(148, 'Mancheral', 2),
(149, 'Mandapeta', 2),
(150, 'Mandasa', 2),
(151, 'Mangalagiri', 2),
(152, 'Manthani', 2),
(153, 'Markapur', 2),
(154, 'Marturu', 2),
(155, 'Metpalli', 2),
(156, 'Mindi', 2),
(157, 'Mirpet', 2),
(158, 'Moragudi', 2),
(159, 'Mothugudam', 2),
(160, 'Nagari', 2),
(161, 'Nagireddipalle', 2),
(162, 'Nandigama', 2),
(163, 'Nandikotkur', 2),
(164, 'Nandyal', 2),
(165, 'Narasannapeta', 2),
(166, 'Narasapur', 2),
(167, 'Narasaraopet', 2),
(168, 'Narayanavanam', 2),
(169, 'Narsapur', 2),
(170, 'Narsingi', 2),
(171, 'Narsipatnam', 2),
(172, 'Naspur', 2),
(173, 'Nathayyapalem', 2),
(174, 'Nayudupeta', 2),
(175, 'Nelimaria', 2),
(176, 'Nellore', 2),
(177, 'Nidadavole', 2),
(178, 'Nuzvid', 2),
(179, 'Omerkhan daira', 2),
(180, 'Ongole', 2),
(181, 'Osmania University', 2),
(182, 'Pakala', 2),
(183, 'Palakole', 2),
(184, 'Palakurthi', 2),
(185, 'Palasa', 2),
(186, 'Palempalle', 2),
(187, 'Palkonda', 2),
(188, 'Palmaner', 2),
(189, 'Pamur', 2),
(190, 'Panjim', 2),
(191, 'Papampeta', 2),
(192, 'Parasamba', 2),
(193, 'Parvatipuram', 2),
(194, 'Patancheru', 2),
(195, 'Payakaraopet', 2),
(196, 'Pedagantyada', 2),
(197, 'Pedana', 2),
(198, 'Peddapuram', 2),
(199, 'Pendurthi', 2),
(200, 'Penugonda', 2),
(201, 'Penukonda', 2),
(202, 'Phirangipuram', 2),
(203, 'Pithapuram', 2),
(204, 'Ponnur', 2),
(205, 'Port Blair', 2),
(206, 'Pothinamallayyapalem', 2),
(207, 'Prakasam', 2),
(208, 'Prasadampadu', 2),
(209, 'Prasantinilayam', 2),
(210, 'Proddatur', 2),
(211, 'Pulivendla', 2),
(212, 'Punganuru', 2),
(213, 'Puttur', 2),
(214, 'Qutubullapur', 2),
(215, 'Rajahmundry', 2),
(216, 'Rajamahendri', 2),
(217, 'Rajampet', 2),
(218, 'Rajendranagar', 2),
(219, 'Rajoli', 2),
(220, 'Ramachandrapuram', 2),
(221, 'Ramanayyapeta', 2),
(222, 'Ramapuram', 2),
(223, 'Ramarajupalli', 2),
(224, 'Ramavarappadu', 2),
(225, 'Rameswaram', 2),
(226, 'Rampachodavaram', 2),
(227, 'Ravulapalam', 2),
(228, 'Rayachoti', 2),
(229, 'Rayadrug', 2),
(230, 'Razam', 2),
(231, 'Razole', 2),
(232, 'Renigunta', 2),
(233, 'Repalle', 2),
(234, 'Rishikonda', 2),
(235, 'Salur', 2),
(236, 'Samalkot', 2),
(237, 'Sattenapalle', 2),
(238, 'Seetharampuram', 2),
(239, 'Serilungampalle', 2),
(240, 'Shankarampet', 2),
(241, 'Shar', 2),
(242, 'Singarayakonda', 2),
(243, 'Sirpur', 2),
(244, 'Sirsilla', 2),
(245, 'Sompeta', 2),
(246, 'Sriharikota', 2),
(247, 'Srikakulam', 2),
(248, 'Srikalahasti', 2),
(249, 'Sriramnagar', 2),
(250, 'Sriramsagar', 2),
(251, 'Srisailam', 2),
(252, 'Srisailamgudem Devasthanam', 2),
(253, 'Sulurpeta', 2),
(254, 'Suriapet', 2),
(255, 'Suryaraopet', 2),
(256, 'Tadepalle', 2),
(257, 'Tadepalligudem', 2),
(258, 'Tadpatri', 2),
(259, 'Tallapalle', 2),
(260, 'Tanuku', 2),
(261, 'Tekkali', 2),
(262, 'Tenali', 2),
(263, 'Tigalapahad', 2),
(264, 'Tiruchanur', 2),
(265, 'Tirumala', 2),
(266, 'Tirupati', 2),
(267, 'Tirvuru', 2),
(268, 'Trimulgherry', 2),
(269, 'Tuni', 2),
(270, 'Turangi', 2),
(271, 'Ukkayapalli', 2),
(272, 'Ukkunagaram', 2),
(273, 'Uppal Kalan', 2),
(274, 'Upper Sileru', 2),
(275, 'Uravakonda', 2),
(276, 'Vadlapudi', 2),
(277, 'Vaparala', 2),
(278, 'Vemalwada', 2),
(279, 'Venkatagiri', 2),
(280, 'Venkatapuram', 2),
(281, 'Vepagunta', 2),
(282, 'Vetapalem', 2),
(283, 'Vijayapuri', 2),
(284, 'Vijayapuri South', 2),
(285, 'Vijayawada', 2),
(286, 'Vinukonda', 2),
(287, 'Visakhapatnam', 2),
(288, 'Vizianagaram', 2),
(289, 'Vuyyuru', 2),
(290, 'Wanparti', 2),
(291, 'West Godavari Dist.', 2),
(292, 'Yadagirigutta', 2),
(293, 'Yarada', 2),
(294, 'Yellamanchili', 2),
(295, 'Yemmiganur', 2),
(296, 'Yenamalakudru', 2),
(297, 'Yendada', 2),
(298, 'Yerraguntla', 2),
(299, 'Along', 3),
(300, 'Basar', 3),
(301, 'Bondila', 3),
(302, 'Changlang', 3),
(303, 'Daporijo', 3),
(304, 'Deomali', 3),
(305, 'Itanagar', 3),
(306, 'Jairampur', 3),
(307, 'Khonsa', 3),
(308, 'Naharlagun', 3),
(309, 'Namsai', 3),
(310, 'Pasighat', 3),
(311, 'Roing', 3),
(312, 'Seppa', 3),
(313, 'Tawang', 3),
(314, 'Tezu', 3),
(315, 'Ziro', 3),
(316, 'Abhayapuri', 4),
(317, 'Ambikapur', 4),
(318, 'Amguri', 4),
(319, 'Anand Nagar', 4),
(320, 'Badarpur', 4),
(321, 'Badarpur Railway Town', 4),
(322, 'Bahbari Gaon', 4),
(323, 'Bamun Sualkuchi', 4),
(324, 'Barbari', 4),
(325, 'Barpathar', 4),
(326, 'Barpeta', 4),
(327, 'Barpeta Road', 4),
(328, 'Basugaon', 4),
(329, 'Bihpuria', 4),
(330, 'Bijni', 4),
(331, 'Bilasipara', 4),
(332, 'Biswanath Chariali', 4),
(333, 'Bohori', 4),
(334, 'Bokajan', 4),
(335, 'Bokokhat', 4),
(336, 'Bongaigaon', 4),
(337, 'Bongaigaon Petro-chemical Town', 4),
(338, 'Borgolai', 4),
(339, 'Chabua', 4),
(340, 'Chandrapur Bagicha', 4),
(341, 'Chapar', 4),
(342, 'Chekonidhara', 4),
(343, 'Choto Haibor', 4),
(344, 'Dergaon', 4),
(345, 'Dharapur', 4),
(346, 'Dhekiajuli', 4),
(347, 'Dhemaji', 4),
(348, 'Dhing', 4),
(349, 'Dhubri', 4),
(350, 'Dhuburi', 4),
(351, 'Dibrugarh', 4),
(352, 'Digboi', 4),
(353, 'Digboi Oil Town', 4),
(354, 'Dimaruguri', 4),
(355, 'Diphu', 4),
(356, 'Dispur', 4),
(357, 'Doboka', 4),
(358, 'Dokmoka', 4),
(359, 'Donkamokan', 4),
(360, 'Duliagaon', 4),
(361, 'Duliajan', 4),
(362, 'Duliajan No.1', 4),
(363, 'Dum Duma', 4),
(364, 'Durga Nagar', 4),
(365, 'Gauripur', 4),
(366, 'Goalpara', 4),
(367, 'Gohpur', 4),
(368, 'Golaghat', 4),
(369, 'Golakganj', 4),
(370, 'Gossaigaon', 4),
(371, 'Guwahati', 4),
(372, 'Haflong', 4),
(373, 'Hailakandi', 4),
(374, 'Hamren', 4),
(375, 'Hauli', 4),
(376, 'Hauraghat', 4),
(377, 'Hojai', 4),
(378, 'Jagiroad', 4),
(379, 'Jagiroad Paper Mill', 4),
(380, 'Jogighopa', 4),
(381, 'Jonai Bazar', 4),
(382, 'Jorhat', 4),
(383, 'Kampur Town', 4),
(384, 'Kamrup', 4),
(385, 'Kanakpur', 4),
(386, 'Karimganj', 4),
(387, 'Kharijapikon', 4),
(388, 'Kharupetia', 4),
(389, 'Kochpara', 4),
(390, 'Kokrajhar', 4),
(391, 'Kumar Kaibarta Gaon', 4),
(392, 'Lakhimpur', 4),
(393, 'Lakhipur', 4),
(394, 'Lala', 4),
(395, 'Lanka', 4),
(396, 'Lido Tikok', 4),
(397, 'Lido Town', 4),
(398, 'Lumding', 4),
(399, 'Lumding Railway Colony', 4),
(400, 'Mahur', 4),
(401, 'Maibong', 4),
(402, 'Majgaon', 4),
(403, 'Makum', 4),
(404, 'Mangaldai', 4),
(405, 'Mankachar', 4),
(406, 'Margherita', 4),
(407, 'Mariani', 4),
(408, 'Marigaon', 4),
(409, 'Moran', 4),
(410, 'Moranhat', 4),
(411, 'Nagaon', 4),
(412, 'Naharkatia', 4),
(413, 'Nalbari', 4),
(414, 'Namrup', 4),
(415, 'Naubaisa Gaon', 4),
(416, 'Nazira', 4),
(417, 'New Bongaigaon Railway Colony', 4),
(418, 'Niz-Hajo', 4),
(419, 'North Guwahati', 4),
(420, 'Numaligarh', 4),
(421, 'Palasbari', 4),
(422, 'Panchgram', 4),
(423, 'Pathsala', 4),
(424, 'Raha', 4),
(425, 'Rangapara', 4),
(426, 'Rangia', 4),
(427, 'Salakati', 4),
(428, 'Sapatgram', 4),
(429, 'Sarthebari', 4),
(430, 'Sarupathar', 4),
(431, 'Sarupathar Bengali', 4),
(432, 'Senchoagaon', 4),
(433, 'Sibsagar', 4),
(434, 'Silapathar', 4),
(435, 'Silchar', 4),
(436, 'Silchar Part-X', 4),
(437, 'Sonari', 4),
(438, 'Sorbhog', 4),
(439, 'Sualkuchi', 4),
(440, 'Tangla', 4),
(441, 'Tezpur', 4),
(442, 'Tihu', 4),
(443, 'Tinsukia', 4),
(444, 'Titabor', 4),
(445, 'Udalguri', 4),
(446, 'Umrangso', 4),
(447, 'Uttar Krishnapur Part-I', 4),
(448, 'Amarpur', 5),
(449, 'Ara', 5),
(450, 'Araria', 5),
(451, 'Areraj', 5),
(452, 'Asarganj', 5),
(453, 'Aurangabad', 5),
(454, 'Bagaha', 5),
(455, 'Bahadurganj', 5),
(456, 'Bairgania', 5),
(457, 'Bakhtiyarpur', 5),
(458, 'Banka', 5),
(459, 'Banmankhi', 5),
(460, 'Bar Bigha', 5),
(461, 'Barauli', 5),
(462, 'Barauni Oil Township', 5),
(463, 'Barh', 5),
(464, 'Barhiya', 5),
(465, 'Bariapur', 5),
(466, 'Baruni', 5),
(467, 'Begusarai', 5),
(468, 'Behea', 5),
(469, 'Belsand', 5),
(470, 'Bettiah', 5),
(471, 'Bhabua', 5),
(472, 'Bhagalpur', 5),
(473, 'Bhimnagar', 5),
(474, 'Bhojpur', 5),
(475, 'Bihar', 5),
(476, 'Bihar Sharif', 5),
(477, 'Bihariganj', 5),
(478, 'Bikramganj', 5),
(479, 'Birpur', 5),
(480, 'Bodh Gaya', 5),
(481, 'Buxar', 5),
(482, 'Chakia', 5),
(483, 'Chanpatia', 5),
(484, 'Chhapra', 5),
(485, 'Chhatapur', 5),
(486, 'Colgong', 5),
(487, 'Dalsingh Sarai', 5),
(488, 'Darbhanga', 5),
(489, 'Daudnagar', 5),
(490, 'Dehri', 5),
(491, 'Dhaka', 5),
(492, 'Dighwara', 5),
(493, 'Dinapur', 5),
(494, 'Dinapur Cantonment', 5),
(495, 'Dumra', 5),
(496, 'Dumraon', 5),
(497, 'Fatwa', 5),
(498, 'Forbesganj', 5),
(499, 'Gaya', 5),
(500, 'Gazipur', 5),
(501, 'Ghoghardiha', 5),
(502, 'Gogri Jamalpur', 5),
(503, 'Gopalganj', 5),
(504, 'Habibpur', 5),
(505, 'Hajipur', 5),
(506, 'Hasanpur', 5),
(507, 'Hazaribagh', 5),
(508, 'Hilsa', 5),
(509, 'Hisua', 5),
(510, 'Islampur', 5),
(511, 'Jagdispur', 5),
(512, 'Jahanabad', 5),
(513, 'Jamalpur', 5),
(514, 'Jamhaur', 5),
(515, 'Jamui', 5),
(516, 'Janakpur Road', 5),
(517, 'Janpur', 5),
(518, 'Jaynagar', 5),
(519, 'Jha Jha', 5),
(520, 'Jhanjharpur', 5),
(521, 'Jogbani', 5),
(522, 'Kanti', 5),
(523, 'Kasba', 5),
(524, 'Kataiya', 5),
(525, 'Katihar', 5),
(526, 'Khagaria', 5),
(527, 'Khagaul', 5),
(528, 'Kharagpur', 5),
(529, 'Khusrupur', 5),
(530, 'Kishanganj', 5),
(531, 'Koath', 5),
(532, 'Koilwar', 5),
(533, 'Lakhisarai', 5),
(534, 'Lalganj', 5),
(535, 'Lauthaha', 5),
(536, 'Madhepura', 5),
(537, 'Madhubani', 5),
(538, 'Maharajganj', 5),
(539, 'Mahnar Bazar', 5),
(540, 'Mairwa', 5),
(541, 'Makhdumpur', 5),
(542, 'Maner', 5),
(543, 'Manihari', 5),
(544, 'Marhaura', 5),
(545, 'Masaurhi', 5),
(546, 'Mirganj', 5),
(547, 'Mohiuddinagar', 5),
(548, 'Mokama', 5),
(549, 'Motihari', 5),
(550, 'Motipur', 5),
(551, 'Munger', 5),
(552, 'Murliganj', 5),
(553, 'Muzaffarpur', 5),
(554, 'Nabinagar', 5),
(555, 'Narkatiaganj', 5),
(556, 'Nasriganj', 5),
(557, 'Natwar', 5),
(558, 'Naugachhia', 5),
(559, 'Nawada', 5),
(560, 'Nirmali', 5),
(561, 'Nokha', 5),
(562, 'Paharpur', 5),
(563, 'Patna', 5),
(564, 'Phulwari', 5),
(565, 'Piro', 5),
(566, 'Purnia', 5),
(567, 'Pusa', 5),
(568, 'Rafiganj', 5),
(569, 'Raghunathpur', 5),
(570, 'Rajgir', 5),
(571, 'Ramnagar', 5),
(572, 'Raxaul', 5),
(573, 'Revelganj', 5),
(574, 'Rusera', 5),
(575, 'Sagauli', 5),
(576, 'Saharsa', 5),
(577, 'Samastipur', 5),
(578, 'Sasaram', 5),
(579, 'Shahpur', 5),
(580, 'Shaikhpura', 5),
(581, 'Sherghati', 5),
(582, 'Shivhar', 5),
(583, 'Silao', 5),
(584, 'Sitamarhi', 5),
(585, 'Siwan', 5),
(586, 'Sonepur', 5),
(587, 'Sultanganj', 5),
(588, 'Supaul', 5),
(589, 'Teghra', 5),
(590, 'Tekari', 5),
(591, 'Thakurganj', 5),
(592, 'Vaishali', 5),
(593, 'Waris Aliganj', 5),
(594, 'Chandigarh', 6),
(595, 'Ahiwara', 7),
(596, 'Akaltara', 7),
(597, 'Ambagarh Chauki', 7),
(598, 'Ambikapur', 7),
(599, 'Arang', 7),
(600, 'Bade Bacheli', 7),
(601, 'Bagbahara', 7),
(602, 'Baikunthpur', 7),
(603, 'Balod', 7),
(604, 'Baloda', 7),
(605, 'Baloda Bazar', 7),
(606, 'Banarsi', 7),
(607, 'Basna', 7),
(608, 'Bemetra', 7),
(609, 'Bhanpuri', 7),
(610, 'Bhatapara', 7),
(611, 'Bhatgaon', 7),
(612, 'Bhilai', 7),
(613, 'Bilaspur', 7),
(614, 'Bilha', 7),
(615, 'Birgaon', 7),
(616, 'Bodri', 7),
(617, 'Champa', 7),
(618, 'Charcha', 7),
(619, 'Charoda', 7),
(620, 'Chhuikhadan', 7),
(621, 'Chirmiri', 7),
(622, 'Dantewada', 7),
(623, 'Deori', 7),
(624, 'Dhamdha', 7),
(625, 'Dhamtari', 7),
(626, 'Dharamjaigarh', 7),
(627, 'Dipka', 7),
(628, 'Doman Hill Colliery', 7),
(629, 'Dongargaon', 7),
(630, 'Dongragarh', 7),
(631, 'Durg', 7),
(632, 'Frezarpur', 7),
(633, 'Gandai', 7),
(634, 'Gariaband', 7),
(635, 'Gaurela', 7),
(636, 'Gelhapani', 7),
(637, 'Gharghoda', 7),
(638, 'Gidam', 7),
(639, 'Gobra Nawapara', 7),
(640, 'Gogaon', 7),
(641, 'Hatkachora', 7),
(642, 'Jagdalpur', 7),
(643, 'Jamui', 7),
(644, 'Jashpurnagar', 7),
(645, 'Jhagrakhand', 7),
(646, 'Kanker', 7),
(647, 'Katghora', 7),
(648, 'Kawardha', 7),
(649, 'Khairagarh', 7),
(650, 'Khamhria', 7),
(651, 'Kharod', 7),
(652, 'Kharsia', 7),
(653, 'Khonga Pani', 7),
(654, 'Kirandu', 7),
(655, 'Kirandul', 7),
(656, 'Kohka', 7),
(657, 'Kondagaon', 7),
(658, 'Korba', 7),
(659, 'Korea', 7),
(660, 'Koria Block', 7),
(661, 'Kota', 7),
(662, 'Kumhari', 7),
(663, 'Kumud Katta', 7),
(664, 'Kurasia', 7),
(665, 'Kurud', 7),
(666, 'Lingiyadih', 7),
(667, 'Lormi', 7),
(668, 'Mahasamund', 7),
(669, 'Mahendragarh', 7),
(670, 'Mehmand', 7),
(671, 'Mongra', 7),
(672, 'Mowa', 7),
(673, 'Mungeli', 7),
(674, 'Nailajanjgir', 7),
(675, 'Namna Kalan', 7),
(676, 'Naya Baradwar', 7),
(677, 'Pandariya', 7),
(678, 'Patan', 7),
(679, 'Pathalgaon', 7),
(680, 'Pendra', 7),
(681, 'Phunderdihari', 7),
(682, 'Pithora', 7),
(683, 'Raigarh', 7),
(684, 'Raipur', 7),
(685, 'Rajgamar', 7),
(686, 'Rajhara', 7),
(687, 'Rajnandgaon', 7),
(688, 'Ramanuj Ganj', 7),
(689, 'Ratanpur', 7),
(690, 'Sakti', 7),
(691, 'Saraipali', 7),
(692, 'Sarajpur', 7),
(693, 'Sarangarh', 7),
(694, 'Shivrinarayan', 7),
(695, 'Simga', 7),
(696, 'Sirgiti', 7),
(697, 'Takhatpur', 7),
(698, 'Telgaon', 7),
(699, 'Tildanewra', 7),
(700, 'Urla', 7),
(701, 'Vishrampur', 7),
(702, 'Amli', 8),
(703, 'Silvassa', 8),
(704, 'Daman', 9),
(705, 'Diu', 9),
(706, 'Delhi', 10),
(707, 'New Delhi', 10),
(708, 'Aldona', 11),
(709, 'Altinho', 11),
(710, 'Aquem', 11),
(711, 'Arpora', 11),
(712, 'Bambolim', 11),
(713, 'Bandora', 11),
(714, 'Bardez', 11),
(715, 'Benaulim', 11),
(716, 'Betora', 11),
(717, 'Bicholim', 11),
(718, 'Calapor', 11),
(719, 'Candolim', 11),
(720, 'Caranzalem', 11),
(721, 'Carapur', 11),
(722, 'Chicalim', 11),
(723, 'Chimbel', 11),
(724, 'Chinchinim', 11),
(725, 'Colvale', 11),
(726, 'Corlim', 11),
(727, 'Cortalim', 11),
(728, 'Cuncolim', 11),
(729, 'Curchorem', 11),
(730, 'Curti', 11),
(731, 'Davorlim', 11),
(732, 'Dona Paula', 11),
(733, 'Goa', 11),
(734, 'Guirim', 11),
(735, 'Jua', 11),
(736, 'Kalangat', 11),
(737, 'Kankon', 11),
(738, 'Kundaim', 11),
(739, 'Loutulim', 11),
(740, 'Madgaon', 11),
(741, 'Mapusa', 11),
(742, 'Margao', 11),
(743, 'Margaon', 11),
(744, 'Miramar', 11),
(745, 'Morjim', 11),
(746, 'Mormugao', 11),
(747, 'Navelim', 11),
(748, 'Pale', 11),
(749, 'Panaji', 11),
(750, 'Parcem', 11),
(751, 'Parra', 11),
(752, 'Penha de Franca', 11),
(753, 'Pernem', 11),
(754, 'Pilerne', 11),
(755, 'Pissurlem', 11),
(756, 'Ponda', 11),
(757, 'Porvorim', 11),
(758, 'Quepem', 11),
(759, 'Queula', 11),
(760, 'Raia', 11),
(761, 'Reis Magos', 11),
(762, 'Salcette', 11),
(763, 'Saligao', 11),
(764, 'Sancoale', 11),
(765, 'Sanguem', 11),
(766, 'Sanquelim', 11),
(767, 'Sanvordem', 11),
(768, 'Sao Jose-de-Areal', 11),
(769, 'Sattari', 11),
(770, 'Serula', 11),
(771, 'Sinquerim', 11),
(772, 'Siolim', 11),
(773, 'Taleigao', 11),
(774, 'Tivim', 11),
(775, 'Valpoi', 11),
(776, 'Varca', 11),
(777, 'Vasco', 11),
(778, 'Verna', 11),
(779, 'Abrama', 12),
(780, 'Adalaj', 12),
(781, 'Adityana', 12),
(782, 'Advana', 12),
(783, 'Ahmedabad', 12),
(784, 'Ahwa', 12),
(785, 'Alang', 12),
(786, 'Ambaji', 12),
(787, 'Ambaliyasan', 12),
(788, 'Amod', 12),
(789, 'Amreli', 12),
(790, 'Amroli', 12),
(791, 'Anand', 12),
(792, 'Andada', 12),
(793, 'Anjar', 12),
(794, 'Anklav', 12),
(795, 'Ankleshwar', 12),
(796, 'Anklesvar INA', 12),
(797, 'Antaliya', 12),
(798, 'Arambhada', 12),
(799, 'Asarma', 12),
(800, 'Atul', 12),
(801, 'Babra', 12),
(802, 'Bag-e-Firdosh', 12),
(803, 'Bagasara', 12),
(804, 'Bahadarpar', 12),
(805, 'Bajipura', 12),
(806, 'Bajva', 12),
(807, 'Balasinor', 12),
(808, 'Banaskantha', 12),
(809, 'Bansda', 12),
(810, 'Bantva', 12),
(811, 'Bardoli', 12),
(812, 'Barwala', 12),
(813, 'Bayad', 12),
(814, 'Bechar', 12),
(815, 'Bedi', 12),
(816, 'Beyt', 12),
(817, 'Bhachau', 12),
(818, 'Bhanvad', 12),
(819, 'Bharuch', 12),
(820, 'Bharuch INA', 12),
(821, 'Bhavnagar', 12),
(822, 'Bhayavadar', 12),
(823, 'Bhestan', 12),
(824, 'Bhuj', 12),
(825, 'Bilimora', 12),
(826, 'Bilkha', 12),
(827, 'Billimora', 12),
(828, 'Bodakdev', 12),
(829, 'Bodeli', 12),
(830, 'Bopal', 12),
(831, 'Boria', 12),
(832, 'Boriavi', 12),
(833, 'Borsad', 12),
(834, 'Botad', 12),
(835, 'Cambay', 12),
(836, 'Chaklasi', 12),
(837, 'Chala', 12),
(838, 'Chalala', 12),
(839, 'Chalthan', 12),
(840, 'Chanasma', 12),
(841, 'Chandisar', 12),
(842, 'Chandkheda', 12),
(843, 'Chanod', 12),
(844, 'Chaya', 12),
(845, 'Chenpur', 12),
(846, 'Chhapi', 12),
(847, 'Chhaprabhatha', 12),
(848, 'Chhatral', 12),
(849, 'Chhota Udepur', 12),
(850, 'Chikhli', 12),
(851, 'Chiloda', 12),
(852, 'Chorvad', 12),
(853, 'Chotila', 12),
(854, 'Dabhoi', 12),
(855, 'Dadara', 12),
(856, 'Dahod', 12),
(857, 'Dakor', 12),
(858, 'Damnagar', 12),
(859, 'Deesa', 12),
(860, 'Delvada', 12),
(861, 'Devgadh Baria', 12),
(862, 'Devsar', 12),
(863, 'Dhandhuka', 12),
(864, 'Dhanera', 12),
(865, 'Dhangdhra', 12),
(866, 'Dhansura', 12),
(867, 'Dharampur', 12),
(868, 'Dhari', 12),
(869, 'Dhola', 12),
(870, 'Dholka', 12),
(871, 'Dholka Rural', 12),
(872, 'Dhoraji', 12),
(873, 'Dhrangadhra', 12),
(874, 'Dhrol', 12),
(875, 'Dhuva', 12),
(876, 'Dhuwaran', 12),
(877, 'Digvijaygram', 12),
(878, 'Disa', 12),
(879, 'Dungar', 12),
(880, 'Dungarpur', 12),
(881, 'Dungra', 12),
(882, 'Dwarka', 12),
(883, 'Flelanganj', 12),
(884, 'GSFC Complex', 12),
(885, 'Gadhda', 12),
(886, 'Gandevi', 12),
(887, 'Gandhidham', 12),
(888, 'Gandhinagar', 12),
(889, 'Gariadhar', 12),
(890, 'Ghogha', 12),
(891, 'Godhra', 12),
(892, 'Gondal', 12),
(893, 'Hajira INA', 12),
(894, 'Halol', 12),
(895, 'Halvad', 12),
(896, 'Hansot', 12),
(897, 'Harij', 12),
(898, 'Himatnagar', 12),
(899, 'Ichchhapor', 12),
(900, 'Idar', 12),
(901, 'Jafrabad', 12),
(902, 'Jalalpore', 12),
(903, 'Jambusar', 12),
(904, 'Jamjodhpur', 12),
(905, 'Jamnagar', 12),
(906, 'Jasdan', 12),
(907, 'Jawaharnagar', 12),
(908, 'Jetalsar', 12),
(909, 'Jetpur', 12),
(910, 'Jodiya', 12),
(911, 'Joshipura', 12),
(912, 'Junagadh', 12),
(913, 'Kadi', 12),
(914, 'Kadodara', 12),
(915, 'Kalavad', 12),
(916, 'Kali', 12),
(917, 'Kaliawadi', 12),
(918, 'Kalol', 12),
(919, 'Kalol INA', 12),
(920, 'Kandla', 12),
(921, 'Kanjari', 12),
(922, 'Kanodar', 12),
(923, 'Kapadwanj', 12),
(924, 'Karachiya', 12),
(925, 'Karamsad', 12),
(926, 'Karjan', 12),
(927, 'Kathial', 12),
(928, 'Kathor', 12),
(929, 'Katpar', 12),
(930, 'Kavant', 12),
(931, 'Keshod', 12),
(932, 'Kevadiya', 12),
(933, 'Khambhaliya', 12),
(934, 'Khambhat', 12),
(935, 'Kharaghoda', 12),
(936, 'Khed Brahma', 12),
(937, 'Kheda', 12),
(938, 'Kheralu', 12),
(939, 'Kodinar', 12),
(940, 'Kosamba', 12),
(941, 'Kundla', 12),
(942, 'Kutch', 12),
(943, 'Kutiyana', 12),
(944, 'Lakhtar', 12),
(945, 'Lalpur', 12),
(946, 'Lambha', 12),
(947, 'Lathi', 12),
(948, 'Limbdi', 12),
(949, 'Limla', 12),
(950, 'Lunavada', 12),
(951, 'Madhapar', 12),
(952, 'Maflipur', 12),
(953, 'Mahemdavad', 12),
(954, 'Mahudha', 12),
(955, 'Mahuva', 12),
(956, 'Mahuvar', 12),
(957, 'Makarba', 12),
(958, 'Makarpura', 12),
(959, 'Makassar', 12),
(960, 'Maktampur', 12),
(961, 'Malia', 12),
(962, 'Malpur', 12),
(963, 'Manavadar', 12),
(964, 'Mandal', 12),
(965, 'Mandvi', 12),
(966, 'Mangrol', 12),
(967, 'Mansa', 12),
(968, 'Meghraj', 12),
(969, 'Mehsana', 12),
(970, 'Mendarla', 12),
(971, 'Mithapur', 12),
(972, 'Modasa', 12),
(973, 'Mogravadi', 12),
(974, 'Morbi', 12),
(975, 'Morvi', 12),
(976, 'Mundra', 12),
(977, 'Nadiad', 12),
(978, 'Naliya', 12),
(979, 'Nanakvada', 12),
(980, 'Nandej', 12),
(981, 'Nandesari', 12),
(982, 'Nandesari INA', 12),
(983, 'Naroda', 12),
(984, 'Navagadh', 12),
(985, 'Navagam Ghed', 12),
(986, 'Navsari', 12),
(987, 'Ode', 12),
(988, 'Okaf', 12),
(989, 'Okha', 12),
(990, 'Olpad', 12),
(991, 'Paddhari', 12),
(992, 'Padra', 12),
(993, 'Palanpur', 12),
(994, 'Palej', 12),
(995, 'Pali', 12),
(996, 'Palitana', 12),
(997, 'Paliyad', 12),
(998, 'Pandesara', 12),
(999, 'Panoli', 12),
(1000, 'Pardi', 12),
(1001, 'Parnera', 12),
(1002, 'Parvat', 12),
(1003, 'Patan', 12),
(1004, 'Patdi', 12),
(1005, 'Petlad', 12),
(1006, 'Petrochemical Complex', 12),
(1007, 'Porbandar', 12),
(1008, 'Prantij', 12),
(1009, 'Radhanpur', 12),
(1010, 'Raiya', 12),
(1011, 'Rajkot', 12),
(1012, 'Rajpipla', 12),
(1013, 'Rajula', 12),
(1014, 'Ramod', 12),
(1015, 'Ranavav', 12),
(1016, 'Ranoli', 12),
(1017, 'Rapar', 12),
(1018, 'Sahij', 12),
(1019, 'Salaya', 12),
(1020, 'Sanand', 12),
(1021, 'Sankheda', 12),
(1022, 'Santrampur', 12),
(1023, 'Saribujrang', 12),
(1024, 'Sarigam INA', 12),
(1025, 'Sayan', 12),
(1026, 'Sayla', 12),
(1027, 'Shahpur', 12),
(1028, 'Shahwadi', 12),
(1029, 'Shapar', 12),
(1030, 'Shivrajpur', 12),
(1031, 'Siddhapur', 12),
(1032, 'Sidhpur', 12),
(1033, 'Sihor', 12),
(1034, 'Sika', 12),
(1035, 'Singarva', 12),
(1036, 'Sinor', 12),
(1037, 'Sojitra', 12),
(1038, 'Sola', 12),
(1039, 'Songadh', 12),
(1040, 'Suraj Karadi', 12),
(1041, 'Surat', 12),
(1042, 'Surendranagar', 12),
(1043, 'Talaja', 12),
(1044, 'Talala', 12),
(1045, 'Talod', 12),
(1046, 'Tankara', 12),
(1047, 'Tarsali', 12),
(1048, 'Thangadh', 12),
(1049, 'Tharad', 12),
(1050, 'Thasra', 12),
(1051, 'Udyognagar', 12),
(1052, 'Ukai', 12),
(1053, 'Umbergaon', 12),
(1054, 'Umbergaon INA', 12),
(1055, 'Umrala', 12),
(1056, 'Umreth', 12),
(1057, 'Un', 12),
(1058, 'Una', 12),
(1059, 'Unjha', 12),
(1060, 'Upleta', 12),
(1061, 'Utran', 12),
(1062, 'Uttarsanda', 12),
(1063, 'V.U. Nagar', 12),
(1064, 'V.V. Nagar', 12),
(1065, 'Vadia', 12),
(1066, 'Vadla', 12),
(1067, 'Vadnagar', 12),
(1068, 'Vadodara', 12),
(1069, 'Vaghodia INA', 12),
(1070, 'Valbhipur', 12),
(1071, 'Vallabh Vidyanagar', 12),
(1072, 'Valsad', 12),
(1073, 'Valsad INA', 12),
(1074, 'Vanthali', 12),
(1075, 'Vapi', 12),
(1076, 'Vapi INA', 12),
(1077, 'Vartej', 12),
(1078, 'Vasad', 12),
(1079, 'Vasna Borsad INA', 12),
(1080, 'Vaso', 12),
(1081, 'Veraval', 12),
(1082, 'Vidyanagar', 12),
(1083, 'Vijalpor', 12),
(1084, 'Vijapur', 12),
(1085, 'Vinchhiya', 12),
(1086, 'Vinzol', 12),
(1087, 'Virpur', 12),
(1088, 'Visavadar', 12),
(1089, 'Visnagar', 12),
(1090, 'Vyara', 12),
(1091, 'Wadhwan', 12),
(1092, 'Waghai', 12),
(1093, 'Waghodia', 12),
(1094, 'Wankaner', 12),
(1095, 'Zalod', 12),
(1096, 'Ambala', 13),
(1097, 'Ambala Cantt', 13),
(1098, 'Asan Khurd', 13),
(1099, 'Asandh', 13),
(1100, 'Ateli', 13),
(1101, 'Babiyal', 13),
(1102, 'Bahadurgarh', 13),
(1103, 'Ballabgarh', 13),
(1104, 'Barwala', 13),
(1105, 'Bawal', 13),
(1106, 'Bawani Khera', 13),
(1107, 'Beri', 13),
(1108, 'Bhiwani', 13),
(1109, 'Bilaspur', 13),
(1110, 'Buria', 13),
(1111, 'Charkhi Dadri', 13),
(1112, 'Chhachhrauli', 13),
(1113, 'Chita', 13),
(1114, 'Dabwali', 13),
(1115, 'Dharuhera', 13),
(1116, 'Dundahera', 13),
(1117, 'Ellenabad', 13),
(1118, 'Farakhpur', 13),
(1119, 'Faridabad', 13),
(1120, 'Farrukhnagar', 13),
(1121, 'Fatehabad', 13),
(1122, 'Firozpur Jhirka', 13),
(1123, 'Gannaur', 13),
(1124, 'Ghraunda', 13),
(1125, 'Gohana', 13),
(1126, 'Gurgaon', 13),
(1127, 'Haileymandi', 13),
(1128, 'Hansi', 13),
(1129, 'Hasanpur', 13),
(1130, 'Hathin', 13),
(1131, 'Hisar', 13),
(1132, 'Hissar', 13),
(1133, 'Hodal', 13),
(1134, 'Indri', 13),
(1135, 'Jagadhri', 13),
(1136, 'Jakhal Mandi', 13),
(1137, 'Jhajjar', 13),
(1138, 'Jind', 13),
(1139, 'Julana', 13),
(1140, 'Kaithal', 13),
(1141, 'Kalanur', 13),
(1142, 'Kalanwali', 13),
(1143, 'Kalayat', 13),
(1144, 'Kalka', 13),
(1145, 'Kanina', 13),
(1146, 'Kansepur', 13),
(1147, 'Kardhan', 13),
(1148, 'Karnal', 13),
(1149, 'Kharkhoda', 13),
(1150, 'Kheri Sampla', 13),
(1151, 'Kundli', 13),
(1152, 'Kurukshetra', 13),
(1153, 'Ladrawan', 13),
(1154, 'Ladwa', 13),
(1155, 'Loharu', 13),
(1156, 'Maham', 13),
(1157, 'Mahendragarh', 13),
(1158, 'Mustafabad', 13),
(1159, 'Nagai Chaudhry', 13),
(1160, 'Narayangarh', 13),
(1161, 'Narnaul', 13),
(1162, 'Narnaund', 13),
(1163, 'Narwana', 13),
(1164, 'Nilokheri', 13),
(1165, 'Nuh', 13),
(1166, 'Palwal', 13),
(1167, 'Panchkula', 13),
(1168, 'Panipat', 13),
(1169, 'Panipat Taraf Ansar', 13),
(1170, 'Panipat Taraf Makhdum Zadgan', 13),
(1171, 'Panipat Taraf Rajputan', 13),
(1172, 'Pehowa', 13),
(1173, 'Pinjaur', 13),
(1174, 'Punahana', 13),
(1175, 'Pundri', 13),
(1176, 'Radaur', 13),
(1177, 'Raipur Rani', 13),
(1178, 'Rania', 13),
(1179, 'Ratiya', 13),
(1180, 'Rewari', 13),
(1181, 'Rohtak', 13),
(1182, 'Ropar', 13),
(1183, 'Sadauri', 13),
(1184, 'Safidon', 13),
(1185, 'Samalkha', 13),
(1186, 'Sankhol', 13),
(1187, 'Sasauli', 13),
(1188, 'Shahabad', 13),
(1189, 'Sirsa', 13),
(1190, 'Siwani', 13),
(1191, 'Sohna', 13),
(1192, 'Sonipat', 13),
(1193, 'Sukhrali', 13),
(1194, 'Taoru', 13),
(1195, 'Taraori', 13),
(1196, 'Tauru', 13),
(1197, 'Thanesar', 13),
(1198, 'Tilpat', 13),
(1199, 'Tohana', 13),
(1200, 'Tosham', 13),
(1201, 'Uchana', 13),
(1202, 'Uklana Mandi', 13),
(1203, 'Uncha Siwana', 13),
(1204, 'Yamunanagar', 13),
(1205, 'Arki', 14),
(1206, 'Baddi', 14),
(1207, 'Bakloh', 14),
(1208, 'Banjar', 14),
(1209, 'Bhota', 14),
(1210, 'Bhuntar', 14),
(1211, 'Bilaspur', 14),
(1212, 'Chamba', 14),
(1213, 'Chaupal', 14),
(1214, 'Chuari Khas', 14),
(1215, 'Dagshai', 14),
(1216, 'Dalhousie', 14),
(1217, 'Dalhousie Cantonment', 14),
(1218, 'Damtal', 14),
(1219, 'Daulatpur', 14),
(1220, 'Dera Gopipur', 14),
(1221, 'Dhalli', 14),
(1222, 'Dharamshala', 14),
(1223, 'Gagret', 14),
(1224, 'Ghamarwin', 14),
(1225, 'Hamirpur', 14),
(1226, 'Jawala Mukhi', 14),
(1227, 'Jogindarnagar', 14),
(1228, 'Jubbal', 14),
(1229, 'Jutogh', 14),
(1230, 'Kala Amb', 14),
(1231, 'Kalpa', 14),
(1232, 'Kangra', 14),
(1233, 'Kasauli', 14),
(1234, 'Kot Khai', 14),
(1235, 'Kullu', 14),
(1236, 'Kulu', 14),
(1237, 'Manali', 14),
(1238, 'Mandi', 14),
(1239, 'Mant Khas', 14),
(1240, 'Mehatpur Basdehra', 14),
(1241, 'Nadaun', 14),
(1242, 'Nagrota', 14),
(1243, 'Nahan', 14),
(1244, 'Naina Devi', 14),
(1245, 'Nalagarh', 14),
(1246, 'Narkanda', 14),
(1247, 'Nurpur', 14),
(1248, 'Palampur', 14),
(1249, 'Pandoh', 14),
(1250, 'Paonta Sahib', 14),
(1251, 'Parwanoo', 14),
(1252, 'Parwanu', 14),
(1253, 'Rajgarh', 14),
(1254, 'Rampur', 14),
(1255, 'Rawalsar', 14),
(1256, 'Rohru', 14),
(1257, 'Sabathu', 14),
(1258, 'Santokhgarh', 14),
(1259, 'Sarahan', 14),
(1260, 'Sarka Ghat', 14),
(1261, 'Seoni', 14),
(1262, 'Shimla', 14),
(1263, 'Sirmaur', 14),
(1264, 'Solan', 14),
(1265, 'Solon', 14),
(1266, 'Sundarnagar', 14),
(1267, 'Sundernagar', 14),
(1268, 'Talai', 14),
(1269, 'Theog', 14),
(1270, 'Tira Sujanpur', 14),
(1271, 'Una', 14),
(1272, 'Yol', 14),
(1273, 'Achabal', 15),
(1274, 'Akhnur', 15),
(1275, 'Anantnag', 15),
(1276, 'Arnia', 15),
(1277, 'Awantipora', 15),
(1278, 'Badami Bagh', 15),
(1279, 'Bandipur', 15),
(1280, 'Banihal', 15),
(1281, 'Baramula', 15),
(1282, 'Baramulla', 15),
(1283, 'Bari Brahmana', 15),
(1284, 'Bashohli', 15),
(1285, 'Batote', 15),
(1286, 'Bhaderwah', 15),
(1287, 'Bijbiara', 15),
(1288, 'Billawar', 15),
(1289, 'Birwah', 15),
(1290, 'Bishna', 15),
(1291, 'Budgam', 15),
(1292, 'Charari Sharief', 15),
(1293, 'Chenani', 15),
(1294, 'Doda', 15),
(1295, 'Duru-Verinag', 15),
(1296, 'Gandarbat', 15),
(1297, 'Gho Manhasan', 15),
(1298, 'Gorah Salathian', 15),
(1299, 'Gulmarg', 15),
(1300, 'Hajan', 15),
(1301, 'Handwara', 15),
(1302, 'Hiranagar', 15),
(1303, 'Jammu', 15),
(1304, 'Jammu Cantonment', 15),
(1305, 'Jammu Tawi', 15),
(1306, 'Jourian', 15),
(1307, 'Kargil', 15),
(1308, 'Kathua', 15),
(1309, 'Katra', 15),
(1310, 'Khan Sahib', 15),
(1311, 'Khour', 15),
(1312, 'Khrew', 15),
(1313, 'Kishtwar', 15),
(1314, 'Kud', 15),
(1315, 'Kukernag', 15),
(1316, 'Kulgam', 15),
(1317, 'Kunzer', 15),
(1318, 'Kupwara', 15),
(1319, 'Lakhenpur', 15),
(1320, 'Leh', 15),
(1321, 'Magam', 15),
(1322, 'Mattan', 15),
(1323, 'Naushehra', 15),
(1324, 'Pahalgam', 15),
(1325, 'Pampore', 15),
(1326, 'Parole', 15),
(1327, 'Pattan', 15),
(1328, 'Pulwama', 15),
(1329, 'Punch', 15),
(1330, 'Qazigund', 15),
(1331, 'Rajauri', 15),
(1332, 'Ramban', 15),
(1333, 'Ramgarh', 15),
(1334, 'Ramnagar', 15),
(1335, 'Ranbirsingh Pora', 15),
(1336, 'Reasi', 15),
(1337, 'Rehambal', 15),
(1338, 'Samba', 15),
(1339, 'Shupiyan', 15),
(1340, 'Sopur', 15),
(1341, 'Srinagar', 15),
(1342, 'Sumbal', 15),
(1343, 'Sunderbani', 15),
(1344, 'Talwara', 15),
(1345, 'Thanamandi', 15),
(1346, 'Tral', 15),
(1347, 'Udhampur', 15),
(1348, 'Uri', 15),
(1349, 'Vijaypur', 15),
(1350, 'Adityapur', 16),
(1351, 'Amlabad', 16),
(1352, 'Angarpathar', 16),
(1353, 'Ara', 16),
(1354, 'Babua Kalan', 16),
(1355, 'Bagbahra', 16),
(1356, 'Baliapur', 16),
(1357, 'Baliari', 16),
(1358, 'Balkundra', 16),
(1359, 'Bandhgora', 16),
(1360, 'Barajamda', 16),
(1361, 'Barhi', 16),
(1362, 'Barka Kana', 16),
(1363, 'Barki Saraiya', 16),
(1364, 'Barughutu', 16),
(1365, 'Barwadih', 16),
(1366, 'Basaria', 16),
(1367, 'Basukinath', 16),
(1368, 'Bermo', 16),
(1369, 'Bhagatdih', 16),
(1370, 'Bhaurah', 16),
(1371, 'Bhojudih', 16),
(1372, 'Bhuli', 16),
(1373, 'Bokaro', 16),
(1374, 'Borio Bazar', 16),
(1375, 'Bundu', 16),
(1376, 'Chaibasa', 16),
(1377, 'Chaitudih', 16),
(1378, 'Chakradharpur', 16),
(1379, 'Chakulia', 16),
(1380, 'Chandaur', 16),
(1381, 'Chandil', 16),
(1382, 'Chandrapura', 16),
(1383, 'Chas', 16),
(1384, 'Chatra', 16),
(1385, 'Chhatatanr', 16),
(1386, 'Chhotaputki', 16),
(1387, 'Chiria', 16),
(1388, 'Chirkunda', 16),
(1389, 'Churi', 16),
(1390, 'Daltenganj', 16),
(1391, 'Danguwapasi', 16),
(1392, 'Dari', 16),
(1393, 'Deoghar', 16),
(1394, 'Deorikalan', 16),
(1395, 'Devghar', 16),
(1396, 'Dhanbad', 16),
(1397, 'Dhanwar', 16),
(1398, 'Dhaunsar', 16),
(1399, 'Dugda', 16),
(1400, 'Dumarkunda', 16),
(1401, 'Dumka', 16),
(1402, 'Egarkunr', 16),
(1403, 'Gadhra', 16),
(1404, 'Garwa', 16),
(1405, 'Ghatsila', 16),
(1406, 'Ghorabandha', 16),
(1407, 'Gidi', 16),
(1408, 'Giridih', 16),
(1409, 'Gobindpur', 16),
(1410, 'Godda', 16),
(1411, 'Godhar', 16),
(1412, 'Golphalbari', 16),
(1413, 'Gomoh', 16),
(1414, 'Gua', 16),
(1415, 'Gumia', 16),
(1416, 'Gumla', 16),
(1417, 'Haludbani', 16),
(1418, 'Hazaribag', 16),
(1419, 'Hesla', 16),
(1420, 'Husainabad', 16),
(1421, 'Isri', 16),
(1422, 'Jadugora', 16),
(1423, 'Jagannathpur', 16),
(1424, 'Jamadoba', 16),
(1425, 'Jamshedpur', 16),
(1426, 'Jamtara', 16),
(1427, 'Jarangdih', 16),
(1428, 'Jaridih', 16),
(1429, 'Jasidih', 16),
(1430, 'Jena', 16),
(1431, 'Jharia', 16),
(1432, 'Jharia Khas', 16),
(1433, 'Jhinkpani', 16),
(1434, 'Jhumri Tilaiya', 16),
(1435, 'Jorapokhar', 16),
(1436, 'Jugsalai', 16),
(1437, 'Kailudih', 16),
(1438, 'Kalikapur', 16),
(1439, 'Kandra', 16),
(1440, 'Kanke', 16),
(1441, 'Katras', 16),
(1442, 'Kedla', 16),
(1443, 'Kenduadih', 16),
(1444, 'Kharkhari', 16),
(1445, 'Kharsawan', 16),
(1446, 'Khelari', 16),
(1447, 'Khunti', 16),
(1448, 'Kiri Buru', 16),
(1449, 'Kiriburu', 16),
(1450, 'Kodarma', 16),
(1451, 'Kuju', 16),
(1452, 'Kurpania', 16),
(1453, 'Kustai', 16),
(1454, 'Lakarka', 16),
(1455, 'Lapanga', 16),
(1456, 'Latehar', 16),
(1457, 'Lohardaga', 16),
(1458, 'Loiya', 16),
(1459, 'Loyabad', 16),
(1460, 'Madhupur', 16),
(1461, 'Mahesh Mundi', 16),
(1462, 'Maithon', 16),
(1463, 'Malkera', 16),
(1464, 'Mango', 16),
(1465, 'Manoharpur', 16),
(1466, 'Marma', 16),
(1467, 'Meghahatuburu Forest village', 16),
(1468, 'Mera', 16),
(1469, 'Meru', 16),
(1470, 'Mihijam', 16),
(1471, 'Mugma', 16),
(1472, 'Muri', 16),
(1473, 'Mushabani', 16),
(1474, 'Nagri Kalan', 16),
(1475, 'Netarhat', 16),
(1476, 'Nirsa', 16),
(1477, 'Noamundi', 16),
(1478, 'Okni', 16),
(1479, 'Orla', 16),
(1480, 'Pakaur', 16),
(1481, 'Palamau', 16),
(1482, 'Palawa', 16),
(1483, 'Panchet', 16),
(1484, 'Panrra', 16),
(1485, 'Paratdih', 16),
(1486, 'Pathardih', 16),
(1487, 'Patratu', 16),
(1488, 'Phusro', 16),
(1489, 'Pondar Kanali', 16),
(1490, 'Rajmahal', 16),
(1491, 'Ramgarh', 16),
(1492, 'Ranchi', 16),
(1493, 'Ray', 16),
(1494, 'Rehla', 16),
(1495, 'Religara', 16),
(1496, 'Rohraband', 16),
(1497, 'Sahibganj', 16),
(1498, 'Sahnidih', 16),
(1499, 'Saraidhela', 16),
(1500, 'Saraikela', 16),
(1501, 'Sarjamda', 16),
(1502, 'Saunda', 16),
(1503, 'Sewai', 16),
(1504, 'Sijhua', 16),
(1505, 'Sijua', 16),
(1506, 'Simdega', 16),
(1507, 'Sindari', 16),
(1508, 'Sinduria', 16),
(1509, 'Sini', 16),
(1510, 'Sirka', 16),
(1511, 'Siuliban', 16),
(1512, 'Surubera', 16),
(1513, 'Tati', 16),
(1514, 'Tenudam', 16),
(1515, 'Tisra', 16),
(1516, 'Topa', 16),
(1517, 'Topchanchi', 16),
(1518, 'Adityanagar', 17),
(1519, 'Adityapatna', 17),
(1520, 'Afzalpur', 17),
(1521, 'Ajjampur', 17),
(1522, 'Aland', 17),
(1523, 'Almatti Sitimani', 17),
(1524, 'Alnavar', 17),
(1525, 'Alur', 17),
(1526, 'Ambikanagara', 17),
(1527, 'Anekal', 17),
(1528, 'Ankola', 17),
(1529, 'Annigeri', 17),
(1530, 'Arkalgud', 17),
(1531, 'Arsikere', 17),
(1532, 'Athni', 17),
(1533, 'Aurad', 17),
(1534, 'Badagavettu', 17),
(1535, 'Badami', 17),
(1536, 'Bagalkot', 17),
(1537, 'Bagepalli', 17),
(1538, 'Bailhongal', 17),
(1539, 'Baindur', 17),
(1540, 'Bajala', 17),
(1541, 'Bajpe', 17),
(1542, 'Banavar', 17),
(1543, 'Bangarapet', 17),
(1544, 'Bankapura', 17),
(1545, 'Bannur', 17),
(1546, 'Bantwal', 17),
(1547, 'Basavakalyan', 17),
(1548, 'Basavana Bagevadi', 17),
(1549, 'Belagula', 17),
(1550, 'Belakavadiq', 17),
(1551, 'Belgaum', 17),
(1552, 'Belgaum Cantonment', 17),
(1553, 'Bellary', 17),
(1554, 'Belluru', 17),
(1555, 'Beltangadi', 17),
(1556, 'Belur', 17),
(1557, 'Belvata', 17),
(1558, 'Bengaluru', 17),
(1559, 'Bhadravati', 17),
(1560, 'Bhalki', 17),
(1561, 'Bhatkal', 17),
(1562, 'Bhimarayanagudi', 17),
(1563, 'Bhogadi', 17),
(1564, 'Bidar', 17),
(1565, 'Bijapur', 17),
(1566, 'Bilgi', 17),
(1567, 'Birur', 17),
(1568, 'Bommanahalli', 17),
(1569, 'Bommasandra', 17),
(1570, 'Byadgi', 17),
(1571, 'Byatarayanapura', 17),
(1572, 'Chakranagar Colony', 17),
(1573, 'Challakere', 17),
(1574, 'Chamrajnagar', 17),
(1575, 'Chamundi Betta', 17),
(1576, 'Channagiri', 17),
(1577, 'Channapatna', 17),
(1578, 'Channarayapatna', 17),
(1579, 'Chickballapur', 17),
(1580, 'Chik Ballapur', 17),
(1581, 'Chikkaballapur', 17),
(1582, 'Chikmagalur', 17),
(1583, 'Chiknayakanhalli', 17),
(1584, 'Chikodi', 17),
(1585, 'Chincholi', 17),
(1586, 'Chintamani', 17),
(1587, 'Chitaguppa', 17),
(1588, 'Chitapur', 17),
(1589, 'Chitradurga', 17),
(1590, 'Coorg', 17),
(1591, 'Dandeli', 17),
(1592, 'Dargajogihalli', 17),
(1593, 'Dasarahalli', 17),
(1594, 'Davangere', 17),
(1595, 'Devadurga', 17),
(1596, 'Devagiri', 17),
(1597, 'Devanhalli', 17),
(1598, 'Dharwar', 17),
(1599, 'Dhupdal', 17),
(1600, 'Dod Ballapur', 17),
(1601, 'Donimalai', 17),
(1602, 'Gadag', 17),
(1603, 'Gajendragarh', 17),
(1604, 'Ganeshgudi', 17),
(1605, 'Gangawati', 17),
(1606, 'Gangoli', 17),
(1607, 'Gauribidanur', 17),
(1608, 'Gokak', 17),
(1609, 'Gokak Falls', 17),
(1610, 'Gonikoppal', 17),
(1611, 'Gorur', 17),
(1612, 'Gottikere', 17),
(1613, 'Gubbi', 17),
(1614, 'Gudibanda', 17),
(1615, 'Gulbarga', 17),
(1616, 'Guledgudda', 17),
(1617, 'Gundlupet', 17),
(1618, 'Gurmatkal', 17),
(1619, 'Haliyal', 17),
(1620, 'Hangal', 17),
(1621, 'Harihar', 17),
(1622, 'Harpanahalli', 17),
(1623, 'Hassan', 17),
(1624, 'Hatti', 17),
(1625, 'Hatti Gold Mines', 17),
(1626, 'Haveri', 17),
(1627, 'Hebbagodi', 17),
(1628, 'Hebbalu', 17),
(1629, 'Hebri', 17),
(1630, 'Heggadadevanakote', 17),
(1631, 'Herohalli', 17),
(1632, 'Hidkal', 17),
(1633, 'Hindalgi', 17),
(1634, 'Hirekerur', 17),
(1635, 'Hiriyur', 17),
(1636, 'Holalkere', 17),
(1637, 'Hole Narsipur', 17),
(1638, 'Homnabad', 17),
(1639, 'Honavar', 17),
(1640, 'Honnali', 17),
(1641, 'Hosakote', 17),
(1642, 'Hosanagara', 17),
(1643, 'Hosangadi', 17),
(1644, 'Hosdurga', 17),
(1645, 'Hoskote', 17),
(1646, 'Hospet', 17),
(1647, 'Hubli', 17),
(1648, 'Hukeri', 17),
(1649, 'Hunasagi', 17),
(1650, 'Hunasamaranahalli', 17),
(1651, 'Hungund', 17),
(1652, 'Hunsur', 17),
(1653, 'Huvina Hadagalli', 17),
(1654, 'Ilkal', 17),
(1655, 'Indi', 17),
(1656, 'Jagalur', 17),
(1657, 'Jamkhandi', 17),
(1658, 'Jevargi', 17),
(1659, 'Jog Falls', 17),
(1660, 'Kabini Colony', 17),
(1661, 'Kadur', 17),
(1662, 'Kalghatgi', 17),
(1663, 'Kamalapuram', 17),
(1664, 'Kampli', 17),
(1665, 'Kanakapura', 17),
(1666, 'Kangrali BK', 17),
(1667, 'Kangrali KH', 17),
(1668, 'Kannur', 17),
(1669, 'Karkala', 17),
(1670, 'Karwar', 17),
(1671, 'Kemminja', 17),
(1672, 'Kengeri', 17),
(1673, 'Kerur', 17),
(1674, 'Khanapur', 17),
(1675, 'Kodigenahalli', 17),
(1676, 'Kodiyal', 17),
(1677, 'Kodlipet', 17),
(1678, 'Kolar', 17),
(1679, 'Kollegal', 17),
(1680, 'Konanakunte', 17),
(1681, 'Konanur', 17),
(1682, 'Konnur', 17),
(1683, 'Koppa', 17),
(1684, 'Koppal', 17),
(1685, 'Koratagere', 17),
(1686, 'Kotekara', 17),
(1687, 'Kothnur', 17),
(1688, 'Kotturu', 17),
(1689, 'Krishnapura', 17),
(1690, 'Krishnarajanagar', 17),
(1691, 'Krishnarajapura', 17),
(1692, 'Krishnarajasagara', 17),
(1693, 'Krishnarajpet', 17),
(1694, 'Kudchi', 17),
(1695, 'Kudligi', 17),
(1696, 'Kudremukh', 17),
(1697, 'Kumsi', 17),
(1698, 'Kumta', 17),
(1699, 'Kundapura', 17),
(1700, 'Kundgol', 17),
(1701, 'Kunigal', 17),
(1702, 'Kurgunta', 17),
(1703, 'Kushalnagar', 17),
(1704, 'Kushtagi', 17),
(1705, 'Kyathanahalli', 17),
(1706, 'Lakshmeshwar', 17),
(1707, 'Lingsugur', 17),
(1708, 'Londa', 17),
(1709, 'Maddur', 17),
(1710, 'Madhugiri', 17),
(1711, 'Madikeri', 17),
(1712, 'Magadi', 17),
(1713, 'Magod Falls', 17),
(1714, 'Mahadeswara Hills', 17),
(1715, 'Mahadevapura', 17),
(1716, 'Mahalingpur', 17),
(1717, 'Maisuru', 17),
(1718, 'Maisuru Cantonment', 17),
(1719, 'Malavalli', 17),
(1720, 'Mallar', 17),
(1721, 'Malpe', 17),
(1722, 'Malur', 17),
(1723, 'Manchenahalli', 17),
(1724, 'Mandya', 17),
(1725, 'Mangalore', 17),
(1726, 'Mangaluru', 17),
(1727, 'Manipal', 17),
(1728, 'Manvi', 17),
(1729, 'Maski', 17),
(1730, 'Mastikatte Colony', 17),
(1731, 'Mayakonda', 17),
(1732, 'Melukote', 17),
(1733, 'Molakalmuru', 17),
(1734, 'Mudalgi', 17),
(1735, 'Mudbidri', 17),
(1736, 'Muddebihal', 17),
(1737, 'Mudgal', 17),
(1738, 'Mudhol', 17),
(1739, 'Mudigere', 17),
(1740, 'Mudushedde', 17),
(1741, 'Mulbagal', 17),
(1742, 'Mulgund', 17),
(1743, 'Mulki', 17),
(1744, 'Mulur', 17),
(1745, 'Mundargi', 17),
(1746, 'Mundgod', 17),
(1747, 'Munirabad', 17),
(1748, 'Munnur', 17),
(1749, 'Murudeshwara', 17),
(1750, 'Mysore', 17),
(1751, 'Nagamangala', 17),
(1752, 'Nanjangud', 17),
(1753, 'Naragund', 17),
(1754, 'Narasimharajapura', 17),
(1755, 'Naravi', 17),
(1756, 'Narayanpur', 17),
(1757, 'Naregal', 17),
(1758, 'Navalgund', 17),
(1759, 'Nelmangala', 17),
(1760, 'Nipani', 17),
(1761, 'Nitte', 17),
(1762, 'Nyamati', 17),
(1763, 'Padu', 17),
(1764, 'Pandavapura', 17),
(1765, 'Pattanagere', 17),
(1766, 'Pavagada', 17),
(1767, 'Piriyapatna', 17),
(1768, 'Ponnampet', 17),
(1769, 'Puttur', 17),
(1770, 'Rabkavi', 17),
(1771, 'Raichur', 17),
(1772, 'Ramanagaram', 17),
(1773, 'Ramdurg', 17),
(1774, 'Ranibennur', 17),
(1775, 'Raybag', 17),
(1776, 'Robertsonpet', 17),
(1777, 'Ron', 17),
(1778, 'Sadalgi', 17),
(1779, 'Sagar', 17),
(1780, 'Sakleshpur', 17),
(1781, 'Saligram', 17),
(1782, 'Sandur', 17),
(1783, 'Sanivarsante', 17),
(1784, 'Sankeshwar', 17),
(1785, 'Sargur', 17),
(1786, 'Sathyamangala', 17),
(1787, 'Saundatti Yellamma', 17),
(1788, 'Savanur', 17),
(1789, 'Sedam', 17),
(1790, 'Shahabad', 17),
(1791, 'Shahabad A.C.C.', 17),
(1792, 'Shahapur', 17),
(1793, 'Shahpur', 17),
(1794, 'Shaktinagar', 17),
(1795, 'Shiggaon', 17),
(1796, 'Shikarpur', 17),
(1797, 'Shimoga', 17),
(1798, 'Shirhatti', 17),
(1799, 'Shorapur', 17),
(1800, 'Shravanabelagola', 17),
(1801, 'Shrirangapattana', 17),
(1802, 'Siddapur', 17),
(1803, 'Sidlaghatta', 17),
(1804, 'Sindgi', 17),
(1805, 'Sindhnur', 17),
(1806, 'Sira', 17),
(1807, 'Sirakoppa', 17),
(1808, 'Sirsi', 17),
(1809, 'Siruguppa', 17),
(1810, 'Someshwar', 17),
(1811, 'Somvarpet', 17),
(1812, 'Sorab', 17),
(1813, 'Sringeri', 17),
(1814, 'Srinivaspur', 17),
(1815, 'Sulya', 17),
(1816, 'Suntikopa', 17),
(1817, 'Talikota', 17),
(1818, 'Tarikera', 17),
(1819, 'Tekkalakota', 17),
(1820, 'Terdal', 17),
(1821, 'Thokur', 17),
(1822, 'Thumbe', 17),
(1823, 'Tiptur', 17),
(1824, 'Tirthahalli', 17),
(1825, 'Tirumakudal Narsipur', 17),
(1826, 'Tonse', 17),
(1827, 'Tumkur', 17),
(1828, 'Turuvekere', 17),
(1829, 'Udupi', 17),
(1830, 'Ullal', 17),
(1831, 'Uttarahalli', 17),
(1832, 'Venkatapura', 17),
(1833, 'Vijayapura', 17),
(1834, 'Virarajendrapet', 17),
(1835, 'Wadi', 17),
(1836, 'Wadi A.C.C.', 17),
(1837, 'Yadgir', 17),
(1838, 'Yelahanka', 17),
(1839, 'Yelandur', 17),
(1840, 'Yelbarga', 17),
(1841, 'Yellapur', 17),
(1842, 'Yenagudde', 17),
(1843, 'Adimaly', 19),
(1844, 'Adoor', 19),
(1845, 'Adur', 19),
(1846, 'Akathiyur', 19),
(1847, 'Alangad', 19),
(1848, 'Alappuzha', 19),
(1849, 'Aluva', 19),
(1850, 'Ancharakandy', 19),
(1851, 'Angamaly', 19),
(1852, 'Aroor', 19),
(1853, 'Arukutti', 19),
(1854, 'Attingal', 19),
(1855, 'Avinissery', 19),
(1856, 'Azhikode North', 19),
(1857, 'Azhikode South', 19),
(1858, 'Azhiyur', 19),
(1859, 'Balussery', 19),
(1860, 'Bangramanjeshwar', 19),
(1861, 'Beypur', 19),
(1862, 'Brahmakulam', 19),
(1863, 'Chala', 19),
(1864, 'Chalakudi', 19),
(1865, 'Changanacheri', 19),
(1866, 'Chauwara', 19),
(1867, 'Chavakkad', 19),
(1868, 'Chelakkara', 19),
(1869, 'Chelora', 19),
(1870, 'Chendamangalam', 19),
(1871, 'Chengamanad', 19),
(1872, 'Chengannur', 19),
(1873, 'Cheranallur', 19),
(1874, 'Cheriyakadavu', 19),
(1875, 'Cherthala', 19),
(1876, 'Cherukunnu', 19),
(1877, 'Cheruthazham', 19),
(1878, 'Cheruvannur', 19),
(1879, 'Cheruvattur', 19),
(1880, 'Chevvur', 19),
(1881, 'Chirakkal', 19),
(1882, 'Chittur', 19),
(1883, 'Chockli', 19),
(1884, 'Churnikkara', 19),
(1885, 'Dharmadam', 19),
(1886, 'Edappal', 19),
(1887, 'Edathala', 19),
(1888, 'Elayavur', 19),
(1889, 'Elur', 19),
(1890, 'Eranholi', 19),
(1891, 'Erattupetta', 19),
(1892, 'Ernakulam', 19),
(1893, 'Eruvatti', 19),
(1894, 'Ettumanoor', 19),
(1895, 'Feroke', 19),
(1896, 'Guruvayur', 19),
(1897, 'Haripad', 19),
(1898, 'Hosabettu', 19),
(1899, 'Idukki', 19),
(1900, 'Iringaprom', 19),
(1901, 'Irinjalakuda', 19),
(1902, 'Iriveri', 19),
(1903, 'Kadachira', 19),
(1904, 'Kadalundi', 19),
(1905, 'Kadamakkudy', 19),
(1906, 'Kadirur', 19),
(1907, 'Kadungallur', 19),
(1908, 'Kakkodi', 19),
(1909, 'Kalady', 19),
(1910, 'Kalamassery', 19),
(1911, 'Kalliasseri', 19),
(1912, 'Kalpetta', 19),
(1913, 'Kanhangad', 19),
(1914, 'Kanhirode', 19),
(1915, 'Kanjikkuzhi', 19),
(1916, 'Kanjikode', 19),
(1917, 'Kanjirappalli', 19),
(1918, 'Kannadiparamba', 19),
(1919, 'Kannangad', 19),
(1920, 'Kannapuram', 19),
(1921, 'Kannur', 19),
(1922, 'Kannur Cantonment', 19),
(1923, 'Karunagappally', 19),
(1924, 'Karuvamyhuruthy', 19),
(1925, 'Kasaragod', 19),
(1926, 'Kasargod', 19),
(1927, 'Kattappana', 19),
(1928, 'Kayamkulam', 19),
(1929, 'Kedamangalam', 19),
(1930, 'Kochi', 19),
(1931, 'Kodamthuruthu', 19),
(1932, 'Kodungallur', 19),
(1933, 'Koduvally', 19),
(1934, 'Koduvayur', 19),
(1935, 'Kokkothamangalam', 19),
(1936, 'Kolazhy', 19),
(1937, 'Kollam', 19),
(1938, 'Komalapuram', 19),
(1939, 'Koothattukulam', 19),
(1940, 'Koratty', 19),
(1941, 'Kothamangalam', 19),
(1942, 'Kottarakkara', 19),
(1943, 'Kottayam', 19),
(1944, 'Kottayam Malabar', 19),
(1945, 'Kottuvally', 19),
(1946, 'Koyilandi', 19),
(1947, 'Kozhikode', 19),
(1948, 'Kudappanakunnu', 19),
(1949, 'Kudlu', 19),
(1950, 'Kumarakom', 19),
(1951, 'Kumily', 19),
(1952, 'Kunnamangalam', 19),
(1953, 'Kunnamkulam', 19),
(1954, 'Kurikkad', 19),
(1955, 'Kurkkanchery', 19),
(1956, 'Kuthuparamba', 19),
(1957, 'Kuttakulam', 19),
(1958, 'Kuttikkattur', 19),
(1959, 'Kuttur', 19),
(1960, 'Malappuram', 19),
(1961, 'Mallappally', 19),
(1962, 'Manjeri', 19),
(1963, 'Manjeshwar', 19),
(1964, 'Mannancherry', 19),
(1965, 'Mannar', 19),
(1966, 'Mannarakkat', 19),
(1967, 'Maradu', 19),
(1968, 'Marathakkara', 19),
(1969, 'Marutharod', 19),
(1970, 'Mattannur', 19),
(1971, 'Mavelikara', 19),
(1972, 'Mavilayi', 19),
(1973, 'Mavur', 19),
(1974, 'Methala', 19),
(1975, 'Muhamma', 19),
(1976, 'Mulavukad', 19),
(1977, 'Mundakayam', 19),
(1978, 'Munderi', 19),
(1979, 'Munnar', 19),
(1980, 'Muthakunnam', 19),
(1981, 'Muvattupuzha', 19),
(1982, 'Muzhappilangad', 19),
(1983, 'Nadapuram', 19),
(1984, 'Nadathara', 19),
(1985, 'Narath', 19),
(1986, 'Nattakam', 19),
(1987, 'Nedumangad', 19),
(1988, 'Nenmenikkara', 19),
(1989, 'New Mahe', 19),
(1990, 'Neyyattinkara', 19),
(1991, 'Nileshwar', 19),
(1992, 'Olavanna', 19),
(1993, 'Ottapalam', 19),
(1994, 'Ottappalam', 19),
(1995, 'Paduvilayi', 19),
(1996, 'Palai', 19),
(1997, 'Palakkad', 19),
(1998, 'Palayad', 19),
(1999, 'Palissery', 19),
(2000, 'Pallikkunnu', 19),
(2001, 'Paluvai', 19),
(2002, 'Panniyannur', 19),
(2003, 'Pantalam', 19),
(2004, 'Panthiramkavu', 19),
(2005, 'Panur', 19),
(2006, 'Pappinisseri', 19),
(2007, 'Parassala', 19),
(2008, 'Paravur', 19),
(2009, 'Pathanamthitta', 19),
(2010, 'Pathanapuram', 19),
(2011, 'Pathiriyad', 19),
(2012, 'Pattambi', 19),
(2013, 'Pattiom', 19),
(2014, 'Pavaratty', 19),
(2015, 'Payyannur', 19),
(2016, 'Peermade', 19),
(2017, 'Perakam', 19),
(2018, 'Peralasseri', 19),
(2019, 'Peringathur', 19),
(2020, 'Perinthalmanna', 19),
(2021, 'Perole', 19),
(2022, 'Perumanna', 19),
(2023, 'Perumbaikadu', 19),
(2024, 'Perumbavoor', 19),
(2025, 'Pinarayi', 19),
(2026, 'Piravam', 19),
(2027, 'Ponnani', 19),
(2028, 'Pottore', 19),
(2029, 'Pudukad', 19),
(2030, 'Punalur', 19),
(2031, 'Puranattukara', 19),
(2032, 'Puthunagaram', 19),
(2033, 'Puthuppariyaram', 19),
(2034, 'Puzhathi', 19),
(2035, 'Ramanattukara', 19),
(2036, 'Shoranur', 19),
(2037, 'Sultans Battery', 19),
(2038, 'Sulthan Bathery', 19),
(2039, 'Talipparamba', 19),
(2040, 'Thaikkad', 19),
(2041, 'Thalassery', 19),
(2042, 'Thannirmukkam', 19),
(2043, 'Theyyalingal', 19),
(2044, 'Thiruvalla', 19),
(2045, 'Thiruvananthapuram', 19),
(2046, 'Thiruvankulam', 19),
(2047, 'Thodupuzha', 19),
(2048, 'Thottada', 19),
(2049, 'Thrippunithura', 19),
(2050, 'Thrissur', 19),
(2051, 'Tirur', 19),
(2052, 'Udma', 19),
(2053, 'Vadakara', 19),
(2054, 'Vaikam', 19),
(2055, 'Valapattam', 19),
(2056, 'Vallachira', 19),
(2057, 'Varam', 19),
(2058, 'Varappuzha', 19),
(2059, 'Varkala', 19),
(2060, 'Vayalar', 19),
(2061, 'Vazhakkala', 19),
(2062, 'Venmanad', 19),
(2063, 'Villiappally', 19),
(2064, 'Wayanad', 19),
(2065, 'Agethi', 20),
(2066, 'Amini', 20),
(2067, 'Androth Island', 20),
(2068, 'Kavaratti', 20),
(2069, 'Minicoy', 20),
(2070, 'Agar', 21),
(2071, 'Ajaigarh', 21),
(2072, 'Akoda', 21),
(2073, 'Akodia', 21),
(2074, 'Alampur', 21),
(2075, 'Alirajpur', 21),
(2076, 'Alot', 21),
(2077, 'Amanganj', 21),
(2078, 'Amarkantak', 21),
(2079, 'Amarpatan', 21),
(2080, 'Amarwara', 21),
(2081, 'Ambada', 21),
(2082, 'Ambah', 21),
(2083, 'Amla', 21),
(2084, 'Amlai', 21),
(2085, 'Anjad', 21),
(2086, 'Antri', 21),
(2087, 'Anuppur', 21),
(2088, 'Aron', 21),
(2089, 'Ashoknagar', 21),
(2090, 'Ashta', 21),
(2091, 'Babai', 21),
(2092, 'Bada Malhera', 21),
(2093, 'Badagaon', 21),
(2094, 'Badagoan', 21),
(2095, 'Badarwas', 21),
(2096, 'Badawada', 21),
(2097, 'Badi', 21),
(2098, 'Badkuhi', 21),
(2099, 'Badnagar', 21),
(2100, 'Badnawar', 21),
(2101, 'Badod', 21),
(2102, 'Badoda', 21),
(2103, 'Badra', 21),
(2104, 'Bagh', 21),
(2105, 'Bagli', 21),
(2106, 'Baihar', 21),
(2107, 'Baikunthpur', 21),
(2108, 'Bakswaha', 21),
(2109, 'Balaghat', 21),
(2110, 'Baldeogarh', 21),
(2111, 'Bamaniya', 21),
(2112, 'Bamhani', 21),
(2113, 'Bamor', 21),
(2114, 'Bamora', 21),
(2115, 'Banda', 21),
(2116, 'Bangawan', 21),
(2117, 'Bansatar Kheda', 21),
(2118, 'Baraily', 21),
(2119, 'Barela', 21),
(2120, 'Barghat', 21),
(2121, 'Bargi', 21),
(2122, 'Barhi', 21),
(2123, 'Barigarh', 21),
(2124, 'Barwaha', 21),
(2125, 'Barwani', 21),
(2126, 'Basoda', 21),
(2127, 'Begamganj', 21),
(2128, 'Beohari', 21),
(2129, 'Berasia', 21),
(2130, 'Betma', 21),
(2131, 'Betul', 21),
(2132, 'Betul Bazar', 21),
(2133, 'Bhainsdehi', 21),
(2134, 'Bhamodi', 21),
(2135, 'Bhander', 21),
(2136, 'Bhanpura', 21),
(2137, 'Bharveli', 21),
(2138, 'Bhaurasa', 21),
(2139, 'Bhavra', 21),
(2140, 'Bhedaghat', 21),
(2141, 'Bhikangaon', 21),
(2142, 'Bhilakhedi', 21),
(2143, 'Bhind', 21),
(2144, 'Bhitarwar', 21),
(2145, 'Bhopal', 21),
(2146, 'Bhuibandh', 21),
(2147, 'Biaora', 21),
(2148, 'Bijawar', 21),
(2149, 'Bijeypur', 21),
(2150, 'Bijrauni', 21),
(2151, 'Bijuri', 21),
(2152, 'Bilaua', 21),
(2153, 'Bilpura', 21),
(2154, 'Bina Railway Colony', 21),
(2155, 'Bina-Etawa', 21),
(2156, 'Birsinghpur', 21),
(2157, 'Boda', 21),
(2158, 'Budhni', 21),
(2159, 'Burhanpur', 21),
(2160, 'Burhar', 21),
(2161, 'Chachaura Binaganj', 21),
(2162, 'Chakghat', 21),
(2163, 'Chandameta Butar', 21),
(2164, 'Chanderi', 21),
(2165, 'Chandia', 21),
(2166, 'Chandla', 21),
(2167, 'Chaurai Khas', 21),
(2168, 'Chhatarpur', 21),
(2169, 'Chhindwara', 21),
(2170, 'Chhota Chhindwara', 21),
(2171, 'Chichli', 21),
(2172, 'Chitrakut', 21),
(2173, 'Churhat', 21),
(2174, 'Daboh', 21),
(2175, 'Dabra', 21),
(2176, 'Damoh', 21),
(2177, 'Damua', 21),
(2178, 'Datia', 21),
(2179, 'Deodara', 21),
(2180, 'Deori', 21),
(2181, 'Deori Khas', 21),
(2182, 'Depalpur', 21),
(2183, 'Devendranagar', 21),
(2184, 'Devhara', 21),
(2185, 'Dewas', 21),
(2186, 'Dhamnod', 21),
(2187, 'Dhana', 21),
(2188, 'Dhanpuri', 21),
(2189, 'Dhar', 21),
(2190, 'Dharampuri', 21),
(2191, 'Dighawani', 21),
(2192, 'Diken', 21),
(2193, 'Dindori', 21),
(2194, 'Dola', 21),
(2195, 'Dumar Kachhar', 21),
(2196, 'Dungariya Chhapara', 21),
(2197, 'Gadarwara', 21),
(2198, 'Gairatganj', 21),
(2199, 'Gandhi Sagar Hydel Colony', 21),
(2200, 'Ganjbasoda', 21),
(2201, 'Garhakota', 21),
(2202, 'Garhi Malhara', 21),
(2203, 'Garoth', 21),
(2204, 'Gautapura', 21),
(2205, 'Ghansor', 21),
(2206, 'Ghuwara', 21),
(2207, 'Gogaon', 21),
(2208, 'Gogapur', 21),
(2209, 'Gohad', 21),
(2210, 'Gormi', 21),
(2211, 'Govindgarh', 21),
(2212, 'Guna', 21),
(2213, 'Gurh', 21),
(2214, 'Gwalior', 21),
(2215, 'Hanumana', 21),
(2216, 'Harda', 21),
(2217, 'Harpalpur', 21),
(2218, 'Harrai', 21),
(2219, 'Harsud', 21),
(2220, 'Hatod', 21),
(2221, 'Hatpipalya', 21),
(2222, 'Hatta', 21),
(2223, 'Hindoria', 21),
(2224, 'Hirapur', 21),
(2225, 'Hoshangabad', 21),
(2226, 'Ichhawar', 21),
(2227, 'Iklehra', 21),
(2228, 'Indergarh', 21),
(2229, 'Indore', 21),
(2230, 'Isagarh', 21),
(2231, 'Itarsi', 21),
(2232, 'Jabalpur', 21),
(2233, 'Jabalpur Cantonment', 21),
(2234, 'Jabalpur G.C.F', 21),
(2235, 'Jaisinghnagar', 21),
(2236, 'Jaithari', 21),
(2237, 'Jaitwara', 21),
(2238, 'Jamai', 21),
(2239, 'Jaora', 21),
(2240, 'Jatachhapar', 21),
(2241, 'Jatara', 21),
(2242, 'Jawad', 21),
(2243, 'Jawar', 21),
(2244, 'Jeronkhalsa', 21),
(2245, 'Jhabua', 21),
(2246, 'Jhundpura', 21),
(2247, 'Jiran', 21),
(2248, 'Jirapur', 21),
(2249, 'Jobat', 21),
(2250, 'Joura', 21),
(2251, 'Kailaras', 21),
(2252, 'Kaimur', 21),
(2253, 'Kakarhati', 21),
(2254, 'Kalichhapar', 21),
(2255, 'Kanad', 21),
(2256, 'Kannod', 21),
(2257, 'Kantaphod', 21),
(2258, 'Kareli', 21),
(2259, 'Karera', 21),
(2260, 'Kari', 21),
(2261, 'Karnawad', 21),
(2262, 'Karrapur', 21),
(2263, 'Kasrawad', 21),
(2264, 'Katangi', 21),
(2265, 'Katni', 21),
(2266, 'Kelhauri', 21),
(2267, 'Khachrod', 21),
(2268, 'Khajuraho', 21),
(2269, 'Khamaria', 21),
(2270, 'Khand', 21),
(2271, 'Khandwa', 21),
(2272, 'Khaniyadhana', 21),
(2273, 'Khargapur', 21),
(2274, 'Khargone', 21),
(2275, 'Khategaon', 21),
(2276, 'Khetia', 21),
(2277, 'Khilchipur', 21),
(2278, 'Khirkiya', 21),
(2279, 'Khujner', 21),
(2280, 'Khurai', 21),
(2281, 'Kolaras', 21),
(2282, 'Kotar', 21),
(2283, 'Kothi', 21),
(2284, 'Kotma', 21),
(2285, 'Kukshi', 21),
(2286, 'Kumbhraj', 21),
(2287, 'Kurwai', 21),
(2288, 'Lahar', 21),
(2289, 'Lakhnadon', 21),
(2290, 'Lateri', 21),
(2291, 'Laundi', 21),
(2292, 'Lidhora Khas', 21),
(2293, 'Lodhikheda', 21),
(2294, 'Loharda', 21),
(2295, 'Machalpur', 21),
(2296, 'Madhogarh', 21),
(2297, 'Maharajpur', 21),
(2298, 'Maheshwar', 21),
(2299, 'Mahidpur', 21),
(2300, 'Maihar', 21),
(2301, 'Majholi', 21),
(2302, 'Makronia', 21),
(2303, 'Maksi', 21),
(2304, 'Malaj Khand', 21),
(2305, 'Malanpur', 21),
(2306, 'Malhargarh', 21),
(2307, 'Manasa', 21),
(2308, 'Manawar', 21),
(2309, 'Mandav', 21),
(2310, 'Mandideep', 21),
(2311, 'Mandla', 21),
(2312, 'Mandleshwar', 21),
(2313, 'Mandsaur', 21),
(2314, 'Manegaon', 21),
(2315, 'Mangawan', 21),
(2316, 'Manglaya Sadak', 21),
(2317, 'Manpur', 21),
(2318, 'Mau', 21),
(2319, 'Mauganj', 21),
(2320, 'Meghnagar', 21),
(2321, 'Mehara Gaon', 21);
INSERT INTO `billing_city` (`CityID`, `City_Name`, `StateID`) VALUES
(2322, 'Mehgaon', 21),
(2323, 'Mhaugaon', 21),
(2324, 'Mhow', 21),
(2325, 'Mihona', 21),
(2326, 'Mohgaon', 21),
(2327, 'Morar', 21),
(2328, 'Morena', 21),
(2329, 'Morwa', 21),
(2330, 'Multai', 21),
(2331, 'Mundi', 21),
(2332, 'Mungaoli', 21),
(2333, 'Murwara', 21),
(2334, 'Nagda', 21),
(2335, 'Nagod', 21),
(2336, 'Nagri', 21),
(2337, 'Naigarhi', 21),
(2338, 'Nainpur', 21),
(2339, 'Nalkheda', 21),
(2340, 'Namli', 21),
(2341, 'Narayangarh', 21),
(2342, 'Narsimhapur', 21),
(2343, 'Narsingarh', 21),
(2344, 'Narsinghpur', 21),
(2345, 'Narwar', 21),
(2346, 'Nasrullaganj', 21),
(2347, 'Naudhia', 21),
(2348, 'Naugaon', 21),
(2349, 'Naurozabad', 21),
(2350, 'Neemuch', 21),
(2351, 'Nepa Nagar', 21),
(2352, 'Neuton Chikhli Kalan', 21),
(2353, 'Nimach', 21),
(2354, 'Niwari', 21),
(2355, 'Obedullaganj', 21),
(2356, 'Omkareshwar', 21),
(2357, 'Orachha', 21),
(2358, 'Ordinance Factory Itarsi', 21),
(2359, 'Pachmarhi', 21),
(2360, 'Pachmarhi Cantonment', 21),
(2361, 'Pachore', 21),
(2362, 'Palchorai', 21),
(2363, 'Palda', 21),
(2364, 'Palera', 21),
(2365, 'Pali', 21),
(2366, 'Panagar', 21),
(2367, 'Panara', 21),
(2368, 'Pandaria', 21),
(2369, 'Pandhana', 21),
(2370, 'Pandhurna', 21),
(2371, 'Panna', 21),
(2372, 'Pansemal', 21),
(2373, 'Parasia', 21),
(2374, 'Pasan', 21),
(2375, 'Patan', 21),
(2376, 'Patharia', 21),
(2377, 'Pawai', 21),
(2378, 'Petlawad', 21),
(2379, 'Phuph Kalan', 21),
(2380, 'Pichhore', 21),
(2381, 'Pipariya', 21),
(2382, 'Pipliya Mandi', 21),
(2383, 'Piploda', 21),
(2384, 'Pithampur', 21),
(2385, 'Polay Kalan', 21),
(2386, 'Porsa', 21),
(2387, 'Prithvipur', 21),
(2388, 'Raghogarh', 21),
(2389, 'Rahatgarh', 21),
(2390, 'Raisen', 21),
(2391, 'Rajakhedi', 21),
(2392, 'Rajgarh', 21),
(2393, 'Rajnagar', 21),
(2394, 'Rajpur', 21),
(2395, 'Rampur Baghelan', 21),
(2396, 'Rampur Naikin', 21),
(2397, 'Rampura', 21),
(2398, 'Ranapur', 21),
(2399, 'Ranipura', 21),
(2400, 'Ratangarh', 21),
(2401, 'Ratlam', 21),
(2402, 'Ratlam Kasba', 21),
(2403, 'Rau', 21),
(2404, 'Rehli', 21),
(2405, 'Rehti', 21),
(2406, 'Rewa', 21),
(2407, 'Sabalgarh', 21),
(2408, 'Sagar', 21),
(2409, 'Sagar Cantonment', 21),
(2410, 'Sailana', 21),
(2411, 'Sanawad', 21),
(2412, 'Sanchi', 21),
(2413, 'Sanwer', 21),
(2414, 'Sarangpur', 21),
(2415, 'Sardarpur', 21),
(2416, 'Sarni', 21),
(2417, 'Satai', 21),
(2418, 'Satna', 21),
(2419, 'Satwas', 21),
(2420, 'Sausar', 21),
(2421, 'Sehore', 21),
(2422, 'Semaria', 21),
(2423, 'Sendhwa', 21),
(2424, 'Seondha', 21),
(2425, 'Seoni', 21),
(2426, 'Seoni Malwa', 21),
(2427, 'Sethia', 21),
(2428, 'Shahdol', 21),
(2429, 'Shahgarh', 21),
(2430, 'Shahpur', 21),
(2431, 'Shahpura', 21),
(2432, 'Shajapur', 21),
(2433, 'Shamgarh', 21),
(2434, 'Sheopur', 21),
(2435, 'Shivpuri', 21),
(2436, 'Shujalpur', 21),
(2437, 'Sidhi', 21),
(2438, 'Sihora', 21),
(2439, 'Singolo', 21),
(2440, 'Singrauli', 21),
(2441, 'Sinhasa', 21),
(2442, 'Sirgora', 21),
(2443, 'Sirmaur', 21),
(2444, 'Sironj', 21),
(2445, 'Sitamau', 21),
(2446, 'Sohagpur', 21),
(2447, 'Sonkatch', 21),
(2448, 'Soyatkalan', 21),
(2449, 'Suhagi', 21),
(2450, 'Sultanpur', 21),
(2451, 'Susner', 21),
(2452, 'Suthaliya', 21),
(2453, 'Tal', 21),
(2454, 'Talen', 21),
(2455, 'Tarana', 21),
(2456, 'Taricharkalan', 21),
(2457, 'Tekanpur', 21),
(2458, 'Tendukheda', 21),
(2459, 'Teonthar', 21),
(2460, 'Thandia', 21),
(2461, 'Tikamgarh', 21),
(2462, 'Timarni', 21),
(2463, 'Tirodi', 21),
(2464, 'Udaipura', 21),
(2465, 'Ujjain', 21),
(2466, 'Ukwa', 21),
(2467, 'Umaria', 21),
(2468, 'Unchahara', 21),
(2469, 'Unhel', 21),
(2470, 'Vehicle Factory Jabalpur', 21),
(2471, 'Vidisha', 21),
(2472, 'Vijayraghavgarh', 21),
(2473, 'Waraseoni', 21),
(2474, 'Achalpur', 22),
(2475, 'Aheri', 22),
(2476, 'Ahmadnagar Cantonment', 22),
(2477, 'Ahmadpur', 22),
(2478, 'Ahmednagar', 22),
(2479, 'Ajra', 22),
(2480, 'Akalkot', 22),
(2481, 'Akkalkuwa', 22),
(2482, 'Akola', 22),
(2483, 'Akot', 22),
(2484, 'Alandi', 22),
(2485, 'Alibag', 22),
(2486, 'Allapalli', 22),
(2487, 'Alore', 22),
(2488, 'Amalner', 22),
(2489, 'Ambad', 22),
(2490, 'Ambajogai', 22),
(2491, 'Ambernath', 22),
(2492, 'Ambivali Tarf Wankhal', 22),
(2493, 'Amgaon', 22),
(2494, 'Amravati', 22),
(2495, 'Anjangaon', 22),
(2496, 'Arvi', 22),
(2497, 'Ashta', 22),
(2498, 'Ashti', 22),
(2499, 'Aurangabad', 22),
(2500, 'Aurangabad Cantonment', 22),
(2501, 'Ausa', 22),
(2502, 'Babhulgaon', 22),
(2503, 'Badlapur', 22),
(2504, 'Balapur', 22),
(2505, 'Ballarpur', 22),
(2506, 'Baramati', 22),
(2507, 'Barshi', 22),
(2508, 'Basmat', 22),
(2509, 'Beed', 22),
(2510, 'Bhadravati', 22),
(2511, 'Bhagur', 22),
(2512, 'Bhandara', 22),
(2513, 'Bhigvan', 22),
(2514, 'Bhingar', 22),
(2515, 'Bhiwandi', 22),
(2516, 'Bhokhardan', 22),
(2517, 'Bhor', 22),
(2518, 'Bhosari', 22),
(2519, 'Bhum', 22),
(2520, 'Bhusawal', 22),
(2521, 'Bid', 22),
(2522, 'Biloli', 22),
(2523, 'Birwadi', 22),
(2524, 'Boisar', 22),
(2525, 'Bop Khel', 22),
(2526, 'Brahmapuri', 22),
(2527, 'Budhgaon', 22),
(2528, 'Buldana', 22),
(2529, 'Buldhana', 22),
(2530, 'Butibori', 22),
(2531, 'Chakan', 22),
(2532, 'Chalisgaon', 22),
(2533, 'Chandrapur', 22),
(2534, 'Chandur', 22),
(2535, 'Chandur Bazar', 22),
(2536, 'Chandvad', 22),
(2537, 'Chicholi', 22),
(2538, 'Chikhala', 22),
(2539, 'Chikhaldara', 22),
(2540, 'Chikhli', 22),
(2541, 'Chinchani', 22),
(2542, 'Chinchwad', 22),
(2543, 'Chiplun', 22),
(2544, 'Chopda', 22),
(2545, 'Dabhol', 22),
(2546, 'Dahance', 22),
(2547, 'Dahanu', 22),
(2548, 'Daharu', 22),
(2549, 'Dapoli Camp', 22),
(2550, 'Darwa', 22),
(2551, 'Daryapur', 22),
(2552, 'Dattapur', 22),
(2553, 'Daund', 22),
(2554, 'Davlameti', 22),
(2555, 'Deglur', 22),
(2556, 'Dehu Road', 22),
(2557, 'Deolali', 22),
(2558, 'Deolali Pravara', 22),
(2559, 'Deoli', 22),
(2560, 'Desaiganj', 22),
(2561, 'Deulgaon Raja', 22),
(2562, 'Dewhadi', 22),
(2563, 'Dharangaon', 22),
(2564, 'Dharmabad', 22),
(2565, 'Dharur', 22),
(2566, 'Dhatau', 22),
(2567, 'Dhule', 22),
(2568, 'Digdoh', 22),
(2569, 'Diglur', 22),
(2570, 'Digras', 22),
(2571, 'Dombivli', 22),
(2572, 'Dondaicha', 22),
(2573, 'Dudhani', 22),
(2574, 'Durgapur', 22),
(2575, 'Dyane', 22),
(2576, 'Edandol', 22),
(2577, 'Eklahare', 22),
(2578, 'Faizpur', 22),
(2579, 'Fekari', 22),
(2580, 'Gadchiroli', 22),
(2581, 'Gadhinghaj', 22),
(2582, 'Gandhi Nagar', 22),
(2583, 'Ganeshpur', 22),
(2584, 'Gangakher', 22),
(2585, 'Gangapur', 22),
(2586, 'Gevrai', 22),
(2587, 'Ghatanji', 22),
(2588, 'Ghoti', 22),
(2589, 'Ghugus', 22),
(2590, 'Ghulewadi', 22),
(2591, 'Godoli', 22),
(2592, 'Gondia', 22),
(2593, 'Guhagar', 22),
(2594, 'Hadgaon', 22),
(2595, 'Harnai Beach', 22),
(2596, 'Hinganghat', 22),
(2597, 'Hingoli', 22),
(2598, 'Hupari', 22),
(2599, 'Ichalkaranji', 22),
(2600, 'Igatpuri', 22),
(2601, 'Indapur', 22),
(2602, 'Jaisinghpur', 22),
(2603, 'Jalgaon', 22),
(2604, 'Jalna', 22),
(2605, 'Jamkhed', 22),
(2606, 'Jawhar', 22),
(2607, 'Jaysingpur', 22),
(2608, 'Jejuri', 22),
(2609, 'Jintur', 22),
(2610, 'Junnar', 22),
(2611, 'Kabnur', 22),
(2612, 'Kagal', 22),
(2613, 'Kalamb', 22),
(2614, 'Kalamnuri', 22),
(2615, 'Kalas', 22),
(2616, 'Kalmeshwar', 22),
(2617, 'Kalundre', 22),
(2618, 'Kalyan', 22),
(2619, 'Kamthi', 22),
(2620, 'Kamthi Cantonment', 22),
(2621, 'Kandari', 22),
(2622, 'Kandhar', 22),
(2623, 'Kandri', 22),
(2624, 'Kandri II', 22),
(2625, 'Kanhan', 22),
(2626, 'Kankavli', 22),
(2627, 'Kannad', 22),
(2628, 'Karad', 22),
(2629, 'Karanja', 22),
(2630, 'Karanje Tarf', 22),
(2631, 'Karivali', 22),
(2632, 'Karjat', 22),
(2633, 'Karmala', 22),
(2634, 'Kasara Budruk', 22),
(2635, 'Katai', 22),
(2636, 'Katkar', 22),
(2637, 'Katol', 22),
(2638, 'Kegaon', 22),
(2639, 'Khadkale', 22),
(2640, 'Khadki', 22),
(2641, 'Khamgaon', 22),
(2642, 'Khapa', 22),
(2643, 'Kharadi', 22),
(2644, 'Kharakvasla', 22),
(2645, 'Khed', 22),
(2646, 'Kherdi', 22),
(2647, 'Khoni', 22),
(2648, 'Khopoli', 22),
(2649, 'Khuldabad', 22),
(2650, 'Kinwat', 22),
(2651, 'Kodoli', 22),
(2652, 'Kolhapur', 22),
(2653, 'Kon', 22),
(2654, 'Kondumal', 22),
(2655, 'Kopargaon', 22),
(2656, 'Kopharad', 22),
(2657, 'Koradi', 22),
(2658, 'Koregaon', 22),
(2659, 'Korochi', 22),
(2660, 'Kudal', 22),
(2661, 'Kundaim', 22),
(2662, 'Kundalwadi', 22),
(2663, 'Kurandvad', 22),
(2664, 'Kurduvadi', 22),
(2665, 'Kusgaon Budruk', 22),
(2666, 'Lanja', 22),
(2667, 'Lasalgaon', 22),
(2668, 'Latur', 22),
(2669, 'Loha', 22),
(2670, 'Lohegaon', 22),
(2671, 'Lonar', 22),
(2672, 'Lonavala', 22),
(2673, 'Madhavnagar', 22),
(2674, 'Mahabaleshwar', 22),
(2675, 'Mahad', 22),
(2676, 'Mahadula', 22),
(2677, 'Maindargi', 22),
(2678, 'Majalgaon', 22),
(2679, 'Malegaon', 22),
(2680, 'Malgaon', 22),
(2681, 'Malkapur', 22),
(2682, 'Malwan', 22),
(2683, 'Manadur', 22),
(2684, 'Manchar', 22),
(2685, 'Mangalvedhe', 22),
(2686, 'Mangrul Pir', 22),
(2687, 'Manmad', 22),
(2688, 'Manor', 22),
(2689, 'Mansar', 22),
(2690, 'Manwath', 22),
(2691, 'Mapuca', 22),
(2692, 'Matheran', 22),
(2693, 'Mehkar', 22),
(2694, 'Mhasla', 22),
(2695, 'Mhaswad', 22),
(2696, 'Mira Bhayandar', 22),
(2697, 'Miraj', 22),
(2698, 'Mohpa', 22),
(2699, 'Mohpada', 22),
(2700, 'Moram', 22),
(2701, 'Morshi', 22),
(2702, 'Mowad', 22),
(2703, 'Mudkhed', 22),
(2704, 'Mukhed', 22),
(2705, 'Mul', 22),
(2706, 'Mulshi', 22),
(2707, 'Mumbai', 22),
(2708, 'Murbad', 22),
(2709, 'Murgud', 22),
(2710, 'Murtijapur', 22),
(2711, 'Murud', 22),
(2712, 'Nachane', 22),
(2713, 'Nagardeole', 22),
(2714, 'Nagothane', 22),
(2715, 'Nagpur', 22),
(2716, 'Nakoda', 22),
(2717, 'Nalasopara', 22),
(2718, 'Naldurg', 22),
(2719, 'Nanded', 22),
(2720, 'Nandgaon', 22),
(2721, 'Nandura', 22),
(2722, 'Nandurbar', 22),
(2723, 'Narkhed', 22),
(2724, 'Nashik', 22),
(2725, 'Navapur', 22),
(2726, 'Navi Mumbai', 22),
(2727, 'Navi Mumbai Panvel', 22),
(2728, 'Neral', 22),
(2729, 'Nigdi', 22),
(2730, 'Nilanga', 22),
(2731, 'Nildoh', 22),
(2732, 'Nimbhore', 22),
(2733, 'Ojhar', 22),
(2734, 'Osmanabad', 22),
(2735, 'Pachgaon', 22),
(2736, 'Pachora', 22),
(2737, 'Padagha', 22),
(2738, 'Paithan', 22),
(2739, 'Palghar', 22),
(2740, 'Pali', 22),
(2741, 'Panchgani', 22),
(2742, 'Pandhakarwada', 22),
(2743, 'Pandharpur', 22),
(2744, 'Panhala', 22),
(2745, 'Panvel', 22),
(2746, 'Paranda', 22),
(2747, 'Parbhani', 22),
(2748, 'Parli', 22),
(2749, 'Parola', 22),
(2750, 'Partur', 22),
(2751, 'Pasthal', 22),
(2752, 'Patan', 22),
(2753, 'Pathardi', 22),
(2754, 'Pathri', 22),
(2755, 'Patur', 22),
(2756, 'Pawni', 22),
(2757, 'Pen', 22),
(2758, 'Pethumri', 22),
(2759, 'Phaltan', 22),
(2760, 'Pimpri', 22),
(2761, 'Poladpur', 22),
(2762, 'Pulgaon', 22),
(2763, 'Pune', 22),
(2764, 'Pune Cantonment', 22),
(2765, 'Purna', 22),
(2766, 'Purushottamnagar', 22),
(2767, 'Pusad', 22),
(2768, 'Rahimatpur', 22),
(2769, 'Rahta Pimplas', 22),
(2770, 'Rahuri', 22),
(2771, 'Raigad', 22),
(2772, 'Rajapur', 22),
(2773, 'Rajgurunagar', 22),
(2774, 'Rajur', 22),
(2775, 'Rajura', 22),
(2776, 'Ramtek', 22),
(2777, 'Ratnagiri', 22),
(2778, 'Ravalgaon', 22),
(2779, 'Raver', 22),
(2780, 'Revadanda', 22),
(2781, 'Risod', 22),
(2782, 'Roha Ashtami', 22),
(2783, 'Sakri', 22),
(2784, 'Sandor', 22),
(2785, 'Sangamner', 22),
(2786, 'Sangli', 22),
(2787, 'Sangole', 22),
(2788, 'Sasti', 22),
(2789, 'Sasvad', 22),
(2790, 'Satana', 22),
(2791, 'Satara', 22),
(2792, 'Savantvadi', 22),
(2793, 'Savda', 22),
(2794, 'Savner', 22),
(2795, 'Sawari Jawharnagar', 22),
(2796, 'Selu', 22),
(2797, 'Shahada', 22),
(2798, 'Shahapur', 22),
(2799, 'Shegaon', 22),
(2800, 'Shelar', 22),
(2801, 'Shendurjana', 22),
(2802, 'Shirdi', 22),
(2803, 'Shirgaon', 22),
(2804, 'Shirpur', 22),
(2805, 'Shirur', 22),
(2806, 'Shirwal', 22),
(2807, 'Shivatkar', 22),
(2808, 'Shrigonda', 22),
(2809, 'Shrirampur', 22),
(2810, 'Shrirampur Rural', 22),
(2811, 'Sillewada', 22),
(2812, 'Sillod', 22),
(2813, 'Sindhudurg', 22),
(2814, 'Sindi', 22),
(2815, 'Sindi Turf Hindnagar', 22),
(2816, 'Sindkhed Raja', 22),
(2817, 'Singnapur', 22),
(2818, 'Sinnar', 22),
(2819, 'Sirur', 22),
(2820, 'Sitasawangi', 22),
(2821, 'Solapur', 22),
(2822, 'Sonai', 22),
(2823, 'Sonegaon', 22),
(2824, 'Soyagaon', 22),
(2825, 'Srivardhan', 22),
(2826, 'Surgana', 22),
(2827, 'Talegaon Dabhade', 22),
(2828, 'Taloda', 22),
(2829, 'Taloja', 22),
(2830, 'Talwade', 22),
(2831, 'Tarapur', 22),
(2832, 'Tasgaon', 22),
(2833, 'Tathavade', 22),
(2834, 'Tekadi', 22),
(2835, 'Telhara', 22),
(2836, 'Thane', 22),
(2837, 'Tirira', 22),
(2838, 'Totaladoh', 22),
(2839, 'Trimbak', 22),
(2840, 'Tuljapur', 22),
(2841, 'Tumsar', 22),
(2842, 'Uchgaon', 22),
(2843, 'Udgir', 22),
(2844, 'Ulhasnagar', 22),
(2845, 'Umarga', 22),
(2846, 'Umarkhed', 22),
(2847, 'Umarsara', 22),
(2848, 'Umbar Pada Nandade', 22),
(2849, 'Umred', 22),
(2850, 'Umri Pragane Balapur', 22),
(2851, 'Uran', 22),
(2852, 'Uran Islampur', 22),
(2853, 'Utekhol', 22),
(2854, 'Vada', 22),
(2855, 'Vadgaon', 22),
(2856, 'Vadgaon Kasba', 22),
(2857, 'Vaijapur', 22),
(2858, 'Vanvadi', 22),
(2859, 'Varangaon', 22),
(2860, 'Vasai', 22),
(2861, 'Vasantnagar', 22),
(2862, 'Vashind', 22),
(2863, 'Vengurla', 22),
(2864, 'Virar', 22),
(2865, 'Visapur', 22),
(2866, 'Vite', 22),
(2867, 'Vithalwadi', 22),
(2868, 'Wadi', 22),
(2869, 'Waghapur', 22),
(2870, 'Wai', 22),
(2871, 'Wajegaon', 22),
(2872, 'Walani', 22),
(2873, 'Wanadongri', 22),
(2874, 'Wani', 22),
(2875, 'Wardha', 22),
(2876, 'Warora', 22),
(2877, 'Warthi', 22),
(2878, 'Warud', 22),
(2879, 'Washim', 22),
(2880, 'Yaval', 22),
(2881, 'Yavatmal', 22),
(2882, 'Yeola', 22),
(2883, 'Yerkheda', 22),
(2884, 'Andro', 23),
(2885, 'Bijoy Govinda', 23),
(2886, 'Bishnupur', 23),
(2887, 'Churachandpur', 23),
(2888, 'Heriok', 23),
(2889, 'Imphal', 23),
(2890, 'Jiribam', 23),
(2891, 'Kakching', 23),
(2892, 'Kakching Khunou', 23),
(2893, 'Khongman', 23),
(2894, 'Kumbi', 23),
(2895, 'Kwakta', 23),
(2896, 'Lamai', 23),
(2897, 'Lamjaotongba', 23),
(2898, 'Lamshang', 23),
(2899, 'Lilong', 23),
(2900, 'Mayang Imphal', 23),
(2901, 'Moirang', 23),
(2902, 'Moreh', 23),
(2903, 'Nambol', 23),
(2904, 'Naoriya Pakhanglakpa', 23),
(2905, 'Ningthoukhong', 23),
(2906, 'Oinam', 23),
(2907, 'Porompat', 23),
(2908, 'Samurou', 23),
(2909, 'Sekmai Bazar', 23),
(2910, 'Senapati', 23),
(2911, 'Sikhong Sekmai', 23),
(2912, 'Sugnu', 23),
(2913, 'Thongkhong Laxmi Bazar', 23),
(2914, 'Thoubal', 23),
(2915, 'Torban', 23),
(2916, 'Wangjing', 23),
(2917, 'Wangoi', 23),
(2918, 'Yairipok', 23),
(2919, 'Baghmara', 24),
(2920, 'Cherrapunji', 24),
(2921, 'Jawai', 24),
(2922, 'Madanrting', 24),
(2923, 'Mairang', 24),
(2924, 'Mawlai', 24),
(2925, 'Nongmynsong', 24),
(2926, 'Nongpoh', 24),
(2927, 'Nongstoin', 24),
(2928, 'Nongthymmai', 24),
(2929, 'Pynthorumkhrah', 24),
(2930, 'Resubelpara', 24),
(2931, 'Shillong', 24),
(2932, 'Shillong Cantonment', 24),
(2933, 'Tura', 24),
(2934, 'Williamnagar', 24),
(2935, 'Aizawl', 25),
(2936, 'Bairabi', 25),
(2937, 'Biate', 25),
(2938, 'Champhai', 25),
(2939, 'Darlawn', 25),
(2940, 'Hnahthial', 25),
(2941, 'Kawnpui', 25),
(2942, 'Khawhai', 25),
(2943, 'Khawzawl', 25),
(2944, 'Kolasib', 25),
(2945, 'Lengpui', 25),
(2946, 'Lunglei', 25),
(2947, 'Mamit', 25),
(2948, 'North Vanlaiphai', 25),
(2949, 'Saiha', 25),
(2950, 'Sairang', 25),
(2951, 'Saitul', 25),
(2952, 'Serchhip', 25),
(2953, 'Thenzawl', 25),
(2954, 'Tlabung', 25),
(2955, 'Vairengte', 25),
(2956, 'Zawlnuam', 25);

-- --------------------------------------------------------

--
-- Table structure for table `billing_customer`
--

CREATE TABLE `billing_customer` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobileno` varchar(20) NOT NULL,
  `address` text,
  `country` varchar(55) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` text,
  `status` tinyint(4) DEFAULT NULL,
  `created_datetime` datetime DEFAULT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `isdelete` int(11) DEFAULT NULL,
  `createdip` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `billing_customer`
--

INSERT INTO `billing_customer` (`id`, `name`, `mobileno`, `address`, `country`, `state`, `city`, `pincode`, `email`, `password`, `status`, `created_datetime`, `modified_datetime`, `isdelete`, `createdip`) VALUES
(1, 'Maksud', '8460213084', 'tesq', 'India', 3, 'junagdh', '362001', 'maksud.khan006@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2022-07-27 12:28:45', NULL, 0, '::1'),
(2, 'Maksud', '8460213031', 'sdsad', 'India', 3, 'junagadh', '362001', 'knsdlsa@gmaisl.com', '92251e8665e19be62c86ff039528e16e', 1, '2022-07-28 17:22:39', NULL, 0, '::1'),
(3, 'Maksud', '8460213085', 'msakdsda', 'India', 41, 'junadh', '254562', 'maksud@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2022-07-29 13:11:12', '2022-08-05 17:09:38', 0, '::1'),
(4, 'Test Test', '7984784649', 'n House Junagadh -362001', 'India', 12, 'Jsksnsiw', '362001', 'admin@everbrite.com', '68eacb97d86f0c4621fa2b0e17cabd8c', 1, '2022-08-07 20:26:06', NULL, 0, '::1'),
(5, 'Test Test', '7984784649', 'n House Junagadh -362001', 'India', 12, 'Jsksnsiw', '362001', 'adminds@everbrite.com', '68eacb97d86f0c4621fa2b0e17cabd8c', 1, '2022-08-07 20:26:52', NULL, 0, '::1');

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

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'collections id',
  `name` varchar(55) NOT NULL,
  `slug` varchar(55) NOT NULL,
  `shortname` varchar(55) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `displayorder` int(11) NOT NULL COMMENT 'collections rank for ordering',
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `shortname`, `image`, `description`, `displayorder`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 'Gold Collection', 'gold-collection', 'Gold', 'gold-collection.png', '', 1, 1, 0, '2022-07-08 17:07:29', '2022-07-08 17:11:07', '::1'),
(2, 'Silver Collection', 'silver-collection', 'Silver', 'silver-collection.png', '', 2, 1, 0, '2022-07-08 17:07:52', '2022-07-08 17:13:04', '::1'),
(3, 'Real Diamonds Collection', 'real-diamonds-collection', 'Real Dimonds', 'real-diamonds-collection.png', '', 3, 1, 0, '2022-07-08 17:08:20', '2022-07-08 17:12:59', '::1'),
(4, 'Platinum Collection', 'platinum-collection', 'Platinum', 'platinum-collection.png', '', 4, 1, 0, '2022-07-08 17:08:48', '2022-07-08 17:12:54', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `committee_master`
--

CREATE TABLE `committee_master` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `city` text CHARACTER SET utf8,
  `fullname` text CHARACTER SET utf8,
  `designation` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contact` text CHARACTER SET utf8,
  `gender` varchar(10) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_favorite_products`
--

CREATE TABLE `customer_favorite_products` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `products_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_favorite_products`
--

INSERT INTO `customer_favorite_products` (`id`, `customer_id`, `products_id`, `status`, `isdelete`, `created_datetime`, `modified_datetime`) VALUES
(3, 3, 2, 1, 0, '2022-08-04 23:21:52', '0000-00-00 00:00:00'),
(5, 3, 1, 1, 0, '2022-08-04 23:22:08', '0000-00-00 00:00:00'),
(6, 3, 3, 1, 0, '2022-08-06 17:36:39', '0000-00-00 00:00:00'),
(7, 3, 1, 1, 0, '2022-08-06 17:41:11', '0000-00-00 00:00:00'),
(8, 3, 2, 1, 0, '2022-08-06 17:41:18', '0000-00-00 00:00:00'),
(9, 3, 1, 1, 0, '2022-08-06 17:41:20', '0000-00-00 00:00:00'),
(10, 3, 2, 1, 0, '2022-08-06 17:41:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dailyratechanger`
--

CREATE TABLE `dailyratechanger` (
  `id` int(11) NOT NULL COMMENT 'dailyratechanger id',
  `name` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dailyratechanger`
--

INSERT INTO `dailyratechanger` (`id`, `name`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 'Gold Rate 18ct 750 : Rs. 41,800   22ct 916 : 49100', 1, 0, '2022-07-09 10:34:30', '2022-07-13 12:32:08', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_details`
--

CREATE TABLE `gallery_details` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `event_date` date DEFAULT NULL,
  `title` text CHARACTER SET utf8,
  `details` text CHARACTER SET utf8,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_details`
--

INSERT INTO `gallery_details` (`id`, `user_id`, `event_date`, `title`, `details`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, '2019-03-28', '17/12/2017 one day trekking camp', '', 1, '2019-03-28 16:17:17', '2019-04-02 03:32:44'),
(5, 1, '2019-04-03', 'Mount Abu trekking camp 30/04/17', '', 1, '2019-04-03 15:04:13', '2019-04-09 11:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_photo`
--

CREATE TABLE `gallery_photo` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `event_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_photo`
--

INSERT INTO `gallery_photo` (`id`, `user_id`, `event_id`, `image`) VALUES
(13, 1, 5, '5_69129_1.jpg'),
(14, 1, 5, '5_69645_10.jpg'),
(15, 1, 5, '5_89584_23.jpg'),
(16, 1, 5, '5_79231_img-20170505-wa0075.jpg'),
(17, 1, 5, '5_29224_9.jpg'),
(18, 1, 4, '4_87154_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL COMMENT 'gender id',
  `name` varchar(55) NOT NULL,
  `slug` varchar(55) NOT NULL,
  `image` text NOT NULL,
  `displayorder` int(11) NOT NULL COMMENT 'gender rank for ordering',
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`, `slug`, `image`, `displayorder`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 'MEN', 'men', 'men.jpg', 2, 1, 0, '2022-07-08 18:28:02', '2022-07-08 18:29:24', '::1'),
(2, 'WOMEN', 'women', 'women.jpg', 1, 1, 0, '2022-07-08 18:28:14', '2022-07-08 18:28:56', '::1'),
(3, 'KIDS', 'kids', 'kids.jpg', 3, 1, 0, '2022-07-08 18:28:24', '2022-07-08 18:29:01', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `offerzone`
--

CREATE TABLE `offerzone` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offerzone`
--

INSERT INTO `offerzone` (`id`, `name`, `image`, `document`, `status`, `created_at`, `updated_at`) VALUES
(9, 'tyty', 'eve_1659437969.jpg', '16594379905829701.xlsx', 1, '2022-08-02 16:29:50', '2022-08-02 16:29:50'),
(10, 'swsss', 'eve_1659439811.jpg', '1659439824212436350.jpg', 1, '2022-08-02 17:00:24', '2022-08-02 17:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `OrderNo` varchar(255) NOT NULL,
  `OrderDate` date NOT NULL,
  `OrderTime` time DEFAULT NULL,
  `OrderStatus` enum('Received','Accepted','Preparing','Dispatch','Delivered','Cancelled') NOT NULL,
  `TotalProducts` int(11) NOT NULL,
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
  `ShippingCountry` varchar(55) NOT NULL,
  `ShippingZipCode` varchar(255) NOT NULL,
  `ShippingMobileNo` varchar(100) NOT NULL,
  `Remark` text NOT NULL,
  `created_datetime` datetime NOT NULL,
  `CreatedBy` varchar(55) NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `LastModifiedBy` varchar(55) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `OrderNo`, `OrderDate`, `OrderTime`, `OrderStatus`, `TotalProducts`, `SubValue`, `ShippingCharges`, `Tax`, `TotalValue`, `BillingName`, `BillingEmail`, `BillingPhone`, `BillingAddress`, `BillingCity`, `BillingState`, `BillingZipCode`, `BillingNote`, `GSTNo`, `isDifferentShipping`, `ShippingName`, `ShippingEmail`, `ShippingAddress`, `ShippingCity`, `ShippingState`, `ShippingCountry`, `ShippingZipCode`, `ShippingMobileNo`, `Remark`, `created_datetime`, `CreatedBy`, `modified_datetime`, `LastModifiedBy`, `status`, `isdelete`) VALUES
(1, 0, '0001', '0000-00-00', NULL, '', 0, 0, 0, 0, 0, '', '', '', '', '', '', '', NULL, '', 0, '', '', '', '', '', '', '', '', '', '2022-07-29 09:41:24', '', '2022-07-29 09:41:24', '', 0, 0),
(2, 3, '0002', '2022-07-29', '13:14:18', 'Received', 0, 562, 0, 0, 562, 'Maksud', 'maksud.khan006@gmail.com', '8460213084', 'tesq', 'junagdh', '3', '362001', 'thisi is ete', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213084', '', '2022-07-29 13:14:18', '', '0000-00-00 00:00:00', '', 0, 0),
(3, 3, '0003', '2022-07-31', '19:15:16', 'Received', 0, 0, 0, 0, 0, 'Maksud', 'maksud@gmail.com', '8460213084', 'msakdsda', 'junadh', '2', '254562', 'sdsad', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213084', '', '2022-07-31 19:15:16', '', '0000-00-00 00:00:00', '', 1, 0),
(4, 3, '0004', '2022-08-04', '21:57:46', 'Received', 0, 562, 0, 0, 562, 'Maksud', 'maksud@gmail.com', '8460213084', 'msakdsda', 'junadh', '2', '254562', 'Test this order', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213084', '', '2022-08-04 21:57:46', '', '0000-00-00 00:00:00', '', 1, 0),
(5, 3, '0005', '2022-08-04', '22:55:55', 'Received', 1, 1316, 0, 0, 1316, 'Maksud', 'maksud@gmail.com', '8460213084', 'msakdsda', 'junadh', '2', '254562', 'dsfedf', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213084', '', '2022-08-04 22:55:55', '', '0000-00-00 00:00:00', '', 1, 0),
(6, 3, '0006', '2022-08-07', '21:46:14', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 21:46:14', '', '0000-00-00 00:00:00', '', 1, 0),
(7, 3, '0007', '2022-08-07', '21:49:38', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 21:49:38', '', '0000-00-00 00:00:00', '', 1, 0),
(8, 3, '0008', '2022-08-07', '21:50:15', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 21:50:15', '', '0000-00-00 00:00:00', '', 1, 0),
(9, 3, '0009', '2022-08-07', '21:50:23', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 21:50:23', '', '0000-00-00 00:00:00', '', 1, 0),
(10, 3, '0010', '2022-08-07', '21:50:40', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 21:50:40', '', '0000-00-00 00:00:00', '', 1, 0),
(11, 3, '0011', '2022-08-07', '22:15:37', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 22:15:37', '', '0000-00-00 00:00:00', '', 1, 0),
(12, 3, '0012', '2022-08-07', '22:17:03', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 22:17:03', '', '0000-00-00 00:00:00', '', 1, 0),
(13, 3, '0013', '2022-08-07', '22:17:27', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 22:17:27', '', '0000-00-00 00:00:00', '', 1, 0),
(14, 3, '0014', '2022-08-07', '22:18:35', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 22:18:35', '', '0000-00-00 00:00:00', '', 1, 0),
(15, 3, '0015', '2022-08-07', '22:18:56', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 22:18:56', '', '0000-00-00 00:00:00', '', 1, 0),
(16, 3, '0016', '2022-08-07', '22:19:09', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 22:19:09', '', '0000-00-00 00:00:00', '', 1, 0),
(17, 3, '0017', '2022-08-07', '22:30:32', 'Received', 3, 1220, 0, 0, 1220, 'Maksud', 'maksud@gmail.com', '8460213085', 'msakdsda', 'junadh', '41', '254562', 'this is may offer', '', 0, 'Maksud', 'maksud@gmail.com', 'msakdsda', 'junadh', '41', 'India', '41', '8460213085', '', '2022-08-07 22:30:32', '', '0000-00-00 00:00:00', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_products_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_no` varchar(55) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `products_id` int(11) NOT NULL,
  `products_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `products_code` varchar(150) NOT NULL,
  `products_price` float(10,2) DEFAULT NULL,
  `products_qty` int(11) NOT NULL,
  `products_total_cost` float(10,2) NOT NULL,
  `collectiontype` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `products_image` text NOT NULL,
  `products_extra_note` varchar(150) DEFAULT NULL,
  `product_remark` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_products_id`, `order_id`, `order_no`, `customer_id`, `products_id`, `products_name`, `products_code`, `products_price`, `products_qty`, `products_total_cost`, `collectiontype`, `categoryid`, `products_image`, `products_extra_note`, `product_remark`, `status`, `isdelete`, `created_datetime`, `modified_datetime`) VALUES
(1, 6, '0006', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 21:46:14', '0000-00-00 00:00:00'),
(2, 6, '0006', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 21:46:14', '0000-00-00 00:00:00'),
(3, 6, '0006', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 21:46:14', '0000-00-00 00:00:00'),
(4, 7, '0007', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 21:49:38', '0000-00-00 00:00:00'),
(5, 7, '0007', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 21:49:39', '0000-00-00 00:00:00'),
(6, 7, '0007', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 21:49:39', '0000-00-00 00:00:00'),
(7, 8, '0008', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 21:50:15', '0000-00-00 00:00:00'),
(8, 8, '0008', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 21:50:16', '0000-00-00 00:00:00'),
(9, 8, '0008', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 21:50:16', '0000-00-00 00:00:00'),
(10, 9, '0009', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 21:50:23', '0000-00-00 00:00:00'),
(11, 9, '0009', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 21:50:23', '0000-00-00 00:00:00'),
(12, 9, '0009', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 21:50:23', '0000-00-00 00:00:00'),
(13, 10, '0010', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 21:50:40', '0000-00-00 00:00:00'),
(14, 10, '0010', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 21:50:40', '0000-00-00 00:00:00'),
(15, 10, '0010', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 21:50:40', '0000-00-00 00:00:00'),
(16, 11, '0011', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 22:15:37', '0000-00-00 00:00:00'),
(17, 11, '0011', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 22:15:37', '0000-00-00 00:00:00'),
(18, 11, '0011', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 22:15:37', '0000-00-00 00:00:00'),
(19, 12, '0012', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 22:17:03', '0000-00-00 00:00:00'),
(20, 12, '0012', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 22:17:03', '0000-00-00 00:00:00'),
(21, 12, '0012', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 22:17:03', '0000-00-00 00:00:00'),
(22, 13, '0013', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 22:17:27', '0000-00-00 00:00:00'),
(23, 13, '0013', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 22:17:27', '0000-00-00 00:00:00'),
(24, 13, '0013', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 22:17:27', '0000-00-00 00:00:00'),
(25, 14, '0014', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 22:18:35', '0000-00-00 00:00:00'),
(26, 14, '0014', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 22:18:35', '0000-00-00 00:00:00'),
(27, 14, '0014', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 22:18:35', '0000-00-00 00:00:00'),
(28, 15, '0015', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 22:18:56', '0000-00-00 00:00:00'),
(29, 15, '0015', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 22:18:56', '0000-00-00 00:00:00'),
(30, 15, '0015', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 22:18:56', '0000-00-00 00:00:00'),
(31, 16, '0016', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 22:19:09', '0000-00-00 00:00:00'),
(32, 16, '0016', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 22:19:09', '0000-00-00 00:00:00'),
(33, 16, '0016', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 22:19:10', '0000-00-00 00:00:00'),
(34, 17, '0017', 3, 4, 'platinum collection mangalsutra Magal', 'Magal', 658.00, 1, 658.00, 4, 6, '91477.jpg', '', '', 1, 0, '2022-08-07 22:30:32', '0000-00-00 00:00:00'),
(35, 17, '0017', 3, 2, 'silver collection pendant Heart Younger', 'Heart Younger', 0.00, 1, 0.00, 1, 9, '78322.jpg', '', '', 1, 0, '2022-08-07 22:30:32', '0000-00-00 00:00:00'),
(36, 17, '0017', 3, 3, 'real diamonds collection nose pins Elesh', 'Elesh', 562.00, 1, 562.00, 3, 5, '61597.jpg', '', '', 1, 0, '2022-08-07 22:30:32', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `own_countries`
--

CREATE TABLE `own_countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `own_countries`
--

INSERT INTO `own_countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

CREATE TABLE `photo_gallery` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo_gallery`
--

INSERT INTO `photo_gallery` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'eve_1657626319.jpg', 1, '2022-07-12 17:15:36', '2022-07-12 17:15:36'),
(2, 'sdsad', '', 1, '2022-07-13 16:27:40', '2022-07-13 16:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery_detail`
--

CREATE TABLE `photo_gallery_detail` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo_gallery_detail`
--

INSERT INTO `photo_gallery_detail` (`id`, `event_id`, `image_name`, `created_at`, `updated_at`) VALUES
(4, 1, '46146.jpg', '2022-07-12 17:15:37', '2022-07-12 17:15:37'),
(6, 1, '30457.jpg', '2022-07-12 17:15:37', '2022-07-12 17:15:37'),
(7, 2, '16665.jpeg', '2022-07-13 16:27:40', '2022-07-13 16:27:40'),
(8, 2, '36821.jpg', '2022-07-13 16:27:40', '2022-07-13 16:27:40'),
(9, 2, '76432.jpg', '2022-07-13 16:27:40', '2022-07-13 16:27:40'),
(10, 2, '91329.jpg', '2022-07-13 16:27:40', '2022-07-13 16:27:40');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `collectiontype` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` text NOT NULL,
  `productcode` varchar(55) NOT NULL,
  `price` double DEFAULT NULL,
  `description` text,
  `gender` text,
  `size` text,
  `highlight` text,
  `displayorder` int(11) DEFAULT '0',
  `totalrating` int(11) DEFAULT '0',
  `totalreviews` int(11) DEFAULT '0',
  `popularity` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `collectiontype`, `categoryid`, `name`, `slug`, `productcode`, `price`, `description`, `gender`, `size`, `highlight`, `displayorder`, `totalrating`, `totalreviews`, `popularity`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 1, 7, 'gold collection bracelet Helix', 'gold-collection_bracelet_Helix', 'Helix', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam,nisi ut aliquip ex ea commodo consequat.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet\r\nquis nostrud exercitation ullamco\r\nDuis aute irure dolor in reprehenderit', 'WOMEN', NULL, 'NEW ARRIVAL,TRENDING COLLECTIONS', NULL, 0, 0, 0, 1, 0, '2022-07-19 11:17:45', '0000-00-00 00:00:00', '::1'),
(2, 1, 9, 'silver collection pendant Heart Younger', 'silver-collection_pendant_HeartYounger', 'Heart Younger', 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam,nisi ut aliquip ex ea commodo consequat.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet\r\nquis nostrud exercitation ullamco\r\nDuis aute irure dolor in reprehenderit', 'MEN,WOMEN', NULL, 'NEW ARRIVAL,TRENDING COLLECTIONS', NULL, 0, 0, 0, 1, 0, '2022-07-19 11:20:59', '0000-00-00 00:00:00', '::1'),
(3, 3, 5, 'real diamonds collection nose pins Elesh', 'real-diamonds-collection_nose-pins_Elesh', 'Elesh', 562, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam,nisi ut aliquip ex ea commodo consequat.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'WOMEN', NULL, 'TRENDING COLLECTIONS', NULL, 0, 0, 0, 1, 0, '2022-07-19 11:27:10', '0000-00-00 00:00:00', '::1'),
(4, 4, 6, 'platinum collection mangalsutra Magal', 'platinum-collection_mangalsutra_Magal', 'Magal', 658, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam,nisi ut aliquip ex ea commodo consequat.Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'WOMEN', NULL, 'TRENDING COLLECTIONS', NULL, 0, 0, 0, 1, 0, '2022-07-19 11:28:30', '0000-00-00 00:00:00', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `product_extra`
--

CREATE TABLE `product_extra` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `evalue` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `displayorder` int(11) NOT NULL DEFAULT '0',
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_extra`
--

INSERT INTO `product_extra` (`id`, `product_id`, `ename`, `evalue`, `status`, `displayorder`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(7, 1, 'Height', '20.86 ', 1, 0, 0, '2022-07-19 11:17:45', '0000-00-00 00:00:00', '::1'),
(8, 1, 'Width', '7.86', 1, 0, 0, '2022-07-19 11:17:45', '0000-00-00 00:00:00', '::1'),
(9, 1, 'Product Weight (Approx.)', '3.53 gram', 1, 0, 0, '2022-07-19 11:17:45', '0000-00-00 00:00:00', '::1'),
(10, 1, 'Type', '18Kt Gold', 1, 0, 0, '2022-07-19 11:17:45', '0000-00-00 00:00:00', '::1'),
(11, 2, 'Height', '20.86 ', 1, 0, 0, '2022-07-19 11:21:00', '0000-00-00 00:00:00', '::1'),
(12, 2, 'Width', '65.5', 1, 0, 0, '2022-07-19 11:21:00', '0000-00-00 00:00:00', '::1'),
(13, 2, 'Product Weight (Approx.)', '3.56', 1, 0, 0, '2022-07-19 11:21:00', '0000-00-00 00:00:00', '::1'),
(14, 2, 'Type', '18k', 1, 0, 0, '2022-07-19 11:21:00', '0000-00-00 00:00:00', '::1'),
(15, 3, 'Width', '20.86 ', 1, 0, 0, '2022-07-19 11:27:11', '0000-00-00 00:00:00', '::1'),
(16, 3, 'Height', '65', 1, 0, 0, '2022-07-19 11:27:11', '0000-00-00 00:00:00', '::1'),
(17, 3, 'Size', '56', 1, 0, 0, '2022-07-19 11:27:11', '0000-00-00 00:00:00', '::1'),
(18, 4, 'Width', '20.86 ', 1, 0, 0, '2022-07-19 11:28:30', '0000-00-00 00:00:00', '::1'),
(19, 4, 'Height', '65', 1, 0, 0, '2022-07-19 11:28:30', '0000-00-00 00:00:00', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `product_highlights`
--

CREATE TABLE `product_highlights` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_highlights`
--

INSERT INTO `product_highlights` (`id`, `name`, `status`) VALUES
(1, 'NEW ARRIVAL', 1),
(2, 'TRENDING COLLECTIONS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_name`, `created_at`, `updated_at`) VALUES
(6, 1, '65210.jpg', '2022-07-19 11:17:45', '2022-07-19 11:17:45'),
(7, 2, '78322.jpg', '2022-07-19 11:20:59', '2022-07-19 11:20:59'),
(8, 2, '60349.jpg', '2022-07-19 11:20:59', '2022-07-19 11:20:59'),
(9, 2, '18846.jpg', '2022-07-19 11:20:59', '2022-07-19 11:20:59'),
(10, 2, '42092.jpg', '2022-07-19 11:21:00', '2022-07-19 11:21:00'),
(11, 2, '65851.jpg', '2022-07-19 11:21:00', '2022-07-19 11:21:00'),
(12, 3, '61597.jpg', '2022-07-19 11:27:10', '2022-07-19 11:27:10'),
(13, 3, '30245.jpg', '2022-07-19 11:27:11', '2022-07-19 11:27:11'),
(14, 3, '60979.jpg', '2022-07-19 11:27:11', '2022-07-19 11:27:11'),
(15, 3, '48560.jpg', '2022-07-19 11:27:11', '2022-07-19 11:27:11'),
(16, 4, '91477.jpg', '2022-07-19 11:28:30', '2022-07-19 11:28:30'),
(17, 4, '96237.jpg', '2022-07-19 11:28:30', '2022-07-19 11:28:30'),
(18, 4, '28584.jpg', '2022-07-19 11:28:30', '2022-07-19 11:28:30'),
(19, 4, '23505.jpg', '2022-07-19 11:28:30', '2022-07-19 11:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_pricerange`
--

CREATE TABLE `product_pricerange` (
  `id` int(11) NOT NULL COMMENT 'pricerange id',
  `name` varchar(55) NOT NULL,
  `slug` varchar(55) NOT NULL,
  `image` text,
  `pricemax` double DEFAULT NULL,
  `pricemin` double DEFAULT NULL,
  `displayorder` int(11) NOT NULL COMMENT 'price range rank for ordering',
  `showonweb` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_pricerange`
--

INSERT INTO `product_pricerange` (`id`, `name`, `slug`, `image`, `pricemax`, `pricemin`, `displayorder`, `showonweb`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 'Below 10K', 'below-10k', NULL, 10000, 0, 1, 0, 1, 0, '2022-07-08 19:00:14', '2022-07-08 19:01:09', '::1'),
(2, '10K - 20K', '10k-20k', NULL, 20000, 10000, 2, 0, 1, 0, '2022-07-08 19:01:27', '2022-07-08 19:02:13', '::1'),
(3, '20K - 30K', '20K-30K', NULL, 30000, 20000, 3, 0, 1, 0, '2022-07-08 19:01:27', '0000-00-00 00:00:00', '::1'),
(4, '30K - 50K', '30k-50k', NULL, 50000, 30000, 4, 0, 1, 0, '2022-07-08 19:02:37', '0000-00-00 00:00:00', '::1'),
(5, 'Above 50K', 'above-50k', NULL, 0, 50000, 5, 0, 1, 0, '2022-07-08 19:03:01', '2022-07-08 19:03:08', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `product_rating`
--

CREATE TABLE `product_rating` (
  `id` int(50) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `mobileno` varchar(15) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_rating` varchar(5) CHARACTER SET utf8mb4 DEFAULT NULL,
  `product_review` text COLLATE utf8_unicode_ci,
  `customerid` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order_no` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order_id` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `replayby` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `replayremark` text COLLATE utf8_unicode_ci,
  `status` tinyint(3) NOT NULL,
  `isdelete` tinyint(3) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `createdip` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `subtitle` varchar(150) DEFAULT NULL,
  `description` text,
  `image` text NOT NULL,
  `linktext` varchar(100) NOT NULL,
  `linkurl` text,
  `displayorder` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime DEFAULT NULL,
  `isdelete` int(11) NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `subtitle`, `description`, `image`, `linktext`, `linkurl`, `displayorder`, `status`, `created_datetime`, `modified_datetime`, `isdelete`, `createdip`) VALUES
(1, 'BRAND NEW COLLECTION', 'NEW ARRIVALS', 'Autem vel eum iriure dolor in hendrerit molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.', '1.jpg', 'SHOP NOW', 'https://www.google.com/', 1, 1, '2022-07-08 12:44:18', NULL, 0, '::1'),
(2, 'LATEST COLLECTION 2018', 'STYLE & GRACE', 'Autem vel eum iriure dolor molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.', '2.jpg', 'SHOP NOW', 'https://www.google.com/', 2, 1, '2022-07-08 12:45:33', NULL, 0, '::1'),
(3, 'BRAND NEW COLLECTION', 'COMERCIO SHOP', 'Autem vel eum iriure dolor in molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.', '3.jpg', 'SHOP NOW', 'https://www.google.com/', 3, 1, '2022-07-08 12:50:02', NULL, 0, '::1'),
(4, 'BRAND NEW COLLECTION', 'STYLE & GRACEs', 'Autem vel eum iriure dolor in hendrerit molestie consequat vel illum dolore eu feugiat nulla facilisis at vero eros.', '4.jpg', 'SHOP NOW', 'https://www.google.com/', 4, 1, '2022-07-08 12:54:12', '2022-07-08 13:34:45', 0, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`, `created_at`) VALUES
(1, 'abc@yahoo.com', '2021-07-14 10:23:35'),
(2, 'Testing@yahoo.com', '2021-07-14 10:24:31'),
(3, 'demotesting@yahoo.com', '2021-07-14 10:26:12'),
(4, 'abcd@yahoo.com', '2021-07-14 10:27:11'),
(5, 'maksud@gmail.com', '2022-08-06 17:35:40'),
(6, 'maksud@gmai.cos', '2022-08-07 11:29:05'),
(7, 'dsad@gamil.com', '2022-08-07 12:40:31'),
(8, 'sads@gamil.com', '2022-08-07 12:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` varchar(55) NOT NULL,
  `name` text NOT NULL,
  `slug` varchar(55) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `image`, `category_id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Earrings.jpg', '1,2,3,4', 'Earrings', 'earrings', 1, '2022-07-12 11:40:17', '2022-07-19 23:50:16'),
(2, 'Bangles.jpg', '1,2,3,4', 'Bangles', 'bangles', 1, '2022-07-12 11:40:27', '2022-07-19 23:49:27'),
(3, 'DiamondChains.jpg', '1,2,3,4', 'Diamond Chains', 'diamondchains', 0, '2022-07-12 11:40:48', '2022-07-19 23:50:07'),
(4, 'Necklaces.jpg', '1,2,3,4', 'Necklaces', 'necklaces', 1, '2022-07-12 11:41:00', '2022-07-19 23:50:40'),
(5, 'NosePins.jpg', '1,2,3,4', 'Nose Pins', 'nosepins', 1, '2022-07-12 11:41:00', '2022-07-19 23:50:51'),
(6, 'Mangalsutra.jpg', '1,2,3,4', 'Mangalsutra', 'mangalsutra', 1, '2022-07-12 11:41:00', '2022-07-19 23:50:24'),
(7, 'Bracelet.jpg', '1,2,3,4', 'Bracelet', 'bracelet', 1, '2022-07-12 11:41:00', '2022-07-19 23:49:35'),
(8, 'Necklace.jpg', '1,2,3,4', 'Necklace', 'necklace', 1, '2022-07-12 11:41:00', '2022-07-19 23:50:31'),
(9, 'Pendant.jpg', '1,2,3,4', 'Pendant', 'pendant', 1, '2022-07-12 11:41:00', '2022-07-19 23:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `homepage` int(1) NOT NULL COMMENT '0 Off 1 - ON',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `city`, `desc`, `image`, `homepage`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Deeksha & Nakul', 'Ahmedabad, India', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500', 'eve_1623054775.jpg', 1, 1, '2021-06-05 11:11:52', '2021-06-18 16:23:27'),
(2, 'Priyanka & Pawan', 'Banglore, India', 'Thanks a ton Anam Khan for helping me in finding the profile for my Son Sanyam Jain who is very humble and down to earth person. Like every Mother, I wanted best of the partner and I found a very good Family for Him. She is absolutely awesome and perfect match for my Son. I wish that they would live happily.', 'eve_1623054729.jpg', 1, 1, '2021-06-05 11:12:41', '2021-06-07 08:32:17'),
(12, 'Sanyam & Mansie', 'junagadh', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable Eng', 'eve_1623054746.jpg', 1, 1, '2021-06-05 16:18:52', '2021-06-18 16:30:54'),
(13, 'Anjush & Pahuja', 'Porbandar', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable', 'eve_1623054708.jpg', 1, 1, '2021-06-05 17:55:28', '2022-05-07 16:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `trending`
--

CREATE TABLE `trending` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trending`
--

INSERT INTO `trending` (`id`, `image`, `created_at`, `updated_at`) VALUES
(1, 'f3f1e62d04893bd423e11f5ed9a204a8.jpg', '2022-07-12 17:15:36', '2022-08-01 17:31:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` text CHARACTER SET utf8,
  `surname` text CHARACTER SET utf8,
  `en_address_1` text CHARACTER SET utf8,
  `en_address_2` text CHARACTER SET utf8,
  `en_address_3` text CHARACTER SET utf8,
  `en_surname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `en_name` text CHARACTER SET utf8,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mo_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tel_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `whtsapp_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address_1` text CHARACTER SET utf8,
  `address_2` text CHARACTER SET utf8,
  `address_3` text CHARACTER SET utf8,
  `city` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `taluka` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pincode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category` int(11) NOT NULL DEFAULT '0',
  `sub_category` int(11) NOT NULL DEFAULT '0',
  `group_of` varchar(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `user_type` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_see_profile`
--

CREATE TABLE `user_see_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_see_profile`
--

INSERT INTO `user_see_profile` (`id`, `user_id`, `mem_id`, `created_at`) VALUES
(1, 96, 586, '2022-02-15 09:20:09'),
(2, 1, 586, '2022-04-16 09:20:41'),
(3, 586, 208, '2022-04-14 15:46:47'),
(4, 586, 157, '2022-04-14 15:48:24'),
(5, 586, 5, '2022-04-15 12:13:43'),
(6, 586, 13, '2022-04-15 12:13:55'),
(7, 586, 56, '2022-04-15 15:37:32'),
(8, 586, 24, '2022-04-15 16:03:44'),
(9, 586, 96, '2022-04-12 09:19:47'),
(10, 586, 3, '2022-04-19 11:10:55'),
(11, 3, 586, '2022-04-19 11:12:55'),
(12, 586, 122, '2022-04-23 11:20:18'),
(13, 586, 41, '2022-04-23 11:28:09'),
(14, 586, 8, '2022-04-23 11:28:37'),
(15, 586, 12, '2022-04-23 13:07:25'),
(16, 586, 1, '2022-04-23 13:09:18'),
(17, 586, 18, '2022-04-23 13:26:36'),
(18, 572, 180, '2022-04-23 13:27:47'),
(19, 572, 250, '2022-04-23 13:30:06'),
(20, 572, 586, '2022-04-23 13:30:53'),
(21, 572, 545, '2022-04-23 13:36:14'),
(22, 572, 555, '2022-04-23 13:43:19'),
(23, 572, 492, '2022-04-23 13:43:42'),
(24, 572, 19, '2022-04-23 13:43:56'),
(25, 586, 572, '2022-04-28 16:13:24'),
(26, 579, 582, '2022-04-28 16:18:20'),
(27, 582, 579, '2022-04-28 16:37:43'),
(28, 582, 13, '2022-04-28 17:53:01'),
(29, 582, 20, '2022-04-28 17:54:30'),
(30, 582, 339, '2022-04-28 18:01:19'),
(31, 582, 157, '2022-04-28 18:59:41'),
(32, 582, 1, '2022-05-12 12:45:39'),
(33, 582, 155, '2022-05-13 09:46:39'),
(34, 582, 449, '2022-05-14 11:18:04'),
(35, 582, 12, '2022-05-24 10:04:45'),
(36, 582, 40, '2022-06-06 12:38:37'),
(37, 582, 470, '2022-06-06 12:53:25'),
(38, 582, 518, '2022-06-06 15:48:13'),
(39, 582, 372, '2022-06-06 16:04:04');

-- --------------------------------------------------------

--
-- Table structure for table `websiteinformation`
--

CREATE TABLE `websiteinformation` (
  `id` int(11) NOT NULL,
  `websitetitle` varchar(100) NOT NULL,
  `websiteurl` text,
  `logo` varchar(500) NOT NULL,
  `site_favicon` varchar(500) NOT NULL,
  `applink` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `fb_url` varchar(500) NOT NULL,
  `instagram_url` varchar(500) NOT NULL,
  `youtube_url` varchar(500) NOT NULL,
  `twitter_url` varchar(500) NOT NULL,
  `mobileno` varchar(100) NOT NULL,
  `whatsapp_no` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `openclosetiming` text NOT NULL,
  `seokeywords` text,
  `seotitle` text,
  `seodescription` text,
  `status` int(15) NOT NULL,
  `isdelete` int(5) NOT NULL,
  `created_datetime` datetime(6) NOT NULL,
  `modified_datetime` datetime(6) NOT NULL,
  `createdip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `websiteinformation`
--

INSERT INTO `websiteinformation` (`id`, `websitetitle`, `websiteurl`, `logo`, `site_favicon`, `applink`, `address`, `fb_url`, `instagram_url`, `youtube_url`, `twitter_url`, `mobileno`, `whatsapp_no`, `email`, `openclosetiming`, `seokeywords`, `seotitle`, `seodescription`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 'KD Bhindi Jewellers Junagadh', '', 'logo.jpg', '2022-07-09-11-47-23favicon.png', 'https://pf.com', 'Zanzarda Road, \r\nopp. Saibaba Temple, \r\nJunagadh, \r\nGujarat 362001 India', 'https://www.facebook.com/KDBhindiJewellers', 'https://www.instagram.com/KDBhindiJewellers/', '', '', '7600122030', ' +91 99099 17102', 'kdbhindi@gmail.com', 'MONDAY - SATURDAY ( 9.00 TO 21.00 )\r\nSUNDAY ( 9.00 TO 14.00 )', 'Junagadh,Jewellers, Best Jewellers,Jewellery,Watches, Jewellery', 'KD Bhindi Jewellers Junagadh', 'An Award-winning Jewellery Brand, Bhindi Jewellers was established in 1970 and has the knack for crafting designer jewellery that are a sheer piece of Art! Come and check out our collection! ', 1, 0, '2021-01-29 17:20:53.000000', '2022-07-09 11:48:00.000000', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `welcomenote`
--

CREATE TABLE `welcomenote` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `ads_category`
--
ALTER TABLE `ads_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_city`
--
ALTER TABLE `billing_city`
  ADD PRIMARY KEY (`CityID`);

--
-- Indexes for table `billing_customer`
--
ALTER TABLE `billing_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_state`
--
ALTER TABLE `billing_state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `committee_master`
--
ALTER TABLE `committee_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_favorite_products`
--
ALTER TABLE `customer_favorite_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailyratechanger`
--
ALTER TABLE `dailyratechanger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_details`
--
ALTER TABLE `gallery_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_photo`
--
ALTER TABLE `gallery_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offerzone`
--
ALTER TABLE `offerzone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_products_id`);

--
-- Indexes for table `own_countries`
--
ALTER TABLE `own_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_gallery`
--
ALTER TABLE `photo_gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_gallery_detail`
--
ALTER TABLE `photo_gallery_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_extra`
--
ALTER TABLE `product_extra`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_highlights`
--
ALTER TABLE `product_highlights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_pricerange`
--
ALTER TABLE `product_pricerange`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_rating`
--
ALTER TABLE `product_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trending`
--
ALTER TABLE `trending`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_see_profile`
--
ALTER TABLE `user_see_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `websiteinformation`
--
ALTER TABLE `websiteinformation`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ads_category`
--
ALTER TABLE `ads_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `billing_city`
--
ALTER TABLE `billing_city`
  MODIFY `CityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2957;

--
-- AUTO_INCREMENT for table `billing_customer`
--
ALTER TABLE `billing_customer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `billing_state`
--
ALTER TABLE `billing_state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'collections id', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `committee_master`
--
ALTER TABLE `committee_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_favorite_products`
--
ALTER TABLE `customer_favorite_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `dailyratechanger`
--
ALTER TABLE `dailyratechanger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dailyratechanger id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery_details`
--
ALTER TABLE `gallery_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gallery_photo`
--
ALTER TABLE `gallery_photo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'gender id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `offerzone`
--
ALTER TABLE `offerzone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `own_countries`
--
ALTER TABLE `own_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `photo_gallery`
--
ALTER TABLE `photo_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `photo_gallery_detail`
--
ALTER TABLE `photo_gallery_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_extra`
--
ALTER TABLE `product_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_highlights`
--
ALTER TABLE `product_highlights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `product_pricerange`
--
ALTER TABLE `product_pricerange`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pricerange id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_rating`
--
ALTER TABLE `product_rating`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `trending`
--
ALTER TABLE `trending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_see_profile`
--
ALTER TABLE `user_see_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `websiteinformation`
--
ALTER TABLE `websiteinformation`
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
