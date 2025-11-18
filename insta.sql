-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 18, 2025 at 12:44 PM
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
  `acc_profile_photo` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `acc_bio` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `acc_username` varchar(200) NOT NULL,
  `acc_password` varchar(200) NOT NULL,
  PRIMARY KEY (`acc_id`),
  UNIQUE KEY `acc_username` (`acc_username`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `user_id`, `acc_profile_photo`, `acc_bio`, `acc_username`, `acc_password`) VALUES
(101, 1, NULL, NULL, 'meet', 'meet@123'),
(102, 1, NULL, NULL, 'Meet2', 'meet@123'),
(107, 9, '', 'Hello i am meet ', 'Meet890', 'Meet@890'),
(109, 9, '', 'Hello i am meet ', 'Meet8890', 'Meetrn@890');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

DROP TABLE IF EXISTS `block`;
CREATE TABLE IF NOT EXISTS `block` (
  `block_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int DEFAULT NULL,
  `block_to` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`block_id`),
  UNIQUE KEY `block_to` (`block_to`(250)) USING BTREE,
  KEY `acc_id` (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comm_id` int NOT NULL AUTO_INCREMENT,
  `post_id` int DEFAULT NULL,
  `comm_by` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`comm_id`),
  KEY `comm_by` (`comm_by`(250)),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  KEY `foll_following` (`foll_following`(250)),
  KEY `acc_id` (`acc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `like_id` int NOT NULL,
  `post_id` int NOT NULL,
  `like_by` longtext NOT NULL,
  PRIMARY KEY (`like_id`),
  UNIQUE KEY `like_by` (`like_by`(250)) USING BTREE,
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`req_id`),
  KEY `req_sender` (`req_sender`,`req_receiver`),
  KEY `req_receiver` (`req_receiver`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `acc_id` int NOT NULL,
  `post_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `post_location` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `post_caption` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `like_id` int DEFAULT NULL,
  `comment_id` int DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `like_id` (`like_id`,`comment_id`),
  KEY `acc_id` (`acc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `acc_id`, `post_type`, `post_location`, `post_caption`, `like_id`, `comment_id`) VALUES
(2, 107, 'image', 'post_691c699da33251.43570467_c076459163.jpg', 'BCA SEM-6', NULL, NULL),
(3, 107, 'image', 'post_691c69c03a77f3.79689772_9fe5c0ba18.jpg', 'SSC', NULL, NULL),
(4, 107, 'image', 'post_691c6a193350f1.90359808_1d3ac69781.jpg', 'HSC', NULL, NULL);

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
  `user_password` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_ph` (`user_ph`),
  KEY `Index_user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_age`, `user_gender`, `user_ph`, `user_email`, `user_dob`, `user_password`) VALUES
(1, 'Meet', 24, 'Male', 7774441112, 'meetrn7890@gmail.com', '2002-11-27', 'meet@2002'),
(2, 'Krupal', 22, 'male', 9999999989, 'krupal@gmail.com', '2004-11-27', 'krupal@123'),
(6, 'Krupal2', 22, 'male', 9999999999, 'krupal2@gmail.com', '2004-11-27', 'krupal@123'),
(8, 'uday', 22, 'male', 123456456, 'uday@gmail.com', '2002-11-27', 'uday@123'),
(9, 'meet', 24, 'male', 4564564564, 'meet12@gmail.com', '2002-11-27', 'Meet@123'),
(10, 'anjli', 23, 'femal', 1112223334, 'anjli@gmail.com', '2003-11-27', 'anjli@123'),
(11, 'anjli2', 23, 'femal', 1112223335, 'anjli2@gmail.com', '2003-11-27', 'anjli@123');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `block`
--
ALTER TABLE `block`
  ADD CONSTRAINT `block_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;

--
-- Constraints for table `pending_request`
--
ALTER TABLE `pending_request`
  ADD CONSTRAINT `pending_request_ibfk_1` FOREIGN KEY (`req_sender`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pending_request_ibfk_2` FOREIGN KEY (`req_receiver`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`acc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
