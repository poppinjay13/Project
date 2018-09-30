-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2018 at 08:12 AM
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
-- Database: `tenderingsyst`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentId` varchar(4) NOT NULL,
  `departmentName` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentId`, `departmentName`) VALUES
('1A', 'FOOD'),
('1B', 'BOOKS');

-- --------------------------------------------------------

--
-- Table structure for table `departmentmanagers`
--

CREATE TABLE `departmentmanagers` (
  `userId` int(11) NOT NULL,
  `departmentId` varchar(4) NOT NULL,
  `FirstName` varchar(25) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departmentmanagers`
--

INSERT INTO `departmentmanagers` (`userId`, `departmentId`, `FirstName`, `LastName`, `email`) VALUES
(100, '1B', 'IAN', 'ODUNDO', 'odundo@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userId` int(11) NOT NULL,
  `Password` varchar(10) NOT NULL,
  `userType` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userId`, `Password`, `userType`) VALUES
(1, 'julie100', 'TENDERER'),
(100, 'ian100', 'DEPARTMENT MANAGER');

-- --------------------------------------------------------

--
-- Table structure for table `tender`
--

CREATE TABLE `tender` (
  `tenderId` int(11) NOT NULL,
  `tenderName` varchar(25) NOT NULL,
  `departmentId` varchar(4) NOT NULL,
  `tenderDetails` varchar(255) NOT NULL,
  `floating date` datetime NOT NULL,
  `deadlineDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tender`
--

INSERT INTO `tender` (`tenderId`, `tenderName`, `departmentId`, `tenderDetails`, `floating date`, `deadlineDate`) VALUES
(890, 'A4 BOOKS TENDER', '1B', 'The tender required is of A4 books, 200 pages.', '2018-09-20 08:00:00', '2018-10-04 10:00:00'),
(980, 'MAIZE FLOUR TENDER', '1A', 'The tender required is of maize flour, No. 1, 100 90kgs bags', '2018-09-27 08:00:00', '2018-10-11 10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tenderer`
--

CREATE TABLE `tenderer` (
  `userId` int(11) NOT NULL,
  `FirstName` varchar(15) NOT NULL,
  `LastName` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `idNum` int(11) NOT NULL,
  `phoneNo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenderer`
--

INSERT INTO `tenderer` (`userId`, `FirstName`, `LastName`, `Email`, `idNum`, `phoneNo`) VALUES
(1, 'JULIE', 'MUNYUI', 'julz@gmail.com', 34578, 7935466);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentId`),
  ADD UNIQUE KEY `departmentId` (`departmentId`),
  ADD KEY `departmentId_2` (`departmentId`);

--
-- Indexes for table `departmentmanagers`
--
ALTER TABLE `departmentmanagers`
  ADD UNIQUE KEY `userId` (`userId`),
  ADD KEY `departmentId` (`departmentId`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Indexes for table `tender`
--
ALTER TABLE `tender`
  ADD PRIMARY KEY (`tenderId`),
  ADD UNIQUE KEY `tenderId` (`tenderId`),
  ADD KEY `departmentId` (`departmentId`);

--
-- Indexes for table `tenderer`
--
ALTER TABLE `tenderer`
  ADD UNIQUE KEY `idNum` (`idNum`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departmentmanagers`
--
ALTER TABLE `departmentmanagers`
  ADD CONSTRAINT `departmentmanagers_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `login` (`userId`),
  ADD CONSTRAINT `departmentmanagers_ibfk_2` FOREIGN KEY (`departmentId`) REFERENCES `department` (`departmentId`);

--
-- Constraints for table `tender`
--
ALTER TABLE `tender`
  ADD CONSTRAINT `tender_ibfk_1` FOREIGN KEY (`departmentId`) REFERENCES `department` (`departmentId`);

--
-- Constraints for table `tenderer`
--
ALTER TABLE `tenderer`
  ADD CONSTRAINT `tenderer_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `login` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
