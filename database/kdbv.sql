-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 02:12 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `user_type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0-master, 1-user',
  `create_at` datetime DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `email`, `password`, `org_password`, `mo_number`, `image`, `status`, `user_type`, `create_at`, `update_at`) VALUES
(1, 'KD Bhindi Jewellers', 'kssadmin', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '123', '9228253285', '42251_team-img04.jpg', 1, 1, '2019-02-20 00:00:00', '2022-07-12 05:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `ads_category`
--

CREATE TABLE `ads_category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads_category`
--

INSERT INTO `ads_category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Life Style', 1, '2021-06-05 12:32:50', '2021-06-05 17:08:32'),
(3, 'Food', 1, '2021-06-05 12:33:06', '2021-06-05 12:33:06'),
(4, 'Medical', 1, '2021-06-05 12:33:20', '2021-06-05 12:33:20'),
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
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '1 - active , 0 - deactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL COMMENT 'collections id',
  `name` varchar(55) NOT NULL,
  `slug` varchar(55) NOT NULL,
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

INSERT INTO `category` (`id`, `name`, `slug`, `image`, `description`, `displayorder`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 'Gold Collection', 'gold-collection', 'gold-collection.png', '', 1, 1, 0, '2022-07-08 17:07:29', '2022-07-08 17:11:07', '::1'),
(2, 'Silver Collection', 'silver-collection', 'silver-collection.png', '', 2, 1, 0, '2022-07-08 17:07:52', '2022-07-08 17:13:04', '::1'),
(3, 'Real Diamonds Collection', 'real-diamonds-collection', 'real-diamonds-collection.png', '', 3, 1, 0, '2022-07-08 17:08:20', '2022-07-08 17:12:59', '::1'),
(4, 'Platinum Collection', 'platinum-collection', 'platinum-collection.png', '', 4, 1, 0, '2022-07-08 17:08:48', '2022-07-08 17:12:54', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `committee_master`
--

CREATE TABLE `committee_master` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `city` text CHARACTER SET utf8 DEFAULT NULL,
  `fullname` text CHARACTER SET utf8 DEFAULT NULL,
  `designation` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `contact` text CHARACTER SET utf8 DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `user_id` int(11) NOT NULL DEFAULT 0,
  `event_date` date DEFAULT NULL,
  `title` text CHARACTER SET utf8 DEFAULT NULL,
  `details` text CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `user_id` int(11) NOT NULL DEFAULT 0,
  `event_id` int(11) NOT NULL DEFAULT 0,
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
(1, 'MEN', 'men', '2022-07-08-18-29-24g1.jpg', 2, 1, 0, '2022-07-08 18:28:02', '2022-07-08 18:29:24', '::1'),
(2, 'WOMEN', 'women', '2022-07-08-18-28-14g2.jpg', 1, 1, 0, '2022-07-08 18:28:14', '2022-07-08 18:28:56', '::1'),
(3, 'KIDS', 'kids', '2022-07-08-18-28-24g3.jpg', 3, 1, 0, '2022-07-08 18:28:24', '2022-07-08 18:29:01', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `own_countries`
--

CREATE TABLE `own_countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) DEFAULT 0
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
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `productcode` varchar(55) NOT NULL,
  `price` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `highlight` text DEFAULT NULL,
  `displayorder` int(11) DEFAULT 0,
  `status` tinyint(4) NOT NULL,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `collectiontype`, `categoryid`, `name`, `productcode`, `price`, `description`, `gender`, `size`, `highlight`, `displayorder`, `status`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 1, 2, 'gold-jewellery_rings_SKO12', 'SKO12', 251, 'sdsad', NULL, NULL, NULL, NULL, 1, 0, '2022-07-14 18:49:37', '0000-00-00 00:00:00', '::1'),
(2, 1, 4, 'gold-jewellery_pendants_SK0123', 'SK0123', 52, 'Tehisd sakd', 'WOMEN,KIDS', NULL, 'NEW ARRIVAL', NULL, 1, 0, '2022-07-15 19:25:39', '0000-00-00 00:00:00', '::1');

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
  `displayorder` int(11) NOT NULL DEFAULT 0,
  `isdelete` int(11) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `modified_datetime` datetime NOT NULL,
  `createdip` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_extra`
--

INSERT INTO `product_extra` (`id`, `product_id`, `ename`, `evalue`, `status`, `displayorder`, `isdelete`, `created_datetime`, `modified_datetime`, `createdip`) VALUES
(1, 1, 'Test', 'Test', 1, 0, 0, '2022-07-14 18:49:38', '0000-00-00 00:00:00', '::1'),
(4, 2, 'Height', '123', 1, 0, 0, '2022-07-15 18:42:32', '0000-00-00 00:00:00', '::1'),
(5, 2, 'Width', '150', 1, 0, 0, '2022-07-15 19:25:41', '0000-00-00 00:00:00', '::1'),
(6, 2, 'Size', '62', 1, 0, 0, '2022-07-15 19:25:41', '0000-00-00 00:00:00', '::1');

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `product_id`, `image_name`, `created_at`, `updated_at`) VALUES
(1, 2, '84915.jpg', '2022-07-15 18:42:30', '2022-07-15 18:42:30'),
(4, 2, '47098.png', '2022-07-15 19:25:39', '2022-07-15 19:25:39'),
(5, 2, '73440.png', '2022-07-15 19:25:41', '2022-07-15 19:25:41');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `subtitle` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text NOT NULL,
  `linktext` varchar(100) NOT NULL,
  `linkurl` text DEFAULT NULL,
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
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`, `created_at`) VALUES
(1, 'abc@yahoo.com', '2021-07-14 10:23:35'),
(2, 'Testing@yahoo.com', '2021-07-14 10:24:31'),
(3, 'demotesting@yahoo.com', '2021-07-14 10:26:12'),
(4, 'abcd@yahoo.com', '2021-07-14 10:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `image`, `category_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Earrings.jpg', 1, 'Earrings', 1, '2022-07-12 11:40:17', '2022-07-16 17:25:42'),
(2, 'Bangles.jpg', 1, 'Bangles', 1, '2022-07-12 11:40:27', '2022-07-16 17:26:10'),
(3, 'DiamondChains.jpg', 1, 'Diamond Chains', 0, '2022-07-12 11:40:48', '2022-07-16 17:26:21'),
(4, 'Necklaces.jpg', 1, 'Necklaces', 1, '2022-07-12 11:41:00', '2022-07-16 17:26:27'),
(5, 'NosePins.jpg', 1, 'Nose Pins', 1, '2022-07-12 11:41:00', '2022-07-16 17:26:36'),
(6, 'Mangalsutra.jpg', 1, 'Mangalsutra', 1, '2022-07-12 11:41:00', '2022-07-16 17:26:42');

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
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` text CHARACTER SET utf8 DEFAULT NULL,
  `surname` text CHARACTER SET utf8 DEFAULT NULL,
  `en_address_1` text CHARACTER SET utf8 DEFAULT NULL,
  `en_address_2` text CHARACTER SET utf8 DEFAULT NULL,
  `en_address_3` text CHARACTER SET utf8 DEFAULT NULL,
  `en_surname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `en_name` text CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `mo_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tel_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `whtsapp_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `address_1` text CHARACTER SET utf8 DEFAULT NULL,
  `address_2` text CHARACTER SET utf8 DEFAULT NULL,
  `address_3` text CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `taluka` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pincode` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `sub_category` int(11) NOT NULL DEFAULT 0,
  `group_of` varchar(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `user_type` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_see_profile`
--

CREATE TABLE `user_see_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
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
  `websiteurl` text DEFAULT NULL,
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
  `seokeywords` text DEFAULT NULL,
  `seotitle` text DEFAULT NULL,
  `seodescription` text DEFAULT NULL,
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `dailyratechanger`
--
ALTER TABLE `dailyratechanger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'dailyratechanger id', AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_extra`
--
ALTER TABLE `product_extra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_highlights`
--
ALTER TABLE `product_highlights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
