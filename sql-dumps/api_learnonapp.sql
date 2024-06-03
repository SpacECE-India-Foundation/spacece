-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 07:31 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_learnonapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `learnon_courses`
--

CREATE TABLE `learnon_courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `mode` enum('Online','Offline') NOT NULL,
  `duration` smallint(6) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learnon_courses`
--

INSERT INTO `learnon_courses` (`id`, `title`, `description`, `type`, `mode`, `duration`, `price`) VALUES
(1, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99),
(2, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99),
(3, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99),
(4, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99),
(5, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99),
(6, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99),
(7, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99),
(8, 'Lorem ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.', 'Whatsapp', 'Online', 30, 49.99);

-- --------------------------------------------------------

--
-- Table structure for table `learnon_messages`
--

CREATE TABLE `learnon_messages` (
  `id` int(11) NOT NULL,
  `no_of_day` smallint(6) NOT NULL,
  `time` varchar(100) NOT NULL,
  `header` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `learnon_users`
--

CREATE TABLE `learnon_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `days` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learnon_users`
--

INSERT INTO `learnon_users` (`id`, `name`, `email`, `password`, `phone`, `days`, `created_at`) VALUES
(1, 'Krishna Thorat', 'krishna.thorat20@vit.edu', '8a6f2805b4515ac12058e79e66539be9', '8550969625', 0, '2021-10-11 09:16:43'),
(5, 'Sunil Shahu', 'sunilshahu07@gmail.com', '8a6f2805b4515ac12058e79e66539be9', '9730536037', 0, '2021-10-12 05:59:44'),
(6, 'sssss', 'sssss@gmail.com', '2d02e669731cbade6a64b58d602cf2a4', 'sssss', 0, '2021-10-12 07:50:18'),
(7, 'Shubham Gangurde', 'shubhamvijaygangurdes2012@gmail.com', '7dbfc9764ca694169f1af5e31f2b04a0', '9892380935', 0, '2021-10-12 09:35:44'),
(8, 'sssss', 'sssss@sssss', '033c91317f9b6795106a825cf8ef773d', 'ssssssssss', 0, '2021-10-12 09:51:52'),
(9, 'sssss', 'ssss@ss', '033c91317f9b6795106a825cf8ef773d', 'sasasasasasasasa', 0, '2021-10-12 10:36:18'),
(10, 'sssss', 'chotu.sonia@gmail.com', '1cef3477dff8074020152072fcc68ed9', '9606888725', 0, '2021-10-12 11:03:39'),
(11, 'Ashutosh Soni', 'Asonibgh@gmail.com', '87f5ce84d66c6ca661f614213858b0b4', '+447008970861', 0, '2021-10-12 16:45:32'),
(12, 'abcd', 'abcd123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234567890', 0, '2021-10-12 16:51:25'),
(13, 'Siddhi Vora', 'siddhivora9@gmail.com', '8834f6271bf3eeddc7649489c461b02a', '+919409156737', 0, '2021-10-13 04:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `learnon_users_courses`
--

CREATE TABLE `learnon_users_courses` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `learnon_users_courses`
--

INSERT INTO `learnon_users_courses` (`id`, `uid`, `cid`, `payment_status`, `payment_details`, `created_at`) VALUES
(2, 1, 1, 0, NULL, '2021-10-11 09:27:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `learnon_courses`
--
ALTER TABLE `learnon_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learnon_messages`
--
ALTER TABLE `learnon_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `learnon_users`
--
ALTER TABLE `learnon_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `learnon_users_courses`
--
ALTER TABLE `learnon_users_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `cid` (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `learnon_courses`
--
ALTER TABLE `learnon_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `learnon_messages`
--
ALTER TABLE `learnon_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `learnon_users`
--
ALTER TABLE `learnon_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `learnon_users_courses`
--
ALTER TABLE `learnon_users_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `learnon_users_courses`
--
ALTER TABLE `learnon_users_courses`
  ADD CONSTRAINT `learnon_users_courses_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `learnon_users` (`id`),
  ADD CONSTRAINT `learnon_users_courses_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `learnon_courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
