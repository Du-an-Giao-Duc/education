-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2015 at 08:02 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE IF NOT EXISTS `school` (
`id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `reg_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_role_code`
--

CREATE TABLE IF NOT EXISTS `user_role_code` (
  `username` varchar(50) NOT NULL,
  `role_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `question_id` (`question_id`);

--
-- Indexes for table `chuong`
--
ALTER TABLE `chuong`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `class_id` (`class_id`);

--
-- Indexes for table `chuyen_de`
--
ALTER TABLE `chuyen_de`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `chuong_id` (`chuong_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `subject_id` (`subject_id`);

--
-- Indexes for table `dang_bai`
--
ALTER TABLE `dang_bai`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `chuyen_de_id` (`chuyen_de_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `post_user` (`post_user`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `dang_bai_id` (`dang_bai_id`), ADD UNIQUE KEY `question_type_id` (`question_type_id`), ADD UNIQUE KEY `post_user` (`post_user`), ADD UNIQUE KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `subject_id` (`subject_id`), ADD UNIQUE KEY `quiz_type_id` (`quiz_type_id`), ADD UNIQUE KEY `school_id` (`school_id`);

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
 ADD PRIMARY KEY (`username`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chuyen_de`
--
ALTER TABLE `chuyen_de`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dang_bai`
--
ALTER TABLE `dang_bai`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
