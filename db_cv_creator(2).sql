-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 12:26 PM
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
(6, '<b>Appointment Canceled...</b>', '<b>Hello, Dev lee. </b><br>Your appointment with <b>ID: F20616EFCD6D5C32</b>, and <b>DR. Dev lee</b>, has been cancedl. Sorry for any incoviniences caused. Scheduled on:  <b>Thursday 18 May, 2023 - 03:29:26 PM</b>. <br>Stay tunned for updateds on this appointment. Thanks', 'DD2DADC122462FA2', '28B10A971C6444A8', 'UNREAD', 'E0D535192DBE3325', '2023-05-19 08:04:07');

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
  `resume_id` varchar(40) NOT NULL COMMENT 'set of string and variable characters',
  `cover_photo` varchar(80) NOT NULL COMMENT 'Store as an encode array parsed by php. It contains array key value pares. As a form of an Object or Array',
  `personal` varchar(500) NOT NULL COMMENT 'Store as an encode array parsed by php. It contains array key value pares. As a form of an Object or Array',
  `extras` varchar(500) NOT NULL,
  `education` varchar(1000) NOT NULL COMMENT 'string of data url to photo path in file system',
  `experience` varchar(1000) NOT NULL COMMENT 'A more complex object stored as a JSON String',
  `social` varchar(250) NOT NULL,
  `language` varchar(200) NOT NULL COMMENT 'A more complex object stored as a JSON String',
  `skill` varchar(500) NOT NULL,
  `hobby` varchar(500) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblresumes`
--

INSERT INTO `tblresumes` (`id`, `resume_id`, `cover_photo`, `personal`, `extras`, `education`, `experience`, `social`, `language`, `skill`, `hobby`, `created_on`, `updated_on`) VALUES
(3, 'E08DDD2780606D5F7CD7', 'RESUME-209179933BA6ADA9957E46FC.jpg', '{\"firstname\":\"Ankain\",\"lastname\":\"lesly Chup\",\"address\":\"Cam Bamenda\",\"date_of_birth\":\"275760-05-06\",\"headline\":\"Font end Dev\",\"about\":\"About my soul...\",\"email\":\"leeleslyank@gmail.com\",\"phone\":\"670710480\"}', '[]', '{\"UU-1690948536790\":{\"education\":\"OJaf\",\"school\":\"sajadf\",\"start_date\":\"4894-06-04\",\"end_date\":\"0004-08-04\",\"city\":\"Bamenda\",\"description\":\"asdfasdffas\"},\"UU-1690955861050\":{\"education\":\"adfsadf\",\"school\":\"asdf sad\",\"start_date\":\"0003-03-04\",\"end_date\":\"0005-03-04\",\"city\":\"asdasf\",\"description\":\"asdfsadf \",\"present\":\"true\"}}', '{\"UU-1690949911541\":{\"position\":\"Soft\",\"employer\":\"Civilsalt\",\"start_date\":\"0768-05-08\",\"end_date\":\"7867-06-08\",\"city\":\"Bamenda\",\"description\":\"adfas dfsadfa sdf sdf sdfa sd\"},\"UU-1690955833378\":{\"position\":\"asdf\",\"employer\":\"asdf\",\"city\":\"asdf\",\"description\":\"asdfsadf\",\"end_date\":\"6456-04-05\",\"start_date\":\"0006-04-05\"}}', '{\"UU-1690950717900\":{\"social\":\"Facebook\",\"handle\":\"asdffas d\"},\"UU-1690950726996\":{\"social\":\"Telegram\",\"handle\":\"asdfsadf\"},\"UU-1690951458989\":{\"social\":\"Website\",\"handle\":\"adf\"},\"UU-1690955759154\":{\"social\":\"Website\",\"handle\":\"asdfsaf\"},\"UU-16909558', '', '', '', '2023-07-25 14:45:30', '2023-08-02 09:16:18'),
(16, '99068FFA42F940A8AC06614551C5B8B4', 'RESUME-39E077A745978B1EE5AC8C07.jpg', '{\"firstname\":\"Ankain\",\"lastname\":\"lesly Chup\",\"address\":\"Cam Bamenda\",\"date_of_birth\":\"275760-05-06\",\"headline\":\"Font end Dev\",\"about\":\"About my soul...\",\"email\":\"leeleslyank@gmail.com\",\"phone\":\"670710480\"}', '[]', '{\"UU-1690948536790\":{\"education\":\"OJaf\",\"school\":\"sajadf\",\"start_date\":\"4894-06-04\",\"end_date\":\"0004-08-04\",\"city\":\"Bamenda\",\"description\":\"asdfasdffas\"},\"UU-1690949085750\":{\"education\":\"111HYD\",\"school\":\"asdf \",\"start_date\":\"0076-07-08\",\"end_date\":\"0078-07-06\",\"city\":\"Casss\",\"description\":\"lorem dorl.sadfl\"}}', '{\"UU-1690949911541\":{\"position\":\"Soft\",\"employer\":\"Civilsalt\",\"start_date\":\"0768-05-08\",\"end_date\":\"7867-06-08\",\"city\":\"Bamenda\",\"description\":\"adfas dfsadfa sdf sdf sdfa sd\"},\"UU-1690949945667\":{\"position\":\"Cake\",\"employer\":\"Yoaid\",\"start_date\":\"0005-05-07\",\"city\":\"57 street ayaba\",\"description\":\"sadfj;adkf sadf\"}}', '{\"UU-1690950717900\":{\"social\":\"Facebook\",\"handle\":\"asdffas d\"},\"UU-1690950726996\":{\"social\":\"Telegram\",\"handle\":\"asdfsadf\"},\"UU-1690950732141\":{\"social\":\"Twitter\"},\"UU-1690950828981\":{\"social\":\"LinkedIn\",\"handle\":\"asf\"},\"UU-1690951458989\":{\"social\":\"', '', '', '', '2023-08-01 18:08:21', '2023-08-01 21:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblresume_metadata`
--

CREATE TABLE `tblresume_metadata` (
  `id` int(11) NOT NULL,
  `meta_id` varchar(40) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `template_id` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `description` varchar(200) NOT NULL,
  `resume_id` varchar(40) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblresume_metadata`
--

INSERT INTO `tblresume_metadata` (`id`, `meta_id`, `user_id`, `template_id`, `title`, `description`, `resume_id`, `created_on`) VALUES
(3, '05EC5978A0270C0623D0', 'E410B95575C4CD27FA32B3B9', '26F455977DEC2E1F3235', 'Test', 'test', 'E08DDD2780606D5F7CD7', '2023-07-25 14:45:30'),
(16, '76431F55E647E275897C346DC65F0E1D', 'E410B95575C4CD27FA32B3B9', '666C76835290FF20BC3B', 'Job', 'My first job..', '99068FFA42F940A8AC06614551C5B8B4', '2023-08-01 18:08:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbltemplates`
--

CREATE TABLE `tbltemplates` (
  `id` int(11) NOT NULL,
  `template_id` varchar(30) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `php_file` varchar(30) NOT NULL,
  `css_file` varchar(30) NOT NULL,
  `title` varchar(20) NOT NULL,
  `settings` varchar(80) NOT NULL,
  `user_id` varchar(40) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltemplates`
--

INSERT INTO `tbltemplates` (`id`, `template_id`, `thumbnail`, `php_file`, `css_file`, `title`, `settings`, `user_id`, `status`, `created_on`) VALUES
(2, '49FF05DD133B2ABB68F3', 'TEMPLATE-49FF05DD133B2ABB68F3.png', 'Design-49FF05DD133B2ABB68F3.ph', 'Design-49FF05DD133B2ABB68F3.cs', 'Updated', 'picture,firstname,education,', 'E410B95575C4CD27FA32B3B9', 0, '2023-08-01 11:42:28'),
(3, 'D5F33C079AA3FEEF6CBE', 'TEMPLATE-D5F33C079AA3FEEF6CBE.png', 'Design-D5F33C079AA3FEEF6CBE.ph', 'Design-D5F33C079AA3FEEF6CBE.cs', 'AS', 'picture,firstname,', 'E410B95575C4CD27FA32B3B9', 0, '2023-08-01 11:43:09'),
(4, '4BCEFDD5ED8359006458', 'TEMPLATE-4BCEFDD5ED8359006458.png', 'Design-4BCEFDD5ED8359006458.ph', 'Design-4BCEFDD5ED8359006458.cs', 'Basis', 'picture,firstname,picture,lastname,', 'E410B95575C4CD27FA32B3B9', 0, '2023-08-01 15:57:01'),
(5, '666C76835290FF20BC3B', 'TEMPLATE-666C76835290FF20BC3B.png', 'Design-666C76835290FF20BC3B.ph', 'Design-666C76835290FF20BC3B.cs', 'Classic Design', '', 'E410B95575C4CD27FA32B3B9', 1, '2023-08-01 16:50:38'),
(6, '589258CE063A20C771D7', 'TEMPLATE-589258CE063A20C771D7.png', 'Design-589258CE063A20C771D7.ph', 'Design-589258CE063A20C771D7.cs', 'Minimal Design', '', 'E410B95575C4CD27FA32B3B9', 1, '2023-08-01 16:54:00'),
(7, '132982E41F2E8B1E5950', 'TEMPLATE-132982E41F2E8B1E5950.png', 'Design-132982E41F2E8B1E5950.ph', 'Design-132982E41F2E8B1E5950.cs', 'Basic Design', '', 'E410B95575C4CD27FA32B3B9', 1, '2023-08-01 16:54:48'),
(8, '26F455977DEC2E1F3235', 'TEMPLATE-26F455977DEC2E1F3235.png', 'Design-26F455977DEC2E1F3235.ph', 'Design-26F455977DEC2E1F3235.cs', 'Info Based', '', 'E410B95575C4CD27FA32B3B9', 1, '2023-08-01 16:55:55'),
(9, '195D7E206E01898BA1AA', 'TEMPLATE-195D7E206E01898BA1AA.png', 'Design-195D7E206E01898BA1AA.ph', 'Design-195D7E206E01898BA1AA.cs', 'Clean Design', '', 'E410B95575C4CD27FA32B3B9', 1, '2023-08-01 16:57:17');

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
  `action` varchar(20) NOT NULL DEFAULT 'NONE',
  `password_reset` varchar(50) NOT NULL COMMENT 'Container users password verification tokens'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `userID`, `username`, `email`, `phone`, `address`, `profile`, `password`, `reg_date`, `role`, `action`, `password_reset`) VALUES
(26, '378DF613E235DBF7DEE5BE91', 'ankleexx', 'ankleexx@gmail.com', '', '', '', '$2y$10$sLUmF73tAAdwxccweZgjh.AV8qxmV2AcRSPnaGAra0VWZXsuKGhrO', '2023-07-13 15:08:39', '1', 'NONE', ''),
(27, 'E410B95575C4CD27FA32B3B9', 'Test name', 'test@gmail.com', '+4564546546 asdf', '345 go street A 21 asdfsadf', 'IMG-TEST-NAME-E410B95575C4CD27FA32B3B9.jpg', '$2y$10$T90sHM4jTVHZZlfi7Ys2tO5Tcqf9ITzOqmy2L1OdjDYsICjEDx7Sm', '2023-07-24 18:05:29', '3', 'NONE', 'DONE');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltemplates`
--
ALTER TABLE `tbltemplates`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblresume_metadata`
--
ALTER TABLE `tblresume_metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbltemplates`
--
ALTER TABLE `tbltemplates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
