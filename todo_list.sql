-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 02:23 PM
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
-- Database: `todo_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_task`
--

CREATE TABLE `add_task` (
  `tsk_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `task_name` varchar(300) NOT NULL,
  `task_dis` varchar(500) NOT NULL,
  `st_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_task`
--

INSERT INTO `add_task` (`tsk_id`, `user_id`, `task_name`, `task_dis`, `st_date`, `end_date`) VALUES
(38, 1, 'lec 12', 'bubbers video', '2023-08-17', '2023-09-21'),
(39, 0, 'lec 112', 'Bubber video ', '2023-08-18', '2023-09-14'),
(40, 1, 'DSA', 'Avni mam lec', '2023-09-22', '2023-09-23'),
(41, 3, 'Ml', 'Py video', '2023-09-21', '2023-09-30'),
(42, 1, 'Machine learning', 'Py video', '2023-09-21', '2023-09-22'),
(43, 1, 'Dinner', 'Eating Veg. Makanvala with Paratha', '2023-09-21', '2023-09-21'),
(44, 6, 'DSA LAB', 'Avni Ma\'am\'s Problems List', '2023-09-22', '2023-09-23'),
(45, 7, 'DSA LAB', '123', '2023-09-23', '2023-09-28'),
(46, 7, 'task2', '234', '2023-09-30', '2023-10-08'),
(47, 8, 'Interview At Evening', 'Tech Cordinator', '2023-09-23', '2023-09-24'),
(48, 3, 'Interview', 'Tech Cordinator', '2023-09-24', '2023-09-25'),
(49, 3, 'Interview', 'Tech Cordinator', '2023-09-26', '2023-09-27'),
(50, 3, 'Interview', 'ninad', '2023-10-12', '2023-11-02'),
(51, 3, 'Interview', 'jash', '2023-10-11', '2023-10-11'),
(52, 10, 'DSA LAB', 'Avni Ma\'am\'s Problems Completed', '2023-10-04', '2023-10-18'),
(53, 10, 'SGPA LAB', 'Front End Complete', '2023-09-06', '2023-11-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `pass` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pass`, `user_id`) VALUES
('apurv', '12345678', 1),
('apurvchudasama.edu@gmail.com', '@TEf8VJhzg', 2),
('22CS016', '1234567890', 3),
('Meet Raval', 'Meet111', 5),
('Jay Bhagat', 'Jay', 6),
('apurv123', '123', 7),
('cr37', '9559', 8),
('jash', '45', 9),
('APC', 'A', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_task`
--
ALTER TABLE `add_task`
  ADD PRIMARY KEY (`tsk_id`),
  ADD KEY `fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_task`
--
ALTER TABLE `add_task`
  MODIFY `tsk_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
