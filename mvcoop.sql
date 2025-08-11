-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 11, 2025 at 03:34 PM
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
(3, 'Walking', 'Physical', '1754747553_wave pay.jpg', '09:00:00', 16, 'Yangon 123 street to 124 street', '2025-08-09 13:52:33'),
(4, 'Create With me', 'Creative', '1754749263_paypal.png', '09:51:00', 13, 'Yangon , North Okkalapa Park', '2025-08-09 14:21:03'),
(5, 'Play With me', 'Social', '1754882804_kpay.png', '22:57:00', 18, 'Yangon , Insein Park', '2025-08-11 03:26:44'),
(6, 'Happy With Me', 'Mental', '1754883308_Seafoam.jpg', '23:06:00', 10, 'Meikhtila', '2025-08-11 03:35:08');

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
(9, 'Aung', '1940-07-09', '09785461320', 'yangon', 'female', '2025-07-30', 'followup', 'evening', 'Dr. Kyaw', 'prescription-refill', 'personal (1).png', '2025-07-29 10:23:28'),
(10, 'Paing', '1930-07-23', '09750231601', 'yangon', 'male', '2025-07-31', 'followup', 'evening', 'Dr. Kyaw', 'symptoms', 'paypal.png', '2025-07-30 04:33:35'),
(11, 'Aung Nyein', '1940-07-09', '09751654789', 'kalaw', 'male', '2025-07-31', 'consultation', 'morning', 'dr-paing', 'prescription-refill', 'paing.jpg', '2025-07-30 09:00:48'),
(12, 'Aung Nyein Chann', '1930-07-14', '097-502-31601', 'Meikhtila', 'female', '2025-07-31', 'checkup', 'evening', 'Dr. Kyaw', 'prescription-refill', 'paing.jpg', '2025-07-30 09:06:08'),
(13, 'That Naing', '1920-07-22', '09750231601', 'Meikhtila', 'male', '2025-07-29', 'checkup', 'evening', 'dr-paing', 'prescription-refill', 'paypal.png', '2025-07-31 04:21:31'),
(14, 'That Naing', '1925-07-22', '09750231601', 'yangon', 'male', '2025-07-31', 'checkup', 'afternoon', 'dr-paing', 'symptoms', 'kpay.png', '2025-07-31 04:31:07'),
(15, 'That Naing', '1927-07-22', '09750231601', 'yangon', 'male', '2025-07-31', 'checkup', 'afternoon', 'dr-paing', 'general-checkup', 'paypal.png', '2025-07-31 04:35:19'),
(16, 'That Naing', '1929-07-22', '09750231601', 'Meikhtila ', 'male', '2025-07-31', 'followup', 'morning', 'dr-paing', 'prescription-refill', 'credit.png', '2025-07-31 05:08:49'),
(17, 'That Naing', '1930-07-18', '09750231601', 'Meikhtila', 'female', '2025-07-31', 'consultation', 'afternoon', 'Dr. Paing', 'general-checkup', 'paypal.png', '2025-07-31 13:55:23'),
(18, 'PaingMya', '1930-07-22', '09402788771', 'Meikhtila ', 'male', '2025-08-02', 'followup', 'evening', 'dr-paing', 'symptoms', 'Seafoam.jpg', '2025-08-01 05:13:03'),
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
(29, 'PaingMya', '1930-08-08', '09256595765', 'mandalay', 'male', '2025-08-09', 'consultation', 'morning', 'dr-moe', 'prescription-refill', 'desk.jpg', '2025-08-08 05:13:49'),
(30, 'Paing Paing', '1930-07-07', '09256595765', 'Meikhtila', 'male', '2025-08-09', 'followup', 'evening', 'dr-moe', 'prescription-refill', 'Seafoam.jpg', '2025-08-08 05:16:05'),
(31, 'PaingMya', '1935-08-08', '09750231601', 'Meikhtila ', 'male', '2025-08-10', 'followup', 'evening', 'dr-paing', 'prescription-refill', 'kpay.png', '2025-08-09 15:11:40'),
(32, 'PaingMya', '1940-03-03', '09750231601', 'Meikhtila    ', 'male', '2025-08-12', 'followup', 'afternoon', 'dr-paing', 'symptoms', 'paypal.png', '2025-08-11 14:35:29');

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
(4, 'mgmg', 'kololo@gmail.com', '09750231601', 250.00, 'paypal', '2025-07-25 15:47:32', 'not'),
(5, 'mya', 'admin@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-25 16:12:08', 'pending'),
(6, 'mya', 'konaing@gmail.com', '09672636439', 100.00, 'kpay', '2025-07-27 12:38:56', 'complete'),
(7, 'fadfaf', 'kololo@gmail.com', '09750236489', 250.00, 'paypal', '2025-07-27 12:39:29', 'pending'),
(8, 'Kyaw', 'kyawgyi@gmail.com', '09785461320', 1000.00, 'wave', '2025-07-27 15:34:05', 'pending'),
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
(45, 'Kyaw', 'kyawgyi@gmail.com', '09750231601', 250.00, 'kpay', '2025-08-11 09:50:01', 'pending');

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
(24, 'Mya Thandar', 'wwko@gmail.com', '09256595765', 'adfaf', 'driver', '2025-08-05 08:36:58', '2025-08-11 14:48:49'),
(25, 'Mya Thandar', 'paingkyaw@gmail.com', '09672636439', 'Taunggyi', 'doctor', '2025-08-05 08:52:04', '2025-08-07 06:50:32'),
(26, 'Kyaw Moe', 'pap12@gmail.com', '09785461320', 'ssssss', 'caregiver', '2025-08-05 08:52:42', '2025-08-05 08:52:42'),
(28, 'Kyaw Moe', 'wwko12@gmail.com', '09256595765', 'adfaf', 'caregiver', '2025-08-05 09:08:28', '2025-08-11 14:38:04'),
(29, 'Mya Thandar', 'pap45@gmail.com', '09672636439', 'daf', 'driver', '2025-08-05 09:09:53', '2025-08-05 09:09:53'),
(30, 'Mya Thandar', 'aljljaalfjkk@gmail.com', '09750231601', 'sadad', 'doctor', '2025-08-05 09:12:31', '2025-08-05 09:12:31'),
(31, 'myathandar', 'mya12@gmail.com', '09785461320', 'daefefe', 'doctor', '2025-08-05 09:27:16', '2025-08-05 09:27:16'),
(32, 'Kyaw Moe', 'mya123@gmail.com', '09256595765', 'address', 'caregiver', '2025-08-05 09:37:15', '2025-08-05 09:37:15'),
(33, 'Kyaw Moe', 'mmm74@gmail.com', '09256595765', 'asdffa', 'staff', '2025-08-05 09:45:20', '2025-08-05 09:45:20'),
(34, 'mimi', 'mimi@gmial.com', '09672636439', 'adfadfaf', 'caregiver', '2025-08-05 10:07:11', '2025-08-05 10:07:11'),
(36, 'PaingMya', 'pap89@gmail.com', '09256595765', 'dafaf', 'doctor', '2025-08-06 05:43:52', '2025-08-07 03:23:49'),
(37, 'That Naing', 'mmm4@gmail.com', '09785461320', 'affa', 'driver', '2025-08-06 07:26:44', '2025-08-06 07:26:44'),
(38, 'PaingMya', 'paingk742@gmail.com', '09750231601', 'Yangon', 'doctor', '2025-08-06 07:58:33', '2025-08-06 07:58:33'),
(39, 'Mg Paing', 'kyawkayw1@gmail.com', '09750231601', 'Meikhtila', 'doctor', '2025-08-06 08:19:44', '2025-08-06 08:19:44'),
(40, 'KyawKyaw', 'pap85@gmail.com', '09256595765', 'meikhtila', 'staff', '2025-08-07 03:25:32', '2025-08-07 03:25:32'),
(41, 'PaingMya', 'mya@gmail.com', '09750231601', 'Yangon', 'doctor', '2025-08-07 03:34:00', '2025-08-07 03:34:00'),
(42, 'Teacher', 'afdfff@gmail.com', '09750231601', 'dadfaf', 'doctor', '2025-08-11 09:10:52', '2025-08-11 09:10:52');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role_id`, `created_at`) VALUES
(31, 'Paing P', 'paingkyaw@gmail.com', 'UGFpbmdAMTIz', '1', '2025-08-07 07:51:11'),
(32, 'Paing Kyaw', 'mya@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-07 08:51:44'),
(33, 'Paing Gyi', 'pap@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-07 10:20:29'),
(34, 'Phyoe Phyoe', 'phyoe@gmail.com', 'UGh5b2VAMTIz', '2', '2025-08-08 08:23:52'),
(35, 'Teacher', 'teacher@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-09 07:32:42'),
(36, 'Teacher', 'teacher12@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-11 04:15:19'),
(37, 'Phyoe', 'mya123@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-11 09:45:35'),
(38, 'PaingMya', 'mya45@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-11 15:32:26');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
