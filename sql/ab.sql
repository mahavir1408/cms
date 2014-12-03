-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2014 at 09:23 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ab`
--

-- --------------------------------------------------------

--
-- Table structure for table `ab_category`
--

CREATE TABLE IF NOT EXISTS `ab_category` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_published` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ab_category`
--

INSERT INTO `ab_category` (`id`, `userid`, `display_name`, `slug`, `created_at`, `is_published`) VALUES
(1, 1, '27 Feb1 H1 Tag', '27-feb1-h1-tag', '2014-02-27 11:11:07', 1),
(2, 1, '27 Feb2 H1 Tag', '27-feb2-url', '2014-02-27 11:12:49', 1),
(3, 1, '27 Feb3 H1 tag', '27-feb3-url', '2014-02-27 11:13:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ab_comment`
--

CREATE TABLE IF NOT EXISTS `ab_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(70) NOT NULL,
  `comment` tinytext NOT NULL,
  `created_at` datetime NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ab_page`
--

CREATE TABLE IF NOT EXISTS `ab_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(70) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `head` varchar(255) NOT NULL,
  `leader` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `page_type` enum('page','directory') NOT NULL DEFAULT 'page',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `userid` int(11) NOT NULL,
  `is_published` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `head` (`head`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ab_page`
--

INSERT INTO `ab_page` (`id`, `meta_title`, `meta_description`, `meta_keywords`, `uri`, `image`, `head`, `leader`, `category_id`, `page_type`, `created_at`, `modified_at`, `userid`, `is_published`) VALUES
(1, '27 Feb1 Title', '27 Feb1 Description', '27 Feb1 Keywords', '27-feb1-h1-tag', '', '27 Feb1 H1 Tag', '', 1, 'directory', '2014-02-27 11:11:07', '2014-02-27 11:11:53', 1, 0),
(2, '27 Feb2 Title', '27 Feb2 Meta Description', '27 Feb2 Meta Keywords', '27-feb2-url', '', '27 Feb2 H1 Tag', '', 2, 'directory', '2014-02-27 11:12:49', '2014-02-27 11:26:27', 1, 0),
(3, '27 Feb3 Title', '27 Feb3 Meta Description', '27 Feb3 Meta Keywords', '27-feb3-url', 'a:5:{s:8:"alt_text";s:40:"This is a test image upload for category";s:10:"title_text";s:46:"This is a test image upload Title for category";s:5:"width";s:2:"40";s:6:"height";s:2:"40";s:9:"file_name";s:22:"category1-filename.jpg";}', '27 Feb3 H1 tag', 'in PHPMyAdmin it shows all the rows there in the column a\r\n\r\nwhy would this query not work?\r\ntest\r\nHello', 3, 'directory', '2014-02-27 11:13:13', '2014-02-28 11:08:26', 1, 0),
(4, 'Page1 Meta Title', 'Page1 Meta Description', 'Page1 Meta Keywords', 'page1-url', '', 'Page1 H1 tag', '', 3, 'page', '2014-02-27 11:25:09', '2014-05-09 08:03:30', 1, 0),
(5, '', '', '', 'demo-page-h1-tag', '', 'Demo Page H1 tag', '', 3, 'page', '2014-03-19 10:35:18', '2014-04-25 13:20:08', 1, 0),
(6, '', '', '', 'h1-tag22', '', 'H1 tag:', '', 3, 'page', '2014-04-25 12:10:07', '2014-05-09 08:03:39', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ab_page_content`
--

CREATE TABLE IF NOT EXISTS `ab_page_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ab_page_content`
--

INSERT INTO `ab_page_content` (`id`, `page_id`, `content`, `created_at`) VALUES
(1, 1, '', '2014-02-27 11:11:07'),
(2, 2, '', '2014-02-27 11:12:49'),
(3, 3, 'in PHPMyAdmin it shows all the rows there in the column a\r\n\r\nwhy would this query not work?\r\n<b>test</b>\r\n<p>Hello</p>', '2014-02-28 11:08:26'),
(4, 4, '', '2014-02-27 11:25:09'),
(5, 5, '', '2014-03-19 10:35:18'),
(6, 6, '', '2014-04-25 12:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `ab_user`
--

CREATE TABLE IF NOT EXISTS `ab_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `last_access` datetime NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ab_user`
--

INSERT INTO `ab_user` (`id`, `name`, `email`, `passwd`, `last_access`, `is_active`) VALUES
(1, 'Mahavir Munot', 'veer712@gmail.com', '9adae88d4114c5e6212de9c9a36929d7', '2013-10-19 16:17:07', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
