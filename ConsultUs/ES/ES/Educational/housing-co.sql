-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2021 at 04:35 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `housing-co`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `cardrent`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `cardrent`;
CREATE TABLE IF NOT EXISTS `cardrent` (
`city` varchar(100)
,`flat_id` int
,`image` varchar(500)
,`location` varchar(100)
,`rent_amount` int
,`time` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `cardsale`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `cardsale`;
CREATE TABLE IF NOT EXISTS `cardsale` (
`city` varchar(100)
,`flat_id` int
,`image` varchar(500)
,`location` varchar(100)
,`time` timestamp
,`totalcost` double
);

-- --------------------------------------------------------

--
-- Table structure for table `feedbackbuilder`
--

DROP TABLE IF EXISTS `feedbackbuilder`;
CREATE TABLE IF NOT EXISTS `feedbackbuilder` (
  `val` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `question` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedbackuser`
--

DROP TABLE IF EXISTS `feedbackuser`;
CREATE TABLE IF NOT EXISTS `feedbackuser` (
  `val` int NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `question` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbackuser`
--

INSERT INTO `feedbackuser` (`val`, `name`, `email`, `question`) VALUES
(2, 'Jaydeep', 'jv@gmail.com', 'hkajhfkjsdf'),
(8, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `flat`
--

DROP TABLE IF EXISTS `flat`;
CREATE TABLE IF NOT EXISTS `flat` (
  `flat_id` int NOT NULL AUTO_INCREMENT,
  `uid` int DEFAULT NULL,
  `bid` int DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `amenities` varchar(500) NOT NULL,
  `area` double NOT NULL,
  `image` varchar(500) NOT NULL,
  `image1` varchar(500) NOT NULL,
  `image2` varchar(500) NOT NULL,
  `image3` varchar(500) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`flat_id`),
  UNIQUE KEY `address` (`location`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flat`
--

INSERT INTO `flat` (`flat_id`, `uid`, `bid`, `location`, `city`, `description`, `amenities`, `area`, `image`, `image1`, `image2`, `image3`, `time`) VALUES
(1, 1, NULL, 'Andheri', 'Mumbai', 'Best flat', 'Swimming pool', 450, 'img/img5.jpg', 'img/img5.jpg', 'img/img5.jpg', 'img/img5.jpg', '2019-04-15 03:27:48'),
(2, 1, NULL, 'Mira road', 'Mumbai', 'Near Station', 'gym and parking', 500, 'img/img10.jpg', 'img/img10.jpg', 'img/img10.jpg', 'img/img10.jpg', '2019-04-15 03:30:16'),
(3, 1, NULL, 'Borivali', 'Mumbai', 'Awesome', 'Best parking', 450, 'img/img16.jpg', 'img/img16.jpg', 'img/img16.jpg', 'img/img16.jpg', '2019-04-15 03:33:16'),
(4, 1, NULL, 'Virar', 'Mumbai', 'Near station', 'Gym and pool', 450, 'img/img18.jpg', 'img/img18.jpg', 'img/img18.jpg', 'img/img18.jpg', '2019-04-15 03:34:39'),
(6, 1, NULL, 'Malad', 'Mumbai', 'Very awesome flat', 'Swimming Pool', 550, 'img/img10.jpg', 'img/img10.jpg', 'img/img10.jpg', 'img/img10.jpg', '2019-04-15 05:27:52'),
(7, NULL, 5, 'Pune', 'Kanyakumari', 'sdzvss', 'svv', 75757, 'gggg', 'gg', 'gg', 'gg', '2021-06-29 08:47:49'),
(9, 4, NULL, 'Lucknow corporation', 'Lucknow', 'sdzvss', 'svv', 75757, 'gggg', 'gg', 'gg', 'gg', '2021-06-30 07:22:34'),
(11, 4, NULL, 'qq', 'aa', 'sdzvss', 'svv', 75757, 'gggg', 'gg', 'gg', 'gg', '2021-06-30 07:34:41'),
(15, NULL, 11, 'ww', 'rr', 'sdzvss', 'svv', 75757, 'gggg', 'gg', 'gg', 'gg', '2021-06-30 07:57:21'),
(16, NULL, 5, 'er', 'er', 'sdzvss', 'svv', 75757, 'gggg', 'gg', 'gg', 'gg', '2021-06-30 08:02:21'),
(21, NULL, 14, 'asd', 'asd', 'sdzvss', 'svv', 75757, 'gggg', 'gg', 'gg', 'gg', '2021-06-30 11:29:03'),
(25, NULL, 4, 'ss', 'ss', 'sdzvss', 'svv', 75757, 'gggg', 'gg', 'gg', 'gg', '2021-07-01 04:47:17'),
(28, NULL, 19, 'hj', 'hj', 'sdzvss', 'svv', 75757, 'gggg', 'Female', '17/03/2000', '34Months', '2021-07-01 05:15:34'),
(31, NULL, 4, 'qwe', 'qwe', 'sdzvss', 'svv', 123, 'gggg', 'Female', '17/03/2000', '34Months', '2021-07-01 12:57:15'),
(32, NULL, 4, 'kk', 'kk', 'sdzvss', 'svv', 75757, 'gggg', 'Female', '17/03/2000', '34Months', '2021-07-02 04:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `UID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` decimal(10,0) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UID`, `username`, `password`, `name`, `email`, `phone`) VALUES
(1, 'manassinkar', 'manas12345', 'Manas', 'manas.sinkar@gmail.com', '9022942188'),
(2, 'jaydeep', 'jaydeep12345', 'Jaydeep', 'jaydeep@gmail.com', '9854545452'),
(3, 'parththosani', 'parth12345', 'Parth', 'parth@gmail.com', '9854512541'),
(4, 'sangeeta08', '1a2s3d4f5g', 'Sangeeta', 'sangeetamalviya08@gmail.com', '8888888888'),
(5, 'sangeeta08', '1234567890', 'Sangeeta', 'sangeetamalviya08@gmail.com', '8787878787'),
(6, 'sangeeta08', '1a2s3d4f5g', 'Ashok', 'sangeetamalviya08@gmail.com', '8888888888'),
(7, 'sangeeta081', '1a2s3d4f5g', 'sang', 'sangeetamalviya08@gmail.com', '8888888888'),
(8, 'sangeeta080', '1a2s3d4f5g', 'Sangeeta', 'sangeetamalviya08@gmail.com', '8888888888'),
(9, 'admin', '1a2s3d4f5g', 'Sangeeta', 'sangeetamalviya08@gmail.com', '8888888888'),
(10, 'sangeeta08', '1234567890', 'Sangeeta', 'sangeetamalviya08@gmail.com', '8888888888');

-- --------------------------------------------------------

--
-- Table structure for table `login_builder`
--

DROP TABLE IF EXISTS `login_builder`;
CREATE TABLE IF NOT EXISTS `login_builder` (
  `BID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `lno` int NOT NULL,
  `password` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `phoneno` decimal(10,0) NOT NULL,
  `cat2` varchar(30) NOT NULL,
  `cat3` varchar(30) NOT NULL,
  `cat4` varchar(30) NOT NULL,
  PRIMARY KEY (`BID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_builder`
--

INSERT INTO `login_builder` (`BID`, `username`, `lno`, `password`, `emailid`, `phoneno`, `cat2`, `cat3`, `cat4`) VALUES
(1, 'manasbuilder', 12345, 'manas12345', 'manas@gmail.com', '9022942188', '', '', ''),
(2, 'jaydeep', 56789, 'jaydeep12345', 'jaydeep@gmail.com', '9565112574', '', '', ''),
(3, 'parthbuilder', 13579, 'parth12345', 'parth@gmail.com', '9885846564', '', '', ''),
(4, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', '', '', ''),
(5, 'sangeeta080', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(6, 'lalit', 2147483647, '1234567890', 'sangeetamalviya08@gmail.com', '8765423456', 'jnefna', 'bhd', 'mbkb'),
(7, 'sng00', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(8, 'sq1', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(9, 'saf1', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8787878787', 'jnefna', 'bhd', 'mbkb'),
(10, 'hg', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(11, 'gghh', 2147483647, '1234567890', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(12, 'sangeeta080', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(13, 'gff', 2147483647, '1234567890', 'sangeetamalviya08@gmail.com', '8888888888', 'hdhdhd', 'bhd', 'mbkb'),
(14, 'sangeeta18', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(15, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(16, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(17, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(18, 'sangeeta080', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'hdhdhd', 'bhd', 'mbkb'),
(19, 'sangeeta89', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(20, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'hdhdhd', 'bhd', 'mbkb'),
(21, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(22, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb'),
(23, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8787878787', 'jnefna', 'bhd', 'mbkb'),
(24, 'sangeeta08', 2147483647, '1a2s3d4f5g', 'sangeetamalviya08@gmail.com', '8888888888', 'jnefna', 'bhd', 'mbkb');

-- --------------------------------------------------------

--
-- Table structure for table `packers_movers`
--

DROP TABLE IF EXISTS `packers_movers`;
CREATE TABLE IF NOT EXISTS `packers_movers` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `name_org` varchar(50) NOT NULL,
  `contact_no` decimal(11,0) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packers_movers`
--

INSERT INTO `packers_movers` (`pid`, `name_org`, `contact_no`, `email_id`) VALUES
(1, 'abcd', '9022942188', 'manas.sinkar@gmail.com'),
(2, 'pqrs', '7977261097', 'manas.sinkar@spit.ac.in'),
(3, 'Manas ', '6846565465', 'manas@gmail.com'),
(4, 'parth', '7208201778', 'thosaniparth@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `UID` int NOT NULL,
  `buyer` varchar(100) NOT NULL,
  `Bank_name` varchar(100) NOT NULL,
  `amount` int NOT NULL,
  `Loan_details` varchar(10000) NOT NULL,
  `cheque_number` int NOT NULL,
  `payment_opt` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

DROP TABLE IF EXISTS `rent`;
CREATE TABLE IF NOT EXISTS `rent` (
  `flat_id` int NOT NULL,
  `rent_amount` int NOT NULL,
  `deposit_amount` int NOT NULL,
  `time_period` int NOT NULL,
  PRIMARY KEY (`flat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`flat_id`, `rent_amount`, `deposit_amount`, `time_period`) VALUES
(3, 15000, 50000, 5),
(4, 20000, 60000, 7);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
CREATE TABLE IF NOT EXISTS `sale` (
  `flat_id` int NOT NULL,
  `totalcost` double NOT NULL,
  `rate` double NOT NULL,
  PRIMARY KEY (`flat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`flat_id`, `totalcost`, `rate`) VALUES
(1, 3600000, 8000),
(2, 4500000, 9000),
(6, 11000000, 20000),
(7, 4242392, 56),
(9, 4242392, 56),
(11, 4242392, 56),
(15, 4242392, 56),
(16, 4242392, 56),
(21, 4242392, 56),
(25, 4242392, 56),
(28, 4242392, 56),
(31, 6888, 56),
(32, 4242392, 56);

-- --------------------------------------------------------

--
-- Table structure for table `upcoming_projects`
--

DROP TABLE IF EXISTS `upcoming_projects`;
CREATE TABLE IF NOT EXISTS `upcoming_projects` (
  `upid` int NOT NULL AUTO_INCREMENT,
  `bid` int NOT NULL,
  `location` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `comp_time` int NOT NULL,
  PRIMARY KEY (`upid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure for view `cardrent`
--
DROP TABLE IF EXISTS `cardrent`;

DROP VIEW IF EXISTS `cardrent`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cardrent`  AS  select `flat`.`flat_id` AS `flat_id`,`flat`.`location` AS `location`,`flat`.`city` AS `city`,`rent`.`rent_amount` AS `rent_amount`,`flat`.`image` AS `image`,`flat`.`time` AS `time` from (`flat` join `rent` on((`flat`.`flat_id` = `rent`.`flat_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `cardsale`
--
DROP TABLE IF EXISTS `cardsale`;

DROP VIEW IF EXISTS `cardsale`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cardsale`  AS  select `flat`.`flat_id` AS `flat_id`,`flat`.`location` AS `location`,`flat`.`city` AS `city`,`sale`.`totalcost` AS `totalcost`,`flat`.`image` AS `image`,`flat`.`time` AS `time` from (`flat` join `sale` on((`flat`.`flat_id` = `sale`.`flat_id`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT `rent_ibfk_1` FOREIGN KEY (`flat_id`) REFERENCES `flat` (`flat_id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`flat_id`) REFERENCES `flat` (`flat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
