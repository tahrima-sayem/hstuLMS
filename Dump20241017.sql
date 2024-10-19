CREATE DATABASE  IF NOT EXISTS `tm` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tm`;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: tm
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `assigned_externals`
--

DROP TABLE IF EXISTS `assigned_externals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assigned_externals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `external_1` bigint unsigned NOT NULL,
  `external_2` bigint unsigned NOT NULL,
  `scrutinizer` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_externals_course_id_foreign` (`course_id`),
  KEY `assigned_externals_external_1_foreign` (`external_1`),
  KEY `assigned_externals_external_2_foreign` (`external_2`),
  KEY `assigned_externals_scrutinizer_foreign` (`scrutinizer`),
  CONSTRAINT `assigned_externals_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  CONSTRAINT `assigned_externals_external_1_foreign` FOREIGN KEY (`external_1`) REFERENCES `externals` (`id`),
  CONSTRAINT `assigned_externals_external_2_foreign` FOREIGN KEY (`external_2`) REFERENCES `externals` (`id`),
  CONSTRAINT `assigned_externals_scrutinizer_foreign` FOREIGN KEY (`scrutinizer`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_externals`
--

LOCK TABLES `assigned_externals` WRITE;
/*!40000 ALTER TABLE `assigned_externals` DISABLE KEYS */;
/*!40000 ALTER TABLE `assigned_externals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assignments_course_id_foreign` (`course_id`),
  CONSTRAINT `assignments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assignments`
--

LOCK TABLES `assignments` WRITE;
/*!40000 ALTER TABLE `assignments` DISABLE KEYS */;
INSERT INTO `assignments` VALUES (1,'1st assignment',9,'it is first assignment',NULL,'2024-10-20 00:00:00'),(6,'An Assignment',9,'This is an assignment',NULL,'2024-10-24 00:00:00');
/*!40000 ALTER TABLE `assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendence`
--

DROP TABLE IF EXISTS `attendence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendence` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `class_id` bigint unsigned NOT NULL,
  `attendance_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attendence_student_id_foreign` (`student_id`),
  KEY `attendence_class_id_foreign` (`class_id`),
  CONSTRAINT `attendence_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `attendence_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendence`
--

LOCK TABLES `attendence` WRITE;
/*!40000 ALTER TABLE `attendence` DISABLE KEYS */;
INSERT INTO `attendence` VALUES (1,1,4,1),(2,2,4,1),(3,3,4,0),(4,1,3,1),(5,2,1,0),(6,3,2,0),(7,1,5,1),(8,2,5,0),(9,3,5,1),(10,1,6,1),(11,2,6,0),(12,3,6,0);
/*!40000 ALTER TABLE `attendence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classes_course_id_foreign` (`course_id`),
  CONSTRAINT `classes_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `classes`
--

LOCK TABLES `classes` WRITE;
/*!40000 ALTER TABLE `classes` DISABLE KEYS */;
INSERT INTO `classes` VALUES (1,1,'2024-09-10'),(2,2,'2024-09-10'),(3,3,'2024-09-10'),(4,9,'2024-09-10'),(5,9,'2024-09-11'),(6,9,'2024-09-13'),(7,4,'2024-09-15'),(8,3,'2024-09-15');
/*!40000 ALTER TABLE `classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_taken`
--

DROP TABLE IF EXISTS `course_taken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_taken` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `course_taken_student_id_foreign` (`student_id`),
  KEY `course_taken_course_id_foreign` (`course_id`),
  CONSTRAINT `course_taken_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_taken_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_taken`
--

LOCK TABLES `course_taken` WRITE;
/*!40000 ALTER TABLE `course_taken` DISABLE KEYS */;
INSERT INTO `course_taken` VALUES (1,3,1,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(2,3,2,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(3,3,3,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(4,3,4,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(5,3,5,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(6,3,6,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(7,3,7,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(8,3,8,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(9,3,9,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(10,1,1,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(11,1,2,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(12,1,3,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(13,1,4,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(14,1,5,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(15,1,6,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(16,1,7,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(17,1,8,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(18,1,9,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(19,2,1,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(20,2,2,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(21,2,3,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(22,2,4,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(23,2,5,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(24,2,6,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(25,2,7,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(26,2,8,'2024-09-10 08:35:13','2024-09-10 08:42:09'),(27,2,9,'2024-09-10 08:35:13','2024-09-10 08:42:09');
/*!40000 ALTER TABLE `course_taken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credit_hour` double NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_degree_id_foreign` (`degree_id`),
  CONSTRAINT `courses_degree_id_foreign` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'CSE 403','Artificial Intelligence','4','i',3,'Theory',1,'2024-09-10 08:47:55','2024-09-10 08:47:55'),(2,'CSE 404','Atrificial Intelligence Sessional','4','i',0.75,'Sessional',1,'2024-09-10 08:48:33','2024-09-10 08:48:33'),(3,'CSE 405','Computer Graphics and Image Processing','4','i',3,'Theory',1,'2024-09-10 08:49:17','2024-09-10 08:49:17'),(4,'CSE 406','Computer Graphics and Image Processing Sessional','4','i',1.5,'Sessional',1,'2024-09-10 08:49:52','2024-09-10 08:49:52'),(5,'CSE 415','Mobile and Wireless Communication','4','i',3,'Theory',1,'2024-09-10 08:50:35','2024-09-10 08:50:35'),(6,'CSE 416','Mobile and Wireless Communication Sessional','4','i',0.75,'Sessional',1,'2024-09-10 08:51:08','2024-09-10 08:51:08'),(7,'CSE 423','Graph Theory','4','i',3,'Theory',1,'2024-09-10 08:51:57','2024-09-10 08:51:57'),(8,'CSE 424','Graph Theory Sessional','4','i',0.75,'Sessional',1,'2024-09-10 08:52:34','2024-09-10 08:52:34'),(9,'CSE 408','Technical Writing and Presentation Skill Development Sessional','4','i',1.5,'Sessional',1,'2024-09-10 08:53:28','2024-09-10 08:53:28');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `degrees`
--

DROP TABLE IF EXISTS `degrees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `degrees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `degrees_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `degrees_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `degrees`
--

LOCK TABLES `degrees` WRITE;
/*!40000 ALTER TABLE `degrees` DISABLE KEYS */;
INSERT INTO `degrees` VALUES (1,'B.Sc. (Engineering) in CSE',1,'2024-09-10 08:37:21','2024-09-10 08:37:21');
/*!40000 ALTER TABLE `degrees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dept_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `faculty_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_user_id_foreign` (`user_id`),
  KEY `departments_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Department of Computer Science and Engineering','CSE',3,1,'2024-09-10 08:36:42','2024-09-10 08:36:42');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distributions`
--

DROP TABLE IF EXISTS `distributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distributions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  `session` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `distributions_course_id_foreign` (`course_id`),
  KEY `distributions_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `distributions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `distributions_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distributions`
--

LOCK TABLES `distributions` WRITE;
/*!40000 ALTER TABLE `distributions` DISABLE KEYS */;
INSERT INTO `distributions` VALUES (1,1,1,'2020','2024-09-10 08:54:39','2024-09-10 08:54:39'),(2,9,4,'2020','2024-09-10 10:31:58','2024-09-10 10:31:58'),(3,2,1,'2020','2024-09-10 10:43:34','2024-09-10 10:43:34'),(4,3,2,'2020','2024-09-10 10:43:56','2024-09-10 10:43:56'),(5,5,3,'2020','2024-09-10 11:21:27','2024-09-10 11:21:27');
/*!40000 ALTER TABLE `distributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enrollment` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department` bigint unsigned NOT NULL,
  `level` int NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enrollment_department_foreign` (`department`),
  CONSTRAINT `enrollment_department_foreign` FOREIGN KEY (`department`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment`
--

LOCK TABLES `enrollment` WRITE;
/*!40000 ALTER TABLE `enrollment` DISABLE KEYS */;
INSERT INTO `enrollment` VALUES (1,1,1,'I','2024-10-17','2024-10-23');
/*!40000 ALTER TABLE `enrollment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `syllabus` text COLLATE utf8mb4_unicode_ci,
  `date` date NOT NULL,
  `category` enum('mid','quiz','final') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_course_id_foreign` (`course_id`),
  CONSTRAINT `exam_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
INSERT INTO `exam` VALUES (1,9,'lecture 1,2,3','2024-11-10','quiz'),(2,9,'lecture 1,2,3,4','2024-11-15','mid');
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_committee`
--

DROP TABLE IF EXISTS `exam_committee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_committee` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `year` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chairman` bigint unsigned NOT NULL,
  `member_1` bigint unsigned NOT NULL,
  `member_2` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_committee_chairman_foreign` (`chairman`),
  KEY `exam_committee_member_1_foreign` (`member_1`),
  KEY `exam_committee_member_2_foreign` (`member_2`),
  CONSTRAINT `exam_committee_chairman_foreign` FOREIGN KEY (`chairman`) REFERENCES `teachers` (`id`),
  CONSTRAINT `exam_committee_member_1_foreign` FOREIGN KEY (`member_1`) REFERENCES `teachers` (`id`),
  CONSTRAINT `exam_committee_member_2_foreign` FOREIGN KEY (`member_2`) REFERENCES `teachers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_committee`
--

LOCK TABLES `exam_committee` WRITE;
/*!40000 ALTER TABLE `exam_committee` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_committee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_mark`
--

DROP TABLE IF EXISTS `exam_mark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_mark` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `exam_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `mark` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exam_mark_student_id_foreign` (`student_id`),
  KEY `exam_mark_exam_id_foreign` (`exam_id`),
  KEY `exam_mark_course_id_foreign` (`course_id`),
  CONSTRAINT `exam_mark_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_mark_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`) ON DELETE CASCADE,
  CONSTRAINT `exam_mark_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_mark`
--

LOCK TABLES `exam_mark` WRITE;
/*!40000 ALTER TABLE `exam_mark` DISABLE KEYS */;
INSERT INTO `exam_mark` VALUES (1,1,1,9,12),(2,1,2,9,27);
/*!40000 ALTER TABLE `exam_mark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `externals`
--

DROP TABLE IF EXISTS `externals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `externals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` bigint unsigned NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `externals_email_unique` (`email`),
  KEY `externals_department_foreign` (`department`),
  CONSTRAINT `externals_department_foreign` FOREIGN KEY (`department`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `externals`
--

LOCK TABLES `externals` WRITE;
/*!40000 ALTER TABLE `externals` DISABLE KEYS */;
/*!40000 ALTER TABLE `externals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faculties` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculties_user_id_foreign` (`user_id`),
  CONSTRAINT `faculties_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculties`
--

LOCK TABLES `faculties` WRITE;
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` VALUES (1,'Faculty of Computer Science and Engineering',NULL,2,'2024-09-10 08:36:13','2024-09-10 08:36:13');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;
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
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labwork`
--

DROP TABLE IF EXISTS `labwork`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `labwork` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` blob,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `labwork_course_id_foreign` (`course_id`),
  CONSTRAINT `labwork_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labwork`
--

LOCK TABLES `labwork` WRITE;
/*!40000 ALTER TABLE `labwork` DISABLE KEYS */;
INSERT INTO `labwork` VALUES (1,'1st labwork',9,'This is the 1st labwork',NULL,'2024-10-25');
/*!40000 ALTER TABLE `labwork` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `materials_course_id_foreign` (`course_id`),
  CONSTRAINT `materials_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materials`
--

LOCK TABLES `materials` WRITE;
/*!40000 ALTER TABLE `materials` DISABLE KEYS */;
INSERT INTO `materials` VALUES (1,9,'History of Computer','The history of computers dates back to ancient times with early mechanical devices like the abacus. In the 19th century, Charles Babbage conceptualized the first mechanical computer, the Analytical Engine. The 20th century saw the development of electronic computers, beginning with ENIAC in 1945, leading to the evolution of modern digital computers. The invention of transistors in the 1950s and integrated circuits in the 1960s revolutionized computer technology, paving the way for personal computers, the internet, and today\'s powerful, interconnected devices.','\"C:\\Users\\Admin\\Downloads\\database table (1).pdf\"');
/*!40000 ALTER TABLE `materials` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1),(3,'2024_07_11_064056_create_roles_table',1),(4,'2024_07_14_073155_create_special_roles_table',1),(5,'2024_07_14_073258_create_users_table',1),(6,'2024_07_14_080833_create_special_role_user_table',1),(7,'2024_07_14_124816_create_faculties_table',1),(8,'2024_07_14_125943_create_departments_table',1),(9,'2024_07_26_095620_create_degrees_table',1),(10,'2024_08_26_094224_create_teachers_table',1),(11,'2024_08_26_094235_create_students_table',1),(12,'2024_08_26_094303_create_courses_table',1),(13,'2024_08_26_105232_create_assignments_table',1),(14,'2024_09_02_160702_create_distributions_table',1),(15,'2024_10_09_040607_create_course_taken_table',2),(16,'2024_10_09_041819_create_classes_table',3),(17,'2024_10_09_042727_create_attendence_table',4),(18,'2024_10_09_043206_create_assignments_table',5),(19,'2024_10_09_043711_create_solution_assignment_table',6),(20,'2024_10_09_093222_create_labwork_table',7),(21,'2024_10_09_093740_create_solution_labwork_table',8),(22,'2024_10_10_094109_create_exam_table',9),(23,'2024_10_10_094326_create_exam_mark_table',10),(24,'2024_10_10_094643_create_materials_table',11),(25,'2024_10_10_094810_create_enrollment_table',12),(26,'2024_10_10_095026_create_externals_table',13),(27,'2024_10_10_100354_create_assigned_externals_table',14),(28,'2024_10_10_100628_create_exam_committee_table',15),(29,'2024_10_13_161316_create_silution_assignment_table',16),(30,'2024_10_13_164700_create_solution_assignment_table',17),(31,'2024_10_13_165231_create_solution_labwork_table',18),(32,'2024_10_13_165622_create_solution_labwork_table',19);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','2024-09-10 08:35:12','2024-09-10 08:35:12'),(2,'teacher','2024-09-10 08:35:12','2024-09-10 08:35:12'),(3,'student','2024-09-10 08:35:12','2024-09-10 08:35:12');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('LLPUM7Re4c2xqBXm6EkxosNvOqPSboLYr6nU0YSG',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36','YTo3OntzOjY6Il90b2tlbiI7czo0MDoiR05zdFd3R2Z4TEFBVkM3aTJ1ejZ6dUw5RUx2UmU4UEUwSGF3cjVmbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90ZWFjaGVyL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6OToiY3Vycl91c2VyIjtPOjE1OiJBcHBcTW9kZWxzXFVzZXIiOjMyOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6InVzZXJzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6ODp7czoyOiJpZCI7aTo1O3M6ODoiZnVsbG5hbWUiO3M6MjI6IkRyLiBBc2hpcyBLdW1hciBNYW5kYWwiO3M6NToiZW1haWwiO3M6MTY6ImFzaGlzQGhzdHUuYWMuYmQiO3M6MTQ6ImNvbnRhY3RfbnVtYmVyIjtzOjExOiIwMTkxMjEzNjAyMSI7czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJDZIOFNGWEdKOW5nUkNlQ3oxMVVtRS5IUFVTL0JBUDlkbVpNd2hjN1J1NmJLZE1ubjVpYkkyIjtzOjc6InJvbGVfaWQiO2k6MjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA5LTEwIDE0OjM5OjAxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA5LTEwIDE0OjM5OjAxIjt9czoxMToiACoAb3JpZ2luYWwiO2E6ODp7czoyOiJpZCI7aTo1O3M6ODoiZnVsbG5hbWUiO3M6MjI6IkRyLiBBc2hpcyBLdW1hciBNYW5kYWwiO3M6NToiZW1haWwiO3M6MTY6ImFzaGlzQGhzdHUuYWMuYmQiO3M6MTQ6ImNvbnRhY3RfbnVtYmVyIjtzOjExOiIwMTkxMjEzNjAyMSI7czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJDZIOFNGWEdKOW5nUkNlQ3oxMVVtRS5IUFVTL0JBUDlkbVpNd2hjN1J1NmJLZE1ubjVpYkkyIjtzOjc6InJvbGVfaWQiO2k6MjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI0LTA5LTEwIDE0OjM5OjAxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI0LTA5LTEwIDE0OjM5OjAxIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YToyOntzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7czo4OiJkYXRldGltZSI7czo4OiJwYXNzd29yZCI7czo2OiJoYXNoZWQiO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MDp7fXM6MTk6IgAqAGRpc3BhdGNoZXNFdmVudHMiO2E6MDp7fXM6MTQ6IgAqAG9ic2VydmFibGVzIjthOjA6e31zOjEyOiIAKgByZWxhdGlvbnMiO2E6MDp7fXM6MTA6IgAqAHRvdWNoZXMiO2E6MDp7fXM6MTA6InRpbWVzdGFtcHMiO2I6MTtzOjEzOiJ1c2VzVW5pcXVlSWRzIjtiOjA7czo5OiIAKgBoaWRkZW4iO2E6Mjp7aTowO3M6ODoicGFzc3dvcmQiO2k6MTtzOjE0OiJyZW1lbWJlcl90b2tlbiI7fXM6MTA6IgAqAHZpc2libGUiO2E6MDp7fXM6MTE6IgAqAGZpbGxhYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjI6e2k6MDtzOjEwOiJjcmVhdGVkX2F0IjtpOjE7czoxMDoidXBkYXRlZF9hdCI7fXM6MTk6IgAqAGF1dGhQYXNzd29yZE5hbWUiO3M6ODoicGFzc3dvcmQiO3M6MjA6IgAqAHJlbWVtYmVyVG9rZW5OYW1lIjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7fXM6OToidXNlcl9yb2xlIjtzOjc6InRlYWNoZXIiO3M6NzoidXNlcl9pZCI7aTo1O3M6MTA6InRlYWNoZXJfaWQiO2k6MTt9',1729093298);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution_assignment`
--

DROP TABLE IF EXISTS `solution_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solution_assignment` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `assignment_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `mark` int DEFAULT NULL,
  `file` blob,
  PRIMARY KEY (`id`),
  KEY `solution_assignment_student_id_foreign` (`student_id`),
  KEY `solution_assignment_assignment_id_foreign` (`assignment_id`),
  KEY `solution_assignment_course_id_foreign` (`course_id`),
  CONSTRAINT `solution_assignment_assignment_id_foreign` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `solution_assignment_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `solution_assignment_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution_assignment`
--

LOCK TABLES `solution_assignment` WRITE;
/*!40000 ALTER TABLE `solution_assignment` DISABLE KEYS */;
INSERT INTO `solution_assignment` VALUES (1,1,1,9,5,NULL);
/*!40000 ALTER TABLE `solution_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solution_labwork`
--

DROP TABLE IF EXISTS `solution_labwork`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solution_labwork` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned NOT NULL,
  `labwork_id` bigint unsigned NOT NULL,
  `course_id` bigint unsigned NOT NULL,
  `mark` int DEFAULT NULL,
  `file` blob,
  PRIMARY KEY (`id`),
  KEY `solution_labwork_student_id_foreign` (`student_id`),
  KEY `solution_labwork_labwork_id_foreign` (`labwork_id`),
  KEY `solution_labwork_course_id_foreign` (`course_id`),
  CONSTRAINT `solution_labwork_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `solution_labwork_labwork_id_foreign` FOREIGN KEY (`labwork_id`) REFERENCES `labwork` (`id`) ON DELETE CASCADE,
  CONSTRAINT `solution_labwork_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solution_labwork`
--

LOCK TABLES `solution_labwork` WRITE;
/*!40000 ALTER TABLE `solution_labwork` DISABLE KEYS */;
INSERT INTO `solution_labwork` VALUES (1,1,1,9,5,NULL);
/*!40000 ALTER TABLE `solution_labwork` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_role_user`
--

DROP TABLE IF EXISTS `special_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `special_role_user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `special_role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `special_role_user_user_id_foreign` (`user_id`),
  KEY `special_role_user_special_role_id_foreign` (`special_role_id`),
  CONSTRAINT `special_role_user_special_role_id_foreign` FOREIGN KEY (`special_role_id`) REFERENCES `special_roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `special_role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_role_user`
--

LOCK TABLES `special_role_user` WRITE;
/*!40000 ALTER TABLE `special_role_user` DISABLE KEYS */;
INSERT INTO `special_role_user` VALUES (1,2,1,NULL,NULL),(2,3,2,NULL,NULL);
/*!40000 ALTER TABLE `special_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `special_roles`
--

DROP TABLE IF EXISTS `special_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `special_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `special_roles`
--

LOCK TABLES `special_roles` WRITE;
/*!40000 ALTER TABLE `special_roles` DISABLE KEYS */;
INSERT INTO `special_roles` VALUES (1,'dean','2024-09-10 08:35:12','2024-09-10 08:35:12'),(2,'chairman','2024-09-10 08:35:12','2024-09-10 08:35:12'),(3,'vc','2024-09-10 08:35:12','2024-09-10 08:35:12');
/*!40000 ALTER TABLE `special_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `s_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `students_degree_id_foreign` (`degree_id`),
  KEY `students_user_id_foreign` (`user_id`),
  CONSTRAINT `students_degree_id_foreign` FOREIGN KEY (`degree_id`) REFERENCES `degrees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'2002041','4','i','2020',1,8,'2024-09-10 08:42:09','2024-09-10 08:42:09'),(2,'2002066','4','i','2020',1,9,'2024-09-10 08:45:31','2024-09-10 08:45:31'),(3,'2002008','4','i','2020',1,10,'2024-09-10 08:46:41','2024-09-10 08:46:41');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL,
  `faculty_id` bigint unsigned NOT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teachers_department_id_foreign` (`department_id`),
  KEY `teachers_faculty_id_foreign` (`faculty_id`),
  KEY `teachers_user_id_foreign` (`user_id`),
  CONSTRAINT `teachers_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `teachers_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`) ON DELETE CASCADE,
  CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (1,1,1,'Professor',5,'2024-09-10 08:39:01','2024-09-10 08:39:01'),(2,1,1,'Associate Professor',6,'2024-09-10 08:40:00','2024-09-10 08:40:00'),(3,1,1,'Lecturer',7,'2024-09-10 08:41:14','2024-09-10 08:41:14'),(4,1,1,'Professor',3,'2024-09-10 08:59:14','2024-09-10 08:59:14'),(5,1,1,'Professor',2,'2024-09-10 09:00:00','2024-09-10 09:00:00');
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Teacher Name 1','t1@example.com','123456789','$2y$12$8BvlE1BWtZfWwWg3spCqmOl5QRgtZr2lFUTjbmmOuNzn2yGSKG/9u',2,'2024-09-10 08:35:13','2024-09-10 08:35:13'),(2,'Dr. Md. Delowar Hossain','delower.cit@gmail.com','01712262634','$2y$12$KDA1.QcR53itkGDhRREFJuHf9AqlDSrErOHBma2Azs6vRtpcsC9vi',2,'2024-09-10 08:35:13','2024-09-10 08:35:13'),(3,'Adiba Mahjabin Nitu','nitu.hstu@gmail.com','01716407820','$2y$12$CjydjfQBCHBWY2dAX/BSa.cfRct5bYOcTl0/SHoB1WngI8ani.Qda',2,'2024-09-10 08:35:13','2024-09-10 08:35:13'),(4,'Admin Name 1','admin@example.com','123456789','$2y$12$LIW5aNP4mUF0rh/KGCA3v.ntAfUFD/93ICcvIitz4BBuCb3D0mvey',1,'2024-09-10 08:35:13','2024-09-10 08:35:13'),(5,'Dr. Ashis Kumar Mandal','ashis@hstu.ac.bd','01912136021','$2y$12$6H8SFXGJ9ngRCeCz11UmE.HPUS/BAP9dmZMwhc7Ru6bKdMnn5ibI2',2,'2024-09-10 08:39:01','2024-09-10 08:39:01'),(6,'Masud Ibn Afjal','masud@hstu.ac.bd','01737049633','$2y$12$MgR1hC8WyHklKLzNzjMWLuIh4K9CO5tVeBT18IfBxfFZRK9z9UC8S',2,'2024-09-10 08:40:00','2024-09-10 08:40:00'),(7,'Pankaj Bhowmik','pankaj.cshstu@gmail.com','01791848439','$2y$12$2PQJIfQP/8GgLy02AaGIi.VwMJnWfRjnxdBBoaq9da5BWr2hacD8S',2,'2024-09-10 08:41:14','2024-09-10 08:41:14'),(8,'Tahrima Sayem Sowa','tahrimasowa@gmail.com','01816187689','$2y$12$idxXXe.HLaLWXT07SezGoOO4nvJt8bD91WzZPSG2MqLbQfSffM5.O',3,'2024-09-10 08:42:09','2024-09-10 08:42:09'),(9,'Meherun Fabiha Jinia','m.f.jinia@gmail.com','01734856667','$2y$12$zn6FBgyhOkPZI3pKidK9IuRj7MPOvxIjaEH.3ktLwFQI7fSJVDjZm',3,'2024-09-10 08:45:31','2024-09-10 08:45:31'),(10,'Sweety Akter Sima','sima@gmail.com','0151992832534','$2y$12$ug1SXXxR2p6ztmOA6CcYvOzxDCS.DUhLk.vSbmgy8mAhPFyeKGITi',3,'2024-09-10 08:46:41','2024-09-10 08:46:41');
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

-- Dump completed on 2024-10-17  9:14:14
