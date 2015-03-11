-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 24 Juin 2012 à 11:33
-- Version du serveur: 5.5.9
-- Version de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `spibookbdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `lieu-geocodes`
--

CREATE TABLE `lieu-geocodes` (
  `lieu-geocode-id` int(11) NOT NULL,
  `lieu-geocode-lat` varchar(255) NOT NULL,
  `lieu-geocode-long` varchar(255) NOT NULL,
  UNIQUE KEY `lieu-geocode-id` (`lieu-geocode-id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lieu-geocodes`
--


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `lieu-geocodes`
--
ALTER TABLE `lieu-geocodes`
  ADD CONSTRAINT `lieu@002dgeocodes_ibfk_1` FOREIGN KEY (`lieu-geocode-id`) REFERENCES `lieu` (`lieu-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
    