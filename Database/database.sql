-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: libromate
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `bid` varchar(15) NOT NULL,
  `bname` varchar(40) NOT NULL,
  `author` varchar(30) NOT NULL,
  `owner` varchar(15) NOT NULL,
  `trash` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`bid`),
  KEY `owner` (`owner`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES ('b18041523011648','Harry Potter','J.K Rowling','u18041523005424',0),('b18041523012820','Zero To One','Peter Thiel','u18041523005424',0),('b18041523021949','The Intelligent Investor','Benjamin Graham','u18041523005424',0),('b18041523024420','The Lord Of The Rings','J. R. R. Tolkien','u18041523005424',0),('b18041523030417','A Tale Of Two Cities	','Charles Dickens','u18041523005424',0),('b18041523042106','Too Big To Fail','Andrew Ross Sorkin','u18041523032768',0),('b18041523051252','The End Of Wall Street','Roger Lowenstein','u18041523032768',0),('b18041523054790','The Big Short','Michael Lewis','u18041523032768',0),('b18041523075548','The Diary Of A Young Girl','Anne Frank','u18041523032768',0),('b18041523084596','The Book Thief','Markus Zusak','u18041523032768',0);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `bid` varchar(15) DEFAULT NULL,
  `from_user` varchar(15) NOT NULL,
  `to_user` varchar(15) NOT NULL,
  `sn` tinyint(1) DEFAULT '0',
  `rn` tinyint(1) DEFAULT '0',
  `status` char(1) DEFAULT '0',
  KEY `bid` (`bid`),
  KEY `from_user` (`from_user`),
  KEY `to_user` (`to_user`),
  CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`bid`) REFERENCES `books` (`bid`),
  CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES ('b18041523012820','u18041523032768','u18041523005424',0,0,'1'),('b18041523024420','u18041523032768','u18041523005424',0,0,'1'),('b18041523084596','u18041523005424','u18041523032768',1,0,'1'),('b18041523054790','u18041523005424','u18041523032768',1,0,'1');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `points` smallint(6) DEFAULT '10',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('u18041523005424','user1','user1','e10adc3949ba59abbe56e057f20f883e',1234567890,'user1@gmail.com',0,23),('u18041523032768','user2','user2','e10adc3949ba59abbe56e057f20f883e',987654321,'user2@gmail.com',0,24);
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

-- Dump completed on 2018-04-15 23:19:07
