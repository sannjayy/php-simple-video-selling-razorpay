-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2021 at 03:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `video_sell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `payment_id` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `password`, `status`, `is_admin`, `is_paid`, `payment_id`, `created_at`) VALUES
(1, 'Sanjay', 'znasofficial@gmail.com', '9333386868', 'ce65e680084ee011a62ac0462456d4ee', 1, 1, 1, 'pay_Hc6M42qUMeEcDl', '2021-07-22 21:20:24'),
(3, '', 'support@znas.in', '', 'ce65e680084ee011a62ac0462456d4ee', 0, 0, 0, NULL, '2021-07-22 21:54:16'),
(11, 'Sumit Das', 'sanjayx53@gmail.com', '9333386868', 'e10adc3949ba59abbe56e057f20f883e', 0, 0, 1, 'pay_Hc8A4XiwxfKwJS', '2021-07-23 01:31:34'),
(13, 'Rohan Ghatok', 'test@gmail.com', '9333386868', 'ce65e680084ee011a62ac0462456d4ee', 1, 0, 1, 'pay_Hc8CMxtZSiHx57', '2021-07-23 03:20:50'),
(15, 'Account new', 'a@a.com', '9333386868', 'ce65e680084ee011a62ac0462456d4ee', 1, 0, 1, 'pay_HhX1StEWKN71NC', '2021-08-05 18:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `video_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `thumbnail` varchar(150) DEFAULT NULL,
  `trailer_video` varchar(150) DEFAULT NULL,
  `video_file` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `video_name`, `price`, `thumbnail`, `trailer_video`, `video_file`) VALUES
(1, 'test2w', 20, 'test2w-thumbnail)-2124767152.png', 'test2-trailer_video)-1094252871.mp4', 'test2w-video_file)-316154327.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
