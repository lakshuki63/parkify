-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 01:32 PM
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
-- Database: `user_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `phoneNo` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address1` varchar(200) DEFAULT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `aadharNumber` varchar(20) DEFAULT NULL,
  `aadharFile` varchar(255) DEFAULT NULL,
  `carNumber` varchar(20) DEFAULT NULL,
  `dlNumber` varchar(20) DEFAULT NULL,
  `dlFile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `username`, `firstName`, `lastName`, `phoneNo`, `email`, `state`, `city`, `address1`, `address2`, `dob`, `aadharNumber`, `aadharFile`, `carNumber`, `dlNumber`, `dlFile`, `created_at`) VALUES
(5, 'lakshuki123', 'Lakshuki', 'Hatwar', '9766399731', 'lakshukihatwar@gmail.com', 'Maharashtra', 'bhandara', 'bhandara', 'RAJIV GANDHI WARD ,STATION ROAD ,BHANDARA', '25 may 2006', '53453786587675687', '', '864564', '32654786586378', '', '2025-04-05 17:40:37'),
(6, 'n3ssdub3y', 'Ness', 'dubey', '9098044401', 'nessdubey0@gmail.com', 'madhya pradesh', 'Shivpuri', 'Vivekanand colony', 'infront of D.J. Kothi', '11/01/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 10:52:35'),
(7, 'pr@nj@l', 'pranjal', 'baghel', '7000335292', 'bt24csa052@iiitn.ac.in', 'madhya pradesh', 'Narsinghpur', 'aalu ka paratha', 'bhindi gali', '4/12/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 10:59:45'),
(8, 'nxkul', 'nakul', 'bhadade', '9967885464', 'bt24csa047@iiitn.ac.in', 'maharashtra', 'mumbai', 'aalu ka paratha', 'bhindi gali', '19/12/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 11:02:02'),
(9, 's!ddh!', 'siddhi', 'dhoke', '8857856525', 'bt24csa050@iiitn.ac.in', 'Maharashtra', 'Nagpur', 'aalu ka paratha', 'bhindi gali', '29/03/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 11:04:10'),
(10, 'tannu', 'tanmay', 'namdeo', '9403936785', 'bt24csa089@iiitn.ac.in', 'Maharashtra', 'Nagpur', 'aalu ka paratha', 'bhindi gali', '23/01/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 11:06:41'),
(11, 'rajjo', 'Raj', 'gupta', '9724734339', 'bt24ece090@iiitn.ac.in', 'Gujrat', 'Bhuj', 'aalu ka paratha', 'bhindi gali', '25/09/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 11:21:52'),
(12, 'ank!ta', 'ankita', 'baghel', '8827402466', 'bt24ece050@iiitn.ac.in', 'madhya pradesh', 'Dhar', 'aalu ka paratha', 'bhindi gali', '15/03/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 11:25:19'),
(13, '@nnu', 'annapurna', 'mahajan', '8252014495', 'bt24ece052@iiitn.ac.in', 'Bihar', 'Patna', 'bhole chature', 'bhindi gali', '28/03/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 11:28:42'),
(14, 's0umya', 'soumya', 'light', '8097273010', 'bt24ece117@iiitn.ac.in', 'Maharashtra', 'Mumbai', 'bhole chature', 'bhindi gali', '20/04/2006', '358309506778', '', 'MP32H1639', '1223334444', '', '2025-04-09 11:31:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
