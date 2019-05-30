-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2019 at 03:06 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onepipedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_one`
--

DROP TABLE IF EXISTS `tb_one`;
CREATE TABLE IF NOT EXISTS `tb_one` (
  `userId` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_one`
--

INSERT INTO `tb_one` (`userId`, `fullname`, `answer`) VALUES
(1, 'Frank', 'Making a life worth living is something we all should learn to do');

-- --------------------------------------------------------

--
-- Table structure for table `tb_two`
--

DROP TABLE IF EXISTS `tb_two`;
CREATE TABLE IF NOT EXISTS `tb_two` (
  `userId` int(8) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_two`
--

INSERT INTO `tb_two` (`userId`, `fullname`, `answer`) VALUES
(1, 'Kunle', 'Making a life worth living is something we all should learn to do');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
