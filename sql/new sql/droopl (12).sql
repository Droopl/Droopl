-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 07 jan 2016 om 19:43
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
-- Tabelstructuur voor tabel `accepted_propos`
--

CREATE TABLE `accepted_propos` (
  `id` int(11) NOT NULL,
  `propo_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `accepted_propos`
--

INSERT INTO `accepted_propos` (`id`, `propo_id`, `quest_id`, `creation_date`) VALUES
(1, 1, 5, '2016-01-06 18:55:52'),
(2, 2, 4, '2016-01-06 18:57:15');

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
  `status` tinyint(1) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `collection`
--

INSERT INTO `collection` (`collection_id`, `item_name`, `user_id`, `description`, `collection_image`, `collection_creation_date`, `status`, `available`) VALUES
(1, 'the smurfs', 1, 'heey\r\n', 'v52erw27PA.jpg', '2016-01-06 18:52:50', 0, 0),
(2, 'rachouan', 2, 'heey\r\n', 'tD7VZfLeuc.jpg', '2016-01-06 18:53:31', 0, 0),
(3, 'heey', 1, 'yoo!', '', '2016-01-07 11:08:11', 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `communities`
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `communities`
--

INSERT INTO `communities` (`id`, `community_name`, `community_profile`, `genre`, `creator_id`, `description`, `privacy`, `creation_date`) VALUES
(1, 'Dribbble', '', 0, 1, 'This is the dribble community', 1, '2016-01-07 10:58:49');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `community_quests`
--

CREATE TABLE `community_quests` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `community_users`
--

CREATE TABLE `community_users` (
  `id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `community_users`
--

INSERT INTO `community_users` (`id`, `community_id`, `user_id`, `creation_date`) VALUES
(1, 1, 1, '2016-01-07 10:58:49'),
(2, 1, 4, '2016-01-07 10:59:36');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `completed_quests`
--

CREATE TABLE `completed_quests` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `conversation`
--

CREATE TABLE `conversation` (
  `conversation_id` int(11) NOT NULL,
  `conversation_name` varchar(255) NOT NULL,
  `conversation_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `conversation_typing` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `conversation`
--

INSERT INTO `conversation` (`conversation_id`, `conversation_name`, `conversation_creation_date`, `conversation_typing`) VALUES
(1, 'New conversation', '2016-01-06 17:59:36', 0),
(2, 'New conversation', '2016-01-07 10:27:25', 0),
(3, 'New conversation', '2016-01-07 10:50:16', 0),
(4, 'New conversation', '2016-01-07 11:00:32', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `conversation_users`
--

INSERT INTO `conversation_users` (`id`, `conversation_id`, `user_id`, `creation_date`, `user_typing`) VALUES
(1, 1, 1, '2016-01-06 18:55:43', 0),
(2, 1, 2, '2016-01-07 09:19:24', 0),
(3, 2, 3, '2016-01-07 10:27:25', 0),
(4, 2, 1, '2016-01-07 10:27:25', 0),
(5, 3, 5, '2016-01-07 10:54:27', 0),
(6, 3, 4, '2016-01-07 10:54:50', 1),
(7, 4, 4, '2016-01-07 11:01:14', 0),
(8, 4, 1, '2016-01-07 11:16:48', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `followers`
--

CREATE TABLE `followers` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `follow_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `followers`
--

INSERT INTO `followers` (`follow_id`, `user_id`, `friend_id`, `follow_creation_date`) VALUES
(1, 1, 1, '2016-01-04 09:24:07'),
(2, 2, 2, '2016-01-06 17:57:32'),
(3, 2, 1, '2016-01-06 17:58:44'),
(4, 1, 2, '2016-01-06 17:59:15'),
(5, 3, 3, '2016-01-07 08:40:48'),
(6, 3, 1, '2016-01-07 10:27:08'),
(7, 4, 4, '2016-01-07 10:32:23'),
(8, 1, 3, '2016-01-07 10:36:31'),
(9, 1, 4, '2016-01-07 10:36:46'),
(10, 5, 5, '2016-01-07 10:46:47'),
(11, 1, 5, '2016-01-07 11:11:48');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `invites`
--

CREATE TABLE `invites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `community_id` int(11) NOT NULL,
  `accepted` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `invites`
--

INSERT INTO `invites` (`id`, `user_id`, `community_id`, `accepted`) VALUES
(1, 4, 1, '0');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `message_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `seen` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `user_id`, `message`, `message_creation_date`, `seen`) VALUES
(1, 1, 1, 'Whats up!!!!', '2016-01-06 18:58:04', 0),
(2, 1, 1, 'whats up!', '2016-01-06 18:58:04', 0),
(3, 2, 3, 'hey rqch\r\n', '2016-01-07 10:27:47', 0),
(4, 2, 1, 'de kenny ofwa ??', '2016-01-07 10:28:07', 0),
(5, 2, 1, 'hehhehe', '2016-01-07 10:28:41', 0),
(6, 2, 3, 'heyhey', '2016-01-07 10:28:49', 0),
(7, 2, 1, 'jupllaa', '2016-01-07 10:28:51', 0),
(8, 1, 1, 'Heeyy!', '2016-01-07 10:39:35', 1),
(9, 3, 5, 'heey', '2016-01-07 10:50:16', 1),
(10, 3, 4, 'Xoxo', '2016-01-07 10:54:07', 1),
(11, 3, 5, 'hye', '2016-01-07 10:54:19', 1),
(12, 3, 5, 'hye', '2016-01-07 10:54:26', 1),
(13, 3, 4, 'Zet is ne profielfoto cunt', '2016-01-07 10:55:02', 1),
(14, 4, 4, 'HELLO BAE <3', '2016-01-07 11:00:40', 0),
(15, 4, 1, 'Heyyyyyy! <3', '2016-01-07 11:02:12', 0),
(16, 4, 1, 'whats up!', '2016-01-07 11:02:12', 0),
(17, 4, 4, 'You know... Drooplin'' and stuff...', '2016-01-07 11:01:12', 0),
(18, 4, 4, 'you?', '2016-01-07 11:01:16', 0),
(19, 4, 1, 'hahahahhah!', '2016-01-07 11:02:12', 0),
(20, 4, 1, 'adasdasd', '2016-01-07 11:02:12', 0),
(21, 4, 1, 'whats up!!', '2016-01-07 11:16:48', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `item_id`, `notification_type`, `notification_creation_date`, `creator_user_id`, `seen`) VALUES
(1, 1, 0, 2, '2016-01-06 18:49:24', 2, 1),
(2, 2, 0, 3, '2016-01-06 18:53:12', 1, 1),
(3, 1, 5, 0, '2016-01-06 18:54:37', 2, 1),
(4, 1, 4, 0, '2016-01-06 18:54:37', 2, 1),
(5, 1, 3, 0, '2016-01-06 18:54:37', 2, 1),
(6, 1, 2, 0, '2016-01-06 18:54:37', 2, 1),
(7, 2, 5, 6, '2016-01-06 18:56:10', 1, 1),
(8, 2, 4, 6, '2016-01-06 18:57:35', 1, 1),
(9, 1, 0, 2, '2016-01-07 10:36:21', 3, 1),
(10, 3, 0, 3, '2016-01-07 10:36:31', 1, 0),
(11, 4, 0, 2, '2016-01-07 10:53:53', 1, 1),
(12, 4, 1, 4, '2016-01-07 10:59:28', 1, 1),
(13, 5, 0, 2, '2016-01-07 11:11:48', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `offers`
--

CREATE TABLE `offers` (
  `offer_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `offer_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `offers`
--

INSERT INTO `offers` (`offer_id`, `quest_id`, `collection_id`, `offer_creation_date`) VALUES
(1, 5, 1, '2016-01-06 18:52:57'),
(2, 8, 1, '2016-01-07 10:37:37');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `proposals`
--

INSERT INTO `proposals` (`propo_id`, `user_id`, `quest_id`, `collection_id`, `propo_creation_date`) VALUES
(1, 2, 5, 2, '2016-01-06 18:53:53'),
(2, 2, 4, 2, '2016-01-06 18:54:03'),
(3, 2, 3, 2, '2016-01-06 18:54:10'),
(4, 2, 2, 2, '2016-01-06 18:54:16');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `public_quests`
--

CREATE TABLE `public_quests` (
  `id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `public_quests`
--

INSERT INTO `public_quests` (`id`, `quest_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2),
(7, 7, 3),
(8, 8, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `quests`
--

INSERT INTO `quests` (`quest_id`, `item`, `user_id`, `quest_description`, `type`, `creation_date`, `active`, `views`) VALUES
(1, 'Nothing special', 1, 'Really nothing', 0, '2016-01-04 09:25:53', 0, 7),
(2, 'Nothing !', 1, '', 0, '2016-01-06 16:51:57', 1, 2),
(3, 'Nothing special', 1, '', 0, '2016-01-06 16:52:14', 1, 6),
(4, 'asdasdasd', 1, '', 0, '2016-01-06 18:52:33', 1, 4),
(5, '', 1, '', 1, '2016-01-06 18:52:57', 1, 7),
(6, 'Heeyy!', 2, '', 0, '2016-01-06 18:57:50', 1, 17),
(7, 'kenny', 3, '', 0, '2016-01-07 08:43:19', 0, 0),
(8, '', 1, 'Nothing', 1, '2016-01-07 10:37:37', 1, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shares`
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
-- Tabelstructuur voor tabel `users`
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `picture`, `age`, `gender`, `street`, `nr`, `zipcode`, `city`, `country`, `password`, `occupation`, `number`, `status`, `verification`, `description`, `lang`, `latitude`, `longitude`) VALUES
(1, 'rachouan', 'rejeb', 'rachouan_15@hotmail.fr', '6XgWcz2Y1W.jpg', '0000-00-00', 'm', 'Pollarestraat', '117', '9400', 'Ninove', 'BelgiÃ«', 'b563601746289f07b004e5c80cea791b87bfa3b2', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'en', '50.8336386', '4.0188286'),
(2, 'Smurfs', 'Hey', 'thesmurfs@droopl.com', 'gPconeCqyU.jpg', '1993-06-18', 'f', 'Market Street', '8411', '94103', 'San Francisco', 'Verenigde Staten', '3518a3709cae32767b8f519cb72a10bb31c09b6b', 'No occupation', 'No Number', 0, 0, 'No Desciption', 'en', '37.775161', '-122.419082'),
(3, 'Kenny', 'vm', 'kenny_tkb_smurf@hotmail.com', 'NNH71iKJ9r.jpg', '0000-00-00', 'm', 'Dorpstraat', '473', '3061', 'Bertem', 'BelgiÃ«', '148d239a4c68a5dc0dc9cb6a6714b97eb6288b95', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'nl', '50.8644751', '4.6303588'),
(4, 'Bas', 'Vleugels', 'basjevleugels@hotmail.com', 'W26TTRhaMy.jpg', '0000-00-00', 'm', 'Sint-Pietersstraat', '14-42', '3110', 'Rotselaar', 'Belgium', '95e1323a0fe2b48db0a1c07ee9385023946c69cc', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'nl', '50.9536709', '4.7183791'),
(5, 'Jef', 'Vastenavondt', 'jef.vastenavondt@icloud.com', '', '0000-00-00', 'm', 'Quai de l''Industrie', '170', '1070', 'Anderlecht', 'Belgium', 'eea0d65fff59ba749c4f6124ba974958b19a7275', 'No occupation', 'No Number', 0, 1, 'No Desciption', 'nl', '50.8412117', '4.3218139');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_rating`
--

CREATE TABLE `user_rating` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `verified` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `verification`
--

INSERT INTO `verification` (`id`, `user_id`, `code`, `verified`) VALUES
(1, 1, 1034, 1),
(2, 2, 2586, 0),
(3, 3, 6265, 1),
(4, 4, 3891, 1),
(5, 5, 1005, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `accepted_propos`
--
ALTER TABLE `accepted_propos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`),
  ADD KEY `propo_id` (`propo_id`);

--
-- Indexen voor tabel `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`collection_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`creator_id`);

--
-- Indexen voor tabel `community_quests`
--
ALTER TABLE `community_quests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`),
  ADD KEY `quest_id_2` (`quest_id`);

--
-- Indexen voor tabel `community_users`
--
ALTER TABLE `community_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `community_id` (`community_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `completed_quests`
--
ALTER TABLE `completed_quests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indexen voor tabel `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexen voor tabel `conversation_users`
--
ALTER TABLE `conversation_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexen voor tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follow_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexen voor tabel `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indexen voor tabel `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `community_id` (`community_id`);

--
-- Indexen voor tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `quest_id` (`quest_id`),
  ADD KEY `collection_id` (`collection_id`);

--
-- Indexen voor tabel `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`propo_id`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indexen voor tabel `public_quests`
--
ALTER TABLE `public_quests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quest_id` (`quest_id`);

--
-- Indexen voor tabel `quests`
--
ALTER TABLE `quests`
  ADD PRIMARY KEY (`quest_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`share_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quest_id` (`quest_id`);

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
-- Indexen voor tabel `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `accepted_propos`
--
ALTER TABLE `accepted_propos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `collection`
--
ALTER TABLE `collection`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `communities`
--
ALTER TABLE `communities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `community_quests`
--
ALTER TABLE `community_quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `community_users`
--
ALTER TABLE `community_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `completed_quests`
--
ALTER TABLE `completed_quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `conversation`
--
ALTER TABLE `conversation`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `conversation_users`
--
ALTER TABLE `conversation_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `followers`
--
ALTER TABLE `followers`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT voor een tabel `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `invites`
--
ALTER TABLE `invites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT voor een tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT voor een tabel `offers`
--
ALTER TABLE `offers`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `proposals`
--
ALTER TABLE `proposals`
  MODIFY `propo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT voor een tabel `public_quests`
--
ALTER TABLE `public_quests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `quests`
--
ALTER TABLE `quests`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT voor een tabel `shares`
--
ALTER TABLE `shares`
  MODIFY `share_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `user_rating`
--
ALTER TABLE `user_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `accepted_propos`
--
ALTER TABLE `accepted_propos`
  ADD CONSTRAINT `proposals` FOREIGN KEY (`propo_id`) REFERENCES `proposals` (`propo_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `user_collection` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `community_quests`
--
ALTER TABLE `community_quests`
  ADD CONSTRAINT `community_quests` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`quest_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `community_users`
--
ALTER TABLE `community_users`
  ADD CONSTRAINT `community_users` FOREIGN KEY (`community_id`) REFERENCES `communities` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `comu` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `completed_quests`
--
ALTER TABLE `completed_quests`
  ADD CONSTRAINT `completed` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`quest_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `conversation_users`
--
ALTER TABLE `conversation_users`
  ADD CONSTRAINT `conversation_users_id` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`conversation_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `follower` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `following` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `invites`
--
ALTER TABLE `invites`
  ADD CONSTRAINT `community_invitation` FOREIGN KEY (`community_id`) REFERENCES `communities` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_invitation` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `message_ conversation` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`conversation_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_messages` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notification_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `collection_item` FOREIGN KEY (`collection_id`) REFERENCES `collection` (`collection_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quest_offer` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`quest_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposal_quest_id` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`quest_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `public_quests`
--
ALTER TABLE `public_quests`
  ADD CONSTRAINT `public_quest_id` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`quest_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `quests`
--
ALTER TABLE `quests`
  ADD CONSTRAINT `quest_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `quest_share` FOREIGN KEY (`quest_id`) REFERENCES `quests` (`quest_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `quest_share_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `verification`
--
ALTER TABLE `verification`
  ADD CONSTRAINT `user_verification` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
