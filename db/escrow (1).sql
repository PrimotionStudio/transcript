-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 23, 2024 at 05:46 AM
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
-- Database: `escrow`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(60) NOT NULL,
  `loginkey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `password`, `loginkey`) VALUES
(1, 'admin', 'admin@escrow.com', '555555556', 'admin', '$2y$10$RF37b4oFOkjws2soQX4RNuSZFSP4M3ulSgUpIpnbf1VRgL8d1jb5a');

-- --------------------------------------------------------

--
-- Table structure for table `kyc`
--

CREATE TABLE `kyc` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `id_doc` text NOT NULL,
  `selfie` text NOT NULL,
  `dob` date NOT NULL,
  `status` enum('verified','not verified') NOT NULL DEFAULT 'not verified',
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kyc`
--

INSERT INTO `kyc` (`id`, `user_id`, `id_type`, `id_doc`, `selfie`, `dob`, `status`, `datetime`) VALUES
(4, 1, 'Driver\'s License', 'uploads/67414c6f37b27_Gemini_Generated_Image_3rq0jj3rq0jj3rq0.jpeg', 'uploads/67414c6f37b2c_Gemini_Generated_Image_xryypwxryypwxryy.jpeg', '2024-11-23', 'verified', '2024-11-23 03:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `transactionId` varchar(255) NOT NULL,
  `sendUserId` int(11) NOT NULL,
  `message` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `transactionId`, `sendUserId`, `message`, `datetime`) VALUES
(1, '0x4af3e99e88dc96e4', 2, 'Hello', '2024-11-22 01:40:33'),
(2, '0x4af3e99e88dc96e4', 1, 'Hi', '2024-11-22 01:40:58'),
(3, '0x4af3e99e88dc96e4', 1, 'Hey', '2024-11-22 01:41:39'),
(4, '0x4af3e99e88dc96e4', 1, 'Hey', '2024-11-22 01:41:56'),
(5, '0x4af3e99e88dc96e4', 1, 'Transaction completed successfully', '2024-11-22 01:44:00'),
(6, '0x4af3e99e88dc96e4', 1, 'I have sent this to the admin', '2024-11-22 01:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `payment_request`
--

CREATE TABLE `payment_request` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `wallet_addr` varchar(255) NOT NULL,
  `wallet_name` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `status` enum('seen','not seen') NOT NULL DEFAULT 'not seen',
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_request`
--

INSERT INTO `payment_request` (`id`, `transaction_id`, `user_id`, `wallet_addr`, `wallet_name`, `amount`, `status`, `datetime`) VALUES
(1, '0x4af3e99e88dc96e4', 1, '1234567890', 'BTC', 2, 'seen', '2024-11-22 01:41:14'),
(2, '0x4af3e99e88dc96e4', 1, '1234567890', 'BTC', 2, 'not seen', '2024-11-22 01:44:11'),
(3, '0x4af3e99e88dc96e4', 2, 'qwertyuiop', 'USDT', 2500, 'seen', '2024-11-22 01:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `status` enum('approved','rejected','pending') NOT NULL DEFAULT 'pending',
  `datetime` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payouts`
--

INSERT INTO `payouts` (`id`, `user_id`, `amount`, `status`, `datetime`) VALUES
(1, 1, 50, 'approved', '2024-11-23 04:36:06'),
(2, 1, 1.23, 'approved', '2024-11-23 04:44:37'),
(3, 1, 33, 'rejected', '2024-11-23 04:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) UNSIGNED NOT NULL,
  `creatorUserId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `coin` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `paymentMethod` varchar(10) NOT NULL DEFAULT 'USDT',
  `estimatedTotal` float NOT NULL,
  `transactionId` varchar(255) NOT NULL,
  `creatorRole` enum('buyer','seller') NOT NULL,
  `buyer` int(11) DEFAULT NULL,
  `seller` int(11) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `state` enum('completed','rejected','resolved','disputed','pending') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `creatorUserId`, `title`, `coin`, `amount`, `paymentMethod`, `estimatedTotal`, `transactionId`, `creatorRole`, `buyer`, `seller`, `datetime`, `state`) VALUES
(1, 2, 'Test1', 'BTC', 2, 'USDT', 2000, '0x66ab00f51e2a97a2', 'buyer', 2, NULL, '2024-11-22 01:37:35', 'rejected'),
(2, 2, 'Test2', 'BTC', 2, 'USDT', 2500, '0x4af3e99e88dc96e4', 'buyer', 2, 1, '2024-11-22 01:39:45', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `payout_balance` float NOT NULL DEFAULT 0,
  `password` varchar(60) NOT NULL,
  `loginkey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `payout_balance`, `password`, `loginkey`) VALUES
(1, 'Funny Yummy Dummy', 'funnyyummydummy@gmail.com', '911489557', 248.77, '$2y$10$coltcuLdtbsi0/OQnq1iwucnyHjTWNIpyhksm/6StkhZq9z/FD6ae', '$2y$10$efHoaQvlO/q8qTH.dD6O4uc.e6y9630Pe2T07/wzMVPBA1bmY77E.'),
(2, 'Person Person', 'captainjakehook@gmail.com', '99999999', 999, '$2y$10$bnoWc6X.EmlupOdTJBb5ZuH4zLJlnPb6.6t7yibUeyKPPVwO3Vr82', '$2y$10$BfgY4qTMizpzism.k3AmIO7tuWyK.hvkq5kPzg32itZ.41YoUQ8aa');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(10) UNSIGNED NOT NULL,
  `wallet_name` varchar(50) NOT NULL,
  `wallet_addr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `wallet_name`, `wallet_addr`) VALUES
(4, 'BTC', '1234567890'),
(5, 'ETH', '0987654321'),
(6, 'USDT', 'qwertyuiop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc`
--
ALTER TABLE `kyc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_request`
--
ALTER TABLE `payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kyc`
--
ALTER TABLE `kyc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_request`
--
ALTER TABLE `payment_request`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
