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
  `date` datetime NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_launch_reports`
--

LOCK TABLES `app_launch_reports` WRITE;
/*!40000 ALTER TABLE `app_launch_reports` DISABLE KEYS */;
INSERT INTO `app_launch_reports` VALUES (1,2131165227,'2016-11-14 10:04:21','vbox86p','USA','3.10.0-genymotion-g1d178ae-dirty','Genymotion','Samsung Galaxy S4 - 4.4.4 - API 19 - 1080x1920','vbox86p',1920,1080,19,'0123456789abcdef');
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
  `date` datetime NOT NULL,
  `udid` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_usage_reports`
--

LOCK TABLES `app_usage_reports` WRITE;
/*!40000 ALTER TABLE `app_usage_reports` DISABLE KEYS */;
INSERT INTO `app_usage_reports` VALUES (1,'AddPost','2016-11-14 10:17:29','0123456789abcdef'),(2,'AddPost','2016-11-14 10:17:29','0123456789abcdef'),(3,'AddPost','2016-11-14 10:17:29','0123456789abcdef');
/*!40000 ALTER TABLE `app_usage_reports` ENABLE KEYS */;
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

-- Dump completed on 2016-11-14 20:31:40
