-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 30, 2025 at 05:58 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chama`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `profilepic` varchar(40) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fname`, `lname`, `address`, `profilepic`, `contact`, `dob`, `username`, `email`, `password`, `creationdate`, `updationdate`) VALUES
(1, 'admin', 'admin', 'my address', 'istockphoto-77931645-170667a.jpg', '712345678', '', 'admin', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2019-11-14 17:36:19', '2025-07-24 18:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `credit`
--

DROP TABLE IF EXISTS `credit`;
CREATE TABLE IF NOT EXISTS `credit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mid` int NOT NULL,
  `amount` float NOT NULL,
  `balance` float NOT NULL,
  `refno` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `source` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `credit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `credit`
--

INSERT INTO `credit` (`id`, `mid`, `amount`, `balance`, `refno`, `source`, `credit_date`, `status`) VALUES
(1, 11, 1600, 100, 'erff', 'total savings', '2022-06-17 00:00:00', 1),
(4, 12, 666, 222, 'ess', 'payments', '2022-06-19 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `debit`
--

DROP TABLE IF EXISTS `debit`;
CREATE TABLE IF NOT EXISTS `debit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mid` int NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `refno` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `source` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `debit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `debit`
--

INSERT INTO `debit` (`id`, `mid`, `amount`, `refno`, `source`, `debit_date`, `status`) VALUES
(1, 4, 1111, 'daada', 'payments', '2022-06-17 11:22:01', 1),
(3, 6, 300, 'dfs', 'total savings', '2022-06-19 10:50:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `investment`
--

DROP TABLE IF EXISTS `investment`;
CREATE TABLE IF NOT EXISTS `investment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `details` varchar(10000) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `refno` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investment`
--

INSERT INTO `investment` (`id`, `details`, `amount`, `date`, `refno`) VALUES
(3, 'aaaaaaaaaaaaaaaaad', 2904, '2022-07-20 00:00:00', 'ddddd');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
CREATE TABLE IF NOT EXISTS `loans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `refno` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `userid` int NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `type` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `status` int NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `refno`, `userid`, `amount`, `type`, `due_date`, `status`, `created_date`) VALUES
(21, 'hyrffhggo', 20, 600, '6', '2025-07-31 00:00:00', 0, '2022-07-20 04:50:54'),
(22, 'nbbg', 10, 800, '6', '2022-07-20 00:00:00', 0, '2022-07-20 05:20:01'),
(23, '', 20, 300, '6', NULL, 3, '2022-07-20 05:24:57'),
(24, '', 20, 300, '6', NULL, 1, '2022-07-20 05:25:37'),
(25, '', 20, 800, '6', NULL, 1, '2022-07-20 05:31:57'),
(26, 'xxxx', 20, 778, '6', '2025-07-24 00:00:00', 0, '2025-07-24 21:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `pay_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `balance` float NOT NULL,
  `pay_type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `refno` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `userid`, `amount`, `pay_date`, `balance`, `pay_type`, `refno`, `status`) VALUES
(11, 20, 1000, '2022-07-20 00:00:00', 0, 'contributions', 'dDsA', 0),
(12, 20, 1000, '2022-07-20 00:00:00', 0, 'Shares', 'dDsA', 1),
(13, 20, 1000, '2022-07-20 00:00:00', 0, 'contributions', 'tffgggg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
CREATE TABLE IF NOT EXISTS `plans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `terms` varchar(10000) COLLATE utf8mb4_general_ci NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `type`, `terms`, `creationdate`, `status`) VALUES
(6, 'Emergency Loan', 'Payment Within 12 weeks after loan credited to client', '2022-07-20 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `savings`
--

DROP TABLE IF EXISTS `savings`;
CREATE TABLE IF NOT EXISTS `savings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `username` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `refno` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `pay_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `savings`
--

INSERT INTO `savings` (`id`, `userid`, `username`, `refno`, `amount`, `pay_date`, `status`, `created_date`) VALUES
(67, 20, 'felo felo', 'css', 200, '2022-07-20 06:13:06', 0, '2022-07-20 00:00:00'),
(71, 20, 'felo felo', 'hjhjftfhgfoo', 600, '2022-07-20 06:26:42', 1, '2022-07-20 00:00:00'),
(72, 20, '', 'uuuuuu', 900, '2025-07-24 21:56:01', 0, '2025-07-24 18:56:01'),
(73, 20, '', 'wervcftyy', 1000, '2025-07-27 17:35:15', 0, '2025-07-27 14:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `kin` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `status` int DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updationdate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `profilepic` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `username`, `dob`, `address`, `kin`, `password`, `contact`, `status`, `creationdate`, `updationdate`, `profilepic`) VALUES
(20, 'Test', 'Test', 'test@gmail.com', 'test', '12/14/2022', '148-Kericho', 'hghghgtr', '5dd1e33dd7e4b1f9a4edc3fcb2520ab0', '712345678', 1, '2022-06-20 13:53:46', '2023-01-08 11:15:39', 'istockphoto-77931645-170667a.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
