-- MySQL dump 10.13  Distrib 5.1.66, for debian-linux-gnu (x86_64)
--
-- Host: mysql.dev.solidoodles.com    Database: doodles_dev
-- ------------------------------------------------------
-- Server version	5.1.56-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `thread` int(10) unsigned DEFAULT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `comment` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `soft_delete` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,NULL,NULL,14,NULL,'2013-06-26 08:06:44','2013-06-26 08:06:44',1),(2,NULL,NULL,14,NULL,'2013-06-26 08:09:10','2013-06-26 08:09:10',1),(3,72,NULL,14,NULL,'2013-06-26 08:13:38','2013-06-26 08:13:38',1),(4,72,NULL,14,NULL,'2013-06-26 08:15:16','2013-06-26 08:15:16',1),(5,72,NULL,14,'Let\'s try another comments test. Again!','2013-06-26 08:18:17','2013-06-26 08:18:17',1),(6,72,NULL,14,'Let\'s try another comments test. Again!','2013-06-26 08:20:30','2013-06-26 08:20:30',1),(7,72,NULL,14,'Let\'s try another comments test. Again!','2013-06-26 08:38:48','2013-06-26 08:38:48',1),(8,72,NULL,14,'Let\'s try another comments test. Again!','2013-06-26 08:46:55','2013-06-26 08:46:55',1),(9,72,NULL,14,'Let\'s try another comments test. Again!','2013-06-26 08:50:13','2013-06-26 08:50:13',0),(10,72,NULL,14,'Let\'s try another comments test. Again!','2013-06-26 08:52:05','2013-06-26 08:52:05',0),(11,72,NULL,14,'Let\'s try another comments test. Again!','2013-06-26 09:32:47','2013-06-26 09:32:47',0),(12,72,NULL,14,'trying this. ','2013-06-26 11:53:21','2013-06-26 11:53:21',0),(13,72,NULL,14,'trying this. ','2013-06-26 11:55:55','2013-06-26 11:55:55',1),(14,72,NULL,14,'trying this. ','2013-06-26 11:56:10','2013-06-26 11:56:10',0),(15,72,NULL,14,'change all? ','2013-06-26 11:56:34','2013-06-26 11:56:34',0),(16,72,NULL,14,'change all still ? ','2013-06-26 11:57:15','2013-06-26 11:57:15',0),(17,72,NULL,14,'change all still ? ','2013-06-26 12:01:02','2013-06-26 12:01:02',0),(18,72,NULL,14,'problem fixed?','2013-06-26 12:01:16','2013-06-26 12:01:16',0),(19,72,NULL,14,'post test','2013-06-26 15:02:23','2013-06-26 15:02:23',0),(20,72,NULL,14,'post test','2013-06-26 15:03:39','2013-06-26 15:03:39',0),(21,72,NULL,14,'post test','2013-06-26 15:05:31','2013-06-26 15:05:31',0),(22,72,NULL,14,'post test','2013-06-26 15:05:44','2013-06-26 15:05:44',0),(23,72,NULL,14,'post test','2013-06-26 15:05:52','2013-06-26 15:05:52',0),(24,72,NULL,14,'post test','2013-06-26 15:08:36','2013-06-26 15:08:36',0),(25,72,NULL,14,'post test','2013-06-26 15:08:54','2013-06-26 15:08:54',0),(26,72,NULL,14,'bob','2013-06-26 15:19:17','2013-06-26 15:19:17',0),(27,72,NULL,14,'bob','2013-06-26 15:19:59','2013-06-26 15:19:59',0),(28,72,NULL,14,'bob dole','2013-06-26 15:20:30','2013-06-26 15:20:30',0),(29,72,NULL,14,'flood check','2013-06-27 06:14:38','2013-06-27 06:14:38',0),(30,72,NULL,14,'flood check','2013-06-27 06:19:51','2013-06-27 06:19:51',0),(31,72,NULL,14,'flood check 2','2013-06-27 06:19:59','2013-06-27 06:19:59',0),(32,72,NULL,14,'flood check 3','2013-06-27 06:20:08','2013-06-27 06:20:08',0),(33,72,NULL,14,'flood check 3','2013-06-27 06:27:02','2013-06-27 06:27:02',0),(34,72,NULL,14,'flood check 3','2013-06-27 06:36:24','2013-06-27 06:36:24',1),(35,72,NULL,14,'flood check 4','2013-06-27 06:37:50','2013-06-27 06:37:50',1),(36,31,NULL,24,'This is a test comment.','2013-06-27 08:00:36','2013-06-27 08:00:36',0),(37,31,NULL,24,'I see your comment, and I raise you a comment.','2013-06-27 08:02:40','2013-06-27 08:02:40',0),(38,96,NULL,14,'&ltstrong&gt hello &lt/strong&gt there\r\n','2013-06-28 09:55:26','2013-06-28 09:55:26',0),(39,96,NULL,14,'&ltstrong&gt hello &lt/strong&gt there\r\n\r\n<script>\r\n\r\nalert();\r\n\r\n</script> \r\n','2013-06-28 09:56:49','2013-06-28 09:56:49',0),(40,96,NULL,14,'&ltstrong&gt hello &lt/strong&gt there\r\n\r\n<script>\r\n\r\nalert();\r\n\r\n</script> \r\n','2013-06-28 09:57:21','2013-06-28 09:57:21',0),(41,96,NULL,14,'&ltstrong&gt hello &lt/strong&gt there\r\n\r\n<script>\r\n\r\nalert();\r\n\r\n</script> \r\n\r\ntest test <div> \r\n','2013-06-28 09:58:18','2013-06-28 09:58:18',0),(42,96,NULL,14,'&ltstrong&gt hello &lt/strong&gt there\r\n\r\n<script>\r\n\r\nalert();\r\n\r\n</script> \r\n\r\ntest test <div> \r\n','2013-06-28 10:02:22','2013-06-28 10:02:22',0),(43,96,NULL,14,'&ltstrong&gt hello &lt/strong&gt there\r\n\r\n<script>\r\n\r\nalert();\r\n\r\n</script> \r\n\r\ntest test <div> \r\n','2013-06-28 10:09:52','2013-06-28 10:09:52',0),(44,96,NULL,14,'&ltstrong&gt hello &lt/strong&gt there\r\n\r\n<script>\r\n\r\nalert();\r\n\r\n</script> \r\n\r\ntest test <div> \r\n','2013-06-28 10:12:53','2013-06-28 10:12:53',0),(45,96,NULL,14,'bob dole \r\n\r\ntest test <div> \r\n','2013-06-28 10:14:35','2013-06-28 10:14:35',0),(46,96,NULL,14,'bob dole \r\n\r\n','2013-06-28 10:21:11','2013-06-28 10:21:11',0),(47,96,NULL,14,'bob dole \r\n\r\n','2013-06-28 10:22:18','2013-06-28 10:22:18',0),(48,96,NULL,14,'bob dole \r\n\r\n','2013-06-28 10:24:40','2013-06-28 10:24:40',0),(49,96,NULL,14,'bob dole \r\n\r\n','2013-06-28 10:25:11','2013-06-28 10:25:11',0),(50,NULL,NULL,14,'bob dole \r\n\r\n','2013-06-28 10:32:46','2013-06-28 10:32:46',0),(51,NULL,NULL,14,'bob dole !\r\n\r\n','2013-06-28 10:33:28','2013-06-28 10:33:28',0),(52,NULL,NULL,14,'bob dole !\r\n\r\n','2013-06-28 10:34:46','2013-06-28 10:34:46',0),(53,NULL,NULL,14,'bob dole is the best!\r\n\r\n','2013-06-28 10:35:13','2013-06-28 10:35:13',0),(54,NULL,NULL,14,'bob dole is the best!\r\n\r\n','2013-06-28 10:35:23','2013-06-28 10:35:23',0),(55,NULL,NULL,14,'bob dole is the best!\r\n\r\n','2013-06-28 10:35:55','2013-06-28 10:35:55',0),(56,96,NULL,14,'bob dole strikes back!','2013-06-28 10:37:15','2013-06-28 10:37:15',0),(57,96,NULL,14,'steve and larry','2013-06-28 10:37:26','2013-06-28 10:37:26',0),(58,70,NULL,14,'test\r\n','2013-07-02 14:33:04','2013-07-02 14:33:04',0),(59,70,NULL,14,'here we go again\r\n','2013-07-02 14:33:31','2013-07-02 14:33:31',0),(60,70,NULL,14,'here we go again\r\n','2013-07-02 14:35:03','2013-07-02 14:35:03',0),(61,70,NULL,14,'here we go again\r\n','2013-07-02 14:36:14','2013-07-02 14:36:14',0),(62,70,NULL,14,'here we go again\r\n','2013-07-02 14:41:49','2013-07-02 14:41:49',0),(63,70,NULL,14,'here we go again\r\n','2013-07-02 14:42:00','2013-07-02 14:42:00',0),(64,70,NULL,14,'here we go again\r\n','2013-07-02 14:50:57','2013-07-02 14:50:57',0),(65,70,NULL,14,'here we go again\r\n','2013-07-02 14:51:27','2013-07-02 14:51:27',0),(66,70,NULL,14,'here we go again\r\n','2013-07-02 14:52:46','2013-07-02 14:52:46',0),(67,69,NULL,14,'test\r\n','2013-07-03 06:39:54','2013-07-03 06:39:54',1),(68,69,NULL,14,'test\r\n','2013-07-03 06:51:05','2013-07-03 06:51:05',1),(69,69,NULL,14,'The comment that should be deleted ','2013-07-03 07:28:01','2013-07-03 07:28:01',1),(70,69,NULL,14,'More testing ','2013-07-03 08:00:04','2013-07-03 08:00:04',1),(71,133,NULL,14,'steve\r\n','2013-07-03 08:00:43','2013-07-03 08:00:43',1),(72,71,NULL,14,'bob','2013-07-03 08:39:06','2013-07-03 08:39:06',1),(73,71,NULL,14,'bob <b> bob </b>','2013-07-03 08:39:22','2013-07-03 08:39:22',0),(74,71,NULL,14,'bob <div> ','2013-07-03 08:43:17','2013-07-03 08:43:17',0),(75,71,NULL,14,'bob <div> ','2013-07-03 08:45:20','2013-07-03 08:45:20',0),(76,71,NULL,14,'bob <div> ','2013-07-03 08:45:41','2013-07-03 08:45:41',0),(77,71,NULL,14,'bob <div> ','2013-07-03 08:46:35','2013-07-03 08:46:35',0),(78,71,NULL,14,'bob <div> ','2013-07-03 08:52:20','2013-07-03 08:52:20',0),(79,71,NULL,14,'bob <div> ','2013-07-03 08:53:37','2013-07-03 08:53:37',0),(80,135,NULL,14,'tiz so l337 ','2013-07-05 11:43:40','2013-07-05 11:43:40',1),(81,69,NULL,28,'bob','2013-07-08 11:18:33','2013-07-08 11:18:33',1),(82,140,NULL,29,'BULL shit model. ban this dude!','2013-07-09 20:33:34','2013-07-09 20:33:34',0),(83,140,NULL,14,'david','2013-07-10 06:56:28','2013-07-10 06:56:28',1),(84,140,NULL,14,'david','2013-07-10 06:56:48','2013-07-10 06:56:48',1),(85,139,NULL,14,'comment','2013-07-10 06:58:50','2013-07-10 06:58:50',0);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `user` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `comments` varchar(800) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'plogin',14,'2013-06-18 12:25:40',NULL,'24.103.111.118');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_switches`
--

DROP TABLE IF EXISTS `master_switches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_switches` (
  `accounts` int(10) unsigned DEFAULT '0',
  `uploads` int(10) unsigned DEFAULT '0',
  `comments` int(10) unsigned DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_switches`
--

LOCK TABLES `master_switches` WRITE;
/*!40000 ALTER TABLE `master_switches` DISABLE KEYS */;
INSERT INTO `master_switches` VALUES (0,0,0,1);
/*!40000 ALTER TABLE `master_switches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pictures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `file_name` varchar(50) DEFAULT NULL,
  `model_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pictures`
--

LOCK TABLES `pictures` WRITE;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'The title','Let\'s try this ','2013-06-05 14:09:10','2013-06-06 07:23:25',NULL),(2,'A title once again','And the post body follows.','2013-06-05 14:09:45',NULL,NULL),(3,'Title strikes back','This is the really exciting! Not.','2013-06-05 14:10:19',NULL,NULL),(4,'I\'m a post! ','Postie postie postie','2013-06-06 07:15:07','2013-06-06 07:15:07',NULL),(5,'Guess what?','I\'m a bob cat! ','2013-06-06 09:29:22','2013-06-06 09:29:22',NULL),(6,'That\'s a great feeling','Me too','2013-06-06 09:31:38','2013-06-06 09:31:38',NULL),(7,'Hello World','Ta da!','2013-06-06 10:38:12','2013-06-06 10:38:12',19),(8,'Test test ','test','2013-06-06 11:59:02','2013-06-06 11:59:02',18);
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_body` varchar(30) DEFAULT NULL,
  `upload_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `uploads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `filetype` varchar(50) DEFAULT NULL,
  `numberofviews` int(10) unsigned DEFAULT '0',
  `numberofdownloads` int(10) unsigned DEFAULT NULL,
  `model_dir` varchar(255) DEFAULT NULL,
  `model` varchar(60) DEFAULT NULL,
  `owner` varchar(60) DEFAULT NULL,
  `license` varchar(30) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `default_picture` varchar(50) DEFAULT 'solidoodledefault.jpg',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=146 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
INSERT INTO `uploads` VALUES (31,'mrsaint','saintly','2013-06-11 13:55:58','2013-06-11 13:55:58',NULL,6,NULL,'31','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(32,'scale','model','2013-06-11 13:57:36','2013-06-11 13:57:36',NULL,5,NULL,'32','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(33,'dino','saur','2013-06-11 14:04:33','2013-06-11 14:04:33',NULL,1,NULL,'33','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(34,'kate','boslyn','2013-06-11 14:38:42','2013-06-11 14:38:42',NULL,1,NULL,'34','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(35,'cat','dog','2013-06-12 06:25:46','2013-06-12 06:25:46',NULL,1,NULL,'35','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(36,'steve','steve','2013-06-12 06:43:18','2013-06-12 06:43:18',NULL,1,NULL,'36','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(37,'mrmr','mrmr\r\n','2013-06-12 06:44:23','2013-06-12 06:44:23',NULL,1,NULL,'37','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(38,'mrmr','mrmr\r\n','2013-06-12 06:45:27','2013-06-12 06:45:27',NULL,1,NULL,'38','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(39,'mrmr','mrmr\r\n','2013-06-12 06:46:28','2013-06-12 06:46:28',NULL,1,NULL,'39','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(40,'mrmr','mrmr\r\n','2013-06-12 06:55:44','2013-06-12 06:55:44',NULL,1,NULL,'40','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(41,'jack','jack','2013-06-12 07:01:10','2013-06-12 07:01:10',NULL,1,NULL,'41','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(42,'jack','jack','2013-06-12 07:04:54','2013-06-12 07:04:54',NULL,1,NULL,'42','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(43,'jack','jack','2013-06-12 07:05:29','2013-06-12 07:05:29',NULL,1,NULL,'43','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(44,'john','mr','2013-06-12 07:07:07','2013-06-12 07:07:07',NULL,1,NULL,'44','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(45,'bang','can','2013-06-12 07:08:28','2013-06-12 07:08:28',NULL,3,NULL,'45','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(46,'steve','martin','2013-06-12 07:13:12','2013-06-12 07:13:12',NULL,1,NULL,'46','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(47,'newline','newline','2013-06-12 07:17:10','2013-06-12 07:17:10',NULL,1,NULL,'47','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(48,'newline','newline','2013-06-12 07:18:18','2013-06-12 07:18:18',NULL,1,NULL,'48','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(49,'crack','crack','2013-06-12 07:19:35','2013-06-12 07:19:35',NULL,1,NULL,'49','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(50,'bobby','cracy','2013-06-12 07:26:49','2013-06-12 07:26:49',NULL,2,NULL,'50','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(51,'steve','dave','2013-06-12 07:29:09','2013-06-12 07:29:09',NULL,1,NULL,'51','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(52,'terror','terror','2013-06-12 07:35:07','2013-06-12 07:35:07',NULL,1,NULL,'52','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(53,'terror','terror','2013-06-12 07:36:25','2013-06-12 07:36:25',NULL,1,NULL,'53','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(54,'modeldirtest','modeltestdir','2013-06-12 07:41:09','2013-06-12 07:41:09',NULL,1,NULL,'54','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(55,'modeldirtest','modeltestdir','2013-06-12 07:43:48','2013-06-12 07:43:48',NULL,1,NULL,'55','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(56,'idtest','idtest','2013-06-12 07:44:47','2013-06-12 07:44:47',NULL,1,NULL,'56','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(57,'nametest','nametest','2013-06-12 07:50:04','2013-06-12 07:50:04',NULL,1,NULL,'57','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(58,'dirtest','dirtest','2013-06-12 08:02:36','2013-06-12 08:02:36',NULL,1,NULL,'58','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(59,'dirdebug','dirdebug','2013-06-12 08:03:22','2013-06-12 08:03:22',NULL,1,NULL,'59','OHMSLAW_fixed.stl','1',NULL,NULL,'solidoodledefault.jpg'),(60,'momentoftruth','momentoftruth','2013-06-12 08:10:13','2013-06-12 08:10:13',NULL,1,NULL,'60','medal2untitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(61,'momentoftruth','momentoftruth','2013-06-12 08:11:29','2013-06-12 08:11:29',NULL,1,NULL,'61','medal2untitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(62,'ssddsdsds','sdssdsdsdsdsds','2013-06-12 08:39:39','2013-06-12 08:39:39',NULL,1,NULL,'62','medal2untitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(63,'ssddsdsds','sdssdsdsdsdsds','2013-06-12 08:40:15','2013-06-12 08:40:15',NULL,1,NULL,'63','medal2untitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(64,'ssddsdsds','sdssdsdsdsdsds','2013-06-12 08:41:32','2013-06-12 08:41:32',NULL,1,NULL,'64','medaluntitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(65,'sdsadsads','sadsdsadsadsads','2013-06-12 08:49:35','2013-06-12 08:49:35',NULL,1,NULL,'65','medal2untitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(66,'pldeepdkjelkd','sdfkdjfdlkfjdsflkjdflj','2013-06-12 08:52:10','2013-06-12 08:52:10',NULL,2,NULL,'66','medal2untitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(67,'Thenextmodel','I wanted to make a far more professional description for this particular model','2013-06-12 11:11:05','2013-06-12 11:11:05',NULL,2,NULL,'67','medal2untitled.stl','1',NULL,NULL,'solidoodledefault.jpg'),(68,'Adoodle','Adoodleforsure','2013-06-12 11:32:55','2013-07-01 13:39:24',NULL,11,NULL,'68','medal2untitled.stl','1',NULL,NULL,'68.png'),(69,'bobby','my name is bobby','2013-06-13 14:02:27','2013-07-01 13:38:55',NULL,279,NULL,'69','medaluntitled3.stl','1',NULL,NULL,'69.png'),(70,'editpriv','editpriv','2013-06-17 10:28:56','2013-07-02 13:18:11',NULL,22,NULL,'70','HeartBox01.stl','14',NULL,NULL,'70.png'),(71,'misterblue','misterblue','2013-06-17 14:31:51','2013-06-17 14:31:51',NULL,18,NULL,'71','pins.stl','1',NULL,NULL,'solidoodledefault.jpg'),(72,'pins','bunchofpins','2013-06-24 07:30:16','2013-06-24 07:30:16',NULL,190,NULL,'72','LidHeartBox01.stl','14','0',NULL,'solidoodledefault.jpg'),(134,'thefinalbob','a bob, sure enough','2013-07-05 10:58:46','2013-07-05 10:58:46',NULL,36,NULL,'134','medaluntitled3 - Copy - Copy - Copy - Copy.stl','14','1','1','solidoodledefault.jpg'),(137,'4thofjuly2','Bald Eagle','2013-07-05 14:26:48','2013-07-05 14:27:38',NULL,4,NULL,'137','Eagle.stl','14','0','3','137.png'),(145,'abc','abc','2013-07-10 14:01:23','2013-07-10 14:01:23',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,'solidoodledefault.jpg'),(95,'test','test','2013-06-28 09:52:39','2013-06-28 09:52:41',NULL,3,NULL,'95','&&&.stl','14','0',NULL,'95.png'),(96,'test','&lt strong &gt hello &lt / strong &gt','2013-06-28 09:54:21','2013-06-28 09:54:23',NULL,40,NULL,'96','LidHeartBox01 - Copy.stl','14','0',NULL,'96.png'),(97,'Bob','steve','2013-06-28 14:23:44','2013-06-28 14:24:01',NULL,6,NULL,'97','medaluntitled3 - Copy.stl','14','0',NULL,'97.png'),(144,'abc','abc','2013-07-10 13:47:39','2013-07-10 13:47:39',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,'solidoodledefault.jpg'),(143,'abc','abc','2013-07-10 13:47:02','2013-07-10 13:47:02',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,'solidoodledefault.jpg'),(142,'abc ','abc','2013-07-10 13:26:00','2013-07-10 13:26:00',NULL,0,NULL,NULL,NULL,NULL,NULL,NULL,'solidoodledefault.jpg'),(141,'Spool Mount','A great calibration print for your Solidoodle','2013-07-10 07:21:39','2013-07-10 07:22:18',NULL,5,NULL,'141','Spool Mount.stl','29','0','2','141.png'),(140,'Tesalation','bdagl;iajgrl;erslkdfjzrdrw;eldksrredssm/s\r\n\r\nIs there an instructions window, why can\'t I see more attribution in terms of creative commmons. Read a book dog, http://creativecommons.org/licenses/\r\n\r\nTHis mmodel was made fo fun!','2013-07-09 20:25:46','2013-07-09 20:32:02',NULL,14,NULL,'140','stelocta_tc_100705a.stl','29','0','3','140.png'),(139,'steve and bobby','No, really','2013-07-08 09:23:12','2013-07-10 14:47:57',NULL,9,NULL,'139','medaluntitled3 - Copy (2).stl','14','0','0','solidoodledefault.jpg'),(138,'4thofjuly3','4th of July keychain','2013-07-05 14:30:23','2013-07-05 14:30:23',NULL,2,NULL,'138','Keychain.stl','14','0','3','solidoodledefault.jpg'),(136,'4thofjuly1','it\'s the fourth! ','2013-07-05 14:10:20','2013-07-05 14:11:12',NULL,6,NULL,'136','Bracelet.stl','14','0','3','136.png'),(135,'Thetestforsamandraff','Bird and bees and tests for raff and sam. ','2013-07-05 11:37:56','2013-07-05 11:40:24',NULL,7,NULL,'135','medaluntitled3 - Copy - Copy - Copy - Copy - Copy - Copy.stl','14','0','1','135.png'),(133,'Theman','This model is a living testament to the man. Bask in his man like glory. ','2013-07-02 08:55:45','2013-07-02 08:58:12',NULL,6,NULL,'133','medaluntitled3 - Copy - Copy - Copy.stl','14','0','0','133.png'),(132,'thetrex','the trex is an awesome model','2013-07-02 08:09:15','2013-07-02 08:29:26',NULL,18,NULL,'132','medaluntitled3 - Copy - Copy.stl','14','0',NULL,'132.png');
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `numberofdoodles` int(10) unsigned DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `reset` varchar(100) DEFAULT NULL,
  `uses` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'bob','b9862204e25aa3bbcdf359188d9905ae984e0cc9','user','2013-06-07 08:39:06','2013-06-21 12:55:04',NULL,'example@example.com','cf4586f9797d358602563cb8a06038977f22c02b',NULL),(2,'bob','4c54eb9d098b8cf9c59756979e23305c426627bd','user','2013-06-07 08:40:20','2013-06-07 08:40:20',NULL,'example@example.com',NULL,NULL),(3,'bob','b9862204e25aa3bbcdf359188d9905ae984e0cc9','user','2013-06-07 08:40:57','2013-06-07 08:40:57',NULL,'example@example.com',NULL,NULL),(4,'bob','b9862204e25aa3bbcdf359188d9905ae984e0cc9','user','2013-06-07 08:42:05','2013-06-07 08:42:05',NULL,'example@example.com',NULL,NULL),(5,'bob','b9862204e25aa3bbcdf359188d9905ae984e0cc9','user','2013-06-07 08:42:42','2013-06-07 08:42:42',NULL,'example@example.com',NULL,NULL),(6,'bob','b9862204e25aa3bbcdf359188d9905ae984e0cc9','user','2013-06-07 08:43:21','2013-06-07 08:43:21',NULL,'example@example.com',NULL,NULL),(7,'steve','904bd8063b0afaa926e1444dcb6762882958e8b0','user','2013-06-07 08:45:02','2013-06-07 08:45:02',NULL,'example@example.com',NULL,NULL),(8,'steve','904bd8063b0afaa926e1444dcb6762882958e8b0','user','2013-06-07 08:57:10','2013-06-07 08:57:10',NULL,'example@example.com',NULL,NULL),(9,'bobcat','3fe67e52fcaf8eadd7def2df9570796169bcd25a','user','2013-06-07 09:20:00','2013-06-07 09:20:00',NULL,'bobbie@yahoo.com',NULL,NULL),(10,'stevejobs','46328fe661e2fb0120467cdac6266ee000d84b65','user','2013-06-07 09:36:06','2013-06-07 09:36:06',NULL,'bob@bob.com',NULL,NULL),(11,'carl','0dafc5d3d3b0ace9c26363c6a954409fd566024c','user','2013-06-07 11:23:40','2013-06-07 11:23:40',NULL,'bob@bob.com',NULL,NULL),(12,'mrcrabs','7d628d23bf74e572b85b83f7cd48f6e91c7f050b','user','2013-06-10 06:08:10','2013-06-10 06:08:10',NULL,'crabby@crabs.com',NULL,NULL),(13,'Sketch','28ee7b3d797368be6e0aacef75e79736d99b8934','user','2013-06-13 06:49:19','2013-06-13 06:49:19',NULL,'bob@solidoodle.com',NULL,NULL),(14,'baordog','b91330b583f617b0cb4bf53b420e3d81eb658548','admin','2013-06-13 10:41:36','2013-06-18 12:25:40',NULL,'freejazztampa@yahoo.com',NULL,NULL),(15,'randy','b0fde463b6d79105e3b4d0c497e7ef0c64151940','user','2013-06-13 10:46:59','2013-06-13 10:46:59',NULL,'randy@randy.com',NULL,NULL),(16,'carlton','881186499d83ec4200b79dabcde6d9b9b29400d8','user','2013-06-13 10:48:54','2013-06-13 10:48:54',NULL,'carlton@carlton.com',NULL,NULL),(17,NULL,'d583a710c2a261ea063b5df86959aeccde451489','user','2013-06-14 11:27:41','2013-06-14 11:27:41',NULL,'example@example.com',NULL,NULL),(18,NULL,'d583a710c2a261ea063b5df86959aeccde451489','user','2013-06-14 11:29:48','2013-06-14 11:29:48',NULL,'example@example.com',NULL,NULL),(19,NULL,'f0a998d9c680ed985eaa61df7cee5146fda7b697','user','2013-06-14 11:31:16','2013-06-14 11:31:16',NULL,'example@example.com',NULL,NULL),(20,NULL,'488ee2737b4c37f3100aaa56060bc3e797bc5bb9','user','2013-06-14 11:37:22','2013-06-14 11:37:22',NULL,'example@example.com',NULL,NULL),(21,NULL,'488ee2737b4c37f3100aaa56060bc3e797bc5bb9','user','2013-06-14 11:41:21','2013-06-14 11:41:21',NULL,'example@example.com',NULL,NULL),(22,NULL,'488ee2737b4c37f3100aaa56060bc3e797bc5bb9','user','2013-06-14 11:47:01','2013-06-14 11:47:01',NULL,'example@example.com',NULL,NULL),(23,NULL,'488ee2737b4c37f3100aaa56060bc3e797bc5bb9','user','2013-06-14 12:04:56','2013-06-14 12:04:56',NULL,'example@example.com',NULL,NULL),(24,'Sam','f28ef2ad09c587a898dd4cd6391d79c632da0ca8','user','2013-06-27 07:41:48','2013-06-27 07:41:48',NULL,'sam@solidoodle.com',NULL,NULL),(25,NULL,NULL,'user','2013-07-05 07:46:22','2013-07-05 07:46:22',NULL,NULL,NULL,NULL),(26,NULL,NULL,'user','2013-07-05 07:46:32','2013-07-05 07:46:32',NULL,NULL,NULL,NULL),(27,'barthsimpson','695d298d2088f3cd63ea3e2c593d4f308dce18ed','user','2013-07-05 11:48:28','2013-07-05 11:48:28',NULL,'bart@simpsons.org',NULL,NULL),(28,'misterjimbo','0ebe7ecb8e30e0bc51677e28acc6cf822dedb487','user','2013-07-08 11:07:25','2013-07-08 11:07:25',NULL,'jimbob@yahoo.com',NULL,NULL),(29,'Eelaffar','2f722fd15ed885ce33e6386d4168348adb647250','user','2013-07-09 19:59:05','2013-07-09 19:59:05',NULL,'raffaele@solidoodle.com',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-11  6:01:01
