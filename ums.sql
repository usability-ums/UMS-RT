/*
SQLyog Community Edition- MySQL GUI v6.16
MySQL - 5.1.45-community : Database - database
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

create database if not exists `database`;

USE `database`;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `a_question` */

DROP TABLE IF EXISTS `a_question`;

CREATE TABLE `a_question` (
  `id` varchar(200) NOT NULL,
  `project` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `task` varchar(200) NOT NULL,
  `answer` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`,`project`,`name`,`task`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `a_question` */

/*Table structure for table `accesslog` */

DROP TABLE IF EXISTS `accesslog`;

CREATE TABLE `accesslog` (
  `name` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `accesslog` */

/*Table structure for table `answereffectiveness` */

DROP TABLE IF EXISTS `answereffectiveness`;

CREATE TABLE `answereffectiveness` (
  `project` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `task` varchar(20) NOT NULL,
  `no` varchar(20) NOT NULL,
  `answer` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`project`,`name`,`task`,`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `answereffectiveness` */

/*Table structure for table `answerefficiency` */

DROP TABLE IF EXISTS `answerefficiency`;

CREATE TABLE `answerefficiency` (
  `project` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `task` varchar(100) NOT NULL,
  `no` varchar(20) NOT NULL,
  `answer` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`project`,`name`,`task`,`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `answerefficiency` */

/*Table structure for table `answermouseclick` */

DROP TABLE IF EXISTS `answermouseclick`;

CREATE TABLE `answermouseclick` (
  `project` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `task` varchar(50) NOT NULL,
  `answer` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`project`,`name`,`task`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `answermouseclick` */

/*Table structure for table `assigndef` */

DROP TABLE IF EXISTS `assigndef`;

CREATE TABLE `assigndef` (
  `no` varchar(20) NOT NULL,
  `project` varchar(250) NOT NULL,
  PRIMARY KEY (`no`,`project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assigndef` */

/*Table structure for table `assigndemo` */

DROP TABLE IF EXISTS `assigndemo`;

CREATE TABLE `assigndemo` (
  `id` varchar(250) NOT NULL,
  `project` varchar(250) NOT NULL,
  PRIMARY KEY (`id`,`project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assigndemo` */

/*Table structure for table `assigneffectiveness` */

DROP TABLE IF EXISTS `assigneffectiveness`;

CREATE TABLE `assigneffectiveness` (
  `no` varchar(250) NOT NULL,
  `project` varchar(250) NOT NULL,
  PRIMARY KEY (`no`,`project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assigneffectiveness` */

/*Table structure for table `assignefficiency` */

DROP TABLE IF EXISTS `assignefficiency`;

CREATE TABLE `assignefficiency` (
  `no` varchar(250) NOT NULL,
  `project` varchar(250) NOT NULL,
  PRIMARY KEY (`no`,`project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assignefficiency` */

/*Table structure for table `assignsatis` */

DROP TABLE IF EXISTS `assignsatis`;

CREATE TABLE `assignsatis` (
  `no` varchar(250) NOT NULL,
  `project` varchar(250) NOT NULL,
  `task` varchar(250) NOT NULL,
  PRIMARY KEY (`no`,`project`,`task`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `assignsatis` */

/*Table structure for table `data` */

DROP TABLE IF EXISTS `data`;

CREATE TABLE `data` (
  `heuristic` varchar(100) DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `no` varchar(10) DEFAULT NULL,
  `answer` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `data` */

insert  into `data`(`heuristic`,`format`,`no`,`answer`,`ip`) values ('Compatibility','UR','000001','Agree','10.1.25.172'),('Consistency and Standards',NULL,NULL,'Disagree',NULL),('Error Prevention & Correction',NULL,NULL,NULL,NULL),('Explicitness',NULL,NULL,NULL,NULL),('Flexibility & Control',NULL,NULL,NULL,NULL),('Functionality',NULL,NULL,NULL,NULL),('Informative Feedback',NULL,NULL,NULL,NULL),('Language & Content',NULL,NULL,NULL,NULL),('Navigation',NULL,NULL,NULL,NULL),('Privacy',NULL,NULL,NULL,NULL),('User Guidance & Support',NULL,NULL,NULL,NULL),('Visual Clarity',NULL,NULL,NULL,NULL);

/*Table structure for table `debriefing` */

DROP TABLE IF EXISTS `debriefing`;

CREATE TABLE `debriefing` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `debriefing` */

/*Table structure for table `debriefingc` */

DROP TABLE IF EXISTS `debriefingc`;

CREATE TABLE `debriefingc` (
  `user` varchar(250) NOT NULL,
  `comment` text,
  `project` varchar(200) NOT NULL,
  `question` varchar(200) NOT NULL,
  PRIMARY KEY (`user`,`project`,`question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `debriefingc` */

/*Table structure for table `debriefingscore` */

DROP TABLE IF EXISTS `debriefingscore`;

CREATE TABLE `debriefingscore` (
  `user` varchar(200) NOT NULL,
  `score` varchar(200) DEFAULT NULL,
  `project` varchar(200) NOT NULL,
  `question` varchar(250) NOT NULL,
  PRIMARY KEY (`user`,`project`,`question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `debriefingscore` */

/*Table structure for table `defect` */

DROP TABLE IF EXISTS `defect`;

CREATE TABLE `defect` (
  `id` varchar(20) NOT NULL,
  `project` varchar(50) DEFAULT NULL,
  `defecttype` varchar(50) DEFAULT NULL,
  `testingtype` varchar(50) DEFAULT NULL,
  `stage1` varchar(50) DEFAULT NULL,
  `stage2` varchar(50) DEFAULT NULL,
  `issue` text,
  `category` varchar(50) DEFAULT NULL,
  `severity` varchar(20) DEFAULT NULL,
  `screen` text,
  `recommendation` text,
  `file` varchar(250) DEFAULT NULL,
  `environment` text,
  `submitdate` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Submitted',
  `scrubbingnote` text,
  `resolvenote` text,
  `verifynote` text,
  `resolvedate` varchar(50) DEFAULT NULL,
  `verifydate` varchar(50) DEFAULT NULL,
  `impact` text,
  `resolveby` varchar(50) DEFAULT NULL,
  `verifyby` varchar(50) DEFAULT NULL,
  `raiseby` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `defect` */

/*Table structure for table `defectlog` */

DROP TABLE IF EXISTS `defectlog`;

CREATE TABLE `defectlog` (
  `id` varchar(50) DEFAULT NULL,
  `chgby` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `defectlog` */

/*Table structure for table `demographic` */

DROP TABLE IF EXISTS `demographic`;

CREATE TABLE `demographic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `demographic` */

/*Table structure for table `demoscore` */

DROP TABLE IF EXISTS `demoscore`;

CREATE TABLE `demoscore` (
  `user` varchar(250) NOT NULL,
  `score` varchar(250) DEFAULT NULL,
  `project` varchar(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  PRIMARY KEY (`user`,`project`,`question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `demoscore` */

/*Table structure for table `effectiveness` */

DROP TABLE IF EXISTS `effectiveness`;

CREATE TABLE `effectiveness` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `effectiveness` */

/*Table structure for table `efficiency` */

DROP TABLE IF EXISTS `efficiency`;

CREATE TABLE `efficiency` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `efficiency` */

/*Table structure for table `p_question` */

DROP TABLE IF EXISTS `p_question`;

CREATE TABLE `p_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) DEFAULT NULL,
  `task` varchar(20) DEFAULT NULL,
  `question` text,
  `selection` text,
  `answer` varchar(200) DEFAULT NULL,
  `type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `p_question` */

/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'false',
  `URL` varchar(255) DEFAULT NULL,
  `security` varchar(50) DEFAULT 'unlock',
  `content` text,
  `type` varchar(50) DEFAULT NULL,
  `method_type` varchar(50) NOT NULL,
  `lead` varchar(100) DEFAULT NULL,
  `resources` text,
  `date` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`name`,`method_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `project` */

/*Table structure for table `satisfaction` */

DROP TABLE IF EXISTS `satisfaction`;

CREATE TABLE `satisfaction` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `category` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `satisfaction` */

/*Table structure for table `scategory` */

DROP TABLE IF EXISTS `scategory`;

CREATE TABLE `scategory` (
  `category` varchar(200) NOT NULL,
  PRIMARY KEY (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `scategory` */

/*Table structure for table `score` */

DROP TABLE IF EXISTS `score`;

CREATE TABLE `score` (
  `user` varchar(250) NOT NULL,
  `score` varchar(250) DEFAULT 'none',
  `task` varchar(250) NOT NULL,
  `project` varchar(250) NOT NULL,
  `question` varchar(250) NOT NULL,
  PRIMARY KEY (`user`,`task`,`project`,`question`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `score` */

/*Table structure for table `task` */

DROP TABLE IF EXISTS `task`;

CREATE TABLE `task` (
  `no` varchar(255) NOT NULL,
  `PName` varchar(255) NOT NULL,
  `question` text,
  PRIMARY KEY (`no`,`PName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `task` */

/*Table structure for table `thinkaloud` */

DROP TABLE IF EXISTS `thinkaloud`;

CREATE TABLE `thinkaloud` (
  `PName` varchar(255) NOT NULL,
  `task` varchar(255) NOT NULL,
  `answer` text,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`PName`,`task`,`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `thinkaloud` */

/*Table structure for table `time` */

DROP TABLE IF EXISTS `time`;

CREATE TABLE `time` (
  `user` varchar(50) NOT NULL,
  `task` varchar(50) NOT NULL,
  `time` varchar(50) DEFAULT NULL,
  `project` varchar(150) NOT NULL,
  PRIMARY KEY (`user`,`task`,`project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `time` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user` varchar(250) NOT NULL,
  `status` varchar(250) DEFAULT NULL,
  `project` varchar(250) NOT NULL,
  `effectiveness` varchar(20) DEFAULT 'No',
  `efficiency` varchar(20) DEFAULT 'No',
  `mouseclick` varchar(20) DEFAULT 'No',
  `security` varchar(20) DEFAULT 'unlock',
  `password` varchar(20) DEFAULT '1',
  `complete` varchar(10) DEFAULT 'pass',
  PRIMARY KEY (`user`,`project`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`email`),
  UNIQUE KEY `name` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`name`,`role`) values (1,'admin@hotmail.com','admin','Administrator','admin'),(13,'management@hotmail.com','management','Management','management'),(14,'developer@hotmail.com','developer','Developer','developer'),(15,'tester@hotmail.com','tester','Tester','tester'),(16,'supervisor@hotmail.com','supervisor','Supervisor','supervisor');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
