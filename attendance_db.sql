-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: attendance_db
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
  `student_id` int NOT NULL,
  `eventid` int NOT NULL,
  `timein_am` datetime DEFAULT NULL,
  `timeout_am` datetime DEFAULT NULL,
  `timein_pm` datetime DEFAULT NULL,
  `timeout_pm` datetime DEFAULT NULL,
  PRIMARY KEY (`student_id`,`eventid`),
  KEY `studentid_idx` (`student_id`),
  KEY `eventid_idx` (`eventid`),
  CONSTRAINT `eventid` FOREIGN KEY (`eventid`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studentid` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (202080001,35,NULL,NULL,'2023-06-08 18:43:24','2023-06-08 18:43:18'),(202080002,35,NULL,NULL,'2023-06-08 18:43:30','2023-06-08 18:43:38'),(202080003,35,NULL,NULL,'2023-06-08 18:43:48',NULL),(202080004,34,NULL,NULL,NULL,'2023-06-08 18:44:02'),(202080004,35,NULL,NULL,'2023-06-08 18:43:53',NULL),(202080028,35,NULL,NULL,'2023-06-08 18:41:19','2023-06-08 18:41:28'),(202080030,35,NULL,NULL,'2023-06-08 18:42:55','2023-06-08 18:43:08');
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_attendance`
--

DROP TABLE IF EXISTS `event_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_attendance` (
  `studentid` int DEFAULT NULL,
  `eventid` int DEFAULT NULL,
  `timein_no` int NOT NULL,
  `timeout_no` int NOT NULL,
  `event_total_timein` int DEFAULT NULL,
  `event_total_timeout` int DEFAULT NULL,
  `event_total_absents` int DEFAULT NULL,
  KEY `event_idx` (`eventid`),
  KEY `student_idx` (`studentid`),
  CONSTRAINT `event` FOREIGN KEY (`eventid`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `student` FOREIGN KEY (`studentid`) REFERENCES `student_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_attendance`
--

LOCK TABLES `event_attendance` WRITE;
/*!40000 ALTER TABLE `event_attendance` DISABLE KEYS */;
INSERT INTO `event_attendance` VALUES (202080028,32,1,0,1,1,1),(202080028,35,1,0,1,1,1),(202080030,35,1,0,1,1,1),(202080001,35,1,0,1,1,1),(202080002,35,1,0,1,1,1),(202080003,35,1,0,1,1,1),(202080004,35,1,0,1,1,1),(202080004,34,1,0,2,2,3);
/*!40000 ALTER TABLE `event_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(45) DEFAULT NULL,
  `type` enum('Whole Day','Half Day') DEFAULT NULL,
  `half_day_type` enum('Morning','Afternoon') DEFAULT NULL,
  `eventdate` date DEFAULT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (30,'General Assembly','Half Day','Morning','2023-06-01'),(31,'Valentine\'s Day','Whole Day',NULL,'2023-02-14'),(32,'Coding Bootcamp pt. 1','Half Day','Morning','2023-05-12'),(33,'Coding Bootcamp pt. 2','Half Day','Morning','2023-05-13'),(34,'Graduation','Whole Day',NULL,'2023-06-30'),(35,'Battle of the Bands','Half Day','Afternoon','2023-06-01');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_05_31_162641_import_sql_data',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notif_students`
--

DROP TABLE IF EXISTS `notif_students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notif_students` (
  `notif_id` int DEFAULT NULL,
  `students_id` int DEFAULT NULL,
  KEY `notifid_idx` (`notif_id`),
  KEY `studid_idx` (`students_id`),
  CONSTRAINT `notifid` FOREIGN KEY (`notif_id`) REFERENCES `notification` (`idnotification`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studid` FOREIGN KEY (`students_id`) REFERENCES `student_info` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notif_students`
--

LOCK TABLES `notif_students` WRITE;
/*!40000 ALTER TABLE `notif_students` DISABLE KEYS */;
INSERT INTO `notif_students` VALUES (178,202080028),(179,202080028),(180,202080030),(181,202080001),(182,202080002),(183,202080003),(184,202080004),(185,202080004);
/*!40000 ALTER TABLE `notif_students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `idnotification` int NOT NULL AUTO_INCREMENT,
  `notification` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`idnotification`)
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (42,'Student 202080028 logged in this morning.','2023-05-21 10:15:12'),(45,'Student 202080028 logged out this morning.','2023-05-21 10:26:04'),(46,'Student 202080028 logged in this afternoon.','2023-05-27 20:57:28'),(47,'Student 202080028 logged in this afternoon.','2023-05-27 20:59:32'),(48,'Student 202080028 logged in this afternoon.','2023-05-27 21:20:35'),(49,'Student 202080028 logged in this afternoon.','2023-05-27 21:21:50'),(50,'Student 202080028 logged in this afternoon.','2023-05-27 21:22:46'),(51,'Student 202080028 logged in this afternoon.','2023-05-27 21:23:00'),(52,'Student 202080028 logged in this afternoon.','2023-05-27 21:24:20'),(53,'Student 202080028 logged in this afternoon.','2023-05-27 21:29:25'),(54,'Student 202080028 logged in this afternoon.','2023-05-27 21:32:40'),(55,'Student 202080028 logged in this afternoon.','2023-05-27 21:36:35'),(56,'Student 202080028 logged in this afternoon.','2023-05-27 21:38:01'),(57,'Student 202080028 logged in this afternoon.','2023-05-27 21:38:26'),(58,'Student 202080028 logged in this afternoon.','2023-05-27 21:52:07'),(59,'Student 202080028 logged in this afternoon.','2023-05-27 21:53:56'),(60,'Student 202080028 logged in this afternoon.','2023-05-27 21:56:17'),(61,'Student 202080028 logged in this afternoon.','2023-05-27 21:56:24'),(62,'Student 202080028 logged in this afternoon.','2023-05-27 22:00:49'),(63,'Student 202080028 logged in this afternoon.','2023-05-27 22:01:54'),(64,'Student 202080028 logged in this afternoon.','2023-05-27 22:03:17'),(65,'Student 202080028 logged in this afternoon.','2023-05-27 22:03:24'),(66,'Student 202080028 logged in this afternoon.','2023-05-27 22:04:08'),(67,'Student 202080028 logged in this afternoon.','2023-05-27 22:04:16'),(68,'Student 202080028 logged in this afternoon.','2023-05-27 22:08:05'),(69,'Student 202080028 logged in this afternoon.','2023-05-27 22:10:14'),(70,'Student 202080028 logged in this afternoon.','2023-05-27 22:12:28'),(71,'Student 202080028 logged in this afternoon.','2023-05-27 22:17:00'),(72,'Student 202080028 logged in this afternoon.','2023-05-27 22:17:56'),(73,'Student 202080028 logged in this afternoon.','2023-05-27 22:19:19'),(74,'Student 202080028 logged in this afternoon.','2023-05-27 22:19:51'),(75,'Student 202080028 logged in this afternoon.','2023-05-27 22:21:35'),(76,'Student 202080028 logged in this afternoon.','2023-05-27 22:21:48'),(77,'Student 202080028 logged in this afternoon.','2023-05-27 22:22:55'),(78,'Student 202080028 logged in this afternoon.','2023-05-27 22:25:12'),(79,'Student 202080028 logged in this afternoon.','2023-05-27 22:26:16'),(80,'Student 202080028 logged in this afternoon.','2023-05-27 22:30:44'),(81,'Student 202080028 logged in this afternoon.','2023-05-27 22:32:55'),(82,'Student 202080028 logged in this afternoon.','2023-05-27 22:33:11'),(83,'Student 202080028 logged in this afternoon.','2023-05-27 22:34:19'),(84,'Student 202080030 logged in this afternoon.','2023-05-27 22:36:45'),(85,'Student 202080030 logged in this afternoon.','2023-05-27 22:36:52'),(86,'Student 202080028 logged in this afternoon.','2023-05-27 22:38:04'),(87,'Student 202080001 logged in this afternoon.','2023-05-27 22:39:36'),(88,'Student 202080001 logged in this afternoon.','2023-05-27 22:41:39'),(89,'Student 202080028 logged in this afternoon.','2023-05-27 22:43:30'),(90,'Student 202080028 logged in this afternoon.','2023-05-27 22:43:42'),(91,'Student 202080001 logged in this afternoon.','2023-05-27 22:45:26'),(92,'Student 202080030 logged in this afternoon.','2023-05-27 22:47:58'),(93,'Student 202080030 logged in this afternoon.','2023-05-27 22:49:40'),(94,'Student 202080028 logged in this afternoon.','2023-05-27 22:50:44'),(95,'Student 202080030 logged in this afternoon.','2023-05-27 22:50:56'),(96,'Student 202080030 logged in this afternoon.','2023-05-27 22:54:00'),(97,'Student 202080028 logged in this afternoon.','2023-05-30 18:28:18'),(98,'Student 202080028 logged in this afternoon.','2023-05-30 18:29:10'),(99,'Student 202080028 logged in this afternoon.','2023-05-30 18:31:16'),(100,'Student 202080028 logged in this afternoon.','2023-05-30 18:46:07'),(101,'Student 202080028 logged in this afternoon.','2023-05-30 18:46:20'),(102,'Student 202080030 logged in this afternoon.','2023-05-30 19:06:12'),(103,'Student 202080030 logged in this afternoon.','2023-05-30 19:06:20'),(104,'Student 202080030 logged in this afternoon.','2023-05-30 19:06:27'),(105,'Student 202080001 logged in this afternoon.','2023-05-31 21:32:54'),(106,'Student 202080002 logged in this afternoon.','2023-05-31 21:33:03'),(107,'Student 202080003 logged in this afternoon.','2023-05-31 21:33:07'),(108,'Student 202080003 logged in this afternoon.','2023-05-31 21:33:12'),(109,'Student 202080004 logged in this afternoon.','2023-05-31 21:33:17'),(110,'Student 202080001 logged in this afternoon.','2023-05-31 21:33:23'),(111,'Student 202080002 logged in this afternoon.','2023-05-31 21:33:27'),(112,'Student 202080003 logged in this afternoon.','2023-05-31 21:33:32'),(113,'Student 202080004 logged in this afternoon.','2023-05-31 21:33:37'),(114,'Student 202080001 logged in this afternoon.','2023-05-31 21:51:17'),(115,'Student 202080002 logged in this afternoon.','2023-05-31 21:51:21'),(116,'Student 202080003 logged in this afternoon.','2023-05-31 21:51:25'),(117,'Student 202080004 logged in this afternoon.','2023-05-31 21:51:29'),(118,'Student 202080005 logged in this afternoon.','2023-05-31 21:51:32'),(119,'Student 202080028 logged in this afternoon.','2023-05-31 21:51:44'),(120,'Student 202080030 logged in this afternoon.','2023-05-31 21:51:49'),(121,'Student 202080001 logged in this afternoon.','2023-05-31 22:04:42'),(122,'Student 202080002 logged in this afternoon.','2023-05-31 22:04:47'),(123,'Student 202080003 logged in this afternoon.','2023-05-31 22:04:51'),(124,'Student 202080004 logged in this afternoon.','2023-05-31 22:04:56'),(125,'Student 202080028 logged in this afternoon.','2023-05-31 22:05:02'),(126,'Student 202080030 logged in this afternoon.','2023-05-31 22:05:07'),(127,'Student 202080001 logged in this afternoon.','2023-05-31 22:06:27'),(128,'Student 202080002 logged in this afternoon.','2023-05-31 22:06:31'),(129,'Student 202080003 logged in this afternoon.','2023-05-31 22:06:37'),(130,'Student 202080003 logged in this afternoon.','2023-05-31 22:06:41'),(131,'Student 202080004 logged in this afternoon.','2023-05-31 22:06:45'),(132,'Student 202080028 logged in this afternoon.','2023-05-31 22:06:50'),(133,'Student 202080030 logged in this afternoon.','2023-05-31 22:06:54'),(134,'Student 202080001 logged in this afternoon.','2023-05-31 22:08:45'),(135,'Student 202080001 logged in this afternoon.','2023-05-31 22:09:46'),(136,'Student 202080001 logged in this afternoon.','2023-05-31 22:10:48'),(137,'Student 202080002 logged in this afternoon.','2023-05-31 22:10:53'),(138,'Student 202080028 logged in this afternoon.','2023-05-31 22:11:33'),(139,'Student 202080001 logged in this afternoon.','2023-05-31 22:11:45'),(140,'Student 202080003 logged in this afternoon.','2023-05-31 22:13:14'),(141,'Student 202080004 logged in this afternoon.','2023-05-31 22:13:22'),(142,'Student 202080028 logged in this afternoon.','2023-05-31 22:13:27'),(143,'Student 202080030 logged in this afternoon.','2023-05-31 22:13:33'),(144,'Student 1234 logged in this afternoon.','2023-06-06 20:54:10'),(145,'Student 12345 logged in this afternoon.','2023-06-06 20:54:56'),(146,'Student 123124 logged in this afternoon.','2023-06-06 21:01:55'),(147,'Student 123445 logged in this afternoon.','2023-06-06 21:04:20'),(148,'Student 236236 logged in this afternoon.','2023-06-06 21:38:10'),(149,'Student 1232343 logged in this afternoon.','2023-06-06 21:41:14'),(150,'Student 202080002 logged in this afternoon.','2023-06-06 21:44:12'),(151,'Student 202080003 logged in this afternoon.','2023-06-06 21:48:00'),(152,'Student 202080004 logged in this afternoon.','2023-06-06 21:48:40'),(153,'Student 1 logged in this afternoon.','2023-06-06 21:56:40'),(154,'Student 1 logged in this afternoon.','2023-06-06 22:03:36'),(155,'Student 1 logged in this afternoon.','2023-06-06 22:05:40'),(156,'Student 1 logged in this afternoon.','2023-06-06 22:09:44'),(157,'Student 1 logged in this afternoon.','2023-06-06 22:12:04'),(158,'Student 1 logged in this afternoon.','2023-06-06 22:16:54'),(159,'Student 1 logged in this afternoon.','2023-06-06 22:17:44'),(160,'Student 1 logged in this afternoon.','2023-06-06 22:19:48'),(161,'Student 1 logged in this afternoon.','2023-06-06 22:24:01'),(162,'Student 1 logged in this afternoon.','2023-06-06 22:25:21'),(163,'Student 1 logged in this afternoon.','2023-06-06 22:25:34'),(164,'Student 1 logged in this afternoon.','2023-06-06 22:27:42'),(165,'Student 1 logged in this afternoon.','2023-06-06 22:29:06'),(166,'Student 1 logged in this afternoon.','2023-06-06 22:35:09'),(167,'Student 1 logged in this afternoon.','2023-06-06 22:39:35'),(168,'Student 1 logged in this afternoon.','2023-06-06 22:40:16'),(169,'Student 1 logged in this afternoon.','2023-06-06 22:50:51'),(170,'Student 1 logged out this afternoon.','2023-06-06 22:51:48'),(171,'Student 1 logged in this morning.','2023-06-08 11:55:09'),(172,'Student 1 logged in this morning.','2023-06-08 17:12:48'),(173,'Student 1 logged in this morning.','2023-06-08 17:39:15'),(174,'Student 1 logged in this afternoon.','2023-06-08 17:42:21'),(175,'Student 202080028 logged out this afternoon.','2023-06-08 18:18:56'),(176,'Student 1 logged in this afternoon.','2023-06-08 18:21:38'),(177,'Student 1 logged out this afternoon.','2023-06-08 18:24:15'),(178,'Student 202080028 logged in this afternoon.','2023-06-08 18:38:57'),(179,'Student 202080028 logged in this afternoon.','2023-06-08 18:41:19'),(180,'Student 202080030 logged in this afternoon.','2023-06-08 18:42:55'),(181,'Student 202080001 logged out this afternoon.','2023-06-08 18:43:18'),(182,'Student 202080002 logged in this afternoon.','2023-06-08 18:43:30'),(183,'Student 202080003 logged in this afternoon.','2023-06-08 18:43:48'),(184,'Student 202080004 logged in this afternoon.','2023-06-08 18:43:53'),(185,'Student 202080004 logged out this afternoon.','2023-06-08 18:44:02');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_info`
--

DROP TABLE IF EXISTS `student_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_info` (
  `id` int NOT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `middlename` varchar(45) DEFAULT NULL,
  `extname` varchar(45) DEFAULT NULL,
  `course` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `block` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_info`
--

LOCK TABLES `student_info` WRITE;
/*!40000 ALTER TABLE `student_info` DISABLE KEYS */;
INSERT INTO `student_info` VALUES (123,'test','test','test','III','BSMarBio','Third Year','Block 5'),(1234,'test1','test1','test1','test1','BSMarBio','Fourth Year','Block 5'),(12345,'test1','test1','test1','test1','BSMarBio','Fourth Year','Block 5'),(123124,'asasfa','asgas','asgasga','sgasg','BSMedBio','Third Year','Block 3'),(123445,'sfa','asfasf','asfasf','asfafa','BSES','First Year','Block 4'),(236236,'62362','2362','2362','26236','BSCS','First Year','Block 3'),(1232343,'nhgngjng','gnghnghngn','ghghnhggng','mhmhh,h','BSMedBio','First Year','Block 4'),(20022882,'sweere','fefff','ffrfrf','vvfvfv','BSES','First Year','Block 4'),(202080001,'Llado','Maurene','Cayao','','BSIT','Third Year','Block 1'),(202080002,'Orga','Sean','Dalope','','BSIT','Third Year','Block 1'),(202080003,'Gabayan','Angel','Mae','','BSIT','Third Year','Block 1'),(202080004,'Dorero','Charles','Jazon','III','BSIT','Third Year','Block 1'),(202080028,'Calma','Ingrid','Santiaguel','III','BSIT','Third Year','Block 1'),(202080030,'Casayas','Jiezca','Padios','','BSIT','Third Year','Block 1'),(202080065,'Laguna','Myra','savaria','III','BSMarBio','Third Year','Block 3'),(1234567890,'Doe','test','test','sgasg','BSCS','Second Year','Block 2'),(1515151512,'ssswss','xsxsxsx','xsxsx','III','BSCS','Second Year','Block 3');
/*!40000 ALTER TABLE `student_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `total_events_attendance`
--

DROP TABLE IF EXISTS `total_events_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `total_events_attendance` (
  `total_events_timein_no` int DEFAULT NULL,
  `total_events_timeout_no` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `total_events_attendance`
--

LOCK TABLES `total_events_attendance` WRITE;
/*!40000 ALTER TABLE `total_events_attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `total_events_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2023-06-08 18:44:46
