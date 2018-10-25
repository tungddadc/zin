/*
SQLyog Professional v12.09 (64 bit)
MySQL - 10.1.36-MariaDB : Database - corefw
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`corefw` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `corefw`;

/*Table structure for table `st_category` */

DROP TABLE IF EXISTS `st_category`;

CREATE TABLE `st_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'post' COMMENT 'type theo đúng tên controller',
  `order` int(3) DEFAULT '0',
  `is_status` tinyint(2) NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `url_leech` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_category` */

/*Table structure for table `st_category_translations` */

DROP TABLE IF EXISTS `st_category_translations`;

CREATE TABLE `st_category_translations` (
  `id` int(11) NOT NULL,
  `language_code` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `content` mediumtext NOT NULL,
  UNIQUE KEY `ap_category_translations_id_language_code_pk` (`id`,`language_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_category_translations` */

/*Table structure for table `st_groups` */

DROP TABLE IF EXISTS `st_groups`;

CREATE TABLE `st_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `permission` mediumtext,
  `is_status` tinyint(1) DEFAULT '1',
  `created_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `st_groups` */

insert  into `st_groups`(`id`,`name`,`description`,`permission`,`is_status`,`created_time`,`updated_time`) values (1,'admin','Administrator',NULL,1,'2018-10-25 17:16:59','2018-10-25 17:16:59'),(2,'Biên tập viên','Nhóm biên tập quản trị nội dung web','{\"banner\":{\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"groups\":{\"view\":\"1\"},\"media\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"menus\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"page\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"post\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"setting\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"users\":{\"view\":\"1\"}}',1,'2018-10-25 17:16:59','2018-10-25 17:16:59'),(3,'Khách hàng','Cu li',NULL,1,'2018-10-25 17:16:59','2018-10-25 17:16:59');

/*Table structure for table `st_log_action` */

DROP TABLE IF EXISTS `st_log_action`;

CREATE TABLE `st_log_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `st_log_action` */

insert  into `st_log_action`(`id`,`action`,`note`,`uid`,`created_time`) values (1,'category','Update category: 35',1,'2018-10-22 07:21:14'),(2,'category','Update category: 34',1,'2018-10-22 07:21:15'),(3,'category','Update category: 33',1,'2018-10-22 07:21:15'),(4,'category','Update category: 42',1,'2018-10-22 07:21:42'),(5,'category','Update category: 41',1,'2018-10-22 07:21:42'),(6,'category','Update category: 40',1,'2018-10-22 07:21:42'),(7,'category','Update category: 39',1,'2018-10-22 07:21:43'),(8,'category','Update category: 38',1,'2018-10-22 07:21:43'),(9,'category','Update category: 37',1,'2018-10-22 07:21:44'),(10,'category','Update category: 36',1,'2018-10-22 07:21:44');

/*Table structure for table `st_logged_device` */

DROP TABLE IF EXISTS `st_logged_device`;

CREATE TABLE `st_logged_device` (
  `user_id` bigint(20) NOT NULL,
  `ip_address` varchar(45) NOT NULL COMMENT 'IP client',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `device_code` char(32) NOT NULL COMMENT 'Mã md5 thiết bị + key secret',
  `user_agent` varchar(255) NOT NULL COMMENT 'Tên thiết bị',
  UNIQUE KEY `ap_logged_device_user_id_ip_address_user_agent_pk` (`user_id`,`ip_address`,`user_agent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_logged_device` */

/*Table structure for table `st_login_attempts` */

DROP TABLE IF EXISTS `st_login_attempts`;

CREATE TABLE `st_login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_login_attempts` */

/*Table structure for table `st_users` */

DROP TABLE IF EXISTS `st_users`;

CREATE TABLE `st_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `oauth_uid` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `oauth_provider` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8 NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `salt` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `email` varchar(254) CHARACTER SET utf8 NOT NULL,
  `activation_code` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `forgotten_password_code` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `fullname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `first_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address_book` text CHARACTER SET utf8,
  `company` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `created_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `FULLTEXT` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `st_users` */

insert  into `st_users`(`id`,`oauth_uid`,`oauth_provider`,`ip_address`,`username`,`password`,`salt`,`gender`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`fullname`,`first_name`,`last_name`,`address_book`,`company`,`phone`,`created_time`,`updated_time`) values (1,NULL,NULL,'127.0.0.1','admin','$2y$08$ymVkNr.hcUFPFHIaOKWthuw4M4Y6TUW8UfYJYsGqjNNlBEw5nVZie','',0,'contact@apecsoft.asia','',NULL,NULL,NULL,1268889823,1540444984,1,NULL,'Admin','Cây Cảnh',NULL,'Cây Cảnh Ban Công','0999999999','2017-12-17 00:49:09','2018-10-25 12:23:04');

/*Table structure for table `st_users_groups` */

DROP TABLE IF EXISTS `st_users_groups`;

CREATE TABLE `st_users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `st_groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `st_users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `st_users_groups` */

insert  into `st_users_groups`(`id`,`user_id`,`group_id`) values (1,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
