-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Jeu 10 Mai 2012 à 16:14
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `spibook-1.0`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `administrateur-id` int(11) NOT NULL AUTO_INCREMENT,
  `administrateur-nom` varchar(45) DEFAULT NULL,
  `administrateur-prenom` varchar(45) DEFAULT NULL,
  `administrateur-mail` varchar(45) DEFAULT NULL,
  `administrateur-password` varchar(45) DEFAULT NULL,
  `administrateur-tel` varchar(45) DEFAULT NULL,
  `AdminRole_adminrole-id` int(11) NOT NULL,
  PRIMARY KEY (`administrateur-id`),
  KEY `fk_Administrateur_AdminRole1` (`AdminRole_adminrole-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`administrateur-id`, `administrateur-nom`, `administrateur-prenom`, `administrateur-mail`, `administrateur-password`, `administrateur-tel`, `AdminRole_adminrole-id`) VALUES
(1, 'Teillard', 'Benjamin', 'bteillard@gmail.com', 'password', '0102030405', 1);

-- --------------------------------------------------------

--
-- Structure de la table `adminrole`
--

CREATE TABLE IF NOT EXISTS `adminrole` (
  `adminrole-id` int(11) NOT NULL AUTO_INCREMENT,
  `adminrole-nom` varchar(255) DEFAULT NULL,
  `adminrole-description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adminrole-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `adminrole`
--

INSERT INTO `adminrole` (`adminrole-id`, `adminrole-nom`, `adminrole-description`) VALUES
(1, 'SuperAdmin', 'big chief'),
(2, 'Admin', 'middle chief');

-- --------------------------------------------------------

--
-- Structure de la table `communaute`
--

CREATE TABLE IF NOT EXISTS `communaute` (
  `communaute-id` int(11) NOT NULL AUTO_INCREMENT,
  `communaute-nom` varchar(255) DEFAULT NULL,
  `communaute-description` text,
  `communication-photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`communaute-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `communaute`
--

INSERT INTO `communaute` (`communaute-id`, `communaute-nom`, `communaute-description`, `communication-photo`) VALUES
(1, 'Communauté de l''Emmanuel', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/emmanuel.jpg'),
(2, 'Bénédictins', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/benedictin.jpg'),
(3, 'Dominicains', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/dominicains.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE IF NOT EXISTS `favoris` (
  `favoris-id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Les favoris seront les ID des différentes tables séparées par des virgules\n',
  `favoris-communautes` varchar(255) DEFAULT NULL,
  `favoris-types` varchar(255) DEFAULT NULL,
  `favoris-categories` varchar(255) DEFAULT NULL,
  `favoris-lieus` varchar(255) DEFAULT NULL,
  `favoris-retraites` varchar(255) DEFAULT NULL,
  `favoris-intervenants` varchar(255) DEFAULT NULL,
  `User_user-id` int(11) NOT NULL,
  PRIMARY KEY (`favoris-id`),
  UNIQUE KEY `User_user-id_UNIQUE` (`User_user-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `favoris`
--

INSERT INTO `favoris` (`favoris-id`, `favoris-communautes`, `favoris-types`, `favoris-categories`, `favoris-lieus`, `favoris-retraites`, `favoris-intervenants`, `User_user-id`) VALUES
(1, '1', '1', '1', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `intervenant`
--

CREATE TABLE IF NOT EXISTS `intervenant` (
  `intervenant-id` int(11) NOT NULL AUTO_INCREMENT,
  `intervenant-nom` varchar(255) NOT NULL,
  `intervenant-photo` varchar(255) DEFAULT NULL,
  `intervenant-description` text,
  `intervenant-prenom` varchar(45) DEFAULT NULL,
  `intervenant-mail` varchar(45) DEFAULT NULL,
  `intervenant-genre` varchar(45) DEFAULT NULL,
  `Intervenant-titre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intervenant-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `intervenant`
--

INSERT INTO `intervenant` (`intervenant-id`, `intervenant-nom`, `intervenant-photo`, `intervenant-description`, `intervenant-prenom`, `intervenant-mail`, `intervenant-genre`, `Intervenant-titre`) VALUES
(1, 'DOE', 'jdoe.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget elementum quam. Quisque sit amet orci vitae lorem ullamcorper adipiscing. Maecenas at pellentesque elit. Vivamus sagittis venenatis convallis. Nulla metus diam, tincidunt at lacinia sed, dictum sed velit. Vestibulum orci lorem, ultricies in ultricies non, volutpat at ligula. Cras lectus mi, placerat eu vestibulum eget, mattis vitae diam. Fusce tellus augue, fringilla vel accumsan a, ullamcorper eget velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\n\n', 'John', 'jdoe@gmail.com', 'M', 'SAS'),
(2, 'Hazard', 'thazard.jpg', 'Etiam eleifend aliquet velit, non egestas justo lobortis et. Cras adipiscing eleifend magna, nec lobortis justo posuere ut. Curabitur pretium posuere eros, ac ullamcorper tellus vestibulum ut. Proin vitae odio eget neque viverra commodo. Maecenas nec diam non diam lacinia interdum. Aenean euismod ultricies enim eget vulputate. Nunc eros urna, facilisis ut tristique accumsan, mattis a lectus. Fusce eu risus vitae nunc tristique rhoncus eget ac turpis. Sed ultrices sagittis nulla, ut mollis purus aliquet non. Praesent pharetra suscipit odio non faucibus. Mauris pretium nulla quis lorem porttitor suscipit. Vestibulum nisl mauris, eleifend eu suscipit sit amet, vulputate nec nunc. Aenean bibendum tellus luctus ligula pulvinar sed posuere odio laoreet. Integer lorem justo, ullamcorper at suscipit at, sollicitudin consectetur odio.', 'Thierry', 'thazard@gmail.com', 'M', 'Sa Majesté'),
(3, 'GOLDMAN', 'jjgoldman.jpg', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscing leo. Phasellus nec enim quis magna eleifend luctus in at felis. Cras purus libero, dictum non hendrerit at, ultricies ac justo. Proin at justo vitae justo gravida mattis eu sit amet dolor. Sed eleifend purus in massa consectetur sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc eleifend malesuada vestibulum. Praesent at ultricies dolor.', 'Jean-Jacques', 'jjgoldman@gmail.com', 'M', 'Sa Sainteté');

-- --------------------------------------------------------

--
-- Structure de la table `intervenant_pelerinage`
--

CREATE TABLE IF NOT EXISTS `intervenant_pelerinage` (
  `Intervenant_intervenant-id` int(11) NOT NULL,
  `Pelerinage_pelerinage-id` int(11) NOT NULL,
  PRIMARY KEY (`Intervenant_intervenant-id`,`Pelerinage_pelerinage-id`),
  KEY `fk_Intervenant_Pelerinage_Pelerinage1` (`Pelerinage_pelerinage-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `intervenant_pelerinage`
--

INSERT INTO `intervenant_pelerinage` (`Intervenant_intervenant-id`, `Pelerinage_pelerinage-id`) VALUES
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `intervenant_retraite`
--

CREATE TABLE IF NOT EXISTS `intervenant_retraite` (
  `Intervenants_intervenant-id` int(11) NOT NULL,
  `Retraite_retraite-id` int(11) NOT NULL,
  PRIMARY KEY (`Intervenants_intervenant-id`,`Retraite_retraite-id`),
  KEY `fk_Intervenants_has_Retraite_Retraite1` (`Retraite_retraite-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `intervenant_retraite`
--

INSERT INTO `intervenant_retraite` (`Intervenants_intervenant-id`, `Retraite_retraite-id`) VALUES
(2, 1),
(3, 1),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `lieu-id` int(11) NOT NULL AUTO_INCREMENT,
  `lieu-nom` varchar(255) NOT NULL,
  `lieu-adresse1` varchar(255) DEFAULT NULL,
  `lieu-adresse2` varchar(255) DEFAULT NULL,
  `lieu-cp` int(11) NOT NULL,
  `lieu-ville` varchar(255) NOT NULL,
  `lieu-pays` varchar(255) NOT NULL,
  `lieu-description` text,
  `lieu-mainphoto` varchar(255) DEFAULT NULL,
  `lieu-acces-train` tinyint(1) DEFAULT NULL,
  `lieu-acces-train-desc` varchar(255) DEFAULT NULL,
  `lieu-acces-voiture` varchar(255) DEFAULT NULL,
  `lieu-acces-avion` tinyint(1) DEFAULT NULL,
  `lieu-acces-avion-desc` varchar(255) DEFAULT NULL,
  `lieu-lien-siteweb` varchar(255) DEFAULT NULL,
  `lieu-mail` varchar(255) DEFAULT NULL,
  `lieu-lien-inscription` varchar(45) DEFAULT NULL,
  `Type_type-id` int(11) NOT NULL,
  `Communaute_communaute-id` int(11) NOT NULL,
  `Administrateur_administrateur-id` int(11) NOT NULL,
  `lieu-dateEnregistrement` datetime NOT NULL,
  PRIMARY KEY (`lieu-id`),
  KEY `fk_Lieu_Type1` (`Type_type-id`),
  KEY `fk_Lieu_Communaute1` (`Communaute_communaute-id`),
  KEY `fk_Lieu_Administrateur1` (`Administrateur_administrateur-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`lieu-id`, `lieu-nom`, `lieu-adresse1`, `lieu-adresse2`, `lieu-cp`, `lieu-ville`, `lieu-pays`, `lieu-description`, `lieu-mainphoto`, `lieu-acces-train`, `lieu-acces-train-desc`, `lieu-acces-voiture`, `lieu-acces-avion`, `lieu-acces-avion-desc`, `lieu-lien-siteweb`, `lieu-mail`, `lieu-lien-inscription`, `Type_type-id`, `Communaute_communaute-id`, `Administrateur_administrateur-id`, `lieu-dateEnregistrement`) VALUES
(1, 'Paroisse de Montauban', 'Place de la Cathédrale', NULL, 82000, 'MONTAUBAN', '', 'Aenean euismod ultricies enim eget vulputate. Nunc eros urna, facilisis ut tristique accumsan, mattis a lectus. Fusce eu risus vitae nunc tristique rhoncus eget ac turpis. Sed ultrices sagittis nulla, ut mollis purus aliquet non. Praesent pharetra suscipit odio non faucibus. Mauris pretium nulla quis lorem porttitor suscipit. Vestibulum nisl mauris, eleifend eu suscipit sit amet, vulputate nec nunc. Aenean bibendum tellus luctus ligula pulvinar sed posuere odio laoreet. Integer lorem justo, ullamcorper at suscipit at, sollicitudin consectetur odio.', 'Montauban_Cathedrale.jpg', 1, 'TGV Paris - Toulouse', 'Autoroute A20', 0, NULL, 'www.google.com', 'lieu@mail.com', 'www.facebook.com', 1, 1, 1, '2012-04-03 00:00:00'),
(2, 'Centre Notre Dame', NULL, NULL, 46500, 'Rocamadour', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis luctus turpis ac sem blandit ut commodo erat elementum. Fusce dapibus, dolor eu accumsan vehicula, metus nunc lobortis mauris, quis blandit arcu est at diam. Praesent lacus dolor, dignissim sit amet consectetur ac, feugiat vitae erat. Nulla ut sapien mi. Cras pulvinar, orci nec laoreet volutpat, justo erat tristique felis, et consectetur dolor quam sed mi. Ut hendrerit venenatis velit, sit amet fermentum ipsum ornare vitae. Sed lacus sapien, porttitor quis ultricies ac, luctus a massa. In posuere, odio pharetra sollicitudin euismod, tellus risus tempor metus, ut feugiat erat enim et nulla. Mauris pharetra lacinia turpis ac pharetra. Morbi justo nulla, pulvinar id consectetur sed, auctor ac felis', 'Rocamadour.jpg', 1, 'Gare SNCF Rocamadour', 'RN20.', 0, NULL, 'www.rocamadour.com', 'contact@rocamadour.com', 'inscription.rocamadour.com', 2, 2, 1, '2012-04-28 11:42:23'),
(5, 'Maison dioc&eacute;saine Saint Paul', 'Ch&acirc;teau du Parc Ducup  ', 'All&eacute;e des Ch&ecirc;nes ', 66000, 'Perpignan ', 'France ', '<p>\r\n	T&eacute;l&eacute;phone : 04 68 68 32 40</p>\r\n<p>\r\n	H&eacute;bergement : 48 chambres de 1 &agrave; 6 personnes ( salle de bains, WC, TV) &nbsp;&nbsp;</p>\r\n<div>\r\n	4 salles de restaurant</div>\r\n<div>\r\n	8 salles de s&eacute;minaires</div>\r\n<div>\r\n	Parking priv&eacute; gratuit</div>\r\n<div>\r\n	Au milieu d&#39;un parc centenaire de 5 hectares</div>\r\n', '1336513432Parc-Ducup-Perpignan.jpg', 1, '', '<p>\r\n	autoroute A1000</p>\r\n', 0, '', 'http://www.chateau-parcducup.com ', 'parcducup@wanadoo.fr ', 'parcducup@wanadoo.fr ', 3, 3, 1, '2012-05-08 21:43:52'),
(6, 'Abbaye Notre Dame D Aiguebelle ', 'Montjoyer ', '  cc', 26230, 'Aiguebelle ', 'France ', '<p>\r\n	La communaut&eacute; de Notre-Dame d&#39;Aiguebelle compte actuellement 24 moines de 39 &agrave; 92 ans et poursuit toujours sa vie monastique en cherchant &agrave; vivre du travail de ses mains, &agrave; aider les pauvres dans la mesure de ses possibilit&eacute;s, &agrave; accueillir ceux et celles qui veulent prendre un temps d&#39;arr&ecirc;t dans leur vie. Cette recherche se fait dans l&#39;enceinte m&ecirc;me du monast&egrave;re dans une vie personnelle et communautaire de pri&egrave;re.</p>\r\n', '1336514200aiguebelle2.jpg', 1, '<p>\r\n	Gare Sncf Aiguebelle.</p>\r\n', '<p>\r\n	<span style="color: rgb(51, 51, 51); font-family: Arial, Helvetica, sans-serif; line-height: 17px; text-align: justify; background-color: rgb(255, 249, 228); ">L&#39;abbaye de Notre Dame d&#39;Aiguebelle est situ&eacute;e &agrave; 18 km de Mont&eacu', 1, '<p>\r\n	A&eacute;roport Lyon Saint Exup&eacute;ry</p>\r\n', 'http://abbaye-aiguebelle.cef.fr ', 'com.aiguebelle@orange.fr ', 'com.aiguebelle@orange.fr ', 2, 1, 1, '2012-05-08 21:56:40'),
(7, 'Abbaye Notre-Dame D&#039;Oelenberg ', '', '', 68950, 'Reiningue ', 'France ', '<p>\r\n	Tel &nbsp;: 03 89 81 91 23</p>\r\n<p>\r\n	La communaut&eacute; est heureuse de pouvoir partager avec ceux qui le d&eacute;sirent le climat spirituel de sa vie monastique. Notre h&ocirc;tellerie peut accueillir des retraitants, individuels ou petits groupes, pour un s&eacute;jour de 8 jours au maximum. A l&rsquo;&eacute;glise, dans le parc ou dans l&rsquo;intimit&eacute; de sa chambre, le retraitant go&ucirc;tera au silence monastique &laquo;qui n&rsquo;est pas une simple pratique, mais une gr&acirc;ce, un don de Dieu.&raquo;</p>\r\n', '1336514825oelenberg.jpg', 1, '<p>\r\n	gare de Mulhouse, tram ligne 1 jusqu&#39;au terminus &quot;Rattachement&quot;, puis ligne de bus 50 jusqu&rsquo;&agrave; l&rsquo;arr&ecirc;t &quot;Ch&acirc;teau d&rsquo;eau&quot; &agrave; 500 m de l&rsquo;abbaye</p>\r\n', '<p>\r\n	&agrave; 15 km &agrave; l&rsquo;ouest de Mulhouse.</p>\r\n', 1, '<p>\r\n	a&eacute;roport B&acirc;le-Mulhouse &agrave; 35 km ; a&eacute;roport Strasbourg-Entzheim &agrave; 110 km</p>\r\n', 'www.abbaye-oelenberg.com ', 'hotellerie@abbaye-oelenberg.com ', 'hotellerie@abbaye-oelenberg.com ', 2, 1, 1, '2012-05-08 22:07:05');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `newsletter-mail` varchar(255) NOT NULL,
  `newsletter-status` tinyint(1) DEFAULT NULL,
  `newsletter-DateInscription` datetime DEFAULT NULL,
  PRIMARY KEY (`newsletter-mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `newsletter`
--

INSERT INTO `newsletter` (`newsletter-mail`, `newsletter-status`, `newsletter-DateInscription`) VALUES
('bteillard@gmail.com', 1, '2012-04-14 10:58:54');

-- --------------------------------------------------------

--
-- Structure de la table `pelerinage`
--

CREATE TABLE IF NOT EXISTS `pelerinage` (
  `pelerinage-id` int(11) NOT NULL AUTO_INCREMENT,
  `pelerinage-nom` varchar(255) NOT NULL,
  `pelerinage-description` text,
  `pelerinage-datedebut` datetime DEFAULT NULL,
  `pelerinage-datefin` datetime DEFAULT NULL,
  `pelerinage-mainphoto` varchar(255) DEFAULT NULL,
  `pelerinage-prix` varchar(45) DEFAULT NULL,
  `pelerinage-contact` text,
  `Lieu_lieu-id` int(11) NOT NULL,
  `pelerinage-dateEnregistrement` datetime NOT NULL,
  PRIMARY KEY (`pelerinage-id`),
  KEY `fk_Retraite_Lieu10` (`Lieu_lieu-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `pelerinage`
--

INSERT INTO `pelerinage` (`pelerinage-id`, `pelerinage-nom`, `pelerinage-description`, `pelerinage-datedebut`, `pelerinage-datefin`, `pelerinage-mainphoto`, `pelerinage-prix`, `pelerinage-contact`, `Lieu_lieu-id`, `pelerinage-dateEnregistrement`) VALUES
(1, 'Le Pélé pour les nuls', 'Mauris cursus dignissim erat, et lobortis mauris euismod et. Aliquam mi dolor, malesuada in dignissim adipiscing, fringilla in quam. Fusce aliquet blandit urna, vitae vulputate quam laoreet vitae. Praesent aliquam hendrerit est, eu aliquam erat fermentum at. Nam id dui mauris, sit amet euismod neque. Etiam ac purus leo. Praesent ultricies, elit et ultricies pellentesque, lorem ipsum ultrices purus, quis faucibus massa magna eget enim. Nam a tempus justo. Mauris porttitor, erat vel lacinia pulvinar, libero risus adipiscing neque, nec posuere erat metus eu enim. Sed non velit ac magna mollis egestas nec in nisl. Sed pulvinar elit dolor, sed consequat dui. Donec ac lorem nibh, vel vestibulum metus.\r\n\r\nInteger pulvinar nisi non arcu facilisis hendrerit. In at tortor lorem. Pellentesque vehicula nisl non arcu volutpat porttitor. Donec ultrices pellentesque placerat. Pellentesque interdum augue elit, in laoreet risus. Maecenas laoreet turpis sed nulla consectetur pulvinar. Integer dignissim turpis ac augue tristique aliquam. Ut commodo iaculis pellentesque. Sed dolor ante, lacinia et hendrerit nec, scelerisque id dolor. Morbi bibendum nibh eu turpis aliquet varius. Curabitur vestibulum diam nec odio lobortis vehicula. Cras id elit in enim pulvinar pharetra et egestas massa. Phasellus molestie, nisi eu rhoncus lacinia, lectus lorem consectetur tortor, ac feugiat mauris metus congue massa. Nulla vulputate sapien et mauris fringilla molestie. Nullam eget ante risus, eget sollicitudin lacus. Aliquam ornare posuere orci, non imperdiet sem tempus ac.', '2012-05-30 22:32:29', '2012-06-04 22:32:36', 'nuls.jpg', '10', '<b>Cum sociis natoque penatibus et magnis dis parturient montes</b>, nascetur ridiculus mus. In vitae accumsan erat. Sed et orci lorem. Nam pretium lacus in nibh volutpat fermentum <i>feugiat lectus feugiat. Etiam fermentum lacinia risus id luctus. Nam hendrerit leo mauris, vel </i>gravida nibh. Curabitur lorem quam, rhoncus et varius ac, venenatis ut diam. Sed placerat metus tincidunt metus aliquam id consectetur nisi fringilla. ', 1, '2012-04-01 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `photo-id` int(11) NOT NULL AUTO_INCREMENT,
  `photo-url` varchar(45) DEFAULT NULL,
  `Lieu_lieu-id` int(11) NOT NULL,
  PRIMARY KEY (`photo-id`),
  KEY `fk_Photo_Lieu1` (`Lieu_lieu-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`photo-id`, `photo-url`, `Lieu_lieu-id`) VALUES
(1, 'aaaaa', 1);

-- --------------------------------------------------------

--
-- Structure de la table `photo_pelerinage`
--

CREATE TABLE IF NOT EXISTS `photo_pelerinage` (
  `photo_retraite-id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_retraite-url` varchar(45) DEFAULT NULL,
  `Pelerinage_pelerinage-id` int(11) NOT NULL,
  PRIMARY KEY (`photo_retraite-id`),
  KEY `fk_Photo_pelerinage_Pelerinage1` (`Pelerinage_pelerinage-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `photo_retraite`
--

CREATE TABLE IF NOT EXISTS `photo_retraite` (
  `photo_retraite-id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_retraite-url` varchar(45) DEFAULT NULL,
  `Retraite_retraite-id` int(11) NOT NULL,
  PRIMARY KEY (`photo_retraite-id`),
  KEY `fk_Photo_copy1_Retraite1` (`Retraite_retraite-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `photo_retraite`
--

INSERT INTO `photo_retraite` (`photo_retraite-id`, `photo_retraite-url`, `Retraite_retraite-id`) VALUES
(1, 'abcde', 1);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `profil-id` int(11) NOT NULL AUTO_INCREMENT,
  `profil-nom` varchar(255) DEFAULT NULL,
  `profil-description` text,
  PRIMARY KEY (`profil-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `profil`
--

INSERT INTO `profil` (`profil-id`, `profil-nom`, `profil-description`) VALUES
(1, 'normal', 'blabla'),
(2, 'premium', 'blabla mais plus cher');

-- --------------------------------------------------------

--
-- Structure de la table `retraite`
--

CREATE TABLE IF NOT EXISTS `retraite` (
  `retraite-id` int(11) NOT NULL AUTO_INCREMENT,
  `retraite-nom` varchar(255) NOT NULL,
  `retraite-description` text,
  `retraite-datedebut` datetime DEFAULT NULL,
  `retraite-datefin` datetime DEFAULT NULL,
  `retraite-mainphoto` varchar(255) DEFAULT NULL,
  `retraite-prix` varchar(45) DEFAULT NULL,
  `retraite-garderie` tinyint(1) DEFAULT NULL,
  `retraite-hebergement` tinyint(1) NOT NULL DEFAULT '1',
  `Lieu_lieu-id` int(11) NOT NULL,
  `retraite-dateEnregistrement` datetime NOT NULL,
  PRIMARY KEY (`retraite-id`),
  KEY `fk_Retraite_Lieu1` (`Lieu_lieu-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `retraite`
--

INSERT INTO `retraite` (`retraite-id`, `retraite-nom`, `retraite-description`, `retraite-datedebut`, `retraite-datefin`, `retraite-mainphoto`, `retraite-prix`, `retraite-garderie`, `retraite-hebergement`, `Lieu_lieu-id`, `retraite-dateEnregistrement`) VALUES
(1, 'Question de Chr&eacute;tiens aux candidats', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ante elit, porta nec imperdiet in, scelerisque sed libero. Donec sit amet enim urna, ut placerat tellus. Sed consectetur sodales quam non tristique. Praesent eget consequat metus. Vestibulum ut elit augue. Etiam eleifend, tortor id convallis fringilla, urna orci interdum magna, eget egestas massa augue a mi. Proin quis lectus erat. Phasellus luctus suscipit enim, non porta odio porta consectetur. Etiam malesuada, turpis a hendrerit ornare, libero nisl ornare elit, a convallis quam nisi quis lacus. Etiam nec lorem mi.\n\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'candidats.jpg', '10', 0, 1, 1, '0000-00-00 00:00:00'),
(2, 'Le mariage au centre de la vie de couple', 'Nullam sapien nunc, lobortis ac mollis vitae, congue in eros. Nam dictum quam quis nibh varius dignissim. In hac habitasse platea dictumst. Mauris commodo placerat accumsan. Vivamus in mauris neque. Donec tempor libero vel urna dapibus blandit. Fusce dapibus, neque a varius bibendum, dolor enim bibendum sem, vitae posuere lectus nulla at arcu. Fusce ligula leo, imperdiet ultricies blandit eleifend, sodales in dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi quis metus sit amet lectus pretium vehicula a vitae sem. Phasellus pellentesque lorem eget ipsum sodales lacinia.', '2012-06-20 10:48:52', '2012-06-23 10:49:05', 'mariage.jpg', '20', 1, 1, 2, '0000-00-00 00:00:00'),
(3, 'Vivre sa foi au travail', 'Mauris quis libero vel risus accumsan dictum. Etiam neque nibh, tincidunt sed aliquet vel, interdum ac sem. Morbi convallis suscipit tincidunt. In pellentesque hendrerit iaculis. Quisque scelerisque lobortis odio, eu vestibulum neque interdum eu. Cras sit amet urna in felis condimentum ullamcorper non a dolor. Cras et ligula in ante luctus gravida quis at sem. Vestibulum hendrerit blandit magna, non vestibulum erat auctor a. Mauris eleifend adipiscing metus, sit amet consectetur sem feugiat nec. Aliquam velit urna, tempor id iaculis nec, gravida vitae elit. Duis interdum tellus et odio aliquet id dignissim lectus tempor. Aenean faucibus nulla non felis tristique suscipit. Vestibulum euismod consequat augue, eu gravida dui posuere et.', '2012-06-22 10:49:44', '2012-06-22 18:49:44', 'travail.jpg', '7', 0, 0, 1, '0000-00-00 00:00:00'),
(4, 'La Bible pour les nuls', 'Nullam sapien nunc, lobortis ac mollis vitae, congue in eros. Nam dictum quam quis nibh varius dignissim. In hac habitasse platea dictumst. Mauris commodo placerat accumsan. Vivamus in mauris neque. Donec tempor libero vel urna dapibus blandit. Fusce dapibus, neque a varius bibendum, dolor enim bibendum sem, vitae posuere lectus nulla at arcu. Fusce ligula leo, imperdiet ultricies blandit eleifend, sodales in dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi quis metus sit amet lectus pretium vehicula a vitae sem. Phasellus pellentesque lorem eget ipsum sodales lacinia.', '2012-08-22 10:48:52', '2012-08-29 10:49:05', 'mariage.jpg', '20', 1, 1, 1, '0000-00-00 00:00:00'),
(5, 'L''Humanitaire', 'Mauris quis libero vel risus accumsan dictum. Etiam neque nibh, tincidunt sed aliquet vel, interdum ac sem. Morbi convallis suscipit tincidunt. In pellentesque hendrerit iaculis. Quisque scelerisque lobortis odio, eu vestibulum neque interdum eu. Cras sit amet urna in felis condimentum ullamcorper non a dolor. Cras et ligula in ante luctus gravida quis at sem. Vestibulum hendrerit blandit magna, non vestibulum erat auctor a. Mauris eleifend adipiscing metus, sit amet consectetur sem feugiat nec. Aliquam velit urna, tempor id iaculis nec, gravida vitae elit. Duis interdum tellus et odio aliquet id dignissim lectus tempor. Aenean faucibus nulla non felis tristique suscipit. Vestibulum euismod consequat augue, eu gravida dui posuere et.', '2012-10-22 10:49:44', '2012-10-25 18:49:44', 'humanitaire.jpg', '7', 0, 0, 1, '0000-00-00 00:00:00'),
(11, 'testRetraite', '<p>\r\n	lldabkdjd qlkfjdqfh d</p>\r\n<p>\r\n	qfdpflkdsq f</p>\r\n<p>\r\n	dmflksqf dqflkjhf qfkjdfh qdkjfh&nbsp;dqflkjhf qfkjdfh qdkjfh&nbsp;dqflkjhf qfkjdfh qdkjfh&nbsp;dqflkjhf qfkjdfh qdkjfh&nbsp;dqflkjhf qfkjdfh qdkjfh&nbsp;dqflkjhf qfkjdfh qdkjfh&nbsp;dqflkjhf qfkjdfh qdkjfh&nbsp;</p>\r\n', '2012-06-17 00:00:00', '2012-06-20 00:00:00', '1336555166carmelbourges.jpg', '10', 1, 1, 2, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `theme-id` int(11) NOT NULL AUTO_INCREMENT,
  `theme-nom` varchar(255) DEFAULT NULL,
  `theme-description` varchar(255) DEFAULT NULL,
  `theme-image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`theme-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`theme-id`, `theme-nom`, `theme-description`, `theme-image`) VALUES
(1, 'Célibataires', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'celib.jpg'),
(2, 'Couples', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'couples.jpg'),
(3, 'Etudiants', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'etudiants.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `theme_pelerinage`
--

CREATE TABLE IF NOT EXISTS `theme_pelerinage` (
  `Theme_theme-id` int(11) NOT NULL,
  `Pelerinage_pelerinage-id` int(11) NOT NULL,
  PRIMARY KEY (`Theme_theme-id`,`Pelerinage_pelerinage-id`),
  KEY `fk_Categorie_Pelerinage_Pelerinage1` (`Pelerinage_pelerinage-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `theme_retraite`
--

CREATE TABLE IF NOT EXISTS `theme_retraite` (
  `Theme_theme-id` int(11) NOT NULL,
  `Retraite_retraite-id` int(11) NOT NULL,
  PRIMARY KEY (`Theme_theme-id`,`Retraite_retraite-id`),
  KEY `fk_Categorie_has_Retraite_Retraite1` (`Retraite_retraite-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `theme_retraite`
--

INSERT INTO `theme_retraite` (`Theme_theme-id`, `Retraite_retraite-id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type-id` int(11) NOT NULL AUTO_INCREMENT,
  `type-nom` varchar(255) DEFAULT NULL,
  `type-description` varchar(255) DEFAULT NULL,
  `type-photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`type-id`, `type-nom`, `type-description`, `type-photo`) VALUES
(1, 'Couvent', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscin', 'type/couv.jpg'),
(2, 'Abbaye', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscin', 'type/abb.jpg'),
(3, 'Maison paroissiale', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscin', 'type/mparois.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user-id` int(11) NOT NULL AUTO_INCREMENT,
  `user-login` varchar(255) NOT NULL,
  `user-nom` varchar(255) DEFAULT NULL,
  `user-prenom` varchar(255) DEFAULT NULL,
  `user-mail` varchar(255) DEFAULT NULL,
  `user-password` varchar(45) DEFAULT NULL,
  `user-tel1` varchar(45) DEFAULT NULL,
  `user-tel2` varchar(45) DEFAULT NULL,
  `user-newsletter` tinyint(1) NOT NULL DEFAULT '1',
  `user-optin` tinyint(1) NOT NULL DEFAULT '1',
  `Profil_profil-id` int(11) NOT NULL,
  PRIMARY KEY (`user-id`),
  KEY `fk_User_Profil1` (`Profil_profil-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user-id`, `user-login`, `user-nom`, `user-prenom`, `user-mail`, `user-password`, `user-tel1`, `user-tel2`, `user-newsletter`, `user-optin`, `Profil_profil-id`) VALUES
(1, 'jdupont', 'Dupont', 'Jean', 'jdup@gmail.com', 'pwd', '0102030405', '0203040560', 1, 1, 1),
(2, 'bteillard2', 'TEILLARD', 'Benjamin', 'bteillard@gmail.com', '6942824801287ed734eb9e362046b483', '0102030405', '0102030405', 1, 1, 1),
(3, 'pdelava', 'DELAVA', 'PAUL', 'paul.delava@gmail.com', '40435fb3f3cb6a5bc103d4173be9dc95', '0102030405', '0102030405', 1, 1, 1),
(4, 'maman', 'TEILLARD', 'MAMAAAAOUAUUA', 'chantal.teillard@gmail.com', '6ffee7d3af984c95d72d813efda2d919', '0102030405', '0102030405', 1, 1, 1),
(5, 'benteil', 'Teillard', 'Benjamin', 'bteillard@gmail.com', 'ba99267a89cf694c632faea096294a0a', '0102030405', '0102030405', 1, 1, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `fk_Administrateur_AdminRole1` FOREIGN KEY (`AdminRole_adminrole-id`) REFERENCES `adminrole` (`adminrole-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `fk_Favoris_User1` FOREIGN KEY (`User_user-id`) REFERENCES `user` (`user-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `intervenant_pelerinage`
--
ALTER TABLE `intervenant_pelerinage`
  ADD CONSTRAINT `fk_Intervenant_Pelerinage_Intervenant1` FOREIGN KEY (`Intervenant_intervenant-id`) REFERENCES `intervenant` (`intervenant-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Intervenant_Pelerinage_Pelerinage1` FOREIGN KEY (`Pelerinage_pelerinage-id`) REFERENCES `pelerinage` (`pelerinage-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `intervenant_retraite`
--
ALTER TABLE `intervenant_retraite`
  ADD CONSTRAINT `fk_Intervenants_has_Retraite_Intervenants` FOREIGN KEY (`Intervenants_intervenant-id`) REFERENCES `intervenant` (`intervenant-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Intervenants_has_Retraite_Retraite1` FOREIGN KEY (`Retraite_retraite-id`) REFERENCES `retraite` (`retraite-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD CONSTRAINT `fk_Lieu_Administrateur1` FOREIGN KEY (`Administrateur_administrateur-id`) REFERENCES `administrateur` (`administrateur-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Lieu_Communaute1` FOREIGN KEY (`Communaute_communaute-id`) REFERENCES `communaute` (`communaute-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Lieu_Type1` FOREIGN KEY (`Type_type-id`) REFERENCES `type` (`type-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pelerinage`
--
ALTER TABLE `pelerinage`
  ADD CONSTRAINT `fk_Retraite_Lieu10` FOREIGN KEY (`Lieu_lieu-id`) REFERENCES `lieu` (`lieu-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_Photo_Lieu1` FOREIGN KEY (`Lieu_lieu-id`) REFERENCES `lieu` (`lieu-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `photo_pelerinage`
--
ALTER TABLE `photo_pelerinage`
  ADD CONSTRAINT `fk_Photo_pelerinage_Pelerinage1` FOREIGN KEY (`Pelerinage_pelerinage-id`) REFERENCES `pelerinage` (`pelerinage-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `photo_retraite`
--
ALTER TABLE `photo_retraite`
  ADD CONSTRAINT `fk_Photo_copy1_Retraite1` FOREIGN KEY (`Retraite_retraite-id`) REFERENCES `retraite` (`retraite-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `retraite`
--
ALTER TABLE `retraite`
  ADD CONSTRAINT `fk_Retraite_Lieu1` FOREIGN KEY (`Lieu_lieu-id`) REFERENCES `lieu` (`lieu-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `theme_pelerinage`
--
ALTER TABLE `theme_pelerinage`
  ADD CONSTRAINT `fk_Categorie_has_Retraite_Categorie10` FOREIGN KEY (`Theme_theme-id`) REFERENCES `theme` (`theme-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categorie_Pelerinage_Pelerinage1` FOREIGN KEY (`Pelerinage_pelerinage-id`) REFERENCES `pelerinage` (`pelerinage-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `theme_retraite`
--
ALTER TABLE `theme_retraite`
  ADD CONSTRAINT `fk_Categorie_has_Retraite_Categorie1` FOREIGN KEY (`Theme_theme-id`) REFERENCES `theme` (`theme-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categorie_has_Retraite_Retraite1` FOREIGN KEY (`Retraite_retraite-id`) REFERENCES `retraite` (`retraite-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_User_Profil1` FOREIGN KEY (`Profil_profil-id`) REFERENCES `profil` (`profil-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
