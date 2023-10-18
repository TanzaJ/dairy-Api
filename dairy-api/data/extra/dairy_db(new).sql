-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 07:21 AM
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
  `dp_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cheese`
--

CREATE TABLE `cheese` (
  `cheese_id` int(11) NOT NULL,
  `milk_id` int(11) NOT NULL,
  `dp_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Table structure for table `dairy_product`
--

CREATE TABLE `dairy_product` (
  `dp_id` int(11) NOT NULL,
  `dp_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ice_cream`
--

CREATE TABLE `ice_cream` (
  `ice_cream_id` int(11) NOT NULL,
  `milk_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `dp_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'Whole Milk', 2.49, 'United States', '1922', 840, 2, 1),
(2, '2% Reduced-Fat Milk', 2.29, 'United States', '1970', 840, 2, 2),
(3, '1% Low-Fat Milk', 2.19, 'United States', '1983', 840, 2, 3),
(4, 'Skim Milk', 2.09, 'United States', '1979', 840, 2, 4),
(5, 'Chocolate Milk', 2.99, 'United States', '1950', 840, 2, 5),
(6, 'Soy Milk', 3.49, 'China', '1960', 156, 2, 6),
(7, 'Almond Milk', 3.99, 'United States', '1950', 840, 3, 7),
(8, 'Oat Milk', 4.49, 'Sweden', '1990', 752, 2, 8),
(9, 'Goat Milk', 5.99, 'France', '1800', 250, 5, 9),
(10, 'Camel Milk', 10.99, 'United Arab Emirates', '1980', 784, 2, 10);

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
(1, 61, 0, 20, 5, 3, 1, 0, 2),
(2, 47, 0, 10, 5, 2, 1, 0, 1),
(3, 34, 0, 5, 5, 1, 0.5, 0, 0.5),
(4, 27, 0, 2, 5, 1, 0, 0, 0),
(5, 126, 2, 35, 23, 8, 3, 0, 5),
(6, 80, 1, 0, 7, 6, 1, 3, 0.5),
(7, 160, 1, 0, 10, 8, 1, 0, 5),
(8, 130, 1, 0, 15, 3, 0, 0, 1),
(9, 69, 0, 20, 4, 5, 0, 0, 3),
(10, 50, 1, 10, 3, 3, 2, 0, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `unity_type`
--

CREATE TABLE `unity_type` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL,
  `unit_scale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD UNIQUE KEY `butter_dp_id_unique` (`dp_id`),
  ADD KEY `milk_id` (`milk_id`),
  ADD KEY `country_id` (`country_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `nutritional_value_id` (`nutritional_value_id`);

--
-- Indexes for table `cheese`
--
ALTER TABLE `cheese`
  ADD PRIMARY KEY (`cheese_id`,`milk_id`),
  ADD UNIQUE KEY `cheese_dp_id_unique` (`dp_id`),
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
-- Indexes for table `dairy_product`
--
ALTER TABLE `dairy_product`
  ADD PRIMARY KEY (`dp_id`);

--
-- Indexes for table `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD PRIMARY KEY (`ice_cream_id`,`milk_id`),
  ADD UNIQUE KEY `ice_cream_dp_id_unique` (`dp_id`),
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
  ADD UNIQUE KEY `projected_milk_production_unit_id_unique` (`unit_id`),
  ADD KEY `milk_id` (`milk_id`);

--
-- Indexes for table `unity_type`
--
ALTER TABLE `unity_type`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `butter`
--
ALTER TABLE `butter`
  MODIFY `butter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cheese`
--
ALTER TABLE `cheese`
  MODIFY `cheese_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dairy_product`
--
ALTER TABLE `dairy_product`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `milk`
--
ALTER TABLE `milk`
  MODIFY `milk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nutritional_value`
--
ALTER TABLE `nutritional_value`
  MODIFY `nutritional_value_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `projected_milk_production`
--
ALTER TABLE `projected_milk_production`
  MODIFY `pmp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unity_type`
--
ALTER TABLE `unity_type`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `butter_ibfk_4` FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value` (`nutritional_value_id`),
  ADD CONSTRAINT `butter_ibfk_5` FOREIGN KEY (`dp_id`) REFERENCES `dairy_product` (`dp_id`);

--
-- Constraints for table `cheese`
--
ALTER TABLE `cheese`
  ADD CONSTRAINT `cheese_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `cheese_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `cheese_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `cheese_ibfk_4` FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value` (`nutritional_value_id`),
  ADD CONSTRAINT `cheese_ibfk_5` FOREIGN KEY (`dp_id`) REFERENCES `dairy_product` (`dp_id`);

--
-- Constraints for table `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD CONSTRAINT `ice_cream_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `ice_cream_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`),
  ADD CONSTRAINT `ice_cream_ibfk_3` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `ice_cream_ibfk_4` FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value` (`nutritional_value_id`),
  ADD CONSTRAINT `ice_cream_ibfk_5` FOREIGN KEY (`dp_id`) REFERENCES `dairy_product` (`dp_id`);

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
  ADD CONSTRAINT `projected_milk_production_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unity_type` (`unit_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
