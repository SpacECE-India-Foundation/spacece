-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2018 at 04:39 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_service_credits`
--

CREATE TABLE IF NOT EXISTS `add_service_credits` (
`add_service_credits_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `days` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_service_credits`
--

INSERT INTO `add_service_credits` (`add_service_credits_id`, `employee_id`, `days`, `date`) VALUES
(3, 33, '15', '02 05, 2014 '),
(4, 33, '11', '02 05, 2014 '),
(7, 44, '10', '02 13, 2014 '),
(8, 44, '1', '02 13, 2014 '),
(9, 46, '5', '02 13, 2014 '),
(10, 47, '5', '02 13, 2014 '),
(11, 43, '5', '02 13, 2014 '),
(12, 50, '10', '02 13, 2014 '),
(14, 39, '10', '03 19, 2014 '),
(15, 40, '10', '03 01, 2014 '),
(16, 58, '10', '03 05, 2014 '),
(17, 62, '2', '09 10, 2018 ');

-- --------------------------------------------------------

--
-- Table structure for table `administrative_information`
--

CREATE TABLE IF NOT EXISTS `administrative_information` (
`administrative_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `affinity_national` varchar(100) NOT NULL,
  `affinity_local` varchar(100) NOT NULL,
  `charges` varchar(100) NOT NULL,
  `offenses` varchar(100) NOT NULL,
  `criminal_record` varchar(100) NOT NULL,
  `service_records` varchar(100) NOT NULL,
  `candidacy` varchar(100) NOT NULL,
  `indigenous_group` varchar(100) NOT NULL,
  `differently_abled` varchar(100) NOT NULL,
  `solo_parent` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`attendance_id` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `am_in` varchar(20) NOT NULL,
  `am_out` varchar(20) NOT NULL,
  `pm_in` varchar(20) NOT NULL,
  `pm_out` varchar(20) NOT NULL,
  `late` varchar(30) NOT NULL,
  `undertime` varchar(30) NOT NULL,
  `member_id` varchar(100) NOT NULL,
  `month` varchar(15) NOT NULL,
  `date` varchar(15) NOT NULL,
  `year` varchar(15) NOT NULL,
  `row_num` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `employee_id`, `am_in`, `am_out`, `pm_in`, `pm_out`, `late`, `undertime`, `member_id`, `month`, `date`, `year`, `row_num`) VALUES
(31, '1', '10:50 am', '', '', '', '140', '', 'ROD-001', 'Aug ', '16', '2015', 1),
(32, '61', '10:52 am', '10:54 am', '', '', '202', '126', 'ALL-060', 'Aug ', '16', '2015', 1);

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE IF NOT EXISTS `child` (
`child_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthdate` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`child_id`, `employee_id`, `name`, `birthdate`) VALUES
(1, 32, 'qwwqe', 'q'),
(2, 32, '1', '1'),
(3, 39, 'sdada', '2014-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `civil_service_eligibility`
--

CREATE TABLE IF NOT EXISTS `civil_service_eligibility` (
`civil_service_eligibility_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `career_service` varchar(50) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `date_examination_conferment` varchar(20) NOT NULL,
  `place_examination_conferment` varchar(50) NOT NULL,
  `license_number` varchar(30) NOT NULL,
  `license_date_release` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `civil_service_eligibility`
--

INSERT INTO `civil_service_eligibility` (`civil_service_eligibility_id`, `employee_id`, `career_service`, `rating`, `date_examination_conferment`, `place_examination_conferment`, `license_number`, `license_date_release`) VALUES
(1, 1, '1', 'q', '2014-01-24', 'q', 'q', '2014-01-24'),
(2, 30, '', 'q', '', 'q', 'q', ''),
(3, 30, '', '', '', '', '', ''),
(4, 30, '', '', '', '', '', ''),
(5, 30, '', 'q', '', 'q', 'q', '');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
`college_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `degree_course` varchar(50) NOT NULL,
  `year_graduated` varchar(30) NOT NULL,
  `highest_grade_level_units_earned` varchar(50) NOT NULL,
  `dates_from_to` varchar(50) NOT NULL,
  `scholar_academic_honors` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `employee_id`, `school_name`, `degree_course`, `year_graduated`, `highest_grade_level_units_earned`, `dates_from_to`, `scholar_academic_honors`) VALUES
(1, 1, '4', '4', '4', '4', '4', '4'),
(2, 30, '0', '0', '0', '0', '0', '0'),
(3, 30, 'q', 'q', 'q', 'q', '0', 'q'),
(4, 39, 'C', 'C', 'ccccccccc', 'C', '0', 'C');

-- --------------------------------------------------------

--
-- Table structure for table `elementary`
--

CREATE TABLE IF NOT EXISTS `elementary` (
`elementary_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `degree_course` varchar(50) NOT NULL,
  `year_graduated` varchar(50) NOT NULL,
  `highest_grade_level_units_earned` varchar(50) NOT NULL,
  `dates_from_to` varchar(50) NOT NULL,
  `scholar_academic_honors` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elementary`
--

INSERT INTO `elementary` (`elementary_id`, `employee_id`, `school_name`, `degree_course`, `year_graduated`, `highest_grade_level_units_earned`, `dates_from_to`, `scholar_academic_honors`) VALUES
(1, 1, '1', '1', '1', '1', '1', '1'),
(2, 30, 'q', 'q', 'q', 'q', '0', 'q'),
(3, 39, 'x', 'ggg', 'x', 'ggg', 'x', 'x');

-- --------------------------------------------------------

--
-- Table structure for table `employee_details`
--

CREATE TABLE IF NOT EXISTS `employee_details` (
`employee_details_id` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `citizenship` varchar(30) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `bloodtype` varchar(10) NOT NULL,
  `gsis_id_no` varchar(20) NOT NULL,
  `pag_ibig_id_no` varchar(20) NOT NULL,
  `philhealth_no` varchar(20) NOT NULL,
  `sss_no` varchar(20) NOT NULL,
  `residential_address` varchar(50) NOT NULL,
  `ra_zip_code` varchar(10) NOT NULL,
  `ra_telephone_no` varchar(20) NOT NULL,
  `permanent_address` varchar(50) NOT NULL,
  `pa_zip_code` varchar(10) NOT NULL,
  `pa_telephone_no` varchar(20) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `cellphone_no` varchar(20) NOT NULL,
  `agency_employee_no` varchar(20) NOT NULL,
  `tin` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_details`
--

INSERT INTO `employee_details` (`employee_details_id`, `employee_id`, `citizenship`, `height`, `weight`, `bloodtype`, `gsis_id_no`, `pag_ibig_id_no`, `philhealth_no`, `sss_no`, `residential_address`, `ra_zip_code`, `ra_telephone_no`, `permanent_address`, `pa_zip_code`, `pa_telephone_no`, `email_address`, `cellphone_no`, `agency_employee_no`, `tin`) VALUES
(21, '1', 'ESP', '5', '69 kgs', 'a', '55600', '12', '212', '2522', 'talisay cty  ', '0202', '0939302890', 'talisay city', '0202', '09393002890', 'demo@gmail.com', '85200000002', '1', '5552'),
(22, '27', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'qq', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q', 'q'),
(71, '2', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(72, '60', 't', 't', 't', 't', 't', 't', 't', 'tt', 't ', 't', '332313132', 't ', 't', 't', 't', 'tt', 't', 't'),
(73, '61', 'H', 'H', 'H', 'H', 'A', 'HH', 'HH', 'H', 'H', 'H', 'H', 'H ', 'HH', 'H', 'H', 'H', 'H', 'H'),
(74, '62', 'demo', '6.0', '59', 'b+', '10101', '454', '55', '555', 'Demo', '545454', '6565656', 'demo ', '545454', '6565656', 'demo@demo.com', '8525552501', '5456', '555');

-- --------------------------------------------------------

--
-- Table structure for table `graduate_studies`
--

CREATE TABLE IF NOT EXISTS `graduate_studies` (
`graduate_studies_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `degree_course` varchar(50) NOT NULL,
  `year_graduated` varchar(30) NOT NULL,
  `highest_grade_level_units_earned` varchar(50) NOT NULL,
  `dates_from_to` varchar(30) NOT NULL,
  `scholar_academic_honors` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `graduate_studies`
--

INSERT INTO `graduate_studies` (`graduate_studies_id`, `employee_id`, `school_name`, `degree_course`, `year_graduated`, `highest_grade_level_units_earned`, `dates_from_to`, `scholar_academic_honors`) VALUES
(1, 1, '5', '5', '5', '5', '5', '5'),
(2, 30, '0', '0', '0', '0', '0', '0'),
(3, 30, 'q', 'qqq', 'q', 'q', '0', 'q'),
(4, 39, 'S', 'S', 'S', 'S', '0', 'sdas');

-- --------------------------------------------------------

--
-- Table structure for table `leave_credits`
--

CREATE TABLE IF NOT EXISTS `leave_credits` (
`leave_credits_id` int(11) NOT NULL,
  `leave_type` varchar(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `days` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_credits`
--

INSERT INTO `leave_credits` (`leave_credits_id`, `leave_type`, `employee_id`, `date`, `days`) VALUES
(14, 'Sick', 33, '02 05, 2014 ', '1'),
(16, 'Vacation', 44, 'feb 11-18, 2014', '9'),
(17, 'Sick', 46, 'February 11, 2014', '1'),
(18, 'Sick', 47, 'February 11, 2014', '1'),
(19, 'Sick', 43, 'February 11-12, 2014', '2'),
(20, 'Vacation', 50, 'February 11, 2014', '9'),
(21, 'Vacation', 39, 'May 1-9, 2014', '9');

-- --------------------------------------------------------

--
-- Table structure for table `other_information`
--

CREATE TABLE IF NOT EXISTS `other_information` (
`other_information_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `special_skills` varchar(100) NOT NULL,
  `non_academic_distinctions_recognition` varchar(100) NOT NULL,
  `membership_association_organization` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `other_information`
--

INSERT INTO `other_information` (`other_information_id`, `employee_id`, `special_skills`, `non_academic_distinctions_recognition`, `membership_association_organization`) VALUES
(1, 1, 'q', 'q', 'q'),
(2, 30, 'qq', '', ''),
(3, 30, 'qq', '', ''),
(4, 30, 'q', 'q', 'q');

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE IF NOT EXISTS `parents` (
`parents_id` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `father_firstname` varchar(50) NOT NULL,
  `father_middlename` varchar(50) NOT NULL,
  `father_surname` varchar(50) NOT NULL,
  `mother_firstname` varchar(50) NOT NULL,
  `mother_middlename` varchar(50) NOT NULL,
  `mother_surname` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parents`
--

INSERT INTO `parents` (`parents_id`, `employee_id`, `father_firstname`, `father_middlename`, `father_surname`, `mother_firstname`, `mother_middlename`, `mother_surname`) VALUES
(1, '32', 'v', 'v', 'v', 'vv', 'v', 'vv'),
(3, '39', 'd', 'd', 'd', 'd', 'd', 'd'),
(4, '41', 'johny', 'walker', 'statham', 'star', 'geb', 'na'),
(5, '57', 'weqwesadasdas', 'wee', 'ew', 'ew', 'wew', 'wew');

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE IF NOT EXISTS `personal_information` (
`employee_id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `name_extension` varchar(10) NOT NULL,
  `place_birth` varchar(30) NOT NULL,
  `sex` varchar(30) NOT NULL,
  `civil_status` varchar(30) NOT NULL,
  `department` varchar(30) NOT NULL,
  `image` varchar(500) NOT NULL,
  `cis_no` varchar(50) NOT NULL,
  `position` varchar(30) NOT NULL,
  `date_of_birth` varchar(30) NOT NULL,
  `member_id` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personal_information`
--

INSERT INTO `personal_information` (`employee_id`, `firstname`, `middlename`, `surname`, `name_extension`, `place_birth`, `sex`, `civil_status`, `department`, `image`, `cis_no`, `position`, `date_of_birth`, `member_id`) VALUES
(1, 'Harry', 'Den', 'Jr', '', 'ESPN', 'male', 'Single', 'IT', 'images.jpg', '', 'administrative officer IV', 'October 7, 1991', 'ROD-001'),
(60, 'Kate', 'Lee', 'Anne', '', 't', 'Female', 'Single', 'tt', 'data.png', 't', 't', '2015-08-25', 'CAR-059'),
(61, 'Tom', 'Abe', 'Kent', '', 'HH', 'Male', 'Single', 'H', 'Chrysanthemum.jpg', 'H', 'H', '2015-08-15', 'ALL-060'),
(62, 'Bruno', 'jr', 'Camato', 'demo', 'demo', 'Male', 'Seperated', 'IT', 'male6.jpg', '22025', '1', '1998-02-02', 'HAR-061');

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE IF NOT EXISTS `references` (
`reference_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `secondary`
--

CREATE TABLE IF NOT EXISTS `secondary` (
`secondary_id` int(11) NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `degree_course` varchar(50) NOT NULL,
  `year_graduated` varchar(30) NOT NULL,
  `highest_grade_level_units_earned` varchar(100) NOT NULL,
  `dates_from_to` varchar(50) NOT NULL,
  `scholar_academic_honors` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secondary`
--

INSERT INTO `secondary` (`secondary_id`, `employee_id`, `school_name`, `degree_course`, `year_graduated`, `highest_grade_level_units_earned`, `dates_from_to`, `scholar_academic_honors`) VALUES
(1, '1', '2', '2', '2', '2', '2', '2'),
(2, '30', '0', '0', '0', '0', '0', '0'),
(3, '30', 'q', 'q', 'q', 'q', '0', 'q'),
(4, '39', 'Q', 'WQSWDASDASDAS', '', '', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `service_credits`
--

CREATE TABLE IF NOT EXISTS `service_credits` (
`service_credits_id` int(11) NOT NULL,
  `Balance` varchar(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `days` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_credits`
--

INSERT INTO `service_credits` (`service_credits_id`, `Balance`, `employee_id`, `date`, `days`) VALUES
(33, '0', 27, '', 0),
(34, '0', 28, '', 0),
(35, '0', 29, '', 0),
(36, '0', 30, '', 0),
(37, '0', 31, '', 0),
(38, '0', 32, '', 0),
(39, '0', 33, '', 0),
(40, '0', 26, '', 0),
(41, '0', 35, '', 0),
(42, '0', 36, '', 0),
(43, '0', 26, '', 0),
(44, '0', 26, '', 0),
(45, '1', 39, '', 0),
(46, '10', 40, '', 0),
(47, '0', 41, '', 0),
(48, '0', 42, '', 0),
(49, '3', 43, '', 0),
(50, '2', 44, '', 0),
(51, '0', 45, '', 0),
(52, '4', 46, '', 0),
(53, '4', 47, '', 0),
(54, '0', 48, '', 0),
(55, '0', 49, '', 0),
(56, '1', 50, '', 0),
(57, '0', 51, '', 0),
(58, '0', 52, '', 0),
(59, '0', 53, '', 0),
(60, '0', 54, '', 0),
(61, '0', 55, '', 0),
(62, '0', 56, '', 0),
(63, '0', 56, '', 0),
(64, '0', 57, '', 0),
(65, '10', 58, '', 0),
(66, '0', 2, '', 0),
(67, '0', 60, '', 0),
(68, '0', 61, '', 0),
(69, '2', 62, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `spouse`
--

CREATE TABLE IF NOT EXISTS `spouse` (
`spouse_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `spouse_firstname` varchar(50) NOT NULL,
  `spouse_middlename` varchar(50) NOT NULL,
  `spouse_surname` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `employer_bus_name` varchar(50) NOT NULL,
  `business_address` varchar(50) NOT NULL,
  `telephone_no` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spouse`
--

INSERT INTO `spouse` (`spouse_id`, `employee_id`, `spouse_firstname`, `spouse_middlename`, `spouse_surname`, `occupation`, `employer_bus_name`, `business_address`, `telephone_no`) VALUES
(1, 30, 'p', 'p', '', 'p', 'p', 'p', 'p'),
(2, 32, 'qwsadas', 'wda', '', 'hgh', 'w', 'hg', 'g'),
(6, 39, 'ty', 't', 'yt', 't', 'uyt', 't', 'q'),
(7, 41, 'Jaypee', 'De Guzman', 'Pontino', 'Owner of my Heart', '010812', 'Sa Puso Ko', '09426578645');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
`tax_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `tax_certificate` varchar(50) NOT NULL,
  `issued_at` varchar(20) NOT NULL,
  `issued_on` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `training_programs`
--

CREATE TABLE IF NOT EXISTS `training_programs` (
`training_programs_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `title_seminar` varchar(100) NOT NULL,
  `date_from` varchar(30) NOT NULL,
  `date_to` varchar(30) NOT NULL,
  `number_hours` varchar(10) NOT NULL,
  `conducted` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `training_programs`
--

INSERT INTO `training_programs` (`training_programs_id`, `employee_id`, `title_seminar`, `date_from`, `date_to`, `number_hours`, `conducted`) VALUES
(1, 1, '1', '1', '1', '1', '1'),
(2, 30, 'q', '', '', 'q', 'q');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `employee_id`, `username`, `password`) VALUES
(1, 1, 'admin1', 'admin1'),
(43, 60, 'qwerty', 'qwerty'),
(44, 61, 'A', 'A'),
(45, 62, 'harry', 'code0');

-- --------------------------------------------------------

--
-- Table structure for table `vocational_trade_course`
--

CREATE TABLE IF NOT EXISTS `vocational_trade_course` (
`vocational_trade_course_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `degree_course` varchar(50) NOT NULL,
  `year_graduated` varchar(30) NOT NULL,
  `highest_grade_level_units_earned` varchar(50) NOT NULL,
  `dates_from_to` varchar(50) NOT NULL,
  `scholar_academic_honors` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vocational_trade_course`
--

INSERT INTO `vocational_trade_course` (`vocational_trade_course_id`, `employee_id`, `school_name`, `degree_course`, `year_graduated`, `highest_grade_level_units_earned`, `dates_from_to`, `scholar_academic_honors`) VALUES
(1, 1, '3', '3', '3', '3', '3', '3'),
(2, 30, '0', '0', '0', '0', '0', '0'),
(3, 30, 'q', 'qq', 'q', 'q', '0', 'q'),
(4, 39, 'R', 'TRT', 'RT', '', '0', 'RT');

-- --------------------------------------------------------

--
-- Table structure for table `voluntary_work`
--

CREATE TABLE IF NOT EXISTS `voluntary_work` (
`voluntary_work_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `name_address_organization` varchar(100) NOT NULL,
  `dates_from` varchar(20) NOT NULL,
  `dates_to` varchar(20) NOT NULL,
  `number_hours` varchar(20) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voluntary_work`
--

INSERT INTO `voluntary_work` (`voluntary_work_id`, `employee_id`, `name_address_organization`, `dates_from`, `dates_to`, `number_hours`, `position`) VALUES
(1, 1, 'q', '2014-01-04', '2014-01-04', 'q', 'q'),
(2, 30, 'q', '2014-02-07', '2014-02-14', 'q', 'q'),
(3, 30, 'w', '2014-02-01', '2014-02-01', 'w', 'w'),
(4, 30, '', '', '', 'q', '');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE IF NOT EXISTS `work_experience` (
`work_experience_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `dates_from` varchar(30) NOT NULL,
  `dates_to` varchar(30) NOT NULL,
  `position_title` varchar(50) NOT NULL,
  `work_place` varchar(50) NOT NULL,
  `monthly_salary` varchar(30) NOT NULL,
  `salary_grade_step_inc` varchar(30) NOT NULL,
  `status_appointment` varchar(50) NOT NULL,
  `gov_service` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`work_experience_id`, `employee_id`, `dates_from`, `dates_to`, `position_title`, `work_place`, `monthly_salary`, `salary_grade_step_inc`, `status_appointment`, `gov_service`) VALUES
(2, 1, 'q', 'q', 'qq', 'q', 'q', 'q', 'q', 'q');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_service_credits`
--
ALTER TABLE `add_service_credits`
 ADD PRIMARY KEY (`add_service_credits_id`);

--
-- Indexes for table `administrative_information`
--
ALTER TABLE `administrative_information`
 ADD PRIMARY KEY (`administrative_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
 ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `civil_service_eligibility`
--
ALTER TABLE `civil_service_eligibility`
 ADD PRIMARY KEY (`civil_service_eligibility_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
 ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `elementary`
--
ALTER TABLE `elementary`
 ADD PRIMARY KEY (`elementary_id`);

--
-- Indexes for table `employee_details`
--
ALTER TABLE `employee_details`
 ADD PRIMARY KEY (`employee_details_id`);

--
-- Indexes for table `graduate_studies`
--
ALTER TABLE `graduate_studies`
 ADD PRIMARY KEY (`graduate_studies_id`);

--
-- Indexes for table `leave_credits`
--
ALTER TABLE `leave_credits`
 ADD PRIMARY KEY (`leave_credits_id`);

--
-- Indexes for table `other_information`
--
ALTER TABLE `other_information`
 ADD PRIMARY KEY (`other_information_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
 ADD PRIMARY KEY (`parents_id`);

--
-- Indexes for table `personal_information`
--
ALTER TABLE `personal_information`
 ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
 ADD PRIMARY KEY (`reference_id`);

--
-- Indexes for table `secondary`
--
ALTER TABLE `secondary`
 ADD PRIMARY KEY (`secondary_id`);

--
-- Indexes for table `service_credits`
--
ALTER TABLE `service_credits`
 ADD PRIMARY KEY (`service_credits_id`);

--
-- Indexes for table `spouse`
--
ALTER TABLE `spouse`
 ADD PRIMARY KEY (`spouse_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
 ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `training_programs`
--
ALTER TABLE `training_programs`
 ADD PRIMARY KEY (`training_programs_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vocational_trade_course`
--
ALTER TABLE `vocational_trade_course`
 ADD PRIMARY KEY (`vocational_trade_course_id`);

--
-- Indexes for table `voluntary_work`
--
ALTER TABLE `voluntary_work`
 ADD PRIMARY KEY (`voluntary_work_id`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
 ADD PRIMARY KEY (`work_experience_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_service_credits`
--
ALTER TABLE `add_service_credits`
MODIFY `add_service_credits_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `administrative_information`
--
ALTER TABLE `administrative_information`
MODIFY `administrative_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `civil_service_eligibility`
--
ALTER TABLE `civil_service_eligibility`
MODIFY `civil_service_eligibility_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `elementary`
--
ALTER TABLE `elementary`
MODIFY `elementary_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee_details`
--
ALTER TABLE `employee_details`
MODIFY `employee_details_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `graduate_studies`
--
ALTER TABLE `graduate_studies`
MODIFY `graduate_studies_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `leave_credits`
--
ALTER TABLE `leave_credits`
MODIFY `leave_credits_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `other_information`
--
ALTER TABLE `other_information`
MODIFY `other_information_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
MODIFY `parents_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
MODIFY `reference_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `secondary`
--
ALTER TABLE `secondary`
MODIFY `secondary_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `service_credits`
--
ALTER TABLE `service_credits`
MODIFY `service_credits_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `spouse`
--
ALTER TABLE `spouse`
MODIFY `spouse_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `training_programs`
--
ALTER TABLE `training_programs`
MODIFY `training_programs_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `vocational_trade_course`
--
ALTER TABLE `vocational_trade_course`
MODIFY `vocational_trade_course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `voluntary_work`
--
ALTER TABLE `voluntary_work`
MODIFY `voluntary_work_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
MODIFY `work_experience_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
