-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2022 at 12:09 PM
-- Server version: 8.0.26-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spaceece`
--

-- --------------------------------------------------------

--
-- Table structure for table `consultant`
--

CREATE TABLE `consultant` (
  `c_id` int NOT NULL,
  `u_id` int NOT NULL,
  `c_category` int NOT NULL,
  `c_office` varchar(100) NOT NULL,
  `c_from_time` time NOT NULL,
  `c_to_time` time NOT NULL,
  `c_language` varchar(50) NOT NULL,
  `c_fee` double NOT NULL,
  `c_available_from` varchar(20) NOT NULL,
  `c_available_to` varchar(20) NOT NULL,
  `c_qualification` varchar(100) NOT NULL,
  `c_aval_days` varchar(200) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `consultant`
--

INSERT INTO `consultant` (`c_id`, `u_id`, `c_category`, `c_office`, `c_from_time`, `c_to_time`, `c_language`, `c_fee`, `c_available_from`, `c_available_to`, `c_qualification`, `c_aval_days`) VALUES
(8, 39, 3, 'Hinjewadi, Pune', '10:00:00', '18:00:00', 'English', 250, 'Monday', 'Monday', 'MD', 'Monday,Tuesday,Saturday,Wednesday,Thursday,Friday'),
(13, 49, 1, 'india', '13:00:00', '19:00:00', 'Hindi', 45, 'Monday', 'Thursday', 'MD', 'Sunday'),
(14, 50, 4, 'bombay', '14:00:00', '20:00:00', 'English', 69, 'Monday', 'Tuesday', 'Btech', 'Sunday'),
(15, 52, 5, 'pune', '14:20:00', '18:16:00', 'English', 100, 'Monday', 'Monday', '12', 'Sunday'),
(16, 55, 1, 'Bangalore', '11:00:00', '14:00:00', 'English', 20, 'Monday', 'Friday', 'MBBS', 'Sunday'),
(17, 56, 3, 'pune', '12:59:04', '18:00:00', 'English', 100, 'Monday', 'Monday', '12', 'Monday,Tuesday,Saturday,Wednesday,Thursday,Friday'),
(18, 68, 4, 'NY', '12:00:00', '18:00:00', 'Hindi', 123, 'Monday', 'Tuesday', 'ABC', 'Sunday'),
(19, 72, 4, 'NY', '12:00:00', '18:00:00', 'Hindi', 123, 'Monday', 'Tuesday', 'ABC', 'Sunday'),
(23, 85, 2, 'Samta nager, basmath,dist. Hingoli', '20:13:00', '23:16:00', 'English', 1000, 'Monday', 'Monday', 'mba', 'Monday,Tuesday,Saturday,Wednesday,Thursday,Friday'),
(24, 87, 2, 'Bangalore', '14:30:00', '17:30:00', 'English', 500, 'Monday', 'Saturday', 'MBBS', 'Monday,Tuesday,Saturday,Wednesday,Thursday,Friday');

-- --------------------------------------------------------

--
-- Table structure for table `consultant_category`
--

CREATE TABLE `consultant_category` (
  `cat_id` int NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_slug` varchar(100) NOT NULL,
  `cat_img` varchar(50) NOT NULL
) ENGINE=InnoDB;

--
-- Dumping data for table `consultant_category`
--

INSERT INTO `consultant_category` (`cat_id`, `cat_name`, `cat_slug`, `cat_img`) VALUES
(1, 'Paediatrician', 'paediatrician', 'd1.jpg'),
(2, 'Psychiatrist', 'psychiatrist', 'd3.jpg'),
(3, 'Physical Health', 'physical-health', 'd4.jpg'),
(4, 'Mental Health', 'mental-health', 'd5.jpg'),
(5, 'Nutritionist', 'nutritionist', 'd6.jpg'),
(6, 'all', 'all', 'all.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `imojo_id` varchar(255) NOT NULL,
  `delivery_person` varchar(255) DEFAULT NULL,
  `status` enum('not_picked','not_delivered','delivered','') NOT NULL DEFAULT 'not_picked',
  `address` varchar(255) NOT NULL,
  `location_from_longitute` float NOT NULL,
  `location_from_latitude` float NOT NULL,
  `location_from_address` varchar(100) NOT NULL,
  `location_to_longitute` float NOT NULL,
  `location_to_latitude` float NOT NULL,
  `location_to_address` varchar(100) NOT NULL,
  `pick_up_timestamp` timestamp NULL DEFAULT NULL,
  `delivered_timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `learnonapp_courses`
--

CREATE TABLE `learnonapp_courses` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `mode` enum('Online','Offline') NOT NULL,
  `duration` smallint NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data for table `learnonapp_courses`
--

INSERT INTO `learnonapp_courses` (`id`, `title`, `description`, `logo`, `type`, `mode`, `duration`, `price`) VALUES
(1, 'Emergent Literacy', 'In order to make children critically thinking adults and observers, it is important that we allow our young learners to imagine and converse in their home language(s) ( the L1 language). However, because of various reasons, most children in India arenu2019t taught in their home languages in schools. At home, parents donu2019t know how to strengthen the L1 language by efficiently using the home as a learning space.', NULL, 'Whatsapp', 'Offline', 30, 49.99),
(2, 'Home as a learning', 'In the ages of 1 to 3 years, the child makes major strides towards independence. During this age a child starts walking, running, naming objects, mumbling words, identifying patterns and figures around him. Toddlers can also do scribbling on the walls, make marks similar to a real object, build blocks and try to eat by themselves. Most of the children learn these functional skills from the environment at their homes.', NULL, 'Whatsapp', 'Online', 30, 49.99),
(3, 'Natural Learning', 'The objective of this five day workshop on ‘ NATURAL LEARNING’ by SPACEECE Organization is to make parents well equipped with the concept of ‘Natural learning’- whats, whys, wheres and hows? The ulterior objective of the workshop is to compulse parents to use the principles of Natural learning during Early Childhood Education.', NULL, 'Whatsapp', 'Offline', 30, 39);

-- --------------------------------------------------------

--
-- Table structure for table `learnonapp_messages`
--

CREATE TABLE `learnonapp_messages` (
  `id` int NOT NULL,
  `no_of_day` smallint NOT NULL,
  `time` varchar(100) NOT NULL,
  `header` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB;

--
-- Dumping data for table `learnonapp_messages`
--

INSERT INTO `learnonapp_messages` (`id`, `no_of_day`, `time`, `header`, `message`) VALUES
(1, 1, '8:00 AM', 'Introduction', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day1: Introduction* 🍁\r\n\r\nhttps://youtu.be/byLb4z-uqEg\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(2, 1, '11:00 AM', 'Quotes', ''),
(3, 1, '5:00 PM', 'Questions', ''),
(4, 2, '8:00 AM', 'Introduction', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day2: Introduction* 🍁\r\n\r\nhttps://youtu.be/NctraENjyNA\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(5, 2, '10:00 AM', 'Reading Material', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day2: Reading Material and Video*🍁\r\n\r\n*Reading material:* https://docs.google.com/document/u/1/d/1C4xYBWwEgr-J4kCIggP4niVVvXhhyQRTLIB2bZK5MoA/mobilebasic\r\n*Video Recording:* https://youtu.be/D4hvBxCLgm8\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(6, 2, '11:00 AM', 'Quotes', ''),
(7, 2, '5:00 PM', 'Questions', ''),
(8, 3, '8:00 AM', 'Introduction', '🍁 SpacECE-LearnOnApp 🍁\r\n🍁 Course001-Home as a Learning SPACE 🍁\r\n🍁 Day3: Introduction 🍁\r\n\r\nhttps://youtu.be/457rQRlz4xc\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(9, 3, '10:00 AM', 'Reading Material', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day3: Reading Material and Video🍁\r\n\r\n*Reading material:* https://docs.google.com/document/d/1eweO80zDfCoEzfsh983QNq7HPDtkpfhR4NT8oRhu6Tw/edit?usp=sharing\r\n*Video recording:* https://youtu.be/457rQRlz4xc\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(10, 3, '11:00 AM', 'Quotes', ''),
(11, 3, '5:00 PM', 'Questions', ''),
(12, 4, '8:00 AM', 'Introduction', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day4: introduction* 🍁\r\n\r\nhttps://youtu.be/-HBWMteRMAY\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(13, 4, '10:00 AM', 'Reading Material', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day4: Reading Material and Video*🍁\r\n\r\n*Reading material:* https://docs.google.com/document/d/1rR7_sggZ6i_PDezKM4SsstHdrg9Ut1pUbdxZJi9yE7c/editusp=sharing                                                                                                                                                                                    \r\n*Video Recording:* https://youtu.be/D2ysrAlnPx4\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(14, 4, '11:00 AM', 'Quotes', ''),
(15, 4, '5:00 PM', 'Questions', ''),
(16, 5, '8:00 AM', 'Introduction', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day5: Introduction* 🍁\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(17, 5, '10:00 AM', 'Reading Material', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day5: Reading Material and Video* 🍁\r\n\r\n*Reading material:* https://docs.google.com/document/d/1nCVQqonukARarK_BnZuNB2BfrrR2qDOx/edit?usp=sharing&ouid=111531550679710763482&rtpof=true&sd=true\r\n*Video Recording:* https://youtu.be/2T_JHkYiZFs \r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(18, 5, '11:00 AM', 'Quotes', ''),
(19, 5, '5:00 PM', 'Questions', ''),
(20, 6, '3:00 PM', 'Online Session', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day6: Online Session* 🍁\r\n\r\n*Link:*\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),
(21, 1, '10:00 AM', 'Reading Material', '🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day1: Reading Material and Video* 🍁\r\n\r\n*Reading Material:* https://docs.google.com/document/d/e/2PACX-1vTM3k9ZXr4x13oO7TLVU0ZHn2erZs9OKdEeBDanWdQgmWGAqmt-37otrbS1B66cm_Y6KhSmxy4F-6q1/pub\r\n*Video Recording:* https://youtu.be/XlLSmDQU-EM\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation');

-- --------------------------------------------------------

--
-- Table structure for table `learnonapp_subcourses`
--

CREATE TABLE `learnonapp_subcourses` (
  `id` int NOT NULL,
  `cid` int NOT NULL,
  `day` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `docs` json NOT NULL
) ENGINE=InnoDB ;

-- --------------------------------------------------------

--
-- Table structure for table `learnonapp_users_courses`
--
CREATE TABLE `learnonapp_users_courses` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `payment_status` enum('failed','paid') DEFAULT NULL,
  `payment_details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
	
--
-- Dumping data for table `learnonapp_users_courses`
--

INSERT INTO `learnonapp_users_courses` (`id`, `uid`, `cid`, `payment_status`, `payment_details`, `created_at`) VALUES
(9, 54, 2, 'paid', 'MOJO2105B05A42112809', '2022-01-05 09:43:01'),
(12, 39, 1, 'paid', 'MOJO2118105A52032093', '2022-01-18 01:23:57'),
(13, 109, 2, 'paid', 'MOJO2119P05A53414502', '2022-01-19 05:27:17'),
(14, 133, 1, 'failed', NULL, '2022-01-21 11:49:50'),
(15, 133, 3, 'paid', 'MOJO2121T05N46244780', '2022-01-21 11:53:22'),
(16, 133, 3, 'failed', NULL, '2022-01-21 12:04:13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ntfID` int NOT NULL,
  `ntfTitle` text,
  `ntfBody` text,
  `ntfProduct` varchar(50) DEFAULT NULL,
  `ntfTimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ntfID`, `ntfTitle`, `ntfBody`, `ntfProduct`, `ntfTimeStamp`) VALUES
(1, 'SpacActive - Day1 Activity', 'This is a Day 1 activity', 'promotion', '2021-10-25 04:06:19'),
(2, 'SpacActive - Day2 Activity', 'This is a Day 2 activity', 'promotion', '2021-11-01 04:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `p_id` int NOT NULL,
  `p_name` varchar(255) NOT NULL
) ENGINE=InnoDB ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB ;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `email`) VALUES
(37, 'salovarshaikh@gmail.com'),
(35, 'varunmanila@gmail.com'),
(36, 'varunmanila89@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int NOT NULL,
  `u_name` varchar(200) ,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(255) ,
  `u_mob` varchar(255) DEFAULT NULL,
  `u_image` text,
  `u_type` varchar(255) NOT NULL DEFAULT 'customer',
  `days` int NOT NULL DEFAULT '0',
  `space_active` varchar(20) NOT NULL DEFAULT 'inactive',
  `learnon_app` varchar(20) ,
  `spacetube` varchar(20) NOT NULL DEFAULT 'inactive',
  `u_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `u_name`, `u_email`, `u_password`, `u_mob`, `u_image`, `u_type`, `days`, `space_active`, `learnon_app`, `spacetube`, `u_createdAt`) VALUES
(1, 'Space Foundation', 'admin@spacece.co', '8a6f2805b4515ac12058e79e66539be9', '8550969625', 'SpacECELogo.jpg', 'admin', 0, 'inactive', 'inactive', 'inactive', '2022-01-11 05:37:04'),
(39, 'Krishna Thorat', 'krishnathorat007@gmail.com', '8a6f2805b4515ac12058e79e66539be9', '8550969625', 'rohit-tandon-9wg5jCEPBsw-unsplash.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 12:16:38'),
(40, 'suraj prakash singh', 'surajprakash612@gmail.com', 'e8ecacd9479ce00c7c4b940aa27253c0', '8639739231', 'pps.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 12:27:48'),
(41, 'George', 'abc@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '123', '', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 12:47:52'),
(42, 'Ramesh', 'user1@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '123', '', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 12:50:08'),
(43, 'Umesh', 'user2@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', '', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 14:42:40'),
(44, 'Umesh', 'user3@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', '', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 14:44:35'),
(45, 'Ujjawal', 'user4@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'Ujjawaljpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 15:05:13'),
(46, 'Shreya', 'user6@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'Shreya.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-24 16:08:26'),
(47, 'Utkarsh', 'user11@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'Utkarsh.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-25 05:52:43'),
(48, 'Utkarsh', 'user12@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'Utkarsh.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-25 05:53:40'),
(49, 'Utkarsh', 'consult1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1234567891', 'Utkarsh.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-25 14:15:03'),
(50, 'Devendra', 'consult2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '1234567890', 'img.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-25 14:22:42'),
(51, 'varun kumar k', 'varun@gmail.com', '2138cb5b0302e84382dd9b3677576b24', '8951698545', 'varun1.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-27 10:58:17'),
(52, 'dddddd', 'kkk@gmail.com', 'df780a97b7d6a8f779f14728bccd3c4c', '9090909090', '123.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-28 08:48:02'),
(53, 'Sachin Mohite', 'sachin.mohite@gmail.com', '15285722f9def45c091725aee9c387cb', '9372744039', 'SpacECE Logo - WhatsApp - download.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-28 10:57:43'),
(54, 'Susmita', 'chotu.sonia@gmail.com', '033c91317f9b6795106a825cf8ef773d', '3333333333', 'IMG-20200524-WA0004 (2).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 03:18:20'),
(55, 'Ajay', 'arige.ajay@gmail.com', '033c91317f9b6795106a825cf8ef773d', '6666666664', 'IMG-20200524-WA0004 (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 03:21:37'),
(56, 'snehal salave', 'snehal130@gmail.com', 'df780a97b7d6a8f779f14728bccd3c4c', '9022478080', 'logo2.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 08:14:32'),
(57, 'prangal patil', 'pranjal@gmail.com', '25f9e794323b453885f5181f1b624d0b', '1234567893', 'Screenshot (63).png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 08:21:05'),
(58, 'Krishna Thorat', 'krishnathorat008@gmail.com', '8a6f2805b4515ac12058e79e66539be9', '8550969625', 'w3.JPG', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 08:56:55'),
(59, 'Krishna Thorat', 'krishna.thorat20@vit.edu', '8a6f2805b4515ac12058e79e66539be9', '8550969625', 'W2.JPG', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 09:01:50'),
(60, 'rita', 'rita@gmail.com', 'df780a97b7d6a8f779f14728bccd3c4c', '9087655678', 'temp_image_20210407_135325_d8f280ba-c237-4f27-a03c-3ecff5185d46.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 09:11:00'),
(61, 'ABC', 'ABC11111@gmail.com', 'e882b72bccfc2ad578c27b0d9b472a14', '9099999999', 'temp_image_20210407_135325_d8f280ba-c237-4f27-a03c-3ecff5185d46.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 09:13:09'),
(62, 'pinka', 'pinka123@gmail.com', '421f39a8ff4dd996a3e57877c3d98146', '9087909809', '123.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 09:15:14'),
(63, 'Krishna Thorat', 'not@engineer.com', '8a6f2805b4515ac12058e79e66539be9', '8550969625', 'WRESTLING.JPG', 'customer', 0, 'inactive', 'inactive', 'inactive', '2021-12-29 10:03:26'),
(64, 'Jayesh Hemant Borae', 'jayborse59@gmail.com', '14f54983d1e87ccdabb873007b1e6f6c', '8626033209', 'Remini20211009103820419.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-02 09:35:41'),
(65, 'pkjhhbbjnkjkmn', 'raju@gmail.com', '25f9e794323b453885f5181f1b624d0b', '9852100012', 'Screenshot (83).png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-02 16:49:05'),
(66, 'pooja', 'pooja@gmail.com', 'df780a97b7d6a8f779f14728bccd3c4c', '9022345689', '123.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-03 07:17:25'),
(67, 'Captain', 'user8@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '55', 'Captain.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 08:41:41'),
(68, 'captain', 'consult11@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'captain.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 09:14:40'),
(69, 'Sakshi Kapote', 'kapotesakshi29@gmail.com', 'a037df1d6ebaad1fa1d709e7a7f24f69', '9325358061', 'larm-rmah-AEaTUnvneik-unsplash.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 09:27:49'),
(70, 'Abhishek', 'user9@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'Abhishek.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 09:59:24'),
(71, 'Captain', 'user10@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'Captain.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 10:02:32'),
(72, 'Udeshya', 'consult12@gmail.com', '7694f4a66316e53c8cdd9d9954bd611d', '123', 'Udeshya.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 10:30:20'),
(73, 'ajay', 'chotu.sania@gmail.com', '033c91317f9b6795106a825cf8ef773d', '9056454545', 'IMG-20200524-WA0004 (2).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 13:07:22'),
(74, 'xxxx', 'chotu.sania@mail.com', '033c91317f9b6795106a825cf8ef773d', '9023453443', 'IMG-20200524-WA0004 (2).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-04 13:14:29'),
(75, 'Ankit', 'ankit@gmail.com', '033c91317f9b6795106a825cf8ef773d', '8023232323', 'IMG-20200524-WA0004 (2).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-05 13:38:24'),
(76, 'Saurabh  Chuadhari', 'chaudharisaurabh5699@gmail.com', '4b46da8494c1f6654ced844e79d7461f', '9579526346', 'saur pic.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-07 11:52:10'),
(77, 'Abhinav Tiwari', 'abhinavtiwari8539@gmail.com', '1022e0c6591b4daf92232a387febeda2', '9595503331', 'original_608928e1-df49-488f-9521-4be8117164a7_IMG_20211103_164024.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-07 12:46:48'),
(78, 'Ankit', 'chotu.sonia@mail.com', '033c91317f9b6795106a825cf8ef773d', '9606888725ccccc\n\n&&&&&&\n9606888745\n69999887776', 'Ankit.jpeg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-08 02:52:35'),
(79, 'Ankit', 'cu.sania@mail.com', '033c91317f9b6795106a825cf8ef773d', '9606888725ccccc\n\n&&&&&&\n9606888745\n69999887776', 'Ankit.jpeg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-08 02:53:05'),
(80, 'gggg', 'arige@gmail.com', '033c91317f9b6795106a825cf8ef773d', '7876686767', 'gggg.jpeg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-08 02:53:56'),
(81, '4667888', 'pawarpsp97@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', '4567890321', '4667888.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-08 16:42:45'),
(83, 'Umesh Anil Khandare', 'khandareumesh13@gmail.com', '3e9fd42e162f89f36b1f424168be8cc9', '8390139031', 'passport.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-11 10:17:28'),
(84, 'Vaibhav Khandare', 'khandareumesh14@gmail.com', '3e9fd42e162f89f36b1f424168be8cc9', '8390139031', 'download.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-11 10:51:59'),
(85, 'ShaliniAnil Khandare', 'khandareumesh15@gmail.com', '3e9fd42e162f89f36b1f424168be8cc9', '8830242472', '1d40e597ad5436038925729677c9314b (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-11 11:40:51'),
(86, 'Roshan patil', 'patilroshan503@gmail.com', '687af8c029f9df52e0b934a60a126bdc', '8793073594', 'WhatsApp Image 2022-01-07 at 11.46.30 PM.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-11 11:57:15'),
(87, 'varunk', 'varunmanila89@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '8722235441', '6-024f0ee051991.png', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-13 06:54:47'),
(88, 'sam', 'sameedham01@gmail.com', '28e0ef517bcc607039da951ae7e557a1', '9497588490', 'Capture.PNG', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-13 07:48:14'),
(89, 'Sandeep mewada', 'sandeepmewada76@gmail.com', '1a60af4377c3f0fdacf0bbe36b1ddeb2', '7746875035', 'j.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 03:00:12'),
(90, 'M.A Muzakkir Ahmed', 'muzakkirma143@gmail.com', 'b00fafbd84a2ad59491ea0d460a132a2', '8309242968', 'IMG_20191120_214146.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 03:02:52'),
(91, 'Varad Sandip waikar', '1999varadwaikar@gmail.com', 'e927ec1cf5f8024d7d7918e092196a17', '9370226616', 'IMG20210109114236.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 03:03:26'),
(92, 'satyapriya sahani', 'satyapriyasahani0@gmail.com', 'fea3a5239d0fef390dc7ff6e8b4bb5a4', '9348364689', 'proflle.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 03:06:56'),
(93, 'Sudhanshu Shukla', 'sudhanshushukla071@gmail.com', 'a06de0a2eecd625a7df6de1a3ac8f86f', '9867179095', 'image.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 03:29:00'),
(94, 'Nagajyothi', 'kottamnagajyothi176@gmail.com', '9a2b21da8911551e82d08f6d3e9b8109', '9502506275', 'IMG_20211221_150242.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 03:55:33'),
(95, 'Meghana N', '1997meghana@gmail.com', '61c9c103a8935ef5d85f5d3bc22f317c', '9036660481', 'meghana_n_x964wmqacba1n9ev1fhtnufq.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 04:19:13'),
(96, 'JOY BOSU', 'joybosu456@gmail.com', '2d2a8d39259a3766b3ee001395f22be3', '8391906640', '20211227_004007.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 05:32:38'),
(97, 'chetan mal', 'cmali507@gmail.com', '12865c376dccb42c2f49c3d61dc5e4e2', '9545270449', 'logo.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 06:17:17'),
(98, 'Vidya', 'vdzuluk@gmail.com', '6679d239d5a3f312c2890cec31deb043', '9130051978', 'Photo.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 09:57:51'),
(99, 'manthan', 'manthan@gmail.com', 'a30be188929d68d782a1cfaf3882ac34', '9878963564', 'mantha_786_gate_img.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 10:03:51'),
(100, 'manthan', 'manthanbansal1@gmail.com', 'a30be188929d68d782a1cfaf3882ac34', '9574565556', 'mantha_786_gate_img.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 10:05:05'),
(101, 'Tushar tyagi', 'mailtotushartyagi07@gmail.com', 'e71b014ee5194c95ce724c2c13b6b3cc', '8077099135', 'b8c7960a-4aad-4bf9-86de-ace05fd11c23.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 12:18:11'),
(102, 'Krati Varshney', 'varshneykrati8532@gmail.com', '7cce1ebe8540ba334b82b64a648a84d8', '8532044845', 'Picsart_22-01-14_17-16-14-602.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 12:32:12'),
(103, 'Varad Waikar', 'varadwaikar7@gmail.com', 'ed18a427c27d619fb31d1d1d77e0abfe', '9370226616', 'IMG-20211108-WA0036.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 13:09:39'),
(104, 'Priyanka', 'priyankaminde1@gmail.com', 'c9f590f5e729544e3a6bd2e819de721d', '9359977210', 'IMG-20220113-WA0015.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-14 16:30:43'),
(105, 'Soumyaranjan Sahoo', 'soumyaranjanalex@gmail.com', 'f23acfee1498d098634d9ab270012634', '9114558681', 'Soumya Image2.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-15 17:42:59'),
(106, 'demo', 'demo@spacece.co', '62cc2d8b4bf2d8728120d052163a77df', '8722235441', 'Screenshot 2021-12-28 142015.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-18 09:40:01'),
(107, 'susmita', 'chotu.nia@mail.com', '033c91317f9b6795106a825cf8ef773d', '9045634567', 'IMG-20200524-WA0004 (2).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 09:51:00'),
(108, 'Susmita Vulli', 'choti.nia@mail.com', '033c91317f9b6795106a825cf8ef773d', '9606888725', 'IMG-20200524-WA0004 (2).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 09:55:23'),
(109, 'Susmita Vulli', 'choti.niai@mail.com', '033c91317f9b6795106a825cf8ef773d', '9606888725', 'IMG-20200524-WA0004 (2).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 10:07:58'),
(110, 'Susmita Vulli', 'chotu.ni@mail.com', '033c91317f9b6795106a825cf8ef773d', '9606888725', 'IMG-20200524-WA0004 (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 12:36:42'),
(111, 'Susmita Vulli', 'choi.niai@mail.com', '033c91317f9b6795106a825cf8ef773d', '9606888725', 'IMG-20200524-WA0004 (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 12:45:01'),
(112, 'SHAIK SUFIAN', 'sufi3135@gmail.com', 'e3cbb2cb8ed152783f8d3b523bb77bfd', '8686332453', '20211006_155836_compress63.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 13:10:16'),
(113, 'Vishal Chothe', 'vishalchothe134@gmail.com', '8ab5220ef349856049f73d0bc4a17846', '9552001231', 'Passport Size.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 14:09:32'),
(114, 'Vishal Sir', 'vishalchothe123@gmail.com', '8ab5220ef349856049f73d0bc4a17846', '9552001231', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 19:50:00'),
(115, 'Vishal Sir', 'vishalsir123@gmail.com', 'ae1285ab8aaaca3c8fb0f140c815a983', '9552001231', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 19:52:18'),
(116, 'Vishal Sir', 'vishal123@gmail.com', 'ae1285ab8aaaca3c8fb0f140c815a983', '9552001231', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 19:57:25'),
(117, 'Vishal Sir', 'vishalkumar@gmail.com', 'ae1285ab8aaaca3c8fb0f140c815a983', '8698720310', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 20:00:59'),
(118, 'Vishal Sir', 'vishalwinner1707@gmail.com', 'ae1285ab8aaaca3c8fb0f140c815a983', '8698720310', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 20:01:32'),
(119, 'Vishal', 'vishalwinners1707@gmail.com', '8ab5220ef349856049f73d0bc4a17846', '9552001231', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 20:15:30'),
(120, 'Rahul Kadam', 'rahulkadam123@gmail.com', 'ebaaba27b32928a25f2ad6185fc0cc74', '8698720310', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 20:34:19'),
(121, 'Amol', 'amolmule1707@gmail.com', 'ebaaba27b32928a25f2ad6185fc0cc74', '8698720310', 'Passport Size.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 20:40:54'),
(122, 'Somnath', 'somnathtodmal17@gmail.com', '2de29bf005022948b50c91fc6927d56e', '8698720310', 'Passport Size.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-19 20:43:42'),
(123, 'feff', 'cwmk2kd@fmef.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '8238872884', 'temp.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-20 06:38:58'),
(124, 'djq', 'abc@g.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', '7777777777', 'temp.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-20 06:40:20'),
(125, 'Koravakutti Pruduvi', 'prudhvicherry082@gmail.com', '1f49ea40b689efd15ca2b751ea524286', '9110359617', 'prudhvi.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-20 15:37:42'),
(126, 'Anwesha', 'panigrahianwesha2@gmail.com', '7c6197c698b6a77abb6d808b29de3cfa', '8144743349', 'IMG_20220106_192506_467.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-20 17:21:15'),
(127, 'K Snehashree', 'ksnehashree1998@gmail.com', 'c16e0c932d5c8a13f59f05b3c7cb6830', '7978079961', 'IMG_20211104_185902.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-20 20:06:57'),
(128, 'Madhav Vermani', 'madhav.vermani@gmail.com', 'f348f50d048149b4ef944dd0682ae313', '9463648559', 'IMG_0856 (1).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-20 20:28:21'),
(129, 'Megha', 'megnamegna623@gmail.com', '489877ec5b7a26bcc731272882ab08e4', '9353243722', 'IMG_20210916_193518_11zon.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 02:06:59'),
(130, 'Jui walimbe', 'walimbejui@gmail.com', 'b0ba8ff8f9af7ee8af78785929fa9686', '9595406338', 'photo.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 03:04:19'),
(131, 'shaik sharuk', 'sharuk2016@gmail.com', '73eadf6fb46a9770bc5019e99c5be539', '9908040203', 'IMG-20201016-WA0004.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 05:38:14'),
(132, 'Rupam', 'therupss1709@gmail.com', '703400f84cc6ff6a003ff98e80672002', '9766071709', 'myself.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 05:44:56'),
(133, 'vrushali', 'vrushalimali165@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9075470346', 'vrushali img.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 06:44:44'),
(134, 'Mandakini Holambe', 'holambemanvi@gmail.com', 'b4e09e59c33761637581fd900a2a567a', '8390592320', '1641636912528-01.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 07:32:09'),
(135, 'Rohit G', 'rohitsmart1397@gmail.com', 'c58d3e9e7377b02c8c9998121ccc23dd', '9361884561', 'IMG_20220114_075100.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 07:33:19'),
(136, 'pavan', 'pavan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9988776655', 'download (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 17:03:22'),
(137, 'pavan', 'pavan123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9988776655', 'download (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 17:03:39'),
(138, 'pavan', 'pavan1234@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9988776655', 'download (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 17:03:59'),
(139, 'pavan', 'pavan890@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9988776655', 'download (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 17:04:19'),
(140, 'pavan', 'pawan890@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9988776655', 'download (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 17:05:27'),
(141, 'pavan', 'pawan110@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9988776655', 'download (2).jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-01-21 17:05:51'),
(142, 'Sumithra', 'sumithradegala612@gmail.com', '5542e2be971c3ebea19d20a9482d1a88', '9963043027', 'file.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 03:00:36'),
(143, 'Mohammed imthiyas', 'imthiyasm549@gmail.com', '01fa9fdd2d7f52ca800cc6a95b75d6af', '8903893617', 'IMG-20210820-WA0008.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 04:57:35'),
(144, 'Komal Hiwale', 'komalhiwale1267@gmail.com', 'dda2865a243bef529355f72d49a527d3', '7350192203', 'IMG_20200928_110921624~2_5~2.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 07:05:15'),
(145, 'Bhagyashri Patil', 'bhagyashrippatil925@gmail.com', 'e9a8e8154d7d66a9332dfebf8c4c4fb6', '9373553457', 'IMG_20220121_114912.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 07:07:18'),
(146, 'Shilpashree S', 'shilpashreeeshilpa01@gmail.com', 'db4bbb687bbfedd95c9ce14f5ba8a995', '9113916447', 'IMG-20211124-WA0000.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 08:10:07'),
(147, 'Vishakha', 'vishakhapatil350@gmail.com', 'e7ea6be45d92501649db79a0a66f7217', '9579775298', 'IMG-20210719-WA0044.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 08:32:29'),
(148, 'Roshan', 'roshansadafale@gmail.com', '865705f3d16ae6a06e4c8d9a8c473258', '9421757890', 'IMG20191001155026.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 10:22:57'),
(149, 'Rupali', 'rupalimahalle121@gmail.com', '8ad62f8bdef2ba3ebcfc3158cf06c529', '7620287846', 'IMG20191001155026.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 10:26:16'),
(150, 'Rupali', 'rupalimahalle121@gamil.com', '8ad62f8bdef2ba3ebcfc3158cf06c529', '7620287846', 'IMG20191210190810.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 11:04:22'),
(151, 'Vaishali', 'vaishalisharma3468@gmail.com', '09866ff76e5a5194f118bb77dc514845', '7015702598', '20211101_154424.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 11:58:06'),
(152, 'ddd', 'dsf@ham.ccnc', '96e79218965eb72c92a549dd5a330112', '9011111112', 'img6.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 12:56:28'),
(153, 'Preethi Shetty DB', 'preethishetty0514@gmail.com', 'c0a752ce365cf58e189be96aeccf1851', '9448470151', 'Photo.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 13:01:47'),
(154, 'abc', 'abcd@gmail.com', '96e79218965eb72c92a549dd5a330112', '9090908901', 'img4.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 13:11:31'),
(155, 'aaaaaaaaaa aaaa aaaa', 'qqqq@gmail.com', '343b1c4a3ea721b2d640fc8700db0f36', '9834484870', 'img4.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 13:13:28'),
(156, 'avc', 'avc@gmail.com', '670b14728ad9902aecba32e22fa4f6bd', '9834484800', 'An-overview-of-wireless-network-virtualization.png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 14:09:06'),
(157, 'Jay Tiwaskar', 'jtiwaskar@gmail.com', 'cd2e5239aa2ec4bba574bba4dbe6543c', '8983242574', 'PicsArt_07-04-09.11.57 (1).jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 14:34:22'),
(158, 'JenniferS', 'jenniferjaddu143@gmail.com', '4ec162b842343137fd353bf8d9636d94', '9113611321', 'IMG_20220114_201950.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 14:41:39'),
(159, 'Mithilesh Kharvi', 'mithukharvi8277@gmail.com', '086a31c328768e68ac4191fecf520973', '8792028220', 'SAVE_20220123_091914.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 14:47:18'),
(160, 'Abc', 'abc190@gmail.com', '200820e3227815ed1756a6b531e7e0d2', '7080901020', 'Test.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 14:51:40'),
(161, 'Sachin Bharat Algule', 'sachinalgule687@gmail.com', '46fc7657ceb875768ef0d416b13fdc39', '8411829301', '1642927514156.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 15:43:21'),
(162, 'Sachin Bharat Algule', 'sachinalgule358@gmail.com', '46fc7657ceb875768ef0d416b13fdc39', '8411829301', '1642927514156.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 15:47:23'),
(163, 'Preethi Shetty DB', 'preethi2017075@staloysius.ac.in', 'c0a752ce365cf58e189be96aeccf1851', '9448470151', 'Photo.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-26 15:54:15'),
(164, 'Vikas Tiwari', '2020aspire39@gmail.com', '26b51c849e1c36fd42868179a8bcad7a', '7696387507', '200kb pic.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-27 12:02:19'),
(165, 'August Kumar Roy', '7445august@gmail.com', '9d64e910971918e63e25d27f88d8d869', '9430476827', '2020 Recently Photo copy.jpg_Aug.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-28 11:40:52'),
(166, 'Shubham Jena', 'shubhamjena2090@gmail.com', 'd01f5dcd50835a2233696855b1792537', '9658230354', 'IMG_20220116_162425.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-29 06:30:36'),
(167, 'Raman Kumar', 'ramanpri702@gmail.com', '2106b588dea58d358a1607eb3277e73c', '7061321191', 'IMG_20210804_141125.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-29 10:29:34'),
(168, 'Shubham Metkar', 'shubhammetkar2000@gmail.com', 'f91e15dbec69fc40f81f0876e7009648', '8600880085', 'IMG_20211123_162325-removebg-preview.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-29 15:58:48'),
(169, 'JUDE ANTONY', 'jude.ash.antony@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9008438156', '24842.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-29 16:35:41'),
(170, 'Vishwesh', 'vishweshnaik62@gmail.com', '95d47be0d380a7cd3bb5bbe78e8bed49', '8431639251', 'IMG_20201007_160153.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-29 16:41:57'),
(171, 'kodathala Sravani', 'k9sravani@gmail.com', 'ee6fc22e19d1a018b0dba33165271651', '9963178368', '1637940860089_1637940859407_1637940859076_1637940858484_1637940856084_1637940824451_1634015509895.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-30 02:19:06'),
(172, 'RANGULA SATHVIKA', 'sathvikarangula5@gmail.com', '7ebc440b244d87648a26df4560862874', '9490156411', 'Square Fit_20211123233022400.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-30 05:34:56'),
(173, 'SHAMSUDDEEN', 'shamsushaaz121@gmail.com', 'c480cac4147dc08f0f6f96e8e2b8c91b', '9995530058', 'IMG-20211221-WA0005-01.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-30 06:12:42'),
(174, 'ashish kumar', 'ashishtejyan5462@gmail.com', 'e71b014ee5194c95ce724c2c13b6b3cc', '8433234199', 'b8c7960a-4aad-4bf9-86de-ace05fd11c23.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-01-31 12:14:33'),
(175, 'MAITHRI L', 'maithrilgowda15@gmail.com', '8c8382cf4bfa46d12bae18d0e1c1c359', '9113500910', 'maithri.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-01 02:18:21'),
(176, 'Meghana N', 'manjunnath3@gmail.com', '61c9c103a8935ef5d85f5d3bc22f317c', '9036660481', '20190104_174719.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-01 17:27:11'),
(177, 'Manogneta K', 'manognetakk99@gmail.com', 'ec75c81e00e06fbb1c99e8ab5e7637bb', '9148608489', '3C3758E0-EE53-4DF8-8B5A-4C286B39B062.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-02 18:03:51'),
(178, 'Mayank Singh', 'mayanksingh092000@gmail.com', 'baae685b0f8f708fdd1e9f934dae17cc', '7897209410', 'pic.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-02 18:11:39'),
(179, 'Raman kumar', 'saxenaraman664@gmail.com', 'c92c1f27e91c39667bc35bffe94eee30', '7566020226', 'WhatsApp Image 2021-07-26 at 12.30.16 PM.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-02 18:24:43'),
(180, 'Nimith Y', 'nimih003@gmail.com', 'edc6f6be38e2b6698fbd5c2ef496fe13', '9741635261', '2017064.JPG', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-02 18:26:38'),
(181, 'Nimith Y', 'nimithyoga@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', '9741635261', '2017064.JPG', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-02 18:29:53'),
(182, 'Salovar Kasim Shaikh', 'salovarshaikh@gmail.com', '903645e7a390302ce7e09f55f3935b37', '9284144884', 'IMG_20171114_083646.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-03 02:24:47'),
(183, 'khe', '12@gmail.com', '25f9e794323b453885f5181f1b624d0b', '9839798334', 't4.png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-04 07:25:54'),
(184, 'BATTU SHALOM RAJU', 'shalom.bnri777@gmail.com', 'b36b2fe76b6f539acff4212c6c8eb0c3', '8985604484', 'd8ck577-6a99d0bf-cb7f-4d6f-9633-60231739555a.png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-05 06:46:05'),
(185, 'Patil Mankarnika', 'patilmankarnika10@gmail.com', '5d61a84db0f9fa969fc74255cecf8925', '9322612496', 'IMG-20200705-WA0126.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 02:39:34'),
(186, 'Bhavyashree', 'bhavyapsuvarna@gmail.com', '6eaa8fa04a44cffd0f3a37622898f78e', '7760295038', 'bhavyapicss.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 04:44:04'),
(187, 'Greeshma .', 'greeshmasaliank@gmail.com', '1c54bd6fadb47267105644935514712c', '9019738758', 'bir.PNG', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 07:11:28'),
(188, 'Bhavyashree', 'bhavya99ps@gmail.com', '468e2afcf201cf1e0ed1653ed11d23ab', '9945032874', 'IMG-20220206-WA0017.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 07:24:11'),
(189, 'Bhavya', 'bhavyapsuvarnass@gmail.com', '440ac85892ca43ad26d44c7ad9d47d3e', '9945032874', '1.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 07:37:49'),
(190, 'Bhavya', 'appus@gmail.com', '440ac85892ca43ad26d44c7ad9d47d3e', '9945032874', '1.jpg', 'consultant', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 07:38:08'),
(191, 'ashi', 'bhavya@gmail.com', '189342e2ed9d23bb9a02ecbf8ed06762', '8989891234', '1.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 07:39:52'),
(192, 'Deekshashetty D N', 'deekshashettydeek@gmail.com', 'b33db08282095eab9017463c55308ea4', '8904188002', 'download.png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 07:51:52'),
(193, 'Greee', 'gree@gma.com', 'e10adc3949ba59abbe56e057f20f883e', '8372861202', '26232698.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 12:11:26'),
(194, 'pooja shet', 'poojashet310@gmail.com', '545886c05bfb07ec20fc27c86072efd9', '8884522408', 'WhatsApp Image 2022-02-04 at 9.29.41 PM.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 13:24:44'),
(195, 'Keerthan L B', 'keerthanllb@gmail.com', 'd87008d773217eef3065b4c6616a73da', '8971892949', 'icon-g0c65a7aa8_1920.png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 14:16:21'),
(196, 'Ashwath', 'ashwathkulal04@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9902390243', 'Screenshot (22).png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 16:26:44'),
(197, 'Sandur Aruna', 'sandhur2017085@staloysius.ac.in', 'a743c26f0bd538051d612a6dd5909f19', '8746830391', 'Aruna.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 16:29:42'),
(198, 'Dhanraj', 'abcddvv@gmail.com', '25d55ad283aa400af464c76d713c07ad', '7777777777', '16441918375156945202747337664193.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-06 23:59:49'),
(199, 'Komal Shimpi', 'komalshimpi91198@gmail.comhhhh', '68673662afe234e2598220915639c3e2', '9689690336', 's1.png', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-07 14:56:14'),
(200, 'Mayuri Joshi', 'mayiijoshi30493@gmail.com', '27f07e6acdf983035487b8465cc7a58b', '8989508552', 'PHOTO.jpg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-02-10 10:26:29'),
(201, 'varun', 'varunmanila@gmail.com', 'e86fdc2283aff4717103f2d44d0610f7', '8951698546', 'home.png', 'customer', 0, 'active', 'inactive', 'inactive', '2022-02-23 05:16:03'),
(202, 'Sachin Mohite', 'sachin.mohite@spacece.co', NULL, '+919372744039', NULL, 'customer', 0, 'active', 'inactive', 'inactive', '2022-02-26 06:17:38'),
(207, 'Sachin Mohite', 'me@sachinmohite.com', '15285722f9def45c091725aee9c387cb', '9372744039', 'SpacECE Logo - Smaller.jpeg', 'customer', 0, 'inactive', 'inactive', 'inactive', '2022-03-29 17:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_mail`
--

CREATE TABLE `user_activity_mail` (
  `id` int NOT NULL,
  `u_id` int NOT NULL,
  `act_id` int NOT NULL,
  `act_date` date NOT NULL,
  `is_mail_sent` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activity_mail`
--

INSERT INTO `user_activity_mail` (`id`, `u_id`, `act_id`, `act_date`, `is_mail_sent`) VALUES
(473, 87, 32, '2022-03-11', 1),
(474, 53, 32, '2022-03-11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `noti_id` int NOT NULL,
  `id` int NOT NULL,
  `u_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `webhook`
--

CREATE TABLE `webhook` (
  `imojo_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `date_of_purchase` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_of_activation` timestamp NOT NULL,
  `date_of_expire` timestamp NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `webhook`
--

INSERT INTO `webhook` (`imojo_id`, `payment_id`, `u_email`, `p_name`, `date_of_purchase`, `date_of_activation`, `date_of_expire`, `amount`, `status`) VALUES
('MOJO2226A05D83107365', 'MOJO2226A05D83107365', 'sachin.mohite@spacece.co', 'SpacActive', '2022-02-26 06:12:44', '2022-02-26 06:12:43', '2022-03-26 00:00:00', 13.9, 'active'),
('MOJO2226E05D83107748', 'MOJO2226E05D83107748', 'sachin.mohite@spacece.co', 'SpacActive', '2022-02-26 06:21:03', '2022-02-26 06:21:03', '2022-03-26 00:00:00', 13.9, 'active'),
('MOJO2226H05D83106706', 'MOJO2226H05D83106706', 'sachin.mohite@spacece.co', 'SpacActive', '2022-02-26 06:13:09', '2022-02-26 06:13:09', '2022-03-26 00:00:00', 13.9, 'active'),
('MOJO2226T05D83108807', 'MOJO2226T05D83108807', 'sachin.mohite@spacece.co', 'SpacActive', '2022-02-26 06:41:46', '2022-02-26 06:41:46', '2022-03-26 00:00:00', 13.9, 'active'),
('MOJO2226U05D83105709', 'MOJO2226U05D83105709', 'sachin.mohite14@apu.edu.in', 'SpacActive', '2022-02-26 05:53:17', '2022-02-26 05:35:52', '2022-03-26 00:00:00', 13.9, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consultant`
--
ALTER TABLE `consultant`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `c_category` (`c_category`),
  ADD KEY `consultant_ibfk_1` (`u_id`);

--
-- Indexes for table `consultant_category`
--
ALTER TABLE `consultant_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_ibfk_1` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `learnonapp_courses`
--
ALTER TABLE `learnonapp_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learnonapp_messages`
--
ALTER TABLE `learnonapp_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learnonapp_subcourses`
--
ALTER TABLE `learnonapp_subcourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learnonapp_subcourses_ibfk_1` (`cid`);

--
-- Indexes for table `learnonapp_users_courses`
--
ALTER TABLE `learnonapp_users_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `learnonapp_users_courses_ibfk_1` (`uid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ntfID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`p_id`),
  ADD UNIQUE KEY `p_name` (`p_name`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- Indexes for table `user_activity_mail`
--
ALTER TABLE `user_activity_mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `act_id` (`act_id`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `noti_id` (`noti_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `webhook`
--
ALTER TABLE `webhook`
  ADD PRIMARY KEY (`imojo_id`),
  ADD KEY `u_email` (`u_email`),
  ADD KEY `p_name` (`p_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consultant`
--
ALTER TABLE `consultant`
  MODIFY `c_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `consultant_category`
--
ALTER TABLE `consultant_category`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learnonapp_courses`
--
ALTER TABLE `learnonapp_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `learnonapp_messages`
--
ALTER TABLE `learnonapp_messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `learnonapp_subcourses`
--
ALTER TABLE `learnonapp_subcourses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `learnonapp_users_courses`
--
ALTER TABLE `learnonapp_users_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ntfID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `p_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `user_activity_mail`
--
ALTER TABLE `user_activity_mail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultant`
--
ALTER TABLE `consultant`
  ADD CONSTRAINT `consultant_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultant_ibfk_2` FOREIGN KEY (`c_category`) REFERENCES `consultant_category` (`cat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `courier`
--
ALTER TABLE `courier`
  ADD CONSTRAINT `courier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courier_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `libforsmall`.`orders` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `learnonapp_subcourses`
--
ALTER TABLE `learnonapp_subcourses`
  ADD CONSTRAINT `learnonapp_subcourses_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `learnonapp_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learnonapp_users_courses`
--
ALTER TABLE `learnonapp_users_courses`
  ADD CONSTRAINT `learnonapp_users_courses_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `learnonapp_users_courses_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `learnonapp_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD CONSTRAINT `user_notification_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_notification_ibfk_3` FOREIGN KEY (`noti_id`) REFERENCES `notifications` (`ntfID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
