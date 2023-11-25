-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2023 at 06:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sideline_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

CREATE TABLE `agency` (
  `agen_id` int(11) NOT NULL,
  `agen_name` varchar(255) NOT NULL,
  `agen_surname` varchar(255) NOT NULL,
  `agen_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `agen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `agen_id`) VALUES
(1, 'PG-Slot', 1),
(2, 'Royal Sideline', 2),
(3, 'TSG Sideline', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ladies`
--

CREATE TABLE `ladies` (
  `id` int(11) NOT NULL,
  `lady_id` varchar(10) NOT NULL,
  `lady_name` varchar(255) NOT NULL,
  `lady_address` varchar(255) NOT NULL,
  `lady_photo` varchar(255) NOT NULL,
  `lady_phone` varchar(255) NOT NULL,
  `lady_line` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ladies`
--

INSERT INTO `ladies` (`id`, `lady_id`, `lady_name`, `lady_address`, `lady_photo`, `lady_phone`, `lady_line`, `group_id`) VALUES
(39, '001', 'น้องเคน', 'ระยอง', 'ken.jpg', '0988987111', '@ken777', 3),
(40, '002', 'น้องต้นข้าว', 'สมุทรสาคร', 'kaow.jpg', '098898767', '@kaow.k', 3),
(41, '003', 'น้องทีม', 'ราชบุรี', 'tt.jpg', '0852736111', '@teammy', 2),
(42, '004', 'น้องฟรังกี้', 'นครปฐม', 'fababa.jpg', '0988987611', '@frang', 1),
(43, '005', 'น้องต้นน้ำ', 'นครปฐม', '1.png', '0988987611', '@ttnum', 1),
(44, '006', 'น้องโชค', 'นครปฐม', 'jo.jpg', '09889121', '@p888', 1),
(45, '007', 'น้องกอบ', 'กรุงเทพฯ', 'kk.jpg', '0988987', '@aaa888', 2),
(46, '008', 'น้องกานต์', 'นนทบุรี', 'ka.jpg', '0988987111', '@kann.n', 3),
(47, '009', 'น้องปอนด์', 'ราชบุรี', 'pond.jpg', '0654321111', '@pond.d', 1),
(48, '010', 'น้องหนุ่ม', 'ราชบุรี', 'noomrz.jpg', '0852736111', '@noomrz', 1),
(49, '011', 'น้องปอ', 'ราชบุรี', 'por.jpg', '0988987111', '@por.r', 2),
(50, '012', 'น้องทีม &  น้องอาร์ม', 'นครปฐม', 'at.jpg', '0988987611', '@pdkd', 2),
(51, '013', 'น้องเก็ท', 'สุพรรณบุรี', 'g.jpg', '0988987611', '@gett.t', 3),
(52, '014', 'น้องโย', 'สุพรรณบุรี', 'yo.jpg', '0988987611', '@yoyo.y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `urole`, `created_at`) VALUES
(2, 'admin', '01', 'admin@gmail.com', '$2y$10$yQ5op.uO3ZNv/M2Y8qD9yObdMvxyhoGT/yLXwpTz04o9NkIhmS4Kq', 'admin', '2023-11-07 16:23:14'),
(6, 'Naphat', 'Lonu', 'hat31122002@gmail.com', '$2y$10$K7Py/1xFXRoPhRRiK7V35ezR3MVQXUQisJ5ATqMW/49d3w68xy1Ym', 'user', '2023-11-14 07:13:34'),
(7, 'user', 'test', 'user@gmail.com', '$2y$10$rIraOn6D4b/v6UyOFwIhY.Ay8tyZ6/N9VLS7h0N2dg9qB941qbWQC', 'user', '2023-11-25 04:58:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agency`
--
ALTER TABLE `agency`
  ADD PRIMARY KEY (`agen_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `ladies`
--
ALTER TABLE `ladies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agency`
--
ALTER TABLE `agency`
  MODIFY `agen_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ladies`
--
ALTER TABLE `ladies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
