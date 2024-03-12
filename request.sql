-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 07:54 AM
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
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `DDC` varchar(255) DEFAULT NULL,
  `ISBN` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `publication_date` varchar(100) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `sheets` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `borrowed_date` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `MyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `DDC`, `ISBN`, `author`, `category`, `book_id`, `image`, `language`, `publication_date`, `publisher`, `sheets`, `title`, `topic`, `borrowed_date`, `status`, `name`, `MyId`) VALUES
(30, '100', '0900', 'sample 4', 'Philosophy', 19, 'rent.png', 'English', '2023-12-03', 'SAMPLE 4', 'ITEAPV-BOOK.docx', 'sample 4', 'sample topic 4', '2024-01-21 13:28:01', 'received', 'curry', 7),
(31, '000', '0900', 'sample 5', 'Computer Science', 21, 'Leomord.png', 'English', '2023-11-28', 'SAMPLE 5', 'Endterm-Activity.docx', 'sample 5', 'sample topic 5', '2024-01-21 13:28:48', 'return', 'PERRY', 7),
(32, '100', '0900', 'sample 4', 'Philosophy', 19, 'rent.png', 'English', '2023-12-03', 'SAMPLE 4', 'ITEAPV-BOOK.docx', 'sample 4', 'sample topic 4', '2024-01-21', 'pending', 'curry', 7),
(33, '000', '0900', 'sample 5', 'Computer Science', 21, 'Leomord.png', 'English', '2023-11-28', 'SAMPLE 5', 'Endterm-Activity.docx', 'sample 5', 'sample topic 5', '2024-01-21', 'accepted', 'PERRY', 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
