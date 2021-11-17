-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2021 at 08:20 AM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rab_smartmon`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `rangedateinweeks`
--
CREATE TABLE IF NOT EXISTS `rangedateinweeks` (
`date_1` datetime
,`date_2` datetime
,`date_3` datetime
,`date_4` datetime
,`date_5` datetime
,`date_6` datetime
,`date_7` datetime
);
-- --------------------------------------------------------

--
-- Table structure for table `tbllokasi`
--

CREATE TABLE IF NOT EXISTS `tbllokasi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lokasi_Name` varchar(100) NOT NULL,
  `Status` int(11) DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Lokasi_Name_UNIQUE` (`Lokasi_Name`),
  UNIQUE KEY `Lokasi_Name` (`Lokasi_Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbllokasi`
--

INSERT INTO `tbllokasi` (`ID`, `Lokasi_Name`, `Status`) VALUES
(1, 'Cibinong', 1),
(2, 'Ujung Batu', 1),
(3, 'Duri', 1),
(4, 'Dumai', 1),
(5, 'data baru', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmonitoring`
--

CREATE TABLE IF NOT EXISTS `tblmonitoring` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lokasi_ID` int(11) NOT NULL,
  `Suhu_Udara` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Udara` decimal(20,2) DEFAULT NULL,
  `Suhu_Tanah` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Tanah` decimal(20,2) DEFAULT NULL,
  `Ketinggian_Air` decimal(20,2) DEFAULT NULL,
  `Last_Update` timestamp NULL DEFAULT NULL,
  `Status_Lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`,`Lokasi_ID`),
  UNIQUE KEY `Lokasi_ID_UNIQUE` (`Lokasi_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblmonitoring`
--

INSERT INTO `tblmonitoring` (`ID`, `Lokasi_ID`, `Suhu_Udara`, `Kelembaban_Udara`, `Suhu_Tanah`, `Kelembaban_Tanah`, `Ketinggian_Air`, `Last_Update`, `Status_Lokasi`) VALUES
(4, 1, 30.25, 30.00, 40.53, 10.00, 30.00, '2021-11-14 16:41:53', 'AMAN');

-- --------------------------------------------------------

--
-- Table structure for table `tblmonitoring_his`
--

CREATE TABLE IF NOT EXISTS `tblmonitoring_his` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Update_Time` timestamp NULL DEFAULT NULL,
  `Lokasi_ID` int(11) NOT NULL,
  `Suhu_Udara` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Udara` decimal(20,2) DEFAULT NULL,
  `Suhu_Tanah` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Tanah` decimal(20,2) DEFAULT NULL,
  `Ketinggian_Air` decimal(20,2) DEFAULT NULL,
  `Status_Lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblmonitoring_his`
--

INSERT INTO `tblmonitoring_his` (`ID`, `Update_Time`, `Lokasi_ID`, `Suhu_Udara`, `Kelembaban_Udara`, `Suhu_Tanah`, `Kelembaban_Tanah`, `Ketinggian_Air`, `Status_Lokasi`) VALUES
(1, '2021-11-12 22:34:57', 1, 20.00, 30.00, 40.00, 10.00, 30.00, 'AMAN'),
(2, '2021-11-12 22:37:05', 1, 20.00, 30.00, 40.00, 20.00, 30.00, 'AMAN'),
(3, '2021-11-12 22:37:42', 1, 20.00, 30.00, 0.00, 0.00, 40.00, 'AMAN'),
(4, '2021-11-12 22:39:46', 1, 20.00, 30.00, 40.00, 10.00, 30.00, 'NORMAL'),
(5, '2021-11-12 22:40:17', 1, 20.00, 30.00, 40.00, 20.00, 30.00, 'NORMAL'),
(6, '2021-11-12 22:42:27', 1, 20.00, 30.00, 40.00, 10.00, 30.00, 'AMAN'),
(7, '2021-11-12 22:42:47', 1, 1.00, 30.00, 40.00, 10.00, 30.00, 'AMAN'),
(8, '2021-11-12 22:43:11', 1, 30.00, 30.00, 40.00, 10.00, 30.00, 'AMAN'),
(9, '2021-11-12 22:43:22', 1, 30.25, 30.00, 40.00, 10.00, 30.00, 'AMAN'),
(10, '2021-11-14 16:41:53', 1, 30.25, 30.00, 40.53, 10.00, 30.00, 'AMAN');

-- --------------------------------------------------------

--
-- Structure for view `rangedateinweeks`
--
DROP TABLE IF EXISTS `rangedateinweeks`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rangedateinweeks` AS select (case when (dayofweek(sysdate()) = 1) then (sysdate() - interval 6 day) when (dayofweek(sysdate()) = 2) then sysdate() when (dayofweek(sysdate()) = 3) then (sysdate() - interval 1 day) when (dayofweek(sysdate()) = 4) then (sysdate() - interval 2 day) when (dayofweek(sysdate()) = 5) then (sysdate() - interval 3 day) when (dayofweek(sysdate()) = 6) then (sysdate() - interval 4 day) when (dayofweek(sysdate()) = 7) then (sysdate() - interval 5 day) end) AS `date_1`,(case when (dayofweek(sysdate()) = 1) then (sysdate() - interval 5 day) when (dayofweek(sysdate()) = 2) then (sysdate() + interval 1 day) when (dayofweek(sysdate()) = 3) then sysdate() when (dayofweek(sysdate()) = 4) then (sysdate() - interval 1 day) when (dayofweek(sysdate()) = 5) then (sysdate() - interval 2 day) when (dayofweek(sysdate()) = 6) then (sysdate() - interval 3 day) when (dayofweek(sysdate()) = 7) then (sysdate() - interval 4 day) end) AS `date_2`,(case when (dayofweek(sysdate()) = 1) then (sysdate() - interval 4 day) when (dayofweek(sysdate()) = 2) then (sysdate() + interval 2 day) when (dayofweek(sysdate()) = 3) then (sysdate() + interval 1 day) when (dayofweek(sysdate()) = 4) then sysdate() when (dayofweek(sysdate()) = 5) then (sysdate() - interval 1 day) when (dayofweek(sysdate()) = 6) then (sysdate() - interval 2 day) when (dayofweek(sysdate()) = 7) then (sysdate() - interval 3 day) end) AS `date_3`,(case when (dayofweek(sysdate()) = 1) then (sysdate() - interval 3 day) when (dayofweek(sysdate()) = 2) then (sysdate() + interval 3 day) when (dayofweek(sysdate()) = 3) then (sysdate() + interval 2 day) when (dayofweek(sysdate()) = 4) then (sysdate() + interval 1 day) when (dayofweek(sysdate()) = 5) then sysdate() when (dayofweek(sysdate()) = 6) then (sysdate() - interval 1 day) when (dayofweek(sysdate()) = 7) then (sysdate() - interval 2 day) end) AS `date_4`,(case when (dayofweek(sysdate()) = 1) then (sysdate() - interval 2 day) when (dayofweek(sysdate()) = 2) then (sysdate() + interval 4 day) when (dayofweek(sysdate()) = 3) then (sysdate() + interval 3 day) when (dayofweek(sysdate()) = 4) then (sysdate() + interval 2 day) when (dayofweek(sysdate()) = 5) then (sysdate() + interval 1 day) when (dayofweek(sysdate()) = 6) then sysdate() when (dayofweek(sysdate()) = 7) then (sysdate() - interval 1 day) end) AS `date_5`,(case when (dayofweek(sysdate()) = 1) then (sysdate() - interval 1 day) when (dayofweek(sysdate()) = 2) then (sysdate() + interval 5 day) when (dayofweek(sysdate()) = 3) then (sysdate() + interval 4 day) when (dayofweek(sysdate()) = 4) then (sysdate() + interval 3 day) when (dayofweek(sysdate()) = 5) then (sysdate() + interval 2 day) when (dayofweek(sysdate()) = 6) then (sysdate() + interval 1 day) when (dayofweek(sysdate()) = 7) then sysdate() end) AS `date_6`,(case when (dayofweek(sysdate()) = 1) then sysdate() when (dayofweek(sysdate()) = 2) then (sysdate() + interval 6 day) when (dayofweek(sysdate()) = 3) then (sysdate() + interval 5 day) when (dayofweek(sysdate()) = 4) then (sysdate() + interval 4 day) when (dayofweek(sysdate()) = 5) then (sysdate() + interval 3 day) when (dayofweek(sysdate()) = 6) then (sysdate() + interval 2 day) when (dayofweek(sysdate()) = 7) then (sysdate() + interval 1 day) end) AS `date_7`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
