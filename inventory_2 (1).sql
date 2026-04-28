-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2026 at 10:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_request`
--

CREATE TABLE `borrow_request` (
  `request_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_requested` int(11) NOT NULL CHECK (`quantity_requested` > 0),
  `request_date` date NOT NULL,
  `days_to_borrow` int(11) NOT NULL CHECK (`days_to_borrow` > 0),
  `status` enum('PENDING','APPROVED','REJECTED','CANCELLED') DEFAULT 'PENDING',
  `processed_by_official_id` varchar(50) DEFAULT NULL,
  `processed_date` date DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_request`
--

INSERT INTO `borrow_request` (`request_id`, `student_id`, `item_id`, `quantity_requested`, `request_date`, `days_to_borrow`, `status`, `processed_by_official_id`, `processed_date`, `remarks`, `created_at`) VALUES
(1, 2023002, 3, 2, '2026-04-20', 5, 'PENDING', NULL, NULL, 'Need for class presentation', '2026-04-27 06:58:37'),
(2, 20240041, 1, 1, '2026-04-21', 7, 'APPROVED', 'OFF001', '2026-04-21', 'Approved – laptop for online exam', '2026-04-27 06:58:37');

--
-- Triggers `borrow_request`
--
DELIMITER $$
CREATE TRIGGER `trg_before_request` BEFORE INSERT ON `borrow_request` FOR EACH ROW BEGIN
  DECLARE avail_qty INT;
  
  SELECT available_quantity INTO avail_qty 
  FROM items WHERE item_id = NEW.item_id;
  
  IF NEW.quantity_requested > avail_qty THEN
    SIGNAL SQLSTATE '45000' 
    SET MESSAGE_TEXT = 'Insufficient quantity available';
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Electronics'),
(2, 'Furniture'),
(4, 'Laboratory'),
(3, 'Office Supplies');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `course_name`) VALUES
('BSCS', 'COMPUTER SCIENCE'),
('CRIM', 'CRIMINOLOGY');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `total_quantity` int(11) NOT NULL DEFAULT 0,
  `available_quantity` int(11) NOT NULL DEFAULT 0,
  `min_quantity_alert` int(11) DEFAULT 5,
  `received_by_official_id` varchar(50) DEFAULT NULL,
  `date_added` date DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `description`, `unit_id`, `category_id`, `total_quantity`, `available_quantity`, `min_quantity_alert`, `received_by_official_id`, `date_added`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 'Dell Latitude 5520', 1, 1, 10, 10, 2, 'OFF001', '2026-01-10', 'active', '2026-04-27 06:58:36', '2026-04-27 06:58:36'),
(2, 'Office Chair', 'Ergonomic mesh chair', 1, 2, 15, 15, 3, 'OFF001', '2026-01-15', 'active', '2026-04-27 06:58:36', '2026-04-27 06:58:36'),
(3, 'Microphone', 'USB condenser mic', 1, 1, 8, 8, 2, 'OFF002', '2026-02-01', 'active', '2026-04-27 06:58:36', '2026-04-27 06:58:36'),
(4, 'Bond Paper (ream)', 'A4 size, 500 sheets', 3, 3, 50, 50, 10, 'OFF003', '2026-03-05', 'active', '2026-04-27 06:58:36', '2026-04-27 06:58:36'),
(5, 'Lab Goggles', 'Chemical splash safety goggles', 1, 4, 20, 20, 5, 'OFF002', '2026-01-20', 'active', '2026-04-27 06:58:36', '2026-04-27 06:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `master_list`
--

CREATE TABLE `master_list` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `year_level` year(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_list`
--

INSERT INTO `master_list` (`student_id`, `first_name`, `last_name`, `course_code`, `year_level`, `created_at`) VALUES
(2023001, 'Juan', 'Dela Cruz', NULL, '2023', '2026-04-27 06:58:36'),
(2023002, 'Maria', 'Santos', NULL, '2023', '2026-04-27 06:58:36'),
(2023003, 'Jose', 'Reyes', NULL, '2023', '2026-04-27 06:58:36'),
(20240041, 'Luis', 'Torres', NULL, '2024', '2026-04-27 06:58:36'),
(20240042, 'Andrea', 'Villanueva', NULL, '2024', '2026-04-27 06:58:36'),
(1212324324, 'Lhorence', 'Abejo', 'BSCS', '2003', '2026-04-28 08:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `officials_masterlist`
--

CREATE TABLE `officials_masterlist` (
  `official_id` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `position_code` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials_masterlist`
--

INSERT INTO `officials_masterlist` (`official_id`, `first_name`, `last_name`, `position_code`, `is_active`, `created_at`) VALUES
('OFF001', 'Roberto', 'Gonzales', NULL, 1, '2026-04-27 06:58:36'),
('OFF002', 'Elena', 'Morales', NULL, 1, '2026-04-27 06:58:36'),
('OFF003', 'Antonio', 'Velasco', NULL, 1, '2026-04-27 06:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `position_code` varchar(20) NOT NULL,
  `position_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_borrowed` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `expected_return_date` date NOT NULL,
  `actual_return_date` date DEFAULT NULL,
  `status` enum('BORROWED','RETURNED','OVERDUE','LOST') DEFAULT 'BORROWED',
  `released_by_official_id` varchar(50) DEFAULT NULL,
  `received_by_official_id` varchar(50) DEFAULT NULL,
  `condition_on_return` enum('GOOD','DAMAGED','LOST') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `trg_after_borrow` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
  IF NEW.status = 'BORROWED' THEN
    UPDATE `items` 
    SET `available_quantity` = `available_quantity` - NEW.quantity_borrowed
    WHERE `item_id` = NEW.item_id;
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_return` AFTER UPDATE ON `transactions` FOR EACH ROW BEGIN
  IF NEW.status = 'RETURNED' AND OLD.status = 'BORROWED' THEN
    UPDATE `items` 
    SET `available_quantity` = `available_quantity` + NEW.quantity_borrowed
    WHERE `item_id` = NEW.item_id;
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`) VALUES
(3, 'box/boxes'),
(2, 'kg'),
(1, 'pcs'),
(4, 'tae');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','admin') DEFAULT 'student',
  `is_default_password` tinyint(1) DEFAULT 1,
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `student_id`, `username`, `password`, `role`, `is_default_password`, `is_active`, `last_login`, `created_at`) VALUES
(1, 2023001, '2023001', 'admin123', 'admin', 0, 1, NULL, '2026-04-27 06:58:36'),
(2, 2023002, '2023002', 'marias123', 'student', 0, 1, NULL, '2026-04-27 06:58:36'),
(3, 2023003, '2023003', 'jose123', 'student', 1, 1, NULL, '2026-04-27 06:58:36'),
(4, 20240041, '20240041', 'luis123', 'student', 0, 1, NULL, '2026-04-27 06:58:36'),
(5, 20240042, '20240042', 'andrea123', 'student', 1, 1, NULL, '2026-04-27 06:58:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_request`
--
ALTER TABLE `borrow_request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `idx_student` (`student_id`),
  ADD KEY `idx_item` (`item_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_request_date` (`request_date`),
  ADD KEY `fk_request_processor` (`processed_by_official_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_unit` (`unit_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `fk_items_receiver` (`received_by_official_id`);

--
-- Indexes for table `master_list`
--
ALTER TABLE `master_list`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fk_course` (`course_code`);

--
-- Indexes for table `officials_masterlist`
--
ALTER TABLE `officials_masterlist`
  ADD PRIMARY KEY (`official_id`),
  ADD KEY `fk_masterlist` (`position_code`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`position_code`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `idx_request` (`request_id`),
  ADD KEY `idx_student` (`student_id`),
  ADD KEY `idx_item` (`item_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_expected_return` (`expected_return_date`),
  ADD KEY `fk_transaction_releaser` (`released_by_official_id`),
  ADD KEY `fk_transaction_receiver` (`received_by_official_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`),
  ADD UNIQUE KEY `unit_name` (`unit_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `idx_student_id` (`student_id`),
  ADD KEY `idx_role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_request`
--
ALTER TABLE `borrow_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_request`
--
ALTER TABLE `borrow_request`
  ADD CONSTRAINT `fk_request_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_processor` FOREIGN KEY (`processed_by_official_id`) REFERENCES `officials_masterlist` (`official_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_request_student` FOREIGN KEY (`student_id`) REFERENCES `master_list` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_items_receiver` FOREIGN KEY (`received_by_official_id`) REFERENCES `officials_masterlist` (`official_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_items_unit` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `master_list`
--
ALTER TABLE `master_list`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`);

--
-- Constraints for table `officials_masterlist`
--
ALTER TABLE `officials_masterlist`
  ADD CONSTRAINT `fk_masterlist` FOREIGN KEY (`position_code`) REFERENCES `positions` (`position_code`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `fk_transaction_item` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_receiver` FOREIGN KEY (`received_by_official_id`) REFERENCES `officials_masterlist` (`official_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_releaser` FOREIGN KEY (`released_by_official_id`) REFERENCES `officials_masterlist` (`official_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_request` FOREIGN KEY (`request_id`) REFERENCES `borrow_request` (`request_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaction_student` FOREIGN KEY (`student_id`) REFERENCES `master_list` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_student` FOREIGN KEY (`student_id`) REFERENCES `master_list` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
