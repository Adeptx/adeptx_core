SET FOREIGN_KEY_CHECKS = 0;

-- 
-- Table structure for table `adeptx_session` 
-- 

DROP TABLE IF EXISTS `adeptx_session`;
CREATE TABLE `adeptx_session` (
`id` bigint(255) NOT NULL auto_increment,
`user_id` bigint(255) NOT NULL,
`line_desc` varchar(255) NOT NULL,
`line_value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2;

-- --------------------------------------------------------

-- 
-- Table structure for table `adeptx_user` 
-- 

DROP TABLE IF EXISTS `adeptx_user`;
CREATE TABLE `adeptx_user` (
`id` bigint(255) NOT NULL auto_increment,
`nickname` varchar(255) NOT NULL,
`email` varchar(255) NOT NULL,
`hash` varchar(255) NOT NULL,
`salt` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3;

-- --------------------------------------------------------

-- 
-- Table structure for table `adeptx_user_message` 
-- 

DROP TABLE IF EXISTS `adeptx_user_message`;
CREATE TABLE `adeptx_user_message` (
`id` int(15) NOT NULL auto_increment,
`to_uid` int(9) NOT NULL,
`subject` varchar(255) NOT NULL,
`message` text,
`reaplyto` varchar(255),
`from_uid` int(9) NOT NULL,
`sender_ip` varchar(255),
`date_sent` timestamp DEFAULT '2015-09-13 22:13:01' NOT NULL,
`was_read` tinyint(1),
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13;

-- --------------------------------------------------------

-- 
-- Dumping data for table `adeptx_session` 
-- 

INSERT INTO `adeptx_session` (`id`, `user_id`, `line_desc`, `line_value`) VALUES ('1','1','cloud','fm');

-- --------------------------------------------------------

-- 
-- Dumping data for table `adeptx_user` 
-- 

INSERT INTO `adeptx_user` (`id`, `nickname`, `email`, `hash`, `salt`) VALUES ('1','x-positive','e.grinec@gmail.com','6ab39c41030d3888846c4ecb11375bb3ad7138f7879ac19f2f9e192f7614cf1523f1b3ac951eea304b09d911d3797f32','5024467d5acfd9d9d3592340ee2800cf'),
 ('2','gcorp','gcorp.gcorp@gmail.com','0359ac6aa8df54fe9dad42ef88a5134e5d2389e4339cdc91330de5f6bdf24e8f1c2081763a03d00838c1aa16f18db61e','0cc27475046ec987dfc168c0669b6323');

-- --------------------------------------------------------

-- 
-- Dumping data for table `adeptx_user_message` 
-- 

INSERT INTO `adeptx_user_message` (`id`, `to_uid`, `subject`, `message`, `reaplyto`, `from_uid`, `sender_ip`, `date_sent`, `was_read`) VALUES ('1','2','Че_почитать','_брачо_','','1','127.0.0.1','2015-09-10 22:29:10','0'),
 ('2','2','Че_почитать','_брачо_','','1','127.0.0.1','2015-09-10 22:29:10','0'),
 ('3','2','Че_почитать','_брачо_','','1','127.0.0.1','2015-09-10 22:30:10','0'),
 ('4','2','Че_почитать','_брачо_','','1','127.0.0.1','2015-09-10 22:32:10','0'),
 ('5','2','Че_почитать','_брачо_','e.grinec@gmail.com','1','127.0.0.1','2015-09-10 22:33:10','0'),
 ('6','2','Че_почитать','_брачо_','e.grinec@gmail.com','1','127.0.0.1','2015-09-10 22:34:10','0'),
 ('7','1','Тот_кто_знает','_поймет_','gcorp.gcorp@gmail.com','2','127.0.0.1','2015-09-10 22:42:10','0'),
 ('8','0','txt','','gcorp.gcorp@gmail.com (gcorp.gcorp@gmail.com)','2','127.0.0.1','2015-09-10 23:41:11','0'),
 ('9','1','subj','txt','gcorp.gcorp@gmail.com (gcorp.gcorp@gmail.com)','2','127.0.0.1','2015-09-10 23:44:11','0'),
 ('10','0','txt','','e.grinec@gmail.com (e.grinec@gmail.com)','0','127.0.0.1','2015-09-10 23:47:11','0'),
 ('11','1','subj','txt','e.grinec@gmail.com (e.grinec@gmail.com)','0','127.0.0.1','2015-09-10 23:49:11','0'),
 ('12','1','subj','txt','x-positive (e.grinec@gmail.com)','0','127.0.0.1','2015-09-10 23:50:11','0');

-- --------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 1;

