-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2025 at 12:38 PM
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
-- Database: `parkingspots`
--

-- --------------------------------------------------------

--
-- Table structure for table `parkingspots`
--

CREATE TABLE `parkingspots` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL,
  `total_slots` int(11) DEFAULT NULL,
  `available_slots` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parkingspots`
--

INSERT INTO `parkingspots` (`id`, `name`, `lat`, `lon`, `total_slots`, `available_slots`, `city`, `area`) VALUES
(1, 'Airport Parking', 21.0909, 79.0547, 20, 20, 'nagpur', 'Airport'),
(2, 'Rajiv Gandhi Snake Park', 18.4531, 73.8613, 20, 20, 'pune', 'katraj'),
(3, 'shambaji nagar airport ', 19.8622, 75.4023, 20, 20, 'sambhaji nagar', 'airport'),
(4, 'ramdaspeth', 21.137, 79.0763, 20, 20, 'nagpur', 'ramdaspeth');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parkingspots`
--
ALTER TABLE `parkingspots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parkingspots`
--
ALTER TABLE `parkingspots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
