-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 13 fév. 2020 à 08:40
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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Non classé', 'Articles non classés'),
(2, 'Développement numérique', 'Référencement, sécurité,  outils, image numérique, etc.'),
(36, 'PHP/Symfony', 'Formation avec Openclassrooms délivrant un diplôme de développeur PHP/Symfony de niveau 6 (bac +3/4).'),
(45, 'Général', 'Compétences généralistes dans d\'autres domaines que le développement numérique.');

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
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date_creation`, `post_id`, `user_id`, `validated`) VALUES
(145, 'Bonne chance pour ta reconversion !', '2020-02-12 17:39:56', 2, 3, 1),
(146, 'Bon courage !', '2020-02-12 17:40:26', 2, 4, 1),
(147, 'Bon travail !', '2020-02-12 17:40:53', 2, 5, 1),
(148, 'Merci pour vos encouragements, je suis plus motivé que jamais.', '2020-02-12 17:41:19', 2, 1, 1),
(149, 'C\'est chouette pour une première réalisation.', '2020-02-12 17:42:36', 1, 5, 1),
(150, 'Merci, mais faut bien avouer que les chalets en vente sont plus sympa que le site ;-)', '2020-02-12 17:43:17', 1, 1, 1),
(151, 'Moi j’achète celui pret du lac !!!', '2020-02-12 17:43:51', 1, 3, 1),
(152, 'très jolie !', '2020-02-12 17:45:50', 14, 3, 1),
(153, 'SUPER !!!', '2020-02-12 17:46:16', 14, 4, 1),
(154, 'merci,\r\nJe suis content du résultat \r\n:-)', '2020-02-12 17:46:52', 14, 1, 1),
(155, 'Tu peux', '2020-02-12 17:48:53', 14, 4, 1),
(156, 'Y-a-pas de site cette fois ?\r\n', '2020-02-12 17:52:34', 25, 5, 1),
(157, 'He non !', '2020-02-12 17:52:51', 25, 1, 1),
(158, 'Ca avance ton blog ?', '2020-02-12 17:58:59', 27, 3, 1),
(159, 'Doucement, mais surement ...', '2020-02-12 17:59:28', 27, 1, 1),
(160, 'Alors ta soutenance s\'est bien passée ?', '2020-02-12 17:59:52', 27, 3, NULL),
(161, 'Tu lances dans la musique finalement ?', '2020-02-12 18:00:26', 28, 5, NULL),
(162, 'LOL :-D', '2020-02-12 18:00:50', 28, 4, NULL),
(163, 'Ca fait peur :-p', '2020-02-12 21:28:53', 26, 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `form_contacts`
--

DROP TABLE IF EXISTS `form_contacts`;
CREATE TABLE IF NOT EXISTS `form_contacts` (
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `form_contacts`
--

INSERT INTO `form_contacts` (`id`, `first_name`, `last_name`, `email`, `subject`, `content`, `user_id`, `date_submission`, `alreadyRead`) VALUES
(4, 'Sael', 'ghastine', 'sael@SAel.fr', 'petit test forumlaire', 'I am trying to conditionally style user-to-user messages on my site based on the following:\r\n\r\nIf the user has not yet accessed the message, it remains bold (\"unread\"). If the user clicks the link and accesses it, it goes from bold to unbold (\"read\")\r\n\r\n(reference: this is how many email inboxes work)\r\n\r\nQuestion: How would I check if the user has clicked on the link to view their new message, or if they have not? As in, how would I store this information and indicate that it has been \"read\"?', 4, '2019-12-11 10:00:00', 'X'),
(6, 'Olivier', 'Rentz', 'olivier@rentz.fr', 'Creation d\'un site web', 'Un site web pour 15€, c\'est possible ?', NULL, '2019-12-11 11:00:00', 'X'),
(11, 'fzfd', 'sdqfdqsf', 'dqsfdqsf@gjgj.fr', 'dfsqdqsf', 'dqsdfsdsfq', 1, '2020-02-06 20:27:22', NULL),
(12, 'fzfd', 'sdqfdqsf', 'dqsfdqsf@gjgj.fr', 'dfsqdqsf', 'dqsdfsdsfq', 1, '2020-02-06 20:51:52', NULL),
(13, 'fzfd', 'sdqfdqsf', 'dqsfdqsf@gjgj.fr', 'dfsqdqsf', 'dqsdfsdsfq', 1, '2020-02-06 20:52:51', NULL),
(14, 'camile', 'ghastine', 'camileghastine@hotmail.com', 'test phpmailer', 'alors ca marche ?', 1, '2020-02-06 20:56:57', NULL),
(15, 'camile', 'ghastine', 'camileghastine@hotmail.com', 'test', 'gjdsgfjsdgfj', 3, '2020-02-08 08:02:30', NULL),
(16, 'dffds', 'dqsfsdqf', 'camileghastine@hotmail.com', 'dsfqqsdf', 'dqsfqsdfqsdf', 1, '2020-02-11 21:38:26', NULL),
(17, 'dffds', 'dqsfsdqf', 'camileghastine@hotmail.com', 'dsfqqsdf', 'dqsfqsdfqsdf', 1, '2020-02-11 21:39:31', NULL),
(18, 'dffds', 'dqsfsdqf', 'camileghastine@hotmail.com', 'dsfqqsdf', 'dqsfqsdfqsdf', 1, '2020-02-11 21:39:44', NULL),
(19, 'dffds', 'dqsfsdqf', 'camileghastine@hotmail.com', 'dsfqqsdf', 'dqsfqsdfqsdf', 1, '2020-02-11 21:41:20', NULL),
(20, 'dffds', 'dqsfsdqf', 'camileghastine@hotmail.com', 'dsfqqsdf', 'dqsfqsdfqsdf', 1, '2020-02-11 21:41:46', NULL),
(21, 'bcndfg', 'xcbxcvbx', 'camileghastine@hotmail.com', 'dfdqsfdqs', 'qdsfqdsfdqsf', 2, '2020-02-11 21:56:12', NULL),
(22, 'dfqsqsdf', 'dqsfqsd', 'dqsfqsdf@dqsfqsdf.fr', 'kjmlkml', 'hgfdgfh', 2, '2020-02-11 21:56:54', NULL),
(23, 'sfsdf', 'qsdfqsdf', 'camileghastine@hotmail.com', 'dfsgdgfs', 'sdfgsdfg', 2, '2020-02-11 21:58:09', NULL),
(24, 'camile', 'ghastine', 'camileghastine@hotmail.com', 'etes vous le meilleur ?', 'J\'ai besaoin €d\'un site. Je vous paye 1 millions ', 2, '2020-02-12 19:37:54', NULL),
(25, 'ghkjgkj', 'ghkghkj', 'camileghastine@hotmail.com', 'jhghfj', 'gfhjghfj', 1, '2020-02-12 21:16:59', NULL),
(26, 'test mdp', 'rtyuj', 'camileghastine@hotmail.com', 'ghfdfgh', 'dfghdfgh', 1, '2020-02-12 21:18:16', NULL),
(27, 'ezraezr', 'raezazeraez', 'camileghastine@hotmail.com', 'tes456', 'fqdsfqsdf', 1, '2020-02-12 21:43:26', NULL),
(28, 'rtyyer', 'yeryretyretyrey', 'eryertyery@retyretyy.hy', 'dsfgsdfg', 'dsfgsdfgsdfgdsfgdf', 1, '2020-02-12 21:51:37', NULL),
(29, 'rtyyer', 'yeryretyretyrey', 'eryertyery@retyretyy.hy', 'dsfgsdfg', 'dsfgsdfgsdfgdsfgdf', 1, '2020-02-12 21:52:13', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `chapo`, `content`, `date_creation`, `date_modification`, `category_id`, `user_id`) VALUES
(1, 'WordPress', 'Projet 2 : Intégrer un thème WordPress pour un client', 'Création d\'un site avec WordPress : <a href=\"https://wp.ghastine.com/\"><img style=\"width: 20%; height: 20%;\" src=\"img/perso/chalet&caviar.png\"></a>\r\n\r\nRédaction d\'un <a href=\"img/perso/guideUtilisateur.pdf\">guide utilisateur</a> du site à usage du client.\r\n\r\nMaitrise de HTML 5 et CSS 3.\r\n\r\n<U>Certificats :</U>\r\n<a href=\"#\">Apprendre à créer un site web avec HTML5 et CSS3</a>\r\n<a href=\"#\">Découvrir les solutions CMS</a>\r\n<a href=\"#\">Créer un site moderne et professionnel avec WordPress 5</a>', '2019-12-03 21:05:22', '2019-12-12 09:57:57', 36, 1),
(2, 'Mise en place de ma stratégie d\'apprentissage', 'Projet 1 : planification de mon calendrier de formation, mise à jour ou création de mon CV et des comptes linkedIn et Github.', 'Mon CV : <a href=\"doc/cv.pdf\"><img style=\"width: 5%; height: 45%;\" src=\"img/home/cv.jpg\"></a>\r\n\r\nProfil LinkedIn : <a class=\"col col-sm-1 btn\" href=\"https://www.linkedin.com/in/camile-ghastine/\" target=\"_blank\"><img style=\"width: 100%; height: 100%;\" src=\"img/default/linkedIn.png\" id=\"icon\"></a>\r\n\r\nCompte GitHub : <a class=\"col col-sm-1 btn\" href=\"https://github.com/CamileGhastine\" target=\"_blank\"><img style=\"width: 100%; height: 100%;\" src=\"img/default/github.png\" id=\"icon\"></a>', '2019-12-03 08:00:00', '2019-12-03 08:00:00', 36, 1),
(3, 'Javascript', 'Toutes les bases de javascript et introduction à JQuery', '<U>Certificats :</U>\r\n<a href=\"#\">Apprendre à coder avec Javascript</a>\r\n<a href=\"#\">Créer des pages web interactives avec Javascript</a>\r\n<a href=\"#\">Introduction à JQuery</a>', '2019-12-05 09:00:00', '2019-12-05 09:00:00', 2, 1),
(14, 'Réalisation d\'un cahier des charges et intégration d\'une maquette', 'Projet 3 : Analyse des besoins du client pour son festival du film', 'Création d\'un site avec Bootstrap 4 : <a href=\"https://boot.ghastine.com/\"><img style=\"width: 30%; height: 50%;\" src=\"img/perso/festivalDuFilm.png\"></a>\r\n\r\nRéalisatation d\'un <a href=\"img/perso/cahierDesCharges.pdf\">cahier des charges</a> : \r\n- Cadre du projet\r\n- Spécification techniques et fonctionnelles\r\n- Conception graphique (brief créatif, charte graphique et wireframes).\r\n\r\n<U>Certificats :</U>\r\n<a href=\"#\">Boostrap</a>\r\n<a href=\"#\">Découper et intégrer une maquette</a>', '2020-01-31 14:15:48', '2020-01-31 14:15:48', 36, 1),
(21, 'Le référencement web', 'Toutes les clefs pour réussir son référencement web', '<U>Certificat :</U>\r\n<a href=\"#\">Le référencement web</a>', '2020-02-09 22:31:11', '2020-02-09 22:31:11', 2, 1),
(23, 'GitHub', 'Utilisation de GitHUb pour versionner mes codes', '<U>Certificats :</U>\r\n<a href=\"#\">Apprendre à utiliser la ligne de commande</a>\r\n<a href=\"#\">Gérer un code avec GitHub</a>\r\n<a href=\"#\">Utiliser Git et GitHub pour des projets de développement</a>', '2020-02-12 14:06:03', '2020-02-12 14:06:03', 2, 1),
(24, 'Gestion de projet numérique', 'Principes et applications des différents types de gestion de projets (en cascade, agile, etc.)', '<U>Certificats :</U>\r\n<a href=\"#\">Gérer un projet informatique facilement</a>\r\n<a href=\"#\">Gérer un projet numérique avec une méthodologie en cascade</a>', '2020-02-12 14:06:16', '2020-02-12 14:06:16', 2, 1),
(25, 'Conception de l\'architecture d\'une base de données avec UML et MySQL', 'Projet 4 : Concevoir la solution technique d\'une application de restauration en ligne', 'Réalisation d\'un document présentant la <a href=\"img/perso/conceptionTechnique.pdf\">conception technique</a> de l\'application :\r\n- Cas d\'utilisation (diagrammes des cas d\'utilisation, fiches descriptives et diagrammes de séquences)\r\n- Diagramme de classes\r\n- Modèle physique de données\r\n\r\n<U>Certificats :</U>\r\n<a href=\"#\">Analyse locielle avec UML</a>\r\n<a href=\"#\">Modéliser et implémenter une base de données relationnelles avec UML</a>', '2020-02-12 16:52:20', '2020-02-12 16:52:20', 36, 1),
(26, 'Sécurité informatique', 'Les différents types de failles web et les techniques pour s\'en protéger', '<U>Failles :</U>\r\n- XSS\r\n- Include\r\n- Upload\r\n- Injection SQL\r\n- CSRF\r\n- CRLF\r\n- Attaque par force brute\r\n- Variables de session\r\n- Buffer Overflow\r\n- Protection des données\r\n- Captcha\r\n- Protection des mots de passe\r\n- Protection des répertoires\r\n- Etc.\r\n\r\n<U>Certificat :</U>\r\n<a href=\"#\">Protection efficace contre les failles web</a>', '2020-02-12 16:56:08', '2020-02-12 16:56:08', 2, 1),
(27, 'PHP programmation orienté objet', 'Projet 5 : Créer un blog en PHP en orienté objet', '- Création d\'<a href=\"https://github.com/CamileGhastine/BlogOC5/issues\">issues</a> sur GitHub pour planifier les tâches à effectuer\r\n- <a href=\"#\">Diagramme UML</a> et <a href=\"#\">modèle physique de données</a> de l\'application\r\n- Utilisation de librairies externes (auto-loader et gestion des mails) intégrées grâce à composer.\r\n- Toutes les autres fonctionnalités ont été codées maison en programmation orienté objet (routeur, vérification poussée des formulaires, protection par mot de passe, pagination etc.) sans injection de dépendance\r\n- Protection contre les failles de sécurité (XSS, injection SQL, CSRF, hijacking, etc.)\r\n- Code versionné sur <a href=\"https://github.com/CamileGhastine/BlogOC5\">GitHub</a>\r\n- Suivi de code sur <a href=\"https://codeclimate.com/github/CamileGhastine/BlogOC5\">CodeClimat</a>\r\n- Déploiement du <a href=\"http://blog.ghastine.com\">blog</a>\r\n\r\n<U>Certificats :</U>\r\n<a href=\"#\">Concevoir un site web en PHP et MySQL</a>\r\n<a href=\"#\">Adopter une architecture MVC en PHP</a>\r\n<a href=\"#\">Programmer en orienté objet</a>\r\n<a href=\"#\">Administrer les bases de données avec MySQL</a>\r\n\r\n', '2020-02-12 17:27:05', '2020-02-12 17:27:05', 36, 1),
(28, 'Framework Symfony', 'Projet 6 : Développer un site communautaire avec Symfony', 'En cours ...', '2020-02-12 17:32:15', '2020-02-12 17:32:15', 36, 1),
(29, 'Images numériques', 'Retouche photo et monatge vidéo numérique', 'Bonne Maitrise des produits Adobe :\r\n- Photoshop\r\n- Première\r\n- After effects)', '2019-12-02 18:14:09', '2020-02-12 18:14:09', 2, 1),
(30, 'Sciences Physiques', 'Titulaire du CAPES et Professeur de Sciences Physiques ', 'Professeur de Sciences Physiques pendant plus de 10 ans.\r\nTuteur d\'enseignants néo-titulaires.\r\n', '2019-12-01 18:18:50', '2020-02-12 18:18:50', 45, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `statut`, `pass`, `date_inscription`, `validated`, `try`) VALUES
(1, 'camile', 'camileghastine@hotmail.com', 'admin', '$2y$10$joat/ETZJ/bnN/AfWUYJA.D0LINvXYSAzovx/lXf4ACFoFd.p1Bva', '2019-12-09 09:00:00', 1, 0),
(2, 'Anonyme', 'camile@ghastine.com', 'admin', '$2y$10$joat/ETZJ/bnN/AfWUYJA.D0LINvXYSAzovx/lXf4ACFoFd.p1Bva', '2019-12-10 10:00:00', 1, 0),
(3, 'loann', 'loann@loann.fr', 'user', '$2y$10$joat/ETZJ/bnN/AfWUYJA.D0LINvXYSAzovx/lXf4ACFoFd.p1Bva', '2019-12-11 08:00:00', 1, 0),
(4, 'saël', 'sael@sael.fr', 'user', '$2y$10$ojgdv21iKCNQ40e6khuJdOz0EdAa3bfgyyfuagZu3lj.cmIKfH94.', '2019-12-11 10:00:00', 1, 3),
(5, 'Ninel', 'ninel@ninel.fr', 'user', '$2y$10$joat/ETZJ/bnN/AfWUYJA.D0LINvXYSAzovx/lXf4ACFoFd.p1Bva', '2020-02-11 21:54:26', 1, 5),
(110, 'roberto', 'roberto@mel.com', 'user', '$2y$10$joat/ETZJ/bnN/AfWUYJA.D0LINvXYSAzovx/lXf4ACFoFd.p1Bva', '2020-02-11 18:23:06', NULL, 0);

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
