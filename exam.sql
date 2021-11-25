-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2021 at 06:27 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `semister` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `management` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `department`, `session`, `semister`, `name`, `management`) VALUES
(4, 'IIT', '2010-2011', '1', '2010-2011 1st term', 5),
(5, 'CSE', '2011-2012', '2', '2011-2012 2nd term', 5);

-- --------------------------------------------------------

--
-- Table structure for table `exam_subject`
--

CREATE TABLE `exam_subject` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(50) NOT NULL,
  `credit` int(11) NOT NULL,
  `exam_date` varchar(50) NOT NULL,
  `management` int(11) DEFAULT NULL,
  `exam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_subject`
--

INSERT INTO `exam_subject` (`id`, `name`, `code`, `credit`, `exam_date`, `management`, `exam`) VALUES
(10, 'sdkfjdsb', 'ksbdfk', 3, 'ksdbf', 5, 4),
(11, 'sdkfjbds', 'ksdbfhdb', 2, 'ksdbfhds', 4, 4),
(12, 'sdkjbsd', 'ksdbg', 2, 'skdbf', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department` varchar(150) DEFAULT NULL,
  `session` varchar(100) DEFAULT NULL,
  `roll` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `current_semister` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `department`, `session`, `roll`, `gender`, `current_semister`) VALUES
(1, 1, 'IIT', '2010-2011', 'ASH1511043M', 'Male', 1),
(2, 2, 'IIT', '2010-2011', 'ASH1511044M', 'Male', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `remuneration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `remuneration`) VALUES
(1, 150);

-- --------------------------------------------------------

--
-- Table structure for table `student_subject_relation`
--

CREATE TABLE `student_subject_relation` (
  `id` int(11) NOT NULL,
  `student` int(11) DEFAULT NULL,
  `subject` int(11) DEFAULT NULL,
  `exam` int(11) DEFAULT NULL,
  `marks` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_subject_relation`
--

INSERT INTO `student_subject_relation` (`id`, `student`, `subject`, `exam`, `marks`) VALUES
(1, 1, 10, 4, 99),
(2, 2, 10, 4, 60),
(3, 1, 11, 4, 80),
(4, 2, 11, 4, 99);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `role`, `password`, `date`) VALUES
(1, 'amir', 'amir@co.design', 1, '1234', '2021-09-04 23:23:57'),
(2, 'student', 'upwork.mubarak@gmail.com', 1, '1234', '2021-09-04 23:23:57'),
(3, 'admin', 'admin@gmail.com', 3, '1234', '2021-09-04 23:23:57'),
(4, 'management', 'management@gmail.com', 2, '1234', '2021-09-04 23:25:27'),
(5, 'management2', 'management2@gmail.com', 2, '1234', '2021-09-11 21:59:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `management` (`management`);

--
-- Indexes for table `exam_subject`
--
ALTER TABLE `exam_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `management` (`management`),
  ADD KEY `exam` (`exam`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_subject_relation`
--
ALTER TABLE `student_subject_relation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam` (`exam`),
  ADD KEY `student` (`student`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `exam_subject`
--
ALTER TABLE `exam_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_subject_relation`
--
ALTER TABLE `student_subject_relation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_ibfk_1` FOREIGN KEY (`management`) REFERENCES `user` (`id`);

--
-- Constraints for table `exam_subject`
--
ALTER TABLE `exam_subject`
  ADD CONSTRAINT `exam_subject_ibfk_1` FOREIGN KEY (`management`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `exam_subject_ibfk_2` FOREIGN KEY (`exam`) REFERENCES `exam` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `student_subject_relation`
--
ALTER TABLE `student_subject_relation`
  ADD CONSTRAINT `student_subject_relation_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `exam_subject` (`id`),
  ADD CONSTRAINT `student_subject_relation_ibfk_2` FOREIGN KEY (`exam`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `student_subject_relation_ibfk_3` FOREIGN KEY (`student`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `student_subject_relation_ibfk_4` FOREIGN KEY (`subject`) REFERENCES `exam_subject` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
