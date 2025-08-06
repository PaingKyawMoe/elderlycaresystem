-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 06, 2025 at 08:37 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` enum('Physical','Mental','Social','Creative') NOT NULL,
  `time` time NOT NULL,
  `duration` int NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `image` varchar(500) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `description`, `category`, `time`, `duration`, `status`, `image`, `created_at`) VALUES
(5, 'Happy exercise', 'happy exercise', 'Physical', '01:00:00', 20, 'active', NULL, '2025-08-01 05:29:08'),
(8, 'myathandar', 'dafa', 'Physical', '10:20:00', 15, 'active', 'https://images.unsplash.com/photo-1551559347-b2df2a690bd5?w=500&amp;auto=format&amp;fit=crop&amp;q=60&amp;ixlib=rb-4.1.0&amp;ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8ZWxkZXJseWNhcmV8ZW58MHx8MHx8fDA%3D', '2025-08-01 09:48:32'),
(9, 'paing', 'paing', 'Physical', '12:30:00', 25, 'active', NULL, '2025-08-02 04:59:42'),
(10, 'That naing', 'dfdffd', 'Mental', '00:34:00', 45, 'active', NULL, '2025-08-02 05:03:53'),
(11, 'HELLO', 'HELLO', 'Social', '12:45:00', 30, 'active', NULL, '2025-08-02 05:13:28'),
(18, 'daff', 'afaf', 'Social', '05:43:00', 20, 'active', NULL, '2025-08-02 09:13:16'),
(19, 'happy', 'Hello', 'Mental', '16:00:00', 30, 'active', 'https://media.istockphoto.com/id/2157359681/photo/lake-sunshine-and-kayak-with-old-couple-nature-and-retirement-with-happiness-getaway-trip-and.webp?a=1&amp;amp;b=1&amp;amp;s=612x612&amp;amp;w=0&amp;amp;k=20&amp;amp;c=GyB1u1afum24aJPfBynWEC4730lYNu_lfhALavttfMc=', '2025-08-06 08:32:20');

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
(5, 'Teacher', '1940-07-16', '09256595765', 'mandalay', 'female', '2025-07-30', 'followup', 'morning', 'Dr. Paing', 'general-checkup', 'paypal.png', '2025-07-28 15:40:32'),
(7, 'Paing Kyaw Moe', '1920-07-23', '09750231601', 'Meikhtila    ', 'male', '2025-07-23', 'followup', 'evening', 'dr-moe', 'symptoms', 'credit.png', '2025-07-29 03:09:19'),
(8, 'Paing Kyaw Moe', '1920-07-23', '09750231601', 'Meikhtila', 'male', '2025-07-23', 'followup', 'evening', 'Dr. Phyoe', 'symptoms', 'credit.png', '2025-07-29 03:09:53'),
(9, 'Aung Nyein Chann', '1940-07-09', '09785461320', 'yangon', 'male', '2025-07-30', 'followup', 'evening', 'Dr. Kyaw', 'prescription-refill', 'personal (1).png', '2025-07-29 10:23:28'),
(10, 'Paing Kyaw Moe', '1930-07-23', '09750231601', 'yangon', 'male', '2025-07-31', 'followup', 'evening', 'dr-moe', 'symptoms', 'paypal.png', '2025-07-30 04:33:35'),
(11, 'Aung Nyein', '1940-07-09', '09751654789', 'kalaw', 'male', '2025-07-31', 'consultation', 'morning', 'dr-paing', 'prescription-refill', 'paing.jpg', '2025-07-30 09:00:48'),
(12, 'Aung Nyein Chann', '1930-07-14', '097-502-31601', 'Meikhtila    ', 'male', '2025-07-31', 'checkup', 'evening', 'dr-mya', 'prescription-refill', 'paing.jpg', '2025-07-30 09:06:08'),
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
(27, 'Mya Thandar', '1920-06-06', '09785461320', 'mandalay', 'male', '2025-08-08', 'checkup', 'evening', 'dr-phyoe', 'prescription-refill', 'credit.png', '2025-08-06 08:28:14');

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
(5, 'mya', 'admin@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-25 16:12:08', 'complete'),
(6, 'mya', 'konaing@gmail.com', '09672636439', 100.00, 'kpay', '2025-07-27 12:38:56', 'not'),
(7, 'fadfaf', 'kololo@gmail.com', '09750236489', 250.00, 'paypal', '2025-07-27 12:39:29', 'not'),
(8, 'Kyaw', 'kyawgyi@gmail.com', '09785461320', 1000.00, 'wave', '2025-07-27 15:34:05', 'pending'),
(9, 'mgmg', 'ko@gmail.com', '09785461320', 250.00, 'kpay', '2025-07-27 15:34:26', 'not'),
(10, 'kyawkyaw', 'kyawkayw@gmail.com', '09402788771', 100.00, 'paypal', '2025-07-27 15:34:54', 'pending'),
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
(35, 'kyawkyaw', 'mmm@gmail.com', '09256595765', 100.00, 'kpay', '2025-08-06 01:26:41', 'complete');

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
(23, 'Kyaw Moe', 'aljljaalfj@gmail.com', '09785461320', 'w3333', 'doctor', '2025-08-05 08:26:10', '2025-08-05 08:26:10'),
(24, 'Mya Thandar', 'wwko@gmail.com', '09256595765', 'adfaf', 'caregiver', '2025-08-05 08:36:58', '2025-08-05 08:36:58'),
(25, 'Mya Thandar', 'paingkyaw@gmail.com', '09672636439', 'dsaddad', 'doctor', '2025-08-05 08:52:04', '2025-08-05 08:52:04'),
(26, 'Kyaw Moe', 'pap12@gmail.com', '09785461320', 'ssssss', 'caregiver', '2025-08-05 08:52:42', '2025-08-05 08:52:42'),
(28, 'Kyaw Moe', 'wwko12@gmail.com', '09256595765', 'adfaf', 'doctor', '2025-08-05 09:08:28', '2025-08-05 09:08:28'),
(29, 'Mya Thandar', 'pap45@gmail.com', '09672636439', 'daf', 'driver', '2025-08-05 09:09:53', '2025-08-05 09:09:53'),
(30, 'Mya Thandar', 'aljljaalfjkk@gmail.com', '09750231601', 'sadad', 'doctor', '2025-08-05 09:12:31', '2025-08-05 09:12:31'),
(31, 'myathandar', 'mya12@gmail.com', '09785461320', 'daefefe', 'doctor', '2025-08-05 09:27:16', '2025-08-05 09:27:16'),
(32, 'Kyaw Moe', 'mya123@gmail.com', '09256595765', 'address', 'caregiver', '2025-08-05 09:37:15', '2025-08-05 09:37:15'),
(33, 'Kyaw Moe', 'mmm74@gmail.com', '09256595765', 'asdffa', 'staff', '2025-08-05 09:45:20', '2025-08-05 09:45:20'),
(34, 'mimi', 'mimi@gmial.com', '09672636439', 'adfadfaf', 'caregiver', '2025-08-05 10:07:11', '2025-08-05 10:07:11'),
(36, 'PaingMya', 'pap89@gmail.com', '09256595765', 'dafaf', 'caregiver', '2025-08-06 05:43:52', '2025-08-06 05:43:52'),
(37, 'That Naing', 'mmm4@gmail.com', '09785461320', 'affa', 'driver', '2025-08-06 07:26:44', '2025-08-06 07:26:44'),
(38, 'PaingMya', 'paingk742@gmail.com', '09750231601', 'Yangon', 'doctor', '2025-08-06 07:58:33', '2025-08-06 07:58:33'),
(39, 'Mg Paing', 'kyawkayw1@gmail.com', '09750231601', 'Meikhtila', 'doctor', '2025-08-06 08:19:44', '2025-08-06 08:19:44');

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
(6, 'Paing Kyaw Moe', 'paing@gmail.com', 'UGFpbmdAMTIz', '1', '2025-07-28 05:16:25'),
(7, 'Hello Paing', 'hello123@gmail.com', 'SGVsbG9AMTIzNA==', '2', '2025-07-28 09:13:50'),
(8, 'Paing Kyaw', 'paingkyaw@gmail.com', 'UGFpbmdAMTIz', '1', '2025-07-28 15:35:39'),
(9, 'Paing Kyaw Moe', 'ko1234@gmail.com', 'UGFpbmdAMTIz', '2', '2025-07-29 04:22:38'),
(10, 'Phyoe mg', 'phyoemg@gmail.com', 'Phyoemg@123', '2', '2025-07-29 10:15:09'),
(11, 'Kyawgyi', 'kyawgyi@gmail.com', 'Kyaw@123', '2', '2025-07-29 10:34:37'),
(12, 'Paing Kyaw Moe', 'pap@gmail.com', 'UGFpbmdAMTIzNA==', '2', '2025-07-30 04:32:35'),
(13, 'Paing Kyaw Moe', 'ko@gmail.com', 'UGFpbmdAMTIz', '2', '2025-07-30 08:19:46'),
(14, 'Paing Kyaw Moe', 'wwwko@gmail.com', 'UGFpbmdAMTIz', '2', '2025-07-30 08:38:42'),
(15, 'Paing Kyaw Moe', 'aaako@gmail.com', 'UGFpbmdAMTIz', '2', '2025-07-31 05:06:35'),
(16, 'Paing', 'paingmya@gmail.com', 'UGFpbmdteWFAMTIz', '2', '2025-08-01 05:11:45'),
(17, 'Mya Thandar', 'mya@gmail.com', 'TXlhQDEyMzQ=', '2', '2025-08-01 08:16:22'),
(18, 'PaingMya', 'paingkyaw45@gmail.com', 'TXlhcGFpbmdAMTIz', '2', '2025-08-01 09:04:26'),
(19, 'Hteteuujj', 'htet123@gmail.com', 'SHRldEAxMjM=', '2', '2025-08-01 09:35:53'),
(20, 'Mya Thandar', 'myathandar123@gmial.com', 'TXlhQDEyMzQ1', '2', '2025-08-01 10:31:24'),
(21, 'PaingMya', 'mya425@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-02 06:57:40'),
(22, 'PaingPaing', 'paing456@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-04 10:30:23'),
(23, 'Paing', 'paingkyaw457@gmail.com', '$2y$10$NGiVLCda.KprMyKc.hGXDe5uqf8OCQDXMr4XVqIXp3V1LJ3zcp4QC', '2', '2025-08-04 16:15:52'),
(24, 'PaingMya', 'mmm425@gmail.com', 'UGFpbmdANDI1', '2', '2025-08-04 16:55:46'),
(25, 'Mya Thandar', 'mya789@gmail.com', 'UGFpbmdAMTIz', 'User', '2025-08-05 00:57:24'),
(26, 'Mya Thandar', 'mya741@gmail.com', 'UGFpbmdAMTIz', 'User', '2025-08-05 00:58:16'),
(27, 'Kyaw Moe', 'pap741@gmail.com', 'UGFpbmdAMTIz', 'User', '2025-08-05 00:59:56'),
(28, 'That Naing', 'wko741@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-05 01:01:25'),
(29, 'Mya Thandar', 'mya745@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-05 01:15:17'),
(30, 'Kyaw Moe', 'paingkyaw453@gmail.com', 'UGFpbmdAMTIz', '2', '2025-08-06 08:26:49');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
