-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 30, 2024 at 07:25 AM
-- Server version: 5.7.40-log
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `submission`
--

-- --------------------------------------------------------

--
-- Table structure for table `copy_send_wp_msgs`
--

CREATE TABLE `copy_send_wp_msgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login_id` bigint(20) NOT NULL,
  `campaign_unique_id` varchar(50) NOT NULL,
  `campaign_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_count` bigint(20) NOT NULL,
  `image-1` text NOT NULL,
  `image-2` text NOT NULL,
  `image-3` text NOT NULL,
  `image-4` text NOT NULL,
  `upload_pdf` text NOT NULL,
  `send_audio` text NOT NULL,
  `send_video` text NOT NULL,
  `dp_image` text NOT NULL,
  `status` enum('pending','process','delivered','discard') NOT NULL DEFAULT 'pending',
  `updated_at` varchar(30) NOT NULL,
  `created_at` varchar(30) NOT NULL,
  `sort_date_wise` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `copy_send_wp_msgs`
--
ALTER TABLE `copy_send_wp_msgs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `copy_send_wp_msgs`
--
ALTER TABLE `copy_send_wp_msgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
