-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2013 at 07:06 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `technicalexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(255) NOT NULL DEFAULT '',
  `email_address` varchar(64) NOT NULL DEFAULT '',
  `username` varchar(64) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `pwd` varchar(64) NOT NULL,
  `language` varchar(5) DEFAULT NULL,
  `default_account_id` mediumint(9) DEFAULT NULL,
  `comments` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sso_user_id` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_last_login` datetime DEFAULT NULL,
  `email_updated` datetime DEFAULT NULL,
  `mailsent` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `ox_users_username` (`username`),
  UNIQUE KEY `ox_users_sso_user_id` (`sso_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `contact_name`, `email_address`, `username`, `password`, `pwd`, `language`, `default_account_id`, `comments`, `active`, `sso_user_id`, `date_created`, `date_last_login`, `email_updated`, `mailsent`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', '0192023a7bbd73250516f069df18b500', '', 'en', 2, NULL, 1, NULL, '2012-05-24 12:09:20', NULL, '2012-05-24 12:09:20', '0');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `isactive` tinyint(4) NOT NULL,
  `createdby` int(11) NOT NULL,
  `createdtime` datetime NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedtime` datetime NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `key`, `description`, `value`, `isactive`, `createdby`, `createdtime`, `updatedby`, `updatedtime`) VALUES
(1, 'ADMIN_MAIL', 'Admin Email Address', 'abdulshamadhu@gmail.com', 1, 0, '0000-00-00 00:00:00', 0, '2009-04-15 19:53:31'),
(2, 'SMTP_USERNAME', 'SMTP Server Username', '', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'SMTP_PASSWORD', 'SMTP Server Password', '', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'SMTP_PORT', 'SMTP Port', '', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'SMTP_HOST', 'SMTP Server Host Name', '', 1, 0, '0000-00-00 00:00:00', 0, '2009-04-15 19:53:31'),
(7, 'PAYPAL_EMAIL_ID', 'PayPal payable  email address', '', 1, 0, '2009-08-07 15:15:41', 0, '2009-08-07 15:15:45'),
(8, 'AUTHORIZED_LOGIN_ID', 'Login id of the authorized.net', '', 1, 0, '2009-08-27 14:36:11', 0, '2009-08-27 14:36:13'),
(9, 'AUTHORIZED_TRANSACTION_KEY', 'Transaction key of the authorized.net', '', 1, 0, '2009-08-27 14:37:03', 0, '2009-08-27 14:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscribers`
--

CREATE TABLE IF NOT EXISTS `tbl_subscribers` (
  `subscriber_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_on` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`subscriber_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_subscribers`
--

INSERT INTO `tbl_subscribers` (`subscriber_id`, `title`, `description`, `created_on`, `status`) VALUES
(1, 'New Year Wishes', 'As we celebrate this Chinese New Year, let us spare a thought for those who, due to circumstances beyond their control, are unable to enjoy the merrymaking and feasting.\r\n\r\nI am talking about the old and infirm who are confined to the old folksâ€™ and nursing homes. I hope their families visit and bring them cheer.\r\n\r\nFor those who recently suffered the immeasurable loss of family members due to accident or sickness, I hope that they get on with their lives as soon as they can, and I wish them multiple blessings in the Year of the Snake.\r\n\r\nThere are also Singaporeans whose loved ones are going through a life-threatening sickness. I hope they remain optimistic and that their loved ones go on to live fulfilling lives.', '2013-03-04 01:57:25', 1),
(2, 'Merry Christmas Wishes', 'The making of cribs, the preparation of sweets; the baking of cake, the chocolate icing underneath; The Christmas carols sung out loud, brings happiness and bliss all the year round! Merry Christmas and a Happy New Year!', '2013-03-04 01:59:03', 1),
(3, 'Pongal Greetings', 'People send greetings for Pongal through various medium. Those who are reachable send Pongal wishes by visiting personally. Whereas those who live abroad, cannot give a personal visit to their friends and relatives. Thus, they send Pongal cards, Pongal e-cards and Pongal greeting cards. Pongal recipe are also exchanged during this festival. Thus, on this day, people go out for places and exchange Pongal greetings and give Pongal Gifts to each other.', '2013-03-04 02:00:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `subscription` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `firstname`, `lastname`, `email`, `password`, `subscription`, `created_on`, `status`) VALUES
(1, 'Abdul', 'Shamadhu', 'abdulshamadhu@gmail.com', 'dpTz9vfhukZl8wc3ZePj/M89gN4CPtIGrGKHFmR9tLk=', 1, '2013-03-04 01:51:48', 1),
(2, 'Mohammed', 'Ibrahim', 'mohamed@gmail.com', 'dpTz9vfhukZl8wc3ZePj/M89gN4CPtIGrGKHFmR9tLk=', 0, '2013-03-04 01:52:20', 0),
(3, 'Raffiq', 'Mohammed', 'raffiq@mailinator.com', 'dpTz9vfhukZl8wc3ZePj/M89gN4CPtIGrGKHFmR9tLk=', 1, '2013-03-04 01:53:01', 0),
(4, 'Ram', 'Nivas', 'ramnivas@mailinator.com', 'dpTz9vfhukZl8wc3ZePj/M89gN4CPtIGrGKHFmR9tLk=', 1, '2013-03-04 01:53:34', 1),
(5, 'Peter', 'John', 'peter@yahoo.com', 'dpTz9vfhukZl8wc3ZePj/M89gN4CPtIGrGKHFmR9tLk=', 1, '2013-03-04 01:54:10', 0);
