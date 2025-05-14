-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2025 at 01:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `consultant_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `cid` int(10) UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `cname` varchar(100) NOT NULL,
  `date_appointment` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `bid` int(10) UNSIGNED NOT NULL,
  `time_appointment` time DEFAULT NULL,
  `child_name` varchar(50) NOT NULL,
  `com_mob` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`cid`, `category`, `username`, `cname`, `date_appointment`, `status`, `email`, `mobile`, `bid`, `time_appointment`, `child_name`, `com_mob`) VALUES
(39, 'Physical Health', 'dddddd', 'Krishna Thorat', NULL, NULL, NULL, NULL, 52, NULL, '', '9090909090'),
(39, 'Physical Health', 'Space Foundation', 'Krishna Thorat', NULL, NULL, NULL, NULL, 277911, NULL, '', '8550969625'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', NULL, NULL, NULL, NULL, 341707, NULL, '', '9852100012'),
(49, 'Paediatrician', 'Aditi Niphade', 'Utkarsh', NULL, NULL, NULL, NULL, 416586, NULL, '', '8975176634'),
(85, 'Psychiatrist', 'uma', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 456391, NULL, '', '9500661540'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 592401, '16:18:00', '', '8951698546'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', NULL, NULL, NULL, NULL, 687234, NULL, '', '3333333333'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 693853, NULL, '', '9372744039'),
(49, 'Paediatrician', 'Admin', 'Utkarsh', NULL, NULL, NULL, NULL, 708678, NULL, '', '6234567890'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 766189, NULL, '', '9035656712'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', NULL, NULL, NULL, NULL, 773601, NULL, '', '9852100012'),
(49, 'Paediatrician', 'Harshul', 'Utkarsh', NULL, NULL, NULL, NULL, 845604, NULL, '', '9211887711'),
(50, 'Mental Health', 'suraj prakash singh', 'Devendra', NULL, NULL, NULL, NULL, 849291, NULL, '', '8639739231'),
(85, 'Psychiatrist', 'alvin', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 895798, NULL, '', '9172155896'),
(55, 'Paediatrician', 'Qadirul hasan qa', 'Ajay', NULL, NULL, NULL, NULL, 923586, NULL, '', '7618831881'),
(49, 'Paediatrician', 'Roshan patil', 'Utkarsh', NULL, NULL, NULL, NULL, 1049618, NULL, '', '8793073594'),
(49, 'Paediatrician', 'djq', 'Utkarsh', NULL, NULL, NULL, NULL, 1098493, NULL, '', '7777777777'),
(85, 'Psychiatrist', 'Sachin Mohite', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 1105609, NULL, '', '9372744039'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', NULL, NULL, NULL, NULL, 1150594, NULL, '', '3333333333'),
(49, 'Paediatrician', 'admintest', 'Utkarsh', NULL, NULL, NULL, NULL, 1265998, NULL, '', '9588661541'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 1292332, NULL, '', '9087909809'),
(39, 'Physical Health', 'Qadirul hasan qa', 'Krishna Thorat', NULL, NULL, NULL, NULL, 1307913, NULL, '', '7618831881'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 1340560, NULL, '', '9087909809'),
(439, 'Physical Health', 'uma', 'new consultuser', '2025-05-13', NULL, 'uma@gmail.com', NULL, 1387909, '17:30:00', 'test child', '9685745869'),
(49, 'Paediatrician', 'testuma', 'Utkarsh', NULL, NULL, NULL, NULL, 1415620, NULL, '', '7485966581'),
(49, 'Paediatrician', 'Sandeep mewada', 'Utkarsh', NULL, NULL, NULL, NULL, 1456781, NULL, '', '7746875035'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 1546984, NULL, '', '7618831881'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', NULL, NULL, NULL, NULL, 1589330, NULL, '', '9852100012'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', NULL, NULL, NULL, NULL, 1625768, NULL, '', '9087909809'),
(68, 'Mental Health', 'suraj prakash singh', 'captain', NULL, NULL, NULL, NULL, 1647317, NULL, '', '8639739231'),
(87, 'Psychiatrist', 'Qadirul hasan qa', 'varunk', NULL, NULL, NULL, NULL, 1767412, NULL, '', '7618831881'),
(363, 'Psychiatrist', 'uma', 'Dr. Kumar', '2025-05-13', NULL, 'uma@gmail.com', NULL, 1787266, '16:00:00', 'test child', '9685745869'),
(438, 'Psychiatrist', 'uma', 'newconsult', '2025-05-13', NULL, 'uma@gmail.com', NULL, 1912180, '17:00:00', 'test child', '9685745869'),
(55, 'Paediatrician', 'umaworld', 'Ajay', '2025-05-04', NULL, 'uma@gmail.com', NULL, 1944384, '17:00:00', 'test child', '9500661540'),
(52, 'Nutritionist', 'Qadirul hasan qa', 'dddddd', NULL, NULL, NULL, NULL, 1962483, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'suraj prakash singh', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 2042877, NULL, '', '8639739231'),
(85, 'Psychiatrist', 'abcd', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 2135333, NULL, '', '9546546541'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2261814, NULL, '', '9087909809'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', NULL, NULL, NULL, NULL, 2344607, NULL, '', '9852100012'),
(56, 'Physical Health', 'pinka', 'snehal salave', NULL, NULL, NULL, NULL, 2423190, NULL, '', '9087909809'),
(49, 'Paediatrician', 'uma', 'Utkarsh', NULL, NULL, NULL, NULL, 2440785, NULL, '', '9500661540'),
(52, 'Nutritionist', 'Shivam', 'dddddd', NULL, NULL, NULL, NULL, 2443978, NULL, '', '7049579435'),
(352, 'Paediatrician', 'Qadirul hasan qa', 'mEe', NULL, NULL, NULL, NULL, 2532911, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 2536701, NULL, '', '9035656712'),
(49, 'Paediatrician', 'abcd', 'Utkarsh', NULL, NULL, NULL, NULL, 2542827, NULL, '', '9546546541'),
(49, 'Paediatrician', 'khe', 'Utkarsh', NULL, NULL, NULL, NULL, 2552478, NULL, '', '9839798334'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2574845, NULL, '', '9372744039'),
(39, 'Physical Health', 'Space Foundation', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2604577, NULL, '', '8550969625'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 2646786, NULL, '', '7618831881'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', '2022-01-08', 'inactive', NULL, NULL, 2683010, '17:48:00', '', '9087909809'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2801511, NULL, '', '9372744039'),
(85, 'Psychiatrist', 'uma', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 2809268, NULL, '', '9500661540'),
(85, 'Psychiatrist', '', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 2834185, NULL, '', ''),
(85, 'Psychiatrist', 'testumaworld', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 3022757, NULL, '', '9500668778'),
(56, 'Physical Health', 'pinka', 'snehal salave', NULL, NULL, NULL, NULL, 3034265, NULL, '', '9087909809'),
(56, 'Physical Health', 'xxxx', 'snehal salave', NULL, NULL, NULL, NULL, 3035483, NULL, '', '9023453443'),
(321, 'Physical Health', 'Qadirul hasan qa', 'shivam singh', NULL, NULL, NULL, NULL, 3276340, NULL, '', '7618831881'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 3276897, NULL, '', '7618831881'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', NULL, NULL, NULL, NULL, 3301540, NULL, '', '9852100012'),
(55, 'Paediatrician', 'uma', 'Ajay', '2025-05-11', NULL, 'uma@gmail.com', NULL, 3318470, '03:03:00', 'test child', '9685745869'),
(55, 'Paediatrician', 'Harshul', 'Ajay', NULL, NULL, NULL, NULL, 3442985, NULL, '', '9211887711'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 3555660, NULL, '', '9035656712'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-01-21', 'inactive', NULL, NULL, 3595610, '16:56:00', '', '9852100012'),
(85, 'Psychiatrist', 'testdelivery', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 3705779, NULL, '', '9685741425'),
(39, 'Physical Health', 'varun kumar k', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 3747792, '16:05:00', '', '8951698545'),
(49, 'Paediatrician', 'testingapp', 'Utkarsh', NULL, NULL, NULL, NULL, 3773254, NULL, '', '9566889878'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 3870256, '16:09:00', '', '8951698546'),
(55, 'Paediatrician', 'abcd', 'Ajay', NULL, NULL, NULL, NULL, 3884511, NULL, '', '9546546541'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 3955148, NULL, '', '9035656712'),
(50, 'Mental Health', 'uma', 'Devendra', NULL, NULL, NULL, NULL, 3962055, NULL, '', '9500661540'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', NULL, NULL, NULL, NULL, 3972965, NULL, '', '9087909809'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', NULL, NULL, NULL, NULL, 3979799, NULL, '', '8951698546'),
(50, 'Mental Health', 'Susmita', 'Devendra', NULL, NULL, NULL, NULL, 4001117, NULL, '', '3333333333'),
(87, 'Psychiatrist', 'Pranjal Agrawal', 'varunk', NULL, NULL, NULL, NULL, 4029137, NULL, '', '6423234567'),
(49, 'Paediatrician', 'vrushali', 'Utkarsh', NULL, NULL, NULL, NULL, 4147518, NULL, '', '9075470346'),
(85, 'Psychiatrist', 'testdelivery', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 4153713, NULL, '', '9685741425'),
(49, 'Paediatrician', 'testingworld', 'Utkarsh', NULL, NULL, NULL, NULL, 4153745, NULL, '', '9566001541'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 4277710, NULL, '', '9035656712'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4476273, NULL, '', '9087909809'),
(49, 'Paediatrician', 'suraj prakash singh', 'Utkarsh', NULL, NULL, NULL, NULL, 4494341, NULL, '', '8639739231'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4543422, NULL, '', '9372744039'),
(85, 'Psychiatrist', 'pooja shet', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 4556120, NULL, '', '8884522408'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4584806, NULL, '', '8639739231'),
(39, 'Physical Health', 'varunk', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4602700, NULL, '', '8722235441'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 4606038, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 4612022, NULL, '', '9035656712'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', '2022-01-29', 'inactive', NULL, NULL, 4781457, '15:50:00', '', '9087909809'),
(55, 'Paediatrician', 'Susmita Vulli', 'Ajay', '2022-01-30', 'inactive', NULL, NULL, 4787197, '12:25:00', '', '9606888725'),
(52, 'Nutritionist', 'Aditi Niphade', 'dddddd', NULL, NULL, NULL, NULL, 4811295, NULL, '', '8975176634'),
(49, 'Paediatrician', 'Susmita Vulli', 'Utkarsh', '2022-01-23', 'inactive', NULL, NULL, 4863388, '16:43:00', '', '9606888725'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', NULL, NULL, NULL, NULL, 4907823, NULL, '', '9087909809'),
(56, 'Physical Health', 'Jayesh Hemant Borae', 'snehal salave', NULL, NULL, NULL, NULL, 4925590, NULL, '', '8626033209'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 4950272, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 4955858, NULL, '', '9035656712'),
(52, 'Paediatrician', 'suraj prakash singh', 'dddddd', NULL, NULL, NULL, NULL, 5032925, NULL, '', '8639739231'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', '2022-01-27', 'inactive', NULL, NULL, 5098771, '15:00:00', '', '9852100012'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5182394, NULL, '', '9372744039'),
(49, 'Paediatrician', 'abcd', 'Utkarsh', NULL, NULL, NULL, NULL, 5198885, NULL, '', '9546546541'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5361625, NULL, '', '8639739231'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', '2022-01-01', 'inactive', NULL, NULL, 5420548, '15:08:00', '', '9022478080'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 5435389, NULL, '', '9035656712'),
(85, 'Psychiatrist', 'testdelivery', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 5438745, NULL, '', '9685741425'),
(85, 'Psychiatrist', 'Pranjal Agarwal', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 5514101, NULL, '', '9305695488'),
(49, 'Paediatrician', 'snehal salave', 'Utkarsh', NULL, NULL, NULL, NULL, 5643743, NULL, '', '9022478080'),
(39, 'Physical Health', 'pooja shet', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5781331, NULL, '', '8884522408'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5842468, NULL, '', '9022478080'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', '2022-01-17', 'inactive', NULL, NULL, 5851969, '14:21:00', '', '3333333333'),
(85, 'Psychiatrist', 'Sachin Mohite', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 5872181, NULL, '', '9372744039'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 6124073, NULL, '', '7618831881'),
(49, 'Paediatrician', 'xxxx', 'Utkarsh', NULL, NULL, NULL, NULL, 6216697, NULL, '', '9023453443'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6250351, NULL, '', '9087909809'),
(39, 'Physical Health', 'pooja', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6370541, NULL, '', '9022345689'),
(85, 'Psychiatrist', 'Harshul', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 6397144, NULL, '', '9211887711'),
(391, 'Paediatrician', 'Shivam', 'Dr Sukhpreet Kaur', NULL, NULL, NULL, NULL, 6400681, NULL, '', '7049579435'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 6424445, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'Sachin Mohite', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 6491053, NULL, '', '9372744039'),
(49, 'Paediatrician', 'snehal salave', 'Utkarsh', NULL, NULL, NULL, NULL, 6496382, NULL, '', '9022478080'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', NULL, NULL, NULL, NULL, 6658714, NULL, '', '3333333333'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6698313, NULL, '', '8639739231'),
(321, 'Physical Health', 'Qadirul hasan qa', 'shivam singh', NULL, NULL, NULL, NULL, 6715084, NULL, '', '7618831881'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6780753, NULL, '', '8639739231'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6782623, NULL, '', '9022478080'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 6880553, NULL, '', '7618831881'),
(52, 'Paediatrician', 'snehal salave', 'dddddd', NULL, NULL, NULL, NULL, 6887338, NULL, '', '9022478080'),
(49, 'Paediatrician', 'Harshul', 'Utkarsh', NULL, NULL, NULL, NULL, 6898154, NULL, '', '9211887711'),
(52, 'Nutritionist', 'user', 'dddddd', NULL, NULL, NULL, NULL, 7007889, NULL, '', '0987654321'),
(55, 'Paediatrician', 'Shivam', 'Ajay', NULL, NULL, NULL, NULL, 7049510, NULL, '', '7049579435'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-01-23', 'inactive', NULL, NULL, 7111540, '15:00:00', '', '9852100012'),
(52, 'Paediatrician', 'Sachin Mohite', 'dddddd', NULL, NULL, NULL, NULL, 7172678, NULL, '', '9372744039'),
(50, 'Mental Health', 'Preethi Shetty DB', 'Devendra', NULL, NULL, NULL, NULL, 7258693, NULL, '', '9448470151'),
(85, 'Psychiatrist', 'Sachith Kiran', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 7263928, NULL, '', '9035656712'),
(49, 'Paediatrician', 'Keerthan L B', 'Utkarsh', NULL, NULL, NULL, NULL, 7304234, NULL, '', '8971892949'),
(55, 'Paediatrician', 'testbookowner', 'Ajay', NULL, NULL, NULL, NULL, 7348114, NULL, '', '9685744152'),
(55, 'Paediatrician', 'Harshul', 'Ajay', NULL, NULL, NULL, NULL, 7389085, NULL, '', '9211887711'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7413931, NULL, '', '9022478080'),
(56, 'Physical Health', 'pinka', 'snehal salave', NULL, NULL, NULL, NULL, 7487941, NULL, '', '9087909809'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', '2022-02-25', 'inactive', NULL, NULL, 7505754, '15:22:00', '', '9852100012'),
(49, 'Paediatrician', 'Roshan patil', 'Utkarsh', NULL, NULL, NULL, NULL, 7518425, NULL, '', '8793073594'),
(39, 'Physical Health', 'Qadirul hasan qa', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7573761, NULL, '', '7618831881'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7587616, NULL, '', '9022478080'),
(85, 'Psychiatrist', 'Qadirul hasan qa', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 7595762, NULL, '', '7618831881'),
(39, 'Physical Health', 'abcd', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7653781, NULL, '', '8080808080'),
(52, 'Nutritionist', 'Qadirul hasan qa', 'dddddd', NULL, NULL, NULL, NULL, 7683035, NULL, '', '7618831881'),
(72, 'Mental Health', 'Shivam', 'Udeshya', NULL, NULL, NULL, NULL, 7881773, NULL, '', '7049579435'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7900899, NULL, '', '9087909809'),
(345, 'Physical Health', 'Qadirul hasan qa', 'ashish', NULL, NULL, NULL, NULL, 7945199, NULL, '', '7618831881'),
(55, 'Paediatrician', 'umaworld', 'Ajay', '2025-05-04', NULL, 'uma@gmail.com', NULL, 8000695, '04:00:00', 'test child', '9500661540'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-01-25', 'inactive', NULL, NULL, 8115315, '14:02:00', '', '9852100012'),
(49, 'Paediatrician', 'xxxx', 'Utkarsh', NULL, NULL, NULL, NULL, 8137311, NULL, '', '9023453443'),
(352, 'Paediatrician', 'Harshul', 'mEe', NULL, NULL, NULL, NULL, 8161465, NULL, '', '9211887711'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 8380831, '16:10:00', '', '8951698546'),
(85, 'Psychiatrist', 'Preethi Shetty DB', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 8386452, NULL, '', '9448470151'),
(49, 'Paediatrician', 'Space Foundation', 'Utkarsh', NULL, NULL, NULL, NULL, 8416278, NULL, '', '8550969625'),
(352, 'Paediatrician', 'Harshul', 'mEe', NULL, NULL, NULL, NULL, 8440214, NULL, '', '9211887711'),
(52, 'Nutritionist', 'testbookowner', 'dddddd', NULL, NULL, NULL, NULL, 8451411, NULL, '', '9685744152'),
(39, 'Physical Health', 'demo', 'Krishna Thorat', NULL, NULL, NULL, NULL, 8535250, NULL, '', '8722235441'),
(50, 'Mental Health', 'xxxx', 'Devendra', NULL, NULL, NULL, NULL, 8707683, NULL, '', '9023453443'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 8737763, NULL, '', '9087909809'),
(72, 'Mental Health', 'Roshan patil', 'Udeshya', NULL, NULL, NULL, NULL, 8801670, NULL, '', '8793073594'),
(55, 'Paediatrician', 'Dora', 'Ajay', NULL, NULL, NULL, NULL, 8839369, NULL, '', '7845125556'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 8843937, NULL, '', '9372744039'),
(39, 'Physical Health', 'Qadirul hasan qa', 'Krishna Thorat', NULL, NULL, NULL, NULL, 8928716, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'suraj prakash singh', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 8967973, NULL, '', '8639739231'),
(50, 'Mental Health', 'snehal salave', 'Devendra', '2022-01-02', 'inactive', NULL, NULL, 9005983, '16:20:00', '', '9022478080'),
(85, 'Psychiatrist', 'Qadirul hasan qa', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 9032135, NULL, '', '7618831881'),
(49, 'Paediatrician', 'uma', 'Utkarsh', NULL, NULL, NULL, NULL, 9112786, NULL, '', '9500661540'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9130644, NULL, '', '9087909809'),
(87, 'Psychiatrist', 'Pranjal Agrawal', 'varunk', NULL, NULL, NULL, NULL, 9172515, NULL, '', '6423234567'),
(85, 'Psychiatrist', 'varunk', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 9230661, NULL, '', '8722235441'),
(49, 'Paediatrician', 'testuma', 'Utkarsh', NULL, NULL, NULL, NULL, 9243395, NULL, '', '7485966581'),
(49, 'Paediatrician', 'Rupali', 'Utkarsh', '2022-01-26', 'inactive', NULL, NULL, 9265553, '16:10:00', '', '7620287846'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9275904, NULL, '', '9372744039'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9308289, NULL, '', '9087909809'),
(348, 'Physical Health', 'Qadirul hasan qa', 'api', NULL, NULL, NULL, NULL, 9308535, NULL, '', '7618831881'),
(49, 'Paediatrician', 'Harshul', 'Utkarsh', NULL, NULL, NULL, NULL, 9466054, NULL, '', '9211887711'),
(49, 'Paediatrician', 'suraj prakash singh', 'Utkarsh', NULL, NULL, NULL, NULL, 9467369, NULL, '', '8639739231'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9501715, NULL, '', '9372744039'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-02-11', 'inactive', NULL, NULL, 9570518, '14:00:00', '', '9852100012'),
(49, 'Paediatrician', 'abcd', 'Utkarsh', NULL, NULL, NULL, NULL, 9602739, NULL, '', '9546546541'),
(49, 'Paediatrician', 'Sachin Mohite', 'Utkarsh', '2022-01-04', 'inactive', NULL, NULL, 9650878, '13:30:00', '', '9372744039'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 9737578, '16:14:00', '', '8951698546'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 9756898, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'testumaworld', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 9784739, NULL, '', '9500668778'),
(39, 'Physical Health', 'xxxx', 'Krishna Thorat', '2022-01-06', 'inactive', NULL, NULL, 9832183, '12:11:00', '', '9023453443'),
(87, 'Psychiatrist', 'Sachith Kiran', 'varunk', NULL, NULL, NULL, NULL, 9840557, NULL, '', '9035656712'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 9842231, '16:22:00', '', '8951698546'),
(85, 'Psychiatrist', 'Qadirul hasan qa', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 9900282, NULL, '', '7618831881'),
(363, 'Psychiatrist', 'umaworld', 'Dr. Kumar', '2025-05-02', NULL, 'uma@gmail.com', NULL, 9927861, '14:00:00', 'test child', '9500661540'),
(85, 'Psychiatrist', 'ShaliniAnil Khandare', 'ShaliniAnil Khandare', '2022-01-12', 'inactive', NULL, NULL, 9941641, '21:17:00', '', '8830242472'),
(55, 'Paediatrician', 'abcd', 'Ajay', NULL, NULL, NULL, NULL, 9946926, NULL, '', '8080808080'),
(49, 'Paediatrician', 'Qadirul hasan qa', 'Utkarsh', NULL, NULL, NULL, NULL, 9971658, NULL, '', '7618831881'),
(85, 'Psychiatrist', 'testdelivery', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 9988562, NULL, '', '9685741425');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`bid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
