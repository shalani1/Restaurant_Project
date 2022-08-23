-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2022 at 05:31 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

DROP TABLE IF EXISTS `foods`;
CREATE TABLE IF NOT EXISTS `foods` (
  `food_id` int(11) NOT NULL AUTO_INCREMENT,
  `food_name` varchar(255) NOT NULL,
  `price` decimal(5,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`food_id`),
  KEY `users_foods_fk` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`food_id`, `food_name`, `price`, `user_id`) VALUES
(1, 'Fried Papadum with Mango Chutney', '200', 1),
(2, 'Whole-grain waffles', '450', 1),
(3, 'Kottu Roti - Vegetable', '450', 1),
(4, 'Kottu Rotti - Mixed Meat or Sea Food', '700', 1),
(5, 'Traditional Paddy Field Style Plated Meal', '500', 1),
(11, 'Whole-grain flour tortillas', '200', 1),
(12, 'Skinless chicken or turkey breasts', '350', 1),
(13, 'Brown rice', '300', 1),
(14, 'Whole wheat or whole-grain pasta', '400', 1),
(15, 'Steel-cut or instant oatmeal', '290', 1),
(16, 'Low-sodium soups and broths', '250', 1),
(17, 'Black, kidney, soy, or garbanzo beans; lentils, split peas', '350', 1),
(18, 'Pre-portioned, low-fat ice cream or frozen yogurt', '300', 1),
(19, 'Low-fat cheese or string cheese snacks', '150', 1),
(20, 'Whole-grain crackers', '200', 1),
(21, 'Dark chocolate pieces', '100', 1),
(22, 'Peanut butter, almond, or soy butter', '300', 1),
(23, 'Sparkling water', '190', 1),
(24, 'Skim or low-fat milk or soymilk', '450', 1),
(27, 'Biriyani', '590', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(50) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `code` (`code`),
  KEY `user_order_fk` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `code`, `order_date`, `total_price`, `user_id`) VALUES
(1, 1968064195, '2022-07-23 10:18:51', '740', 3),
(2, 1974027595, '2022-07-23 11:00:46', '550', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_foods`
--

DROP TABLE IF EXISTS `order_foods`;
CREATE TABLE IF NOT EXISTS `order_foods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(50) NOT NULL,
  `food_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`food_id`),
  KEY `order_order_foods_fk` (`code`),
  KEY `foods_order_foods_fk` (`food_id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_foods`
--

INSERT INTO `order_foods` (`id`, `code`, `food_id`) VALUES
(1, 1968064195, 15),
(2, 1968064195, 3),
(3, 1974027595, 21),
(4, 1974027595, 24);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_in` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `role`, `username`, `password`, `created_in`) VALUES
(1, 'Shalani Malsha', 'Admin', 'shalani', 'A1234', '2022-07-16 16:59:06'),
(2, 'Hansika Madumal', 'Waiter', 'Hansika', '1111', '2022-07-16 16:59:06'),
(3, 'Manu Siriwardhane', 'Waiter', 'manu', '234', '2022-07-16 16:59:06'),
(4, 'Dilusha Pawan', 'Waiter', 'dilusha', '338', '2022-07-16 16:59:06'),
(5, 'Manuk Wihanga', 'Waiter', 'manuk', '999', '2022-07-20 10:03:52');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `users_foods_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `user_order_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_foods`
--
ALTER TABLE `order_foods`
  ADD CONSTRAINT `foods_order_foods_fk` FOREIGN KEY (`food_id`) REFERENCES `foods` (`food_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_order_foods_fk` FOREIGN KEY (`code`) REFERENCES `orders` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
