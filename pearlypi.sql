-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2013 at 06:43 AM
-- Server version: 5.1.61
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pearlypi`
--

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE IF NOT EXISTS `Item` (
  `item_id` int(8) NOT NULL AUTO_INCREMENT,
  `item_product_id` int(8) NOT NULL,
  `item_price` double NOT NULL,
  `item_discount` int(3) DEFAULT NULL,
  `item_quantity` int(3) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Job`
--

CREATE TABLE IF NOT EXISTS `Job` (
  `job_id` int(8) NOT NULL AUTO_INCREMENT,
  `job_type` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` text COLLATE utf8_unicode_ci NOT NULL,
  `job_date` date NOT NULL,
  `job_time` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `job_names` text COLLATE utf8_unicode_ci NOT NULL,
  `job_location` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `job_discount` int(3) NOT NULL,
  `job_status` int(3) NOT NULL,
  PRIMARY KEY (`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Modules`
--

CREATE TABLE IF NOT EXISTS `Modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `module_enabled` bit(1) NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `Modules`
--

INSERT INTO `Modules` (`module_id`, `module_name`, `module_enabled`) VALUES
(1, 'login', b'1'),
(2, 'index', b'1'),
(3, 'item', b'1'),
(4, 'person', b'1'),
(5, 'photo', b'1'),
(6, 'product', b'1'),
(7, 'task', b'1'),
(8, 'search', b'1'),
(9, 'logout', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE IF NOT EXISTS `Person` (
  `person_id` int(8) NOT NULL AUTO_INCREMENT,
  `person_username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `person_firstname` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `person_lastname` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `person_company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `person_mobile` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_home` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_address` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_city` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_zip` int(5) DEFAULT NULL,
  `person_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `person_recommended` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_adverttype` int(1) DEFAULT NULL,
  `person_created` date NOT NULL,
  `person_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `person_password_salt` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `person_password_attempts` int(1) DEFAULT NULL,
  `person_last_attempt` date DEFAULT NULL,
  `person_permissions` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `person_enabled` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`person_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`person_id`, `person_username`, `person_firstname`, `person_lastname`, `person_company`, `person_mobile`, `person_home`, `person_address`, `person_city`, `person_state`, `person_zip`, `person_email`, `person_recommended`, `person_adverttype`, `person_created`, `person_password`, `person_password_salt`, `person_password_attempts`, `person_last_attempt`, `person_permissions`, `person_enabled`) VALUES
(1, 'TParis', 'Andrew', 'Pearson', 'Pearson Web Design', '210-488-1258', '210-658-6585', '7203 Autumn Acres', 'Converse', 'TX', 78109, 'tparis00ap@hotmail.com', 'Laura', 1, '2013-02-18', 'b20f8da7b8fcdce055b288d798119fe5', 'ABCD', 0, '0000-00-00', 'a:4:{s:8:"hasAdmin";b:1;s:10:"UsersAdmin";b:0;s:12:"ModulesAdmin";b:1;s:17:"ModulePermissions";a:2:{s:13:"Person_1_Read";b:1;s:14:"Person_1_Write";b:1;}}', b'1'),
(2, 'and', 'Andrew', 'Pills', 'Pills'' Pills', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '0000-00-00', '', '', NULL, NULL, '', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `Photo`
--

CREATE TABLE IF NOT EXISTS `Photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_size` text COLLATE utf8_unicode_ci,
  `product_price` double NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Relations`
--

CREATE TABLE IF NOT EXISTS `Relations` (
  `parent_module_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `parent_module_id` int(8) NOT NULL,
  `child_module_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `child_module_id` int(8) NOT NULL,
  PRIMARY KEY (`parent_module_name`,`parent_module_id`,`child_module_name`,`child_module_id`),
  KEY `child_module` (`child_module_name`,`child_module_id`),
  KEY `parent_module` (`parent_module_name`,`parent_module_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Search_columns`
--

CREATE TABLE IF NOT EXISTS `Search_columns` (
  `search_table` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `search_column` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `search_search` int(11) NOT NULL,
  `search_display` int(1) NOT NULL,
  `search_display_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `search_order` int(2) NOT NULL,
  PRIMARY KEY (`search_table`,`search_column`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Search_columns`
--

INSERT INTO `Search_columns` (`search_table`, `search_column`, `search_search`, `search_display`, `search_display_title`, `search_order`) VALUES
('Person', 'person_username', 1, 1, 'Username', 1),
('Person', 'person_firstname', 1, 0, '', 6),
('Person', 'person_lastname', 1, 0, '', 7),
('Person', 'person_mobile', 1, 0, '', 8),
('Person', 'person_home', 1, 0, '', 9),
('Person', 'person_address', 1, 0, '', 10),
('Person', 'person_zip', 1, 0, '', 11),
('Person', 'person_state', 1, 0, '', 12),
('Person', 'person_email', 1, 1, 'Email', 3),
('Person', 'person_recommended', 1, 0, '', 13),
('Job', 'job_description', 1, 0, '', 4),
('Job', 'job_date', 1, 1, 'Date', 3),
('Job', 'job_names', 1, 1, 'Job title', 1),
('Job', 'job_location', 1, 1, 'Job location', 2),
('Person', 'Person_created', 0, 1, 'Created', 4),
('Person', 'Person_enabled', 0, 1, 'Enabled', 5),
('Person', 'person_company', 1, 1, 'Company', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Search_objects`
--

CREATE TABLE IF NOT EXISTS `Search_objects` (
  `Search_table` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `Search_object` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Search_table`),
  UNIQUE KEY `Search_table` (`Search_table`,`Search_object`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Search_objects`
--

INSERT INTO `Search_objects` (`Search_table`, `Search_object`) VALUES
('Person', 'CONCAT(person_firstname, " ", person_lastname)');

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE IF NOT EXISTS `Task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `task_description` text COLLATE utf8_unicode_ci NOT NULL,
  `task_status` int(3) NOT NULL,
  `task_cost` double DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
