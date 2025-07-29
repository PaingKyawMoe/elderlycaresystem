-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 29, 2025 at 09:20 AM
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
  `image` varchar(500) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `description`, `category`, `time`, `duration`, `image`, `status`, `created_at`, `updated_at`) VALUES
(8, 'dddd', 'dff', 'Social', '15:16:00', 30, 'https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg', 'active', '2025-07-29 08:37:52', '2025-07-29 08:42:56'),
(9, 'aaaaaa', 'ffdfff', 'Mental', '06:11:00', 50, 'https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg', 'inactive', '2025-07-29 08:41:50', '2025-07-29 08:43:19'),
(10, 'dddaaaa', 'dfaf', 'Mental', '16:22:00', 15, NULL, 'active', '2025-07-29 08:52:57', '2025-07-29 08:52:57'),
(11, 'ddddddssaa', 'ddd', 'Creative', '06:30:00', 40, NULL, 'active', '2025-07-29 08:58:07', '2025-07-29 08:58:07'),
(12, 'vvv', '0000', 'Physical', '16:41:00', 20, 'https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg', 'inactive', '2025-07-29 09:10:29', '2025-07-29 09:10:36'),
(13, 'sssss', 'k', 'Mental', '04:49:00', 20, 'https://images.pexels.com/photos/7330708/pexels-photo-7330708.jpeg', 'inactive', '2025-07-29 09:18:37', '2025-07-29 09:18:45');

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
(4, 'That Naing', '1940-07-22', '09750231601', 'Meikhtila', 'male', '2025-07-29', 'checkup', 'evening', 'Dr. Paing', 'prescription-refill', 'paypal.png', '2025-07-28 09:14:53'),
(5, 'Teacher', '1940-07-15', '09256595765', 'mandalay', 'female', '2025-07-29', 'followup', 'morning', 'dr-paing', 'general-checkup', 'paypal.png', '2025-07-28 15:40:32'),
(6, 'Thet Thet', '2021-03-21', '09654123789', 'Meikhtila', 'female', '2025-07-30', 'checkup', 'afternoon', 'dr-phyoe', 'prescription-refill', 'kpay.png', '2025-07-29 03:07:48'),
(7, 'Paing Kyaw Moe', '1920-07-23', '09750231601', 'Meikhtila    ', 'male', '2025-07-23', 'followup', 'evening', 'dr-moe', 'symptoms', 'credit.png', '2025-07-29 03:09:19'),
(8, 'Paing Kyaw Moe', '1920-07-23', '09750231601', 'Meikhtila    ', 'male', '2025-07-23', 'followup', 'evening', 'dr-moe', 'symptoms', 'credit.png', '2025-07-29 03:09:53');

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
(16, 'mya', 'paingkyaw@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-29 02:51:47', 'not'),
(17, 'paing', 'ko@gmail.com', '09750231601', 250.00, 'kpay', '2025-07-29 04:17:31', 'pending');

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
(5, 'Paing Kyaw Moe', 'admin@gmail.com', 'Paing@123', '1', '2025-07-28 04:41:15'),
(6, 'Paing Kyaw Moe', 'paing@gmail.com', 'UGFpbmdAMTIz', '1', '2025-07-28 05:16:25'),
(7, 'Hello Paing', 'hello123@gmail.com', 'SGVsbG9AMTIzNA==', '2', '2025-07-28 09:13:50'),
(8, 'Paing Kyaw', 'paingkyaw@gmail.com', 'UGFpbmdAMTIz', '1', '2025-07-28 15:35:39'),
(9, 'Paing Kyaw Moe', 'ko1234@gmail.com', 'UGFpbmdAMTIz', '2', '2025-07-29 04:22:38');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
