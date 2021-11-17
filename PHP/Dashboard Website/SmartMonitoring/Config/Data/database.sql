CREATE DATABASE `rab_smartmon` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

use `rab_smartmon`;

CREATE TABLE `tbllokasi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lokasi_Name` varchar(100) NOT NULL,
  `Status` int(11) DEFAULT 1,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Lokasi_Name_UNIQUE` (`Lokasi_Name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tblmonitoring` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Lokasi_ID` int(11) NOT NULL,
  `Suhu_Udara` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Udara` decimal(20,2) DEFAULT NULL,
  `Suhu_Tanah` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Tanah` decimal(20,2) DEFAULT NULL,
  `Ketinggian_Air` decimal(20,2) DEFAULT NULL,
  `Last_Update` timestamp(6) NULL DEFAULT NULL,
  `Status_Lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`,`Lokasi_ID`),
  UNIQUE KEY `Lokasi_ID_UNIQUE` (`Lokasi_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tblmonitoring_his` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Update_Time` timestamp(6) NULL DEFAULT NULL,
  `Lokasi_ID` int(11) NOT NULL,
  `Suhu_Udara` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Udara` decimal(20,2) DEFAULT NULL,
  `Suhu_Tanah` decimal(20,2) DEFAULT NULL,
  `Kelembaban_Tanah` decimal(20,2) DEFAULT NULL,
  `Ketinggian_Air` decimal(20,2) DEFAULT NULL,
  `Status_Lokasi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

