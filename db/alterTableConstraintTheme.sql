ALTER TABLE  `tre_themeretraite` DROP FOREIGN KEY  `FK_theme_retraite_retraite` ;

ALTER TABLE  `tre_themeretraite` ADD CONSTRAINT  `FK_theme_evenement` FOREIGN KEY (  `themeRetraiteRetraiteId` ) REFERENCES  `spk`.`eve_evenements` (
`eve_int_id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;


ALTER TABLE  `ire_intervenantretraite` DROP FOREIGN KEY  `FK_intervenant_retraite_intervenant` ;

ALTER TABLE  `ire_intervenantretraite` ADD CONSTRAINT  `FK_intervenant_evenement_intervenant` FOREIGN KEY (  `intervenantRetraiteIntervenantId` ) REFERENCES  `spk`.`int_intervenant` (
`intervenantId`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;

ALTER TABLE  `ire_intervenantretraite` DROP FOREIGN KEY  `FK_intervenant_retraite_retraite` ;

ALTER TABLE  `ire_intervenantretraite` ADD CONSTRAINT  `FK_intervenant_evenement_evenement` FOREIGN KEY (  `intervenantRetraiteRetraiteId` ) REFERENCES  `spk`.`eve_evenements` (
`eve_int_id`
) ON DELETE CASCADE ON UPDATE RESTRICT ;
