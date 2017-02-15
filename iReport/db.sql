-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2013 at 09:05 PM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ksc_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `rep_options`
--

CREATE TABLE `rep_options` (
  `option_ID` int(11) NOT NULL AUTO_INCREMENT,
  `option_key` varchar(255) NOT NULL,
  `option_value` longtext NOT NULL,
  PRIMARY KEY (`option_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rep_options`
--

INSERT INTO `rep_options` (`option_ID`, `option_key`, `option_value`) VALUES
(1, 'position', '["Kalab","Manager","Administration","Research and Development","Maintenance","Finance"]'),
(2, 'module', '["Java","Looping","Inheritance"]'),
(3, 'default_password', 'jangansoktau'),
(4, 'generation', '["default","2009-2010","2010-2011"]'),
(5, 'active_generation', '2'),
(6, 'time_practicum', '["08:0-09:30","10:00-11:30","13:00-14:30","15:30-17:00"]');

-- --------------------------------------------------------

--
-- Table structure for table `rep_presence`
--

CREATE TABLE `rep_presence` (
  `presence_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) DEFAULT NULL,
  `presence_date` datetime DEFAULT NULL,
  `presence_start_time` time DEFAULT NULL COMMENT ' ',
  `presence_end_time` time DEFAULT NULL,
  `presence_module` varchar(255) DEFAULT NULL,
  `presence_my_signature` varchar(255) DEFAULT NULL,
  `presence_kalab_signature` varchar(45) DEFAULT NULL,
  `presence_students_presence` varchar(255) NOT NULL,
  PRIMARY KEY (`presence_ID`),
  KEY `user_ID_idx` (`user_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

-- --------------------------------------------------------

--
-- Table structure for table `rep_schedule`
--

CREATE TABLE `rep_schedule` (
  `schedule_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `schedule_value` longtext NOT NULL,
  PRIMARY KEY (`schedule_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `rep_schedule`
--

INSERT INTO `rep_schedule` (`schedule_ID`, `user_ID`, `schedule_value`) VALUES
(1, 1, '""'),
(2, 6, '""'),
(3, 13, '""'),
(4, 16, '""'),
(5, 9, '""'),
(6, 5, '""'),
(7, 10, '""');

-- --------------------------------------------------------

--
-- Table structure for table `rep_usermeta`
--

CREATE TABLE `rep_usermeta` (
  `meta_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL,
  PRIMARY KEY (`meta_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `rep_usermeta`
--

INSERT INTO `rep_usermeta` (`meta_ID`, `user_ID`, `meta_key`, `meta_value`) VALUES
(104, 24, 'position', '2'),
(20, 1, 'position', '0'),
(16, 1, 'first_name', 'administrator'),
(17, 1, 'last_name', ''),
(103, 24, 'last_name', 'fahmi'),
(102, 24, 'first_name', 'makhfuzi'),
(105, 25, 'first_name', 'Zumrotun'),
(99, 23, 'first_name', 'Herlina'),
(98, 22, 'position', '3'),
(107, 25, 'position', '5'),
(106, 25, 'last_name', 'Naimah'),
(112, 22, 'generation', '2'),
(111, 21, 'generation', '2'),
(96, 22, 'first_name', 'Ivan'),
(95, 21, 'position', '3'),
(93, 21, 'first_name', 'Dadang'),
(92, 20, 'position', '4'),
(91, 20, 'last_name', 'sulistio'),
(110, 25, 'generation', '2'),
(89, 19, 'position', '1'),
(88, 19, 'last_name', 'Azani'),
(114, 20, 'generation', '2'),
(113, 19, 'generation', '2'),
(100, 23, 'last_name', ''),
(101, 23, 'position', '2'),
(97, 22, 'last_name', 'Adhi'),
(94, 21, 'last_name', 'heksaputra'),
(90, 20, 'first_name', 'Deni '),
(87, 19, 'first_name', 'Yopi'),
(108, 23, 'generation', '2'),
(109, 24, 'generation', '2');

-- --------------------------------------------------------

--
-- Table structure for table `rep_users`
--

CREATE TABLE `rep_users` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_nicename` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_registered` datetime NOT NULL,
  PRIMARY KEY (`user_ID`),
  UNIQUE KEY `user_nicename` (`user_nicename`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `rep_users`
--

INSERT INTO `rep_users` (`user_ID`, `user_nicename`, `user_pass`, `user_registered`) VALUES
(1, 'admin', 'f6d673d64390db04e73e0fe722cb34c0', '2013-09-28 20:30:07'),
(23, 'Herlina', 'e279b21bd528ecd43dced88c6742a8c0', '2013-10-20 21:03:30'),
(24, 'makhfuzi', 'e279b21bd528ecd43dced88c6742a8c0', '2013-10-20 21:03:56'),
(25, 'zumrotun', 'e279b21bd528ecd43dced88c6742a8c0', '2013-10-20 21:04:20'),
(21, 'dadangheksa', 'e279b21bd528ecd43dced88c6742a8c0', '2013-10-20 21:02:58'),
(22, 'ivanadhi', 'e279b21bd528ecd43dced88c6742a8c0', '2013-10-20 21:03:15'),
(19, 'yopiazani', 'e279b21bd528ecd43dced88c6742a8c0', '2013-10-20 21:01:20'),
(20, 'denisulistio', 'e279b21bd528ecd43dced88c6742a8c0', '2013-10-20 21:01:45');
