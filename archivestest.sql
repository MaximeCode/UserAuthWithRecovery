-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 10 jan. 2025 à 11:33
-- Version du serveur : 8.0.32
-- Version de PHP : 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `archivestest`
--

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

DROP TABLE IF EXISTS `communes`;
CREATE TABLE IF NOT EXISTS `communes` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `login_id` bigint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `login_id` (`login_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `communes`
--

INSERT INTO `communes` (`id`, `nom`, `login_id`) VALUES
(1, 'max', 3),
(2, 'Marseille', 4),
(3, 'Chartres', 5),
(4, 'Nice', 6),
(5, 'Brest', 7),
(6, 'Max', 8),
(7, 'test', 9),
(8, 'Cannes', 10),
(9, 'Test', 11),
(10, 'Eurelien', 12),
(11, 'Gâvre', 13),
(12, 'encoreUnTest', 14);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `login`, `pwd`) VALUES
(3, 'moi', '$2y$10$HNDatZLVfRl1jFvXpOtf/e2T092aKmbWA13JiwSOrNJkQRj1Z3aMq'),
(4, 'marseille@gmail.fr', '$2y$10$xHsTFRrvWvfYWXT73xnIBudxzRS4eyu6kGIl67KA44GC6xNo7M4dO'),
(5, 'chartres@gmail.fr', '$2y$10$QKFL6ktXF4ntTWOrAYwJgutzmo/7p7tdQRWaiXxBWPQnDkuPM87TC'),
(6, 'nice@gmail.com', '$2y$10$JnMBtKsENXN9V7SJF2xMd.B.TtmVRTErizejt06cLJkv7Fcts.rMS'),
(7, 'brest@gmail.com', '$2y$10$dXXMqE8GmIYh3lrS/mFgI.QaPGbLYw8ottm9MacOMYsHDRVsOlTsu'),
(8, 'dobibax331@matmayer.com', '$2y$10$DRP/4Co.0HUWUoTnThItLe8XdslwfGeHo71HXIFEOrGKaxX5gi5Mi'),
(9, 'ketefem686@pariag.com', '$2y$10$sCjjNViaQ6MMALy22wv0perBF.Z/FzPEhrq4nxJMW9ZxvBQ0/c2Mu'),
(10, 'cannes@gmail.com', '$2y$10$/matIX98XfTYN2yAWSQ7J.wyRBMw09vx77.UcOW3lXps4tFF8YBJ.'),
(11, 'test@gmail.com', '$2y$10$Mt1t/wBRtuRDf4.xx3y83.zxM/0PsPCOp764dm1XCRnR3CAvyo106'),
(12, 'eurelien@gmail.com', '$2y$10$8wZ5srXkeddEoXSKt2C5deTh12rriItmjH8kewVlkP89263Tq1.J.'),
(13, 'gavre@gmail.com', '$2y$10$MIpxQIlsYTd5lMVu5SmX3OlMlaop9S0oWta8mLnRofI362yBeRzaC'),
(14, 'encoremoi@gmail.com', '$2y$10$w/TOyCpnIfuePUGxCT07a.GT8HtNrFsy8vZr9qsHjEzem624KRu6G');

--
-- Déclencheurs `login`
--
DROP TRIGGER IF EXISTS `logSignUp`;
DELIMITER $$
CREATE TRIGGER `logSignUp` AFTER INSERT ON `login` FOR EACH ROW BEGIN
	INSERT INTO logs (`action`) VALUES (CONCAT(NEW.login, " s'est inscrit"));
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `logUpdatePwd`;
DELIMITER $$
CREATE TRIGGER `logUpdatePwd` AFTER UPDATE ON `login` FOR EACH ROW BEGIN
	INSERT INTO logs (`action`) VALUES (CONCAT(NEW.login, ' à modification son mot de passe'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `action` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `datetimeOfAction` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `logs`
--

INSERT INTO `logs` (`id`, `action`, `datetimeOfAction`) VALUES
(1, 'eurelien@gmail.com à modification son mot de passe', '2025-01-10 10:12:19'),
(2, 'gavre@gmail.com à modification son mot de passe', '2025-01-10 10:15:05'),
(4, 'encoremoi@gmail.com s\'est inscrit', '2025-01-10 10:22:10'),
(5, 'encoremoi@gmail.com à modification son mot de passe', '2025-01-10 10:23:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
