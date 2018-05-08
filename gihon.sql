-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2018 at 10:28 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gihon`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comments` text NOT NULL,
  `submitted_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`user_id`, `first_name`, `last_name`, `email`, `comments`, `submitted_date`) VALUES
(2, 'Kibiruyisfa', 'Lemma', 'kibir@gmail.com', 'first comment', '2018-05-07 23:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_level` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `active` char(32) DEFAULT NULL,
  `registration_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `user_level`, `active`, `registration_date`) VALUES
(3, 'kibir', 'lemma', 'kibir@gmail.com', 'ed75d8477f2129971197275c5dbabcf77dad187ad95b6d782c86f91ac04af4e055f0354dd19f47e178adcf6d54c85b1f15b02ab0b35818f875155fda685cf992', 1, NULL, '2018-05-06 22:23:34'),
(4, 'Mikiyas', 'Mikiyas', 'mikiyas@gmail.com', '$2y$10$VyDR8jJyaRGug3riZD8vvuLynHpQLPGmRA/LbDrm0n1o5KN8j2cwa', 0, '6d45a7e72b186a5f93c843de972af069', '2018-05-06 22:34:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
