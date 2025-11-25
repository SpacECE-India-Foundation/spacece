-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: cits1
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblchildren`
--

DROP TABLE IF EXISTS `tblchildren`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tblchildren` (
  `childName` varchar(255) DEFAULT NULL,
  `parentContno` varchar(20) DEFAULT NULL,
  `parentEmail` varchar(255) DEFAULT NULL,
  `childGender` varchar(10) DEFAULT NULL,
  `parentAdd` varchar(255) DEFAULT NULL,
  `childAge` int DEFAULT NULL,
  `childImmu` varchar(255) DEFAULT NULL,
  `childDoB` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblchildren`
--

LOCK TABLES `tblchildren` WRITE;
/*!40000 ALTER TABLE `tblchildren` DISABLE KEYS */;
INSERT INTO `tblchildren` VALUES ('John Doe','1234567890','sachin@gmail.com','Male','123 Main St, City, Country',5,'Up to date','2019-01-01'),('Sachin','9310177993','20103170@mail.jiit.ac.in','male','delhi',10,'ocd','2014-04-23'),('Dummy','9211887771','20103170@mail.jiit.ac.in','male','pune',10,'asd','2014-04-23'),('Davy','9211887771','20103100@mail.jiit.ac.in','male','ghaziabad',10,'asd','2014-04-23'),('Davy','9211887771','20103170@mail.jiit.ac.in','male','Delhi',10,'ASD','2014-04-23'),('Dummy','9123456789','pranjal@gmil.com','male','Lucknow',22,'OCD','2002-01-13'),('Dora','7845124578','dora@gmail.com','female','Hawaaii',0,'ChocoBar','2023-10-12');
/*!40000 ALTER TABLE `tblchildren` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-20 15:53:22

-- ============================================================
-- ✅ Bug Fix Summary: 0000533 & 0000534
-- ------------------------------------------------------------
-- 0000533: Profile image was not visible in the 'Your Children'
--           section for Delivery Boy login.
-- 0000534: Registered child card was not showing after successful
--           registration in the 'Your Children' section.
--
-- Root Cause:
--   Missing or incomplete 'children' table structure in database,
--   which caused child details and profile images to not load.
--
-- Fix Implemented:
--   ➤ Created a new 'children' table to properly store child details.
--   ➤ Added 'img_path' column to store image file path for each child.
--   ➤ Ensured all required fields (name, DOB, gender, etc.) are included.
--
-- Status: ✅ FIXED and VERIFIED
-- ============================================================


-- Table structure for table `children` 
DROP TABLE IF EXISTS `children`;

CREATE TABLE `children` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `child_name` VARCHAR(100) DEFAULT NULL,
  `parent_contact` VARCHAR(15) DEFAULT NULL,
  `parent_email` VARCHAR(100) DEFAULT NULL,
  `gender` VARCHAR(10) DEFAULT NULL,
  `parent_address` VARCHAR(255) DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `age` VARCHAR(10) DEFAULT NULL,
  `bcg` VARCHAR(20) DEFAULT NULL,
  `opv0` VARCHAR(20) DEFAULT NULL,
  `hepb` VARCHAR(20) DEFAULT NULL,
  `OPV-1` VARCHAR(20) DEFAULT NULL,
  `RVV-1` VARCHAR(20) DEFAULT NULL,
  `img_path` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



