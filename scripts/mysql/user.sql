
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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
  `prev_team` varchar(255) NOT NULL,
  `email` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `salt` varchar(45) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `register` date NOT NULL,
  `login` date NOT NULL,
  `status` enum('Collegiate','Challenger','Admin') NOT NULL COMMENT '@field {Enum: Collegiate, Challenger, Admin} status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `ign` (`ign`),
  KEY `team_id` (`team_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='A simple user model' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `ign`, `wins`, `losses`, `team_id`, `prev_team`, `email`, `password`, `salt`, `activate`, `register`, `login`, `status`) VALUES
(1, 'root', 5, 1, NULL, '', 'root@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FRK_UserID` FOREIGN KEY (`team_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
