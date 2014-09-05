-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2013 at 09:02 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `utopia_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `ud_parent_son`
--

CREATE TABLE IF NOT EXISTS `ud_parent_son` (
  `parentID` int(11) NOT NULL,
  `sonID` int(11) NOT NULL,
  PRIMARY KEY (`parentID`,`sonID`),
  KEY `sonID` (`sonID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ud_parent_son`
--

INSERT INTO `ud_parent_son` (`parentID`, `sonID`) VALUES
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ud_question`
--

CREATE TABLE IF NOT EXISTS `ud_question` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `userModID` int(11) NOT NULL,
  `questionCatID` int(11) NOT NULL,
  `questionName` varchar(50) NOT NULL,
  `questionText` varchar(4000) DEFAULT NULL,
  `questionMark` float NOT NULL DEFAULT '1',
  `questionPenaltyMark` float NOT NULL,
  `questionTypeID` int(5) NOT NULL,
  `questionShuffle` tinyint(1) NOT NULL DEFAULT '0',
  `questionGeneralFeedback` varchar(500) DEFAULT NULL,
  `questionPosFeedback` varchar(500) DEFAULT NULL,
  `questionParFeedback` varchar(500) DEFAULT NULL,
  `questionNegFeedback` varchar(500) DEFAULT NULL,
  `questionThrashed` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`questionID`),
  KEY `questionCatID` (`questionCatID`),
  KEY `questionTypeID` (`questionTypeID`),
  KEY `userID` (`userID`),
  KEY `questionCatID_2` (`questionCatID`),
  KEY `userModID` (`userModID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_choice_match`
--

CREATE TABLE IF NOT EXISTS `ud_question_choice_match` (
  `matchID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `matchQuestion` varchar(300) NOT NULL,
  `matchAnswer` varchar(300) NOT NULL,
  PRIMARY KEY (`matchID`,`questionID`),
  KEY `questionID` (`questionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_choice_match_misguide`
--

CREATE TABLE IF NOT EXISTS `ud_question_choice_match_misguide` (
  `misguideID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `choiceText` varchar(300) NOT NULL,
  `choiceFeedback` varchar(500) NOT NULL,
  PRIMARY KEY (`misguideID`,`questionID`),
  KEY `questionID` (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_choice_multiple`
--

CREATE TABLE IF NOT EXISTS `ud_question_choice_multiple` (
  `choiceID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `choiceText` varchar(100) NOT NULL,
  `choiceCorrect` tinyint(1) NOT NULL DEFAULT '0',
  `choiceGrade` float NOT NULL DEFAULT '0',
  `choiceFeedback` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`choiceID`,`questionID`),
  KEY `questionID` (`questionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_choice_numerical`
--

CREATE TABLE IF NOT EXISTS `ud_question_choice_numerical` (
  `questionID` int(11) NOT NULL,
  `choiceValue` float NOT NULL,
  `choiceTolerance` float NOT NULL,
  `choiceFeedback` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_choice_single`
--

CREATE TABLE IF NOT EXISTS `ud_question_choice_single` (
  `choiceID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `choiceText` varchar(100) NOT NULL,
  `choiceCorrect` tinyint(1) NOT NULL DEFAULT '1',
  `choiceGrade` float NOT NULL DEFAULT '0',
  `choiceFeedback` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`choiceID`,`questionID`),
  KEY `questionID` (`questionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_choice_sub`
--

CREATE TABLE IF NOT EXISTS `ud_question_choice_sub` (
  `questionID` int(11) NOT NULL,
  `choiceText` varchar(100) NOT NULL,
  `choiceFeedback` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_choice_true_false`
--

CREATE TABLE IF NOT EXISTS `ud_question_choice_true_false` (
  `questionID` int(11) NOT NULL,
  `choiceTF` tinytext NOT NULL,
  `choiceFeedback` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_hint`
--

CREATE TABLE IF NOT EXISTS `ud_question_hint` (
  `hintID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) NOT NULL,
  `hintText` varchar(500) NOT NULL,
  PRIMARY KEY (`hintID`,`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_question_type`
--

CREATE TABLE IF NOT EXISTS `ud_question_type` (
  `questionTypeID` int(5) NOT NULL AUTO_INCREMENT,
  `questionType` varchar(30) NOT NULL,
  `questionTemplate` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`questionTypeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ud_question_type`
--

INSERT INTO `ud_question_type` (`questionTypeID`, `questionType`, `questionTemplate`) VALUES
(1, 'Single Choice', NULL),
(2, 'Multiple Choice', NULL),
(3, 'Subjective', NULL),
(4, 'True/False', NULL),
(5, 'Matching', NULL),
(6, 'Numerical', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ud_quiz`
--

CREATE TABLE IF NOT EXISTS `ud_quiz` (
  `quizID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `quizName` varchar(50) NOT NULL,
  `quiztimestampF` datetime NOT NULL,
  `quiztimestampS` datetime NOT NULL,
  `quizDuration` int(10) NOT NULL,
  `quizTotScore` int(5) NOT NULL DEFAULT '0',
  `quizEffectiveScoreType` int(1) NOT NULL DEFAULT '0',
  `quizInstruction` varchar(1000) DEFAULT NULL,
  `quizShuffle` tinyint(1) NOT NULL DEFAULT '0',
  `quizAttempts` int(5) NOT NULL DEFAULT '1',
  `quizPublished` tinyint(1) NOT NULL DEFAULT '0',
  `timestampC` datetime NOT NULL,
  `timestampM` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`quizID`,`userID`,`subjectID`),
  KEY `userID` (`userID`),
  KEY `subjectID` (`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_quiz_question`
--

CREATE TABLE IF NOT EXISTS `ud_quiz_question` (
  `quizID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `questionNo` int(5) NOT NULL,
  `questionGrade` int(5) NOT NULL,
  PRIMARY KEY (`quizID`,`questionID`),
  KEY `questionID` (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ud_subject`
--

CREATE TABLE IF NOT EXISTS `ud_subject` (
  `subjectID` int(11) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(150) NOT NULL,
  `subjectDetail` varchar(10000) DEFAULT NULL,
  `subjectLogo` varchar(50) NOT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_subjects_users`
--

CREATE TABLE IF NOT EXISTS `ud_subjects_users` (
  `subjectID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `subjectStart` datetime NOT NULL,
  `subjectEnd` datetime NOT NULL,
  `subjectAcc` datetime NOT NULL,
  `subjectMod` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subjectID`,`userID`),
  UNIQUE KEY `subjectMod` (`subjectMod`),
  UNIQUE KEY `subjectAcc` (`subjectAcc`),
  UNIQUE KEY `timestamp` (`timestamp`),
  KEY `userID` (`userID`),
  KEY `subjectID` (`subjectID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ud_subject_category`
--

CREATE TABLE IF NOT EXISTS `ud_subject_category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `subjectID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `category` varchar(150) NOT NULL,
  `categoryDefault` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoryID`,`subjectID`,`userID`),
  KEY `subjectID` (`subjectID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_subject_notification`
--

CREATE TABLE IF NOT EXISTS `ud_subject_notification` (
  `subjectID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `notificationTitle` varchar(200) NOT NULL,
  `notificationMessage` varchar(5000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subjectID`,`userID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ud_users`
--

CREATE TABLE IF NOT EXISTS `ud_users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userCode` varchar(50) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userLogin` varchar(50) NOT NULL,
  `userPassword` varchar(32) NOT NULL,
  `userRole` int(2) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userTimeZone` int(5) DEFAULT NULL,
  `userLogo` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userLogin` (`userLogin`),
  UNIQUE KEY `userCode` (`userCode`),
  KEY `userRole` (`userRole`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

--
-- Dumping data for table `ud_users`
--

INSERT INTO `ud_users` (`userID`, `userCode`, `userName`, `userLogin`, `userPassword`, `userRole`, `userEmail`, `userTimeZone`, `userLogo`, `timestamp`) VALUES
(1, '07FSCSE023', 'Anthoniraj Amalanathan', 'anthoniraj', 'e10adc3949ba59abbe56e057f20f883e', 3, 'anthoniraj@gmail.com', NULL, '', '2013-02-25 07:26:57'),
(2, '10BCE0049', 'Shubhankar Banerjee', 'shubhankar', 'e10adc3949ba59abbe56e057f20f883e', 4, 'shubh.banerjee007@gmail.com', NULL, NULL, '2013-01-26 17:52:05'),
(3, '07FSCSE024', 'Navin Kumar', 'navin', 'e10adc3949ba59abbe56e057f20f883e', 3, 'navin@gmail.com', NULL, '', '2013-02-25 07:26:57'),
(4, '', 'Mr Singh', 'prtapsingh', 'e10adc3949ba59abbe56e057f20f883e', 5, 'pratap@gmail.com', NULL, NULL, '2013-04-25 15:33:27'),
(8, '07SCSE023', 'Margret Annoucina', 'margret', 'e10adc3949ba59abbe56e057f20f883e', 2, 'margret@gmail.com', NULL, NULL, '2013-04-25 21:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `ud_users_attempt`
--

CREATE TABLE IF NOT EXISTS `ud_users_attempt` (
  `attemptID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `quizID` int(11) NOT NULL,
  `attemptNo` int(5) NOT NULL,
  `attemptStart` datetime NOT NULL,
  `attemptEnd` datetime NOT NULL,
  `attemptScore` float NOT NULL DEFAULT '0',
  `attemptComplete` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` varchar(15) NOT NULL,
  PRIMARY KEY (`attemptID`,`userID`,`quizID`),
  KEY `userID` (`userID`),
  KEY `quizID` (`quizID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `ud_users_attempt_answer`
--

CREATE TABLE IF NOT EXISTS `ud_users_attempt_answer` (
  `attemptID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `questionNo` int(3) NOT NULL,
  `answer` varchar(1500) NOT NULL,
  PRIMARY KEY (`attemptID`,`questionID`),
  KEY `quizID` (`attemptID`),
  KEY `questionID` (`questionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ud_users_role`
--

CREATE TABLE IF NOT EXISTS `ud_users_role` (
  `userRoleID` int(5) NOT NULL AUTO_INCREMENT,
  `userRoleName` varchar(50) NOT NULL,
  PRIMARY KEY (`userRoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ud_users_role`
--

INSERT INTO `ud_users_role` (`userRoleID`, `userRoleName`) VALUES
(1, 'Superadmin'),
(2, 'Director'),
(3, 'Teacher'),
(4, 'Student'),
(5, 'Parent');

-- --------------------------------------------------------

--
-- Table structure for table `ud_users_subjects`
--

CREATE TABLE IF NOT EXISTS `ud_users_subjects` (
  `userSID` int(11) NOT NULL,
  `userTID` int(11) NOT NULL,
  `subjectID` int(11) NOT NULL,
  `subjectAcc` datetime NOT NULL,
  `subjectMod` datetime NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `debarred` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userSID`,`userTID`,`subjectID`),
  KEY `subjectID` (`subjectID`),
  KEY `userSID` (`userSID`,`userTID`),
  KEY `userTID` (`userTID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ud_users_subjects`
--

INSERT INTO `ud_users_subjects` (`userSID`, `userTID`, `subjectID`, `subjectAcc`, `subjectMod`, `timestamp`, `debarred`) VALUES
(2, 1, 1, '2013-04-25 21:00:22', '0000-00-00 00:00:00', '2013-02-24 19:24:06', 0),
(2, 3, 3, '2013-02-25 08:50:38', '0000-00-00 00:00:00', '2013-02-25 08:08:42', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ud_parent_son`
--
ALTER TABLE `ud_parent_son`
  ADD CONSTRAINT `ud_parent_son_ibfk_2` FOREIGN KEY (`sonID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_parent_son_ibfk_1` FOREIGN KEY (`parentID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question`
--
ALTER TABLE `ud_question`
  ADD CONSTRAINT `ud_question_ibfk_2` FOREIGN KEY (`questionTypeID`) REFERENCES `ud_question_type` (`questionTypeID`),
  ADD CONSTRAINT `ud_question_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_question_ibfk_4` FOREIGN KEY (`userModID`) REFERENCES `ud_users` (`userID`),
  ADD CONSTRAINT `ud_question_ibfk_5` FOREIGN KEY (`questionCatID`) REFERENCES `ud_subject_category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question_choice_match`
--
ALTER TABLE `ud_question_choice_match`
  ADD CONSTRAINT `ud_question_choice_match_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question_choice_match_misguide`
--
ALTER TABLE `ud_question_choice_match_misguide`
  ADD CONSTRAINT `ud_question_choice_match_misguide_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question_choice_multiple`
--
ALTER TABLE `ud_question_choice_multiple`
  ADD CONSTRAINT `ud_question_choice_multiple_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question_choice_numerical`
--
ALTER TABLE `ud_question_choice_numerical`
  ADD CONSTRAINT `ud_question_choice_numerical_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question_choice_single`
--
ALTER TABLE `ud_question_choice_single`
  ADD CONSTRAINT `ud_question_choice_single_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question_choice_sub`
--
ALTER TABLE `ud_question_choice_sub`
  ADD CONSTRAINT `ud_question_choice_sub_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_question_choice_true_false`
--
ALTER TABLE `ud_question_choice_true_false`
  ADD CONSTRAINT `ud_question_choice_true_false_ibfk_1` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_quiz`
--
ALTER TABLE `ud_quiz`
  ADD CONSTRAINT `ud_quiz_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_quiz_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `ud_subject` (`subjectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_quiz_question`
--
ALTER TABLE `ud_quiz_question`
  ADD CONSTRAINT `ud_quiz_question_ibfk_1` FOREIGN KEY (`quizID`) REFERENCES `ud_quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_quiz_question_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`);

--
-- Constraints for table `ud_subjects_users`
--
ALTER TABLE `ud_subjects_users`
  ADD CONSTRAINT `ud_subjects_users_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `ud_subject` (`subjectID`),
  ADD CONSTRAINT `ud_subjects_users_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_subject_category`
--
ALTER TABLE `ud_subject_category`
  ADD CONSTRAINT `ud_subject_category_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `ud_subject` (`subjectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_subject_category_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_subject_notification`
--
ALTER TABLE `ud_subject_notification`
  ADD CONSTRAINT `ud_subject_notification_ibfk_1` FOREIGN KEY (`subjectID`) REFERENCES `ud_subject` (`subjectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_subject_notification_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_users`
--
ALTER TABLE `ud_users`
  ADD CONSTRAINT `ud_users_ibfk_1` FOREIGN KEY (`userRole`) REFERENCES `ud_users_role` (`userRoleID`);

--
-- Constraints for table `ud_users_attempt`
--
ALTER TABLE `ud_users_attempt`
  ADD CONSTRAINT `ud_users_attempt_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_users_attempt_ibfk_2` FOREIGN KEY (`quizID`) REFERENCES `ud_quiz` (`quizID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_users_attempt_answer`
--
ALTER TABLE `ud_users_attempt_answer`
  ADD CONSTRAINT `ud_users_attempt_answer_ibfk_3` FOREIGN KEY (`questionID`) REFERENCES `ud_question` (`questionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_users_attempt_answer_ibfk_4` FOREIGN KEY (`attemptID`) REFERENCES `ud_users_attempt` (`attemptID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ud_users_subjects`
--
ALTER TABLE `ud_users_subjects`
  ADD CONSTRAINT `ud_users_subjects_ibfk_2` FOREIGN KEY (`subjectID`) REFERENCES `ud_subject` (`subjectID`),
  ADD CONSTRAINT `ud_users_subjects_ibfk_3` FOREIGN KEY (`userSID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ud_users_subjects_ibfk_4` FOREIGN KEY (`userTID`) REFERENCES `ud_users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
