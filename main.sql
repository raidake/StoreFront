-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2018 at 02:53 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `item_id` int(4) NOT NULL,
  `quantity` int(4) DEFAULT '0',
  `COSTPRICE` float DEFAULT '0',
  `DETAILS` varchar(255) DEFAULT NULL,
  `user_id` int(4) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `captcha_verify` varchar(8) NOT NULL,
  `otp_verify` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retailers`
--

INSERT INTO `retailers` (`retails_ID`, `username`, `hash`, `company_Name`, `e-mail`, `phone_Number`, `address`, `description`, `captcha_verify`, `otp_verify`) VALUES
(1, 'drugdealer', '$2y$11$hO2QEjIdJlxxHBg2H30jFep8.00seuD3vinsDcdJt/rWmmz8135ni', 'Legal Drugs', 'idontsellweed@ido.com', 84206969, 'Backstreet Boys Avenue 2', 'We totally sell legal drugs', '', 0),
(6, 'CoolMeister', '$2y$11$8W98sHq0/VlKrCQgiiig7O6TLb.uDMssbmn/fNz/46cbfXswTR9aO', 'Cool Hats Co.', 'coomeister69@gmail.com', 81882341, 'Paya Lebar MRT Station', 'We sell cool hats to people.', '', 0),
(7, 'Alfrodo', '$2y$11$fHcEVe8TO7Xjfhmbnka1nOjoLJLf/o.XJ.OMC82tb5CBhFXJnG2o2', 'Gun Shop', 's0m3gay@cupid.com', 99994444, 'Simei MRT Station', ' We sell Banks', '', 0),
(8, 'R', '$2y$11$FH4hUqTZmA.imu3rOw6dae6QofEfiJGEW1.ymtRjxEBTl653saV0W', 'RR', 'R@R.c', 12345678, '2 R A', 'qwertyu', '', 0),
(9, 'weifeng', '$2y$11$cWN4VLP1gcqybm1niLtbqed7wMlqb0VjYrIvnJAw3XKwAKyMps3.K', 'Wei Feng and Co.', 'weifeng420@gmail.net', 93322211, 'Hougangragoon ave 30', 'A small business', '', 0),
(10, 'ethanheng', '$2y$11$mIjTulF8qia6Nu2pi49nF.EyMUavvyJzXlWbWPkTyLPGRMv29il.G', 'Doge Memes Co.', 'ethanheng@outlook.com', 93321554, 'Serangoon Avenue 5', 'We sell Doge.', '', 0);

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
  `image` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_Name`, `last_Name`, `gender`, `age`, `birthday`, `address`, `contact`, `email`, `hash`, `active`, `captcha_verify`, `otp_verify`) VALUES
(1, 'Jackie', 'Chan', 'Male', 54, '2018-01-08', 'Hong Kong', 91837481, 'jacki_chan@gmail.com', '$2y$11$fmIjYcIexiezavMY5aclsuwL0BjytBSKbGCTi.g/U6jzg.juDVaRO', 1, '', 0),
(2, 'Jackie', 'Chan', 'Male', 54, '2018-01-08', 'Hong Kong', 91837481, 'jacki_chan@gmail.com', '$2y$11$fmIjYcIexiezavMY5aclsuwL0BjytBSKbGCTi.g/U6jzg.juDVaRO', 1, '', 0),
(3, 'Cackie ', 'Jhan', 'Male', 999, '2018-01-10', 'China', 98412516, 'cackie@gmail.com', '$2y$11$tvUO7M4RBKh07TLPvNv00elmFBUn2leOcbpnkj4/CvEGheZfZTIza', 1, '0', 0),
(4, 'Cackie ', 'Jhan', 'Male', 999, '2018-01-10', 'China', 98412516, 'cackie@gmail.com', '$2y$11$tvUO7M4RBKh07TLPvNv00elmFBUn2leOcbpnkj4/CvEGheZfZTIza', 1, '0', 0),
(5, 'Blackie ', 'Chan', 'Female', 111, '2018-01-17', 'Taiwan', 67215261, 'blackie@gmail.com', '$2y$11$Q3A4CeppOZ4yMhGJpxm1jOY6PwMx1eMr6qyuGBw0hW9R4Nogw0mcK', 1, '0', 0),
(6, 'Mackie', 'Bhan', 'Female', 431, '2018-01-11', 'Singapore', 67215265, 'mackie@live.com', '$2y$11$tB24EsaEmuOMqibqq9/SROaJpmRH4DlGcXtZgaug.UhEvQdz/gRKe', 1, '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`item_id`,`user_id`,`date`),
  ADD KEY `order_ibfk_2` (`user_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `retailers`
--
ALTER TABLE `retailers`
  MODIFY `retails_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `retail_items`
--
ALTER TABLE `retail_items`
  MODIFY `item_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
