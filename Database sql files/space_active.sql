-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: space_active
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
-- Table structure for table `spaceactive_activities`
--

DROP TABLE IF EXISTS `spaceactive_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `spaceactive_activities` (
  `activity_no` int NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(255) NOT NULL,
  `activity_level` smallint NOT NULL,
  `activity_dev_domain` varchar(255) NOT NULL,
  `activity_objectives` text NOT NULL,
  `activity_key_dev` varchar(255) NOT NULL,
  `activity_material` varchar(255) NOT NULL,
  `activity_assessment` text NOT NULL,
  `activity_process` text NOT NULL,
  `activity_instructions` text NOT NULL,
  `status` enum('paid','free') NOT NULL DEFAULT 'free',
  `activity_date` date DEFAULT NULL,
  `playlist_id` varchar(50) NOT NULL,
  `playlist_descr` varchar(200) NOT NULL,
  `playlist_name` varchar(50) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `work_done` int DEFAULT NULL,
  `v_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`activity_no`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spaceactive_activities`
--

LOCK TABLES `spaceactive_activities` WRITE;
/*!40000 ALTER TABLE `spaceactive_activities` DISABLE KEYS */;
INSERT INTO `spaceactive_activities` VALUES (100,'Art and Craft',3,'Cognitive, Language, Motor','Boost artistic talent, explore creativity','Fine Motor Skills, Cognitive','Sheet, pencil, eraser','Sketching, drawing, coloring, imagination','Draw a vegetable basket following steps','Show them how to draw, provide step-by-step guidance if needed','free','2024-07-03','1','SpaceEc','Art and Craft','alpha.jpg',NULL,'2dHhvV18eX8'),(101,'Building Blocks',2,'Motor, Cognitive','Enhance problem-solving, spatial awareness','Gross Motor Skills, Cognitive','Building blocks','Structure stability, creativity, ability to follow instructions','Build various structures, starting with simple designs','Encourage creativity, assist if they struggle','free','2024-07-03','2','SpaceCe','Building Blocks','alpha.jpg',NULL,'ZtXGacq9sbM'),(102,'Story Time',1,'Language, Social-Emotional','Improve listening, comprehension, empathy','Language Skills, Social Skills','Storybooks, puppet','Participation, understanding, emotional response','Read a story, use puppets for characters','Engage them in discussion about the story','free','2024-07-04','3','SpaceCe','Story Time','alpha.jpg',NULL,'CpXlvLOyBVI'),(104,'Puzzle Solving',2,'Cognitive, Motor','Enhance problem-solving skills, hand-eye coordination','Cognitive Skills, Fine Motor Skills','Puzzles with large pieces','Ability to complete the puzzle, recognition of shapes','Solve the puzzle, starting with edge pieces first','Demonstrate how to find corner pieces, assist if needed','free','2024-07-04','4','SpaceCe','Puzzle Solving','alpha.jpg',NULL,'UTftkT41eXk'),(105,'Dance and Move',1,'Physical, Emotional','Promote physical activity, express emotions through movement','Gross Motor Skills, Emotional Regulation','Music, open space','Movement coordination, emotional expression','Play lively music, encourage dancing and movement','Guide children in different dance moves, encourage expression','free','2024-07-05','5','SpaceCe','Dance and Move','alpha.jpg',NULL,'VsgpUHUYuJI'),(106,'Sensory Play',2,'Cognitive, Sensory','Develop sensory skills, explore different textures and materials','Fine Motor Skills, Cognitive Skills','Sensory bins, various textured objects','Sensory exploration, tactile discrimination','Create sensory bins with different materials','Guide them through sensory activities, ask questions about textures','free','2024-07-06','6','SpaceEc','Sensory Play','alpha.jpg',NULL,'RgAz8E6E28M'),(107,'Simple Cooking',3,'Cognitive, Motor','Learn basic cooking skills, follow recipes','Fine Motor Skills, Cognitive Skills','Simple recipes, cooking utensils','Recipe following, cooking techniques','Prepare a simple dish following a recipe','Assist in measuring ingredients, explain cooking steps','free','2024-07-07','7','SpaceEc','Simple Cooking','alpha.jpg',NULL,'Ew4C95FeKwc');
/*!40000 ALTER TABLE `spaceactive_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `name` text NOT NULL,
  `email` text NOT NULL,
  `oauth_type` text NOT NULL,
  `gender` varchar(9) NOT NULL,
  `user_id` int NOT NULL,
  `activity_no` int NOT NULL,
  `workdone` int DEFAULT NULL,
  PRIMARY KEY (`user_id`,`activity_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('NULL','NULL','NULL','NULL',308,7,0),('NULL','NULL','NULL','NULL',308,1,0),('NULL','NULL','NULL','NULL',273,1,1),('NULL','NULL','NULL','NULL',273,0,0),('NULL','NULL','NULL','NULL',273,3,1),('NULL','NULL','NULL','NULL',367,4,1),('NULL','NULL','NULL','NULL',367,34,1),('NULL','NULL','NULL','NULL',367,5,1),('NULL','NULL','NULL','NULL',367,24,1),('NULL','NULL','NULL','NULL',367,37,1),('NULL','NULL','NULL','NULL',367,36,1),('NULL','NULL','NULL','NULL',367,3,1),('NULL','NULL','NULL','NULL',367,1,0),('NULL','NULL','NULL','NULL',367,6,1),('NULL','NULL','NULL','NULL',367,35,1),('NULL','NULL','NULL','NULL',367,20,1),('NULL','NULL','NULL','NULL',367,22,1),('NULL','NULL','NULL','NULL',367,28,1),('NULL','NULL','NULL','NULL',367,29,1),('NULL','NULL','NULL','NULL',367,30,1),('NULL','NULL','NULL','NULL',367,31,1),('NULL','NULL','NULL','NULL',367,32,1),('NULL','NULL','NULL','NULL',369,4,1),('NULL','NULL','NULL','NULL',312,1,1),('NULL','NULL','NULL','NULL',312,3,1),('NULL','NULL','NULL','NULL',273,35,1),('NULL','NULL','NULL','NULL',273,5,-1),('NULL','NULL','NULL','NULL',273,4,0),('NULL','NULL','NULL','NULL',273,20,1),('NULL','NULL','NULL','NULL',273,33,0),('NULL','NULL','NULL','NULL',273,37,-1),('NULL','NULL','NULL','NULL',380,3,1),('NULL','NULL','NULL','NULL',273,100,1),('NULL','NULL','NULL','NULL',367,100,0),('NULL','NULL','NULL','NULL',367,101,1),('NULL','NULL','NULL','NULL',392,106,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `youtube_oauth`
--

DROP TABLE IF EXISTS `youtube_oauth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `youtube_oauth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `provider` varchar(255) NOT NULL,
  `provider_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `youtube_oauth`
--

LOCK TABLES `youtube_oauth` WRITE;
/*!40000 ALTER TABLE `youtube_oauth` DISABLE KEYS */;
INSERT INTO `youtube_oauth` VALUES (20,'youtube','{\"access_token\":\"ya29.A0ARrdaM-72-k6mzisfi8oxponxikeogYfY9NmXLE3DovBHlh53VH_zZdTQHvJTcDeHkUUXM-51lUWj5sM4BxPpjBTDnHgzQUKES4XWzS6ygjvqvVl4gwC3kN_wVpNMAMxe45Pwy4QkwuqlJCZnQezOAO1dqkw\",\"token_type\":\"Bearer\",\"refresh_token\":\"1//0gXzoWzklM7csCgYIARAAGBASNwF-L9IrKmsK8r72wU0iKEHzrgVvJ8LzT0AamyVErln_4FnB1VGAyU0XB3O9yCju6RNO785HSh0\",\"expires_in\":3599,\"expires_at\":1641573800}');
/*!40000 ALTER TABLE `youtube_oauth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `youtube_videos`
--

DROP TABLE IF EXISTS `youtube_videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `youtube_videos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `video_id` varchar(20) NOT NULL,
  `title` varchar(20) NOT NULL,
  `v_description` text NOT NULL,
  `category_id` varchar(20) NOT NULL,
  `published_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `playlist_id` varchar(50) NOT NULL,
  `act_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `youtube_videos`
--

LOCK TABLES `youtube_videos` WRITE;
/*!40000 ALTER TABLE `youtube_videos` DISABLE KEYS */;
INSERT INTO `youtube_videos` VALUES (2,'varunmanila@gmail.com','i_Drt586NCI','ewert','dfsdret','PLm0GU5IUgzTCafm3r3F','2021-11-25 06:38:33','',0),(3,'varunmanila@gmail.com','i_Drt586NCI','ewertjfuyfgf yry6','dfsdrettretert','PLm0GU5IUgzTCafm3r3F','2021-11-25 06:38:33','',0),(4,'varunmanila@gmail.com','nvoFj0OMQHQ','adsre  arewr','erer','PLm0GU5IUgzTAXv24BTO','2021-11-25 10:01:41','',0),(5,'varunmanila@gmail.com','yH-s6R9mYDg','fgfhyr','ryyruyf','PLm0GU5IUgzTAXv24BTO','2021-11-25 10:03:33','',0),(17,'varun@gmail.com','4HsCKMa2J44','my first Activity','childrens activity','','2022-01-22 09:54:36','PLj6kkolZM3BMZsIVP4QLutpIJYGe-5FIh',16),(18,'varun@gmail.com','t61BW5Y1UCg','Summer Activity','Summer activity 1','','2022-01-22 11:52:19','PLj6kkolZM3BMpM_UYZGQ-m_MA0QqARzDT',20),(19,'varun@gmail.com','H9Q7omyubBY','Summer Activity','Summer activity 1','','2022-01-22 11:52:22','PLj6kkolZM3BMpM_UYZGQ-m_MA0QqARzDT',20),(20,'varun@gmail.com','mPXGUEDPCVE','test video','testing','','2022-01-23 10:54:45','PLj6kkolZM3BMpM_UYZGQ-m_MA0QqARzDT',20),(21,'varun@gmail.com','-tPEn1ZG_PY','testing2','testing','','2022-01-23 11:05:20','PLj6kkolZM3BMpM_UYZGQ-m_MA0QqARzDT',20),(22,'varun@gmail.com','bvh6IxyQf_w','upload','upload 1','','2022-01-23 11:11:18','PLj6kkolZM3BMpM_UYZGQ-m_MA0QqARzDT',20),(23,'varun@gmail.com','ekwq9eTY6As','Testing','Testing playlist','','2022-01-27 01:02:01','PLj6kkolZM3BM97Ql5hTTvhvjUlDsO7tjB',30),(24,'varun@gmail.com','ac56oxZ2X4o','Food and health','Food and health','','2022-02-11 02:33:51','PLj6kkolZM3BMqYIJo-FJ5RK8QdgNI0ZVC',24),(25,'varun@gmail.com','jbfPpsS9pAs','family','Family','','2022-02-11 02:41:34','PLj6kkolZM3BMqYIJo-FJ5RK8QdgNI0ZVC',24),(26,'varun@gmail.com','G_EBjF1fjC8','family','Family','','2022-02-11 02:42:00','PLj6kkolZM3BMqYIJo-FJ5RK8QdgNI0ZVC',24),(27,'varun@gmail.com','9g5hNotzAek','family','Family','','2022-02-11 02:42:04','PLj6kkolZM3BMqYIJo-FJ5RK8QdgNI0ZVC',24),(28,'varun@gmail.com','0C2hMDs6z3o','Family and health','Family and health','','2022-02-11 05:32:17','PLj6kkolZM3BMqYIJo-FJ5RK8QdgNI0ZVC',24),(29,'varun@gmail.com','XWi2MvC0i7w','uploading','uploading','','2022-02-11 06:05:27','PLj6kkolZM3BMpM_UYZGQ-m_MA0QqARzDT',20);
/*!40000 ALTER TABLE `youtube_videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-20 16:04:41
