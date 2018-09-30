-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2018 at 08:27 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projecttender`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Idnum` varchar(254) NOT NULL,
  `Status` varchar(254) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Password` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Idnum`, `Status`, `Email`, `Password`) VALUES
('100446', 'tenderer', 'ian.odundo@site.com', 'OdundoIan'),
('26565', 'department manager', 'davidson.ridure@site.com', 'RidureDavid'),
('34545', 'department manager', 'kimilili.waswa@site.com', 'WaswaPenn'),
('99460', 'tenderer', 'munyui.julie@site.com', 'MunyuiJulie');

-- --------------------------------------------------------
--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`Name`, `Department`, `Requirements`, `Enquiries`, `Deadtime`, `Deaddate`) VALUES
('Maize', 'Administration', '100 90kg bags of maize', '079723456263', '00:00:00.000000', '0000-00-00'),
('Books', 'Sciences', 'KMF 200 copies', '0734567338i8', '00:20:18.000000', '0000-00-00'),
('Pencils', 'Economics', 'Beautiful pencils', '0832456478', '00:00:00.000000', '2018-09-09'),
('Thermometer', 'Laboratory', '50 thermometers ', '0712303090', '00:00:00.000000', '2018-09-09'),
('Projectors', 'Administration', 'we need 5 projectors', '0713454567', '00:00:00.000000', '2018-09-09'),
('Burretes', 'Laboratory', '20 burretes', '0712303090', '00:00:00.000000', '2018-09-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Idnum`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
