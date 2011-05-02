-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 29, 2010 at 03:25 PM
-- Server version: 5.1.52
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rl50121_vddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `vd_prefs`
--

CREATE TABLE IF NOT EXISTS `vd_prefs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) NOT NULL DEFAULT '',
  `option_value` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`option_name`),
  UNIQUE `option_name` (`option_name`)
);


-- --------------------------------------------------------

--
-- Table structure for table `vd_admin`
--

CREATE TABLE IF NOT EXISTS `vd_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) NOT NULL DEFAULT '',
  `admin_key` varchar(255) NOT NULL DEFAULT '',
  `admin_username` varchar(20) NOT NULL DEFAULT '',
  `admin_password` char(32) NOT NULL DEFAULT '',
  `admin_email` varchar(255) NOT NULL DEFAULT '',
  `date_edited` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `user_login` (`admin_username`)
);


-- --------------------------------------------------------

--
-- Table structure for table `vd_groups`
--

CREATE TABLE IF NOT EXISTS `vd_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`name`),
  UNIQUE `name` (`name`)
);

-- --------------------------------------------------------

--
-- Table structure for table `vd_categories`
--

CREATE TABLE IF NOT EXISTS `vd_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grpid` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `desc` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`grpid`,`name`)
);

-- --------------------------------------------------------

--
-- Table structure for table `vd_seo`
--

CREATE TABLE IF NOT EXISTS `vd_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `mdesc` varchar(255) DEFAULT '',
  `mkeys` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`,`catid`)
);

-- --------------------------------------------------------

--
-- Table structure for table `vd_list`
--

CREATE TABLE IF NOT EXISTS `vd_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grpid` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`,`grpid`,`catid`)
);

-- --------------------------------------------------------
