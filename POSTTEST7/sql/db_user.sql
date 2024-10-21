-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Oct 21, 2024 at 03:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_user`
--
CREATE DATABASE IF NOT EXISTS `db_user` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_user`;

-- --------------------------------------------------------

--
-- Table structure for table `komen`
--

DROP TABLE IF EXISTS `komen`;
CREATE TABLE `komen` (
  `id` int(11) NOT NULL,
  `nama_novel` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komen`
--

INSERT INTO `komen` (`id`, `nama_novel`, `comment`, `foto`, `username`) VALUES
(1, 'Matahari', 'Bagus dan asyik', '2024-10-21 20.26.48.jpg', 'Heri'),
(2, 'Ceros dan Batozar', 'Seram tapi unik', '2024-10-21 20.32.50.png', 'Aiman'),
(3, 'Midnight at malioboro', 'Sedih tapi candu', '2024-10-21 20.51.24.png', 'Aiman');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `password`) VALUES
('Aiman', 'eiman@gmail.com', '$2y$10$D6lkmWH4FonGO1juD4BzxeAvLblk.JbmpcV0aapz1YAUBySZQIALG'),
('Heri', 'heri@gmail.com', '$2y$10$F.XUdvo7xTaz/xI9ZtpR3OS3.vDnjlvvt1xtaM/i6wy3WatAV63jK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komen`
--
ALTER TABLE `komen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komen`
--
ALTER TABLE `komen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
