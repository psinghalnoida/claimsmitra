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
-- Table structure for table `claims_expenses`
--

CREATE TABLE `claims_expenses` (
  `id` int(11) NOT NULL,
  `aid` varchar(150) NOT NULL,
  `operation` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claims_expenses`
--

INSERT INTO `claims_expenses` (`id`, `aid`, `operation`, `date`, `amount`, `description`, `status`, `createdat`) VALUES
(111, '08072410393456', 'Less', '0000-00-00', '2321', 'Cash', 1, '2024-07-27 12:06:30'),
(113, '27072412210751', 'Add', '2024-08-07', '200', 'Expenses', 1, '2024-08-09 09:40:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `claims_expenses`
--
ALTER TABLE `claims_expenses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `claims_expenses`
--
ALTER TABLE `claims_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
