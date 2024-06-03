-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3316
-- Generation Time: Apr 26, 2024 at 11:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cits1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblchildren`
--

CREATE TABLE `tblchildren` (
  `childName` varchar(255) DEFAULT NULL,
  `parentContno` varchar(20) DEFAULT NULL,
  `parentEmail` varchar(255) DEFAULT NULL,
  `childGender` char(1) DEFAULT NULL,
  `parentAdd` varchar(255) DEFAULT NULL,
  `childAge` int(11) DEFAULT NULL,
  `childImmu` varchar(255) DEFAULT NULL,
  `childDoB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblchildren`
--

INSERT INTO `tblchildren` (`childName`, `parentContno`, `parentEmail`, `childGender`, `parentAdd`, `childAge`, `childImmu`, `childDoB`) VALUES
('Emma Smith', '1234567890', 'emma@example.com', 'F', '123 Main St, Anytown, USA', 5, 'Measles, Mumps, Rubella', '2019-05-10'),
('Dummy', '9211887771', '20103170@mail.jiit.ac.in', 'm', 'delhi', 10, 'adhd', '2014-04-23'),
('Dummy', '9211887771', '20103170@mail.jiit.ac.in', 'm', 'delhi', 10, 'adhd', '2014-04-23'),
('Davy', '9211887771', '20103170@mail.jiit.ac.in', 'm', 'delhi', 10, 'adhd', '2014-04-23'),
('test', '8221177717', '20103170@mail.jiit.ac.in', 'm', 'pune', 10, 'ASD', '2010-10-10'),
('hello', '9211661119', '20103170@mail.jiit.ac.in', 'm', 'delhi', 10, 'ocd', '2014-04-23');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
