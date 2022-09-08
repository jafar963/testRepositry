-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2022 at 10:57 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `Option1` varchar(100) DEFAULT NULL,
  `Option2` varchar(100) DEFAULT NULL,
  `Option3` varchar(100) DEFAULT NULL,
  `Option4` varchar(100) DEFAULT NULL,
  `answer` int(100) DEFAULT NULL,
  `questionText` varchar(100) DEFAULT NULL,
  `topics_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `Option1`, `Option2`, `Option3`, `Option4`, `answer`, `questionText`, `topics_id`) VALUES
(37, 'Guido van Rossum', 'James Gosling', 'Dennis Ritchie', 'Bjarne Stroustrup', 2, '1. Who invented Java Programming?', 35),
(38, 'Java is a sequence-dependent programming language', 'Java is a code dependent programming language', 'Java is a platform-dependent programming language', 'Java is a platform-independent programming language', 4, 'Which statement is true about Java?', 35),
(39, 'JRE', 'JIT', 'JDK', 'JVM', 3, 'Which component is used to compile, debug and execute the java programs?', 35),
(40, 'Object-oriented', 'Use of pointers', 'Portable', 'Dynamic and Extensible', 2, 'Which one of the following is not a Java feature?', 35),
(41, 'Polymorphism', 'Inheritance', 'Compilation', 'Encapsulation', 3, 'Which of the following is not an OOPS concept in Java?', 35),
(42, 'Selector', 'Property', 'Value', 'All of the above.', 4, 'Which of the following is a component of CSS style rule?', 32),
(43, 'in', 'mm', 'pc', 'pt', 1, 'Which of the following defines a measurement in inches?', 32),
(44, 'unsigned char;', 'int', 'wchar_t', 'none of the above.', 3, 'Which data type can be used to hold a wide character in C++?', 36),
(45, 'Only (i) is true', 'Only (ii) is true', 'Both (i) &amp; (ii) are true', 'Both (i) &amp; (ii) are false', 3, '(i) ‘ios’ is the base class of ‘istream’  (ii) All the files are classified into only 2 types. (1) T', 36),
(46, 'All variables in PHP are denoted with a leading dollar sign ($).', 'The value of a variable is the value of its most recent assignment.', 'Variables are assigned with the = operator, with the variable on the left-hand side and the expressi', 'All of the above.', 4, 'Which of the following is true about php variables?', 33),
(47, 'Integers', 'Doubles', 'Booleans', 'Strings', 1, 'Which of the following type of variables are whole numbers, without a decimal point, like 4195?', 33),
(48, 'global variable', 'local variable', 'Both of the above.', 'None of the above.', 1, 'Which of the following type of variable is visible everywhere in your JavaScript code?', 34),
(49, 'characterAt()', 'getCharAt()', 'charAt()', 'None of the above.', 3, 'Which built-in method returns the character at the specified index?', 34),
(51, '9', '6', '5', '4', 1, '3*3=', 39);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'admin test center'),
(3, 'student');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`) VALUES
(11, 'Web-basics'),
(12, 'Advanced-programming'),
(16, 'sfbdb'),
(17, 'b jhhjvhvjh');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `examDuration` int(11) DEFAULT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `examDuration`, `subject_id`) VALUES
(151, 20, 11),
(152, 10, 11),
(153, 15, 12),
(155, 8, 11);

-- --------------------------------------------------------

--
-- Table structure for table `test_center`
--

CREATE TABLE `test_center` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_center`
--

INSERT INTO `test_center` (`id`, `name`, `address`, `mobile`, `user_id`) VALUES
(8, 'Homs-center', 'Homs/alhadara street', '0315232186', 140),
(9, 'Hama-center', 'Hama/', '0333621259', 141);

-- --------------------------------------------------------

--
-- Table structure for table `test_center_has_test`
--

CREATE TABLE `test_center_has_test` (
  `test_center_id` int(11) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_center_has_test`
--

INSERT INTO `test_center_has_test` (`test_center_id`, `test_id`, `id`) VALUES
(9, 151, 34),
(9, 152, 35),
(9, 155, 36);

-- --------------------------------------------------------

--
-- Table structure for table `test_details`
--

CREATE TABLE `test_details` (
  `id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_mark_obtain` int(11) DEFAULT NULL,
  `date_exam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_details`
--

INSERT INTO `test_details` (`id`, `test_id`, `user_id`, `total_mark_obtain`, `date_exam`) VALUES
(22, 151, 143, 20, '2022-04-11'),
(23, 152, 142, 20, '2022-04-11'),
(24, 151, 144, 20, '2022-04-11'),
(25, 153, 142, 0, '2022-04-11'),
(26, 152, 142, 0, '2022-04-11'),
(27, 151, 142, 20, '2022-04-11'),
(28, 152, 142, 20, '2022-04-11'),
(29, 153, 142, 0, '2022-04-11'),
(30, 153, 142, 60, '2022-04-11'),
(31, 152, 142, 0, '2022-04-11'),
(32, 151, 146, 0, '2022-04-11'),
(33, 152, 146, 0, '2022-04-11'),
(34, 151, 142, 60, '2022-04-12'),
(35, 151, 142, 60, '2022-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `test_has_question`
--

CREATE TABLE `test_has_question` (
  `id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `Question_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_has_question`
--

INSERT INTO `test_has_question` (`id`, `test_id`, `Question_id`) VALUES
(206, 151, 43),
(207, 151, 48),
(208, 151, 49),
(209, 151, 44),
(210, 151, 45),
(211, 152, 42),
(212, 152, 46),
(213, 152, 47),
(214, 152, 48),
(215, 152, 45),
(216, 153, 37),
(217, 153, 38),
(218, 153, 39),
(219, 153, 40),
(220, 153, 41),
(226, 155, 42),
(227, 155, 46),
(228, 155, 48),
(229, 155, 49),
(230, 155, 51);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `subject_id`) VALUES
(31, 'HTML', 11),
(32, 'CSS', 11),
(33, 'PHP', 11),
(34, 'JavaScript', 11),
(35, 'JAVA', 12),
(36, 'C++', 11),
(37, 'C#', 11),
(39, 'algebra', 11);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Mobile` varchar(15) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `time_created` date DEFAULT NULL,
  `isActive` int(11) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `Password`, `Mobile`, `image`, `time_created`, `isActive`, `role_id`) VALUES
(138, 'samira', 'said', 'Mustaphadakkak@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '1231231231', 'mostafa.jpg', '2022-04-10', 1, 1),
(140, 'obaida', 'boshi', 'obaida@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '0936367795', 'user.jpg', '2022-04-11', 0, 2),
(141, 'ensaf', 'alshami', 'ensaf@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '0965653214', 'user.jpg', '2022-04-11', 1, 2),
(142, 'amer', 'amen', 'amer@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '0965653213', 'user.jpg', '2022-04-11', 1, 2),
(143, 'Mohanad', 'Ahmed', 'mohanad@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '0921365423', 'mohanad.jpg', '2022-04-11', 1, 3),
(144, 'Ramadan', 'Najm', 'ramadan@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '0993215462', 'user.jpg', '2022-04-11', 1, 3),
(145, 'mohamad', 'khadoor', 'mohamadkhadoor503@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '0934184503', '', '2022-04-11', 1, 3),
(146, 'ali', 'ahmad', 'student@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '1230123021', '', '2022-04-11', 1, 3),
(147, 'mohanad', 'ahamd', 'student1@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', '1254125487', '', '2022-04-11', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_topics1_idx` (`topics_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_test_subject1_idx` (`subject_id`);

--
-- Indexes for table `test_center`
--
ALTER TABLE `test_center`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_test_center_user1_idx` (`user_id`);

--
-- Indexes for table `test_center_has_test`
--
ALTER TABLE `test_center_has_test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_test_center_has_Test_Test1_idx` (`test_id`),
  ADD KEY `fk_test_center_has_Test_test_center1_idx` (`test_center_id`) USING BTREE;

--
-- Indexes for table `test_details`
--
ALTER TABLE `test_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Test_has_user_user1_idx` (`user_id`),
  ADD KEY `fk_Test_has_user_Test1_idx` (`test_id`);

--
-- Indexes for table `test_has_question`
--
ALTER TABLE `test_has_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Test_has_Question_Question1_idx` (`Question_id`),
  ADD KEY `fk_Test_has_Question_Test1_idx` (`test_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Topics_subject_idx` (`subject_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `Mobile_UNIQUE` (`Mobile`),
  ADD KEY `fk_user_role1_idx` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `test_center`
--
ALTER TABLE `test_center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `test_center_has_test`
--
ALTER TABLE `test_center_has_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `test_details`
--
ALTER TABLE `test_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `test_has_question`
--
ALTER TABLE `test_has_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=231;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_topics1` FOREIGN KEY (`topics_id`) REFERENCES `topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `fk_test_subject1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test_center`
--
ALTER TABLE `test_center`
  ADD CONSTRAINT `fk_test_center_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test_center_has_test`
--
ALTER TABLE `test_center_has_test`
  ADD CONSTRAINT `fk_test_center_has_Test_Test1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_test_center_has_Test_test_center1` FOREIGN KEY (`test_center_id`) REFERENCES `test_center` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test_details`
--
ALTER TABLE `test_details`
  ADD CONSTRAINT `fk_Test_has_user_Test1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Test_has_user_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `test_has_question`
--
ALTER TABLE `test_has_question`
  ADD CONSTRAINT `fk_Test_has_Question_Question1` FOREIGN KEY (`Question_id`) REFERENCES `question` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Test_has_Question_Test1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `fk_Topics_subject` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
