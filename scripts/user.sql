DROP DATABASE leagueServer;
CREATE DATABASE leagueServer;
Use leagueServer;
DROP TABLE if exists user;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



--
-- Database: `leagueServer`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(45) NOT NULL AUTO_INCREMENT COMMENT '@Primary key {int} Id',
  `ign` varchar(34) NOT NULL COMMENT '@property {String} ign (in game name)',
  `wins` int(10) NOT NULL COMMENT '@property {int} wins',
  `losses` int(11) NOT NULL COMMENT '@property {int} losses',
  `team` varchar(34) DEFAULT NULL COMMENT ' @property {String} team (can be null)',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='A simple user model' AUTO_INCREMENT=1 ;

Insert Into user Values(1,'root','5','1', NULL);



