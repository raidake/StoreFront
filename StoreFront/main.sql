-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2018 at 05:19 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

CREATE DATABASE main;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `main`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `item_ID` int(3) NOT NULL,
  `user_ID` int(4) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`item_ID`, `user_ID`, `comment`, `timestamp`) VALUES
(2, 1, 'I use it daily', '2018-01-24 18:42:35'),
(2, 1, 'I really like this\r\n', '2018-01-24 19:31:21'),
(2, 1, 'I am not a bot :^)', '2018-01-24 19:31:26'),
(2, 1, 'Nice meme', '2018-01-24 19:31:29'),
(2, 1, 'Its not worth 1/5 pls reduce price', '2018-01-25 05:43:07'),
(2, 1, 'dfsklf;os', '2018-01-25 07:44:11'),
(2, 3, 'Stop logging in', '2018-01-31 02:15:10'),
(3, 3, 'Nice chocolate', '2018-01-31 02:40:44'),
(5, 1, 'It really floats!', '2018-01-25 05:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `user_id` int(4) NOT NULL,
  `first_Name` varchar(25) DEFAULT NULL,
  `last_Name` varchar(25) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `contact` int(8) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `captcha_verify` varchar(8) NOT NULL,
  `otp_verify` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `first_Name`, `last_Name`, `gender`, `age`, `birthday`, `address`, `contact`, `email`, `hash`, `active`, `captcha_verify`, `otp_verify`) VALUES
(1, 'Jackie', 'Chan', 'Male', 54, '2018-01-08', 'Hong Kong', 91837481, 'keith_teo@outlook.sg', '$2y$11$yLBU6UapqZsl9dJkliUb4OYv.taWWd8WM5ZHK6tiGLRIV8/GSSLny', 1, '', 0),
(2, 'Jackie', 'Chan', 'Male', 54, '2018-01-08', 'Hong Kong', 91837481, 'jacki_chan@gmail.com', '$2y$11$ZDqhXjRdKXH4.A6e6Y51l.f1VKDarnwpK0IpNGgyV2tiy.fqhWTRe', 1, '', 0),
(3, 'Cackie ', 'Jhan', 'Male', 999, '2018-01-10', 'China', 98412516, 'cackie@gmail.com', '$2y$11$HBAQXdQvnX9/y7VKtl22L.m5G.vPpsxLjK3KVsyFogAQv1u7R09uy', 1, '0', 0),
(4, 'Cackie ', 'Jhan', 'Male', 999, '2018-01-10', 'China', 98412516, 'cackie@gmail.com', '$2y$11$VybUD8O/m2EM.88wnb1yzeVSaSIWGpY3vhW2BGoBum9QoUOoBlDTW', 1, '0', 0),
(5, 'Blackie ', 'Chan', 'Female', 111, '2018-01-17', 'Taiwan', 67215261, 'blackie@gmail.com', '$2y$11$N/uJtpDqyWkm0LkmPV5lveegDE1WdR3UElPcypO1Lq02rkeRqxJXy', 1, '0', 0),
(6, 'Mackie', 'Bhan', 'Female', 431, '2018-01-11', 'Singapore', 67215265, 'mackie@live.com', '$2y$11$rUN3Rw2jyieeDYGiuy9jueQGsTTqcybfNkaqoh8mwdgWbLJMQB65a', 1, '0', 0),
(8, 'test', 'test', 'Male', 0, '2018-01-25', 'SINGAPORE', 98767898, 'marcus_goh25@hotmail.com', '$2y$11$SyMFBlTnWyIOoI5toPCC.ud8.p07SaH0yD2LFm/su/mg3e9JY7VzO', 0, '1714840', 8384018),
(9, 'test', 'test', 'Male', 0, '2018-01-06', 'SINGAPORE', 97867897, 'test@test.com', '$2y$11$lg31aGKPtBQ/M4doAyhAAeekbpc1Wlw2Yq/n.fXONyUeedsPt8BE6', 0, '9814308', 0);

-- --------------------------------------------------------

--
-- Table structure for table `retailers`
--

CREATE TABLE `retailers` (
  `retails_ID` int(5) NOT NULL,
  `username` varchar(15) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `company_Name` varchar(100) NOT NULL,
  `e-mail` varchar(254) NOT NULL,
  `phone_Number` int(8) NOT NULL,
  `address` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `active` int(1) NOT NULL,
  `captcha_verify` varchar(8) NOT NULL,
  `otp_verify` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retailers`
--

INSERT INTO `retailers` (`retails_ID`, `username`, `hash`, `company_Name`, `e-mail`, `phone_Number`, `address`, `description`, `active`, `captcha_verify`, `otp_verify`) VALUES
(1, 'drugdealer', '$2y$11$0CzcR5h0f5Ql/dbJIe7xLO2aDoNNV3JI/4YEhGXwqw.7U4bIr1Q/C', 'Legal Drugs', 'keith_teo@outlook.sg', 84206969, 'Backstreet Boys Avenue 2', 'We totally sell legal drugs', 1, '3835705', 2294819),
(6, 'CoolMeister', '$2y$11$Jct5Yks34hCOpSJoQakFouJVb3vmxgUgCE6/zmZdoQpXcK2d5AzOK', 'Cool Hats Co.', 'coomeister69@gmail.com', 81882341, 'Paya Lebar MRT Station', 'We sell cool hats to people.', 0, '', 0),
(7, 'Alfrodo', '$2y$11$AHCxHbbC6PXzg8rVdoTNBeFwN2nmjZeeCbkXM9tToNJkIf1GRFKgK', 'Gun Shop', 's0m3gay@cupid.com', 99994444, 'Simei MRT Station', ' We sell Banks', 0, '', 0),
(8, 'R', '$2y$11$K41CQFjn1sE8wjIAFBydt.viAqNNUtmCzRnwYNGARtlHrurv9Drp6', 'RR', 'R@R.c', 12345678, '2 R A', 'qwertyu', 0, '', 0),
(9, 'weifeng', '$2y$11$dDEK2ASfr53DLRi2EmKWxuGwHOBJHviG7Ovz/yAKj9fS9ymaM6ivO', 'Wei Feng and Co.', 'weifeng420@gmail.net', 93322211, 'Hougangragoon ave 30', 'A small business', 0, '', 0),
(10, 'ethanheng', '$2y$11$EdQEz4j0ljeguoNIyqO6bu8j50aTFNMvfeTKvP8k/Z/CE0q.zE6Ae', 'Doge Memes Co.', 'ethanheng@outlook.com', 93321554, 'Serangoon Avenue 5', 'We sell Doge.', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `retail_items`
--

CREATE TABLE `retail_items` (
  `item_ID` int(3) NOT NULL,
  `item_Name` varchar(30) NOT NULL,
  `item_Description` varchar(100) NOT NULL,
  `item_Cost` decimal(65,2) NOT NULL,
  `retails_ID` int(3) NOT NULL,
  `stock` int(5) NOT NULL,
  `image` varchar(100) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retail_items`
--

INSERT INTO `retail_items` (`item_ID`, `item_Name`, `item_Description`, `item_Cost`, `retails_ID`, `stock`, `image`, `active`) VALUES
(2, 'Iman', 'Iman is a fake', '5.00', 1, 0, '/StoreFront/Retailers/images/i_have_no_life.jpg', 1),
(3, 'Rich Chocolate', 'This is real authentic chocolate.', '25.00', 1, 300, '/StoreFront/Retailers/images/chocolate-plain.png', 1),
(4, 'Tupperware Containers', 'Waterproof. 500cm^3', '5.00', 1, 500, '/StoreFront/Retailers/images/280-tupperware-original-imae7w8hrg9uvyzw.jpeg', 1),
(5, 'Red Balloons', 'it floats.', '0.50', 1, 145, '/StoreFront/Retailers/images/174788.jpg', 1),
(6, 'sun', 'the sun', '491.00', 1, 111, '/StoreFront/Retailers/images/wallsun.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`item_ID`,`user_ID`,`timestamp`),
  ADD KEY `user_id` (`user_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `retailers`
--
ALTER TABLE `retailers`
  ADD PRIMARY KEY (`retails_ID`);

--
-- Indexes for table `retail_items`
--
ALTER TABLE `retail_items`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `retails_ID` (`retails_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `retailers`
--
ALTER TABLE `retailers`
  MODIFY `retails_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `retail_items`
--
ALTER TABLE `retail_items`
  MODIFY `item_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `item_id` FOREIGN KEY (`item_ID`) REFERENCES `retail_items` (`item_ID`),
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_ID`) REFERENCES `customers` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
