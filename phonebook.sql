-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2017 at 06:45 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_phonebook`
--

CREATE TABLE `tb_phonebook` (
  `id_phonebook` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `ranks` varchar(45) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `home` varchar(25) DEFAULT NULL,
  `remarrk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_phonebook`
--

INSERT INTO `tb_phonebook` (`id_phonebook`, `firstname`, `lastname`, `ranks`, `position`, `department`, `tel`, `home`, `remarrk`) VALUES
(13, 'àº„àº¹àº§àº½àº‡', 'àº„à»àº²àºˆàº±àº™àº§àº»àº‡', 'àºžàº±àº™à»€àº­àº', 'à»„àº­àº—àºµ', 'àºàº­àº‡àº®à»‰àº­àºII', '0209954593', '0309557573', NULL),
(14, 'àº‚àº²àº§àº—àº­àº‡', 'àºˆàº±àº™àº—àº°àº§àº»àº‡', 'àºªàº´àºšà»€àº­àº', 'àºàº³àº¥àº±àº‡àºžàº»àº™', 'àº‡à»799', '02099535796', '0309667563', NULL),
(15, 'àº—àº­àº‡àºžàº±àº™', 'àº—àº³àº¡àº°àº§àº»àº‡', 'àºžàº±àº™àº•àºµ', 'àº«àº»àº§à»œà»‰àº²àºàº²àº™à»€àº¡àº·àº­àº‡', 'àºàº­àº‡àºžàº±àº™à»ƒàº«àºà»ˆ987', '02099325796', '0309774356', NULL),
(16, 'àºžàº­àº™àºªàº°àº«àº§àº±àº™', 'àº—àº³àº¡àº°àº§àº»àº‡', 'àºžàº±àº™àº•àºµ', 'àº«àº»àº§à»œà»‰àº²àºàº²àº™à»€àº¡àº·àº­àº‡', 'àºàº­àº‡àºžàº±àº™983', '02098532456', '0309557362', NULL),
(17, 'àº—à»ˆàº²àº™ àº§àº»àº‡àºžàº­àº™', 'àº¡àºµà»„àºŠàºžàº­àº™', 'àº®à»‰àº­àºà»€àº­àº', 'àº«àº»àº§à»œà»‰àº²àºàº²àº™à»€àº‡àºµàº™', 'àºàº­àº‡àº®à»‰àº­àºI', '02098532457', '0309557364', NULL),
(18, 'àºšàº»àº§àº¥àº²', 'àºžàº­àº™à»„àºŠ', 'àº§àº²àº—àºµ', 'àºàº°à»€àºªàº”', 'àºàº­àº‡àº®à»‰àº­àº II', '02098532459', '0309557361', NULL),
(19, 'àº§àº±àº™à»„àºŠ', 'àºªàº»àº¡àºªàº¸àº', 'àº®à»‰àº­àºàº•àºµ', 'àº™àº±àºàº‚à»ˆàº²àº§', 'àºàº­àº‡àºžàº±àº™à»ƒàº«àºà»ˆ', '02098532454', '0309554362', NULL),
(20, 'àº™àº±àº™àº—àº´à»€àºªàº™', 'àº™àº²àº¡àº­àº²àº™àº¸', 'àºªàº´àºšà»‚àº—', 'àº‚àº±àºšàº¥àº»àº”', 'àºàº­àº‡àº®à»‰àº­àºàº¥àº»àº”', '02098532356', '0309557352', NULL),
(22, 'àº™àº²àº‡ àº™àº°àº§àº»àº‡', 'àºˆàº±àº™à»‚àºªàºžàº²', 'àº§àº²àº—àºµ', 'àº®àº±àºšà»àº‚àº', 'àºàº­àº‡àº®à»‰àº­àº I', '02098552452', '0309554342', NULL),
(24, 'àº§àº­àº™à»„àºŠ', 'àº—àº°àº¡àº°à»‚àº™', 'àº®à»‰àº­àºàº•à»€àº­àº', 'àºàº²àº™à»€àº„àº·àº­àº‡', 'àºàº­àº‡àº®à»‰àº­àº II', '02097532456', '0309857362', NULL),
(25, 'àºžàº­àº™àº§àº±àº™', 'àº—àº±àº”àºªàº°àºžàº­àº™', 'àº®à»‰àº­àºà»€àº­àº', 'àºšàº±àº™àºŠàºµ', 'àºàº­àº‡àºžàº±àº™à»ƒàº«àºà»ˆ 983', '02098532476', '0309557962', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `username_login` varchar(45) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `user_level` enum('admin','user') NOT NULL DEFAULT 'user',
  `user_registered` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `username_login`, `user_password`, `user_level`, `user_registered`, `last_login`) VALUES
(61, 'admin', '1234', 'admin', '2017-07-28 19:12:31', '0000-00-00 00:00:00'),
(62, 'user', '123', 'user', '2017-07-29 12:50:10', NULL),
(64, 'sommaiy', '1234', 'admin', '2017-07-29 12:50:24', NULL),
(66, 'thongdee', '1234', 'admin', '2017-07-29 12:50:35', NULL),
(67, 'somphone', '1234', 'admin', '2017-07-29 12:50:40', NULL),
(69, 'saiphone', '1234', 'user', '2017-07-29 12:50:49', NULL),
(70, 'khouvieng', '1234', 'user', '2017-07-29 12:50:54', NULL),
(75, 'inthavong', '1234', 'admin', '2017-08-01 15:39:57', NULL),
(76, 'sany', '4566', 'admin', '2017-08-04 14:38:06', NULL),
(77, 'addee', '41444', 'admin', '2017-08-04 14:41:51', NULL),
(78, 'vansy', '78585', 'user', '2017-08-04 14:43:21', NULL),
(80, 'mmy', '4523523', 'user', '2017-08-12 11:37:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_phonebook`
--
ALTER TABLE `tb_phonebook`
  ADD PRIMARY KEY (`id_phonebook`),
  ADD UNIQUE KEY `firstname_UNIQUE` (`firstname`),
  ADD UNIQUE KEY `home_UNIQUE` (`home`),
  ADD UNIQUE KEY `tel_UNIQUE` (`tel`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `username_login_UNIQUE` (`username_login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_phonebook`
--
ALTER TABLE `tb_phonebook`
  MODIFY `id_phonebook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
