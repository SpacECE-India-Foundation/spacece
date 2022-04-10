-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 09:00 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdcms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `babysitter_details`
--

CREATE TABLE `babysitter_details` (
  `babysitter_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter_details`
--

INSERT INTO `babysitter_details` (`babysitter_id`, `meta_field`, `meta_value`) VALUES
(1, 'firstname', 'Claire'),
(1, 'middlename', 'C'),
(1, 'lastname', 'Blake'),
(1, 'gender', 'Female'),
(1, 'email', 'cblake@sample.com'),
(1, 'contact', '09123456789'),
(1, 'address', 'Here Street, There City, Anywhere, 1014'),
(1, 'skills', 'Achievement 101, Achievement 102, Achievement 103, Achievement 104, and Achievement 105'),
(1, 'years_experience', '5'),
(1, 'other', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus.'),
(1, 'firstname', 'Claire'),
(1, 'middlename', 'C'),
(1, 'lastname', 'Blake'),
(1, 'gender', 'Female'),
(1, 'email', 'cblake@sample.com'),
(1, 'contact', '09123456789'),
(1, 'address', 'Here Street, There City, Anywhere, 1014'),
(1, 'skills', 'Skill 101, Skill 102, Skill 103, Skill 104, and Skill 105'),
(1, 'years_experience', '5'),
(1, 'achievement', 'Achievement 101, Achievement 102, Achievement 103, Achievement 104, and Achievement 105'),
(1, 'other', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus.'),
(1, 'firstname', 'Claire'),
(1, 'middlename', 'C'),
(1, 'lastname', 'Blake'),
(1, 'gender', 'Female'),
(1, 'email', 'cblake@sample.com'),
(1, 'contact', '09123456789'),
(1, 'address', 'Here Street, There City, Anywhere, 1014'),
(1, 'skills', 'Skill 101, Skill 102, Skill 103, Skill 104, and Skill 105'),
(1, 'years_experience', '5'),
(1, 'achievement', 'Achievement 101, Achievement 102, Achievement 103, Achievement 104, and Achievement 105'),
(1, 'other', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus.'),
(2, 'firstname', 'Mark'),
(2, 'middlename', 'D'),
(2, 'lastname', 'Cooper'),
(2, 'gender', 'Male'),
(2, 'email', 'mcooper@sample.com'),
(2, 'contact', '09123456789'),
(2, 'address', 'Sample Address'),
(2, 'skills', 'Sample Skills'),
(2, 'years_experience', '2'),
(2, 'achievement', 'Sample Achievements'),
(2, 'other', 'Sample Other'),
(3, 'firstname', 'Samantha'),
(3, 'middlename', ''),
(3, 'lastname', 'Lou'),
(3, 'gender', 'Female'),
(3, 'email', 'slou@sample.com'),
(3, 'contact', '09786654499'),
(3, 'address', 'Sample Address 101'),
(3, 'skills', 'Sample Skills 101'),
(3, 'years_experience', '1'),
(3, 'achievement', 'Sample Achievements 101'),
(3, 'other', 'N/A'),
(4, 'firstname', 'Cynthia'),
(4, 'middlename', 'C'),
(4, 'lastname', 'Anthony'),
(4, 'gender', 'Female'),
(4, 'email', 'canthony@sample.com'),
(4, 'contact', '09875469999'),
(4, 'address', 'Sample Address 102'),
(4, 'skills', 'Sample Skill 102'),
(4, 'years_experience', '2'),
(4, 'achievement', 'Sample Achievements 102'),
(4, 'other', 'N/A'),
(4, 'firstname', 'Cynthia'),
(4, 'middlename', 'C'),
(4, 'lastname', 'Anthony'),
(4, 'gender', 'Female'),
(4, 'email', 'canthony@sample.com'),
(4, 'contact', '09875469999'),
(4, 'address', 'Sample Address 102'),
(4, 'skills', 'Sample Skill 102'),
(4, 'years_experience', '2'),
(4, 'achievement', 'Sample Achievements 102'),
(4, 'other', 'N/A'),
(4, 'firstname', 'Cynthia'),
(4, 'middlename', 'C'),
(4, 'lastname', 'Anthony'),
(4, 'gender', 'Female'),
(4, 'email', 'canthony@sample.com'),
(4, 'contact', '09875469999'),
(4, 'address', 'Sample Address 102'),
(4, 'skills', 'Sample Skill 102'),
(4, 'years_experience', '2'),
(4, 'achievement', 'Sample Achievements 102'),
(4, 'other', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `babysitter_list`
--

CREATE TABLE `babysitter_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL DEFAULT '50',
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter_list`
--

INSERT INTO `babysitter_list` (`id`, `code`, `fullname`, `status`, `date_created`, `date_updated`) VALUES
(1, 'BS-2021120001', 'Blake, Claire C', 1, '2021-12-14 11:45:43', '2021-12-14 11:47:36'),
(2, 'BS-2021120002', 'Cooper, Mark D', 1, '2021-12-14 13:14:42', '2021-12-14 13:14:42'),
(3, 'BS-2021120003', 'Lou, Samantha ', 1, '2021-12-14 13:16:46', '2021-12-14 13:16:46'),
(4, 'BS-2021120004', 'Anthony, Cynthia C', 1, '2021-12-14 13:18:13', '2021-12-14 15:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_details`
--

CREATE TABLE `enrollment_details` (
  `enrollment_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment_details`
--

INSERT INTO `enrollment_details` (`enrollment_id`, `meta_field`, `meta_value`) VALUES
(1, 'child_firstname', 'James'),
(1, 'child_middlename', 'D'),
(1, 'child_lastname', 'McDowell'),
(1, 'gender', 'Male'),
(1, 'child_dob', '2020-11-30'),
(1, 'parent_firstname', 'John'),
(1, 'parent_middlename', 'C'),
(1, 'parent_lastname', 'McDowell'),
(1, 'parent_contact', '09123789564'),
(1, 'parent_email', 'jMcDowell@sample.com'),
(1, 'address', 'Here Street, There City, Anywhere 2306'),
(1, 'child_fullname', 'McDowell, James D'),
(1, 'parent_fullname', 'McDowell, John C'),
(2, 'child_firstname', 'Sofie Angeline'),
(2, 'child_middlename', 'M'),
(2, 'child_lastname', 'Richards'),
(2, 'gender', 'Female'),
(2, 'child_dob', '2021-02-08'),
(2, 'parent_firstname', 'Maureen'),
(2, 'parent_middlename', 'D'),
(2, 'parent_lastname', 'Richards'),
(2, 'parent_contact', '09123987546'),
(2, 'parent_email', 'mrichards@gmail.com'),
(2, 'address', 'Over There Block, Lot Here, Down There City, Everywhere, 1507'),
(2, 'child_fullname', 'Richards, Sofie Angeline M'),
(2, 'parent_fullname', 'Richards, Maureen D'),
(4, 'child_firstname', 'Jhonny'),
(4, 'child_middlename', 'B'),
(4, 'child_lastname', 'Smith'),
(4, 'gender', 'Male'),
(4, 'child_dob', '2020-06-14'),
(4, 'parent_firstname', 'John'),
(4, 'parent_middlename', 'D'),
(4, 'parent_lastname', 'Smith'),
(4, 'parent_contact', '09123456789'),
(4, 'parent_email', 'jsmith@sample.com'),
(4, 'address', 'Sample Address Only'),
(4, 'child_fullname', 'Smith, Jhonny B'),
(4, 'parent_fullname', 'Smith, John D');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_list`
--

CREATE TABLE `enrollment_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL,
  `child_fullname` text NOT NULL,
  `parent_fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment_list`
--

INSERT INTO `enrollment_list` (`id`, `code`, `child_fullname`, `parent_fullname`, `status`, `date_created`, `date_updated`) VALUES
(1, 'NTZ2021120001', 'McDowell, James D', 'McDowell, John C', 1, '2021-12-14 14:42:47', '2021-12-14 15:33:06'),
(2, 'LFC-2021120001', 'Richards, Sofie Angeline M', 'Richards, Maureen D', 1, '2021-12-14 14:49:01', '2021-12-14 15:33:11'),
(4, 'KNE-2021120001', 'Smith, Jhonny B', 'Smith, John D', 0, '2021-12-14 15:58:57', '2021-12-14 15:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Program 101', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras fringilla est mi, eget hendrerit lacus vehicula id. Nam nisi magna, venenatis sit amet placerat non, porttitor eu ante. Phasellus sagittis aliquam turpis et malesuada. Quisque sollicitudin sit amet mi non suscipit. Integer turpis magna, tempor nec orci vel, aliquet ultricies dolor. Nulla venenatis maximus gravida. Aenean scelerisque ornare nunc, sed tempor tortor blandit et.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:00', NULL),
(2, 'Program 102', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Nulla tincidunt felis felis, vel tempus ligula pulvinar id. Aenean sagittis, augue nec tempus mattis, purus ex tempus lorem, porta iaculis sem arcu ac ligula. Integer orci nisi, maximus at urna sit amet, dapibus imperdiet eros. In sit amet vulputate elit, non porttitor augue. Nunc sollicitudin scelerisque justo, ut semper neque laoreet a. Maecenas dictum venenatis viverra. Sed sit amet venenatis dui. Etiam ullamcorper viverra odio, quis pretium metus commodo eu. Quisque aliquam rutrum tellus id hendrerit. Etiam quis sem molestie, molestie magna eget, vestibulum urna. Phasellus vitae tristique nibh, id rhoncus justo.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:23', NULL),
(3, 'Program 103', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Maecenas elit massa, maximus molestie laoreet sit amet, dapibus eu leo. Curabitur vitae elit lacus. Aenean placerat, metus consectetur imperdiet interdum, metus eros interdum orci, sed eleifend purus orci in nibh. Nulla id urna ex. Nulla dolor sem, bibendum id tellus a, euismod consequat ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam facilisis sagittis ex, ut imperdiet tellus feugiat in. Morbi non commodo lacus. Donec varius sem et lectus tristique tincidunt. In volutpat id justo dictum pharetra. Sed ac scelerisque ipsum. Sed cursus elementum odio, eget gravida odio semper fringilla. Praesent lorem turpis, ultrices vitae porta eget, posuere in massa.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:33', NULL),
(4, 'Program 104', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Suspendisse suscipit luctus vulputate. Praesent ac mi vel tortor tincidunt ornare. Curabitur id arcu purus. Sed suscipit in purus in ultricies. Sed interdum vel odio a pellentesque. Nulla eget accumsan ipsum. Proin sapien magna, pretium eu lectus et, lacinia blandit mi. Sed cursus varius orci a laoreet. Ut vehicula fringilla placerat. Donec euismod tincidunt est sit amet mollis. Quisque pulvinar consequat mollis. Sed eget aliquam arcu. Morbi fermentum vel odio vitae tincidunt. Etiam congue imperdiet feugiat. In commodo placerat tellus.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:52', '2021-12-14 10:03:04'),
(5, 'Program 105', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam sollicitudin, elit pellentesque mattis interdum, augue orci blandit ex, ut viverra orci lorem at tellus. Morbi a rhoncus purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc et diam non urna porta tempus nec id enim. Suspendisse vestibulum ante eu maximus molestie.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:05:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Child Day Care Management System - PHP'),
(6, 'short_name', 'CDCMS - PHP'),
(11, 'logo', 'uploads/logo-1639445951.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1639445951.png'),
(15, 'content', 'Array'),
(16, 'email', 'info@babycareXYZ.com'),
(17, 'contact', '09854698789 / 78945632'),
(18, 'from_time', '11:00'),
(19, 'to_time', '21:30'),
(20, 'address', 'ABC Street, There City, Here, 2306');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2021-12-14 15:47:08'),
(3, 'Claire', NULL, 'Blake', 'cblake', '4744ddea876b11dcb1d169fadf494418', 'uploads/avatar-3.png?v=1639467985', NULL, 2, 1, '2021-12-14 15:46:25', '2021-12-14 15:46:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `babysitter_details`
--
ALTER TABLE `babysitter_details`
  ADD KEY `babysitter_id` (`babysitter_id`);

--
-- Indexes for table `babysitter_list`
--
ALTER TABLE `babysitter_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment_details`
--
ALTER TABLE `enrollment_details`
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indexes for table `enrollment_list`
--
ALTER TABLE `enrollment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `babysitter_list`
--
ALTER TABLE `babysitter_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollment_list`
--
ALTER TABLE `enrollment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `babysitter_details`
--
ALTER TABLE `babysitter_details`
  ADD CONSTRAINT `babysitter_details_ibfk_1` FOREIGN KEY (`babysitter_id`) REFERENCES `babysitter_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollment_details`
--
ALTER TABLE `enrollment_details`
  ADD CONSTRAINT `enrollment_details_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
