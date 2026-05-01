-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2025 at 11:00 AM
-- Server version: 5.5.28-log
-- PHP Version: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfees_committee`
--

-- --------------------------------------------------------

--
-- Table structure for table `committee`
--

CREATE TABLE IF NOT EXISTS `committee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `committee_shortname` varchar(50) NOT NULL,
  `committee_fullname` varchar(255) NOT NULL,
  `committee_creationtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `committee_deletiontime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `committee`
--

INSERT INTO `committee` (`id`, `committee_shortname`, `committee_fullname`, `committee_creationtime`, `committee_deletiontime`) VALUES
(1, 'CNC', 'Cost Negotiation Committee', '2025-08-30 05:00:20', NULL),
(2, 'DSC', 'Departmental Selection Committee', '2025-08-02 00:39:30', '2025-08-08 22:45:27'),
(3, 'ass', 'asdgge', '2025-09-03 16:39:53', NULL),
(4, 'ass', 'asd', '2025-09-03 16:40:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `committee_members`
--

CREATE TABLE IF NOT EXISTS `committee_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `committee_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `committee_id` (`committee_id`),
  KEY `emp_id` (`emp_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_role`
--

CREATE TABLE IF NOT EXISTS `id_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `id_admin`
--

CREATE TABLE IF NOT EXISTS `id_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `g_id` int(6) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('Admin','User','Telecom','Super Admin','IT Hardware','Software','Network') NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `id_admin`
--

INSERT INTO `id_admin` (`id`, `name`, `g_id`, `username`, `password`, `user_type`, `is_created`, `is_deleted`) VALUES
(11, 'Fateh', 9, 'fateh11', 'G*6AAApjYl', 'IT Hardware', '0000-00-00 00:00:00', 'yes'),
(12, 'Himmat', 1, 'himmat12', '17V8@Y1b+%', 'Network', '0000-00-00 00:00:00', 'no'),
(13, 'Jivin', 8, 'jivin13', 'r&9xAJwd2h', 'Software', '0000-00-00 00:00:00', 'no'),
(14, 'Advik', 7, 'advik14', '+6jjFJhKMh', 'Super Admin', '0000-00-00 00:00:00', 'no'),
(15, 'Tejas', 1, 'tejas15', '$0Q_WgWfRu', 'Telecom', '0000-00-00 00:00:00', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `id_desig`
--

CREATE TABLE IF NOT EXISTS `id_desig` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `desig_fullname` varchar(50) NOT NULL,
  `cadre_id` tinyint(4) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `id_desig`
--

INSERT INTO `id_desig` (`id`, `name`, `desig_fullname`, `cadre_id`, `is_created`, `is_deleted`) VALUES
(1, 'SC''H''', 'Scientist ''H''', 2, '0000-00-00 00:00:00', 'yes'),
(2, 'SC''G''', 'Scientist ''G''', 1, '0000-00-00 00:00:00', 'no'),
(3, 'SC''F''', 'Scientist ''F''', 3, '0000-00-00 00:00:00', 'yes'),
(4, 'SC''E''', 'Scientist ''E''', 3, '0000-00-00 00:00:00', 'yes'),
(5, 'SC''D''', 'Scientist ''D''', 3, '0000-00-00 00:00:00', 'yes'),
(6, 'SC''C''', 'Scientist ''C''', 4, '0000-00-00 00:00:00', 'no'),
(7, 'SC''B''', 'Scientist ''B''', 5, '0000-00-00 00:00:00', 'no'),
(8, 'SC''A''', 'Scientist ''A''', 3, '0000-00-00 00:00:00', 'yes'),
(9, 'TO''A''', 'Technical Officer ''A''', 3, '0000-00-00 00:00:00', 'no'),
(10, 'TO''B''', 'Technical Officer ''B''', 2, '0000-00-00 00:00:00', 'no'),
(11, 'TO''C''', 'Technical Officer ''C''', 1, '0000-00-00 00:00:00', 'yes'),
(12, 'TO''D''', 'Technical Officer ''D''', 3, '0000-00-00 00:00:00', 'no'),
(13, 'TO''E''', 'Technical Officer ''E''', 1, '0000-00-00 00:00:00', 'no'),
(14, 'TO''F''', 'Technical Officer ''F''', 4, '0000-00-00 00:00:00', 'no'),
(15, 'TO''G''', 'Technical Officer ''G''', 5, '0000-00-00 00:00:00', 'no'),
(16, 'TO''H''', 'Technical Officer ''H''', 4, '0000-00-00 00:00:00', 'yes'),
(17, 'STA''A''', 'Sr. Technical Asst. ''A''', 3, '0000-00-00 00:00:00', 'yes'),
(18, 'STA''B''', 'Sr. Technical Asst. ''B''', 2, '0000-00-00 00:00:00', 'no'),
(19, 'STA''C''', 'Sr. Technical Asst. ''C''', 2, '0000-00-00 00:00:00', 'yes'),
(20, 'STA''D''', 'Sr. Technical Asst. ''D''', 3, '0000-00-00 00:00:00', 'yes'),
(21, 'STA''E''', 'Sr. Technical Asst. ''E''', 1, '0000-00-00 00:00:00', 'no'),
(22, 'STA''F''', 'Sr. Technical Asst. ''F''', 2, '0000-00-00 00:00:00', 'yes'),
(23, 'ADMIN''A''', 'Admin Officer ''A''', 5, '0000-00-00 00:00:00', 'yes'),
(24, 'ADMIN''B''', 'Admin Officer ''B''', 5, '0000-00-00 00:00:00', 'no'),
(25, 'ADMIN''C''', 'Admin Officer ''C''', 5, '0000-00-00 00:00:00', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `id_emp`
--

CREATE TABLE IF NOT EXISTS `id_emp` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `gen` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `cadre_id` tinyint(4) NOT NULL,
  `desig_id` int(5) NOT NULL,
  `internal_desig_id` int(4) NOT NULL,
  `group_id` int(5) NOT NULL,
  `user_type` enum('Permanent','Generic','Temporary') NOT NULL,
  `telephone_no` varchar(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  `is_gazetted` enum('yes','no') NOT NULL DEFAULT 'no',
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `id_emp`
--

INSERT INTO `id_emp` (`id`, `first_name`, `middle_name`, `last_name`, `gen`, `dob`, `mobile_no`, `email_id`, `cadre_id`, `desig_id`, `internal_desig_id`, `group_id`, `user_type`, `telephone_no`, `user_name`, `password`, `status`, `is_gazetted`, `is_created`, `is_deleted`) VALUES
(1, 'Mamooty', '', 'Mallick', 'Male', '0000-00-00', '9438892037', 'mamooty.mallick1@example.com', 2, 881, 14, 7, 'Temporary', '8311763202', 'mamooty1', '_2LuB2gW6k', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(2, 'Jiya', '', 'Kale', 'Female', '0000-00-00', '8954813935', 'jiya.kale2@test.org', 1, 554, 11, 9, 'Generic', '3633709238', 'jiya2', '1dG%aCN((g', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(3, 'Biju', '', 'Char', 'Other', '0000-00-00', '9073302081', 'biju.char3@sample.net', 3, 482, 2, 1, 'Permanent', '4697721570', 'biju3', 'upX#R1Lios', 1, 'yes', '0000-00-00 00:00:00', 'yes'),
(4, 'Aayush', '', 'Trivedi', 'Female', '0000-00-00', '8408303851', 'aayush.trivedi4@sample.net', 3, 561, 16, 6, 'Permanent', '8021682048', 'aayush4', '^016XSFdNG', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(5, 'Jhanvi', 'Neysa', 'Zachariah', 'Female', '0000-00-00', '8397005820', 'jhanvi.zachariah5@test.org', 3, 784, 18, 7, 'Temporary', '4084684958', 'jhanvi5', '%82W6jKoaj', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(6, 'Ivana', '', 'Tella', 'Female', '0000-00-00', '7622174139', 'ivana.tella6@test.org', 4, 111, 11, 10, 'Generic', '3025061170', 'ivana6', 'Nt0Lo#wog@', 1, 'no', '0000-00-00 00:00:00', 'no'),
(7, 'Vaibhav', '', 'Subramanian', 'Female', '0000-00-00', '8091760465', 'vaibhav.subramanian7@sample.net', 5, 639, 3, 3, 'Permanent', '3516803270', 'vaibhav7', '_54wM4Ec6x', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(8, 'Rhea', 'Chirag', 'Sawhney', 'Other', '0000-00-00', '9165541688', 'rhea.sawhney8@sample.net', 3, 807, 13, 1, 'Generic', '3661012592', 'rhea8', '*@_8HDnDPm', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(9, 'Yuvaan', '', 'Ray', 'Other', '0000-00-00', '7772433585', 'yuvaan.ray9@example.com', 3, 114, 19, 4, 'Permanent', '1098754053', 'yuvaan9', '0sT1kUAd(7', 1, 'no', '0000-00-00 00:00:00', 'no'),
(10, 'Ehsaan', 'Armaan', 'Chhabra', 'Male', '0000-00-00', '7473983020', 'ehsaan.chhabra10@test.org', 2, 616, 4, 9, 'Temporary', '9867576202', 'ehsaan10', '*5Q^^na0vz', 1, 'no', '0000-00-00 00:00:00', 'no'),
(11, 'Fateh', '', 'Sha', 'Other', '0000-00-00', '9785694415', 'fateh.sha11@example.com', 1, 777, 19, 9, 'Permanent', '6551392014', 'fateh11', 'G*6AAApjYl', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(12, 'Himmat', 'Mannat', 'Varty', 'Female', '0000-00-00', '9438564175', 'himmat.varty12@example.com', 3, 403, 20, 1, 'Generic', '1704097260', 'himmat12', '17V8@Y1b+%', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(13, 'Jivin', 'Nayantara', 'Bal', 'Female', '0000-00-00', '9217033845', 'jivin.bal13@test.org', 1, 942, 5, 8, 'Generic', '7875502979', 'jivin13', 'r&9xAJwd2h', 1, 'no', '0000-00-00 00:00:00', 'no'),
(14, 'Advik', 'Adah', 'Upadhyay', 'Female', '0000-00-00', '9724497879', 'advik.upadhyay14@sample.net', 4, 427, 15, 7, 'Generic', '2662396859', 'advik14', '+6jjFJhKMh', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(15, 'Tejas', 'Zoya', 'Dugar', 'Other', '0000-00-00', '8264094942', 'tejas.dugar15@example.com', 5, 640, 16, 1, 'Generic', '8896878298', 'tejas15', '$0Q_WgWfRu', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(16, 'Rohan', '', 'Sankar', 'Female', '0000-00-00', '8870833474', 'rohan.sankar16@example.com', 4, 268, 4, 4, 'Temporary', '5931753530', 'rohan16', '!dm*TAk$h0', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(17, 'Neysa', '', 'Vohra', 'Female', '0000-00-00', '9547780378', 'neysa.vohra17@sample.net', 3, 708, 14, 10, 'Temporary', '7510867717', 'neysa17', '63!N!x7Y!1', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(18, 'Samar', '', 'Loyal', 'Female', '0000-00-00', '7862867518', 'samar.loyal18@sample.net', 2, 963, 2, 9, 'Generic', '7038464098', 'samar18', 'tl9yUeLZ)^', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(19, 'Vidur', 'Aarush', 'Deshmukh', 'Other', '0000-00-00', '7003170374', 'vidur.deshmukh19@sample.net', 2, 535, 19, 6, 'Permanent', '1315549494', 'vidur19', '#8jmNqWjP5', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(20, 'Adira', 'Hrishita', 'Doctor', 'Female', '0000-00-00', '9068753987', 'adira.doctor20@sample.net', 3, 348, 6, 2, 'Permanent', '8299078187', 'adira20', '#B0SAit1y3', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(21, 'Ivan', '', 'Sundaram', 'Other', '0000-00-00', '7630501488', 'ivan.sundaram21@example.com', 1, 610, 1, 2, 'Generic', '1657811406', 'ivan21', 'i%f6wWf^4@', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(22, 'Bhavin', 'Kimaya', 'Buch', 'Male', '0000-00-00', '8117186961', 'bhavin.buch22@test.org', 2, 801, 7, 6, 'Generic', '9191909596', 'bhavin22', 'B+7W1YuG7%', 1, 'no', '0000-00-00 00:00:00', 'yes'),
(23, 'Ivan', 'Kiaan', 'Tank', 'Male', '0000-00-00', '8084300250', 'ivan.tank23@test.org', 5, 421, 7, 1, 'Generic', '1145664130', 'ivan23', 'os231V&eX@', 1, 'yes', '0000-00-00 00:00:00', 'yes'),
(24, 'Devansh', '', 'Ahluwalia', 'Female', '0000-00-00', '9220120236', 'devansh.ahluwalia24@test.org', 5, 353, 3, 2, 'Generic', '7500565660', 'devansh24', 'G(8R8Ckx$y', 1, 'yes', '0000-00-00 00:00:00', 'no'),
(25, 'Anay', '', 'Andra', 'Other', '0000-00-00', '7728455308', 'anay.andra25@example.com', 5, 815, 4, 9, 'Temporary', '1874003325', 'anay25', 'Q2Ra9xRM%!', 1, 'no', '0000-00-00 00:00:00', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `id_group`
--

CREATE TABLE IF NOT EXISTS `id_group` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `ad_id` int(6) NOT NULL,
  `gh_id` int(6) NOT NULL,
  `va1_id` int(6) NOT NULL,
  `va2_id` int(6) NOT NULL,
  `is_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `ad_id` (`ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `id_group`
--

INSERT INTO `id_group` (`id`, `name`, `fullname`, `ad_id`, `gh_id`, `va1_id`, `va2_id`, `is_created`, `is_deleted`) VALUES
(1, 'ACD', 'Advanced Computing Division', 101, 201, 301, 401, '0000-00-00 00:00:00', 'yes'),
(2, 'MTD', 'Materials Technology Division', 102, 202, 302, 402, '0000-00-00 00:00:00', 'no'),
(3, 'EMD', 'Electromagnetic Division', 103, 203, 303, 403, '0000-00-00 00:00:00', 'yes'),
(4, 'CSD', 'Communication Systems Division', 104, 204, 304, 404, '0000-00-00 00:00:00', 'yes'),
(5, 'NSD', 'Navigation Systems Division', 105, 205, 305, 405, '0000-00-00 00:00:00', 'yes'),
(6, 'SSD', 'Sensor Systems Division', 106, 206, 306, 406, '0000-00-00 00:00:00', 'no'),
(7, 'PSD', 'Power Systems Division', 107, 207, 307, 407, '0000-00-00 00:00:00', 'no'),
(8, 'ESD', 'Embedded Systems Division', 108, 208, 308, 408, '0000-00-00 00:00:00', 'yes'),
(9, 'HWD', 'High Voltage Division', 109, 209, 309, 409, '0000-00-00 00:00:00', 'no'),
(10, 'CND', 'Control and Navigation Division', 110, 210, 310, 410, '0000-00-00 00:00:00', 'no'),
(11, 'WTD', 'Weapon Technology Division', 111, 211, 311, 411, '0000-00-00 00:00:00', 'yes'),
(12, 'LSD', 'Laser Systems Division', 112, 212, 312, 412, '0000-00-00 00:00:00', 'no'),
(13, 'OPD', 'Optics Division', 113, 213, 313, 413, '0000-00-00 00:00:00', 'no'),
(14, 'THD', 'Thermal Division', 114, 214, 314, 414, '0000-00-00 00:00:00', 'no'),
(15, 'SMD', 'Structural Mechanics Division', 115, 215, 315, 415, '0000-00-00 00:00:00', 'no'),
(16, 'FLD', 'Flight Lab Division', 116, 216, 316, 416, '0000-00-00 00:00:00', 'yes'),
(17, 'ARD', 'Aero Research Division', 117, 217, 317, 417, '0000-00-00 00:00:00', 'yes'),
(18, 'CMD', 'Composite Materials Division', 118, 218, 318, 418, '0000-00-00 00:00:00', 'no'),
(19, 'PRD', 'Propulsion Research Division', 119, 219, 319, 419, '0000-00-00 00:00:00', 'yes'),
(20, 'VSD', 'Vibration Systems Division', 120, 220, 320, 420, '0000-00-00 00:00:00', 'yes'),
(21, 'MND', 'Microelectronics and Nanotech Division', 121, 221, 321, 421, '0000-00-00 00:00:00', 'no'),
(22, 'IQD', 'Image & Quantum Division', 122, 222, 322, 422, '0000-00-00 00:00:00', 'yes'),
(23, 'RAD', 'Radiation Applications Division', 123, 223, 323, 423, '0000-00-00 00:00:00', 'yes'),
(24, 'TRD', 'Testing & Reliability Division', 124, 224, 324, 424, '0000-00-00 00:00:00', 'no'),
(25, 'CRD', 'Cyber Research Division', 125, 225, 325, 425, '0000-00-00 00:00:00', 'no');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `committee_members`
--
ALTER TABLE `committee_members`
  ADD CONSTRAINT `committee_members_ibfk_1` FOREIGN KEY (`committee_id`) REFERENCES `committee` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `committee_members_ibfk_2` FOREIGN KEY (`emp_id`) REFERENCES `id_emp` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `committee_members_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `id_role` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;