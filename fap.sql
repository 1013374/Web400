-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: fap
-- ------------------------------------------------------
-- Server version	5.1.49-1ubuntu8

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
-- Table structure for table `cookies`
--

DROP TABLE IF EXISTS `cookies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cookies` (
  `team_id` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cookies`
--

LOCK TABLES `cookies` WRITE;
/*!40000 ALTER TABLE `cookies` DISABLE KEYS */;
INSERT INTO `cookies` VALUES (1,'a0ede606fa000c68b81ee0f598877a0c'),(2,'da2e3d760c1c8a1f20cc1c1c07348fa9'),(3,'a182c3677310a6bcd5a702dc73d192de'),(4,'963992cfa94184c59ae55d5c648168f7'),(5,'4d8ba391e0c58260060039616913539c'),(6,'e40328c52c8375f7002ef9a83c77e964'),(7,'dacbbd298080acb39f71de1a3fa2c970'),(8,'97137582bec3d453c1364db28c2df2fd'),(9,'8099fb5205efd890a4636cf624ac539d'),(10,'82e9ec9f11da0bf292300d88654c4fbb'),(11,'e667208ce9a83c7a10d3c4d9839b3e83'),(12,'6b5e62df6ff38a7aa627c4034e6c56be'),(13,'bad1d93500fa242104f901c9b5ff45ac'),(14,'6aa02e5ebda896286f159f6941e8b92f'),(15,'47381a192756052c593e249bd4e133ea'),(16,'b237ca31b66ea619a6dfae7b80cd5741'),(17,'f723c3b4379cbc6d2e2333726d1a1fb4'),(18,'1d985eab33996a1ca1ef6d9c79cd1f3d'),(19,'39db87c13fb0b2a350d4b14c1efb479c'),(20,'2420ef9ed984ecc5fda5bb98aa935412'),(21,'cdfb99b1195af6ea1a26d9c55d0f7182'),(22,'b4017f5c5a9617bff888aa75898bb787'),(23,'75a529ac346ca44cbd636f98615606e6'),(24,'68aec061c257da4962afbdef345feee9'),(25,'e6360477b8a537d8a3178fcdd52bfd9f'),(26,'401acfabfc557d8eb80e5a3b073619a2'),(27,'01642e70cc51ed6fc6c8e098f73c2163'),(28,'92eb26bd9ca21f71080c580a1a77f83a'),(29,'ff3ed527f6f3c227470b3242ea9ef4d7'),(30,'b3f4806522b168f25d57fb7aa78814f3'),(31,'d22278529040aa75298761e67ac1f4ad'),(32,'4cec71450b0538ae3de10f02a5ab1d83'),(33,'7783db53d1d7fc0ddc3a0902a58fdfeb');
/*!40000 ALTER TABLE `cookies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `abbv` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `old_price` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,'Lulzsec Inc.','LULZ','blah blah blah',1,'1'),(2,'Team Poison','POIS','blah',1,'1'),(3,'HBGary','HBG','blah',1,'1'),(4,'Sony','SONY','blah',1,'1'),(5,'Anonymous','ANON','blah',1,'1'),(6,'Uberleakz','UBER',NULL,1,'1'),(7,'Wikileaks','WIKI',NULL,1,'1'),(8,'Lulzraft','RAFT',NULL,1,'1'),(9,'Backtrace Security','BTRC',NULL,1,'1'),(10,'T3HJ35T3R','JEST',NULL,1,'1'),(11,'Gawker','GAWK',NULL,1,'1'),(12,'Chaos Computer Club','CCC',NULL,1,'1'),(13,'HackMiami','HMIA',NULL,1,'1'),(14,'Cripsec','CRIP',NULL,1,'1');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks_owned`
--

DROP TABLE IF EXISTS `stocks_owned`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks_owned` (
  `u_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`u_id`,`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks_owned`
--

LOCK TABLES `stocks_owned` WRITE;
/*!40000 ALTER TABLE `stocks_owned` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocks_owned` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logs`
--

DROP TABLE IF EXISTS `user_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(100) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `team_name` varchar(100) DEFAULT NULL,
  `hijacking_team` varchar(100) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `object_type` varchar(50) DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `created` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logs`
--

LOCK TABLES `user_logs` WRITE;
/*!40000 ALTER TABLE `user_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `news_stream` varchar(500) DEFAULT NULL,
  `old` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Free Radicals','freeradicalscausecancer1138','1000',NULL,NULL),(2,'diabl0','whynohttps','1000',NULL,NULL),(3,'0xDEADCAFE','$qmU6tw,zd-6<E%7.+?Di/1A31KVs;','1000',NULL,NULL),(4,'knytetyme','F33eny9Ym{oP','1000',NULL,NULL),(5,'Pukimakz','omgwtfbbq','1000',NULL,NULL),(6,'Mostly Harmless','Blabla12','1000',NULL,NULL),(7,'WCSC','WC$Cf0rth3w1n!#','1000',NULL,NULL),(8,'sharp','salmon101','1000',NULL,NULL),(9,'vImeDhuSocHbarN','nuTarViDom','1000',NULL,NULL),(10,'Three Burritos in Sombreros','d9RxFYO9AY','1000',NULL,NULL),(11,'Team Venture','fuzzyk1tt3ns','1000',NULL,NULL),(12,'B00TZ','k33p0nknockenth3mb00tz!','1000',NULL,NULL),(13,'disekt','4n3asyp4ss','1000',NULL,NULL),(14,'nuckphuts','W3lc0m310','1000',NULL,NULL),(15,'ShenHsiehTeam','finallybrokenit','1000',NULL,NULL),(16,'Neg9','kityinthecity','1000',NULL,NULL),(17,'sharps','hella hot chicks ','1000',NULL,NULL),(18,'vand','CpSYGm0R4giyFws36iUP','1000',NULL,NULL),(19,'5emaPh00ls','5emaPh00ls','1000',NULL,NULL),(20,'DC949','i0wn949','1000',NULL,NULL),(21,'Destroy Destroy Destroy','97LDT4lt9L6ThhHUHWTZ','1000',NULL,NULL),(22,'Blue Falcon','US@F@cwc2011!','1000',NULL,NULL),(23,'Scrambles ','iamtoosexyformyshirt!123','1000',NULL,NULL),(24,'My Little Pwnies','Witpi!1','1000',NULL,NULL),(25,'AK41s','crackmedc!','1000',NULL,NULL),(26,'quesoburguesa','foA?ou?rlUs#oe','1000',NULL,NULL),(27,'I Am a Fugitive from a ROP Chain Gang','craft5tix','1000',NULL,NULL),(28,'CATSecurity','tjxmdlqslek','1000',NULL,NULL),(29,'BYU PenTesting','FvcDJ;FD3(#Jju@#hF*E8mcemw','1000',NULL,NULL),(30,'CATSecurity1','tjxmdlqslek','1000',NULL,NULL),(31,'pwn2own','bagandtag23','1000',NULL,NULL),(32,'Keysec','aaaaaaa','1000',NULL,NULL),(33,'UNIXcorn','CnjmLqeU1a!','1000',NULL,NULL);
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

-- Dump completed on 2011-08-02 17:30:05
