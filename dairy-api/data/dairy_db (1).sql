-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2023 at 09:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP SCHEMA IF EXISTS dairy_db;
CREATE SCHEMA dairy_db;
USE dairy_db;
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
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `nutrition_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cheese`
--

CREATE TABLE `cheese` (
  `cheese_id` int(11) NOT NULL,
  `milk_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `dp_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutrition_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `population` int(11) NOT NULL,
  `area_sq_mile` float NOT NULL,
  `population_density_sq_mile` float NOT NULL,
  `gdp_perCapita` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dairy_product`
--

CREATE TABLE `dairy_product` (
  `dp_id` int(11) NOT NULL,
  `dp_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `nutrition_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `milk`
--

CREATE TABLE `milk` (
  `milk_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `average_cost` float NOT NULL,
  `place_of_origin` varchar(50) NOT NULL,
  `year_created` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutrition_value_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nutritional_value`
--

CREATE TABLE `nutritional_value` (
  `nutr_val_id` int(11) NOT NULL,
  `kcal` float NOT NULL,
  `fiber` float NOT NULL,
  `cholesterol` float NOT NULL,
  `carbohydrate` float NOT NULL,
  `protein` float NOT NULL,
  `monosat_fat` float NOT NULL,
  `polysat_fat` float NOT NULL,
  `sat_fat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `milk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  ADD KEY `dp_id` (`dp_id`,`country_id`,`brand_id`,`nutrition_value_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `cheese`
--
ALTER TABLE `cheese`
  ADD PRIMARY KEY (`cheese_id`,`milk_id`),
  ADD KEY `milk_id` (`milk_id`),
  ADD KEY `dp_id` (`dp_id`,`country_id`,`brand_id`,`nutrition_value_id`);

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
  ADD KEY `milk_id` (`milk_id`),
  ADD KEY `dp_id` (`dp_id`,`country_id`,`brand_id`,`nutrition_value_id`);

--
-- Indexes for table `milk`
--
ALTER TABLE `milk`
  ADD PRIMARY KEY (`milk_id`),
  ADD KEY `country_id` (`country_id`,`brand_id`,`nutrition_value_id`);

--
-- Indexes for table `nutritional_value`
--
ALTER TABLE `nutritional_value`
  ADD PRIMARY KEY (`nutr_val_id`);

--
-- Indexes for table `projected_milk_production`
--
ALTER TABLE `projected_milk_production`
  ADD PRIMARY KEY (`pmp_id`),
  ADD KEY `milk_id` (`milk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dairy_product`
--
ALTER TABLE `dairy_product`
  MODIFY `dp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ice_cream`
--
ALTER TABLE `ice_cream`
  MODIFY `ice_cream_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `milk`
--
ALTER TABLE `milk`
  MODIFY `milk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nutritional_value`
--
ALTER TABLE `nutritional_value`
  MODIFY `nutr_val_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projected_milk_production`
--
ALTER TABLE `projected_milk_production`
  MODIFY `pmp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `butter`
--
ALTER TABLE `butter`
  ADD CONSTRAINT `butter_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `butter_ibfk_2` FOREIGN KEY (`dp_id`) REFERENCES `dairy_product` (`dp_id`),
  ADD CONSTRAINT `butter_ibfk_3` FOREIGN KEY (`nutrition_value_id`) REFERENCES `nutritional_value` (`nutrition_value_id`),
  ADD CONSTRAINT `butter_ibfk_4` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `butter_ibfk_5` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `cheese`
--
ALTER TABLE `cheese`
  ADD CONSTRAINT `cheese_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `cheese_ibfk_2` FOREIGN KEY (`dp_id`) REFERENCES `dairy_product` (`dp_id`),
  ADD CONSTRAINT `cheese_ibfk_3` FOREIGN KEY (`nutrition_value_id`) REFERENCES `nutritional_value` (`nutrition_value_id`),
  ADD CONSTRAINT `cheese_ibfk_4` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `cheese_ibfk_5` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `ice_cream`
--
ALTER TABLE `ice_cream`
  ADD CONSTRAINT `ice_cream_ibfk_1` FOREIGN KEY (`milk_id`) REFERENCES `milk` (`milk_id`),
  ADD CONSTRAINT `ice_cream_ibfk_2` FOREIGN KEY (`dp_id`) REFERENCES `dairy_product` (`dp_id`),
  ADD CONSTRAINT `ice_cream_ibfk_3` FOREIGN KEY (`nutrition_value_id`) REFERENCES `nutritional_value` (`nutrition_value_id`),
  ADD CONSTRAINT `ice_cream_ibfk_4` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`),
  ADD CONSTRAINT `ice_cream_ibfk_5` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
