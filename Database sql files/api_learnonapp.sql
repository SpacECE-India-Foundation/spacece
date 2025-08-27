-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: api_learnonapp
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
-- Table structure for table `learnon_courses`
--

DROP TABLE IF EXISTS `learnon_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnon_courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `mode` enum('Online','Offline') NOT NULL,
  `duration` smallint NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnon_courses`
--

LOCK TABLES `learnon_courses` WRITE;
/*!40000 ALTER TABLE `learnon_courses` DISABLE KEYS */;
INSERT INTO `learnon_courses` VALUES (1,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99),(2,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99),(3,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99),(4,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99),(5,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99),(6,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99),(7,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99),(8,'Lorem ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod eget orci non convallis. Suspendisse fermentum orci libero, a faucibus massa sollicitudin consequat.','Whatsapp','Online',30,49.99);
/*!40000 ALTER TABLE `learnon_courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learnon_messages`
--

DROP TABLE IF EXISTS `learnon_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnon_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_of_day` smallint NOT NULL,
  `time` varchar(100) NOT NULL,
  `header` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnon_messages`
--

LOCK TABLES `learnon_messages` WRITE;
/*!40000 ALTER TABLE `learnon_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `learnon_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learnon_users`
--

DROP TABLE IF EXISTS `learnon_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnon_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `days` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnon_users`
--

LOCK TABLES `learnon_users` WRITE;
/*!40000 ALTER TABLE `learnon_users` DISABLE KEYS */;
INSERT INTO `learnon_users` VALUES (1,'Krishna Thorat','krishna.thorat20@vit.edu','8a6f2805b4515ac12058e79e66539be9','8550969625',0,'2021-10-11 09:16:43'),(5,'Sunil Shahu','sunilshahu07@gmail.com','8a6f2805b4515ac12058e79e66539be9','9730536037',0,'2021-10-12 05:59:44'),(6,'sssss','sssss@gmail.com','2d02e669731cbade6a64b58d602cf2a4','sssss',0,'2021-10-12 07:50:18'),(7,'Shubham Gangurde','shubhamvijaygangurdes2012@gmail.com','7dbfc9764ca694169f1af5e31f2b04a0','9892380935',0,'2021-10-12 09:35:44'),(8,'sssss','sssss@sssss','033c91317f9b6795106a825cf8ef773d','ssssssssss',0,'2021-10-12 09:51:52'),(9,'sssss','ssss@ss','033c91317f9b6795106a825cf8ef773d','sasasasasasasasa',0,'2021-10-12 10:36:18'),(10,'sssss','chotu.sonia@gmail.com','1cef3477dff8074020152072fcc68ed9','9606888725',0,'2021-10-12 11:03:39'),(11,'Ashutosh Soni','Asonibgh@gmail.com','87f5ce84d66c6ca661f614213858b0b4','+447008970861',0,'2021-10-12 16:45:32'),(12,'abcd','abcd123@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','1234567890',0,'2021-10-12 16:51:25'),(13,'Siddhi Vora','siddhivora9@gmail.com','8834f6271bf3eeddc7649489c461b02a','+919409156737',0,'2021-10-13 04:28:25');
/*!40000 ALTER TABLE `learnon_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `learnon_users_courses`
--

DROP TABLE IF EXISTS `learnon_users_courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `learnon_users_courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `cid` int NOT NULL,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `payment_details` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `cid` (`cid`),
  CONSTRAINT `learnon_users_courses_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `learnon_users` (`id`),
  CONSTRAINT `learnon_users_courses_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `learnon_courses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `learnon_users_courses`
--

LOCK TABLES `learnon_users_courses` WRITE;
/*!40000 ALTER TABLE `learnon_users_courses` DISABLE KEYS */;
INSERT INTO `learnon_users_courses` VALUES (2,1,1,0,NULL,'2021-10-11 09:27:00');
/*!40000 ALTER TABLE `learnon_users_courses` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-20 15:45:13
