-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4903
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table c2ms2.articles
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `comment` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.articles: ~1 rows (approximately)
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `content`, `comment`) VALUES
	(1, 'Ik vaar nu zo\'n kleine drie maanden mee en heb het "drakenvirus" zwaar te pakken. Alles eraan vind ik leuk: de manier van trainen; de interactie met teamleden: het lezen van de wolken (zit er wel onweer in of niet) en de fanieke manier van beoefenen. Drakenbootvaren vind je of superleuk of je vindt er niks aan. Ik ben echt verkocht.', 1);
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;


-- Dumping structure for table c2ms2.attendances
DROP TABLE IF EXISTS `attendances`;
CREATE TABLE IF NOT EXISTS `attendances` (
  `event_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  KEY `event_id` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.attendances: ~1 rows (approximately)
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` (`event_id`, `user_id`, `status`) VALUES
	(2, 1, 1);
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;


-- Dumping structure for table c2ms2.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.comments: ~5 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `item_id`, `user_id`, `comment`) VALUES
	(1, 2, 1, 'test'),
	(2, 2, 1, 'nog niets'),
	(3, 1, 1, 'test3'),
	(4, 1, 1, 'test4'),
	(5, 1, 1, 'teset4');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Dumping structure for table c2ms2.events
DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` mediumtext NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `fullday` tinyint(1) NOT NULL DEFAULT '0',
  `attendance` tinyint(1) NOT NULL DEFAULT '0',
  `attend_end` datetime NOT NULL,
  `comment` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.events: ~1 rows (approximately)
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` (`id`, `description`, `start`, `end`, `fullday`, `attendance`, `attend_end`, `comment`) VALUES
	(1, '', '2015-02-15 00:00:00', '2015-02-15 00:00:00', 1, 1, '0000-00-00 00:00:00', 1);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;


-- Dumping structure for table c2ms2.items
DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `module` varchar(50) NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.items: ~2 rows (approximately)
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` (`id`, `slug`, `title`, `module`, `item_id`) VALUES
	(1, 'nk-als-nieuweling', 'NK als nieuweling', 'Models\\Article', 1),
	(2, 'dragontrek-alkmaar-2015', 'Dragontrek Alkmaar', 'Models\\Event', 1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;


-- Dumping structure for table c2ms2.item_topics
DROP TABLE IF EXISTS `item_topics`;
CREATE TABLE IF NOT EXISTS `item_topics` (
  `item_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.item_topics: ~2 rows (approximately)
/*!40000 ALTER TABLE `item_topics` DISABLE KEYS */;
INSERT INTO `item_topics` (`item_id`, `topic_id`) VALUES
	(1, 2),
	(2, 1);
/*!40000 ALTER TABLE `item_topics` ENABLE KEYS */;


-- Dumping structure for table c2ms2.permissions
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission` (`permission`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.permissions: ~17 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `permission`) VALUES
	(7, 'article.comment'),
	(1, 'article.create'),
	(3, 'article.delete'),
	(2, 'article.edit'),
	(10, 'article.view'),
	(12, 'comment.create'),
	(14, 'comment.delete'),
	(13, 'comment.edit'),
	(9, 'event.attend'),
	(8, 'event.comment'),
	(4, 'event.create'),
	(6, 'event.delete'),
	(5, 'event.edit'),
	(11, 'event.view'),
	(19, 'permission.change'),
	(20, 'permission.view'),
	(16, 'user.create'),
	(18, 'user.delete'),
	(17, 'user.edit'),
	(15, 'user.edit-self');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


-- Dumping structure for table c2ms2.topics
DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `category` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.topics: ~4 rows (approximately)
/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` (`id`, `slug`, `title`, `category`) VALUES
	(1, 'wedstrijden', 'Wedstrijden', 1),
	(2, 'nieuws', 'Nieuws', 1),
	(3, 'trainingen', 'Trainingen', 1),
	(4, 'informatie', 'Informatie', 1);
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;


-- Dumping structure for table c2ms2.usergroups
DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE IF NOT EXISTS `usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.usergroups: ~5 rows (approximately)
/*!40000 ALTER TABLE `usergroups` DISABLE KEYS */;
INSERT INTO `usergroups` (`id`, `name`) VALUES
	(0, 'guest'),
	(1, 'admin'),
	(2, 'bestuur'),
	(3, 'tc'),
	(4, 'leden'),
	(6, 'redactie');
/*!40000 ALTER TABLE `usergroups` ENABLE KEYS */;


-- Dumping structure for table c2ms2.usergroup_permissions
DROP TABLE IF EXISTS `usergroup_permissions`;
CREATE TABLE IF NOT EXISTS `usergroup_permissions` (
  `usergroup_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.usergroup_permissions: ~5 rows (approximately)
/*!40000 ALTER TABLE `usergroup_permissions` DISABLE KEYS */;
INSERT INTO `usergroup_permissions` (`usergroup_id`, `permission_id`, `topic_id`) VALUES
	(1, 1, NULL),
	(1, 1, 1),
	(1, 9, NULL),
	(1, 7, NULL),
	(1, 8, NULL);
/*!40000 ALTER TABLE `usergroup_permissions` ENABLE KEYS */;


-- Dumping structure for table c2ms2.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `image` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `password`, `image`) VALUES
	(1, 'admin', '$2y$10$VUpNcC1NSFlqSDE1Yy9qb.pd6xhcJEPmeRJmHN//pL4LObe4hdNuK', 'profiles/erwin.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table c2ms2.user_usergroups
DROP TABLE IF EXISTS `user_usergroups`;
CREATE TABLE IF NOT EXISTS `user_usergroups` (
  `user_id` int(10) unsigned NOT NULL,
  `usergroup_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table c2ms2.user_usergroups: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_usergroups` DISABLE KEYS */;
INSERT INTO `user_usergroups` (`user_id`, `usergroup_id`) VALUES
	(1, 1),
	(1, 4);
/*!40000 ALTER TABLE `user_usergroups` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
