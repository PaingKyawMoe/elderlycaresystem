-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 21, 2025 at 07:37 AM
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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `name`, `dob`, `phone`, `address`, `gender`, `preferred_date`, `appointment_type`, `preferred_time`, `selectDoctor`, `reasonForAppointment`, `photo`, `created_at`) VALUES
(9, 'Aung', '1940-07-09', '09785461320', 'yangon', 'male', '2025-07-30', 'followup', 'evening', 'Dr. Paing', 'prescription-refill', 'personal (1).png', '2025-07-29 10:23:28'),
(10, 'Paing', '1930-07-23', '09750231601', 'yangon', 'male', '2025-07-31', 'followup', 'evening', 'Dr. Kyaw', 'symptoms', 'paypal.png', '2025-07-30 04:33:35'),
(11, 'Aung Nyein', '1940-07-09', '09751654789', 'kalaw', 'male', '2025-07-31', 'consultation', 'morning', 'Dr. Phyoe', 'prescription-refill', 'paing.jpg', '2025-07-30 09:00:48'),
(12, 'Aung Nyein Chann', '1930-07-14', '09750231601', 'Meikhtila', 'female', '2025-07-31', 'checkup', 'evening', 'Dr. Kyaw', 'prescription-refill', 'paing.jpg', '2025-07-30 09:06:08'),
(13, 'That Naing', '1920-07-22', '09750231601', 'Meikhtila', 'male', '2025-07-29', 'checkup', 'evening', 'dr-paing', 'prescription-refill', 'paypal.png', '2025-07-31 04:21:31'),
(14, 'That Naing', '1925-07-22', '09750231601', 'yangon', 'male', '2025-07-31', 'checkup', 'afternoon', 'Dr. Paing', 'symptoms', 'kpay.png', '2025-07-31 04:31:07'),
(15, 'That Naing', '1927-07-22', '09750231601', 'yangon', 'male', '2025-07-31', 'checkup', 'afternoon', 'Dr. Paing', 'general-checkup', 'paypal.png', '2025-07-31 04:35:19'),
(16, 'That Naing', '1929-07-22', '09750231605', 'Meikhtila', 'male', '2025-07-31', 'followup', 'morning', 'Dr. Paing', 'prescription-refill', 'credit.png', '2025-07-31 05:08:49'),
(17, 'That Naing', '1930-07-18', '09750231601', 'Meikhtila', 'female', '2025-07-31', 'consultation', 'afternoon', 'Dr. Paing', 'general-checkup', 'paypal.png', '2025-07-31 13:55:23'),
(18, 'PaingMya', '1930-07-22', '09402788771', 'Meikhtila', 'male', '2025-08-02', 'followup', 'evening', 'Dr. Mya', 'symptoms', 'Seafoam.jpg', '2025-08-01 05:13:03'),
(19, 'PaingMya', '1930-08-08', '09750231601', 'Meikhtila    ', 'male', '2025-08-02', 'checkup', 'afternoon', 'dr-kyaw', 'prescription-refill', 'Seafoam.jpg', '2025-08-01 09:05:16'),
(20, 'PaingMya', '1930-08-01', '09750231601', 'Meikhtila', 'male', '2025-08-06', 'checkup', 'afternoon', 'dr-kyaw', 'general-checkup', 'Seafoam.jpg', '2025-08-01 09:37:00'),
(21, 'Paing', '1920-08-08', '09750231601', 'Meikhtila', 'male', '2025-08-03', 'checkup', 'evening', 'Dr. Moe', 'prescription-refill', 'Seafoam.jpg', '2025-08-02 06:59:22'),
(22, 'Mya Thandar', '1920-08-07', '09256595765', 'mandalay', 'male', '2025-08-05', 'consultation', 'evening', 'dr-paing', 'prescription-refill', 'wave pay.jpg', '2025-08-04 14:12:54'),
(23, 'PaingMya', '1940-08-08', '09750231601', 'Meikhtila ', 'male', '2025-08-05', 'followup', 'evening', 'dr-phyoe', 'prescription-refill', 'kpay.png', '2025-08-04 14:58:00'),
(24, 'Kyaw Moe', '1920-08-01', '09785461320', 'mandalay', 'male', '2025-08-06', 'followup', 'morning', 'dr-paing', 'prescription-refill', 'kpay.png', '2025-08-04 14:58:58'),
(25, 'Paing12', '1920-01-02', '09750231601', 'Meikhtila ', 'male', '2025-08-05', 'followup', 'evening', 'dr-phyoe', 'prescription-refill', 'kpay.png', '2025-08-04 15:23:34'),
(26, 'DoDo', '1920-05-09', '09750231601', 'Meikhtila', 'male', '2025-08-05', 'checkup', 'afternoon', 'Dr. Paing', 'prescription-refill', 'wave pay.jpg', '2025-08-04 15:30:57'),
(27, 'Mya Thandar', '1920-06-06', '09785461320', 'mandalay', 'male', '2025-08-08', 'checkup', 'evening', 'dr-phyoe', 'prescription-refill', 'credit.png', '2025-08-06 08:28:14'),
(28, 'Ko Ko', '1925-08-08', '09750231608', 'Meikhtila', 'male', '2025-08-14', 'followup', 'evening', 'Dr. Moe', 'prescription-refill', 'kpay.png', '2025-08-08 04:55:31'),
(29, 'PaingMya', '1930-08-08', '09256595765', 'mandalay', 'male', '2025-08-09', 'consultation', 'morning', 'Dr. Paing', 'prescription-refill', 'desk.jpg', '2025-08-08 05:13:49'),
(30, 'Paing Paing', '1930-07-07', '09256595765', 'Meikhtila', 'male', '2025-08-09', 'followup', 'evening', 'Dr. Paing', 'prescription-refill', 'Seafoam.jpg', '2025-08-08 05:16:05'),
(31, 'PaingMya', '1935-08-08', '09750231601', 'Meikhtila', 'male', '2025-08-10', 'followup', 'evening', 'Dr. Phyoe', 'prescription-refill', 'kpay.png', '2025-08-09 15:11:40'),
(32, 'PaingMya', '1940-03-03', '09750231601', 'Meikhtila', 'male', '2025-08-12', 'followup', 'afternoon', 'Dr. Phyoe', 'symptoms', 'paypal.png', '2025-08-11 14:35:29'),
(33, 'Painggyi', '1930-08-08', '09750231603', 'Meikhtila', 'male', '2025-08-15', 'followup', 'evening', 'Dr. Phyoe', 'prescription-refill', 'people.png', '2025-08-14 14:50:56'),
(34, 'MIMI', '1930-08-08', '09750231702', 'Meikhtila', 'male', '2025-08-19', 'checkup', 'evening', 'Dr. Paing', 'prescription-refill', '5ca20f1efb2e23a33252ec39c8c19cc6.png', '2025-08-18 04:24:15'),
(35, 'PaingMya', '1928-08-08', '09750231601', 'Meikhtila', 'male', '2025-08-20', 'checkup', 'evening', 'Dr. Paing', 'prescription-refill', 'd5dc50e03e5c16c855a395a2946c8714.png', '2025-08-19 16:10:52');

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
(62, 'kyawkyaw', 'pap@gmail.com', '09785461320', 500.00, 'wave', '2025-08-15 08:07:17', 'pending'),
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
  `role_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'User',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `created_at`, `reset_token`, `reset_expires`) VALUES
(31, 'Paing P', 'paingkyaw@gmail.com', '$2y$10$BO0jaCDs2NaoIRedtD7GiO7Wa4Vgk9hB1FjJWaetYTMN0UpQo4p1m', '1', '2025-08-07 07:51:11', NULL, NULL),
(32, 'Paing Kyaw', 'mya@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-07 08:51:44', NULL, NULL),
(33, 'Paing Gyi', 'pap@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-07 10:20:29', NULL, NULL),
(34, 'Phyoe Phyoe', 'phyoe@gmail.com', 'UGh5b2VAMTIz', '2', '2025-08-08 08:23:52', NULL, NULL),
(35, 'Teacher', 'teacher@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-09 07:32:42', NULL, NULL),
(36, 'Teacher', 'teacher12@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-11 04:15:19', NULL, NULL),
(37, 'Phyoe', 'mya123@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-11 09:45:35', NULL, NULL),
(38, 'PaingMya', 'mya45@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-11 15:32:26', NULL, NULL),
(39, 'Phyoe Phyoe', 'phyoee@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-12 15:35:54', NULL, NULL),
(40, 'Paing', 'paingkyaw7841@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-13 09:07:13', NULL, NULL),
(41, 'MiMiKhaing', 'papmi@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-13 09:12:46', NULL, NULL),
(42, 'PaingMya', 'mya741@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-13 09:15:53', NULL, NULL),
(43, 'Phyoe Phyoe', 'mmm741@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-13 09:17:01', NULL, NULL),
(44, 'PaingK', 'wwko45@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-13 09:19:43', NULL, NULL),
(45, 'Teacher', 'mmm7894@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-13 10:06:37', NULL, NULL),
(46, 'Phyoe Phyoe', 'kyawgyi456@gmail.com', '$2y$10$BO0jaCDs2NaoIRedtD7GiO7Wa4Vgk9hB1FjJWaetYTMN0UpQo4p1m', '2', '2025-08-13 10:20:01', NULL, NULL),
(47, 'Phyoe K', 'phyoek@gmail.com', '$2y$10$JT/iC7aibgwijLkC/36fjejOai1NwN.L52c1HXWNZEpRcmkosRJH2', '2', '2025-08-13 15:24:44', NULL, NULL),
(49, 'Teacher', 'paingkyaw1234@gmail.com', '$2y$10$SIOwrFUCxMyBfTdT9kaOD.MqxceuXOVbgFbT8mj8MdR7Xjxks9c0C', '2', '2025-08-19 05:02:17', NULL, NULL),
(50, 'Phyoe Phyoe', 'phyoek12@gmail.com', '$2y$10$67YrITg9criCcuSBqsCOKuryGENmsXyZb5RmVo.mDPwQbNyt0yLPi', '2', '2025-08-19 05:05:39', NULL, NULL),
(51, 'Teacher', 'pap852@gmail.com', '$2y$10$HejXlA85kxbYQwEYUBjbs.BXRXtrIjh/81/5EFXZuCFxp86rMmzWq', '2', '2025-08-19 07:30:23', NULL, NULL),
(52, 'Phyoe Phyoe', 'mmm452@gmail.com', '$2y$10$tPo.jigkASlvKclH81zdOuBWCmN8lGBNdOMYXtRdQCoWe.GS5FiaG', '2', '2025-08-19 07:33:07', NULL, NULL),
(53, 'Mya Thandar', 'mya784@gmail.com', '$2y$10$Y4Z9nIIOuX8JEXusPGf6WOzUzVRjtJr2Q6xJwT2sfasECidbzhXsy', '2', '2025-08-19 07:36:15', NULL, NULL),
(54, 'PaingMya', 'pap451@gmail.com', '$2y$10$MD3qIORn708C3ROPEpU7JOlHcLamA03O06RMu1KM8TezXa6kW17ru', '2', '2025-08-19 07:44:29', NULL, NULL),
(55, 'Teacher', 'teacher412@gmail.com', '$2y$10$7iHU7s7mZSSox2.H/9hJzOmUha6Ig6NOc02OQZmXZWUXqbiU.BWVC', '2', '2025-08-19 07:50:29', NULL, NULL),
(56, 'Paing', 'mya4561@gmail.com', '$2y$10$/luvaj8MI3HS4whRJZXRtetUZWDIAZvXR6EUUZRrXpWBnz/z4PQ1S', '2', '2025-08-19 07:53:21', NULL, NULL),
(57, 'Teacher', 'pap741@gmail.com', '$2y$10$gqgJ5cmuE3G6vDTQTUCg5OrLiKgtbNYSEOGXES10g8FrYvOphOqo2', '2', '2025-08-19 08:01:39', NULL, NULL),
(58, 'Paing', 'pap7541@gmail.com', '$2y$10$TJ1SM0UURxwh0HQBghbMeuB5gqvmcgVoxHlqWnUKge52VMFncpb/e', '2', '2025-08-19 08:12:09', NULL, NULL),
(59, 'Paing', 'pap7546@gmail.com', '$2y$10$w5d3sbbi2r9z6VkrfAMdNOnqwi/WNHKFgtUBHP8gi53wY2mGIPMmK', '2', '2025-08-19 08:14:10', NULL, NULL),
(60, 'PaingMy', 'mya78456@gmail.com', '$2y$10$mqdlaGtfoBSrG9Z3pvSWbuaSSbVsgGqKnvqPzREMhGVmjy6yqKZba', '2', '2025-08-19 08:17:22', NULL, NULL),
(61, 'Phyoe Phyoe', 'pap8542@gmail.com', '$2y$10$g0h/6fLB2LcadHINEZ2mK.I.8E4vBQzLoxtp/9PvY7ToL8cxkrJcO', '2', '2025-08-19 08:22:33', NULL, NULL),
(62, 'Teacher', 'teacher8546@gmail.com', '$2y$10$gBc/dUSBwQKO7R7gVXvwKOSaE7Td6U.W/lyEuDpfC3v/k0aTsduwS', '2', '2025-08-19 08:24:37', NULL, NULL),
(63, 'Teacher', 'mmm8546@gmail.com', '$2y$10$1P/OvyerEokCIamqI1xl1uk8It9SRzqHsnd4/SEbuTtJlGP2frJsS', '2', '2025-08-19 08:27:40', NULL, NULL),
(64, 'Teacher', 'mmma@gmail.com', '$2y$10$WuOd3luEcQLtE6mClW4wp.S9D2NNCKRdlzGQAieKgR8XwJcw2Y00C', '2', '2025-08-19 08:32:21', NULL, NULL),
(65, 'Mya Thandar', 'myapa@gmail.com', '$2y$10$s6GCVxHNhbBJ73RbVCyR4O.Dsw6rk7gWuPadwLF/YaZPHYt2ttuve', '2', '2025-08-19 08:36:37', NULL, NULL),
(66, 'Phyoe Phyoe', 'mmmaa@gmail.com', '$2y$10$8Ze.MQmO5tEDG1bmIMoMPujlsjXGqKHL.irlfEVd0iYCN/YANud6O', '2', '2025-08-19 08:40:55', NULL, NULL),
(67, 'Phyoe Phyoe', 'wwkaao@gmail.com', '$2y$10$C94pYf8CBKbj6.6dwWleE.5c3XI/iFDKwPdB3Epf6ACA5uIuBi6Ty', '2', '2025-08-19 08:43:21', NULL, NULL),
(68, 'Mya Thandar', 'myaaet@gmail.com', '$2y$10$yE0zKFGObelQ1773ajvHoOb8KiAqDJeXJTiHEIKOkISdERdTQvVVG', '2', '2025-08-19 08:44:20', NULL, NULL),
(69, 'PaingMya', 'myaaa1@gmail.com', '$2y$10$mgUPYl4O24MVtLwISg2m9ukdKeQTbir2WDY1T996NKQob5ZRLFcY2', '2', '2025-08-19 08:50:58', NULL, NULL),
(70, 'PaingMya', 'myaaa@gmail.com', '$2y$10$ZD8ZBtMl/Nq/Uvlm88hFJObTJ5Gp.dZc5Mmd8o5fgHcKJ22NDmCUu', '2', '2025-08-19 08:51:52', NULL, NULL),
(71, 'Phyoe Phyoe', 'pap45@gmail.com', '$2y$10$Xde9YVnfAJ8ZRP59ZYWnpueA4rDU/puAQ8vriYAu6bCvmKtpgsoRa', '2', '2025-08-19 08:54:31', NULL, NULL),
(72, 'Tun Tun', 'tun@gmail.com', '$2y$10$mHWk94flyg7PKGo9/QI3GOVVKlJrJkC4cb3P43Ux5cNbrIX6RNQw6', '2', '2025-08-19 08:56:31', NULL, NULL),
(73, 'Phyoe Kyaw', 'myakyaw@gmail.com', '$2y$10$dzsdqGREbVl.3/sBN9wft.Hpu/zWuKNHXf0SzLhG2GOjk7zlRL3RS', '2', '2025-08-19 09:00:24', NULL, NULL),
(74, 'Phyoe Moe', 'pap45125@gmail.com', '$2y$10$xB2WowcVCq3eFZ7kZ1zJduFlTgnXtabCvQXHQdhY7lhzwlT9BmYpy', '2', '2025-08-19 09:01:26', NULL, NULL),
(75, 'Phyoe Phyoe', 'pap451258@gmail.com', '$2y$10$FdNtniLR0qf5U4Y8SmjrFO2Eor9ZV1NgEfNSfS9.6X.4OqFZbFf4q', '2', '2025-08-19 09:02:01', NULL, NULL),
(76, 'Mya Thandar', 'mmmp@gmail.com', '$2y$10$Ho8R7fqkdcOKOewee8A.CeVGqtXQuKNsaLb/lGDcg.7abC/eQRcRq', '2', '2025-08-19 09:05:21', NULL, NULL),
(77, 'Ko Ko Aung', 'kokoaung@gmail.com', '$2y$10$jBzcNMhwFbKKJGqN9dURsOJ.POuIEtW/kgsnDYIf9z3y9B7/xQ0UO', '2', '2025-08-19 09:13:31', NULL, NULL),
(78, 'Phyoe Phyoe', 'mya4785@gmail.com', '$2y$10$5f8Ynfu/Nj5qMV318i3.POiZeNMGG33fkwjLbsbYrgZ0TO.xzKg9.', '2', '2025-08-19 10:26:57', NULL, NULL),
(79, 'Mya Thandar', 'pap7548@gmail.com', '$2y$10$5e8A/DCCXoxjGh/Ma5Of.ukuJNOLojEnyO4naqHd/MyOhpK2ajPT.', '2', '2025-08-19 10:30:13', NULL, NULL),
(80, 'Phyoe Phyoe', 'pap5486@gmail.com', '$2y$10$DXVUURNBmdoxy/0KLsDHaeT68J79YacWfw85ftDRAoeUKvXmEUWMe', '2', '2025-08-19 10:32:58', NULL, NULL),
(81, 'Mya Thandar', 'mya85214@gmail.com', '$2y$10$QksYxxynR6bcYUaODLjQcuULc7emcRjKtQUouiUrb5V/tfi1BLgKW', '2', '2025-08-19 10:36:32', NULL, NULL),
(82, 'Teacher', 'pap7645@gmail.com', '$2y$10$jvnYwVGr9gFbpIxRCc3V1erCu4MzRONpBZyjN/TfMA0WXjIqTLHKS', '2', '2025-08-19 14:16:00', NULL, NULL),
(83, 'PaingMya', 'mya7845@gmail.com', '$2y$10$Z1ivA2J0aea3mu1gecz7eutDLQsYxCCCDEhzMq9P8LPn3qFigS8JG', '2', '2025-08-19 16:20:18', NULL, NULL),
(84, 'Teacher', 'mya456781@gmail.com', '$2y$10$fUjxuTwB3rfoV1J9qE9NT.PWYZJj2NeH6w7UEWirPMlst2GirafsW', '2', '2025-08-19 16:21:19', NULL, NULL),
(85, 'PaingKyaw', 'mya784561@gmail.com', '$2y$10$hnAceolOOrdxdfuIU3pY2eaQJy.vL6n9kt78vQovVhNcUu4Mt6pVO', '2', '2025-08-19 16:24:26', NULL, NULL),
(86, 'Phyoe Phyoe', 'mya852147@gmail.com', '$2y$10$4gv0pRSn7zuY2FCZgck6U.KlqpjFbEvmV2n28cPzL4nfoCR2.9WSu', '2', '2025-08-19 16:26:40', NULL, NULL),
(87, 'Teacher', 'pap789321@gmail.com', '$2y$10$xnX.Qz9Xo2X3qS4G6WbJ6.3mNZWdbbBzkPYzOqiO8zyJyC/tezUjy', '2', '2025-08-19 16:31:54', NULL, NULL),
(88, 'Mya Thandar', 'mya4658@gmail.com', '$2y$10$P1scglcK0dQpU8dWuO1XPe2dL9kA.nHZB3Dl0fKu8J2CLau/dfAiu', '2', '2025-08-19 16:33:22', NULL, NULL),
(89, 'Phyoe Phyoe', 'mya8973@gmail.com', '$2y$10$xI5WWKGF9AjE.hx6r8bqFuQxMbT9vDkwcLzqlWXZUG0OG/dBZtsaa', '2', '2025-08-19 16:35:07', NULL, NULL),
(90, 'Min Min', 'min@gmail.com', '$2y$10$0va1ZXNTiIm/nU1IvnfEw.wqd61LNEGXRt.u2zovp08g6A4xwho9C', '2', '2025-08-20 03:02:41', NULL, NULL),
(91, 'MiMin', 'miminmin@gmail.com', '$2y$10$fQQ6/wVssM16MDZr/f5Vv..YYWn/H0WzHDqwM1N/YR5LLKwJkM7aW', '2', '2025-08-20 03:04:02', NULL, NULL),
(92, 'Mya Thandar', 'mya8564@gmail.com', '$2y$10$ExVt5jDbRMm2oMJZvc3u2umPKqY7lASnKfvg2oaHEMMvdvbo9TDU2', '2', '2025-08-20 03:10:59', NULL, NULL),
(93, 'Htet Htet', 'htet784@gmail.com', '$2y$10$MJhjouYYAqSe4hB4RsCRcu/0UV6Vj.ZClXcy7tn8biQGPuQiIvzlO', '2', '2025-08-20 03:12:14', NULL, NULL),
(94, 'That That', 'that78@gmail.com', '$2y$10$tDN9XZgaAkxRU6VIklDwwOCA9rgmase3Ooywac1Zp2SKGkUknKm2O', '2', '2025-08-20 03:16:13', NULL, NULL),
(95, 'Kyaw Kyaw', 'kyaw852@gmial.com', '$2y$10$d10MQPJu4O2j.niTPcEc0OowadKj8.v10XF9NTeYEXIUG8R2YkPVO', '2', '2025-08-20 04:26:50', NULL, NULL),
(96, 'Mya Thandar', 'mya78941@gmail.com', '$2y$10$78BERKb7ICNbyUmTAx6Qde/ZspTSJnQUu34euyMFETTQcBptLUsoy', '2', '2025-08-20 04:28:44', NULL, NULL),
(97, 'Phyoe Phyoe', 'phyoekkyaw@gmail.com', '$2y$10$3eVa1zdF8//1Qy3VtVBM1./mJRIo4y5J45Gr32AGZ/l9oawnHVpsy', '2', '2025-08-20 04:35:14', NULL, NULL),
(98, 'Mya Thandar', 'mya964@gmail.com', '$2y$10$.NeQiAkkLaxGW1RQ.54Z4OAZLAkV9nLiZE2wzqRBdgURazFKTlrpS', '2', '2025-08-20 05:40:25', NULL, NULL),
(99, 'Mya Thandar', 'mya4867@gmail.com', '$2y$10$A455PHRMYmvGmyUNHi/H2Oj7ZBxpbLA9YD3zK6Cw2xVdEPMbBsoJW', '2', '2025-08-20 07:27:29', NULL, NULL),
(100, 'PaingMya', 'paingkyawmoe@gmail.com', '$2y$10$Rk9roX4hp4GfNw78B/8oTeMnyvDQHvN0ltCav4MRKry3DKd47Dn9O', '2', '2025-08-20 07:43:54', NULL, NULL),
(101, 'Phyoe Phyoe', 'paingkyawm.pkm555@gmail.com', '$2y$10$rU4CukGGveX8IeRNo.3crOtql9WFawfkYmDSJ0B4//9LviUihnicW', '2', '2025-08-20 07:48:55', NULL, NULL),
(103, 'Paingkyawmoe', 'paingkwmopkm555@gmail.com', '$2y$10$o0lYIKVL6HAzGvq.DgBMP.8qdAiX15qPAiGrX0KNLxdbhPxWffThm', '2', '2025-08-20 08:48:07', NULL, NULL),
(104, 'Mya Thandar', 'myadaadadf@gmial.com', '$2y$10$JbM3bohrCilIf/z1hRm5eOGATMSWzpxYiMEeok5ezZGtyaXJWwNaC', '2', '2025-08-20 08:52:30', NULL, NULL),
(105, 'PaingMya', 'paingkyawme@gmail.com', '$2y$10$Cf./uzgsUv.AXJhtPSAjNOT4jnL.kH1jPHNAgBodMv8n7yrgxFyKy', '2', '2025-08-20 08:57:12', NULL, NULL),
(106, 'Mya Thandar', 'kyawmoe.pkm555@gmail.com', '$2y$10$lYd.VmNjoNLEz9sy6CMkhuOWHo6cw5fkw/86OMwoR.IgCzGntAZMu', '2', '2025-08-20 09:02:45', NULL, NULL),
(107, 'HtetHtetWin', 'htethtetwin664@gmail.com', '$2y$10$35/zh4795QBQet2uLp02FeDzAHc0nxhHbmrIZo5ESb6QboBCozyPi', '2', '2025-08-20 09:04:39', 'fc78d7a4e536112be0ca9bd8e3c57dcecc16b95d49474de4769e3f0cf146e961', '2025-08-21 06:00:47'),
(108, 'Mi Mi', 'mimikhainglin70@gmail.com', '$2y$10$wHFJpcn4hFNebMMX3gIOTuR.zH/ONatB0DUY650HvfN8nqKrpxStS', '2', '2025-08-20 09:07:34', NULL, NULL),
(109, 'Mya Thandar', 'painkyawmoepkm555@gmail.com', '$2y$10$J9ORDdQa1kFlombg3swyF.aYkJUKQtbtioM5dzm3IsSC4GGSDKyGO', '2', '2025-08-20 09:11:53', NULL, NULL),
(110, 'PaingKyaw', 'paingkyawmoe.pk555@gmail.com', '$2y$10$dHIKBXTBqRJ7avDqnV/87OuXW4Kun2lzrSkb0S/jT0Zjgy0NUlNy.', '2', '2025-08-20 09:15:41', NULL, NULL),
(111, 'PaingMya', 'mya097@gmail.com', '$2y$10$7.b3KKAw6oj5YAP5c3YU1eIunMjG7XdsrYzL75dVuqvnJ0rNp2P7K', '2', '2025-08-20 09:19:47', NULL, NULL),
(112, 'Mythandar Khaing', 'myathandar71@gmial.com', '$2y$10$.MRIAS6eKVV7B7PKm8NM4uDnXsniL5RNL3/ftA/i0dVMgi4AqyAwi', '2', '2025-08-20 09:23:55', NULL, NULL),
(113, 'PaingMya', 'mya821@gmail.com', '$2y$10$NVjzAnl.pZYOFlqjeHSa7uKlowwSD18XQAGKurJjxkE/TzNdgwDMS', '2', '2025-08-20 09:57:22', NULL, NULL),
(114, 'Phyoe Phyoe', 'pap475@gmail.com', '$2y$10$C1ApyUSICaoe4gePrEC6NuU0nob8JcoM3R3kCDWkRljwkU6yBWxuu', '2', '2025-08-20 09:58:21', NULL, NULL),
(115, 'Kokopaing', 'mmm4578@gmail.com', '$2y$10$MzZqx3dE.WX3plGnInavSOrDthRjKDXI6imESBPWPE6kB8UsWe/hK', '2', '2025-08-20 09:59:33', NULL, NULL),
(116, 'Mya Thandar', 'pap7461@gmail.com', '$2y$10$fSwP3Sf0lTYJkFi9nUeuo.FVutwozxfKSzTV.XwEFqU.5DSgn7BcW', '2', '2025-08-20 10:01:32', NULL, NULL),
(117, 'Teacher', 'mmm8210@gmail.com', '$2y$10$dAsZcdrdGbpQ/ihMk/tuD.XFGjEcD8m5.lbYINRQtLFjeekfh287q', '2', '2025-08-20 10:03:08', NULL, NULL),
(118, 'Mya Thandar', 'paingkyaw821@gmail.com', '$2y$10$erc02QzwFcLJY6iOdNpwYet/rymnlEEfsUEtS/Z9U424uMH6MUdiS', '2', '2025-08-20 10:04:50', NULL, NULL),
(119, 'Mya Thandar', 'myathandar710@gmial.com', '$2y$10$u90xH4.BHgcrWcaWQek0oeCL4WSS7tRRDel/EFJUj6kuOwm6qVdfm', '2', '2025-08-21 03:18:29', NULL, NULL),
(120, 'Paingkyawmoe', 'pagkyawmoe.pkm555@gmail.com', '$2y$10$PNJPi0xpr.4t02A/Z/NHdODqG96yBhOQdhME0uEWmTdVTYFEgY2/G', '2', '2025-08-21 03:22:17', 'e725c77abcda3048528389ba582d74b56fa9319fe8a0cbb05d12845a3965983b', '2025-08-21 05:54:32'),
(121, 'Phone Mya', 'phyone@gmail.com', '$2y$10$1BmEUiWp9eQCSNUrAEKYMOXKrHmw/jHKqTJ.53bOF/lRmpA1xpG.a', '2', '2025-08-21 03:24:49', NULL, NULL),
(122, 'Phyoe Phyoe', 'pap846@gmail.com', '$2y$10$/UKMU1okvwXqab.CdgYSx.xKXRl2hdXADYUEF9xfuVn6oSG/LI5ve', '2', '2025-08-21 03:43:46', NULL, NULL),
(123, 'PaingMya', 'paing1kyawmoe.pkm555@gmail.com', '$2y$10$K2msrDek2UkG6zp3OSh2ruc2ZXOdloyqALHjE6ZtlYW2.4K/ZdvD2', '2', '2025-08-21 04:57:41', NULL, NULL),
(124, 'PaingkyawMoe', 'paingkyawmoe.pkm555@gmail.com', '$2y$10$G4G64m5QN/Bzgtbmn4tnQOEKKrJ2MRzk3bsKzMgZTz6CcssATIFvW', '2', '2025-08-21 05:25:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_with_roles`
-- (See below for the actual view)
--
CREATE TABLE `user_with_roles` (
`user_id` int
,`user_name` varchar(100)
,`email` varchar(100)
,`created_at` timestamp
,`role_id` int
,`role_name` varchar(255)
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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

-- --------------------------------------------------------

--
-- Structure for view `user_with_roles`
--
DROP TABLE IF EXISTS `user_with_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `user_with_roles`  AS SELECT `users`.`id` AS `user_id`, `users`.`name` AS `user_name`, `users`.`email` AS `email`, `users`.`created_at` AS `created_at`, `roles`.`id` AS `role_id`, `roles`.`name` AS `role_name` FROM (`users` join `roles` on((`users`.`role_id` = `roles`.`id`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
