-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2015 at 10:43 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studyonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE IF NOT EXISTS `answer` (
`id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `is_true` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chuong`
--

CREATE TABLE IF NOT EXISTS `chuong` (
`id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chuong`
--

INSERT INTO `chuong` (`id`, `class_id`, `order_number`, `semester`, `name`, `description`) VALUES
(28, 2, 1, 1, 'Chương 1', 'Chương 1'),
(29, 2, 2, 2, 'Chương 2', 'Chương 2'),
(30, 2, 3, 1, 'Chương 3', 'Chương 3'),
(31, 3, 1, 1, 'Chương 1', 'Chương 1'),
(34, 3, 3, 1, 'Chương 2', 'Chương 2'),
(35, 3, 2, 1, 'Chương 3', 'Chương 3');

-- --------------------------------------------------------

--
-- Table structure for table `chuyen_de`
--

CREATE TABLE IF NOT EXISTS `chuyen_de` (
`id` int(11) NOT NULL,
  `chuong_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chuyen_de`
--

INSERT INTO `chuyen_de` (`id`, `chuong_id`, `order_number`, `name`, `description`) VALUES
(3, 28, 1, 'Chuyên đề 1', 'Chuyên đề 1'),
(6, 34, 1, 'Chuyên đề 1', 'Chuyên đề 1'),
(7, 28, 2, 'Chuyên đề 2', 'Chuyên đề 2'),
(8, 29, 1, 'Chuyên đề 2', 'Chuyên đề 1'),
(9, 29, 2, 'Chuyên đề 1', 'Chuyên đề 1');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `subject_id`, `name`, `description`) VALUES
(2, 7, '10', 'Lớp 10'),
(3, 7, '11', 'Lớp 11'),
(4, 8, '10', '10'),
(5, 7, '12', 'Lớp 12'),
(6, 7, 'Lớp 10', 'Lớp 10'),
(7, 8, '11', '11');

-- --------------------------------------------------------

--
-- Table structure for table `dang_bai`
--

CREATE TABLE IF NOT EXISTS `dang_bai` (
`id` int(11) NOT NULL,
  `chuyen_de_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dang_bai`
--

INSERT INTO `dang_bai` (`id`, `chuyen_de_id`, `order_number`, `name`, `description`) VALUES
(2, 8, 1, 'Dạng 1', 'Dạng 1'),
(3, 8, 2, 'Dạng 2', 'Dạng 1'),
(4, 9, 1, 'Dạng 2', 'Dạng 1'),
(5, 3, 1, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
`id` int(11) NOT NULL,
  `reg_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL,
  `post_user` varchar(50) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
`id` int(11) NOT NULL,
  `dang_bai_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `question_type_id` int(11) NOT NULL,
  `is_theory` tinyint(1) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `is_common` tinyint(1) NOT NULL,
  `is_basic` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `solution` text,
  `status` tinyint(1) NOT NULL,
  `reg_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL,
  `post_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE IF NOT EXISTS `question_type` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_type`
--

INSERT INTO `question_type` (`id`, `name`, `description`) VALUES
(1, 'Cơ bản', 'Cơ bản này'),
(2, 'xxx', 'xxx');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
`id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quiz_type_id` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `school_id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_type`
--

CREATE TABLE IF NOT EXISTS `quiz_type` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `description`) VALUES
(7, 'Toán', 'Môn Toán'),
(8, 'Lý', 'Môn Lý'),
(9, 'Hóa', 'Môn Hóa'),
(12, 'Sinh', 'Môn Sinh'),
(13, 'Anh', 'Môn Anh');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` tinyint(1) NOT NULL,
  `role_post` tinyint(1) NOT NULL,
  `role_edit` tinyint(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role`, `role_post`, `role_edit`, `email`, `reg_date`) VALUES
('1', '12345678', 2, 1, 1, 'hoangducnam.hoang645@gmail.com', '2015-06-14 00:00:00'),
('a', '11111111', 1, 0, 0, 'b@gmail.com', '2015-06-17 22:48:41'),
('fasfd', '11111111', 5, 0, 0, 'xr@gmail.com', '2015-06-17 22:47:08'),
('namhd', '11111111', 3, 1, 1, 'namhd@fsoft.com.vn', '2015-06-09 00:00:00'),
('phuoctd', '111111111', 5, 0, 0, 'phuoctd@gmail.com', '2015-06-18 23:15:39'),
('sdfas', '11111111', 5, 0, 0, 'xxx@gmail.com', '0000-00-00 00:00:00'),
('xxx', '123456789', 5, 0, 0, 'xyz@gmail.com', '2015-06-17 23:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_code`
--

CREATE TABLE IF NOT EXISTS `user_role_code` (
  `username` varchar(50) NOT NULL,
  `role_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role_code`
--

INSERT INTO `user_role_code` (`username`, `role_code`) VALUES
('1', 7),
('1', 8),
('namhd', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`id`), ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `chuong`
--
ALTER TABLE `chuong`
 ADD PRIMARY KEY (`id`), ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `chuyen_de`
--
ALTER TABLE `chuyen_de`
 ADD PRIMARY KEY (`id`), ADD KEY `chuong_id` (`chuong_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `dang_bai`
--
ALTER TABLE `dang_bai`
 ADD PRIMARY KEY (`id`), ADD KEY `chuyen_de_id` (`chuyen_de_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`), ADD KEY `post_user` (`post_user`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`id`), ADD KEY `dang_bai_id` (`dang_bai_id`), ADD KEY `question_type_id` (`question_type_id`), ADD KEY `quiz_id` (`quiz_id`), ADD KEY `post_user` (`post_user`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
 ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `school_id` (`school_id`), ADD KEY `quiz_type_id` (`quiz_type_id`);

--
-- Indexes for table `quiz_type`
--
ALTER TABLE `quiz_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_role_code`
--
ALTER TABLE `user_role_code`
 ADD PRIMARY KEY (`username`,`role_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chuong`
--
ALTER TABLE `chuong`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `chuyen_de`
--
ALTER TABLE `chuyen_de`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dang_bai`
--
ALTER TABLE `dang_bai`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_type`
--
ALTER TABLE `quiz_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
ADD CONSTRAINT `answer_question` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `chuong`
--
ALTER TABLE `chuong`
ADD CONSTRAINT `chuong_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`);

--
-- Constraints for table `chuyen_de`
--
ALTER TABLE `chuyen_de`
ADD CONSTRAINT `chuyen_de_chuong` FOREIGN KEY (`chuong_id`) REFERENCES `chuong` (`id`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
ADD CONSTRAINT `class_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `dang_bai`
--
ALTER TABLE `dang_bai`
ADD CONSTRAINT `dang_bai_chuyen_de` FOREIGN KEY (`chuyen_de_id`) REFERENCES `chuyen_de` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
ADD CONSTRAINT `news_user` FOREIGN KEY (`post_user`) REFERENCES `user` (`username`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
ADD CONSTRAINT `question_dang_bai` FOREIGN KEY (`dang_bai_id`) REFERENCES `dang_bai` (`id`),
ADD CONSTRAINT `question_post_user` FOREIGN KEY (`post_user`) REFERENCES `user` (`username`),
ADD CONSTRAINT `question_question_type` FOREIGN KEY (`question_type_id`) REFERENCES `question_type` (`id`),
ADD CONSTRAINT `question_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
ADD CONSTRAINT `quiz_quiz_type` FOREIGN KEY (`quiz_type_id`) REFERENCES `quiz_type` (`id`),
ADD CONSTRAINT `quiz_school` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
ADD CONSTRAINT `quiz_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `user_role_code`
--
ALTER TABLE `user_role_code`
ADD CONSTRAINT `user_role_code_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
