-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2018 at 09:33 AM
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
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `AdminId` varchar(254) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`AdminId`, `Name`, `Email`) VALUES
('24245', 'Wallah Bin', 'wallah.bin@site.com');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `TenderID` int(254) NOT NULL,
  `TendererID` varchar(254) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `Business` varchar(254) NOT NULL,
  `Position` varchar(254) NOT NULL,
  `Price` int(11) NOT NULL,
  `Completion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Amount` int(11) NOT NULL,
  `Location` varchar(254) NOT NULL,
  `Docs` varchar(254) NOT NULL,
  `Status` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`TenderID`, `TendererID`, `Name`, `Business`, `Position`, `Price`, `Completion`, `Amount`, `Location`, `Docs`, `Status`) VALUES
(1, '99460', '', '', '', 0, '2018-10-07 14:25:52', 0, '', '1-99460.pdf', 'ACCEPTED'),
(24, '100446', '', '', '', 0, '2018-10-07 13:46:55', 0, '', '24-100446.pdf', 'nooos'),
(1, '100446', '', '', '', 0, '2018-10-11 16:42:32', 0, '', '1-100446.pdf', 'REJECTED'),
(28, '99460', '', '', '', 0, '2018-10-07 13:46:55', 0, '', '28-99460.pdf', 'REJECTED'),
(37, '100446', 'Ian Otieno Odundo', 'Mybiz', 'Manager', 1234, '2018-10-07 14:16:01', 12, 'Ruai', '37-100446.pdf', 'ACCEPTED');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DeptID` int(254) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `DeptMan` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DeptID`, `Name`, `DeptMan`) VALUES
(1, 'Languages', ''),
(2, 'Mathematics', ''),
(3, 'Humanities', ''),
(4, 'Sciences', ''),
(5, 'Technical', ''),
(6, 'Economics', ''),
(7, 'Business', ''),
(8, 'Laboratory', ''),
(9, 'Administration', ''),
(10, 'Finance', ''),
(11, 'Guidance and Counselling', '');

-- --------------------------------------------------------

--
-- Table structure for table `heads`
--

CREATE TABLE `heads` (
  `HeadID` varchar(254) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Department` varchar(254) NOT NULL,
  `Phone_Num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heads`
--

INSERT INTO `heads` (`HeadID`, `Name`, `Email`, `Department`, `Phone_Num`) VALUES
('34545', 'Peninah Waswa Kimilili', 'kimilili.waswa@site.com', 'Administration', 713454567),
('100998', 'Junior Jr', 'junior.jr@site.com', 'Finance', 735434343),
('26565', 'Davidson Kamau Ridure', 'davidson.ridure@site.com', 'Laboratory', 712303090);

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
('100998', 'department manager', 'junior.jr@site.com', 'JrJunior'),
('24245', 'administrator', 'wallah.bin@site.com', 'BinWallah'),
('26565', 'department manager', 'davidson.ridure@site.com', 'RidureDavid'),
('34545', 'department manager', 'kimilili.waswa@site.com', 'WaswaPenn'),
('99460', 'tenderer', 'munyui.julie@site.com', 'MunyuiJulie');

-- --------------------------------------------------------

--
-- Table structure for table `tenderers`
--

CREATE TABLE `tenderers` (
  `No` int(11) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `IDNo` varchar(254) NOT NULL,
  `Phone` varchar(254) NOT NULL,
  `Email` varchar(254) NOT NULL,
  `Address` varchar(254) NOT NULL,
  `POBox` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenderers`
--

INSERT INTO `tenderers` (`No`, `Name`, `IDNo`, `Phone`, `Email`, `Address`, `POBox`) VALUES
(1, 'Ian Otieno Odundo', '100446', '0713009333', 'ian.odundo@site.com', '', ''),
(2, 'Julie Munyui', '99460', '0797652842', 'munyui.julie@site.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tenders`
--

CREATE TABLE `tenders` (
  `TenderID` int(254) NOT NULL,
  `Name` varchar(254) NOT NULL,
  `Department` varchar(254) NOT NULL,
  `Requirements` varchar(254) NOT NULL,
  `Enquiries` varchar(254) NOT NULL,
  `Deaddate` datetime NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`TenderID`, `Name`, `Department`, `Requirements`, `Enquiries`, `Deaddate`, `Status`) VALUES
(1, 'Construction Materials', 'Administration', 'Supply of 10 bags of cement and 4 tonnes of sand.', '071300933', '2018-09-18 00:00:00', ''),
(2, 'Call for Stationery', 'Languages', 'Supply of 2000 A4 square ruled notebooks.', '0719653520', '2018-09-30 00:00:00', ''),
(22, 'Maize', 'Administration', '100 90kg bags of maize', '079723456263', '0000-00-00 00:00:00', ''),
(24, 'Books', 'Sciences', 'KMF 200 copies', '0734567338i8', '0000-00-00 00:00:00', ''),
(25, 'Pencils', 'Economics', 'Beautiful pencils', '0832456478', '2018-09-09 00:00:00', ''),
(27, 'Thermometer', 'Laboratory', '50 thermometers ', '0712303090', '2018-09-09 00:00:00', ''),
(28, 'Projectors', 'Administration', 'we need 5 projectors', '0713454567', '2018-09-09 00:00:00', ''),
(29, 'Burretes', 'Laboratory', '20 burretes', '0712303090', '2018-09-09 00:00:00', ''),
(35, 'Whiteboard', 'Administration', '2 large whiteboards', '0712303090', '2018-10-30 04:00:00', ''),
(36, 'Computers', 'Administration', 'core 17', '0713332244', '2018-10-24 21:00:00', ''),
(37, 'Books2', 'Administration', '2books', '079443256y', '2018-10-08 21:00:00', ''),
(38, 'jules', 'Administration', 'egh', '0712303090', '2018-10-09 20:00:00', ''),
(39, 'Pen', 'Administration', '50 pens', '0712303090', '2018-10-23 17:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD KEY `AdminId` (`AdminId`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD KEY `TenderID` (`TenderID`,`TendererID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DeptID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `heads`
--
ALTER TABLE `heads`
  ADD UNIQUE KEY `Department_2` (`Department`),
  ADD KEY `HeadID` (`HeadID`),
  ADD KEY `Department` (`Department`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Idnum`);

--
-- Indexes for table `tenderers`
--
ALTER TABLE `tenderers`
  ADD UNIQUE KEY `Num` (`No`),
  ADD UNIQUE KEY `IDNo_2` (`IDNo`),
  ADD KEY `No` (`No`),
  ADD KEY `IDNo` (`IDNo`);

--
-- Indexes for table `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`TenderID`),
  ADD KEY `Department` (`Department`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DeptID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tenderers`
--
ALTER TABLE `tenderers`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `TenderID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrators`
--
ALTER TABLE `administrators`
  ADD CONSTRAINT `administrators_ibfk_1` FOREIGN KEY (`AdminId`) REFERENCES `login` (`Idnum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`TenderID`) REFERENCES `tenders` (`TenderID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `heads`
--
ALTER TABLE `heads`
  ADD CONSTRAINT `heads_ibfk_1` FOREIGN KEY (`HeadID`) REFERENCES `login` (`Idnum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `heads_ibfk_2` FOREIGN KEY (`Department`) REFERENCES `departments` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenderers`
--
ALTER TABLE `tenderers`
  ADD CONSTRAINT `tenderers_ibfk_1` FOREIGN KEY (`IDNo`) REFERENCES `login` (`Idnum`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenders`
--
ALTER TABLE `tenders`
  ADD CONSTRAINT `tenders_ibfk_1` FOREIGN KEY (`Department`) REFERENCES `departments` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
