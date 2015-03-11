-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 14 Avril 2012 à 14:50
-- Version du serveur: 5.1.37
-- Version de PHP: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `spibook-1.0`
--

-- --------------------------------------------------------

--
-- Structure de la table `Administrateur`
--

CREATE TABLE `Administrateur` (
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
-- Contenu de la table `Administrateur`
--

INSERT INTO `Administrateur` VALUES(1, 'Teillard', 'Benjamin', 'bteillard@gmail.com', 'password', '0102030405', 1);

-- --------------------------------------------------------

--
-- Structure de la table `AdminRole`
--

CREATE TABLE `AdminRole` (
  `adminrole-id` int(11) NOT NULL AUTO_INCREMENT,
  `adminrole-nom` varchar(255) DEFAULT NULL,
  `adminrole-description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adminrole-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `AdminRole`
--

INSERT INTO `AdminRole` VALUES(1, 'SuperAdmin', 'big chief');
INSERT INTO `AdminRole` VALUES(2, 'Admin', 'middle chief');

-- --------------------------------------------------------

--
-- Structure de la table `Communaute`
--

CREATE TABLE `Communaute` (
  `communaute-id` int(11) NOT NULL AUTO_INCREMENT,
  `communaute-nom` varchar(255) DEFAULT NULL,
  `communaute-description` text,
  `communication-photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`communaute-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Communaute`
--

INSERT INTO `Communaute` VALUES(1, 'Communauté de l''Emmanuel', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/emmanuel.jpg');
INSERT INTO `Communaute` VALUES(2, 'Bénédictins', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/benedictin.jpg');
INSERT INTO `Communaute` VALUES(3, 'Dominicains', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/dominicains.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Favoris`
--

CREATE TABLE `Favoris` (
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
-- Contenu de la table `Favoris`
--

INSERT INTO `Favoris` VALUES(1, '1', '1', '1', '1', '1', '1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Intervenant`
--

CREATE TABLE `Intervenant` (
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
-- Contenu de la table `Intervenant`
--

INSERT INTO `Intervenant` VALUES(1, 'DOE', 'jdoe.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget elementum quam. Quisque sit amet orci vitae lorem ullamcorper adipiscing. Maecenas at pellentesque elit. Vivamus sagittis venenatis convallis. Nulla metus diam, tincidunt at lacinia sed, dictum sed velit. Vestibulum orci lorem, ultricies in ultricies non, volutpat at ligula. Cras lectus mi, placerat eu vestibulum eget, mattis vitae diam. Fusce tellus augue, fringilla vel accumsan a, ullamcorper eget velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\n\n', 'John', 'jdoe@gmail.com', 'M', 'SAS');
INSERT INTO `Intervenant` VALUES(2, 'Hazard', 'thazard.jpg', 'Etiam eleifend aliquet velit, non egestas justo lobortis et. Cras adipiscing eleifend magna, nec lobortis justo posuere ut. Curabitur pretium posuere eros, ac ullamcorper tellus vestibulum ut. Proin vitae odio eget neque viverra commodo. Maecenas nec diam non diam lacinia interdum. Aenean euismod ultricies enim eget vulputate. Nunc eros urna, facilisis ut tristique accumsan, mattis a lectus. Fusce eu risus vitae nunc tristique rhoncus eget ac turpis. Sed ultrices sagittis nulla, ut mollis purus aliquet non. Praesent pharetra suscipit odio non faucibus. Mauris pretium nulla quis lorem porttitor suscipit. Vestibulum nisl mauris, eleifend eu suscipit sit amet, vulputate nec nunc. Aenean bibendum tellus luctus ligula pulvinar sed posuere odio laoreet. Integer lorem justo, ullamcorper at suscipit at, sollicitudin consectetur odio.', 'Thierry', 'thazard@gmail.com', 'M', 'Sa Majesté');
INSERT INTO `Intervenant` VALUES(3, 'GOLDMAN', 'jjgoldman.jpg', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscing leo. Phasellus nec enim quis magna eleifend luctus in at felis. Cras purus libero, dictum non hendrerit at, ultricies ac justo. Proin at justo vitae justo gravida mattis eu sit amet dolor. Sed eleifend purus in massa consectetur sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc eleifend malesuada vestibulum. Praesent at ultricies dolor.', 'Jean-Jacques', 'jjgoldman@gmail.com', 'M', 'Sa Sainteté');

-- --------------------------------------------------------

--
-- Structure de la table `Intervenant_Retraite`
--

CREATE TABLE `Intervenant_Retraite` (
  `Intervenants_intervenant-id` int(11) NOT NULL,
  `Retraite_retraite-id` int(11) NOT NULL,
  PRIMARY KEY (`Intervenants_intervenant-id`,`Retraite_retraite-id`),
  KEY `fk_Intervenants_has_Retraite_Retraite1` (`Retraite_retraite-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Intervenant_Retraite`
--

INSERT INTO `Intervenant_Retraite` VALUES(2, 1);
INSERT INTO `Intervenant_Retraite` VALUES(3, 1);
INSERT INTO `Intervenant_Retraite` VALUES(2, 2);
INSERT INTO `Intervenant_Retraite` VALUES(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Lieu`
--

CREATE TABLE `Lieu` (
  `lieu-id` int(11) NOT NULL AUTO_INCREMENT,
  `lieu-nom` varchar(255) NOT NULL,
  `lieu-adresse1` varchar(255) DEFAULT NULL,
  `lieu-adresse2` varchar(255) DEFAULT NULL,
  `lieu-cp` int(11) NOT NULL,
  `lieu-ville` varchar(255) NOT NULL,
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
  PRIMARY KEY (`lieu-id`),
  KEY `fk_Lieu_Type1` (`Type_type-id`),
  KEY `fk_Lieu_Communaute1` (`Communaute_communaute-id`),
  KEY `fk_Lieu_Administrateur1` (`Administrateur_administrateur-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Lieu`
--

INSERT INTO `Lieu` VALUES(1, 'Abbaye titi', 'Place de la Cathédrale', NULL, 82000, 'MONTAUBAN', 'Aenean euismod ultricies enim eget vulputate. Nunc eros urna, facilisis ut tristique accumsan, mattis a lectus. Fusce eu risus vitae nunc tristique rhoncus eget ac turpis. Sed ultrices sagittis nulla, ut mollis purus aliquet non. Praesent pharetra suscipit odio non faucibus. Mauris pretium nulla quis lorem porttitor suscipit. Vestibulum nisl mauris, eleifend eu suscipit sit amet, vulputate nec nunc. Aenean bibendum tellus luctus ligula pulvinar sed posuere odio laoreet. Integer lorem justo, ullamcorper at suscipit at, sollicitudin consectetur odio.', '1', 1, 'TGV Paris - Toulouse', 'Autoroute A20', 0, NULL, 'www.google.com', 'lieu@mail.com', 'www.facebook.com', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `newsletter-mail` varchar(255) NOT NULL,
  `newsletter-status` tinyint(1) DEFAULT NULL,
  `newsletter-DateInscription` datetime DEFAULT NULL,
  PRIMARY KEY (`newsletter-mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `newsletter`
--

INSERT INTO `newsletter` VALUES('bteillard@gmail.com', 1, '2012-04-14 10:58:54');

-- --------------------------------------------------------

--
-- Structure de la table `Pelerinage`
--

CREATE TABLE `Pelerinage` (
  `pelerinage-id` int(11) NOT NULL AUTO_INCREMENT,
  `pelerinage-nom` varchar(255) NOT NULL,
  `pelerinage-description` text,
  `pelerinage-datedebut` datetime DEFAULT NULL,
  `pelerinage-datefin` datetime DEFAULT NULL,
  `pelerinage-mainphoto` varchar(255) DEFAULT NULL,
  `pelerinage-prix` varchar(45) DEFAULT NULL,
  `pelerinage-contact` text,
  `Lieu_lieu-id` int(11) NOT NULL,
  PRIMARY KEY (`pelerinage-id`),
  KEY `fk_Retraite_Lieu10` (`Lieu_lieu-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Pelerinage`
--

INSERT INTO `Pelerinage` VALUES(1, 'Le Pélé pour les nuls', 'Mauris cursus dignissim erat, et lobortis mauris euismod et. Aliquam mi dolor, malesuada in dignissim adipiscing, fringilla in quam. Fusce aliquet blandit urna, vitae vulputate quam laoreet vitae. Praesent aliquam hendrerit est, eu aliquam erat fermentum at. Nam id dui mauris, sit amet euismod neque. Etiam ac purus leo. Praesent ultricies, elit et ultricies pellentesque, lorem ipsum ultrices purus, quis faucibus massa magna eget enim. Nam a tempus justo. Mauris porttitor, erat vel lacinia pulvinar, libero risus adipiscing neque, nec posuere erat metus eu enim. Sed non velit ac magna mollis egestas nec in nisl. Sed pulvinar elit dolor, sed consequat dui. Donec ac lorem nibh, vel vestibulum metus.\r\n\r\nInteger pulvinar nisi non arcu facilisis hendrerit. In at tortor lorem. Pellentesque vehicula nisl non arcu volutpat porttitor. Donec ultrices pellentesque placerat. Pellentesque interdum augue elit, in laoreet risus. Maecenas laoreet turpis sed nulla consectetur pulvinar. Integer dignissim turpis ac augue tristique aliquam. Ut commodo iaculis pellentesque. Sed dolor ante, lacinia et hendrerit nec, scelerisque id dolor. Morbi bibendum nibh eu turpis aliquet varius. Curabitur vestibulum diam nec odio lobortis vehicula. Cras id elit in enim pulvinar pharetra et egestas massa. Phasellus molestie, nisi eu rhoncus lacinia, lectus lorem consectetur tortor, ac feugiat mauris metus congue massa. Nulla vulputate sapien et mauris fringilla molestie. Nullam eget ante risus, eget sollicitudin lacus. Aliquam ornare posuere orci, non imperdiet sem tempus ac.', '2012-05-30 22:32:29', '2012-06-04 22:32:36', 'nuls.jpg', '10', '<b>Cum sociis natoque penatibus et magnis dis parturient montes</b>, nascetur ridiculus mus. In vitae accumsan erat. Sed et orci lorem. Nam pretium lacus in nibh volutpat fermentum <i>feugiat lectus feugiat. Etiam fermentum lacinia risus id luctus. Nam hendrerit leo mauris, vel </i>gravida nibh. Curabitur lorem quam, rhoncus et varius ac, venenatis ut diam. Sed placerat metus tincidunt metus aliquam id consectetur nisi fringilla. ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE `Photo` (
  `photo-id` int(11) NOT NULL AUTO_INCREMENT,
  `photo-url` varchar(45) DEFAULT NULL,
  `Lieu_lieu-id` int(11) NOT NULL,
  PRIMARY KEY (`photo-id`),
  KEY `fk_Photo_Lieu1` (`Lieu_lieu-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Photo`
--

INSERT INTO `Photo` VALUES(1, 'aaaaa', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Photo_pelerinage`
--

CREATE TABLE `Photo_pelerinage` (
  `photo_retraite-id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_retraite-url` varchar(45) DEFAULT NULL,
  `Pelerinage_pelerinage-id` int(11) NOT NULL,
  PRIMARY KEY (`photo_retraite-id`),
  KEY `fk_Photo_pelerinage_Pelerinage1` (`Pelerinage_pelerinage-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `Photo_pelerinage`
--


-- --------------------------------------------------------

--
-- Structure de la table `Photo_retraite`
--

CREATE TABLE `Photo_retraite` (
  `photo_retraite-id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_retraite-url` varchar(45) DEFAULT NULL,
  `Retraite_retraite-id` int(11) NOT NULL,
  PRIMARY KEY (`photo_retraite-id`),
  KEY `fk_Photo_copy1_Retraite1` (`Retraite_retraite-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `Photo_retraite`
--

INSERT INTO `Photo_retraite` VALUES(1, 'abcde', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Profil`
--

CREATE TABLE `Profil` (
  `profil-id` int(11) NOT NULL AUTO_INCREMENT,
  `profil-nom` varchar(255) DEFAULT NULL,
  `profil-description` text,
  PRIMARY KEY (`profil-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `Profil`
--

INSERT INTO `Profil` VALUES(1, 'normal', 'blabla');
INSERT INTO `Profil` VALUES(2, 'premium', 'blabla mais plus cher');

-- --------------------------------------------------------

--
-- Structure de la table `Retraite`
--

CREATE TABLE `Retraite` (
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
  PRIMARY KEY (`retraite-id`),
  KEY `fk_Retraite_Lieu1` (`Lieu_lieu-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `Retraite`
--

INSERT INTO `Retraite` VALUES(1, 'Question de Chrétiens aux candidats', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ante elit, porta nec imperdiet in, scelerisque sed libero. Donec sit amet enim urna, ut placerat tellus. Sed consectetur sodales quam non tristique. Praesent eget consequat metus. Vestibulum ut elit augue. Etiam eleifend, tortor id convallis fringilla, urna orci interdum magna, eget egestas massa augue a mi. Proin quis lectus erat. Phasellus luctus suscipit enim, non porta odio porta consectetur. Etiam malesuada, turpis a hendrerit ornare, libero nisl ornare elit, a convallis quam nisi quis lacus. Etiam nec lorem mi.\n\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'candidats.jpg', '10', 0, 1, 1);
INSERT INTO `Retraite` VALUES(2, 'Le mariage au centre de la vie de couple', 'Nullam sapien nunc, lobortis ac mollis vitae, congue in eros. Nam dictum quam quis nibh varius dignissim. In hac habitasse platea dictumst. Mauris commodo placerat accumsan. Vivamus in mauris neque. Donec tempor libero vel urna dapibus blandit. Fusce dapibus, neque a varius bibendum, dolor enim bibendum sem, vitae posuere lectus nulla at arcu. Fusce ligula leo, imperdiet ultricies blandit eleifend, sodales in dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi quis metus sit amet lectus pretium vehicula a vitae sem. Phasellus pellentesque lorem eget ipsum sodales lacinia.', '2012-06-20 10:48:52', '2012-06-23 10:49:05', 'mariage.jpg', '20', 1, 1, 1);
INSERT INTO `Retraite` VALUES(3, 'Vivre sa foi au travail', 'Mauris quis libero vel risus accumsan dictum. Etiam neque nibh, tincidunt sed aliquet vel, interdum ac sem. Morbi convallis suscipit tincidunt. In pellentesque hendrerit iaculis. Quisque scelerisque lobortis odio, eu vestibulum neque interdum eu. Cras sit amet urna in felis condimentum ullamcorper non a dolor. Cras et ligula in ante luctus gravida quis at sem. Vestibulum hendrerit blandit magna, non vestibulum erat auctor a. Mauris eleifend adipiscing metus, sit amet consectetur sem feugiat nec. Aliquam velit urna, tempor id iaculis nec, gravida vitae elit. Duis interdum tellus et odio aliquet id dignissim lectus tempor. Aenean faucibus nulla non felis tristique suscipit. Vestibulum euismod consequat augue, eu gravida dui posuere et.', '2012-06-22 10:49:44', '2012-06-22 18:49:44', 'travail.jpg', '7', 0, 0, 1);
INSERT INTO `Retraite` VALUES(4, 'La Bible pour les nuls', 'Nullam sapien nunc, lobortis ac mollis vitae, congue in eros. Nam dictum quam quis nibh varius dignissim. In hac habitasse platea dictumst. Mauris commodo placerat accumsan. Vivamus in mauris neque. Donec tempor libero vel urna dapibus blandit. Fusce dapibus, neque a varius bibendum, dolor enim bibendum sem, vitae posuere lectus nulla at arcu. Fusce ligula leo, imperdiet ultricies blandit eleifend, sodales in dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi quis metus sit amet lectus pretium vehicula a vitae sem. Phasellus pellentesque lorem eget ipsum sodales lacinia.', '2012-08-22 10:48:52', '2012-08-29 10:49:05', 'mariage.jpg', '20', 1, 1, 1);
INSERT INTO `Retraite` VALUES(5, 'L''Humanitaire', 'Mauris quis libero vel risus accumsan dictum. Etiam neque nibh, tincidunt sed aliquet vel, interdum ac sem. Morbi convallis suscipit tincidunt. In pellentesque hendrerit iaculis. Quisque scelerisque lobortis odio, eu vestibulum neque interdum eu. Cras sit amet urna in felis condimentum ullamcorper non a dolor. Cras et ligula in ante luctus gravida quis at sem. Vestibulum hendrerit blandit magna, non vestibulum erat auctor a. Mauris eleifend adipiscing metus, sit amet consectetur sem feugiat nec. Aliquam velit urna, tempor id iaculis nec, gravida vitae elit. Duis interdum tellus et odio aliquet id dignissim lectus tempor. Aenean faucibus nulla non felis tristique suscipit. Vestibulum euismod consequat augue, eu gravida dui posuere et.', '2012-10-22 10:49:44', '2012-10-25 18:49:44', 'humanitaire.jpg', '7', 0, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Theme`
--

CREATE TABLE `Theme` (
  `theme-id` int(11) NOT NULL AUTO_INCREMENT,
  `theme-nom` varchar(255) DEFAULT NULL,
  `theme-description` varchar(255) DEFAULT NULL,
  `theme-image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`theme-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Theme`
--

INSERT INTO `Theme` VALUES(1, 'Célibataires', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'celib.jpg');
INSERT INTO `Theme` VALUES(2, 'Couples', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'couples.jpg');
INSERT INTO `Theme` VALUES(3, 'Etudiants', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'etudiants.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Theme_Pelerinage`
--

CREATE TABLE `Theme_Pelerinage` (
  `Theme_theme-id` int(11) NOT NULL,
  `Pelerinage_pelerinage-id` int(11) NOT NULL,
  PRIMARY KEY (`Theme_theme-id`,`Pelerinage_pelerinage-id`),
  KEY `fk_Categorie_Pelerinage_Pelerinage1` (`Pelerinage_pelerinage-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Theme_Pelerinage`
--


-- --------------------------------------------------------

--
-- Structure de la table `Theme_Retraite`
--

CREATE TABLE `Theme_Retraite` (
  `Theme_theme-id` int(11) NOT NULL,
  `Retraite_retraite-id` int(11) NOT NULL,
  PRIMARY KEY (`Theme_theme-id`,`Retraite_retraite-id`),
  KEY `fk_Categorie_has_Retraite_Retraite1` (`Retraite_retraite-id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `Theme_Retraite`
--


-- --------------------------------------------------------

--
-- Structure de la table `Type`
--

CREATE TABLE `Type` (
  `type-id` int(11) NOT NULL AUTO_INCREMENT,
  `type-nom` varchar(255) DEFAULT NULL,
  `type-description` varchar(255) DEFAULT NULL,
  `type-photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type-id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `Type`
--

INSERT INTO `Type` VALUES(1, 'Couvent', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscin', 'type/couv.jpg');
INSERT INTO `Type` VALUES(2, 'Abbaye', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscin', 'type/abb.jpg');
INSERT INTO `Type` VALUES(3, 'Maison paroissiale', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscin', 'type/mparois.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `User`
--

INSERT INTO `User` VALUES(1, 'jdupont', 'Dupont', 'Jean', 'jdup@gmail.com', 'pwd', '0102030405', '0203040560', 1, 1, 1);
INSERT INTO `User` VALUES(2, 'bteillard2', 'TEILLARD', 'Benjamin', 'bteillard@gmail.com', '6942824801287ed734eb9e362046b483', '0102030405', '0102030405', 1, 1, 1);
INSERT INTO `User` VALUES(3, 'pdelava', 'DELAVA', 'PAUL', 'paul.delava@gmail.com', '40435fb3f3cb6a5bc103d4173be9dc95', '0102030405', '0102030405', 1, 1, 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Administrateur`
--
ALTER TABLE `Administrateur`
  ADD CONSTRAINT `fk_Administrateur_AdminRole1` FOREIGN KEY (`AdminRole_adminrole-id`) REFERENCES `AdminRole` (`adminrole-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Favoris`
--
ALTER TABLE `Favoris`
  ADD CONSTRAINT `fk_Favoris_User1` FOREIGN KEY (`User_user-id`) REFERENCES `User` (`user-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Intervenant_Retraite`
--
ALTER TABLE `Intervenant_Retraite`
  ADD CONSTRAINT `fk_Intervenants_has_Retraite_Intervenants` FOREIGN KEY (`Intervenants_intervenant-id`) REFERENCES `Intervenant` (`intervenant-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Intervenants_has_Retraite_Retraite1` FOREIGN KEY (`Retraite_retraite-id`) REFERENCES `Retraite` (`retraite-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Lieu`
--
ALTER TABLE `Lieu`
  ADD CONSTRAINT `fk_Lieu_Administrateur1` FOREIGN KEY (`Administrateur_administrateur-id`) REFERENCES `Administrateur` (`administrateur-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Lieu_Communaute1` FOREIGN KEY (`Communaute_communaute-id`) REFERENCES `Communaute` (`communaute-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Lieu_Type1` FOREIGN KEY (`Type_type-id`) REFERENCES `Type` (`type-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Pelerinage`
--
ALTER TABLE `Pelerinage`
  ADD CONSTRAINT `fk_Retraite_Lieu10` FOREIGN KEY (`Lieu_lieu-id`) REFERENCES `Lieu` (`lieu-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `fk_Photo_Lieu1` FOREIGN KEY (`Lieu_lieu-id`) REFERENCES `Lieu` (`lieu-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Photo_pelerinage`
--
ALTER TABLE `Photo_pelerinage`
  ADD CONSTRAINT `fk_Photo_pelerinage_Pelerinage1` FOREIGN KEY (`Pelerinage_pelerinage-id`) REFERENCES `Pelerinage` (`pelerinage-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Photo_retraite`
--
ALTER TABLE `Photo_retraite`
  ADD CONSTRAINT `fk_Photo_copy1_Retraite1` FOREIGN KEY (`Retraite_retraite-id`) REFERENCES `Retraite` (`retraite-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Retraite`
--
ALTER TABLE `Retraite`
  ADD CONSTRAINT `fk_Retraite_Lieu1` FOREIGN KEY (`Lieu_lieu-id`) REFERENCES `Lieu` (`lieu-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Theme_Pelerinage`
--
ALTER TABLE `Theme_Pelerinage`
  ADD CONSTRAINT `fk_Categorie_has_Retraite_Categorie10` FOREIGN KEY (`Theme_theme-id`) REFERENCES `Theme` (`theme-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categorie_Pelerinage_Pelerinage1` FOREIGN KEY (`Pelerinage_pelerinage-id`) REFERENCES `Pelerinage` (`pelerinage-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Theme_Retraite`
--
ALTER TABLE `Theme_Retraite`
  ADD CONSTRAINT `fk_Categorie_has_Retraite_Categorie1` FOREIGN KEY (`Theme_theme-id`) REFERENCES `Theme` (`theme-id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Categorie_has_Retraite_Retraite1` FOREIGN KEY (`Retraite_retraite-id`) REFERENCES `Retraite` (`retraite-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `fk_User_Profil1` FOREIGN KEY (`Profil_profil-id`) REFERENCES `Profil` (`profil-id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
