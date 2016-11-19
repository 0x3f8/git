-- MySQL dump 10.13  Distrib 5.7.16, for Linux (x86_64)
--
-- Host: localhost    Database: sprusage
-- ------------------------------------------------------
-- Server version	5.7.11-0ubuntu6

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
-- Table structure for table `app_launch_reports`
--

DROP TABLE IF EXISTS `app_launch_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_launch_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appVersion` int(11) NOT NULL,
  `date` date NOT NULL,
  `device` varchar(32) NOT NULL,
  `locale` varchar(128) NOT NULL,
  `lversion` varchar(128) NOT NULL,
  `manuf` varchar(128) NOT NULL,
  `model` varchar(128) NOT NULL,
  `product` varchar(128) NOT NULL,
  `screenDensityH` int(11) NOT NULL,
  `screenDensityW` int(11) NOT NULL,
  `sdkint` int(11) NOT NULL,
  `udid` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_launch_reports`
--

LOCK TABLES `app_launch_reports` WRITE;
/*!40000 ALTER TABLE `app_launch_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_launch_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_usage_reports`
--

DROP TABLE IF EXISTS `app_usage_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_usage_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(32) NOT NULL,
  `date` date NOT NULL,
  `udid` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_usage_reports`
--

LOCK TABLES `app_usage_reports` WRITE;
/*!40000 ALTER TABLE `app_usage_reports` DISABLE KEYS */;
INSERT INTO `app_usage_reports` VALUES (14,'activity1','2016-11-18','abcdefgh'),(15,'activity2','2016-11-18','CUT_TEXT'),(16,'CUT_TEXT','2016-11-18','udid1234'),(17,'SELECT_ALL','2016-11-18','udid1234'),(18,'DELETE_FILE','2016-11-18','udid1234'),(19,'SELECT_ALL','2016-11-18','udid4321'),(20,'EXIT','2016-11-18','udid4321'),(21,'CUT_TEXT','2016-11-17','udid1234'),(22,'USE_VIM','2016-11-17','udid1234'),(23,'DELETE_VIM','2016-11-17','udid1234'),(24,'USE_EMACS','2016-11-17','udid1234'),(25,'RUN_MALWARE','2016-11-17','udid4321'),(26,'RUN_MALWARE_AGAIN','2016-11-17','udid4321'),(27,'TRY_TO_DELETE_MALWARE','2016-11-17','udid4321'),(28,'CUT_TEXT','2016-11-18','udid1234'),(29,'SELECT_ALL','2016-11-18','udid1234'),(30,'SELECT_ALL','2016-11-18','udid4321'),(31,'EXIT','2016-11-18','udid4321'),(32,'CUT_TEXT','2016-11-17','udid1234'),(33,'USE_VIM','2016-11-17','udid1234'),(34,'DELETE_VIM','2016-11-17','udid1234'),(35,'USE_EMACS','2016-11-17','udid1234'),(36,'RUN_MALWARE','2016-11-17','udid4321'),(37,'RUN_MALWARE_AGAIN','2016-11-17','udid4321'),(38,'TRY_TO_DELETE_MALWARE','2016-11-17','udid4321');
/*!40000 ALTER TABLE `app_usage_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` varchar(36) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text,
  `outfile` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES ('d469c237-b828-4d4d-bce6-d579b0873f2b','report-d469c237-b828-4d4d-bce6-d579b0873f2b','Report generated @ 2016-11-18 22:15:06','out/d469c237-b828-4d4d-bce6-d579b0873f2b'),('d71a8856-2522-410d-9282-3af3ac620ff3','report-d71a8856-2522-410d-9282-3af3ac620ff3','Report generated @ 2016-11-18 22:14:53','out/d71a8856-2522-410d-9282-3af3ac620ff3');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'administrator','KeepWatchingTheSkies'),(1,'guest','busyllama67');
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

-- Dump completed on 2016-11-18 22:18:55
