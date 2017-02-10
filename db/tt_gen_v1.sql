-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2017 at 07:30 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tt_gen_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `courserooms`
--

CREATE TABLE `courserooms` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `is_hard` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courserooms`
--

INSERT INTO `courserooms` (`id`, `course_id`, `room_id`, `is_hard`) VALUES
(71, 506, 7, 0),
(72, 507, 7, 0),
(73, 508, 7, 0),
(74, 509, 7, 0),
(75, 510, 4, 0),
(76, 511, 4, 0),
(77, 512, 4, 0),
(78, 513, 4, 0),
(79, 514, 6, 0),
(80, 515, 6, 0),
(81, 516, 6, 0),
(82, 517, 6, 0),
(83, 518, 5, 0),
(84, 519, 5, 0),
(85, 520, 11, 0),
(86, 521, 11, 0),
(87, 522, 3, 0),
(88, 523, 3, 0),
(89, 524, 3, 0),
(90, 525, 3, 0),
(91, 526, 10, 0),
(92, 527, 10, 0),
(93, 528, 10, 0),
(94, 529, 10, 0),
(95, 530, 9, 0),
(96, 531, 9, 0),
(97, 532, 9, 0),
(98, 533, 9, 0),
(99, 534, 8, 0),
(100, 535, 8, 0),
(101, 536, 8, 0),
(102, 537, 8, 0),
(103, 538, 11, 0),
(104, 539, 11, 0),
(105, 540, 11, 0),
(106, 541, 11, 0),
(107, 542, 5, 0),
(108, 543, 5, 0),
(109, 544, 5, 0),
(110, 545, 5, 0),
(111, 546, 6, 0),
(112, 547, 6, 0),
(113, 548, 6, 0),
(114, 549, 6, 0),
(115, 550, 10, 0),
(116, 551, 10, 0),
(117, 552, 10, 0),
(118, 553, 10, 0),
(119, 554, 8, 0),
(120, 555, 8, 0),
(121, 556, 8, 0),
(122, 557, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `type` varchar(5) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `sem` int(11) DEFAULT NULL,
  `batch` varchar(5) DEFAULT NULL,
  `student_id` int(11) NOT NULL,
  `el_batch` varchar(10) DEFAULT NULL COMMENT 'Batch Name',
  `subject` varchar(255) DEFAULT NULL,
  `subject_code` varchar(45) DEFAULT NULL,
  `frequency` int(11) DEFAULT NULL COMMENT 'No of Lactures/Week-Part',
  `room_type` varchar(255) DEFAULT NULL,
  `parts` int(11) DEFAULT NULL COMMENT 'Part of a class',
  `time_units` int(11) DEFAULT '1' COMMENT 'Hours in one lab/lact',
  `course_id` int(11) DEFAULT NULL COMMENT 'Refer id for course'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `type`, `year`, `sem`, `batch`, `student_id`, `el_batch`, `subject`, `subject_code`, `frequency`, `room_type`, `parts`, `time_units`, `course_id`) VALUES
(1, 'c', 4, 8, '8CS', 1, NULL, 'Mobile Computing', 'MC', 3, NULL, 1, 1, NULL),
(2, 'c', 4, 8, '8CS', 1, NULL, 'Digital Image Processing', 'DIP', 3, NULL, 1, 1, NULL),
(3, 'c', 4, 8, '8CS', 1, NULL, 'Distributed Systems', 'DS', 3, NULL, 1, 1, NULL),
(4, 'c', 4, 8, '8CS', 1, NULL, 'Real Time Systems', 'RTS', 3, NULL, 1, 1, NULL),
(5, 'l', 4, 8, '8CS', 1, NULL, 'Unix Network Programming', 'UNIX LAB', 1, NULL, 4, 3, NULL),
(6, 'l', 4, 8, '8CS', 1, NULL, 'FPGA Lab', 'FPGA Lab', 1, NULL, 4, 3, NULL),
(7, 'l', 4, 8, '8CS', 1, NULL, 'Digital Image Processing Lab', 'DIP Lab', 1, NULL, 4, 2, NULL),
(8, 'l', 4, 8, '8CS', 1, NULL, 'Project-II', 'PROJECT', 1, NULL, 2, 2, NULL),
(9, 'l', 4, 8, '8CS', 1, NULL, 'Seminar', 'SEMINAR', 1, NULL, 2, 2, NULL),
(10, 'c', 3, 6, '6CS', 3, NULL, 'Computer Networks', 'CN', 3, NULL, 1, 1, NULL),
(11, 'c', 3, 6, '6CS', 3, NULL, 'Design and Analysis of Algorithms', 'DAA', 3, NULL, 1, 1, NULL),
(12, 'c', 3, 6, '6CS', 3, NULL, 'Theory Of Computation', 'TOC', 3, NULL, 1, 1, NULL),
(13, 'c', 3, 6, '6CS', 3, NULL, 'Computer Graphics and Multimedia Techniques', 'CGMM', 3, NULL, 1, 1, NULL),
(14, 'c', 3, 6, '6CS', 3, NULL, 'Embedded System Design', 'ESD', 3, NULL, 1, 1, NULL),
(15, 'c', 3, 6, '6CS', 3, NULL, 'Human Computer Interface', 'HCI', 3, NULL, 1, 1, NULL),
(16, 'l', 3, 6, '6CS', 3, NULL, 'Java Programming Lab', 'JAVA LAB', 1, NULL, 4, 3, NULL),
(17, 'l', 3, 6, '6CS', 3, NULL, 'Computer Graphics & Multimedia Lab', 'CGMM Lab', 1, NULL, 4, 2, NULL),
(18, 'l', 3, 6, '6CS', 3, NULL, 'Design and Analysis of Algorithms Lab', 'DAA Lab', 1, NULL, 4, 3, NULL),
(19, 'l', 3, 6, '6CS', 3, NULL, 'Embedded System Design Lab', 'EMB Lab', 1, NULL, 4, 2, NULL),
(20, 'l', 3, 6, '6CS', 3, NULL, 'Humanities and Social Sciences', 'HUMM Lab', 1, NULL, 4, 2, NULL),
(21, 'c', 2, 4, '4CS', 5, NULL, 'Microprocessors and Interfaces', 'MP', 3, NULL, 1, 1, NULL),
(22, 'c', 2, 4, '4CS', 5, NULL, 'Dicrete Mathematical Structures', 'DMS', 3, NULL, 1, 1, NULL),
(23, 'c', 2, 4, '4CS', 5, NULL, 'Statistics and Probability Theory', 'S & PT', 3, NULL, 1, 1, NULL),
(24, 'c', 2, 4, '4CS', 5, NULL, 'Software Engineering', 'S/W ENGG', 3, NULL, 1, 1, NULL),
(25, 'c', 2, 4, '4CS', 5, NULL, 'Principles of Communication', 'FOC', 3, NULL, 1, 1, NULL),
(26, 'c', 2, 4, '4CS', 5, NULL, 'Principles of Programming Languages', 'PPL', 3, NULL, 1, 1, NULL),
(27, 'l', 2, 4, '4CS', 5, NULL, 'Microprocessor Lab', 'MP LAB', 1, NULL, 4, 3, NULL),
(28, 'l', 2, 4, '4CS', 5, NULL, 'Communication Lab', 'COMM Lab', 1, NULL, 4, 3, NULL),
(29, 'l', 2, 4, '4CS', 5, NULL, 'Computer Aided Software Engg Lab', 'CAD Lab', 1, NULL, 4, 3, NULL),
(30, 'l', 2, 4, '4CS', 5, NULL, 'Business Entrepreneurship Development Lab', 'BUSS Lab', 1, NULL, 4, 2, NULL),
(506, 'el', NULL, NULL, NULL, 0, '8CS1', NULL, NULL, 1, NULL, NULL, 3, 5),
(507, 'el', NULL, NULL, NULL, 0, '8CS2', NULL, NULL, 1, NULL, NULL, 3, 5),
(508, 'el', NULL, NULL, NULL, 0, '8CS3', NULL, NULL, 1, NULL, NULL, 3, 5),
(509, 'el', NULL, NULL, NULL, 0, '8CS4', NULL, NULL, 1, NULL, NULL, 3, 5),
(510, 'el', NULL, NULL, NULL, 0, '8CS1', NULL, NULL, 1, NULL, NULL, 3, 6),
(511, 'el', NULL, NULL, NULL, 0, '8CS2', NULL, NULL, 1, NULL, NULL, 3, 6),
(512, 'el', NULL, NULL, NULL, 0, '8CS3', NULL, NULL, 1, NULL, NULL, 3, 6),
(513, 'el', NULL, NULL, NULL, 0, '8CS4', NULL, NULL, 1, NULL, NULL, 3, 6),
(514, 'el', NULL, NULL, NULL, 0, '8CS1', NULL, NULL, 1, NULL, NULL, 2, 7),
(515, 'el', NULL, NULL, NULL, 0, '8CS2', NULL, NULL, 1, NULL, NULL, 2, 7),
(516, 'el', NULL, NULL, NULL, 0, '8CS3', NULL, NULL, 1, NULL, NULL, 2, 7),
(517, 'el', NULL, NULL, NULL, 0, '8CS4', NULL, NULL, 1, NULL, NULL, 2, 7),
(518, 'el', NULL, NULL, NULL, 0, '8CS1+8CS2', NULL, NULL, 1, NULL, NULL, 2, 8),
(519, 'el', NULL, NULL, NULL, 0, '8CS3+8CS4', NULL, NULL, 1, NULL, NULL, 2, 8),
(520, 'el', NULL, NULL, NULL, 0, '8CS1+8CS2', NULL, NULL, 1, NULL, NULL, 2, 9),
(521, 'el', NULL, NULL, NULL, 0, '8CS3+8CS4', NULL, NULL, 1, NULL, NULL, 2, 9),
(522, 'el', NULL, NULL, NULL, 0, '6CS1', NULL, NULL, 1, NULL, NULL, 3, 16),
(523, 'el', NULL, NULL, NULL, 0, '6CS2', NULL, NULL, 1, NULL, NULL, 3, 16),
(524, 'el', NULL, NULL, NULL, 0, '6CS3', NULL, NULL, 1, NULL, NULL, 3, 16),
(525, 'el', NULL, NULL, NULL, 0, '6CS4', NULL, NULL, 1, NULL, NULL, 3, 16),
(526, 'el', NULL, NULL, NULL, 0, '6CS1', NULL, NULL, 1, NULL, NULL, 2, 17),
(527, 'el', NULL, NULL, NULL, 0, '6CS2', NULL, NULL, 1, NULL, NULL, 2, 17),
(528, 'el', NULL, NULL, NULL, 0, '6CS3', NULL, NULL, 1, NULL, NULL, 2, 17),
(529, 'el', NULL, NULL, NULL, 0, '6CS4', NULL, NULL, 1, NULL, NULL, 2, 17),
(530, 'el', NULL, NULL, NULL, 0, '6CS1', NULL, NULL, 1, NULL, NULL, 3, 18),
(531, 'el', NULL, NULL, NULL, 0, '6CS2', NULL, NULL, 1, NULL, NULL, 3, 18),
(532, 'el', NULL, NULL, NULL, 0, '6CS3', NULL, NULL, 1, NULL, NULL, 3, 18),
(533, 'el', NULL, NULL, NULL, 0, '6CS4', NULL, NULL, 1, NULL, NULL, 3, 18),
(534, 'el', NULL, NULL, NULL, 0, '6CS1', NULL, NULL, 1, NULL, NULL, 2, 19),
(535, 'el', NULL, NULL, NULL, 0, '6CS2', NULL, NULL, 1, NULL, NULL, 2, 19),
(536, 'el', NULL, NULL, NULL, 0, '6CS3', NULL, NULL, 1, NULL, NULL, 2, 19),
(537, 'el', NULL, NULL, NULL, 0, '6CS4', NULL, NULL, 1, NULL, NULL, 2, 19),
(538, 'el', NULL, NULL, NULL, 0, '6CS1', NULL, NULL, 1, NULL, NULL, 2, 20),
(539, 'el', NULL, NULL, NULL, 0, '6CS2', NULL, NULL, 1, NULL, NULL, 2, 20),
(540, 'el', NULL, NULL, NULL, 0, '6CS3', NULL, NULL, 1, NULL, NULL, 2, 20),
(541, 'el', NULL, NULL, NULL, 0, '6CS4', NULL, NULL, 1, NULL, NULL, 2, 20),
(542, 'el', NULL, NULL, NULL, 0, '4CS1', NULL, NULL, 1, NULL, NULL, 3, 27),
(543, 'el', NULL, NULL, NULL, 0, '4CS2', NULL, NULL, 1, NULL, NULL, 3, 27),
(544, 'el', NULL, NULL, NULL, 0, '4CS3', NULL, NULL, 1, NULL, NULL, 3, 27),
(545, 'el', NULL, NULL, NULL, 0, '4CS4', NULL, NULL, 1, NULL, NULL, 3, 27),
(546, 'el', NULL, NULL, NULL, 0, '4CS1', NULL, NULL, 1, NULL, NULL, 3, 28),
(547, 'el', NULL, NULL, NULL, 0, '4CS2', NULL, NULL, 1, NULL, NULL, 3, 28),
(548, 'el', NULL, NULL, NULL, 0, '4CS3', NULL, NULL, 1, NULL, NULL, 3, 28),
(549, 'el', NULL, NULL, NULL, 0, '4CS4', NULL, NULL, 1, NULL, NULL, 3, 28),
(550, 'el', NULL, NULL, NULL, 0, '4CS1', NULL, NULL, 1, NULL, NULL, 3, 29),
(551, 'el', NULL, NULL, NULL, 0, '4CS2', NULL, NULL, 1, NULL, NULL, 3, 29),
(552, 'el', NULL, NULL, NULL, 0, '4CS3', NULL, NULL, 1, NULL, NULL, 3, 29),
(553, 'el', NULL, NULL, NULL, 0, '4CS4', NULL, NULL, 1, NULL, NULL, 3, 29),
(554, 'el', NULL, NULL, NULL, 0, '4CS1', NULL, NULL, 1, NULL, NULL, 2, 30),
(555, 'el', NULL, NULL, NULL, 0, '4CS2', NULL, NULL, 1, NULL, NULL, 2, 30),
(556, 'el', NULL, NULL, NULL, 0, '4CS3', NULL, NULL, 1, NULL, NULL, 2, 30),
(557, 'el', NULL, NULL, NULL, 0, '4CS4', NULL, NULL, 1, NULL, NULL, 2, 30);

-- --------------------------------------------------------

--
-- Table structure for table `generates`
--

CREATE TABLE `generates` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `dtd` int(11) NOT NULL,
  `fitness` int(11) NOT NULL DEFAULT '-999'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generates`
--

INSERT INTO `generates` (`id`, `course_id`, `teacher_id`, `room_id`, `dtd`, `fitness`) VALUES
(49, 1, 5, 1, 2051, -999),
(50, 15, 12, 2, 5081, -999),
(51, 23, 6, -1, -1, -999),
(52, 12, 14, 2, 6041, -999),
(53, 11, 15, 2, 5061, -999),
(54, 26, 3, -1, -1, -999),
(55, 25, 8, -1, -1, -999),
(56, 13, 11, 2, 4051, -999),
(57, 3, 2, 1, 3041, -999),
(58, 10, 16, 2, 2041, -999),
(59, 2, 1, 1, 3061, -999),
(60, 24, 7, -1, -1, -999),
(61, 22, 10, -1, -1, -999),
(62, 21, 13, -1, -1, -999),
(63, 4, 4, 1, 4091, -999),
(64, 14, 9, 2, 2031, -999),
(65, 26, 3, -1, -1, -999),
(66, 14, 9, 2, 4041, -999),
(67, 11, 15, 2, 4091, -999),
(68, 15, 12, 2, 1081, -999),
(69, 22, 10, -1, -1, -999),
(70, 10, 16, 2, 3041, -999),
(71, 21, 13, -1, -1, -999),
(72, 3, 2, 1, 6061, -999),
(73, 12, 14, 2, 1041, -999),
(74, 13, 11, 2, 5051, -999),
(75, 23, 6, -1, -1, -999),
(76, 4, 4, 1, 2061, -999),
(77, 24, 7, -1, -1, -999),
(78, 25, 8, -1, -1, -999),
(79, 1, 5, 1, 3081, -999),
(80, 2, 1, 1, 1031, -999),
(81, 12, 14, 2, 4061, -999),
(82, 22, 10, -1, -1, -999),
(83, 4, 4, 1, 5101, -999),
(84, 10, 16, 2, 1031, -999),
(85, 21, 13, -1, -1, -999),
(86, 26, 3, -1, -1, -999),
(87, 1, 5, 1, 5031, -999),
(88, 25, 8, -1, -1, -999),
(89, 15, 12, 2, 3091, -999),
(90, 24, 7, -1, -1, -999),
(91, 3, 2, 1, 4051, -999),
(92, 2, 1, 1, 2081, -999),
(93, 23, 6, -1, -1, -999),
(94, 14, 9, 2, 3101, -999),
(95, 13, 11, 2, 1061, -999),
(96, 11, 15, 2, 3031, -999);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(12) NOT NULL,
  `type` varchar(5) NOT NULL,
  `slots_day` int(11) NOT NULL,
  `slots_week` int(11) NOT NULL,
  `capacity` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `type`, `slots_day`, `slots_week`, `capacity`) VALUES
(-1, '0', '0', 0, 0, '0'),
(1, 'A221', 'c', 7, 38, 'x'),
(2, 'A220', 'c', 7, 38, 'x'),
(3, 'IBM-A', 'l', 7, 38, 's'),
(4, 'IBM-B', 'l', 7, 38, 's'),
(5, 'CSC', 'l', 7, 38, 's'),
(6, 'SDC', 'l', 7, 38, 'b'),
(7, 'CSC-EXT', 'l', 7, 38, 's'),
(8, 'A117', 'l', 7, 38, 's'),
(9, 'PTP', 'l', 7, 38, 'x'),
(10, 'PG', 'l', 7, 38, 'b'),
(11, 'B201', 'l', 7, 38, 'x');

-- --------------------------------------------------------

--
-- Table structure for table `studentrooms`
--

CREATE TABLE `studentrooms` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `is_hard` tinyint(1) NOT NULL DEFAULT '0',
  `availability` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentrooms`
--

INSERT INTO `studentrooms` (`id`, `student_id`, `room_id`, `is_hard`, `availability`) VALUES
(36, 1, 1, 1, -1),
(37, 3, 2, 1, -1),
(38, 5, -1, 0, -1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `branch` varchar(25) NOT NULL,
  `strength` varchar(5) NOT NULL,
  `batch_count` int(11) NOT NULL,
  `code` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `year`, `branch`, `strength`, `batch_count`, `code`) VALUES
(1, 4, 'Computer Science', 'b', 4, '8CS'),
(2, 4, 'Information Technology', 'm', 2, '8IT'),
(3, 3, 'Computer Science', 'b', 4, '6CS'),
(4, 3, 'Information Technology', 'm', 2, '6IT'),
(5, 2, 'Computer Science', 'b', 4, '4CS'),
(6, 2, 'Information Technology', 'm', 2, '4IT');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `code` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `type` varchar(5) NOT NULL,
  `load` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `code`, `name`, `department`, `type`, `load`) VALUES
(1, 'CPG', 'CP Gupta', 'Computer Science', 'mf', 14),
(2, 'GF01', 'Vandana Mam', 'Computer Science', 'gf', 24),
(3, 'GF02', 'Hukum Sir', 'Computer Science', 'gf', 24),
(4, 'GF03', 'Pankaj Sir', 'Computer Science', 'gf', 24),
(5, 'GF04', 'Naveen Sir', 'Computer Science', 'gf', 24),
(6, 'GF05', 'Shruti Mam', 'Computer Science', 'gf', 24),
(7, 'GF06', 'Gunjan Mam', 'Computer Science', 'gf', 24),
(8, 'GF07', 'Shalini Mam', 'Computer Science', 'gf', 24),
(9, 'GF08', 'Krishna Mam', 'Computer Science', 'gf', 24),
(10, 'GF09', 'Bhawana Mam', 'Computer Science', 'gf', 24),
(11, 'SCJ', 'SC Jain', 'Computer Science', 'mf', 14),
(12, 'RSS', 'RS Sharma', 'Computer Science', 'mf', 14),
(13, 'RKB', 'RKB', 'Computer Science', 'mf', 14),
(14, 'HS', 'Harish Sharma', 'Computer Science', 'mf', 14),
(15, 'NS', 'Nimala Sharma', 'Computer Science', 'mf', 14),
(16, 'DS', 'Dinesh Soni', 'Computer Science', 'mf', 14);

-- --------------------------------------------------------

--
-- Table structure for table `techcourses`
--

CREATE TABLE `techcourses` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `hard` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `techcourses`
--

INSERT INTO `techcourses` (`id`, `teacher_id`, `course_id`, `hard`) VALUES
(104, 5, 1, 0),
(105, 12, 15, 0),
(106, 6, 23, 0),
(107, 14, 12, 0),
(108, 15, 11, 0),
(109, 3, 26, 0),
(110, 8, 25, 0),
(111, 11, 13, 0),
(112, 2, 3, 0),
(113, 16, 10, 0),
(114, 1, 2, 0),
(115, 7, 24, 0),
(117, 13, 21, 0),
(118, 4, 4, 0),
(119, 9, 14, 0),
(120, 7, 542, 0),
(121, 3, 521, 0),
(122, 2, 537, 0),
(123, 8, 512, 0),
(124, 10, 513, 0),
(125, 9, 528, 0),
(126, 6, 553, 0),
(127, 4, 509, 0),
(128, 5, 529, 0),
(129, 2, 527, 0),
(130, 3, 522, 0),
(131, 9, 516, 0),
(132, 5, 540, 0),
(133, 14, 544, 0),
(134, 1, 535, 0),
(135, 13, 557, 0),
(136, 11, 520, 0),
(137, 12, 555, 0),
(138, 15, 531, 0),
(139, 16, 549, 0),
(140, 10, 514, 0),
(141, 8, 524, 0),
(142, 7, 525, 0),
(143, 4, 547, 0),
(144, 6, 543, 0),
(145, 5, 541, 0),
(146, 3, 506, 0),
(147, 10, 550, 0),
(148, 9, 534, 0),
(149, 2, 545, 0),
(150, 10, 536, 0),
(151, 13, 518, 0),
(152, 1, 530, 0),
(153, 12, 556, 0),
(154, 11, 539, 0),
(155, 5, 508, 0),
(156, 7, 551, 0),
(157, 9, 519, 0),
(158, 6, 517, 0),
(159, 8, 552, 0),
(160, 4, 546, 0),
(161, 2, 538, 0),
(162, 10, 523, 0),
(163, 15, 511, 0),
(164, 16, 533, 0),
(165, 14, 532, 0),
(166, 3, 515, 0),
(167, 9, 526, 0),
(168, 6, 554, 0),
(169, 5, 548, 0),
(170, 8, 510, 0),
(171, 11, 507, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courserooms`
--
ALTER TABLE `courserooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_batch` (`batch`);

--
-- Indexes for table `generates`
--
ALTER TABLE `generates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_course_gen` (`course_id`),
  ADD KEY `fk_teacher_gen` (`teacher_id`),
  ADD KEY `fk_room_gen` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slots_day_index` (`slots_day`),
  ADD KEY `slots_week_index` (`slots_week`);

--
-- Indexes for table `studentrooms`
--
ALTER TABLE `studentrooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_room` (`room_id`),
  ADD KEY `FK_student` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `code_2` (`code`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_unique` (`code`),
  ADD KEY `load_index` (`load`);

--
-- Indexes for table `techcourses`
--
ALTER TABLE `techcourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_teacher` (`teacher_id`),
  ADD KEY `FK_course` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courserooms`
--
ALTER TABLE `courserooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;
--
-- AUTO_INCREMENT for table `generates`
--
ALTER TABLE `generates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `studentrooms`
--
ALTER TABLE `studentrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `techcourses`
--
ALTER TABLE `techcourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_batch` FOREIGN KEY (`batch`) REFERENCES `students` (`code`);

--
-- Constraints for table `studentrooms`
--
ALTER TABLE `studentrooms`
  ADD CONSTRAINT `FK_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `FK_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `techcourses`
--
ALTER TABLE `techcourses`
  ADD CONSTRAINT `FK_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `FK_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
