-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 09, 2024 at 01:23 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fire-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`) VALUES
(1, 'tushar@gmail.com', 'tushar123');

-- --------------------------------------------------------

--
-- Table structure for table `fire_report`
--

CREATE TABLE `fire_report` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `message` varchar(500) NOT NULL,
  `assign_to` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `posting_date` datetime NOT NULL,
  `assignment_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fire_report`
--

INSERT INTO `fire_report` (`id`, `full_name`, `mobile`, `email`, `location`, `message`, `assign_to`, `status`, `posting_date`, `assignment_time`) VALUES
(4, 'Tushar Mahajan', '4569875540', 'tushar@gmail.com', 'Amoda, Yawal', 'Fire Emergency', 1, 'COMPLETE', '2024-10-09 13:13:26', '2024-10-09 16:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `fire_team`
--

CREATE TABLE `fire_team` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(50) NOT NULL,
  `team_leader` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `team_members` varchar(500) NOT NULL,
  `posting_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fire_team`
--

INSERT INTO `fire_team` (`team_id`, `team_name`, `team_leader`, `mobile`, `team_members`, `posting_date`) VALUES
(1, 'Team-1', 'Tushar', '4569875556', 'Jayesh, Vaibhav', '2024-10-09 16:44:25'),
(2, 'Team-2', 'Bhuvan', '4568976546', 'pankaj, girish', '2024-10-09 16:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `request_history`
--

CREATE TABLE `request_history` (
  `h_id` int(11) NOT NULL,
  `r_id` int(11) DEFAULT NULL,
  `remark` varchar(30) NOT NULL,
  `message` varchar(30) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_history`
--

INSERT INTO `request_history` (`h_id`, `r_id`, `remark`, `message`, `date`) VALUES
(1, 4, 'ON_THE_WAY', 'Team On the Way', '2024-10-09 16:45:39'),
(2, 4, 'IN_PROGRESS', 'Fire Relief Work in Progress', '2024-10-09 16:45:59'),
(3, 4, 'COMPLETE', 'Request Completed', '2024-10-09 16:46:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `fire_report`
--
ALTER TABLE `fire_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assign_to` (`assign_to`);

--
-- Indexes for table `fire_team`
--
ALTER TABLE `fire_team`
  ADD PRIMARY KEY (`team_id`);

--
-- Indexes for table `request_history`
--
ALTER TABLE `request_history`
  ADD PRIMARY KEY (`h_id`),
  ADD KEY `r_id` (`r_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fire_report`
--
ALTER TABLE `fire_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fire_team`
--
ALTER TABLE `fire_team`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `request_history`
--
ALTER TABLE `request_history`
  MODIFY `h_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request_history`
--
ALTER TABLE `request_history`
  ADD CONSTRAINT `request_history_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `fire_report` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
