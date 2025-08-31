-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2025 at 10:22 PM
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
-- Database: `construction_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `area_sqft` decimal(10,2) DEFAULT NULL,
  `total_cost` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `phone` varchar(20) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `address` varchar(225) NOT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(50) NOT NULL DEFAULT 'Consultation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consultation_bookings`
--

CREATE TABLE `consultation_bookings` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `consultation_type` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `phone` varchar(20) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `address` varchar(225) NOT NULL,
  `start_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation_bookings`
--

INSERT INTO `consultation_bookings` (`id`, `customer_id`, `consultation_type`, `status`, `phone`, `nic`, `address`, `start_date`, `created_at`) VALUES
(45, 1, 'consultation with contractor', 'Paid', '0710000000', '30098765456', 'yyyyyyyyyyy', '2025-09-06', '2025-08-19 17:07:17'),
(53, 7, 'Waste Management Service', 'Paid', '1111111111111111111', '1111111111111', '1111111111111', '2025-09-02', '2025-08-19 17:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `cost_settings`
--

CREATE TABLE `cost_settings` (
  `id` int(11) NOT NULL,
  `cost_per_sqm` decimal(10,2) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost_settings`
--

INSERT INTO `cost_settings` (`id`, `cost_per_sqm`, `updated_at`) VALUES
(1, 1000.00, '2025-08-16 10:23:05'),
(2, 900.00, '2025-08-16 10:23:05'),
(3, 400.00, '2025-08-16 10:23:35'),
(4, 100.00, '2025-08-16 10:23:57'),
(5, 200.00, '2025-08-16 10:29:12'),
(6, 100.00, '2025-08-16 10:31:32'),
(7, 1000.00, '2025-08-16 10:54:52'),
(8, 1850.00, '2025-08-17 03:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `password`) VALUES
(1, 'laviena', 'l@gmail.com', '$2y$10$1bf9JWi6NKfJ62KPlaCSMe6WSwkTvCu87frQhyo64.ojTktrbRoqa'),
(2, 'kin', 'k@gmail.com', '$2y$10$5Ts13ET35VISRxMNbgREO.SezgBqmf.H7w7fFbEdItdA4Hs6XOT72'),
(3, 'gim ', 'g@gmail.com', '$2y$10$DHhRsaPXm3kfPUFBgmiZ0O2lykFmVDqD55n2oKryfECtCbYD1kI3.'),
(4, 'malar', 'm@gmail.com', '$2y$10$YnNfY0Hd3GEezK9EIYSHCeEKlPJThejJ5shmfLsvMwpumnsJmcmrO'),
(5, 'mike', 'i@gmail.com', '$2y$10$PEIqu0MK0TZ0XVx.cJI1Y.fe1XMVnYzx3AFQEsa2c4hveUyH/fyRu'),
(6, 'queen', 'q@gmail.com', '$2y$10$Yp73.MAwqbcM9aTFacLEHObVf8sLxs24VPpAIN1186.t0Hqt5aThC'),
(7, 'arun', 'o@gmail.com', '$2y$10$0LCNSFcJRM9qp0Vi6nH7TuAwe7GA5ir2drWivHfnqGUTd6rfa6IUi');

-- --------------------------------------------------------

--
-- Table structure for table `material_percentages`
--

CREATE TABLE `material_percentages` (
  `id` int(11) NOT NULL,
  `material_name` varchar(50) NOT NULL,
  `percentage` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material_percentages`
--

INSERT INTO `material_percentages` (`id`, `material_name`, `percentage`) VALUES
(1, 'Cement', 16.40),
(2, 'Sand', 12.30),
(3, 'Aggregate', 7.40),
(4, 'Steel', 24.60),
(5, 'Finishers', 16.50),
(6, 'Fittings', 22.80);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `consultation_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `card_number` varchar(20) DEFAULT NULL,
  `card_holder` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(10) DEFAULT NULL,
  `cvv` varchar(5) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `consultation_id`, `customer_id`, `amount`, `card_number`, `card_holder`, `expiry_date`, `cvv`, `payment_date`, `status`) VALUES
(2, NULL, NULL, 1, 1500.00, '4444444', 'ddddddd', '6578', '675', '2025-08-19 17:07:26', 'Paid'),
(3, NULL, NULL, 1, 1500.00, '4444444', 'ddddddd', '6578', '675', '2025-08-19 17:07:51', 'Paid'),
(6, NULL, 53, 7, 1500.00, '111111111111', '111111111111', '1111', '111', '2025-08-19 17:46:18', 'Paid'),
(10, NULL, 53, 7, 1500.00, '111111111111', '111111111111', '1111', '111', '2025-08-19 17:54:51', 'Paid'),
(13, NULL, 53, 7, 1500.00, '111111111111', '111111111111', '1111', '111', '2025-08-19 17:59:54', 'Paid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `consultation_bookings`
--
ALTER TABLE `consultation_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_settings`
--
ALTER TABLE `cost_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `material_percentages`
--
ALTER TABLE `material_percentages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `consultation_id` (`consultation_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `consultation_bookings`
--
ALTER TABLE `consultation_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `cost_settings`
--
ALTER TABLE `cost_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `material_percentages`
--
ALTER TABLE `material_percentages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`consultation_id`) REFERENCES `consultation_bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
