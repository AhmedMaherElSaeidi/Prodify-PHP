-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: sql.freedb.tech
-- Generation Time: Jul 06, 2024 at 04:01 PM
-- Server version: 8.0.37
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodifydb`
--
CREATE DATABASE IF NOT EXISTS `prodifydb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `prodifydb`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int NOT NULL,
  `sku` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(10, 'DVD123', 'Great Movie', 19.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(11, 'BOOK123', 'Interesting Book', 9.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(13, 'FURN123', 'Wooden Chair', 49.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(15, 'BOOK124', 'Interesting Book', 9.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(16, 'DVD456', 'Great Movie', 19.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(17, 'FURN789', 'Comfortable Chair', 89.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(18, 'BOOK456', 'Science Fiction', 14.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(19, 'DVD789', 'Action Movie', 24.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(22, 'FURN12', 'Modern Sofa', 19.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(23, 'BOOK789', 'Adventure Novel', 12.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(24, 'DVD13', 'Comedy Special', 15.99);
INSERT INTO `products` (`id`, `sku`, `name`, `price`) VALUES(25, 'FURN456', 'Dining Table', 149.99);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

DROP TABLE IF EXISTS `product_attributes`;
CREATE TABLE `product_attributes` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `attribute_name` enum('DVD','Book','Furniture') NOT NULL,
  `attribute_value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(9, 10, 'DVD', '120');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(10, 11, 'Book', '0.5');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(12, 13, 'Furniture', '15x15x30');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(13, 15, 'Book', '0.5');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(14, 16, 'DVD', '120');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(15, 17, 'Furniture', '40x40x90');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(16, 18, 'Book', '0.7');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(17, 19, 'DVD', '150');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(19, 22, 'Furniture', '200x90x75');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(20, 23, 'Book', '0.6');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(21, 24, 'DVD', '90');
INSERT INTO `product_attributes` (`id`, `product_id`, `attribute_name`, `attribute_value`) VALUES(22, 25, 'Furniture', '120x75x75');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_ibfk_1` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
