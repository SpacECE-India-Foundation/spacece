-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: spactube
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
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `u_id` varchar(100) NOT NULL,
  `v_id` varchar(100) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES ('2','2','hello','2021-08-10','14:36:05');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `UID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` decimal(10,0) NOT NULL,
  `subscription_status` varchar(100) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'manassinkar','manas12345','Manas','manas.sinkar@gmail.com',9022942188,'inactive'),(2,'jaydeep','jaydeep12345','Jaydeep','jaydeep@gmail.com',9854545452,'inactive'),(3,'parththosani','parth12345','Parth','parth@gmail.com',9854512541,'inactive'),(4,'sangeeta08','1a2s3d4f5g','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active'),(5,'sangeeta08','1234567890','Sangeeta','sangeetamalviya08@gmail.com',8787878787,'active'),(6,'sangeeta08','1a2s3d4f5g','Ashok','sangeetamalviya08@gmail.com',8888888888,'active'),(7,'sangeeta081','1a2s3d4f5g','sang','sangeetamalviya08@gmail.com',8888888888,'active'),(8,'sangeeta080','1a2s3d4f5g','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active'),(9,'admin','1a2s3d4f5g','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active'),(10,'sangeeta08','1234567890','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active'),(11,'sangeeta90','1a2s3d4f5g','asd','sangeetamalviya08@gmail.com',8888888888,'active'),(12,'sangeeta08','1a2s3d4f5g','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active'),(13,'sangeeta189','1a2s3d4f5g','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active'),(14,'san45','1a2s3d4f5g','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active'),(15,'sangeeta0899','1a2s3d4f5g','Sangeeta','sangeetamalviya08@gmail.com',8888888888,'active');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comments`
--

DROP TABLE IF EXISTS `tbl_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `u_no` int DEFAULT NULL,
  `v_id` int DEFAULT NULL,
  `u_comment` varchar(1000) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comments`
--

LOCK TABLES `tbl_comments` WRITE;
/*!40000 ALTER TABLE `tbl_comments` DISABLE KEYS */;
INSERT INTO `tbl_comments` VALUES (1,15,7,'biebie','2024-06-25 16:49:11'),(2,15,12,'biebie','2024-06-25 16:49:55'),(3,15,12,'biebie','2024-06-25 16:50:54'),(4,15,5,'hiii','2024-06-25 17:02:32'),(5,15,5,'hlo','2024-06-25 17:02:40'),(6,372,24,'1','2024-06-25 17:02:43'),(7,15,7,'hlo','2024-06-25 17:02:49'),(8,15,7,'nice','2024-06-25 17:02:56'),(9,372,24,'a','2024-06-25 17:02:59'),(10,372,21,'q','2024-06-25 17:04:08'),(11,372,21,'hey','2024-06-25 19:39:53'),(12,372,21,'2','2024-06-25 19:44:18'),(13,372,22,'heyyy','2024-06-25 20:09:00'),(14,372,21,'hello','2024-06-26 02:40:56'),(15,372,21,'heyyyyy','2024-06-26 08:48:51'),(16,15,7,'nice','2024-06-26 12:53:37'),(17,372,21,'1','2024-06-26 22:03:48'),(18,372,21,'2','2024-06-26 22:03:54'),(19,372,21,'helooo','2024-06-27 16:16:59'),(20,380,21,'hii','2024-07-03 19:10:24'),(21,273,30,'','2024-07-06 16:14:33'),(22,273,30,'','2024-07-06 16:14:33'),(23,273,30,'good+one','2024-07-06 16:14:33'),(24,273,30,'','2024-07-06 16:14:33');
/*!40000 ALTER TABLE `tbl_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_dislike`
--

DROP TABLE IF EXISTS `tbl_dislike`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `tbl_dislike` (
  `u_id` varchar(100) NOT NULL,
  `v_id` varchar(200) NOT NULL,
  `dislike` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`u_id`,`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dislike`
--

LOCK TABLES `tbl_dislike` WRITE;
/*!40000 ALTER TABLE `tbl_dislike` DISABLE KEYS */;
INSERT INTO `tbl_dislike` VALUES ('100','5','1'),('2','2','dislike'),('234','24','1'),('273','31','1'),('372','21','1'),('372','22','1');
/*!40000 ALTER TABLE `tbl_dislike` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_like`
--

DROP TABLE IF EXISTS `tbl_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `tbl_like` (
  `u_id` varchar(200) NOT NULL,
  `v_id` varchar(200) NOT NULL,
  `like_status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`u_id`,`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_like`
--

LOCK TABLES `tbl_like` WRITE;
/*!40000 ALTER TABLE `tbl_like` DISABLE KEYS */;
INSERT INTO `tbl_like` VALUES ('1','2','liked'),('2','3','liked\r\n'),('20','5','1'),('21','5','1'),('273','27','1'),('273','30','1'),('372','24','1'),('50','7','1');
/*!40000 ALTER TABLE `tbl_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_recents`
--

DROP TABLE IF EXISTS `tbl_recents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `tbl_recents` (
  `u_no` int NOT NULL,
  `v_id` int NOT NULL,
  `v_time` time DEFAULT NULL,
  `vr_date` date DEFAULT NULL,
  `v_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_recents`
--

LOCK TABLES `tbl_recents` WRITE;
/*!40000 ALTER TABLE `tbl_recents` DISABLE KEYS */;
INSERT INTO `tbl_recents` VALUES (1,1,'00:15:00','2021-08-16','zWkU1fwkwWg'),(1,2,'00:14:00','2021-08-16','u_iKGzPZQoQ'),(1,3,'00:10:00','2021-08-16','TWICDS-8qMs'),(1,4,'00:15:00','2021-08-16','NdL-sbjIaOI'),(2,2,'00:15:00','2021-08-16','u_iKGzPZQoQ');
/*!40000 ALTER TABLE `tbl_recents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `v_id` int NOT NULL AUTO_INCREMENT,
  `v_url` varchar(250) NOT NULL,
  `v_date` date NOT NULL,
  `v_uni_no` bigint NOT NULL,
  `status` varchar(200) NOT NULL,
  `filter` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `v_desc` varchar(2000) NOT NULL,
  `length` varchar(20) NOT NULL,
  `cntlike` int DEFAULT '0',
  `cntdislike` int DEFAULT '0',
  `views` bigint unsigned NOT NULL,
  `cntcomment` int DEFAULT '0',
  `v_descr` varchar(200) NOT NULL,
  `language` varchar(20) NOT NULL,
  PRIMARY KEY (`v_id`),
  UNIQUE KEY `v_uni_no` (`v_uni_no`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (5,'7nUD_t23ZHQ','2021-07-30',2027920015622735,'created','FINE MOTOR SKILLS ','THUMB PAINTING - TEACHING KIDS HOW TO DRAW ANIMALS.','THUMB PAINTING - TEACHING KIDS HOW TO DRAW ANIMALS. Thumb painting activities make kids more inventive. In this activity, we draw different-different animals by using painting colours and our thumb. While doing this activity, we do not require a brush, so, it is safer for kids to use their thumbs. In which we also make children understand the importance of animal-loving.','01:42',2,1,1,5,'',''),(7,'Yv9YrfA3YEY','2021-07-30',4482536649151950,'created','FINE MOTOR SKILLS ','KITE MAKING - USING GRACE PAPER','Today we will be doing kite making activity. For this activity we need grace paper, Glue, broom stick and scissor. First we will cut the grace paper in the shape of kite the we will us grace paper and sticks to make a kite and glue to hold them together. This activity is fun and can be done with newspaper too if grace paper is unavailable.  ','02:31',1,0,0,5,'',''),(8,'hRk8PO_L6sU','2021-07-30',2021735501916720,'created','FINE MOTOR SKILLS ','LADY FINGER PAINTING - FLOWERS WITH HELP OF LADY FINGER','Kids will enjoy this activity while learning something new. For this activity we need, water color, painting brush, 1 white sheet of paper and 1 ladyfinger. With the help of lady finger we will draw flowers and at the end we will attach all of the flowers using painting brush. This activity is fun and help kids develop new skills. ','01:54',0,0,120,0,'',''),(9,'rNrdOgUUKhw','2021-07-30',9377736009577556,'created','FINE MOTOR SKILLS ','HOUSE CRAFT - MAKE HOUSE BY USING MATCH STICK','This activity is called match stick activity. For this activity we need few matchstick, glue, sketch pen and white paper. We will draw a house on the paper and then we will cover its outlines with match sticks. One this step is done we will then fill the color in the drawing with the help of sketch pen. This will develop both fine and gross motor skills in kids. ','03:44',0,0,0,0,'',''),(10,'68SvMoVGYEg','2021-07-30',2663402521195107,'created','FINE MOTOR SKILLS ','HONEY BEE CRAFT - USING GRACE PAPER','In this activity we will create a honeybee with the help of grace paper. This activity is fun. We will cut the grace paper and then paste it together. This activity should be done under elders supervision as this involves the usage of scissor. These kind of craft activities helps the child to develop aesthetic and creativity. ','02:30',0,0,18,0,'',''),(11,'JFAt0kuFBNA','2021-07-30',3524935854918151,'created','FINE MOTOR SKILLS ','HAND OUTLINE DRAW - COLOUR THE DRAWING','\"In this activity we will draw the picture of our hand. We need a white sheet and sketch pen for this activity. We have to put our hand on the paper and then simply mark the outline of our hand on the paper. once done we will fill color in the drawing. This activity improves the focus of child and fun to do. \"','01:00',0,0,0,0,'',''),(12,'SX1l3Lv0okw','2021-07-30',9144390298217508,'created','FINE MOTOR SKILLS ','HAND CHICKEN - BY USING WATER COLOURS','In this activity we will make a painting of chicken with our hand. We need white sheet, water color, sketch pen and paint brush. we will dip our palm in water color and press it against the white sheet. Same we will do with the thumb for chicks. This would be the structure of our chicken and then with the help of sketch pen and brush we will finish the painting. This activity will help kids to learn something new and help them be  more creative. ','02:23',1,0,0,2,'',''),(13,'KDYnCTZDcx8','2021-07-30',5710340144554480,'created','FINE MOTOR SKILLS ','FOOD MATERIALS PAINTING - MAKE SUN BY USING PULSES/GRAIN','We will make a sun in this activity by using pulses/grains. We need tape, white sheet, sketch pen and pulses for this activity. With the help of tape we will draw circle and then we will draw rays. Now with the help of pulses we will color it. This activity is fun and also helps kids to use their creativity. ','1.06',0,0,0,0,'',''),(15,'wht5gWU4FvE','2021-07-30',6271442941035923,'created','FINE MOTOR SKILLS ','FLAG MAKING - BY USING GRACE PAPER','For this activity we need a sheet, pencil, grace paper, erasers, scale, glue, and scissor. Fist we have to draw a flag on the sheet with pencil. The we will highlight the drawing with sketch pen. We will then put some glue on the flag and with the help of scissor we will cut the  grace paper and will fill the flag accordingly with it. ','02:12',2,1,0,0,'',''),(21,'2HazErTLkno','2021-07-30',4730957616051131,'free','FINE MOTOR SKILLS ','MAZE - FIND THE CORRECT ROUTE','A maze is a path or collection of paths, typically from an entrance to a goal. The word is used to refer both to branching tour puzzles through which the solver must find a route, and to simpler non-branching (\"unicursal\") patterns that lead unambiguously through a convoluted layout to a goal.','01:08',6,4,113,19,'',''),(22,'VOtuLz-IBb0','2021-07-30',7797188851110135,'free','FINE MOTOR SKILLS ','PAINTING OF FISH - BY USING BALLOON','In this activity we will draw a fish using balloons. We need a white sheet, balloons, water color and painting brush for this. Dip the balloon in color and press it against the sheet. You can use different balloons for different things. For water you can use blue color and for fish you can use any of your favorite color. Finish the drawing with painting brush. ','01:15',2,4,13,4,'',''),(23,'vADNcn9v8JA','2021-07-30',8483549564040275,'free','FINE MOTOR SKILLS ','PAPER SNAKE ACTIVITY - MAKE SNAKE USING GRACE PAPER','In this activity, we make a snake by folding papers like origami with the help of grace paper and glue. This activity improves the fine motor skills of the children.  ','03:34',5,4,1,0,'',''),(24,'GRQtIKCGoFk','2021-07-30',5368133619491872,'free','FINE MOTOR SKILLS ','PASTING ACTIVITY - DRAW A TREE USING COLOURFUL CARDS','n this pasting activity, we make a tree by using colourful cards. we need glue and a piece of colourful card. This activity will help kids develop cognitive and fine motor skills and kids will enjoy this while learning about colour.','01:16',3,4,7,2,'',''),(25,'FxPP4780f9k','2021-07-30',1331816913115884,'free','FINE MOTOR SKILLS ','PUZZLE ACTIVITY - IDENTIFY SIMILAR IMAGES','In this activity, we draw the different-different images on a sheet of paper. Once done, we will cut those images into pieces, then we will allow kids to join those images together and, this activity we called a puzzle activity. This activity increases the memory of the children.','01:29',3,4,0,0,'',''),(26,'hkstVuu4TJE','2021-07-30',0,'free','FINE MOTOR SKILLS','ORIGAMI - MAKE A PAPER BOAT','In this activity use of one\'s fingers improves fine motor skills and brain development. When doing origami we use our fingers to create specific shapes out of paper. In this video, we are learning how to make a boat with the help of paper.','02:27',4,2,0,0,'',''),(27,'YIgox4QBYMM','2021-07-30',1,'free','FINE MOTOR SKILLS','SHEEP CRAFT - DRAW SHEEP USING COTTON','We will make a sheep in this activity by using cotton. We need cotton, cardboard, a sketch pen and glue for this activity. With the help of a sketch pen, we will draw a sheep. Now with the help of cotton, we will fill the cotton on their body. This activity is fun and also helps kids to use their creativity.','00:46',5,3,6,0,'',''),(28,'5Ejea4TSIyQ','2021-07-30',2,'free','FINE MOTOR SKILLS','STICK PUPPET - USING WOODEN SPOON','We will make a puppet in this activity by using a wooden spoon. We need a wooden spoon, glue, a sketch pen and googly eyes for this activity. With the help of a wooden spoon, we will make a puppet. Now with the help of a spoon, we will colour it if you want. This activity is fun and also helps kids to use their creativity.','01:23',6,3,1,0,'',''),(29,'20PKqu77ej4','2021-07-30',3,'free','FINE MOTOR SKILLS','CHRISTMAS TREE - DECORATION OF CHRISTMAS TREE',' This activity is called Christmas tree. We need a glitter sheet, stars, sketch pen, glue and scissor for this. We will first draw a Christmas tree on a sheet and then cut it. Then we will draw some gifts on another sheet and cut them as well. At the end we will put glue on the tree and paste all the gifts on it.','02:25',4,3,0,0,'',''),(30,'ruEfQJS6DU4','2021-07-30',4,'free','FINE MOTOR SKILLS','DRAW UMBRELLA - BY USING PULSESGRAIN','We will make an umbrella in this activity by using pulses/grains. We need tape, a white sheet, a sketch pen and pulses for this activity. With the help of tape, we will draw an umbrella. Now with the help of pulses, we will colour it. This activity is fun and also helps kids to use their creativity.','02:19',3,3,2,4,'',''),(31,'6-9Simqxc8w','2021-07-30',5,'free','LEARNING DEVELOPMENT','PICTURE OF TRAFFIC LIGHT - RULES OF SIGNAL','This activity shows that how to draw traffic signals step by step. Because road safety is most important for every person, and we teach kids about the rules of the traffic light.','02:30',3,3,9,0,'',''),(32,'eEnubFAK0uc','2021-07-30',6,'free','LEARNING DEVELOPMENT','TRACING SKILLS - LEARNING COUNTING AND ALPHABETS.','Tracing activity helps kids to identify numbers and learn how to write them. In which we make the numbers and alphabets by dots on a blank white sheet. Once done, we will then allow the kids to trace these dots. While doing this activity, children will learn how to write and also improve their writing skills.','01:43',4,2,6,0,'',''),(33,'jGyG9a7pkTI','2021-07-30',7,'free','LEARNING DEVELOPMENT','IDENTIFICATION OF SHAPE - BY USING DRAWING AND NAME.',' This activity is called \'Identification of shapes\'. Draw some shapes on a paper and allow kids to identify the shapes. Once this is done then guide the kids to draw something using these shapes. Try to add multiple shapes in the drawing.','01:53',4,2,9,0,'',''),(34,'BhTgtkpszkQ','2021-07-30',8,'free','LEARNING DEVELOPMENT','COMPLETE THE PATTERN - IDENTIFICATION OF SIMILAR PATTERN',' This activity is called complete the pattern. Take a sheet and draw few unique patterns on it. Name each alphabetically .After that draw these same patterns in different order. Kids have to find and match 2 identical patterns. Once the pattern is matched name the pattern it is similar to. ','01:22',9,7,12,0,'',''),(35,'HSexHsZVMhc','2021-07-30',9,'free','LEARNING DEVELOPMENT','MATCH THE FOLLOWING - MATCHING PICTURES WITH THE LETTERS (activity-2)','Match the following activity to help kids to improve their pragmatic skills. In this activity, we will draw some images related to letters on one column of the white paper and write down the letters in each column on another side of the paper. We will then allow the kids to match the image with a starting letter of this image available in the opposite columns. This will help kids to understand the alphabet well.','01:48',15,5,4,0,'',''),(36,'https://www.youtube.com/watch?v=E490qP5TtQg','2021-09-25',6449799551818520,'free','','Universe - Planets, solar system - uranus | preschool education Learning for kids - Jugnu Kids','universe, planets and solar system are some favorite topic for kids to explore. Earth, sun, uranus, and  other planets in universe.','30:31',11,6,0,0,'',''),(75,'jz338fDC0aQ','2021-12-14',1383513983519377,'free','hello ','werwer','','',0,0,0,0,'',''),(76,'jz338fDC0aQ','2021-12-14',1383513983519374,'free','hello ','werwer','','15',0,0,0,0,'',''),(77,'ktjafK4SgWM','2021-12-14',2467949859533436,'free','testing','HelloTesting ','this is testing video','25',0,0,1,0,'',''),(80,'BDrweher','2022-01-20',2787455474255,'created','aswe','wawrer','','30',0,0,0,0,'',''),(81,'BDrweher','2022-01-20',278745547255,'created','aswe','wawrer','','30:20',0,0,0,0,'',''),(82,'ZmtLzRJh8n8','2022-04-01',7763283936669160,'created','trtrt','wrwer','rwerwe','30',0,0,1,0,'',''),(83,'ZmtLzRJh8n8','2022-04-01',3957002841299320,'free','lang','lan','lang','30',0,0,1,0,'',''),(84,'ZmtLzRJh8n8','2022-04-01',6930001778806067,'free','lang','lan','lang','30',0,0,1,0,'',''),(85,'ZmtLzRJh8n8','2022-04-01',4024746345761395,'free','lang','lang','lang','30:50',0,0,2,0,'','English');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webhook`
--

DROP TABLE IF EXISTS `webhook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8 */;
CREATE TABLE `webhook` (
  `imojo` varchar(50) NOT NULL,
  `payment_id` varchar(32) NOT NULL,
  `status` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `date_of_purchase` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_subs` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webhook`
--

LOCK TABLES `webhook` WRITE;
/*!40000 ALTER TABLE `webhook` DISABLE KEYS */;
INSERT INTO `webhook` VALUES ('MOJO5606427064044919','aef4e1cbd8274087981451c672f6c4c0','Credit','yashasvipundeer@gmail.com','+917668711341','testing','2021-08-10 10:31:55','2021-09-10'),('MOJO8877746782067174','11ad3f39bc5c4d59b35a2201929ad470','Credit','yashasvipundeer@gmail.com','+917668711341','testing','2021-08-10 10:31:55','2021-09-10'),('MOJO5702629198712542','a5014270ee484fe9b443add12bccb22c','Credit','yashasvipundeer@gmail.com','+917668711341','testing','2021-08-10 10:31:55','2021-09-10'),('MOJO4341279620210203','0e2cc226f642420aa8cf4d3ca18f7928','Credit','happy@gmail.com','+919997983617','testing','2021-09-10 00:00:00','2021-09-10'),('MOJO1810Q05A94811176','27d183b4f8f147e8b574aef3bfeef2bf','Credit','yashasvipundeer@gmail.com','+917668711341','testing','2021-08-10 10:31:55','2021-09-10'),('MOJO6260065916541766','b4857ace655442b1bc69d8795aeecfca','Credit','yashasvipundeer@gmail.com','+917668711341','testing','2021-08-10 11:01:27','2021-09-10'),('MOJO1720104508524038','af6b1b158af64741a44b0211a6f8c729','Credit','yashasvipundeer@gmail.com','+917668711341','testing','2021-08-10 11:08:53','2021-09-10'),('MOJO1810G05A94811250','a8488e39c69d4935871f0f5f6ef12582','Credit','sangeetamalviya08@gmail.com','+917668711341','SpacTube','2021-08-10 11:19:10','2021-09-10'),('MOJO7607397818037388','a8488e39c69d4935871f0f5f6ef12582','Credit','sangeetamalviya08@gmail.com','+917668711341','SpacTube','2021-08-10 11:20:21','2021-09-10'),('MOJO1810S05A94811269','6a13880c11af4445ad9a93fe036f1530','Credit','sangeetamalviya08@gmail.com','+917668711341','SpacTube','2021-08-10 11:26:24','2021-09-10'),('MOJO1810E05A94811276','4e28207f93104880a00bd768f4edb814','Credit','sangeetamalviya08@gmail.com','+917668711341','SpacTube','2021-08-10 11:31:53','2021-09-10'),('MOJO1810V05A94811295','df75d440157e472d98e765df01732573','Credit','sangeetamalviya08@gmail.com','+917668711341','SpacTube','2021-08-10 11:41:30','2021-09-10'),('MOJO2475283037321746','df75d440157e472d98e765df01732573','Credit','sangeetamalviya08@gmail.com','+917668711341','SpacTube','2021-08-10 11:57:05','2021-09-10'),('MOJO1813C05A98425840','58d252ed2162474196e67c4e59da65b8','Credit','parth@gmail.com','+917668711341','CONSULTANT FEE','2021-08-13 06:46:02',NULL),('MOJO9024099372522348','52849e75c8c6404c8a0dd556bd383175','Credit','parth@gmail.com','+917668711341','CONSULTANT FEE','2021-08-13 06:50:34',NULL),('MOJO5503614093486546','52849e75c8c6404c8a0dd556bd383175','Credit','parth@gmail.com','+917668711341','CONSULTANT FEE','2021-08-13 06:52:39',NULL),('MOJO2423122634703475','58d252ed2162474196e67c4e59da65b8','Credit','parth@gmail.com','+917668711341','CONSULTANT FEE','2021-08-13 06:53:14',NULL);
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

-- Dump completed on 2024-07-20 16:05:24
