SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP DATABASE leagueserver;
CREATE DATABASE leagueserver;
Use leagueserver;
DROP TABLE if exists user;
DROP TABLE if exists team;

--
-- Database: `leagueserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '@Primary key {int} Id',
  `ign` varchar(32) NOT NULL,
  `wins` int(10) NOT NULL COMMENT '@property {int} wins',
  `losses` int(10) NOT NULL COMMENT '@property {int} losses',
  `team_id` int(10) DEFAULT NULL COMMENT '@Foreign key {int} team_id (can be null)',
  `email` varchar(32) NOT NULL,
  `password` varchar(13) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `register` date NOT NULL,
  `login` date NOT NULL,
  `score` float(10,3) NULL,
  `status` enum('Challenger','Collegiate','Admin', 'Root') NOT NULL COMMENT '@field {Enum: Collegiate, Challenger(default), Admin, Root} status',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ign` (`ign`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='A simple user model' AUTO_INCREMENT=1 ;


--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `team_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '@Primary key {int} id',
  `name` varchar(32) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('Collegiate','Challenger') NOT NULL,
  `score` float(10,3) NULL,
  `last_match` date NULL,
  PRIMARY KEY (`team_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

  -- sample team 
  INSERT INTO `team` (`name`,`wins`, `losses`, `user_id`, `status`, `score`) VALUES
('Team1', 2, 1, 2, 'Collegiate', 2-1*(1/3));

-- sample users

 INSERT INTO `user` (`ign`, `wins`, `losses`, `team_id`, `email`, `password`, `salt`, `activate`, `register`, `login`,`score`) VALUES
('user1', 5, 1, NULL, 'user1@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00',5-1*(1/6));
INSERT INTO `user` (`ign`, `wins`, `losses`, `team_id`, `email`, `password`, `salt`, `activate`, `register`, `login`,`score`) VALUES
('user2', 7, 3, 1, 'user2@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00', 7-3*(3/10));
INSERT INTO `user` (`ign`, `wins`, `losses`, `team_id`, `email`, `password`, `salt`, `activate`, `register`, `login`,`score`) VALUES
('user3', 10, 11, NULL, 'user3@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00',10-11*(11/21));
INSERT INTO `user` (`ign`, `wins`, `losses`, `team_id`, `email`, `password`, `salt`, `activate`, `register`, `login`, `score`) VALUES
('user4', 2, 1, NULL, 'user4@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00',2-1*(1/3));

--
-- 
--



