-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 04 fév. 2020 à 22:01
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet5oc`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Non classé', 'Articles non classés'),
(2, 'Divers', 'Autres formations'),
(36, 'Parcours PHP/Symfony', 'Formation dispensée par Openclassrooms délivrant un diplôme bac +3');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `validated` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date_creation`, `post_id`, `user_id`, `validated`) VALUES
(1, 'Deuxieme commentaire !', '2019-12-04 16:00:00', 1, 4, 1),
(3, 'commenatair 3', '2019-12-07 11:00:00', 1, 3, 1),
(4, 'pemier commentaire', '2019-12-02 11:00:00', 1, 4, 1),
(6, 'un autre commentaire non validé', '2019-12-11 22:13:54', 3, 1, 1),
(15, 'tres interessant ', '2019-12-12 14:39:33', 3, 1, 1),
(16, 'Rien de bien onteressant dans cette discution ', '2019-12-12 14:39:59', 1, 1, 1),
(17, 'Je vais eleve le niveau ...', '2019-12-12 14:40:13', 1, 1, 1),
(18, 'Wordpress, jumla ou from scratch ????', '2019-12-12 14:40:26', 1, 1, 1),
(19, 'scratch c\'est bien comme langage, je choisie scratch !!!', '2019-12-12 14:41:00', 1, 4, 1),
(20, 'comme sael', '2019-12-12 14:41:19', 1, 3, 1),
(21, 'Moi je comprends rien', '2019-12-12 14:41:37', 1, 2, 1),
(22, 'je t\'expliquerai', '2019-12-12 14:41:54', 1, 1, 1),
(33, 'test com phpmyadmin', '2020-01-27 10:05:43', 2, 1, 1),
(34, 'ytyutyu', '2020-01-27 10:39:29', 2, 1, 1),
(35, 'ghgfhjfhgj', '2020-01-27 10:40:13', 2, 1, 1),
(36, 'retreztre', '2020-01-27 10:41:02', 2, 1, 1),
(37, 'yttyu', '2020-01-27 10:42:01', 2, 1, 1),
(58, 'aezrazer', '2020-01-28 17:51:15', 1, 1, 1),
(86, 'pas faux', '2020-01-31 17:57:53', 3, 1, 1),
(90, 'rereret', '2020-01-31 17:58:56', 3, 4, NULL),
(92, 'modification test', '2020-01-31 17:59:07', 14, 4, 1),
(93, 'reertret', '2020-01-31 17:59:10', 14, 4, NULL),
(96, 'ertertertre', '2020-01-31 17:59:26', 2, 4, NULL),
(97, 'reretertert', '2020-01-31 17:59:29', 2, 4, NULL),
(98, 'ggrtg', '2020-02-03 22:05:00', 14, 1, 1),
(99, 'rezrez', '2020-02-03 22:05:31', 14, 1, 1),
(100, 'rterty', '2020-02-03 22:06:36', 14, 1, 1),
(101, 'ertg', '2020-02-03 22:07:35', 14, 1, 1),
(102, 'rtgrt', '2020-02-03 22:08:31', 14, 1, 1),
(103, 'rtyerty', '2020-02-03 22:10:49', 14, 1, 1),
(105, 'test commentaire', '2020-02-04 10:15:17', 3, 1, 1),
(106, 'test commentaire maintenant validé', '2020-02-04 10:17:26', 14, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `form_contact`
--

DROP TABLE IF EXISTS `form_contact`;
CREATE TABLE IF NOT EXISTS `form_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date_submission` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alreadyRead` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `form_contact`
--

INSERT INTO `form_contact` (`id`, `first_name`, `last_name`, `email`, `subject`, `content`, `user_id`, `date_submission`, `alreadyRead`) VALUES
(4, 'Sael', 'ghastine', 'sael@SAel.fr', 'petit test forumlaire', 'I am trying to conditionally style user-to-user messages on my site based on the following:\r\n\r\nIf the user has not yet accessed the message, it remains bold (\"unread\"). If the user clicks the link and accesses it, it goes from bold to unbold (\"read\")\r\n\r\n(reference: this is how many email inboxes work)\r\n\r\nQuestion: How would I check if the user has clicked on the link to view their new message, or if they have not? As in, how would I store this information and indicate that it has been \"read\"?', 4, '2019-12-11 10:00:00', 'X'),
(6, 'Olivier', 'Rentz', 'olivier@rentz.fr', 'Creation d\'un site web', 'Un site web pour 15€, c\'est possible ?', NULL, '2019-12-11 11:00:00', 'X'),
(7, 'camile', 'ghjd', 'camileghastine@hotmail.com', 'test', 'hqskdhqs', NULL, '2020-01-15 13:49:26', 'X');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `chapo` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP,
  `category_id` tinyint(4) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `chapo`, `content`, `date_creation`, `date_modification`, `category_id`, `user_id`) VALUES
(1, 'Projet 2 : Créer un site avec Wordpress', 'Wordpress', 'Maitrise de Wordpress, HTML et CSS .', '2019-12-03 21:05:22', '2019-12-12 09:57:57', 36, 1),
(2, 'Projet 1: Stratégie d\'apprentissage', 'STratégie d\'apprentissage, CV et lien vers linkedIn et Github', 'Mise en place de la stratégie d\'apprentissage, Rédaction du CV, création d\'un compte linkedin', '2019-12-03 08:00:00', '2019-12-03 08:00:00', 36, 1),
(3, 'Référencement web', 'Les clefs pour réussir son référencement', 'Web\r\nLe web porte l’objectif de développement des entreprises. Toutes les campagnes de communication passent aujourd’hui par le web (même partiellement).\r\n\r\nDeux objectifs du web :\r\n•	Attirer les prospects (faire du trafic)\r\n•	Mais le plus important est de convertir les prospects (vente, formulaire, téléchargement, etc.)\r\n\r\nMarketing : segmenter pour adapter le dispositif au marché\r\n\r\n3 types de visiteurs sur internet :\r\n•	Visiteurs qui cherchent : c’est le référencement qui attire ces visiteurs\r\n•	Visiteurs qui participent : s’intégrer dans les communautés qui concerne notre domaine (Facebook, twitter, etc.) et prouver notre expertise au sein de cette communauté pour proposer nos services.\r\n•	Visiteurs qui surfent : ces visiteurs doivent être touché par des bandeaux pubs pour éveiller leur intérêt et qu’il s’adresse à nous le jour où ils en auront besoin.\r\n\r\nDispositif webmarketing complet\r\nDispositif web pour créer une présence sur le web dans le cadre d’objectif déterminés.\r\nOn va devoir s’adresser aux trois types de visiteurs :\r\n•	Ceux qui cherchent en travaillant sur le référencement\r\n•	Ceux qui participent en faisant du Community management (travail sur les réseaux sociaux : veille, publication de contenu, animation de communauté)\r\n•	Ceux qui surfent en faisant des bandeaux pub, du mailing et du « print » réel (4 par 3, flyers, etc.)\r\n\r\nCe cours portera sur la partie référencement et plus précisément sur la partie référencement naturel.\r\n', '2019-12-05 09:00:00', '2019-12-05 09:00:00', 2, 1),
(14, 'article test 2', 'chapo test', '<p>You can use the mark tag to <mark>highlight</mark> text.</p>\r\n<p><del>This line of text is meant to be treated as deleted text.</del></p>\r\n<p><s>This line of text is meant to be treated as no longer accurate.</s></p>\r\n<p><ins>This line of text is meant to be treated as an addition to the document.</ins></p>\r\n<p><u>This line of text will render as underlined</u></p>\r\n<p><small>This line of text is meant to be treated as fine print.</small></p>\r\n<p><strong>This line rendered as bold text.</strong></p>\r\n<p><em>This line rendered as italicized text.</em></p>\r\n\r\n.mark and .small classes are also available to apply the same styles as <mark> and <small> while avoiding any unwanted semantic implications that the tags would bring.\r\n\r\nWhile not shown above, feel free to use <b> and <i> in HTML5. <b> is meant to highlight words or phrases without conveying additional importance while <i> is mostly for voice, technical terms, etc.\r\nText utilities\r\n\r\nChange text alignment, transform, style, weight, and color with our text utilities and color utilities.\r\nAbbreviations\r\n\r\nStylized implementation of HTML’s <abbr> element for abbreviations and acronyms to show the expanded version on hover. Abbreviations have a default underline and gain a help cursor to provide additional context on hover and to users of assistive technologies.\r\n\r\nAdd .initialism to an abbreviation for a slightly smaller font-size.', '2020-01-31 14:15:48', '2020-01-31 14:15:48', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `statut` varchar(10) NOT NULL DEFAULT 'user',
  `pass` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `validated` tinyint(4) DEFAULT NULL,
  `try` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `statut`, `pass`, `date_inscription`, `validated`, `try`) VALUES
(1, 'camile', 'camileghastine@hotmail.com', 'admin', '$2y$10$7s2mOmm/urAsjsCwo0vNkumJ.aRecfiwNCvQszafaP72fgCmt48ty', '2019-12-09 09:00:00', 1, 0),
(2, 'ninel', 'ninel@ninel.fr', 'user', '$2y$10$BBL2hAvsE2muvGpQ9F9T/.IPBhKHo7sXX8wsvvCI7IdOAar5KPdZS', '2019-12-10 10:00:00', 1, 0),
(3, 'loann', 'loann@loann.fr', 'user', '$2y$10$E1XGxrwmWlRAVIisgD3TdOvx6cTy2/jJfiSjCV.innWU3t8WSolbG', '2019-12-11 08:00:00', 1, 0),
(4, 'saël', 'sael@sael.fr', 'user', '$2y$10$OtuH.6/wKlapy3WRxRQRu.hoHXOGA1KQMI.H8v/vv.XZ7sDy8qwGy', '2019-12-11 10:00:00', 1, 0),
(68, 'roger', 'roger@roger.fr', 'user', '$2y$10$QNvlluZh8hCYkcldqjvdAu4S/9RBNgwU9O9O9NQPv7jOl35Oo2L/y', '2020-01-30 16:20:52', 1, 1),
(75, 'jean charles', 'jc@jc.fr', 'user', '$2y$10$qCDbZaBLCtEKXPqGYtWB/.iv/xRXkj6YvUhqSrcrRPlsHgSduhWUW', '2020-02-02 23:19:09', NULL, 0),
(76, 'benoit', 'benoit@chien.fr', 'user', '$2y$10$lQEQu/.Kv.HlISfbuvLnHepAnZ5zo1DWDEZ85NPW4Uc4BeHwM56YO', '2020-02-02 23:19:34', NULL, 0),
(77, 'tratlala', 'dsfsdf@dsfds.fr', 'user', '$2y$10$Jme1ybo1Ilp.mW6vyGgece0qIENumtHxDYYSuS79n7YXG6n9WR2Kq', '2020-02-04 10:16:33', 1, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
