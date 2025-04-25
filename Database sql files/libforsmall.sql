-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: libforsmall
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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (3,'Rizwan','rizwan@gmail.com','$2y$10$Z1DnKbJRDFUTHMI7y1vSqeU3.Y9cgDyC4AeWx4.ucH34z/mkzL2E.','0'),(4,'ajay','ajay@gmail.com','$2y$10$UGzx/ODNB4ZSFruRF8BN2eC/NNE.6MBhfTTYKtUo.k4ZVHZFD85DO','0'),(5,'Rizwan','rizwankhan@gmail.com','$2y$10$qZ0OoyX8bhAVxDFM/fx8leZSZwlyq15c1C/KTnaqDLSx6eCDJ0VpC','1'),(6,'Faizan','faizan@gmail.com','$2y$10$Ll2.sETLuB8sdhh1LRK4e.cQqn4CtTEudFg.exhf76D6rGzSOwWNm','0'),(12,'kirti Salunkhe','kirtisalunkhe15@gmail.com','$2y$10$4BWUERSUilQmqLzKrZUH2exH20mBY1SL0268rzmM4S1sMPpIbmxDu','0'),(13,'Kirti Salunkhe','chetansalunkhe18@gmail.com','$2y$10$3/Ykc/m5nXj1X4nj4jrcge1saHantJdtPoGNRLMR67hhkSZEDBzj6','0');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_title` text NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (11,'p'),(15,'Barbieq'),(31,'fd'),(32,'kirti'),(33,'phwretjuyj'),(34,'Tom&Jerry'),(35,'text');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `p_id` int NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int DEFAULT NULL,
  `qty` int NOT NULL,
  `start_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` date DEFAULT NULL,
  `total_duration` int DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `exchange_product` int DEFAULT '0',
  `exchange_price` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=294 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (2,6,'::1',8,1,'2021-09-22 00:00:00','2021-09-24',2,'Exchange',2,1),(4,2,'106.220.172.158',-1,1,'2021-10-07 07:31:43',NULL,NULL,'Rent',0,0),(7,1,'122.171.218.90',11,1,'2021-10-07 14:11:36',NULL,NULL,'Rent',0,0),(9,3,'122.171.218.90',11,1,'2021-10-07 14:11:48',NULL,NULL,'Rent',0,0),(13,2,'122.171.218.90',17,1,'2021-10-07 15:44:42',NULL,NULL,'Rent',0,0),(22,1,'223.227.33.162',-1,1,'2021-10-08 02:34:09',NULL,NULL,'Exchange',0,0),(23,1,'122.171.218.90',17,1,'2021-10-08 05:19:02',NULL,NULL,'Rent',0,0),(24,3,'122.171.218.90',17,1,'2021-10-08 05:19:22',NULL,NULL,'Rent',0,0),(25,6,'122.171.218.90',17,1,'2021-10-08 05:19:29',NULL,NULL,'Rent',0,0),(28,3,'122.171.218.90',18,1,'2021-10-08 06:16:22',NULL,NULL,'Sale',0,0),(31,1,'157.45.253.228',21,1,'2021-10-08 06:27:37',NULL,NULL,'Exchange',0,0),(35,6,'49.37.167.221',-1,1,'2021-10-08 06:31:34',NULL,NULL,'',0,0),(36,1,'122.171.218.90',19,1,'2021-10-08 06:40:13',NULL,NULL,'Rent',0,0),(37,2,'122.171.218.90',22,1,'2021-10-08 06:41:53',NULL,NULL,'Rent',0,0),(38,3,'122.171.218.90',22,1,'2021-10-08 06:41:54',NULL,NULL,'Rent',0,0),(39,1,'122.171.218.90',23,1,'2021-10-07 00:00:00','2021-10-10',3,'Rent',0,0),(40,2,'103.146.240.201',24,1,'2021-10-08 07:18:39',NULL,NULL,'Rent',0,0),(66,6,'122.171.218.90',26,1,'2021-10-08 08:24:22',NULL,NULL,'',0,0),(67,6,'106.193.137.216',-1,1,'2021-10-08 08:24:22',NULL,NULL,'',0,0),(68,1,'122.171.218.90',26,1,'2021-10-08 08:25:08',NULL,NULL,'',0,0),(69,1,'106.193.137.216',-1,1,'2021-10-08 08:25:16',NULL,NULL,'',0,0),(70,2,'122.171.218.90',26,1,'2021-10-08 08:25:21',NULL,NULL,'',0,0),(71,3,'122.171.218.90',26,10,'2021-10-01 00:00:00','2021-10-02',1,'Rent',0,0),(72,1,'103.146.240.201',-1,1,'2021-10-08 08:34:20',NULL,NULL,'',0,0),(73,1,'122.171.218.90',27,1,'2021-10-01 00:00:00','2021-10-10',9,'Rent',0,0),(74,1,'122.171.218.90',29,1,'2021-10-01 00:00:00','2021-10-02',1,'Rent',0,0),(75,1,'122.171.218.90',30,1,'2021-10-08 09:22:40',NULL,NULL,'Rent',0,0),(76,6,'157.45.235.55',0,1,'2021-10-08 12:19:35',NULL,NULL,'',0,0),(77,2,'103.146.240.201',-1,1,'2021-10-08 16:05:17',NULL,NULL,'',0,0),(78,6,'106.210.183.129',-1,1,'2021-10-13 10:40:32',NULL,NULL,'Rent',0,0),(80,3,'110.227.29.170',-1,1,'2021-10-14 10:00:18',NULL,NULL,'Exchange',0,0),(81,1,'106.222.40.125',37,1,'2021-10-16 12:07:22',NULL,NULL,'Rent',0,0),(83,1,'106.222.40.125',38,1,'2021-10-16 14:18:01',NULL,NULL,'Rent',0,0),(84,2,'106.222.40.125',38,1,'2021-10-16 14:18:03',NULL,NULL,'Rent',0,0),(85,3,'106.222.40.125',38,1,'2021-10-16 14:18:07',NULL,NULL,'Rent',0,0),(87,6,'49.37.186.119',-1,1,'2021-10-18 06:35:29',NULL,NULL,'',0,0),(88,1,'49.37.186.119',-1,1,'2021-10-18 06:36:08',NULL,NULL,'',0,0),(91,2,'106.206.105.174',39,1,'2021-10-06 00:00:00','2021-10-22',16,'Rent',0,0),(94,1,'103.150.138.89',45,1,'2021-10-20 07:21:07',NULL,NULL,'Exchange',0,0),(95,1,'49.37.186.85',-1,1,'2021-10-20 13:01:30',NULL,NULL,'Rent',0,0),(96,2,'49.37.186.85',-1,1,'2021-10-20 13:03:43',NULL,NULL,'Exchange',0,0),(97,3,'49.37.186.85',-1,1,'2021-10-20 13:04:51',NULL,NULL,'Rent',0,0),(98,6,'49.37.186.85',-1,1,'2021-10-20 13:06:28',NULL,NULL,'',0,0),(99,1,'103.150.138.89',46,1,'2021-10-20 16:44:14',NULL,NULL,'Rent',0,0),(100,2,'103.150.138.89',46,1,'2021-10-20 16:54:57',NULL,NULL,'Rent',0,0),(101,1,'49.37.191.4',-1,1,'2021-10-22 13:20:43',NULL,NULL,'',0,0),(102,3,'49.37.191.4',-1,1,'2021-10-22 13:20:46',NULL,NULL,'',0,0),(103,1,'103.150.138.89',-1,1,'2021-10-23 05:30:39',NULL,NULL,'Rent',0,0),(104,1,'103.150.138.86',-1,1,'2021-10-26 10:22:17',NULL,NULL,'Exchange',0,0),(122,1,'122.171.253.232',49,1,'2021-10-30 06:58:48',NULL,NULL,'Exchange',0,0),(123,2,'122.171.253.232',49,1,'2021-10-30 06:59:03',NULL,NULL,'Exchange',0,0),(124,3,'122.171.253.232',49,1,'2021-10-30 06:59:16',NULL,NULL,'Exchange',0,0),(125,6,'122.171.253.232',49,1,'2021-10-30 06:59:36',NULL,NULL,'Exchange',0,0),(127,1,'152.57.222.231',-1,1,'2021-10-30 13:45:40',NULL,NULL,'Exchange',0,0),(128,1,'122.171.253.232',-1,1,'2021-11-02 09:30:28',NULL,NULL,'Rent',0,0),(140,6,'223.184.82.11',50,1,'2021-11-09 02:39:16',NULL,NULL,'Sale',0,0),(145,2,'223.184.82.11',-1,1,'2021-11-10 10:27:49',NULL,NULL,'Exchange',0,0),(146,1,'::1',52,1,'2021-12-11 10:54:28',NULL,NULL,'Rent',0,0),(147,1,'103.182.221.227',-1,1,'2024-05-11 02:09:03',NULL,NULL,'Borrow',0,0),(148,2,'103.182.221.227',-1,1,'2024-05-11 02:09:21',NULL,NULL,'Sale',0,0),(150,6,'103.182.221.227',-1,1,'2024-05-11 02:14:48','2024-05-15',4,'Rent',0,0),(151,3,'103.182.221.227',-1,1,'2024-05-11 02:15:00',NULL,NULL,'Exchange',0,0),(153,2,'103.182.221.199',218,1,'2024-05-11 17:02:41',NULL,NULL,'Sale',0,0),(154,11,'103.182.221.199',218,1,'2024-05-11 17:02:50','2024-05-28',17,'Rent',0,0),(155,12,'103.182.221.199',218,1,'2024-05-11 17:02:51','2024-05-15',4,'Rent',0,0),(156,6,'103.182.221.199',218,1,'2024-05-11 17:03:43',NULL,NULL,'',0,0),(157,2,'136.226.251.30',-1,1,'2024-05-15 13:26:19',NULL,NULL,'',0,0),(158,11,'136.226.251.19',225,1,'2024-05-24 16:36:53',NULL,NULL,'',0,0),(159,1,'49.36.42.54',231,1,'2024-05-27 11:47:28',NULL,NULL,'Sale',0,0),(160,2,'49.36.42.54',231,1,'2024-05-27 11:47:32','2024-05-27',0,'Rent',0,0),(161,3,'49.36.42.54',231,1,'2024-05-27 11:47:40','2024-05-27',0,'Rent',0,0),(162,1,'49.36.42.54',232,1,'2024-05-27 11:56:51',NULL,NULL,'Rent',0,0),(163,6,'103.79.171.76',-1,1,'2024-06-03 16:06:20',NULL,NULL,'',0,0),(164,1,'220.158.158.13',-1,1,'2024-06-04 01:45:34',NULL,NULL,'Exchange',0,0),(165,11,'220.158.158.13',-1,1,'2024-06-04 01:45:50',NULL,NULL,'Rent',0,0),(166,1,'220.158.158.13',217,1,'2024-06-04 01:47:47',NULL,NULL,'Rent',0,0),(168,6,'103.42.196.141',256,1,'2024-06-04 15:21:11',NULL,NULL,'',0,0),(169,1,'1.187.213.134',369,1,'2024-06-22 14:50:46',NULL,NULL,'Rent',0,0),(170,1,'27.97.155.17',-1,1,'2024-06-23 11:57:09',NULL,NULL,'Sale',0,0),(171,6,'27.97.155.17',-1,1,'2024-06-23 11:57:29',NULL,NULL,'Sale',0,0),(172,3,'27.97.155.17',-1,1,'2024-06-23 12:13:18',NULL,NULL,'Sale',0,0),(173,12,'27.97.155.17',-1,1,'2024-06-23 12:52:56',NULL,NULL,'Sale',0,0),(174,1,'106.79.235.249',-1,1,'2024-06-23 15:22:40',NULL,NULL,'Borrow',0,0),(175,12,'106.79.235.249',-1,1,'2024-06-23 15:24:44',NULL,NULL,'Borrow',0,0),(176,12,'49.15.170.93',-1,1,'2024-06-23 19:12:55',NULL,NULL,'Borrow',0,0),(179,3,'49.15.170.93',-1,1,'2024-06-23 19:13:51',NULL,NULL,'Borrow',0,0),(180,1,'152.59.133.178',-1,1,'2024-06-25 05:35:15',NULL,NULL,'Borrow',0,0),(181,2,'152.59.133.178',-1,1,'2024-06-25 05:37:47',NULL,NULL,'Borrow',0,0),(183,6,'152.59.133.178',-1,1,'2024-06-25 06:02:16',NULL,NULL,'Borrow',0,0),(184,1,'152.59.133.250',-1,1,'2024-06-25 08:04:42',NULL,NULL,'Borrow',0,0),(185,2,'152.59.133.250',-1,1,'2024-06-25 08:04:48',NULL,NULL,'Borrow',0,0),(186,1,'182.77.64.64',-1,1,'2024-06-25 08:06:51',NULL,NULL,'Borrow',0,0),(187,2,'182.77.64.64',-1,1,'2024-06-25 08:30:21',NULL,NULL,'Borrow',0,0),(188,1,'152.59.133.123',-1,1,'2024-06-25 08:44:38',NULL,NULL,'Borrow',0,0),(189,2,'152.59.133.123',-1,1,'2024-06-25 08:44:57',NULL,NULL,'Borrow',0,0),(190,1,'223.236.55.1',-1,1,'2024-06-25 09:23:56',NULL,NULL,'Borrow',0,0),(191,3,'223.236.55.1',-1,1,'2024-06-25 10:55:47',NULL,NULL,'Borrow',0,0),(192,6,'223.236.55.1',-1,1,'2024-06-25 11:04:37',NULL,NULL,'Borrow',0,0),(198,1,'152.59.171.58',-1,1,'2024-06-25 19:20:36',NULL,NULL,'Borrow',0,0),(209,12,'27.97.34.233',-1,1,'2024-06-25 21:20:12',NULL,NULL,'Borrow',0,0),(214,2,'152.59.170.226',-1,1,'2024-06-26 04:32:22',NULL,NULL,'Borrow',0,0),(216,1,'49.43.3.234',-1,1,'2024-06-26 05:38:04',NULL,NULL,'Borrow',0,0),(217,1,'171.61.22.107',-1,1,'2024-06-26 05:40:35',NULL,NULL,'Borrow',0,0),(222,1,'122.168.234.61',-1,1,'2024-06-26 07:00:21',NULL,NULL,'Borrow',0,0),(223,2,'152.58.159.127',-1,1,'2024-06-26 08:42:40',NULL,NULL,'Borrow',0,0),(224,3,'152.58.159.127',-1,1,'2024-06-26 08:46:30',NULL,NULL,'Borrow',0,0),(225,1,'122.168.86.143',-1,1,'2024-06-26 09:27:37',NULL,NULL,'Borrow',0,0),(227,12,'27.59.125.103',-1,1,'2024-06-26 09:54:27',NULL,NULL,'Borrow',0,0),(244,6,'27.59.125.103',306,1,'2024-06-26 12:02:09','2024-06-30',15,'Borrow',0,0),(245,3,'27.59.125.103',-1,1,'2024-06-26 12:05:42',NULL,NULL,'Borrow',0,0),(246,3,'27.59.125.103',307,1,'2024-06-26 12:09:13','2024-06-30',15,'Borrow',0,0),(247,1,'152.59.169.19',-1,1,'2024-06-26 12:09:47',NULL,NULL,'Borrow',0,0),(248,1,'122.168.7.187',-1,1,'2024-06-26 12:22:30',NULL,NULL,'Borrow',0,0),(250,12,'152.59.169.237',383,1,'2024-06-26 12:30:43','2024-12-31',15,'Borrow',0,0),(251,6,'152.59.169.237',-1,1,'2024-06-26 12:31:19',NULL,NULL,'Borrow',0,0),(252,1,'152.59.169.237',383,1,'2024-06-26 12:34:02','2024-12-31',15,'Borrow',0,0),(254,3,'152.59.168.181',383,1,'2024-06-26 12:49:53',NULL,NULL,'Buy',0,0),(255,6,'152.59.168.181',383,1,'2024-06-26 12:50:39',NULL,NULL,'Buy',0,0),(260,11,'152.59.168.87',383,1,'2024-06-26 12:56:02',NULL,NULL,'Buy',0,0),(262,1,'106.195.8.111',234,1,'2024-06-27 03:31:30',NULL,NULL,'Buy',0,0),(267,1,'152.59.10.235',216,1,'2024-07-03 03:51:26',NULL,NULL,'Buy',0,0),(268,2,'152.59.10.235',216,1,'2024-07-03 03:51:58',NULL,NULL,'Buy',0,0),(269,3,'152.59.47.187',273,1,'2024-07-03 07:44:18',NULL,NULL,'Buy',0,0),(279,11,'152.58.135.238',380,1,'2024-07-05 19:23:44',NULL,NULL,'Buy',0,0),(280,3,'152.58.135.238',380,1,'2024-07-05 19:27:12',NULL,NULL,'Buy',0,0),(285,1,'122.175.178.138',381,1,'2024-07-06 08:53:41',NULL,NULL,'Buy',0,0),(287,2,'152.59.47.69',273,1,'2024-07-06 10:02:11',NULL,NULL,'Buy',0,0),(288,3,'152.59.47.69',367,1,'2024-07-06 10:51:19',NULL,NULL,'Buy',0,0),(289,1,'136.226.230.101',210,1,'2024-07-06 13:14:11',NULL,NULL,'Rent',0,0),(290,11,'183.83.53.130',392,1,'2024-07-20 13:09:05',NULL,NULL,'Buy',0,0),(291,3,'183.83.53.130',392,1,'2024-07-20 13:09:18',NULL,NULL,'Buy',0,0),(292,1,'183.83.53.130',392,1,'2024-07-20 13:09:23',NULL,NULL,'Buy',0,0),(293,1,'152.58.191.49',380,1,'2024-07-20 15:55:40',NULL,NULL,'Buy',0,0);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_title` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (16,'fg'),(17,'fgdgr'),(21,'fgygh'),(22,'fgyghfdg'),(23,'hjkjk'),(24,'Tom');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cust_products`
--

DROP TABLE IF EXISTS `cust_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cust_products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_cat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_brand` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_des` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `product_image` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cust_products`
--

LOCK TABLES `cust_products` WRITE;
/*!40000 ALTER TABLE `cust_products` DISABLE KEYS */;
INSERT INTO `cust_products` VALUES (1,9,'barbie','sdf','barbie','H','images/barbie.jpg'),(2,9,'barbie','sdf','barbie','dsfd','images/barbie.jpg'),(3,9,'puzzle','sdf','puzzle','dg','images/puzzle.jpg'),(4,8,'puzzle','HGJ','puzzle','good','images/puzzle.jpg'),(5,9,'barbie','sdf','barbie','k,','images/barbie.jpg');
/*!40000 ALTER TABLE `cust_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `qty` int NOT NULL,
  `trx_id` varchar(255) NOT NULL,
  `p_status` varchar(20) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `user_id` int DEFAULT '0',
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_cat` int NOT NULL,
  `product_brand` int NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int NOT NULL,
  `product_qty` int NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL,
  `exchange_price` int DEFAULT NULL,
  `rent_price` int DEFAULT '0',
  `deposit` int DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `fk_product_cat` (`product_cat`),
  KEY `fk_product_brand` (`product_brand`),
  CONSTRAINT `fk_product_brand` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`),
  CONSTRAINT `fk_product_cat` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (8,1,17,11,'puzzle',2,2,'fyh','1632248994_puzzle.jpg','puzzle',3,4,5),(8,2,17,15,'barbie',1,1,'we','1632251955_barbie.jpg','bar',1,1,2),(8,3,17,15,'barbie',1,1,'we','1632251983_barbie.jpg','bar',1,1,3),(0,6,16,15,'Samsung Galaxy S6',3,3,'5rt','1632292598_barbie.jpg','puzzle',3,4,3),(0,11,24,34,'Tom and Jerry',500,2,'Tom  cat','1648916032_WhatsApp Image 2022-04-01 at 3.46.00 PM.jpeg','TomCat',120,20,150),(0,12,24,34,'Tom and Jerry',123,2,'qaweqwe','1648919277_fsdImp.png','TomCat',2,12,13);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracking`
--

DROP TABLE IF EXISTS `tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tracking` (
  `tracking_id` int NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `delivery_boy_id` varchar(30) NOT NULL,
  `user_lat` double NOT NULL,
  `user_lang` double NOT NULL,
  `delivery_lat` double NOT NULL,
  `delivery_lang` double NOT NULL,
  `is_Active` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracking`
--

LOCK TABLES `tracking` WRITE;
/*!40000 ALTER TABLE `tracking` DISABLE KEYS */;
INSERT INTO `tracking` VALUES (123456,'123','325',17.125452,36.15748,17.3256,36.154565,1);
/*!40000 ALTER TABLE `tracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_info` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL,
  `address2` varchar(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (1,'Rizwan','Khan','rizwankhan.august16@gmail.com','25f9e794323b453885f5181f1b624d0b','8389080183','Rahmat Nagar Burnpur Asansol','Asansol'),(2,'Rizwan','Khan','rizwankhan.august16@yahoo.com','25f9e794323b453885f5181f1b624d0b','8389080183','Rahmat Nagar Burnpur Asansol','Asa'),(3,'Kirti','Salunkhe','kirtisalunkhe15@gmail.com','aad7eaf8d9211f3115c5a94b17a7f478','8329475486','Shivajinagar,pune, Shivajinagar,pune','Shivajinaga'),(4,'mansi','Salunkhe','kanchanwaghkop@gmail.com','bbabcc4d7e9ffbdf941f09e3ede169e0','8329475486','Shivajinagar,pune, Shivajinagar,pune','Shivajinaga'),(6,'','Salunkhe','','6a13bdfc27460fe492d2ae7ba60448b6','','',''),(7,'swati','Rupnwar','poojasalunkhe189@gmail.com','6155fc03415fcf69eb7d1d3df90e4ec3','1234567895','shivaji nagar','shivaji nag'),(8,'Yukta','Salunkhe','yuktasalunkhe15@gmail.com','c62b4fdb0786ce07a31526d408384587','8329475486','Shivajinagar,pune,','Shivajinaga'),(9,'Neha','shelar','manesalunkhe189@gmail.com','97eff39267741b6473576151b9480a75','1234567887','shivaji','pune'),(10,'Krishna','Thorat','krishnathorat008@gmail.com','8a6f2805b4515ac12058e79e66539be9','8550969625','Pune','Maharashtra'),(11,'wrertrtrdg','gfhgg','chotu.sonia@gmail.com','6dd55c2b491c5a73bd35765328228906','4343545465','fdghgj','retytfyt'),(12,'Pushpendra','Kumar','pushpendragupta2701@gmail.com','e10adc3949ba59abbe56e057f20f883e','9956862264','None','Rath'),(13,'Pushpendra','Kumar','pushpendragupta2@gmail.com','e10adc3949ba59abbe56e057f20f883e','9956862264','None','Rath'),(14,'kiran','Dhumal','kiran21dhumal@gmail.com','e10adc3949ba59abbe56e057f20f883e','9876543210','dbgvfd','htjytkiu'),(15,'Pushpendra','kumar','pushpendragupta@gmail.com','e10adc3949ba59abbe56e057f20f883e','9956862264','None','Rath'),(16,'Mahaboob ','Basha','bashamca99@gmail.com','d26bd7787ed3b7e47d54adbe2851727c','9642809805','28/1310, kolimipeta 2nd street, noonepalli.','Nandyal'),(17,'fdgfdgfdg','ddfgfdgdfg','sdfdfd@gmail.com','033c91317f9b6795106a825cf8ef773d','6666666666','ssssssssssssss','erdtrtg'),(18,'fdgfdgfdg','ddfgfdgdfg','sdfafd@gmail.com','033c91317f9b6795106a825cf8ef773d','6666666666','ssssssssssssss','erdtrtg'),(19,'sssss','sssss','sssss@gmail.com','033c91317f9b6795106a825cf8ef773d','6666666666','ssssssssssssss','erdtrtg'),(20,'Kiran','Dhumal','kiran22dhumal@gmail.com','c33367701511b4f6020ec61ded352059','1234567890','rperd','uhgiufuy'),(21,'kavya','g','ran.kavya@gmail.com','e10adc3949ba59abbe56e057f20f883e','7892254941','#55,krishna, amaravathi','hospet'),(22,'sdds','fsdfdsf','dsdsf@gmail.com','b330cf2425c6ac1561c63f825e680a53','3333333333','dsfds','dsfsdf'),(23,'sdds','fsdfdsf','dsddsf@gmail.com','b330cf2425c6ac1561c63f825e680a53','3333333333','dsfds','dsfsdf'),(24,'sangita','tambe','sang.tambe7887@rediffmail.com','8e14cb56eced1e7b7f5c7bd34d15f9e6','9096368895','pune','moshi'),(25,'sangita','tambe','sangita.tambe7887@gmail.com','8e14cb56eced1e7b7f5c7bd34d15f9e6','9096368895','pune','moshi'),(26,'sfg','sdgfdg','dgfdg@gmail.com','033c91317f9b6795106a825cf8ef773d','4343434343','fdfdf','334dsfdfd'),(27,'dfd','dfdf','qweds@gmail.com','033c91317f9b6795106a825cf8ef773d','1111111111','sdsd','sdsd'),(28,' kiran','dhumal ','chvk@gmail.com','e10adc3949ba59abbe56e057f20f883e','1234567890','jheofugheof','eofgofg'),(29,'rer','erer','sss@gmail.com','af15d5fdacd5fdfea300e88a8e253e82','1111111111','11','ss'),(30,'tgdrtgd','erer','dgdfg@gmail.com','16fcb1091f8a0cc70c96e2ff97fdd213','3434343434','fdfg','gfg'),(31,'daga','paga','kjkfjhxmhvk@gmail.com','e10adc3949ba59abbe56e057f20f883e','4852118581','dfef','wdef'),(32,'wrewr','qwe','weer@gmail.com','033c91317f9b6795106a825cf8ef773d','3333333333','33','33'),(33,'daga ','paga','kdgifcbkh@gmail.com','6c44e5cd17f0019c64b042e4a745412a','9876543210','abcd','xyz'),(34,'daga ','paga','kdgifcbkhjf@gmail.com','6c44e5cd17f0019c64b042e4a745412a','9876543210','abcd','xyz'),(35,'daga ','paga','kdgifcbjgkkhjf@gmail.com','e10adc3949ba59abbe56e057f20f883e','1111111111','abcd','xyz'),(36,'Pushpendra','Kumar','pushpendra@gmail.com','e10adc3949ba59abbe56e057f20f883e','9956862264','None','Rath'),(37,'tester','tester','tester@gmail.com','f5d1278e8109edd94e1e4197e04873b9','9898989898','tester','tester'),(38,'tester','tester','tester11@gmail.com','f5d1278e8109edd94e1e4197e04873b9','9898989898','tester','tester'),(39,'sss','sss','ssssss@gmail.com','e11170b8cbd2d74102651cb967fa28e5','1111111111','ddd','ddd'),(40,'snehal','Salave','pooja@gmail.com','f55e40b78d6db174c472f98beed5b0da','9022478080','pune','pune'),(41,'snehal','Salave','rita@gmail.com','f55e40b78d6db174c472f98beed5b0da','9022478080','pune','pune'),(42,'snehal','Salave','mina123@gmail.com','f55e40b78d6db174c472f98beed5b0da','9022478080','pune','pune'),(43,'snehal','salave','snehalsalave130@gmail.com','3a58e928d11c4daf463c99826c397136','8180915503','Hivare Zare','Hivare zare'),(44,'snehal','salave','snehalsalave2130@gmail.com','3a58e928d11c4daf463c99826c397136','8180915503','Hivare Zare','Hivare zare'),(45,'snehal','salave','snehalsalave21303@gmail.com','3a58e928d11c4daf463c99826c397136','8180915503','Hivare Zare','Hivare zare'),(46,'snehal','salave','bbbb@gamil.com','3a58e928d11c4daf463c99826c397136','0818091550','Hivare Zare','Hivare zare'),(47,'chotu','sonia','arige.ajay@gmail.com','784cc49c66174aa5151749d6dcc20bcb','4242424242','ssssssssssssss','sssss'),(48,'ankit','arige','ankit.arige@gmail.com','033c91317f9b6795106a825cf8ef773d','4343434343','sss','sss'),(49,'ssss','sss','dfdsf@fg.com','033c91317f9b6795106a825cf8ef773d','1212121212','wewewe','ewewew'),(50,'ssssss','ssssss','aaaaaaaaaa@gmail.com','0eb7274308f37fc4a86f69adea5b6fb3','2222222222','dsfddgfdgfg','dddfgfgfdg'),(51,'cccccccccc','cccccccccc','cccccccccc@gmail.com','565557670136ae194b21a8856bfd5fe3','3333333333','dfdfdfdf','dfdfdfdf'),(52,'varun','kumar','varunmanila@gmail.com','e86fdc2283aff4717103f2d44d0610f7','8951698546','wqrwerwer','werwer');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-20 15:58:48
