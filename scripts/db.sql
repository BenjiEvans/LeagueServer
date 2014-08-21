SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP DATABASE leagueserver;
CREATE DATABASE leagueserver;
Use leagueserver;
DROP TABLE if exists user;

--
-- Database: `leagueserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(45) NOT NULL AUTO_INCREMENT COMMENT '@Primary key {int} Id',
  `ign` varchar(34) NOT NULL,
  `wins` int(10) NOT NULL COMMENT '@property {int} wins',
  `losses` int(11) NOT NULL COMMENT '@property {int} losses',
  `team_id` int(10) DEFAULT NULL COMMENT '@Foreign key {int} team_id (can be null)',
  `email` varchar(15) NOT NULL,
  `password` varchar(13) NOT NULL,
  `salt` varchar(45) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `register` date NOT NULL,
  `login` date NOT NULL,
  `status` enum('Challenger','Collegiate','Admin', 'Root') NOT NULL COMMENT '@field {Enum: Collegiate, Challenger(default), Admin, Root} status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ign` (`ign`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='A simple user model' AUTO_INCREMENT=2 ;

ALTER TABLE `user`
  ADD CONSTRAINT `FRK_UserID` FOREIGN KEY (`team_id`) REFERENCES `user` (`id`);


--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL COMMENT '@Primary key {int} id',
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `captain` int(11) NOT NULL,
  `status` enum('Collegiate','Challenger') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `captain` (`captain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `team`
  ADD CONSTRAINT `FRK_id` FOREIGN KEY (`captain`) REFERENCES `team` (`id`);



--
-- 
--



