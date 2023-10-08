-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 05:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcu`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `admin_Name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_Name`, `email`, `password`) VALUES
(1, 'Subramanya A T', 'sub@gmail.com', 'sub@123');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventid` int(100) NOT NULL,
  `ename` varchar(255) NOT NULL,
  `event_cid` int(255) NOT NULL,
  `winner_regno` varchar(255) NOT NULL,
  `runner_regno` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `ename`, `event_cid`, `winner_regno`, `runner_regno`) VALUES
(1, 'Cricket', 1, 'S1818589', 'S1818579'),
(2, 'Chess', 2, 'S1818589', ''),
(3, 'Football', 3, '', ''),
(4, 'Volleyball ', 4, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `event_coordinator`
--

CREATE TABLE `event_coordinator` (
  `coor_id` int(200) NOT NULL,
  `coor_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `STATUS` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_coordinator`
--

INSERT INTO `event_coordinator` (`coor_id`, `coor_name`, `email`, `password`, `phoneno`, `STATUS`) VALUES
(1, 'Chandrababu Yeragorla', 'Chandra@gmail.com', 'Chandra@123', '1234567891', '1'),
(2, 'Chandana', 'chandana@gmail.com', 'chandana@123', '123456789', '1'),
(3, 'Vishal', 'vishal@gmail.com', 'vishal@123', '123456789', '1'),
(4, 'Subramanya A T', 'Sub@gamil.com', 'Sub@123', '1234567898', '1'),
(5, 'Hareesh', 'Hari@gamil.com', 'Hari@123', '1232456789', '0');

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` int(255) NOT NULL,
  `Reg_no` varchar(255) NOT NULL,
  `eventid` int(255) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `Reg_no`, `eventid`, `status`) VALUES
(1, 'S1818589', 1, 1),
(4, 'S1818589', 2, 1),
(6, 'S1818579', 1, 1),
(7, 'S1818579', 2, 0),
(8, 'S1818579', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int(255) NOT NULL,
  `reg_no` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `college` varchar(255) NOT NULL,
  `cource` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `reg_no`, `name`, `email`, `password`, `photo`, `phone`, `college`, `cource`) VALUES
(1, 'S1818589', 'Yeragorla Chandrababu', 'cyeragorla@gmail.com', 'Cha@12340', 'student_photos/1694415844522.jpg', '8297986036', 'Ingou', 'PG Computer Science'),
(5, 'S1818579', 'Subramanya', 'subramanya@gmail.com', 'Sub@1230', 'student_photos/1694530243206.jpg', '8975756868', 'Bengaluru C University ', 'PG Computer Science');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventid`),
  ADD UNIQUE KEY `foreign key` (`event_cid`);

--
-- Indexes for table `event_coordinator`
--
ALTER TABLE `event_coordinator`
  ADD PRIMARY KEY (`coor_id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `Reg_no` (`reg_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `eventid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `event_coordinator`
--
ALTER TABLE `event_coordinator`
  MODIFY `coor_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
