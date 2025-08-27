-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: growth_tracker
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
-- Table structure for table `Dose`
--

DROP TABLE IF EXISTS `Dose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Dose` (
  `dose_id` int NOT NULL AUTO_INCREMENT,
  `vaccine_id` int DEFAULT NULL,
  `dose_number` int DEFAULT NULL,
  `age_range` varchar(50) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`dose_id`),
  KEY `vaccine_id` (`vaccine_id`),
  CONSTRAINT `Dose_ibfk_1` FOREIGN KEY (`vaccine_id`) REFERENCES `Vaccine` (`vaccine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dose`
--

LOCK TABLES `Dose` WRITE;
/*!40000 ALTER TABLE `Dose` DISABLE KEYS */;
INSERT INTO `Dose` VALUES (1,1,1,'Birth','1st dose'),(2,1,2,'1 month','2nd dose'),(3,1,3,'6 months','3rd dose at 6 months'),(4,2,1,'2 months','1st dose'),(5,2,2,'4 months','2nd dose'),(6,2,3,'8 months','3rd dose if RV5, maximum age 8 months'),(7,2,1,'2 months','1st dose'),(8,2,2,'4 months','2nd dose'),(9,2,3,'8 months','3rd dose if RV5, maximum age 8 months'),(10,3,1,'2 months','1st dose'),(11,3,2,'4 months','2nd dose'),(12,3,3,'6 months','3rd dose'),(13,3,4,'15-18 months','4th dose'),(14,3,5,'4-6 years','5th dose'),(15,4,1,'2 months','1st dose'),(16,4,2,'4 months','2nd dose'),(17,4,3,'12-15 months','3rd or 4th dose'),(18,5,1,'2 months','1st dose'),(19,5,2,'4 months','2nd dose'),(20,5,3,'6 months','3rd dose'),(21,5,4,'12-15 months','4th dose'),(22,5,5,'4-6 years','5th dose'),(23,6,1,'2 months','1st dose'),(24,6,2,'4 months','2nd dose'),(25,6,3,'6 months','3rd dose'),(26,6,4,'12-15 months','4th dose'),(27,7,1,'Yearly','Yearly dose'),(28,8,1,'12-15 months','1st dose'),(29,8,2,'4-6 years','2nd dose'),(30,9,1,'12-15 months','1st dose'),(31,9,2,'4-6 years','2nd dose'),(32,10,1,'12-23 months','1st dose'),(33,10,2,'Minimum interval: 6 months','2nd dose starting at age 12 months'),(34,11,1,'11-12 years','1st dose'),(35,11,2,'16 years','2nd dose'),(36,12,1,'11-12 years','1st dose'),(37,13,1,'9-14 years','1st dose'),(38,13,2,'Minimum interval: 5 months','2nd dose starting at 9-14 years'),(39,13,3,'15-26 years','3-dose series starting at 15-26 years');
/*!40000 ALTER TABLE `Dose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_vaccination_record`
--

DROP TABLE IF EXISTS `User_vaccination_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;

CREATE TABLE `User_vaccination_record` (
  `u_id` int NOT NULL,
  `vaccine_id` int NOT NULL,
  `dose_number` int NOT NULL,
  `age` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`u_id`,`vaccine_id`,`dose_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_vaccination_record`
--

LOCK TABLES `User_vaccination_record` WRITE;
/*!40000 ALTER TABLE `User_vaccination_record` DISABLE KEYS */;
INSERT INTO `User_vaccination_record` VALUES (0,1,1,'0',0),(0,2,1,'0',0),(0,11,1,'0',0),(381,1,1,'18 Months',0),(381,1,2,'18 Months',0),(381,1,3,'18 Months',0),(381,2,1,'0',0);
/*!40000 ALTER TABLE `User_vaccination_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Vaccine`
--

DROP TABLE IF EXISTS `Vaccine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8*/;
CREATE TABLE `Vaccine` (
  `vaccine_id` int NOT NULL AUTO_INCREMENT,
  `vaccine_name` varchar(100) NOT NULL,
  `protects_against` varchar(200) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`vaccine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Vaccine`
--

LOCK TABLES `Vaccine` WRITE;
/*!40000 ALTER TABLE `Vaccine` DISABLE KEYS */;
INSERT INTO `Vaccine` VALUES (1,'Hepatitis B (HepB)','Hepatitis B','3 doses at 0, 1–2, 6–18 months'),(2,'Rotavirus (RV)','Rotavirus','Maximum age for the final dose is 8 months'),(3,'Diphtheria, Tetanus, & Acellular Pertussis (DTaP)','Diphtheria, Tetanus, Pertussis','5-dose series at 2, 4, 6, 15–18 months, 4–6 years'),(4,'Haemophilus influenzae type b (Hib)','Haemophilus influenzae type b','3 or 4 doses, 2, 4, 6 months, 12–15 months'),(5,'Pneumococcal conjugate (PCV13)','Pneumococcal disease','4-dose series at 2, 4, 6, 12–15 months'),(6,'Inactivated poliovirus (IPV)','Polio','4-dose series at 2, 4, 6, 12–15 months'),(7,'Influenza (IIV)','Influenza','-'),(8,'Measles, Mumps, Rubella (MMR)','Measles, Mumps, Rubella','1 or 2 doses annually'),(9,'Varicella (VAR)','Varicella (Chickenpox)','2 doses at 12-15 months, 4-6 years'),(10,'Hepatitis A (HepA)','Hepatitis A','2-dose series (minimum interval: 6 months) beginning at age 12 months'),(11,'Meningococcal','Meningococcal disease','2-dose series: 11-12 years, 16 years'),(12,'Tetanus, Diphtheria, & Acellular Pertussis (Tdap)','Tetanus, Diphtheria, Pertussis','1 dose at 11-12 years'),(13,'Human Papillomavirus (HPV)','Certain strains of HPV causing cancer','2-dose series starting at 9-14 years, 3-dose series starting at 15-26 years');
/*!40000 ALTER TABLE `Vaccine` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `growth_result`
--

DROP TABLE IF EXISTS `growth_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;

CREATE TABLE `growth_result` (
  `u_id` int NOT NULL,
  `date` date NOT NULL,
  `water_intake` double DEFAULT NULL,
  `outdoor_play` double DEFAULT NULL,
  `fruits` double DEFAULT NULL,
  `vegetables` double DEFAULT NULL,
  `screen_time` double DEFAULT NULL,
  `sleep_time` double DEFAULT NULL,
  `day` text,
  `average` double DEFAULT NULL,
  PRIMARY KEY (`u_id`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `growth_result`
--

LOCK TABLES `growth_result` WRITE;
/*!40000 ALTER TABLE `growth_result` DISABLE KEYS */;
INSERT INTO `growth_result` VALUES (380,'2024-07-20',500,2,250,250,5,7,'Sat',132.6389),(381,'2024-07-10',1000,2,35,350,2,8,'Wed',67.36111),(381,'2024-07-16',1000,2,200,500,4,6,'Tue',134.72221),(381,'2024-07-17',500,8,24,159,1,8,'Wed',63.277782),(381,'2024-07-18',1000,6,24,268,2,8,'Thu',69.333336),(381,'2024-07-19',1000,2,200,500,6,6,'Fri',129.16667),(381,'2024-07-20',1000,5,26,280,2,8,'Sat',68.05555),(392,'2024-07-20',1000,0,5,2,10,10,'Sat',11.916669);
/*!40000 ALTER TABLE `growth_result` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-20 15:55:21
