-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2023 at 06:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `de_db_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` int(11) NOT NULL,
  `loyalty_tier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `loyalty_tier`) VALUES
(1, 'bronze'),
(2, 'silver');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`user_id`, `role_id`) VALUES
(3, 1),
(7, 1),
(4, 2),
(8, 2),
(5, 3),
(9, 3),
(6, 4),
(10, 4);

-- --------------------------------------------------------

--
-- Table structure for table `inventorymanager`
--

CREATE TABLE `inventorymanager` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kitchenstaffmember`
--

CREATE TABLE `kitchenstaffmember` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receptionist`
--

CREATE TABLE `receptionist` (
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Manager'),
(2, 'Inventory Manager'),
(3, 'Receptionist'),
(4, 'chef');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `name`, `email`, `dob`, `mobile_no`) VALUES
(1, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Alice', 'alice@example.com', '1990-01-01', '123-456-7890'),
(2, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Bob', 'bob@example.com', '1991-02-02', '098-765-4321'),
(3, '$2y$10$NrXBeKylP8Bu2nyaErIJW.ZoObEVQMJQdZkaJqH7s.tI83EoMZnDi', 'Carol', 'carol@example.com', '1992-03-03', '12121212'),
(4, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Dave', 'dave@example.com', '1993-04-04', '876-543-2109'),
(5, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Eve', 'eve@example.com', '1994-05-05', '765-432-1098'),
(6, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Frank', 'frank@example.com', '1995-06-06', '654-321-0987'),
(7, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Grace', 'grace@example.com', '1996-07-07', '543-210-9876'),
(8, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Henry', 'henry@example.com', '1997-08-08', '432-109-8765'),
(9, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'Ida', 'ida@example.com', '1998-09-09', '321-098-7654'),
(10, '$2y$10$XSP3.02iGEJwk8wafwmSt.yWQ9VN4s6HJwZwYW8yujF0xcdkRz6ki', 'John', 'john@example.com', '1999-10-10', '1'),
(28, '$2y$10$NrXBeKylP8Bu2nyaErIJW.ZoObEVQMJQdZkaJqH7s.tI83EoMZnDi', 'dew', 'dew@gmail.com', '2023-09-16', '0000000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `inventorymanager`
--
ALTER TABLE `inventorymanager`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `kitchenstaffmember`
--
ALTER TABLE `kitchenstaffmember`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `inventorymanager`
--
ALTER TABLE `inventorymanager`
  ADD CONSTRAINT `inventorymanager_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `employee` (`user_id`);

--
-- Constraints for table `kitchenstaffmember`
--
ALTER TABLE `kitchenstaffmember`
  ADD CONSTRAINT `kitchenstaffmember_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `employee` (`user_id`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `employee` (`user_id`);

--
-- Constraints for table `receptionist`
--
ALTER TABLE `receptionist`
  ADD CONSTRAINT `receptionist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `employee` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
