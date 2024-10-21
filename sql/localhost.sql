-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2023 at 12:38 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id20063826_haltsaltpepper`
--
CREATE DATABASE IF NOT EXISTS `id20063826_haltsaltpepper` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id20063826_haltsaltpepper`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `salted` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `salted`) VALUES
(73, 'haha@gmail.com', 'haha', '$2y$10$hYqLTUygcGynvvjGRNZXuOTpXk8ZyX870of/CD9jEXAHF0Uh5AKIu', 'aochaaamhimlaaa.haalhahchaahmiga'),
(74, 'takloy@gmail.com', 'takloy', '$2y$10$nciDLZfgyJotkSBndkgEiuOuqw.uaHnNS9i0KXXLL/Lv2vzfHPkeq', 'lgmotcltckakamcloktmymgytgtomooo'),
(75, 'llsa@gmail.com', 'saSDSAD', '$2y$10$xf7xebYnuixEbZiavdd5OeqHRlItKp6GD/J8NSDCqNbfjYLU2Qmd6', 'amoso@aSsooSaaasDSSlaaa@clA@mmls');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
