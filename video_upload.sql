-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2019 at 07:41 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video_upload`
--
CREATE DATABASE IF NOT EXISTS `video_upload` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `video_upload`;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `upload_path` varchar(255) NOT NULL,
  `ftp_hostname` varchar(255) NOT NULL,
  `ftp_username` varchar(255) NOT NULL,
  `ftp_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `upload_path`, `ftp_hostname`, `ftp_username`, `ftp_password`) VALUES
(1, 'uploads/video', '127.0.0.1', 'root', '  ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `realname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phonenum` varchar(20) NOT NULL,
  `permission` int(11) NOT NULL DEFAULT '0' COMMENT '2: admin, 1: uploader, 0: candidate',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `realname`, `password`, `email`, `address`, `phonenum`, `permission`, `created_date`) VALUES
(2, 'alex1', 'alex', '202cb962ac59075b964b07152d234b70', 'alex@gmail.com', 'dandong', '1234567890', 1, '2019-06-06 18:31:09'),
(7, 'alex6', 'alex', 'e10adc3949ba59abbe56e057f20f883e', 'alex@gmail.com', 'dandong', '1234567890', 0, '2019-06-06 18:31:13'),
(9, 'kevin', 'kevin2', '202cb962ac59075b964b07152d234b70', 'kevin@hotmail.co', 'dandong', '1234567890', 2, '2019-06-07 11:21:27'),
(13, 'fg', 'tjfgj', 'ea7d201d1cdd240f3798b2dc51d6adcb', 'jg@yandex.com', 'fg', 'fgj', 0, '2019-06-07 11:26:41');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `origin_filename` varchar(255) NOT NULL,
  `uploaded_filename` varchar(255) NOT NULL,
  `copy_url` varchar(255) NOT NULL,
  `contents` text NOT NULL,
  `uploaded_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uploader_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
