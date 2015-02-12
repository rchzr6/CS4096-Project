-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2015 at 11:01 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `databases`
--

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `id_num` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `room` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `user_name` varchar(25) NOT NULL,
  `role` varchar(25) NOT NULL,
  `entry` int(11) NOT NULL,
  `group_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `mem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id_num` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `room` text NOT NULL,
  `phone` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` char(50) NOT NULL,
  `Name` text NOT NULL,
  `room_number` text NOT NULL,
  `phone` text NOT NULL,
  `status` text NOT NULL,
  `last_transaction_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stu_member`
--

CREATE TABLE IF NOT EXISTS `stu_member` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id` varchar(50) NOT NULL,
  `mem_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transaction_num` int(11) NOT NULL,
  `wo_num` int(11) NOT NULL,
  `wo_status` text NOT NULL,
  `transaction_by` text NOT NULL,
  `comments` longtext NOT NULL,
  `hours_logged` int(11) NOT NULL,
  `Date/Time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hours_logged_now` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_orders`
--

CREATE TABLE IF NOT EXISTS `work_orders` (
  `wo_num` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `wo_status` text NOT NULL,
  `submitter_status` text NOT NULL,
  `submitter_name` text NOT NULL,
  `submitter_room_num` text NOT NULL,
  `submitter_phone` text NOT NULL,
  `submitter_email` text NOT NULL,
  `submitter_advisor` text NOT NULL,
  `wo_scope` text NOT NULL,
  `wo_type` text NOT NULL,
  `wo_short_description` text NOT NULL,
  `wo_long_description` longtext NOT NULL,
  `wo_file_list` varchar(50) NOT NULL DEFAULT 'NO_FILES.php',
  `wo_submit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wo_complete_date` datetime NOT NULL,
  `wo_update_sequence` int(11) NOT NULL,
  `parent_wo_num` int(11) NOT NULL,
  `assigned_name` text NOT NULL,
  `assigned_group` text NOT NULL,
  `due_date` date NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
 ADD PRIMARY KEY (`id_num`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
 ADD PRIMARY KEY (`entry`), ADD UNIQUE KEY `entry` (`entry`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
 ADD PRIMARY KEY (`mem_id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
 ADD PRIMARY KEY (`id_num`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stu_member`
--
ALTER TABLE `stu_member`
 ADD PRIMARY KEY (`mem_id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
 ADD PRIMARY KEY (`transaction_num`), ADD UNIQUE KEY `Date/Time` (`Date/Time`), ADD UNIQUE KEY `transaction_num` (`transaction_num`);

--
-- Indexes for table `work_orders`
--
ALTER TABLE `work_orders`
 ADD PRIMARY KEY (`wo_num`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
