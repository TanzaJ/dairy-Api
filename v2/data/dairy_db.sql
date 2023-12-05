-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 06:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS `dairy_db`;

-- Creating the database
CREATE DATABASE IF NOT EXISTS `dairy_db`;

-- Changing the connection.
USE `dairy_db`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `country_id`) VALUES
(1, 'Kerrygold', 372),
(2, 'Lactantia', 124),
(3, 'Dairyland', 124),
(4, 'Natrel', 124),
(5, 'Babybel', 250),
(6, 'Black Diamond', 124),
(7, 'Kraft', 840),
(8, 'Cracker Barrel', 840),
(9, 'Saputo', 124),
(10, 'Lactalis', 250),
(11, 'Beatrice Foods', 124),
(12, 'Chapman', 840),
(13, 'La Diperie', 124),
(14, 'Bilboquet', 124),
(15, 'Laura Secord', 124);

-- --------------------------------------------------------

--
-- Table structure for table `butter`
--

CREATE TABLE `butter` (
  `butter_id` int(11) NOT NULL,
  `milk_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `butter`
--

INSERT INTO `butter` (`butter_id`, `milk_id`, `product_name`, `country_id`, `brand_id`, `nutritional_value_id`) VALUES
(1, 1, 'Kerrygold Butter', 372, 1, 1),
(2, 2, 'Lactantia Butter', 124, 2, 2),
(3, 3, 'Dairyland Butter', 124, 3, 3),
(4, 4, 'Natrel Butter', 124, 4, 4),
(9, 9, 'Saputo Butter', 124, 9, 5),
(10, 10, 'Lactalis Butter', 250, 10, 6),
(11, 11, 'Beatrice Foods Butter', 124, 11, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cheese`
--

CREATE TABLE `cheese` (
  `cheese_id` int(11) NOT NULL,
  `milk_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cheese`
--

INSERT INTO `cheese` (`cheese_id`, `milk_id`, `product_name`, `country_id`, `brand_id`, `nutritional_value_id`) VALUES
(16, 1, 'Kerrygold Cheese', 372, 1, 8),
(17, 2, 'Lactantia Cheese', 124, 2, 9),
(18, 3, 'Dairyland Cheese', 124, 3, 10),
(19, 4, 'Natrel Cheese', 124, 4, 11),
(20, 5, 'Babybel Cheese', 250, 5, 12),
(21, 6, 'Black Diamond Cheese', 124, 6, 13),
(22, 7, 'Kraft Cheese', 840, 7, 14),
(23, 8, 'Cracker Barrel Cheese', 840, 8, 15),
(24, 9, 'Saputo Cheese', 124, 9, 16),
(25, 10, 'Lactalis Cheese', 250, 10, 17),
(26, 11, 'Beatrice Foods Cheese', 124, 11, 18),
(27, 12, 'Chapman Cheese', 840, 12, 19),
(28, 13, 'La Diperie Cheese', 124, 13, 20),
(29, 14, 'Bilboquet Cheese', 124, 14, 21),
(30, 15, 'Laura Secord Cheese', 124, 15, 22);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `area_sq_mile` float DEFAULT NULL,
  `population_density_sq_mile` float DEFAULT NULL,
  `gdp_perCapita` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`, `region`, `population`, `area_sq_mile`, `population_density_sq_mile`, `gdp_perCapita`) VALUES
(4, 'Afghanistan', 'Asia', 38041754, 249347, 152.54, 509.28),
(8, 'Albania', 'Europe', 2862427, 11100.2, 258.06, 5352.15),
(10, 'Antarctica', 'Antarctica', 1106, 5470000, 0.0002, NULL),
(12, 'Algeria', 'Africa', 43053054, 919596, 46.84, 3948.32),
(16, 'American Samoa', 'Oceania', 55465, 581.2, 95.36, 11250.00),
(20, 'Andorra', 'Europe', 77142, 181.6, 424.07, 41793.06),
(24, 'Angola', 'Africa', 31825295, 1246700, 25.56, 2772.81),
(28, 'Antigua and Barbuda', 'North America', 97118, 170.5, 568.98, 16564.50),
(31, 'Azerbaijan', 'Asia', 10023318, 33435.9, 299.83, 4614.61),
(32, 'Argentina', 'South America', 44938712, 1068300, 42.02, 11698.98),
(36, 'Australia', 'Oceania', 25203198, 2966150, 8.49, 51681.38),
(40, 'Austria', 'Europe', 8955102, 32383.5, 276.28, 50737.37),
(44, 'Bahamas', 'North America', 389482, 5349.7, 72.75, 33132.69),
(48, 'Bahrain', 'Asia', 1641172, 301.7, 5431.6, 24298.07),
(50, 'Bangladesh', 'Asia', 163046161, 57297.3, 2845.54, 1465.41),
(51, 'Armenia', 'Asia', 2957731, 29743.3, 99.43, 4215.91),
(52, 'Barbados', 'North America', 287025, 167.4, 1712.87, 16517.66),
(56, 'Belgium', 'Europe', 11484055, 11866, 968.02, 46938.95),
(60, 'Bermuda', 'North America', 62506, 20.8, 3000.32, 0.00),
(64, 'Bhutan', 'Asia', 763092, 14686, 51.97, 2661.29),
(68, 'Bolivia', 'South America', 1130541, 424165, 2.66, 2822.53),
(70, 'Bosnia and Herzegovina', 'Europe', 3301000, 19745.3, 167.34, 5607.52),
(72, 'Botswana', 'Africa', 2303697, 224607, 10.25, 7494.95),
(74, 'Bouvet Island', 'Antarctica', NULL, NULL, NULL, NULL),
(76, 'Brazil', 'South America', 211049527, 3287600, 64.2, 9821.74),
(84, 'Belize', 'North America', 390353, 8866.3, 44.09, 4988.11),
(86, 'British Indian Ocean Territory', 'Asia', NULL, NULL, NULL, NULL),
(90, 'Solomon Islands', 'Oceania', 669823, 10987.6, 60.94, 1798.47),
(92, 'Virgin Islands, British', 'North America', 30030, 151, 198.81, 0.00),
(96, 'Brunei Darussalam', 'Asia', 433285, 2226.3, 194.68, 30048.92),
(100, 'Bulgaria', 'Europe', 7000039, 42239.7, 165.86, 8013.61),
(104, 'Myanmar', 'Asia', 54045420, 261229, 206.8, 1278.34),
(108, 'Burundi', 'Africa', 11530616, 10154.7, 1134.45, 283.49),
(112, 'Belarus', 'Europe', 9485386, 80863, 117.24, 5962.64),
(116, 'Cambodia', 'Asia', 16486542, 181036, 91, 1523.89),
(120, 'Cameroon', 'Africa', 25876380, 183568, 140.99, 1477.63),
(124, 'Canada', 'North America', 37411047, 3855090, 9.7, 44951.33),
(132, 'Cape Verde', 'Africa', 549935, 1556, 353.61, 3488.18),
(136, 'Cayman Islands', 'North America', 64948, 100, 649.48, 0.00),
(140, 'Central African Republic', 'Africa', 4998000, 240535, 20.79, 430.01),
(144, 'Sri Lanka', 'Asia', 21413249, 25332, 844.97, 4098.46),
(148, 'Chad', 'Africa', 15477798, 495752, 31.23, 740.98),
(152, 'Chile', 'South America', 18952038, 291930, 64.82, 13928.23),
(156, 'China', 'Asia', 1392730000, 3705920, 375.97, 9770.85),
(158, 'Taiwan, Province of China', 'Asia', 23780000, 13983.5, 1700.63, 27337.54),
(162, 'Christmas Island', 'Oceania', NULL, NULL, NULL, NULL),
(166, 'Cocos (Keeling) Islands', 'Oceania', NULL, NULL, NULL, NULL),
(170, 'Colombia', 'South America', 50339443, 440716, 114.1, 6759.70),
(174, 'Comoros', 'Africa', 850886, 863, 985.46, 1214.37),
(175, 'Mayotte', 'Africa', 266150, 144, 1847.57, 0.00),
(178, 'Congo', 'Africa', 5244363, 132046, 39.7, 1812.17),
(180, 'Congo, the Democratic Republic of the', 'Africa', 85026000, 905568, 93.75, 674.36),
(184, 'Cook Islands', 'Oceania', 17462, 92.3, 189.33, 0.00),
(188, 'Costa Rica', 'North America', 5058007, 19520.7, 259.1, 10688.89),
(191, 'Croatia', 'Europe', 4105267, 21831, 188.15, 12897.91),
(192, 'Cuba', 'North America', 11338138, 42042.3, 270.11, 8102.73),
(196, 'Cyprus', 'Asia', 875899, 3570.4, 245.33, 27228.85),
(203, 'Czech Republic', 'Europe', 10649800, 30123.5, 353.84, 21712.17),
(204, 'Benin', 'Africa', 11733059, 43484.2, 269.52, 827.85),
(208, 'Denmark', 'Europe', 5771876, 42431, 135.92, 56479.98),
(212, 'Dominica', 'North America', 71625, 290.6, 246.18, 4875.49),
(214, 'Dominican Republic', 'North America', 10738958, 18675.7, 574.77, 7025.41),
(218, 'Ecuador', 'South America', 17373662, 276841, 62.64, 6172.79),
(222, 'El Salvador', 'North America', 6453553, 8120.7, 795.53, 4098.22),
(226, 'Equatorial Guinea', 'Africa', 1355986, 10425.6, 130.17, 14482.86),
(231, 'Ethiopia', 'Africa', 114963588, 426364, 269.73, 789.09),
(232, 'Eritrea', 'Africa', 3497117, 45926.6, 76.11, 1047.68),
(233, 'Estonia', 'Europe', 1321977, 17403.9, 75.93, 17203.45),
(234, 'Faroe Islands', 'Europe', 52110, 540.2, 96.48, 0.00),
(238, 'Falkland Islands (Malvinas)', 'South America', 2840, 4697, 0.6, 0.00),
(239, 'South Georgia and the South Sandwich Islands', 'Antarctica', NULL, NULL, NULL, NULL),
(242, 'Fiji', 'Oceania', 889953, 7055.6, 126.17, 5105.06),
(246, 'Finland', 'Europe', 5520314, 130586, 42.29, 46385.97),
(250, 'France', 'Europe', 65273511, 248665, 262.36, 43560.98),
(254, 'French Guiana', 'South America', 290691, 32944.5, 8.82, 9049.15),
(258, 'French Polynesia', 'Oceania', 279287, 1435.6, 194.71, 12098.74),
(260, 'French Southern Territories', 'Antarctica', NULL, NULL, NULL, NULL),
(262, 'Djibouti', 'Africa', 973560, 8797, 110.64, 2464.55),
(266, 'Gabon', 'Africa', 2119275, 103347, 20.52, 7924.91),
(268, 'Georgia', 'Asia', 3996765, 26900, 148.56, 3879.11),
(270, 'Gambia', 'Africa', 2347706, 2196.3, 1069.62, 0.00),
(275, 'Palestine, State of', 'Asia', 4981420, 26361.9, 189.03, 2892.90),
(276, 'Germany', 'Europe', 83517045, 137847, 605.34, 44469.91),
(288, 'Ghana', 'Africa', 30417856, 92098.1, 330.01, 2265.98),
(292, 'Gibraltar', 'Europe', 33701, 2.6, 12961.5, 0.00),
(296, 'Kiribati', 'Oceania', 117606, 290.2, 405.07, 1686.51),
(300, 'Greece', 'Europe', 10724599, 50094.9, 213.99, 18734.22),
(304, 'Greenland', 'North America', 56025, 836331, 0.07, 0.00),
(308, 'Grenada', 'North America', 112523, 133, 846.05, 8300.43),
(312, 'Guadeloupe', 'North America', 400132, 630.1, 634.44, 0.00),
(316, 'Guam', 'Oceania', 165768, 210.2, 789.52, 43545.96),
(320, 'Guatemala', 'North America', 17773627, 42267.3, 420.97, 4208.39),
(324, 'Guinea', 'Africa', 12771246, 94926.6, 134.69, 997.76),
(328, 'Guyana', 'South America', 782766, 78717.1, 9.95, 4436.94),
(332, 'Haiti', 'North America', 11263077, 10864, 1037.4, 874.63),
(334, 'Heard Island and McDonald Islands', 'Antarctica', NULL, NULL, NULL, NULL),
(336, 'Holy See', 'Europe', 799, 0.2, 3995, 0.00),
(340, 'Honduras', 'North America', 9757617, 43095.4, 226, 2247.98),
(344, 'Hong Kong', 'Asia', 7451000, 427.8, 17415.5, 0.00),
(348, 'Hungary', 'Europe', 9775564, 35824.6, 272.33, 15567.42),
(352, 'Iceland', 'Europe', 360563, 39770.4, 9.07, 46482.35),
(356, 'India', 'Asia', 1366417754, 1269340, 1076.11, 2103.59),
(360, 'Indonesia', 'Asia', 270625568, 735359, 368.02, 3952.27),
(364, 'Iran, Islamic Republic of', 'Asia', 82913906, 1648200, 50.29, 5120.34),
(368, 'Iraq', 'Asia', 39309280, 168868, 232.78, 4554.08),
(372, 'Ireland', 'Europe', 4853506, 27620.3, 175.63, 86060.67),
(376, 'Israel', 'Asia', 9053300, 8442.9, 1073.85, 42870.58),
(380, 'Italy', 'Europe', 60550075, 116345, 520.66, 32426.26),
(384, 'Cote dIvoire', 'Africa', 25716544, 124505, 206.32, 1873.28),
(388, 'Jamaica', 'North America', 2934855, 4411.4, 664.53, 5224.73),
(392, 'Japan', 'Asia', 126860301, 145937, 868.48, 40261.48),
(398, 'Kazakhstan', 'Asia', 18403860, 2724900, 6.75, 9126.65),
(400, 'Jordan', 'Asia', 10101694, 34468, 293.12, 4456.43),
(404, 'Kenya', 'Africa', 52573967, 224081, 234.8, 1697.65),
(408, 'Korea, Democratic People s Republic of', 'Asia', 25666161, 46470.9, 552.16, 0.00),
(410, 'Korea, Republic of', 'Asia', 51225308, 38202.3, 1340.07, 31313.22),
(414, 'Kuwait', 'Asia', 4207083, 6888.9, 611.12, 28138.65),
(417, 'Kyrgyzstan', 'Asia', 6315800, 77197.7, 81.74, 1225.44),
(418, 'Lao People s Democratic Republic', 'Asia', 7064242, 91474.7, 77.19, 2307.89),
(422, 'Lebanon', 'Asia', 6855713, 40580.6, 168.96, 8152.63),
(426, 'Lesotho', 'Africa', 2142249, 11319.5, 189.21, 1293.07),
(428, 'Latvia', 'Europe', 1926542, 24938.5, 77.3, 16252.51),
(430, 'Liberia', 'Africa', 5057681, 43000, 117.36, 453.76),
(434, 'Libya', 'Africa', 6777452, 172191, 39.34, 3443.40),
(438, 'Liechtenstein', 'Europe', 38019, 62.2, 611.74, 0.00),
(440, 'Lithuania', 'Europe', 2794194, 25345.2, 110.3, 17132.03),
(442, 'Luxembourg', 'Europe', 607728, 998.6, 609.11, 114935.24),
(446, 'Macao', 'Asia', 640445, 11.6, 55228.4, 0.00),
(450, 'Madagascar', 'Africa', 26969307, 226948, 118.71, 489.45),
(454, 'Malawi', 'Africa', 18622104, 45273, 411.21, 369.28),
(458, 'Malaysia', 'Asia', 31949777, 329758, 96.74, 9945.92),
(462, 'Maldives', 'Asia', 392492, 115, 3419.05, 9773.90),
(466, 'Mali', 'Africa', 19658031, 478768, 41.12, 790.99),
(470, 'Malta', 'Europe', 493559, 121, 4079.5, 29692.99),
(474, 'Martinique', 'North America', 376480, 425.7, 884.48, 0.00),
(478, 'Mauritania', 'Africa', 4525696, 397840, 11.38, 1116.49),
(480, 'Mauritius', 'Africa', 1265985, 788.3, 1605.54, 10453.18),
(484, 'Mexico', 'North America', 126190788, 758449, 166.38, 9785.10),
(492, 'Monaco', 'Europe', 38389, 0.6, 63983.3, 0.00),
(496, 'Mongolia', 'Asia', 3225167, 604830, 5.33, 4135.78),
(498, 'Moldova, Republic of', 'Europe', 4051212, 13067.9, 309.83, 1794.84),
(499, 'Montenegro', 'Europe', 621810, 5316.1, 117.18, 7531.29),
(500, 'Montserrat', 'North America', 5900, 10, 590, 0.00),
(504, 'Morocco', 'Africa', 36471769, 175914, 207.4, 3082.17),
(508, 'Mozambique', 'Africa', 30366036, 309496, 98.12, 553.49),
(512, 'Oman', 'Asia', 4974986, 119499, 41.68, 15068.08),
(516, 'Namibia', 'Africa', 2458936, 318772, 77.04, 5055.40),
(520, 'Nauru', 'Oceania', 10824, 8.5, 1271.53, 0.00),
(524, 'Nepal', 'Asia', 28608710, 56125, 509.35, 849.18),
(528, 'Netherlands', 'Europe', 17134872, 16033.5, 1068.45, 53629.73),
(531, 'Curacao', 'North America', 157538, 171, 922.33, 0.00),
(533, 'Aruba', 'North America', 106314, 69.1, 1538.97, 0.00),
(534, 'Sint Maarten (Dutch part)', 'North America', 42876, 34, 1261.41, 0.00),
(535, 'Bonaire, Sint Eustatius and Saba', 'North America', 25157, 117.4, 214.36, NULL),
(540, 'New Caledonia', 'Oceania', 285498, 7537.9, 37.89, 15975.65),
(548, 'Vanuatu', 'Oceania', 299882, 3085, 97.27, 2883.18),
(554, 'New Zealand', 'Oceania', 4917000, 268838, 182.75, 42074.37),
(558, 'Nicaragua', 'North America', 6545502, 50637.5, 129.17, 1962.20),
(562, 'Niger', 'Africa', 23310715, 489191, 47.67, 376.63),
(566, 'Nigeria', 'Africa', 200963599, 356669, 563.76, 2399.71),
(570, 'Niue', 'Oceania', 1618, 100, 16.18, 0.00),
(574, 'Norfolk Island', 'Oceania', 2169, 13.2, 164.32, 0.00),
(578, 'Norway', 'Europe', 5378857, 148729, 36.17, 74356.07),
(580, 'Northern Mariana Islands', 'Oceania', 57616, 180, 320.09, 0.00),
(583, 'Micronesia, Federated States of', 'Oceania', 112640, 271, 416.06, 3194.71),
(584, 'Marshall Islands', 'Oceania', 58791, 70, 839.87, 0.00),
(585, 'Palau', 'Oceania', 18008, 177, 101.69, 10210.92),
(586, 'Pakistan', 'Asia', 216565318, 340509, 635.92, 1546.95),
(591, 'Panama', 'North America', 4246439, 29216, 145.3, 15498.36),
(598, 'Papua New Guinea', 'Oceania', 8776109, 462840, 18.95, 2444.61),
(600, 'Paraguay', 'South America', 7044636, 157049, 44.86, 4631.92),
(604, 'Peru', 'South America', 32510453, 496094, 65.51, 6462.88),
(608, 'Philippines', 'Asia', 108116615, 342353, 315.77, 3272.53),
(612, 'Pitcairn', 'Oceania', 50, 1.5, 33.33, 0.00),
(616, 'Poland', 'Europe', 37974750, 120726, 314.38, 15986.29),
(620, 'Portugal', 'Europe', 10283822, 35129.8, 292.4, 19765.84),
(624, 'Guinea-Bissau', 'Africa', 1600529, 13947.4, 114.62, 0.00),
(626, 'Timor-Leste', 'Asia', 1293119, 5906.9, 218.81, 1938.62),
(630, 'Puerto Rico', 'North America', 3195153, 3515, 908.04, 0.00),
(634, 'Qatar', 'Asia', 2832067, 4521.4, 626.41, 62242.55),
(638, 'Saint Barthelemy', 'North America', 9793, 21, 465.38, 0.00),
(642, 'Romania', 'Europe', 19473936, 238398, 81.67, 12000.45),
(643, 'Russian Federation', 'Europe', 144373535, 17098200, 84.46, 11430.68),
(646, 'Rwanda', 'Africa', 12663156, 10138.9, 1247.88, 801.19),
(652, 'Saint Helena, Ascension and Tristan da Cunha', 'Africa', 4074, 308, 13.24, 0.00),
(659, 'Saint Kitts and Nevis', 'North America', 52834, 101, 522.86, 19471.87),
(660, 'Anguilla', 'North America', 14969, 35, 427.69, 12274.00),
(662, 'Saint Lucia', 'North America', 182790, 238.2, 767.67, 6506.52),
(663, 'Saint Martin (French part)', 'North America', 38666, 54.4, 710.88, 0.00),
(666, 'Saint Pierre and Miquelon', 'North America', 5822, 242, 24.05, 0.00),
(670, 'Saint Vincent and the Grenadines', 'North America', 110608, 150.7, 733.77, 0.00),
(674, 'San Marino', 'Europe', 33860, 23.6, 1438.98, 0.00),
(678, 'Sao Tome and Principe', 'Africa', 211028, 386, 547.44, 1553.25),
(682, 'Saudi Arabia', 'Asia', 34268528, 2149690, 15.94, 22918.45),
(686, 'Senegal', 'Africa', 16296364, 196723, 82.77, 1367.89),
(688, 'Serbia', 'Europe', 6944975, 29205, 237.95, 5730.32),
(690, 'Seychelles', 'Africa', 97625, 459, 212.7, 15972.13),
(694, 'Sierra Leone', 'Africa', 7813215, 27699.4, 281.98, 480.71),
(702, 'Singapore', 'Asia', 5708844, 278.8, 20475.2, 58193.37),
(703, 'Slovakia', 'Europe', 5450421, 18513.2, 294.38, 15995.03),
(704, 'Viet Nam', 'Asia', 96462106, 310070, 311.33, 2342.50),
(705, 'Slovenia', 'Europe', 2078654, 7826.3, 265.79, 23412.47),
(706, 'Somalia', 'Africa', 15008154, 637657, 23.52, 418.70),
(710, 'South Africa', 'Africa', 58558270, 471359, 124.31, 6101.74),
(716, 'Zimbabwe', 'Africa', 14645468, 390757, 37.41, 219.93),
(724, 'Spain', 'Europe', 47076781, 505992, 93.02, 28119.79),
(728, 'South Sudan', 'Africa', 11062113, 239285, 46.2, 0.00),
(729, 'Sudan', 'Africa', 42813238, 1839540, 23.26, 0.00),
(732, 'Western Sahara', 'Africa', 582463, 266000, 2.19, 0.00),
(740, 'Suriname', 'South America', 581372, 63458.8, 9.16, 6148.67),
(744, 'Svalbard and Jan Mayen', 'Europe', 2655, 62, 42.74, 0.00),
(748, 'Eswatini', 'Africa', 1148130, 6354.4, 180.84, 3786.03),
(752, 'Sweden', 'Europe', 10036379, 450295, 22.28, 54691.42),
(756, 'Switzerland', 'Europe', 8574832, 15904.7, 539.42, 81031.82),
(760, 'Syrian Arab Republic', 'Asia', 17070135, 71650, 238.21, 0.00),
(762, 'Tajikistan', 'Asia', 9100837, 55224.6, 164.78, 833.42),
(764, 'Thailand', 'Asia', 69428524, 198114, 350.09, 5423.44),
(768, 'Togo', 'Africa', 8082366, 21925.6, 368.73, 662.67),
(772, 'Tokelau', 'Oceania', 1411, 3, 470.33, 0.00),
(776, 'Tonga', 'Oceania', 103197, 288.8, 357.08, 4869.69),
(780, 'Trinidad and Tobago', 'North America', 1399491, 1980, 707.06, 16850.22),
(784, 'United Arab Emirates', 'Asia', 9770529, 83600, 116.95, 41499.07),
(788, 'Tunisia', 'Africa', 11694719, 62763.9, 186.54, 3080.10),
(792, 'Turkey', 'Asia', 82319724, 783562, 104.92, 10550.79),
(795, 'Turkmenistan', 'Asia', 5851466, 488100, 12, 7336.92),
(796, 'Turks and Caicos Islands', 'North America', 38191, 497, 76.82, 0.00),
(798, 'Tuvalu', 'Oceania', 11646, 26.8, 434, 0.00),
(800, 'Uganda', 'Africa', 44269587, 241551, 183.19, 600.47),
(804, 'Ukraine', 'Europe', 44385155, 603500, 73.51, 2616.76),
(807, 'Macedonia, the former Yugoslav Republic of', 'Europe', 2086720, 25713.4, 81.27, 5311.45),
(818, 'Egypt', 'Africa', 100388073, 390122, 257.17, 2756.10),
(826, 'United Kingdom', 'Europe', 66488991, 242495, 274.51, 42943.90),
(832, 'Jersey', 'Europe', 107800, 46.2, 2334.98, 0.00),
(833, 'Isle of Man', 'Europe', 85032, 221, 384.71, 0.00),
(834, 'Tanzania, United Republic of', 'Africa', 58005463, 364900, 158.96, 0.00),
(840, 'United States', 'North America', 329093745, 3771350, 87.38, 62794.59),
(850, 'Virgin Islands, U.S.', 'North America', 106631, 346.3, 307.75, 0.00),
(854, 'Burkina Faso', 'Africa', 20321378, 104536, 194.3, 714.94),
(858, 'Uruguay', 'South America', 3461731, 181034, 19.1, 16896.45),
(860, 'Uzbekistan', 'Asia', 32955400, 448979, 73.42, 1808.57),
(862, 'Venezuela, Bolivarian Republic of', 'South America', 28515829, 916445, 31.11, 0.00),
(876, 'Wallis and Futuna', 'Oceania', 11773, 142.5, 82.65, 0.00),
(882, 'Samoa', 'Oceania', 197097, 1093.5, 180, 4220.95),
(887, 'Yemen', 'Asia', 29161922, 527968, 55.22, 762.88),
(894, 'Zambia', 'Africa', 17885422, 752619, 23.78, 1509.98);

-- --------------------------------------------------------

--
-- Table structure for table `ice_cream`
--

CREATE TABLE `ice_cream` (
  `ice_cream_id` int(11) NOT NULL,
  `milk_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ice_cream`
--

INSERT INTO `ice_cream` (`ice_cream_id`, `milk_id`, `product_name`, `country_id`, `brand_id`, `nutritional_value_id`) VALUES
(1, 3, 'Dairyland Ice Cream', 124, 3, 23),
(2, 4, 'Natrel Ice Cream', 124, 4, 24),
(3, 9, 'Saputo Ice Cream', 124, 9, 25),
(4, 12, 'Chapman Ice Cream', 840, 12, 26),
(5, 13, 'La Diperie Ice Cream', 124, 13, 27),
(6, 15, 'Laura Secord Ice Cream', 124, 15, 28);

-- --------------------------------------------------------

--
-- Table structure for table `milk`
--

CREATE TABLE `milk` (
  `milk_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `average_cost` decimal(15,2) NOT NULL,
  `place_of_origin` varchar(50) NOT NULL,
  `year_created` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `milk`
--

INSERT INTO `milk` (`milk_id`, `name`, `average_cost`, `place_of_origin`, `year_created`, `country_id`, `brand_id`, `nutritional_value_id`) VALUES
(1, 'Kerrygold Milk', 2.99, 'Ireland', '1990', 372, 1, 29),
(2, 'Lactantia Milk', 3.49, 'Canada', '1980', 124, 2, 30),
(3, 'Dairyland Milk', 3.19, 'Canada', '1975', 124, 3, 31),
(4, 'Natrel Milk', 3.29, 'Canada', '1985', 124, 4, 32),
(5, 'Babybel Milk', 2.79, 'France', '2000', 250, 5, 33),
(6, 'Black Diamond Milk', 3.09, 'Canada', '1995', 124, 6, 34),
(7, 'Kraft Milk', 2.89, 'USA', '1992', 840, 7, 35),
(8, 'Cracker Barrel Milk', 3.19, 'USA', '1987', 840, 8, 36),
(9, 'Saputo Milk', 3.09, 'Canada', '1982', 124, 9, 37),
(10, 'Lactalis Milk', 2.99, 'France', '1978', 250, 10, 38),
(11, 'Beatrice Foods Milk', 3.39, 'Canada', '1988', 124, 11, 39),
(12, 'Chapman Milk', 3.49, 'USA', '1991', 840, 12, 40),
(13, 'La Diperie Milk', 3.09, 'Canada', '2005', 124, 13, 41),
(14, 'Bilboquet Milk', 3.29, 'Canada', '1999', 124, 14, 42),
(15, 'Laura Secord Milk', 3.19, 'Canada', '1984', 124, 15, 43);

-- --------------------------------------------------------

--
-- Table structure for table `nutritional_value`
--

CREATE TABLE `nutritional_value` (
  `nutritional_value_id` int(11) NOT NULL,
  `kcal` float NOT NULL,
  `fiber` float NOT NULL,
  `cholesterol` float NOT NULL,
  `carbohydrate` float NOT NULL,
  `protein` float NOT NULL,
  `monosat_fat` float NOT NULL,
  `polysat_fat` float NOT NULL,
  `sat_fat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nutritional_value`
--

INSERT INTO `nutritional_value` (`nutritional_value_id`, `kcal`, `fiber`, `cholesterol`, `carbohydrate`, `protein`, `monosat_fat`, `polysat_fat`, `sat_fat`) VALUES
(1, 100, 0, 30, 0, 0, 4, 0, 7),
(2, 70, 0, 20, 0, 0, 0, 0.2, 5),
(3, 70, 0, 20, 0, 0, 0.2, 0, 5),
(4, 70, 0, 20, 0, 0.1, 0.3, 0, 5),
(5, 70, 0, 20, 0, 0.1, 0.3, 0, 5),
(6, 70, 0, 20, 0, 0, 0.3, 0, 5),
(7, 70, 0, 20, 0, 0, 0.3, 0, 5),
(8, 300, 0, 70, 1, 25, 2, 0.5, 15),
(9, 350, 0, 85, 2, 30, 2.5, 1, 18),
(10, 280, 0, 60, 1, 22, 1.5, 0.3, 14),
(11, 320, 0, 75, 1, 27, 2.2, 0.8, 17),
(12, 280, 0, 65, 1, 24, 2, 0.6, 16),
(13, 340, 0, 80, 2, 28, 2.8, 1.2, 20),
(14, 310, 0, 70, 1, 23, 2.2, 0.5, 15),
(15, 330, 0, 85, 2, 29, 2.5, 0.8, 18),
(16, 290, 0, 75, 1, 25, 1.8, 0.4, 14),
(17, 360, 0, 90, 2, 32, 3, 1.5, 21),
(18, 295, 0, 65, 1, 26, 2.1, 0.7, 16),
(19, 315, 0, 70, 2, 30, 2.6, 0.9, 19),
(20, 285, 0, 60, 1, 24, 1.7, 0.3, 13),
(21, 330, 0, 75, 2, 28, 2.9, 1, 17),
(22, 310, 0, 70, 1, 25, 2.3, 0.6, 15),
(23, 137, 0.5, 28, 14.5, 2.3, 4.2, 2.1, 5),
(24, 140, 0.3, 30, 15, 2.2, 4, 2.3, 4.8),
(25, 133, 0.7, 25, 13.8, 2.4, 4.4, 2, 5.2),
(26, 136, 0.4, 27, 14.3, 2.1, 4.1, 2.2, 4.9),
(27, 139, 0.6, 29, 14.7, 2.5, 4.3, 2.1, 5.1),
(28, 132, 0.2, 26, 13.5, 2.5, 4.5, 2, 5.3),
(29, 150, 0.2, 32, 12.5, 8.2, 5, 1.5, 5.3),
(30, 152, 0.3, 30, 12.8, 8, 4.8, 1.7, 5.1),
(31, 148, 0.1, 31, 12.3, 8.5, 5.2, 1.4, 5.5),
(32, 149, 0.4, 33, 12.6, 7.8, 4.9, 1.6, 5.2),
(33, 151, 0.2, 32, 12.7, 8.3, 5.1, 1.3, 5.4),
(34, 147, 0.3, 30, 12.2, 8.7, 5.3, 1.2, 5.6),
(35, 153, 0.1, 31, 12.9, 7.9, 4.7, 1.8, 5),
(36, 146, 0.4, 33, 12.4, 8.6, 5.4, 1.1, 5.7),
(37, 154, 0.2, 32, 13, 8.1, 4.6, 1.9, 4.9),
(38, 145, 0.3, 30, 12.1, 8.8, 5.5, 1, 5.8),
(39, 155, 0.1, 31, 13.1, 7.7, 4.5, 2, 4.8),
(40, 144, 0.4, 33, 12, 8.9, 5.6, 0.9, 5.9),
(41, 156, 0.2, 32, 13.2, 8.2, 4.4, 2.1, 4.7),
(42, 143, 0.3, 30, 11.9, 8.7, 5.7, 0.8, 6),
(43, 157, 0.1, 31, 13.3, 7.6, 4.3, 2.2, 4.6);

-- --------------------------------------------------------

--
-- Table structure for table `projected_milk_production`
--

CREATE TABLE `projected_milk_production` (
  `pmp_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `type` varchar(100) NOT NULL,
  `production` float NOT NULL,
  `consumption` float NOT NULL,
  `price` float NOT NULL,
  `milk_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `projected_milk_production`
--

INSERT INTO `projected_milk_production` (`pmp_id`, `year`, `type`, `production`, `consumption`, `price`, `milk_id`, `unit_id`) VALUES
(1, '1920', 'Total dairy products', 3661870, 0, 427.99, 12, 1),
(2, '1920', 'Fluid products', 1367510, 0, 159.83, 9, 1),
(3, '1920', 'Butter', 2101220, 0, 245.58, 4, 1),
(4, '1920', 'Cheese', 115568, 0, 13.51, 1, 1),
(5, '1920', 'Concentrated whole milk products', 37589, 0, 4.39, 11, 1),
(6, '1920', 'Ice cream', 39974, 0, 4.67, 2, 1),
(7, '1921', 'Total dairy products', 4081470, 0, 464.42, 14, 1),
(8, '1921', 'Fluid products', 1481320, 0, 168.56, 13, 1),
(9, '1921', 'Butter', 2413400, 0, 274.62, 14, 1),
(10, '1921', 'Cheese', 109045, 0, 12.41, 11, 1),
(11, '1921', 'Concentrated whole milk products', 39979, 0, 4.55, 4, 1),
(12, '1921', 'Ice cream', 37725, 0, 4.29, 11, 1),
(13, '1922', 'Total dairy products', 4204630, 0, 471.42, 13, 1),
(14, '1922', 'Fluid products', 1508980, 0, 169.19, 6, 1),
(15, '1922', 'Butter', 2491570, 0, 279.36, 13, 1),
(16, '1922', 'Cheese', 134637, 0, 15.1, 4, 1),
(17, '1922', 'Concentrated whole milk products', 36282, 0, 4.07, 13, 1),
(18, '1922', 'Ice cream', 33157, 0, 3.72, 3, 1),
(19, '1923', 'Total dairy products', 4502260, 0, 499.69, 5, 1),
(20, '1923', 'Fluid products', 1595980, 0, 177.13, 12, 1),
(21, '1923', 'Butter', 2691910, 0, 298.77, 13, 1),
(22, '1923', 'Cheese', 141910, 0, 15.75, 12, 1),
(23, '1923', 'Concentrated whole milk products', 33613, 0, 3.73, 6, 1),
(24, '1923', 'Ice cream', 38846, 0, 4.31, 1, 1),
(25, '1924', 'Total dairy products', 4536670, 0, 496.19, 9, 1),
(26, '1924', 'Fluid products', 1636920, 0, 179.04, 3, 1),
(27, '1924', 'Butter', 2676910, 0, 292.78, 5, 1),
(28, '1924', 'Cheese', 145939, 0, 15.96, 10, 1),
(29, '1924', 'Concentrated whole milk products', 38870, 0, 4.25, 10, 1),
(30, '1924', 'Ice cream', 38029, 0, 4.16, 11, 1),
(31, '1925', 'Total dairy products', 4689340, 0, 504.55, 3, 1),
(32, '1925', 'Fluid products', 1728180, 0, 185.95, 3, 1),
(33, '1925', 'Butter', 2706240, 0, 291.18, 14, 1),
(34, '1925', 'Cheese', 171830, 0, 18.49, 4, 1),
(35, '1925', 'Concentrated whole milk products', 42294, 0, 4.55, 4, 1),
(36, '1925', 'Ice cream', 40805, 0, 4.39, 10, 1),
(37, '1926', 'Total dairy products', 4876610, 0, 516, 5, 1),
(38, '1926', 'Fluid products', 1736130, 0, 183.7, 12, 1),
(39, '1926', 'Butter', 2844610, 0, 300.99, 12, 1),
(40, '1926', 'Cheese', 201269, 0, 21.3, 6, 1),
(41, '1926', 'Concentrated whole milk products', 46855, 0, 4.96, 13, 1),
(42, '1926', 'Ice cream', 47739, 0, 5.05, 14, 1),
(43, '1927', 'Total dairy products', 4830190, 0, 501.21, 14, 1),
(44, '1927', 'Fluid products', 1667330, 0, 173.01, 10, 1),
(45, '1927', 'Butter', 2890440, 0, 299.93, 12, 1),
(46, '1927', 'Cheese', 164456, 0, 17.07, 11, 1),
(47, '1927', 'Concentrated whole milk products', 56291, 0, 5.84, 11, 1),
(48, '1927', 'Ice cream', 51670, 0, 5.36, 5, 1),
(49, '1928', 'Total dairy products', 4929760, 0, 501.25, 9, 1),
(50, '1928', 'Fluid products', 1640960, 0, 166.85, 10, 1),
(51, '1928', 'Butter', 2990660, 0, 304.08, 10, 1),
(52, '1928', 'Cheese', 182583, 0, 18.56, 3, 1),
(53, '1928', 'Concentrated whole milk products', 56557, 0, 5.76, 5, 1),
(54, '1928', 'Ice cream', 58999, 0, 6, 11, 1),
(55, '1929', 'Total dairy products', 5036180, 0, 502.16, 8, 1),
(56, '1929', 'Fluid products', 1610200, 0, 160.56, 2, 1),
(57, '1929', 'Butter', 3120180, 0, 311.12, 7, 1),
(58, '1929', 'Cheese', 177705, 0, 17.72, 9, 1),
(59, '1929', 'Concentrated whole milk products', 60292, 0, 6.01, 12, 1),
(60, '1929', 'Ice cream', 67802, 0, 6.76, 6, 1),
(61, '1930', 'Total dairy products', 5283540, 0, 517.6, 3, 1),
(62, '1930', 'Fluid products', 1748390, 0, 171.28, 10, 1),
(63, '1930', 'Butter', 3219920, 0, 315.43, 12, 1),
(64, '1930', 'Cheese', 185001, 0, 18.12, 0, 1),
(65, '1930', 'Concentrated whole milk products', 63045, 0, 6.18, 10, 1),
(66, '1930', 'Ice cream', 67187, 0, 6.58, 7, 1),
(67, '1931', 'Total dairy products', 5455410, 0, 525.77, 6, 1),
(68, '1931', 'Fluid products', 1917570, 0, 184.81, 10, 1),
(69, '1931', 'Butter', 3243090, 0, 312.56, 14, 1),
(70, '1931', 'Cheese', 180616, 0, 17.41, 14, 1),
(71, '1931', 'Concentrated whole milk products', 57148, 0, 5.51, 6, 1),
(72, '1931', 'Ice cream', 56985, 0, 5.49, 12, 1),
(73, '1932', 'Total dairy products', 5359330, 0, 509.92, 9, 1),
(74, '1932', 'Fluid products', 1880470, 0, 178.92, 13, 1),
(75, '1932', 'Butter', 3220220, 0, 306.4, 0, 1),
(76, '1932', 'Cheese', 169305, 0, 16.11, 5, 1),
(77, '1932', 'Concentrated whole milk products', 46586, 0, 4.43, 7, 1),
(78, '1932', 'Ice cream', 42735, 0, 4.07, 5, 1),
(79, '1933', 'Total dairy products', 5400930, 0, 507.95, 8, 1),
(80, '1933', 'Fluid products', 1886500, 0, 177.42, 11, 1),
(81, '1933', 'Butter', 3248350, 0, 305.5, 6, 1),
(82, '1933', 'Cheese', 179922, 0, 16.92, 13, 1),
(83, '1933', 'Concentrated whole milk products', 46545, 0, 4.38, 0, 1),
(84, '1933', 'Ice cream', 39607, 0, 3.73, 12, 1),
(85, '1934', 'Total dairy products', 5600900, 0, 521.46, 13, 1),
(86, '1934', 'Fluid products', 1952740, 0, 181.8, 7, 1),
(87, '1934', 'Butter', 3360200, 0, 312.84, 5, 1),
(88, '1934', 'Cheese', 193035, 0, 17.97, 1, 1),
(89, '1934', 'Concentrated whole milk products', 53481, 0, 4.98, 5, 1),
(90, '1934', 'Ice cream', 41441, 0, 3.86, 10, 1),
(91, '1935', 'Total dairy products', 5667480, 0, 522.59, 9, 1),
(92, '1935', 'Fluid products', 1951120, 0, 179.91, 14, 1),
(93, '1935', 'Butter', 3412900, 0, 314.7, 5, 1),
(94, '1935', 'Cheese', 196185, 0, 18.09, 14, 1),
(95, '1935', 'Concentrated whole milk products', 61678, 0, 5.69, 1, 1),
(96, '1935', 'Ice cream', 45594, 0, 4.2, 4, 1),
(97, '1936', 'Total dairy products', 5800780, 0, 529.75, 7, 1),
(98, '1936', 'Fluid products', 1994010, 0, 182.1, 9, 1),
(99, '1936', 'Butter', 3478150, 0, 317.64, 1, 1),
(100, '1936', 'Cheese', 197964, 0, 18.08, 11, 1),
(101, '1936', 'Concentrated whole milk products', 73543, 0, 6.72, 4, 1),
(102, '1936', 'Ice cream', 57110, 0, 5.22, 3, 1),
(103, '1937', 'Total dairy products', 5862580, 0, 530.79, 12, 1),
(104, '1937', 'Fluid products', 1960710, 0, 177.52, 4, 1),
(105, '1937', 'Butter', 3557160, 0, 322.06, 14, 1),
(106, '1937', 'Cheese', 195332, 0, 17.69, 8, 1),
(107, '1937', 'Concentrated whole milk products', 85058, 0, 7.7, 11, 1),
(108, '1937', 'Ice cream', 64328, 0, 5.82, 3, 1),
(109, '1938', 'Total dairy products', 6013790, 0, 539.26, 0, 1),
(110, '1938', 'Fluid products', 2115940, 0, 189.74, 14, 1),
(111, '1938', 'Butter', 3538290, 0, 317.28, 0, 1),
(112, '1938', 'Cheese', 209403, 0, 18.78, 11, 1),
(113, '1938', 'Concentrated whole milk products', 88240, 0, 7.92, 8, 1),
(114, '1938', 'Ice cream', 61906, 0, 5.55, 14, 1),
(115, '1939', 'Total dairy products', 6065820, 0, 538.36, 3, 1),
(116, '1939', 'Fluid products', 2115540, 0, 187.76, 10, 1),
(117, '1939', 'Butter', 3568540, 0, 316.72, 1, 1),
(118, '1939', 'Cheese', 211457, 0, 18.77, 13, 1),
(119, '1939', 'Concentrated whole milk products', 107629, 0, 9.55, 9, 1),
(120, '1939', 'Ice cream', 62653, 0, 5.56, 4, 1),
(121, '1940', 'Total dairy products', 5881200, 0, 516.75, 10, 1),
(122, '1940', 'Fluid products', 1878290, 0, 165.04, 3, 1),
(123, '1940', 'Butter', 3615550, 0, 317.68, 5, 1),
(124, '1940', 'Cheese', 203250, 0, 17.86, 3, 1),
(125, '1940', 'Concentrated whole milk products', 114614, 0, 10.07, 8, 1),
(126, '1940', 'Ice cream', 69492, 0, 6.11, 0, 1),
(127, '1941', 'Total dairy products', 5948700, 0, 521.13, 2, 1),
(128, '1941', 'Fluid products', 1865000, 0, 163.38, 13, 1),
(129, '1941', 'Butter', 3612910, 0, 316.5, 7, 1),
(130, '1941', 'Cheese', 251761, 0, 22.06, 12, 1),
(131, '1941', 'Concentrated whole milk products', 129832, 0, 11.37, 13, 1),
(132, '1941', 'Ice cream', 89209, 0, 7.82, 2, 1),
(133, '1942', 'Total dairy products', 6279260, 0, 548.12, 12, 1),
(134, '1942', 'Fluid products', 1994460, 0, 174.1, 8, 1),
(135, '1942', 'Butter', 3789290, 0, 330.77, 6, 1),
(136, '1942', 'Cheese', 222660, 0, 19.44, 8, 1),
(137, '1942', 'Concentrated whole milk products', 177005, 0, 15.45, 6, 1),
(138, '1942', 'Ice cream', 95851, 0, 8.37, 12, 1),
(139, '1943', 'Total dairy products', 5992400, 0, 521.39, 8, 1),
(140, '1943', 'Fluid products', 2153330, 0, 187.36, 3, 1),
(141, '1943', 'Butter', 3250980, 0, 282.86, 1, 1),
(142, '1943', 'Cheese', 268751, 0, 23.38, 7, 1),
(143, '1943', 'Concentrated whole milk products', 210795, 0, 18.34, 6, 1),
(144, '1943', 'Ice cream', 108547, 0, 9.44, 4, 1),
(145, '1944', 'Total dairy products', 6257360, 0, 541.86, 2, 1),
(146, '1944', 'Fluid products', 2243450, 0, 194.27, 11, 1),
(147, '1944', 'Butter', 3449710, 0, 298.73, 12, 1),
(148, '1944', 'Cheese', 267118, 0, 23.13, 13, 1),
(149, '1944', 'Concentrated whole milk products', 185865, 0, 16.1, 12, 1),
(150, '1944', 'Ice cream', 111217, 0, 9.63, 5, 1),
(151, '1945', 'Total dairy products', 6230910, 0, 534.84, 14, 1),
(152, '1945', 'Fluid products', 2281160, 0, 195.81, 1, 1),
(153, '1945', 'Butter', 3354640, 0, 287.95, 2, 1),
(154, '1945', 'Cheese', 298938, 0, 25.66, 7, 1),
(155, '1945', 'Concentrated whole milk products', 193237, 0, 16.58, 6, 1),
(156, '1945', 'Ice cream', 102939, 0, 8.84, 10, 1),
(157, '1946', 'Total dairy products', 5954590, 0, 486.01, 4, 1),
(158, '1946', 'Fluid products', 2390050, 0, 195.08, 14, 1),
(159, '1946', 'Butter', 3017270, 0, 246.27, 0, 1),
(160, '1946', 'Cheese', 255366, 0, 20.84, 7, 1),
(161, '1946', 'Concentrated whole milk products', 192264, 0, 15.69, 13, 1),
(162, '1946', 'Ice cream', 99646, 0, 8.13, 3, 1),
(163, '1947', 'Total dairy products', 6406670, 0, 510.46, 14, 1),
(164, '1947', 'Fluid products', 2338220, 0, 186.3, 12, 1),
(165, '1947', 'Butter', 3370900, 0, 268.58, 14, 1),
(166, '1947', 'Cheese', 320647, 0, 25.55, 2, 1),
(167, '1947', 'Concentrated whole milk products', 229342, 0, 18.28, 14, 1),
(168, '1947', 'Ice cream', 147565, 0, 11.76, 11, 1),
(169, '1948', 'Total dairy products', 6393660, 0, 498.61, 9, 1),
(170, '1948', 'Fluid products', 2226930, 0, 173.67, 3, 1),
(171, '1948', 'Butter', 3514160, 0, 274.05, 12, 1),
(172, '1948', 'Cheese', 252444, 0, 19.69, 1, 1),
(173, '1948', 'Concentrated whole milk products', 241449, 0, 18.83, 2, 1),
(174, '1948', 'Ice cream', 158676, 0, 12.37, 12, 1),
(175, '1949', 'Total dairy products', 6016330, 0, 453.65, 3, 1),
(176, '1949', 'Fluid products', 2264570, 0, 172.84, 1, 1),
(177, '1949', 'Butter', 3022300, 0, 226.2, 3, 1),
(178, '1949', 'Cheese', 302839, 0, 22.67, 4, 1),
(179, '1949', 'Concentrated whole milk products', 235706, 0, 17.65, 12, 1),
(180, '1949', 'Ice cream', 190912, 0, 14.29, 1, 1),
(181, '1950', 'Total dairy products', 6232490, 0, 458.93, 2, 1),
(182, '1950', 'Fluid products', 2299940, 0, 172.14, 6, 1),
(183, '1950', 'Butter', 3138010, 0, 228.85, 4, 1),
(184, '1950', 'Cheese', 334550, 0, 24.4, 10, 1),
(185, '1950', 'Concentrated whole milk products', 272693, 0, 19.89, 11, 1),
(186, '1950', 'Ice cream', 187296, 0, 13.66, 11, 1),
(187, '1951', 'Total dairy products', 6187430, 0, 446.04, 11, 1),
(188, '1951', 'Fluid products', 2309610, 0, 169.23, 10, 1),
(189, '1951', 'Butter', 3048720, 0, 217.63, 9, 1),
(190, '1951', 'Cheese', 342149, 0, 24.42, 14, 1),
(191, '1951', 'Concentrated whole milk products', 285959, 0, 20.41, 7, 1),
(192, '1951', 'Ice cream', 200990, 0, 14.35, 14, 1),
(193, '1952', 'Total dairy products', 6314040, 0, 441.03, 1, 1),
(194, '1952', 'Fluid products', 2364840, 0, 167.9, 13, 1),
(195, '1952', 'Butter', 3066700, 0, 212.1, 5, 1),
(196, '1952', 'Cheese', 362978, 0, 25.11, 1, 1),
(197, '1952', 'Concentrated whole milk products', 309687, 0, 21.42, 11, 1),
(198, '1952', 'Ice cream', 209839, 0, 14.51, 1, 1),
(199, '1953', 'Total dairy products', 6515030, 0, 443.25, 9, 1),
(200, '1953', 'Fluid products', 2456630, 0, 169.87, 6, 1),
(201, '1953', 'Butter', 3141550, 0, 211.62, 4, 1),
(202, '1953', 'Cheese', 378925, 0, 25.52, 14, 1),
(203, '1953', 'Concentrated whole milk products', 323095, 0, 21.77, 8, 1),
(204, '1953', 'Ice cream', 214837, 0, 14.47, 4, 1),
(205, '1954', 'Total dairy products', 6674400, 0, 441, 6, 1),
(206, '1954', 'Fluid products', 2532760, 0, 170.08, 0, 1),
(207, '1954', 'Butter', 3194310, 0, 208.96, 0, 1),
(208, '1954', 'Cheese', 406569, 0, 26.59, 10, 1),
(209, '1954', 'Concentrated whole milk products', 326799, 0, 21.38, 1, 1),
(210, '1954', 'Ice cream', 213969, 0, 14, 9, 1),
(211, '1955', 'Total dairy products', 6924060, 0, 445.56, 14, 1),
(212, '1955', 'Fluid products', 2650100, 0, 173.3, 11, 1),
(213, '1955', 'Butter', 3262850, 0, 207.85, 10, 1),
(214, '1955', 'Cheese', 437579, 0, 27.88, 9, 1),
(215, '1955', 'Concentrated whole milk products', 331280, 0, 21.1, 6, 1),
(216, '1955', 'Ice cream', 242262, 0, 15.43, 11, 1),
(217, '1956', 'Total dairy products', 7187920, 0, 451.54, 4, 1),
(218, '1956', 'Fluid products', 2769860, 0, 176.81, 10, 1),
(219, '1956', 'Butter', 3376470, 0, 209.97, 7, 1),
(220, '1956', 'Cheese', 439044, 0, 27.3, 14, 1),
(221, '1956', 'Concentrated whole milk products', 354057, 0, 22.02, 1, 1),
(222, '1956', 'Ice cream', 248493, 0, 15.45, 14, 1),
(223, '1957', 'Total dairy products', 7266990, 0, 441.8, 14, 1),
(224, '1957', 'Fluid products', 2723370, 0, 168.26, 1, 1),
(225, '1957', 'Butter', 3445250, 0, 207.42, 5, 1),
(226, '1957', 'Cheese', 480568, 0, 28.93, 5, 1),
(227, '1957', 'Concentrated whole milk products', 354807, 0, 21.36, 2, 1),
(228, '1957', 'Ice cream', 262992, 0, 15.83, 9, 1),
(229, '1958', 'Total dairy products', 7178480, 0, 424.41, 10, 1),
(230, '1958', 'Fluid products', 2716490, 0, 163.17, 3, 1),
(231, '1958', 'Butter', 3343360, 0, 195.75, 4, 1),
(232, '1958', 'Cheese', 497747, 0, 29.14, 10, 1),
(233, '1958', 'Concentrated whole milk products', 347025, 0, 20.32, 13, 1),
(234, '1958', 'Ice cream', 273843, 0, 16.03, 3, 1),
(235, '1959', 'Total dairy products', 7077040, 0, 408.75, 5, 1),
(236, '1959', 'Fluid products', 2672710, 0, 156.83, 12, 1),
(237, '1959', 'Butter', 3237020, 0, 185.15, 2, 1),
(238, '1959', 'Cheese', 519458, 0, 29.71, 7, 1),
(239, '1959', 'Concentrated whole milk products', 348163, 0, 19.92, 5, 1),
(240, '1959', 'Ice cream', 299688, 0, 17.14, 10, 1),
(241, '1960', 'Total dairy products', 6966180, 0, 393.65, 12, 1),
(242, '1960', 'Fluid products', 2654420, 0, 152.36, 7, 1),
(243, '1960', 'Butter', 3091340, 0, 172.99, 12, 1),
(244, '1960', 'Cheese', 546739, 0, 30.59, 2, 1),
(245, '1960', 'Concentrated whole milk products', 366929, 0, 20.53, 6, 1),
(246, '1960', 'Ice cream', 306750, 0, 17.17, 3, 1),
(247, '1961', 'Total dairy products', 6889410, 0, 381.42, 10, 1),
(248, '1961', 'Fluid products', 2603130, 0, 146.41, 3, 1),
(249, '1961', 'Butter', 3061920, 0, 167.89, 13, 1),
(250, '1961', 'Cheese', 583284, 0, 31.98, 5, 1),
(251, '1961', 'Concentrated whole milk products', 354718, 0, 19.45, 11, 1),
(252, '1961', 'Ice cream', 286352, 0, 15.7, 13, 1),
(253, '1962', 'Total dairy products', 7228620, 0, 392.61, 2, 1),
(254, '1962', 'Fluid products', 2602800, 0, 143.68, 0, 1),
(255, '1962', 'Butter', 3382930, 0, 182.04, 8, 1),
(256, '1962', 'Cheese', 643853, 0, 34.65, 14, 1),
(257, '1962', 'Concentrated whole milk products', 362895, 0, 19.53, 1, 1),
(258, '1962', 'Ice cream', 236145, 0, 12.71, 3, 1),
(259, '1963', 'Total dairy products', 7582380, 0, 403.41, 6, 1),
(260, '1963', 'Fluid products', 2627980, 0, 142.15, 13, 1),
(261, '1963', 'Butter', 3684680, 0, 194.3, 7, 1),
(262, '1963', 'Cheese', 676133, 0, 35.65, 12, 1),
(263, '1963', 'Concentrated whole milk products', 373630, 0, 19.7, 5, 1),
(264, '1963', 'Ice cream', 219955, 0, 11.6, 9, 1),
(265, '1964', 'Total dairy products', 7688230, 0, 401.37, 1, 1),
(266, '1964', 'Fluid products', 2660850, 0, 141.23, 9, 1),
(267, '1964', 'Butter', 3734020, 0, 193.22, 1, 1),
(268, '1964', 'Cheese', 716637, 0, 37.08, 4, 1),
(269, '1964', 'Concentrated whole milk products', 360900, 0, 18.67, 6, 1),
(270, '1964', 'Ice cream', 215823, 0, 11.17, 5, 1),
(271, '1965', 'Total dairy products', 7754470, 0, 397.53, 13, 1),
(272, '1965', 'Fluid products', 2679130, 0, 139.61, 10, 1),
(273, '1965', 'Butter', 3710430, 0, 188.56, 13, 1),
(274, '1965', 'Cheese', 768087, 0, 39.03, 3, 1),
(275, '1965', 'Concentrated whole milk products', 360178, 0, 18.3, 13, 1),
(276, '1965', 'Ice cream', 236649, 0, 12.03, 8, 1),
(277, '1966', 'Total dairy products', 7669610, 0, 385.86, 13, 1),
(278, '1966', 'Fluid products', 2638820, 0, 134.95, 12, 1),
(279, '1966', 'Butter', 3619590, 0, 180.53, 9, 1),
(280, '1966', 'Cheese', 780193, 0, 38.91, 10, 1),
(281, '1966', 'Concentrated whole milk products', 350607, 0, 17.48, 13, 1),
(282, '1966', 'Ice cream', 280399, 0, 13.99, 13, 1),
(283, '1967', 'Total dairy products', 7631080, 0, 376.69, 10, 1),
(284, '1967', 'Fluid products', 2590340, 0, 130.09, 8, 1),
(285, '1967', 'Butter', 3506360, 0, 171.53, 4, 1),
(286, '1967', 'Cheese', 859959, 0, 42.07, 10, 1),
(287, '1967', 'Concentrated whole milk products', 350018, 0, 17.12, 10, 1),
(288, '1967', 'Ice cream', 324406, 0, 15.87, 7, 1),
(289, '1968', 'Total dairy products', 7591770, 0, 368.8, 1, 1),
(290, '1968', 'Fluid products', 2538520, 0, 125.53, 1, 1),
(291, '1968', 'Butter', 3465180, 0, 166.82, 10, 1),
(292, '1968', 'Cheese', 921841, 0, 44.38, 12, 1),
(293, '1968', 'Concentrated whole milk products', 338968, 0, 16.32, 7, 1),
(294, '1968', 'Ice cream', 327254, 0, 15.75, 8, 1),
(295, '1969', 'Total dairy products', 7537130, 0, 360.72, 8, 1),
(296, '1969', 'Fluid products', 2496200, 0, 121.69, 11, 1),
(297, '1969', 'Butter', 3355140, 0, 159.09, 12, 1),
(298, '1969', 'Cheese', 1020620, 0, 48.4, 2, 1),
(299, '1969', 'Concentrated whole milk products', 314282, 0, 14.9, 13, 1),
(300, '1969', 'Ice cream', 350890, 0, 16.64, 0, 1),
(301, '1970', 'Total dairy products', 7689030, 0, 362.58, 11, 1),
(302, '1970', 'Fluid products', 2513110, 0, 120.79, 11, 1),
(303, '1970', 'Butter', 3408500, 0, 159.23, 4, 1),
(304, '1970', 'Cheese', 1106440, 0, 51.69, 13, 1),
(305, '1970', 'Concentrated whole milk products', 293190, 0, 13.7, 13, 1),
(306, '1970', 'Ice cream', 367789, 0, 17.18, 3, 1),
(307, '1971', 'Total dairy products', 7788430, 0, 360.67, 4, 1),
(308, '1971', 'Fluid products', 2521440, 0, 116.78, 7, 1),
(309, '1971', 'Butter', 3413170, 0, 158.05, 5, 1),
(310, '1971', 'Cheese', 1187760, 0, 55, 8, 1),
(311, '1971', 'Concentrated whole milk products', 292049, 0, 13.52, 10, 1),
(312, '1971', 'Ice cream', 374007, 0, 17.32, 13, 1),
(313, '1972', 'Total dairy products', 7784280, 0, 356.69, 13, 1),
(314, '1972', 'Fluid products', 2573810, 0, 117.95, 7, 1),
(315, '1972', 'Butter', 3288540, 0, 150.7, 4, 1),
(316, '1972', 'Cheese', 1248650, 0, 57.22, 12, 1),
(317, '1972', 'Concentrated whole milk products', 281563, 0, 12.9, 5, 1),
(318, '1972', 'Ice cream', 391707, 0, 17.93, 9, 1),
(319, '1973', 'Total dairy products', 7713420, 0, 349.42, 13, 1),
(320, '1973', 'Fluid products', 2609620, 0, 118.23, 4, 1),
(321, '1973', 'Butter', 3040590, 0, 137.76, 9, 1),
(322, '1973', 'Cheese', 1389680, 0, 62.96, 14, 1),
(323, '1973', 'Concentrated whole milk products', 275567, 0, 12.48, 5, 1),
(324, '1973', 'Ice cream', 397954, 0, 17.99, 9, 1),
(325, '1974', 'Total dairy products', 1240, 0, 350.38, 10, 1),
(326, '1974', 'Fluid products', 2637160, 0, 117.76, 1, 1),
(327, '1974', 'Butter', 2996110, 0, 133.78, 10, 1),
(328, '1974', 'Cheese', 1563060, 0, 69.79, 13, 1),
(329, '1974', 'Concentrated whole milk products', 254608, 0, 11.37, 0, 1),
(330, '1974', 'Ice cream', 397423, 0, 17.68, 4, 1),
(331, '1975', 'Total dairy products', 1264, 0, 330.56, 5, 1),
(332, '1975', 'Fluid products', 2572830, 0, 113.2, 11, 1),
(333, '1975', 'Butter', 2722920, 0, 119.81, 11, 1),
(334, '1975', 'Cheese', 1563930, 0, 68.81, 14, 1),
(335, '1975', 'Concentrated whole milk products', 237864, 0, 10.47, 7, 1),
(336, '1975', 'Ice cream', 412985, 0, 18.26, 4, 1),
(337, '1976', 'Total dairy products', 1214, 0, 327.21, 10, 1),
(338, '1976', 'Fluid products', 2649420, 0, 115.07, 3, 1),
(339, '1976', 'Butter', 2658480, 0, 115.46, 4, 1),
(340, '1976', 'Cheese', 1574800, 0, 68.4, 1, 1),
(341, '1976', 'Concentrated whole milk products', 239346, 0, 10.4, 11, 1),
(342, '1976', 'Ice cream', 409769, 0, 17.89, 5, 1),
(343, '1977', 'Total dairy products', 1254, 0, 317.99, 10, 1),
(344, '1977', 'Fluid products', 2674000, 0, 114.68, 2, 1),
(345, '1977', 'Butter', 2402460, 0, 103.04, 10, 1),
(346, '1977', 'Cheese', 1627130, 0, 69.78, 4, 1),
(347, '1977', 'Concentrated whole milk products', 272346, 0, 11.68, 14, 1),
(348, '1977', 'Ice cream', 436170, 0, 18.81, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit_type`
--

CREATE TABLE `unit_type` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `unit_scale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_type`
--

INSERT INTO `unit_type` (`unit_id`, `unit_name`, `unit_scale`) VALUES
(1, 'Kiloliters', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `ws_log`
--

CREATE TABLE `ws_log` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) NOT NULL,
  `user_action` varchar(255) NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ws_users`
--

CREATE TABLE `ws_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `butter`
--
ALTER TABLE `butter`
  ADD PRIMARY KEY (`butter_id`,`milk_id`),
  ADD KEY `milk_id` (`milk_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `nutritional_value_id` (`nutritional_value_id`);

--
-- Indexes for table `cheese`
--
ALTER TABLE `cheese`
  ADD PRIMARY KEY (`cheese_id`,`milk_id`),
  ADD KEY `milk_id` (`milk_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `nutritional_value_id` (`nutritional_value_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD PRIMARY KEY (`ice_cream_id`),
  ADD KEY `milk_id` (`milk_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `nutritional_value_id` (`nutritional_value_id`);

--
-- Indexes for table `milk`
--
ALTER TABLE `milk`
  ADD PRIMARY KEY (`milk_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `nutritional_value_id` (`nutritional_value_id`);

--
-- Indexes for table `nutritional_value`
--
ALTER TABLE `nutritional_value`
  ADD PRIMARY KEY (`nutritional_value_id`);

--
-- Indexes for table `projected_milk_production`
--
ALTER TABLE `projected_milk_production`
  ADD PRIMARY KEY (`pmp_id`),
  ADD KEY `milk_id` (`milk_id`),
  ADD KEY `projected_milk_production_ibfk_2` (`unit_id`);

--
-- Indexes for table `unit_type`
--
ALTER TABLE `unit_type`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `ws_log`
--
ALTER TABLE `ws_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `ws_users`
--
ALTER TABLE `ws_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `ice_cream_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `butter`
--
ALTER TABLE `butter`
  MODIFY `butter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cheese`
--
ALTER TABLE `cheese`
  MODIFY `cheese_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `milk`
--
ALTER TABLE `milk`
  MODIFY `milk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `nutritional_value`
--
ALTER TABLE `nutritional_value`
  MODIFY `nutritional_value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `projected_milk_production`
--
ALTER TABLE `projected_milk_production`
  MODIFY `pmp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;

--
-- AUTO_INCREMENT for table `unit_type`
--
ALTER TABLE `unit_type`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ws_log`
--
ALTER TABLE `ws_log`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ws_users`
--
ALTER TABLE `ws_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `brand_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `butter`
--
ALTER TABLE `butter`
  ADD CONSTRAINT `butter_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `butter_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `butter_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `butter_ibfk_4` FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value` (`nutritional_value_id`);

--
-- Constraints for table `cheese`
--
ALTER TABLE `cheese`
  ADD CONSTRAINT `cheese_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `cheese_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `cheese_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `cheese_ibfk_4` FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value` (`nutritional_value_id`);

--
-- Constraints for table `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD CONSTRAINT `ice_cream_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `ice_cream_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `ice_cream_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `ice_cream_ibfk_4` FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value` (`nutritional_value_id`);

--
-- Constraints for table `milk`
--
ALTER TABLE `milk`
  ADD CONSTRAINT `milk_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `milk_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `milk_ibfk_3` FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value` (`nutritional_value_id`);

--
-- Constraints for table `projected_milk_production`
--
ALTER TABLE `projected_milk_production`
  ADD CONSTRAINT `projected_milk_production_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `projected_milk_production_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit_type` (`unit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
