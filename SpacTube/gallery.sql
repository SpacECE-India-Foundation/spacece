-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2021 at 02:03 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `user` varchar(20) NOT NULL,
  `u_comment` varchar(1000) NOT NULL,
  `v_id` int(11) DEFAULT NULL,
  `c_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dislike`
--

CREATE TABLE `tbl_dislike` (
  `user` varchar(20) NOT NULL,
  `v_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_like`
--

CREATE TABLE `tbl_like` (
  `user` varchar(20) NOT NULL,
  `v_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `v_id` int(11) NOT NULL,
  `v_url` varchar(250) NOT NULL,
  `v_date` date NOT NULL,
  `v_uni_no` bigint(20) NOT NULL,
  `status` varchar(200) NOT NULL,
  `filter` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `desc` varchar(2000) NOT NULL,
  `length` varchar(20) NOT NULL,
  `cntlike` int(11) DEFAULT 0,
  `cntdislike` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`v_id`, `v_url`, `v_date`, `v_uni_no`, `status`, `filter`, `title`, `desc`, `length`, `cntlike`, `cntdislike`) VALUES
(2, 'zWkU1fwkwWg', '2020-01-03', 6837197912490141, 'free', 'technical', 'title 2', 'desc 2', '10 min', 0, 0),
(3, 'u_iKGzPZQoQ', '2020-01-23', 2284070198390204, 'free', 'r_rated', 'title 1', 'desc 3', '10 min', 0, 0),
(6, 'TWICDS-8qMs', '2020-01-24', 2784442360948059, 'created', 'technical', 'title 3', 'desc 6', '10 min', 0, 0),
(7, 'NdL-sbjIaOI', '2020-03-31', 3137821525807509, 'created', 'r_rated', 'How to Select Data from Database in PHP & Display in Table Format | PHP MySQLI Tutorial in Hindi #56', 'Welcome, How to Select, Display data from a database with PHP MySQL in Hindi. How to select data from the database in PHP and display in table format in PHP MySQLI in Hindi. These series consist of a total of 6 videos on the PHP MySQLi tutorial in Hindi.  Where we will see crud operation step by step. 1: How to create Database and Tables in PHP MySQL in Hindi 2. How to Create Connection with Database in PHP MySQL in Hindi 3. How to Insert data/values in a database with PHP MySQL in Hindi 4. How to Select/Display/View data from a database with PHP MySQL in Hindi 5. How to update table data with PHP MySQL in Hindi', '26 min', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`v_id`),
  ADD UNIQUE KEY `v_uni_no` (`v_uni_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
