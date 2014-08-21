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
  `Id` int(45) NOT NULL AUTO_INCREMENT COMMENT '@Primary key {int} Id',
  `wins` int(10) NOT NULL COMMENT '@property {int} wins',
  `losses` int(11) NOT NULL COMMENT '@property {int} losses',
  `team` varchar(34) DEFAULT NULL COMMENT ' @property {String} team (can be null)',
  `password` varchar(10) NOT NULL COMMENT '@property {String} password',
  `email` varchar(15) NOT NULL COMMENT '@property {String} email',
  `ign` varchar(34) NOT NULL COMMENT '''@property {String} ign (in game name)''',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ign` (`ign`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='A simple user model' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `wins`, `losses`, `team`, `password`, `email`, `ign`) VALUES
(1, 5, 1, NULL, 'password', 'root@yahoo.com', 'root');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
