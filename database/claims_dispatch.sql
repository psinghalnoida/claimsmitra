-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2024 at 07:13 AM
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
-- Table structure for table `claims_dispatch`
--

CREATE TABLE `claims_dispatch` (
  `id` int(11) NOT NULL,
  `aid` varchar(150) NOT NULL,
  `dispatchmode` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `dispatchdate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claims_dispatch`
--

INSERT INTO `claims_dispatch` (`id`, `aid`, `dispatchmode`, `description`, `dispatchdate`, `status`, `createdat`) VALUES
(26, '08072410393456', 'Dispatch By Hand', '', '2024-07-10', 1, '2024-07-16 11:14:09'),
(27, '08072410393456', 'Pending For Dispatch', '', '2024-07-20', 1, '2024-07-16 11:17:46'),
(28, '08072410393456', 'Pending For Dispatch', 'testing', '2024-07-13', 1, '2024-07-16 11:20:13'),
(30, '08072410393456', 'Pending For Dispatch', 'test', '2024-07-20', 1, '2024-07-16 11:44:55'),
(31, '08072410393456', 'Pending For Dispatch', 'not testing', '2024-07-28', 1, '2024-07-16 11:49:35'),
(32, '08072410393456', 'Dispatch By Post', 'good', '2024-07-26', 1, '2024-07-16 11:57:16'),
(33, '08072410393456', 'Dispatch By Post', 'hii', '2024-08-01', 1, '2024-07-16 12:18:11'),
(34, '08072410393456', 'Dispatch By Post', 'hii', '2024-07-19', 1, '2024-07-16 12:18:27'),
(35, '08072410393456', 'Dispatch By Hand', 'testing', '2024-07-27', 1, '2024-07-17 04:49:35'),
(36, '08072410393456', 'Dispatch By Hand', 'hii', '2024-07-19', 1, '2024-07-17 05:00:18'),
(37, '08072410393456', 'Pending For Dispatch', 'testing', '2024-08-02', 1, '2024-07-17 05:38:38'),
(38, '08072410393456', 'Dispatch By Post', 'Surveyor', '2024-08-11', 1, '2024-07-17 05:52:41'),
(39, '08072410393456', 'Pending For Dispatch', 'hiii', '2024-07-04', 1, '2024-07-25 10:13:38'),
(40, '08072410393456', 'Submitted Online', 'select', '2024-08-31', 1, '2024-07-25 10:13:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claims_dispatch`
--
ALTER TABLE `claims_dispatch`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claims_dispatch`
--
ALTER TABLE `claims_dispatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
