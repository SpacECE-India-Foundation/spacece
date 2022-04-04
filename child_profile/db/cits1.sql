-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 08:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updationDate`) VALUES
(1, 'admin', 'Test@12345', '28-12-2016 11:42:05 AM');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `docSpecialization` varchar(255) DEFAULT NULL,
  `docId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `appointmentDate` varchar(255) DEFAULT NULL,
  `appointmentTime` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `docStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `docSpecialization`, `docId`, `userId`, `consultancyFees`, `description`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `docStatus`, `updationDate`) VALUES
(46, 'Dermatologist', 9, 7, 500, 'TB', '2021-03-23', '9:15 AM', '2021-03-22 18:09:51', 0, 1, '2021-03-22 20:08:02'),
(47, 'Doctor', 5, 7, 8050, 'TB', '2021-03-23', '9:15 AM', '2021-03-22 18:11:56', 1, 0, '2021-03-22 20:08:49'),
(48, 'Doctor', 5, 9, 8050, '999', '2021-04-21', '8:30 PM', '2021-04-20 17:19:53', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `docspecilization`
--

CREATE TABLE `docspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `docspecilization`
--

INSERT INTO `docspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(2, 'Doctor', '2016-12-28 06:38:12', '2021-03-22 14:13:56'),
(3, 'Emergency & Critical Care', '2016-12-28 06:38:48', '2021-03-22 14:13:47'),
(4, 'Dermatologist', '2016-12-28 06:39:26', '2021-03-22 16:23:34'),
(5, 'Pedetrician', '2016-12-28 06:39:51', '2021-03-22 18:03:37'),
(6, 'Nurse', '2016-12-28 06:40:08', '2021-03-22 16:24:00'),
(9, 'Dermatologist', '2016-12-28 07:37:39', '2021-03-22 16:24:09'),
(10, 'Nutritionist', '2017-01-07 08:07:53', '2021-03-22 16:24:17'),
(11, 'Surgeon', '2019-06-23 17:51:06', '2021-03-22 16:24:24'),
(15, 'Infectious Disease Doctor', '2021-03-01 11:32:55', '2021-03-09 13:07:14'),
(23, 'Pathologist', '2021-06-21 17:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `docName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `docName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(2, 'Emergency & Critical Care', 'Samwel Umtiti', '14 Nakuru', '600', 2147483647, 'sarita@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2016-12-29 06:51:51', '2021-03-22 16:21:32'),
(5, 'Doctor', 'Nipher Patience', 'Kmu 22', '8050', 442166644647, 'sanjeev@gmail.com', '4297f44b13955235245b2497399d7a93', '2017-01-07 07:47:07', '2021-04-20 17:15:46'),
(6, 'Nutritionist', 'Stephanie Motty', '123 Kis', '2500', 45497964, 'amrita@test.com', 'f925916e2754e5e03f75dd58a5733251', '2017-01-07 07:52:50', '2021-03-22 16:22:00'),
(7, 'Nutritionist', 'Mayellow yellow', '190 Kitui', '200', 852888888, 'test@demo.com', '4297f44b13955235245b2497399d7a93', '2017-01-07 08:08:58', '2021-03-22 16:22:15'),
(8, 'Emergency & Critical Care', 'Kata Kiu', '77 Nyeri', '600', 1234567890, 'test@test.com', '4297f44b13955235245b2497399d7a93', '2019-06-23 17:57:43', '2021-03-22 16:22:23'),
(9, 'Dermatologist', 'Tompson Davis', '67 New jersey', '500', 1234567890, 'sp@test.com', '4297f44b13955235245b2497399d7a93', '2019-11-10 18:37:47', '2021-03-22 20:11:10'),
(10, 'Doctor', 'Mayellow yellow', '789', '1000', 98989, 'kk@yahoo.com', '4297f44b13955235245b2497399d7a93', '2021-03-01 11:54:21', '2021-03-22 16:23:07'),
(14, 'Infectious Disease Doctor', 'Samson Keter', '184-100', '500', 92882999, 'son@gmmail.com', '4297f44b13955235245b2497399d7a93', '2021-03-09 13:21:50', NULL),
(15, 'Pathologist', 'Cephus Johnstone', '4550', '2900', 6893738, 'ceph@gmail.com', '4297f44b13955235245b2497399d7a93', '2021-03-22 19:55:39', '2021-03-22 19:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(20, NULL, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 21:04:34', NULL, 0),
(21, NULL, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 21:04:50', NULL, 0),
(22, NULL, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 21:07:43', NULL, 0),
(23, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 21:08:28', '01-03-2021 02:39:58 AM', 1),
(24, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 21:22:25', NULL, 1),
(25, NULL, 'sp@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 22:40:14', NULL, 0),
(26, 9, 'sp@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 22:40:24', '01-03-2021 04:11:13 AM', 1),
(28, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 22:54:13', '01-03-2021 04:35:03 AM', 1),
(29, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 23:05:17', NULL, 1),
(30, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 23:05:17', NULL, 1),
(31, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 23:05:17', '01-03-2021 04:36:25 AM', 1),
(33, NULL, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:52:41', NULL, 0),
(34, NULL, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:52:59', NULL, 0),
(35, NULL, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:53:11', NULL, 0),
(36, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:53:52', NULL, 1),
(37, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:56:41', NULL, 1),
(38, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:56:41', NULL, 1),
(39, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 09:05:46', NULL, 1),
(40, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 09:26:31', NULL, 1),
(41, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 09:28:06', NULL, 1),
(42, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 10:07:16', NULL, 1),
(43, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 10:13:27', NULL, 1),
(44, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 10:16:10', NULL, 1),
(45, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 10:22:59', NULL, 1),
(46, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-07 11:18:29', NULL, 1),
(47, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-08 22:01:50', '09-03-2021 04:13:33 AM', 1),
(48, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-08 22:44:10', NULL, 1),
(49, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:17:31', '09-03-2021 11:48:33 AM', 1),
(50, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:27:06', '09-03-2021 12:07:20 PM', 1),
(51, 10, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:40:17', '09-03-2021 12:18:09 PM', 1),
(52, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:49:28', '09-03-2021 12:19:55 PM', 1),
(53, 9, 'sp@test.com', 0x3a3a3100000000000000000000000000, '2021-03-13 17:52:48', '13-03-2021 11:23:14 PM', 1),
(54, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 07:27:17', '22-03-2021 01:04:42 PM', 1),
(55, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 13:49:45', '22-03-2021 07:22:29 PM', 1),
(56, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 18:14:05', '22-03-2021 11:45:33 PM', 1),
(57, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 19:21:17', '23-03-2021 12:53:51 AM', 1),
(58, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 19:23:58', '23-03-2021 12:59:08 AM', 1),
(59, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 19:44:11', '23-03-2021 01:20:04 AM', 1),
(60, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 20:08:19', '23-03-2021 01:39:02 AM', 1),
(61, 9, 'sp@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 20:11:29', '23-03-2021 01:42:44 AM', 1),
(62, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 20:22:35', '23-03-2021 01:56:34 AM', 1),
(63, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-23 08:55:25', '23-03-2021 02:26:31 PM', 1),
(64, NULL, 'john@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-29 21:35:24', NULL, 0),
(65, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-29 21:36:01', NULL, 1),
(66, NULL, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-04-01 16:18:12', NULL, 0),
(67, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-04-03 08:37:14', NULL, 1),
(68, NULL, 'sanjeev@gmail.co', 0x3a3a3100000000000000000000000000, '2021-04-20 16:55:33', NULL, 0),
(69, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-04-20 16:55:43', '20-04-2021 10:48:31 PM', 1),
(70, 5, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-04-20 17:20:34', '21-06-2021 09:38:45 PM', 1),
(71, NULL, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-06-21 10:54:35', NULL, 0),
(72, NULL, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-06-21 10:57:13', NULL, 0),
(73, NULL, 'test@test,com', 0x3a3a3100000000000000000000000000, '2021-06-21 10:57:36', NULL, 0),
(74, 8, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-06-21 10:58:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  `CONTACT` text NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `MESSAGE` text NOT NULL,
  `STATUS` text NOT NULL,
  `LOGS` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `NAME`, `CONTACT`, `EMAIL`, `MESSAGE`, `STATUS`, `LOGS`) VALUES
(9, 'nn', '474555555', 'madxs@gmail.com', 'hello', '1', '2020-12-12 18:57:21'),
(25, 'Thompson ', '26237864', 'tom@aol.com', 'hello', '0', '2021-03-09 17:47:11'),
(27, 'ken', '907099', 'ken@gmail.com', 'hello there', '1', '2021-04-04 21:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `tblchildren`
--

CREATE TABLE `tblchildren` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `childName` varchar(200) DEFAULT NULL,
  `parentContno` bigint(10) DEFAULT NULL,
  `parentEmail` varchar(200) DEFAULT NULL,
  `childGender` varchar(50) DEFAULT NULL,
  `parentAdd` mediumtext DEFAULT NULL,
  `childAge` int(10) DEFAULT NULL,
  `childImmu` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblchildren`
--

INSERT INTO `tblchildren` (`ID`, `Docid`, `childName`, `parentContno`, `parentEmail`, `childGender`, `parentAdd`, `childAge`, `childImmu`, `CreationDate`, `UpdationDate`) VALUES
(1, 1, 'Jesus', 2222, 'test@gmail.com', 'Male', '47478-40100', 2, 'tongue', '2019-11-04 21:38:06', '2021-03-22 19:12:56'),
(3, 7, 'Mansi', 9878978798, 'jk@gmail.com', 'Female', '\"fdghyj', 46, 'No', '2019-11-05 10:49:41', '2019-11-05 11:58:59'),
(5, 9, 'John', 1234567890, 'john@test.com', 'male', 'Test ', 25, 'jj', '2019-11-10 18:49:24', '2021-03-22 19:12:22'),
(8, 8, 'memos', 344, 'memo@gmail.com', 'Male', '444', 3, 'fkkfkf', '2021-02-25 19:45:29', '2021-02-25 19:45:46'),
(12, 8, 'gender test', 999, 'gender@gmail.com', 'Male', '184-40200', 1, 'iii', '2021-02-25 21:18:25', '2021-02-25 21:18:45'),
(13, 8, 'all', 990088, 'all@gmail.com', 'Male', '184-40200', 5, 'ul', '2021-02-25 21:30:07', '2021-02-25 21:30:44'),
(14, 8, 'every', 7777, 'wanj@aol.com', 'Male', '7777', 5, 'uio', '2021-02-25 21:31:12', '2021-02-27 08:28:40'),
(15, 8, 'new', 666, 'new@gmail.com', 'Male', '184-100', 7, 'ttt', '2021-02-28 21:09:11', '2021-02-28 21:09:35'),
(16, 7, 'nt', 123123, 'kai@hotmail.com', 'Male', '566-0100\r\nNairobi', 7, '444', '2021-02-28 22:51:39', '2021-02-28 22:52:01'),
(17, 8, '222', 8888888, 'mil@hotmail.com', 'Male', '184-100', 4, 'ttt', '2021-02-28 23:05:49', '2021-02-28 23:06:18'),
(19, 10, 'Sabella', 99990, 'was@aol.com', 'Male', '184-40200', 7, 'polio', '2021-03-07 10:23:52', '2021-03-08 23:34:55'),
(20, 10, 'Johab', 9999, 'was@aol.com', 'Male', '309-100', 9, 'TB', '2021-03-07 10:24:49', '2021-03-08 23:35:37'),
(21, 10, 'Kerubo', 9999, 'was@aol.com', 'Male', '166', 4, 'Hepatitis', '2021-03-07 10:24:49', '2021-03-08 23:36:07'),
(22, 10, 'Kelvin Tom', 77778, 'vet@gmail.com', 'Male', '566-0100\r\nNairobi', 3, 'polio', '2021-03-07 10:25:34', '2021-03-08 23:36:42'),
(26, 10, 'Gervas', 78353573, 'mungai@gmail.com', 'Male', '55677-100\r\nNairobi', 4, 'polio', '2021-03-08 23:14:38', '2021-03-08 23:35:09'),
(27, 10, 'Charity', 78635723, 'chary@gmail.com', 'Male', '3636-100\r\nNairobi', 4, 'polio', '2021-03-08 23:18:30', '2021-03-08 23:37:08'),
(28, 5, 'Getrude James', 8895898591, 'sanjeev@gmail.com', 'Male', '344', 3, 'TB', '2021-03-22 19:27:06', '2021-06-21 11:30:40'),
(29, 5, 'Jaspher', 2234344, 'nares@hotmail.com', 'Male', '5456', 2, 'Polio', '2021-03-22 20:24:12', '2021-03-22 20:24:27'),
(30, 5, 'giovean', 773556537, 'gio@gmail.com', 'Male', 'iriir3383', 12, 'tb', '2021-04-20 17:16:57', '2021-04-20 17:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `tblimmunization`
--

CREATE TABLE `tblimmunization` (
  `ID` int(10) NOT NULL,
  `childID` int(10) DEFAULT NULL,
  `vaccineID` varchar(200) DEFAULT NULL,
  `vaccineName` varchar(200) NOT NULL,
  `adminmethod` varchar(100) DEFAULT NULL,
  `bodysite` varchar(200) DEFAULT NULL,
  `nextdate` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblimmunization`
--

INSERT INTO `tblimmunization` (`ID`, `childID`, `vaccineID`, `vaccineName`, `adminmethod`, `bodysite`, `nextdate`, `CreationDate`) VALUES
(10, 19, 'xxfdf', 'BCG', 'ORAL', 'MOUTH', '2021-04-05', '2021-03-08 23:56:42'),
(11, 27, 'llliou', 'BCG', 'injection', 'arm', '2021-05-06', '2021-03-08 23:58:53'),
(12, 0, 'hjjj', 'DPAT', 'injection', 'arm', '2021-10-10', '2021-03-09 06:37:10'),
(13, 0, 'iojhjhas', 'BCG', 'ORAL', 'MOUTH', '20201', '2021-03-09 06:41:16'),
(14, 5, 'KLKLFJJLF', 'KDKD', 'KKSK', 'KSS', 'KASSAD', '2021-03-09 06:47:10'),
(15, 0, '6556TT', 'DPT', 'JAB', 'ARM', '12/06/2021', '2021-03-22 18:15:18'),
(16, 28, '6556TT', 'DPT', 'JAB', 'ARM', '12-04-2021', '2021-03-22 19:27:52'),
(17, 0, 'rety', 'BCG', 'oral', 'mouth', '12/12/2021', '2021-03-22 20:12:38'),
(18, 29, '19SSAJ', 'B.C.G', 'oral', 'mouth', '12/12/2021', '2021-03-22 20:26:12'),
(19, 30, '897474', 'tpp', 'jab', 'arm', '12/03.2022', '2021-04-20 17:17:56'),
(20, 28, '6556TT', 'DPT', 'jab', 'arm', '12/09/2021', '2021-06-21 11:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(24, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 19:06:56', '01-03-2021 02:34:20 AM', 1),
(25, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 21:10:09', '01-03-2021 02:41:12 AM', 1),
(26, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 21:34:12', '01-03-2021 03:49:41 AM', 1),
(27, NULL, 'test@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 22:21:20', NULL, 0),
(28, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 22:21:30', '01-03-2021 04:09:06 AM', 1),
(29, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-02-28 22:49:08', NULL, 1),
(30, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-01 12:35:18', NULL, 1),
(31, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-01 13:18:13', '01-03-2021 06:53:07 PM', 1),
(32, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:11:33', '07-03-2021 02:22:02 PM', 1),
(33, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 08:55:52', '07-03-2021 02:52:12 PM', 1),
(34, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 10:00:50', '07-03-2021 03:37:00 PM', 1),
(35, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 10:14:47', '07-03-2021 03:45:52 PM', 1),
(36, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 11:17:08', '07-03-2021 04:48:13 PM', 1),
(37, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-07 12:33:19', '09-03-2021 12:57:00 AM', 1),
(38, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-08 19:27:20', '09-03-2021 03:17:12 AM', 1),
(39, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-08 21:47:52', '09-03-2021 03:17:55 AM', 1),
(40, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-08 21:48:40', '09-03-2021 03:18:44 AM', 1),
(41, NULL, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-08 21:51:36', NULL, 0),
(42, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-08 21:51:49', '09-03-2021 03:25:23 AM', 1),
(43, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:14:23', '09-03-2021 11:45:23 AM', 1),
(44, NULL, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:15:40', NULL, 0),
(45, NULL, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:15:51', NULL, 0),
(46, NULL, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:17:09', NULL, 0),
(47, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:24:17', '09-03-2021 11:56:23 AM', 1),
(48, NULL, 'kk@yahoo.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:26:43', NULL, 0),
(49, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:37:35', '09-03-2021 12:10:02 PM', 1),
(50, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:48:23', '09-03-2021 12:19:11 PM', 1),
(51, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-09 06:53:21', '09-03-2021 12:29:11 PM', 1),
(52, 8, 'pat@gmail.com ', 0x3a3a3100000000000000000000000000, '2021-03-12 11:38:24', '12-03-2021 05:08:29 PM', 1),
(53, NULL, 'pat@gmail.com ', 0x3a3a3100000000000000000000000000, '2021-03-12 11:38:58', NULL, 0),
(54, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-13 15:23:42', '13-03-2021 06:23:46 PM', 1),
(55, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 07:21:40', '22-03-2021 10:26:21 AM', 1),
(56, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 13:47:29', '22-03-2021 04:48:34 PM', 1),
(57, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 16:18:43', '22-03-2021 07:37:20 PM', 1),
(58, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 18:07:06', '22-03-2021 09:07:59 PM', 1),
(59, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 18:08:44', '22-03-2021 09:12:29 PM', 1),
(60, NULL, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 18:13:51', NULL, 0),
(61, NULL, 'sanjeev@gmail.com', 0x3a3a3100000000000000000000000000, '2021-03-22 18:15:52', NULL, 0),
(62, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 18:16:01', '22-03-2021 09:17:24 PM', 1),
(63, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 20:07:54', '22-03-2021 11:08:09 PM', 1),
(64, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 20:12:56', '22-03-2021 11:14:32 PM', 1),
(65, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-22 20:26:47', '22-03-2021 11:27:09 PM', 1),
(66, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-03-29 16:04:28', NULL, 1),
(67, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-04-02 08:31:51', NULL, 1),
(68, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-04-02 18:07:14', NULL, 1),
(69, NULL, 'Shadrack@Kilimani', 0x3a3a3100000000000000000000000000, '2021-04-20 13:28:59', NULL, 0),
(70, 9, '1@aol.com', 0x3a3a3100000000000000000000000000, '2021-04-20 13:29:52', NULL, 1),
(71, 9, '1@aol.com', 0x3a3a3100000000000000000000000000, '2021-04-20 16:14:22', '20-04-2021 07:34:39 PM', 1),
(72, 9, '1@aol.com', 0x3a3a3100000000000000000000000000, '2021-04-20 16:35:07', '20-04-2021 07:52:20 PM', 1),
(73, 9, '1@aol.com', 0x3a3a3100000000000000000000000000, '2021-04-20 17:18:42', '20-04-2021 08:20:18 PM', 1),
(74, 9, '1@aol.com', 0x3a3a3100000000000000000000000000, '2021-06-21 09:05:52', '21-06-2021 01:53:58 PM', 1),
(75, 7, 'john@test.com', 0x3a3a3100000000000000000000000000, '2021-06-21 16:09:04', '21-06-2021 07:35:25 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(7, 'John', 'Nairobi ', 'Nairobi ', 'male', 'john@test.com', '4297f44b13955235245b2497399d7a93', '2019-11-10 18:40:21', '2021-03-08 21:45:58'),
(8, 'Patience nipher', '456', 'Kafka ', 'female', 'pat@gmail.com', '4297f44b13955235245b2497399d7a93', '2021-03-12 11:38:06', NULL),
(9, 'nipher', '184-40200', 'Nairobi', 'female', '1@aol.com', '4297f44b13955235245b2497399d7a93', '2021-04-20 13:29:41', '2021-06-21 10:38:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docspecilization`
--
ALTER TABLE `docspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblchildren`
--
ALTER TABLE `tblchildren`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblimmunization`
--
ALTER TABLE `tblimmunization`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `docspecilization`
--
ALTER TABLE `docspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblchildren`
--
ALTER TABLE `tblchildren`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblimmunization`
--
ALTER TABLE `tblimmunization`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
