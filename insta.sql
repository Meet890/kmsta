-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2025 at 02:26 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`acc_id`, `user_id`, `acc_profile_photo`, `acc_bio`, `acc_username`, `acc_password`) VALUES
(101, 1, NULL, NULL, 'meet', 'meet@123'),
(102, 1, NULL, NULL, 'Meet2', 'meet@123'),
(107, 9, '1763557153_boy.png', 'Hello i am meet ', 'Meet890', 'Meet@890'),
(109, 9, '1763556469_images.png', 'Hello i am meet ', 'Meet8890', 'Meetrn@890'),
(110, 12, '1763558039_images.png', 'hi i am krunal from Ahmedabad', 'krunal', 'krunal@123'),
(111, 12, NULL, 'hi i am krunal from Ahmedabad', 'krunal123', 'krunal@123');

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
-- Table structure for table `followers`
--

DROP TABLE IF EXISTS `followers`;
CREATE TABLE IF NOT EXISTS `followers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `follower_id` int NOT NULL,
  `following_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follower_id`, `following_id`, `created_at`) VALUES
(33, 109, 107, '2025-11-19 12:47:26'),
(24, 107, 109, '2025-11-19 10:48:13'),
(23, 107, 102, '2025-11-19 10:48:12'),
(40, 107, 101, '2025-11-20 06:02:09'),
(30, 109, 102, '2025-11-19 12:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `message_text` text NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender_id`, `receiver_id`, `message_text`, `is_read`, `created_at`) VALUES
(1, 107, 101, 'asdas', 0, '2025-11-19 14:54:33'),
(2, 107, 101, 'hello', 0, '2025-11-19 14:56:19'),
(3, 107, 101, 'hello', 0, '2025-11-20 06:02:25'),
(4, 0, 0, '', 1, '2025-11-20 06:30:31'),
(5, 0, 0, '', 0, '2025-11-20 06:38:49'),
(6, 109, 107, 'hieeee', 0, '2025-11-20 08:20:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `acc_id`, `post_type`, `post_location`, `post_caption`, `like_id`, `comment_id`) VALUES
(2, 107, 'image', 'post_691c699da33251.43570467_c076459163.jpg', 'BCA SEM-6', NULL, NULL),
(3, 107, 'image', 'post_691c69c03a77f3.79689772_9fe5c0ba18.jpg', 'SSC', NULL, NULL),
(4, 107, 'image', 'post_691c6a193350f1.90359808_1d3ac69781.jpg', 'HSC', NULL, NULL),
(5, 107, 'image', 'post_691c6b9d485d53.29661086_085c43e267.jpg', 'Lc', NULL, NULL),
(7, 107, 'image', 'post_691c7fc2400431.05158758_c37522cfd0.png', 'sadasd', NULL, NULL),
(8, 109, 'image', 'post_691ecf32ed02c9.27753607_02375f2d06.png', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE IF NOT EXISTS `post_comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(5, 8, 107, 'ad', '2025-11-20 13:59:29'),
(6, 8, 107, 'sdfsdgdsf', '2025-11-20 14:03:42'),
(7, 5, 107, 'sdgfdgdfg', '2025-11-20 14:03:59'),
(8, 8, 107, 'asdsagfdshfgh', '2025-11-20 14:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

DROP TABLE IF EXISTS `post_likes`;
CREATE TABLE IF NOT EXISTS `post_likes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`, `created_at`) VALUES
(7, 6, 9, '2025-11-20 14:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_age` int NOT NULL,
  `user_gender` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_ph` bigint DEFAULT NULL,
  `user_email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_dob` date DEFAULT NULL,
  `user_password` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email` (`user_email`),
  UNIQUE KEY `user_ph` (`user_ph`),
  KEY `Index_user_name` (`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_name`, `user_age`, `user_gender`, `user_ph`, `user_email`, `user_dob`, `user_password`) VALUES
(1, 'Meet', 24, 'Male', 7774441112, 'meetrn7890@gmail.com', '2002-11-27', 'meet@2002'),
(2, 'Krupal', 22, 'Male', 9999999989, 'krupal@gmail.com', '2004-11-27', 'krupal@123'),
(6, 'Krupal2', 22, 'Male', 9999999999, 'krupal2@gmail.com', '2004-11-27', 'krupal@123'),
(8, 'uday', 22, 'Male', 123456456, 'uday@gmail.com', '2002-11-27', 'uday@123'),
(9, 'meet', 26, 'Male', 4564564564, 'meet12@gmail.com', '2002-11-27', 'Meet@123'),
(10, 'anjli', 23, 'Female', 1112223334, 'anjli@gmail.com', '2003-11-27', 'anjli@123'),
(11, 'anjli2', 23, 'Female', 1112223335, 'anjli2@gmail.com', '2003-11-27', 'anjli@123'),
(12, 'krunal', 22, 'Male', 5656565656, 'krunal@gmail.com', '2004-11-27', 'krunal@123');

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
