-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 05:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill_section`
--

CREATE TABLE `bill_section` (
  `id` int(12) NOT NULL,
  `complainid` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `problem` varchar(50) NOT NULL,
  `uc` varchar(50) NOT NULL,
  `vs` varchar(10) NOT NULL,
  `price` int(12) NOT NULL,
  `breakup` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bill_store`
--

CREATE TABLE `bill_store` (
  `id` int(3) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `pdf` varchar(500) NOT NULL,
  `status` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `problem_store`
--

CREATE TABLE `problem_store` (
  `id` int(11) NOT NULL,
  `complainidno` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `room` varchar(50) NOT NULL,
  `finaldate` date NOT NULL,
  `problem` varchar(20) NOT NULL,
  `status` int(2) DEFAULT NULL,
  `userconf` varchar(12) NOT NULL,
  `vendorconf` varchar(12) NOT NULL,
  `expandiature` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `domain` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `usertype`, `domain`, `name`, `email`, `mobile`, `password`) VALUES
(1, 'Admin', 'CSE', 'Shibsankar Manna', 'cse19119@cemk.ac.in', '8927888654', '123');

-- --------------------------------------------------------

--
-- Table structure for table `user_vendor_confirmation`
--

CREATE TABLE `user_vendor_confirmation` (
  `id` int(11) NOT NULL,
  `jobid` varchar(12) NOT NULL,
  `name` varchar(50) NOT NULL,
  `room` varchar(10) NOT NULL,
  `problem` varchar(50) NOT NULL,
  `user_conf` varchar(50) NOT NULL,
  `vendor_conf` varchar(20) NOT NULL,
  `price` int(12) NOT NULL,
  `breakup` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill_section`
--
ALTER TABLE `bill_section`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `complainid` (`complainid`);

--
-- Indexes for table `bill_store`
--
ALTER TABLE `bill_store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pdf` (`pdf`);

--
-- Indexes for table `problem_store`
--
ALTER TABLE `problem_store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `complainidno` (`complainidno`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_vendor_confirmation`
--
ALTER TABLE `user_vendor_confirmation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jobid` (`jobid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill_section`
--
ALTER TABLE `bill_section`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_store`
--
ALTER TABLE `bill_store`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `problem_store`
--
ALTER TABLE `problem_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_vendor_confirmation`
--
ALTER TABLE `user_vendor_confirmation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
