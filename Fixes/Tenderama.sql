-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 08:59 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

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
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`AdminId`, `Name`, `Email`, `Phone`) VALUES
('24245', 'Wallah Bin', 'wallah.bin@site.com', '0713009333');

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
  `Completion` date NOT NULL,
  `Amount` int(11) NOT NULL,
  `Location` varchar(254) NOT NULL,
  `Docs` varchar(254) NOT NULL,
  `Status` varchar(254) NOT NULL,
  `AppID` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`TenderID`, `TendererID`, `Name`, `Business`, `Position`, `Price`, `Completion`, `Amount`, `Location`, `Docs`, `Status`, `AppID`) VALUES
(1, '99460', '', '', '', 500000, '2018-10-07', 5000, 'Nakuru', '1-99460.pdf', 'ACCEPTED', 1),
(24, '100446', '', '', '', 700000, '2018-10-07', 90000, 'Nairobi', '24-100446.pdf', 'PENDING', 2),
(1, '100446', '', '', '', 1200000, '2018-10-11', 1000000, 'Mombasa', '1-100446.pdf', 'ACCEPTED', 3),
(28, '99460', '', '', '', 45000, '2018-10-07', 70000, 'Kisumu', '28-99460.pdf', 'REJECTED', 4),
(37, '100446', 'Ian Otieno Odundo', 'Mybiz', 'Manager', 12500, '2018-10-07', 120000, 'Ruai', '37-100446.pdf', 'COMPLETED', 5),
(2, '00000000', 'Sample User', 'SampleBiz', 'Role', 50, '2018-12-31', 5000, 'SampleLocation', '2-00000000.pdf', 'ACCEPTED', 6);

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
(3, 'Humanities', '17232'),
(4, 'Sciences', ''),
(5, 'Technical', ''),
(6, 'Economics', ''),
(7, 'Business', ''),
(8, 'Laboratory', '26565'),
(9, 'Administration', '3454'),
(10, 'Finance', '100998'),
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
('34545', 'Peninah Waswa Kimilili', 'kimilili.waswa@site.com', 'Administration', 713459568),
('100998', 'Junior Jr June', 'junior.jr@site.com', 'Finance', 735434343),
('17232', 'Carl Jeffreys', 'jeffery.carl@site.com', 'Humanities', 727654980),
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
('00000000', 'tenderer', 'sampleuser@site.com', '733c4cd94c25a0dbb7dee4cef261a597'),
('100446', 'tenderer', 'ian.odundo@site.com', 'a365f8ba2919dadc59f61c42713f1da4'),
('100998', 'department manager', 'junior.jr@site.com', '10f2243d0612a8335f55b8cc720124c6'),
('12345678', 'tenderer', 'maria.ogamba@site.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
('17232', 'department manager', 'jeffery.carl@site.com', '3b0c7e06b73cf8c7884e04a19b13db27'),
('24245', 'administrator', 'wallah.bin@site.com', '07ee56d0889335ae059e4821426c29ae'),
('26565', 'department manager', 'davidson.ridure@site.com', 'e0d7c82be78f17231deb18a7657997c9'),
('34545', 'department manager', 'kimilili.waswa@site.com', '2eb3dda841cdc61da88dfc34c2d910d9'),
('76593400', 'tenderer', 'kimotho.tomoko@site.com', 'a387911309a900737ea2f15b9260063c'),
('99460', 'tenderer', 'munyui.julie@site.com', 'c835c75647ab25c9fa081fdf1bb38c09');

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
(1, 'Ian Odundo', '100446', '0719653520', 'ian.odundo@site.com', 'Nairobi, Kenya', '12345-00100'),
(2, 'Julie Munyui', '99460', '0797652842', 'munyui.julie@site.com', 'Nakuru, Kenya', '45678-00400'),
(3, 'Kimotho Tomoko', '76593400', '0722789564', 'kimotho.tomoko@site.com', 'Kakamega, Kenya', '78954-00560'),
(9, 'Maria Ogamba', '12345678', '0712345678', 'maria.ogamba@site.com', 'Nairobi, Kenya', '12345-00100'),
(10, 'Sample User', '00000000', '0712345678', 'sampleuser@site.com', 'Locale X', '12345-00100');

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
  `Deaddate` date NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`TenderID`, `Name`, `Department`, `Requirements`, `Enquiries`, `Deaddate`, `Status`) VALUES
(1, 'Construction Materials', 'Administration', 'Supply of 10 bags of cement and 4 tonnes of sand.', '0713009333', '2018-09-18', 'AWARDED'),
(2, 'Call for Stationery', 'Languages', 'Supply of 2000 A4 square ruled notebooks.', '0719653520', '2018-09-30', 'PENDING'),
(22, 'Maize', 'Administration', 'Supply of 100 90kg bags of dried maize', '0797234562', '2019-01-25', 'COMPLETED'),
(24, 'Books', 'Sciences', 'Supply of 200 copies of the KCSE Made Familiar Workbook', '0734567338', '2019-07-12', 'PENDING'),
(25, 'Pencils', 'Economics', 'Supply of 500 HB leaded pencils', '0832456478', '2018-09-09', 'PENDING'),
(27, 'Thermometer', 'Laboratory', 'Supply of 50 thermometers made of Pyrex glass', '0712303090', '2018-09-09', 'COMPLETED'),
(28, 'Projectors', 'Administration', 'Supply of 5 Overhead Projector Units', '0713454567', '2018-09-09', 'COMPLETED'),
(29, 'Burretes', 'Laboratory', 'Supply of 20 burrettes made of Pyrex glass ', '0712303090', '2018-09-09', 'AWARDED'),
(35, 'Whiteboard', 'Administration', 'Supply of 2 large whiteboards and 12 boxes of 20pcs whiteboard markers.', '0712303090', '2018-10-30', 'PENDING'),
(36, 'Computers', 'Administration', 'Supply of 30 core i7 Lenovo full desktops with 4 GB available ram and 500 GB HDD.', '0713332244', '2018-10-24', 'COMPLETED'),
(37, 'Log Books', 'Administration', 'Supply of 4 Accounting Log Books', '0794432560', '2018-10-08', 'PENDING'),
(38, 'Erasers', 'Administration', 'Supply of 30 clean erase erasers', '0712303090', '2018-10-09', 'PENDING'),
(39, 'Mathematical Sets', 'Administration', 'Supply of 30 mathematical sets with all complete geometrical instruments', '0712303090', '2018-10-23', 'PENDING');

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
  ADD UNIQUE KEY `AppID_2` (`AppID`),
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
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `AppID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DeptID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tenderers`
--
ALTER TABLE `tenderers`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `TenderID` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
