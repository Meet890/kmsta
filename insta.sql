-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 17, 2025 at 01:15 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insta`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `acc_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `acc_profile_photo` varchar(200) NOT NULL,
  `post_id` varchar(200) NOT NULL,
  `acc_bio` varchar(200) NOT NULL,
  `acc_username` varchar(200) NOT NULL,
  `acc_password` varchar(200) NOT NULL,
  PRIMARY KEY (`acc_id`),
  UNIQUE KEY `acc_username` (`acc_username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
CREATE TABLE IF NOT EXISTS `block` (
  `block_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `block_to` longtext NOT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comm_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `comm_by` longtext NOT NULL,
  PRIMARY KEY (`comm_id`),
  KEY `comm_by` (`comm_by`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
  `foll_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int NOT NULL,
  `foll_followers` longtext NOT NULL,
  `foll_following` longtext NOT NULL,
  PRIMARY KEY (`foll_id`),
  KEY `foll_followers` (`foll_followers`(250)),
  KEY `foll_following` (`foll_following`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int NOT NULL,
  `post_id` int NOT NULL,
  `like_by` longtext NOT NULL,
  UNIQUE KEY `like_by` (`like_by`(250)) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_request`
--

DROP TABLE IF EXISTS `pending_request`;
CREATE TABLE IF NOT EXISTS `pending_request` (
  `req_id` int NOT NULL AUTO_INCREMENT,
  `req_type` varchar(200) NOT NULL,
  `req_sender` int NOT NULL,
  `req_receiver` int NOT NULL,
  `req_status` varchar(1) NOT NULL,
  PRIMARY KEY (`req_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `post_type` varchar(200) NOT NULL,
  `post_location` varchar(200) NOT NULL,
  `like_id` int NOT NULL,
  `comment_id` int NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_age` int NOT NULL,
  `user_gender` varchar(5) NOT NULL,
  `user_ph` bigint DEFAULT NULL,
  `user_email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_ph` (`user_ph`),
  KEY `Index_user_name` (`user_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
