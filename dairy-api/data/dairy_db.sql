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
-- Table structure for table `nutritional_value`
--

CREATE TABLE `nutritional_value` (
  `nutritional_value_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kcal` float NOT NULL,
  `cholesterol` float NOT NULL,
  `carbohydrate` float NOT NULL,
  `protein` float NOT NULL,
  `monosat_fat` float NOT NULL,
  `polysat_fat` float NOT NULL,
  `sat_fat` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `country_name` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `population` int(11) NOT NULL,
  `area_sq_mile` float NOT NULL,
  `population_density_sq_mile` float NOT NULL,
  `gdp_perCapita` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `brand_name` varchar(50) NOT NULL,
  `country_id` int,
  FOREIGN KEY (`country_id`) REFERENCES `country`(`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Table structure for table `milk`
--

CREATE TABLE `milk` (
  `milk_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `average_cost` float NOT NULL,
  `place_of_origin` varchar(50) NOT NULL,
  `year_created` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL,
  FOREIGN KEY (`country_id`) REFERENCES `country`(`country_id`),
  FOREIGN KEY (`brand_id`) REFERENCES `brand`(`brand_id`),
  FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value`(`nutritional_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `butter`
--

CREATE TABLE `butter` (
  `butter_id` int(11) NOT NULL AUTO_INCREMENT,
  `milk_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL,
  PRIMARY KEY (`butter_id`, `milk_id`),
  FOREIGN KEY (`milk_id`) REFERENCES `milk`(`milk_id`),
  FOREIGN KEY (`country_id`) REFERENCES `country`(`country_id`),
  FOREIGN KEY (`brand_id`) REFERENCES `brand`(`brand_id`),
  FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value`(`nutritional_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cheese`
--

CREATE TABLE `cheese` (
  `cheese_id` int(11) NOT NULL AUTO_INCREMENT,
  `milk_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `nutritional_value_id` int(11) NOT NULL,
  PRIMARY KEY (`cheese_id`, `milk_id`),
  FOREIGN KEY (`milk_id`) REFERENCES `milk`(`milk_id`),
  FOREIGN KEY (`country_id`) REFERENCES `country`(`country_id`),
  FOREIGN KEY (`brand_id`) REFERENCES `brand`(`brand_id`),
  FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value`(`nutritional_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

-- --------------------------------------------------------
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
  `nutritional_value_id` int(11) NOT NULL,
  PRIMARY KEY (`ice_cream_id`, `milk_id`),
  FOREIGN KEY (`milk_id`) REFERENCES `milk`(`milk_id`),
  FOREIGN KEY (`country_id`) REFERENCES `country`(`country_id`),
  FOREIGN KEY (`brand_id`) REFERENCES `brand`(`brand_id`),
  FOREIGN KEY (`nutritional_value_id`) REFERENCES `nutritional_value`(`nutritional_value_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `projected_milk_production`
--

CREATE TABLE `projected_milk_production` (
  `pmp_id` int(11) NOT NULL  AUTO_INCREMENT PRIMARY KEY,
  `year` year(4) NOT NULL,
  `type` varchar(100) NOT NULL,
  `production` float NOT NULL,
  `consumption` float NOT NULL,
  `price` float NOT NULL,
  `milk_id` int(11) NOT NULL,
  FOREIGN KEY (`milk_id`) REFERENCES `milk`(`milk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

