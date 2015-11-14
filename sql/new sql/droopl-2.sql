-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 14, 2015 at 03:32 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `droopl`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_propos`
--

CREATE TABLE `accepted_propos` (
  `id` int(11) NOT NULL,
  `propo_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accepted_propos`
--

INSERT INTO `accepted_propos` (`id`, `propo_id`, `quest_id`, `creation_date`) VALUES
(1, 1, 554, '2015-10-31 13:45:56'),
(2, 2, 553, '2015-11-05 19:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `collection_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `collection_image` varchar(255) NOT NULL,
  `collection_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`collection_id`, `item_name`, `user_id`, `description`, `collection_image`, `collection_creation_date`, `status`, `available`) VALUES
(2, 'Stofzuiger', 1, 'Dit is een stofzuiger', 'cleaner.jpg', '2015-09-25 13:04:53', 1, 1),
(4, 'Dolce gusto', 1, 'I like coffee.', 'dolce-gusto.png', '2015-09-25 16:21:02', 0, 0),
(5, 'Reflex camera', 2, 'Dit is een gibson gitaar dat ik heb aangemaakt', 'canon-reflex.png', '2015-09-27 13:52:57', 0, 0),
(6, 'Cleaner', 2, 'To clean stuff with.', 'cleaner.jpg', '2015-09-27 13:52:57', 1, 0),
(7, 'Disqueuse', 2, 'Disqueuse', 'disqueuse.png', '2015-09-27 13:52:57', 0, 0),
(8, 'Dolce gusto', 2, 'I like coffee.', 'dolce-gusto.png', '2015-09-27 13:52:57', 0, 0),
(12, 'lamp', 2, '64 watt', 'ed2FgZgCSV.jpeg', '2015-09-27 16:32:43', 0, 0),
(13, 'schep', 2, '', 'kDt0l4tY0i.jpeg', '2015-09-27 16:41:28', 0, 0),
(14, 'fixie', 2, 'this item has no description yet', 'dOYwxskA51.png', '2015-09-27 16:42:17', 0, 1),
(16, 'random', 1, 'qsdqsdqsd', 'vi1YPKjK25.jpeg', '2015-10-05 08:04:59', 0, 1),
(17, 'boske', 9, 'qsdqsddqsd', '0fBjuyw7oz.jpg', '2015-10-13 08:19:55', 0, 0),
(18, 'Iets random', 34, 'blbabla', '1ZBc6g2uFU.jpg', '2015-10-22 08:43:17', 0, 0),
(19, 'Kak', 36, 'Dit is een random bos', '3f6kOLWEoy.jpg', '2015-10-22 13:24:23', 0, 0),
(20, 'bos', 37, 'qsdqsd', 'eDjUfc6pwT.jpg', '2015-10-31 13:42:16', 0, 0),
(21, 'Bos', 38, 'Dit is een bos', 'Z5pGs6qfsg.jpg', '2015-11-01 16:59:49', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `communities`
--

CREATE TABLE `communities` (
  `id` int(11) NOT NULL,
  `community_name` varchar(255) NOT NULL,
  `community_profile` varchar(255) NOT NULL,
  `genre` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `privacy` tinyint(1) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `communities`
--

INSERT INTO `communities` (`id`, `community_name`, `community_profile`, `genre`, `creator_id`, `description`, `privacy`, `creation_date`) VALUES
(1, 'Ehb', 'ehb.jpg', 0, 1, 'This is a community just for ehb students where we can trade items and help eachother out', 0, '2015-10-09 21:47:43'),
(2, 'Dribbble', '0IUxN9v4mB.jpg', 0, 2, 'This is a community for designers', 1, '2015-10-17 08:24:15'),
(3, 'Het bos', 'Z6dhmKnQ4q.jpg', 0, 37, 'random', 1, '2015-10-31 13:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `community_quests`
--

CREATE TABLE `community_quests` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `community_users`
--

CREATE TABLE `community_users` (
  `id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `community_users`
--

INSERT INTO `community_users` (`id`, `community_id`, `user_id`, `creation_date`) VALUES
(2, 1, 8, '2015-10-09 12:05:38'),
(12, 1, 1, '2015-10-10 13:49:10'),
(13, 1, 2, '2015-10-12 11:01:16'),
(14, 2, 2, '2015-10-17 08:24:32'),
(15, 2, 1, '2015-10-17 08:50:04'),
(16, 1, 11, '2015-10-20 17:29:47'),
(17, 1, 34, '2015-10-22 08:48:54'),
(18, 2, 34, '2015-10-22 08:49:10'),
(19, 1, 36, '2015-10-22 13:32:07'),
(20, 3, 37, '2015-10-31 13:48:48'),
(21, 1, 37, '2015-10-31 13:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `completed_quests`
--

CREATE TABLE `completed_quests` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `completed_quests`
--

INSERT INTO `completed_quests` (`id`, `quest_id`, `creation_date`) VALUES
(1, 552, '2015-10-24 07:36:34'),
(2, 554, '2015-10-31 13:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `conversation_id` int(11) NOT NULL,
  `conversation_name` varchar(255) NOT NULL,
  `conversation_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `conversation_typing` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`conversation_id`, `conversation_name`, `conversation_creation_date`, `conversation_typing`) VALUES
(1, 'Groep 1', '2015-09-29 15:45:35', 0),
(2, 'groep 2', '2015-09-29 11:13:28', 0),
(3, 'Kaka', '2015-10-08 14:02:26', 0),
(4, 'niks', '2015-10-09 17:04:00', 0),
(5, 'new convo', '2015-10-13 08:22:34', 0),
(49, 'New conversation', '2015-10-14 08:42:12', 0),
(50, 'New conversation', '2015-10-14 08:47:34', 0),
(51, 'New conversation', '2015-10-14 08:51:22', 0),
(52, 'New conversation', '2015-10-14 11:51:32', 0),
(53, 'New conversation', '2015-10-20 17:30:43', 0),
(54, 'New conversation', '2015-10-21 11:53:54', 0),
(55, 'New conversation', '2015-10-21 15:18:06', 0),
(56, 'New conversation', '2015-10-22 08:47:42', 0),
(57, 'New conversation', '2015-10-22 09:48:46', 0),
(58, 'New conversation', '2015-10-22 09:50:11', 0),
(59, 'New conversation', '2015-10-22 13:28:19', 0),
(60, 'New conversation', '2015-10-31 13:45:10', 0),
(61, 'New conversation', '2015-11-01 17:01:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `conversation_users`
--

CREATE TABLE `conversation_users` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_typing` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation_users`
--

INSERT INTO `conversation_users` (`id`, `conversation_id`, `user_id`, `creation_date`, `user_typing`) VALUES
(1, 1, 1, '2015-10-24 09:31:16', 0),
(2, 1, 2, '2015-10-24 09:20:29', 0),
(3, 2, 1, '2015-10-25 09:40:58', 0),
(4, 2, 3, '2015-09-29 11:13:41', 0),
(5, 1, 3, '2015-10-10 09:44:14', 0),
(6, 3, 1, '2015-10-08 20:12:31', 0),
(7, 3, 8, '2015-10-08 14:06:07', 0),
(8, 4, 1, '2015-10-09 17:04:22', 0),
(9, 4, 9, '2015-10-09 17:05:09', 0),
(55, 49, 2, '2015-10-14 08:42:17', 0),
(56, 49, 4, '2015-10-14 08:42:12', 0),
(57, 50, 2, '2015-10-21 11:39:01', 0),
(58, 50, 7, '2015-10-14 08:47:34', 0),
(59, 51, 2, '2015-10-21 11:39:14', 0),
(60, 51, 6, '2015-10-14 08:51:22', 0),
(61, 52, 1, '2015-10-25 09:40:48', 1),
(62, 52, 6, '2015-10-14 11:51:32', 0),
(63, 53, 11, '2015-10-20 17:31:08', 0),
(64, 53, 6, '2015-10-20 17:30:43', 0),
(65, 54, 12, '2015-10-21 11:53:54', 0),
(66, 54, 6, '2015-10-21 11:53:54', 0),
(67, 55, 19, '2015-10-21 15:19:08', 0),
(68, 55, 6, '2015-10-21 15:18:06', 0),
(69, 56, 34, '2015-10-22 08:47:42', 0),
(70, 56, 1, '2015-10-22 08:47:42', 0),
(71, 57, 35, '2015-10-22 09:48:50', 0),
(72, 57, 6, '2015-10-22 09:48:46', 0),
(73, 58, 35, '2015-10-22 09:50:46', 0),
(74, 58, 1, '2015-10-22 09:50:11', 0),
(75, 59, 36, '2015-10-22 13:30:11', 0),
(76, 59, 1, '2015-10-24 09:04:08', 1),
(77, 60, 1, '2015-10-31 13:45:29', 0),
(78, 60, 37, '2015-10-31 13:45:10', 0),
(79, 61, 1, '2015-11-01 17:02:43', 0),
(80, 61, 38, '2015-11-01 17:01:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `type`, `user_id`, `feedback`, `creation_date`) VALUES
(1, 0, 1, 'qssqdsdsqd', '2015-10-19 10:44:10'),
(2, 0, 1, 'Dit is lelijk ', '2015-10-19 10:44:31'),
(3, 1, 1, 'It just sucks!', '2015-10-19 11:51:10'),
(4, 1, 1, 'This is random feedback !', '2015-10-19 11:51:52'),
(5, 0, 1, 'This is feedback 2', '2015-10-19 11:54:08'),
(6, 0, 1, 'This is feedback 2', '2015-10-19 11:54:24'),
(7, 0, 1, 'This is feedback 2', '2015-10-19 11:54:33'),
(8, 0, 1, 'This is feedback 2', '2015-10-19 11:54:53'),
(9, 0, 1, 'This is feedback 2', '2015-10-19 11:54:59'),
(10, 1, 1, 'qsdsqdqsdqsd\r\n', '2015-10-19 17:57:15'),
(11, 0, 36, 'qsdqsdqsdqsd', '2015-10-22 13:34:28'),
(12, 0, 37, 'hhey dit is feedback', '2015-10-31 13:55:39');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `follow_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=138 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follow_id`, `user_id`, `friend_id`, `follow_creation_date`) VALUES
(49, 3, 3, '2015-09-06 21:05:45'),
(50, 3, 1, '2015-09-06 21:06:26'),
(51, 4, 3, '2015-09-07 10:59:45'),
(52, 4, 1, '2015-09-07 11:00:01'),
(53, 4, 4, '2015-09-07 11:02:29'),
(54, 4, 2, '2015-09-07 11:03:20'),
(59, 5, 1, '2015-09-07 12:15:34'),
(60, 5, 3, '2015-09-07 12:16:11'),
(65, 1, 1, '2015-09-21 12:23:36'),
(83, 2, 1, '2015-10-02 11:52:09'),
(84, 1, 3, '2015-10-06 14:18:22'),
(85, 2, 3, '2015-10-07 09:36:41'),
(86, 8, 1, '2015-10-08 13:56:58'),
(87, 8, 8, '2015-10-08 13:59:45'),
(89, 9, 1, '2015-10-09 17:01:33'),
(92, 2, 2, '2015-10-10 08:08:49'),
(93, 1, 2, '2015-10-12 17:44:26'),
(95, 9, 2, '2015-10-13 08:20:10'),
(96, 1, 6, '2015-10-14 12:24:37'),
(97, 2, 6, '2015-10-15 12:24:32'),
(98, 11, 1, '2015-10-20 17:29:26'),
(99, 1, 11, '2015-10-21 08:20:34'),
(100, 12, 1, '2015-10-21 11:53:32'),
(103, 19, 1, '2015-10-21 15:13:33'),
(104, 20, 20, '2015-10-21 15:26:38'),
(106, 21, 21, '2015-10-21 18:36:32'),
(107, 22, 22, '2015-10-21 18:39:27'),
(108, 23, 23, '2015-10-21 18:41:51'),
(109, 24, 24, '2015-10-21 18:44:10'),
(110, 25, 25, '2015-10-21 18:45:40'),
(111, 26, 26, '2015-10-21 18:47:14'),
(112, 27, 27, '2015-10-21 18:49:17'),
(113, 28, 28, '2015-10-21 18:53:27'),
(114, 29, 29, '2015-10-21 19:05:48'),
(115, 30, 30, '2015-10-21 19:07:55'),
(116, 31, 31, '2015-10-21 19:09:45'),
(117, 32, 32, '2015-10-21 19:12:25'),
(118, 33, 33, '2015-10-21 19:16:27'),
(119, 34, 34, '2015-10-22 08:41:08'),
(120, 34, 1, '2015-10-22 08:42:50'),
(121, 34, 2, '2015-10-22 08:49:30'),
(122, 35, 35, '2015-10-22 08:52:09'),
(123, 35, 12, '2015-10-22 09:16:05'),
(124, 35, 1, '2015-10-22 09:16:14'),
(125, 36, 36, '2015-10-22 13:22:17'),
(126, 36, 1, '2015-10-22 13:23:47'),
(128, 37, 37, '2015-10-31 13:40:52'),
(129, 37, 1, '2015-10-31 13:41:58'),
(130, 37, 2, '2015-10-31 13:42:48'),
(131, 38, 38, '2015-11-01 16:55:12'),
(132, 38, 1, '2015-11-01 16:59:17'),
(135, 1, 38, '2015-11-06 11:24:35'),
(136, 1, 37, '2015-11-07 10:18:18'),
(137, 2, 34, '2015-11-07 10:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `quest_id`, `image_url`, `creation_date`) VALUES
(86, 198, '6rSR3oP2gu.jpg', '2015-10-06 13:11:50'),
(87, 199, 'KyvsQO4vSm.jpg', '2015-10-06 13:20:50'),
(88, 200, 'O3PI86UvEa.jpg', '2015-10-06 13:26:33'),
(89, 262, 'JGVbKQtGJn.jpg', '2015-10-10 12:16:51'),
(90, 462, 'XHQbfumkpv.jpg', '2015-10-19 17:47:19'),
(91, 551, 'yEKRMX3YaU.jpg', '2015-10-23 08:29:29'),
(92, 553, 'Qfx29aht1W.jpg', '2015-10-24 07:56:51'),
(93, 564, 'EnntKygKjI.jpg', '2015-11-05 19:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `accepted` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invites`
--

INSERT INTO `invites` (`id`, `user_id`, `community_id`, `accepted`) VALUES
(16, 38, 1, '0'),
(17, 2, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seen` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `user_id`, `message`, `message_creation_date`, `seen`) VALUES
(196, 1, 1, 'heey!', '2015-10-19 15:34:20', 0),
(197, 1, 1, 'heey!', '2015-10-19 15:34:23', 0),
(198, 2, 1, 'werk!', '2015-10-19 15:49:10', 0),
(199, 2, 1, 'stom ding', '2015-10-19 15:49:10', 0),
(200, 4, 1, 'Ahlan !', '2015-10-19 15:49:15', 0),
(201, 2, 1, 'wow !', '2015-10-19 15:49:10', 0),
(202, 2, 1, 'heeyy!! whats up', '2015-10-19 15:49:10', 0),
(203, 1, 1, 'What up bobo', '2015-10-19 15:49:01', 0),
(204, 3, 1, 'de jef !', '2015-10-19 15:48:37', 0),
(205, 1, 2, 'heey', '2015-10-19 17:29:09', 0),
(206, 4, 1, 'winek', '2015-10-19 17:18:01', 0),
(207, 4, 1, 'blabal', '2015-10-19 17:19:20', 0),
(208, 1, 1, 'he', '2015-10-19 17:39:53', 0),
(209, 4, 1, 'sdsd', '2015-10-19 17:33:58', 0),
(210, 1, 2, 'heey!', '2015-10-19 17:34:59', 0),
(211, 1, 1, 'qsdqsd', '2015-10-19 17:39:59', 0),
(212, 1, 1, 'qsdqsd', '2015-10-19 17:40:37', 0),
(213, 1, 1, 'hey', '2015-10-19 17:40:55', 0),
(214, 1, 1, 'haha', '2015-10-19 17:41:09', 0),
(215, 1, 1, 'werkt het ofwa ?', '2015-10-19 17:41:18', 0),
(216, 1, 1, 'Notif', '2015-10-19 17:43:05', 0),
(217, 1, 1, 'hu ?', '2015-10-19 17:43:16', 0),
(218, 1, 1, 'werk please', '2015-10-19 17:44:41', 0),
(219, 1, 1, 'Antwoord is', '2015-10-19 17:45:01', 0),
(220, 1, 1, 'blabal', '2015-10-19 17:45:18', 0),
(221, 1, 1, 'Oo boris ik wil da echt', '2015-10-19 17:52:40', 0),
(222, 1, 2, 'oke ik geef het u', '2015-10-19 17:48:18', 0),
(223, 1, 1, 'Yoo!!', '2015-10-20 06:06:53', 0),
(224, 4, 1, 'hey!', '2015-10-20 06:07:01', 0),
(225, 4, 9, 'Ahlan !', '2015-10-20 06:08:06', 0),
(226, 1, 2, 'yooo!!', '2015-10-20 06:08:55', 0),
(227, 4, 1, 'what up !', '2015-10-20 06:09:45', 0),
(228, 4, 1, 'fuck this !', '2015-10-20 06:09:50', 0),
(229, 1, 1, 'heey!', '2015-10-20 06:10:09', 0),
(230, 1, 2, 'hahah!', '2015-10-20 06:10:25', 0),
(231, 1, 1, 'Yo bobo', '2015-10-20 06:10:32', 0),
(232, 1, 2, 'heey bobo', '2015-10-20 06:44:10', 0),
(233, 1, 2, 'hey rach', '2015-10-20 06:44:30', 0),
(234, 1, 2, 'hu ?', '2015-10-20 06:44:38', 0),
(235, 1, 2, 'ok', '2015-10-20 06:45:24', 0),
(236, 1, 2, 'ola', '2015-10-20 06:45:32', 0),
(237, 1, 2, 'negeer ni', '2015-10-20 06:45:45', 0),
(238, 1, 2, 'kaka', '2015-10-20 06:46:31', 0),
(239, 1, 2, 'pipi', '2015-10-20 06:46:46', 0),
(240, 1, 2, 'kaka', '2015-10-20 06:46:48', 0),
(241, 1, 2, 'sale shmet', '2015-10-20 06:47:08', 0),
(242, 1, 2, 'shmet !! :p', '2015-10-20 06:47:24', 0),
(243, 1, 2, 'het werkt niet ', '2015-10-20 06:47:37', 0),
(244, 1, 2, 'alee!!', '2015-10-20 06:47:53', 0),
(245, 1, 2, 'alee!!', '2015-10-20 06:48:01', 0),
(246, 1, 2, 'werk', '2015-10-20 06:48:08', 0),
(247, 1, 2, 'please', '2015-10-20 06:48:10', 0),
(248, 1, 1, 'haha', '2015-10-20 06:48:21', 0),
(249, 1, 1, 'heey!', '2015-10-20 06:49:28', 0),
(250, 1, 1, 'oke', '2015-10-20 06:53:50', 0),
(251, 1, 1, 'heey', '2015-10-20 07:02:53', 0),
(252, 1, 1, 'sdsd', '2015-10-20 07:03:07', 0),
(253, 1, 1, 'werk eh', '2015-10-20 07:03:15', 0),
(254, 1, 1, 'werk !!', '2015-10-20 07:03:23', 0),
(255, 1, 1, 'sdsd', '2015-10-20 07:03:32', 0),
(256, 1, 1, 'hey', '2015-10-20 09:44:48', 0),
(257, 1, 2, 'nice', '2015-10-21 08:21:41', 0),
(258, 1, 1, 'qsdqsd', '2015-10-20 09:44:48', 0),
(259, 1, 2, 'ok', '2015-10-20 11:56:54', 0),
(260, 1, 2, 'hha', '2015-10-20 11:56:54', 0),
(261, 3, 1, 'yoo', '2015-10-20 08:08:31', 1),
(262, 1, 1, 'Olala!!', '2015-10-20 09:44:48', 0),
(263, 1, 1, 'bobo', '2015-10-20 09:44:48', 0),
(264, 1, 1, 'is kaka ', '2015-10-20 09:44:48', 0),
(265, 1, 1, 'hihih', '2015-10-20 09:44:48', 0),
(266, 1, 1, 'What the fuck !', '2015-10-20 11:51:39', 0),
(267, 3, 1, 'jef !', '2015-10-20 09:48:34', 1),
(268, 3, 1, 'heehe', '2015-10-20 09:48:38', 1),
(269, 3, 1, 'heeheheehe', '2015-10-20 09:48:39', 1),
(270, 3, 1, 'heehe', '2015-10-20 09:48:40', 1),
(271, 3, 1, 'heehe', '2015-10-20 09:48:41', 1),
(272, 3, 1, 'heehe', '2015-10-20 09:48:43', 1),
(273, 4, 1, 'werk please', '2015-10-20 09:50:46', 1),
(274, 4, 1, 'http://rachouanrejeb.be', '2015-10-20 09:51:25', 1),
(275, 52, 1, 'oke !!', '2015-10-21 15:20:56', 0),
(276, 52, 1, 'Die mourad', '2015-10-21 15:20:56', 0),
(277, 1, 2, 'hee!', '2015-10-20 11:39:57', 0),
(278, 1, 2, 'blablabla', '2015-10-20 11:39:54', 0),
(279, 1, 2, 'heey!', '2015-10-20 11:39:52', 0),
(280, 1, 2, 'yoo', '2015-10-20 11:39:47', 0),
(281, 1, 1, 'yoo!', '2015-10-20 11:51:39', 0),
(282, 1, 2, 'wa gebeurd er ?', '2015-10-21 08:21:38', 0),
(283, 1, 1, 'you', '2015-10-20 11:51:39', 0),
(284, 1, 1, 'hey', '2015-10-20 11:52:16', 0),
(285, 1, 2, 'yoo!', '2015-10-20 11:52:24', 0),
(286, 1, 1, 'nice!', '2015-10-20 11:52:32', 0),
(287, 1, 2, 'oke', '2015-10-20 11:56:41', 0),
(288, 53, 11, 'yoo !!', '2015-10-20 17:31:02', 1),
(289, 53, 11, 'Whats up !', '2015-10-20 17:31:08', 1),
(290, 1, 1, 'yoo!', '2015-10-21 10:51:35', 0),
(291, 52, 1, 'stront', '2015-10-21 15:20:56', 0),
(292, 4, 1, 'pis', '2015-10-21 09:56:00', 1),
(293, 3, 1, 'haha!', '2015-10-21 09:56:06', 1),
(294, 3, 1, 'werkt het ! ', '2015-10-21 10:50:56', 1),
(295, 1, 2, 'sooo !', '2015-10-21 11:39:47', 0),
(296, 49, 2, 'yo', '2015-10-21 11:38:41', 1),
(297, 50, 2, 'heey!', '2015-10-21 11:39:01', 1),
(298, 51, 2, 'heey!!', '2015-10-21 15:20:51', 0),
(299, 1, 2, 'Bobo', '2015-10-21 11:39:47', 0),
(300, 1, 1, 'oui', '2015-11-05 19:54:21', 0),
(301, 54, 12, 'Yooo!!', '2015-10-21 15:21:02', 0),
(302, 55, 19, 'joo', '2015-10-21 15:20:44', 0),
(303, 55, 19, 'heey!!', '2015-10-21 15:20:44', 0),
(304, 55, 6, 'heey!', '2015-10-21 15:20:47', 1),
(305, 51, 6, 'whats up !', '2015-10-21 15:20:52', 1),
(306, 52, 6, 'yooo!!', '2015-10-21 16:41:32', 0),
(307, 54, 6, 'yo', '2015-10-21 15:21:04', 1),
(308, 56, 34, 'yooo!', '2015-10-22 08:48:03', 0),
(309, 56, 1, 'heey joren', '2015-10-22 08:48:21', 0),
(310, 56, 34, 'blalabalbal', '2015-10-22 08:48:26', 0),
(311, 57, 35, 'heeyy', '2015-10-22 09:48:50', 1),
(312, 58, 35, 'heey rac', '2015-10-22 09:50:40', 0),
(313, 58, 35, 'sdqsd', '2015-10-22 09:50:51', 0),
(314, 59, 36, 'Heeyy', '2015-10-22 13:28:44', 0),
(315, 59, 1, 'Yo jonas', '2015-10-22 13:29:15', 0),
(316, 59, 36, 'yo', '2015-10-22 13:29:20', 0),
(317, 59, 1, 'qsdqd', '2015-10-24 07:45:37', 1),
(318, 59, 1, 'sqdqsd', '2015-10-24 07:45:50', 1),
(319, 59, 1, 'qsdqsd', '2015-10-24 07:45:51', 1),
(320, 59, 1, 'qsdqsdqs', '2015-10-24 07:45:52', 1),
(321, 59, 1, 'qsdqsdq', '2015-10-24 07:45:52', 1),
(322, 59, 1, 'qsdqsdqsd', '2015-10-24 07:45:53', 1),
(323, 59, 1, 'qsdqsdqsd', '2015-10-24 07:45:54', 1),
(324, 59, 1, 'qsdqsdqsd', '2015-10-24 07:45:55', 1),
(325, 59, 1, 'qsdqsdqsd', '2015-10-24 07:45:55', 1),
(326, 59, 1, 'qsdqsdqsd', '2015-10-24 07:45:56', 1),
(327, 59, 1, 'qsdqsd', '2015-10-24 07:45:57', 1),
(328, 59, 1, 'qsdqsd', '2015-10-24 07:45:58', 1),
(329, 52, 1, 'qsqsdqsdqsdqsd', '2015-10-24 09:05:22', 1),
(330, 52, 1, 'sqdqsd', '2015-10-24 09:06:35', 1),
(331, 52, 1, 'qsdqsd', '2015-10-24 09:12:12', 1),
(332, 52, 1, 'qdqsdqs', '2015-10-24 09:12:13', 1),
(333, 52, 1, 'qsdqsdqsd', '2015-10-24 09:12:13', 1),
(334, 52, 1, 'qsdqsdqs', '2015-10-24 09:12:15', 1),
(335, 52, 1, 'qsdsqd', '2015-10-24 09:17:04', 1),
(336, 52, 1, 'qsdsqdqsd', '2015-10-24 09:17:05', 1),
(337, 52, 1, 'qsdqsdqsd', '2015-10-24 09:17:06', 1),
(338, 1, 2, 'heey', '2015-10-25 09:42:16', 0),
(339, 1, 2, 'whats up ?', '2015-10-25 09:42:16', 0),
(340, 1, 2, 'ik wacht ?', '2015-10-25 09:42:16', 0),
(341, 1, 2, 'haha', '2015-10-25 09:42:16', 0),
(342, 51, 2, 'mourad boiii!!', '2015-10-24 09:20:39', 1),
(343, 1, 2, 'stront', '2015-10-25 09:42:16', 0),
(344, 1, 1, 'zwijg', '2015-11-05 19:54:21', 0),
(345, 1, 1, 'shhhtt', '2015-11-05 19:54:21', 0),
(346, 52, 1, 'yoo!!', '2015-10-25 08:04:27', 1),
(347, 52, 1, 'heey', '2015-10-25 08:35:45', 1),
(348, 52, 1, 'Heey', '2015-10-25 08:38:03', 1),
(349, 52, 1, 'Heey', '2015-10-25 08:38:54', 1),
(350, 52, 1, 'heey!', '2015-10-25 08:39:06', 1),
(351, 52, 1, 'heey!!\r\n', '2015-10-25 08:39:26', 1),
(352, 52, 1, 'dude!', '2015-10-25 08:39:43', 1),
(353, 1, 1, 'hehe!\r\n', '2015-11-05 19:54:21', 0),
(354, 1, 1, 'Heei!', '2015-11-05 19:54:21', 0),
(355, 52, 1, 'hoi!', '2015-10-25 09:03:55', 1),
(356, 52, 1, 'heey', '2015-10-25 09:06:18', 1),
(357, 2, 1, 'hoi', '2015-10-25 09:40:48', 1),
(358, 2, 1, 'whats up !', '2015-10-25 09:40:54', 1),
(359, 2, 1, 'alles inorde', '2015-10-25 09:40:58', 1),
(360, 60, 1, 'sqdqs', '2015-10-31 13:47:39', 0),
(361, 60, 37, 'heey!', '2015-10-31 13:47:48', 0),
(362, 60, 1, 'heyeye', '2015-10-31 13:47:53', 0),
(363, 60, 1, 'sdsdsd', '2015-10-31 13:48:11', 0),
(364, 61, 1, 'heey benjamin', '2015-11-01 17:02:01', 0),
(365, 61, 1, 'kaka', '2015-11-01 17:02:49', 0),
(366, 1, 2, 'hey rach', '2015-11-05 19:54:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `notification_type` int(11) NOT NULL,
  `notification_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator_user_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `item_id`, `notification_type`, `notification_creation_date`, `creator_user_id`, `seen`) VALUES
(1, 1, 117, 0, '2015-10-05 14:36:02', 2, 1),
(2, 1, 118, 0, '2015-10-05 14:36:05', 2, 1),
(3, 6, 0, 2, '2015-10-02 11:31:12', 1, 0),
(4, 6, 0, 2, '2015-10-02 11:31:22', 1, 0),
(5, 6, 0, 2, '2015-10-02 11:31:36', 1, 0),
(6, 1, 0, 2, '2015-10-05 14:36:11', 2, 1),
(7, 2, 0, 2, '2015-10-05 17:12:42', 1, 1),
(8, 2, 0, 2, '2015-10-05 17:12:41', 1, 1),
(9, 1, 0, 3, '2015-10-05 14:36:15', 2, 1),
(10, 1, 143, 0, '2015-10-05 14:36:19', 2, 1),
(11, 2, 145, 0, '2015-10-05 17:12:41', 1, 1),
(12, 2, 145, 0, '2015-10-05 17:12:41', 1, 1),
(13, 2, 145, 0, '2015-10-05 17:12:41', 1, 1),
(14, 2, 119, 0, '2015-10-05 17:12:41', 1, 1),
(15, 1, 143, 0, '2015-10-05 14:41:01', 2, 1),
(16, 1, 142, 0, '2015-10-05 14:58:17', 2, 1),
(17, 1, 143, 0, '2015-10-05 15:20:35', 2, 1),
(18, 1, 141, 0, '2015-10-05 15:25:59', 2, 1),
(19, 2, 145, 0, '2015-10-05 17:12:40', 1, 1),
(20, 1, 131, 0, '2015-10-05 17:14:30', 2, 1),
(21, 1, 116, 0, '2015-10-05 17:18:18', 2, 1),
(22, 2, 144, 0, '2015-10-05 17:22:01', 1, 1),
(23, 2, 144, 0, '2015-10-05 17:23:00', 1, 1),
(24, 2, 119, 0, '2015-10-06 06:31:01', 1, 1),
(25, 1, 142, 0, '2015-10-05 17:28:20', 2, 1),
(26, 2, 145, 0, '2015-10-06 06:30:58', 1, 1),
(27, 2, 119, 0, '2015-10-06 06:30:56', 1, 1),
(28, 3, 0, 3, '2015-10-06 14:18:22', 1, 0),
(29, 3, 0, 2, '2015-10-07 09:36:41', 2, 0),
(30, 2, 145, 0, '2015-10-07 11:33:24', 1, 1),
(31, 1, 0, 2, '2015-10-08 19:51:55', 8, 1),
(32, 8, 0, 3, '2015-10-08 13:59:45', 8, 0),
(33, 8, 204, 0, '2015-10-08 20:13:03', 1, 0),
(34, 8, 0, 3, '2015-10-09 16:52:45', 1, 0),
(35, 1, 202, 0, '2015-10-09 17:07:06', 9, 1),
(36, 1, 0, 2, '2015-10-09 17:07:05', 9, 1),
(37, 1, 200, 0, '2015-10-09 17:07:05', 9, 1),
(38, 9, 0, 3, '2015-10-09 17:06:44', 1, 0),
(39, 9, 0, 2, '2015-10-09 21:14:28', 2, 0),
(40, 2, 0, 3, '2015-10-10 08:11:33', 2, 1),
(41, 2, 244, 0, '2015-10-10 09:43:38', 1, 1),
(42, 2, 260, 0, '2015-10-10 21:13:22', 1, 1),
(43, 2, 262, 0, '2015-10-10 21:13:22', 1, 1),
(44, 1, 201, 0, '2015-10-12 17:01:05', 2, 1),
(45, 1, 263, 0, '2015-10-12 17:01:03', 2, 1),
(46, 1, 263, 0, '2015-10-12 17:01:03', 2, 1),
(47, 2, 0, 3, '2015-10-12 17:45:09', 1, 1),
(48, 2, 262, 0, '2015-10-12 17:45:08', 1, 1),
(52, 1, 244, 6, '2015-10-13 06:39:16', 2, 1),
(53, 2, 243, 0, '2015-10-13 07:20:38', 1, 1),
(54, 9, 202, 6, '2015-10-13 07:09:23', 1, 0),
(55, 2, 143, 6, '2015-10-13 07:20:37', 1, 1),
(56, 1, 144, 6, '2015-10-13 12:33:16', 2, 1),
(57, 1, 111, 0, '2015-10-13 12:33:15', 2, 1),
(58, 8, 0, 3, '2015-10-13 08:17:23', 1, 0),
(59, 8, 203, 0, '2015-10-13 08:17:32', 1, 0),
(60, 2, 0, 2, '2015-10-13 08:21:04', 9, 1),
(61, 2, 260, 0, '2015-10-13 08:21:04', 9, 1),
(62, 2, 201, 6, '2015-10-13 12:46:58', 1, 1),
(63, 1, 373, 0, '2015-10-14 08:20:30', 2, 1),
(64, 2, 373, 6, '2015-10-14 08:44:22', 1, 1),
(65, 6, 0, 2, '2015-10-14 12:24:37', 1, 0),
(66, 6, 0, 2, '2015-10-21 15:20:37', 2, 1),
(67, 1, 225, 0, '2015-10-17 08:54:02', 2, 1),
(68, 1, 225, 0, '2015-10-17 08:54:01', 2, 1),
(69, 1, 243, 6, '2015-10-17 08:54:01', 2, 1),
(70, 1, 462, 0, '2015-10-19 17:49:33', 2, 1),
(71, 2, 462, 6, '2015-10-20 06:43:44', 1, 1),
(72, 1, 463, 0, '2015-10-19 17:49:33', 2, 1),
(73, 1, 474, 0, '2015-10-19 17:55:30', 2, 1),
(74, 2, 474, 6, '2015-10-20 06:43:44', 1, 1),
(75, 9, 200, 6, '2015-10-19 17:58:13', 1, 0),
(76, 1, 0, 2, '2015-10-21 08:20:48', 11, 1),
(77, 11, 0, 3, '2015-10-21 08:20:34', 1, 0),
(78, 1, 0, 2, '2015-10-21 14:05:27', 12, 1),
(79, 12, 0, 3, '2015-10-21 14:04:17', 1, 0),
(80, 12, 490, 0, '2015-10-21 14:04:46', 1, 0),
(81, 1, 0, 2, '2015-10-21 16:41:38', 19, 1),
(82, 20, 499, 0, '2015-10-21 16:41:03', 1, 0),
(83, 20, 0, 2, '2015-10-21 16:41:19', 1, 0),
(84, 1, 0, 2, '2015-10-22 08:44:01', 34, 1),
(85, 1, 489, 0, '2015-10-22 08:44:01', 34, 1),
(86, 34, 489, 6, '2015-10-22 08:43:53', 1, 0),
(87, 20, 499, 0, '2015-10-22 08:46:26', 1, 0),
(88, 34, 503, 0, '2015-10-22 08:47:34', 1, 0),
(89, 2, 0, 2, '2015-11-07 10:26:39', 34, 1),
(90, 12, 0, 2, '2015-10-22 09:16:05', 35, 0),
(91, 1, 0, 2, '2015-10-22 13:18:40', 35, 1),
(92, 35, 527, 0, '2015-10-22 09:50:02', 1, 0),
(93, 12, 490, 0, '2015-10-22 13:18:11', 1, 0),
(94, 1, 0, 2, '2015-10-23 07:56:17', 36, 1),
(95, 36, 535, 0, '2015-10-22 13:28:07', 1, 0),
(96, 1, 535, 6, '2015-10-23 07:56:16', 36, 1),
(97, 36, 0, 3, '2015-10-24 08:37:37', 1, 0),
(98, 1, 0, 2, '2015-10-31 14:26:27', 37, 1),
(99, 2, 0, 2, '2015-11-07 10:26:36', 37, 1),
(100, 1, 554, 0, '2015-10-31 14:26:26', 37, 1),
(101, 37, 554, 6, '2015-10-31 13:45:56', 1, 0),
(102, 1, 0, 2, '2015-11-06 10:46:47', 38, 1),
(103, 1, 553, 0, '2015-11-06 10:46:46', 38, 1),
(104, 38, 0, 3, '2015-11-01 17:01:04', 1, 0),
(105, 38, 562, 0, '2015-11-03 08:02:15', 1, 0),
(106, 19, 0, 3, '2015-11-05 19:55:30', 1, 0),
(107, 38, 553, 6, '2015-11-05 19:55:48', 1, 0),
(108, 1, 564, 0, '2015-11-06 10:46:46', 2, 1),
(109, 38, 0, 3, '2015-11-06 11:24:35', 1, 0),
(110, 37, 0, 3, '2015-11-07 10:18:18', 1, 0),
(111, 2, 1, 3, '2015-11-07 10:26:36', 1, 1),
(112, 2, 1, 4, '2015-11-07 10:26:36', 1, 1),
(113, 2, 1, 4, '2015-11-07 10:26:35', 1, 1),
(114, 38, 1, 4, '2015-11-07 10:25:58', 1, 0),
(115, 2, 1, 4, '2015-11-07 10:26:35', 1, 1),
(116, 34, 0, 3, '2015-11-07 10:26:43', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `offer_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offer_id`, `quest_id`, `collection_id`, `offer_creation_date`) VALUES
(2, 125, 4, '2015-09-30 14:45:28'),
(3, 126, 2, '2015-09-30 14:46:14'),
(4, 127, 4, '2015-09-30 14:47:30'),
(5, 128, 4, '2015-09-30 14:48:18'),
(6, 130, 2, '2015-09-30 17:33:30'),
(7, 131, 4, '2015-09-30 17:48:40'),
(8, 139, 2, '2015-09-30 18:05:39'),
(9, 141, 2, '2015-10-03 16:21:17'),
(10, 144, 8, '2015-10-03 16:31:32'),
(11, 145, 5, '2015-10-05 09:34:36'),
(12, 167, 4, '2015-10-06 12:27:33'),
(13, 206, 17, '2015-10-09 17:02:23'),
(14, 243, 12, '2015-10-10 08:14:57'),
(15, 244, 5, '2015-10-10 08:15:39'),
(16, 263, 2, '2015-10-10 12:19:44'),
(17, 264, 2, '2015-10-10 13:09:52'),
(18, 474, 4, '2015-10-19 17:49:52'),
(19, 489, 2, '2015-10-21 10:49:13'),
(20, 535, 19, '2015-10-22 13:25:21'),
(21, 552, 4, '2015-10-24 07:29:14');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `propo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `propo_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`propo_id`, `user_id`, `quest_id`, `collection_id`, `propo_creation_date`) VALUES
(1, 37, 554, 20, '2015-10-31 13:43:46'),
(2, 38, 553, 21, '2015-11-01 17:00:21'),
(3, 1, 562, 4, '2015-11-03 08:02:15'),
(4, 2, 564, 5, '2015-11-05 20:00:03');

-- --------------------------------------------------------

--
-- Table structure for table `public_quests`
--

CREATE TABLE `public_quests` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `public_quests`
--

INSERT INTO `public_quests` (`id`, `quest_id`, `user_id`) VALUES
(98, 210, 2),
(99, 211, 2),
(101, 213, 2),
(102, 214, 2),
(103, 215, 2),
(104, 224, 1),
(105, 225, 1),
(106, 226, 1),
(107, 240, 2),
(110, 243, 2),
(111, 244, 2),
(112, 262, 2),
(113, 263, 1),
(114, 462, 1),
(115, 474, 1),
(116, 483, 1),
(117, 484, 2),
(118, 489, 1),
(119, 490, 12),
(120, 499, 20),
(121, 503, 34),
(122, 525, 35),
(123, 526, 35),
(124, 527, 35),
(125, 528, 1),
(126, 535, 36),
(127, 551, 1),
(128, 552, 1),
(129, 553, 1),
(130, 554, 1),
(131, 555, 1),
(132, 556, 37),
(133, 557, 37),
(134, 562, 38),
(135, 563, 1),
(136, 564, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quests`
--

CREATE TABLE `quests` (
  `quest_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_description` text NOT NULL,
  `type` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=611 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quests`
--

INSERT INTO `quests` (`quest_id`, `item`, `user_id`, `quest_description`, `type`, `creation_date`, `active`, `views`) VALUES
(551, 'First quest', 1, 'This is our first quest on droopl', 0, '2015-10-23 08:29:29', 1, 8),
(553, 'sqdqdqsd', 1, 'qsdqsdqsdqsd', 0, '2015-10-24 07:56:51', 1, 9),
(554, 'Heey!', 1, '', 0, '2015-10-24 08:16:15', 0, 11),
(555, 'what up my g', 1, 'nothing', 0, '2015-10-25 09:08:09', 0, 0),
(556, 'qsdqsd', 37, 'qsdqsd', 0, '2015-10-31 13:42:26', 1, 0),
(557, 'Gitaar', 37, 'Ik heb dit echt nodig', 0, '2015-10-31 13:43:15', 1, 1),
(562, 'Vrouwen 50 jaar', 38, 'Ik heb liefde nodig !!', 0, '2015-11-01 16:59:05', 1, 5),
(564, 'Een laptop', 1, 'Een acer laptop', 0, '2015-11-05 19:59:47', 1, 3),
(565, '', 2, '', 0, '2015-11-07 10:26:35', 1, 0),
(566, '', 2, '', 0, '2015-11-07 10:26:35', 1, 0),
(567, '', 2, '', 0, '2015-11-07 10:26:35', 1, 0),
(568, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(569, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(570, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(571, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(572, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(573, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(574, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(575, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(576, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(577, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(578, '', 2, '', 0, '2015-11-07 10:26:36', 1, 0),
(579, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(580, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(581, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(582, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(583, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(584, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(585, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(586, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(587, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(588, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(589, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(590, '', 2, '', 0, '2015-11-07 10:26:37', 1, 0),
(591, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(592, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(593, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(594, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(595, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(596, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(597, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(598, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(599, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(600, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(601, '', 2, '', 0, '2015-11-07 10:26:38', 1, 0),
(602, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(603, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(604, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(605, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(606, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(607, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(608, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(609, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0),
(610, '', 2, '', 0, '2015-11-07 10:26:39', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `share_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `age` date NOT NULL,
  `gender` varchar(225) NOT NULL,
  `street` varchar(255) NOT NULL,
  `nr` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `verification` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `lang` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `picture`, `age`, `gender`, `street`, `nr`, `zipcode`, `city`, `country`, `password`, `occupation`, `number`, `status`, `verification`, `description`, `lang`, `latitude`, `longitude`) VALUES
(1, 'Rachouan', 'Rejeb', 'rachouanrejeb@droopl.com', 'rachouanrejeb.jpg', '1993-06-18', 'm', 'Pollarestraat', '117', '9400', 'Ninove', '', 'Haithem18+', 'Shareholder at Droopl', '0475/49.41.99', 0, 1, 'Heey my name is Rachouan I''m the one who developed the Droopl website.', 'nl', '50.833639', '4.018829'),
(2, 'Boris', 'Debusscher', 'borisdebusscher@droopl.com', 'boris.jpg', '1996-11-21', 'm', 'Rue de bobo', '12', '8439', 'Louvain-La-Neuve', '', 'test', 'Employe at droopl', '0475494199', 0, 1, 'enchanté', 'fr', '50.850340', '4.351710'),
(3, 'Ferielle', 'zagnoun', 'ferielle.zagnoun@hotmail.com', 'ferielle.jpg', '1999-06-20', 'f', '', '', '', '', '', 'test', 'Student', '', 0, 1, 'Ik ben ferielle en ik ben heel lelijk !', 'nl', '50.818079', '3.967183'),
(4, 'Wael', 'Zagnoun', 'waelzagnoun@hotmail.com', 'waelzagnoun.jpg', '1996-10-04', 'm', 'Botermelkstraat', '9', '9400', 'Appelterre-eichem', '', 'test', 'Lawyer', '0475434549', 0, 1, 'I''m wael , and I love rachouan', 'nl', '50.818079', '3.967183'),
(6, 'Mourad', 'Taiebi', 'mourad.taiebi@droopl.com', 'mouradtaiebi.jpg', '2015-09-22', 'm', '', '', '', '', '', 'test', 'Droopl co-owner', '0465363746', 0, 1, 'IN-D-STRUCT-IBLE', 'nl', '51.025876', '4.477536'),
(7, 'Daniël', 'Yikik', 'daniel.yikik@droopl.com', 'danielyikik.jpg', '2015-09-14', 'm', '', '', '', '', '', 'test', 'Droopl co-owner', '0437347346', 0, 1, 'Everybody''s Cool, But Y''all Just Ain''t Me', 'nl', '51.025876', '4.477536'),
(8, 'Jef', 'Vastenavondt', 'jef.vastenavondt@icloud.com', '', '1994-07-23', 'm', 'Provinciebaan', '149', '3118', 'Werchter', '', 'azerty', 'Student', '', 0, 1, '', 'nl', '', ''),
(9, 'Chedli', 'Rejeb', 'chdoula62@hotmail.com', 'chedli.jpg', '1962-04-06', 'm', 'pollarestraat', '117', '9400', 'Ninove', '', 'test', 'Arbeider', '0473503215', 0, 1, 'Je suis chedli', 'fr', '', ''),
(11, 'rachouan', 'rejeb', 'rachouan_15@hotmail.fr', 'hXuS9ED4wi.jpg', '2015-10-23', 'm', 'Pollarestraat', '117', '9400', 'Ninove', 'BelgiÃ«', 'Haithem18+', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'en', '50.8336386', '50.8336386'),
(12, 'Mathias', 'Decoster', 'ben@kleware.be', 'hjMckxhABV.jpg', '2015-10-13', 'm', 'Nijverheidskaai', '170', '1070', 'Anderlecht', 'BelgiÃ«', 'test', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'en', '50.83919909999999', '50.83919909999999'),
(19, 'Emna', 'rejeb', 'emna.rejeb@hotmail.com', '', '1993-06-18', 'm', 'pollarestraat', '117', '9400', 'Ninove', 'Belgium', 'test', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'en', '50.833639', '50.833639'),
(20, 'kak', 'pipi', 'kak@pipi.com', '', '1993-06-18', 'm', 'qsdqsd', 'qsdqsd', 'qsdqsd', 'qsdqsd', 'qsdqsd', 'test', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'en', 'qsdqsd', 'qsdqsd'),
(33, 'rachouan', 'rejeb', 'rachouan.rejeb@icloud.com', '', '1993-06-18', 'm', 'Pollarestraat', '117', '9400', 'Ninove', 'BelgiÃ«', 'Haithem18+', 'No occupation', 'No Number', 0, 0, 'No Desciption', 'en', '50.8336386', '4.0188286'),
(34, 'Joren', 'De Mesmaeker', 'jorendemesmaeker@hotmail.com', '', '1996-05-12', 'm', 'Nijverheidskaai', '170', '1070', 'Anderlecht', 'BelgiÃ«', 'azerty', 'No occupation', 'No Number', 0, 0, 'No Desciption', 'nl', '50.83919909999999', '4.3297341'),
(35, 'Ben', 'Klewais', 'mathias.decoster@gmail.com', 'B9EzOU479B.jpg', '1996-11-02', 'm', 'Dries', '21', '3380', 'Glabbeek', 'BelgiÃ«', 'test', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'en', '50.87291339999999', '4.9488142'),
(36, 'Jonas', 'Pardon', 'jonaspardon@hotmail.com', '', '1994-11-14', 'm', 'Sint Martensplein', '1749', '9300', 'Aalst', 'BelgiÃ«', '12345678', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'nl', '50.9378101', '4.0409517'),
(37, 'Daniel', 'Taiebi', 'rachouan.rejeb@icloud.com', 'wM3RV8jpD9.jpg', '1993-06-18', 'm', 'LÃ©opoldstraat', '3', '1000', 'Brussel', 'BelgiÃ«', 'test', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'nl', '50.848752', '4.355348'),
(38, 'Benjamin', 'Van der meulen', 'benjamin1vdm@hotmail.com', 'UhpyzCzrzr.jpg', '1997-10-21', 'm', 'Sint-Michielsstraat', '29', '9000', 'Gent', 'BelgiÃ«', 'test', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'en', '51.05439', '3.7170859');

-- --------------------------------------------------------

--
-- Table structure for table `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_rating`
--

INSERT INTO `user_rating` (`id`, `user_id`, `creator_id`, `rating`) VALUES
(1, 2, 1, '3'),
(2, 3, 1, '3.5'),
(3, 4, 1, '4'),
(4, 3, 2, '4.5'),
(5, 1, 2, '1.5');

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `user_id`, `code`, `verified`) VALUES
(9, 11, 4968, 1),
(10, 12, 1405, 1),
(31, 33, 2277, 0),
(32, 34, 5777, 1),
(33, 35, 2370, 1),
(34, 36, 3525, 1),
(35, 37, 9357, 1),
(36, 38, 6627, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_propos`
--
ALTER TABLE `accepted_propos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_quests`
--
ALTER TABLE `community_quests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `community_users`
--
ALTER TABLE `community_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completed_quests`
--
ALTER TABLE `completed_quests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `conversation_users`
--
ALTER TABLE `conversation_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`propo_id`);

--
-- Indexes for table `public_quests`
--
ALTER TABLE `public_quests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quests`
--
ALTER TABLE `quests`
  ADD PRIMARY KEY (`quest_id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`share_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accepted_propos`
--
ALTER TABLE `accepted_propos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `community_quests`
--
ALTER TABLE `community_quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `community_users`
--
ALTER TABLE `community_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `completed_quests`
--
ALTER TABLE `completed_quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `conversation_users`
--
ALTER TABLE `conversation_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=367;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `propo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `public_quests`
--
ALTER TABLE `public_quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `quests`
--
ALTER TABLE `quests`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=611;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `share_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
