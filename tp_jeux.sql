-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 15 mars 2018 à 15:33
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tp_jeux`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte_utilisateur`
--

DROP TABLE IF EXISTS `compte_utilisateur`;
CREATE TABLE IF NOT EXISTS `compte_utilisateur` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `adresseMail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`),
  UNIQUE KEY `adresseMail` (`adresseMail`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte_utilisateur`
--

INSERT INTO `compte_utilisateur` (`id`, `pseudo`, `password`, `adresseMail`) VALUES
(10, 'Nirata', '$2y$10$rwEMh2mCzAQA3dLClJmRZ.n5F87/.HtejU9EWifIqghFrVRoUHNqC', 'christophe.riviere44@laposte.net');

-- --------------------------------------------------------

--
-- Structure de la table `personnages`
--

DROP TABLE IF EXISTS `personnages`;
CREATE TABLE IF NOT EXISTS `personnages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `degats` int(255) DEFAULT '0',
  `vieMax` int(255) NOT NULL DEFAULT '100',
  `forcePerso` int(255) NOT NULL,
  `degatMin` int(255) NOT NULL,
  `degatMax` int(255) NOT NULL,
  `defensePerso` int(255) NOT NULL,
  `fatigue` int(255) DEFAULT '0',
  `endurenceMax` int(255) NOT NULL,
  `chanceCritique` int(255) NOT NULL DEFAULT '0',
  `multiplicateurCritique` int(255) NOT NULL DEFAULT '0',
  `idPlayer` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `personnages`
--

INSERT INTO `personnages` (`id`, `nom`, `degats`, `vieMax`, `forcePerso`, `degatMin`, `degatMax`, `defensePerso`, `fatigue`, `endurenceMax`, `chanceCritique`, `multiplicateurCritique`, `idPlayer`) VALUES
(3, 'Nirata', 0, 100, 3, 3, 6, 2, 100, 100, 0, 0, 10),
(22, 'Nono', -7, 100, 2, 1, 2, 3, NULL, 100, 0, 0, 10),
(26, 'albert', 0, 100, 2, 1, 2, 2, 0, 100, 0, 0, 1),
(29, 'Jean Jean', 0, 100, 2, 1, 2, 2, 0, 100, 0, 0, 10),
(38, 'alfred', 0, 100, 2, 1, 2, 2, 0, 100, 0, 0, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
