-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2015 at 05:05 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eagle`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_level` int(10) unsigned NOT NULL DEFAULT '0',
  `menu_order` int(10) unsigned NOT NULL DEFAULT '100',
  `menu_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_pid` int(10) unsigned DEFAULT NULL,
  `menu_active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `menu_icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `menu_group` (`menu_group`),
  KEY `menu_level` (`menu_level`),
  KEY `menu_order` (`menu_order`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_group`, `menu_name`, `menu_level`, `menu_order`, `menu_link`, `menu_permission`, `menu_pid`, `menu_active`, `menu_icon`) VALUES
(1, 'Admin', '(Root)', 1, 0, '/', 'index_index_index', NULL, 1, ''),
(2, 'Admin', 'Install', 2, 0, '/core/install', '*_*_*', 1, 1, ''),
(3, 'Admin', 'Menus', 2, 1, '/menus', 'menus_*_*', 1, 1, ''),
(4, 'Admin', 'Roles', 2, 0, '/auth/roles', 'auth_*_*', 3, 1, ''),
(5, 'Front', 'Home', 1, 0, '/', 'index_*_*', NULL, 1, ''),
(6, 'Admin', 'Exit', 0, 2, '/auth/index/exit', 'auth_index_exit', 1, 1, ''),
(7, 'Front', 'Auth', 1, 0, '/auth', 'auth_index_index', 5, 1, ''),
(8, 'Front', 'Contact', 1, 1, '/contact', 'index_index_*', 5, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `permission_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_mca` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permission_active` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`),
  KEY `permission_data` (`permission_mca`),
  KEY `permission_active` (`permission_active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission_name`, `permission_mca`, `permission_active`) VALUES
(1, 'User can Login / Logout', 'auth_index_*', 1),
(2, 'Can view Default module, index controller', 'index_index_*', 1),
(3, 'God Permission', '*_*_*', 1),
(4, 'Install modules', 'core_install_*', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_active` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`),
  KEY `role_name` (`role_name`),
  KEY `role_active` (`role_active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_active`) VALUES
(1, 'god', 1),
(2, 'administrator', 1),
(3, 'guest', 1),
(4, 'NewRole', 0),
(5, 'SecondNew', 0);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `fk_permissions_r_p_permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(2, 1),
(0, 2),
(1, 2),
(2, 2),
(1, 3),
(1, 4),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_active` int(3) unsigned NOT NULL DEFAULT '0',
  `user_created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_name` (`user_name`),
  KEY `user_email` (`user_email`),
  KEY `user_active` (`user_active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_active`, `user_created`) VALUES
(1, 'ionut', 'marcel.toma@endava.com', '$2a$08$JcLm1IONh99AlUCnHfuzZukb82QEvFZoFLTEwSYzJr5gb4MjC5PaS', 1, 0),
(2, 'guest', 'guest', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE IF NOT EXISTS `users_permissions` (
  `user_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `user_permission_type` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `user_permission_type` (`user_permission_type`),
  KEY `fk_permissions_u_p_permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE IF NOT EXISTS `users_roles` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_roles_u_r_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(0, 0),
(1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `fk_permissions_r_p_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`),
  ADD CONSTRAINT `fk_roles_r_p_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);

--
-- Constraints for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD CONSTRAINT `fk_permissions_u_p_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`),
  ADD CONSTRAINT `fk_users_u_p_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD CONSTRAINT `fk_roles_u_r_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `fk_users_u_r_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
