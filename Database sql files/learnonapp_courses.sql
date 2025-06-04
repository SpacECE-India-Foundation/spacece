-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2025 at 07:35 AM
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
-- Table structure for table `learnonapp_courses`
--

CREATE TABLE `learnonapp_courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `level` varchar(50) NOT NULL,
  `category` varchar(255) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `mode` enum('Online','Offline') NOT NULL,
  `duration` smallint(6) NOT NULL,
  `skill_gained` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `learnonapp_courses`
--

INSERT INTO `learnonapp_courses` (`id`, `title`, `description`, `level`, `category`, `logo`, `type`, `mode`, `duration`, `skill_gained`, `price`) VALUES
(16, 'Newborn Care Essentials', 'Learn to confidently care for your baby.\nNewborn care essentials include items for feeding, sleeping, diapering, bathing, and dressing.', 'Beginner', 'Infant care', 'newborn.jpg', '', 'Online', 13, 'Feeding & Soothing, Safe Practices, Developmental Milestones, Interpreting Cues', 0),
(17, 'Infant Development Milestones', 'Understand how babies grow physically and cognitively from birth to 12 months.', 'Intermediate', 'Child Development', 'infant-development.jpg', '', 'Online', 10, 'Milestone Tracking, Early Intervention Awareness, Growth Stages, Observation Techniques', 0),
(18, 'Pediatric Emergency Response and First Aid', 'Gain expertise in handling pediatric emergencies, from CPR to allergic reactions.', 'Advanced', 'Emergency Care', 'pediatric-emergency.jpg', '', 'Online', 15, 'CPR, Airway Management, Emergency Protocols, Allergy & Anaphylaxis Response', 0),
(19, 'Feeding an infant or young child', 'If you need help with breastfeeding, ask others for advice, such as asking a trained health worker or other experienced women\r\nFeed a baby only with breast milk for the first six months ', 'Beginner', 'Infant care', 'newborn.jpg', '', 'Online', 13, 'test', 0),
(20, 'What is sudden infant death syndrome (SIDS)', 'SIDS is the sudden death of an infant younger than 1 year of age that is still unexplained after a complete investigation. This investigation can include an autopsy, a review of the death scene, and taking complete family and medical histories.1\r\n\r\nNICHD leads federal research on SIDS, including ways to reduce the risk of SIDS. For more information, visit the SIDS A to Z topic.', 'Beginner', 'Infant care', 'newborn.jpg', '', 'Online', 13, 'testst', 0),
(21, 'testdfgdg', 'Learn to confidently care for your baby.', 'Beginner', 'Infant care', 'newborn.jpg', '', 'Online', 13, 'Feeding & Soothing, Safe Practices, Developmental Milestones, Interpreting Cues', 0),
(23, 'Infant Care Basics', 'Learn how to care for newborns.', 'Intermediate', 'Infant care', 'https://example.com/logo.jpg', '', 'Online', 10, 'Feeding, Sleeping, Soothing', 49.99),
(25, 'Essential Infant Care for New Parents', 'Learn how to take care of your newborn with confidence, covering feeding, sleep, hygiene, and health.', 'Beginner', 'Infant Care', 'infant-care-logo.png', '', 'Online', 2, 'Feeding, Diapering, Bathing, Infant Safety', 299);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `learnonapp_courses`
--
ALTER TABLE `learnonapp_courses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `learnonapp_courses`
--
ALTER TABLE `learnonapp_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
