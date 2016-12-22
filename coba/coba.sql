-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2016 at 07:18 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coba`
--

-- --------------------------------------------------------

--
-- Table structure for table `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `control_id` int(2) NOT NULL AUTO_INCREMENT,
  `room_id` int(2) NOT NULL,
  `switch` varchar(20) NOT NULL,
  `switch_status` int(1) NOT NULL,
  `mac_address` varchar(16) NOT NULL,
  `sensor_mac_address` varchar(16) NOT NULL,
  `mode` int(1) NOT NULL,
  `mode_status` int(1) NOT NULL,
  `sensor_status` int(2) NOT NULL,
  `schedule_on` time NOT NULL,
  `schedule_off` time NOT NULL,
  PRIMARY KEY (`control_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `control`
--

INSERT INTO `control` (`control_id`, `room_id`, `switch`, `switch_status`, `mac_address`, `sensor_mac_address`, `mode`, `mode_status`, `sensor_status`, `schedule_on`, `schedule_off`) VALUES
(36, 1, 'A', 0, '123456789101213', '', 4, 0, 0, '07:00:00', '07:00:00'),
(38, 2, 'B', 1, '3532758979814124', '', 4, 0, 0, '18:00:00', '06:00:00'),
(39, 3, 'C', 1, '234678981034AD9C', '1231531526426474', 2, 1, 0, '07:00:00', '07:00:00'),
(40, 1, '', 1, '123456789101213', '', 3, 1, 0, '12:00:00', '12:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(2) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(20) NOT NULL,
  `device_name` varchar(35) NOT NULL,
  `room_description` varchar(35) NOT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `device_name`, `room_description`) VALUES
(1, 'Living Room', 'FAN', ''),
(2, 'Bed Room', 'AC', ''),
(3, 'Outdoor', 'LAMP', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPass` varchar(255) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`) VALUES
(1, 'sunshine', 'sunrise23241@gmail.com', '59b18ab96266fe0b677a8df78bcdc2fa8f54720bae5ec862f0515eddb100c5fd');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
