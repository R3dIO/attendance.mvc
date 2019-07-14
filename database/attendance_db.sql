-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: attendance
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Current Database: `attendance`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `attendance` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `attendance`;

--
-- Table structure for table `attendance_table`
--

DROP TABLE IF EXISTS `attendance_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_table` (
  `schedule_id` bigint(20) unsigned NOT NULL,
  `student_id` smallint(5) unsigned NOT NULL,
  `l1` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l8` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l9` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l10` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l11` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l12` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l13` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l14` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l15` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l16` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l17` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l18` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l19` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l20` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l21` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l22` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l23` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l24` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l25` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l26` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l27` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l28` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l29` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l30` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l31` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l32` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l33` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l34` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l35` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l36` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l37` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l38` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l39` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `l40` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `present_no` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`schedule_id`,`student_id`),
  CONSTRAINT `attendance_table_ibfk_1` FOREIGN KEY (`schedule_id`) REFERENCES `schedule_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `class_table`
--

DROP TABLE IF EXISTS `class_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_table` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `course` varchar(3) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `year` tinyint(1) unsigned NOT NULL,
  `section` char(1) DEFAULT NULL,
  `coordinator_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faculty_login_table`
--

DROP TABLE IF EXISTS `faculty_login_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty_login_table` (
  `id` smallint(5) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `faculty_login_table_ibfk_1` FOREIGN KEY (`id`) REFERENCES `faculty_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faculty_subject_table`
--

DROP TABLE IF EXISTS `faculty_subject_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty_subject_table` (
  `faculty_id` smallint(3) unsigned NOT NULL,
  `subject_id` smallint(5) unsigned NOT NULL,
  `class_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`faculty_id`,`subject_id`,`class_id`),
  KEY `subject_id` (`subject_id`),
  KEY `class_id` (`class_id`),
  CONSTRAINT `faculty_subject_table_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `faculty_subject_table_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `faculty_subject_table_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `class_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `faculty_table`
--

DROP TABLE IF EXISTS `faculty_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty_table` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1065 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `firebase_tokens`
--

DROP TABLE IF EXISTS `firebase_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firebase_tokens` (
  `faculty_id` smallint(5) unsigned NOT NULL,
  `token` varchar(1000) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `firebase_tokens_student`
--

DROP TABLE IF EXISTS `firebase_tokens_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `firebase_tokens_student` (
  `id` bigint(20) unsigned NOT NULL,
  `token` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedule_table`
--

DROP TABLE IF EXISTS `schedule_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule_table` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` tinyint(3) unsigned NOT NULL,
  `subject_id` smallint(5) unsigned NOT NULL,
  `batch` tinyint(1) unsigned NOT NULL,
  `last_lecture_date` date DEFAULT NULL,
  `last_lecture_no` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `l1` date DEFAULT NULL,
  `l2` date DEFAULT NULL,
  `l3` date DEFAULT NULL,
  `l4` date DEFAULT NULL,
  `l5` date DEFAULT NULL,
  `l6` date DEFAULT NULL,
  `l7` date DEFAULT NULL,
  `l8` date DEFAULT NULL,
  `l9` date DEFAULT NULL,
  `l10` date DEFAULT NULL,
  `l11` date DEFAULT NULL,
  `l12` date DEFAULT NULL,
  `l13` date DEFAULT NULL,
  `l14` date DEFAULT NULL,
  `l15` date DEFAULT NULL,
  `l16` date DEFAULT NULL,
  `l17` date DEFAULT NULL,
  `l18` date DEFAULT NULL,
  `l19` date DEFAULT NULL,
  `l20` date DEFAULT NULL,
  `l21` date DEFAULT NULL,
  `l22` date DEFAULT NULL,
  `l23` date DEFAULT NULL,
  `l24` date DEFAULT NULL,
  `l25` date DEFAULT NULL,
  `l26` date DEFAULT NULL,
  `l27` date DEFAULT NULL,
  `l28` date DEFAULT NULL,
  `l29` date DEFAULT NULL,
  `l30` date DEFAULT NULL,
  `l31` date DEFAULT NULL,
  `l32` date DEFAULT NULL,
  `l33` date DEFAULT NULL,
  `l34` date DEFAULT NULL,
  `l35` date DEFAULT NULL,
  `l36` date DEFAULT NULL,
  `l37` date DEFAULT NULL,
  `l38` date DEFAULT NULL,
  `l39` date DEFAULT NULL,
  `l40` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=544 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_profile`
--

DROP TABLE IF EXISTS `student_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_profile` (
  `student_id` bigint(20) NOT NULL,
  `mobile_no` bigint(10) NOT NULL,
  `email_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `student_table`
--

DROP TABLE IF EXISTS `student_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student_table` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `class_id` tinyint(3) unsigned NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `enroll_no` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `batch` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roll_no` (`roll_no`),
  UNIQUE KEY `enroll_no` (`enroll_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7764 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `subject_table`
--

DROP TABLE IF EXISTS `subject_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject_table` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `course` varchar(3) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `semester` tinyint(1) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=335 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `temp_student_table`
--

DROP TABLE IF EXISTS `temp_student_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_student_table` (
  `course` varchar(3) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `year` tinyint(1) NOT NULL,
  `section` char(1) NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `enroll_no` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  UNIQUE KEY `roll_no` (`roll_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_student_table`
--

LOCK TABLES `temp_student_table` WRITE;
/*!40000 ALTER TABLE `temp_student_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `temp_student_table` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-14 23:39:30
