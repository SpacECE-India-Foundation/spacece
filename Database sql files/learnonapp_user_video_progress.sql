-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 07:40 AM
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
-- Table structure for table `learnonapp_user_video_progress`
--

CREATE TABLE `learnonapp_user_video_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `is_completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `learnonapp_user_video_progress`
--

INSERT INTO `learnonapp_user_video_progress` (`id`, `user_id`, `course_id`, `video_id`, `is_completed`) VALUES
(17, 393, 25, 3, 1),
(18, 393, 25, 4, 1),
(19, 393, 25, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `learnonapp_user_video_progress`
--
ALTER TABLE `learnonapp_user_video_progress`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`video_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `video_id` (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `learnonapp_user_video_progress`
--
ALTER TABLE `learnonapp_user_video_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `learnonapp_user_video_progress`
--
ALTER TABLE `learnonapp_user_video_progress`
  ADD CONSTRAINT `learnonapp_user_video_progress_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `learnonapp_courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `learnonapp_user_video_progress_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `learnonapp_videos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
