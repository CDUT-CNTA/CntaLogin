-- phpMyAdmin SQL Dump
-- version 4.4.15.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-09-18 01:25:39
-- 服务器版本： 5.5.48-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CNTA`
--

-- --------------------------------------------------------

--
-- 表的结构 `cnta-member-2016`
--

CREATE TABLE IF NOT EXISTS `cnta-member-2016` (
  `mID` int(10) unsigned NOT NULL,
  `mStuID` bigint(12) NOT NULL,
  `mName` varchar(10) NOT NULL,
  `mSex` int(1) NOT NULL DEFAULT '0' COMMENT '1是男 0是女',
  `mDepart` varchar(50) NOT NULL,
  `mQQ` varchar(15) NOT NULL,
  `mPhone` varchar(15) NOT NULL,
  `mEmail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cnta-repair`
--

CREATE TABLE IF NOT EXISTS `cnta-repair` (
  `reID` int(10) unsigned NOT NULL,
  `reName` varchar(10) NOT NULL,
  `reStuID` bigint(12) NOT NULL,
  `reAddress` varchar(50) NOT NULL,
  `rePhone` varchar(15) NOT NULL,
  `reQQ` varchar(15) NOT NULL,
  `reIssue` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `cnta-web-login`
--

CREATE TABLE IF NOT EXISTS `cnta-web-login` (
  `logID` int(10) unsigned NOT NULL,
  `logEmail` varchar(25) NOT NULL,
  `logPwd` char(50) NOT NULL,
  `logName` varchar(25) NOT NULL,
  `logMemID` int(4) DEFAULT NULL,
  `logStuID` bigint(12) NOT NULL,
  `logPhone` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `emailConfirm` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cnta-member-2016`
--
ALTER TABLE `cnta-member-2016`
  ADD PRIMARY KEY (`mID`),
  ADD UNIQUE KEY `mStuID` (`mStuID`);

--
-- Indexes for table `cnta-repair`
--
ALTER TABLE `cnta-repair`
  ADD PRIMARY KEY (`reID`);

--
-- Indexes for table `cnta-web-login`
--
ALTER TABLE `cnta-web-login`
  ADD PRIMARY KEY (`logID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cnta-member-2016`
--
ALTER TABLE `cnta-member-2016`
  MODIFY `mID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cnta-repair`
--
ALTER TABLE `cnta-repair`
  MODIFY `reID` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cnta-web-login`
--
ALTER TABLE `cnta-web-login`
  MODIFY `logID` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
