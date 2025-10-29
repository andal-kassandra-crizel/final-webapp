-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 29, 2025 at 12:46 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` int NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `middlename` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'Hanna', 'Santos', 'Villafuerte', 'hanna@gmail.com', '$2y$10$zbcdmhiJBAwSWkJZuepqFei1BFIXXdqFYSTpATlBvdfg0te8jsJqi', 'user', '2025-10-18 02:22:44'),
(4, 'Kassandra Crizel', 'Malabanan', 'Andal', 'kassandraandal601@gmail.com', '$2y$10$Wj7uv2ZZq873dMGNVgiVQOMZ5.KXsgA65jonz.k6Me.037Scg2RE.', 'admin', '2025-10-18 02:49:23'),
(8, 'Ronald', 'Romero', 'Andal', 'unad@gmail.com', '$2y$10$GIPK.pBexOWvmRppXhqU1u1euPJkJao1BWbLGXD1gIS8twVgXMxni', 'user', '2025-10-19 13:31:12'),
(9, 'Ruby', 'Mie', 'Yang', 'rubyyang@gmail.com', '$2y$10$/5VV8Mbo3knswuhMscQKDOYa.IlJK.RkoEvuOzNxWvdp3EmQ.EcGq', 'user', '2025-10-22 00:44:50'),
(10, 'Danielle', 'Agillon', 'Ramos', 'danramos@gmail.com', '$2y$10$7m7CiIMDCrfphJQLOI/YpOtq3oPusJzuI46DO..9OQDZpH2VkkPGS', 'user', '2025-10-23 07:39:57'),
(11, 'Maria', 'Lopez', 'Dela Cruz', 'lopez@gmail.com', '$2y$10$wyilGt1p.xmtOfna2FzjmeCwJgKQ16grWr.jiH1UKs8VzgyxdBC2q', 'user', '2025-10-23 08:58:36'),
(14, 'Mark Angelo', 'Reyes', 'Bautista', 'markbautista@gmail.com', '$2y$10$KmQJaf.w98pH6mlxYPzjCuW47LVIXXrG/PJoOL1D9p8YKRtYPdG3e', 'user', '2025-10-28 10:36:40');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `middlename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `age` varchar(5) NOT NULL,
  `service_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `firstname`, `middlename`, `lastname`, `email`, `age`, `service_id`, `doctor_id`, `appointment_date`, `message`, `created_at`, `status`) VALUES
(1, 2, 'Hanna', 'Santos', 'Villafuerte', 'hanna@gmail.com', '20', 6, 3, '2025-10-21', NULL, '2025-10-19 02:44:58', 'Approved'),
(5, 2, 'George', 'Perez', 'Guerrero', 'guerrero@gmail.com', '21', 4, 4, '2025-10-25', NULL, '2025-10-19 03:48:08', 'Approved'),
(6, 2, 'Kyla', 'Santos', 'Villafuerte', 'kyla@gmail.com', '20', 7, 5, '2025-10-23', NULL, '2025-10-19 03:54:43', 'Approved'),
(7, 2, 'Lea Mae', 'Rosales', 'Alonzo', 'leamaerosales@gmail.com', '19', 5, 4, '2025-10-26', NULL, '2025-10-19 04:11:42', 'Approved'),
(8, 8, 'Ronald', 'Romero', 'Andal', 'unad@gmail.com', '31', 4, 3, '2025-10-27', NULL, '2025-10-19 13:32:33', 'Approved'),
(9, 2, 'Reneir', 'Torres', 'Manongsong', 'manongsong@gmail.com', '21', 4, 4, '2025-10-21', NULL, '2025-10-20 05:37:29', 'Approved'),
(10, 8, 'Roy', 'Romero', 'Andal', 'royromero@gmail.com', '35', 5, 14, '2025-10-29', '', '2025-10-22 00:18:26', 'Approved'),
(11, 9, 'Ruby', 'Mie', 'Yang', 'rubyyang@gmail.com', '22', 1, 13, '2025-10-24', '', '2025-10-22 00:46:45', 'Approved'),
(12, 9, 'Lucy Anne', 'Mie', 'Yang', 'lucyyang@gmail.com', '19', 6, 4, '2025-10-27', '', '2025-10-22 01:03:01', 'Approved'),
(13, 2, 'Trisha Mae', 'Cadis', 'Sapeda', 'sapeda@gmail.com', '20', 6, 4, '2025-10-22', '', '2025-10-22 07:39:45', 'Approved'),
(14, 10, 'Danielle', 'Agillon', 'Ramos', 'danramos@gmail.com', '19', 4, 3, '2025-10-27', '', '2025-10-23 07:41:32', 'Approved'),
(15, 10, 'Janelle', 'Mendoza', 'Fajardo', 'janelle@gmail.com', '20', 4, 14, '2025-10-27', '', '2025-10-23 07:42:49', 'Approved'),
(16, 9, 'Sarah', 'Mie', 'Yang', 'sarahyang@gmail.com', '12', 4, 14, '2025-10-30', '', '2025-10-23 08:51:33', 'Approved'),
(17, 11, 'Maria', 'Lopez', 'Dela Cruz', 'lopez@gmail.com', '41', 2, 13, '2025-10-28', '', '2025-10-23 09:00:30', 'Approved'),
(18, 11, 'Alyssa', 'Lopez', 'Dela Cruz', 'alyssa@gmail.com', '19', 14, 3, '2025-11-03', '', '2025-10-25 03:53:39', 'Approved'),
(19, 9, 'Dave', 'Mie', 'Yang', 'dave@gmail.com', '22', 16, 5, '2025-11-05', '', '2025-10-25 05:20:28', 'Approved'),
(20, 14, 'Mark Angelo', 'Reyes', 'Bautista', 'markbautista@gmail.com', '18', 14, 3, '2025-11-04', NULL, '2025-10-28 10:38:40', 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int NOT NULL,
  `doctor_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `category_id` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_name`, `category_id`, `email`, `phone`, `status`, `created_at`) VALUES
(1, 'Dr. Sarah Johnson', 1, 'sarah@example.com', '09123456789', 'active', '2025-10-16 01:59:57'),
(2, 'Dr. Robert Smith', 1, 'robert@example.com', '09123456780', 'active', '2025-10-16 01:59:57'),
(3, 'Dr. Emily Davis', 2, 'emily@example.com', '09123456781', 'active', '2025-10-16 01:59:57'),
(4, 'Dr. Michael Chen', 2, 'michael@example.com', '09123456782', 'active', '2025-10-16 01:59:57'),
(5, 'Dr. Lisa Brown', 3, 'lisa@example.com', '09123456783', 'active', '2025-10-16 01:59:57'),
(13, 'Dr. Anthony Reyes', 1, 'anthony.reyes@example.com', '09124567891', 'active', '2025-10-18 02:11:33'),
(14, 'Dr. Hannah Cruz', 2, 'hannah.cruz@example.com', '09125678912', 'active', '2025-10-18 02:11:33'),
(15, 'Dr. Nathaniel Torres', 3, 'nathaniel.torres@example.com', '09126789123', 'active', '2025-10-18 02:11:33'),
(16, 'Dr. Patricia Gomez', 3, 'patricia.gomez@example.com', '09127891231', 'active', '2025-10-18 02:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `service_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `category_id`, `service_name`) VALUES
(1, 1, 'Consultation and Check-ups'),
(2, 1, 'Physical Examinations'),
(3, 1, 'Vital Signs Monitoring'),
(4, 2, 'Cleaning & Check-ups'),
(5, 2, 'Tooth Extraction & Fillings'),
(6, 2, 'Perfect Alignment (Braces)'),
(7, 3, 'Vaccination'),
(8, 3, 'Minor Procedures & Suturing'),
(9, 3, '24/7 Emergency Assistance'),
(14, 2, 'Cavity Treatment'),
(15, 2, 'Root Canal'),
(16, 3, 'Health Counseling'),
(17, 2, 'Smile Restoration (Dentures)'),
(18, 2, 'Tooth Renewal (Crowns)');

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`category_id`, `category_name`) VALUES
(1, 'General Services'),
(2, 'Dental Services'),
(3, 'Preventive & Emergency Care');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `fk_appointments_user` (`user_id`),
  ADD KEY `fk_appointments_doctor` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `fk_doctors_category` (`category_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `fk_appointments_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_user` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `fk_doctors_category` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `service_categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
