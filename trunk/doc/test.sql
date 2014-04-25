# MySQL-Front 5.0  (Build 1.33)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;


# Host: 127.0.0.1    Database: test
# ------------------------------------------------------
# Server version 5.1.34-community

USE `test`;

#
# Table structure for table test
#

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (

  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,

  `name` varchar(32) DEFAULT NULL,

  PRIMARY KEY (`id`)

) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Dumping data for table test
#

INSERT INTO `test` VALUES (1,'张三');
INSERT INTO `test` VALUES (2,'李四');
INSERT INTO `test` VALUES (3,'三国杀');

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
