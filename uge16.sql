-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2014 at 10:26 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uge16`
--
CREATE DATABASE IF NOT EXISTS `uge16` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `uge16`;

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE IF NOT EXISTS `account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `type`, `active`) VALUES
(1, 'administrator', 1),
(2, 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `additional_measure_types_in_analyzers_for_alarm_types`
--

CREATE TABLE IF NOT EXISTS `additional_measure_types_in_analyzers_for_alarm_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alarm_types_for_measure_types_in_analyzers_id` int(11) NOT NULL,
  `measure_types_in_analyzers_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `alarm_types_for_measure_types_in_analyzers_id` (`alarm_types_for_measure_types_in_analyzers_id`),
  KEY `measure_types_in_analyzers_id` (`measure_types_in_analyzers_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alarms_for_measure_types_in_analyzers`
--

CREATE TABLE IF NOT EXISTS `alarms_for_measure_types_in_analyzers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alarm_types_for_measure_types_in_analyzers_id` int(11) NOT NULL,
  `original_time` datetime NOT NULL,
  `original_time_ms` int(3) NOT NULL,
  `receive_time` datetime NOT NULL,
  `receive_time_ms` int(3) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `alarm_types_for_measure_types_in_analyzers_id` (`alarm_types_for_measure_types_in_analyzers_id`),
  KEY `original_time` (`original_time`),
  KEY `original_time_ms` (`original_time_ms`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alarm_measures`
--

CREATE TABLE IF NOT EXISTS `alarm_measures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alarms_for_measure_types_in_analyzers_id` int(11) NOT NULL,
  `original_time` datetime NOT NULL,
  `original_time_ms` int(3) NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alarms_for_measure_types_in_analyzers_id` (`alarms_for_measure_types_in_analyzers_id`),
  KEY `original_time` (`original_time`),
  KEY `original_time_ms` (`original_time_ms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alarm_types`
--

CREATE TABLE IF NOT EXISTS `alarm_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(100) COLLATE utf8_bin NOT NULL,
  `name_sr` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alarm_types_for_measure_types_in_analyzers`
--

CREATE TABLE IF NOT EXISTS `alarm_types_for_measure_types_in_analyzers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `measure_types_in_analyzers_id` int(11) NOT NULL,
  `alarm_types_id` int(11) NOT NULL,
  `alarm_level` float DEFAULT NULL,
  `alarm_high_flag` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `measure_types_in_analyzers_id` (`measure_types_in_analyzers_id`),
  KEY `alarm_types_id` (`alarm_types_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `alarm_types_for_measure_types_in_analyzer_types`
--

CREATE TABLE IF NOT EXISTS `alarm_types_for_measure_types_in_analyzer_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alarm_types_id` int(11) NOT NULL,
  `measure_types_in_analyzer_types_id` int(11) NOT NULL,
  `modbus_alarm_state_function` char(2) COLLATE utf8_bin NOT NULL,
  `modbus_alarm_state_register` int(5) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `alarm_types_id` (`alarm_types_id`),
  KEY `measure_types_in_analyzer_types_id` (`measure_types_in_analyzer_types_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `analyzers`
--

CREATE TABLE IF NOT EXISTS `analyzers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `comment` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `modbus_slave_address` char(2) COLLATE utf8_bin NOT NULL,
  `current_measure_period` int(11) NOT NULL,
  `long_message_period` int(11) NOT NULL,
  `short_message_period` int(11) NOT NULL,
  `alarm_measure_period` int(11) DEFAULT NULL,
  `measures_before_alarm` int(3) NOT NULL,
  `hubs_id` int(11) NOT NULL,
  `input_position` tinyint(2) DEFAULT NULL,
  `customers_id` int(11) NOT NULL,
  `analyzer_types_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `modbus_address` (`modbus_slave_address`),
  KEY `hubs_id` (`hubs_id`),
  KEY `customers_id` (`customers_id`),
  KEY `analyzer_types_id` (`analyzer_types_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `analyzers`
--

INSERT INTO `analyzers` (`id`, `name`, `description`, `comment`, `modbus_slave_address`, `current_measure_period`, `long_message_period`, `short_message_period`, `alarm_measure_period`, `measures_before_alarm`, `hubs_id`, `input_position`, `customers_id`, `analyzer_types_id`, `active`) VALUES
(1, 'analizator_49', NULL, NULL, '01', 20, 900, 60, 0, 0, 1, NULL, 1, 1, 1),
(2, 'analizator_50', NULL, NULL, '01', 20, 900, 60, 0, 0, 2, NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `analyzer_types`
--

CREATE TABLE IF NOT EXISTS `analyzer_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `alarm_output_signal` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `analyzer_types`
--

INSERT INTO `analyzer_types` (`id`, `name`, `description`, `alarm_output_signal`, `active`) VALUES
(1, 'Schrack...', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `address` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `contact_person` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `contact_email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `contact_address` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `contact_phone` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `logo_image` blob,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `contact_person`, `contact_email`, `contact_address`, `contact_phone`, `logo_image`, `active`) VALUES
(1, 'Eko Pak', 'Ulica BB, 18000 Niš', 'Mišić', NULL, NULL, NULL, NULL, 1),
(2, 'Konstantin', 'dawwad', 'koki', 'dawdaw@adsa.com', NULL, '020310231', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hubs`
--

CREATE TABLE IF NOT EXISTS `hubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `comment` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  `postal_address` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `latitude` decimal(12,8) DEFAULT NULL,
  `longitude` decimal(12,8) DEFAULT NULL,
  `interface_type` varchar(30) COLLATE utf8_bin NOT NULL,
  `ip_address` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `port` varchar(10) COLLATE utf8_bin NOT NULL,
  `rc_address` int(5) NOT NULL,
  `serial_port_speed` int(8) NOT NULL DEFAULT '9600',
  `serial_port_parity` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'N',
  `serial_port_stop_bits` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `interface_type` (`interface_type`),
  KEY `ip_address` (`ip_address`),
  KEY `port` (`port`),
  KEY `rc_address` (`rc_address`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `hubs`
--

INSERT INTO `hubs` (`id`, `name`, `description`, `comment`, `postal_address`, `latitude`, `longitude`, `interface_type`, `ip_address`, `port`, `rc_address`, `serial_port_speed`, `serial_port_parity`, `serial_port_stop_bits`, `active`) VALUES
(1, 'koncentrator_49', NULL, NULL, NULL, NULL, NULL, 'UDP', '172.27.126.49', '9000', 1, 9600, 'N', 1, 1),
(2, 'koncentrator_50', NULL, NULL, NULL, NULL, NULL, 'UDP', '172.27.126.50', '9000', 2, 9600, 'N', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hub_resets`
--

CREATE TABLE IF NOT EXISTS `hub_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hubs_id` int(11) NOT NULL,
  `type` int(3) NOT NULL,
  `original_time` datetime NOT NULL,
  `original_time_ms` int(3) NOT NULL,
  `receive_time` datetime NOT NULL,
  `receive_time_ms` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hubs_id` (`hubs_id`),
  KEY `type` (`type`),
  KEY `original_time` (`original_time`),
  KEY `original_time_ms` (`original_time_ms`),
  KEY `receive_time` (`receive_time`),
  KEY `receive_time_ms` (`receive_time_ms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `measures`
--

CREATE TABLE IF NOT EXISTS `measures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `measure_types_in_analyzers_id` int(11) NOT NULL,
  `scheduled` tinyint(1) NOT NULL DEFAULT '0',
  `original_time` datetime NOT NULL,
  `original_time_ms` int(3) NOT NULL,
  `analyzer_time` datetime NOT NULL,
  `receive_time` datetime NOT NULL,
  `receive_time_ms` int(3) NOT NULL,
  `value` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `measure_types_in_analyzers_id` (`measure_types_in_analyzers_id`),
  KEY `scheduled` (`scheduled`),
  KEY `original_time` (`original_time`),
  KEY `original_time_ms` (`original_time_ms`),
  KEY `analyzer_time` (`analyzer_time`),
  KEY `value` (`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `measure_types`
--

CREATE TABLE IF NOT EXISTS `measure_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(100) COLLATE utf8_bin NOT NULL,
  `name_sr` varchar(100) COLLATE utf8_bin NOT NULL,
  `unit` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=37 ;

--
-- Dumping data for table `measure_types`
--

INSERT INTO `measure_types` (`id`, `name_en`, `name_sr`, `unit`, `active`) VALUES
(1, 'Voltage Line 1', 'Napon 1', 'V', 1),
(2, 'Voltage Line 2', 'Napon 2', 'V', 1),
(3, 'Voltage Line 3', 'Napon 3', 'V', 1),
(4, 'Current in Line 1', 'Struja 1', 'A', 1),
(5, 'Current in Line 2', 'Struja 2', 'A', 1),
(6, 'Current in Line 3', 'Struja 3', 'A', 1),
(7, 'Active Power Line 1', 'Aktivna snaga 1', 'W', 1),
(8, 'Active Power Line 2', 'Aktivna snaga 2', 'W', 1),
(9, 'Active Power Line 3', 'Aktivna snaga 3', 'W', 1),
(10, 'Combined Active Power Line 1+2+3', 'Kombinovana aktivna snaga 1+2+3', 'W', 1),
(11, 'Reactive Power Line 1', 'Reaktivna snaga 1', 'VAR', 1),
(12, 'Reactive Power Line 2', 'Reaktivna snaga 2', 'VAR', 1),
(13, 'Reactive Power Line 3', 'Reaktivna snaga 3', 'VAR', 1),
(14, 'Combined Reactive Power Line 1+2+3', 'Kombinovana reaktivna snaga 1+2+3', 'VAR', 1),
(15, 'Power Factor Line 1', 'Faktor snage 1', NULL, 1),
(16, 'Power Factor Line 2', 'Faktor snage 2', NULL, 1),
(17, 'Power Factor Line 3', 'Faktor snage 3', NULL, 1),
(18, 'Combined Power Factor for Line 1+2+3', 'Kombinovani faktor snage 1+2+3', NULL, 1),
(19, 'Frequency Line 1', 'Frekvencija', 'Hz', 1),
(20, 'Active Total Energy', 'Ukupna aktivna energija', 'Wh', 1),
(21, 'Reactive Total Energy', 'Ukupna reaktivna energija', 'VARh', 1),
(22, 'Apparent Total Energy', 'Ukupna prividna energija', 'VAh', 1),
(23, 'Date Time', 'Vreme', NULL, 1),
(24, 'THD for Volts Line 1', 'THD za napon 1', NULL, 1),
(25, 'THD for Volts Line 2', 'THD za napon 2', NULL, 1),
(26, 'THD for Volts Line 3', 'THD za napon 3', NULL, 1),
(27, 'THD for Current Line 1', 'THD za struju 1', NULL, 1),
(28, 'THD for Current Line 2', 'THD za struju 2', NULL, 1),
(29, 'THD for Current Line 3', 'THD za struju 3', NULL, 1),
(30, 'Demand – KW Max (Watt)', '', 'W', 1),
(31, 'Demand – PF (KW)', '', 'KW', 1),
(32, 'Demand – Date (KW)', '', NULL, 1),
(33, 'Demand – KVA (Watt)', '', 'W', 1),
(34, 'Demand – PF (KVA)', '', 'KVA', 1),
(35, 'Demand – Date (KVA)', '', 'KVA', 1),
(36, 'Koki', 'Koky', 'K', 1);

-- --------------------------------------------------------

--
-- Table structure for table `measure_types_in_analyzers`
--

CREATE TABLE IF NOT EXISTS `measure_types_in_analyzers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `analyzers_id` int(11) NOT NULL,
  `measure_types_id` int(11) NOT NULL,
  `long_message_position` int(3) DEFAULT NULL,
  `short_message_position` int(3) DEFAULT NULL,
  `current_message_position` int(3) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `analyzers_id` (`analyzers_id`),
  KEY `measure_types_id` (`measure_types_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=71 ;

--
-- Dumping data for table `measure_types_in_analyzers`
--

INSERT INTO `measure_types_in_analyzers` (`id`, `analyzers_id`, `measure_types_id`, `long_message_position`, `short_message_position`, `current_message_position`, `active`) VALUES
(1, 1, 1, 1, 1, NULL, 1),
(2, 1, 2, 2, NULL, NULL, 1),
(3, 1, 3, 3, NULL, NULL, 1),
(4, 1, 4, 4, 2, NULL, 1),
(5, 1, 5, 5, NULL, NULL, 1),
(6, 1, 6, 6, NULL, NULL, 1),
(7, 1, 7, 7, NULL, NULL, 1),
(8, 1, 8, 8, NULL, NULL, 1),
(9, 1, 9, 9, NULL, NULL, 1),
(10, 1, 10, 10, 3, NULL, 1),
(11, 1, 11, 11, NULL, NULL, 1),
(12, 1, 12, 12, NULL, NULL, 1),
(13, 1, 13, 13, NULL, NULL, 1),
(14, 1, 14, 14, NULL, NULL, 1),
(15, 1, 15, 15, NULL, NULL, 1),
(16, 1, 16, 16, NULL, NULL, 1),
(17, 1, 17, 17, NULL, NULL, 1),
(18, 1, 18, 18, NULL, NULL, 1),
(19, 1, 19, 19, NULL, NULL, 1),
(20, 1, 20, 20, 4, NULL, 1),
(21, 1, 21, 21, 5, NULL, 1),
(22, 1, 22, 22, NULL, NULL, 1),
(23, 1, 23, 23, NULL, NULL, 1),
(24, 1, 24, 24, NULL, NULL, 1),
(25, 1, 25, 25, NULL, NULL, 1),
(26, 1, 26, 26, NULL, NULL, 1),
(27, 1, 27, 27, NULL, NULL, 1),
(28, 1, 28, 28, NULL, NULL, 1),
(29, 1, 29, 29, NULL, NULL, 1),
(30, 1, 30, 30, NULL, NULL, 1),
(31, 1, 31, 31, NULL, NULL, 1),
(32, 1, 32, 32, NULL, NULL, 1),
(33, 1, 33, 33, NULL, NULL, 1),
(34, 1, 34, 34, NULL, NULL, 1),
(35, 1, 35, 35, NULL, NULL, 1),
(36, 2, 1, 1, 1, NULL, 1),
(37, 2, 2, 2, NULL, NULL, 1),
(38, 2, 3, 3, NULL, NULL, 1),
(39, 2, 4, 4, 2, NULL, 1),
(40, 2, 5, 5, NULL, NULL, 1),
(41, 2, 6, 6, NULL, NULL, 1),
(42, 2, 7, 7, NULL, NULL, 1),
(43, 2, 8, 8, NULL, NULL, 1),
(44, 2, 9, 9, NULL, NULL, 1),
(45, 2, 10, 10, 3, NULL, 1),
(46, 2, 11, 11, NULL, NULL, 1),
(47, 2, 12, 12, NULL, NULL, 1),
(48, 2, 13, 13, NULL, NULL, 1),
(49, 2, 14, 14, NULL, NULL, 1),
(50, 2, 15, 15, NULL, NULL, 1),
(51, 2, 16, 16, NULL, NULL, 1),
(52, 2, 17, 17, NULL, NULL, 1),
(53, 2, 18, 18, NULL, NULL, 1),
(54, 2, 19, 19, NULL, NULL, 1),
(55, 2, 20, 20, 4, NULL, 1),
(56, 2, 21, 21, 5, NULL, 1),
(57, 2, 22, 22, NULL, NULL, 1),
(58, 2, 23, 23, NULL, NULL, 1),
(59, 2, 24, 24, NULL, NULL, 1),
(60, 2, 25, 25, NULL, NULL, 1),
(61, 2, 26, 26, NULL, NULL, 1),
(62, 2, 27, 27, NULL, NULL, 1),
(63, 2, 28, 28, NULL, NULL, 1),
(64, 2, 29, 29, NULL, NULL, 1),
(65, 2, 30, 30, NULL, NULL, 1),
(66, 2, 31, 31, NULL, NULL, 1),
(67, 2, 32, 32, NULL, NULL, 1),
(68, 2, 33, 33, NULL, NULL, 1),
(69, 2, 34, 34, NULL, NULL, 1),
(70, 2, 35, 35, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `measure_types_in_analyzer_types`
--

CREATE TABLE IF NOT EXISTS `measure_types_in_analyzer_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `measure_types_id` int(11) NOT NULL,
  `analyzer_types_id` int(11) NOT NULL,
  `modbus_measure_function` char(2) COLLATE utf8_bin NOT NULL,
  `modbus_measure_register` int(5) NOT NULL,
  `coefficient_of_proportionality` float NOT NULL DEFAULT '1',
  `offset` float NOT NULL DEFAULT '0',
  `threshold` float NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `measure_types_id` (`measure_types_id`),
  KEY `analyzer_types_id` (`analyzer_types_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `measure_types_in_analyzer_types`
--

INSERT INTO `measure_types_in_analyzer_types` (`id`, `measure_types_id`, `analyzer_types_id`, `modbus_measure_function`, `modbus_measure_register`, `coefficient_of_proportionality`, `offset`, `threshold`, `active`) VALUES
(1, 24, 1, '1', 1, 1, 0, 0, 1),
(2, 25, 1, '1', 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modbus_querys`
--

CREATE TABLE IF NOT EXISTS `modbus_querys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `analyzers_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `time_ms` int(3) NOT NULL,
  `comment` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `function` char(2) COLLATE utf8_bin NOT NULL,
  `data_bytes` varchar(250) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `analyzers_id` (`analyzers_id`),
  KEY `users_id` (`users_id`),
  KEY `time` (`time`),
  KEY `time_ms` (`time_ms`),
  KEY `function` (`function`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

--
-- Dumping data for table `modbus_querys`
--

INSERT INTO `modbus_querys` (`id`, `analyzers_id`, `users_id`, `time`, `time_ms`, `comment`, `function`, `data_bytes`) VALUES
(5, 1, 2, '0000-00-00 00:00:00', 0, 'komentar', '04', '0000 0134 4431');

-- --------------------------------------------------------

--
-- Table structure for table `modbus_responses`
--

CREATE TABLE IF NOT EXISTS `modbus_responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modbus_querys_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `time_ms` int(3) NOT NULL DEFAULT '1',
  `function` char(2) COLLATE utf8_bin NOT NULL,
  `data_bytes` varchar(250) COLLATE utf8_bin NOT NULL,
  `comment` varchar(1000) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modbus_querys_id` (`modbus_querys_id`),
  KEY `time` (`time`),
  KEY `time_ms` (`time_ms`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `parameters`
--

CREATE TABLE IF NOT EXISTS `parameters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `description` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `value` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `parameters`
--

INSERT INTO `parameters` (`id`, `name`, `description`, `value`) VALUES
(1, 'DatabaseVersion', NULL, '1.6'),
(2, 'CenterRCAddress', NULL, '255'),
(3, 'LocalUDPPort', NULL, '9000'),
(4, 'DetailedLog', NULL, '1'),
(5, 'LogFilePath', NULL, 'c:'),
(6, 'PauseBeforeAskingMeasure', NULL, '5000'),
(7, 'HoursForKeepingOldMeasures', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `signals`
--

CREATE TABLE IF NOT EXISTS `signals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `signal_types_in_hubs_id` int(11) NOT NULL,
  `original_time` datetime NOT NULL,
  `original_time_ms` int(3) NOT NULL,
  `receive_time` datetime NOT NULL,
  `receive_time_ms` int(3) NOT NULL,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `signal_types_in_hubs_id` (`signal_types_in_hubs_id`),
  KEY `original_time` (`original_time`),
  KEY `original_time_ms` (`original_time_ms`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `signal_types`
--

CREATE TABLE IF NOT EXISTS `signal_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_en` varchar(100) COLLATE utf8_bin NOT NULL,
  `name_sr` varchar(100) COLLATE utf8_bin NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `signal_types_in_hubs`
--

CREATE TABLE IF NOT EXISTS `signal_types_in_hubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hubs_id` int(11) NOT NULL,
  `signal_types_id` int(11) NOT NULL,
  `input_position` int(11) NOT NULL,
  `negative_logic` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `hubs_id` (`hubs_id`),
  KEY `signal_types_id` (`signal_types_id`),
  KEY `input_position` (`input_position`),
  KEY `active` (`active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `contact_email` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `contact_sms` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `image` blob,
  `username` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `account_types_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `customers_id` (`customers_id`),
  KEY `name` (`name`),
  KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `account_types_id` (`account_types_id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `customers_id`, `name`, `contact_email`, `contact_sms`, `image`, `username`, `password`, `account_types_id`, `active`) VALUES
(1, 1, 'NT Soft', NULL, NULL, NULL, 'ivan', 'a15f8b81a160b4eebe5c84e9e3b65c87b9b2f18e', 1, 1),
(2, 1, 'admin', 'admin', 'admin', NULL, 'admin', '$2y$10$6A/0Y16tbUaTiT26eFFX8O4NMIIq512aK7viChj7Ffm8mUP1PgFxe', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_schedule`
--

CREATE TABLE IF NOT EXISTS `users_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `month` tinyint(2) DEFAULT NULL,
  `day_of_the_month` tinyint(2) DEFAULT NULL,
  `day_of_the_week` tinyint(1) DEFAULT NULL,
  `begin_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '23:59:59',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_measure_types_in_analyzers_for_alarm_types`
--
ALTER TABLE `additional_measure_types_in_analyzers_for_alarm_types`
  ADD CONSTRAINT `additional_measure_types_in_analyzers_for_alarm_types_ibfk_1` FOREIGN KEY (`alarm_types_for_measure_types_in_analyzers_id`) REFERENCES `alarm_types_for_measure_types_in_analyzers` (`id`),
  ADD CONSTRAINT `additional_measure_types_in_analyzers_for_alarm_types_ibfk_2` FOREIGN KEY (`measure_types_in_analyzers_id`) REFERENCES `measure_types_in_analyzers` (`id`);

--
-- Constraints for table `alarms_for_measure_types_in_analyzers`
--
ALTER TABLE `alarms_for_measure_types_in_analyzers`
  ADD CONSTRAINT `alarms_for_measure_types_in_analyzers_ibfk_1` FOREIGN KEY (`alarm_types_for_measure_types_in_analyzers_id`) REFERENCES `alarm_types_for_measure_types_in_analyzers` (`id`);

--
-- Constraints for table `alarm_measures`
--
ALTER TABLE `alarm_measures`
  ADD CONSTRAINT `alarm_measures_ibfk_1` FOREIGN KEY (`alarms_for_measure_types_in_analyzers_id`) REFERENCES `alarms_for_measure_types_in_analyzers` (`id`);

--
-- Constraints for table `alarm_types_for_measure_types_in_analyzers`
--
ALTER TABLE `alarm_types_for_measure_types_in_analyzers`
  ADD CONSTRAINT `alarm_types_for_measure_types_in_analyzers_ibfk_1` FOREIGN KEY (`measure_types_in_analyzers_id`) REFERENCES `measure_types_in_analyzers` (`id`),
  ADD CONSTRAINT `alarm_types_for_measure_types_in_analyzers_ibfk_2` FOREIGN KEY (`alarm_types_id`) REFERENCES `alarm_types` (`id`);

--
-- Constraints for table `alarm_types_for_measure_types_in_analyzer_types`
--
ALTER TABLE `alarm_types_for_measure_types_in_analyzer_types`
  ADD CONSTRAINT `alarm_types_for_measure_types_in_analyzer_types_ibfk_1` FOREIGN KEY (`alarm_types_id`) REFERENCES `alarm_types` (`id`),
  ADD CONSTRAINT `alarm_types_for_measure_types_in_analyzer_types_ibfk_2` FOREIGN KEY (`measure_types_in_analyzer_types_id`) REFERENCES `measure_types_in_analyzer_types` (`id`);

--
-- Constraints for table `analyzers`
--
ALTER TABLE `analyzers`
  ADD CONSTRAINT `analyzers_ibfk_1` FOREIGN KEY (`hubs_id`) REFERENCES `hubs` (`id`),
  ADD CONSTRAINT `analyzers_ibfk_2` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `analyzers_ibfk_3` FOREIGN KEY (`analyzer_types_id`) REFERENCES `analyzer_types` (`id`);

--
-- Constraints for table `hub_resets`
--
ALTER TABLE `hub_resets`
  ADD CONSTRAINT `hub_resets_ibfk_1` FOREIGN KEY (`hubs_id`) REFERENCES `hubs` (`id`);

--
-- Constraints for table `measures`
--
ALTER TABLE `measures`
  ADD CONSTRAINT `measures_ibfk_1` FOREIGN KEY (`measure_types_in_analyzers_id`) REFERENCES `measure_types_in_analyzers` (`id`);

--
-- Constraints for table `measure_types_in_analyzers`
--
ALTER TABLE `measure_types_in_analyzers`
  ADD CONSTRAINT `measure_types_in_analyzers_ibfk_1` FOREIGN KEY (`analyzers_id`) REFERENCES `analyzers` (`id`),
  ADD CONSTRAINT `measure_types_in_analyzers_ibfk_2` FOREIGN KEY (`measure_types_id`) REFERENCES `measure_types` (`id`);

--
-- Constraints for table `measure_types_in_analyzer_types`
--
ALTER TABLE `measure_types_in_analyzer_types`
  ADD CONSTRAINT `measure_types_in_analyzer_types_ibfk_1` FOREIGN KEY (`measure_types_id`) REFERENCES `measure_types` (`id`),
  ADD CONSTRAINT `measure_types_in_analyzer_types_ibfk_2` FOREIGN KEY (`analyzer_types_id`) REFERENCES `analyzer_types` (`id`);

--
-- Constraints for table `modbus_querys`
--
ALTER TABLE `modbus_querys`
  ADD CONSTRAINT `modbus_querys_ibfk_1` FOREIGN KEY (`analyzers_id`) REFERENCES `analyzers` (`id`),
  ADD CONSTRAINT `modbus_querys_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `modbus_responses`
--
ALTER TABLE `modbus_responses`
  ADD CONSTRAINT `modbus_responses_ibfk_1` FOREIGN KEY (`modbus_querys_id`) REFERENCES `modbus_querys` (`id`);

--
-- Constraints for table `signals`
--
ALTER TABLE `signals`
  ADD CONSTRAINT `signals_ibfk_1` FOREIGN KEY (`signal_types_in_hubs_id`) REFERENCES `signal_types_in_hubs` (`id`);

--
-- Constraints for table `signal_types_in_hubs`
--
ALTER TABLE `signal_types_in_hubs`
  ADD CONSTRAINT `signal_types_in_hubs_ibfk_1` FOREIGN KEY (`hubs_id`) REFERENCES `hubs` (`id`),
  ADD CONSTRAINT `signal_types_in_hubs_ibfk_2` FOREIGN KEY (`signal_types_id`) REFERENCES `signal_types` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`account_types_id`) REFERENCES `account_types` (`id`);

--
-- Constraints for table `users_schedule`
--
ALTER TABLE `users_schedule`
  ADD CONSTRAINT `users_schedule_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
