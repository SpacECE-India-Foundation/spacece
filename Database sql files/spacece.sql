-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: spacece
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `consultant`
--

DROP TABLE IF EXISTS `consultant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `consultant` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `c_category` int NOT NULL,
  `c_office` varchar(100) NOT NULL,
  `c_from_time` time NOT NULL,
  `c_to_time` time NOT NULL,
  `c_language` varchar(50) NOT NULL,
  `c_fee` double NOT NULL,
  `c_available_from` varchar(20) NOT NULL,
  `c_available_to` varchar(20) NOT NULL,
  `c_qualification` varchar(100) NOT NULL,
  `c_aval_days` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`c_id`),
  KEY `c_category` (`c_category`),
  KEY `consultant_ibfk_1` (`u_id`),
  CONSTRAINT `consultant_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `consultant_ibfk_2` FOREIGN KEY (`c_category`) REFERENCES `consultant_category` (`cat_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultant`
--

LOCK TABLES `consultant` WRITE;
/*!40000 ALTER TABLE `consultant` DISABLE KEYS */;
INSERT INTO `consultant` VALUES (8,39,3,'Hinjewadi, Pune','10:00:00','18:00:00','English',250,'Monday','Monday','MD','Monday,Tuesday,Saturday,Wednesday,Thursday,Friday'),(13,49,1,'india','13:00:00','19:00:00','Hindi',45,'Monday','Thursday','MD','Sunday'),(14,50,4,'bombay','14:00:00','20:00:00','English',69,'Monday','Tuesday','Btech','Sunday'),(15,52,5,'pune','14:20:00','18:16:00','English',100,'Monday','Monday','12','Sunday'),(16,55,1,'Bangalore','11:00:00','14:00:00','English',20,'Monday','Friday','MBBS','Sunday'),(17,56,3,'pune','12:59:04','18:00:00','English',100,'Monday','Monday','12','Monday,Tuesday,Saturday,Wednesday,Thursday,Friday'),(18,68,4,'NY','12:00:00','18:00:00','Hindi',123,'Monday','Tuesday','ABC','Sunday'),(19,72,4,'NY','12:00:00','18:00:00','Hindi',123,'Monday','Tuesday','ABC','Sunday'),(23,85,2,'Samta nager, basmath,dist. Hingoli','20:13:00','23:16:00','English',1000,'Monday','Monday','mba','Monday,Tuesday,Saturday,Wednesday,Thursday,Friday'),(24,87,2,'Bangalore','14:30:00','17:30:00','English',500,'Monday','Saturday','MBBS','Monday,Tuesday,Saturday,Wednesday,Thursday,Friday'),(25,321,3,'gwalior','10:00:00','11:00:00','english',54000,'8:00','11:00','CSE','Everyday(except sunday)'),(26,323,3,'zjjssue','12:00:00','18:00:00','English',6000,'Monday','Tuesday','68',''),(28,331,3,'jdp','12:00:00','23:00:00','Hindi',6000,'Monday','Tuesday','computer science 🔭',''),(29,332,3,'jagdalpur','12:00:00','18:00:00','Hindi',6000,'Monday','Tuesday','computer science',''),(30,333,3,'jdp','12:00:00','18:00:00','English',6000,'Monday','Tuesday','computer science 🫂',''),(31,344,3,'jdp','12:00:00','18:00:00','English',6000,'Monday','Tuesday','computer science 🫂',''),(32,345,3,'jdp','12:00:00','18:00:00','Hindi',6000,'Monday','Tuesday','computer science',''),(33,346,3,'jdp fhd','12:00:00','17:00:00','Hindi',6000,'Monday','Tuesday','wo28edn',''),(34,347,3,'rjjreeh6urjr','12:00:00','18:00:00','Hindi',6000,'Monday','Tuesday','e783rjf',''),(35,348,3,'jejdrjrj','12:00:00','17:00:00','English',6000,'Monday','Tuesday','hsjs','[Monday, Tuesday]'),(36,349,2,'gghttu','13:00:00','18:00:00','Hindi',6000,'Monday','Tuesday','jwjshd','Monday, Tuesday'),(37,350,3,'jdp','12:00:00','18:00:00','Hindi',6000,'Monday','Tuesday','okok','Monday, Tuesday'),(38,352,1,'gormi samadhiya colony','10:04:00','11:00:00','English',875,'','','java','Tuesday,Wednesday,Thursday,Friday,Saturday'),(39,353,3,'jvu','12:00:00','18:00:00','English',60009,'Monday','Tuesday','cs','Monday,Tuesday'),(40,356,2,'Pune','09:00:00','16:00:00','Hindi',500,'Monday','Tuesday','MBBS',''),(41,357,4,'pune','09:00:00','16:00:00','Hindi',500,'Monday','Tuesday','MBBS',''),(42,358,3,'Pune','09:00:00','18:00:00','Hindi',500,'','','MBBS',''),(45,361,4,'pune','10:00:00','17:00:00','Hindi',500,'','','MBBS',''),(46,362,3,'gwalior','10:00:00','11:00:00','english',54000,'','','CSE','Everyday(except sunday)'),(47,363,2,'pune','09:00:00','16:00:00','Hindi',500,'','','MBBS','Monday,Tuesday,Wednesday,Thursday,Friday'),(49,365,2,'Pune','09:00:00','17:00:00','Hindi',500,'','','MBBS','Monday,Tuesday,Wednesday,Thursday,Friday'),(50,366,1,'pune','09:00:00','16:20:00','Hindi',500,'','','MBBS','Monday,Tuesday,Wednesday,Thursday,Friday'),(51,367,3,'vjvu7f','12:00:00','19:00:00','Hindi',6000,'Monday','Tuesday','rus','Monday,Tuesday'),(52,369,5,'GWL','10:00:00','18:00:00','English',450,'','','MD','Tuesday,Thursday,Saturday,Sunday'),(53,384,1,'noida','08:30:00','09:30:00','English',1200,'','','MBBS','Monday'),(54,385,1,'GWL','10:10:00','16:10:00','English',500,'','','MD','Monday,Tuesday,Wednesday,Thursday,Friday'),(55,386,1,'GWL','10:10:00','16:10:00','English',500,'','','MD','Monday,Tuesday,Wednesday,Thursday,Friday'),(56,387,1,'Not Known','19:00:00','20:00:00','English',700,'','','MBBS (UCMS & GTB hospital), MD Pediatrics, NNF Neonatology (LTMMC mumbai)','Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'),(57,388,5,'Not Known','09:00:00','19:00:00','Hindi',1500,'','','Post-Graduation in Sports Science and Nutrition','Monday,Tuesday,Wednesday,Thursday,Friday'),(58,389,5,'Bengaluru','10:00:00','18:00:00','English',3000,'','','MSc (Clinical Biochemistry)','Thursday'),(59,390,5,'Mumbai','09:00:00','19:00:00','English',1500,'','','Diploma (Nutrition And Dietetics Management)','Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'),(60,391,1,'Ludhiana','09:00:00','15:00:00','English',700,'','','MBBS, MD PEDIATRICS','Monday,Tuesday,Wednesday');
/*!40000 ALTER TABLE `consultant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consultant_category`
--

DROP TABLE IF EXISTS `consultant_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `consultant_category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cat_slug` varchar(100) NOT NULL,
  `cat_img` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consultant_category`
--

LOCK TABLES `consultant_category` WRITE;
/*!40000 ALTER TABLE `consultant_category` DISABLE KEYS */;
INSERT INTO `consultant_category` VALUES (1,'Paediatrician','paediatrician','d1.jpg'),(2,'Psychiatrist','psychiatrist','d3.jpg'),(3,'Physical Health','physical-health','d4.jpg'),(4,'Mental Health','mental-health','d5.jpg'),(5,'Nutritionist','nutritionist','d6.jpg'),(6,'all','all','all.jpg');
/*!40000 ALTER TABLE `consultant_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courier`
--

DROP TABLE IF EXISTS `courier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `courier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `imojo_id` varchar(255) NOT NULL,
  `delivery_person` varchar(255) DEFAULT NULL,
  `status` enum('not_picked','not_delivered','delivered','') NOT NULL DEFAULT 'not_picked',
  `address` varchar(255) NOT NULL,
  `location_from_longitute` float NOT NULL,
  `location_from_latitude` float NOT NULL,
  `location_from_address` varchar(100) NOT NULL,
  `location_to_longitute` float NOT NULL,
  `location_to_latitude` float NOT NULL,
  `location_to_address` varchar(100) NOT NULL,
  `pick_up_timestamp` timestamp NULL DEFAULT NULL,
  `delivered_timestamp` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `courier_ibfk_1` (`user_id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `courier_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `courier_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `libforsmall`.`orders` (`order_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courier`
--

LOCK TABLES `courier` WRITE;
/*!40000 ALTER TABLE `courier` DISABLE KEYS */;
/*!40000 ALTER TABLE `courier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learnonapp_courses`
--

DROP TABLE IF EXISTS `learnonapp_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnonapp_courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(100) CHARACTER SET utf8  DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `mode` enum('Online','Offline') NOT NULL,
  `duration` smallint NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnonapp_courses`
--

LOCK TABLES `learnonapp_courses` WRITE;
/*!40000 ALTER TABLE `learnonapp_courses` DISABLE KEYS */;
INSERT INTO `learnonapp_courses` VALUES (1,'Emergent Literacy','In order to make children critically thinking adults and observers, it is important that we allow our young learners to imagine and converse in their home language(s) ( the L1 language). However, because of various reasons, most children in India arenu2019t taught in their home languages in schools. At home, parents donu2019t know how to strengthen the L1 language by efficiently using the home as a learning space.',NULL,'Whatsapp','Offline',30,49.99),(2,'Home as a learning','In the ages of 1 to 3 years, the child makes major strides towards independence. During this age a child starts walking, running, naming objects, mumbling words, identifying patterns and figures around him. Toddlers can also do scribbling on the walls, make marks similar to a real object, build blocks and try to eat by themselves. Most of the children learn these functional skills from the environment at their homes.',NULL,'Whatsapp','Online',30,49.99),(3,'Natural Learning','The objective of this five day workshop on ‘ NATURAL LEARNING’ by SPACEECE Organization is to make parents well equipped with the concept of ‘Natural learning’- whats, whys, wheres and hows? The ulterior objective of the workshop is to compulse parents to use the principles of Natural learning during Early Childhood Education.',NULL,'Whatsapp','Offline',30,39);
/*!40000 ALTER TABLE `learnonapp_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learnonapp_messages`
--

DROP TABLE IF EXISTS `learnonapp_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnonapp_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_of_day` smallint NOT NULL,
  `time` varchar(100) NOT NULL,
  `header` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnonapp_messages`
--

LOCK TABLES `learnonapp_messages` WRITE;
/*!40000 ALTER TABLE `learnonapp_messages` DISABLE KEYS */;
INSERT INTO `learnonapp_messages` VALUES (1,1,'8:00 AM','Introduction','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day1: Introduction* 🍁\r\n\r\nhttps://youtu.be/byLb4z-uqEg\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(2,1,'11:00 AM','Quotes',''),(3,1,'5:00 PM','Questions',''),(4,2,'8:00 AM','Introduction','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day2: Introduction* 🍁\r\n\r\nhttps://youtu.be/NctraENjyNA\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(5,2,'10:00 AM','Reading Material','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day2: Reading Material and Video*🍁\r\n\r\n*Reading material:* https://docs.google.com/document/u/1/d/1C4xYBWwEgr-J4kCIggP4niVVvXhhyQRTLIB2bZK5MoA/mobilebasic\r\n*Video Recording:* https://youtu.be/D4hvBxCLgm8\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(6,2,'11:00 AM','Quotes',''),(7,2,'5:00 PM','Questions',''),(8,3,'8:00 AM','Introduction','🍁 SpacECE-LearnOnApp 🍁\r\n🍁 Course001-Home as a Learning SPACE 🍁\r\n🍁 Day3: Introduction 🍁\r\n\r\nhttps://youtu.be/457rQRlz4xc\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(9,3,'10:00 AM','Reading Material','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day3: Reading Material and Video🍁\r\n\r\n*Reading material:* https://docs.google.com/document/d/1eweO80zDfCoEzfsh983QNq7HPDtkpfhR4NT8oRhu6Tw/edit?usp=sharing\r\n*Video recording:* https://youtu.be/457rQRlz4xc\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(10,3,'11:00 AM','Quotes',''),(11,3,'5:00 PM','Questions',''),(12,4,'8:00 AM','Introduction','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day4: introduction* 🍁\r\n\r\nhttps://youtu.be/-HBWMteRMAY\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(13,4,'10:00 AM','Reading Material','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day4: Reading Material and Video*🍁\r\n\r\n*Reading material:* https://docs.google.com/document/d/1rR7_sggZ6i_PDezKM4SsstHdrg9Ut1pUbdxZJi9yE7c/editusp=sharing                                                                                                                                                                                    \r\n*Video Recording:* https://youtu.be/D2ysrAlnPx4\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(14,4,'11:00 AM','Quotes',''),(15,4,'5:00 PM','Questions',''),(16,5,'8:00 AM','Introduction','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day5: Introduction* 🍁\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(17,5,'10:00 AM','Reading Material','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day5: Reading Material and Video* 🍁\r\n\r\n*Reading material:* https://docs.google.com/document/d/1nCVQqonukARarK_BnZuNB2BfrrR2qDOx/edit?usp=sharing&ouid=111531550679710763482&rtpof=true&sd=true\r\n*Video Recording:* https://youtu.be/2T_JHkYiZFs \r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(18,5,'11:00 AM','Quotes',''),(19,5,'5:00 PM','Questions',''),(20,6,'3:00 PM','Online Session','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day6: Online Session* 🍁\r\n\r\n*Link:*\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation'),(21,1,'10:00 AM','Reading Material','🍁 *SpacECE-LearnOnApp* 🍁\r\n🍁 *Course001-Home as a Learning SPACE* 🍁\r\n🍁 *Day1: Reading Material and Video* 🍁\r\n\r\n*Reading Material:* https://docs.google.com/document/d/e/2PACX-1vTM3k9ZXr4x13oO7TLVU0ZHn2erZs9OKdEeBDanWdQgmWGAqmt-37otrbS1B66cm_Y6KhSmxy4F-6q1/pub\r\n*Video Recording:* https://youtu.be/XlLSmDQU-EM\r\n\r\nThanks and Regards,\r\nLearnOnApp\r\nSpacECE India Foundation');
/*!40000 ALTER TABLE `learnonapp_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learnonapp_subcourses`
--

DROP TABLE IF EXISTS `learnonapp_subcourses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnonapp_subcourses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cid` int NOT NULL,
  `day` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `docs` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `learnonapp_subcourses_ibfk_1` (`cid`),
  CONSTRAINT `learnonapp_subcourses_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `learnonapp_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnonapp_subcourses`
--

LOCK TABLES `learnonapp_subcourses` WRITE;
/*!40000 ALTER TABLE `learnonapp_subcourses` DISABLE KEYS */;
/*!40000 ALTER TABLE `learnonapp_subcourses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learnonapp_users_courses`
--

DROP TABLE IF EXISTS `learnonapp_users_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnonapp_users_courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `cid` int NOT NULL,
  `payment_status` enum('failed','paid') DEFAULT NULL,
  `payment_details` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `learnonapp_users_courses_ibfk_1` (`uid`),
  KEY `cid` (`cid`),
  CONSTRAINT `learnonapp_users_courses_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `learnonapp_users_courses_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `learnonapp_courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnonapp_users_courses`
--

LOCK TABLES `learnonapp_users_courses` WRITE;
/*!40000 ALTER TABLE `learnonapp_users_courses` DISABLE KEYS */;
INSERT INTO `learnonapp_users_courses` VALUES (9,54,2,'paid','MOJO2105B05A42112809','2022-01-05 09:43:01'),(12,39,1,'paid','MOJO2118105A52032093','2022-01-18 01:23:57'),(13,109,2,'paid','MOJO2119P05A53414502','2022-01-19 05:27:17'),(14,133,1,'failed',NULL,'2022-01-21 11:49:50'),(15,133,3,'paid','MOJO2121T05N46244780','2022-01-21 11:53:22'),(16,133,3,'failed',NULL,'2022-01-21 12:04:13'),(17,309,1,'paid','MOJO2121T05N46244781','2024-07-13 20:55:26'),(18,309,2,'paid','MOJO2121T05N46244782','2024-07-13 20:55:38'),(19,309,3,'paid','MOJO2121T05N46244783','2024-07-13 20:55:49'),(22,307,3,'failed','','2024-07-13 20:56:43'),(23,307,2,'failed','','2024-07-13 20:56:51');
/*!40000 ALTER TABLE `learnonapp_users_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `ntfID` int NOT NULL AUTO_INCREMENT,
  `ntfTitle` text,
  `ntfBody` text,
  `ntfProduct` varchar(50) DEFAULT NULL,
  `ntfTimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ntfID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (1,'SpacActive - Day1 Activity','This is a Day 1 activity','promotion','2021-10-25 04:06:19'),(2,'SpacActive - Day2 Activity','This is a Day 2 activity','promotion','2021-11-01 04:06:19');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `p_name` varchar(255) NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `p_name` (`p_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription`
--

DROP TABLE IF EXISTS `subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `subscription` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription`
--

LOCK TABLES `subscription` WRITE;
/*!40000 ALTER TABLE `subscription` DISABLE KEYS */;
INSERT INTO `subscription` VALUES (66,'112@12'),(67,'112@12.com'),(68,'112@gmai.l.com'),(45,'20103170@mail.jiit.ac.in'),(53,'aasdfssds@gmail.com'),(40,'abcd@gmail.com'),(41,'abcd12@gmail.com'),(44,'abcd123@gmail.com'),(51,'ads@123.com'),(52,'ads@gmail.com'),(50,'ashishsahu7224059144@gmail.com'),(56,'dffgng@gmail.com'),(55,'dfg@gmail.com'),(65,'dora@gmail.com'),(47,'harshul@gmail.com'),(46,'harshul7713@gmail.com'),(48,'nbtx10607@mail.jiit.ac.in'),(42,'prineqadeer0786@gmail.com'),(49,'ptimumbai@vsnl.net'),(43,'qadirul.hasan14355@gmail.com'),(37,'salovarshaikh@gmail.com'),(57,'sdfghj@gmail.com'),(71,'sevwestsevwest1978@gmail.com'),(64,'shivambh57680bhadoriya@gmail.com'),(63,'shivambh5768bhadoriya@gmail.com'),(59,'shivamsingh@gmail.com'),(58,'shivamsingh57680@gmail.com'),(70,'svein_e_westgaard@hotmail.com'),(61,'vaddcvdscs@gmail.com'),(60,'vads@gmail.com'),(35,'varunmanila@gmail.com'),(36,'varunmanila89@gmail.com'),(38,'vasishthkatre@123.com'),(39,'vasishthkatre@gmail.co'),(54,'vasishthkatre@gmail.com'),(62,'vasishthkatre111@gmail.com'),(69,'vvk111@gmail.com');
/*!40000 ALTER TABLE `subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activity_mail`
--

DROP TABLE IF EXISTS `user_activity_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `user_activity_mail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `act_id` int NOT NULL,
  `act_date` date NOT NULL,
  `is_mail_sent` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `act_id` (`act_id`)
) ENGINE=InnoDB AUTO_INCREMENT=475 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activity_mail`
--

LOCK TABLES `user_activity_mail` WRITE;
/*!40000 ALTER TABLE `user_activity_mail` DISABLE KEYS */;
INSERT INTO `user_activity_mail` VALUES (473,87,32,'2022-03-11',1),(474,53,32,'2022-03-11',1);
/*!40000 ALTER TABLE `user_activity_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_notification`
--

DROP TABLE IF EXISTS `user_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `user_notification` (
  `noti_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `noti_id` (`noti_id`),
  KEY `u_id` (`u_id`),
  CONSTRAINT `user_notification_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `user_notification_ibfk_3` FOREIGN KEY (`noti_id`) REFERENCES `notifications` (`ntfID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_notification`
--

LOCK TABLES `user_notification` WRITE;
/*!40000 ALTER TABLE `user_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `u_name` varchar(200) DEFAULT NULL,
  `u_email` varchar(255) NOT NULL,
  `u_password` varchar(255) DEFAULT NULL,
  `u_mob` varchar(255) DEFAULT NULL,
  `u_image` text,
  `u_type` varchar(255) NOT NULL DEFAULT 'customer',
  `days` int NOT NULL DEFAULT '0',
  `space_active` varchar(20) NOT NULL DEFAULT 'inactive',
  `learnon_app` varchar(20) DEFAULT NULL,
  `spacetube` varchar(20) NOT NULL DEFAULT 'inactive',
  `u_createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `u_email` (`u_email`)
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Space Foundation','admin@spacece.co','8a6f2805b4515ac12058e79e66539be9','8550969625','SpacECELogo.jpg','admin',0,'inactive','inactive','inactive','2022-01-11 05:37:04'),(39,'Krishna Thorat','krishnathorat007@gmail.com','8a6f2805b4515ac12058e79e66539be9','8550969625','rohit-tandon-9wg5jCEPBsw-unsplash.jpg','consultant',0,'inactive','inactive','inactive','2021-12-24 12:16:38'),(40,'suraj prakash singh','surajprakash612@gmail.com','e8ecacd9479ce00c7c4b940aa27253c0','8639739231','pps.jpeg','customer',0,'inactive','inactive','inactive','2021-12-24 12:27:48'),(41,'George','abc@gmail.com','c4ca4238a0b923820dcc509a6f75849b','123','','consultant',0,'inactive','inactive','inactive','2021-12-24 12:47:52'),(42,'Ramesh','user1@gmail.com','c4ca4238a0b923820dcc509a6f75849b','123','','customer',0,'inactive','inactive','inactive','2021-12-24 12:50:08'),(43,'Umesh','user2@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','','consultant',0,'inactive','inactive','inactive','2021-12-24 14:42:40'),(44,'Umesh','user3@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','','consultant',0,'inactive','inactive','inactive','2021-12-24 14:44:35'),(45,'Ujjawal','user4@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','Ujjawaljpg','customer',0,'inactive','inactive','inactive','2021-12-24 15:05:13'),(46,'Shreya','user6@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','Shreya.jpg','customer',0,'inactive','inactive','inactive','2021-12-24 16:08:26'),(47,'Utkarsh','user11@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','Utkarsh.jpg','consultant',0,'inactive','inactive','inactive','2021-12-25 05:52:43'),(48,'Utkarsh','user12@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','Utkarsh.jpg','customer',0,'inactive','inactive','inactive','2021-12-25 05:53:40'),(49,'Utkarsh','consult1@gmail.com','e10adc3949ba59abbe56e057f20f883e','1234567891','Utkarsh.jpg','consultant',0,'inactive','inactive','inactive','2021-12-25 14:15:03'),(50,'Devendra','consult2@gmail.com','e10adc3949ba59abbe56e057f20f883e','1234567890','img.jpg','consultant',0,'inactive','inactive','inactive','2021-12-25 14:22:42'),(51,'varun kumar k','varun@gmail.com','2138cb5b0302e84382dd9b3677576b24','8951698545','varun1.jpg','customer',0,'inactive','inactive','inactive','2021-12-27 10:58:17'),(52,'dddddd','kkk@gmail.com','df780a97b7d6a8f779f14728bccd3c4c','9090909090','123.jpg','consultant',0,'inactive','inactive','inactive','2021-12-28 08:48:02'),(53,'Sachin Mohite','sachin.mohite@gmail.com','15285722f9def45c091725aee9c387cb','9372744039','SpacECE Logo - WhatsApp - download.jpg','customer',0,'inactive','inactive','inactive','2021-12-28 10:57:43'),(54,'Susmita','chotu.sonia@gmail.com','033c91317f9b6795106a825cf8ef773d','3333333333','IMG-20200524-WA0004 (2).jpg','customer',0,'inactive','inactive','inactive','2021-12-29 03:18:20'),(55,'Ajay','arige.ajay@gmail.com','033c91317f9b6795106a825cf8ef773d','6666666664','IMG-20200524-WA0004 (2).jpg','consultant',0,'inactive','inactive','inactive','2021-12-29 03:21:37'),(56,'snehal salave','snehal130@gmail.com','df780a97b7d6a8f779f14728bccd3c4c','9022478080','logo2.jpg','consultant',0,'inactive','inactive','inactive','2021-12-29 08:14:32'),(57,'prangal patil','pranjal@gmail.com','25f9e794323b453885f5181f1b624d0b','1234567893','Screenshot (63).png','customer',0,'inactive','inactive','inactive','2021-12-29 08:21:05'),(58,'Krishna Thorat','krishnathorat008@gmail.com','8a6f2805b4515ac12058e79e66539be9','8550969625','w3.JPG','customer',0,'inactive','inactive','inactive','2021-12-29 08:56:55'),(59,'Krishna Thorat','krishna.thorat20@vit.edu','8a6f2805b4515ac12058e79e66539be9','8550969625','W2.JPG','customer',0,'inactive','inactive','inactive','2021-12-29 09:01:50'),(60,'rita','rita@gmail.com','df780a97b7d6a8f779f14728bccd3c4c','9087655678','temp_image_20210407_135325_d8f280ba-c237-4f27-a03c-3ecff5185d46.jpg','customer',0,'inactive','inactive','inactive','2021-12-29 09:11:00'),(61,'ABC','ABC11111@gmail.com','e882b72bccfc2ad578c27b0d9b472a14','9099999999','temp_image_20210407_135325_d8f280ba-c237-4f27-a03c-3ecff5185d46.jpg','customer',0,'inactive','inactive','inactive','2021-12-29 09:13:09'),(62,'pinka','pinka123@gmail.com','421f39a8ff4dd996a3e57877c3d98146','9087909809','123.jpg','customer',0,'inactive','inactive','inactive','2021-12-29 09:15:14'),(63,'Krishna Thorat','not@engineer.com','8a6f2805b4515ac12058e79e66539be9','8550969625','WRESTLING.JPG','customer',0,'inactive','inactive','inactive','2021-12-29 10:03:26'),(64,'Jayesh Hemant Borae','jayborse59@gmail.com','14f54983d1e87ccdabb873007b1e6f6c','8626033209','Remini20211009103820419.jpg','customer',0,'inactive','inactive','inactive','2022-01-02 09:35:41'),(65,'pkjhhbbjnkjkmn','raju@gmail.com','25f9e794323b453885f5181f1b624d0b','9852100012','Screenshot (83).png','customer',0,'inactive','inactive','inactive','2022-01-02 16:49:05'),(66,'pooja','pooja@gmail.com','df780a97b7d6a8f779f14728bccd3c4c','9022345689','123.jpg','customer',0,'inactive','inactive','inactive','2022-01-03 07:17:25'),(67,'Captain','user8@gmail.com','e10adc3949ba59abbe56e057f20f883e','55','Captain.jpg','customer',0,'inactive','inactive','inactive','2022-01-04 08:41:41'),(68,'captain','consult11@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','captain.jpg','consultant',0,'inactive','inactive','inactive','2022-01-04 09:14:40'),(69,'Sakshi Kapote','kapotesakshi29@gmail.com','a037df1d6ebaad1fa1d709e7a7f24f69','9325358061','larm-rmah-AEaTUnvneik-unsplash.jpg','customer',0,'inactive','inactive','inactive','2022-01-04 09:27:49'),(70,'Abhishek','user9@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','Abhishek.jpg','customer',0,'inactive','inactive','inactive','2022-01-04 09:59:24'),(71,'Captain','user10@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','Captain.jpg','customer',0,'inactive','inactive','inactive','2022-01-04 10:02:32'),(72,'Udeshya','consult12@gmail.com','7694f4a66316e53c8cdd9d9954bd611d','123','Udeshya.jpg','consultant',0,'inactive','inactive','inactive','2022-01-04 10:30:20'),(73,'ajay','chotu.sania@gmail.com','033c91317f9b6795106a825cf8ef773d','9056454545','IMG-20200524-WA0004 (2).jpg','customer',0,'inactive','inactive','inactive','2022-01-04 13:07:22'),(74,'xxxx','chotu.sania@mail.com','033c91317f9b6795106a825cf8ef773d','9023453443','IMG-20200524-WA0004 (2).jpg','customer',0,'inactive','inactive','inactive','2022-01-04 13:14:29'),(75,'Ankit','ankit@gmail.com','033c91317f9b6795106a825cf8ef773d','8023232323','IMG-20200524-WA0004 (2).jpg','customer',0,'inactive','inactive','inactive','2022-01-05 13:38:24'),(76,'Saurabh  Chuadhari','chaudharisaurabh5699@gmail.com','4b46da8494c1f6654ced844e79d7461f','9579526346','saur pic.jpg','customer',0,'inactive','inactive','inactive','2022-01-07 11:52:10'),(77,'Abhinav Tiwari','abhinavtiwari8539@gmail.com','1022e0c6591b4daf92232a387febeda2','9595503331','original_608928e1-df49-488f-9521-4be8117164a7_IMG_20211103_164024.jpg','customer',0,'inactive','inactive','inactive','2022-01-07 12:46:48'),(78,'Ankit','chotu.sonia@mail.com','033c91317f9b6795106a825cf8ef773d','9606888725ccccc\n\n&&&&&&\n9606888745\n69999887776','Ankit.jpeg','consultant',0,'inactive','inactive','inactive','2022-01-08 02:52:35'),(79,'Ankit','cu.sania@mail.com','033c91317f9b6795106a825cf8ef773d','9606888725ccccc\n\n&&&&&&\n9606888745\n69999887776','Ankit.jpeg','consultant',0,'inactive','inactive','inactive','2022-01-08 02:53:05'),(80,'gggg','arige@gmail.com','033c91317f9b6795106a825cf8ef773d','7876686767','gggg.jpeg','consultant',0,'inactive','inactive','inactive','2022-01-08 02:53:56'),(81,'4667888','pawarpsp97@gmail.com','c4ca4238a0b923820dcc509a6f75849b','4567890321','4667888.jpeg','customer',0,'inactive','inactive','inactive','2022-01-08 16:42:45'),(83,'Umesh Anil Khandare','khandareumesh13@gmail.com','3e9fd42e162f89f36b1f424168be8cc9','8390139031','passport.jpeg','customer',0,'inactive','inactive','inactive','2022-01-11 10:17:28'),(84,'Vaibhav Khandare','khandareumesh14@gmail.com','3e9fd42e162f89f36b1f424168be8cc9','8390139031','download.jpg','customer',0,'inactive','inactive','inactive','2022-01-11 10:51:59'),(85,'ShaliniAnil Khandare','khandareumesh15@gmail.com','3e9fd42e162f89f36b1f424168be8cc9','8830242472','1d40e597ad5436038925729677c9314b (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-11 11:40:51'),(86,'Roshan patil','patilroshan503@gmail.com','687af8c029f9df52e0b934a60a126bdc','8793073594','WhatsApp Image 2022-01-07 at 11.46.30 PM.jpeg','customer',0,'inactive','inactive','inactive','2022-01-11 11:57:15'),(87,'varunk','varunmanila89@gmail.com','5f4dcc3b5aa765d61d8327deb882cf99','8722235441','6-024f0ee051991.png','consultant',0,'inactive','inactive','inactive','2022-01-13 06:54:47'),(88,'sam','sameedham01@gmail.com','28e0ef517bcc607039da951ae7e557a1','9497588490','Capture.PNG','customer',0,'inactive','inactive','inactive','2022-01-13 07:48:14'),(89,'Sandeep mewada','sandeepmewada76@gmail.com','1a60af4377c3f0fdacf0bbe36b1ddeb2','7746875035','j.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 03:00:12'),(90,'M.A Muzakkir Ahmed','muzakkirma143@gmail.com','b00fafbd84a2ad59491ea0d460a132a2','8309242968','IMG_20191120_214146.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 03:02:52'),(91,'Varad Sandip waikar','1999varadwaikar@gmail.com','e927ec1cf5f8024d7d7918e092196a17','9370226616','IMG20210109114236.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 03:03:26'),(92,'satyapriya sahani','satyapriyasahani0@gmail.com','fea3a5239d0fef390dc7ff6e8b4bb5a4','9348364689','proflle.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 03:06:56'),(93,'Sudhanshu Shukla','sudhanshushukla071@gmail.com','a06de0a2eecd625a7df6de1a3ac8f86f','9867179095','image.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 03:29:00'),(94,'Nagajyothi','kottamnagajyothi176@gmail.com','9a2b21da8911551e82d08f6d3e9b8109','9502506275','IMG_20211221_150242.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 03:55:33'),(95,'Meghana N','1997meghana@gmail.com','61c9c103a8935ef5d85f5d3bc22f317c','9036660481','meghana_n_x964wmqacba1n9ev1fhtnufq.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 04:19:13'),(96,'JOY BOSU','joybosu456@gmail.com','2d2a8d39259a3766b3ee001395f22be3','8391906640','20211227_004007.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 05:32:38'),(97,'chetan mal','cmali507@gmail.com','12865c376dccb42c2f49c3d61dc5e4e2','9545270449','logo.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 06:17:17'),(98,'Vidya','vdzuluk@gmail.com','6679d239d5a3f312c2890cec31deb043','9130051978','Photo.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 09:57:51'),(99,'manthan','manthan@gmail.com','a30be188929d68d782a1cfaf3882ac34','9878963564','mantha_786_gate_img.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 10:03:51'),(100,'manthan','manthanbansal1@gmail.com','a30be188929d68d782a1cfaf3882ac34','9574565556','mantha_786_gate_img.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 10:05:05'),(101,'Tushar tyagi','mailtotushartyagi07@gmail.com','e71b014ee5194c95ce724c2c13b6b3cc','8077099135','b8c7960a-4aad-4bf9-86de-ace05fd11c23.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 12:18:11'),(102,'Krati Varshney','varshneykrati8532@gmail.com','7cce1ebe8540ba334b82b64a648a84d8','8532044845','Picsart_22-01-14_17-16-14-602.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 12:32:12'),(103,'Varad Waikar','varadwaikar7@gmail.com','ed18a427c27d619fb31d1d1d77e0abfe','9370226616','IMG-20211108-WA0036.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 13:09:39'),(104,'Priyanka','priyankaminde1@gmail.com','c9f590f5e729544e3a6bd2e819de721d','9359977210','IMG-20220113-WA0015.jpg','customer',0,'inactive','inactive','inactive','2022-01-14 16:30:43'),(105,'Soumyaranjan Sahoo','soumyaranjanalex@gmail.com','f23acfee1498d098634d9ab270012634','9114558681','Soumya Image2.jpg','customer',0,'inactive','inactive','inactive','2022-01-15 17:42:59'),(106,'demo','demo@spacece.co','62cc2d8b4bf2d8728120d052163a77df','8722235441','Screenshot 2021-12-28 142015.jpg','customer',0,'inactive','inactive','inactive','2022-01-18 09:40:01'),(107,'susmita','chotu.nia@mail.com','033c91317f9b6795106a825cf8ef773d','9045634567','IMG-20200524-WA0004 (2).jpg','customer',0,'inactive','inactive','inactive','2022-01-19 09:51:00'),(108,'Susmita Vulli','choti.nia@mail.com','033c91317f9b6795106a825cf8ef773d','9606888725','IMG-20200524-WA0004 (2).jpg','customer',0,'inactive','inactive','inactive','2022-01-19 09:55:23'),(109,'Susmita Vulli','choti.niai@mail.com','033c91317f9b6795106a825cf8ef773d','9606888725','IMG-20200524-WA0004 (2).jpg','customer',0,'inactive','inactive','inactive','2022-01-19 10:07:58'),(110,'Susmita Vulli','chotu.ni@mail.com','033c91317f9b6795106a825cf8ef773d','9606888725','IMG-20200524-WA0004 (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 12:36:42'),(111,'Susmita Vulli','choi.niai@mail.com','033c91317f9b6795106a825cf8ef773d','9606888725','IMG-20200524-WA0004 (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 12:45:01'),(112,'SHAIK SUFIAN','sufi3135@gmail.com','e3cbb2cb8ed152783f8d3b523bb77bfd','8686332453','20211006_155836_compress63.jpg','customer',0,'inactive','inactive','inactive','2022-01-19 13:10:16'),(113,'Vishal Chothe','vishalchothe134@gmail.com','8ab5220ef349856049f73d0bc4a17846','9552001231','Passport Size.jpg','customer',0,'inactive','inactive','inactive','2022-01-19 14:09:32'),(114,'Vishal Sir','vishalchothe123@gmail.com','8ab5220ef349856049f73d0bc4a17846','9552001231','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 19:50:00'),(115,'Vishal Sir','vishalsir123@gmail.com','ae1285ab8aaaca3c8fb0f140c815a983','9552001231','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 19:52:18'),(116,'Vishal Sir','vishal123@gmail.com','ae1285ab8aaaca3c8fb0f140c815a983','9552001231','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 19:57:25'),(117,'Vishal Sir','vishalkumar@gmail.com','ae1285ab8aaaca3c8fb0f140c815a983','8698720310','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 20:00:59'),(118,'Vishal Sir','vishalwinner1707@gmail.com','ae1285ab8aaaca3c8fb0f140c815a983','8698720310','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 20:01:32'),(119,'Vishal','vishalwinners1707@gmail.com','8ab5220ef349856049f73d0bc4a17846','9552001231','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 20:15:30'),(120,'Rahul Kadam','rahulkadam123@gmail.com','ebaaba27b32928a25f2ad6185fc0cc74','8698720310','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 20:34:19'),(121,'Amol','amolmule1707@gmail.com','ebaaba27b32928a25f2ad6185fc0cc74','8698720310','Passport Size.jpg','customer',0,'inactive','inactive','inactive','2022-01-19 20:40:54'),(122,'Somnath','somnathtodmal17@gmail.com','2de29bf005022948b50c91fc6927d56e','8698720310','Passport Size.jpg','consultant',0,'inactive','inactive','inactive','2022-01-19 20:43:42'),(123,'feff','cwmk2kd@fmef.com','d8578edf8458ce06fbc5bb76a58c5ca4','8238872884','temp.jpg','customer',0,'inactive','inactive','inactive','2022-01-20 06:38:58'),(124,'djq','abc@g.com','d8578edf8458ce06fbc5bb76a58c5ca4','7777777777','temp.jpg','customer',0,'inactive','inactive','inactive','2022-01-20 06:40:20'),(125,'Koravakutti Pruduvi','prudhvicherry082@gmail.com','1f49ea40b689efd15ca2b751ea524286','9110359617','prudhvi.jpg','customer',0,'inactive','inactive','inactive','2022-01-20 15:37:42'),(126,'Anwesha','panigrahianwesha2@gmail.com','7c6197c698b6a77abb6d808b29de3cfa','8144743349','IMG_20220106_192506_467.jpg','customer',0,'inactive','inactive','inactive','2022-01-20 17:21:15'),(127,'K Snehashree','ksnehashree1998@gmail.com','c16e0c932d5c8a13f59f05b3c7cb6830','7978079961','IMG_20211104_185902.jpg','customer',0,'inactive','inactive','inactive','2022-01-20 20:06:57'),(128,'Madhav Vermani','madhav.vermani@gmail.com','f348f50d048149b4ef944dd0682ae313','9463648559','IMG_0856 (1).jpg','customer',0,'inactive','inactive','inactive','2022-01-20 20:28:21'),(129,'Megha','megnamegna623@gmail.com','489877ec5b7a26bcc731272882ab08e4','9353243722','IMG_20210916_193518_11zon.jpg','customer',0,'inactive','inactive','inactive','2022-01-21 02:06:59'),(130,'Jui walimbe','walimbejui@gmail.com','b0ba8ff8f9af7ee8af78785929fa9686','9595406338','photo.jpg','customer',0,'inactive','inactive','inactive','2022-01-21 03:04:19'),(131,'shaik sharuk','sharuk2016@gmail.com','73eadf6fb46a9770bc5019e99c5be539','9908040203','IMG-20201016-WA0004.jpg','customer',0,'inactive','inactive','inactive','2022-01-21 05:38:14'),(132,'Rupam','therupss1709@gmail.com','703400f84cc6ff6a003ff98e80672002','9766071709','myself.jpg','customer',0,'inactive','inactive','inactive','2022-01-21 05:44:56'),(133,'vrushali','vrushalimali165@gmail.com','e10adc3949ba59abbe56e057f20f883e','9075470346','vrushali img.jpg','customer',0,'inactive','inactive','inactive','2022-01-21 06:44:44'),(134,'Mandakini Holambe','holambemanvi@gmail.com','b4e09e59c33761637581fd900a2a567a','8390592320','1641636912528-01.jpeg','customer',0,'inactive','inactive','inactive','2022-01-21 07:32:09'),(135,'Rohit G','rohitsmart1397@gmail.com','c58d3e9e7377b02c8c9998121ccc23dd','9361884561','IMG_20220114_075100.jpg','customer',0,'inactive','inactive','inactive','2022-01-21 07:33:19'),(136,'pavan','pavan@gmail.com','e10adc3949ba59abbe56e057f20f883e','9988776655','download (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-21 17:03:22'),(137,'pavan','pavan123@gmail.com','e10adc3949ba59abbe56e057f20f883e','9988776655','download (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-21 17:03:39'),(138,'pavan','pavan1234@gmail.com','e10adc3949ba59abbe56e057f20f883e','9988776655','download (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-21 17:03:59'),(139,'pavan','pavan890@gmail.com','e10adc3949ba59abbe56e057f20f883e','9988776655','download (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-21 17:04:19'),(140,'pavan','pawan890@gmail.com','e10adc3949ba59abbe56e057f20f883e','9988776655','download (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-21 17:05:27'),(141,'pavan','pawan110@gmail.com','e10adc3949ba59abbe56e057f20f883e','9988776655','download (2).jpg','consultant',0,'inactive','inactive','inactive','2022-01-21 17:05:51'),(142,'Sumithra','sumithradegala612@gmail.com','5542e2be971c3ebea19d20a9482d1a88','9963043027','file.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 03:00:36'),(143,'Mohammed imthiyas','imthiyasm549@gmail.com','01fa9fdd2d7f52ca800cc6a95b75d6af','8903893617','IMG-20210820-WA0008.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 04:57:35'),(144,'Komal Hiwale','komalhiwale1267@gmail.com','dda2865a243bef529355f72d49a527d3','7350192203','IMG_20200928_110921624~2_5~2.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 07:05:15'),(145,'Bhagyashri Patil','bhagyashrippatil925@gmail.com','e9a8e8154d7d66a9332dfebf8c4c4fb6','9373553457','IMG_20220121_114912.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 07:07:18'),(146,'Shilpashree S','shilpashreeeshilpa01@gmail.com','db4bbb687bbfedd95c9ce14f5ba8a995','9113916447','IMG-20211124-WA0000.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 08:10:07'),(147,'Vishakha','vishakhapatil350@gmail.com','e7ea6be45d92501649db79a0a66f7217','9579775298','IMG-20210719-WA0044.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 08:32:29'),(148,'Roshan','roshansadafale@gmail.com','865705f3d16ae6a06e4c8d9a8c473258','9421757890','IMG20191001155026.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 10:22:57'),(149,'Rupali','rupalimahalle121@gmail.com','8ad62f8bdef2ba3ebcfc3158cf06c529','7620287846','IMG20191001155026.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 10:26:16'),(150,'Rupali','rupalimahalle121@gamil.com','8ad62f8bdef2ba3ebcfc3158cf06c529','7620287846','IMG20191210190810.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 11:04:22'),(151,'Vaishali','vaishalisharma3468@gmail.com','09866ff76e5a5194f118bb77dc514845','7015702598','20211101_154424.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 11:58:06'),(152,'ddd','dsf@ham.ccnc','96e79218965eb72c92a549dd5a330112','9011111112','img6.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 12:56:28'),(153,'Preethi Shetty DB','preethishetty0514@gmail.com','c0a752ce365cf58e189be96aeccf1851','9448470151','Photo.jpeg','customer',0,'inactive','inactive','inactive','2022-01-26 13:01:47'),(154,'abc','abcd@gmail.com','96e79218965eb72c92a549dd5a330112','9090908901','img4.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 13:11:31'),(155,'aaaaaaaaaa aaaa aaaa','qqqq@gmail.com','343b1c4a3ea721b2d640fc8700db0f36','9834484870','img4.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 13:13:28'),(156,'avc','avc@gmail.com','670b14728ad9902aecba32e22fa4f6bd','9834484800','An-overview-of-wireless-network-virtualization.png','customer',0,'inactive','inactive','inactive','2022-01-26 14:09:06'),(157,'Jay Tiwaskar','jtiwaskar@gmail.com','cd2e5239aa2ec4bba574bba4dbe6543c','8983242574','PicsArt_07-04-09.11.57 (1).jpg','customer',0,'inactive','inactive','inactive','2022-01-26 14:34:22'),(158,'JenniferS','jenniferjaddu143@gmail.com','4ec162b842343137fd353bf8d9636d94','9113611321','IMG_20220114_201950.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 14:41:39'),(159,'Mithilesh Kharvi','mithukharvi8277@gmail.com','086a31c328768e68ac4191fecf520973','8792028220','SAVE_20220123_091914.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 14:47:18'),(160,'Abc','abc190@gmail.com','200820e3227815ed1756a6b531e7e0d2','7080901020','Test.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 14:51:40'),(161,'Sachin Bharat Algule','sachinalgule687@gmail.com','46fc7657ceb875768ef0d416b13fdc39','8411829301','1642927514156.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 15:43:21'),(162,'Sachin Bharat Algule','sachinalgule358@gmail.com','46fc7657ceb875768ef0d416b13fdc39','8411829301','1642927514156.jpg','customer',0,'inactive','inactive','inactive','2022-01-26 15:47:23'),(163,'Preethi Shetty DB','preethi2017075@staloysius.ac.in','c0a752ce365cf58e189be96aeccf1851','9448470151','Photo.jpeg','customer',0,'inactive','inactive','inactive','2022-01-26 15:54:15'),(164,'Vikas Tiwari','2020aspire39@gmail.com','26b51c849e1c36fd42868179a8bcad7a','7696387507','200kb pic.jpg','customer',0,'inactive','inactive','inactive','2022-01-27 12:02:19'),(165,'August Kumar Roy','7445august@gmail.com','9d64e910971918e63e25d27f88d8d869','9430476827','2020 Recently Photo copy.jpg_Aug.jpg','customer',0,'inactive','inactive','inactive','2022-01-28 11:40:52'),(166,'Shubham Jena','shubhamjena2090@gmail.com','d01f5dcd50835a2233696855b1792537','9658230354','IMG_20220116_162425.jpg','customer',0,'inactive','inactive','inactive','2022-01-29 06:30:36'),(167,'Raman Kumar','ramanpri702@gmail.com','2106b588dea58d358a1607eb3277e73c','7061321191','IMG_20210804_141125.jpg','customer',0,'inactive','inactive','inactive','2022-01-29 10:29:34'),(168,'Shubham Metkar','shubhammetkar2000@gmail.com','f91e15dbec69fc40f81f0876e7009648','8600880085','IMG_20211123_162325-removebg-preview.jpg','customer',0,'inactive','inactive','inactive','2022-01-29 15:58:48'),(169,'JUDE ANTONY','jude.ash.antony@gmail.com','e10adc3949ba59abbe56e057f20f883e','9008438156','24842.jpg','customer',0,'inactive','inactive','inactive','2022-01-29 16:35:41'),(170,'Vishwesh','vishweshnaik62@gmail.com','95d47be0d380a7cd3bb5bbe78e8bed49','8431639251','IMG_20201007_160153.jpg','customer',0,'inactive','inactive','inactive','2022-01-29 16:41:57'),(171,'kodathala Sravani','k9sravani@gmail.com','ee6fc22e19d1a018b0dba33165271651','9963178368','1637940860089_1637940859407_1637940859076_1637940858484_1637940856084_1637940824451_1634015509895.jpg','customer',0,'inactive','inactive','inactive','2022-01-30 02:19:06'),(172,'RANGULA SATHVIKA','sathvikarangula5@gmail.com','7ebc440b244d87648a26df4560862874','9490156411','Square Fit_20211123233022400.jpg','customer',0,'inactive','inactive','inactive','2022-01-30 05:34:56'),(173,'SHAMSUDDEEN','shamsushaaz121@gmail.com','c480cac4147dc08f0f6f96e8e2b8c91b','9995530058','IMG-20211221-WA0005-01.jpeg','customer',0,'inactive','inactive','inactive','2022-01-30 06:12:42'),(174,'ashish kumar','ashishtejyan5462@gmail.com','e71b014ee5194c95ce724c2c13b6b3cc','8433234199','b8c7960a-4aad-4bf9-86de-ace05fd11c23.jpg','customer',0,'inactive','inactive','inactive','2022-01-31 12:14:33'),(175,'MAITHRI L','maithrilgowda15@gmail.com','8c8382cf4bfa46d12bae18d0e1c1c359','9113500910','maithri.jpg','customer',0,'inactive','inactive','inactive','2022-02-01 02:18:21'),(176,'Meghana N','manjunnath3@gmail.com','61c9c103a8935ef5d85f5d3bc22f317c','9036660481','20190104_174719.jpg','customer',0,'inactive','inactive','inactive','2022-02-01 17:27:11'),(177,'Manogneta K','manognetakk99@gmail.com','ec75c81e00e06fbb1c99e8ab5e7637bb','9148608489','3C3758E0-EE53-4DF8-8B5A-4C286B39B062.jpeg','customer',0,'inactive','inactive','inactive','2022-02-02 18:03:51'),(178,'Mayank Singh','mayanksingh092000@gmail.com','baae685b0f8f708fdd1e9f934dae17cc','7897209410','pic.jpg','customer',0,'inactive','inactive','inactive','2022-02-02 18:11:39'),(179,'Raman kumar','saxenaraman664@gmail.com','c92c1f27e91c39667bc35bffe94eee30','7566020226','WhatsApp Image 2021-07-26 at 12.30.16 PM.jpeg','customer',0,'inactive','inactive','inactive','2022-02-02 18:24:43'),(180,'Nimith Y','nimih003@gmail.com','edc6f6be38e2b6698fbd5c2ef496fe13','9741635261','2017064.JPG','customer',0,'inactive','inactive','inactive','2022-02-02 18:26:38'),(181,'Nimith Y','nimithyoga@gmail.com','fcea920f7412b5da7be0cf42b8c93759','9741635261','2017064.JPG','customer',0,'inactive','inactive','inactive','2022-02-02 18:29:53'),(182,'Salovar Kasim Shaikh','salovarshaikh@gmail.com','903645e7a390302ce7e09f55f3935b37','9284144884','IMG_20171114_083646.jpg','customer',0,'inactive','inactive','inactive','2022-02-03 02:24:47'),(183,'khe','12@gmail.com','25f9e794323b453885f5181f1b624d0b','9839798334','t4.png','customer',0,'inactive','inactive','inactive','2022-02-04 07:25:54'),(184,'BATTU SHALOM RAJU','shalom.bnri777@gmail.com','b36b2fe76b6f539acff4212c6c8eb0c3','8985604484','d8ck577-6a99d0bf-cb7f-4d6f-9633-60231739555a.png','customer',0,'inactive','inactive','inactive','2022-02-05 06:46:05'),(185,'Patil Mankarnika','patilmankarnika10@gmail.com','5d61a84db0f9fa969fc74255cecf8925','9322612496','IMG-20200705-WA0126.jpg','customer',0,'inactive','inactive','inactive','2022-02-06 02:39:34'),(186,'Bhavyashree','bhavyapsuvarna@gmail.com','6eaa8fa04a44cffd0f3a37622898f78e','7760295038','bhavyapicss.jpg','customer',0,'inactive','inactive','inactive','2022-02-06 04:44:04'),(187,'Greeshma .','greeshmasaliank@gmail.com','1c54bd6fadb47267105644935514712c','9019738758','bir.PNG','customer',0,'inactive','inactive','inactive','2022-02-06 07:11:28'),(188,'Bhavyashree','bhavya99ps@gmail.com','468e2afcf201cf1e0ed1653ed11d23ab','9945032874','IMG-20220206-WA0017.jpeg','customer',0,'inactive','inactive','inactive','2022-02-06 07:24:11'),(189,'Bhavya','bhavyapsuvarnass@gmail.com','440ac85892ca43ad26d44c7ad9d47d3e','9945032874','1.jpg','consultant',0,'inactive','inactive','inactive','2022-02-06 07:37:49'),(190,'Bhavya','appus@gmail.com','440ac85892ca43ad26d44c7ad9d47d3e','9945032874','1.jpg','consultant',0,'inactive','inactive','inactive','2022-02-06 07:38:08'),(191,'ashi','bhavya@gmail.com','189342e2ed9d23bb9a02ecbf8ed06762','8989891234','1.jpg','customer',0,'inactive','inactive','inactive','2022-02-06 07:39:52'),(192,'Deekshashetty D N','deekshashettydeek@gmail.com','b33db08282095eab9017463c55308ea4','8904188002','download.png','customer',0,'inactive','inactive','inactive','2022-02-06 07:51:52'),(193,'Greee','gree@gma.com','e10adc3949ba59abbe56e057f20f883e','8372861202','26232698.jpg','customer',0,'inactive','inactive','inactive','2022-02-06 12:11:26'),(194,'pooja shet','poojashet310@gmail.com','545886c05bfb07ec20fc27c86072efd9','8884522408','WhatsApp Image 2022-02-04 at 9.29.41 PM.jpeg','customer',0,'inactive','inactive','inactive','2022-02-06 13:24:44'),(195,'Keerthan L B','keerthanllb@gmail.com','d87008d773217eef3065b4c6616a73da','8971892949','icon-g0c65a7aa8_1920.png','customer',0,'inactive','inactive','inactive','2022-02-06 14:16:21'),(196,'Ashwath','ashwathkulal04@gmail.com','e10adc3949ba59abbe56e057f20f883e','9902390243','Screenshot (22).png','customer',0,'inactive','inactive','inactive','2022-02-06 16:26:44'),(197,'Sandur Aruna','sandhur2017085@staloysius.ac.in','a743c26f0bd538051d612a6dd5909f19','8746830391','Aruna.jpg','customer',0,'inactive','inactive','inactive','2022-02-06 16:29:42'),(198,'Dhanraj','abcddvv@gmail.com','25d55ad283aa400af464c76d713c07ad','7777777777','16441918375156945202747337664193.jpg','customer',0,'inactive','inactive','inactive','2022-02-06 23:59:49'),(199,'Komal Shimpi','komalshimpi91198@gmail.comhhhh','68673662afe234e2598220915639c3e2','9689690336','s1.png','customer',0,'inactive','inactive','inactive','2022-02-07 14:56:14'),(200,'Mayuri Joshi','mayiijoshi30493@gmail.com','27f07e6acdf983035487b8465cc7a58b','8989508552','PHOTO.jpg','customer',0,'inactive','inactive','inactive','2022-02-10 10:26:29'),(201,'varun','varunmanila@gmail.com','e86fdc2283aff4717103f2d44d0610f7','8951698546','home.png','customer',0,'active','inactive','inactive','2022-02-23 05:16:03'),(202,'Sachin Mohite','sachin.mohite@spacece.co',NULL,'+919372744039',NULL,'customer',0,'active','inactive','inactive','2022-02-26 06:17:38'),(207,'Sachin Mohite','me@sachinmohite.com','15285722f9def45c091725aee9c387cb','9372744039','SpacECE Logo - Smaller.jpeg','customer',0,'inactive','inactive','inactive','2022-03-29 17:52:21'),(208,'Harshul','20103170@mail.jii.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9755044884','pexels-photo-2026960.jpeg','customer',0,'inactive',NULL,'inactive','2024-04-16 10:56:44'),(209,'Aditi Niphade','aaditiniphade@gmail.com','decd81cbcdf61ad1d240d980bfc64286','8975176634','pixlr-image-generator-3122f302-5900-4c23-a51c-10d5dd282102.png','customer',0,'inactive',NULL,'inactive','2024-04-16 11:05:59'),(210,'Harshul','20103170@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9211887711','walker.jpg','customer',0,'inactive',NULL,'inactive','2024-04-24 10:52:49'),(211,'Akshat Jain','20103160@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9100112224','pexels-photo-2026960.jpeg','consultant',0,'inactive',NULL,'inactive','2024-04-24 11:02:45'),(212,'Akshat Jain','akshat@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9100112224','pexels-photo-2026960.jpeg','consultant',0,'inactive',NULL,'inactive','2024-04-24 11:03:45'),(213,'Dummy','dummy@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9811331117','pexels-photo-2026960.jpeg','consultant',0,'inactive',NULL,'inactive','2024-04-24 16:59:04'),(214,'Dummy V','dummy1@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9811331117','pexels-photo-2026960.jpeg','consultant',0,'inactive',NULL,'inactive','2024-04-24 17:01:44'),(215,'Sachin','sachin@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9201077994','pexels-photo-2026960.jpeg','customer',0,'inactive',NULL,'inactive','2024-04-28 04:55:26'),(216,'abcd','123vasishthk.atre@gm.ail.com','4297f44b13955235245b2497399d7a93','9546546541','images.jpg','customer',0,'inactive',NULL,'inactive','2024-04-28 17:43:04'),(217,'Qadirul hasan qa','qadirul.hasan14355@gmail.com','2e93783eb0c43904471bf435bc792193','7618831881','WIN_20240503_10_30_27_Pro.jpg','customer',0,'inactive',NULL,'inactive','2024-05-03 17:30:42'),(218,'abc','abcde@gmail.com','b9a3f7140300936d253563e47ca73729','7447553906','user-icon-2048x2048-ihoxz4vq.png','book_owner',0,'inactive',NULL,'inactive','2024-05-11 16:42:16'),(219,'timepass','time@timepass.com','e807f1fcf82d132f9bb018ca6738a19f','8101811772','pexels-photo-2026960.jpeg','customer',0,'inactive',NULL,'inactive','2024-05-18 07:57:44'),(220,'sdsDSA','temp@teendn.com','e807f1fcf82d132f9bb018ca6738a19f','9892809280','pexels-photo-2026960.jpeg','customer',0,'inactive',NULL,'inactive','2024-05-18 09:40:23'),(221,'Harshul','20103190@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9255441133','paul-walker.jpg','customer',0,'inactive',NULL,'inactive','2024-05-18 12:38:43'),(222,'Akshat','20103150@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9861416576','paul-walker.jpg','customer',0,'inactive',NULL,'inactive','2024-05-18 12:45:07'),(223,'Akshat','20103100@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9811232323','paul-walker.jpg','customer',0,'inactive',NULL,'inactive','2024-05-18 13:23:49'),(224,'Chadnu','20103101@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9123456789','walker.jpg','customer',0,'inactive',NULL,'inactive','2024-05-24 13:25:02'),(225,'Pranjal Agrawal','pranjal@gmil.com','e807f1fcf82d132f9bb018ca6738a19f','6423234567','pexels-photo-2026960.jpeg','customer',0,'inactive',NULL,'inactive','2024-05-24 16:20:44'),(226,'Pranjal Agarwal','apranjal816@gmail.com','e10adc3949ba59abbe56e057f20f883e','9305695488','5e27f638a8790216cdf8874d_1579677240773.jpg','customer',0,'inactive',NULL,'inactive','2024-05-25 11:42:29'),(227,'Sujal Raunak','sujalraunak452@gmail.com','25d55ad283aa400af464c76d713c07ad','9797322179','pexels-quang-nguyen-vinh-222549-2166711.jpg','customer',0,'inactive',NULL,'inactive','2024-05-25 15:41:41'),(228,'Consultant Test','consuntanttest@gmail.com','4297f44b13955235245b2497399d7a93','6587974566','images.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-27 11:15:10'),(229,'Consultant Test','consuntanttest1@gmail.com','4297f44b13955235245b2497399d7a93','6587974566','images.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-27 11:15:37'),(230,'Vasishth Katre','vasishthkatre11@gmail.com','4297f44b13955235245b2497399d7a93','6897898745','images.jpg','admin',0,'inactive',NULL,'inactive','2024-05-27 11:40:55'),(231,'Vasishth Katre','vasishthkatre@yahoo.com','4297f44b13955235245b2497399d7a93','6546547892','images.jpg','book_owner',0,'inactive',NULL,'inactive','2024-05-27 11:46:19'),(232,'Delivery Boy','deliveryboy@gmail.com','4297f44b13955235245b2497399d7a93','6546546547','images.jpg','delivery_boy',0,'inactive',NULL,'inactive','2024-05-27 11:53:37'),(233,'Sachith Kiran','sachith.kiran0@gmail.com','0e1df8dd5094d3c01fddd2164e6eae62','9035656712','95646583.webp','customer',0,'inactive',NULL,'inactive','2024-05-27 16:01:12'),(234,'Aniket','aniket@gmail.com','22d912d8004b31868870c2c88c047464','8999080707','EGR MODULE MOUNTING BRACKET.jpg','customer',0,'inactive',NULL,'inactive','2024-05-29 19:12:21'),(235,'Admin','admin@gmail.com','e10adc3949ba59abbe56e057f20f883e','6234567890','images.jpg','admin',0,'inactive',NULL,'inactive','2024-05-30 17:30:33'),(236,'Aniket','aniket1@gmail.com','22d912d8004b31868870c2c88c047464','1234567891','Aniket.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-31 09:39:24'),(237,'mudit','mudit@gmail.com','900150983cd24fb0d6963f7d28e17f72','123456789','mudit.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 10:56:20'),(238,'mudit','mudit12@gmail.com','900150983cd24fb0d6963f7d28e17f72','123456789','mudit.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 10:57:34'),(239,'Ashish','ashish@gmail.com','7b69ad8a8999d4ca7c42b8a729fb0ffd','9999999999','Ashish.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 11:07:21'),(240,'Aniket','ani@gmail.com','22d912d8004b31868870c2c88c047464','1234567891','Aniket.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 11:42:22'),(241,'Aniket','a@gmail.com','22d912d8004b31868870c2c88c047464','1234567891','Aniket.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 11:43:49'),(242,'Aniket','aa@gmail.com','22d912d8004b31868870c2c88c047464','1234567891','Aniket.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 13:48:14'),(243,'ANI','anii@gmail.com','22d912d8004b31868870c2c88c047464','1234567891','ANI.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-31 13:51:16'),(244,'Ashish111','ashish72@gmail.com','7b69ad8a8999d4ca7c42b8a729fb0ffd','1234567890','Ashish111.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 14:46:58'),(245,'Testing','testing@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9123456789','walker.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-31 16:54:17'),(246,'Testing','qwertyuiop@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9123456789','walker.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-31 16:59:41'),(247,'aniket','ai@gmail.com','22d912d8004b31868870c2c88c047464','1234567890','aniket.jpg','customer',0,'inactive',NULL,'inactive','2024-05-31 17:04:41'),(248,'Mudit','muditconsult@gmail.com','900150983cd24fb0d6963f7d28e17f72','n\n748992','Mudit.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-31 20:08:45'),(249,'jd','ndjdj@gmail.com','900150983cd24fb0d6963f7d28e17f72','7383','jd.jpg','consultant',0,'inactive',NULL,'inactive','2024-05-31 20:10:11'),(250,'ashish','ashish78@gmail.com','2a9e8506516a729a0eea806472d9e3dd','1234567890','ashish.jpg','customer',0,'inactive',NULL,'inactive','2024-06-02 16:14:11'),(251,'ashish','ashish90@gmail.com','7b69ad8a8999d4ca7c42b8a729fb0ffd','9097873563','ashish.jpg','customer',0,'inactive',NULL,'inactive','2024-06-02 16:17:36'),(252,'aniket','anikett@gmail.com','22d912d8004b31868870c2c88c047464','8999080707','','consultant',0,'inactive',NULL,'inactive','2024-06-03 06:30:05'),(253,'aniket','anike4t@gmail.com','22d912d8004b31868870c2c88c047464','8999080707','','consultant',0,'inactive',NULL,'inactive','2024-06-03 06:30:32'),(254,'hx','mudit292005@gmail.com','900150983cd24fb0d6963f7d28e17f72','47','hx.jpg','customer',0,'inactive',NULL,'inactive','2024-06-03 20:06:50'),(255,'aniket','anike4tt@gmail.com','22d912d8004b31868870c2c88c047464','8999080707','','consultant',0,'inactive',NULL,'inactive','2024-06-04 10:15:38'),(256,'alvin','josealvin702@gmail.com','41d453ea7dd9362822b65573af5208ea','9172155896','Screenshot 2024-06-04 202128.jpg','customer',0,'inactive',NULL,'inactive','2024-06-04 14:52:37'),(257,'ashish','22ashish@gmail.com','539cf5dedd715714bd08850f12f89aad','9098348836','ashish .jpg','customer',0,'inactive',NULL,'inactive','2024-06-04 17:32:59'),(258,'ashish','33ashish@gmail.com','ca992ae0477b1543b4afae0d4c6db899','277383832','ashish.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-04 17:34:32'),(259,'ashish','4ashish@gmail.com','d3c2631289cfbc1e430c0b52c2f170f3','12687378','ashish.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-05 03:15:53'),(260,'Aniket','anike@gmail.com','22d912d8004b31868870c2c88c047464','1234567891','Aniket.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-05 03:22:12'),(261,'aniket','anike5tt@gmail.com','22d912d8004b31868870c2c88c047464','8999080707','','consultant',0,'inactive',NULL,'inactive','2024-06-05 03:23:39'),(262,'ashish','ashish1@gmail.com','137399abd34fa30e9eec25a3602ce4bf','67890','ashish .jpg','customer',0,'inactive',NULL,'inactive','2024-06-06 10:04:51'),(263,'ashish','ashishcon@gmail.com','81482bdb592e0986e51e2ecab8360144','38383838','ashish.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-06 14:15:27'),(264,'Shivam','shibbu@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7878787888','Shivam.jpg','customer',0,'inactive',NULL,'inactive','2024-06-06 14:18:06'),(265,'hello','bhalu@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7878787878','hello.jpg','customer',0,'inactive',NULL,'inactive','2024-06-06 14:19:46'),(266,'ashish222','ashish222@gmail.com','8e23e4fe379c00324e979def75c52fa3','222222','ashish222.jpg','customer',0,'inactive',NULL,'inactive','2024-06-06 14:20:22'),(267,'hero','hathi@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7878787878','hero.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-06 14:21:47'),(268,'ashish','con@gmail.com','7ed201fa20d25d22b291dc85ae9e5ced','8927373','ashish.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-06 14:23:14'),(269,'chidiya','chidiya@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7878787878','chidiya.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-06 14:23:26'),(270,'sbi am','vzbhd@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','gshhd','sbi am.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-06 14:24:46'),(271,'Harshul','2010310@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9212345678','walker.jpg','customer',0,'inactive',NULL,'inactive','2024-06-06 16:22:52'),(272,'asdj','copy@gmail.com','12cba3ee81cf4a793796a51b6327c678','9089686568','asdj.jpg','customer',0,'inactive',NULL,'inactive','2024-06-06 16:34:53'),(273,'user','user@gmail.com','ee11cbb19052e40b07aac0ca060c23ee','0987654321','Screenshot (1).png','customer',0,'inactive',NULL,'inactive','2024-06-06 18:01:31'),(274,'shivam singh','mehugian221@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 08:47:17'),(275,'shivam singh','mehugian23221@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 08:48:37'),(276,'shivam singh','mehugian223221@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 08:49:00'),(277,'shivam singh','mehugian2253221@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 08:54:54'),(278,'shivam singh','mehugian22543221@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 08:55:34'),(279,'shivam singh','mehugian225543221@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:07:27'),(280,'shivam singh','mehugian22554312251@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:08:09'),(281,'shivam singh','mehugian2255431225441@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:12:15'),(282,'shivam singh','mehugian22554531225441@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:14:43'),(283,'shivam singh','bhoot@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:28:10'),(284,'shivam singh','bhoo55t@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:32:06'),(285,'shivam singh','bhoo555t@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:36:18'),(286,'shivam singh','bhoo5n55t@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621',NULL,'consultant',0,'inactive',NULL,'inactive','2024-06-07 09:36:32'),(287,'shivam singh','bhoo5n455t@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:36:55'),(288,'shivam singh','shivamsingh57680@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:38:06'),(289,'shivam singh','example@example.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:39:42'),(290,'shivam singh','hi@example.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:57:42'),(291,'shivam singh','ygyfe@example.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 09:58:10'),(292,'shivam singh','hello@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 10:03:51'),(293,'shivam singh','hello5@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 10:04:57'),(294,'shivam singh','hello25@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 10:08:32'),(295,'shivam singh','hello255@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','customer',0,'inactive',NULL,'inactive','2024-06-07 10:09:01'),(296,'shivam singh','hello2555@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','customer',0,'inactive',NULL,'inactive','2024-06-07 10:09:20'),(297,'shivam singh','hello52555@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','customer',0,'inactive',NULL,'inactive','2024-06-07 10:10:36'),(298,'shivam singh','hello525555@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 10:11:09'),(299,'shivam singh','hello5285555@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-07 10:11:32'),(300,'Shivam','shivamsingh@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7049579435','2.png','customer',0,'inactive',NULL,'inactive','2024-06-07 11:14:45'),(301,'Rohit Kumar','rohitku12@gmail.com','77798037e7c8f5f5bd7b6ee2d341d79d','9798328412','Rohit Kumar.jpg','customer',0,'inactive',NULL,'inactive','2024-06-07 15:44:41'),(302,'Rohit Kumar','rohitku123@gmail.com','24780214eac5297e08da75a44c5f0480','9798328412','Rohit Kumar.jpg','customer',0,'inactive',NULL,'inactive','2024-06-07 15:54:00'),(303,'Rohit Kumar','rohitku1234@gmail.com','24780214eac5297e08da75a44c5f0480','9798328412','Rohit Kumar.jpg','customer',0,'inactive',NULL,'inactive','2024-06-07 16:02:12'),(304,'Atharva','atharva@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9123456782','Screenshot (1).png','customer',0,'inactive',NULL,'inactive','2024-06-07 16:05:39'),(305,'Test','asdfghjkl@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9123456783','pexels-photo-2026960.jpeg','customer',0,'inactive',NULL,'inactive','2024-06-07 16:21:56'),(306,'Bhardwaj','bhardwaj@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','78786867677','Bhardwaj .jpg','consultant',0,'inactive',NULL,'inactive','2024-06-07 19:17:37'),(307,'Hola','hola@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7878787868','Hola.jpg','customer',0,'inactive',NULL,'inactive','2024-06-07 19:19:14'),(308,'Dummy','dummy@mail.jiit.ac.in','e807f1fcf82d132f9bb018ca6738a19f','9353446546','Screenshot.png','customer',0,'inactive',NULL,'inactive','2024-06-08 06:34:04'),(309,'hmm@gmail.com','hmm@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','78787879797','hmm@gmail.com.jpg','customer',0,'inactive',NULL,'inactive','2024-06-08 14:55:12'),(311,'hmm','hmmm@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','78787979796','hmm.jpg','customer',0,'inactive',NULL,'inactive','2024-06-08 14:56:13'),(312,'khushi','khushihura123@gmail.com','e2fc714c4727ee9395f324cd2e7f331f','6268362135','khushi.jpg','customer',0,'inactive',NULL,'inactive','2024-06-08 17:17:34'),(313,'shivam singh','kiko12@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 17:25:12'),(314,'shivam singh','kiko123@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 17:25:36'),(315,'shivam singh','kiko1234@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 17:31:31'),(316,'shivam singh','kiko12345@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 17:32:27'),(317,'shivam singh','kiko5515285553415@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 17:42:25'),(318,'shivam singh','kiko55152855535415@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 17:53:39'),(319,'shivam singh','kiko5515552855535415@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:03:36'),(320,'shivam singh','hui@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:07:31'),(321,'shivam singh','hui1@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:13:09'),(322,'shivam singh','hui12@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','customer',0,'inactive',NULL,'inactive','2024-06-08 18:26:25'),(323,'ashish','consultant@gmail.com','7adfa4f2ba9323e6c1e024de375434b0','929384939','ashish.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:37:23'),(330,'hali','hali@gmail.com','e10adc3949ba59abbe56e057f20f883e','8996653861','hali.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:37:24'),(331,'Ashish sahu','consult@gmail.com','107f3400ca80abfe4d2a127622908d53','9098348836','Ashish sahu.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:43:00'),(332,'Ashish Sahu','ConsultUs@gmail.com','0dc4864564ad8c5dd8d0cdd9714f5711','9098348836','Ashish Sahu .jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:46:35'),(333,'computer','consultants@gmail.com','c6fbb5ca6219111731f9c4c4d2675810','93948548','computer.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:52:12'),(344,'shubham','consultsection@gmail.com','478b25100e30be89d9e130f8502f5dfa','e8384i','shubham.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:52:14'),(345,'ashish','usbrous@gmail.com','da9a9fdc92aa6c37b6b20d8ae6a9ff18','9087373','ashish.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 18:55:13'),(346,'ashish','sahu@gmail.com','1854b136ed3141c5dba201fc44a0f849','92848448','ashish.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 19:10:51'),(347,'user','abcdef@gmail.com','e80b5017098950fc58aad83c8c14978e','iw2883','user .jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 19:21:12'),(348,'api','asdf@gmail.com','912ec803b2ce49e4a541068d495ab570','jsiejf','api.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 19:23:25'),(349,'hsjsjd','dudu@gmail.com','b247deafa97a5122eef246b489074c5d','whjsjs','hsjsjd.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 19:28:22'),(350,'russia','russia@gmail.com','1c625cc86f824660a320d185916e3c55','828448','russia.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-08 19:35:43'),(351,'mEe','mee@gmail.com','e10adc3949ba59abbe56e057f20f883e','7845124578','mits-logo.png','customer',0,'inactive',NULL,'inactive','2024-06-08 19:53:32'),(352,'mEe','meee@gmail.com','e10adc3949ba59abbe56e057f20f883e','7845126552','mits-logo.png','consultant',0,'inactive',NULL,'inactive','2024-06-08 19:55:20'),(353,'cs','cs@gmail.com','95cc64dd2825f9df13ec4ad683ecf339','70589','cs.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-09 06:02:20'),(356,'Dr. Aniket','draniket@gmail.com','22d912d8004b31868870c2c88c047464','8999080707','Dr. Aniket.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 07:51:53'),(357,'Dr. Vikas Patil','vikas@gmail.com','22d912d8004b31868870c2c88c047464','7741023581','Dr. Vikas Patil.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 07:55:01'),(358,'Dr. Nikam','nikam@gmail.com','22d912d8004b31868870c2c88c047464','6246823488','Dr. Nikam.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 08:21:36'),(359,'Dr. Vijay','vijay@gmail.com','22d912d8004b31868870c2c88c047464','96534788512','Dr. Vijay.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 08:29:28'),(360,'Dr. Vijay','vijay1@gmail.com','22d912d8004b31868870c2c88c047464','96534788512','Dr. Vijay.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 08:29:50'),(361,'Dr. Meenal','meenal@gmail.com','22d912d8004b31868870c2c88c047464','8965347828','Dr. Meenal.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 08:33:49'),(362,'shivam singh','hui152@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845129621','esitting.png','consultant',0,'inactive',NULL,'inactive','2024-06-11 09:40:28'),(363,'Dr. Kumar','kumar@gmail.com','22d912d8004b31868870c2c88c047464','8963547856','Dr. Kumar.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 09:42:15'),(364,'Dr. Mahesh','mahesh@gmail.com','22d912d8004b31868870c2c88c047464','89635478651','Dr. Mahesh.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 09:45:22'),(365,'Dr. M','m@gmail.com','22d912d8004b31868870c2c88c047464','89635785247','Dr. M.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-11 09:47:20'),(366,'Aniket','aniketdr@gmail.com','22d912d8004b31868870c2c88c047464','165289285423','Aniket.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-14 12:04:48'),(367,'rus','consultus@email.com','40fa3aab39112e8d95dd8aea55b33952','9098348836','rus.jpg','consultant',0,'inactive',NULL,'inactive','2024-06-14 15:09:31'),(368,'Kiiiiu Jssjjw','ratujotos@gmail.com','d489a3289ecdc847cb67f7a480e6f9fa','8888888888','mini.php','customer',0,'inactive',NULL,'inactive','2024-06-18 02:02:32'),(369,'Dora','dora@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845125556','2.png','consultant',0,'inactive',NULL,'inactive','2024-06-21 13:03:45'),(370,'Sujal','sujal@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9123456783','pexels-photo-2026960.jpeg','admin',0,'inactive',NULL,'inactive','2024-06-21 15:59:33'),(371,'dstpgij','9436746253@emailcbox.pro','eeb461c69513214d2446eab74cc68445','9096305643','ava.php.jpg','customer',0,'inactive',NULL,'inactive','2024-06-22 12:28:10'),(372,'mudit','23uec577@lnmiit.ac.in','202cb962ac59075b964b07152d234b70','9672467580','mudit.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 10:37:43'),(373,'abc','abcdef123@gmail.com','e99a18c428cb38d5f260853678922e03','9876543210','abc.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 13:48:19'),(374,'space','space@gmail.com','b1be2b3ff963fee5a53b324cac9c974a','6515275181','space.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 14:01:38'),(375,'likhita','likhita@gmail.com','a6352645b81787954f6f69c4f62bd999','6283628193','likhita.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 14:06:48'),(376,'alpha','alpha@gmail.com','2c1743a391305fbf367df8e4f069f9f9','6281938168','alpha.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 14:20:01'),(377,'beta','beta@gmail.com','987bcab01b929eb2c07877b224215c92','7281937293','beta.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 14:21:33'),(378,'gama','gama@gmail.com','17a4bd3127e15a0fa8560e643ab54f88','7293819392','gama.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 14:37:42'),(379,'gamma','gamma@gmail.com','05b048d7242cb7b8b57cfa3b1d65ecea','7283628193','gamma.jpg','customer',0,'inactive',NULL,'inactive','2024-06-24 14:43:15'),(380,'Rohit','rohitku321@gmail.com','25d55ad283aa400af464c76d713c07ad','9798328412','Rohit.jpg','customer',0,'inactive',NULL,'inactive','2024-06-25 08:44:12'),(381,'mohit','mohitsinghtadhiyal8@gmail.com','da5496c7148c9bd797b664a78de9b646','79097 82275','mohit.jpg','customer',0,'inactive',NULL,'inactive','2024-06-25 18:49:28'),(382,'Rohit','devildinker@gmail.com','25d55ad283aa400af464c76d713c07ad','9798328412','Rohit.jpg','customer',0,'inactive',NULL,'inactive','2024-06-25 19:20:25'),(383,'Rohit','rohit12345ku@gmail.com','25d55ad283aa400af464c76d713c07ad','9798328412','Rohit.jpg','customer',0,'inactive',NULL,'inactive','2024-06-26 11:40:32'),(384,'test','poiuytrewq@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9253534535','pexels-photo-2026960.jpeg','consultant',0,'inactive',NULL,'inactive','2024-07-01 15:02:20'),(385,'shinchain','shinchain@gamil.com','e807f1fcf82d132f9bb018ca6738a19f','7845124578','IMG-20240522-WA0003.jpg','consultant',0,'inactive',NULL,'inactive','2024-07-01 15:09:19'),(386,'shinchain','shinchain@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','7845124578','IMG-20240522-WA0003.jpg','consultant',0,'inactive',NULL,'inactive','2024-07-01 15:09:22'),(387,'Dr. Anshul Bhargava','dranshulneo@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','9560671092','dh.png','consultant',0,'inactive',NULL,'inactive','2024-07-03 07:49:52'),(388,'Dr.Rujuta Diwekar','mitahar@gmail.com','e807f1fcf82d132f9bb018ca6738a19f','8080824276','mi.png','consultant',0,'inactive',NULL,'inactive','2024-07-03 07:54:36'),(389,'Dr.Ryan Fernando','neil@quahealth.com','e807f1fcf82d132f9bb018ca6738a19f','9256363925','ry.png','consultant',0,'inactive',NULL,'inactive','2024-07-03 07:58:32'),(390,'Dr. Shweta Diwan','therahealth@mail.com','e807f1fcf82d132f9bb018ca6738a19f','7894561230','sw.png','consultant',0,'inactive',NULL,'inactive','2024-07-03 08:04:26'),(391,'Dr Sukhpreet Kaur','info@cloudninecare.com','e807f1fcf82d132f9bb018ca6738a19f','9972899728','jas.png','consultant',0,'inactive',NULL,'inactive','2024-07-03 08:09:48'),(392,'mudit','muditabcd@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','1234567890','mudit.jpg','customer',0,'inactive',NULL,'inactive','2024-07-20 12:54:07');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webhook`
--

DROP TABLE IF EXISTS `webhook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `webhook` (
  `imojo_id` varchar(255) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `u_email` varchar(255) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `date_of_purchase` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_of_activation` timestamp NOT NULL,
  `date_of_expire` timestamp NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`imojo_id`),
  KEY `u_email` (`u_email`),
  KEY `p_name` (`p_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webhook`
--

LOCK TABLES `webhook` WRITE;
/*!40000 ALTER TABLE `webhook` DISABLE KEYS */;
INSERT INTO `webhook` VALUES ('MOJO2226A05D83107365','MOJO2226A05D83107365','sachin.mohite@spacece.co','SpacActive','2022-02-26 06:12:44','2022-02-26 06:12:43','2022-03-26 00:00:00',13.9,'active'),('MOJO2226E05D83107748','MOJO2226E05D83107748','sachin.mohite@spacece.co','SpacActive','2022-02-26 06:21:03','2022-02-26 06:21:03','2022-03-26 00:00:00',13.9,'active'),('MOJO2226H05D83106706','MOJO2226H05D83106706','sachin.mohite@spacece.co','SpacActive','2022-02-26 06:13:09','2022-02-26 06:13:09','2022-03-26 00:00:00',13.9,'active'),('MOJO2226T05D83108807','MOJO2226T05D83108807','sachin.mohite@spacece.co','SpacActive','2022-02-26 06:41:46','2022-02-26 06:41:46','2022-03-26 00:00:00',13.9,'active'),('MOJO2226U05D83105709','MOJO2226U05D83105709','sachin.mohite14@apu.edu.in','SpacActive','2022-02-26 05:53:17','2022-02-26 05:35:52','2022-03-26 00:00:00',13.9,'active');
/*!40000 ALTER TABLE `webhook` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-20 16:04:56
