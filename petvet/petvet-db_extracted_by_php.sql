-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2020 at 05:09 PM
-- Server version: 5.7.22-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petvet`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(10) UNSIGNED NOT NULL,
  `c_name` varchar(45) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `c_name`, `description`) VALUES
(1, 'External Parasite Treatments', 'parasite.'),
(2, 'Internal Parasite Treatments (Deworming)', 'parasite (deworm).'),
(3, 'Surgeries', 'any kind of surgeries.');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `ID` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(5) DEFAULT NULL,
  `fullname` varchar(45) NOT NULL,
  `address` char(75) DEFAULT NULL,
  `mobile` char(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `description` char(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`ID`, `prefix`, `fullname`, `address`, `mobile`, `email`, `description`) VALUES
(1, 'Mr.', 'Ahmed Hakem Makhluq', 'Irbil, Ankawa', '07704324568', 'makh@mail.com', NULL),
(2, 'Miss', 'Sara Kalar Muhammed', 'Irbil, Saidawa', '07821673475', 'sara@mail.com', NULL),
(3, 'Mrs.', 'Sarah Paywand Solav', 'Irbil, Topzawa', '07516378943', 's.paywand@mail.com', NULL),
(4, 'Miss', 'Ahmed Rasul Tolas', 'Irbil, Newroz', '07507893409', 'zarposh@mail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `ID` int(10) UNSIGNED NOT NULL,
  `p_name` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `species` varchar(25) DEFAULT NULL,
  `breed` varchar(25) DEFAULT NULL,
  `photo` varchar(75) DEFAULT NULL,
  `coat_color` varchar(10) DEFAULT NULL,
  `microchip_number` int(11) NOT NULL,
  `microchip_date` date NOT NULL,
  `rabies` varchar(50) DEFAULT NULL,
  `result` char(50) DEFAULT NULL,
  `reference_lab` char(50) DEFAULT NULL,
  `health_certificate` char(50) DEFAULT NULL,
  `inserted_date` date NOT NULL,
  `fk_owners_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`ID`, `p_name`, `birthdate`, `gender`, `species`, `breed`, `photo`, `coat_color`, `microchip_number`, `microchip_date`, `rabies`, `result`, `reference_lab`, `health_certificate`, `inserted_date`, `fk_owners_id`) VALUES
(1, 'Charly', '2016-02-27', 'Male', 'dog', 'sheperd', '../petvet/uploads/photos/1.jpg', 'Yellow', 12345678, '2018-08-01', '../petvet/uploads/files/1_rabies.pdf', '../petvet/uploads/files/1_result.pdf', 'no reference', 'yes', '2018-08-01', 1),
(2, 'Mr. Betils', '2017-03-21', 'Male', 'Cat', 'Bowny', '../petvet/uploads/photos/2.jpg', 'Brown', 847294, '2018-12-28', '../petvet/uploads/files/2_rabies.pdf', '../petvet/uploads/files/2_result.pdf', 'no reference', 'yes', '2019-01-01', 2),
(3, 'Semon', '2016-08-18', 'Female', 'Cat', 'Egyption', '../petvet/uploads/photos/3.jpg', 'White', 98214, '2018-08-03', '../petvet/uploads/files/3_rabies.pdf', '../petvet/uploads/files/3_result.pdf', 'no reference', 'yes', '2018-08-03', 1),
(4, 'Tommy', '2016-02-27', 'Male', 'dog', 'sheperd', '../petvet/uploads/photos/1.jpg', 'Yellow', 12345678, '2018-08-01', '../petvet/uploads/files/1_rabies.pdf', '../petvet/uploads/files/1_result.pdf', 'no reference', 'yes', '2018-08-01', 3),
(5, 'Light', '2017-03-21', 'Male', 'Cat', 'Bowny', '../petvet/uploads/photos/2.jpg', 'Brown', 847294, '2018-12-28', '../petvet/uploads/files/2_rabies.pdf', '../petvet/uploads/files/2_result.pdf', 'no reference', 'yes', '2019-01-01', 4),
(6, 'Betty', '2016-08-18', 'Female', 'Cat', 'Egyption', '../petvet/uploads/photos/3.jpg', 'White', 98214, '2018-08-03', '../petvet/uploads/files/3_rabies.pdf', '../petvet/uploads/files/3_result.pdf', 'no reference', 'yes', '2018-08-03', 3),
(7, 'Carl', '2016-02-27', 'Male', 'dog', 'sheperd', '../petvet/uploads/photos/1.jpg', 'Yellow', 12345678, '2018-08-01', '../petvet/uploads/files/1_rabies.pdf', '../petvet/uploads/files/1_result.pdf', 'no reference', 'yes', '2018-08-01', 4),
(8, 'Beast', '2017-03-21', 'Male', 'Cat', 'Bowny', '../petvet/uploads/photos/2.jpg', 'Brown', 847294, '2018-12-28', '../petvet/uploads/files/2_rabies.pdf', '../petvet/uploads/files/2_result.pdf', 'no reference', 'yes', '2019-01-01', 2),
(9, 'Miss. Cookie', '2016-08-18', 'Female', 'Cat', 'Egyption', '../petvet/uploads/photos/3.jpg', 'White', 98214, '2018-08-03', '../petvet/uploads/files/3_rabies.pdf', '../petvet/uploads/files/3_result.pdf', 'no reference', 'yes', '2018-08-03', 3);

-- --------------------------------------------------------

--
-- Table structure for table `privilege`
--

CREATE TABLE `privilege` (
  `ID` int(10) UNSIGNED NOT NULL,
  `view_p` enum('Yes','No') NOT NULL,
  `insert_p` enum('Yes','No') NOT NULL,
  `update_p` enum('Yes','No') NOT NULL,
  `delete_p` enum('Yes','No') NOT NULL,
  `p_name` varchar(35) NOT NULL,
  `fk_users_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privilege`
--

INSERT INTO `privilege` (`ID`, `view_p`, `insert_p`, `update_p`, `delete_p`, `p_name`, `fk_users_id`) VALUES
(1, 'Yes', 'Yes', 'Yes', 'Yes', 'Categories', 1),
(2, 'Yes', 'Yes', 'Yes', 'Yes', 'Next Vaccination Report', 1),
(3, 'Yes', 'Yes', 'Yes', 'Yes', 'Owner Test Vaccination Report', 1),
(4, 'Yes', 'Yes', 'Yes', 'Yes', 'Owners', 1),
(5, 'Yes', 'Yes', 'Yes', 'Yes', 'Pets', 1),
(6, 'Yes', 'Yes', 'Yes', 'Yes', 'Privileges', 1),
(7, 'Yes', 'Yes', 'Yes', 'Yes', 'Roles', 1),
(8, 'Yes', 'Yes', 'Yes', 'Yes', 'Test Report', 1),
(9, 'Yes', 'Yes', 'Yes', 'Yes', 'Tests', 1),
(10, 'Yes', 'Yes', 'Yes', 'Yes', 'Users', 1),
(11, 'Yes', 'Yes', 'Yes', 'Yes', 'Categories', 2),
(12, 'Yes', 'Yes', 'Yes', 'Yes', 'Next Vaccination Report', 2),
(13, 'Yes', 'Yes', 'Yes', 'Yes', 'Owner Test Vaccination Report', 2),
(14, 'Yes', 'Yes', 'Yes', 'Yes', 'Owners', 2),
(15, 'Yes', 'Yes', 'Yes', 'Yes', 'Pets', 2),
(16, 'Yes', 'Yes', 'Yes', 'Yes', 'Privileges', 2),
(17, 'Yes', 'Yes', 'Yes', 'Yes', 'Roles', 2),
(18, 'Yes', 'Yes', 'Yes', 'Yes', 'Test Report', 2),
(19, 'Yes', 'Yes', 'Yes', 'Yes', 'Tests', 2),
(20, 'Yes', 'Yes', 'Yes', 'Yes', 'Users', 2),
(21, 'Yes', 'No', 'Yes', 'No', 'Owners', 3),
(22, 'No', 'No', 'No', 'No', 'Categories', 4),
(23, 'Yes', 'No', 'No', 'No', 'Roles', 4);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(10) UNSIGNED NOT NULL,
  `r_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `r_name`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `ID` int(10) UNSIGNED NOT NULL,
  `t_date` date NOT NULL,
  `vaccine_label` char(50) NOT NULL,
  `barcode` char(15) NOT NULL,
  `next_vaccination` date NOT NULL,
  `fk_users_id` int(10) UNSIGNED NOT NULL,
  `fk_pet_id` int(10) UNSIGNED NOT NULL,
  `fk_category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`ID`, `t_date`, `vaccine_label`, `barcode`, `next_vaccination`, `fk_users_id`, `fk_pet_id`, `fk_category_id`) VALUES
(1, '2018-08-01', '1234567', '123456789', '2018-09-06', 1, 1, 1),
(2, '2018-01-06', '13564', '12423545', '2018-05-02', 2, 2, 3),
(3, '2018-08-01', '1234567', '123456789', '2017-01-01', 1, 1, 2),
(4, '2018-01-06', '13564', '12423545', '2017-03-02', 2, 3, 3),
(5, '2018-08-01', '1234567', '123456789', '2017-03-23', 1, 4, 1),
(6, '2018-01-06', '13564', '12423545', '2017-05-17', 2, 5, 3),
(7, '2018-08-01', '1234567', '123456789', '2017-09-21', 1, 6, 3),
(8, '2018-01-06', '13564', '12423545', '2017-05-11', 2, 7, 3),
(9, '2018-08-01', '1234567', '123456789', '2017-12-16', 1, 8, 2),
(10, '2018-01-06', '13564', '12423545', '2018-10-17', 2, 5, 3),
(11, '2018-08-01', '1234567', '123456789', '2018-10-21', 1, 6, 2),
(12, '2018-01-06', '13564', '12423545', '2018-10-11', 2, 7, 3),
(13, '2018-08-01', '1234567', '123456789', '2018-10-16', 1, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(5) DEFAULT NULL,
  `fullname` varchar(45) NOT NULL,
  `username` varchar(10) NOT NULL,
  `u_password` varchar(60) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fk_role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `prefix`, `fullname`, `username`, `u_password`, `email`, `fk_role_id`) VALUES
(1, 'Mr.', 'Ahmed Farhad Abdulkareem', 'A7a', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'a@mail.com', 1), /*[PASSWORD:123]*/
(2, 'Mr.', 'Rasty Khalid Muhammed', 'Rasti', '6a0129d59aa4967c0627c4c0803ae1a9a49f6ddd', 'r@yandix.com', 1), /*[PASSWORD:1312]*/
(3, 'Ms.', 'Zhela Sartep Umed', 'Zhelo', '6a0129d59aa4967c0627c4c0803ae1a9a49f6ddd', 'z@mail.com', 3), /*[PASSWORD:1312]*/
(4, 'Miss', 'Sarah Muafaq Tofeq', 'Susu', '00fd4b4549a1094aae926ef62e9dbd3cdcc2e456', 'susu@mail.com', 2); /*[PASSWORD:1122]*/

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_owners_id` (`fk_owners_id`);

--
-- Indexes for table `privilege`
--
ALTER TABLE `privilege`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_users_id` (`fk_users_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_users_id` (`fk_users_id`),
  ADD KEY `fk_pet_id` (`fk_pet_id`),
  ADD KEY `fk_category_id` (`fk_category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_role_id` (`fk_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `privilege`
--
ALTER TABLE `privilege`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`fk_owners_id`) REFERENCES `owners` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `privilege`
--
ALTER TABLE `privilege`
  ADD CONSTRAINT `privilege_ibfk_1` FOREIGN KEY (`fk_users_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `test_ibfk_1` FOREIGN KEY (`fk_users_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_ibfk_2` FOREIGN KEY (`fk_pet_id`) REFERENCES `pet` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `test_ibfk_3` FOREIGN KEY (`fk_category_id`) REFERENCES `category` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_role_id`) REFERENCES `role` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
