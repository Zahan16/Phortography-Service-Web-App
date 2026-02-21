-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: lismoredb
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_login` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_name` (`admin_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_login`
--

LOCK TABLES `admin_login` WRITE;
/*!40000 ALTER TABLE `admin_login` DISABLE KEYS */;
INSERT INTO `admin_login` VALUES (2,'admin1','$2y$10$zvkxdh4O9sq.SyVAlTRU.OHa5g5nz3Omesa.MD1c08QHDhIWNjqvS'),(3,'admin2','$2y$10$AhkftGCBXdYoDD4rGH1jauMp1ehHhdUYi7t0t79GylvGtoyx1FLv2'),(5,'admin3','$2y$10$3iDz56x24.XSQ2v7VW0cNOThtqRiTMJb3NZU4Izw57T6B5n7ojCoy'),(6,'admin','$2y$10$reVGD79CGb6woKMTMqknZ.O13C4mGAxFm8bfJAnW.RtQliV/Lvvke');
/*!40000 ALTER TABLE `admin_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_inquiry`
--

DROP TABLE IF EXISTS `client_inquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_inquiry` (
  `Inquiry_ID` int(6) unsigned NOT NULL,
  `Client_Name` varchar(60) NOT NULL,
  `Client_Email` varchar(60) NOT NULL,
  KEY `Inquiry_ID` (`Inquiry_ID`),
  CONSTRAINT `client_inquiry_ibfk_1` FOREIGN KEY (`Inquiry_ID`) REFERENCES `inquiries` (`Inquiry_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_inquiry`
--

LOCK TABLES `client_inquiry` WRITE;
/*!40000 ALTER TABLE `client_inquiry` DISABLE KEYS */;
/*!40000 ALTER TABLE `client_inquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gallery` (
  `Gallery_ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Gallery_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Gallery_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
INSERT INTO `gallery` VALUES (2,'Weddings'),(3,'Portraits'),(4,'Events');
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inquiries`
--

DROP TABLE IF EXISTS `inquiries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inquiries` (
  `Inquiry_ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Service_ID` int(6) unsigned NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Function_Date` date NOT NULL,
  `Inquiry` varchar(1500) NOT NULL,
  PRIMARY KEY (`Inquiry_ID`),
  KEY `Service_ID` (`Service_ID`),
  CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`Service_ID`) REFERENCES `services` (`Service_ID`),
  CONSTRAINT `inquiries_ibfk_2` FOREIGN KEY (`Service_ID`) REFERENCES `services` (`Service_ID`),
  CONSTRAINT `inquiries_ibfk_3` FOREIGN KEY (`Service_ID`) REFERENCES `services` (`Service_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inquiries`
--

LOCK TABLES `inquiries` WRITE;
/*!40000 ALTER TABLE `inquiries` DISABLE KEYS */;
INSERT INTO `inquiries` VALUES (6,'aa','abc@gmail.com',1,'xyz','2024-08-19','Hiii'),(7,'Sahan','sahannawa16@gmail.com',1,'asc','2024-08-30','aaaaa'),(8,'Sahan','xyz@gmail.com',1,'Ragama','2024-09-01','Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum ex dolorem nostrum sed maxime, qui iure quia commodi id, quasi, culpa tempore quos facere. Saepe voluptatibus nobis facilis soluta assumenda.');
/*!40000 ALTER TABLE `inquiries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `Package_ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Service_ID` int(6) unsigned NOT NULL,
  `Package_Name` varchar(100) NOT NULL,
  `Package_Price` double(6,2) NOT NULL,
  PRIMARY KEY (`Package_ID`),
  KEY `Service_ID` (`Service_ID`),
  CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`Service_ID`) REFERENCES `services` (`Service_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photographer`
--

DROP TABLE IF EXISTS `photographer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photographer` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `facebook` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photographer`
--

LOCK TABLES `photographer` WRITE;
/*!40000 ALTER TABLE `photographer` DISABLE KEYS */;
/*!40000 ALTER TABLE `photographer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photos` (
  `Photo_ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Gallery_ID` int(6) unsigned DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `File_Name` varchar(100) NOT NULL,
  `Date_uploaded` date DEFAULT NULL,
  PRIMARY KEY (`Photo_ID`),
  KEY `Gallery_ID` (`Gallery_ID`),
  CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`Gallery_ID`) REFERENCES `gallery` (`Gallery_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photos`
--

LOCK TABLES `photos` WRITE;
/*!40000 ALTER TABLE `photos` DISABLE KEYS */;
INSERT INTO `photos` VALUES (20,2,'Wedding 1','668142e3c441f-W1.jpg','2024-06-30'),(21,2,'Wedding 2','668143fea511a-one-zone-studio-iI_SdgYHWF0-unsplash.jpg','2024-06-30'),(23,4,'Event 1','6681442b69c34-mitchell-orr---LyFIjXoFY-unsplash.jpg','2024-06-30'),(24,4,'Event 2','668144416b756-kateryna-hliznitsova-ocb4ft1qyjA-unsplash.jpg','2024-06-30'),(25,4,'Event 3','668144520ea6f-aditya-chinchure-ZhQCZjr9fHo-unsplash.jpg','2024-06-30'),(27,2,'Wedding 3','66814657b45ea-sasa-petrovic-CEa3F_sPvqg-unsplash.jpg','2024-06-30'),(32,3,'Portrait 7','66cc92aac3811-pexels-guilhermealmeida-1858175.jpg','2024-08-26'),(33,3,'Portrait 8','66cc9346ef80a-pexels-vinicius-wiesehofer-289347-1130626.jpg','2024-08-26'),(34,3,'Portrait 9','66cc936008cda-pexels-creationhill-1681010.jpg','2024-08-26'),(35,3,'Portrait 10','66cc937c6b9b8-pexels-thgusstavo-1933873.jpg','2024-08-26'),(37,4,'Event 4','66cc94cad1540-pexels-thfotodesign-1230397.jpg','2024-08-26'),(38,4,'Event 5','66cc94e3a87fc-pexels-hygor-sakai-1214427-2311713.jpg','2024-08-26'),(39,4,'Event 6','66cc94f9674b5-pexels-rovenimages-com-344613-949592.jpg','2024-08-26'),(40,4,'Event 7','66cc95bed933a-pexels-trinitykubassek-341858.jpg','2024-08-26'),(42,4,'Event 8','66cc961f65e83-pexels-sebastian-ervi-866902-1763075.jpg','2024-08-26'),(43,2,'Wedding 4','66cc96c3dd4c9-pexels-asadphoto-1024993.jpg','2024-08-26'),(44,2,'Wedding 5','66cc96da6498e-pexels-rocsana99-948185.jpg','2024-08-26'),(46,2,'Wedding 6','66cc972022a37-pexels-weddingphotography-1444442.jpg','2024-08-26'),(47,2,'Wedding 7','66cc973254109-pexels-solliefoto-313707.jpg','2024-08-26'),(49,2,'Wedding 8','66cc97844c316-pexels-minan1398-758898.jpg','2024-08-26'),(50,3,'Portrait 11','66d3372d4d58d-pexels-pixabay-415829.jpg','2024-08-31'),(51,2,'Wedding 9','66d3388e37d99-pexels-pham-hoang-kha-1582786-3785644.jpg','2024-08-31'),(52,4,'Event 9','66d33b1aab3fc-pexels-pavel-danilyuk-7180617.jpg','2024-08-31');
/*!40000 ALTER TABLE `photos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `Service_ID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `Service_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Service_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Portrait'),(2,'Wedding'),(3,'Event');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-21 14:22:59
