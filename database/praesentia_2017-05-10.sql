# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.25)
# Database: praesentia
# Generation Time: 2017-05-10 09:17:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table courses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `year` int(10) NOT NULL,
  `period` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;

INSERT INTO `courses` (`id`, `name`, `year`, `period`)
VALUES
	(1,'Wiskunde',2017,1);

/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table group_has_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `group_has_users`;

CREATE TABLE `group_has_users` (
  `user_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `group_has_users` WRITE;
/*!40000 ALTER TABLE `group_has_users` DISABLE KEYS */;

INSERT INTO `group_has_users` (`user_id`, `group_id`)
VALUES
	(11,1),
	(3,1),
	(9,1),
	(10,1);

/*!40000 ALTER TABLE `group_has_users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `school_year` int(10) NOT NULL,
  `period` int(10) NOT NULL,
  `education_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `school_year`, `period`, `education_id`)
VALUES
	(1,'s1b',2017,4,2);

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lecture_has_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lecture_has_groups`;

CREATE TABLE `lecture_has_groups` (
  `group_id` int(10) NOT NULL,
  `lecture_id` int(10) NOT NULL,
  KEY `group_id` (`group_id`,`lecture_id`),
  KEY `lecture_id` (`lecture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table lectures
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lectures`;

CREATE TABLE `lectures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `start_time` varchar(5) NOT NULL DEFAULT '',
  `end_time` varchar(5) NOT NULL DEFAULT '',
  `room_id` int(10) NOT NULL,
  `course_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `room_id` (`room_id`),
  KEY `course_id` (`course_id`,`group_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `lectures` WRITE;
/*!40000 ALTER TABLE `lectures` DISABLE KEYS */;

INSERT INTO `lectures` (`id`, `date`, `start_time`, `end_time`, `room_id`, `course_id`, `group_id`, `user_id`)
VALUES
	(1,'2017-05-08','09:00','11:00',1,1,1,11),
	(2,'2017-05-08','12:00','13:00',1,1,1,11),
	(3,'2017-05-08','14:00','16:00',1,1,1,11),
	(4,'2017-05-09','09:30','11:30',1,1,1,11),
	(5,'2017-05-09','12:00','13:00',1,1,1,11),
	(6,'2017-05-09','13:00','14:00',1,1,1,11),
	(7,'2017-05-09','14:00','15:00',1,1,1,11),
	(8,'2017-05-09','15:00','17:00',1,1,1,11);

/*!40000 ALTER TABLE `lectures` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`id`, `from_user`, `to_user`, `message`, `seen`, `created_at`)
VALUES
	(1,1,2,'5uazu',1,'0000-00-00 00:00:00'),
	(2,1,1,'test',1,'0000-00-00 00:00:00'),
	(3,2,2,'BUTTSBUTTSBUTTSBUTTSBUTT',1,'0000-00-00 00:00:00'),
	(4,2,1,'BUTTSBUTTSBUTTSBUTTSBUTT',1,'0000-00-00 00:00:00'),
	(5,1,9,'Account aangemaakt.',1,'0000-00-00 00:00:00'),
	(6,1,10,'Account aangemaakt.',1,'0000-00-00 00:00:00'),
	(8,11,2,'Gebruiker is gearchiveerd',0,'0000-00-00 00:00:00'),
	(9,11,2,'Nieuwe gebruiker aangemaakt',0,'0000-00-00 00:00:00'),
	(17,11,3,'Aanwezigheid voor Wiskunde op 17-05-08 is op aanwezig gezet.',0,'2017-05-09 13:04:01'),
	(18,11,9,'Aanwezigheid voor Wiskunde op 17-05-08 is op afwezig gezet.',0,'2017-05-09 13:04:01'),
	(19,11,10,'Aanwezigheid voor Wiskunde op 17-05-08 is op afwezig gezet.',0,'2017-05-09 13:04:01'),
	(20,11,11,'Aanwezigheid voor Wiskunde op 17-05-08 is op aanwezig gezet.',0,'2017-05-09 13:04:01'),
	(21,11,3,'Aanwezigheid voor Wiskunde op 17-05-08 is op afwezig gezet.',0,'2017-05-09 13:04:30'),
	(22,11,9,'Aanwezigheid voor Wiskunde op 17-05-08 is op aanwezig gezet.',0,'2017-05-09 13:04:30'),
	(23,11,10,'Aanwezigheid voor Wiskunde op 17-05-08 is op aanwezig gezet.',0,'2017-05-09 13:04:30'),
	(24,11,11,'Aanwezigheid voor Wiskunde op 17-05-08 is op afwezig gezet.',0,'2017-05-09 13:04:30'),
	(25,11,3,'Aanwezigheid voor Wiskunde op 17-05-08 is op afwezig gezet.',0,'2017-05-09 13:07:11'),
	(26,11,9,'Aanwezigheid voor Wiskunde op 17-05-08 is op aanwezig gezet.',0,'2017-05-09 13:07:11'),
	(27,11,10,'Aanwezigheid voor Wiskunde op 17-05-08 is op aanwezig gezet.',0,'2017-05-09 13:07:11'),
	(28,11,11,'Aanwezigheid voor Wiskunde op 17-05-08 is op afwezig gezet.',0,'2017-05-09 13:07:11');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table presence
# ------------------------------------------------------------

DROP TABLE IF EXISTS `presence`;

CREATE TABLE `presence` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `present` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `lecture_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`lecture_id`),
  KEY `lecture_id` (`lecture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `presence` WRITE;
/*!40000 ALTER TABLE `presence` DISABLE KEYS */;

INSERT INTO `presence` (`id`, `present`, `user_id`, `lecture_id`)
VALUES
	(7,0,3,1),
	(8,1,9,1),
	(9,1,10,1),
	(10,0,11,1),
	(11,0,3,1),
	(12,1,9,1),
	(13,1,10,1),
	(14,0,11,1);

/*!40000 ALTER TABLE `presence` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `users` int(11) DEFAULT NULL,
  `presence` int(11) DEFAULT NULL,
  `lectures` int(11) DEFAULT NULL,
  `groups` int(11) DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `title`, `users`, `presence`, `lectures`, `groups`, `rooms`)
VALUES
	(1,'Administratie',1,1,1,1,1);

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `locatie` varchar(255) NOT NULL,
  `number` double(4,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_number` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_number` (`user_number`,`email`),
  UNIQUE KEY `user_number_2` (`user_number`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `user_number`, `email`, `password`)
VALUES
	(3,'Jesse','de boer','12312424','12312@123123.nl','123123'),
	(9,'Henk','henk','123132','123123@123123.nl','123'),
	(10,'test','test','123','123@123.nl','$2y$10$xBS.Ar9oKqEcyVEIg3iAEOqX4yVETglXvZpd0tLzfxPHKfaBOTiGO'),
	(11,'Gerron','Bos','1101696','gerronbos4@hotmail.com','$2y$10$gfdcmL.W8/NC.g09c8iaCuivdRe64DVpErhW4mKrBfliD7kQDCiQG');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
