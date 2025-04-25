-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 07:59 AM
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
-- Database: `cits1`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `MESSAGE` text NOT NULL,
  `CONTACT` varchar(50) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT 'UNREAD',
  `LOGS` text DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `NAME`, `EMAIL`, `MESSAGE`, `CONTACT`, `STATUS`, `LOGS`, `CREATED_AT`) VALUES
(1, 'ALICE JOHNSON', 'alice.johnson@example.com', 'Hi, I am interested in your services.', '123-456-7890', 'UNREAD', 'Message received via contact form.', '2025-04-18 05:52:42'),
(2, 'BOB SMITH', 'bob.smith@example.com', 'Can you provide more details?', '987-654-3210', 'UNREAD', NULL, '2025-04-18 05:52:42'),
(3, 'CHARLIE LEE', 'charlie.lee@example.com', 'Looking forward to working with you!', 'charlie_lee', 'READ', 'Responded on 2025-04-17.', '2025-04-18 05:52:42'),
(4, 'DIANA KING', 'diana.king@example.com', 'Please get back to me ASAP.', '@dianaking', 'UNREAD', '', '2025-04-18 05:52:42'),
(5, 'ETHAN BROWN', 'ethan.brown@example.com', 'Is there a brochure I can download?', 'ethan.b.contact', '0', 'Sent brochure link.', '2025-04-18 05:52:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
