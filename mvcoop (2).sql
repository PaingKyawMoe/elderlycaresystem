-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 27, 2025 at 03:38 PM
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
(1, 'Paing Kyaw Moe', '1950-07-17', '09750231601', 'Meikhtila', 'male', '2025-07-26', 'checkup', 'afternoon', '', 'symptoms', 'paypal.png', '2025-07-25 08:18:52'),
(2, 'Paing Kyaw Moe', '1950-07-17', '09750231601', 'Meikhtila', 'male', '2025-07-26', 'checkup', 'afternoon', 'dr-kyaw', 'symptoms', 'paypal.png', '2025-07-25 08:21:09'),
(3, 'kooal', '1950-07-23', '09672636439', 'yangon', 'female', '2025-07-26', 'consultation', 'evening', 'dr-phyoe', 'prescription-refill', 'About.png', '2025-07-25 15:49:53');

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
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `full_name`, `email`, `phone`, `amount`, `payment_method`, `created_at`) VALUES
(1, 'PaingKyawMoe', 'ko@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-25 09:37:48'),
(2, 'paing', 'admin@gmail.com', '09672636439', 250.00, 'kpay', '2025-07-25 15:17:51'),
(3, 'mya', 'hello12@gmail.com', '09750236489', 500.00, 'wave', '2025-07-25 15:18:45'),
(4, 'mgmg', 'kololo@gmail.com', '09750231601', 250.00, 'paypal', '2025-07-25 15:47:32'),
(5, 'mya', 'admin@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-25 16:12:08'),
(6, 'mya', 'konaing@gmail.com', '09672636439', 100.00, 'kpay', '2025-07-27 12:38:56'),
(7, 'fadfaf', 'kololo@gmail.com', '09750236489', 250.00, 'paypal', '2025-07-27 12:39:29'),
(8, 'Kyaw', 'kyawgyi@gmail.com', '09785461320', 1000.00, 'wave', '2025-07-27 15:34:05'),
(9, 'mgmg', 'ko@gmail.com', '09785461320', 250.00, 'kpay', '2025-07-27 15:34:26'),
(10, 'kyawkyaw', 'kyawkayw@gmail.com', '09402788771', 100.00, 'paypal', '2025-07-27 15:34:54'),
(11, 'khinkhin', 'khin@gmial.com', '09256595765', 5000.00, 'kpay', '2025-07-27 15:35:20'),
(12, 'mimi', 'mi@gmail.com', '09784561324', 700.00, 'paypal', '2025-07-27 15:35:59');

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
(2, 'Paing Kyaw', 'paingkyaw@gmail.com', 'UGFpbmdAMTIzNA==', '1', '2025-07-25 07:26:30'),
(3, 'Paing Kyaw Moe', 'ko@gmail.com', 'UGFpbmdAMTIzNDU2', '1', '2025-07-25 07:32:03'),
(4, 'Mya Thandar', 'hello12@gmail.com', 'TXlhQDEyMzQ=', '2', '2025-07-25 07:37:50');

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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
