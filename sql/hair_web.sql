-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 2024 年 1 月 25 日 00:00
-- サーバのバージョン： 5.6.38
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hair_web`
--
CREATE DATABASE IF NOT EXISTS `hair_web` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `hair_web`;

-- --------------------------------------------------------

--
-- テーブルの構造 `admin`
--

CREATE TABLE `admin` (
  `id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
('admin', 'adminName', '$2y$10$whKi.Kocl2B4DakQ6kzdk.DD1maZrfWsl8ImJiRv39qZHA/20ix0C');

-- --------------------------------------------------------

--
-- テーブルの構造 `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `minutes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `menus`
--

INSERT INTO `menus` (`id`, `menu`, `price`, `minutes`) VALUES
(1, 'カット', 6000, 50),
(2, 'カラー', 7000, 60),
(3, 'パーマ', 9000, 120);

-- --------------------------------------------------------

--
-- テーブルの構造 `reserve`
--

CREATE TABLE `reserve` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `day` date NOT NULL,
  `tel` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `reserve`
--

INSERT INTO `reserve` (`id`, `name`, `day`, `tel`, `start_time`, `end_time`) VALUES
(2024011001, '松澤', '2024-01-10', '0120117117', '09:00:00', '11:00:00'),
(2024011002, '佐々木', '2024-01-10', '0120117117', '15:00:00', '16:00:00'),
(2024011003, '松澤', '2024-01-10', '0120-117-117', '13:00:00', '14:00:00'),
(2024011601, '松澤', '2024-01-16', '08063186595', '09:00:00', '11:00:00'),
(2024011701, '松澤', '2024-01-17', '08063186595', '14:30:00', '15:30:00'),
(2024011702, '松澤', '2024-01-17', '08063186595', '12:00:00', '16:00:00'),
(2024011801, '松澤', '2024-01-18', '08063186595', '09:00:00', '11:00:00'),
(2024011901, '松澤', '2024-01-19', '08063186595', '09:00:00', '11:00:00'),
(2024011902, '松澤', '2024-01-19', '08063186595', '14:00:00', '18:00:00'),
(2024012201, '松澤', '2024-01-22', '08063186595', '09:00:00', '11:00:00'),
(2024012202, '松澤', '2024-01-22', '08063186595', '13:00:00', '15:00:00'),
(2024012203, '松澤', '2024-01-22', '08063186595', '15:00:00', '19:00:00'),
(2024012601, '松澤', '2024-01-26', '08063186595', '12:00:00', '13:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `reserve_detail`
--

CREATE TABLE `reserve_detail` (
  `reserve_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `reserve_detail`
--

INSERT INTO `reserve_detail` (`reserve_id`, `menu_id`) VALUES
(2024011001, 1),
(2024011002, 1),
(2024011003, 1),
(2024011601, 1),
(2024011601, 2),
(2024011601, 3),
(2024011701, 1),
(2024011702, 1),
(2024011702, 2),
(2024011702, 3),
(2024011801, 1),
(2024011801, 2),
(2024011901, 1),
(2024011901, 2),
(2024011902, 1),
(2024011902, 2),
(2024011902, 3),
(2024012001, 1),
(2024012001, 2),
(2024012002, 1),
(2024012002, 2),
(2024012201, 1),
(2024012201, 2),
(2024012202, 3),
(2024012203, 1),
(2024012203, 2),
(2024012203, 3),
(2024012301, 1),
(2024012301, 2),
(2024012601, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reserve_detail`
--
ALTER TABLE `reserve_detail`
  ADD PRIMARY KEY (`reserve_id`,`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
