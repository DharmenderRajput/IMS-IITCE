-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2020 at 08:46 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims_iitce`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(255) NOT NULL,
  `crs_stream` int(255) NOT NULL,
  `crs_fname` varchar(255) NOT NULL,
  `crs_aname` varchar(255) NOT NULL,
  `crs_duration` int(255) NOT NULL,
  `crs_period` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `crs_stream`, `crs_fname`, `crs_aname`, `crs_duration`, `crs_period`) VALUES
(3, 42, 'Information Tecnology', 'IT', 5, 'Months'),
(4, 43, 'Advance diploma in hardware networking', 'ADHN', 2, 'Months'),
(5, 42, 'Networking', 'NETW', 2, 'Year');

-- --------------------------------------------------------

--
-- Table structure for table `course_fee`
--

CREATE TABLE `course_fee` (
  `id` int(255) NOT NULL,
  `course` int(255) NOT NULL,
  `fee_head` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_fee`
--

INSERT INTO `course_fee` (`id`, `course`, `fee_head`) VALUES
(15, 4, 8),
(16, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `fee_head`
--

CREATE TABLE `fee_head` (
  `id` int(255) NOT NULL,
  `fee_head_code` varchar(255) NOT NULL,
  `fee_head_name` varchar(255) NOT NULL,
  `fee_head_type` varchar(255) NOT NULL,
  `fee_head_category` varchar(255) NOT NULL,
  `taxable` int(10) NOT NULL DEFAULT 0 COMMENT '0-false 1-true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_head`
--

INSERT INTO `fee_head` (`id`, `fee_head_code`, `fee_head_name`, `fee_head_type`, `fee_head_category`, `taxable`) VALUES
(8, 'Add Fee', 'Addmission Fee', 'Institutional', 'Addmission', 1),
(9, 'IDCARD', 'Identity card', 'Non-Institutional', 'Addmission', 1),
(10, 'EXFEE', 'Exam Fees', 'Non-Institutional', 'Exam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(10) NOT NULL,
  `menu_position` int(10) DEFAULT NULL COMMENT 'falls under wich menu contains menu_id',
  `menu_head` varchar(255) NOT NULL COMMENT 'Name of menu head',
  `menu_type` int(10) NOT NULL COMMENT '0 - main 1-dropdown',
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `admin` int(10) NOT NULL COMMENT '0 - false  1 - true',
  `admin_manager` int(10) NOT NULL COMMENT '0 - false  1 - true',
  `subadmin` int(10) NOT NULL COMMENT '0 - false  1 - true',
  `subadmin_manager` int(10) NOT NULL COMMENT '0 - false  1 - true'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_position`, `menu_head`, `menu_type`, `link`, `icon`, `admin`, `admin_manager`, `subadmin`, `subadmin_manager`) VALUES
(1, 0, 'Masters', 0, '', '', 1, 1, 1, 1),
(2, 1, 'Streams Master', 1, 'streammaster.php', 'glyphicon-tags', 1, 0, 0, 0),
(3, 1, 'Fee Head Master', 1, 'feeheadmaster.php', 'glyphicon-euro', 1, 0, 0, 0),
(4, 1, 'Course Master', 1, 'coursemaster.php', 'glyphicon-book', 1, 0, 0, 0),
(5, 1, 'Affiliation Body Master', 1, '', 'glyphicon-education', 0, 0, 0, 0),
(6, 1, 'Affiliation Body Setup', 1, '', 'glyphicon-education', 0, 0, 0, 0),
(7, 1, 'Course Fee Setup', 1, 'coursefee.php', 'glyphicon-usd', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE `streams` (
  `id` int(255) NOT NULL,
  `stream_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`id`, `stream_name`) VALUES
(42, 'Param'),
(43, 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` int(255) NOT NULL,
  `User_name` varchar(255) NOT NULL,
  `User_authority` varchar(255) NOT NULL,
  `User_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `User_name`, `User_authority`, `User_password`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_fee`
--
ALTER TABLE `course_fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fee_head`
--
ALTER TABLE `fee_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_fee`
--
ALTER TABLE `course_fee`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `fee_head`
--
ALTER TABLE `fee_head`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `streams`
--
ALTER TABLE `streams`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
