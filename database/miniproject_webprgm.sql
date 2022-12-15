-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2022 at 11:26 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniproject_webprgm`
--
CREATE DATABASE IF NOT EXISTS `miniproject_webprgm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `miniproject_webprgm`;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cid` varchar(10) NOT NULL COMMENT 'รหัสวิชา',
  `cname` varchar(40) NOT NULL COMMENT 'ชื่อวิชา',
  `tid` varchar(10) NOT NULL COMMENT 'รหัสอาจารย์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ตารางรายวิชา';

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `cname`, `tid`) VALUES
('a01', 'ทักษะการทำประตู', '0001'),
('a02', 'ทักษะการเลี้ยงบอล', '0001'),
('a03', 'ทักษะการป้องกัน', '0001'),
('a04', 'ทักษะเล่นลูกกลางอากาศ', '0001'),
('a05', 'ทักษะการเปิดบอล', '0002'),
('a06', 'เส้นทางแห่งการเป็นแชมป์', '0002');

-- --------------------------------------------------------

--
-- Table structure for table `c_check`
--

CREATE TABLE `c_check` (
  `no` int(10) NOT NULL,
  `cid` varchar(10) NOT NULL COMMENT 'รหัสวิชา(FK)',
  `sid` varchar(10) NOT NULL COMMENT 'รหัสนศ(FK)',
  `check_status` int(1) NOT NULL COMMENT '0 ขาด ,1 มา ,2 สาย',
  `date_check` date NOT NULL COMMENT 'ว/ด/ป ที่เช็คชื่อ',
  `date_save` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ตารางเช็คชื่อ';

--
-- Dumping data for table `c_check`
--

INSERT INTO `c_check` (`no`, `cid`, `sid`, `check_status`, `date_check`, `date_save`) VALUES
(7, 'a01', '6301', 2, '2022-09-17', '2022-09-16 17:51:25'),
(8, 'a01', '6302', 2, '2022-09-17', '2022-09-16 17:51:25'),
(9, 'a01', '6303', 2, '2022-09-17', '2022-09-16 17:51:25'),
(10, 'a01', '6304', 2, '2022-09-17', '2022-09-16 17:51:25'),
(11, 'a01', '6305', 2, '2022-09-17', '2022-09-16 17:51:25'),
(12, 'a01', '6306', 2, '2022-09-17', '2022-09-16 17:51:25'),
(13, 'a01', '6301', 1, '2022-09-13', '2022-09-16 17:47:27'),
(14, 'a01', '6302', 0, '2022-09-13', '2022-09-16 17:47:27'),
(15, 'a01', '6303', 2, '2022-09-13', '2022-09-16 17:47:27'),
(16, 'a01', '6304', 1, '2022-09-13', '2022-09-16 17:47:27'),
(17, 'a01', '6305', 0, '2022-09-13', '2022-09-16 17:47:27'),
(18, 'a01', '6306', 1, '2022-09-13', '2022-09-16 17:47:27'),
(19, 'a01', '6301', 1, '2022-09-23', '2022-09-23 14:28:18'),
(20, 'a01', '6302', 1, '2022-09-23', '2022-09-23 14:28:18'),
(21, 'a01', '6303', 1, '2022-09-23', '2022-09-23 14:28:18'),
(22, 'a01', '6304', 1, '2022-09-23', '2022-09-23 14:28:18'),
(23, 'a01', '6305', 1, '2022-09-23', '2022-09-23 14:28:18'),
(24, 'a01', '6306', 1, '2022-09-23', '2022-09-23 14:28:18'),
(25, 'a01', '6301', 2, '2022-09-20', '2022-09-23 14:28:30'),
(26, 'a01', '6302', 2, '2022-09-20', '2022-09-23 14:28:30'),
(27, 'a01', '6303', 2, '2022-09-20', '2022-09-23 14:28:30'),
(28, 'a01', '6304', 2, '2022-09-20', '2022-09-23 14:28:30'),
(29, 'a01', '6305', 2, '2022-09-20', '2022-09-23 14:28:30'),
(30, 'a01', '6306', 2, '2022-09-20', '2022-09-23 14:28:30'),
(31, 'a01', '6301', 1, '2022-09-30', '2022-09-30 05:41:47'),
(32, 'a01', '6302', 1, '2022-09-30', '2022-09-30 05:41:47'),
(33, 'a01', '6303', 2, '2022-09-30', '2022-09-30 05:41:47'),
(34, 'a01', '6304', 1, '2022-09-30', '2022-09-30 05:41:47'),
(35, 'a01', '6305', 1, '2022-09-30', '2022-09-30 05:41:47'),
(36, 'a01', '6306', 1, '2022-09-30', '2022-09-30 05:41:47'),
(37, 'a01', '6301', 1, '2022-10-01', '2022-10-01 08:12:33'),
(38, 'a01', '6302', 1, '2022-10-01', '2022-10-01 08:12:33'),
(39, 'a01', '6303', 1, '2022-10-01', '2022-10-01 08:12:33'),
(40, 'a01', '6304', 1, '2022-10-01', '2022-10-01 08:12:33'),
(41, 'a01', '6305', 1, '2022-10-01', '2022-10-01 08:12:33'),
(42, 'a01', '6306', 1, '2022-10-01', '2022-10-01 08:12:33'),
(43, 'a01', '6301', 1, '2022-10-08', '2022-10-08 16:40:36'),
(44, 'a01', '6302', 1, '2022-10-08', '2022-10-08 16:40:36'),
(45, 'a01', '6303', 1, '2022-10-08', '2022-10-08 16:40:36'),
(46, 'a01', '6304', 1, '2022-10-08', '2022-10-08 16:40:36'),
(47, 'a01', '6305', 1, '2022-10-08', '2022-10-08 16:40:36'),
(48, 'a01', '6306', 2, '2022-10-08', '2022-10-08 16:40:36'),
(49, 'a01', '6301', 1, '2022-10-06', '2022-10-08 16:41:01'),
(50, 'a01', '6302', 2, '2022-10-06', '2022-10-08 16:41:01'),
(51, 'a01', '6303', 0, '2022-10-06', '2022-10-08 16:41:01'),
(52, 'a01', '6304', 1, '2022-10-06', '2022-10-08 16:41:01'),
(53, 'a01', '6305', 1, '2022-10-06', '2022-10-08 16:41:01'),
(54, 'a01', '6306', 2, '2022-10-06', '2022-10-08 16:41:01'),
(55, 'a02', '6301', 1, '2022-10-09', '2022-10-08 21:55:53'),
(56, 'a02', '6302', 1, '2022-10-09', '2022-10-08 21:55:53'),
(57, 'a02', '6303', 1, '2022-10-09', '2022-10-08 21:55:53'),
(58, 'a02', '6304', 1, '2022-10-09', '2022-10-08 21:55:53'),
(59, 'a02', '6305', 1, '2022-10-09', '2022-10-08 21:55:53'),
(60, 'a02', '6306', 1, '2022-10-09', '2022-10-08 21:55:53'),
(61, 'a02', '6301', 2, '2022-10-06', '2022-10-08 17:45:57'),
(62, 'a02', '6302', 1, '2022-10-06', '2022-10-08 17:45:57'),
(63, 'a02', '6303', 1, '2022-10-06', '2022-10-08 17:45:57'),
(64, 'a02', '6304', 1, '2022-10-06', '2022-10-08 17:45:57'),
(65, 'a02', '6305', 1, '2022-10-06', '2022-10-08 17:45:57'),
(66, 'a02', '6306', 1, '2022-10-06', '2022-10-08 17:45:57'),
(67, 'a02', '6301', 1, '2022-10-04', '2022-10-08 17:46:14'),
(68, 'a02', '6302', 1, '2022-10-04', '2022-10-08 17:46:14'),
(69, 'a02', '6303', 1, '2022-10-04', '2022-10-08 17:46:14'),
(70, 'a02', '6304', 1, '2022-10-04', '2022-10-08 17:46:14'),
(71, 'a02', '6305', 1, '2022-10-04', '2022-10-08 17:46:14'),
(72, 'a02', '6306', 1, '2022-10-04', '2022-10-08 17:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `full_score`
--

CREATE TABLE `full_score` (
  `cid` varchar(10) NOT NULL COMMENT 'รหัสวิชา(FK)',
  `f_keep` int(11) NOT NULL COMMENT 'คะแนนเก็บ(เต็ม)',
  `f_midterm` int(11) NOT NULL COMMENT 'คะแนนสอบกลางภาค(เต็ม)',
  `f_final` int(11) NOT NULL COMMENT 'คะแนนสอบปลายภาค(เต็ม)',
  `f_sum` int(11) NOT NULL COMMENT 'คะแนนรวม(เต็ม)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ตารางคะแนนเต็ม';

--
-- Dumping data for table `full_score`
--

INSERT INTO `full_score` (`cid`, `f_keep`, `f_midterm`, `f_final`, `f_sum`) VALUES
('a01', 40, 30, 30, 100);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `cid` varchar(10) NOT NULL COMMENT 'รหัสวิชา(FK)',
  `year` varchar(4) NOT NULL COMMENT 'ชื่อวิชา',
  `term` varchar(2) NOT NULL COMMENT 'ปีการศึกษา',
  `sec` varchar(2) NOT NULL COMMENT 'กลุ่มเรียน',
  `sid` varchar(10) NOT NULL COMMENT 'รหัสนศ(FK)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ตารางลงทะเบียนเรียน';

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`cid`, `year`, `term`, `sec`, `sid`) VALUES
('a01', '2565', '01', '01', '6301'),
('a01', '2565', '01', '01', '6302'),
('a01', '2565', '01', '01', '6303'),
('a01', '2565', '01', '01', '6304'),
('a01', '2565', '01', '01', '6305'),
('a01', '2565', '01', '01', '6306'),
('a02', '2565', '01', '01', '6301'),
('a02', '2565', '01', '01', '6302'),
('a02', '2565', '01', '01', '6303'),
('a02', '2565', '01', '01', '6304'),
('a02', '2565', '01', '01', '6305'),
('a02', '2565', '01', '01', '6306'),
('a03', '2565', '01', '01', '6301'),
('a03', '2565', '01', '01', '6302'),
('a03', '2565', '01', '01', '6303'),
('a03', '2565', '01', '01', '6304'),
('a03', '2565', '01', '01', '6305'),
('a03', '2565', '01', '01', '6306'),
('a04', '2565', '01', '01', '6301'),
('a04', '2565', '01', '01', '6302'),
('a04', '2565', '01', '01', '6303'),
('a04', '2565', '01', '01', '6304'),
('a04', '2565', '01', '01', '6305'),
('a04', '2565', '01', '01', '6306'),
('a05', '2565', '01', '01', '6301'),
('a05', '2565', '01', '01', '6302'),
('a05', '2565', '01', '01', '6303'),
('a05', '2565', '01', '01', '6304'),
('a05', '2565', '01', '01', '6305'),
('a05', '2565', '01', '01', '6306'),
('a06', '2565', '01', '01', '6301'),
('a06', '2565', '01', '01', '6302'),
('a06', '2565', '01', '01', '6303'),
('a06', '2565', '01', '01', '6304'),
('a06', '2565', '01', '01', '6305'),
('a06', '2565', '01', '01', '6306');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `cid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'รหัสวิชา(FK)',
  `sid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'รหัสนศ.(FK)',
  `keep` int(11) NOT NULL COMMENT 'คะแนนเก็บ',
  `k_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '0 hide, 1 show',
  `midterm` int(11) NOT NULL COMMENT 'คะแนนสอบกลางภาค',
  `m_status` varchar(1) NOT NULL COMMENT '0 hide, 1 show',
  `final` int(11) NOT NULL COMMENT 'คะแนนสอบปลายภาค',
  `f_status` varchar(1) NOT NULL COMMENT '0 hide, 1 show',
  `sum` int(11) NOT NULL COMMENT 'คะแนนรวม',
  `s_status` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '0 hide, 1 show'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ตารางคะแนน';

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`cid`, `sid`, `keep`, `k_status`, `midterm`, `m_status`, `final`, `f_status`, `sum`, `s_status`) VALUES
('a01', '6301', 35, '1', 24, '1', 21, '0', 80, '1'),
('a01', '6302', 32, '1', 20, '1', 23, '0', 75, '1'),
('a01', '6303', 28, '1', 16, '1', 18, '0', 62, '1'),
('a01', '6304', 37, '1', 24, '1', 28, '0', 89, '1'),
('a01', '6305', 38, '1', 27, '1', 28, '0', 93, '1'),
('a01', '6306', 36, '1', 21, '1', 24, '0', 81, '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'รหัสนศ.(user)',
  `firstname` varchar(40) NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(40) NOT NULL COMMENT 'สกุล',
  `password` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ตารางนักศึกษา';

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `firstname`, `lastname`, `password`) VALUES
('6301', 'David', 'De Gea', 'cccccc'),
('6302', 'Cristiano', 'Ronaldo', 'dddddd'),
('6303', 'Harry', 'Maguire', 'eeeeee'),
('6304', 'Bruno', 'Fernandes', 'ffffff'),
('6305', 'Marcus', 'Rashford', 'gggggg'),
('6306', 'Jadon', 'Sancho', 'hhhhhh');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tid` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'รหัสอาจารย์(user)',
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'สกุล',
  `password` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ตารางอาจารย์';

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`tid`, `firstname`, `lastname`, `password`) VALUES
('0001', 'Alex', 'Ferguson', 'aaaaaa'),
('0002', 'erik', 'ten hag', 'bbbbbb');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`) USING BTREE,
  ADD KEY `fk_course_teacher` (`tid`);

--
-- Indexes for table `c_check`
--
ALTER TABLE `c_check`
  ADD PRIMARY KEY (`no`,`cid`,`sid`),
  ADD KEY `fk_c_check_course` (`cid`),
  ADD KEY `fk_c_check_student` (`sid`);

--
-- Indexes for table `full_score`
--
ALTER TABLE `full_score`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`cid`,`sid`),
  ADD KEY `fk_register_student` (`sid`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`cid`,`sid`),
  ADD KEY `fk_score_student` (`sid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `c_check`
--
ALTER TABLE `c_check`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_course_teacher` FOREIGN KEY (`tid`) REFERENCES `teacher` (`tid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `c_check`
--
ALTER TABLE `c_check`
  ADD CONSTRAINT `fk_c_check_course` FOREIGN KEY (`cid`) REFERENCES `course` (`cid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_c_check_student` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `full_score`
--
ALTER TABLE `full_score`
  ADD CONSTRAINT `fk_full_score_course` FOREIGN KEY (`cid`) REFERENCES `course` (`cid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `fk_register_course` FOREIGN KEY (`cid`) REFERENCES `course` (`cid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_register_student` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `fk_score_course` FOREIGN KEY (`cid`) REFERENCES `course` (`cid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_score_student` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
