-- Adminer 4.2.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `tp_ip`;
CREATE TABLE `tp_ip` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `vote_type` int(11) NOT NULL,
  `ip_count` int(11) NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tp_ip` (`ip_id`, `ip`, `vote_type`, `ip_count`) VALUES
(1,	'127.0.0.1',	1,	1);

DROP TABLE IF EXISTS `tp_option`;
CREATE TABLE `tp_option` (
  `id` int(11) NOT NULL,
  `vote_title` text NOT NULL,
  `vote_pic` text NOT NULL,
  `vote_about` text NOT NULL,
  `vote_remarks` text NOT NULL,
  `vote_max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tp_option` (`id`, `vote_title`, `vote_pic`, `vote_about`, `vote_remarks`, `vote_max`) VALUES
(1,	'最美农户',	'576375855d891.jpg',	'&lt;p&gt;HHHHHH&lt;br/&gt;&lt;/p&gt;',	'',	10);

DROP TABLE IF EXISTS `tp_type`;
CREATE TABLE `tp_type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tp_type` (`type_id`, `type_name`) VALUES
(1,	'JJJ');

DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tp_user` (`ID`, `username`, `password`, `about`) VALUES
(1,	'admin',	'21232f297a57a5a743894a0e4a801fc3',	'administrator');

DROP TABLE IF EXISTS `tp_vote`;
CREATE TABLE `tp_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `v_name` text CHARACTER SET utf8 NOT NULL,
  `v_about` text CHARACTER SET utf8 NOT NULL,
  `v_pic` text CHARACTER SET utf8 NOT NULL,
  `v_type` int(11) NOT NULL,
  `v_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `v_type` (`v_type`),
  KEY `v_type_2` (`v_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `tp_vote` (`id`, `v_name`, `v_about`, `v_pic`, `v_type`, `v_count`) VALUES
(1,	'4444',	'&lt;p&gt;RTYRYT&lt;br/&gt;&lt;/p&gt;',	'57637518892e8.jpg',	1,	0),
(2,	'2222',	'',	'5763759331c87.jpg',	1,	1);

-- 2016-06-17 04:01:49
