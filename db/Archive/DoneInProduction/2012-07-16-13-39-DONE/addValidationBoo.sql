#Table Theme: rajoute le champ et modifie toutes les valeurs
ALTER TABLE  `theme` ADD  `theme-valid` TINYINT NOT NULL;
UPDATE  `theme` SET  `theme-valid` =  '1';

#Table Intervenant: rajoute le champ de valid et mets toutes les valeurs à 1
ALTER TABLE  `intervenant` ADD  `intervenant-valid` TINYINT NOT NULL;
UPDATE `intervenant` SET  `intervenant-valid` =  '1';

ALTER TABLE  `communaute` ADD  `communaute-valid` TINYINT NOT NULL;
UPDATE `communaute` SET  `communaute-valid` =  '1';
