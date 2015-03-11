<?php 

/*****************************************************************
******************************************************************
*******************  TABLES  *************************************
******************************************************************
******************************************************************/


$table['adm']=array(
    "#"=>"adm_administrateur",
    "Id"=>"administrateurId",
    "Nom"=>"administrateurNom",
    "Prenom"=>"administrateurPrenom",
    "Mail"=>"administrateurMail",
    "Password"=>"administrateurPassword",
    "Tel"=>"administrateurTel",
    "RoleId"=>"administrateurRoleId",
    "DateLastConnect"=>"administrateurDateLastConnect",
    "DateInscription" => "administrateurInscription",
    "Key" => "adm_var_key"
);

$table['aro']=array(
    "#"=>"aro_adminRole",
    "Id"=>"adminRoleId",
    "Nom"=>"adminRoleNom",
    "Description"=>"adminRoleDescription"
);

$table['com']=array(
    "#"=>"com_communaute",
    "Id"=>"communauteId",
    "Nom"=>"communauteNom",
    "Description"=>"communauteDescription",
    "Photo"=>"communautePhoto",
    "Valid"=>"communauteValid"
);

$table['fav']=array(
    "#"=>"fav_favoris",
    "Id"=>"favorisId",
    "Communautes"=>"favorisCommunautes",
    "Types"=>"favorisTypes",
    "favoriCategories"=>"favoriCategories",
    "Lieus"=>"favorisLieus",
    "Retraites"=>"favorisRetraites",
    "Intervenants"=>"favorisIntervenants",
    "UserId"=>"favorisUserId"
);

$table['int']=array(
    "#"=>"int_intervenant",
    "Id"=>"intervenantId",
    "Nom"=>"intervenantNom",
    "Photo"=>"intervenantPhoto",
    "Description"=>"intervenantDescription",
    "Prenom"=>"intervenantPrenom",
    "Mail"=>"intervenantMail",
    "Genre"=>"intervenantGenre",
    "Titre"=>"intervenantTitre",
    "Valid"=>"intervenantValid",
    "Admin"=>"int_adm_int_id"
);

$table['ire']=array(
    "#"=>"ire_intervenantretraite",
    "IntervenantId"=>"intervenantRetraiteIntervenantId",
    "RetraiteId"=>"intervenantRetraiteRetraiteId"
);

$table['lge']=array(
    "#"=>"lge_lieuGeocode",
    "Id"=>"lieuGeocodeId",
    "Lat"=>"lieuGeocodeLat",
    "Long"=>"lieuGeocodeLong"
);



$table['org']=array(
    "#"=>"org_organisateurs",
    "Id"=>"org_int_id",
    "Nom"=>"org_var_nom",
    "Description"=>"org_var_description",
    "Hebergement"=>"org_var_hebergement",
    "Mainphoto"=>"org_var_photo",
    "AccesTrain"=>"org_var_train",
    "AccesVoiture"=>"org_var_voiture",
    "AccesAvion"=>"org_var_avion",
    "LienSiteweb"=>"org_var_siteweb",
    "Mail"=>"org_var_mail",
    "Tel"=>"org_var_tel",
    "Fax"=>"org_var_fax",
    "TypeId"=>"org_typ_int_id",
    "CommunauteId"=>"org_com_int_id",
    "AdministrateurId"=>"org_adm_int_id",
    "DateEnregistrement"=>"org_date_enregistrement",
    "ValidationAdmin"=>"org_boo_valid_admin",
    "ValidationSuperAdmin"=>"org_boo_valid_super_admin",
    "PlaceId"=>"org_pla_int_id"
);

$table['mde']=array(
    "#"=>"mde_mapdepartement",
    "Id"=>"mapDepartementId",
    "RegionId"=>"mapDepartementRegionId",
    "Code"=>"mapDepartementCode",
    "Nom"=>"mapDepartementNom"
);

$table['mre']=array(
    "#"=>"mre_mapregion",
    "Id"=>"mapRegionId",
    "Nom"=>"mapRegionNom"
);

$table['mvi']=array(
    "#"=>"mvi_mapville",
    "Id"=>"mapVilleId",
    "DepartementId"=>"mapVilleDepartementId",
    "Nom"=>"mapVilleNom",
    "Cp"=>"mapVilleCp",
    "Lat"=>"mapVillelat",
    "Lon"=>"mapVillelon"
);

$table['new']=array(
    "#"=>"new_newsletter",
    "Nom"=>"new_var_nom",
    "Prenom"=>"new_var_prenom",
    "Mail"=>"new_var_mail",
    "Status"=>"new_boo_status",
    "DateInscription"=>"new_date_dateInscription",
    "Optin" =>"new_boo_optin",
    "Key" => "new_var_unsuscribeKey"
);

$table['pli']=array(
    "#"=>"pli_photolieu",
    "Id"=>"photoLieuId",
    "Nom"=>"photoLieuNom",
    "LieuID"=>"photoLieuLieuID"
);

$table['pre']=array(
    "#"=>"pre_photoRetraite",
    "Id"=>"photoRetraiteId",
    "Nom"=>"photoRetraiteNom",
    "RetraiteId"=>"photoRetraiteRetraiteId"
);

$table['pro']=array(
    "#"=>"pro_profil",
    "Id"=>"profilId",
    "Nom"=>"profilNom",
    "Description"=>"profilDescription"
);



$table['eve']=array(
    "#"=>"eve_evenements",
    "Id"=>"eve_int_id",
    "Nom"=>"eve_var_titre",
    "Description"=>"eve_var_description",
    "MailInscription"=>"eve_var_mail_inscription",
    "ContacInscription"=>"eve_var_contact",
    "Datedebut"=>"eve_date_debut",
    "Datefin"=>"eve_date_fin",
    "Mainphoto"=>"eve_var_image",
    "Prix"=>"eve_var_prix",
    "Garderie"=>"eve_boo_garderie",
    "Hebergement"=>"eve_boo_hebergement",
    "LieuId"=>"eve_lieu_int_id",
    "TypeEvenement"=>"eve_tev_int_id",
    "DateEnregistrement"=>"eve_date_enregistrement",
    "PlaceId"=>"eve_pla_int_id"
);

$table['the']=array(
    "#"=>"the_theme",
    "Id"=>"themeId",
    "Nom"=>"themeNom",
    "Description"=>"themeDescription",
    "Image"=>"themeImage",
    "Valid"=>"themeValid"
);

$table['tre']=array(
    "#"=>"tre_themeretraite",
    "ThemeId"=>"themeRetraiteThemeId",
    "RetraiteId"=>"themeRetraiteRetraiteId",
    "Priority"=>"themeRetraitePriority"
);

$table['typ']=array(
    "#"=>"typ_type",
    "Id"=>"typeId",
    "Nom"=>"typeNom",
    "Description"=>"typeDescription",
    "Photo"=>"typePhoto"
);

$table['use']=array(
    "#"=>"use_user",
    "Id"=>"userId",
    "Login"=>"userLogin",
    "Nom"=>"useNom",
    "Prenom"=>"userPrenom",
    "Mail"=>"userMail",
    "Password"=>"userPassword",
    "Tel1"=>"userTel1",
    "Tel2"=>"userTel2",
    "Newsletter"=>"userNewsletter",
    "Optin"=>"userOptin",
    "ProfilId"=>"userProfilId"
);


$table['tev']=array(
    "#"=>"tev_typeevenement",
    "Id"=>"tev_int_id",
    "Libelle"=>"tev_var_libelle",
    "Photo"=>"tev_var_img",
    "Description"=>"tev_var_description"
);

$table['dia']=array(
    "#"=>"dia_diaporama",
    "Id"=>"dia_int_id",
    "EvenementId"=>"dia_eve_int_id",
    "Lien"=>"dia_var_lien",
    "Ordre"=>"dia_int_ordre"
);

$table['lis'] = array(
    "#" =>"lis_lien",
    "Id"=>"lis_int_id",
    "Libelle"=>"lis_var_libelle",
    "Lien"=>"lis_var_lien"
);


$table['pla'] = array(
    "#" => "pla_places",
    "Id"=>"pla_int_id",
    "Adresse1"=>"pla_var_adresse1" ,
    "Adresse2"=>"pla_var_adresse2" ,
    "Cp"=>"pla_int_cp" ,
    "Ville"=>"pla_var_ville",
    "Pays"=>"pla_var_pays",
    "Lat"=>"pla_dec_lat",
    "Long"=>"pla_dec_long"
);


/*****************************************************************
******************************************************************
*******************  VUES  ***************************************
******************************************************************
******************************************************************/

$table['vlc'] = array(
    "#" =>"view_lieu_complete2",
    "NbTotal"=>"nbEventTotal",
    "NbAVenir"=>"nbEventAVenir"
    // Les autres champs ont les noms des tables d'origines
    // Lie_lieu
    // mre_mapRegion
    // mde_mapDepartement
);


$table['vel'] = array(
  "#" => "view_evenements_light",
);

$table['vev'] = array(
  "#" => "view_evenements_valid",
);