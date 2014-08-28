SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP DATABASE LeagueServer;
CREATE DATABASE LeagueServer;
Use LeagueServer;
DROP TABLE if exists Users;
DROP TABLE if exists Teams;
DROP TABLE if exists Notifications;
DROP TABLE if exists RequestDispatcher;
DROP TABLE if exists Events;
DROP TABLE if exists XrefUsersEvents;

CREATE TABLE IF NOT EXISTS Users (
  UserID int(10) NOT NULL AUTO_INCREMENT,
  Ign varchar(32) NOT NULL,
  Wins smallint NOT NULL,
  Losses smallint NOT NULL,
  TeamID smallint DEFAULT NULL ,
  Email varchar(100) NOT NULL,
  Password varchar(13) NOT NULL,
  Salt varchar(10) NOT NULL,
  Activate tinyint(1) NOT NULL,
  Register date NOT NULL,
  Login date NOT NULL,
  Score float(10,3) NULL,
  Loggedin tinyint(1) NOT NULL,
  UserStatus enum('Challenger','Collegiate','Admin', 'Root') NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Ign` (`Ign`),
  KEY `TeamID` (`TeamID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- Insert sample users

INSERT INTO Users (Ign, Wins, Losses, TeamID, Email, Password, Salt, Activate, Register, Login,Score) VALUES
('user1', 5, 1, NULL, 'user1@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00',5-1*(1/6));
INSERT INTO Users (Ign, Wins, Losses, TeamID, Email, Password, Salt, Activate, Register, Login,Score) VALUES
('user2', 7, 3, NULL, 'user2@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00', 7-3*(3/10));
INSERT INTO Users (Ign, Wins, Losses, TeamID, Email, Password, Salt, Activate, Register, Login,Score) VALUES
('user3', 10, 11, NULL, 'user3@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00',10-11*(11/21));
INSERT INTO Users (Ign, Wins, Losses, TeamID, Email, Password, Salt, Activate, Register, Login, Score) VALUES
('user4', 2, 1, NULL, 'user4@yahoo.com', 'password', '', 0, '0000-00-00', '0000-00-00',2-1*(1/3));


CREATE TABLE IF NOT EXISTS Teams (
  TeamID smallint NOT NULL AUTO_INCREMENT,
  TeamName varchar(32) NOT NULL,
  Wins smallint NOT NULL,
  Losses smallint NOT NULL,
  UserID int(10) NOT NULL,
  TeamStatus enum('Collegiate','Challenger') NOT NULL,
  Score float(10,3) NULL,
  LastMatch date NULL,
  PRIMARY KEY (`TeamID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

 -- sample team 
INSERT INTO Teams (TeamName,Wins, Losses, UserID, TeamStatus, Score) VALUES
('Team1', 2, 1, 2, 'Collegiate', 2-1*(1/3));

-- notifications 
CREATE TABLE IF NOT EXISTS Notifications (
  NoteID int(11) NOT NULL AUTO_INCREMENT,
  NoteType enum('tr','a','d','r','b') NOT NULL,
  UserID int(10) Not NULL,
  PRIMARY KEY (`NoteID`),
  KEY `UserID` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Requests
CREATE TABLE IF NOT EXISTS RequestDispatcher (
  NoteID int(11) NOT NULL,
  UserID int(10) NOT NULL,
  TeamID smallint NOT NULL, 
  KEY `NoteID` (`NoteID`),
  KEY `UserID` (`UserID`),
  KEY `TeamID` (`TeamID`)
);

-- Events
CREATE TABLE IF NOT EXISTS Events (
  EventID int(11) NOT NULL AUTO_INCREMENT,
  EventName varchar(32) NOT NULL,
  EventType enum('Online') NOT NULL, 
  `Date` date NOT NULL,
  Description varchar(255) NOT NULL,
  PRIMARY KEY (`EventID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--event cross refrence

CREATE TABLE IF NOT EXISTS XrefUsersEvents (
  ID int(11) NOT NULL AUTO_INCREMENT,
  EventID int(11) NOT NULL,
  UserID int(11) NOT NULL,
  KEY `EventID` (`EventID`),
  KEY `UserID` (`UserID`),
  PRIMARY KEY (`ID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--end of script 

-- add permissions to test on repository locally 
CREATE USER 'LeagueAdmin'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'LeagueAdmin'@'localhost';
FLUSH PRIVILEGES;



 
