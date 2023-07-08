-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2023 at 05:09 PM
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
-- Database: `db_cv_creator`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblnotifications`
--

CREATE TABLE `tblnotifications` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `body` varchar(800) NOT NULL,
  `userID` varchar(20) NOT NULL,
  `authorID` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'UNREAD',
  `notivID` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblnotifications`
--

INSERT INTO `tblnotifications` (`id`, `title`, `body`, `userID`, `authorID`, `status`, `notivID`, `created_on`) VALUES
(1, '<b>Appointment Approved</b>', '<b>Hello, Test. </b><br>Your appointment with <b>ID: 840DEF566D671233</b>, and <b>DR. Dev lee</b>, has been approved. Scheduled on:  <b>Tuesday 30 May, 2023 - 12:00:00 AM</b>. Come early. 8AM<br>Be there promptly, Thanks', '28B10A971C6444A8', '28B10A971C6444A8', 'READ', 'ABBC52A5BD615A0F', '2023-05-19 05:20:03'),
(2, '<b>Appointment Approved</b>', '<b>Hello, Dev lee. </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. Dev lee</b>, has been approved. Scheduled on:  <b>Monday 29 May, 2023 - 12:00:00 AM</b>. Make sure to bring your test results<br>Be there promptly, Thanks', 'DD2DADC122462FA2', '28B10A971C6444A8', 'READ', '69630394EF52F44F', '2023-05-19 06:33:05'),
(3, '<b>Appointment Approved</b>', '<b>Hello, Dev lee. </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. Dev lee</b>, has been approved. Scheduled on:  <b>Monday 29 May, 2023 - 12:00:00 AM</b>. Make sure to bring your test results<br>Be there promptly, Thanks', 'DD2DADC122462FA2', '28B10A971C6444A8', 'READ', '0BC64486822894A1', '2023-05-19 06:34:48'),
(4, '<b>Appointment Canceled...</b>', '<b>Hello, Dev lee. </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. Dev lee</b>, has been cancedl. Sorry for the incoviniences caused. Scheduled on:  <b>Thursday 18 May, 2023 - 03:29:26 PM</b>. <br>Stay tunned for updateds on this appointment.', 'DD2DADC122462FA2', '28B10A971C6444A8', 'UNREAD', '3CE3E30B3D463623', '2023-05-19 07:56:55'),
(5, '<b>Appointment Re-Opened...</b>', '<b>Hello, Dev lee. </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. Dev lee</b>, has been Re Opend. Scheduled on:  <b>Thursday 18 May, 2023 - 03:29:26 PM</b>. <br>Stay tunned for updateds from this Doctor. Thanks', 'DD2DADC122462FA2', '28B10A971C6444A8', 'UNREAD', '250103F199D6863F', '2023-05-19 08:03:59'),
(6, '<b>Appointment Canceled...</b>', '<b>Hello, Dev lee. </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. Dev lee</b>, has been cancedl. Sorry for any incoviniences caused. Scheduled on:  <b>Thursday 18 May, 2023 - 03:29:26 PM</b>. <br>Stay tunned for updateds on this appointment. Thanks', 'DD2DADC122462FA2', '28B10A971C6444A8', 'UNREAD', 'E0D535192DBE3325', '2023-05-19 08:04:07'),
(7, '<b>Appointment Approved</b>', '<b>Hello, Dev lee. </b><br>Your appointment with <b>ID: 1CFBA108338EF31F</b>, and <b>DR. Dev lee</b>, has been approved. Scheduled on:  <b>Tuesday 20 June, 2023 - 12:00:00 AM</b>. Be earyly. See you till then...<br>Be there promptly, Thanks', 'DD2DADC122462FA2', '28B10A971C6444A8', 'READ', '6B0041DD6F89F07D', '2023-05-19 08:05:11'),
(8, '<b>Appointment Completed...</b>', '<b>Hello, Dev lee. </b><br>Happy to inform you than your appointment with <b>ID: 1CFBA108338EF31F</b>, and <b>DR. Dev lee</b>, Scheduled on:  <b>Thursday 18 May, 2023 - 03:28:06 PM</b>. <br>has finnally made it to an end. Thank you for using our system and Stay tunned for more update from us. Thanks', 'DD2DADC122462FA2', '28B10A971C6444A8', 'UNREAD', '2532ECD4DAD7F4EA', '2023-05-19 08:09:10'),
(9, '<b>Appointment Approved</b>', '<b>Hello, Test. </b><br>Your appointment with <b>ID: 840DEF566D671233</b>, and <b>DR. Dev lee</b>, has been approved. Scheduled on:  <b>Wednesday 24 May, 2023 - 12:00:00 AM</b>. Come early. 8AM<br>Be there promptly, Thanks', '28B10A971C6444A8', '28B10A971C6444A8', 'READ', '97331ACC9BF508A2', '2023-05-19 11:00:48'),
(10, '<b>Appointment Approved</b>', '<b>Hello, Test. </b><br>Your appointment with <b>ID: 3A3E9C5060E87359</b>, and <b>DR. Dev lee</b>, has been approved. Scheduled on:  <b>Wednesday 17 May, 2023</b>. <br>asdfsa asfd sadfsa dfsa<br>Doctors Schedule Date:  <b>Tuesday 23 May, 2023</b>. <br><br>Be there promptly, Thanks', '28B10A971C6444A8', '28B10A971C6444A8', 'UNREAD', '9D6CE9B7E44CB080', '2023-05-19 19:57:57'),
(11, '<b>Appointment Completed...</b>', '<b>Hello, Test. </b><br>Happy to inform you than your appointment with <b>ID: AC9F2B75BAFD7E34</b>, and <b>DR. Dev lee</b>, Scheduled on:  <b>Thursday 18 May, 2023 - 04:42:49 PM</b>. <br>has finnally made it to an end. Thank you for using our system and Stay tunned for more update from us. Thanks', '28B10A971C6444A8', '28B10A971C6444A8', 'UNREAD', '0749522DA6613A87', '2023-05-19 20:36:59'),
(12, '<b>Appointment Approved</b>', '<b>Hello, TUBUOH BENARD. </b><br>Your appointment with <b>ID: 59F6466B4B4F2777</b>, and <b>DR. Bernard Ngam</b>, has been approved. Scheduled on:  <b>Saturday 20 May, 2023</b>. <br><br>Be there promptly, Thanks', '64BAD2B0E088A942', 'C91975B3A7DE10B3', 'READ', '0AC09AACA31C758B', '2023-05-20 08:44:34'),
(13, '<b>Appointment Canceled...</b>', '<b>Hello, Test [UPDATED]. </b><br>Your appointment with <b>ID: 3AB34A006193B18F</b>, and <b>DR. Bernard Ngam</b>, has been cancedl. Sorry for any incoviniences caused. Scheduled on:  <b>Friday 19 May, 2023 - 10:56:21 AM</b>. <br>Stay tunned for updateds on this appointment. Thanks', '28B10A971C6444A8', '28B10A971C6444A8', 'READ', 'F6AE7E5A54AC9C15', '2023-05-21 06:16:35'),
(14, '<b>Appointment Re-Opened...</b>', '<b>Hello, . </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. </b>, has been Re Opend. Scheduled on:  <b>Thursday 18 May, 2023 - 03:29:26 PM</b>. <br>Stay tunned for updateds from this Doctor. Thanks', 'DD2DADC122462FA2', 'DD2DADC122462FA2', 'UNREAD', 'F84D8635222C021D', '2023-05-22 22:18:36'),
(15, '<b>Appointment Approved</b>', '<b>Hello, Dev lee new. </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. Dev lee new</b>, has been approved. Scheduled on:  <b>Thursday 18 May, 2023</b>. <br><br>Be there promptly, Thanks<br><br>Download PDF approach form <a href=\'/dashboard/reciept.php?reff=F20616EFCD6D5C32\' class=\'btn btn-s\'>Get PDF</a>', 'DD2DADC122462FA2', 'DD2DADC122462FA2', 'READ', '54DA81B0272840A7', '2023-05-22 22:31:16'),
(16, '<b>Appointment Approved</b>', '<b>Hello, TUBUOH BENARD. </b><br>Your appointment with <b>ID: 6A4E5EDB7FFA0430</b>, and <b>DR. Dev lee new</b>, has been approved. Scheduled on:  <b>Monday 29 May, 2023</b>. <br>come at 8:00am along with your receipt<br>Doctors Schedule Date:  <b>Monday 29 May, 2023</b>. <br><br>Be there promptly, Thanks<br><br>Download PDF approach form <a href=\'/dashboard/reciept.php?reff=6A4E5EDB7FFA0430\' class=\'btn btn-s\'>Get PDF</a>', '64BAD2B0E088A942', 'DD2DADC122462FA2', 'READ', '623830BE2F12E40C', '2023-05-23 06:54:20'),
(17, '<b>Appointment Approved</b>', '<b>Hello, ivonne julie. </b><br>Your appointment with <b>ID: 9AF62B02981873FB</b>, and <b>DR. Dev lee new</b>, has been approved. Scheduled on:  <b>Wednesday 24 May, 2023</b>. <br>come at 9am<br>Doctors Schedule Date:  <b>Wednesday 24 May, 2023</b>. <br><br>Be there promptly, Thanks<br><br>Download PDF approach form <a href=\'/dashboard/reciept.php?reff=9AF62B02981873FB\' class=\'btn btn-s\'>Get PDF</a>', 'BAD31AA1AF5C2ABA', 'DD2DADC122462FA2', 'READ', '1B202171FF40C039', '2023-05-23 18:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `tblorders`
--

CREATE TABLE `tblorders` (
  `id` int(11) NOT NULL,
  `orderID` varchar(20) NOT NULL,
  `productID` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'PENDING',
  `ordered_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblresumes`
--

CREATE TABLE `tblresumes` (
  `id` int(11) NOT NULL,
  `resumeID` varchar(30) NOT NULL COMMENT 'set of string and variable characters',
  `contact_info` varchar(500) NOT NULL COMMENT 'Store as an encode array parsed by php. It contains array key value pares. As a form of an Object or Array',
  `languages` varchar(500) NOT NULL COMMENT 'Store as an encode array parsed by php. It contains array key value pares. As a form of an Object or Array',
  `cover_photo` varchar(30) NOT NULL COMMENT 'string of data url to photo path in file system',
  `education` varchar(2000) NOT NULL COMMENT 'A more complex object stored as a JSON String',
  `work_experience` varchar(2000) NOT NULL COMMENT 'A more complex object stored as a JSON String',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblresume_metadata`
--

CREATE TABLE `tblresume_metadata` (
  `metaID` int(11) NOT NULL,
  `resume_title` varchar(30) NOT NULL,
  `resume_description` varchar(200) NOT NULL,
  `resumeID` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'USER',
  `action` varchar(20) NOT NULL DEFAULT 'NONE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `userID`, `username`, `email`, `phone`, `address`, `profile`, `password`, `reg_date`, `role`, `action`) VALUES
(1, 'DD2DADC122462FA2', 'Dev lee new', 'dev@gmail.com', '+4564546546', 'Bamenda', '', '$2y$10$en3eIsZTMzQi7ZhXbY6ld.fsrBJ8YXhTOw3Kmp8VGGSbbdDUp97CC', '2023-05-18 09:06:55', 'USER', 'NONE'),
(2, '28B10A971C6444A8', 'Test', 'test@gmail.com', '+4564546546', 'sadf sadfsadf UPDATED', '', '$2y$10$1oSltA/MbFELx0cApj7pVOTM.kKPIOfFW9RMCTesVjN4hd/4q0GQK', '2023-05-18 11:38:12', 'USER', 'NONE'),
(5, 'EA406A9FA932F8A0', 'Ank Lee NEW', 'lee@gmail.com', '+237670710480', 'Bamenda Cameroon, Bambili', '', '$2y$10$lW0IsU6McLXuPAEn3S5YHeOhEGdkIm9amliBGkHHmv21fgetj2K5y', '2023-05-20 00:37:51', 'USER', 'NONE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblnotifications`
--
ALTER TABLE `tblnotifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblorders`
--
ALTER TABLE `tblorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresumes`
--
ALTER TABLE `tblresumes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresume_metadata`
--
ALTER TABLE `tblresume_metadata`
  ADD PRIMARY KEY (`metaID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblnotifications`
--
ALTER TABLE `tblnotifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblorders`
--
ALTER TABLE `tblorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblresumes`
--
ALTER TABLE `tblresumes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblresume_metadata`
--
ALTER TABLE `tblresume_metadata`
  MODIFY `metaID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
