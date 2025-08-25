-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 25, 2025 at 11:14 AM
-- Server version: 8.0.43
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcoop`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`%` PROCEDURE `GetAllAppointments` ()   BEGIN
	SELECT id,name,dob,phone,address,gender,preferred_date,appointment_type,preferred_time,selectDoctor,reasonForAppointment,photo FROM appointments;
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `GetAllDonations` ()   BEGIN
    SELECT id, full_name, email, phone, amount, payment_method, status FROM donations;
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `GetAllEmployees` ()   BEGIN
SELECT id,name,email,phone,address,role FROM employees;
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `GetAllUsers` ()   BEGIN
    SELECT id, name, email, password FROM users;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `category` enum('Mental','Physical','Creative','Social') NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `time` time NOT NULL,
  `participants` int NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `activity_name`, `category`, `photo`, `time`, `participants`, `location`, `created_at`) VALUES
(3, 'Play', 'Physical', '1755181630_physical.jpeg', '09:00:00', 15, 'Yangon Park', '2025-08-09 13:52:33'),
(4, 'Create With me', 'Creative', '1755181707_creative.jpg', '10:00:00', 15, 'Yangon , North Okkalapa Park', '2025-08-09 14:21:03'),
(5, 'Play With me', 'Social', '1755181720_social.jpg', '11:00:00', 18, 'Yangon , Insein Park', '2025-08-11 03:26:44'),
(6, 'Strong Mental', 'Mental', '1755181757_mental.jpg', '06:00:00', 20, 'Meikhtila park', '2025-08-11 03:35:08'),
(7, 'Hello Beginner', 'Physical', '1755233554_physical.jpeg', '10:00:00', 15, 'TaungGyi Park', '2025-08-15 04:52:34'),
(8, 'Describe Your Creation', 'Creative', '1755572014_creative.jpg', '09:30:00', 15, 'Conference Room A', '2025-08-19 02:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text,
  `gender` enum('male','female','other') NOT NULL,
  `preferred_date` date NOT NULL,
  `appointment_type` varchar(100) NOT NULL,
  `preferred_time` varchar(20) NOT NULL,
  `selectDoctor` varchar(100) NOT NULL,
  `reasonForAppointment` text,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `dob`, `phone`, `address`, `gender`, `preferred_date`, `appointment_type`, `preferred_time`, `selectDoctor`, `reasonForAppointment`, `photo`, `created_at`, `user_id`) VALUES
(36, 'PaingMya', '1920-11-11', '09750231601', 'Meikhtila', 'male', '2025-08-25', 'consultation', 'morning', 'dr-paing', 'general-checkup', 'de3eb5a138dd9ec46acf99fb86c98e17.png', '2025-08-25 10:00:05', 151),
(37, 'Laravel', '1930-11-22', '09672636439', 'Meikhtila', 'male', '2023-11-11', 'checkup', 'afternoon', 'Dr. Paing', 'general-checkup', '606499b285c3b772cca19661839efd8b.png', '2025-08-25 11:06:40', 151);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('complete','pending','not') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `full_name`, `email`, `phone`, `amount`, `payment_method`, `created_at`, `status`) VALUES
(1, 'PaingKyawMoe', 'ko@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-25 09:37:48', 'complete'),
(2, 'paing', 'admin@gmail.com', '09672636439', 250.00, 'kpay', '2025-07-25 15:17:51', 'complete'),
(3, 'mya', 'hello12@gmail.com', '09750236489', 500.00, 'wave', '2025-07-25 15:18:45', 'complete'),
(4, 'mgmg', 'kololo@gmail.com', '09750231601', 250.00, 'paypal', '2025-07-25 15:47:32', 'complete'),
(5, 'mya', 'admin@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-25 16:12:08', 'pending'),
(6, 'mya', 'konaing@gmail.com', '09672636439', 100.00, 'kpay', '2025-07-27 12:38:56', 'complete'),
(7, 'fadfaf', 'kololo@gmail.com', '09750236489', 250.00, 'paypal', '2025-07-27 12:39:29', 'complete'),
(8, 'Kyaw', 'kyawgyi@gmail.com', '09785461320', 1000.00, 'wave', '2025-07-27 15:34:05', 'complete'),
(9, 'mgmg', 'ko@gmail.com', '09785461320', 250.00, 'kpay', '2025-07-27 15:34:26', 'complete'),
(10, 'kyawkyaw', 'kyawkayw@gmail.com', '09402788771', 100.00, 'paypal', '2025-07-27 15:34:54', 'complete'),
(11, 'khinkhin', 'khin@gmial.com', '09256595765', 5000.00, 'kpay', '2025-07-27 15:35:20', 'not'),
(12, 'mimi', 'mi@gmail.com', '09784561324', 700.00, 'paypal', '2025-07-27 15:35:59', 'complete'),
(13, 'mgmg', 'hello12@gmail.com', '09256595765', 250.00, 'kpay', '2025-07-28 03:09:27', 'complete'),
(14, 'PaingKyawMoe', 'ko@gmail.com', '09750231601', 250.00, 'card', '2025-07-28 03:57:07', 'complete'),
(15, 'paing', 'paing@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-28 15:46:28', 'complete'),
(16, 'mya', 'paingkyaw@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-29 02:51:47', 'pending'),
(17, 'paing', 'ko@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-29 04:17:31', 'pending'),
(18, 'phyoe mg', 'phyoemg@gmail.com', '09456123789', 250.00, 'wave', '2025-07-29 10:13:52', 'pending'),
(19, 'mgmg', 'hello12@gmail.com', '09785461320', 500.00, 'kpay', '2025-07-30 04:30:25', 'complete'),
(20, 'PaingKyawMoe', 'konaing@gmail.com', '09256595765', 1000.00, 'kpay', '2025-07-31 05:05:12', 'not'),
(21, 'fadfaf', 'aljljaalfj@gmail.com', '09256595765', 250.00, 'paypal', '2025-07-31 14:59:00', 'complete'),
(22, 'mgmg', 'mmm@gmail.com', '09785461320', 250.00, 'kpay', '2025-08-01 05:11:09', 'complete'),
(23, 'PaingKyawMoe', 'pap@gmail.com', '09672636439', 100.00, 'kpay', '2025-08-01 09:02:42', 'complete'),
(24, 'PaingKyawMoe', 'pap@gmail.com', '09750231601', 100.00, 'kpay', '2025-08-01 09:34:40', 'complete'),
(25, 'mgmg', 'mmm@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-01 10:35:44', 'complete'),
(26, 'mgmg', 'mya@gmail.com', '09750231601', 10000.00, 'kpay', '2025-08-02 06:56:26', 'complete'),
(27, 'Kyaw', 'paingkyaw@gmail.com', '09785461320', 500.00, 'kpay', '2025-08-02 07:47:16', 'complete'),
(28, 'mgmg', 'pap@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-04 15:54:40', 'pending'),
(29, 'Kyaw', 'wwko@gmail.com', '09256595765', 1000.00, 'wave', '2025-08-04 15:55:14', 'pending'),
(30, 'mgmg', 'mmm@gmail.com', '09672636439', 500.00, 'paypal', '2025-08-04 15:56:43', 'pending'),
(31, 'fadfaf', 'mmm@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-04 16:18:10', 'complete'),
(32, 'mgmg', 'mmm@gmail.com', '09672636439', 250.00, 'card', '2025-08-05 17:02:03', 'complete'),
(33, 'Kyaw', 'paingkyaw@gmail.com', '09672636439', 500.00, 'kpay', '2025-08-05 17:02:37', 'complete'),
(34, 'kyawkyaw', 'mmm@gmail.com', '09750231601', 50.00, 'kpay', '2025-08-06 00:24:48', 'complete'),
(35, 'kyawkyaw', 'mmm@gmail.com', '09256595765', 100.00, 'kpay', '2025-08-06 01:26:41', 'complete'),
(36, 'mgmg', 'mya@gmail.com', '09750231601', 500.00, 'card', '2025-08-06 14:31:31', 'pending'),
(37, 'Kyaw', 'mmm@gmail.com', '09785461320', 250.00, 'kpay', '2025-08-08 07:28:18', 'complete'),
(38, 'test', 'wwko@gmail.com', '09750231601', 100.00, 'paypal', '2025-08-08 10:05:11', 'pending'),
(39, 'mya', 'mya@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-09 15:04:17', 'pending'),
(40, 'kyawkyaw', 'pap@gmail.com', '09256595765', 250.00, 'kpay', '2025-08-09 15:06:36', 'pending'),
(41, 'kyawkyaw', 'pap@gmail.com', '09402788771', 250.00, 'kpay', '2025-08-11 08:03:53', 'pending'),
(42, 'test', 'pap@gmail.com', '09785461320', 500.00, 'kpay', '2025-08-11 08:21:41', 'complete'),
(43, 'mgmg', 'paingkyaw@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-11 08:48:23', 'complete'),
(44, 'Kyaw', 'mya@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-11 08:52:50', 'pending'),
(45, 'Kyaw', 'kyawgyi@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-11 09:50:01', 'pending'),
(46, 'mimi', 'mmm@gmail.com', '09672636439', 250.00, 'kpay', '2025-08-12 04:39:28', 'pending'),
(47, 'mgmg', 'mya@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-12 05:08:33', 'pending'),
(48, 'mgmg', 'mya@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-12 07:29:30', 'complete'),
(49, 'test', 'pap@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-12 08:07:11', 'complete'),
(50, 'Kyaw', 'paingkyaw@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-12 08:33:56', 'complete'),
(51, 'test', 'pap@gmail.com', '09256595765', 500.00, 'paypal', '2025-08-12 15:38:45', 'complete'),
(52, 'testing', 'wwko@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-13 05:29:19', 'complete'),
(53, 'mgmg', 'mya@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-13 07:47:33', 'complete'),
(54, 'kyawkyaw', 'paingkyaw@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-13 09:43:56', 'complete'),
(55, 'test', 'kyawgyi456@gmail.com', '09402788771', 250.00, 'kpay', '2025-08-13 15:27:45', 'complete'),
(56, 'mgmg', 'mmm@gmail.com', '09785461320', 250.00, 'paypal', '2025-08-15 05:05:05', 'complete'),
(57, 'test', 'pap@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-15 07:42:04', 'complete'),
(58, 'kyawkyaw', 'kyawgyi456@gmail.com', '09750231601', 500.00, 'paypal', '2025-08-15 07:47:36', 'complete'),
(59, 'fadfaf', 'paingkyaw@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-15 07:53:11', 'complete'),
(60, 'mya', 'mya@gmail.com', '09750231601', 500.00, 'kpay', '2025-08-15 08:00:17', 'pending'),
(61, 'kyawkyaw', 'paingkyaw@gmail.com', '09750231601', 100.00, 'kpay', '2025-08-15 08:02:05', 'pending'),
(62, 'kyawkyaw', 'pap@gmail.com', '09785461320', 500.00, 'wave', '2025-08-15 08:07:17', 'complete'),
(63, 'htethtet', 'wwko@gmail.com', '09256595765', 250.00, 'kpay', '2025-08-15 08:18:09', 'complete'),
(64, 'mya', 'kyawgyi456@gmail.com', '09256595765', 500.00, 'kpay', '2025-08-15 08:21:36', 'complete'),
(65, 'kyawkyaw', 'pap@gmail.com', '09785461320', 250.00, 'kpay', '2025-08-15 08:22:02', 'complete'),
(66, 'kyawkyaw', 'paingkyaw@gmail.com', '09750231601', 50.00, 'paypal', '2025-08-15 08:25:25', 'complete'),
(67, 'mya', 'pap@gmail.com', '09672636439', 100.00, 'kpay', '2025-08-15 08:31:55', 'complete'),
(68, 'Kyaw', 'mya@gmail.com', '09256595765', 250.00, 'paypal', '2025-08-15 15:31:31', 'complete'),
(69, 'mimi', 'mi@gmail.com', '09256595765', 250.00, 'card', '2025-08-20 03:06:17', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `role` enum('doctor','caregiver','driver','staff') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `phone`, `address`, `role`, `created_at`, `updated_at`) VALUES
(31, 'Mya Thandar', 'mya12@gmail.com', '09785461320', 'Yangon', 'doctor', '2025-08-05 09:27:16', '2025-08-19 02:51:28'),
(32, 'Kyaw Moe', 'mya123@gmail.com', '09256595765', 'address', 'caregiver', '2025-08-05 09:37:15', '2025-08-05 09:37:15'),
(33, 'Kyaw Moe', 'mmm74@gmail.com', '09256595765', 'Yangon', 'staff', '2025-08-05 09:45:20', '2025-08-19 02:51:44'),
(34, 'mimi', 'mimi@gmial.com', '09672636439', 'adfadfaf', 'caregiver', '2025-08-05 10:07:11', '2025-08-05 10:07:11'),
(36, 'PaingMya', 'pap89@gmail.com', '09256595765', 'dafaf', 'doctor', '2025-08-06 05:43:52', '2025-08-07 03:23:49'),
(37, 'That Naing', 'mmm4@gmail.com', '09785461320', 'affa', 'driver', '2025-08-06 07:26:44', '2025-08-06 07:26:44'),
(38, 'PaingMya', 'paingk742@gmail.com', '09750231601', 'Yangon', 'doctor', '2025-08-06 07:58:33', '2025-08-06 07:58:33'),
(39, 'Mg Paing', 'kyawkayw1@gmail.com', '09750231601', 'Meikhtila', 'doctor', '2025-08-06 08:19:44', '2025-08-06 08:19:44'),
(40, 'KyawKyaw', 'pap85@gmail.com', '09256595765', 'meikhtila', 'staff', '2025-08-07 03:25:32', '2025-08-07 03:25:32'),
(41, 'PaingMya', 'mya@gmail.com', '09750231601', 'Yangon', 'doctor', '2025-08-07 03:34:00', '2025-08-07 03:34:00'),
(42, 'Teacher', 'afdfff@gmail.com', '09750231601', 'dadfaf', 'doctor', '2025-08-11 09:10:52', '2025-08-11 09:10:52'),
(43, 'Paing', 'pap@gmail.com', '09672636439', 'paing', 'driver', '2025-08-12 08:22:42', '2025-08-12 08:22:42'),
(44, 'Paing', 'mya1234@gmail.com', '09672636439', 'Thamine', 'caregiver', '2025-08-12 15:04:56', '2025-08-12 15:05:11'),
(45, 'Teacher', 'pap47@gmail.com', '09785461320', 'Meikhtila', 'doctor', '2025-08-12 15:42:01', '2025-08-12 15:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'User',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `verify_token` varchar(64) DEFAULT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires` datetime DEFAULT NULL,
  `verify_expires` datetime DEFAULT NULL,
  `status` enum('pending','active') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_verified`, `role_id`, `created_at`, `reset_token`, `reset_expires`, `verify_token`, `otp_code`, `otp_expires`, `verify_expires`, `status`) VALUES
(31, 'Paing P', 'paingkyaw@gmail.com', '$2y$10$BO0jaCDs2NaoIRedtD7GiO7Wa4Vgk9hB1FjJWaetYTMN0UpQo4p1m', 0, '1', '2025-08-07 07:51:11', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(32, 'Paing Kyaw', 'mya@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-07 08:51:44', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(33, 'Paing Gyi', 'pap@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-07 10:20:29', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(34, 'Phyoe Phyoe', 'phyoe@gmail.com', 'UGh5b2VAMTIz', 0, '2', '2025-08-08 08:23:52', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(35, 'Teacher', 'teacher@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-09 07:32:42', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(36, 'Teacher', 'teacher12@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-11 04:15:19', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(37, 'Phyoe', 'mya123@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-11 09:45:35', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(38, 'PaingMya', 'mya45@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-11 15:32:26', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(39, 'Phyoe Phyoe', 'phyoee@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-12 15:35:54', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(40, 'Paing', 'paingkyaw7841@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-13 09:07:13', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(41, 'MiMiKhaing', 'papmi@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-13 09:12:46', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(42, 'PaingMya', 'mya741@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-13 09:15:53', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(43, 'Phyoe Phyoe', 'mmm741@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-13 09:17:01', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(44, 'PaingK', 'wwko45@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-13 09:19:43', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(45, 'Teacher', 'mmm7894@gmail.com', 'UGFpbmdAMTIz', 0, '2', '2025-08-13 10:06:37', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(46, 'Phyoe Phyoe', 'kyawgyi456@gmail.com', '$2y$10$BO0jaCDs2NaoIRedtD7GiO7Wa4Vgk9hB1FjJWaetYTMN0UpQo4p1m', 0, '2', '2025-08-13 10:20:01', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(47, 'Phyoe K', 'phyoek@gmail.com', '$2y$10$JT/iC7aibgwijLkC/36fjejOai1NwN.L52c1HXWNZEpRcmkosRJH2', 0, '2', '2025-08-13 15:24:44', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(49, 'Teacher', 'paingkyaw1234@gmail.com', '$2y$10$SIOwrFUCxMyBfTdT9kaOD.MqxceuXOVbgFbT8mj8MdR7Xjxks9c0C', 0, '2', '2025-08-19 05:02:17', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(50, 'Phyoe Phyoe', 'phyoek12@gmail.com', '$2y$10$67YrITg9criCcuSBqsCOKuryGENmsXyZb5RmVo.mDPwQbNyt0yLPi', 0, '2', '2025-08-19 05:05:39', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(51, 'Teacher', 'pap852@gmail.com', '$2y$10$HejXlA85kxbYQwEYUBjbs.BXRXtrIjh/81/5EFXZuCFxp86rMmzWq', 0, '2', '2025-08-19 07:30:23', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(52, 'Phyoe Phyoe', 'mmm452@gmail.com', '$2y$10$tPo.jigkASlvKclH81zdOuBWCmN8lGBNdOMYXtRdQCoWe.GS5FiaG', 0, '2', '2025-08-19 07:33:07', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(53, 'Mya Thandar', 'mya784@gmail.com', '$2y$10$Y4Z9nIIOuX8JEXusPGf6WOzUzVRjtJr2Q6xJwT2sfasECidbzhXsy', 0, '2', '2025-08-19 07:36:15', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(54, 'PaingMya', 'pap451@gmail.com', '$2y$10$MD3qIORn708C3ROPEpU7JOlHcLamA03O06RMu1KM8TezXa6kW17ru', 0, '2', '2025-08-19 07:44:29', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(55, 'Teacher', 'teacher412@gmail.com', '$2y$10$7iHU7s7mZSSox2.H/9hJzOmUha6Ig6NOc02OQZmXZWUXqbiU.BWVC', 0, '2', '2025-08-19 07:50:29', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(56, 'Paing', 'mya4561@gmail.com', '$2y$10$/luvaj8MI3HS4whRJZXRtetUZWDIAZvXR6EUUZRrXpWBnz/z4PQ1S', 0, '2', '2025-08-19 07:53:21', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(57, 'Teacher', 'pap741@gmail.com', '$2y$10$gqgJ5cmuE3G6vDTQTUCg5OrLiKgtbNYSEOGXES10g8FrYvOphOqo2', 0, '2', '2025-08-19 08:01:39', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(58, 'Paing', 'pap7541@gmail.com', '$2y$10$TJ1SM0UURxwh0HQBghbMeuB5gqvmcgVoxHlqWnUKge52VMFncpb/e', 0, '2', '2025-08-19 08:12:09', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(59, 'Paing', 'pap7546@gmail.com', '$2y$10$w5d3sbbi2r9z6VkrfAMdNOnqwi/WNHKFgtUBHP8gi53wY2mGIPMmK', 0, '2', '2025-08-19 08:14:10', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(60, 'PaingMy', 'mya78456@gmail.com', '$2y$10$mqdlaGtfoBSrG9Z3pvSWbuaSSbVsgGqKnvqPzREMhGVmjy6yqKZba', 0, '2', '2025-08-19 08:17:22', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(61, 'Phyoe Phyoe', 'pap8542@gmail.com', '$2y$10$g0h/6fLB2LcadHINEZ2mK.I.8E4vBQzLoxtp/9PvY7ToL8cxkrJcO', 0, '2', '2025-08-19 08:22:33', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(62, 'Teacher', 'teacher8546@gmail.com', '$2y$10$gBc/dUSBwQKO7R7gVXvwKOSaE7Td6U.W/lyEuDpfC3v/k0aTsduwS', 0, '2', '2025-08-19 08:24:37', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(63, 'Teacher', 'mmm8546@gmail.com', '$2y$10$1P/OvyerEokCIamqI1xl1uk8It9SRzqHsnd4/SEbuTtJlGP2frJsS', 0, '2', '2025-08-19 08:27:40', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(64, 'Teacher', 'mmma@gmail.com', '$2y$10$WuOd3luEcQLtE6mClW4wp.S9D2NNCKRdlzGQAieKgR8XwJcw2Y00C', 0, '2', '2025-08-19 08:32:21', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(65, 'Mya Thandar', 'myapa@gmail.com', '$2y$10$s6GCVxHNhbBJ73RbVCyR4O.Dsw6rk7gWuPadwLF/YaZPHYt2ttuve', 0, '2', '2025-08-19 08:36:37', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(66, 'Phyoe Phyoe', 'mmmaa@gmail.com', '$2y$10$8Ze.MQmO5tEDG1bmIMoMPujlsjXGqKHL.irlfEVd0iYCN/YANud6O', 0, '2', '2025-08-19 08:40:55', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(67, 'Phyoe Phyoe', 'wwkaao@gmail.com', '$2y$10$C94pYf8CBKbj6.6dwWleE.5c3XI/iFDKwPdB3Epf6ACA5uIuBi6Ty', 0, '2', '2025-08-19 08:43:21', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(68, 'Mya Thandar', 'myaaet@gmail.com', '$2y$10$yE0zKFGObelQ1773ajvHoOb8KiAqDJeXJTiHEIKOkISdERdTQvVVG', 0, '2', '2025-08-19 08:44:20', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(69, 'PaingMya', 'myaaa1@gmail.com', '$2y$10$mgUPYl4O24MVtLwISg2m9ukdKeQTbir2WDY1T996NKQob5ZRLFcY2', 0, '2', '2025-08-19 08:50:58', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(70, 'PaingMya', 'myaaa@gmail.com', '$2y$10$ZD8ZBtMl/Nq/Uvlm88hFJObTJ5Gp.dZc5Mmd8o5fgHcKJ22NDmCUu', 0, '2', '2025-08-19 08:51:52', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(71, 'Phyoe Phyoe', 'pap45@gmail.com', '$2y$10$Xde9YVnfAJ8ZRP59ZYWnpueA4rDU/puAQ8vriYAu6bCvmKtpgsoRa', 0, '2', '2025-08-19 08:54:31', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(72, 'Tun Tun', 'tun@gmail.com', '$2y$10$mHWk94flyg7PKGo9/QI3GOVVKlJrJkC4cb3P43Ux5cNbrIX6RNQw6', 0, '2', '2025-08-19 08:56:31', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(73, 'Phyoe Kyaw', 'myakyaw@gmail.com', '$2y$10$dzsdqGREbVl.3/sBN9wft.Hpu/zWuKNHXf0SzLhG2GOjk7zlRL3RS', 0, '2', '2025-08-19 09:00:24', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(74, 'Phyoe Moe', 'pap45125@gmail.com', '$2y$10$xB2WowcVCq3eFZ7kZ1zJduFlTgnXtabCvQXHQdhY7lhzwlT9BmYpy', 0, '2', '2025-08-19 09:01:26', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(75, 'Phyoe Phyoe', 'pap451258@gmail.com', '$2y$10$FdNtniLR0qf5U4Y8SmjrFO2Eor9ZV1NgEfNSfS9.6X.4OqFZbFf4q', 0, '2', '2025-08-19 09:02:01', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(76, 'Mya Thandar', 'mmmp@gmail.com', '$2y$10$Ho8R7fqkdcOKOewee8A.CeVGqtXQuKNsaLb/lGDcg.7abC/eQRcRq', 0, '2', '2025-08-19 09:05:21', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(77, 'Ko Ko Aung', 'kokoaung@gmail.com', '$2y$10$jBzcNMhwFbKKJGqN9dURsOJ.POuIEtW/kgsnDYIf9z3y9B7/xQ0UO', 0, '2', '2025-08-19 09:13:31', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(78, 'Phyoe Phyoe', 'mya4785@gmail.com', '$2y$10$5f8Ynfu/Nj5qMV318i3.POiZeNMGG33fkwjLbsbYrgZ0TO.xzKg9.', 0, '2', '2025-08-19 10:26:57', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(79, 'Mya Thandar', 'pap7548@gmail.com', '$2y$10$5e8A/DCCXoxjGh/Ma5Of.ukuJNOLojEnyO4naqHd/MyOhpK2ajPT.', 0, '2', '2025-08-19 10:30:13', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(80, 'Phyoe Phyoe', 'pap5486@gmail.com', '$2y$10$DXVUURNBmdoxy/0KLsDHaeT68J79YacWfw85ftDRAoeUKvXmEUWMe', 0, '2', '2025-08-19 10:32:58', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(81, 'Mya Thandar', 'mya85214@gmail.com', '$2y$10$QksYxxynR6bcYUaODLjQcuULc7emcRjKtQUouiUrb5V/tfi1BLgKW', 0, '2', '2025-08-19 10:36:32', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(82, 'Teacher', 'pap7645@gmail.com', '$2y$10$jvnYwVGr9gFbpIxRCc3V1erCu4MzRONpBZyjN/TfMA0WXjIqTLHKS', 0, '2', '2025-08-19 14:16:00', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(83, 'PaingMya', 'mya7845@gmail.com', '$2y$10$Z1ivA2J0aea3mu1gecz7eutDLQsYxCCCDEhzMq9P8LPn3qFigS8JG', 0, '2', '2025-08-19 16:20:18', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(84, 'Teacher', 'mya456781@gmail.com', '$2y$10$fUjxuTwB3rfoV1J9qE9NT.PWYZJj2NeH6w7UEWirPMlst2GirafsW', 0, '2', '2025-08-19 16:21:19', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(85, 'PaingKyaw', 'mya784561@gmail.com', '$2y$10$hnAceolOOrdxdfuIU3pY2eaQJy.vL6n9kt78vQovVhNcUu4Mt6pVO', 0, '2', '2025-08-19 16:24:26', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(86, 'Phyoe Phyoe', 'mya852147@gmail.com', '$2y$10$4gv0pRSn7zuY2FCZgck6U.KlqpjFbEvmV2n28cPzL4nfoCR2.9WSu', 0, '2', '2025-08-19 16:26:40', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(87, 'Teacher', 'pap789321@gmail.com', '$2y$10$xnX.Qz9Xo2X3qS4G6WbJ6.3mNZWdbbBzkPYzOqiO8zyJyC/tezUjy', 0, '2', '2025-08-19 16:31:54', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(88, 'Mya Thandar', 'mya4658@gmail.com', '$2y$10$P1scglcK0dQpU8dWuO1XPe2dL9kA.nHZB3Dl0fKu8J2CLau/dfAiu', 0, '2', '2025-08-19 16:33:22', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(89, 'Phyoe Phyoe', 'mya8973@gmail.com', '$2y$10$xI5WWKGF9AjE.hx6r8bqFuQxMbT9vDkwcLzqlWXZUG0OG/dBZtsaa', 0, '2', '2025-08-19 16:35:07', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(90, 'Min Min', 'min@gmail.com', '$2y$10$0va1ZXNTiIm/nU1IvnfEw.wqd61LNEGXRt.u2zovp08g6A4xwho9C', 0, '2', '2025-08-20 03:02:41', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(91, 'MiMin', 'miminmin@gmail.com', '$2y$10$fQQ6/wVssM16MDZr/f5Vv..YYWn/H0WzHDqwM1N/YR5LLKwJkM7aW', 0, '2', '2025-08-20 03:04:02', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(92, 'Mya Thandar', 'mya8564@gmail.com', '$2y$10$ExVt5jDbRMm2oMJZvc3u2umPKqY7lASnKfvg2oaHEMMvdvbo9TDU2', 0, '2', '2025-08-20 03:10:59', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(93, 'Htet Htet', 'htet784@gmail.com', '$2y$10$MJhjouYYAqSe4hB4RsCRcu/0UV6Vj.ZClXcy7tn8biQGPuQiIvzlO', 0, '2', '2025-08-20 03:12:14', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(94, 'That That', 'that78@gmail.com', '$2y$10$tDN9XZgaAkxRU6VIklDwwOCA9rgmase3Ooywac1Zp2SKGkUknKm2O', 0, '2', '2025-08-20 03:16:13', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(95, 'Kyaw Kyaw', 'kyaw852@gmial.com', '$2y$10$d10MQPJu4O2j.niTPcEc0OowadKj8.v10XF9NTeYEXIUG8R2YkPVO', 0, '2', '2025-08-20 04:26:50', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(96, 'Mya Thandar', 'mya78941@gmail.com', '$2y$10$78BERKb7ICNbyUmTAx6Qde/ZspTSJnQUu34euyMFETTQcBptLUsoy', 0, '2', '2025-08-20 04:28:44', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(97, 'Phyoe Phyoe', 'phyoekkyaw@gmail.com', '$2y$10$3eVa1zdF8//1Qy3VtVBM1./mJRIo4y5J45Gr32AGZ/l9oawnHVpsy', 0, '2', '2025-08-20 04:35:14', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(98, 'Mya Thandar', 'mya964@gmail.com', '$2y$10$.NeQiAkkLaxGW1RQ.54Z4OAZLAkV9nLiZE2wzqRBdgURazFKTlrpS', 0, '2', '2025-08-20 05:40:25', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(99, 'Mya Thandar', 'mya4867@gmail.com', '$2y$10$A455PHRMYmvGmyUNHi/H2Oj7ZBxpbLA9YD3zK6Cw2xVdEPMbBsoJW', 0, '2', '2025-08-20 07:27:29', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(100, 'PaingMya', 'paingkyawmoe@gmail.com', '$2y$10$Rk9roX4hp4GfNw78B/8oTeMnyvDQHvN0ltCav4MRKry3DKd47Dn9O', 0, '2', '2025-08-20 07:43:54', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(101, 'Phyoe Phyoe', 'paingkyawm.pkm555@gmail.com', '$2y$10$rU4CukGGveX8IeRNo.3crOtql9WFawfkYmDSJ0B4//9LviUihnicW', 0, '2', '2025-08-20 07:48:55', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(103, 'Paingkyawmoe', 'paingkwmopkm555@gmail.com', '$2y$10$o0lYIKVL6HAzGvq.DgBMP.8qdAiX15qPAiGrX0KNLxdbhPxWffThm', 0, '2', '2025-08-20 08:48:07', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(104, 'Mya Thandar', 'myadaadadf@gmial.com', '$2y$10$JbM3bohrCilIf/z1hRm5eOGATMSWzpxYiMEeok5ezZGtyaXJWwNaC', 0, '2', '2025-08-20 08:52:30', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(105, 'PaingMya', 'paingkyawme@gmail.com', '$2y$10$Cf./uzgsUv.AXJhtPSAjNOT4jnL.kH1jPHNAgBodMv8n7yrgxFyKy', 0, '2', '2025-08-20 08:57:12', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(106, 'Mya Thandar', 'kyawmoe.pkm555@gmail.com', '$2y$10$lYd.VmNjoNLEz9sy6CMkhuOWHo6cw5fkw/86OMwoR.IgCzGntAZMu', 0, '2', '2025-08-20 09:02:45', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(107, 'HtetHtetWin', 'htethtetwin664@gmail.com', '$2y$10$35/zh4795QBQet2uLp02FeDzAHc0nxhHbmrIZo5ESb6QboBCozyPi', 0, '2', '2025-08-20 09:04:39', 'fc78d7a4e536112be0ca9bd8e3c57dcecc16b95d49474de4769e3f0cf146e961', '2025-08-21 06:00:47', NULL, NULL, NULL, NULL, 'pending'),
(108, 'Mi Mi', 'mimikhainglin70@gmail.com', '$2y$10$wHFJpcn4hFNebMMX3gIOTuR.zH/ONatB0DUY650HvfN8nqKrpxStS', 0, '2', '2025-08-20 09:07:34', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(109, 'Mya Thandar', 'painkyawmoepkm555@gmail.com', '$2y$10$J9ORDdQa1kFlombg3swyF.aYkJUKQtbtioM5dzm3IsSC4GGSDKyGO', 0, '2', '2025-08-20 09:11:53', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(110, 'PaingKyaw', 'paingkyaoe.pk555@gmail.com', '$2y$10$dHIKBXTBqRJ7avDqnV/87OuXW4Kun2lzrSkb0S/jT0Zjgy0NUlNy.', 0, '2', '2025-08-20 09:15:41', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(111, 'PaingMya', 'mya097@gmail.com', '$2y$10$7.b3KKAw6oj5YAP5c3YU1eIunMjG7XdsrYzL75dVuqvnJ0rNp2P7K', 0, '2', '2025-08-20 09:19:47', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(112, 'Mythandar Khaing', 'myathandar71@gmial.com', '$2y$10$.MRIAS6eKVV7B7PKm8NM4uDnXsniL5RNL3/ftA/i0dVMgi4AqyAwi', 0, '2', '2025-08-20 09:23:55', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(113, 'PaingMya', 'mya821@gmail.com', '$2y$10$NVjzAnl.pZYOFlqjeHSa7uKlowwSD18XQAGKurJjxkE/TzNdgwDMS', 0, '2', '2025-08-20 09:57:22', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(114, 'Phyoe Phyoe', 'pap475@gmail.com', '$2y$10$C1ApyUSICaoe4gePrEC6NuU0nob8JcoM3R3kCDWkRljwkU6yBWxuu', 0, '2', '2025-08-20 09:58:21', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(115, 'Kokopaing', 'mmm4578@gmail.com', '$2y$10$MzZqx3dE.WX3plGnInavSOrDthRjKDXI6imESBPWPE6kB8UsWe/hK', 0, '2', '2025-08-20 09:59:33', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(116, 'Mya Thandar', 'pap7461@gmail.com', '$2y$10$fSwP3Sf0lTYJkFi9nUeuo.FVutwozxfKSzTV.XwEFqU.5DSgn7BcW', 0, '2', '2025-08-20 10:01:32', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(117, 'Teacher', 'mmm8210@gmail.com', '$2y$10$dAsZcdrdGbpQ/ihMk/tuD.XFGjEcD8m5.lbYINRQtLFjeekfh287q', 0, '2', '2025-08-20 10:03:08', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(118, 'Mya Thandar', 'paingkyaw821@gmail.com', '$2y$10$erc02QzwFcLJY6iOdNpwYet/rymnlEEfsUEtS/Z9U424uMH6MUdiS', 0, '2', '2025-08-20 10:04:50', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(119, 'Mya Thandar', 'myathandar710@gmial.com', '$2y$10$u90xH4.BHgcrWcaWQek0oeCL4WSS7tRRDel/EFJUj6kuOwm6qVdfm', 0, '2', '2025-08-21 03:18:29', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(120, 'Paingkyawmoe', 'pagkyawmoe.pkm555@gmail.com', '$2y$10$PNJPi0xpr.4t02A/Z/NHdODqG96yBhOQdhME0uEWmTdVTYFEgY2/G', 0, '2', '2025-08-21 03:22:17', 'e725c77abcda3048528389ba582d74b56fa9319fe8a0cbb05d12845a3965983b', '2025-08-21 05:54:32', NULL, NULL, NULL, NULL, 'pending'),
(121, 'Phone Mya', 'phyone@gmail.com', '$2y$10$1BmEUiWp9eQCSNUrAEKYMOXKrHmw/jHKqTJ.53bOF/lRmpA1xpG.a', 0, '2', '2025-08-21 03:24:49', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(122, 'Phyoe Phyoe', 'pap846@gmail.com', '$2y$10$/UKMU1okvwXqab.CdgYSx.xKXRl2hdXADYUEF9xfuVn6oSG/LI5ve', 0, '2', '2025-08-21 03:43:46', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(123, 'PaingMya', 'paing1kyawmoe.pkm555@gmail.com', '$2y$10$K2msrDek2UkG6zp3OSh2ruc2ZXOdloyqALHjE6ZtlYW2.4K/ZdvD2', 0, '2', '2025-08-21 04:57:41', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(124, 'PaingkyawMoe', 'paingkyawoe.pkm555@gmail.com', '$2y$10$M3oOiuSPlSa1BMa.KteQkeRxspuyQ5Pv5qFgHc0NPIQxo72Y/g7ES', 0, '2', '2025-08-21 05:25:01', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(125, 'Mg Htun', 'moe.pkm555@gmail.com', '$2y$10$iXetXoHp/POWm415ZveP7udxFu0CTdHfb5Y5DREm9Yb9gt/q.7z9.', 0, '2', '2025-08-22 03:03:55', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(126, 'Mya Thandar', 'myathandar710@gmail.com', '$2y$10$fDbmCh/pxkoHdCutSXC2/ulPiyYJx5b/NXeNhW8mjqWyhGT3VgIne', 0, '2', '2025-08-22 03:10:30', 'a1f78e0077489504063b1c2a298b2348e20dcb85151a731e8bed08268719bfb0', '2025-08-22 05:21:03', NULL, NULL, NULL, NULL, 'pending'),
(127, 'Mya Thandar', 'paingawmoe.pkm555@gmail.com', '$2y$10$86qQ5O/w/YozEILXa.nCWumkjhizZALNP18U9goqp.yz15GEaKGW2', 0, '2', '2025-08-23 03:36:35', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(128, 'KyawMoe', 'wmoe.pkm555@gmail.com', '$2y$10$14PIV39rZjqPk0a6utdWq.O9ja4A4/91Ot7Y2./aiZVM2qwUjkhmu', 0, '2', '2025-08-24 10:20:00', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(129, 'Mya Thandar', 'mya.pkm555@gmail.com', '$2y$10$r3nlsJkA32BpeI9yVmnJh.jjhwO.VCUbf.kbNmBKXHxlzRjJA.kWS', 0, '2', '2025-08-24 10:25:39', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(130, 'Teacher', 'painyawmoe.pkm555@gmail.com', '$2y$10$fxpYW4RMgbvdkZA7vHNTDOMFpVlNluKzcY0BJX/x4FlwhRMg8Qul.', 0, '2', '2025-08-24 10:35:28', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(131, 'PaingkyawMoe', 'paingkyawmoe.p@gmail.com', '$2y$10$rE4dZL8wB0J50cBoLFjkieqriKHFKHFRJAh.Lja3ir7LDadZYZsLW', 0, '2', '2025-08-24 12:01:04', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(132, 'Mya Thandar', 'paingk.pkm555@gmail.com', '$2y$10$Umd.nUTlIeXSxbRwiKDtvezVQNf.ER6CedK0FcJprbwDkIWuECtvK', 0, '2', '2025-08-24 12:03:25', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(133, 'Paingkyawmoe', 'painoe.pkm555@gmail.com', '$2y$10$OvApT2tHCECMA8BRji6RLO0imhXL2h7I5vNQQBHCkNgT09yFWteye', 0, '2', '2025-08-24 12:15:01', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(134, 'PaingMya', 'paingkyawmoe.pkm5@gmail.com', '$2y$10$ky5a5tLNJ5gBN1yMddIi1eiXWYDdo3LAlhKEuKIKc2mgFCVjsROle', 0, '2', '2025-08-24 12:19:48', NULL, NULL, NULL, NULL, NULL, NULL, 'pending'),
(135, 'Mya Thandar', 'paingkyaw5@gmail.com', '$2y$10$N.e2LnM2pcehaZLRy.B1FeLEkF//htG3FeN3VY.cgn0bJninE2f9e', 1, '2', '2025-08-24 12:27:12', NULL, NULL, NULL, NULL, NULL, NULL, 'active'),
(136, 'Paingkyawmoe', 'pkm555@gmail.com', '$2y$10$678Z/T4JYWOmCjHORGsIreq2opOEXqInia84Xyz5YHSh6lU0Ta3mG', 1, '2', '2025-08-24 12:44:04', NULL, NULL, NULL, NULL, NULL, NULL, 'active'),
(148, 'Mya Thandar', 'paingkya.pkm555@gmail.com', '$2y$10$HNmQ.yfJoe9zXrYhcwzqbOAk9cuyAwdFlCzy1Fnr/7d7D4rM6aYd2', 1, '2', '2025-08-24 15:08:20', NULL, NULL, NULL, NULL, NULL, NULL, 'active'),
(149, 'Paing', 'paingkyawe.pkm555@gmail.com', '$2y$10$PioA6aNzgTvZqLoGcC7V1O2iBPM4VgGySHzKewVENHhVs0rkjHpaC', 1, '2', '2025-08-24 15:13:13', NULL, NULL, NULL, NULL, NULL, NULL, 'active'),
(151, 'PaingMya', 'paingkyawmoe.pkm5555@gmail.com', '$2y$10$WJMAcRwhNHTeCsT4XxE2eu/A0DWSI4Grhl/kVc1EttNrVAWSil1fy', 1, '2', '2025-08-25 09:49:20', NULL, NULL, NULL, NULL, NULL, NULL, 'active'),
(152, 'PaingMya', 'paingkyawmoe.pkm555@gmail.com', '$2y$10$gJAUlTcXU2n7R44dLOjz0Oy3bpu7GG4Ug3nAh6MQzC4y1RjH6u50i', 1, '2', '2025-08-25 11:08:09', NULL, NULL, NULL, NULL, NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_with_roles`
-- (See below for the actual view)
--
CREATE TABLE `user_with_roles` (
`created_at` timestamp
,`email` varchar(100)
,`role_id` int
,`role_name` varchar(255)
,`user_id` int
,`user_name` varchar(100)
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_appointment` (`user_id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

-- --------------------------------------------------------

--
-- Structure for view `user_with_roles`
--
DROP TABLE IF EXISTS `user_with_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `user_with_roles`  AS SELECT `users`.`id` AS `user_id`, `users`.`name` AS `user_name`, `users`.`email` AS `email`, `users`.`created_at` AS `created_at`, `roles`.`id` AS `role_id`, `roles`.`name` AS `role_name` FROM (`users` join `roles` on((`users`.`role_id` = `roles`.`id`))) ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_user_appointment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
