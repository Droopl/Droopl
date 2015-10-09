-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 07 okt 2015 om 13:18
-- Serverversie: 5.5.42
-- PHP-versie: 5.6.10

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
-- Tabelstructuur voor tabel `collection`
--

CREATE TABLE `collection` (
  `collection_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `collection_image` varchar(255) NOT NULL,
  `collection_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `collection`
--

INSERT INTO `collection` (`collection_id`, `item_name`, `user_id`, `description`, `collection_image`, `collection_creation_date`, `status`) VALUES
(2, 'Cleaner', 1, 'To clean stuff with.', 'cleaner.jpg', '2015-09-25 13:04:53', 1),
(4, 'Dolce gusto', 1, 'I like coffee.', 'dolce-gusto.png', '2015-09-25 16:21:02', 0),
(5, 'Reflex camera', 2, 'Dit is een gibson gitaar dat ik heb aangemaakt', 'canon-reflex.png', '2015-09-27 13:52:57', 0),
(6, 'Cleaner', 2, 'To clean stuff with.', 'cleaner.jpg', '2015-09-27 13:52:57', 1),
(7, 'Disqueuse', 2, 'Disqueuse', 'disqueuse.png', '2015-09-27 13:52:57', 0),
(8, 'Dolce gusto', 2, 'I like coffee.', 'dolce-gusto.png', '2015-09-27 13:52:57', 0),
(12, 'lamp', 2, '64 watt', 'ed2FgZgCSV.jpeg', '2015-09-27 16:32:43', 0),
(13, 'schep', 2, '', 'kDt0l4tY0i.jpeg', '2015-09-27 16:41:28', 0),
(14, 'fixie', 2, '', 'dOYwxskA51.png', '2015-09-27 16:42:17', 0),
(16, 'random', 1, 'qsdqsdqsd', 'vi1YPKjK25.jpeg', '2015-10-05 08:04:59', 0),
(17, 'qsdqsd', 1, 'qsdqsdqsd', '8Y2Ky6SQB0.jpg', '2015-10-06 13:18:21', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `conversation`
--

CREATE TABLE `conversation` (
  `conversation_id` int(11) NOT NULL,
  `conversation_name` varchar(255) NOT NULL,
  `conversation_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `conversation_typing` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `conversation`
--

INSERT INTO `conversation` (`conversation_id`, `conversation_name`, `conversation_creation_date`, `conversation_typing`) VALUES
(1, 'Groep 1', '2015-09-29 15:45:35', 0),
(2, 'groep 2', '2015-09-29 11:13:28', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `conversation_users`
--

CREATE TABLE `conversation_users` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_typing` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `conversation_users`
--

INSERT INTO `conversation_users` (`id`, `conversation_id`, `user_id`, `creation_date`, `user_typing`) VALUES
(1, 1, 1, '2015-10-05 17:09:01', 0),
(2, 1, 2, '2015-10-03 16:22:29', 0),
(3, 2, 1, '2015-10-05 17:08:56', 0),
(4, 2, 3, '2015-09-29 11:13:41', 0),
(5, 1, 3, '2015-10-05 11:53:02', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `followers`
--

CREATE TABLE `followers` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `follow_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `followers`
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
(63, 2, 2, '2015-09-12 12:36:11'),
(65, 1, 1, '2015-09-21 12:23:36'),
(82, 1, 2, '2015-10-02 11:48:55'),
(83, 2, 1, '2015-10-02 11:52:09'),
(84, 1, 3, '2015-10-06 14:18:22'),
(85, 2, 3, '2015-10-07 09:36:41');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `images`
--

INSERT INTO `images` (`id`, `quest_id`, `image_url`, `creation_date`) VALUES
(86, 198, '6rSR3oP2gu.jpg', '2015-10-06 13:11:50'),
(87, 199, 'KyvsQO4vSm.jpg', '2015-10-06 13:20:50'),
(88, 200, 'O3PI86UvEa.jpg', '2015-10-06 13:26:33');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `user_id`, `message`, `message_creation_date`) VALUES
(1, 1, 1, 'hey!', '2015-09-28 19:41:36'),
(2, 1, 2, 'kaka', '2015-09-28 19:41:36'),
(3, 1, 2, 'Je suis bobo', '2015-09-28 20:22:55'),
(4, 1, 1, 'kaka pipi', '2015-09-28 20:30:07'),
(5, 1, 1, 'Stop aub !', '2015-09-29 11:08:42'),
(6, 2, 1, 'Heey!!', '2015-09-29 11:13:52'),
(7, 1, 2, 'heey!', '2015-09-29 13:06:07'),
(10, 1, 1, 'heey!', '2015-09-29 13:22:01'),
(11, 1, 1, 'whats up !', '2015-09-29 13:22:08'),
(12, 2, 1, 'ik ben rachouan !', '2015-09-29 13:22:16'),
(13, 1, 1, 'heey!\r\n', '2015-09-29 13:24:18'),
(14, 1, 2, 'Yoo!', '2015-09-29 13:25:38'),
(15, 1, 2, 'yoo!!', '2015-09-29 13:25:55'),
(16, 1, 2, 'yoo!', '2015-09-29 13:26:04'),
(17, 1, 2, 'kakaka!!!', '2015-09-29 13:26:42'),
(18, 2, 1, 'hey!', '2015-09-29 13:26:56'),
(19, 1, 2, 'fuck you!', '2015-09-29 13:27:15'),
(20, 1, 2, 'yoo!!\r\n', '2015-09-29 13:28:34'),
(21, 1, 2, 'Werkt het ?', '2015-09-29 13:43:55'),
(22, 1, 2, 'Werkt het ?', '2015-09-29 13:44:20'),
(23, 1, 2, 'heey!', '2015-09-29 14:01:00'),
(24, 1, 1, 'heey bobo', '2015-09-29 14:02:50'),
(25, 1, 2, 'Heey!', '2015-09-29 14:23:48'),
(26, 1, 2, 'Heey!', '2015-09-29 14:23:57'),
(27, 1, 2, 'qsqdqsd', '2015-09-29 14:24:01'),
(28, 1, 2, 'Heey!', '2015-09-29 14:25:10'),
(29, 1, 2, 'Heey!', '2015-09-29 14:29:03'),
(30, 1, 2, 'yoo!\r\n', '2015-09-29 14:29:09'),
(31, 1, 2, 'yoo!\r\n', '2015-09-29 14:29:53'),
(32, 1, 2, 'yoo!\r\n', '2015-09-29 14:30:12'),
(33, 1, 2, 'yoo!\r\n', '2015-09-29 14:30:42'),
(34, 1, 2, 'kaka pip', '2015-09-29 14:30:50'),
(35, 1, 2, 'yoo!\r\n', '2015-09-29 14:31:35'),
(36, 1, 2, 'pqsdqsd', '2015-09-29 14:31:43'),
(37, 1, 2, 'yoo!\r\n', '2015-09-29 14:32:16'),
(38, 1, 2, 'qqsqsdqsd', '2015-09-29 14:32:22'),
(39, 1, 2, 'yoo!\r\n', '2015-09-29 14:32:42'),
(40, 1, 2, 'qsdqsd', '2015-09-29 14:32:45'),
(41, 1, 2, 'heey!', '2015-09-29 14:32:52'),
(42, 1, 2, 'kaka pip', '2015-09-29 14:33:08'),
(43, 1, 2, 'oke', '2015-09-29 14:33:24'),
(44, 1, 2, 'marche', '2015-09-29 14:34:58'),
(45, 1, 2, 'qsdqsd', '2015-09-29 14:35:51'),
(46, 1, 2, 'Woow !', '2015-09-29 14:36:00'),
(47, 1, 2, 'fuck you !\r\n', '2015-09-29 14:36:56'),
(48, 1, 2, 'yeey', '2015-09-29 14:37:00'),
(49, 1, 2, 'werkt', '2015-09-29 14:37:07'),
(50, 1, 2, 'fuck you', '2015-09-29 14:37:18'),
(51, 1, 2, 'akkakaka', '2015-09-29 14:39:12'),
(52, 1, 2, 'h', '2015-09-29 14:40:58'),
(53, 1, 2, 'e', '2015-09-29 14:40:58'),
(54, 1, 2, 'e', '2015-09-29 14:40:59'),
(55, 1, 2, 'y', '2015-09-29 14:40:59'),
(56, 1, 2, 'fuck you\r\n', '2015-09-29 14:42:14'),
(57, 1, 2, 'heeyy!\r\n', '2015-09-29 14:42:21'),
(58, 1, 2, 'please werkt ', '2015-09-29 14:42:33'),
(59, 1, 2, 'werkt', '2015-09-29 14:43:47'),
(60, 1, 2, 'ok', '2015-09-29 14:44:22'),
(61, 1, 2, 'qsdqsd', '2015-09-29 14:44:57'),
(62, 1, 2, 'qsdqsd', '2015-09-29 14:45:06'),
(63, 1, 2, 'qsdsqd', '2015-09-29 14:45:08'),
(64, 1, 2, 'qsdqsd', '2015-09-29 14:45:10'),
(65, 1, 2, 'kaka', '2015-09-29 14:45:12'),
(66, 1, 2, 'haha!', '2015-09-29 14:45:14'),
(67, 1, 2, 'qsdqsd', '2015-09-29 14:46:23'),
(68, 1, 2, 'qsdqsd', '2015-09-29 14:46:26'),
(69, 1, 2, 'kaka', '2015-09-29 14:47:15'),
(70, 1, 2, 'hey', '2015-09-29 14:47:18'),
(71, 1, 2, 'qsdsd', '2015-09-29 14:48:52'),
(72, 1, 2, 'sdqsd', '2015-09-29 14:49:04'),
(73, 1, 2, 'hey', '2015-09-29 14:49:12'),
(74, 1, 2, 'qsdqsd', '2015-09-29 14:50:29'),
(75, 1, 2, 'qsdqsdsqd', '2015-09-29 14:51:17'),
(76, 1, 2, 'qsdqsd', '2015-09-29 14:51:30'),
(77, 1, 2, 'qsdqsd', '2015-09-29 14:51:45'),
(78, 1, 2, 'qqsqsd', '2015-09-29 14:51:55'),
(79, 1, 2, 'qsdsqd', '2015-09-29 14:52:15'),
(80, 1, 2, 'qsdqsd', '2015-09-29 14:52:23'),
(81, 1, 2, 'sqdqsd', '2015-09-29 14:52:26'),
(82, 1, 2, 'sdqsd', '2015-09-29 14:52:30'),
(83, 1, 2, 'qsdqsd', '2015-09-29 14:54:03'),
(84, 1, 2, 'qsdqsd', '2015-09-29 14:56:09'),
(85, 2, 1, 'heeyyÃ¨', '2015-09-29 14:58:41'),
(86, 1, 2, 'hey bobo', '2015-09-29 15:09:23'),
(87, 1, 1, 'yoo!', '2015-09-29 15:09:30'),
(88, 1, 1, 'super cool ', '2015-09-29 15:09:37'),
(89, 1, 1, 'hahaa!!', '2015-09-29 15:09:41'),
(90, 1, 1, 'heey', '2015-09-29 15:14:41'),
(91, 1, 2, 'boris', '2015-09-29 15:14:49'),
(92, 1, 1, 'fuck ', '2015-09-29 15:39:04'),
(93, 1, 1, 'pff', '2015-09-29 15:39:06'),
(94, 1, 1, 'werk', '2015-09-29 15:39:08'),
(95, 1, 1, 'aub', '2015-09-29 15:39:09'),
(96, 2, 1, 'heey!', '2015-09-29 15:39:51'),
(97, 1, 2, 'werk', '2015-09-29 15:40:27'),
(98, 1, 2, 'het werkt', '2015-09-29 15:40:36'),
(99, 1, 2, 'hoi', '2015-09-29 15:45:08'),
(100, 1, 2, 'waauw', '2015-09-29 15:45:11'),
(101, 1, 2, 'werkt :p', '2015-09-29 15:45:16'),
(102, 1, 1, '   sqdsdqsd', '2015-09-29 15:46:43'),
(103, 1, 2, 'balbala', '2015-09-29 15:54:35'),
(104, 1, 2, 'hihi', '2015-09-29 15:54:38'),
(105, 1, 2, 'sqdqd', '2015-09-29 19:34:20'),
(106, 1, 2, 'qsdqsdqd', '2015-09-29 19:34:31'),
(107, 1, 2, 'qsdqsdqd', '2015-09-29 19:34:38'),
(108, 1, 2, 'qsdqsd', '2015-09-29 19:34:41'),
(109, 1, 2, 'qdqsdqsd', '2015-09-29 19:34:44'),
(110, 1, 2, 'qsdqdqsd', '2015-09-29 19:34:47'),
(111, 1, 2, 'qsdqsdqsd', '2015-09-29 19:35:08'),
(112, 1, 2, 'qsdqsd', '2015-09-29 19:35:10'),
(113, 1, 2, 'qsdqsd', '2015-09-29 19:35:12'),
(114, 1, 2, 'qsdqsd', '2015-09-29 19:35:14'),
(115, 1, 2, 'kaka pipi', '2015-09-29 19:35:17'),
(116, 1, 2, 'sqdqsd', '2015-09-29 19:35:20'),
(117, 1, 2, 'qsdqsd', '2015-09-29 19:35:23'),
(118, 1, 2, 'qsdqsd', '2015-09-29 19:35:26'),
(119, 1, 2, 'qsdqsd', '2015-09-29 19:35:30'),
(120, 2, 1, 'sqdqsd', '2015-09-29 20:02:12'),
(121, 1, 1, 'heey!', '2015-09-29 20:03:10'),
(122, 1, 1, 'qsdqsdqsd', '2015-09-29 20:05:19'),
(123, 1, 1, 'sqdqsdqsd', '2015-09-29 20:05:23'),
(124, 1, 1, 'qsdqsdqsd', '2015-09-29 20:05:25'),
(125, 1, 1, 'qsdqsdsqd', '2015-09-29 20:05:28'),
(126, 1, 1, 'qsdqsdqsd', '2015-09-29 20:06:06'),
(127, 1, 1, 'qsdqsd', '2015-09-29 20:06:08'),
(128, 1, 1, 'qsdqsd', '2015-09-29 20:06:09'),
(129, 1, 1, 'qsdqsd', '2015-09-29 20:06:10'),
(130, 1, 1, 'qsdqsd', '2015-09-29 20:06:11'),
(131, 1, 1, 'qsdqsd', '2015-09-29 20:06:16'),
(132, 1, 1, 'qsdqsd', '2015-09-29 20:08:30'),
(133, 1, 1, 'qsdsd', '2015-09-29 20:08:46'),
(134, 1, 1, 'qsdqsd', '2015-09-29 20:08:50'),
(135, 1, 1, 'qsdqsd', '2015-09-29 20:08:53'),
(136, 1, 1, 'qsdqsd', '2015-09-29 20:09:21'),
(137, 1, 1, 'qsdsqd', '2015-09-29 20:09:55'),
(138, 1, 1, 'qsdqsd', '2015-09-29 20:10:29'),
(139, 1, 1, 'qsdqsd', '2015-09-29 20:11:30'),
(140, 1, 2, 'qsdqsd', '2015-09-29 20:12:36'),
(141, 1, 2, 'qsdqsd', '2015-09-29 20:13:12'),
(142, 1, 1, 'kaka pipi', '2015-09-30 06:49:01'),
(143, 1, 2, 'heey!!', '2015-09-30 13:54:25'),
(144, 1, 2, 'kakak pipi', '2015-09-30 13:54:32'),
(145, 1, 2, 'qsdqsd', '2015-09-30 13:54:52'),
(146, 1, 2, 'qsdqsd', '2015-09-30 13:54:58'),
(147, 1, 2, 'Heey ik ben dus nu gwn aant chatten met mezelf ', '2015-09-30 13:55:09'),
(148, 1, 2, 'sqdqsdqsd', '2015-09-30 18:31:20'),
(149, 1, 2, 'whats up !', '2015-09-30 18:31:26'),
(150, 1, 2, 'yoo!', '2015-09-30 18:31:29'),
(151, 1, 1, 'qsdqsd', '2015-10-01 10:26:40'),
(152, 1, 1, 'qsdqs', '2015-10-01 10:26:49'),
(153, 1, 1, 'qsdqsd', '2015-10-01 10:26:51'),
(154, 1, 1, 'sqdqsd', '2015-10-01 10:26:52'),
(155, 1, 1, 'heey!!', '2015-10-01 10:27:02'),
(156, 1, 1, 'kakak', '2015-10-01 10:27:23'),
(157, 1, 1, 'kl', '2015-10-01 10:27:45'),
(158, 1, 1, 'sd', '2015-10-01 10:27:48'),
(159, 1, 2, 'qsdsq', '2015-10-03 16:22:21'),
(160, 1, 2, 'qsd', '2015-10-03 16:22:25'),
(161, 1, 2, 'qsdqsd', '2015-10-03 16:22:29'),
(162, 1, 1, 'Yo boris', '2015-10-05 09:11:05'),
(163, 1, 1, 'seg fer hoe ist !', '2015-10-05 09:11:14'),
(164, 1, 1, 'alles goed ?', '2015-10-05 09:11:34'),
(165, 2, 1, 'heey', '2015-10-05 09:16:30'),
(166, 2, 1, 'whatup !', '2015-10-05 09:16:39'),
(167, 1, 1, 'kak', '2015-10-05 09:16:45'),
(168, 2, 1, 'qsdqsd', '2015-10-05 09:17:47'),
(169, 1, 1, 'dqsd', '2015-10-05 09:17:51'),
(170, 2, 1, 'oke het werkt :p', '2015-10-05 09:17:58'),
(171, 2, 1, 'pff', '2015-10-05 11:50:13'),
(172, 1, 1, 'qsdqsd', '2015-10-05 11:53:48'),
(173, 2, 1, 'sqdqsd', '2015-10-05 17:08:05'),
(174, 2, 1, 'hey', '2015-10-05 17:08:56'),
(175, 1, 1, 'fuck this', '2015-10-05 17:09:01');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `notification_type` int(11) NOT NULL,
  `notification_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator_user_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `notifications`
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
(30, 2, 145, 0, '2015-10-07 10:07:38', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `offer_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `offers`
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
(12, 167, 4, '2015-10-06 12:27:33');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `proposals`
--

CREATE TABLE `proposals` (
  `propo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `propo_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `proposals`
--

INSERT INTO `proposals` (`propo_id`, `user_id`, `quest_id`, `collection_id`, `propo_creation_date`) VALUES
(23, 1, 144, 16, '2015-10-05 09:05:00'),
(24, 1, 144, 2, '2015-10-05 09:05:12'),
(25, 1, 144, 4, '2015-10-05 09:05:44'),
(26, 1, 119, 16, '2015-10-05 09:06:32'),
(27, 1, 119, 4, '2015-10-05 09:06:53'),
(28, 1, 119, 2, '2015-10-05 09:07:37'),
(29, 2, 143, 14, '2015-10-05 09:23:11'),
(30, 1, 145, 4, '2015-10-05 13:31:20'),
(31, 1, 145, 2, '2015-10-05 13:31:53'),
(32, 1, 145, 16, '2015-10-05 13:46:18'),
(33, 1, 119, 17, '2015-10-05 13:47:17'),
(34, 2, 143, 13, '2015-10-05 14:40:33'),
(35, 2, 142, 14, '2015-10-05 14:42:10'),
(36, 2, 143, 12, '2015-10-05 15:08:02'),
(37, 2, 141, 5, '2015-10-05 15:24:22'),
(38, 1, 145, 4, '2015-10-05 17:06:06'),
(39, 2, 131, 7, '2015-10-05 17:13:46'),
(40, 2, 116, 6, '2015-10-05 17:18:03'),
(41, 1, 144, 4, '2015-10-05 17:18:53'),
(42, 1, 144, 16, '2015-10-05 17:22:50'),
(43, 1, 119, 2, '2015-10-05 17:23:18'),
(44, 2, 142, 12, '2015-10-05 17:28:07'),
(45, 1, 145, 2, '2015-10-06 06:29:01'),
(46, 1, 119, 2, '2015-10-06 06:29:24'),
(47, 1, 145, 17, '2015-10-07 10:07:38');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `quests`
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
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `quests`
--

INSERT INTO `quests` (`quest_id`, `item`, `user_id`, `quest_description`, `type`, `creation_date`, `active`, `views`) VALUES
(1, 'Reflex Camera', 1, 'For an assingment for the avengers I am in great need of a camera Prefarbly a reflex \r\ncamera. I need to be able to take beautifull High quality pictures like ', 0, '2015-08-24 08:16:28', 0, 2),
(2, 'Speaker', 1, 'I am throwing a party and I am in need of a great speaker to liven op the party. \r\nMy qoutas are\r\n\r\n1. Great sound\r\n2. Nice bass\r\n3. Great Quality', 0, '2015-08-24 08:40:52', 0, 1),
(73, 'Beats headphones', 1, 'I just need them for myself , I hate everybody else', 0, '2015-08-24 12:01:04', 1, 0),
(74, 'Asus laptop', 1, 'I''m really in need of a good pc , and I have some really nice items that I can trade you for it. just send me a proposal if you can ! cheers !', 0, '2015-08-24 12:02:59', 1, 0),
(106, 'a Life', 1, 'I am tired of studying so I''m looking for a life !', 0, '2015-08-25 18:33:57', 1, 0),
(107, 'For nothing', 2, 'This is my first post', 0, '2015-08-31 15:30:16', 1, 7),
(108, 'Skateboard', 1, 'Because I need one', 0, '2015-09-06 13:41:34', 1, 0),
(109, 'Chips', 3, 'I''m sooo hungry and I need to have food ! thanks !', 0, '2015-09-06 21:05:37', 1, 2),
(110, 'Scheenlappen', 4, 'Ik ga vanaf morgen terug voetbal training volgen dus ik heb scheenlappen nodig', 0, '2015-09-07 11:02:06', 1, 0),
(111, 'Iphone 6', 1, 'I''m really in need of an iphone can anyone help me', 0, '2015-09-07 11:08:39', 1, 2),
(114, 'boormachine ', 1, 'ik zoek een boor mzchine', 0, '2015-09-12 12:23:56', 1, 0),
(115, 'sdqsd', 1, 'qsdqsdqsd', 0, '2015-09-12 12:24:08', 1, 2),
(116, 'qdqsd', 1, 'qsdqsdqsd', 0, '2015-09-12 12:24:16', 1, 3),
(117, 'Gitaar', 1, 'Ik wil het gewoon niet meer', 0, '2015-09-12 12:25:07', 1, 42),
(118, 'balblabeaz', 2, 'qsdqsdqsd', 0, '2015-09-12 12:36:06', 1, 42),
(119, 'schoenen', 2, 'maat 43', 0, '2015-09-27 21:05:02', 1, 77),
(131, '', 1, 'Ik heb deze thuis nog staan als u ze kunt gebruiken laat mij zeker iets weten ;)', 1, '2015-09-30 17:48:40', 1, 3),
(139, '', 1, 'Dit is een stofzuiger zonder zakje ;)', 1, '2015-09-30 18:05:39', 1, 4),
(140, 'heey', 1, 'qsdqsdqsd', 0, '2015-09-30 18:23:19', 1, 15),
(141, '', 1, 'Ik zoek balbala', 1, '2015-10-03 16:21:17', 1, 4),
(142, 'qsdqsd', 1, 'qsdqsd', 0, '2015-10-03 16:24:28', 1, 6),
(143, 'qsdqsd', 1, 'qsdqsdqsd', 0, '2015-10-03 16:26:31', 1, 8),
(144, '', 2, 'Werk aub', 1, '2015-10-03 16:31:32', 1, 75),
(145, '', 2, 'I found this yesterday in my attic it still works perfectly and is just perfect', 1, '2015-10-05 09:34:36', 1, 24),
(198, 'Wael', 1, 'Ik zoek deze allanngg!!', 0, '2015-10-06 13:11:50', 1, 0),
(199, 'Bos', 1, 'Ik zoek een bos', 0, '2015-10-06 13:20:50', 1, 1),
(200, 'sqsdqsdqsd', 1, 'qsdqsd', 0, '2015-10-06 13:26:31', 1, 6),
(201, 'qsd', 1, 'qsdqsd', 0, '2015-10-07 10:06:51', 1, 1),
(202, 'qsdÃ©qsd', 1, 'sqdqsdÃ©qsd', 0, '2015-10-07 10:14:02', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `age` date NOT NULL,
  `street` varchar(255) NOT NULL,
  `nr` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `verification` tinyint(1) NOT NULL,
  `description` text NOT NULL,
  `lang` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `picture`, `age`, `street`, `nr`, `zipcode`, `city`, `password`, `occupation`, `number`, `status`, `verification`, `description`, `lang`, `latitude`, `longitude`) VALUES
(1, 'Rachouan', 'Rejeb', 'rachouanrejeb@droopl.com', 'rachouanrejeb.jpg', '1993-06-18', 'Pollarestraat', '117', '9400', 'Ninove', 'Haithem18+', 'Shareholder at Droopl', '0475/49.41.99', 0, 0, 'Heey my name is Rachouan I''m the one who developed the Droopl website.', 'en', '50.833639', '4.018829'),
(2, 'Boris', 'Debusscher', 'borisdebusscher@droopl.com', 'boris.jpg', '1996-11-21', 'Rue de bobo', '12', '8439', 'Louvain-La-Neuve', 'test', 'Employe at droopl', '0475494199', 0, 0, 'enchanté', 'fr', '50.850340', '4.351710'),
(3, 'Ferielle', 'zagnoun', 'ferielle.zagnoun@hotmail.com', 'ferielle.jpg', '1999-06-20', '', '', '', '', 'test', 'Student', '', 0, 0, 'Ik ben ferielle en ik ben heel lelijk !', 'nl', '50.818079', '3.967183'),
(4, 'Wael', 'Zagnoun', 'waelzagnoun@hotmail.com', 'waelzagnoun.jpg', '1996-10-04', 'Botermelkstraat', '9', '9400', 'Appelterre-eichem', 'test', 'Lawyer', '0475434549', 0, 0, 'I''m wael , and I love rachouan', 'nl', '50.818079', '3.967183'),
(6, 'Mourad', 'Taiebi', 'mourad.taiebi@droopl.com', 'mouradtaiebi.jpg', '2015-09-22', '', '', '', '', 'test', 'Droopl co-owner', '0465363746', 0, 0, 'IN-D-STRUCT-IBLE', 'nl', '51.025876', '4.477536'),
(7, 'Daniël', 'Yikik', 'daniel.yikik@droopl.com', 'danielyikik.jpg', '2015-09-14', '', '', '', '', 'test', 'Droopl co-owner', '0437347346', 0, 0, 'Everybody''s Cool, But Y''all Just Ain''t Me', 'nl', '51.025876', '4.477536');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `user_rating`
--

INSERT INTO `user_rating` (`id`, `user_id`, `creator_id`, `rating`) VALUES
(1, 2, 1, '3'),
(2, 3, 1, '3.5'),
(3, 4, 1, '4'),
(4, 3, 2, '4.5'),
(5, 1, 2, '1.5');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexen voor tabel `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexen voor tabel `conversation_users`
--
ALTER TABLE `conversation_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexen voor tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexen voor tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexen voor tabel `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`);

--
-- Indexen voor tabel `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`propo_id`);

--
-- Indexen voor tabel `quests`
--
ALTER TABLE `quests`
  ADD PRIMARY KEY (`quest_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `user_rating`
--
ALTER TABLE `user_rating`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `conversation`
--
ALTER TABLE `conversation`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `conversation_users`
--
ALTER TABLE `conversation_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `followers`
--
ALTER TABLE `followers`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT voor een tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT voor een tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT voor een tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT voor een tabel `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT voor een tabel `proposals`
--
ALTER TABLE `proposals`
  MODIFY `propo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT voor een tabel `quests`
--
ALTER TABLE `quests`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
