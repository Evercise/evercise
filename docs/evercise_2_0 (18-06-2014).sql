-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2014 at 04:19 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evercise_2_0`
--
CREATE DATABASE IF NOT EXISTS `evercise_2_0` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `evercise_2_0`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Workout', 'Do you want to be physically challenged? Is your goal to tone up, gain muscle, lose weight or combat stress? Choose a workout, either indoors or outdoors, with a qualified instructor who can offer you great advice on your training regime.', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 'Sports', 'Do you want to be coached in a competitive sport involving teams, giving you a chance to meet and bond with new people? (or you can sign up with a group of people you know!) Work together to get fit, learn a skill and have great fun while youre at it!', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(3, 'Healthy Living', 'Do you want to learn about nutritional, physical, emotional and spiritual practices and how to balance these factors in order to achieve a healthy lifestyle? Find therapists, practitioners, dieticians and trainers to help you strike the balance!', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(4, 'Nutrition', 'Find nutritional specialists who will help you learn what, how and when to eat in order to boost your energy levels and achieve maximum health and fitness. Get nutritional advice from the experts and learn healthy recipes.', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(5, 'Injury Recovery', 'Is your goal to recover from an injury? Would you benefit from physiotherapy, or would you like to learn exercise techniques to overcome damage to the body, and the safest ways to exercise without aggravating an injury? Find specialists who offer expert t', '2014-06-17 14:20:21', '2014-06-17 14:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `evercisegroups`
--

CREATE TABLE IF NOT EXISTS `evercisegroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `venue_id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postcode` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `default_duration` int(11) NOT NULL,
  `default_price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `evercisegroups_user_id_foreign` (`user_id`),
  KEY `evercisegroups_category_id_foreign` (`category_id`),
  KEY `evercisegroups_venue_id_foreign` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `evercisegroups`
--

INSERT INTO `evercisegroups` (`id`, `user_id`, `category_id`, `venue_id`, `name`, `title`, `description`, `address`, `town`, `postcode`, `lat`, `lng`, `image`, `capacity`, `default_duration`, `default_price`, `published`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 2, 'Zool Class', '', 'Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool Learn to play Zool', NULL, NULL, NULL, '0.00000000', '0.00000000', '1403018955_zool.png', 13, 35, '7.50', 0, '2014-06-17 14:30:53', '2014-06-17 14:30:53'),
(2, 2, 2, 3, 'Ducktales', '', 'Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo Ducktales woo-oo-oo ', NULL, NULL, NULL, '0.00000000', '0.00000000', '1403019080_Duck_Tales_Art.png', 15, 35, '24.00', 0, '2014-06-17 14:33:39', '2014-06-17 14:33:39'),
(3, 2, 3, 4, 'Adventure time', '', 'Adventure time, go grab your friends. Adventure time, go grab your friends. Adventure time, go grab your friends. Adventure time, go grab your friends. Adventure time, go grab your friends. ', NULL, NULL, NULL, '0.00000000', '0.00000000', '1403019250_adventure_time.jpg', 97, 80, '11.50', 0, '2014-06-17 14:35:14', '2014-06-17 14:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `evercisesessions`
--

CREATE TABLE IF NOT EXISTS `evercisesessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `evercisegroup_id` int(10) unsigned NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `members` int(11) NOT NULL DEFAULT '0',
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `duration` int(11) NOT NULL,
  `members_emailed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `evercisesessions_evercisegroup_id_foreign` (`evercisegroup_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `evercisesessions`
--

INSERT INTO `evercisesessions` (`id`, `evercisegroup_id`, `date_time`, `members`, `price`, `duration`, `members_emailed`, `created_at`, `updated_at`) VALUES
(1, 3, '2014-06-18 11:00:01', 0, '11.50', 80, 0, '2014-06-17 14:35:25', '2014-06-17 14:35:25'),
(2, 3, '2014-06-19 16:00:00', 0, '11.50', 80, 0, '2014-06-17 14:35:35', '2014-06-17 14:35:35'),
(3, 3, '2014-06-26 11:00:00', 0, '11.50', 80, 0, '2014-06-17 14:35:42', '2014-06-17 14:35:42'),
(4, 3, '2014-07-26 11:00:00', 0, '67.50', 90, 0, '2014-06-17 14:35:52', '2014-06-17 14:35:52'),
(5, 3, '2014-08-25 11:00:00', 0, '33.50', 50, 0, '2014-06-17 14:36:03', '2014-06-17 14:36:03'),
(6, 3, '2014-05-23 11:00:00', 0, '11.50', 80, 0, '2014-06-17 14:36:13', '2014-06-17 14:36:13'),
(7, 1, '2014-06-19 11:00:00', 0, '7.50', 35, 0, '2014-06-17 14:36:20', '2014-06-17 14:36:20'),
(10, 1, '2014-07-19 11:00:00', 0, '7.50', 35, 0, '2014-06-17 14:37:01', '2014-06-17 14:37:01'),
(11, 2, '2014-06-18 18:00:00', 0, '24.00', 35, 0, '2014-06-17 14:37:13', '2014-06-17 14:37:13'),
(12, 2, '2014-04-03 16:00:00', 0, '55.50', 35, 0, '2014-06-17 14:37:24', '2014-06-17 14:37:24'),
(13, 2, '2014-08-09 11:00:00', 0, '24.00', 35, 0, '2014-06-17 14:37:33', '2014-06-17 14:37:33'),
(14, 1, '2014-03-07 12:03:03', 0, '7.50', 35, 0, '2014-06-17 14:37:39', '2014-06-17 14:37:39'),
(15, 2, '2014-08-25 11:00:00', 0, '24.00', 35, 0, '2014-06-17 14:37:49', '2014-06-17 14:37:49'),
(16, 1, '2014-08-06 11:00:00', 0, '7.50', 35, 0, '2014-06-18 13:52:36', '2014-06-18 13:52:36'),
(18, 1, '2014-07-18 11:00:00', 0, '7.50', 35, 0, '2014-06-18 13:52:49', '2014-06-18 13:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE IF NOT EXISTS `facilities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `category`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Rowing Machine', 'facility', 'rowing.png', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 'Toilets', 'Amenity', 'toilets', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(3, 'Car Park', 'Amenity', 'carpark', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(4, 'Hall', 'facility', 'hall', '2014-06-17 14:20:21', '2014-06-17 14:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `featuredgymgroups`
--

CREATE TABLE IF NOT EXISTS `featuredgymgroups` (
  `user_id` int(10) unsigned NOT NULL,
  `evercisegroup_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `featuredgymgroups_user_id_foreign` (`user_id`),
  KEY `featuredgymgroups_evercisegroup_id_foreign` (`evercisegroup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 'User', '{"user":1}', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 'Facebook', '{"facebook":1}', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(3, 'Trainer', '{"trainer":1}', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(4, 'Admin', '{"admin":1}', '2014-06-17 14:20:21', '2014-06-17 14:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `gyms`
--

CREATE TABLE IF NOT EXISTS `gyms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `directory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `background_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `gyms_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `gyms`
--

INSERT INTO `gyms` (`id`, `user_id`, `name`, `title`, `description`, `directory`, `logo_image`, `background_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Evercise', 'Evercise Gym', 'Its super cool', '', '', '', '2014-06-17 14:20:21', '2014-06-17 14:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `gym_has_trainers`
--

CREATE TABLE IF NOT EXISTS `gym_has_trainers` (
  `status` tinyint(4) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `gym_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `gym_has_trainers_user_id_foreign` (`user_id`),
  KEY `gym_has_trainers_gym_id_foreign` (`gym_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historytypes`
--

CREATE TABLE IF NOT EXISTS `historytypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `historytypes`
--

INSERT INTO `historytypes` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'created_class', 'a new evercisegroup has been created by a trainer', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 'added_session', 'a trainer has added a new session to evercisegroup', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(3, 'deleted_group', 'a trainer has deleted an evercisegroup / class', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'deleted_session', 'a trainer has deleted a session', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'joined_group', 'a user joined an evercisegroup / class', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'rated_session', 'a user has left a rating for a session', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `marketingpreferences`
--

CREATE TABLE IF NOT EXISTS `marketingpreferences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `option` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `marketingpreferences`
--

INSERT INTO `marketingpreferences` (`id`, `name`, `option`, `created_at`, `updated_at`) VALUES
(1, 'newsletter', 'yes', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 'newsletter', 'no', '2014-06-17 14:20:21', '2014-06-17 14:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_04_10_131418_create_ratings_table', 1),
('2012_12_06_225921_migration_cartalyst_sentry_install_users', 2),
('2012_12_06_225929_migration_cartalyst_sentry_install_groups', 2),
('2012_12_06_225945_migration_cartalyst_sentry_install_users_groups_pivot', 2),
('2012_12_06_225988_migration_cartalyst_sentry_install_throttle', 2),
('2014_04_10_132455_create_users_table', 1),
('2014_04_10_133144_create_sessions_table', 1),
('2014_04_10_133231_create_gyms_table', 1),
('2014_04_28_162518_create_trainers_table', 1),
('2014_04_29_102623_create_evercisegroups_table', 1),
('2014_04_29_115814_create_trainerhistory_table', 1),
('2014_04_29_115921_create_categories_table', 1),
('2014_04_29_120027_create_user_has_categories_table', 1),
('2014_04_29_120131_create_user_has_marketingpreferences_table', 1),
('2014_04_29_120250_create_marketingpreferences_table', 1),
('2014_04_29_120401_create_sessionmembers_table', 1),
('2014_04_29_123525_create_featuredgymgroup_table', 1),
('2014_04_29_123635_create_specialities_table', 1),
('2014_05_02_104031_create_gym_has_trainers_table', 1),
('2014_06_10_103106_create_venues_table', 1),
('2014_06_10_104152_create_facilities_table', 1),
('2014_06_10_104338_create_venue_facilities_table', 1),
('2014_06_16_112856_create_historytypes_table', 1),
('2014_06_16_112956_create_foreign_keys', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `sessionmember_id` int(10) unsigned NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  `evercisegroup_id` int(10) unsigned NOT NULL,
  `user_created_id` int(10) unsigned NOT NULL,
  `stars` tinyint(4) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `ratings_user_id_foreign` (`user_id`),
  KEY `ratings_sessionmember_id_foreign` (`sessionmember_id`),
  KEY `ratings_session_id_foreign` (`session_id`),
  KEY `ratings_evercisegroup_id_foreign` (`evercisegroup_id`),
  KEY `ratings_user_created_id_foreign` (`user_created_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `sessionmember_id`, `session_id`, `evercisegroup_id`, `user_created_id`, `stars`, `comment`, `created_at`, `updated_at`) VALUES
(7, 2, 10, 12, 2, 4, 2, 'It was pretty exciting', '2014-06-17 15:29:27', '2014-06-17 15:29:27'),
(16, 1, 7, 14, 1, 4, 5, 'asdfs', '2014-06-18 10:18:13', '2014-06-18 10:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `sessionmembers`
--

CREATE TABLE IF NOT EXISTS `sessionmembers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `evercisesession_id` int(10) unsigned NOT NULL,
  `price` decimal(6,2) NOT NULL DEFAULT '0.00',
  `reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `sessionmembers_user_id_foreign` (`user_id`),
  KEY `sessionmembers_evercisesession_id_foreign` (`evercisesession_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `sessionmembers`
--

INSERT INTO `sessionmembers` (`id`, `user_id`, `evercisesession_id`, `price`, `reviewed`, `created_at`, `updated_at`) VALUES
(6, 3, 6, '0.00', 0, '2014-06-17 14:50:50', '2014-06-17 14:50:50'),
(7, 4, 14, '0.00', 0, '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(8, 4, 10, '0.00', 0, '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(9, 4, 11, '0.00', 0, '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(10, 4, 12, '0.00', 0, '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(11, 5, 15, '0.00', 0, '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(12, 5, 12, '0.00', 0, '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(13, 5, 1, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(14, 5, 2, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(15, 5, 3, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(16, 5, 6, '0.00', 0, '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(17, 4, 6, '0.00', 0, '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(18, 4, 4, '0.00', 0, '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(19, 4, 3, '0.00', 0, '2014-06-17 15:14:16', '2014-06-17 15:14:16');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE IF NOT EXISTS `specialities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `titles` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `name`, `titles`, `created_at`, `updated_at`) VALUES
(1, 'kickboxing', 'coach', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 'kickboxing', 'trainer', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(3, 'yoga', 'guy', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(4, 'yoga', 'girl', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(5, 'yoga', 'trainer', '2014-06-17 14:20:21', '2014-06-17 14:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `throttle_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 2, NULL, 0, 0, 0, NULL, NULL, NULL),
(2, 3, '::1', 0, 0, 0, NULL, NULL, NULL),
(3, 4, '::1', 0, 0, 0, NULL, NULL, NULL),
(4, 5, '::1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainerhistory`
--

CREATE TABLE IF NOT EXISTS `trainerhistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `historytype_id` int(10) unsigned NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `trainerhistory_user_id_foreign` (`user_id`),
  KEY `trainerhistory_historytype_id_foreign` (`historytype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=48 ;

--
-- Dumping data for table `trainerhistory`
--

INSERT INTO `trainerhistory` (`id`, `user_id`, `historytype_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Tristan_Allen created Class Zool Class', '2014-06-17 14:30:53', '2014-06-17 14:30:53'),
(2, 2, 1, 'Tristan_Allen created Class Ducktales', '2014-06-17 14:33:39', '2014-06-17 14:33:39'),
(3, 2, 1, 'Tristan_Allen created Class Adventure time', '2014-06-17 14:35:14', '2014-06-17 14:35:14'),
(4, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 18th June 2014', '2014-06-17 14:35:25', '2014-06-17 14:35:25'),
(5, 2, 2, 'Tristan_Allen added a new date to Adventure time at 05:00pm on the 19th June 2014', '2014-06-17 14:35:35', '2014-06-17 14:35:35'),
(6, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 26th June 2014', '2014-06-17 14:35:42', '2014-06-17 14:35:42'),
(7, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 26th July 2014', '2014-06-17 14:35:52', '2014-06-17 14:35:52'),
(8, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 25th August 2014', '2014-06-17 14:36:03', '2014-06-17 14:36:03'),
(9, 2, 2, 'Tristan_Allen added a new date to Adventure time at 12:00pm on the 23rd October 2014', '2014-06-17 14:36:13', '2014-06-17 14:36:13'),
(10, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 19th June 2014', '2014-06-17 14:36:20', '2014-06-17 14:36:20'),
(11, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 18th July 2014', '2014-06-17 14:36:28', '2014-06-17 14:36:28'),
(12, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 06th August 2014', '2014-06-17 14:36:37', '2014-06-17 14:36:37'),
(13, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 19th July 2014', '2014-06-17 14:37:01', '2014-06-17 14:37:01'),
(14, 2, 2, 'Tristan_Allen added a new date to Ducktales at 07:00pm on the 18th June 2014', '2014-06-17 14:37:13', '2014-06-17 14:37:13'),
(15, 2, 2, 'Tristan_Allen added a new date to Ducktales at 05:00pm on the 03rd July 2014', '2014-06-17 14:37:24', '2014-06-17 14:37:24'),
(16, 2, 2, 'Tristan_Allen added a new date to Ducktales at 12:00pm on the 09th August 2014', '2014-06-17 14:37:33', '2014-06-17 14:37:33'),
(17, 2, 2, 'Tristan_Allen added a new date to Zool Class at 12:00pm on the 05th July 2014', '2014-06-17 14:37:39', '2014-06-17 14:37:39'),
(18, 2, 2, 'Tristan_Allen added a new date to Ducktales at 12:00pm on the 25th August 2014', '2014-06-17 14:37:49', '2014-06-17 14:37:49'),
(22, 2, 5, 'red ranger has joined Adventure time at 12:00pm on the 23rd October 2014', '2014-06-17 14:50:50', '2014-06-17 14:50:50'),
(23, 2, 5, 'yellow ranger has joined Zool Class at 12:00pm on the 05th July 2014', '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(24, 2, 5, 'yellow ranger has joined Zool Class at 12:00pm on the 19th July 2014', '2014-06-17 14:51:51', '2014-06-17 14:51:51'),
(25, 2, 5, 'yellow ranger has joined Ducktales at 07:00pm on the 18th June 2014', '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(26, 2, 5, 'yellow ranger has joined Ducktales at 05:00pm on the 03rd July 2014', '2014-06-17 14:52:23', '2014-06-17 14:52:23'),
(27, 2, 5, 'green ranger has joined Ducktales at 05:00pm on the 03rd July 2014', '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(28, 2, 5, 'green ranger has joined Ducktales at 12:00pm on the 25th August 2014', '2014-06-17 14:56:45', '2014-06-17 14:56:45'),
(29, 2, 5, 'green ranger has joined Adventure time at 12:00pm on the 18th June 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(30, 2, 5, 'green ranger has joined Adventure time at 05:00pm on the 19th June 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(31, 2, 5, 'green ranger has joined Adventure time at 12:00pm on the 26th June 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(32, 2, 5, 'green ranger has joined Adventure time at 12:00pm on the 23rd October 2014', '2014-06-17 14:57:10', '2014-06-17 14:57:10'),
(33, 2, 5, 'yellow ranger has joined Adventure time at 12:00pm on the 23rd May 2014', '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(34, 2, 5, 'yellow ranger has joined Adventure time at 12:00pm on the 26th June 2014', '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(35, 2, 5, 'yellow ranger has joined Adventure time at 12:00pm on the 26th July 2014', '2014-06-17 15:14:16', '2014-06-17 15:14:16'),
(37, 2, 6, 'yellow ranger has left a review of Zool Class at 12:00pm on the 18th June 2014', '2014-06-17 15:29:27', '2014-06-17 15:29:27'),
(39, 2, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:00:58', '2014-06-18 10:00:58'),
(40, 2, 6, 'yellow ranger has left a review of Ducktales at 12:00pm on the 23rd May 2014', '2014-06-18 10:02:33', '2014-06-18 10:02:33'),
(41, 1, 6, 'yellow ranger has left a review of Adventure time at 12:00pm on the 23rd May 2014', '2014-06-18 10:11:13', '2014-06-18 10:11:13'),
(42, 2, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:13:34', '2014-06-18 10:13:34'),
(43, 2, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:14:01', '2014-06-18 10:14:01'),
(44, 2, 6, 'yellow ranger has left a review of Adventure time at 12:00pm on the 23rd May 2014', '2014-06-18 10:14:52', '2014-06-18 10:14:52'),
(45, 4, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:17:08', '2014-06-18 10:17:08'),
(46, 1, 6, 'yellow ranger has left a review of Zool Class at 12:03pm on the 07th March 2014', '2014-06-18 10:18:13', '2014-06-18 10:18:13'),
(47, 2, 6, 'yellow ranger has left a review of Zool Class at 12:00pm on the 23rd May 2014', '2014-06-18 10:23:23', '2014-06-18 10:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE IF NOT EXISTS `trainers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `bio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `specialities_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `trainers_user_id_foreign` (`user_id`),
  KEY `trainers_specialities_id_foreign` (`specialities_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `user_id`, `bio`, `website`, `specialities_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Invader Zim Invader Zim Invader Zim Invader Zim Invader Zim Invader Zim Invader Zim ', '', 5, '2014-06-17 14:28:17', '2014-06-17 14:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `display_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `dob` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `directory` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `categories` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `display_name`, `gender`, `dob`, `phone`, `directory`, `image`, `categories`, `remember_token`) VALUES
(1, 'admin@evercise.com', '$2y$10$OzLeZoVjb2292Z8TljBKaOdPRIhEZqNuqv0qpUxyBETaBSvRTdZBm', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-06-17 14:20:21', '2014-06-17 14:20:21', '', 0, '0000-00-00 00:00:00', '', '', '', '', NULL),
(2, 'furryfool@gmail.com', '$2y$10$rdJPaqQWgXkMAAKtOiA8wePBFYVC5Ua1Y4dvX2Ykh.z6IC43riKgq', NULL, 1, NULL, NULL, '2014-06-18 13:41:13', '$2y$10$VcozfeYGFzEnQxANPSoCc.9Vz8MHfMzMsSZoGGmsvJeo2bVo49pGu', NULL, 'Invader', 'Zim', '2014-06-17 14:20:36', '2014-06-18 13:41:13', 'Tristan_Allen', 1, '1970-01-22 00:00:00', '', '2014-06/2_Tristan_Allen', '1403018463_4226.jpg', '', NULL),
(3, 'red@ranger.com', '$2y$10$bD.lufaoOCbYtMUd3y2XueWzGsm4X4V4tB99Zhv4ZX0apW9igHDEO', NULL, 1, '', NULL, '2014-06-17 14:58:37', '$2y$10$gX.WLalIjmPV1Y53BDmuJ.aYsWY87GRhqX0foo6X9KW.FLhohUYpm', NULL, 'red', 'ranger', '2014-06-17 14:22:33', '2014-06-17 14:58:37', 'red ranger', 1, '1984-06-06 23:00:00', '', '2014-06/3_red ranger', '1403019513_6177574_orig.jpg', '', NULL),
(4, 'yellow@ranger.com', '$2y$10$tfuZV/f11td0rRvQ4ivQDuMrJxfH.O4ntG2oy5oJ.GSQjKuSG5FxW', NULL, 1, '', NULL, '2014-06-18 09:07:11', '$2y$10$YmxK3kSE5RNZqmma02DP4.RE30siQwEhuzI74QzhB.KOdHBGGOPpe', NULL, 'yellow', 'ranger', '2014-06-17 14:23:22', '2014-06-18 09:07:11', 'yellow ranger', 2, '1984-06-28 23:00:00', '', '2014-06/4_yellow ranger', '1403020755_6177574_orig.jpg', '', NULL),
(5, 'green@ranger.com', '$2y$10$suFT9/bSLDSDmbZacP7iBenrkHdVz/AA2Mrkq/C2IIuiOAJisCCZ2', NULL, 1, '', NULL, '2014-06-17 14:52:51', '$2y$10$Nbq0RyuIz93123AAy1eKreMT9ZSFbuUkBUBNQPmfbZsEHP5nNlHAS', NULL, 'green', 'ranger', '2014-06-17 14:24:03', '2014-06-17 14:53:15', 'green ranger', 1, '1974-06-05 23:00:00', '', '2014-06/5_green ranger', '1403020393_6177574_orig.jpg', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_categories`
--

CREATE TABLE IF NOT EXISTS `user_has_categories` (
  `user_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `user_has_categories_user_id_foreign` (`user_id`),
  KEY `user_has_categories_category_id_foreign` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_marketingpreferences`
--

CREATE TABLE IF NOT EXISTS `user_marketingpreferences` (
  `user_id` int(10) unsigned NOT NULL,
  `marketingpreference_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `user_marketingpreferences_user_id_foreign` (`user_id`),
  KEY `user_marketingpreferences_marketingpreference_id_foreign` (`marketingpreference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_marketingpreferences`
--

INSERT INTO `user_marketingpreferences` (`user_id`, `marketingpreference_id`, `created_at`, `updated_at`) VALUES
(2, 1, '2014-06-17 14:20:36', '2014-06-17 14:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `town` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(10,8) NOT NULL,
  `lng` decimal(11,8) NOT NULL,
  `image` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `venues_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `user_id`, `name`, `address`, `town`, `postcode`, `lat`, `lng`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Greenlight', 'Cally Road', 'London', 'h4', '51.50682494', '-0.15704746', '', '2014-06-17 14:20:21', '2014-06-17 14:20:21'),
(2, 2, 'brent cross', '', 'Londonbrent cross', '', '51.57635890', '-0.22369560', '', '2014-06-17 14:30:03', '2014-06-17 14:30:03'),
(3, 2, 'Abergavenny', '', 'abergavenny', '', '51.82536600', '-3.01942300', '', '2014-06-17 14:33:31', '2014-06-17 14:33:31'),
(4, 2, 'Ooo', '', 'ooo', '', '36.01075890', '10.31169500', '', '2014-06-17 14:35:04', '2014-06-17 14:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `venue_facilities`
--

CREATE TABLE IF NOT EXISTS `venue_facilities` (
  `venue_id` int(10) unsigned NOT NULL,
  `facility_id` int(10) unsigned NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `venue_facilities_venue_id_foreign` (`venue_id`),
  KEY `venue_facilities_facility_id_foreign` (`facility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venue_facilities`
--

INSERT INTO `venue_facilities` (`venue_id`, `facility_id`, `details`, `created_at`, `updated_at`) VALUES
(2, 2, '', '2014-06-17 14:30:03', '2014-06-17 14:30:03'),
(2, 3, '', '2014-06-17 14:30:03', '2014-06-17 14:30:03'),
(3, 1, '', '2014-06-17 14:33:31', '2014-06-17 14:33:31'),
(4, 2, '', '2014-06-17 14:35:04', '2014-06-17 14:35:04');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evercisegroups`
--
ALTER TABLE `evercisegroups`
  ADD CONSTRAINT `evercisegroups_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`),
  ADD CONSTRAINT `evercisegroups_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `evercisegroups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `evercisesessions`
--
ALTER TABLE `evercisesessions`
  ADD CONSTRAINT `evercisesessions_evercisegroup_id_foreign` FOREIGN KEY (`evercisegroup_id`) REFERENCES `evercisegroups` (`id`);

--
-- Constraints for table `featuredgymgroups`
--
ALTER TABLE `featuredgymgroups`
  ADD CONSTRAINT `featuredgymgroups_evercisegroup_id_foreign` FOREIGN KEY (`evercisegroup_id`) REFERENCES `evercisegroups` (`id`),
  ADD CONSTRAINT `featuredgymgroups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `gyms`
--
ALTER TABLE `gyms`
  ADD CONSTRAINT `gyms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `gym_has_trainers`
--
ALTER TABLE `gym_has_trainers`
  ADD CONSTRAINT `gym_has_trainers_gym_id_foreign` FOREIGN KEY (`gym_id`) REFERENCES `gyms` (`id`),
  ADD CONSTRAINT `gym_has_trainers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_user_created_id_foreign` FOREIGN KEY (`user_created_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_evercisegroup_id_foreign` FOREIGN KEY (`evercisegroup_id`) REFERENCES `evercisegroups` (`id`),
  ADD CONSTRAINT `ratings_sessionmember_id_foreign` FOREIGN KEY (`sessionmember_id`) REFERENCES `sessionmembers` (`id`),
  ADD CONSTRAINT `ratings_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `evercisesessions` (`id`),
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `sessionmembers`
--
ALTER TABLE `sessionmembers`
  ADD CONSTRAINT `sessionmembers_evercisesession_id_foreign` FOREIGN KEY (`evercisesession_id`) REFERENCES `evercisesessions` (`id`),
  ADD CONSTRAINT `sessionmembers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trainerhistory`
--
ALTER TABLE `trainerhistory`
  ADD CONSTRAINT `trainerhistory_historytype_id_foreign` FOREIGN KEY (`historytype_id`) REFERENCES `historytypes` (`id`),
  ADD CONSTRAINT `trainerhistory_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trainers`
--
ALTER TABLE `trainers`
  ADD CONSTRAINT `trainers_specialities_id_foreign` FOREIGN KEY (`specialities_id`) REFERENCES `specialities` (`id`),
  ADD CONSTRAINT `trainers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_has_categories`
--
ALTER TABLE `user_has_categories`
  ADD CONSTRAINT `user_has_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `user_has_categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_marketingpreferences`
--
ALTER TABLE `user_marketingpreferences`
  ADD CONSTRAINT `user_marketingpreferences_marketingpreference_id_foreign` FOREIGN KEY (`marketingpreference_id`) REFERENCES `marketingpreferences` (`id`),
  ADD CONSTRAINT `user_marketingpreferences_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `venues`
--
ALTER TABLE `venues`
  ADD CONSTRAINT `venues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `venue_facilities`
--
ALTER TABLE `venue_facilities`
  ADD CONSTRAINT `venue_facilities_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`),
  ADD CONSTRAINT `venue_facilities_venue_id_foreign` FOREIGN KEY (`venue_id`) REFERENCES `venues` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
