-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 07, 2013 at 01:13 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_confess`
--
CREATE DATABASE IF NOT EXISTS `yii_confess` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `yii_confess`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `confession_id` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  `pass` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `confession_id_idx` (`confession_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `confession_id`, `text`, `date`, `status`, `pass`) VALUES
(1, 2, 'Lorem ipsum comment', '2013-01-07 00:07:23', 1, 'ba25b0'),
(2, 2, 'Lorem ipsum comment', '2013-01-07 00:07:31', 1, 'e93b22'),
(3, 1, 'Lorem ipsum comment', '2013-01-07 00:07:46', 1, '759efd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_confessions`
--

CREATE TABLE IF NOT EXISTS `tbl_confessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(5) NOT NULL,
  `confession` text NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  `pass` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `SHORT` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_confessions`
--

INSERT INTO `tbl_confessions` (`id`, `link`, `confession`, `date`, `status`, `pass`) VALUES
(1, 'cJio3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae molestie eros. Donec sed fermentum lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed fringilla faucibus velit, ac suscipit est gravida vitae. Maecenas elementum aliquam orci ac accumsan. Aenean nec quam nec velit blandit porta. Vestibulum id odio quam, at ornare nunc. Vivamus facilisis magna a mi luctus nec vestibulum ante luctus. Nullam vitae cursus orci. Nam ut dolor sem, at faucibus justo. Nam mattis condimentum congue. Sed porta ullamcorper lorem at pretium. In ac lorem nisl. Mauris feugiat lacinia elit, at tempus tortor rhoncus et. Suspendisse potenti.\r\n\r\nAliquam erat volutpat. Quisque eget commodo nisi. Pellentesque sollicitudin rhoncus sapien, id vehicula augue ornare id. In hac habitasse platea dictumst. Donec lacinia massa in nisi pharetra volutpat. Donec fermentum ligula augue, non ultricies nunc. Vestibulum non pulvinar sem. Proin eu sem tortor, sodales scelerisque purus. Nulla blandit turpis non felis vehicula tristique sed sed dolor. Aliquam quis justo ligula, eget vulputate urna. Cras accumsan scelerisque tempus. Pellentesque id felis orci. Praesent imperdiet ultricies nisl at sagittis. Duis et augue diam, sit amet hendrerit enim. Duis dignissim diam dui, sit amet dapibus risus.', '2013-01-07 00:03:47', 1, '49b05a'),
(2, 'EdRc6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae molestie eros. Donec sed fermentum lorem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed fringilla faucibus velit, ac suscipit est gravida vitae. Maecenas elementum aliquam orci ac accumsan. Aenean nec quam nec velit blandit porta. Vestibulum id odio quam, at ornare nunc. Vivamus facilisis magna a mi luctus nec vestibulum ante luctus. Nullam vitae cursus orci. Nam ut dolor sem, at faucibus justo. Nam mattis condimentum congue. Sed porta ullamcorper lorem at pretium. In ac lorem nisl. Mauris feugiat lacinia elit, at tempus tortor rhoncus et. Suspendisse potenti.\r\n\r\nAliquam erat volutpat. Quisque eget commodo nisi. Pellentesque sollicitudin rhoncus sapien, id vehicula augue ornare id. In hac habitasse platea dictumst. Donec lacinia massa in nisi pharetra volutpat. Donec fermentum ligula augue, non ultricies nunc. Vestibulum non pulvinar sem. Proin eu sem tortor, sodales scelerisque purus. Nulla blandit turpis non felis vehicula tristique sed sed dolor. Aliquam quis justo ligula, eget vulputate urna. Cras accumsan scelerisque tempus. Pellentesque id felis orci. Praesent imperdiet ultricies nisl at sagittis. Duis et augue diam, sit amet hendrerit enim. Duis dignissim diam dui, sit amet dapibus risus.', '2013-01-07 00:04:01', 1, '443140');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`) VALUES
(1, 'Admin', 'Admin'),
(4, 'Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` varchar(15) NOT NULL DEFAULT '0',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastvisit_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`) VALUES
(1, 'admin', '9d92b84ce96751bb265abd10f08746f7144e1e90', 'admin@example.com', '9d92b84ce96751bb265abd10f08746f7144e1e90', '2013-01-07 00:02:58', '2013-01-07 00:03:20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_votes`
--

CREATE TABLE IF NOT EXISTS `tbl_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `confession_id` int(11) NOT NULL,
  `user_ip` int(11) DEFAULT NULL,
  `vote` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `confession_link_idx` (`confession_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `confession_id` FOREIGN KEY (`confession_id`) REFERENCES `tbl_confessions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_votes`
--
ALTER TABLE `tbl_votes`
  ADD CONSTRAINT `confession_link` FOREIGN KEY (`confession_id`) REFERENCES `tbl_confessions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
