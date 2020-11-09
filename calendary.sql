-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2020 at 04:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `calendary`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `fdDate` date NOT NULL,
  `fdName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`fdDate`, `fdName`) VALUES
('2020-11-01', 'Remont'),
('2020-11-02', 'Remont'),
('2020-11-03', 'Remont'),
('2020-11-04', 'Remont'),
('2020-11-06', 'Rower'),
('2020-11-07', 'Rower'),
('2020-11-11', 'Weterynarz'),
('2020-11-13', 'Sopot'),
('2020-11-14', 'Sopot'),
('2020-11-17', 'Wyjazd na wakacje!'),
('2020-11-19', 'Tatry'),
('2020-11-20', 'Tatry'),
('2020-11-21', 'Tatry'),
('2020-11-22', 'Tatry'),
('2020-11-23', 'Tatry'),
('2020-11-24', 'Tatry'),
('2020-11-29', 'Weterynarz');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD UNIQUE KEY `fdDate` (`fdDate`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
