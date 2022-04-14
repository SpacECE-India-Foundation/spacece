-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 31, 2022 at 11:52 AM
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
-- Database: `consultant_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int NOT NULL,
  `admin_pwd` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `admin_pwd`, `name`, `username`) VALUES
(1, 'admin', 'yash', 'yash007'),
(3, 'parth12345', 'parth', 'parththosani');

-- --------------------------------------------------------

--
-- Table structure for table `agora_call`
--

CREATE TABLE `agora_call` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `consult_id` varchar(50) NOT NULL,
  `channel_name` varchar(20) NOT NULL,
  `token` varchar(200) NOT NULL,
  `call_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `joining_url` text CHARACTER SET utf8mb4  NOT NULL,
  `c_time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `agora_call`
--

INSERT INTO `agora_call` (`id`, `user_id`, `consult_id`, `channel_name`, `token`, `call_time`, `joining_url`, `c_time`) VALUES
(72, '51', '39', 'varu39', '006464ff3e49fb3409494c0956edcec52e7IADfarjMyr/i+jgjKh5ZvFTnlnTa54jPrJNT5EuSGbwzEhY+ifAAAAAAIgAbXwAAPrvfYQQAAQDOd95hAwDOd95hAgDOd95hBADOd95h', '2022-01-12 11:10:18', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IADfarjMyr/i+jgjKh5ZvFTnlnTa54jPrJNT5EuSGbwzEhY+ifAAAAAAIgAbXwAAPrvfYQQAAQDOd95hAwDOd95hAgDOd95hBADOd95h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu39&id=39&user_id=51', 1641985818),
(73, '51', '39', 'varu39', '006464ff3e49fb3409494c0956edcec52e7IAAGjGWORu1GvtO9Z+QbcPRorc1kOC3Ox4oXQu7+7FgjcxY+ifAAAAAAIgAilAAAYsPfYQQAAQDyf95hAwDyf95hAgDyf95hBADyf95h', '2022-01-12 11:45:02', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IAAGjGWORu1GvtO9Z+QbcPRorc1kOC3Ox4oXQu7+7FgjcxY+ifAAAAAAIgAilAAAYsPfYQQAAQDyf95hAwDyf95hAgDyf95hBADyf95h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu39&id=39&user_id=51', 1641987902),
(74, '51', '39', 'varu39', '006464ff3e49fb3409494c0956edcec52e7IADdbN1WzLFZgGZz+05hAxTH22jIAaJiYj1X5p7q+dKsexY+ifAAAAAAIgCbswAAS8TfYQQAAQDbgN5hAwDbgN5hAgDbgN5hBADbgN5h', '2022-01-20 11:48:58', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IADdbN1WzLFZgGZz+05hAxTH22jIAaJiYj1X5p7q+dKsexY+ifAAAAAAIgCbswAAS8TfYQQAAQDbgN5hAwDbgN5hAgDbgN5hBADbgN5h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu39&id=39&user_id=51', 1642679338),
(75, '51', '39', 'varu39', '006464ff3e49fb3409494c0956edcec52e7IACFacTlIwI7Ck80Yzst05AAXg5rKtxtUAGR4mT0Mk2xgxY+ifAAAAAAIgD6tAAAyBzhYQQAAQBY2d9hAwBY2d9hAgBY2d9hBABY2d9h', '2022-01-13 12:19:17', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IACFacTlIwI7Ck80Yzst05AAXg5rKtxtUAGR4mT0Mk2xgxY+ifAAAAAAIgD6tAAAyBzhYQQAAQBY2d9hAwBY2d9hAgBY2d9hBABY2d9h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu39&id=39&user_id=51', 1642076357),
(76, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IABKdfUO/9Gtakvca7kUmr42JaG7u7sU6Ja8C7R90TCsY9rKxfQAAAAAIgC7uQAAkx7hYQQAAQAj299hAwAj299hAgAj299hBAAj299h', '2022-01-13 12:26:26', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IABKdfUO/9Gtakvca7kUmr42JaG7u7sU6Ja8C7R90TCsY9rKxfQAAAAAIgC7uQAAkx7hYQQAAQAj299hAwAj299hAgAj299hBAAj299h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642076786),
(77, '51', '39', 'varu39', '006464ff3e49fb3409494c0956edcec52e7IADIa0rq0dYlK/rwBoV1s/1/LaJpzV3S4G1uaC51e4yMIxY+ifAAAAAAIgBV9gAA1yDhYQQAAQBn3d9hAwBn3d9hAgBn3d9hBABn3d9h', '2022-01-13 12:36:04', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IADIa0rq0dYlK/rwBoV1s/1/LaJpzV3S4G1uaC51e4yMIxY+ifAAAAAAIgBV9gAA1yDhYQQAAQBn3d9hAwBn3d9hAgBn3d9hBABn3d9h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu39&id=39&user_id=51', 1642077364),
(78, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IACoK+gZvT5aRc8C8X78LfRsc4jt7SZ41Ib9CjguZ/s/9drKxfQAAAAAIgDPBwAA3yDhYQQAAQBv3d9hAwBv3d9hAgBv3d9hBABv3d9h', '2022-01-13 12:36:11', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IACoK+gZvT5aRc8C8X78LfRsc4jt7SZ41Ib9CjguZ/s/9drKxfQAAAAAIgDPBwAA3yDhYQQAAQBv3d9hAwBv3d9hAgBv3d9hBABv3d9h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642077371),
(79, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IAD9oCX7o0AjmUFbvy/EwlaiRWPy4p355fkwmX68bPRrN9rKxfQAAAAAIgBzigAAsCLhYQQAAQBA399hAwBA399hAgBA399hBABA399h', '2022-01-13 12:43:57', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IAD9oCX7o0AjmUFbvy/EwlaiRWPy4p355fkwmX68bPRrN9rKxfQAAAAAIgBzigAAsCLhYQQAAQBA399hAwBA399hAgBA399hBABA399h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642077837),
(80, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IAA5xjQMOmmRyPg5xI3sJDDhgEElMJnI/JnT2xCZ2AY9BtrKxfQAAAAAIgB+fQAAcSPhYQQAAQAB4N9hAwAB4N9hAgAB4N9hBAAB4N9h', '2022-01-13 12:47:09', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IAA5xjQMOmmRyPg5xI3sJDDhgEElMJnI/JnT2xCZ2AY9BtrKxfQAAAAAIgB+fQAAcSPhYQQAAQAB4N9hAwAB4N9hAgAB4N9hBAAB4N9h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642078029),
(81, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IACEmkXT5kqZbRhOlXP2FQTdsfS2aUpJYzkKSeP5Rl6nONrKxfQAAAAAIgB7vQAASyThYQQAAQDb4N9hAwDb4N9hAgDb4N9hBADb4N9h', '2022-01-13 12:50:48', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IACEmkXT5kqZbRhOlXP2FQTdsfS2aUpJYzkKSeP5Rl6nONrKxfQAAAAAIgB7vQAASyThYQQAAQDb4N9hAwDb4N9hAgDb4N9hBADb4N9h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642078248),
(82, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IAB6B0vDgTIXNgDmXNBMwrM7m2vRiyDK7c5ygnNvRnad9NrKxfQAAAAAIgApZwEAeSXhYQQAAQAJ4t9hAwAJ4t9hAgAJ4t9hBAAJ4t9h', '2022-01-13 12:55:54', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IAB6B0vDgTIXNgDmXNBMwrM7m2vRiyDK7c5ygnNvRnad9NrKxfQAAAAAIgApZwEAeSXhYQQAAQAJ4t9hAwAJ4t9hAgAJ4t9hBAAJ4t9h&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642078554),
(83, '51', '39', 'varu39', '006464ff3e49fb3409494c0956edcec52e7IADUIOmfmjim98ynAoX8gBMLWpIfYkyvEwHdUoTIEn/lhhY+ifAAAAAAIgA6VwEAG2PhYQQAAQCrH+BhAwCrH+BhAgCrH+BhBACrH+Bh', '2022-01-13 17:18:54', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IADUIOmfmjim98ynAoX8gBMLWpIfYkyvEwHdUoTIEn/lhhY+ifAAAAAAIgA6VwEAG2PhYQQAAQCrH+BhAwCrH+BhAgCrH+BhBACrH+Bh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu39&id=39&user_id=51', 1642094334),
(84, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IABDByOH4e874lDc6V/V9jLaROY6F+RtNagp0JY5PDmBdtrKxfQAAAAAIgAP8AAAAWrhYQQAAQCRJuBhAwCRJuBhAgCRJuBhBACRJuBh', '2022-01-13 17:48:25', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IABDByOH4e874lDc6V/V9jLaROY6F+RtNagp0JY5PDmBdtrKxfQAAAAAIgAP8AAAAWrhYQQAAQCRJuBhAwCRJuBhAgCRJuBhBACRJuBh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642096105),
(85, '51', '87', 'varu87', '006464ff3e49fb3409494c0956edcec52e7IAAAAMhxSgbiEy5Tjt4jCzX8kk4hTIc6uQBgYPPK9BMN8trKxfQAAAAAIgD+wQAA2o3hYQQAAQBqSuBhAwBqSuBhAgBqSuBhBABqSuBh', '2022-01-13 20:21:35', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IAAAAMhxSgbiEy5Tjt4jCzX8kk4hTIc6uQBgYPPK9BMN8trKxfQAAAAAIgD+wQAA2o3hYQQAAQBqSuBhAwBqSuBhAgBqSuBhBABqSuBh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varu87&id=87&user_id=51', 1642105295),
(86, '51', '39', 'varuKris', '006464ff3e49fb3409494c0956edcec52e7IACIi8J5B9LV4Y81ih4++gy8AF1BP/hjvkexH20v7Ngs5jBQVzMAAAAAIgAxZwEAIKThYQQAAQCwYOBhAwCwYOBhAgCwYOBhBACwYOBh', '2022-01-13 21:56:23', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IACIi8J5B9LV4Y81ih4++gy8AF1BP/hjvkexH20v7Ngs5jBQVzMAAAAAIgAxZwEAIKThYQQAAQCwYOBhAwCwYOBhAgCwYOBhBACwYOBh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuKris&id=39&user_id=51', 1642110983),
(87, '51', '39', 'varuKris', '006464ff3e49fb3409494c0956edcec52e7IACAni84s9ltfG06RhYpJ+7jItKYoLaM6Qop7zsPoM3QfjBQVzMAAAAAIgDw4wAAUaThYQQAAQDhYOBhAwDhYOBhAgDhYOBhBADhYOBh', '2022-01-13 21:57:01', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IACAni84s9ltfG06RhYpJ+7jItKYoLaM6Qop7zsPoM3QfjBQVzMAAAAAIgDw4wAAUaThYQQAAQDhYOBhAwDhYOBhAgDhYOBhBADhYOBh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuKris&id=39&user_id=51', 1642111021),
(88, '51', '39', 'varuKris', '006464ff3e49fb3409494c0956edcec52e7IAAbChRnu27Ke16NVyRAhT00h0icORhfumUPQYzZBWVGDTBQVzMAAAAAIgALVwAAkKThYQQAAQAgYeBhAwAgYeBhAgAgYeBhBAAgYeBh', '2022-01-13 21:58:04', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IAAbChRnu27Ke16NVyRAhT00h0icORhfumUPQYzZBWVGDTBQVzMAAAAAIgALVwAAkKThYQQAAQAgYeBhAwAgYeBhAgAgYeBhBAAgYeBh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuKris&id=39&user_id=51', 1642111084),
(89, '51', '87', 'varuvaru', '006464ff3e49fb3409494c0956edcec52e7IABynC6HoLbR+ssHvTHAUT5VGk24tdXV8e8ljwbCSjaCLcoDI28AAAAAIgBH1gAARb/hYQQAAQDVe+BhAwDVe+BhAgDVe+BhBADVe+Bh', '2022-01-13 23:51:56', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IABynC6HoLbR+ssHvTHAUT5VGk24tdXV8e8ljwbCSjaCLcoDI28AAAAAIgBH1gAARb/hYQQAAQDVe+BhAwDVe+BhAgDVe+BhBADVe+Bh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuvaru&id=87&user_id=51', 1642117916),
(90, '51', '87', 'varuvaru', '006464ff3e49fb3409494c0956edcec52e7IACx5aeFUqZ0xAonA6maQRb/oFc6VdBWeTGxZ2Da/pcoBMoDI28AAAAAIgBpHAEA3MDhYQQAAQBsfeBhAwBsfeBhAgBsfeBhBABsfeBh', '2022-01-13 23:58:43', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IACx5aeFUqZ0xAonA6maQRb/oFc6VdBWeTGxZ2Da/pcoBMoDI28AAAAAIgBpHAEA3MDhYQQAAQBsfeBhAwBsfeBhAgBsfeBhBABsfeBh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuvaru&id=87&user_id=51', 1642118323),
(91, '51', '87', 'varuvaru', '006464ff3e49fb3409494c0956edcec52e7IAC/CixOIy3g17k/v9ZN5+WzhrtW3joqjqBYwh/9DQHYGMoDI28AAAAAIgAzJAAAC8LhYQQAAQCbfuBhAwCbfuBhAgCbfuBhBACbfuBh', '2022-01-14 00:03:46', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IAC/CixOIy3g17k/v9ZN5+WzhrtW3joqjqBYwh/9DQHYGMoDI28AAAAAIgAzJAAAC8LhYQQAAQCbfuBhAwCbfuBhAgCbfuBhBACbfuBh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuvaru&id=87&user_id=51', 1642118626),
(92, '51', '87', 'varuvaru', '006464ff3e49fb3409494c0956edcec52e7IADIt1Q9Rn5hp6Tp5uZXsu0r/TzM66LNAN/XhW0K8xDqxcoDI28AAAAAIgCsxwAAD8PhYQQAAQCff+BhAwCff+BhAgCff+BhBACff+Bh', '2022-01-14 00:08:07', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IADIt1Q9Rn5hp6Tp5uZXsu0r/TzM66LNAN/XhW0K8xDqxcoDI28AAAAAIgCsxwAAD8PhYQQAAQCff+BhAwCff+BhAgCff+BhBACff+Bh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuvaru&id=87&user_id=51', 1642118887),
(93, '51', '87', 'varuvaru', '006464ff3e49fb3409494c0956edcec52e7IADMvR+MsK+MPWDkC4FS/qge0p3ibFNsfNKEXhJRhqDCVMoDI28AAAAAIgAMKgAAOcPhYQQAAQDJf+BhAwDJf+BhAgDJf+BhBADJf+Bh', '2022-01-14 00:08:48', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=006464ff3e49fb3409494c0956edcec52e7IADMvR+MsK+MPWDkC4FS/qge0p3ibFNsfNKEXhJRhqDCVMoDI28AAAAAIgAMKgAAOcPhYQQAAQDJf+BhAwDJf+BhAgDJf+BhBADJf+Bh&appId=464ff3e49fb3409494c0956edcec52e7&channel=varuvaru&id=87&user_id=51', 1642118928),
(94, '51', '87', 'varuvaru', '0060485c1232ca7491e9ada47ae96da3160IAAgOy3PJFBGMbo7ZYKymA7d+mqeZcVljG6M9dxPSVnnpMoDI28AAAAAIgD3hwAAqsThYQQAAQA6geBhAwA6geBhAgA6geBhBAA6geBh', '2022-01-14 00:14:58', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0060485c1232ca7491e9ada47ae96da3160IAAgOy3PJFBGMbo7ZYKymA7d+mqeZcVljG6M9dxPSVnnpMoDI28AAAAAIgD3hwAAqsThYQQAAQA6geBhAwA6geBhAgA6geBhBAA6geBh&appId=0485c1232ca7491e9ada47ae96da3160&channel=varuvaru&id=87&user_id=51', 1642119298),
(95, '51', '87', 'varuvaru', '0060485c1232ca7491e9ada47ae96da3160IADbiAXcoMVRFnHZXtnI6Arhwpm1fiZUePz18Yd8sh+URsoDI28AAAAAIgBITQEA+MfhYQQAAQCIhOBhAwCIhOBhAgCIhOBhBACIhOBh', '2022-01-14 00:29:03', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0060485c1232ca7491e9ada47ae96da3160IADbiAXcoMVRFnHZXtnI6Arhwpm1fiZUePz18Yd8sh+URsoDI28AAAAAIgBITQEA+MfhYQQAAQCIhOBhAwCIhOBhAgCIhOBhBACIhOBh&appId=0485c1232ca7491e9ada47ae96da3160&channel=varuvaru&id=87&user_id=51', 1642120143),
(96, '51', '87', 'varuvaru', '0060485c1232ca7491e9ada47ae96da3160IAD6EySuJvAuTRoEX2k3QkkmNgcU+8hM2Ogk1DEL3v5XzMoDI28AAAAAIgCmVgEA7cjhYQQAAQB9heBhAwB9heBhAgB9heBhBAB9heBh', '2022-01-14 00:33:09', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0060485c1232ca7491e9ada47ae96da3160IAD6EySuJvAuTRoEX2k3QkkmNgcU+8hM2Ogk1DEL3v5XzMoDI28AAAAAIgCmVgEA7cjhYQQAAQB9heBhAwB9heBhAgB9heBhBAB9heBh&appId=0485c1232ca7491e9ada47ae96da3160&channel=varuvaru&id=87&user_id=51', 1642120389),
(97, '51', '87', 'varuvaru', '0060485c1232ca7491e9ada47ae96da3160IAAPSJqhWNqitcLAB6b48Nqz0KcloOr+4cdMeYTaCwbHasoDI28AAAAAIgCOxAAAhMrhYQQAAQAUh+BhAwAUh+BhAgAUh+BhBAAUh+Bh', '2022-01-14 00:39:55', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0060485c1232ca7491e9ada47ae96da3160IAAPSJqhWNqitcLAB6b48Nqz0KcloOr+4cdMeYTaCwbHasoDI28AAAAAIgCOxAAAhMrhYQQAAQAUh+BhAwAUh+BhAgAUh+BhBAAUh+Bh&appId=0485c1232ca7491e9ada47ae96da3160&channel=varuvaru&id=87&user_id=51', 1642120795),
(98, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIADYm7qgdPWANvEAW+gri6BEfL63Ec6ZE6f0S350pjg37soDI28AAAAAIgDbfQEAGczhYQQAAQCpiOBhAwCpiOBhAgCpiOBhBACpiOBh', '2022-01-14 00:46:40', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIADYm7qgdPWANvEAW+gri6BEfL63Ec6ZE6f0S350pjg37soDI28AAAAAIgDbfQEAGczhYQQAAQCpiOBhAwCpiOBhAgCpiOBhBACpiOBh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&id=87&user_id=51', 1642121200),
(99, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIADs66zC6HOxN8XbPc3KdIflT8JHtyQiv4inmSgJB2CjZcoDI28AAAAAIgDTSwAAuszhYQQAAQBKieBhAwBKieBhAgBKieBhBABKieBh', '2022-01-14 00:49:21', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIADs66zC6HOxN8XbPc3KdIflT8JHtyQiv4inmSgJB2CjZcoDI28AAAAAIgDTSwAAuszhYQQAAQBKieBhAwBKieBhAgBKieBhBABKieBh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&id=87&user_id=51', 1642121361),
(100, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIACKSi08gWEcUG9o1YNcJIEKKwKeXqsvpM3FlWjNngwI/MoDI28AAAAAIgBruwAAOc7hYQQAAQDJiuBhAwDJiuBhAgDJiuBhBADJiuBh', '2022-01-14 00:55:44', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIACKSi08gWEcUG9o1YNcJIEKKwKeXqsvpM3FlWjNngwI/MoDI28AAAAAIgBruwAAOc7hYQQAAQDJiuBhAwDJiuBhAgDJiuBhBADJiuBh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&id=87&user_id=51', 1642121744),
(101, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIABvGKYgOQ29u8ZHWIb3nVPQfXljEYSiV97rkRosAWCJvcoDI28AAAAAIgD/VwEAps/hYQQAAQA2jOBhAwA2jOBhAgA2jOBhBAA2jOBh', '2022-01-14 01:01:49', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIABvGKYgOQ29u8ZHWIb3nVPQfXljEYSiV97rkRosAWCJvcoDI28AAAAAIgD/VwEAps/hYQQAAQA2jOBhAwA2jOBhAgA2jOBhBAA2jOBh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&id=87&user_id=51', 1642122109),
(102, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIAD8lXe8jfzrAliV9WD912GuK1mBGK6l5FprjeNHOgOxKMoDI28AAAAAIgB5JAEARtHhYQQAAQDWjeBhAwDWjeBhAgDWjeBhBADWjeBh', '2022-01-14 01:08:45', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIAD8lXe8jfzrAliV9WD912GuK1mBGK6l5FprjeNHOgOxKMoDI28AAAAAIgB5JAEARtHhYQQAAQDWjeBhAwDWjeBhAgDWjeBhBADWjeBh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&id=87&user_id=51', 1642122525),
(103, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIAA1dgni0uWahuRkNBmv+8tAgLwBdBGFEQgR8nGMaaSrI8oDI28AAAAAIgCKrAAAstLhYQQAAQBCj+BhAwBCj+BhAgBCj+BhBABCj+Bh', '2022-01-14 01:14:49', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIAA1dgni0uWahuRkNBmv+8tAgLwBdBGFEQgR8nGMaaSrI8oDI28AAAAAIgCKrAAAstLhYQQAAQBCj+BhAwBCj+BhAgBCj+BhBABCj+Bh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&c_id=87&user_id=51', 1642122889),
(104, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIAALjwhaZLCetBlB06CyaNJvP/57yLGqTSYs040KCfXIz8oDI28AAAAAIgCgQgAAldThYQQAAQAlkeBhAwAlkeBhAgAlkeBhBAAlkeBh', '2022-01-14 01:22:52', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIAALjwhaZLCetBlB06CyaNJvP/57yLGqTSYs040KCfXIz8oDI28AAAAAIgCgQgAAldThYQQAAQAlkeBhAwAlkeBhAgAlkeBhBAAlkeBh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&c_id=87&user_id=51', 1642123372),
(105, '51', '39', 'varuKris', '0068a0176984cea4e4e8a96c984d149d52fIADRmy6nO5byPUJAPR+UMuuYJoMsNXSzkGk9tWuKSWW0aTBQVzMAAAAAIgAKJAEAf17iYQQAAQAPG+FhAwAPG+FhAgAPG+FhBAAPG+Fh', '2022-01-14 11:11:19', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIADRmy6nO5byPUJAPR+UMuuYJoMsNXSzkGk9tWuKSWW0aTBQVzMAAAAAIgAKJAEAf17iYQQAAQAPG+FhAwAPG+FhAgAPG+FhBAAPG+Fh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuKris&c_id=39&user_id=51', 1642158679),
(106, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIABgo1IdvjX2r8nTAN1ZRXXXUPkZRz9urlycfQMYQncgXcoDI28AAAAAIgBLgQEA5l/iYQQAAQB2HOFhAwB2HOFhAgB2HOFhBAB2HOFh', '2022-01-14 11:17:18', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIABgo1IdvjX2r8nTAN1ZRXXXUPkZRz9urlycfQMYQncgXcoDI28AAAAAIgBLgQEA5l/iYQQAAQB2HOFhAwB2HOFhAgB2HOFhBAB2HOFh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&c_id=87&user_id=51', 1642159038),
(107, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIABImt7sU+9+84CDfpuhVzJZi58RLtwDOaJMbjbNoRktgMoDI28AAAAAIgDwxQAA+HLiYQQAAQCIL+FhAwCIL+FhAgCIL+FhBACIL+Fh', '2022-01-14 12:38:39', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIABImt7sU+9+84CDfpuhVzJZi58RLtwDOaJMbjbNoRktgMoDI28AAAAAIgDwxQAA+HLiYQQAAQCIL+FhAwCIL+FhAgCIL+FhBACIL+Fh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&c_id=87&user_id=51', 1642163919),
(108, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIACVZ429br+brNkOq/2SS4CnUsjFejXxCbwVEy1QuHU60MoDI28AAAAAIgDMMwEANXbiYQQAAQDFMuFhAwDFMuFhAgDFMuFhBADFMuFh', '2022-01-14 12:52:28', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIACVZ429br+brNkOq/2SS4CnUsjFejXxCbwVEy1QuHU60MoDI28AAAAAIgDMMwEANXbiYQQAAQDFMuFhAwDFMuFhAgDFMuFhBADFMuFh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&c_id=87&user_id=51', 1642164748),
(109, '51', '87', 'varuvaru', '0068a0176984cea4e4e8a96c984d149d52fIAAYxaiwunVSreM2fjTk/b4j4JC/TEnb99AniLG4bPq808oDI28AAAAAIgAJYQAAuHfiYQQAAQBINOFhAwBINOFhAgBINOFhBABINOFh', '2022-01-14 12:58:55', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIAAYxaiwunVSreM2fjTk/b4j4JC/TEnb99AniLG4bPq808oDI28AAAAAIgAJYQAAuHfiYQQAAQBINOFhAwBINOFhAgBINOFhBABINOFh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuvaru&c_id=87&user_id=51', 1642165135),
(110, '51', '39', 'varuKris', '0068a0176984cea4e4e8a96c984d149d52fIAA3y12Ih0zrMm3f4dkid/7hjL1r4Ve3hRIPo18WYBuHZzBQVzMAAAAAIgBZKAAACcXjYQQAAQCZgeJhAwCZgeJhAgCZgeJhBACZgeJh', '2022-01-15 12:41:05', 'https://spacefoundation.in/test/SpacECE-PHP/ConsultUs/Agora_Web_SDK_FULL/index.html?id=0068a0176984cea4e4e8a96c984d149d52fIAA3y12Ih0zrMm3f4dkid/7hjL1r4Ve3hRIPo18WYBuHZzBQVzMAAAAAIgBZKAAACcXjYQQAAQCZgeJhAwCZgeJhAgCZgeJhBACZgeJh&appId=8a0176984cea4e4e8a96c984d149d52f&channel=varuKris&c_id=39&user_id=51', 1642250465);

-- --------------------------------------------------------

--
-- Table structure for table `agora_scheduled_call`
--

CREATE TABLE `agora_scheduled_call` (
  `id` int NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `consult_id` varchar(50) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `joining_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `cid` int UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `cname` varchar(100) NOT NULL,
  `date_appointment` date DEFAULT NULL,
  `status` varchar(100),
  `email` varchar(100),
  `mobile` varchar(20) ,
  `bid` int UNSIGNED NOT NULL,
  `time_appointment` time DEFAULT NULL,
  `com_mob` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`cid`, `category`, `username`, `cname`, `date_appointment`, `status`, `email`, `mobile`, `bid`, `time_appointment`, `com_mob`) VALUES
(39, 'Physical Health', 'dddddd', 'Krishna Thorat', NULL, NULL, NULL, NULL, 52, NULL, '9090909090'),
(39, 'Physical Health', 'Space Foundation', 'Krishna Thorat', NULL, NULL, NULL, NULL, 277911, NULL, '8550969625'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', NULL, NULL, NULL, NULL, 341707, NULL, '9852100012'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 592401, '16:18:00', '8951698546'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', NULL, NULL, NULL, NULL, 687234, NULL, '3333333333'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 693853, NULL, '9372744039'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', NULL, NULL, NULL, NULL, 773601, NULL, '9852100012'),
(50, 'Mental Health', 'suraj prakash singh', 'Devendra', NULL, NULL, NULL, NULL, 849291, NULL, '8639739231'),
(49, 'Paediatrician', 'Roshan patil', 'Utkarsh', NULL, NULL, NULL, NULL, 1049618, NULL, '8793073594'),
(49, 'Paediatrician', 'djq', 'Utkarsh', NULL, NULL, NULL, NULL, 1098493, NULL, '7777777777'),
(85, 'Psychiatrist', 'Sachin Mohite', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 1105609, NULL, '9372744039'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', NULL, NULL, NULL, NULL, 1150594, NULL, '3333333333'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 1292332, NULL, '9087909809'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 1340560, NULL, '9087909809'),
(49, 'Paediatrician', 'Sandeep mewada', 'Utkarsh', NULL, NULL, NULL, NULL, 1456781, NULL, '7746875035'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', NULL, NULL, NULL, NULL, 1589330, NULL, '9852100012'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', NULL, NULL, NULL, NULL, 1625768, NULL, '9087909809'),
(68, 'Mental Health', 'suraj prakash singh', 'captain', NULL, NULL, NULL, NULL, 1647317, NULL, '8639739231'),
(85, 'Psychiatrist', 'suraj prakash singh', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 2042877, NULL, '8639739231'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2261814, NULL, '9087909809'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', NULL, NULL, NULL, NULL, 2344607, NULL, '9852100012'),
(56, 'Physical Health', 'pinka', 'snehal salave', NULL, NULL, NULL, NULL, 2423190, NULL, '9087909809'),
(49, 'Paediatrician', 'khe', 'Utkarsh', NULL, NULL, NULL, NULL, 2552478, NULL, '9839798334'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2574845, NULL, '9372744039'),
(39, 'Physical Health', 'Space Foundation', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2604577, NULL, '8550969625'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', '2022-01-08', 'inactive', NULL, NULL, 2683010, '17:48:00', '9087909809'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 2801511, NULL, '9372744039'),
(85, 'Psychiatrist', '', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 2834185, NULL, ''),
(56, 'Physical Health', 'pinka', 'snehal salave', NULL, NULL, NULL, NULL, 3034265, NULL, '9087909809'),
(56, 'Physical Health', 'xxxx', 'snehal salave', NULL, NULL, NULL, NULL, 3035483, NULL, '9023453443'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', NULL, NULL, NULL, NULL, 3301540, NULL, '9852100012'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-01-21', 'inactive', NULL, NULL, 3595610, '16:56:00', '9852100012'),
(39, 'Physical Health', 'varun kumar k', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 3747792, '16:05:00', '8951698545'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 3870256, '16:09:00', '8951698546'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', NULL, NULL, NULL, NULL, 3972965, NULL, '9087909809'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', NULL, NULL, NULL, NULL, 3979799, NULL, '8951698546'),
(50, 'Mental Health', 'Susmita', 'Devendra', NULL, NULL, NULL, NULL, 4001117, NULL, '3333333333'),
(49, 'Paediatrician', 'vrushali', 'Utkarsh', NULL, NULL, NULL, NULL, 4147518, NULL, '9075470346'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4476273, NULL, '9087909809'),
(49, 'Paediatrician', 'suraj prakash singh', 'Utkarsh', NULL, NULL, NULL, NULL, 4494341, NULL, '8639739231'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4543422, NULL, '9372744039'),
(85, 'Psychiatrist', 'pooja shet', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 4556120, NULL, '8884522408'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4584806, NULL, '8639739231'),
(39, 'Physical Health', 'varunk', 'Krishna Thorat', NULL, NULL, NULL, NULL, 4602700, NULL, '8722235441'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', '2022-01-29', 'inactive', NULL, NULL, 4781457, '15:50:00', '9087909809'),
(55, 'Paediatrician', 'Susmita Vulli', 'Ajay', '2022-01-30', 'inactive', NULL, NULL, 4787197, '12:25:00', '9606888725'),
(49, 'Paediatrician', 'Susmita Vulli', 'Utkarsh', '2022-01-23', 'inactive', NULL, NULL, 4863388, '16:43:00', '9606888725'),
(49, 'Paediatrician', 'pinka', 'Utkarsh', NULL, NULL, NULL, NULL, 4907823, NULL, '9087909809'),
(56, 'Physical Health', 'Jayesh Hemant Borae', 'snehal salave', NULL, NULL, NULL, NULL, 4925590, NULL, '8626033209'),
(52, 'Paediatrician', 'suraj prakash singh', 'dddddd', NULL, NULL, NULL, NULL, 5032925, NULL, '8639739231'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', '2022-01-27', 'inactive', NULL, NULL, 5098771, '15:00:00', '9852100012'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5182394, NULL, '9372744039'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5361625, NULL, '8639739231'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', '2022-01-01', 'inactive', NULL, NULL, 5420548, '15:08:00', '9022478080'),
(49, 'Paediatrician', 'snehal salave', 'Utkarsh', NULL, NULL, NULL, NULL, 5643743, NULL, '9022478080'),
(39, 'Physical Health', 'pooja shet', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5781331, NULL, '8884522408'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 5842468, NULL, '9022478080'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', '2022-01-17', 'inactive', NULL, NULL, 5851969, '14:21:00', '3333333333'),
(85, 'Psychiatrist', 'Sachin Mohite', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 5872181, NULL, '9372744039'),
(49, 'Paediatrician', 'xxxx', 'Utkarsh', NULL, NULL, NULL, NULL, 6216697, NULL, '9023453443'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6250351, NULL, '9087909809'),
(39, 'Physical Health', 'pooja', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6370541, NULL, '9022345689'),
(85, 'Psychiatrist', 'Sachin Mohite', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 6491053, NULL, '9372744039'),
(49, 'Paediatrician', 'snehal salave', 'Utkarsh', NULL, NULL, NULL, NULL, 6496382, NULL, '9022478080'),
(49, 'Paediatrician', 'Susmita', 'Utkarsh', NULL, NULL, NULL, NULL, 6658714, NULL, '3333333333'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6698313, NULL, '8639739231'),
(39, 'Physical Health', 'suraj prakash singh', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6780753, NULL, '8639739231'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 6782623, NULL, '9022478080'),
(52, 'Paediatrician', 'snehal salave', 'dddddd', NULL, NULL, NULL, NULL, 6887338, NULL, '9022478080'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-01-23', 'inactive', NULL, NULL, 7111540, '15:00:00', '9852100012'),
(52, 'Paediatrician', 'Sachin Mohite', 'dddddd', NULL, NULL, NULL, NULL, 7172678, NULL, '9372744039'),
(50, 'Mental Health', 'Preethi Shetty DB', 'Devendra', NULL, NULL, NULL, NULL, 7258693, NULL, '9448470151'),
(49, 'Paediatrician', 'Keerthan L B', 'Utkarsh', NULL, NULL, NULL, NULL, 7304234, NULL, '8971892949'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7413931, NULL, '9022478080'),
(56, 'Physical Health', 'pinka', 'snehal salave', NULL, NULL, NULL, NULL, 7487941, NULL, '9087909809'),
(49, 'Paediatrician', 'pkjhhbbjnkjkmn', 'Utkarsh', '2022-02-25', 'inactive', NULL, NULL, 7505754, '15:22:00', '9852100012'),
(49, 'Paediatrician', 'Roshan patil', 'Utkarsh', NULL, NULL, NULL, NULL, 7518425, NULL, '8793073594'),
(39, 'Physical Health', 'snehal salave', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7587616, NULL, '9022478080'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 7900899, NULL, '9087909809'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-01-25', 'inactive', NULL, NULL, 8115315, '14:02:00', '9852100012'),
(49, 'Paediatrician', 'xxxx', 'Utkarsh', NULL, NULL, NULL, NULL, 8137311, NULL, '9023453443'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 8380831, '16:10:00', '8951698546'),
(85, 'Psychiatrist', 'Preethi Shetty DB', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 8386452, NULL, '9448470151'),
(49, 'Paediatrician', 'Space Foundation', 'Utkarsh', NULL, NULL, NULL, NULL, 8416278, NULL, '8550969625'),
(39, 'Physical Health', 'demo', 'Krishna Thorat', NULL, NULL, NULL, NULL, 8535250, NULL, '8722235441'),
(50, 'Mental Health', 'xxxx', 'Devendra', NULL, NULL, NULL, NULL, 8707683, NULL, '9023453443'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 8737763, NULL, '9087909809'),
(72, 'Mental Health', 'Roshan patil', 'Udeshya', NULL, NULL, NULL, NULL, 8801670, NULL, '8793073594'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 8843937, NULL, '9372744039'),
(85, 'Psychiatrist', 'suraj prakash singh', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 8967973, NULL, '8639739231'),
(50, 'Mental Health', 'snehal salave', 'Devendra', '2022-01-02', 'inactive', NULL, NULL, 9005983, '16:20:00', '9022478080'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9130644, NULL, '9087909809'),
(85, 'Psychiatrist', 'varunk', 'ShaliniAnil Khandare', NULL, NULL, NULL, NULL, 9230661, NULL, '8722235441'),
(49, 'Paediatrician', 'Rupali', 'Utkarsh', '2022-01-26', 'inactive', NULL, NULL, 9265553, '16:10:00', '7620287846'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9275904, NULL, '9372744039'),
(39, 'Physical Health', 'pinka', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9308289, NULL, '9087909809'),
(49, 'Paediatrician', 'suraj prakash singh', 'Utkarsh', NULL, NULL, NULL, NULL, 9467369, NULL, '8639739231'),
(39, 'Physical Health', 'Sachin Mohite', 'Krishna Thorat', NULL, NULL, NULL, NULL, 9501715, NULL, '9372744039'),
(39, 'Physical Health', 'pkjhhbbjnkjkmn', 'Krishna Thorat', '2022-02-11', 'inactive', NULL, NULL, 9570518, '14:00:00', '9852100012'),
(49, 'Paediatrician', 'Sachin Mohite', 'Utkarsh', '2022-01-04', 'inactive', NULL, NULL, 9650878, '13:30:00', '9372744039'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 9737578, '16:14:00', '8951698546'),
(39, 'Physical Health', 'xxxx', 'Krishna Thorat', '2022-01-06', 'inactive', NULL, NULL, 9832183, '12:11:00', '9023453443'),
(39, 'Physical Health', 'varun', 'Krishna Thorat', '2022-02-25', 'inactive', NULL, NULL, 9842231, '16:22:00', '8951698546'),
(85, 'Psychiatrist', 'ShaliniAnil Khandare', 'ShaliniAnil Khandare', '2022-01-12', 'inactive', NULL, NULL, 9941641, '21:17:00', '8830242472');

-- --------------------------------------------------------

--
-- Table structure for table `consultant`
--

CREATE TABLE `consultant` (
  `c_id` int UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `office` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `ctime` time NOT NULL,
  `pass` varchar(100) NOT NULL,
  `lno` varchar(100) NOT NULL,
  `stime` time NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `img` longblob,
  `lang` varchar(100) CHARACTER SET utf8mb4 NOT NULL DEFAULT 'English',
  `fee` int NOT NULL DEFAULT '100',
  `available_from` varchar(30) CHARACTER SET utf8mb4  NOT NULL DEFAULT 'monday',
  `available_to` varchar(30) NOT NULL DEFAULT 'saturday',
  `qualification` varchar(500) CHARACTER SET utf8mb4  NOT NULL DEFAULT 'bachelor degree '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `consultant`
--

INSERT INTO `consultant` (`c_id`, `name`, `category`, `office`, `mobile`, `ctime`, `pass`, `lno`, `stime`, `email`, `img`, `lang`, `fee`, `available_from`, `available_to`, `qualification`) VALUES
(1, 'raju rastogi', 'paediatrition', 'n-23,andheri,maharastra', '9998964711', '19:10:00', '123', '123332', '22:14:00', 'raju2@gmail.com', 0x68747470733a2f2f7777772e706e676a6f792e636f6d2f706e676d2f3235342f343930353438355f646f63746f72732d696d616765732d696e6469616e2d6d616c652d6d65646963616c2d73747564656e74732d68642d706e672e706e67, 'English', 200, 'monday', 'saturday', 'phd in paediatrition'),
(2, 'dr.bheem raj', 'mental health', 'nagarbassi(n-34),dehradun', '9998765431', '08:00:00', '456', '342737', '09:00:00', 'bheem@gmail.com', 0x68747470733a2f2f6b69646f63732e6f72672f77702d636f6e74656e742f75706c6f6164732f323031342f30312f706f7274726169745f6f665f696e6469616e5f6d616c655f646f63746f725f626c643036313239372e6a7067, 'English', 300, 'monday', 'saturday', 'master in mental health'),
(3, 'dr.amit srivastav', 'physical health', 'nawali(n-22),dehradun', '9998765444', '04:00:00', '987', '324697', '05:10:00', 'amit@gmail.com', 0x68747470733a2f2f7374322e6465706f73697470686f746f732e636f6d2f313439393335352f31323335312f692f3935302f6465706f73697470686f746f735f3132333531323038382d73746f636b2d70686f746f2d6d616c652d696e6469616e2d646f63746f722d616e642d73746574686f73636f70652e6a7067, 'English', 100, 'monday', 'saturday', 'bachelor in physical health'),
(4, 'dr.raj kapoor', 'psychiatrist', 'singh colony(3),rudrapur', '9998765243', '01:00:00', '1009', '573346', '02:16:00', 'raj@gmail.com', 0x68747470733a2f2f7777772e706e676a6f792e636f6d2f706e676d2f3235342f343930353438355f646f63746f72732d696d616765732d696e6469616e2d6d616c652d6d65646963616c2d73747564656e74732d68642d706e672e706e67, 'English', 200, 'monday', 'saturday', 'masters in pschology'),
(5, 'dr.mohan das', 'nutrition', 'indra colony(3),laspur', '9998754343', '02:00:00', 'yash12', '358994', '03:30:00', 'mohan@gmail.com', 0x68747470733a2f2f6d656469612e6973746f636b70686f746f2e636f6d2f70686f746f732f696e6469616e2d6d616e2d646f63746f722d616761696e73742d77686974652d6261636b67726f756e642d706963747572652d69643931323932303139343f6b3d36266d3d39313239323031393426733d3631327836313226773d3026683d546e3673484e4f4755416b7048494f6e704a7a356b4c374a4755737a746a7a4e425a62734f674679344c413d, 'English', 200, 'monday', 'saturday', 'masters in nutrition'),
(15, 'ramnath kovid', 'mental health', 'singh colony,rudrapur,locality 3', '7668722333', '05:09:00', 'ramnath', '11111', '07:10:00', 'ramnath@gmail.com', 0x68747470733a2f2f7777772e706e676a6f792e636f6d2f706e676d2f3235342f343930353438355f646f63746f72732d696d616765732d696e6469616e2d6d616c652d6d65646963616c2d73747564656e74732d68642d706e672e706e67, 'English', 100, 'monday', 'saturday', 'master in mental health\\'),
(18, 'ahmed shah', 'nutrition', 'rudra colony,blaspur', '7668711000', '18:34:00', 'ahmedshah123', '19092', '20:37:00', 'ahmed@gmail.com', 0x68747470733a2f2f7777772e706e676a6f792e636f6d2f706e676d2f3235342f343930353438355f646f63746f72732d696d616765732d696e6469616e2d6d616c652d6d65646963616c2d73747564656e74732d68642d706e672e706e67, 'English', 200, 'monday', 'saturday', 'masters in nutrition'),
(45, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(46, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(47, 'ramesh', 'paediatrition', '#55,krishna, amaravathi', '07892254941', '10:05:00', '123456', '1234556', '11:05:00', 'kavyaramesh.gongati@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(48, '', 'physical health', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(49, 'pooja test', 'nutrition', 'Address line-1', '1231231231', '18:19:00', 'test', 'Test', '20:19:00', 'test@gmail1.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(50, '', 'paediatrition', 'dgs', '', '00:00:00', '', 'dgs', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(51, '23455', 'paediatrition', '1234', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(52, 'VFYVUy', 'paediatrition', 'dsVd', '846516', '20:55:00', 'ashutosh', '+65df+zsdf', '20:53:00', 'Asonibgh@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(53, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(54, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(55, 'sanjit', 'mental health', 'kolkata', '980402918', '15:47:00', 'hellosanjit', 'san007', '04:48:00', 'smondal872@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(56, '', 'paediatrition', '', '', '00:00:00', 'hi', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(57, 'saanvika', 'paediatrition', '#55,krishna, amaravathi', '07892254941', '21:12:00', 'kavya.27', '1234556', '22:13:00', 'rammy.kavya@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(58, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(59, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(60, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(61, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(62, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(63, '', 'paediatrition', '', '', '00:00:00', '', '', '00:00:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(64, '33333333333', 'physical health', 'Hivare Zare, Hivare zare', '08180915503', '13:31:00', '999999', '12345', '16:31:00', 'bittu13@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(65, '', 'paediatrition', '', '', '05:15:00', '', '', '20:06:00', '', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(66, 'abc', 'paediatrition', 'ppp', '9999999999', '15:23:00', '11111111111111111111111111111111111111111111111111111111111111', '8888', '15:24:00', 'abc11@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(67, 'abc', 'paediatrition', 'ppp', '9999999999', '15:23:00', '11111111111111111111111111111111111111111111111111111111111111', '8888', '15:24:00', 'abc11@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(68, 'abc', 'paediatrition', 'ppp', '9999999999', '15:23:00', '11111111111111111111111111111111111111111111111111111111111111', '8888', '15:24:00', 'abc11@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(69, 'abc', 'paediatrition', 'ppp', '9999999999', '15:23:00', '11111111111111111111111111111111111111111111111111111111111111', '8888', '15:24:00', 'abc11@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(70, 'abc', 'paediatrition', 'ppp', '9999999999', '15:23:00', '11111111111111111111111111111111111111111111111111111111111111', '8888', '15:24:00', 'abc11@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(71, 'abc', 'paediatrition', 'ppp', '9999999999', '15:23:00', '11111111111111111111111111111111111111111111111111111111111111', '8888', '15:24:00', 'abc11@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(72, 'susmitav', 'mental health', 'BNG', '1111111111', '12:45:00', 'ssssssssss', 'Testing', '05:45:00', 'Testing@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(73, 'susmitav', 'mental health', 'BNG', '1111111111', '19:40:00', 'ssssssssss', 'Testing', '06:45:00', 'Testing@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(74, 'ram', 'paediatrition', 'ppp', '9999999999', '18:06:00', 'ram@123', '00000', '16:12:00', 'ram@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(75, 'ram', 'paediatrition', 'ppp', '9999999999', '18:06:00', 'ram@123', '00000', '16:12:00', 'ram@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(76, 'bbbbbbb', 'paediatrition', 'pppp', '999999999', '20:19:00', '1234', '99999999', '20:19:00', 'bbb@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(77, 'shubhamvijaygangurdes2012@gmail.com', 'physical health', 'mumbai', '986524975', '23:30:00', '1234567891', '665395', '02:30:00', 'shubhamvijaygangurdes2012@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(78, 'EKTA ', 'psychiatrist', '#1234', '9518210127', '00:00:00', '123456', '123456789', '00:00:00', 'ekta.chauhan1428@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree '),
(79, 'manisha', 'paediatrition', 'kolya', '7892234551', '14:24:00', 'manisha24', '025462', '13:26:00', 'suvarnamanisha3@gmail.com', NULL, 'English', 100, 'monday', 'saturday', 'bachelor degree ');

-- --------------------------------------------------------

--
-- Table structure for table `consultant_category`
--

CREATE TABLE `consultant_category` (
  `cat_id` int NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_slug` varchar(100) NOT NULL,
  `cat_img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `consultant_category`
--

INSERT INTO `consultant_category` (`cat_id`, `cat_name`, `cat_slug`, `cat_img`) VALUES
(1, 'Paediatrician', 'paediatrician', 'd1.jpg'),
(2, 'Psychiatrist', 'psychiatrist', 'd3.jpg'),
(3, 'Physical Health', 'physical-health', 'd4.jpg'),
(4, 'Mental Health', 'mental-health', 'd5.jpg'),
(5, 'Nutritionist', 'nutritionist', 'd6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `description`
--

CREATE TABLE `description` (
  `X` int NOT NULL,
  `descID` int NOT NULL,
  `descName` varchar(30) NOT NULL,
  `treatment` varchar(50) NOT NULL,
  `Note` varchar(200) NOT NULL,
  `doctorIDdesc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `description`
--

INSERT INTO `description` (`X`, `descID`, `descName`, `treatment`, `Note`, `doctorIDdesc`) VALUES
(0, 34, 'shashank', 'NO', 'WELL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `user_name` varchar(100) NOT NULL,
  `feedback` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`user_name`, `feedback`, `email`) VALUES
('shashank', 'bhai jaan shukriya', 'admin@gmail.com'),
('ash', 'dhanyawad balak', 'yashavipundeer@gmail.com'),
('yashu', 'no problem beta', 'main@gmail.com'),
('yashu', 'ha bhai', 'main@gmail.com'),
('shashank', 'ok brio', 'admin@gmail.com'),
('yashu', 'hello guys', 'main34@gmail.com'),
('yashraj', 'ok nice cool', 'yashavipundeer22@gmail.com'),
('ash', 'hi yash', 'yashavipundeer@gmail.com'),
('shashank', 'yes bro', 'admin@gmail.com'),
('', '', ''),
('kavya G', 'wtetrydyrryy66y', 'kavyaramesh.gongati@gmail.com'),
('', '', 'ggffhhf'),
('k', '', ''),
('', '', ''),
('kavya', '', 'kavyaramesh.gongati@gmail.com'),
('kavya G', 'jlafj;jegpwyp', 'kavyaramesh.gongati@gmail.com'),
('', 'dad', 'kavyaramesh.gongati@gmail.com'),
('kavya G', 'hi,,its good website', 'kavyaramesh.gongati@gmail.com'),
('abc', 'hi', 'abc@gmail.com'),
('satish sonawne', 'kbibiuqhwuduw', 'satish.khadke12@gmail.com'),
('rahul', 'hii', 'rahul@1234'),
('526641', 'fhgfht', 'hoighodghhb'),
('dh@#$#$%', 'hfj', 'dvfjtjkh'),
('', '', ''),
('kavya G', 'vfyiti7yoi', 'kavyaramesh.gongati@gmail.com'),
('Shubham', 'hiii', 'Gangurde'),
('mahaboob Basha', 'hello, I am Tester here.', 'shaikmb009@gmail.com'),
('', '', ''),
('Shubham', 'xyz', 'Gangurde'),
('', '', ''),
('', '', ''),
('kavya', 'sdsdggerg', 'kavyaramesh.gongati@gmail.com'),
('sangita tambe', 'jhakshlajd', 'sang.tambe7887@rediffmail.com'),
('', '', ''),
('', '', ''),
('kavya G', 'hii imkavya', 'kavyaramesh.gongati@gmail.com'),
('Siddharth Dhami', 'askmksxmks', 'siddharth9@gmail.com'),
('', '', ''),
('a', 'a', 'a'),
('Tester', 'testing', 'tester@gmail.com'),
('Tester', '', 'tester'),
('', '', ''),
('Tester', 'testing', 'testergmailcom'),
('', '', ''),
('', '', ''),
('', '', ''),
('sanjit mondal', 'hi friends', 'smondal872@gmail.com'),
('Shubham Gangurde', 'hello', 'shubhamvijaygangurde@gmail.com'),
('ssss', 'sss', 'ssss'),
('', '', 'sssssss'),
('kavya', 'ii, thank you for provideing the platform for ur.', 'kavyaramesh.gongati@gmail.com'),
('kavya', 'ii, thank you for provideing the platform for ur.', 'kavyaramesh.gongati@gmail.com'),
('snehal salave', 'hhh', 'abc@gmail.com'),
('snehal salave', 'hhh', 'snehal291195@gmail.com'),
('snehal salave', 'hhh', 'gan130@gmail.com'),
('Shubham', 'fsdvsbv', 'shubhamvijaygangurde@gmail.com'),
('Shubham', 'fsdvsbv', 'shubhamvijaygangurde@gmail.com'),
('shubham', 'Hello', 'shubhamvijaygangurde@gmail.com'),
('52453', 'Hello', '45325434'),
('52453', 'Hello', '45325434'),
('', '', ''),
('susmitaV', 'testing', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('susmitaV', 'cccccc', 'test@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('susmitaV', 'testing', 'chotu.sonia@gmail.com'),
('snehal salave', 'hh', 'snehalsalave130@gmail.com'),
('Gerardbiasy', 'spaceforece.com tyrueoswkdhfbjksdhbdvsddnajkmkxdbfsdjdfadladabfhghgdhsjkd \r\nFuck You Nigger - My Profile: https://www.youtube.com/channel/UCu6eeygUz2BY0xLDSlMKK-Q/featured', 'dimafokin199506780tx+43x3@inbox.ru'),
('snehal salave', 'j', 'admin'),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('', '', ''),
('hello', 'wqwe', 'hello'),
('', '', ''),
('', '', ''),
('EKTA', '', 'ekta.chauhan1428@gmail.com'),
('Ekta Chauhan', 'NOT WORKING PROPERLY', 'ekta.chauhan1428@gmail.com'),
('Mike Bush\r\n', 'Negative SEO attack Services. Deindex bad competitors from Google. It works with any Website, video, blog, product or service. \r\nhttps://www.seo-treff.de/product/derank-seo-service/', 'no-replyol@gmail.com'),
('jah', 'Hi, this is Jeniffer. I am sending you my intimate photos as I promised. https://tinyurl.com/y8fx49ke', '65748vrz@yahoo.com'),
('', '', ''),
('', '', ''),
('NataWeept', ' \r\nI would let you fuck me if you was here https://chicks-for-you.life/?u=41nkd08&o=8dhpkzk', 'woodthighgire1988@gmail.com'),
('', '', ''),
('jah', 'Hi, this is Jeniffer. I am sending you my intimate photos as I promised. https://tinyurl.com/ybfd5fpz', 's2tcbd2a@yahoo.com'),
('ForexExcalak', 'Cel mai bun antrenament de tranzacționare în valută. https://ro.system-forex.com', 'anemone@pochtampt.com'),
('nem3594846krya', 'mis3594846errtbh uwTh4pQ 6O32 mkzWPi1', 'hholcombcessar@gmail.com'),
('jah', 'Hi, this is Irina. I am sending you my intimate photos as I promised. https://tinyurl.com/y9z5xb2p', 'kl4xc4im@yahoo.com'),
('Mike Forster\r\n', 'Negative SEO attack Services. Deindex bad competitors from Google. It works with any Website, video, blog, product or service. \r\nhttps://www.seo-treff.de/product/derank-seo-service/', 'no-replyol@gmail.com'),
('jah', 'Hi, this is Anna. I am sending you my intimate photos as I promised. https://tinyurl.com/ycecpfea', 'r3h8a87b@yahoo.com'),
('SWATHI S A', 'very nice', 'swathisa4726@gmail.com'),
('', '', ''),
('', '', ''),
('SWATHI S A', 'nice', 'swathisa4726@gmail.com'),
('jah', 'Hi, this is Anna. I am sending you my intimate photos as I promised. https://tinyurl.com/ybwmzgtm', 'k71xe766@gmail.com'),
('jah', 'Hi, this is Jenny. I am sending you my intimate photos as I promised. https://tinyurl.com/y9thbngd', '6311ptek@icloud.com'),
('', '', ''),
('jah', 'Hi, this is Jenny. I am sending you my intimate photos as I promised. https://tinyurl.com/ybu79lzm', '11pfdp7a@hotmail.com'),
('Mike Scott\r\n', 'Negative SEO attack Services. Deindex bad competitors from Google. It works with any Website, video, blog, product or service. \r\nhttps://www.seo-treff.de/product/derank-seo-service/', 'no-replyol@gmail.com'),
('jah', 'Hi, this is Jenny. I am sending you my intimate photos as I promised. https://tinyurl.com/y86tw9nb', 'lsbvy6b4@hotmail.com'),
('jah', 'Hi, this is Julia. I am sending you my intimate photos as I promised. https://tinyurl.com/ybv2dt5r', 'd4h0yo9t@yahoo.com'),
('jah', 'Hi, this is Jenny. I am sending you my intimate photos as I promised. https://tinyurl.com/y88xyfmx', 'b7rh7164@gmail.com'),
('Jamesviabe', 'Payments to all Europeans now from 500 EUR per day for all >>>>>>>>>>>>>>  https://telegra.ph/Schnelles-Einkommen-ab-500-EUR-pro-Tag-f%C3%BCr-alle-03-17?83652   <<<<<<<<<<<', 'geraldcheong@loopartners.com.sg'),
('Evichevet', 'cialis uk boots https://oscialipop.com - generic cialis Vtpvcl To Buy Cialis From Ireland <a href=https://oscialipop.com>buy cialis online europe</a> https://oscialipop.com - Cialis Xxdoqg', 'Evichevet@abdulah.xyz'),
('jah', 'Hi, this is Jenny. I am sending you my intimate photos as I promised. https://tinyurl.com/y8lc8cl4', 'bl15ocni@gmail.com'),
('Jermaine Baumgardner', 'Hi, I am interested in some of your products.\r\n\r\nPlease give me a call on +1 304-873-4360', 'jermaine.baumgardner@gmail.com'),
('MichaelFleli', 'spaceforece.com uriefeodeighrkfldjiijofofjmvkdnsisdiehiusfiajfhweiuioidjsjsbfiadjasifaijdfifijsaaiwghifadja', 'chubenkodaniiaz+12d7@mail.ru'),
('DavidAlcom', 'Automatic income on the Trading Robot from $385068 >>>>>>>>>>>>>>  https://telegra.ph/Confirm-you-are-not-a-bot-03-24-4?55194   <<<<<<<<<<<', 'dicky_irwanda@yahoo.de'),
('jah', 'Hi, this is Anna. I am sending you my intimate photos as I promised. https://tinyurl.com/yaqaadqf', 'smry1ctp@gmail.com'),
('ForexExcalak', 'Vai forex tirdzniecība ir reāla. https://lv.forex-stock-bitcoin-brokers.com', 'night@pochtampt.com'),
('DavidAlcom', 'Only your income on Binary Options from $398777 >>>>>>>>>>>>>>  https://telegra.ph/Confirm-you-are-not-a-bot-03-24?76596   <<<<<<<<<<<', 'jestemzajebisty11@gmx.de'),
('', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `UID` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` decimal(10,0) NOT NULL,
  `img` longblob,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UID`, `username`, `password`, `name`, `email`, `phone`, `img`, `token`) VALUES
(1, 'manassinkar', 'manas12345', 'Manas', 'manas.sinkar@gmail.com', '9022942188', 0x687474703a2f2f332e3130392e31342e342f436f6e73756c7455732f696d672f322e6a7067, ''),
(2, 'jaydeep', 'jaydeep12345', 'Jaydeep', 'jaydeep@gmail.com', '9854545452', 0x687474703a2f2f332e3130392e31342e342f436f6e73756c7455732f696d672f322e6a7067, '006464ff3e49fb3409494c0956edcec52e7IAAb2XJ7nZ44MNxpd HkekuDOFQj9kpE0eVAxX1HinIfz3fBAaIAAAAAEACLgpZh3c8oYQEAAQDYzyhh'),
(3, 'parththosani', 'parth12345', 'parthu', 'admin@gmail.com', '9997983616', 0x687474703a2f2f332e3130392e31342e342f436f6e73756c7455732f696d672f322e6a7067, ''),
(4, 'sangeeta08', '1a2s3d4f5g', 'Sangeeta', 'sangeetamalviya08@gmail.com', '8888888888', 0x687474703a2f2f332e3130392e31342e342f436f6e73756c7455732f696d672f322e6a7067, ''),
(16, 'shivanshsri0508', 'shivanshsri', 'Shivansh', 'srivastavashivansh05@gmail.com', '8800312995', 0x687474703a2f2f332e3130392e31342e342f436f6e73756c7455732f696d672f322e6a7067, ''),
(27, 'yashujr09', 'yashujr007', 'shashank', 'admin@gmail.com', '3443555123', 0x687474703a2f2f332e3130392e31342e342f436f6e73756c7455732f696d672f322e6a7067, ''),
(28, 'amit098', 'amit123456', 'amit', 'amit098@gmail.com', '9997987764', 0x687474703a2f2f332e3130392e31342e342f436f6e73756c7455732f696d672f322e6a7067, ''),
(31, 'ramprakash', '1234567890', 'ash', 'yashavipundeer@gmail.com', '7668711234', 0x322e6a7067, NULL),
(32, 'erar23', '1234567890', 'yashu', 'main@gmail.com', '3443555', 0x332e6a7067, NULL),
(33, 'yash12', '1234', 'yashasvi', 'yash123@gamil.com', '9998978616', 0x68747470733a2f2f696e73706972656c6c652e636f6d2f77702d636f6e74656e742f75706c6f6164732f323031362f30352f576562736974652d696d672e6a7067, '123dhsfvuahvajdfs478534'),
(34, 'abc1234', '123456789', 'Abc xyz', 'abc@gmail.com', '9456832170', 0x576861747341707020496d61676520323032312d30352d313620617420312e34352e333620504d2e6a706567, NULL),
(35, 'ketchup', 'yashasvi', 'shashank', 'yashasvipundeer@gmail.com', '7665431231', 0x676f64206f66207761722e6a7067, NULL),
(36, 'ketchup123', 'yashasvi32', 'shashank23', 'yashasvipundeer@gmail.com', '7665431231', 0x676f64206f66207761722e6a7067, NULL),
(37, 'ashketchup', '1234562', 'yashujr', 'yashasvipundeer@gmail.com', '7668711342', 0x322e6a7067, NULL),
(38, 'ran.kavya', 'ramkav.27', 'kavya', 'kavyaramesh.gongati@gmail.com', '7892254941', 0x6b206e6568612070686f746f2e6a7067, NULL),
(44, 'kavyaramesh', 'ramkav.27', 'kavyaG', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(45, 'yash12', '1234', 'yashasvi', 'yash123@gamil.com', '9998978616', 0x68747470733a2f2f696e73706972656c6c652e636f6d2f77702d636f6e74656e742f75706c6f6164732f323031362f30352f576562736974652d696d672e6a7067, '123dhsfvuahvajdfs478534'),
(46, 'yash12', '1234', 'yashasvi', 'yash123@gamil.com', '9998978616', 0x68747470733a2f2f696e73706972656c6c652e636f6d2f77702d636f6e74656e742f75706c6f6164732f323031362f30352f576562736974652d696d672e6a7067, '123dhsfvuahvajdfs478534'),
(47, 'yash12', '1234', 'yashasvi', 'yash123@gamil.com', '9998978616', 0x68747470733a2f2f696e73706972656c6c652e636f6d2f77702d636f6e74656e742f75706c6f6164732f323031362f30352f576562736974652d696d672e6a7067, '123dhsfvuahvajdfs478534'),
(48, 'ravikant28', 'Ravikant28*', 'RAVIKANT SINHA', 'ravikantsinha10@gmail.com', '7903817628', 0x494d472d32303231303931342d5741303030312e6a7067, NULL),
(49, 'hellom2', 'asdasd', 'hemm jert', '12asj@gmail.com', '9898453456', 0x312e706e67, NULL),
(50, '111111111', 'asdasd', '111111111', '1111111', '111111111', '', NULL),
(51, 'V. Ram Priya', 'Priya@08', 'V. Ram Priya', 'ammuprincess2003@gmail.com', '7305353702', 0x536e6170636861742d313133313239373037372e6a7067, NULL),
(52, 'hello123', 'hello123', 'hello123', 'hello123', '1234567890', '', NULL),
(53, 'Siddhivora', 'asdasd', 'Siddhi Vora', 'siddhivora9@gmail.com', '9409156737', '', NULL),
(54, 'tester12', 'asdasd', 'tester 123', 'tester123@gmail.com', '8522081123', '', NULL),
(55, 'sanjit', 'sanjit1234', 'sanjit mondal', 'smondal872@gmail.com', '9804022918', 0x35303836303530375f323135363231313730343433373532355f373134353636373034333138303637353037325f6e202831292e6a7067, NULL),
(56, 'snehal salave', '7038085932', 'snehal Anil salave', 'snehsalave130@gmail.com', '9022478080', 0x342e6a666966, NULL),
(57, 'snehal salave1q', '', 'snehal salave', '', '8180915503', '', NULL),
(58, 'tamanna', 'kavya.27', 'seema', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(59, 'sunitha ', '123456', 'kavya ', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(60, 'chethana', '122455', 'kavya', 'kavyaramesh.gongati@gmail.com', '7892941', '', NULL),
(61, 'krishna', 'aa123456', 'Krishna Thorat', 'krishna.thorat20@vit.edu', '8550969625', '', NULL),
(62, 'sunil', '1234567', 'kavya G', 'sdsdbf', '7892254941', '', NULL),
(63, 'admin', '123456', 'abc', 'abc@gmail.com', '9455470438', '', NULL),
(64, 'rameshbabu', '1234567', 'kavya G', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(65, 'susmita', 'ssssssssss', 'susmitaV', 'chotu.sonia@gmail.com', '9606888725', 0x5553455220524547495354524154494f4e202d20476f6f676c65204368726f6d652031305f31395f3230323120385f34395f323520414d2e706e67, NULL),
(66, 'kirandhumal', 'Kiran@123', 'Kiran Raosaheb Dhumal', 'kiran21dhumal@gmail.com', '9960593750', '', NULL),
(67, 'simran.123', '12345678', 'kavya G', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(68, 'chethana.1234', '12345678', 'kavya G', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(69, 'deeksaddsa', '12345', 'ddfbgff', 'dee@gmail.com', '9632587412', '', NULL),
(70, 'roopa.jagan', '12345678', 'kavya G', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(71, 'saanvika.sudeeksha', '', 'kavya G', 'ran.kavya@gmail.com', '7892254941', '', NULL),
(72, 'kavya.ramesh', '121212', 'kavya G', 'kavyaramesh.gongati@gmail.com', '7892254941', '', NULL),
(73, 'pooja@gmail.com', 'Salave@123', 'pooja', 'pooja123@gmail.com', '9022478080', 0x332e6a666966, NULL),
(74, 'Kriti Sharma', 'kriti', 'Kriti Sharma', 'kritisharma1303@gmail.com', '9168260390', 0x626574682d746575747363686d616e6e2d6564354b795350317466512d756e73706c6173682e6a7067, NULL),
(75, 'bittu123', '1234', 'bittu ', 'bittu1@gmail.com', '9999999999', 0x332e6a666966, NULL),
(76, 'ShubhamGangurde', '34213421', 'Shubham Gangurde', 'shubhamvijaygangurde@gmail.com', '9892380935', 0x333532303531312e706e67, NULL),
(77, 'ramesh', '12345678', 'ramesh kumar', 'abc@gmail.com', '123', '', 'null'),
(78, 'ramesh', '12345678', 'ramesh kumar', 'abc@gmail.com', '123', '', 'null'),
(79, 'Ekta Chauhan', 'Ektaekta@00', 'Ekta Chauhan', 'ekta.chauhan1428@gmail.com', '9518210127', 0x494d475f32303230303930345f3138343830365f426f6b65685f5f30315f5f30322e6a7067, NULL),
(80, 'EktaChauhan02', 'Ektaekta@00', 'Ekta Chauhan', 'ekta.chauhan1428@gmail.com', '9518210127', 0x494d475f32303230303930345f3138343830365f426f6b65685f5f30315f5f30322e6a7067, NULL),
(81, 'Mohit18', 'Mohit@1233', 'Mohit Motilal Magare', 'magaremohit6@gmail.com', '7057091157', 0x505f32303231303830365f3139353131335f764844525f4175746f5f315f312e6a7067, NULL),
(82, 'Swetga', '', 'R swetha', 'swecha4222@gmail.com', '9100208028', '', NULL),
(83, 'Priya2509', 'Priya@nka2509', 'Priyanka Sarkar', 'priyasarkar2509@gmail.com', '915385094', 0x576861747341707020496d61676520323032322d30322d303420617420332e35312e333820504d2e6a706567, NULL),
(84, 'swathisa4726@gmail.com', 'Swathi24@sa', 'SWATHI S A', 'swathisa4726@gmail.com', '7348854065', 0x535741544849205320412e6a7067, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msg`
--

CREATE TABLE `msg` (
  `sno` int NOT NULL,
  `msg` text NOT NULL,
  `room` text NOT NULL,
  `ip` text NOT NULL,
  `rtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `msg`
--

INSERT INTO `msg` (`sno`, `msg`, `room`, `ip`, `rtime`, `u_name`) VALUES
(11, 'why', 'ash22', '::1', '2021-08-07 14:35:56', NULL),
(14, 'hello', 's3', '::1', '2021-08-07 16:41:57', NULL),
(17, 'hi my self yash', 'global1', '::1', '2021-08-09 10:20:30', NULL),
(18, 'hi bro', 'uid270450', '::1', '2021-08-09 11:00:24', NULL),
(19, 'hello baaby', 'bid61524', '::1', '2021-08-09 11:01:56', NULL),
(20, 'hi i am manishankar', 'bid345410', '::1', '2021-08-09 12:41:36', NULL),
(21, 'nope', 'bid625508', '::1', '2021-08-09 15:12:38', NULL),
(22, 'hi', 'bid684483', '::1', '2021-08-09 15:30:32', NULL),
(23, 'hello', 'global1', '::1', '2021-08-09 15:40:31', NULL),
(24, 'hi', 'bid927242', '::1', '2021-08-11 17:31:23', NULL),
(25, 'why', 'global1', '139.167.222.81', '2021-08-13 06:58:35', NULL),
(26, 'Hi Doctor', 'bid915200', '152.57.198.207', '2021-08-13 14:48:43', NULL),
(27, 'How can I help  you?', 'bid915200', '152.57.198.207', '2021-08-13 14:48:55', NULL),
(28, 'lkjlksjfjs', 'bid915200', '152.57.198.207', '2021-08-13 14:49:07', NULL),
(29, 'lksjfjls', 'bid915200', '152.57.198.207', '2021-08-13 14:49:11', NULL),
(30, 'Hello man', 'global1', '152.57.229.19', '2021-08-17 12:51:57', NULL),
(31, 'How are you', 'global1', '152.57.229.19', '2021-08-17 12:51:59', NULL),
(32, 'hi i am yashasvi', 'global1', '139.167.222.204', '2021-08-17 12:52:33', NULL),
(33, 'Hi. This is sachin', 'global1', '152.57.229.19', '2021-08-17 12:52:47', NULL),
(34, 'Hi, This is Harshul', 'global1', '43.247.40.218', '2021-08-17 12:53:56', NULL),
(35, 'hasij', 'bid552440', '132.154.232.84', '2021-08-23 13:36:18', NULL),
(36, 'hi how are you?', 'bid552440', '132.154.22.99', '2021-08-25 12:54:33', NULL),
(37, 'i am fine', 'bid552440', '132.154.22.99', '2021-08-25 12:54:42', NULL),
(38, 'Hello guys ', 'global1', '139.167.163.194', '2021-08-30 15:49:30', NULL),
(39, 'hey', 'global1', '122.161.51.195', '2021-09-25 12:47:17', NULL),
(40, 'hey', 'global1', '122.161.51.195', '2021-09-25 12:54:15', NULL),
(41, ',ml', 'global1', '157.45.103.18', '2021-09-27 18:00:18', NULL),
(42, 'nkn', 'global1', '157.45.103.18', '2021-09-27 18:01:01', NULL),
(43, 'kk', 'global1', '157.45.103.18', '2021-09-27 18:01:21', NULL),
(44, 'mkk', 'global1', '157.45.103.18', '2021-09-27 18:01:40', NULL),
(45, 'ff', 'global1', '157.45.103.18', '2021-09-27 18:02:06', NULL),
(46, 'mlk4', 'global1', '157.45.103.18', '2021-09-27 19:49:40', NULL),
(47, '', 'global1', '157.45.103.18', '2021-09-27 19:49:41', NULL),
(48, 'jii', 'global1', '157.45.103.18', '2021-09-27 19:49:56', NULL),
(49, '', 'global1', '157.45.103.18', '2021-09-27 19:50:12', NULL),
(50, '', 'global1', '157.45.103.18', '2021-09-27 19:50:18', NULL),
(51, 'mkkllk,l', 'global1', '157.33.254.170', '2021-09-28 06:18:44', NULL),
(52, 'hi', 'global1', '157.33.254.170', '2021-09-28 06:18:54', NULL),
(53, 'hii goodmorning', 'global1', '157.33.254.170', '2021-09-28 06:19:14', NULL),
(54, '', 'global1', '157.33.254.170', '2021-09-28 06:19:33', NULL),
(55, 'hiii', 'global1', '49.37.163.183', '2021-09-28 13:01:09', NULL),
(56, 'good eveing', 'global1', '49.37.163.183', '2021-09-28 13:01:28', NULL),
(57, '', 'global1', '49.37.163.183', '2021-09-28 13:01:40', NULL),
(58, '', 'global1', '49.37.163.183', '2021-09-28 13:01:46', NULL),
(59, '', 'global1', '49.37.163.183', '2021-09-28 13:01:47', NULL),
(60, '', 'global1', '49.37.163.183', '2021-09-28 13:13:25', NULL),
(61, 'hiii', 'global1', '49.37.163.183', '2021-09-28 13:24:05', NULL),
(62, 'good eveing', 'global1', '49.37.163.183', '2021-09-28 13:24:19', NULL),
(63, '', 'global1', '49.37.163.183', '2021-09-28 13:26:37', NULL),
(64, 'hiii', 'global1', '49.37.163.183', '2021-09-28 14:09:06', NULL),
(65, 'hi', 'bid924705', '139.167.174.102', '2021-09-29 10:54:46', NULL),
(66, 'hello', 'bid924705', '139.167.174.102', '2021-09-29 10:54:52', NULL),
(67, 'hi', 'global1', '157.45.120.28', '2021-09-30 10:45:08', NULL),
(68, '', 'global1', '157.45.120.28', '2021-09-30 10:45:21', NULL),
(69, 'testing', 'global1', '106.201.42.232', '2021-10-02 07:08:38', NULL),
(70, 'testing', 'global1', '106.201.42.232', '2021-10-02 07:09:01', NULL),
(71, 'test', 'global1', '106.201.42.232', '2021-10-02 07:09:25', NULL),
(72, 'test', 'global1', '106.201.42.232', '2021-10-02 07:09:44', NULL),
(73, 'test', 'global1', '106.201.42.232', '2021-10-02 07:09:50', NULL),
(74, 'hi my self sangita', 'global1', '103.146.240.201', '2021-10-02 13:34:40', NULL),
(75, 'scAScsa', 'global1', '1.39.17.12', '2021-10-02 17:27:44', NULL),
(76, 'jhbb', 'global1', '157.45.99.132', '2021-10-03 07:22:34', NULL),
(77, 'JHI', 'bid241626', '157.45.99.132', '2021-10-03 08:16:28', NULL),
(78, 'JK', 'bid241626', '157.45.99.132', '2021-10-03 08:16:30', NULL),
(79, 'VH', 'bid241626', '157.45.99.132', '2021-10-03 08:16:31', NULL),
(80, 'VJHV', 'bid241626', '157.45.99.132', '2021-10-03 08:16:33', NULL),
(81, 'HVJHV', 'bid241626', '157.45.99.132', '2021-10-03 08:16:34', NULL),
(82, 'K', 'bid241626', '157.45.99.132', '2021-10-03 08:16:35', NULL),
(83, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:36', NULL),
(84, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:36', NULL),
(85, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:37', NULL),
(86, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:37', NULL),
(87, 'GG', 'bid241626', '157.45.99.132', '2021-10-03 08:16:37', NULL),
(88, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:38', NULL),
(89, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:38', NULL),
(90, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:39', NULL),
(91, '', 'bid241626', '157.45.99.132', '2021-10-03 08:16:40', NULL),
(92, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:41', NULL),
(93, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:42', NULL),
(94, 'G', 'bid241626', '157.45.99.132', '2021-10-03 08:16:44', NULL),
(95, 'hi', 'bid123141', '157.45.100.167', '2021-10-03 11:30:30', NULL),
(96, 'nk', 'global1', '157.45.100.167', '2021-10-03 11:38:02', NULL),
(97, 'kk', 'global1', '157.45.100.167', '2021-10-03 11:38:04', NULL),
(98, 'hii', 'bid744116', '157.45.100.167', '2021-10-03 11:44:11', NULL),
(99, '', 'global1', '152.57.213.10', '2021-10-03 22:22:56', NULL),
(100, 'ji', 'global1', '152.57.213.10', '2021-10-03 22:23:00', NULL),
(101, 'Hui', 'global1', '47.8.42.127', '2021-10-06 05:16:27', NULL),
(102, 'hello', 'global1', '117.204.243.228', '2021-10-06 11:45:20', NULL),
(103, 'hello@', 'global1', '117.204.243.228', '2021-10-06 11:45:44', NULL),
(104, '', 'global1', '117.204.243.228', '2021-10-06 11:46:31', NULL),
(105, 'testing message posted at 23:49.', 'global1', '106.213.193.195', '2021-10-06 18:20:03', NULL),
(106, 'nk', 'global1', '157.45.72.212', '2021-10-14 12:07:52', NULL),
(107, 'tttt', 'bid458248', '49.37.186.119', '2021-10-19 04:00:37', NULL),
(108, 'KKKK', 'bid425425', '157.45.72.80', '2021-10-20 08:03:43', NULL),
(109, 'Hii', 'global1', '49.37.163.131', '2021-10-20 13:33:25', NULL),
(110, 'hi', 'global1', '157.45.132.87', '2021-10-22 10:37:02', NULL),
(111, 'hi', 'global1', '157.45.132.87', '2021-10-22 10:37:15', NULL),
(112, 'fhkm', 'bid458248', '49.37.163.199', '2021-10-23 10:16:42', NULL),
(113, 'jhkjh', 'bid458248', '49.37.163.199', '2021-10-23 10:16:49', NULL),
(114, 'hcb', 'global1', '49.37.163.199', '2021-10-23 13:26:36', NULL),
(115, 'faegesg', 'global1', '157.45.65.106', '2021-10-26 11:36:08', NULL),
(116, 'hi', 'global1', '157.45.65.106', '2021-10-26 11:36:42', NULL),
(117, 'faegesg', 'global1', '157.45.65.106', '2021-10-26 11:36:56', NULL),
(118, 'hiii', 'global1', '157.45.65.106', '2021-10-26 11:38:45', NULL),
(119, 'hhjjj', 'global1', '157.45.71.88', '2021-10-27 06:45:18', NULL),
(120, 'hhi', 'global1', '103.150.138.79', '2021-11-01 07:49:04', NULL),
(121, '', 'global1', '103.150.138.79', '2021-11-01 07:49:08', NULL),
(122, 'hii', 'global1', '103.150.138.79', '2021-11-01 07:49:18', NULL),
(123, '', 'global1', '122.171.253.232', '2021-11-02 10:09:56', NULL),
(124, '', 'global1', '122.171.253.232', '2021-11-02 10:10:05', NULL),
(125, '', 'global1', '122.171.253.232', '2021-11-02 10:14:04', NULL),
(126, '', 'global1', '122.171.253.232', '2021-11-02 10:14:16', NULL),
(127, 'testing', 'bid213050', '122.171.253.232', '2021-11-02 10:31:12', NULL),
(128, 'testing', 'bid607039', '122.171.253.232', '2021-11-02 10:35:06', NULL),
(132, 'hello ', 'global1', '27.61.51.244', '2021-12-16 15:29:52', NULL),
(133, 'myself varun', 'global1', '27.61.51.244', '2021-12-16 15:30:03', NULL),
(134, 'hello from karnataka', 'global1', '27.61.51.244', '2021-12-16 15:37:45', NULL),
(135, 'testing', 'global1', '136.185.156.237', '2021-12-17 09:56:23', NULL),
(136, 'Hi', 'global1', '136.185.156.237', '2021-12-17 09:56:52', NULL),
(137, 'hello from varun', 'global1', '106.200.11.235', '2021-12-17 11:41:49', NULL),
(138, 'hi', 'global1', '106.200.11.235', '2021-12-17 11:41:58', NULL),
(139, 'select ', 'global1', '106.200.11.235', '2021-12-17 11:42:17', NULL),
(140, '', 'global1', '106.200.11.235', '2021-12-17 11:42:19', NULL),
(141, '', 'global1', '106.200.11.235', '2021-12-17 11:42:20', NULL),
(142, 'hh', 'global1', '103.150.138.78', '2021-12-17 12:17:53', NULL),
(143, 'hhh', 'global1', '103.150.138.78', '2021-12-17 12:18:04', NULL),
(144, 'hhh', 'global1', '103.150.138.78', '2021-12-20 12:47:44', NULL),
(145, 'hhh', 'global1', '103.150.138.78', '2021-12-20 12:47:54', NULL),
(146, 'testing', 'global1', '106.208.6.188', '2021-12-21 08:07:34', NULL),
(147, 'testing', 'global1', '106.208.6.188', '2021-12-21 08:08:13', NULL),
(148, 'testing', 'global1', '106.208.6.188', '2021-12-21 08:10:21', NULL),
(149, 'Hello', 'global1', '223.225.243.145', '2021-12-21 12:00:08', NULL),
(150, '', 'global1', '223.225.243.145', '2021-12-21 12:00:18', NULL),
(151, 'testing', 'global1', '157.47.96.103', '2021-12-22 09:57:41', NULL),
(152, 'How are you?', 'global1', '152.57.237.188', '2021-12-23 07:47:35', NULL),
(153, 'hi', 'global1', '27.61.46.23', '2021-12-24 06:37:37', NULL),
(154, 'hello', 'global1', '103.81.37.230', '2021-12-25 16:52:35', NULL),
(155, 'How are you\n', 'global1', '152.57.224.14', '2021-12-26 13:34:56', NULL),
(156, 'Hey Varun did you fixed this\n', 'global1', '152.57.224.14', '2021-12-26 13:35:10', NULL),
(157, 'Is everything working fine..\n', 'global1', '152.57.232.59', '2021-12-27 17:35:31', NULL),
(158, 'hi', 'bid2867260', '27.61.18.246', '2021-12-28 15:33:50', NULL),
(159, 'hello', 'bid2867260', '27.61.18.246', '2021-12-28 15:33:58', NULL),
(160, 'hello', 'bid2867260', '27.61.18.246', '2021-12-28 15:38:50', NULL),
(161, 'say hi', 'bid2867260', '106.200.18.174', '2021-12-28 15:39:04', NULL),
(162, 'UI Looking really good.\n', 'global1', '152.57.232.222', '2021-12-28 16:20:36', NULL),
(163, 'hi', 'global1', '27.61.19.198', '2021-12-29 12:14:35', NULL),
(164, 'Hi.. I am there. Are you availalble?\n', 'bid7172678', '152.57.194.19', '2021-12-31 07:00:52', NULL),
(165, 'hlo\n', 'global1', '60.243.176.17', '2021-12-31 08:08:07', NULL),
(166, 'nice to\n see you', 'global1', '60.243.176.17', '2021-12-31 08:08:37', NULL),
(167, 'se oyu soon\n', 'global1', '60.243.176.17', '2021-12-31 08:08:53', NULL),
(168, 'hhh\n', 'bid5420548', '103.150.138.78', '2022-01-03 05:22:37', NULL),
(169, 'testing\n', 'bid3035483', '122.162.178.110', '2022-01-04 13:27:16', NULL),
(170, 'hi\n', 'bid62', '103.150.138.91', '2022-01-05 13:01:14', NULL),
(171, 'good afternoon\n', 'bid62', '103.150.138.91', '2022-01-05 13:01:21', NULL),
(172, 'hii\n', 'global1', '103.81.38.223', '2022-01-11 11:01:56', NULL),
(173, 'Hello\n', 'global1', '103.81.38.223', '2022-01-11 11:02:16', NULL),
(174, 'hello guys\n', 'global1', '103.81.38.223', '2022-01-11 11:03:12', NULL),
(175, 'hii\n', 'bid7599211', '103.81.38.223', '2022-01-11 11:17:52', NULL),
(176, 'hello', 'global1', '103.206.134.33', '2022-01-11 13:17:37', NULL),
(177, 'hi', 'global1', '27.61.8.45', '2022-01-13 05:25:50', 'varun'),
(178, 'hello', 'global1', '103.81.37.230', '2022-01-13 07:17:23', 'pkjhhbbjnkjkmn'),
(179, 'hello', 'global1', '27.61.9.117', '2022-01-14 07:12:49', 'varun'),
(180, 'hi\n', 'global1', '202.168.147.48', '2022-01-15 07:44:03', 'sam'),
(181, 'testing\n', 'bid565655', '223.184.26.27', '2022-01-19 10:18:06', 'Susmita Vulli'),
(182, 'hiii\n', 'global1', '117.99.246.244', '2022-01-19 14:49:40', 'Vishal Chothe'),
(183, 'bye\n', 'global1', '117.99.246.244', '2022-01-19 14:54:01', 'Vishal Chothe'),
(184, 'nice to meet you\n', 'global1', '117.99.246.244', '2022-01-19 14:54:23', 'Vishal Chothe'),
(185, 'what are you doing\n', 'global1', '117.99.246.244', '2022-01-19 14:55:15', 'Vishal Chothe'),
(186, 'Hello Sir\n', 'bid352300', '117.99.246.244', '2022-01-19 15:10:43', 'Vishal Chothe'),
(187, 'Vishal here\n', 'bid352300', '117.99.246.244', '2022-01-19 15:10:50', 'Vishal Chothe'),
(188, 'are you available on time ?', 'bid352300', '117.99.246.244', '2022-01-19 15:11:17', 'Vishal Chothe'),
(189, 'hey', 'global1', '103.164.241.90', '2022-01-21 13:38:10', 'vrushali'),
(190, 'hello guys', 'global1', '27.61.43.129', '2022-01-25 10:08:33', 'varun'),
(191, 'HI', 'global1', '182.74.51.166', '2022-01-26 13:55:14', 'Preethi Shetty DB'),
(192, 'dbc', 'global1', '42.106.13.16', '2022-02-04 07:27:50', 'khe'),
(193, 'hello', 'global1', '49.36.18.233', '2022-02-04 10:24:48', NULL),
(194, 'hello', 'global1', '117.239.56.6', '2022-02-06 17:06:35', 'pooja shet'),
(195, 'jhj', 'bid1337453', '117.239.56.6', '2022-02-06 18:49:14', 'pooja shet'),
(196, 'hi', 'global1', '106.217.93.222', '2022-02-08 07:30:05', NULL),
(197, 'hi', 'global1', '106.217.93.222', '2022-02-08 07:31:10', NULL),
(198, 'hi', 'global1', '106.217.93.222', '2022-02-08 07:42:15', NULL),
(199, 'hi', 'global1', '106.217.93.222', '2022-02-08 07:43:33', NULL),
(200, '', 'global1', '106.217.93.222', '2022-02-08 07:59:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `new_apointment`
--

CREATE TABLE `new_apointment` (
  `booking_id` int NOT NULL,
  `u_id` int NOT NULL,
  `c_id` int NOT NULL,
  `end_time` time NOT NULL,
  `b_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `b_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `new_apointment`
--

INSERT INTO `new_apointment` (`booking_id`, `u_id`, `c_id`, `end_time`, `b_date`, `booking_time`, `b_id`) VALUES
(3292219, 51, 56, '16:15:00', '2022-01-17', '15:45:00', 2),
(8228264, 51, 56, '16:25:00', '2022-01-17', '15:55:00', 3),
(8079540, 51, 56, '17:25:00', '2022-01-17', '16:55:00', 4),
(3964742, 42, 49, '17:01:55', '2022-01-09', '16:46:55', 5),
(5959281, 42, 49, '17:14:55', '2022-01-09', '16:59:55', 6),
(5281030, 42, 49, '17:25:55', '2022-01-09', '17:10:55', 7),
(1943430, 42, 49, '16:25:55', '2022-01-09', '16:10:55', 8),
(3534921, 42, 49, '15:25:55', '2022-01-09', '15:10:55', 9),
(2545896, 42, 49, '15:35:55', '2022-01-09', '15:20:55', 10),
(9204186, 42, 49, '15:55:55', '2022-01-09', '15:40:55', 11),
(9409581, 42, 49, '16:10:55', '2022-01-16', '15:55:55', 12),
(4070562, 42, 49, '16:40:55', '2022-01-16', '16:25:55', 13),
(2772024, 42, 68, '15:31:00', '2022-01-09', '15:01:00', 14),
(1282720, 42, 68, '13:31:00', '2022-01-09', '13:01:00', 15),
(8116902, 42, 39, '13:40:00', '2022-01-13', '13:10:00', 16),
(1083696, 42, 50, '14:31:00', '2022-01-09', '14:01:00', 17),
(484846, 42, 39, '15:45:00', '2022-03-17', '15:30:00', 18),
(5871853, 42, 39, '17:45:00', '2022-02-28', '17:15:00', 19);

-- --------------------------------------------------------

--
-- Table structure for table `webhook`
--

CREATE TABLE `webhook` (
  `imojo` varchar(200) NOT NULL,
  `payment_id` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `date_of_purchase` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `buyer_name` varchar(100) CHARACTER SET utf8mb4  NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4  NOT NULL,
  `track_id` varchar(100) CHARACTER SET utf8mb4  DEFAULT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'order placed',
  `consultant_id` int NOT NULL,
  `expiry_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `webhook`
--

INSERT INTO `webhook` (`imojo`, `payment_id`, `status`, `email`, `phone`, `purpose`, `date_of_purchase`, `buyer_name`, `amount`, `track_id`, `order_status`, `consultant_id`, `expiry_date`) VALUES
('MOJO1813605A98426109', '259442f539a34490b7dadc5a61ebbce6', 'Credit', 'parth@gmail.com', '+917668711341', 'CONSULTANT FEE', '2021-08-13 14:51:42', 'ash', '400', '123456', 'order placed', 0, NULL),
('MOJO5833749117403657', '58d252ed2162474196e67c4e59da65b8', 'Credit', 'parth@gmail.com', '+917668711341', 'CONSULTANT FEE', '2021-08-17 13:50:34', 'ash', '400', '22222', 'order placed', 0, NULL),
('MOJO6639648001970807', '4e28207f93104880a00bd768f4edb814', 'Credit', 'sangeetamalviya08@gmail.com', '+917668711341', 'SpacTube', '2021-08-17 15:38:45', 'ash', '400', '12244', 'order placed', 0, NULL),
('MOJO1515443047655845', 'df75d440157e472d98e765df01732573', 'Credit', 'sangeetamalviya08@gmail.com', '+917668711341', 'SpacTube', '2021-08-17 15:52:38', 'yashasvi', '30.00', '122344', 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA 16', '2021-10-19 00:00:00', 'Sachin Mohite', '2500', NULL, 'order placed', 0, NULL),
('MOJO3126550534819562', 'a0a3cc9f3d8f413fbbc70e03409f967c', 'Credit', 'contactus@spacece.co', '+919810256713', 'FIFA1', '2021-10-19 17:22:22', 'John Doe', '2500.00', NULL, 'order placed', 0, NULL),
('MOJO262005145511405', '8c9241bd8b1f4b818833ab2e703aa21a', 'Credit', 'raju2@gmail.com', '+919998964711', 'ConsulUs-Fee', '2021-10-19 17:54:30', 'dr.bheem raj', '300.00', NULL, 'order placed', 0, NULL),
('MOJO335343921469630', '4b5aef6ca8af4ceb9906d0bb1e0f876f', 'Credit', 'raju2@gmail.com', '+919998964711', 'ConsulUs-Fee', '2021-10-19 18:11:36', 'dr.amit srivastav', '100.00', NULL, 'order placed', 0, NULL),
('MOJO3419990855534590', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-19 18:48:01', '', '', NULL, 'order placed', 0, NULL),
('MOJO1756835826298310', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 01:59:32', '', '', NULL, 'order placed', 0, NULL),
('MOJO9741983502049216', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:01:38', '', '', NULL, 'order placed', 0, NULL),
('MOJO8403050093369937', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:02:05', '', '', NULL, 'order placed', 0, NULL),
('MOJO858412320266475', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:03:34', '', '', NULL, 'order placed', 0, NULL),
('MOJO6522121634636964', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:04:22', '', '', NULL, 'order placed', 0, NULL),
('MOJO512227374370386', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:06:35', '', '', NULL, 'order placed', 0, NULL),
('MOJO820325155223642', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:10:01', '', '', NULL, 'order placed', 0, NULL),
('MOJO8463953652092574', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:10:32', '', '', NULL, 'order placed', 0, NULL),
('MOJO2070755521963446', '4b5aef6ca8af4ceb9906d0bb1e0f876f', '', '', '', '', '2021-10-20 02:14:49', '', '', NULL, 'order placed', 0, NULL),
('MOJO9333619063907468', '8c9241bd8b1f4b818833ab2e703aa21a', 'Credit', 'raju2@gmail.com', '+919998964711', 'ConsulUs-Fee', '2021-10-20 03:14:37', 'dr.bheem raj', '300.00', NULL, 'order placed', 0, NULL),
('MOJO8195484910232482', '4b5aef6ca8af4ceb9906d0bb1e0f876f', 'Credit', 'raju2@gmail.com', '+919998964711', 'ConsulUs-Fee', '2021-10-20 03:23:29', 'dr.amit srivastav', '100.00', NULL, 'order placed', 0, NULL),
('MOJO3564509438645443', '4b5aef6ca8af4ceb9906d0bb1e0f876f', 'Credit', 'raju2@gmail.com', '+919998964711', 'ConsulUs-Fee', '2021-10-20 03:24:24', 'dr.amit srivastav', '100.00', NULL, 'order placed', 0, NULL),
('MOJO7597926635548690', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-20 13:48:22', '', '', NULL, 'order placed', 0, NULL),
('MOJO1a20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:02:18', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:04:36', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:06:54', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:10:30', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:13:20', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:14:37', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:19:05', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '{', '', '', '', '2021-10-21 03:21:30', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '{', '{', '', '', '2021-10-21 03:23:44', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '{', '{', '', '', '2021-10-21 03:25:16', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '{', '{', '', '', '2021-10-21 03:26:49', '', '', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '{', '{', '{', '{', '2021-10-21 03:28:51', '{', '{', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '{', '{', '{', '2021-10-21 03:30:41', '{', '{', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '{', '{', '{', '{', '2021-10-21 03:39:12', '{', '{', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '{', '{', '{', '{', '2021-10-21 03:40:40', '{', '{', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:43:10', 'Sachin Krishna', '13.90', NULL, 'order placed', 0, NULL),
('MOJO1A20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', 'Credit', '', '', '', '2021-10-21 03:44:10', 'Sachin Krishna', '13.90', NULL, 'order placed', 0, NULL),
('MOJO1a20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:48:50', '', '', NULL, 'order placed', 0, NULL),
('MOJO1a20305D16680675', '8c9241bd8b1f4b818833ab2e703aa21a', 'Credit', 'sachin.mohite@gmail.com', '+919372744039', '', '2021-10-21 03:50:21', 'Sachin Krishna', '13.90', NULL, 'order placed', 0, NULL),
('MOJO9047949786604240', '8c9241bd8b1f4b818833ab2e703aa21a', '', '', '', '', '2021-10-21 03:52:09', '', '', NULL, 'order placed', 0, NULL),
('MOJO9006351079257473', 'MOJO9006351079257473', '', '', '', '', '2021-10-21 04:06:57', '', '', NULL, 'order placed', 0, NULL),
('MOJO2794097158005222', 'MOJO2794097158005222', '', '', '', '', '2021-10-21 04:07:33', '', '', NULL, 'order placed', 0, NULL),
('MOJO8273693727584922', 'MOJO8273693727584922', '', '', '', '', '2021-10-21 05:12:01', '', '', NULL, 'order placed', 0, NULL),
('MOJO3816132661642140', 'MOJO3816132661642140', '', '', '', '', '2021-10-21 05:12:11', '', '', NULL, 'order placed', 0, NULL),
('MOJO8052736214995124', 'MOJO8052736214995124', '', '', '', '', '2021-10-21 05:23:37', '', '', NULL, 'order placed', 0, NULL),
('MOJO1a20305D16680675', 'MOJO1a20305D16680675', 'Credit', 'sachin.mohite@gmail.com', '+919372744039', '', '2021-10-21 05:26:46', 'Sachin Krishna', '13.90', NULL, 'order placed', 0, NULL),
('MOJO1a20305D16680675', 'MOJO1a20305D16680675', 'Credit', 'sachin.mohite@gmail.com', '+919372744039', '', '2021-10-21 05:40:22', 'Sachin Krishna', '13.90', NULL, 'order placed', 0, NULL),
('MOJO2065594711055568', 'MOJO2065594711055568', '', '', '', '', '2021-10-21 05:50:19', '', '', NULL, 'order placed', 0, NULL),
('MOJO2807115553948227', 'MOJO2807115553948227', '', '', '', '', '2021-10-21 05:59:42', '', '', NULL, 'order placed', 0, NULL),
('MOJO1a20X05A36274066', 'ef72773b87e94a2f852cd45a47687322', 'Credit', 'not@engineer.com', '8550969625', 'FIFA 16', '2021-10-20 13:25:58', 'Krishna', '100.00', NULL, 'order placed', 0, NULL),
('MOJO1a20X05A36274066', 'ef72773b87e94a2f852cd45a47687322', 'Credit', 'not@engineer.com', '8550969625', 'FIFA 16', '2021-10-20 13:25:58', 'Krishna', '100.00', NULL, 'order placed', 0, NULL),
('MOJO9025997598307566', 'MOJO9025997598307566', '', '', '', 'SpacActive', '2021-10-21 06:23:35', '', '', NULL, 'order placed', 0, NULL),
('MOJO1a21S05A32306888', 'f7e9d399307f4c56b5b5678616ec0720', 'Credit', 'krishna.thorat20@vit.edu', '8550969625', 'Testing', '2021-10-21 06:28:07', 'Krishna Thorat', '100.00', NULL, 'order placed', 0, NULL),
('MOJO2236086430323657', 'MOJO2236086430323657', '', '', '', 'SpacActive', '2021-10-21 06:43:11', '', '', NULL, 'order placed', 0, NULL),
('MOJO1a20305D16680675', 'MOJO1a20305D16680675', 'Credit', 'sachin.mohite@gmail.com', '+919372744039', 'SpacActive', '2021-10-21 06:50:25', 'Sachin Krishna', '13.90', NULL, 'order placed', 0, NULL),
('MOJO1a20305D16680675', 'MOJO1a20305D16680675', 'Credit', 'sachin.mohite@gmail.com', '+919372744039', 'SpacActive', '2021-10-21 06:55:48', 'Sachin Krishna', '13.90', NULL, 'order placed', 0, NULL),
('MOJO1a21H05D12769873', 'MOJO1a21H05D12769873', 'Credit', 'sachin.mohite@gmail.com', '+919372744039', 'SpacActive', '2021-10-21 07:03:31', 'Sachin you did it', '13.90', NULL, 'order placed', 0, NULL),
('MOJO1a21705D12764483', 'MOJO1a21705D12764483', 'Credit', 'sachin.mohite@gmail.com', '+919372744039', 'SpacActive', '2021-10-21 10:29:50', 'Sachin Close it', '13.90', NULL, 'order placed', 0, NULL),
('MOJO1813605A98426105', 'MOJO1813605A98426109\r\n', 'credit', 'varun@gmail.com', '89756798784', 'consultant', '2022-01-10 07:40:59', 'varun', '1500', 'MOJO1813605A98426109', 'order placed', 0, NULL),
('MOJO181360FA98426105\r\n', 'MOJO181360FA98426105', 'Credit', 'varun@gmail.com', '89756798784', 'Testing', '2022-01-10 08:01:04', '1500', '210', 'MOJO181360FA98426105', 'order placed', 0, NULL),
('MOJO3146191421616896', '93abefc797f941d7b46ffe7627695735', 'Credit', 'raju@gmail.com', '9852100012', 'Testing', '2022-01-25 05:45:22', 'pkjhhbbjnkjkmn', '1200', '93abefc797f941d7b46ffe7627695735', 'order placed', 25, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD UNIQUE KEY `AdminID` (`AdminID`);

--
-- Indexes for table `agora_call`
--
ALTER TABLE `agora_call`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agora_scheduled_call`
--
ALTER TABLE `agora_scheduled_call`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `consultant`
--
ALTER TABLE `consultant`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `consultant_category`
--
ALTER TABLE `consultant_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`X`),
  ADD KEY `descpatientID` (`descID`),
  ADD KEY `descDoctorID` (`doctorIDdesc`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `msg`
--
ALTER TABLE `msg`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `new_apointment`
--
ALTER TABLE `new_apointment`
  ADD PRIMARY KEY (`b_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `agora_call`
--
ALTER TABLE `agora_call`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `agora_scheduled_call`
--
ALTER TABLE `agora_scheduled_call`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consultant`
--
ALTER TABLE `consultant`
  MODIFY `c_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `consultant_category`
--
ALTER TABLE `consultant_category`
  MODIFY `cat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `UID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `msg`
--
ALTER TABLE `msg`
  MODIFY `sno` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `new_apointment`
--
ALTER TABLE `new_apointment`
  MODIFY `b_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
