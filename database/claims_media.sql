-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 07:39 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newclaimsmitra`
--

-- --------------------------------------------------------

--
-- Table structure for table `claims_media`
--

CREATE TABLE `claims_media` (
  `id` int(255) NOT NULL,
  `casereference` text NOT NULL,
  `directory_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claims_media`
--

INSERT INTO `claims_media` (`id`, `casereference`, `directory_name`, `created_at`) VALUES
(1, 'VP SInghal Surveyor', '897358917684', '2024-07-05 10:22:20'),
(2, 'VP SInghal Surveyor', '89735891', '2024-07-05 10:35:53'),
(3, 'VP SInghal Surveyor', '897358915135315', '2024-07-05 10:52:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claims_media`
--
ALTER TABLE `claims_media`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claims_media`
--
ALTER TABLE `claims_media`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
