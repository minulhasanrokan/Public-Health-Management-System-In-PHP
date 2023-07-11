-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 11, 2023 at 07:08 PM
-- Server version: 8.0.27
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

DROP TABLE IF EXISTS `accountant`;
CREATE TABLE IF NOT EXISTS `accountant` (
  `accountant_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL,
  `v_status` tinyint(1) NOT NULL DEFAULT '0',
  `code` int NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`accountant_id`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `address`, `phone`, `description`, `image`, `status`) VALUES
(1, 'Md. Minul Hasan Rokan', 'admin@gmail.com', 'f6fdffe48c908deb0f4c3bd36c032e72', '<p>Dhakas</p>', '+8801627197089', '<h1>sssssssssssss</h1>', 'Md.-Minul-Hasan-Rokan92705516d2.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admit`
--

DROP TABLE IF EXISTS `admit`;
CREATE TABLE IF NOT EXISTS `admit` (
  `admit_id` int NOT NULL AUTO_INCREMENT,
  `appointment_no` varchar(255) NOT NULL,
  `appointment_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `admit_date` date NOT NULL,
  `floor_id` int NOT NULL,
  `bed_id` int NOT NULL,
  `description` text NOT NULL,
  `release_status` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `release_date` date DEFAULT NULL,
  PRIMARY KEY (`admit_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `appointment_number` varchar(255) NOT NULL,
  `patient_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `nurse_id` int NOT NULL,
  `shedule_id` int NOT NULL,
  `shedule_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `accept_status` tinyint(1) NOT NULL DEFAULT '0',
  `test_data` text NOT NULL,
  `admit_id` int NOT NULL DEFAULT '0',
  `next_visit_date` date DEFAULT NULL,
  `need_to_admit` tinyint(1) NOT NULL DEFAULT '0',
  `doctor_comment` text,
  `doctor_comment_status` tinyint(1) NOT NULL DEFAULT '0',
  `report_status` tinyint(1) NOT NULL DEFAULT '0',
  `bill_status` tinyint(1) NOT NULL DEFAULT '0',
  `complete_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

DROP TABLE IF EXISTS `bed`;
CREATE TABLE IF NOT EXISTS `bed` (
  `bed_id` int NOT NULL AUTO_INCREMENT,
  `floor_id` int NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `book_status` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`bed_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bed_fee`
--

DROP TABLE IF EXISTS `bed_fee`;
CREATE TABLE IF NOT EXISTS `bed_fee` (
  `fee_id` int NOT NULL AUTO_INCREMENT,
  `floor_id` int NOT NULL,
  `bed_id` int NOT NULL,
  `bed_fee` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `bill_id` int NOT NULL AUTO_INCREMENT,
  `particular_no` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `particular_id` int NOT NULL,
  `bill_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fee` double NOT NULL,
  `pay_type` varchar(255) NOT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bill_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `birth_report`
--

DROP TABLE IF EXISTS `birth_report`;
CREATE TABLE IF NOT EXISTS `birth_report` (
  `birth_report_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `sex` varchar(255) NOT NULL,
  `report_date` date NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_at` datetime NOT NULL,
  PRIMARY KEY (`birth_report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

DROP TABLE IF EXISTS `blood_group`;
CREATE TABLE IF NOT EXISTS `blood_group` (
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_last_given_blood` date NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `blood_group_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`blood_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `dead_report`
--

DROP TABLE IF EXISTS `dead_report`;
CREATE TABLE IF NOT EXISTS `dead_report` (
  `dead_report_id` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `report_date` date NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_at` datetime NOT NULL,
  PRIMARY KEY (`dead_report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` int NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL,
  `v_status` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `certificate` varchar(255) NOT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_fee`
--

DROP TABLE IF EXISTS `doctor_fee`;
CREATE TABLE IF NOT EXISTS `doctor_fee` (
  `fee_id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `doctor_fee` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_history`
--

DROP TABLE IF EXISTS `doctor_history`;
CREATE TABLE IF NOT EXISTS `doctor_history` (
  `history_id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` int NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `certificate` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `ac_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`history_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `floor`
--

DROP TABLE IF EXISTS `floor`;
CREATE TABLE IF NOT EXISTS `floor` (
  `floor_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `department` int NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` smallint NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`floor_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorist`
--

DROP TABLE IF EXISTS `laboratorist`;
CREATE TABLE IF NOT EXISTS `laboratorist` (
  `laboratorist_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL,
  `v_status` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`laboratorist_id`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `laboratorist`
--

INSERT INTO `laboratorist` (`laboratorist_id`, `name`, `speciality`, `mobile`, `email`, `address`, `description`, `image`, `status`, `published_status`, `created_at`, `token`, `v_status`, `password`, `code`) VALUES
(1, 'Md. Minul Hasan Rokan', '0swedrt cgnhjhkj eerutuyu', '01627197089', 'admin@gmail.com', '<p>adssfg</p>', '<p>sdfcv n</p>', 'Md.-Minul-Hasan-Rokan288a40c0a7.jpg', 1, 1, '2022-11-26 20:13:28', '7c6d644d76dca97ffe6fa9cfa2d3cc92', 1, 'f6fdffe48c908deb0f4c3bd36c032e72', '372138');

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

DROP TABLE IF EXISTS `log_history`;
CREATE TABLE IF NOT EXISTS `log_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type` int NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `login_status` int NOT NULL,
  `login_time` datetime NOT NULL,
  `log_out_status` int NOT NULL,
  `log_out_time` datetime NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

DROP TABLE IF EXISTS `medicine`;
CREATE TABLE IF NOT EXISTS `medicine` (
  `medicine_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `description` text NOT NULL,
  `buy_price` int NOT NULL,
  `regular_price` int NOT NULL,
  `sale_price` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`medicine_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_category`
--

DROP TABLE IF EXISTS `medicine_category`;
CREATE TABLE IF NOT EXISTS `medicine_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `medicine_category`
--

INSERT INTO `medicine_category` (`category_id`, `name`, `title`, `description`, `image`, `status`, `created_at`, `published_status`) VALUES
(4, 'Anesthetics', 'Hormonal agents (prostaglandins)', '<h2>Where can I get some?</h2>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', 'Anesthetics-medicine-category-1e8c70ce0e.png', 1, '2023-04-01 16:55:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `notice_id` int NOT NULL AUTO_INCREMENT,
  `notice_date` date DEFAULT NULL,
  `user_type` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `file_type` varchar(50) DEFAULT NULL,
  `file_url` varchar(255) DEFAULT NULL,
  `department_id` int NOT NULL,
  `published_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`notice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `nurse`
--

DROP TABLE IF EXISTS `nurse`;
CREATE TABLE IF NOT EXISTS `nurse` (
  `nurse_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `doctor_id` int NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL,
  `v_status` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`nurse_id`),
  UNIQUE KEY `mobile` (`mobile`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `birth_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `blood_group` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_opening_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `v_status` tinyint(1) NOT NULL DEFAULT '0',
  `v_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `dead_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

DROP TABLE IF EXISTS `pharmacist`;
CREATE TABLE IF NOT EXISTS `pharmacist` (
  `pharmacist_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token` varchar(255) NOT NULL,
  `v_status` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`pharmacist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int NOT NULL AUTO_INCREMENT,
  `appointment_no` varchar(255) NOT NULL,
  `appointment_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `report_date` date NOT NULL,
  `description` text NOT NULL,
  `laboratorist_id` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `test_id` int NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `shedule`
--

DROP TABLE IF EXISTS `shedule`;
CREATE TABLE IF NOT EXISTS `shedule` (
  `shedule_id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `nurse_id` int NOT NULL,
  `shedule_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `appointment_id` int DEFAULT NULL,
  `complete_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`shedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3240 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `test_fee`
--

DROP TABLE IF EXISTS `test_fee`;
CREATE TABLE IF NOT EXISTS `test_fee` (
  `fee_id` int NOT NULL AUTO_INCREMENT,
  `test_id` int NOT NULL,
  `test_fee` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `test_type`
--

DROP TABLE IF EXISTS `test_type`;
CREATE TABLE IF NOT EXISTS `test_type` (
  `test_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `published_status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
