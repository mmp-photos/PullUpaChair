-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: custsql-ipg87.eigbox.net
-- Generation Time: Nov 10, 2017 at 10:50 PM
-- Server version: 5.6.37
-- PHP Version: 4.4.9
-- 
-- Database: `puac`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `Errors`
-- 

DROP TABLE IF EXISTS `Errors`;
CREATE TABLE `Errors` (
  `ErrorKey` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ErrorText` mediumtext NOT NULL,
  PRIMARY KEY (`ErrorKey`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `Errors`
-- 

INSERT INTO `Errors` VALUES (0000000001, '<p class=\\"error\\">You are seeing this message because you do not have sufficient privileges to access the requested page.</p>\r\n\r\n<p class=\\"error\\">Please sign in with an Administrator account.</p>');

-- --------------------------------------------------------

-- 
-- Table structure for table `ForeignKey`
-- 

DROP TABLE IF EXISTS `ForeignKey`;
CREATE TABLE `ForeignKey` (
  `Prefix` varchar(2) NOT NULL,
  `KeyID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `KeyName` varchar(25) NOT NULL,
  `KeyShortKey` varchar(4) NOT NULL,
  PRIMARY KEY (`KeyID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `ForeignKey`
-- 

INSERT INTO `ForeignKey` VALUES ('KY', 00001, 'Active', 'ACTV');
INSERT INTO `ForeignKey` VALUES ('KY', 00002, 'Deleted', 'DLTE');
INSERT INTO `ForeignKey` VALUES ('KY', 00003, 'Active', 'ACTV');
INSERT INTO `ForeignKey` VALUES ('KY', 00004, 'Deleted', 'DLTE');
INSERT INTO `ForeignKey` VALUES ('KY', 00005, 'Key Prefix', 'KY');

-- --------------------------------------------------------

-- 
-- Table structure for table `Links`
-- 

DROP TABLE IF EXISTS `Links`;
CREATE TABLE `Links` (
  `LinkID` int(9) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `LinkPerformer` int(6) unsigned zerofill NOT NULL,
  `LinkURL` varchar(125) NOT NULL,
  `LinkName` varchar(25) NOT NULL,
  `LinkType` varchar(2) NOT NULL,
  `LinkStatus` varchar(2) NOT NULL,
  `LinkAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LinkID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `Links`
-- 

INSERT INTO `Links` VALUES (000000002, 000001, 'https://www.etsy.com/shop/DeMurArtPrints', 'Etsy', 'ES', 'AP', '2017-11-07 22:47:45');
INSERT INTO `Links` VALUES (000000003, 000001, 'https://www.facebook.com/artofsaraejonesdockery/', 'FaceBook', 'FB', 'AP', '2017-11-07 22:47:45');
INSERT INTO `Links` VALUES (000000004, 000030, 'http://www.searchingforkerouac.wordpress.com/', 'Blog', 'WP', 'AP', '0000-00-00 00:00:00');
INSERT INTO `Links` VALUES (000000005, 000001, 'https://www.instagram.com/sejd_artist/', '@sejd_artist ', 'IN', 'AP', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Table structure for table `NewsUpdates`
-- 

DROP TABLE IF EXISTS `NewsUpdates`;
CREATE TABLE `NewsUpdates` (
  `UpdateID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `UpdateTitle` varchar(50) NOT NULL,
  `UpdateText` mediumtext NOT NULL,
  `DateAdded` date NOT NULL,
  `DateExpires` date NOT NULL,
  `Status` varchar(4) NOT NULL,
  PRIMARY KEY (`UpdateID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `NewsUpdates`
-- 

INSERT INTO `NewsUpdates` VALUES (000001, 'Submissions Closed.  Call for Submissions', 'The next installment of Pull Up a Chair, Indy''s unique storytelling show will be April, 29th.  We are now accepting submissions for stories at the show.  Please use the <a href="submissions.php">Submissions</a> page.', '1969-12-31', '2017-04-04', 'ACTV');
INSERT INTO `NewsUpdates` VALUES (000002, 'Show. The Third April 29, 2017', 'Ticket link is live!\r\nA spin on traditional storytelling, Pull Up A Chair will feature spoken stories in addition to stories told using other art forms. Past shows have featured Improv, puppetry, dance, music, burlesque, visual art and more. There is no limit to how a story can be told. Featuring some of Indy''s best artists Including Patrick Weigand, Jason Adams, WaZeil, Members of Angel Burlesque, Vicki Kortz,  Rai Caraballo, Joyce Manier and Genevieve Johnson. \r\nSaturday, April 29, 2017 8:00 PM\r\nPlayground Production Studios in Irvington\r\n$10 in advance, $15 at the door\r\nFree Parking!\r\n\r\nTickets: http://m.bpt.me/event/2910543\r\n\r\nQuestions? Indypullupachair@gmail.com\r\n\r\n', '1969-12-31', '2017-05-09', 'AP');
INSERT INTO `NewsUpdates` VALUES (000003, 'A fourth show?! YES!', 'It''s official. Our next show is July 29th, 2017. Save the date!  Submissions will be accepted soon!', '1969-12-31', '2017-07-29', 'AP');
INSERT INTO `NewsUpdates` VALUES (000004, 'Tickets On Sale Now!', 'http://m.bpt.me/event/3040850', '2017-11-07', '2017-07-30', 'AP');

-- --------------------------------------------------------

-- 
-- Table structure for table `Performers`
-- 

DROP TABLE IF EXISTS `Performers`;
CREATE TABLE `Performers` (
  `Prefix` varchar(2) NOT NULL DEFAULT 'PF',
  `PerformerID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `PerformerFirstName` varchar(50) NOT NULL,
  `PerformerLastName` varchar(50) NOT NULL,
  `PerformerBio` longtext NOT NULL,
  `PerformerPhoto` varchar(75) NOT NULL,
  `Status` varchar(4) NOT NULL,
  `PDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PDateUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`PerformerID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

-- 
-- Dumping data for table `Performers`
-- 

INSERT INTO `Performers` VALUES ('PF', 000001, 'Sara', 'Jones-Dockery', 'Sara Jones-Dockery is a multi media artist with work spanning photography, illustration, projection, performance and traditional media. If she had to choose one medium to describe her work, She''d say it''s the human body. She''s always been fascinated in biology and anatomy which remain her foundation as she explores themes in human identity. As an introvert who has long struggled with social anxiety disorder, she uses her art to push the boundaries of how she interacts with people and expresses her psychological experiences.', 'SaraJonesDockery.jpg', 'ACTV', '2016-10-28 14:16:00', '2016-10-28 14:16:00');
INSERT INTO `Performers` VALUES ('PF', 000002, 'Jason', 'Adams', 'Gentleman geek', '', 'ACTV', '2016-10-31 10:37:07', '2016-10-31 10:37:07');
INSERT INTO `Performers` VALUES ('PF', 000003, 'Mary', 'Armstrong- Smith', '', '', 'ACTV', '2016-11-01 15:59:58', '2016-11-01 15:59:58');
INSERT INTO `Performers` VALUES ('PF', 000004, 'Zach', 'Ramsey', '', '', 'ACTV', '2016-11-01 16:00:21', '2016-11-01 16:00:21');
INSERT INTO `Performers` VALUES ('PF', 000005, 'Pamela', 'O''Brien', '', '', 'ACTV', '2016-11-01 16:00:47', '2016-11-01 16:00:47');
INSERT INTO `Performers` VALUES ('PF', 000006, 'Ivory', 'Fleurtini', '', '', 'ACTV', '2016-11-01 16:01:16', '2016-11-01 16:01:16');
INSERT INTO `Performers` VALUES ('PF', 000007, 'Matt', 'Fogleman', '', '', 'ACTV', '2016-11-01 16:02:01', '2016-11-01 16:02:01');
INSERT INTO `Performers` VALUES ('PF', 000008, 'Roger', 'Roe', 'Roger Roe has played oboe with the Indianapolis Symphony Orchestra for 21 years.', '', 'ACTV', '2016-11-01 16:02:36', '2016-11-01 16:02:36');
INSERT INTO `Performers` VALUES ('PF', 000009, 'Christy', 'Warren', '', '', 'ACTV', '2016-11-01 16:02:58', '2016-11-01 16:02:58');
INSERT INTO `Performers` VALUES ('PF', 000010, 'Minnie', 'Ryder', '', '', 'ACTV', '2016-11-01 16:03:19', '2016-11-01 16:03:19');
INSERT INTO `Performers` VALUES ('PF', 000011, 'Kate', 'Duffy Sim', '', '', 'ACTV', '2016-11-01 20:20:04', '2016-11-01 20:20:04');
INSERT INTO `Performers` VALUES ('PF', 000012, 'Frankie', 'Spanxx', '', '', 'ACTV', '2016-11-02 17:42:47', '2016-11-02 17:42:47');
INSERT INTO `Performers` VALUES ('PF', 000013, 'Cora', 'Noire', '', '', 'ACTV', '2016-11-02 17:43:41', '2016-11-02 17:43:41');
INSERT INTO `Performers` VALUES ('PF', 000014, 'Laney', 'Blaine', '', '', 'ACTV', '2016-11-02 17:44:49', '2016-11-02 17:44:49');
INSERT INTO `Performers` VALUES ('PF', 000015, 'Grammaw', '', '', '', 'ACTV', '2016-11-02 17:45:11', '2016-11-02 17:45:11');
INSERT INTO `Performers` VALUES ('PF', 000016, 'Angela', 'Leisure', '', '', 'ACTV', '2016-11-02 17:45:33', '2016-11-02 17:45:33');
INSERT INTO `Performers` VALUES ('PF', 000017, 'Kris', 'Manier', '', '', 'ACTV', '2016-11-02 17:45:55', '2016-11-02 17:45:55');
INSERT INTO `Performers` VALUES ('PF', 000018, 'Hannah', 'Elizabeth', '', '', 'ACTV', '2016-11-02 17:46:15', '2016-11-02 17:46:15');
INSERT INTO `Performers` VALUES ('PF', 000019, 'Patrick', 'Weigand', '', '', 'ACTV', '2016-11-02 17:46:55', '2016-11-02 17:46:55');
INSERT INTO `Performers` VALUES ('PF', 000020, 'Jillian', 'Godwin', '', '', 'ACTV', '2016-11-02 17:47:33', '2016-11-02 17:47:33');
INSERT INTO `Performers` VALUES ('PF', 000021, 'Maria', 'Meschi', '', '', 'ACTV', '2016-11-02 17:48:09', '2016-11-02 17:48:09');
INSERT INTO `Performers` VALUES ('PF', 000022, 'Katie', 'Angel', '', '', 'ACTV', '2016-11-02 17:48:29', '2016-11-02 17:48:29');
INSERT INTO `Performers` VALUES ('PF', 000023, 'Lola', 'Lavacious', '', '', 'ACTV', '2016-11-02 18:00:23', '2016-11-02 18:00:23');
INSERT INTO `Performers` VALUES ('PF', 000024, 'Rai', 'Caraballo', '', 'RaiCaraballo.jpg', 'ACTV', '2017-07-28 14:48:48', '2017-07-28 14:48:48');
INSERT INTO `Performers` VALUES ('PF', 000025, 'Genevieve', 'Johnson', '', '', 'ACTV', '2017-07-28 14:54:24', '2017-07-28 14:54:24');
INSERT INTO `Performers` VALUES ('PF', 000026, 'Vicki', 'Kortz', '', '', 'ACTV', '2017-07-28 14:59:51', '2017-07-28 14:59:51');
INSERT INTO `Performers` VALUES ('PF', 000027, 'Joyce', 'Manier', '', '', 'ACTV', '2017-07-28 15:01:18', '2017-07-28 15:01:18');
INSERT INTO `Performers` VALUES ('PF', 000028, 'Angel', 'Burlesque', '', '', 'ACTV', '2017-07-28 15:03:50', '2017-07-28 15:03:50');
INSERT INTO `Performers` VALUES ('PF', 000029, 'Mary', 'Karty', 'Mary Karty is a local author and storyteller.  She specializes in satire and sweet stories about family and pets.', 'MaryKarty.jpg', 'ACTV', '2017-11-10 00:06:08', '2017-11-10 00:06:08');
INSERT INTO `Performers` VALUES ('PF', 000030, 'Ron', 'Smith', 'Ron is a vagabond storyteller who has wandered about most of the continental United States chasing Jack Kerouac''s shadow to find "it." He studied at Blackburn College where he received his B.A. in Literature and Religion. He occasionally posts his writing and storytelling exploits on his blog www.searchingforkerouac.wordpress.com.', 'RonSmith.jpg', 'ACTV', '2017-11-10 00:06:08', '2017-11-10 00:06:08');

-- --------------------------------------------------------

-- 
-- Table structure for table `ShowInfo`
-- 

DROP TABLE IF EXISTS `ShowInfo`;
CREATE TABLE `ShowInfo` (
  `Prefix` varchar(2) NOT NULL,
  `ShowID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ShowName` varchar(75) NOT NULL,
  `ShowDateTime` datetime NOT NULL,
  `ShowLocation` varchar(6) NOT NULL,
  `ShowDescription` longtext NOT NULL,
  `TicketLink` varchar(200) NOT NULL,
  `ShowStatus` varchar(4) NOT NULL,
  `ShowAdded` datetime NOT NULL,
  `ShowUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SubmissionOpen` date NOT NULL,
  `SubmissionClose` date NOT NULL,
  `TicketSale` date NOT NULL,
  PRIMARY KEY (`ShowID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `ShowInfo`
-- 

INSERT INTO `ShowInfo` VALUES ('SW', 000001, 'Pull Up a Chair - Debut Show', '2016-04-30 21:00:00', 'TOTS', '', '', 'ACTV', '2016-11-01 00:19:42', '2016-11-01 00:19:42', '0000-00-00', '0000-00-00', '0000-00-00');
INSERT INTO `ShowInfo` VALUES ('SW', 000002, 'Pull Up a Chair #2', '2016-10-16 19:30:00', 'TOTS', '', '', 'ACTV', '2016-11-01 00:26:42', '2016-11-01 00:26:42', '0000-00-00', '0000-00-00', '0000-00-00');
INSERT INTO `ShowInfo` VALUES ('', 000003, 'Pull Up a Chair 3', '2017-04-29 21:00:00', 'TOTS', 'The third installment in Indy''s own storytelling variety show.', '', 'ACTV', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '0000-00-00');
INSERT INTO `ShowInfo` VALUES ('SH', 000004, 'Pull Up a Chair 4', '2017-07-29 20:00:00', '', 'The fourth installment of the Pull Up a Chair series.', 'http://www.brownpapertickets.com/event/3040850', 'ACTV', '2017-06-09 00:20:15', '0000-00-00 00:00:00', '0000-00-00', '0000-00-00', '0000-00-00');
INSERT INTO `ShowInfo` VALUES ('SH', 000005, 'Pull Up a Chair November', '2017-11-17 21:52:19', 'PLGP', 'November''s show', '', 'ACTV', '2017-09-19 21:53:43', '0000-00-00 00:00:00', '2017-09-19', '2017-10-24', '2017-11-17');

-- --------------------------------------------------------

-- 
-- Table structure for table `Stories`
-- 

DROP TABLE IF EXISTS `Stories`;
CREATE TABLE `Stories` (
  `Prefix` varchar(2) NOT NULL,
  `StoryID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `StoryName` varchar(50) NOT NULL,
  `ShowID` varchar(6) NOT NULL,
  `ShowOrder` int(2) unsigned zerofill NOT NULL,
  `Performer` varchar(6) NOT NULL,
  `StoryDescription` mediumtext NOT NULL,
  `StoryStatus` varchar(4) NOT NULL,
  `SDateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SDateUpdated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `VideoEmbed` mediumtext NOT NULL,
  `Featured` tinyint(1) DEFAULT NULL,
  `Photo` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`StoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- 
-- Dumping data for table `Stories`
-- 

INSERT INTO `Stories` VALUES ('ST', 000011, 'I Teach at Walgreen''s', '000002', 01, '000003', 'Your first performer has been a stand up comic and storyteller for over two decades. She has appeared at Crackers Comedy Clubs, as well at the Storyzilla Storytelling Show in Bloomington. Tonight''s story is called "I Teach at Walgreen''s." Please help me welcome Mary Armstrong-Smith.', 'ACTV', '2016-11-02 12:54:04', '2016-11-02 12:54:04', '<iframe width="560" height="315" src="https://www.youtube.com/embed/5l-DowzTJW0" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000012, 'Untitled', '000002', 02, '000004', 'You can usually find our next performer occupying the chair behind box office, or you may even see him around at Karaoke Night at Olly''s or Metro. He has been singing his whole life and has dreams bigger than his belt size, please help me welcome to the stage Zach Ramsey', 'ACTV', '2016-11-02 12:57:15', '2016-11-02 12:57:15', '<iframe width="560" height="315" src="https://www.youtube.com/embed/eQHYWIA6gtA" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000013, 'Katrina', '000002', 03, '000005', 'Pamela O''Brien is a native New Orleanian who was living and working as a clinical social worker with the adult chronically mentally ill population in New Orleans at the time of Hurricane Katrina. She fell in love with a man from Indianapolis and movedÂ here two years later. Tonight she will tell the story of what really happened in New Orleans on August 29th, 2005 and how it affected her ten years later. She will show us three paintings she did around the 10th anniversary of the tragedy, and tell how these three paintings started her on a new path as a professional artist.', 'ACTV', '2016-11-02 12:59:03', '2016-11-02 12:59:03', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000014, 'Portrait', '000002', 04, '000006', 'Ivory Fleurtini debuted her first burlesque solo last Halloween. She will be bringing her second solo number back for us this evening. Her inspiration for this came from women that she didn''t know and a few she did who have experienced sexual assault. She saw the news and heard their stories and wanted tell their story through movement. As she was trying to find the perfect song for this concept, Ivory explored her old music. She listened to numerous artists until she rediscovered her connection with the band Aiden. As she was laying on her floor listening to their music - a song came on and her heart stopped. This was it. This what she needed to paint a story - This is Ivory Fleurtini with Portrait.', 'ACTV', '2016-11-02 13:00:10', '2016-11-02 13:00:10', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000015, 'Untitled', '000002', 05, '000007', 'Next is an entertainer and one who appreciates a good burrito, Matt Fogleman is one of the latest additions to ComedySportz and tonight he shares a story about almost throwing his life away only to be saved by one of his biggest heros.', 'ACTV', '2016-11-02 13:01:04', '2016-11-02 13:01:04', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000016, 'Oboe', '000002', 06, '000008', 'Roger Roe has played oboe with the Indianapolis Symphony Orchestra for 21 years', 'ACTV', '2016-11-02 13:02:14', '2016-11-02 13:02:14', '<iframe width="560" height="315" src="https://www.youtube.com/embed/bQM-SyxkwFo?list=PLS8a3WeVH8d9ZHMm20Hf5RAgMq6TFYh69" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000017, 'Nanna Guns', '000002', 07, '000011', 'Kate Duffy Sim is a playwright, poet, actress and artist, and half of GranÃ¡na, a duo that writes and performs plays about women in Irish history, and sings and plays traditional Irish music. Their show Mother Ireland will be appearing next at the Harlequin Theatre in Columbus, Indiana, November 12 and 13.', 'ACTV', '2016-11-02 13:03:18', '2016-11-02 13:03:18', '<iframe width="560" height="315" src="https://www.youtube.com/embed/Wr9B1ed3ho8" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000018, 'Cut', '000002', 08, '000009', 'Christy is an out and proud Lesbian with almost two years of sobriety under her belt, but it hasn''t always been that way.', 'ACTV', '2016-11-02 13:04:18', '2016-11-02 13:04:18', '<iframe width="560" height="315" src="https://www.youtube.com/embed/aTKT4jsH-RQ" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000019, 'Dick Pics & Censorship', '000002', 09, '000001', 'Sara Jones-Dockery is a multi media artist with work spanning photography, illustration, projection, performance and traditional media. Today she will be presenting as a Guerrilla Girl to talk about censorship and gender bias in the art world.', 'ACTV', '2016-11-02 13:06:02', '2016-11-02 13:06:02', '<iframe width="560" height="315" src="https://www.youtube.com/embed/MokQxcU07tA?list=PLS8a3WeVH8d9ZHMm20Hf5RAgMq6TFYh69" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000020, 'Mommy Burlesque', '000002', 10, '000010', 'Being a burlesque performer is interesting. Being a performer with children is...pretty interesting, especially when it comes to brainstorming new acts. Angel Burlesque Troupe member and mama of three kiddos Minnie Ryder is here to relate how quite a few of her ideas have ended up onstage.', 'ACTV', '2016-11-02 13:07:14', '2016-11-02 13:07:14', '<iframe width="560" height="315" src="https://www.youtube.com/embed/6crtFVJ1tTk?list=PLS8a3WeVH8d9ZHMm20Hf5RAgMq6TFYh69" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000021, 'Untitled', '000001', 02, '000002', 'Jason Adams has been a puppeteer and storyteller for more than a decade. He''s a winner of the Skald storytelling competition, Chicago''s oldest storytelling competition. His puppetry has been seen at the Jim Henson Center For Puppetry Arts in Atlanta , the Great Small Works Fest in New York City as well as variety shows and theaters around Chicago and Indianapolis. If you like what you see tonight, you can catch him again in this very spot on Tuesday doing Magic for Indy Magic Monthly, or Saturday doing more puppets for Angel Burlesque''s Open Bra. If you want to see him somewhere else head on down to the Indyfringe Theater for Face Your Fears on May 8th. That show is the best! ', 'ACTV', '2016-11-02 17:39:31', '2016-11-05 00:45:02', '<iframe width="560" height="315" src="https://www.youtube.com/embed/IgwDh07IWTw?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000022, 'Untitled', '000001', 03, '000013', 'Cora, fellow Angel. The open bra next Saturday will mark her 5th burlesque anniversary. She got tired of believing all of the negative labels, tired of hiding all the imperfections that make herunique and has decided to embrace them. Cora Noire\r\n', 'ACTV', '2016-11-02 17:51:44', '2016-11-05 00:34:07', '<iframe width="560" height="315" src="https://www.youtube.com/embed/snvJzx_vQnI?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000023, 'Untitled', '000001', 04, '000014', 'You know this next performer as Selina prince from angel burlesque. ButÂ tonightÂ she is performing as her muggle self...Laney blaine. Laney has been an angel since 2014, butÂ tonightÂ she is going to do something scarier than take your clothes off in public. She is going to share a raw, personal story with you.', 'ACTV', '2016-11-02 17:53:02', '2016-11-05 00:53:25', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000024, 'Metachromatic (Grey)', '000001', 05, '000015', 'Grammaw is from Indianapolis but travels frequently. She is performing a new song off an upcoming LP entitled "Metachromatic (Grey)"', 'ACTV', '2016-11-02 17:54:18', '2016-11-02 17:54:18', '<iframe width="560" height="315" src="https://www.youtube.com/embed/AGpWvGYrvU0?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000025, 'Visual Art', '000001', 06, '000016', 'Art in lobby.', 'ACTV', '2016-11-02 17:55:56', '2016-11-02 17:55:56', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000026, 'Untitled', '000001', 07, '000017', 'Up next is a guy who is new at storytelling, even though heâ€™s spent lots of time on stage as a musician with his band, the Amazing Year 400 Billion. Heâ€™s going to be telling a story heâ€™s never told, not even really to his family or friends, so this should be interesting. Or awkward. Or both. Ladies & Gentlemen, Kris Mander.', 'ACTV', '2016-11-02 17:57:19', '2016-11-05 00:11:47', '<iframe width="560" height="315" src="https://www.youtube.com/embed/aExq-53pix8?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000027, 'Untitled', '000001', 08, '000018', 'Indianapolis diva and general no-goodnick, Hannah Elizabeth, is gracing us with her prescence despite her fears of divulging personal information. A long time frequenter of the stage, Hannah''s loud-ass voice can often be heard- regardless of whether you want to hear it or not. (Even if you''re partially deaf!) ', 'ACTV', '2016-11-02 17:58:50', '2016-11-02 17:58:50', '<iframe width="560" height="315" src="https://www.youtube.com/embed/_X07sHF15Hk?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000028, 'Untitled', '000001', 09, '000001', 'Visual arts.', 'ACTV', '2016-11-02 17:59:41', '2016-11-02 17:59:41', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000029, 'Untitled', '000001', 10, '000023', 'Lola wears many hats on her flesh sack. Tonite she speaks about her body...the good the bad and just okay...Lola LaVacious.', 'ACTV', '2016-11-02 18:02:02', '2016-11-02 18:02:02', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000030, 'Untitled', '000001', 11, '000019', 'Patrick Weigand is a puppeteer, playwright, (actor?) and, in his day job, â€œguy who does stuff.â€ He has been able to attend The National Puppetry Conference at the Eugene Oâ€™Neill Theater Center four times and was recently accepted as a Resident Company Member for this summerâ€™s conference. The piece he is presenting was developed over the course of two conferences, in 2012 and 2014, and was a defining moment on the quest to find his voice as an artist. Here to present a snippet of what he hopes will one day be a full-length production and to talk about his quest to find his voice, is Patrick Weigand.', 'ACTV', '2016-11-02 18:03:03', '2016-11-02 18:03:03', '<iframe width="560" height="315" src="https://www.youtube.com/embed/ecy8CE9ySY4?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000031, 'Untitled', '000001', 12, '000020', 'Up next, we have a moving performance by none other than Dance Kaleidoscope dancer Jillian Godwin, choreography by DK artistic director David Hochoy. It originallyÂ  premiered in December 2012 for DKs concert, Old Blue Eyes. This piece is very special to Jillian because it was the last solo her mother Donna saw her perform before her passing in March 2013. She says she still feels her mothers presence when she dances this piece. So sit back, relax, and let Jill show you a little bit about life.', 'ACTV', '2016-11-02 18:04:27', '2016-11-02 18:04:27', '<iframe width="560" height="315" src="https://www.youtube.com/embed/-zUl1pmr4MM?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000032, 'Untitled', '000001', 13, '000021', 'Maria Meschi is a versatile performer who collects art forms like PokÃ©mon (gotta catch â€˜em all!) Â She has been seen on stages across Indianapolis singing and crackinâ€™ jokes. Some of Mariaâ€™s favorite appearances include Gal Pal Comedy Fest, Flight of the Living Dead (Cirque Indy), Monster Concert (Q Artistry), ZirkusGrimm (Q Artistry), B0T. (Q Artistry), Strike! A New Bowling Pin Musical (Q Artistry), The Brain from Planet X (Buck Creek Players),and Opheliaâ€™s Revenge (Plagued Productions).', 'ACTV', '2016-11-02 18:05:48', '2016-11-02 18:05:48', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000033, 'Improv', '000001', 14, '000002', '', 'ACTV', '2016-11-02 18:06:45', '2016-11-02 18:06:45', '<iframe width="560" height="315" src="https://www.youtube.com/embed/34pC0_9WHjY?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000034, 'Untitled', '000001', 15, '000003', '"Folks, get ready for big fun! Here''s Mary Armstrong-Smith.', 'ACTV', '2016-11-02 18:07:45', '2016-11-02 18:07:45', '<iframe width="560" height="315" src="https://www.youtube.com/embed/ub1V4zibqww?list=PLS8a3WeVH8d_YQYUzSMithjgumSLxe4q6" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000035, 'Untitled', '000001', 16, '000022', 'Our next performer has a story to share that is dear to her heart and is something she still struggles with today.Â  Please welcome Katie Angel.', 'ACTV', '2016-11-02 18:09:36', '2016-11-02 18:09:36', '', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000036, 'Untitled', '000003', 10, '000025', '', 'ACTV', '2017-07-28 14:57:53', '2017-07-28 14:57:53', '<iframe width="560" height="315" src="https://www.youtube.com/embed/2cWksraQLM8" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000037, 'Escape', '000003', 03, '000002', '', 'ACTV', '2017-07-28 14:58:55', '2017-07-28 15:31:35', '<iframe width="560" height="315" src="https://www.youtube.com/embed/2cWksraQLM8" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000038, 'Untitled', '000003', 05, '000026', '', 'ACTV', '2017-07-28 15:00:21', '2017-07-28 15:31:35', '<iframe width="560" height="315" src="https://www.youtube.com/embed/4j6YSumnd6I" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000039, 'The Meandering Path to Creative Joy', '000003', 07, '000027', '', 'ACTV', '2017-07-28 15:01:58', '2017-07-28 15:31:35', '<iframe width="560" height="315" src="https://www.youtube.com/embed/xSFL1P5aUBY" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000040, 'River', '000003', 11, '000028', '', 'ACTV', '2017-07-28 15:04:07', '2017-07-28 15:31:35', '<iframe width="560" height="315" src="https://www.youtube.com/embed/R1ZY-Gqiqiw" frameborder="0" allowfullscreen></iframe>', NULL, '');
INSERT INTO `Stories` VALUES ('ST', 000041, 'Motherhood', '000004', 01, '000021', '', 'ACTV', '2017-11-09 23:53:55', '2017-11-09 23:58:28', '<iframe class="video" src="https://www.youtube.com/embed/ak5hADrjfZU" frameborder="0" gesture="media" allowfullscreen></iframe>', NULL, NULL);
INSERT INTO `Stories` VALUES ('ST', 000042, 'Big Girl Panties', '000004', 02, '000029', 'Big Girl Panties is the story of a transition from dependence on one''s parents, and acceptance of their values to a more independent identity - told through the framing device of underwear.', 'ACTV', '2017-11-10 00:10:51', '2017-11-10 00:10:51', '<iframe class="video" src="https://www.youtube.com/embed/BIKB3y2cVNc" frameborder="0" gesture="media" allowfullscreen></iframe>', NULL, NULL);
INSERT INTO `Stories` VALUES ('ST', 000043, 'Yoga in the West', '000004', 05, '000030', 'My wife drove from Carlinville, IL to Portland, OR. We hit a deer in the middle of southern Idaho where there is hardly anyone around, we were discovered, and helped, but we lost our cat. Along the way we did yoga every few hours to keep ourselves stretched. Yoga is also a type of spiritual path allowing a person to connect with Brahmin, or the divine, according to their personality. We connected with the divine through the people we met and the nature we witnessed.', 'ACTV', '2017-11-10 00:30:11', '2017-11-10 00:31:04', '<iframe  class="video" src="https://www.youtube.com/embed/WUBJ_Agj3ZU" frameborder="0" gesture="media" allowfullscreen></iframe>', NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `Submissions`
-- 

DROP TABLE IF EXISTS `Submissions`;
CREATE TABLE `Submissions` (
  `submission_id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `UserID` varchar(10) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `stage_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `medium` varchar(25) NOT NULL,
  `tone` varchar(25) NOT NULL,
  `length` varchar(25) NOT NULL,
  `synopsis` mediumtext NOT NULL,
  `Introduction` longtext,
  `submission_photo` varchar(50) NOT NULL DEFAULT 'not_updated',
  `links` varchar(50) NOT NULL,
  `show_id` varchar(6) NOT NULL,
  `date_submitted` datetime NOT NULL,
  `date_reviewed` datetime NOT NULL,
  `reviewed_by` varchar(6) NOT NULL,
  `status` varchar(4) NOT NULL,
  `terms` varchar(8) NOT NULL,
  PRIMARY KEY (`submission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `Submissions`
-- 

INSERT INTO `Submissions` VALUES (000002, '', 'Rai ', 'Caraballo ', 'Rai', 'caraballorm@ymail.com', '3179564638', 'The Turtle', 'Personal Narrative', 'Empowering', '10 minutes', 'The process of dating and finding unrequited love, and finally finding enough self confidence, self love and self respect to call it quits. \r\n\r\nFYI- curse words will probably be used. ', NULL, 'not_updated', '', '000003', '2017-03-07 02:03:22', '2017-03-07 02:03:22', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000003, '', 'Kate', 'Duffy Sim', 'Tattooed Nana', 'kate@tattooednana.com ', '3179193103', 'I Left My Keys To The Kingdom In My Other Pants', 'Monologue', 'Irreverent', '12  minutes', 'Monologue on the dilemma of being a genderqueer Catholic and the different humorous personae that present themselves as options.', NULL, 'not_updated', '', '000003', '2017-03-10 12:03:37', '2017-03-10 12:03:37', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000004, '', 'WaZeil ', 'Wu', 'WaZeil ', 'wazuaz@stalph.co', '7655858076', 'Demons', 'Visual Art', 'Informal', '15 minutes', 'As a victim of sexual assualt by a family member for 10 years, starting at the age of 13, my journey of self love has been extremely rocky. Two years ago, I finally gained enough confidence to confront my perpetrator and I suffered extreme repercussions. My entire family turned their backs on me. They set 5 hit men, 3 to my work and 2 to my home to take my life. All because I tried to stand up for myself. This took a major toll on my mental health and self worth. I created this mini series, Demons, to illustrate exactly how I felt during this traumatic time.  I know many young women feel powerless and worthless as I did and I am confident that with an opportunity to showcase this series, I would have the chance to connect with them. ', NULL, 'not_updated', 'http://www.stalph.co/demons.html', '000003', '2017-03-13 05:03:16', '2017-03-13 05:03:16', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000005, '', 'Matthew', 'Mayer', 'none', 'grafixgeek@yahoo.com', '5033608986', 'untitled', 'none', 'noen', '12', 'This is just a test', NULL, 'not_updated', '', '000003', '2017-03-13 03:03:29', '2017-03-13 03:03:29', '000', 'DLTD', 'on');
INSERT INTO `Submissions` VALUES (000006, '', 'Victoria', 'Kortz', '', 'vicki.kortz@hotmail.com', '3178404365', 'Human', 'Singing', 'Self realization', '4 min', 'Human is a song by Christina Petri were she is telling someone I can do it all, but sometimes I am only human, and I have faults. When I sing this song, I sing this song to my inner self, and telling myself that it''s ok to be human. Which is something I struggle with on a daily basis. ', NULL, 'not_updated', '', '000003', '2017-03-14 08:03:23', '2017-03-14 08:03:23', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000007, '', 'Patrick', 'Weigand', '', 'prweigand@gmail.com', '7653769916', 'How Divorce saved my life', 'storytelling (maybe with ', 'Dark (but with some humor', '15-20 (trying to trim it)', 'I had thought I was just unhappy because parts of my marriage sucked. As I went through the process of a separation and eventual divorce, I realized that the depression (and tendency towards self-harm) were part of something much bigger than that. So i decided to fight it.\r\n\r\nThis story talks about that battle, having a brain that closely resembled a 2016 presidential debate, and how hitting bottom helped me find the light.\r\n\r\n*I should note, this does have a pretty frank discussion/depiction of depression, self-harm, and suicide.', NULL, 'not_updated', '', '000003', '2017-04-03 11:04:02', '2017-04-03 11:04:02', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000008, '', 'Patrick ', 'weigand', '', 'prweigand@gmail.com', '7653769916', 'On Raglan Road', 'song', 'folk-ballad', '5', 'Sometimes a song tells your story better than you can\r\nthis is one of those times.\r\n\r\n(This would be my second choice, unless the other is too long or the wrong tone. if both are happening, this should be later in the run order than the other, please)', NULL, 'not_updated', 'not me singing it: https://www.youtube.com/watch?v', '000003', '2017-04-03 11:04:24', '2017-04-03 11:04:24', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000009, '', 'Maria', 'Meschi', '', 'MariaMeschi@gmail.com', '3174026384', 'Move On', 'story & song', 'Uplifting', '7', 'Intermingling Sondheim''s "Move On" with story of my life since Calvin''s birth (ppd, uncertainty over my art/parenting/balance) through to my decision to go back to school\r\n\r\nI''m looking for a live pianist, fyi. Will get that figured out asap', NULL, 'not_updated', '', '000004', '2017-06-12 12:06:04', '2017-06-12 12:06:04', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000010, '', 'Rai', 'Caraballo', 'Rai', 'Caraballorm@ymail.com', '3179564638', 'My boys', 'Regular ole storytellin ', 'Kinda sad kinda happy alw', '8-9 minutes ', 'Giving your heart to someone for 7 years for it ultimately to be broken can leave someone very cynical especially after failed dating afterwards. This story is about me working my way through the heartbreak and loneliness. ', NULL, 'not_updated', '', '000004', '2017-06-12 12:06:52', '2017-06-12 12:06:52', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000011, '', 'Syd', 'Innovaria', 'Syd Innovaria', 'sydinnovaria@gmail.com', '7653764746', 'Soul-Wrenched Love Letters', 'Spoken word, poetry, draw', 'Sad? Emotional', '20?', 'This will be a story of the many people I have loved, romantically, and have loved me, and we have destroyed each other. \r\nThe story will be told using poetry/spoken word, and a piece of art to represent each person. I can''t share any of the pieces until it is all completed. \r\nSome of the poetry/spoken word will be excerpts of diary entries and letters written to and from those people whom I was romantically involved with. \r\nMessage me if you need further details. I don''t know an exact time, but I also hate to limit myself because you never know how emotional and involved these things can get. ', NULL, 'not_updated', '', '000004', '2017-06-20 04:06:19', '2017-06-20 04:06:19', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000012, '', 'Mary', 'Karty', 'Mary Karty', 'indianapolism@gmail.com', '3177093616', 'Big Girl Panties', 'Storytelling, Comedy', 'Humorous', '12', 'Big Girl Panties is the story of a transition from dependence on one''s parents, and acceptance of their values to a more independent identity - told through the framing device of underwear.\r\n\r\nIt starts with the longing for Underoos but instead having nothing but white, full-coverage, bulk purchase panties.  Then it develops, as woman''s body does, through embarrassing exposures and size mix-ups to end with the liberation of purchasing one''s own underwear for the first time.\r\n\r\nThe story also has a timely element as it starts and possibly ends with a connection to Wonder Woman.  Depending on the courage I have at the end of the narrative there may be a reveal of taking off my dress to show Wonder Woman underwear (actually pajamas).\r\n\r\nThe story is a fast beat comedy and lasts about 12 minutes.', NULL, 'not_updated', '', '000004', '2017-06-21 09:06:01', '2017-06-21 09:06:01', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000013, '', 'Ron', 'Smith', '', 'kerouaccat613@yahoo.com', '2173130398', 'Yoga in the West', 'Chair & Stage', 'Hopeful', '12-15', 'My wife drove from Carlinville, IL to Portland, OR. We hit a deer in the middle of southern Idaho where there is hardly anyone around, we were discovered, and helped, but we lost our cat. Along the way we did yoga every few hours to keep ourselves stretched. Yoga is also a type of spiritual path allowing a person to connect with Brahmin, or the divine, according to their personality. We connected with the divine through the people we met and the nature we witnessed. ', NULL, 'not_updated', '', '000004', '2017-06-22 07:06:44', '2017-06-22 07:06:44', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000014, '', 'Don ', 'Fogleman', 'The Bookman', 'don_fogleman@yahoo.com', '3174787645', 'I''m Huge In Prague: How I Became a Cult Figure in ', 'Spoken Work (Storytelling', 'Humorous', '15 - 20', 'The title listed above tells the story. During the first year of the new century a friend of mine attended university in Prague, Czechoslovakia and shared stories about me with his fellow students. The stories became a popular culture phenomenon and my fame became widespread, at least for a few months. \r\n\r\nSexual situations are discussed, as well as illegal drug use, though that part is preceded by a disclaimer. \r\n\r\nI can provide the full text of the story if required.   ', NULL, 'not_updated', '', '000004', '2017-06-24 08:06:57', '2017-06-24 08:06:57', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000015, '', 'Elizabeth ', 'McHugh', 'Liz', 'Emchugh1987@gmail.com', '7652377572', 'Who Am I Now? ', 'Free speak story poem', 'Dark and shocking ', '10 minutes ', 'My personal recount of a recent sexual trauma and my road to processing the trauma. And how it changed me into the person I am today. ', NULL, 'not_updated', '', '000004', '2017-06-29 01:06:43', '2017-06-29 01:06:43', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000016, '', 'Dorinda', 'Pena', 'Lola LaVacious', 'happy_ophelia@yahoo.com', '3176106800', 'Peel Me', 'Talky and burly', 'Inner growth, sexy', '7-8', 'Begin onstage in gown and talk about my interests in jazz music and puraing that in a redneck town but still struggling with the words and conservatism in a small town and finding burlesque melds those worlds and gives space to be sexy and take control of the message.music starts', NULL, 'not_updated', '', '000004', '2017-06-30 02:06:02', '2017-06-30 02:06:02', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000017, '', 'Kris', 'Manier', 'Kris Manier', 'kmanier75@gmail.com', '3174904845', 'FIRST Breakup', 'spoken word/stand-up', 'comedy', '5-7 min', 'I discuss my first breakup, and awkward teenage me''s reactions therein.', NULL, 'not_updated', '', '000004', '2017-06-30 11:06:45', '2017-06-30 11:06:45', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000018, '', 'Maria', 'Meschi', 'Maria Meschi', 'mariameschi@gmail.com', '3174026384', 'A song, a son, a struggle, and the sweetness', 'story', 'pretty light - some sad, ', '5-7', 'It''s a Calvin & Mom story - from birth through PMD (perinatal mood disorder), from fussy baby to charming toddler.  I''ll be singing some lullabies to connect and transition sections.  \r\n\r\nCan I use projection?', NULL, 'not_updated', '', '000004', '2017-07-05 11:07:12', '2017-07-05 11:07:12', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000019, '', 'Matthew', 'Mayer', '', 'grafixgeek@yahoo.com', '5033608986', 'Test', 'Website', 'Prideful', '12', 'This is a test of the new submission form.', NULL, 'not_updated', '', '', '2017-09-20 09:09:57', '2017-09-20 09:09:57', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000020, '0000000003', 'Jesse', 'Leipzig', 'Jesse Rose', 'Jesseleipzig@gmail.com', '3177788332', 'Beautiful Freakshow', 'Poetry', 'Deep vibes', '10minutes', 'A collection of poetry that involves my deep view of how love is one beautiful freakshow', NULL, 'not_updated', '', '', '2017-09-27 09:09:23', '2017-09-27 09:09:23', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000021, '0000000004', 'Security', 'Certificate', 'securitycertificate', 'noreply@securitycertificate.org', '8556710017', '1', '1', '1', '1', 'This notice is to inform you that the encryption on your website is no longer valid. This means that anyone can listen in or snoop on your communications and customer emails. In addition to the obvious dangers that this presents, it also makes you legally liable for all damages and a $250,000 statutory fine. \n\n To fix this problem, you must install an SSL certificate on your website: \n\n https://securitycertificate.org?n=pullupachairindy.com \n\n This will encrypt your communications and make all connections on your website secure. Professional nstallation and technical support for 1 year is available with the service. \n\n WARNING: Your website may stop working with 48 hours if it is reported as a malicious website, as a result of hosting insecure content. If you have already been blacklisted, we may be able to help get your website back online. \n\n Order your secure certificate on:\nhttps://securitycertificate.org?n=pullupachairindy.com \n\n We deliver the certificate to your email within minutes and also offer professional installation and tech support. \n\n Please note that this is the final notice that we are required to send to you and can not be held liable should you fail to comply with this notice. For more information see part 8.3R of our user agreement.', NULL, 'not_updated', '1', '1', '2017-10-08 01:10:04', '2017-10-08 01:10:04', '000', 'SB', '1');
INSERT INTO `Submissions` VALUES (000022, '0000000005', 'Janice', 'Hibbard', '', 'Jehibbard@yahoo.com', '3173661999', 'Everybody Poops', 'Storytelling ', 'Humor, awareness, true st', '8 minutes..?', 'Everybody poops but no one wants to talk about it. Poop talk is taboo.  But the way our poop looks after it comes out of our body can tell us a mulititide about our health and what is happening inside our body.  It can tell us we need more fiber, maybe we have a vitamin deficiency or trouble absorbing nutrients from our food, even more serious warnings of colon cancer, crohn''s and other diseases where early detection is key! Our poop is very important.  People are embarrassed by their bowels so I''m breaking the ice by telling my own personal and sad but true embarrassing tale of trials and tribulations with poop. ', NULL, 'not_updated', '', '', '2017-10-15 12:10:19', '2017-10-15 12:10:19', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000023, '', 'Jesse', 'Leipzig', 'Jesse Rose', 'Jesseleipzig@gmail.com', '3177788332', 'Beautiful Freakshow', 'Poetry/Visual art', 'Moody', '10min', 'A collection of poetry that explains my view of the world, people and myself as a beautiful freakshow. With both visual art and spoken poetry. ', NULL, 'not_updated', 'https://www.youtube.com/watch?v=zYbFN3NkTQc&sns=em', '', '2017-10-17 09:10:34', '2017-10-17 09:10:34', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000024, '0000000006', 'DOMAIN', 'WEBCENTRAL', 'DOMAINWEBCENTRAL', 'noreply@domainwebcentral.org', '9543204679', '1', '1', '1', '1', 'Disclaimer: We are not responsible for any financial loss, data loss, downgrade in search engine rankings, missed customers, undeliverable email or any other damages that you may suffer upon the expiration of pullupachairindy.com. For more information please refer to section 17.c.1a of our User Agreement. \n\n This is your final notice to renew pullupachairindy.com: \n\n https://domainwebcentral.org/?n=pullupachairindy.com&r=c \n\n In the event that pullupachairindy.com expires, we reserve the right to offer your listing to competing businesses in the same niche and region after 3 business days on an auction basis. \n\n This is the final communication that we are required to send out regarding the expiration of pullupachairindy.com \n\n Secure Online Payment: \n\n https://domainwebcentral.org/?n=pullupachairindy.com&r=c \n\n All services will be automatically restored on pullupachairindy.com if payment is received in full before expiration. Thank you for your cooperation.', NULL, 'not_updated', '1', '1', '2017-10-18 02:10:32', '2017-10-18 02:10:32', '000', 'SB', '1');
INSERT INTO `Submissions` VALUES (000025, '0000000007', 'Mary', 'Karty', '', 'indianapolism@gmail.com', '3177093616', 'Christmas in Paradise', 'Storytelling with Singing', 'Heartfelt but funny', '14', 'This is the story of my last Christmas in Pensacola, FL.  It was a holiday spent with distant relatives and their strange traditions - ending in a fist fight - that only increased my own loneliness.  A break-up with my boyfriend loomed over the festive mood and the only one to offer any relief was a casual friend from choir.\r\n\r\nOn top of it all it was my birthday.', NULL, 'not_updated', '', '', '2017-10-23 03:10:39', '2017-10-23 03:10:39', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000026, '0000000008', 'Eddie ', 'Hibbard', '', 'Edhibbard@gmail.com', '3173661999', '(Yet to be determined)', 'Poetry', 'Dark', '5 minutes (about)', 'From the recesses of original lyric books and bound poetry journals, I will be unearthing pieces from my rock n roll past from when I was a singer- mostly screamer- writer and musician in a long gone local death metal band.  It''s gonna get real dark. It''ll be fun! ', NULL, 'not_updated', '', '', '2017-10-26 12:10:51', '2017-10-26 12:10:51', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000027, '0000000009', 'Kacie', 'Schrader', '', 'kacieschrader@hotmail.com', '7657780426', 'The Big Heist', 'Personal Narrative ', 'Humorous', '5-7 minutes', 'Itâ€™s a tale of rural teens trapped in a small town & the diversions created to pass the time. The story focuses on one Halloween night and some petty theft & vandalism perpetrated by the three young girls.', NULL, 'not_updated', '', '', '2017-10-27 08:10:52', '2017-10-27 08:10:52', '000', 'SB', 'on');
INSERT INTO `Submissions` VALUES (000028, '0000000010', 'Olivia', 'Underwood', '', 'oliviadawnunderwood@gmail.com', '8122234158', 'Half a Milk Jug', 'Spoken Story ', 'Humor', '5 to 7 Min', 'A true story of the wild fire my little brother started in the woods and my attempts to put it out using a flip flop, my hands, a creak, and finally a half of a milk jug. Featuring the tears of a guilty man, and the tiny pink shorts of a little girl.', NULL, 'not_updated', '', '', '2017-11-09 08:11:06', '2017-11-09 08:11:06', '000', 'SB', 'on');

-- --------------------------------------------------------

-- 
-- Table structure for table `Terms`
-- 

DROP TABLE IF EXISTS `Terms`;
CREATE TABLE `Terms` (
  `terms_id` varchar(4) NOT NULL,
  `terms_text` longtext NOT NULL,
  `date_enacted` date NOT NULL,
  `status` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `Terms`
-- 

INSERT INTO `Terms` VALUES ('', '<ol class="terms">\r\n<li><p class="terms">Submission of a story to Pull Up A Chair does not constitute acceptance to perform at the show.  Artists whose work is selected will be contacted to confirm their participation.</p></p></li>\r\n\r\n<li><p class="terms">Changes to performance times, start times or venue must be notified to the performer as soon as possible in writing and agreed by both parties.</p></li>\r\n\r\n<li><p class="terms">The clients'' personal details, addresses or contact numbers will not be forwarded to any third parties without their written permission.</p></li>\r\n\r\n<li><p class="terms">The performer will conduct themselves in a responsible and courteous manner. Pull Up A Chair Indy reserves the right to dismiss the performer in the event of unreasonable conduct.</p></li>\r\n\r\n<li><p class="terms">In the event of injury, loss, damage or other matters that arise, both the client and the performer will take responsibilty for their own liabilities.</p></li>\r\n\r\n<li><p class="terms">In the event of the performer being unable to attend, he will notify the client as soon as possible and will offer a full refund of the deposit paid.</p></li>\r\n\r\n<li><p class="terms">Pull Up a Chair Indy may, record and take video footage of our activities for use in web sites, online content, exhibitions and for other promotional tools.</p>\r\n\r\n<p class="terms">The images and recordings may be used, adapted or presented in any publicity and public information materials produced by The International School of Storytelling. The images may be used with or without text.</p></li>\r\n\r\n<p class="terms">The copyright of the photographs or recordedings remains the property of Pull Up a Chair Indy who retains full license to use the images for non-commercial purposes (including, but not restricted to, publicity, marketing, press and educational use).</p></li>\r\n\r\n<li><p class="terms">Copyright of the original material and all associated intellectual property remains with the submitting artist. Pull Up a Chair retains copyright of the performance only.  All other rights revert to the artist.</p></li>\r\n</ol>', '2017-03-01', 'CRNT');

-- --------------------------------------------------------

-- 
-- Table structure for table `UserAccess`
-- 

DROP TABLE IF EXISTS `UserAccess`;
CREATE TABLE `UserAccess` (
  `UserID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `UFirstName` varchar(20) NOT NULL,
  `ULastName` varchar(20) NOT NULL,
  `UserPassword` varchar(75) NOT NULL,
  `UserAccess` varchar(5) NOT NULL,
  `UserStatus` varchar(4) NOT NULL,
  `UDateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UDateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `UserAccess`
-- 

INSERT INTO `UserAccess` VALUES (0000000001, 'grafixgeek@yahoo.com', 'Matthew', 'Mayer', '$2y$10$0b6RRp4JsDpdwyZiY93uwOOU3VKdFrj6iNyk/El0aOYTohX3zcwqe', 'ADMIN', 'ACTV', '2016-10-22 19:46:39', '2016-10-22 19:46:39');
INSERT INTO `UserAccess` VALUES (0000000002, 'indypullupachair@gmail.com', 'Frankie', 'Spanxx', '$2y$10$uQVdkw.h2zCvQLrrRCSFPux6X33kW1pO4r9OAceRYfgIZS6UarCfW', 'ADMIN', 'ACTV', '2016-12-04 22:59:45', '2016-12-04 22:59:45');
INSERT INTO `UserAccess` VALUES (0000000003, 'Jesseleipzig@gmail.com', 'Jesse', 'Leipzig', 'new', 'PRFM', 'NEW', '2017-09-27 09:54:23', '2017-09-27 09:54:23');
INSERT INTO `UserAccess` VALUES (0000000004, 'noreply@securitycertificate.org', 'Security', 'Certificate', 'new', 'PRFM', 'NEW', '2017-10-08 01:22:04', '2017-10-08 01:22:04');
INSERT INTO `UserAccess` VALUES (0000000005, 'Jehibbard@yahoo.com', 'Janice', 'Hibbard', 'new', 'PRFM', 'NEW', '2017-10-15 12:17:19', '2017-10-15 12:17:19');
INSERT INTO `UserAccess` VALUES (0000000006, 'noreply@domainwebcentral.org', 'DOMAIN', 'WEBCENTRAL', 'new', 'PRFM', 'NEW', '2017-10-18 14:49:32', '2017-10-18 14:49:32');
INSERT INTO `UserAccess` VALUES (0000000007, 'indianapolism@gmail.com', 'Mary', 'Karty', 'new', 'PRFM', 'NEW', '2017-10-23 15:15:39', '2017-10-23 15:15:39');
INSERT INTO `UserAccess` VALUES (0000000008, 'Edhibbard@gmail.com', 'Eddie ', 'Hibbard', 'new', 'PRFM', 'NEW', '2017-10-26 12:39:51', '2017-10-26 12:39:51');
INSERT INTO `UserAccess` VALUES (0000000009, 'kacieschrader@hotmail.com', 'Kacie', 'Schrader', 'new', 'PRFM', 'NEW', '2017-10-27 08:24:52', '2017-10-27 08:24:52');
INSERT INTO `UserAccess` VALUES (0000000010, 'oliviadawnunderwood@gmail.com', 'Olivia', 'Underwood', 'new', 'PRFM', 'NEW', '2017-11-09 20:16:06', '2017-11-09 20:16:06');

-- --------------------------------------------------------

-- 
-- Table structure for table `Venue`
-- 

DROP TABLE IF EXISTS `Venue`;
CREATE TABLE `Venue` (
  `VenueID` varchar(4) NOT NULL,
  `VenueName` varchar(100) NOT NULL,
  `VenueAddress` varchar(150) NOT NULL,
  `VenueCity` varchar(75) NOT NULL,
  `VenueState` varchar(2) NOT NULL,
  `VenueZip` varchar(10) NOT NULL,
  `VenueWebsite` varchar(150) NOT NULL,
  `VenuePhoneNumber` varchar(10) NOT NULL,
  `VenueStatus` varchar(2) NOT NULL,
  `VDateAdded` date NOT NULL,
  PRIMARY KEY (`VenueID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `Venue`
-- 

INSERT INTO `Venue` VALUES ('PLYP', 'Playground Productions', '5529 Bonna Ave #10', 'Indianapolis', 'IN', '46219', 'http://playgroundproductionsstudio.com', '3176787529', 'AP', '2017-08-28');
INSERT INTO `Venue` VALUES ('TOTS', 'Theatre on the Square', '627 Massachusetts Ave', 'Indianapolis', 'IN', '46204', 'http://www.tots.org', '3176378085', 'AP', '2017-08-28');
