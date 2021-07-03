-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2021 at 09:39 PM
-- Server version: 10.3.30-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `danubeproperties_ibms`
--

-- --------------------------------------------------------

--
-- Table structure for table `sch_class`
--

CREATE TABLE `sch_class` (
  `id` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `name` varchar(256) NOT NULL,
  `maximum_students` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `description` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sch_class`
--

INSERT INTO `sch_class` (`id`, `code`, `name`, `maximum_students`, `status`, `description`) VALUES
(1, 'rew', 'fdsafdasf', 10, 1, NULL),
(4, 'res', 'class1', 10, 1, NULL),
(6, 'res1', 'class1', 10, 1, NULL),
(7, 'res2', 'Qasmi', 0, 0, NULL),
(8, '365241', 'john doe', 8, 1, 'Long Text goes here'),
(9, '36111', 'johndoe', 6, 1, 'Long Text goes here');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `class_code` varchar(11) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `class_code`, `date_of_birth`) VALUES
(1, 'ansar', 'younas', 'res', '1990-07-08'),
(3, 'ikram', 'zafar', 'res', '2000-01-01'),
(4, 'ikram', 'zafar', 'res', '2000-01-01'),
(5, 'ikram', 'zafar', 'res', '2000-01-01'),
(9, 'ikram', 'zafar', 'res', '2000-01-01'),
(10, 'ikram', 'zafar', 'res', '2000-01-01'),
(12, 'ikram', 'zafar', 'res', '2000-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `video_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `video_name`) VALUES
(4, 'resr-res.mp4'),
(5, 'sample_4.mkv'),
(11, '1.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sch_class`
--
ALTER TABLE `sch_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sch_class`
--
ALTER TABLE `sch_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
