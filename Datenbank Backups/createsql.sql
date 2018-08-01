CREATE DATABASE IF NOT EXISTS `flreports` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `flreports`;

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `glossary` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `category` int(2) NOT NULL,
  `term` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `deleted` int(1) NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (userID) REFERENCES user(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=162 ;

CREATE TABLE IF NOT EXISTS `grades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `lesson` varchar(50) NOT NULL,
  `content` varchar(300) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `date` varchar(30) NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (userID) REFERENCES user(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `reports` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `date` varchar(30) NOT NULL,
  `cw` int(2) NOT NULL,
  `location` varchar(30) NOT NULL,
  `begin` varchar(10) NOT NULL,
  `end` varchar(10) NOT NULL,
  `deleted` int(1) NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (userID) REFERENCES user(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=249 ;

CREATE TABLE IF NOT EXISTS `report_actions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `reportID` int(11) NOT NULL,
  `action` varchar(1500) NOT NULL,
  `time` float NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (reportID) REFERENCES reports(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=718 ;


CREATE TABLE IF NOT EXISTS `resets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `rack` varchar(50) NOT NULL,
  `lab` varchar(50) NOT NULL,
  `pod` varchar(100) NOT NULL,
  `date` varchar(30) NOT NULL,
  `time` float NOT NULL,
  `comment` varchar(1500) NOT NULL,
  PRIMARY KEY (`ID`),
  FOREIGN KEY (userID) REFERENCES user(ID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;



