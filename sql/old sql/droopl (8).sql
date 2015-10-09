-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 27 Septembre 2015 à 20:03
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `droopl`
--

-- --------------------------------------------------------

--
-- Structure de la table `collection`
--

CREATE TABLE `collection` (
`collection_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `collection_image` varchar(255) NOT NULL,
  `collection_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `collection`
--

INSERT INTO `collection` (`collection_id`, `item_name`, `user_id`, `description`, `collection_image`, `collection_creation_date`, `status`) VALUES
(1, 'Reflex camera', 1, 'Dit is een gibson gitaar dat ik heb aangemaakt', 'canon-reflex.png', '2015-09-24 19:41:20', 0),
(2, 'Cleaner', 1, 'To clean stuff with.', 'cleaner.jpg', '2015-09-25 13:04:53', 1),
(3, 'Disqueuse', 1, 'Disqueuse', 'disqueuse.png', '2015-09-25 13:03:08', 0),
(4, 'Dolce gusto', 1, 'I like coffee.', 'dolce-gusto.png', '2015-09-25 16:21:02', 0),
(5, 'Reflex camera', 2, 'Dit is een gibson gitaar dat ik heb aangemaakt', 'canon-reflex.png', '2015-09-27 13:52:57', 0),
(6, 'Cleaner', 2, 'To clean stuff with.', 'cleaner.jpg', '2015-09-27 13:52:57', 1),
(7, 'Disqueuse', 2, 'Disqueuse', 'disqueuse.png', '2015-09-27 13:52:57', 0),
(8, 'Dolce gusto', 2, 'I like coffee.', 'dolce-gusto.png', '2015-09-27 13:52:57', 0),
(12, 'lamp', 2, '64 watt', 'ed2FgZgCSV.jpeg', '2015-09-27 16:32:43', 0),
(13, 'schep', 2, '', 'kDt0l4tY0i.jpeg', '2015-09-27 16:41:28', 0),
(14, 'fixie', 2, '', 'dOYwxskA51.png', '2015-09-27 16:42:17', 0),
(15, 'nike janoski max', 2, 'size EU43', 'WGLheEtnUl.png', '2015-09-27 17:05:41', 0);

-- --------------------------------------------------------

--
-- Structure de la table `followers`
--

CREATE TABLE `followers` (
`follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `follow_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `followers`
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
(61, 5, 5, '2015-09-07 12:16:19'),
(63, 2, 2, '2015-09-12 12:36:11'),
(64, 1, 2, '2015-09-12 13:17:04'),
(65, 1, 1, '2015-09-21 12:23:36'),
(70, 2, 1, '2015-09-24 20:46:33');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
`id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `images`
--

INSERT INTO `images` (`id`, `quest_id`, `image_url`, `creation_date`) VALUES
(23, 178, 'rkDulUDY12.jpeg', '2015-09-08 13:33:45'),
(24, 179, 'GusZ0PR9rR.jpeg', '2015-09-10 12:58:54'),
(25, 113, 'Xp6zVVg6Dk.jpeg', '2015-09-12 11:37:16'),
(26, 114, 'nlo5gS7ad3.jpeg', '2015-09-12 12:23:56'),
(27, 115, 'wruZPT57r3.jpeg', '2015-09-12 12:24:08'),
(28, 118, 'H7yjsW4OpG.jpeg', '2015-09-12 12:36:06');

-- --------------------------------------------------------

--
-- Structure de la table `proposals`
--

CREATE TABLE `proposals` (
`propo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `propo_creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `proposals`
--

INSERT INTO `proposals` (`propo_id`, `user_id`, `quest_id`, `collection_id`, `propo_creation_date`) VALUES
(1, 1, 1, 1, '2015-08-29 08:10:10'),
(2, 1, 1, 1, '2015-08-29 08:10:20');

-- --------------------------------------------------------

--
-- Structure de la table `quests`
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
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `quests`
--

INSERT INTO `quests` (`quest_id`, `item`, `user_id`, `quest_description`, `type`, `creation_date`, `active`, `views`) VALUES
(1, 'Reflex Camera', 1, 'For an assingment for the avengers I am in great need of a camera Prefarbly a reflex \r\ncamera. I need to be able to take beautifull High quality pictures like ', 0, '2015-08-24 08:16:28', 0, 1),
(2, 'Speaker', 1, 'I am throwing a party and I am in need of a great speaker to liven op the party. \r\nMy qoutas are\r\n\r\n1. Great sound\r\n2. Nice bass\r\n3. Great Quality', 0, '2015-08-24 08:40:52', 0, 1),
(73, 'Beats headphones', 1, 'I just need them for myself , I hate everybody else', 0, '2015-08-24 12:01:04', 1, 0),
(74, 'Asus laptop', 1, 'I''m really in need of a good pc , and I have some really nice items that I can trade you for it. just send me a proposal if you can ! cheers !', 0, '2015-08-24 12:02:59', 1, 0),
(106, 'a Life', 1, 'I am tired of studying so I''m looking for a life !', 0, '2015-08-25 18:33:57', 1, 0),
(107, 'For nothing', 2, 'This is my first post', 0, '2015-08-31 15:30:16', 1, 6),
(108, 'Skateboard', 1, 'Because I need one', 0, '2015-09-06 13:41:34', 1, 0),
(109, 'Chips', 3, 'I''m sooo hungry and I need to have food ! thanks !', 0, '2015-09-06 21:05:37', 1, 1),
(110, 'Scheenlappen', 4, 'Ik ga vanaf morgen terug voetbal training volgen dus ik heb scheenlappen nodig', 0, '2015-09-07 11:02:06', 1, 0),
(111, 'Iphone 6', 1, 'I''m really in need of an iphone can anyone help me', 0, '2015-09-07 11:08:39', 1, 2),
(112, 'A used condom', 1, 'with some sick ass jizz in them', 1, '2015-09-07 20:54:52', 1, 0),
(114, 'boormachine ', 1, 'ik zoek een boor mzchine', 0, '2015-09-12 12:23:56', 1, 0),
(115, 'sdqsd', 1, 'qsdqsdqsd', 0, '2015-09-12 12:24:08', 1, 2),
(116, 'qdqsd', 1, 'qsdqsdqsd', 0, '2015-09-12 12:24:16', 1, 0),
(117, 'Gitaar', 1, 'Ik wil het gewoon niet meer', 0, '2015-09-12 12:25:07', 1, 8),
(118, 'balblabeaz', 2, 'qsdqsdqsd', 0, '2015-09-12 12:36:06', 1, 22);

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
  `lang` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `picture`, `age`, `street`, `nr`, `zipcode`, `city`, `password`, `occupation`, `number`, `status`, `verification`, `description`, `lang`) VALUES
(1, 'Rachouan', 'Rejeb', 'rachouanrejeb@droopl.com', 'rachouanrejeb.jpg', '1993-06-18', 'Pollarestraat', '117', '9400', 'Ninove', 'Haithem18+', 'Shareholder at Droopl', '0475/49.41.99', 0, 0, 'Heey my name is Rachouan I''m the one who developed the Droopl website.', 'fr'),
(2, 'Boris', 'Debusscher', 'borisdebusscher@droopl.com', 'boris.jpg', '1996-11-21', 'Rue de bobo', '12', '8439', 'Louvain-La-Neuve', 'test', 'Employe at droopl', '0475494199', 0, 0, 'enchanté', 'fr'),
(3, 'Ferielle', 'zagnoun', 'ferielle.zagnoun@hotmail.com', 'ferielle.jpg', '1999-06-20', '', '', '', '', 'test', 'Student', '', 0, 0, 'Ik ben ferielle en ik ben heel lelijk !', 'nl'),
(4, 'Wael', 'Zagnoun', 'waelzagnoun@hotmail.com', 'waelzagnoun.jpg', '1996-10-04', 'Botermelkstraat', '9', '9400', 'Appelterre-eichem', 'test', 'Lawyer', '0475434549', 0, 0, 'I''m wael , and I love rachouan', 'nl'),
(5, 'Manu', 'Minne', 'manu.minne@droopl.com', 'manuminne.jpg', '2015-09-08', '', '', '', '', 'test', 'Droopl co-owner', '0475647464', 0, 0, 'Check mijn armen :p', 'nl'),
(6, 'Mourad', 'Taiebi', 'mourad.taiebi@droopl.com', 'mouradtaiebi.jpg', '2015-09-22', '', '', '', '', 'test', 'Droopl co-owner', '0465363746', 0, 0, 'IN-D-STRUCT-IBLE', 'nl'),
(7, 'Daniël', 'Yikik', 'daniel.yikik@droopl.com', 'danielyikik.jpg', '2015-09-14', '', '', '', '', 'test', 'Droopl co-owner', '0437347346', 0, 0, 'Everybody''s Cool, But Y''all Just Ain''t Me', 'nl');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `collection`
--
ALTER TABLE `collection`
 ADD PRIMARY KEY (`collection_id`);

--
-- Index pour la table `followers`
--
ALTER TABLE `followers`
 ADD PRIMARY KEY (`follow_id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `proposals`
--
ALTER TABLE `proposals`
 ADD PRIMARY KEY (`propo_id`);

--
-- Index pour la table `quests`
--
ALTER TABLE `quests`
 ADD PRIMARY KEY (`quest_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `collection`
--
ALTER TABLE `collection`
MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `followers`
--
ALTER TABLE `followers`
MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `proposals`
--
ALTER TABLE `proposals`
MODIFY `propo_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `quests`
--
ALTER TABLE `quests`
MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
