-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--


SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `videoapp`
--

-- --------------------------------------------------------

--
-- table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ipaddr_1` text NOT NULL,
  `ipaddr_2` text NOT NULL,
  `startdate` date NOT NULL,
  `starttime` time NOT NULL,
  PRIMARY KEY (`sessionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- table `session_events` used to store all viewing activity during sessions
--

CREATE TABLE IF NOT EXISTS `session_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vid` int(11) NOT NULL,
  `sessionid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `eventtype` int(11) NOT NULL,
  `videotime` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `content_table_bool` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- table `session_potatoes` used to store activities from hot potatoes attempted by learners during sessions
--

CREATE TABLE IF NOT EXISTS `session_potatoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `exerciseid` int(11) NOT NULL,
  `exercisename` tinytext NOT NULL,
  `score` int(11) NOT NULL,
  `starttime` datetime NOT NULL,
  `endtime` datetime NOT NULL,
  `alldone` tinyint(4) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- table `session_videos` used to store videos started by learners
--

CREATE TABLE IF NOT EXISTS `session_videos` (
  `vid` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `starttime` time NOT NULL,
  PRIMARY KEY (`vid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- table `session_video_quiz` used to store quizzes attempted by learners during sessions
--

CREATE TABLE IF NOT EXISTS `session_video_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `answerInt` int(11) NOT NULL,
  `answerText` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `am` int(11) NOT NULL,
  `flname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `username` tinytext CHARACTER SET latin1 NOT NULL,
  `firstname` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `password` tinytext CHARACTER SET latin1 NOT NULL,
  `mail` text CHARACTER SET latin1 NOT NULL,
  `checked` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 
-- You can use your credentials here

INSERT INTO `users` (`user_id`, `am`, `flname`, `username`, `firstname`, `password`, `mail`, `checked`) VALUES
(1, 4545, 'Alex Kleftodimos', 'Alex', 'Alex', '123', 'kleftodimos@gmail.com', 1);

-- --------------------------------------------------------

--
-- table `videos`, contains details about the videos
--

CREATE TABLE IF NOT EXISTS `videos` (
  `videoid` int(11) NOT NULL AUTO_INCREMENT,
  `videolength` int(11) NOT NULL,
  `videotitle` varchar(50) NOT NULL,
  `videourl` text NOT NULL,
  `time_section_threshold` int(11) NOT NULL,
  `video_sections_bool` tinyint(1) NOT NULL,
  PRIMARY KEY (`videoid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Two videos are already inserted, 
--

INSERT INTO `videos` (`videoid`, `videolength`, `videotitle`, `videourl`, `time_section_threshold`, `video_sections_bool`) VALUES
(1, 432, 'Graphic Design', 'https://www.youtube.com/watch?v=KxJWF36SANU', 60, 1),
(2, 233, 'Google Adwords', 'https://www.youtube.com/watch?v=05we2g3Edgs', 60, 1);

-- --------------------------------------------------------

--
-- table `video_quiz`, (video quizz details)
--

CREATE TABLE IF NOT EXISTS `video_quiz` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `videoid` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `questionType` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer1` varchar(100) NOT NULL,
  `answer2` varchar(100) NOT NULL,
  `answer3` varchar(100) NOT NULL,
  `answer4` varchar(100) NOT NULL,
  `answer5` varchar(100) NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Some examples are already inserted
--

INSERT INTO `video_quiz` (`qid`, `videoid`, `start`, `end`, `questionType`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`) VALUES
(1, 1, 17, 17, 1, 'What is the job of a Graphic Designer according to the 1st Speaker', 'Design interior spaces ', 'Design logos,books,posters, web pages ', 'Design buildings ', '', ''),
(2, 1, 18, 18, 2, 'How would people react 20 years ago when the heard the word "Graphic Designer"', '', '', '', '', ''),
(7, 2, 9, 9, 1, 'What is adwords', 'Googles online advertizment platform', 'TV adverb', 'Radio advertizement', '', ''),
(8, 2, 11, 11, 2, 'How do you think adwords works?', '', '', '', '', '');

-- --------------------------------------------------------

--
-- table `video_sections`, used for storing sections (that can also show up as table of contents)
--

CREATE TABLE IF NOT EXISTS `video_sections` (
  `videoid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  PRIMARY KEY (`videoid`,`sectionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Some example data for the Graphic Design Video
--

INSERT INTO `video_sections` (`videoid`, `sectionid`, `title`, `start`, `end`) VALUES
(1, 1, 'Speaker 1', 0, 53),
(1, 2, 'Speaker 2', 54, 103),
(1, 3, 'Speaker 1 (2nd speech)', 104, 149),
(1, 4, 'Speaker 2 (2nd speech)', 150, 219),
(1, 5, 'Speaker 1 (3rd speech)', 220, 311),
(1, 6, 'Speaker 3 (female)', 312, 338),
(1, 7, 'Speakers 4', 339, 433);

-- --------------------------------------------------------

--
-- table  `video_subtitles`
--

CREATE TABLE IF NOT EXISTS `video_subtitles` (
  `sbid` int(11) NOT NULL AUTO_INCREMENT,
  `videoid` int(11) NOT NULL,
  `subtitleid` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`sbid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Example data for subtitles
--

INSERT INTO `video_subtitles` (`sbid`, `videoid`, `subtitleid`, `start`, `end`, `text`) VALUES
(1, 1, 1, 5, 15, '20 years ago if I''d say that Iam a graphic designer people would have starred at me as if I was from another planet');

-- --------------------------------------------------------

--
-- table `video_url_code`, used for storing internet sources that will either show up as a url or as an embeded webpage next to the video
--

CREATE TABLE IF NOT EXISTS `video_url_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `videoid` int(11) NOT NULL,
  `urlid` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `isembedcode` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Example data `video_url_code`
--

INSERT INTO `video_url_code` (`id`, `videoid`, `urlid`, `start`, `end`, `text`, `isembedcode`) VALUES
(1, 1, 1, 18, 19, 'https://en.wikipedia.org/wiki/Graphic_design', 0),
(2, 1, 2, 25, 26, '<img src="http://1.bp.blogspot.com/-mMQIe-l5S1U/UVFMiIMRNLI/AAAAAAAADtE/TTb1El4k0cI/s1600/url.gif" style="max-width:100%" alt="Sabon Fonts" />', 1),
(3, 1, 3, 37, 38, ' <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d167997.34988049773!2d2.2074683782158937!3d48.85899999405031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e1f06e2b70f%3A0x40b82c3688c9460!2zzqDOsc-Bzq_Pg865LCDOk86xzrvOu86vzrE!5e0!3m2!1sel!2sgr!4v1460125878502" width="300" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>', 1);

-- --------------------------------------------------------

--
-- table `video_url_code_potatoes`, used for storing webpages created with hotpotatoes (containing activities e.g Fill in Blanks)
--

CREATE TABLE IF NOT EXISTS `video_url_code_potatoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `videoid` int(11) NOT NULL,
  `urlid` int(11) NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `text` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` text NOT NULL,
  `description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `isembedcode` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Example data for `video_url_code_potatoes`
--

INSERT INTO `video_url_code_potatoes` (`id`, `videoid`, `urlid`, `start`, `end`, `text`, `url`, `description`, `isembedcode`) VALUES
(1, 1, 1, 10, 10, '<iframe src="example_hotpotatoes_1.php" width="600" height="400" frameborder="0" style="border:0">', '', '', 1),
(2, 1, 2, 65, 65, '<iframe src="example_hotpotatoes_2.php" width="600" height="400" frameborder="0" style="border:0">', '', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
