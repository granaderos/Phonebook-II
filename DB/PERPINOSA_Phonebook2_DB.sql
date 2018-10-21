-- MySQL dump 10.13  Distrib 5.5.8, for Linux (i686)
--
-- Host: localhost    Database: PERPINOSA_Phonebook3_DB
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friends` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `self` int(11) DEFAULT NULL,
  `friend` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `self` (`self`),
  KEY `friend` (`friend`),
  CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`self`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friends`
--

LOCK TABLES `friends` WRITE;
/*!40000 ALTER TABLE `friends` DISABLE KEYS */;
INSERT INTO `friends` VALUES (75,10,12),(76,13,10),(77,13,12),(78,12,10),(79,12,13);
/*!40000 ALTER TABLE `friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `liker` varchar(100) DEFAULT NULL,
  `sharer` int(11) DEFAULT NULL,
  `names` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `liked_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (54,'MAREJEAN GRANADEROS PERPINOSA',12,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','1-10-2013 10:53 AM');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phonebook_entries`
--

DROP TABLE IF EXISTS `phonebook_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phonebook_entries` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(100) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL,
  `owner` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phonebook_entries`
--

LOCK TABLES `phonebook_entries` WRITE;
/*!40000 ALTER TABLE `phonebook_entries` DISABLE KEYS */;
INSERT INTO `phonebook_entries` VALUES (42,'jean','09107985432','geralyn'),(43,'jean','091079865432','geralyn'),(44,'jean','091079865432','geralyn'),(45,'jean','091079865432','geralyn'),(46,'mariz advincula','09482095784','geralyn'),(47,'mariz advincula','09482095784','geralyn'),(48,'dsgfd','45345','geralyn'),(54,'jean','09','marejean'),(56,'yhu','j7868','marejean'),(57,'gfvbh','gfv7y67867','p'),(58,'dvfds','65465','p'),(59,'fdsgf','546546','marejean'),(60,'mj','546546','marejean'),(61,'dvfds','65465','marejean'),(62,'dvfds','65465','marejean'),(63,'jean','09','marejean'),(64,'jean','091079865432','marejean'),(65,'dvfds','65465','marejean'),(66,'jean','09','marejean'),(67,'jean','09','marejean'),(68,'mmmmmmm','000000000','marejean'),(69,'jean','09','marejean'),(70,'dddddddddddddddddd','111111111111','marejean'),(72,'jean','091079865432','marejean'),(73,'jean','09','marejean'),(74,'dvfds','65465','marejean'),(76,'jjjjjjjjjjjjjjjjjjjjjj','4534','marejean'),(77,'shared','09887','geralyn'),(78,'jjjjjjjjjjjjjjjjjjjjjj','4534','geralyn'),(79,'jjjjjjjjjjjjjjjjjjjjjj','4534','geralyn'),(80,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','marejean'),(81,'shared','09887','marejean'),(82,'shared','09887','marejean'),(83,'shared','09887','marejean'),(84,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','geralyn'),(85,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','geralyn'),(86,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','geralyn'),(87,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','cherrymae'),(88,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','cherrymae'),(89,'wwwwwwwwwwwwwwwwwwwwwwwwwww','222222222222222','geralyn'),(90,'jjjjjjjjjjjjjjjjjjjjjj','4534','geralyn'),(91,'dapat','09876','geralyn'),(92,'timeeeeee','4546','marejean');
/*!40000 ALTER TABLE `phonebook_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phonebook_entries_to_user`
--

DROP TABLE IF EXISTS `phonebook_entries_to_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phonebook_entries_to_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `link_to_users` (`user_id`),
  KEY `link_to_phonebook_entries` (`contact_id`),
  CONSTRAINT `link_to_phonebook_entries` FOREIGN KEY (`contact_id`) REFERENCES `phonebook_entries` (`contact_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `link_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phonebook_entries_to_user`
--

LOCK TABLES `phonebook_entries_to_user` WRITE;
/*!40000 ALTER TABLE `phonebook_entries_to_user` DISABLE KEYS */;
INSERT INTO `phonebook_entries_to_user` VALUES (25,42,13),(26,43,13),(27,44,13),(28,45,13),(29,46,13),(30,47,13),(31,48,13),(37,54,10),(39,56,10),(40,57,14),(41,58,14),(42,59,10),(43,60,10),(44,58,10),(45,57,10),(46,68,10),(47,69,10),(48,70,10),(50,72,10),(51,73,10),(52,74,10),(54,76,10),(55,77,13),(56,78,13),(57,79,13),(58,80,10),(59,81,10),(60,82,10),(61,83,10),(62,84,13),(63,85,13),(64,86,13),(65,87,12),(66,88,12),(67,89,13),(68,90,13),(69,91,13),(70,92,10);
/*!40000 ALTER TABLE `phonebook_entries_to_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saves`
--

DROP TABLE IF EXISTS `saves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saver` varchar(100) DEFAULT NULL,
  `sharer` int(11) DEFAULT NULL,
  `names` varchar(100) DEFAULT NULL,
  `contact_number` varchar(10) DEFAULT NULL,
  `saved_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saves`
--

LOCK TABLES `saves` WRITE;
/*!40000 ALTER TABLE `saves` DISABLE KEYS */;
/*!40000 ALTER TABLE `saves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shared_phonebook_entries`
--

DROP TABLE IF EXISTS `shared_phonebook_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shared_phonebook_entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shared_by_id` int(11) DEFAULT NULL,
  `shared_to_id` int(11) DEFAULT NULL,
  `shared_contact_id` int(11) DEFAULT NULL,
  `shared_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shared_phonebook_entries`
--

LOCK TABLES `shared_phonebook_entries` WRITE;
/*!40000 ALTER TABLE `shared_phonebook_entries` DISABLE KEYS */;
INSERT INTO `shared_phonebook_entries` VALUES (97,10,12,56,'1-10-2013 10:08 AM'),(98,12,10,88,'1-10-2013 10:08 AM'),(99,12,10,88,'1-10-2013 10:15 AM');
/*!40000 ALTER TABLE `shared_phonebook_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'MAREJEAN','GRANADEROS','PERPINOSA','female',16,'marejean','marejean'),(11,'JENNILYN','RAMIREZ','ORION','female',17,'jennilyn','jennilyn'),(12,'CHERRY MAE','PERPINOSA','MONTAJES','female',15,'cherrymae','cherrymae'),(13,'GERALYN ','GRANADEROS','PERPINOSA','female',28,'geralyn','geralyn'),(14,'prince','khjh','jhjh','female',79,'p','p'),(15,'jen','r','or','female',2124,'ayeah','1'),(16,'greg','greg','greg','male',2121,'greg','greg'),(17,'she','she','she','female',17,'she','*B6ADF69F7C906DB167F8E56DF325AB601BAEB1A1');
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

-- Dump completed on 2013-01-10 11:10:14
