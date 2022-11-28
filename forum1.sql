-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour forum1
CREATE DATABASE IF NOT EXISTS `forum1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum1`;

-- Listage de la structure de la table forum1. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum1.categorie : ~3 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `nom`) VALUES
	(1, 'popopopopopo'),
	(2, 'momomomomomo'),
	(3, 'doddododododo');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum1. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL,
  `message` text NOT NULL,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table forum1.post : ~3 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `message`, `datePost`, `user_id`, `topic_id`) VALUES
	(1, 'popopopopopopopo', '2022-11-06 15:50:39', 1, 1),
	(2, 'momomomomomomo', '2022-10-28 15:51:00', 2, 2),
	(3, 'doddodododododdodo', '2022-04-28 15:51:20', 3, 3);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum1. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `user_id` (`user_id`),
  KEY `categorie_id` (`categorie_id`),
  CONSTRAINT `topic_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum1.topic : ~2 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `title`, `creationDate`, `closed`, `user_id`, `categorie_id`) VALUES
	(1, 'popopopopopo', '2022-08-28 15:49:33', 0, 1, 1),
	(2, 'dodododododododo', '2022-11-23 15:49:54', 0, 2, 2),
	(3, 'momomomomomo', '2022-11-22 15:50:18', 0, 3, 3);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum1. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `dateInscription` datetime NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum1.user : ~3 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `pseudo`, `mail`, `mdp`, `dateInscription`, `role`) VALUES
	(1, 'momomomo', 'momomomo@momo.com', 'momomomo', '2019-11-28 15:46:41', 'user'),
	(2, 'popopo', 'popopo@popo.com', 'popopo', '2021-11-28 15:47:20', 'user'),
	(3, 'dodododo', 'dododo@dodo.com', 'dododo', '2022-11-28 15:47:52', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
