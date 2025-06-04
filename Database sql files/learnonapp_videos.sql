-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 07:36 AM
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
-- Database: `spacece`
--

-- --------------------------------------------------------

--
-- Table structure for table `learnonapp_videos`
--

CREATE TABLE `learnonapp_videos` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `video_title` varchar(255) DEFAULT NULL,
  `video_link` text NOT NULL,
  `duration` varchar(20) DEFAULT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `learnonapp_videos`
--

INSERT INTO `learnonapp_videos` (`id`, `course_id`, `video_title`, `video_link`, `duration`, `sort_order`) VALUES
(3, 25, 'Introduction to Infant Care', 'https://videos.example.com/infant_intro.mp4', NULL, 1),
(4, 25, 'Feeding and Nutrition Basics', 'https://videos.example.com/infant_feeding.mp4', NULL, 2),
(5, 25, 'Safe Sleep and Daily Routines', 'https://videos.example.com/infant_sleep.mp4', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `learnonapp_videos`
--
ALTER TABLE `learnonapp_videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `learnonapp_videos`
--
ALTER TABLE `learnonapp_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `learnonapp_videos`
--
ALTER TABLE `learnonapp_videos`
  ADD CONSTRAINT `learnonapp_videos_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `learnonapp_courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
