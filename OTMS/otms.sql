-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2014 at 10:13 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `otms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_department`
--

CREATE TABLE IF NOT EXISTS `admin_department` (
  `D_id` int(10) NOT NULL,
  `A_id` int(10) NOT NULL,
  `F_name` varchar(40) NOT NULL,
  `M_init` varchar(1) NOT NULL,
  `L_name` varchar(40) NOT NULL,
  `A_pass` varchar(40) NOT NULL DEFAULT 'password',
  `D_name` varchar(10) NOT NULL,
  PRIMARY KEY (`D_id`),
  UNIQUE KEY `A_id` (`A_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_department`
--

INSERT INTO `admin_department` (`D_id`, `A_id`, `F_name`, `M_init`, `L_name`, `A_pass`, `D_name`) VALUES
(1, 1, 'Ram', 'S', 'Gopal', '1', 'CSE'),
(2, 1234, 'Satya', 'M', 'Rawat', '2', 'SELECT');

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE IF NOT EXISTS `attempts` (
  `Q_id` int(10) NOT NULL,
  `S_id` varchar(10) NOT NULL,
  `No_ques` int(10) NOT NULL,
  PRIMARY KEY (`Q_id`,`S_id`),
  KEY `S_id` (`S_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `C_id` varchar(10) NOT NULL,
  `C_name` varchar(100) NOT NULL,
  `D_id` int(10) NOT NULL,
  PRIMARY KEY (`C_id`),
  KEY `D_id` (`D_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`C_id`, `C_name`, `D_id`) VALUES
('CSE101', 'Problem Solving in Computer', 1),
('CSE102', 'Programming Fundamentals', 1),
('CSE103', 'Object oriented Programming', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_incharge`
--

CREATE TABLE IF NOT EXISTS `course_incharge` (
  `E_id` int(10) NOT NULL,
  `C_id` varchar(10) NOT NULL,
  `setted` varchar(20) NOT NULL DEFAULT 'NONE',
  `No_ques` int(10) NOT NULL DEFAULT '5',
  PRIMARY KEY (`E_id`,`C_id`),
  KEY `C_id` (`C_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_incharge`
--

INSERT INTO `course_incharge` (`E_id`, `C_id`, `setted`, `No_ques`) VALUES
(1, 'CSE101', 'Complete', 6),
(1, 'CSE102', 'Complete', 2),
(1, 'CSE103', 'NONE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `department_cid`
--

CREATE TABLE IF NOT EXISTS `department_cid` (
  `D_id` int(10) NOT NULL,
  `C_id` varchar(10) NOT NULL,
  PRIMARY KEY (`D_id`,`C_id`),
  KEY `C_id` (`C_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_cid`
--

INSERT INTO `department_cid` (`D_id`, `C_id`) VALUES
(1, 'CSE101'),
(1, 'CSE102'),
(1, 'CSE103');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `E_id` int(10) NOT NULL,
  `D_id` int(10) NOT NULL,
  `F_name` varchar(40) NOT NULL,
  `M_init` varchar(1) NOT NULL,
  `L_name` varchar(40) NOT NULL,
  `E_pass` varchar(40) NOT NULL,
  PRIMARY KEY (`E_id`),
  KEY `D_id` (`D_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`E_id`, `D_id`, `F_name`, `M_init`, `L_name`, `E_pass`) VALUES
(1, 1, 'dfg', 'n', 'rst', '1'),
(1234, 2, 'Satya', 'M', 'Rawat', '2');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled`
--

CREATE TABLE IF NOT EXISTS `enrolled` (
  `S_id` varchar(10) NOT NULL,
  `C_id` varchar(10) NOT NULL,
  `E_id` int(10) NOT NULL,
  `Attempt` varchar(20) NOT NULL DEFAULT 'Not Availaible',
  PRIMARY KEY (`S_id`,`C_id`,`E_id`),
  KEY `C_id` (`C_id`),
  KEY `E_id` (`E_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled`
--

INSERT INTO `enrolled` (`S_id`, `C_id`, `E_id`, `Attempt`) VALUES
('1', 'CSE101', 1, 'Available'),
('1', 'CSE102', 1, 'Available'),
('1', 'CSE103', 1, 'Not Availaible'),
('11BCE1003', 'CSE101', 1, '33.333'),
('11BCE1003', 'CSE102', 1, '0'),
('11BCE1003', 'CSE103', 1, 'Not Availaible'),
('11BCE1004', 'CSE101', 1, '33.333'),
('11BCE1004', 'CSE102', 1, '60'),
('11BCE1004', 'CSE103', 1, 'Not Availaible'),
('11BCE1005', 'CSE101', 1, '80'),
('11BCE1005', 'CSE102', 1, '0'),
('11BCE1005', 'CSE103', 1, 'Not Availaible'),
('11BCE1006', 'CSE101', 1, '33.333'),
('11BCE1006', 'CSE102', 1, '0'),
('11BCE1006', 'CSE103', 1, 'Not Availaible'),
('11BCE1007', 'CSE101', 1, '10'),
('11BCE1007', 'CSE102', 1, 'Availaible'),
('11BCE1007', 'CSE103', 1, 'Not Availaible'),
('11BCE1008', 'CSE101', 1, 'Availaible'),
('11BCE1008', 'CSE102', 1, 'Availaible'),
('11BCE1008', 'CSE103', 1, 'Not Availaible'),
('11BCE1009', 'CSE101', 1, '50'),
('11BCE1009', 'CSE102', 1, '0'),
('11BCE1009', 'CSE103', 1, 'Not Availaible'),
('11BCE1010', 'CSE101', 1, 'Availaible'),
('11BCE1010', 'CSE102', 1, '100'),
('11BCE1010', 'CSE103', 1, 'Not Availaible'),
('11BCE1011', 'CSE101', 1, '83.333'),
('11BCE1011', 'CSE102', 1, '0'),
('11BCE1011', 'CSE103', 1, 'Not Availaible');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `Q_no` int(10) NOT NULL,
  `Options` varchar(757) NOT NULL,
  PRIMARY KEY (`Q_no`,`Options`),
  KEY `Q_no` (`Q_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`Q_no`, `Options`) VALUES
(0, 'The global variable is referenced via the auto specifier. '),
(0, 'The global variable is referenced via the extern specifier.'),
(0, 'The global variable is referenced via the global specifier. '),
(0, 'The global variable is referenced via the pointer specifier. '),
(1, 'abc'),
(1, 'float'),
(1, 'int'),
(1, 'structure'),
(2, 'dropmem() '),
(2, 'free()'),
(2, 'release() '),
(2, 'unalloc() '),
(3, 'fileread()'),
(3, 'fread() '),
(3, 'getline() '),
(3, 'readfile() '),
(4, 'printf(""My salary was increased by 15%%!"\n");'),
(4, 'printf(""My salary was increased by 15/%!"\n"); '),
(4, 'printf("My salary was increased by 15%!\n"); '),
(4, 'printf("My salary was increased by 15%!\\n"); '),
(5, 'A declaration occurs once, but a definition may occur many times.'),
(5, 'A definition occurs once, but a declaration may occur many times. '),
(5, 'Both can occur multiple times, but a declaration must occur first'),
(5, 'There is no difference between them. '),
(6, '11'),
(6, '3'),
(6, '5'),
(6, '8'),
(7, '1'),
(7, '14'),
(7, '6'),
(7, '9'),
(8, 'MAX_NUM is a linker constant. '),
(8, 'MAX_NUM is a preprocessor macro.'),
(8, 'MAX_NUM is an integer constant. '),
(8, 'MAX_NUM is an integer variable. '),
(9, 'int *x = &0x200;'),
(9, 'int *x = *0x200;'),
(9, 'int *x = 0x200; '),
(9, 'int *x;  *x = 0x200;'),
(10, '3'),
(10, '4'),
(10, '6'),
(10, '7'),
(11, '11'),
(11, '13'),
(11, '2'),
(11, '34'),
(12, '1'),
(12, '3'),
(12, '5'),
(12, '8'),
(13, '5'),
(13, '6'),
(13, '7'),
(13, '9'),
(14, '10'),
(14, '77'),
(14, '8'),
(14, '9'),
(15, '3'),
(15, '4'),
(15, '5'),
(15, '6'),
(16, '13'),
(16, '2'),
(16, '45'),
(16, '6'),
(17, 'decimal'),
(17, 'float '),
(17, 'integer'),
(17, 'string'),
(19, 'depth first search'),
(19, 'quick sort'),
(19, 'radix sort'),
(19, 'recursion'),
(20, 'equals one'),
(20, 'is far greater than one'),
(20, 'is far less than one'),
(20, 'none of above');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `Q_id` int(100) NOT NULL AUTO_INCREMENT,
  `C_id` varchar(10) NOT NULL,
  `E_id` int(10) NOT NULL DEFAULT '1',
  `Question` varchar(10000) NOT NULL,
  `Answer` varchar(10000) NOT NULL,
  PRIMARY KEY (`Q_id`,`C_id`,`E_id`),
  KEY `C_id` (`C_id`),
  KEY `E_id` (`E_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`Q_id`, `C_id`, `E_id`, `Question`, `Answer`) VALUES
(0, 'CSE101', 1, 'How is a variable accessed from another file? ', 'The global variable is referenced via the extern specifier.'),
(1, 'CSE101', 1, 'Which of the following is not a keyword in ANSI C ?', 'abc'),
(2, 'CSE101', 1, 'With every use of a memory allocation function, what function should be used to release allocated memory which is no longer needed? ', 'free()'),
(3, 'CSE101', 1, 'What function will read a specified number of elements from a file? ', 'getline() '),
(4, 'CSE101', 1, '"My salary was increased by 15%!"  Select the statement which will EXACTLY reproduce the line of text above.', 'printf(""My salary was increased by 15%%!"\n");'),
(5, 'CSE101', 1, 'What is a difference between a declaration and a definition of a variable?', 'A declaration occurs once, but a definition may occur many times.'),
(6, 'CSE101', 1, 'int testarray[3][2][2] = {1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12};  What value does testarray[2][1][0] in the sample code above contain? ', '11'),
(7, 'CSE101', 1, '11 ^ 5  What does the operation shown above produce? ', '14'),
(8, 'CSE101', 1, '#define MAX_NUM 15  Referring to the sample above, what is MAX_NUM? ', 'MAX_NUM is a preprocessor macro.'),
(9, 'CSE101', 1, 'Which one of the following will declare a pointer to an integer at address 0x200 in memory?', 'int *x;  *x = 0x200;'),
(10, 'CSE101', 1, '2+4', '6'),
(11, 'CSE102', 1, '6+5', '11'),
(12, 'CSE102', 1, '2+3', '5'),
(13, 'CSE102', 1, '2+5', '7'),
(14, 'CSE102', 1, '3+4?', '7'),
(15, 'CSE102', 1, '2+1', '3'),
(16, 'CSE102', 1, '4+9', '13'),
(17, 'CSE103', 1, '"sdfjksd" is a ?', 'string'),
(19, 'CSE103', 1, 'queue can be used to implement ?', 'radix sort'),
(20, 'CSE103', 1, 'The average search ,time of hashing with linear probing will be less if the load factor? ', 'is far less than one');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `D_id` varchar(10) NOT NULL,
  `S_id` varchar(10) NOT NULL,
  `F_name` varchar(40) NOT NULL,
  `M_init` varchar(40) NOT NULL,
  `L_name` varchar(40) NOT NULL,
  `S_pass` varchar(40) NOT NULL,
  PRIMARY KEY (`S_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`D_id`, `S_id`, `F_name`, `M_init`, `L_name`, `S_pass`) VALUES
('1', '1', 'abc', 'm', 'xyz', '1'),
('1', '11BCE1003', 'Siddharth', 'P', 'Agrawal', '1003'),
('1', '11BCE1004', 'Abhigna', 'a', 'Antani', '1004'),
('1', '11BCE1005', 'Shilpi', 'A', 'Kayal', '1005'),
('1', '11BCE1006', 'Farhaan', 'S', 'Nasir', '1006'),
('1', '11BCE1007', 'Trasha', 'K', 'Dewan', '1007'),
('1', '11BCE1008', 'Anureet', 'A', 'Bahia', '1008'),
('1', '11BCE1009', 'Ankit', 'a', 'Bhalla', '1009'),
('1', '11BCE1010', 'Kartikey', 'a', 'Sapra', '1010'),
('1', '11BCE1011', 'Obaidullah', '-', 'Mohammed', '1011');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_department`
--
ALTER TABLE `admin_department`
  ADD CONSTRAINT `admin_department_ibfk_1` FOREIGN KEY (`A_id`) REFERENCES `employee` (`E_id`);

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_ibfk_1` FOREIGN KEY (`S_id`) REFERENCES `student` (`S_id`),
  ADD CONSTRAINT `attempts_ibfk_2` FOREIGN KEY (`Q_id`) REFERENCES `question` (`Q_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`D_id`) REFERENCES `admin_department` (`D_id`);

--
-- Constraints for table `course_incharge`
--
ALTER TABLE `course_incharge`
  ADD CONSTRAINT `course_incharge_ibfk_1` FOREIGN KEY (`C_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `course_incharge_ibfk_2` FOREIGN KEY (`E_id`) REFERENCES `employee` (`E_id`);

--
-- Constraints for table `department_cid`
--
ALTER TABLE `department_cid`
  ADD CONSTRAINT `department_cid_ibfk_1` FOREIGN KEY (`D_id`) REFERENCES `admin_department` (`D_id`),
  ADD CONSTRAINT `department_cid_ibfk_2` FOREIGN KEY (`C_id`) REFERENCES `course` (`C_id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`D_id`) REFERENCES `admin_department` (`D_id`);

--
-- Constraints for table `enrolled`
--
ALTER TABLE `enrolled`
  ADD CONSTRAINT `enrolled_ibfk_1` FOREIGN KEY (`S_id`) REFERENCES `student` (`S_id`),
  ADD CONSTRAINT `enrolled_ibfk_2` FOREIGN KEY (`C_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `enrolled_ibfk_3` FOREIGN KEY (`E_id`) REFERENCES `employee` (`E_id`);

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`Q_no`) REFERENCES `question` (`Q_id`),
  ADD CONSTRAINT `options_ibfk_2` FOREIGN KEY (`Q_no`) REFERENCES `question` (`Q_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`C_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`E_id`) REFERENCES `employee` (`E_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
