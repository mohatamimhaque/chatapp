-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 12:20 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `array`
--

CREATE TABLE `array` (
  `id` varchar(11) NOT NULL,
  `array` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `array`
--

INSERT INTO `array` (`id`, `array`) VALUES

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `outgoing_id` varchar(255) NOT NULL,
  `incoming_id` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(191) NOT NULL,
  `file` varchar(191) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `outgoing_id`, `incoming_id`, `message`, `image`, `file`, `status`, `created_at`) VALUES
(51, '2ZsgYAjc', 'uDynLaaT', 'dfdfdf', '', '', 0, '2022-08-25 15:47:28'),
(52, '2ZsgYAjc', 'uDynLaaT', 'dfddd', '', '', 0, '2022-08-25 15:48:34'),
(53, '2ZsgYAjc', 'uDynLaaT', 'jhhh', '', '', 0, '2022-08-25 15:48:50'),
(54, '2ZsgYAjc', 'uDynLaaT', 'jjbjb', '', '', 0, '2022-08-25 15:49:25'),
(55, '2ZsgYAjc', 'uDynLaaT', 'jjbjb', '', '', 0, '2022-08-25 15:49:27'),
(56, '2ZsgYAjc', 'uDynLaaT', 'jjbjb', '', '', 0, '2022-08-25 15:49:31'),
(57, '2ZsgYAjc', 'uDynLaaT', 'jbj', '', '', 0, '2022-08-25 15:49:52'),
(58, '2ZsgYAjc', 'uDynLaaT', 'jbj', '', '', 0, '2022-08-25 15:49:53'),
(59, '2ZsgYAjc', 'uDynLaaT', 'jk', '', '', 0, '2022-08-25 15:50:07'),
(60, 'uDynLaaT', '2ZsgYAjc', 'কেমন আছেন?', '', '', 0, '2022-08-25 21:29:47'),
(61, 'uDynLaaT', '2ZsgYAjc', 'ඔබට කෙසේද?', '', '', 0, '2022-08-25 21:31:21'),
(62, 'uDynLaaT', '2ZsgYAjc', 'grgregreg', '', '', 0, '2022-08-25 23:34:56'),
(63, 'uDynLaaT', '2ZsgYAjc', 'আপনি?', '', '', 0, '2022-08-25 23:36:27'),
(64, '2ZsgYAjc', 'uDynLaaT', ' vcbbfvbv', '', '', 0, '2023-08-25 19:07:57'),
(65, '2ZsgYAjc', 'uDynLaaT', 'dfsdf', '', '', 0, '2023-08-25 19:12:10'),
(66, '2ZsgYAjc', 'uDynLaaT', 'erererererer', '', '', 0, '2023-12-19 17:03:10'),
(67, '2ZsgYAjc', 'uDynLaaT', 'rferfee', '', '', 0, '2023-12-19 17:07:49'),
(68, '2ZsgYAjc', 'uDynLaaT', 'efrerfe', '', '', 0, '2023-12-19 17:07:54'),
(69, '2ZsgYAjc', 'uDynLaaT', 'fefefeefe', '', '', 0, '2023-12-19 17:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(191) NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `photo` varchar(191) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `logged_time` varchar(191) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `unique_id`, `first_name`, `last_name`, `email`, `password`, `photo`, `status`, `logged_time`, `created_at`, `activation_code`) VALUES
(2, 'uDynLaaT', 'Mohatamim', 'Haque', 'mohatamim0haque@gmail.com', '18611131', 'uDynLaaT.jpg', 0, ' 1702984185', '2022-08-05', '0'),
(3, '2ZsgYAjc', 'Adiba', 'Ahmed', 'adibaahmed@gmail.com', '18611131', '2ZsgYAjc.jpg', 0, ' 1702984158', '2022-08-05', '848984'),
(4, '743g1H5g', 'Khusi', 'Tonni', 'khusitonni@gmail.com', '18611131', '743g1H5g.jpg', 0, ' 1661389993', '2022-08-05', '0'),
(5, '1ilHr9Ut', 'Raju', 'Bhai', 'rajubhai@gmail.com', '18611131', '1659689879.jpg', 0, ' 1661387111', '2022-08-05', '0'),
(6, 'vh3P2cLH', 'Nasirul', 'Islam', 'nasirulislam@gmail.com', '18611131', '1659690087.jpg', 0, ' 1661420380', '2022-08-05', '0'),
(9, 'douuCUzo', 'Mohatamim', 'Haque', 'mohatamimhaque790@gmail.com', '18611131', '1659769260.jpg', 0, ' 1659769300', '2022-08-06', '0'),
(10, 'hs3QbEvh', 'vf', 'fvfdvf', 'rivanaakter@gmail.com', '18611131', '1659769393.jpg', 1, ' 1659769395', '2022-08-06', '338661'),
(11, 'P1pczAOi', 'Mohatamim', 'Haque', 'mohatamimhaque20@gmail.com', '18611131dD@', '1659797647.jpg', 1, ' 1659797647', '2022-08-06', '679715');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `array`
--
ALTER TABLE `array`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;