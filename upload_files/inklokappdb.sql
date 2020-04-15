-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2020 at 11:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inklokappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `imagefolders`
--

CREATE TABLE `imagefolders` (
  `id` int(11) NOT NULL,
  `folderName` varchar(50) NOT NULL,
  `folderPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imagefolders`
--

INSERT INTO `imagefolders` (`id`, `folderName`, `folderPath`) VALUES
(1, 'Folder 1', 'http://localhost/crm/upload_files/uploads/Folder 1'),
(2, 'folder2', 'http://localhost/crm/upload_files/uploads/folder2'),
(3, 'folder3', 'http://localhost/crm/upload_files/uploads/folder3'),
(4, 'folder4', 'http://localhost/crm/upload_files/uploads/folder4');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `fileName` varchar(50) NOT NULL,
  `filePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `fileName`, `filePath`) VALUES
(1, '', 'uploads/EVAv3GJWkAMdczQ.jpg'),
(2, '', 'uploads/hbjdshjdsjhds.png'),
(3, '', 'uploads/tumblr_moopi7XqG11qbzzgco1_500.gif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_path` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `photo_path`) VALUES
(1, 'Admin User', 'admin@admin.com', NULL, '$2y$10$cnn2t0VwBUUVHaKJWWUiw.N2WOjlJGRSqoUTu95JbUyRXxMZSYhh.', NULL, '2020-04-08 16:11:43', '2020-04-08 16:11:43', ''),
(2, 'Generic User', 'user@user.com', NULL, '$2y$10$hsZyoJKU5kdE9b/LRz8l9uIRrcg5m.M0UhdeKYc6lZQfS8yd3LWdK', NULL, '2020-04-08 16:11:43', '2020-04-08 16:11:43', ''),
(3, 'khi', 'khi@test.com', NULL, '$2y$10$rG38LULat9E9lHDN6pZEJOxFyuaeoiF8Je3E52OQRilaGXZCYPsJC', NULL, '2020-04-08 16:24:27', '2020-04-08 16:24:27', ''),
(4, 'a', 'a@a.com', NULL, '$2y$10$OtyQQY3l5BruNa5Bnp9nLO80RcFQqCepgSVOuetdXKOHiRtcdX7kq', NULL, '2020-04-10 10:51:12', '2020-04-10 10:51:12', 'external-content.duckduckgo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagefolders`
--
ALTER TABLE `imagefolders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagefolders`
--
ALTER TABLE `imagefolders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
