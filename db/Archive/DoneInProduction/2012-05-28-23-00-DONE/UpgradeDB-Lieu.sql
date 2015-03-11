#Supprimer les booleens sur les acces train et avion
ALTER TABLE `lieu`
  DROP `lieu-acces-train`,
  DROP `lieu-acces-avion`;

#renommer les champs description
ALTER TABLE  `lieu` CHANGE  `lieu-acces-train-desc`  `lieu-acces-train` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE  `lieu` CHANGE  `lieu-acces-avion-desc`  `lieu-acces-avion` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;