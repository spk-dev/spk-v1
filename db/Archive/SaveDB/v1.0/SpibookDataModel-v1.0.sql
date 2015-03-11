SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `spibook-1.0` ;
CREATE SCHEMA IF NOT EXISTS `spibook-1.0` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
SHOW WARNINGS;
USE `spibook-1.0` ;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Type` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Type` (
  `type-id` INT NOT NULL AUTO_INCREMENT ,
  `type-nom` VARCHAR(255) NULL ,
  `type-description` VARCHAR(255) NULL ,
  `type-photo` VARCHAR(255) NULL ,
  PRIMARY KEY (`type-id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Communaute`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Communaute` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Communaute` (
  `communaute-id` INT NOT NULL AUTO_INCREMENT ,
  `communaute-nom` VARCHAR(255) NULL ,
  `communaute-description` TEXT NULL ,
  `communication-photo` VARCHAR(255) NULL ,
  PRIMARY KEY (`communaute-id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`AdminRole`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`AdminRole` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`AdminRole` (
  `adminrole-id` INT NOT NULL AUTO_INCREMENT ,
  `adminrole-nom` VARCHAR(255) NULL ,
  `adminrole-description` VARCHAR(255) NULL ,
  PRIMARY KEY (`adminrole-id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Administrateur`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Administrateur` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Administrateur` (
  `administrateur-id` INT NOT NULL AUTO_INCREMENT ,
  `administrateur-nom` VARCHAR(45) NULL ,
  `administrateur-prenom` VARCHAR(45) NULL ,
  `administrateur-mail` VARCHAR(45) NULL ,
  `administrateur-password` VARCHAR(45) NULL ,
  `administrateur-tel` VARCHAR(45) NULL ,
  `AdminRole_adminrole-id` INT NOT NULL ,
  PRIMARY KEY (`administrateur-id`) ,
  CONSTRAINT `fk_Administrateur_AdminRole1`
    FOREIGN KEY (`AdminRole_adminrole-id` )
    REFERENCES `spibook-1.0`.`AdminRole` (`adminrole-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Lieu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Lieu` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Lieu` (
  `lieu-id` INT NOT NULL AUTO_INCREMENT ,
  `lieu-nom` VARCHAR(255) NOT NULL ,
  `lieu-adresse1` VARCHAR(255) NULL ,
  `lieu-adresse2` VARCHAR(255) NULL ,
  `lieu-cp` INT NOT NULL ,
  `lieu-ville` VARCHAR(255) NOT NULL ,
  `lieu-description` TEXT NULL ,
  `lieu-mainphoto` VARCHAR(255) NULL ,
  `lieu-acces-train` TINYINT(1) NULL ,
  `lieu-acces-train-desc` VARCHAR(255) NULL ,
  `lieu-acces-voiture` VARCHAR(255) NULL ,
  `lieu-acces-avion` TINYINT(1) NULL ,
  `lieu-acces-avion-desc` VARCHAR(255) NULL ,
  `lieu-lien-siteweb` VARCHAR(255) NULL ,
  `lieu-mail` VARCHAR(255) NULL ,
  `lieu-lien-inscription` VARCHAR(45) NULL ,
  `Type_type-id` INT NOT NULL ,
  `Communaute_communaute-id` INT NOT NULL ,
  `Administrateur_administrateur-id` INT NOT NULL ,
  PRIMARY KEY (`lieu-id`) ,
  CONSTRAINT `fk_Lieu_Type1`
    FOREIGN KEY (`Type_type-id` )
    REFERENCES `spibook-1.0`.`Type` (`type-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieu_Communaute1`
    FOREIGN KEY (`Communaute_communaute-id` )
    REFERENCES `spibook-1.0`.`Communaute` (`communaute-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Lieu_Administrateur1`
    FOREIGN KEY (`Administrateur_administrateur-id` )
    REFERENCES `spibook-1.0`.`Administrateur` (`administrateur-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Retraite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Retraite` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Retraite` (
  `retraite-id` INT NOT NULL AUTO_INCREMENT ,
  `retraite-nom` VARCHAR(255) NOT NULL ,
  `retraite-description` TEXT NULL ,
  `retraite-datedebut` DATETIME NULL ,
  `retraite-datefin` DATETIME NULL ,
  `retraite-mainphoto` VARCHAR(255) NULL ,
  `retraite-prix` VARCHAR(45) NULL ,
  `retraite-garderie` TINYINT(1) NULL ,
  `retraite-hebergement` TINYINT(1) NOT NULL DEFAULT 1 ,
  `Lieu_lieu-id` INT NOT NULL ,
  PRIMARY KEY (`retraite-id`) ,
  CONSTRAINT `fk_Retraite_Lieu1`
    FOREIGN KEY (`Lieu_lieu-id` )
    REFERENCES `spibook-1.0`.`Lieu` (`lieu-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Intervenant`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Intervenant` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Intervenant` (
  `intervenant-id` INT NOT NULL AUTO_INCREMENT ,
  `intervenant-nom` VARCHAR(255) NOT NULL ,
  `intervenant-photo` VARCHAR(255) NULL ,
  `intervenant-description` TEXT NULL ,
  `intervenant-prenom` VARCHAR(45) NULL ,
  `intervenant-mail` VARCHAR(45) NULL ,
  `intervenant-genre` VARCHAR(45) NULL ,
  `Intervenant-titre` VARCHAR(45) NULL ,
  PRIMARY KEY (`intervenant-id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Intervenant_Retraite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Intervenant_Retraite` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Intervenant_Retraite` (
  `Intervenants_intervenant-id` INT NOT NULL ,
  `Retraite_retraite-id` INT NOT NULL ,
  PRIMARY KEY (`Intervenants_intervenant-id`, `Retraite_retraite-id`) ,
  CONSTRAINT `fk_Intervenants_has_Retraite_Intervenants`
    FOREIGN KEY (`Intervenants_intervenant-id` )
    REFERENCES `spibook-1.0`.`Intervenant` (`intervenant-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Intervenants_has_Retraite_Retraite1`
    FOREIGN KEY (`Retraite_retraite-id` )
    REFERENCES `spibook-1.0`.`Retraite` (`retraite-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Theme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Theme` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Theme` (
  `theme-id` INT NOT NULL AUTO_INCREMENT ,
  `theme-nom` VARCHAR(255) NULL ,
  `theme-description` VARCHAR(255) NULL ,
  `theme-image` VARCHAR(255) NULL ,
  PRIMARY KEY (`theme-id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Theme_Retraite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Theme_Retraite` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Theme_Retraite` (
  `Theme_theme-id` INT NOT NULL ,
  `Retraite_retraite-id` INT NOT NULL ,
  PRIMARY KEY (`Theme_theme-id`, `Retraite_retraite-id`) ,
  CONSTRAINT `fk_Categorie_has_Retraite_Categorie1`
    FOREIGN KEY (`Theme_theme-id` )
    REFERENCES `spibook-1.0`.`Theme` (`theme-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categorie_has_Retraite_Retraite1`
    FOREIGN KEY (`Retraite_retraite-id` )
    REFERENCES `spibook-1.0`.`Retraite` (`retraite-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Profil`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Profil` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Profil` (
  `profil-id` INT NOT NULL AUTO_INCREMENT ,
  `profil-nom` VARCHAR(255) NULL ,
  `profil-description` TEXT NULL ,
  PRIMARY KEY (`profil-id`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`User`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`User` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`User` (
  `user-id` INT NOT NULL AUTO_INCREMENT ,
  `user-login` VARCHAR(255) NOT NULL ,
  `user-nom` VARCHAR(255) NULL ,
  `user-prenom` VARCHAR(255) NULL ,
  `user-mail` VARCHAR(255) NULL ,
  `user-password` VARCHAR(45) NULL ,
  `user-tel1` VARCHAR(45) NULL ,
  `user-tel2` VARCHAR(45) NULL ,
  `user-newsletter` TINYINT(1) NOT NULL DEFAULT 1 ,
  `user-optin` TINYINT(1) NOT NULL DEFAULT 1 ,
  `Profil_profil-id` INT NOT NULL ,
  PRIMARY KEY (`user-id`) ,
  CONSTRAINT `fk_User_Profil1`
    FOREIGN KEY (`Profil_profil-id` )
    REFERENCES `spibook-1.0`.`Profil` (`profil-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Favoris`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Favoris` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Favoris` (
  `favoris-id` INT NOT NULL AUTO_INCREMENT COMMENT 'Les favoris seront les ID des différentes tables séparées par des virgules\n' ,
  `favoris-communautes` VARCHAR(255) NULL ,
  `favoris-types` VARCHAR(255) NULL ,
  `favoris-categories` VARCHAR(255) NULL ,
  `favoris-lieus` VARCHAR(255) NULL ,
  `favoris-retraites` VARCHAR(255) NULL ,
  `favoris-intervenants` VARCHAR(255) NULL ,
  `User_user-id` INT NOT NULL ,
  PRIMARY KEY (`favoris-id`) ,
  UNIQUE INDEX `User_user-id_UNIQUE` (`User_user-id` ASC) ,
  CONSTRAINT `fk_Favoris_User1`
    FOREIGN KEY (`User_user-id` )
    REFERENCES `spibook-1.0`.`User` (`user-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Photo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Photo` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Photo` (
  `photo-id` INT NOT NULL AUTO_INCREMENT ,
  `photo-url` VARCHAR(45) NULL ,
  `Lieu_lieu-id` INT NOT NULL ,
  PRIMARY KEY (`photo-id`) ,
  CONSTRAINT `fk_Photo_Lieu1`
    FOREIGN KEY (`Lieu_lieu-id` )
    REFERENCES `spibook-1.0`.`Lieu` (`lieu-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Photo_retraite`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Photo_retraite` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Photo_retraite` (
  `photo_retraite-id` INT NOT NULL AUTO_INCREMENT ,
  `photo_retraite-url` VARCHAR(45) NULL ,
  `Retraite_retraite-id` INT NOT NULL ,
  PRIMARY KEY (`photo_retraite-id`) ,
  CONSTRAINT `fk_Photo_copy1_Retraite1`
    FOREIGN KEY (`Retraite_retraite-id` )
    REFERENCES `spibook-1.0`.`Retraite` (`retraite-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Pelerinage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Pelerinage` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Pelerinage` (
  `pelerinage-id` INT NOT NULL AUTO_INCREMENT ,
  `pelerinage-nom` VARCHAR(255) NOT NULL ,
  `pelerinage-description` TEXT NULL ,
  `pelerinage-datedebut` DATETIME NULL ,
  `pelerinage-datefin` DATETIME NULL ,
  `pelerinage-mainphoto` VARCHAR(255) NULL ,
  `pelerinage-prix` VARCHAR(45) NULL ,
  `pelerinage-contact` TEXT NULL ,
  `Lieu_lieu-id` INT NOT NULL ,
  PRIMARY KEY (`pelerinage-id`) ,
  CONSTRAINT `fk_Retraite_Lieu10`
    FOREIGN KEY (`Lieu_lieu-id` )
    REFERENCES `spibook-1.0`.`Lieu` (`lieu-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Theme_Pelerinage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Theme_Pelerinage` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Theme_Pelerinage` (
  `Theme_theme-id` INT NOT NULL ,
  `Pelerinage_pelerinage-id` INT NOT NULL ,
  PRIMARY KEY (`Theme_theme-id`, `Pelerinage_pelerinage-id`) ,
  CONSTRAINT `fk_Categorie_has_Retraite_Categorie10`
    FOREIGN KEY (`Theme_theme-id` )
    REFERENCES `spibook-1.0`.`Theme` (`theme-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Categorie_Pelerinage_Pelerinage1`
    FOREIGN KEY (`Pelerinage_pelerinage-id` )
    REFERENCES `spibook-1.0`.`Pelerinage` (`pelerinage-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`newsletter`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`newsletter` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`newsletter` (
  `newsletter-mail` INT NOT NULL ,
  `newsletter-status` TINYINT(1) NULL ,
  `newsletter-DateInscription` DATETIME NULL ,
  PRIMARY KEY (`newsletter-mail`) )
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `spibook-1.0`.`Photo_pelerinage`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `spibook-1.0`.`Photo_pelerinage` ;

SHOW WARNINGS;
CREATE  TABLE IF NOT EXISTS `spibook-1.0`.`Photo_pelerinage` (
  `photo_retraite-id` INT NOT NULL AUTO_INCREMENT ,
  `photo_retraite-url` VARCHAR(45) NULL ,
  `Pelerinage_pelerinage-id` INT NOT NULL ,
  PRIMARY KEY (`photo_retraite-id`) ,
  CONSTRAINT `fk_Photo_pelerinage_Pelerinage1`
    FOREIGN KEY (`Pelerinage_pelerinage-id` )
    REFERENCES `spibook-1.0`.`Pelerinage` (`pelerinage-id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SHOW WARNINGS;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Type`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Type` (`type-id`, `type-nom`, `type-description`, `type-photo`) VALUES (NULL, 'Couvent', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscing leo. Phasellus nec enim quis magna eleifend luctus in at felis. Cras purus libero, dictum non hendrerit at, ultricies ac justo. Proin at justo vitae justo gravida mattis eu sit amet dolor. Sed eleifend purus in massa consectetur sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc eleifend malesuada vestibulum. Praesent at ultricies dolor.', 'type/couv.jpg');
INSERT INTO `spibook-1.0`.`Type` (`type-id`, `type-nom`, `type-description`, `type-photo`) VALUES (NULL, 'Abbaye', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscing leo. Phasellus nec enim quis magna eleifend luctus in at felis. Cras purus libero, dictum non hendrerit at, ultricies ac justo. Proin at justo vitae justo gravida mattis eu sit amet dolor. Sed eleifend purus in massa consectetur sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc eleifend malesuada vestibulum. Praesent at ultricies dolor.', 'type/abb.jpg');
INSERT INTO `spibook-1.0`.`Type` (`type-id`, `type-nom`, `type-description`, `type-photo`) VALUES (NULL, 'Maison paroissiale', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscing leo. Phasellus nec enim quis magna eleifend luctus in at felis. Cras purus libero, dictum non hendrerit at, ultricies ac justo. Proin at justo vitae justo gravida mattis eu sit amet dolor. Sed eleifend purus in massa consectetur sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc eleifend malesuada vestibulum. Praesent at ultricies dolor.', 'type/mparois.jpg');

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Communaute`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Communaute` (`communaute-id`, `communaute-nom`, `communaute-description`, `communication-photo`) VALUES (NULL, 'Communauté de l\'Emmanuel', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/emmanuel.jpg');
INSERT INTO `spibook-1.0`.`Communaute` (`communaute-id`, `communaute-nom`, `communaute-description`, `communication-photo`) VALUES (NULL, 'Bénédictins', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/benedictin.jpg');
INSERT INTO `spibook-1.0`.`Communaute` (`communaute-id`, `communaute-nom`, `communaute-description`, `communication-photo`) VALUES (NULL, 'Dominicains', 'icies nibh. Phasellus in sem sit amet sapien pharetra faucibus quis sed diam. Nulla vitae sapien vitae augue pharetra porttitor quis non tellus. Sed fermentum sagittis massa vel lacinia. Aenean ullamcorper tempor sodales. Class aptent taciti sociosqu ad litora torquent per conub', 'comm/dominicains.jpg');

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`AdminRole`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`AdminRole` (`adminrole-id`, `adminrole-nom`, `adminrole-description`) VALUES (NULL, 'SuperAdmin', 'big chief');
INSERT INTO `spibook-1.0`.`AdminRole` (`adminrole-id`, `adminrole-nom`, `adminrole-description`) VALUES (NULL, 'Admin', 'middle chief');

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Administrateur`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Administrateur` (`administrateur-id`, `administrateur-nom`, `administrateur-prenom`, `administrateur-mail`, `administrateur-password`, `administrateur-tel`, `AdminRole_adminrole-id`) VALUES (NULL, 'Teillard', 'Benjamin', 'bteillard@gmail.com', 'password', '0102030405', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Lieu`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Lieu` (`lieu-id`, `lieu-nom`, `lieu-adresse1`, `lieu-adresse2`, `lieu-cp`, `lieu-ville`, `lieu-description`, `lieu-mainphoto`, `lieu-acces-train`, `lieu-acces-train-desc`, `lieu-acces-voiture`, `lieu-acces-avion`, `lieu-acces-avion-desc`, `lieu-lien-siteweb`, `lieu-mail`, `lieu-lien-inscription`, `Type_type-id`, `Communaute_communaute-id`, `Administrateur_administrateur-id`) VALUES (NULL, 'Abbaye titi', 'Place de la Cathédrale', NULL, 82000, 'MONTAUBAN', 'Aenean euismod ultricies enim eget vulputate. Nunc eros urna, facilisis ut tristique accumsan, mattis a lectus. Fusce eu risus vitae nunc tristique rhoncus eget ac turpis. Sed ultrices sagittis nulla, ut mollis purus aliquet non. Praesent pharetra suscipit odio non faucibus. Mauris pretium nulla quis lorem porttitor suscipit. Vestibulum nisl mauris, eleifend eu suscipit sit amet, vulputate nec nunc. Aenean bibendum tellus luctus ligula pulvinar sed posuere odio laoreet. Integer lorem justo, ullamcorper at suscipit at, sollicitudin consectetur odio.', '1', 1, 'TGV Paris - Toulouse', 'Autoroute A20', 0, NULL, 'www.google.com', 'lieu@mail.com', 'www.facebook.com', 1, 1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Retraite`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Retraite` (`retraite-id`, `retraite-nom`, `retraite-description`, `retraite-datedebut`, `retraite-datefin`, `retraite-mainphoto`, `retraite-prix`, `retraite-garderie`, `retraite-hebergement`, `Lieu_lieu-id`) VALUES (NULL, 'Question de Chrétiens aux candidats', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ante elit, porta nec imperdiet in, scelerisque sed libero. Donec sit amet enim urna, ut placerat tellus. Sed consectetur sodales quam non tristique. Praesent eget consequat metus. Vestibulum ut elit augue. Etiam eleifend, tortor id convallis fringilla, urna orci interdum magna, eget egestas massa augue a mi. Proin quis lectus erat. Phasellus luctus suscipit enim, non porta odio porta consectetur. Etiam malesuada, turpis a hendrerit ornare, libero nisl ornare elit, a convallis quam nisi quis lacus. Etiam nec lorem mi.\n\n', '01/06/2012', '10/06/2012', 'candidats.jpg', '10', 0, 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Intervenant`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Intervenant` (`intervenant-id`, `intervenant-nom`, `intervenant-photo`, `intervenant-description`, `intervenant-prenom`, `intervenant-mail`, `intervenant-genre`, `Intervenant-titre`) VALUES (NULL, 'DOE', 'jdoe.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi eget elementum quam. Quisque sit amet orci vitae lorem ullamcorper adipiscing. Maecenas at pellentesque elit. Vivamus sagittis venenatis convallis. Nulla metus diam, tincidunt at lacinia sed, dictum sed velit. Vestibulum orci lorem, ultricies in ultricies non, volutpat at ligula. Cras lectus mi, placerat eu vestibulum eget, mattis vitae diam. Fusce tellus augue, fringilla vel accumsan a, ullamcorper eget velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\n\n', 'John', 'jdoe@gmail.com', 'M', 'SAS');
INSERT INTO `spibook-1.0`.`Intervenant` (`intervenant-id`, `intervenant-nom`, `intervenant-photo`, `intervenant-description`, `intervenant-prenom`, `intervenant-mail`, `intervenant-genre`, `Intervenant-titre`) VALUES (NULL, 'Hazard', 'thazard.jpg', 'Etiam eleifend aliquet velit, non egestas justo lobortis et. Cras adipiscing eleifend magna, nec lobortis justo posuere ut. Curabitur pretium posuere eros, ac ullamcorper tellus vestibulum ut. Proin vitae odio eget neque viverra commodo. Maecenas nec diam non diam lacinia interdum. Aenean euismod ultricies enim eget vulputate. Nunc eros urna, facilisis ut tristique accumsan, mattis a lectus. Fusce eu risus vitae nunc tristique rhoncus eget ac turpis. Sed ultrices sagittis nulla, ut mollis purus aliquet non. Praesent pharetra suscipit odio non faucibus. Mauris pretium nulla quis lorem porttitor suscipit. Vestibulum nisl mauris, eleifend eu suscipit sit amet, vulputate nec nunc. Aenean bibendum tellus luctus ligula pulvinar sed posuere odio laoreet. Integer lorem justo, ullamcorper at suscipit at, sollicitudin consectetur odio.', 'Thierry', 'thazard@gmail.com', 'M', 'Sa Majesté');
INSERT INTO `spibook-1.0`.`Intervenant` (`intervenant-id`, `intervenant-nom`, `intervenant-photo`, `intervenant-description`, `intervenant-prenom`, `intervenant-mail`, `intervenant-genre`, `Intervenant-titre`) VALUES (NULL, 'GOLDMAN', 'jjgoldman.jpg', 'Aenean lacinia lobortis enim, vel ultrices justo facilisis vel. Morbi lobortis bibendum pellentesque. Etiam nisl leo, pretium et venenatis nec, rhoncus nec neque. Aliquam aliquet iaculis bibendum. Cras in augue massa, quis ultricies nisi. Nam at adipiscing leo. Phasellus nec enim quis magna eleifend luctus in at felis. Cras purus libero, dictum non hendrerit at, ultricies ac justo. Proin at justo vitae justo gravida mattis eu sit amet dolor. Sed eleifend purus in massa consectetur sollicitudin. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc eleifend malesuada vestibulum. Praesent at ultricies dolor.', 'Jean-Jacques', 'jjgoldman@gmail.com', 'M', 'Sa Sainteté');

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Theme`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Theme` (`theme-id`, `theme-nom`, `theme-description`, `theme-image`) VALUES (NULL, 'Célibataires', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'celib.jpg');
INSERT INTO `spibook-1.0`.`Theme` (`theme-id`, `theme-nom`, `theme-description`, `theme-image`) VALUES (NULL, 'Couples', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'couples.jpg');
INSERT INTO `spibook-1.0`.`Theme` (`theme-id`, `theme-nom`, `theme-description`, `theme-image`) VALUES (NULL, 'Etudiants', 'orci luctus et ultrices posuere cubilia Curae; Morbi porta, leo a luctus viverra, libero erat sodales diam, id consectetur dolor enim a est. Etiam ultrices tellus sed lacus commodo sit amet facilisis odio condimentum. Phasellus venenatis lectus ac nibh a', 'etudiants.jpg');

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Profil`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Profil` (`profil-id`, `profil-nom`, `profil-description`) VALUES (NULL, 'normal', 'blabla');
INSERT INTO `spibook-1.0`.`Profil` (`profil-id`, `profil-nom`, `profil-description`) VALUES (NULL, 'premium', 'blabla mais plus cher');

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`User`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`User` (`user-id`, `user-login`, `user-nom`, `user-prenom`, `user-mail`, `user-password`, `user-tel1`, `user-tel2`, `user-newsletter`, `user-optin`, `Profil_profil-id`) VALUES (NULL, NULL, 'Dupont', 'Jean', 'jdup@gmail.com', 'pwd', '0102030405', '0203040560', NULL, 1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Favoris`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Favoris` (`favoris-id`, `favoris-communautes`, `favoris-types`, `favoris-categories`, `favoris-lieus`, `favoris-retraites`, `favoris-intervenants`, `User_user-id`) VALUES (NULL, '1', '1', '1', '1', '1', '1', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Photo`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Photo` (`photo-id`, `photo-url`, `Lieu_lieu-id`) VALUES (NULL, 'aaaaa', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `spibook-1.0`.`Photo_retraite`
-- -----------------------------------------------------
START TRANSACTION;
USE `spibook-1.0`;
INSERT INTO `spibook-1.0`.`Photo_retraite` (`photo_retraite-id`, `photo_retraite-url`, `Retraite_retraite-id`) VALUES (NULL, 'abcde', 1);

COMMIT;
