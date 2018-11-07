/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.6.37 : Database - corefw
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `st_category` */

DROP TABLE IF EXISTS `st_category`;

CREATE TABLE `st_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `layout` varchar(100) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT 'post' COMMENT 'type theo đúng tên controller',
  `order` int(3) DEFAULT '0',
  `is_status` tinyint(2) NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `st_category` */

insert  into `st_category`(`id`,`parent_id`,`thumbnail`,`banner`,`layout`,`class`,`type`,`order`,`is_status`,`created_time`,`updated_time`) values (1,0,'',NULL,'',NULL,'product',0,1,'2018-10-28 15:13:38','2018-10-28 23:01:39'),(2,0,'',NULL,'',NULL,'product',0,1,'2018-10-28 15:24:03','2018-11-01 16:33:02'),(3,0,'',NULL,'',NULL,'post',0,1,'2018-10-28 23:01:55','2018-10-28 23:01:55'),(4,0,'',NULL,'',NULL,'post',0,1,'2018-10-28 23:41:21','2018-10-28 23:41:21'),(5,0,'',NULL,'',NULL,'product',0,1,'2018-11-01 16:35:20','2018-11-01 16:36:09'),(6,0,'',NULL,'',NULL,'product',0,1,'2018-11-01 16:48:56','2018-11-01 16:48:56'),(7,0,'',NULL,'',NULL,'product',0,1,'2018-11-01 16:56:44','2018-11-01 17:17:50'),(8,0,'',NULL,'',NULL,'product',0,1,'2018-11-01 17:22:27','2018-11-01 17:22:32'),(9,0,'',NULL,'',NULL,'product',0,1,'2018-11-01 17:22:50','2018-11-01 17:22:50'),(10,0,'',NULL,'',NULL,'brand',0,1,'2018-11-01 17:24:29','2018-11-01 17:24:29'),(11,0,'',NULL,'',NULL,'brand',0,1,'2018-11-01 17:24:37','2018-11-01 17:24:40'),(12,10,'',NULL,'',NULL,'brand',0,1,'2018-11-03 01:01:30','2018-11-03 01:03:12'),(13,10,'',NULL,'',NULL,'brand',0,1,'2018-11-03 01:03:48','2018-11-03 01:03:48');

/*Table structure for table `st_category_translations` */

DROP TABLE IF EXISTS `st_category_translations`;

CREATE TABLE `st_category_translations` (
  `id` int(11) unsigned NOT NULL,
  `language_code` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `content` mediumtext NOT NULL,
  UNIQUE KEY `ap_category_translations_id_language_code_pk` (`id`,`language_code`) USING BTREE,
  CONSTRAINT `st_category_translations_ibfk_1` FOREIGN KEY (`id`) REFERENCES `st_category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_category_translations` */

insert  into `st_category_translations`(`id`,`language_code`,`title`,`description`,`slug`,`meta_title`,`meta_description`,`meta_keyword`,`content`) values (1,'vi','Màn hình','Màn hình','man-hinh','Màn hình','Màn hình','Màn hình',''),(2,'vi','Cảm ứng','Cảm ứng','cam-ung','Cảm ứng','Cảm ứng','Cảm ứng',''),(3,'vi','Tin khuyến mại','Tin khuyến mại','tin-khuyen-mai','Tin khuyến mại','Tin khuyến mại','Tin khuyến mại',''),(4,'vi','Tin công nghệ','Tin công nghệ','tin-cong-nghe','Tin công nghệ','Tin công nghệ','Tin công nghệ',''),(5,'vi','Linh kiện bên ngoài','Linh kiện bên ngoài','linh-kien-ben-ngoai','Linh kiện bên ngoài','Linh kiện bên ngoài','Linh kiện bên ngoài',''),(6,'vi','Linh kiện bên trong','Linh kiện bên trong','linh-kien-ben-trong','Linh kiện bên trong','Linh kiện bên trong','Linh kiện bên trong',''),(7,'vi','Thiết bị sửa chữa','Thiết bị sửa chữa','thiet-bi-sua-chua','Thiết bị sửa chữa','Thiết bị sửa chữa','Thiết bị sửa chữa',''),(8,'vi','Thiết bị ép kính - Ép cổ cáp','Thiết bị ép kính - Ép cổ cáp','thiet-bi-ep-kinh-ep-co-cap','Thiết bị ép kính - Ép cổ cáp','Thiết bị ép kính - Ép cổ cáp','Thiết bị ép kính - Ép cổ cáp',''),(9,'vi','Phụ kiện','Phụ kiện','phu-kien','Phụ kiện','Phụ kiện','Phụ kiện',''),(10,'vi','Samsung','Samsung','samsung','Samsung','Samsung','Samsung',''),(11,'vi','Nokia - Lumia','Nokia - Lumia','nokia-lumia','Nokia - Lumia','Nokia - Lumia','Nokia, Lumia',''),(12,'vi','Màn Hình Samsung Galaxy Smartphone','Màn Hình Samsung Galaxy Smartphone','man-hinh-samsung-galaxy-smartphone','Màn Hình Samsung Galaxy Smartphone','Màn Hình Samsung Galaxy Smartphone','Màn Hình Samsung Galaxy Smartphone',''),(13,'vi','Cảm Ứng Samsung','Cảm Ứng Samsung','cam-ung-samsung','Cảm Ứng Samsung','Cảm Ứng Samsung','Cảm Ứng Samsung','');

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

insert  into `st_groups`(`id`,`name`,`description`,`permission`,`is_status`,`created_time`,`updated_time`) values (1,'admin','Administrator',NULL,1,'2018-10-25 17:16:59','2018-10-25 17:16:59'),(2,'Biên tập viên','Nhóm biên tập quản trị nội dung web','{\"banner\":{\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"groups\":{\"view\":\"1\"},\"media\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"menus\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"page\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"post\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"setting\":{\"view\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"import\":\"1\",\"export\":\"1\"},\"users\":{\"view\":\"1\"}}',1,'2018-10-25 17:16:59','2018-10-26 03:05:06'),(3,'Khách hàng','Nhóm khách hàng',NULL,1,'2018-10-25 17:16:59','2018-10-26 03:04:11');

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

/*Table structure for table `st_menus` */

DROP TABLE IF EXISTS `st_menus`;

CREATE TABLE `st_menus` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#',
  `parent_id` int(2) NOT NULL DEFAULT '0',
  `order` tinyint(2) DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_id` smallint(4) NOT NULL,
  `language_code` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `st_menus` */

insert  into `st_menus`(`id`,`title`,`link`,`parent_id`,`order`,`class`,`location_id`,`language_code`,`type`) values (129,'Trang chủ','/',0,1,'',0,'vi',NULL),(130,'Tin khuyến mại','tin-khuyen-mai-c3',0,2,'',0,'vi',NULL),(138,'Màn hình','man-hinh-cp1',0,1,'',1,'vi',NULL),(139,'Cảm ứng','cam-ung-cp2',0,2,'',1,'vi',NULL),(140,'Linh kiện bên ngoài','linh-kien-ben-ngoai-cp5',0,3,'',1,'vi',NULL),(141,'Linh kiện bên trong','linh-kien-ben-trong-cp6',0,4,'',1,'vi',NULL),(142,'Thiết bị sửa chữa','thiet-bi-sua-chua-cp7',0,5,'',1,'vi',NULL),(143,'Thiết bị ép kính','thiet-bi-ep-kinh-ep-co-cap-cp8',0,6,'',1,'vi',NULL),(144,'Phụ kiện','phu-kien-cp9',0,7,'',1,'vi',NULL);

/*Table structure for table `st_page` */

DROP TABLE IF EXISTS `st_page`;

CREATE TABLE `st_page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) DEFAULT NULL,
  `layout` varchar(100) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `url_video` varchar(255) DEFAULT NULL,
  `is_status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT 'trang thai',
  `displayed_time` datetime DEFAULT NULL COMMENT 'ngay publish',
  `viewed` int(11) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngay tao',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngay sua',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `st_page` */

insert  into `st_page`(`id`,`thumbnail`,`layout`,`banner`,`url_video`,`is_status`,`displayed_time`,`viewed`,`created_time`,`updated_time`) values (1,'','contact','',NULL,1,NULL,9571,'2018-10-29 22:42:02','2018-10-29 22:42:02');

/*Table structure for table `st_page_translations` */

DROP TABLE IF EXISTS `st_page_translations`;

CREATE TABLE `st_page_translations` (
  `id` int(11) unsigned NOT NULL,
  `language_code` varchar(2) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` longtext,
  `meta_title` varchar(100) NOT NULL,
  `meta_description` varchar(170) NOT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  UNIQUE KEY `ap_page_translations_id_language_code_pk` (`id`,`language_code`),
  CONSTRAINT `fk_page_trans_pageid` FOREIGN KEY (`id`) REFERENCES `st_page` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_page_translations` */

insert  into `st_page_translations`(`id`,`language_code`,`slug`,`title`,`description`,`content`,`meta_title`,`meta_description`,`meta_keyword`) values (1,'vi','lien-he','Liên hệ','Liên hệ','<p>Li&ecirc;n hệ</p>','Liên hệ','Liên hệ','Liên hệ');

/*Table structure for table `st_post` */

DROP TABLE IF EXISTS `st_post`;

CREATE TABLE `st_post` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) DEFAULT NULL,
  `url_video` varchar(255) DEFAULT NULL,
  `is_status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT 'trang thai',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_time` datetime DEFAULT NULL COMMENT 'ngay publish',
  `viewed` int(11) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngay tao',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngay sua',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `st_post` */

insert  into `st_post`(`id`,`thumbnail`,`url_video`,`is_status`,`is_featured`,`displayed_time`,`viewed`,`created_time`,`updated_time`) values (1,'',NULL,1,0,NULL,9674,'2018-10-28 22:04:39','2018-10-28 23:44:16');

/*Table structure for table `st_post_category` */

DROP TABLE IF EXISTS `st_post_category`;

CREATE TABLE `st_post_category` (
  `post_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `post_id` (`post_id`,`category_id`),
  KEY `fk_post_id` (`post_id`),
  KEY `fk_category_id` (`category_id`),
  CONSTRAINT `fk_post_category_cateid` FOREIGN KEY (`category_id`) REFERENCES `st_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_category_postid` FOREIGN KEY (`post_id`) REFERENCES `st_post` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `st_post_category` */

insert  into `st_post_category`(`post_id`,`category_id`) values (1,3);

/*Table structure for table `st_post_translations` */

DROP TABLE IF EXISTS `st_post_translations`;

CREATE TABLE `st_post_translations` (
  `id` int(11) unsigned NOT NULL,
  `language_code` varchar(2) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` longtext NOT NULL,
  `meta_title` varchar(100) NOT NULL,
  `meta_description` varchar(170) NOT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  UNIQUE KEY `ap_post_translations_id_language_code_pk` (`id`,`language_code`),
  CONSTRAINT `fk_post_trans_postid` FOREIGN KEY (`id`) REFERENCES `st_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_post_translations` */

insert  into `st_post_translations`(`id`,`language_code`,`slug`,`title`,`description`,`content`,`meta_title`,`meta_description`,`meta_keyword`) values (1,'vi','khuyen-mai-giam-31-duy-nhat-trong-ngay-halloween-2018','Khuyến mại giảm 31% duy nhất trong ngày Halloween 2018','Khuyến mại giảm 31% duy nhất trong ngày Halloween 2018','<p>Khuyến mại giảm 31% duy nhất trong ng&agrave;y Halloween 2018</p>','Khuyến mại giảm 31% duy nhất trong ngày Halloween 2018','Khuyến mại giảm 31% duy nhất trong ngày Halloween 2018','');

/*Table structure for table `st_product` */

DROP TABLE IF EXISTS `st_product`;

CREATE TABLE `st_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `thumbnail` varchar(255) DEFAULT NULL,
  `url_video` varchar(255) DEFAULT NULL,
  `is_status` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT 'trang thai',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `displayed_time` datetime DEFAULT NULL COMMENT 'ngay publish',
  `viewed` int(11) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'ngay tao',
  `updated_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ngay sua',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_product` */

/*Table structure for table `st_product_category` */

DROP TABLE IF EXISTS `st_product_category`;

CREATE TABLE `st_product_category` (
  `product_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  UNIQUE KEY `product_id` (`product_id`,`category_id`),
  KEY `fk_category_id` (`category_id`),
  KEY `fk_product_id` (`product_id`),
  CONSTRAINT `fk_product_category_cateid` FOREIGN KEY (`category_id`) REFERENCES `st_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_category_productid` FOREIGN KEY (`product_id`) REFERENCES `st_product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `st_product_category` */

/*Table structure for table `st_product_translations` */

DROP TABLE IF EXISTS `st_product_translations`;

CREATE TABLE `st_product_translations` (
  `id` int(11) unsigned NOT NULL,
  `language_code` varchar(2) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `content` longtext,
  `meta_title` varchar(100) NOT NULL,
  `meta_description` varchar(170) NOT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  UNIQUE KEY `ap_product_translations_id_language_code_pk` (`id`,`language_code`),
  CONSTRAINT `fk_product_trans_productid` FOREIGN KEY (`id`) REFERENCES `st_product` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `st_product_translations` */

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `st_users` */

insert  into `st_users`(`id`,`oauth_uid`,`oauth_provider`,`ip_address`,`username`,`password`,`salt`,`gender`,`email`,`activation_code`,`forgotten_password_code`,`forgotten_password_time`,`remember_code`,`created_on`,`last_login`,`active`,`fullname`,`first_name`,`last_name`,`address_book`,`company`,`phone`,`created_time`,`updated_time`) values (1,NULL,NULL,'127.0.0.1','admin','$2y$08$ymVkNr.hcUFPFHIaOKWthuw4M4Y6TUW8UfYJYsGqjNNlBEw5nVZie','',0,'steven.mucian@gmail.com','',NULL,NULL,'jdrqfB/XE3O9dDXdZp0zm.',1268889823,1541361609,1,'Nguyễn Đức Toàn','Admin','Cây Cảnh',NULL,'Freelancer','0999999999','2017-12-17 00:49:09','2018-11-05 03:00:09');

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
