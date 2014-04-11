-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2014 at 09:12 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evercise_2_0`
--
CREATE DATABASE IF NOT EXISTS `evercise_2_0` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `evercise_2_0`;

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `activityId` int(11) NOT NULL AUTO_INCREMENT,
  `activityName` varchar(45) DEFAULT NULL,
  `activityTitles` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`activityId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(45) DEFAULT NULL,
  `categoryDescription` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `featuredgymgroup`
--

CREATE TABLE IF NOT EXISTS `featuredgymgroup` (
  `featuredGroupId` int(11) NOT NULL AUTO_INCREMENT,
  `gym_gymId` int(11) NOT NULL,
  `group_groupId` int(11) NOT NULL,
  PRIMARY KEY (`featuredGroupId`,`gym_gymId`,`group_groupId`),
  KEY `fk_featuredGroup_gym1_idx` (`gym_gymId`),
  KEY `fk_featuredGroup_group1_idx` (`group_groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `groupId` int(11) NOT NULL AUTO_INCREMENT,
  `user_userId` int(11) NOT NULL,
  `category_categoryId` int(11) NOT NULL,
  `groupName` varchar(45) DEFAULT NULL,
  `groupTitle` varchar(45) DEFAULT NULL,
  `groupDescription` varchar(255) DEFAULT NULL,
  `groupAddress` varchar(45) DEFAULT NULL,
  `groupTown` varchar(45) DEFAULT NULL,
  `groupPostcode` varchar(45) DEFAULT NULL,
  `groupLat` int(11) DEFAULT NULL,
  `groupLong` int(11) DEFAULT NULL,
  `groupImage` varchar(45) DEFAULT NULL,
  `groupCapacity` int(11) DEFAULT NULL,
  `groupDefaultDuration` int(11) DEFAULT NULL,
  `groupcol` varchar(45) DEFAULT NULL,
  `groupDefaultPrice` double DEFAULT NULL,
  `groupPublished` tinyint(4) DEFAULT NULL,
  `groupDatesAdded` varchar(45) DEFAULT NULL,
  `groupCreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`groupId`,`user_userId`,`category_categoryId`),
  KEY `fk_group_user1_idx` (`user_userId`),
  KEY `fk_group_category1_idx` (`category_categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gym`
--

CREATE TABLE IF NOT EXISTS `gym` (
  `gymId` int(11) NOT NULL AUTO_INCREMENT,
  `user_userId` int(11) NOT NULL,
  `gymName` varchar(45) DEFAULT NULL,
  `gymTitle` varchar(45) DEFAULT NULL,
  `gymDescription` varchar(45) DEFAULT NULL,
  `gymDirectory` varchar(45) DEFAULT NULL,
  `gymLogoImage` varchar(45) DEFAULT NULL,
  `gymBackgroundImage` varchar(45) DEFAULT NULL,
  `gymCreated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`gymId`,`user_userId`),
  KEY `fk_gym_user1_idx` (`user_userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gymtrainer`
--

CREATE TABLE IF NOT EXISTS `gymtrainer` (
  `gymTrainerId` int(11) NOT NULL AUTO_INCREMENT,
  `user_userId` int(11) NOT NULL,
  `gym_gymId` int(11) NOT NULL,
  `gymtrainerStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`gymTrainerId`,`user_userId`,`gym_gymId`),
  KEY `fk_user_has_gym_gym1_idx` (`gym_gymId`,`gymTrainerId`),
  KEY `fk_user_has_gym_user1_idx` (`user_userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `ratingId` int(11) NOT NULL AUTO_INCREMENT,
  `user_userId` int(11) NOT NULL,
  `ratingStars` tinyint(4) DEFAULT NULL,
  `ratingComment` varchar(255) DEFAULT NULL,
  `sessionmember_sessionmemberId` int(11) NOT NULL,
  `session_sessionId` int(11) NOT NULL,
  `group_groupId` int(11) NOT NULL,
  `user_createdUserId` int(11) NOT NULL,
  PRIMARY KEY (`ratingId`,`user_userId`,`sessionmember_sessionmemberId`,`session_sessionId`,`group_groupId`,`user_createdUserId`),
  KEY `fk_rating_user1_idx` (`user_userId`),
  KEY `fk_rating_sessionmember1_idx` (`sessionmember_sessionmemberId`),
  KEY `fk_rating_session1_idx` (`session_sessionId`),
  KEY `fk_rating_group1_idx` (`group_groupId`),
  KEY `fk_rating_user2_idx` (`user_createdUserId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `sessionId` int(11) NOT NULL AUTO_INCREMENT,
  `group_groupId` int(11) NOT NULL,
  `sessionTime` timestamp NULL DEFAULT NULL,
  `sessionMembers` int(11) DEFAULT NULL,
  `sessionCreated` timestamp NULL DEFAULT NULL,
  `sessionMembersEmailed` int(11) DEFAULT NULL,
  PRIMARY KEY (`sessionId`,`group_groupId`),
  KEY `fk_session_group1_idx` (`group_groupId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessionmember`
--

CREATE TABLE IF NOT EXISTS `sessionmember` (
  `sessionmemberId` int(11) NOT NULL AUTO_INCREMENT,
  `sessionId` int(11) NOT NULL,
  `user_userId` int(11) NOT NULL,
  `sessionmemberPrice` double DEFAULT NULL,
  `sessionmemberCreated` timestamp NULL DEFAULT NULL,
  `sessionmemberReviewed` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`sessionmemberId`,`user_userId`,`sessionId`),
  KEY `fk_sessionmember_user1_idx` (`user_userId`),
  KEY `fk_sessionmember_session1_idx` (`sessionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE IF NOT EXISTS `trainer` (
  `trainerId` int(11) NOT NULL AUTO_INCREMENT,
  `user_userId` int(11) NOT NULL,
  `trainerCreated` timestamp NULL DEFAULT NULL,
  `trainerBio` varchar(1024) DEFAULT NULL,
  `trainerWebsite` varchar(45) DEFAULT NULL,
  `trainerProfession` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`trainerId`,`user_userId`),
  KEY `fk_trainer_user1_idx` (`user_userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='			' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trainerhistory`
--

CREATE TABLE IF NOT EXISTS `trainerhistory` (
  `trainerHistoryId` int(11) NOT NULL AUTO_INCREMENT,
  `trainerHistoryTypeId` int(11) DEFAULT NULL,
  `trainerHistoryGroupId` int(11) DEFAULT NULL,
  `trainerHistoryGymId` int(11) DEFAULT NULL,
  `trainerHistoryUserId` int(11) DEFAULT NULL,
  `user_userId` int(11) NOT NULL,
  PRIMARY KEY (`trainerHistoryId`,`user_userId`),
  KEY `fk_trainerHistory_user1_idx` (`user_userId`)
) ENGINE=InnoDB DEFAULT CHARSET=big5 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userType` tinyint(4) DEFAULT '1',
  `userName` varchar(15) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `userSex` tinyint(4) DEFAULT NULL,
  `userDob` timestamp NULL DEFAULT NULL,
  `userPhone` int(11) DEFAULT NULL,
  `userCreated` timestamp NULL DEFAULT NULL,
  `userLastLogin` timestamp NULL DEFAULT NULL,
  `userDirectory` varchar(45) DEFAULT NULL,
  `userImage` varchar(45) DEFAULT NULL,
  `userCategories` varchar(45) DEFAULT NULL,
  `userHash` varchar(45) DEFAULT NULL,
  `userVerified` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userType`, `userName`, `userEmail`, `userPassword`, `userSex`, `userDob`, `userPhone`, `userCreated`, `userLastLogin`, `userDirectory`, `userImage`, `userCategories`, `userHash`, `userVerified`) VALUES
(1, 1, 'Tris', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `featuredgymgroup`
--
ALTER TABLE `featuredgymgroup`
  ADD CONSTRAINT `fk_featuredGroup_group1` FOREIGN KEY (`group_groupId`) REFERENCES `group` (`groupId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_featuredGroup_gym1` FOREIGN KEY (`gym_gymId`) REFERENCES `gym` (`gymId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `fk_group_category1` FOREIGN KEY (`category_categoryId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_group_user` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gym`
--
ALTER TABLE `gym`
  ADD CONSTRAINT `fk_gym_user1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `gymtrainer`
--
ALTER TABLE `gymtrainer`
  ADD CONSTRAINT `fk_user_has_gym_gym1` FOREIGN KEY (`gym_gymId`, `gymTrainerId`) REFERENCES `gym` (`gymId`, `user_userId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_gym_user1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_user1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`),
  ADD CONSTRAINT `fk_rating_sessionmember1` FOREIGN KEY (`sessionmember_sessionmemberId`) REFERENCES `sessionmember` (`sessionmemberId`),
  ADD CONSTRAINT `fk_rating_session1` FOREIGN KEY (`session_sessionId`) REFERENCES `session` (`sessionId`),
  ADD CONSTRAINT `fk_rating_group1` FOREIGN KEY (`group_groupId`) REFERENCES `group` (`groupId`),
  ADD CONSTRAINT `fk_rating_user2` FOREIGN KEY (`user_createdUserId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_session_group1` FOREIGN KEY (`group_groupId`) REFERENCES `group` (`groupId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sessionmember`
--
ALTER TABLE `sessionmember`
  ADD CONSTRAINT `fk_sessionmember_session1` FOREIGN KEY (`sessionId`) REFERENCES `session` (`sessionId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sessionmember_user1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `trainer`
--
ALTER TABLE `trainer`
  ADD CONSTRAINT `fk_trainer_user1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `trainerhistory`
--
ALTER TABLE `trainerhistory`
  ADD CONSTRAINT `fk_trainerHistory_user1` FOREIGN KEY (`user_userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
