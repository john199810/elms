-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 06:09 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `record_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `check_in_time` time DEFAULT NULL,
  `lunch_break_start` time DEFAULT NULL,
  `lunch_break_end` time DEFAULT NULL,
  `coffee_break_start` time DEFAULT NULL,
  `coffee_break_end` time DEFAULT NULL,
  `check_out_time` time DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`record_id`, `employee_id`, `check_in_time`, `lunch_break_start`, `lunch_break_end`, `coffee_break_start`, `coffee_break_end`, `check_out_time`, `date`) VALUES
(2, 7, '17:10:08', '17:10:49', '17:11:06', '17:11:20', '17:11:31', '17:11:43', '2024-07-11'),
(3, 7, '14:32:45', '14:32:57', '14:33:09', '14:33:18', '14:33:30', '14:33:39', '2024-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_short_name` varchar(100) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_short_name`, `department_name`, `date_created`) VALUES
(6, 'Software Engineer', 'Software Engineer', '2024-07-10 05:30:52'),
(7, 'Project Manager', 'Project Manager', '2024-07-10 05:31:03'),
(8, 'HR Manager', 'HR Manager', '2024-07-10 05:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(100) NOT NULL,
  `designation_description` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`designation_id`, `designation_name`, `designation_description`, `date_created`) VALUES
(2, 'Project Manager', 'Oversees project planning, execution, and completion, ensuring all project goals are met', '2024-07-10 04:23:59'),
(3, 'HR Manager', 'Manages recruitment, employee relations, and overall HR strategies to support the organization', '2024-07-10 04:24:21'),
(4, 'Finance Manager', 'Responsible for managing financial planning, budgeting, and reporting', '2024-07-10 04:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id_number` varchar(20) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `email_address` varchar(100) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `department` varchar(20) DEFAULT NULL,
  `designation` varchar(20) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_status` enum('Activated','Deactivated') NOT NULL DEFAULT 'Activated',
  `otp_code` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NULL DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `qr_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_id_number`, `last_name`, `first_name`, `middle_name`, `age`, `gender`, `email_address`, `contact_number`, `department`, `designation`, `profile_image`, `username`, `password`, `account_status`, `otp_code`, `created_at`, `expires_at`, `date_created`, `qr_code`) VALUES
(6, 'ELMS-001', 'Sison', 'Patrick', 'Dumagsa', 25, 'Male', 'sisonpatrick1998@gmail.com', '09518512992', 'Software Engineer', 'Project Manager', '440561107_1826319877872412_6353903345761546175_n.jpg', 'patwek1998', '$2y$10$zD.jjt6rsy.BqTP/ClHkJOdL/vv0.eu0VeAyxAGiTBNB6J/wCDHoi', 'Activated', '490109', '2024-07-10 11:04:56', NULL, '2024-07-10 11:04:56', '../assets/QRimages/Sison_1720663430.png'),
(7, 'ELMS-007', 'Felecita', 'Kent', 'Sagales', 23, 'Male', 'jdoe83779@gmail.com', '0912345678', 'HR Manager', 'Finance Manager', 'photo1715063818 (8).jpeg', 'dave', '$2y$10$DJujTYVl93pPn.fF8iBsbOYfiEz8mJ1RuEvHYB3p7txlm2jWpNsui', 'Activated', '230916', '2024-07-10 18:13:15', NULL, '2024-07-10 18:13:15', '../assets/QRimages/Felecita_1721025017.png');

-- --------------------------------------------------------

--
-- Table structure for table `leaveapplications`
--

CREATE TABLE `leaveapplications` (
  `application_id` int(11) NOT NULL,
  `reference_number` varchar(20) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `date_of_application` date NOT NULL,
  `attachment` blob DEFAULT NULL,
  `leave_status` enum('pending','approved','cancelled') NOT NULL DEFAULT 'pending',
  `remarks` text DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaveapplications`
--

INSERT INTO `leaveapplications` (`application_id`, `reference_number`, `employee_id`, `leave_id`, `date_of_application`, `attachment`, `leave_status`, `remarks`, `date_created`, `date_updated`) VALUES
(2, 'ref_668ec60b0dc41', 6, 10, '2024-10-24', 0x2e2e2f6173736574732f6c656176654174746163686d656e74732f636f6d70616e795f6964732e637376, 'approved', 'test', '2024-07-10 17:34:03', '2024-07-18 16:04:05'),
(3, 'ref_6699316b922fd', 6, 9, '2024-07-19', 0x2e2e2f6173736574732f6c656176654174746163686d656e74732f3435303433373831335f3939383030333437313634393137395f323336393934363230333630343238313539355f6e2e706e67, 'cancelled', 'testing', '2024-07-18 15:14:51', '2024-07-18 15:39:27'),
(4, 'ref_66993e05d6766', 6, 11, '2024-08-06', 0x2e2e2f6173736574732f6c656176654174746163686d656e74732f67726f75702e676966, 'pending', '131', '2024-07-18 16:08:37', '2024-07-18 16:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `leavetypes`
--

CREATE TABLE `leavetypes` (
  `leave_id` int(11) NOT NULL,
  `leave_name` varchar(50) NOT NULL,
  `leave_description` text NOT NULL,
  `number_of_days_allowed` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leavetypes`
--

INSERT INTO `leavetypes` (`leave_id`, `leave_name`, `leave_description`, `number_of_days_allowed`, `date_created`) VALUES
(9, 'Annual Leave', 'Annual leave for personal use', 20, '2024-07-10 06:14:05'),
(10, 'Maternity Leave', 'Leave for maternity and childcare', 90, '2024-07-10 06:14:39'),
(11, 'Casual Leave', 'Leave for personal reasons or emergencies', 7, '2024-07-10 06:15:01'),
(12, 'Sick Leave', 'Leave for personal illness or medical appointments', 10, '2024-07-10 06:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email_address` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_category` enum('Admin','Staff') NOT NULL,
  `account_status` enum('Activated','Deactivated') NOT NULL DEFAULT 'Activated',
  `profile_image` varchar(255) DEFAULT NULL,
  `otp_code` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT (current_timestamp() + interval 3 minute),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `contact_number`, `email_address`, `username`, `password`, `user_category`, `account_status`, `profile_image`, `otp_code`, `created_at`, `expires_at`, `date_created`) VALUES
(2, 'Admin', '09518512992', 'admin@gmail.com', 'admin', '$2y$10$HIAojhKZmZMw1KRV2Vw15OC3uz6S5y.Rc3D54JIEd0CMcyiRGQxwu', 'Admin', 'Activated', '0837f71b25577ade6db757d99d9499d6.jpg', '431482', '2024-07-10 09:08:23', '2024-07-18 09:04:08', '2024-07-10 09:08:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `leaveapplications`
--
ALTER TABLE `leaveapplications`
  ADD PRIMARY KEY (`application_id`),
  ADD UNIQUE KEY `reference_number` (`reference_number`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `leave_id` (`leave_id`);

--
-- Indexes for table `leavetypes`
--
ALTER TABLE `leavetypes`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_records`
--
ALTER TABLE `attendance_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `leaveapplications`
--
ALTER TABLE `leaveapplications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leavetypes`
--
ALTER TABLE `leavetypes`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD CONSTRAINT `attendance_records_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `leaveapplications`
--
ALTER TABLE `leaveapplications`
  ADD CONSTRAINT `leaveapplications_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `leaveapplications_ibfk_2` FOREIGN KEY (`leave_id`) REFERENCES `leavetypes` (`leave_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
