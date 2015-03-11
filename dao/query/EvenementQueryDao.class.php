<?php

/**
 * 
 */
class EvenementQueryDao{

   
    
    /**
     * Enregistre une nouvelle evenement
     * @param Evenement $evenement
     * @return boolean
     */
    public static function creerEvenement(Evenement $evenement){
        
        $sql = "INSERT INTO  ".Db::get("eve",null,null)." (
                ".Db::get("eve","Id",null)." ,
                ".Db::get("eve","Nom",null)." ,
                ".Db::get("eve","Description",null)." ,
                ".Db::get("eve","MailInscription",null)." ,
                ".Db::get("eve","ContacInscription", null)." ,
                ".Db::get("eve","Datedebut",null)." ,
                ".Db::get("eve","Datefin",null)." ,
                ".Db::get("eve","Mainphoto",null)." ,
                ".Db::get("eve","Prix",null)." ,
                ".Db::get("eve","Garderie",null)." ,
                ".Db::get("eve","Hebergement",null)." ,
                ".Db::get("eve","LieuId",null)." ,
                ".Db::get("eve","TypeEvenement",null).",    
                ".Db::get("eve","DateEnregistrement",null).",
                ".Db::get("eve","PlaceId",null)."
                )
                VALUES (
                    NULL , 
                    \"".$evenement->getNom()."\" ,  
                    \"".$evenement->getDescription()."\",  
                    \"".$evenement->getMailInscription()."\",
                    \"".$evenement->getCoordInscription()."\",  
                    \"".$evenement->getDateDebut()."\",  
                    \"".$evenement->getDateFin()."\",  
                    \"".$evenement->getMainPhoto()."\",  
                    \"".$evenement->getPrix()."\", 
                    \"".$evenement->getGarderie()."\",  
                    \"".$evenement->getHebergement()."\",  
                    \"".$evenement->getLieu()."\", 
                    \"".$evenement->getTypeEvenement()."\", 
                    CURRENT_TIMESTAMP,
                    \"".$evenement->getPlace()."\"
                );";
        
        return UtilsDao::getInstance()->executeInsert($sql);
    }
    
    /**
    * Liste toutes les evenements pour les listes
    * @param type $condition
    * @return type 
    */
    public static function getListeEvenements($condition){

        $sql = "SELECT DISTINCT "
            . "".Db::get("eve",null,null).".".Db::get("eve","Id",'IdRetraite')." , "
            . "".Db::get("eve",null,null).".".Db::get("eve","Nom",'NomRetraite')." , "
                .Db::get("eve",null,null).".".Db::get("eve","Description","DescriptionRetraite")." , "
            . "".Db::get("eve",null,null).".".Db::get("eve","MailInscription",'MailInscriptionRetraite')." , "
                .Db::get("eve",null,null).".".Db::get("eve","ContacInscription", '')." , "                    
            . "".Db::get("eve",null,null).".".Db::get("eve","Datedebut",'RetraiteDateDebut')." , "
                .Db::get("eve",null,null).".".Db::get("eve","Datefin",'RetraiteDateFin')." , "
            . "".Db::get("eve",null,null).".".Db::get("eve","Mainphoto",'RetraiteMainPhoto')." , "
                .Db::get("eve",null,null).".".Db::get("eve","Prix","RetraitePrix")." , "
            . "".Db::get("eve",null,null).".".Db::get("eve","Garderie",'RetraiteGarderie')." , "
                .Db::get("eve",null,null).".".Db::get("eve","Hebergement",'RetraiteHebergement')." , "
                .Db::get("eve",null,null).".".Db::get("eve","TypeEvenement",'TypeEvenement')." , "
            . "".Db::get("eve",null,null).".".Db::get("eve","DateEnregistrement",'RetraiteDateEnregistrement')." , "                 
            . "".Db::get("org",null,null).".".Db::get("org","Nom","RetraiteLieu")." , "
                .Db::get("org",null,null).".".Db::get("org","Id",'RetraiteLieuId')." "
            . "FROM "
            . "".Db::get("eve",null,null).", ".Db::get("org",null,null)." "  
            . "WHERE 1=1 "
            . "AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' " // EXCLUSION DE L'ORGANISATEUR SPIBOOK
            . "AND (".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null).") "
            . $condition
            . "ORDER BY ".Db::get("eve",null,null).".".Db::get("eve","Nom",null)." ;";

            
        
        return UtilsDao::getInstance()->executeRequete($sql);
    } 

    /**
    * Récupération d'une evenement
    * @param type $idEvenement
    * @return type 
    */
    public static function getEvenement($idEvenement,$organisateurValideFacultatif = null){

            if (!$organisateurValideFacultatif){
                 $conditionValidite = Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                     AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." = 1
                     AND ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)." AND ";
            }
            else{
                $conditionValidite = "";
            }
            $sql = "SELECT * FROM ".Db::get("eve",null,null).", ".Db::get("org",null,null)." WHERE ".$conditionValidite.Db::get("eve","Id",null)." =".$idEvenement.";";
            AppLog::ecrireLog("3-1-1-1 - dans EvenementQueryDao -requete : [".$sql."]", "debug");
            return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
    * Récupère la liste des Themes associées à une evenement
    * @param type $idEvenement
    * @return type 
    */
    public static function getListeThemePourUnEvenement($idEvenement){
            $sql = "SELECT * FROM ".Db::get("the",null,null)." WHERE ".Db::get("the","Id",null)." in (SELECT ".Db::get("tre",null,null).".".Db::get("tre","ThemeId",null)." FROM ".Db::get("tre",null,null)." WHERE ".Db::get("tre","RetraiteId",null)."=".$idEvenement.");";
           
            return UtilsDao::getInstance()->executeRequete($sql);

    }

    /**
    * Récupère la liste des Intervenants associés à une evenement
    * @param type $idEvenement
    * @return type 
    */
    public static function getListeIntervenantsPourUnEvenement($idEvenement){
        $sql = "SELECT * FROM ".Db::get("int",null,null)." WHERE ".Db::get("int","Id",null)." in (SELECT ".Db::get("ire",null,null).".".Db::get("ire","IntervenantId",null)." FROM ".Db::get("ire",null,null)." WHERE ".Db::get("ire","RetraiteId",null)."=$idEvenement);";
            return UtilsDao::getInstance()->executeRequete($sql);

    }

    
    /**
    * Select toutes les evenements de la base
    * @return resource
    */
    public static function  getListeTousEvenements($condition,$organisateurValideFacultatif = null){
        
        if (!$organisateurValideFacultatif){
                $sql = "SELECT ".Db::get("eve",null,null).".* FROM ".Db::get("org",null,null).", ".Db::get("eve",null,null)."left join ".Db::get("pla",null,null)." on ".Db::get("pla","Id",null)."=".Db::get("eve","PlaceId",null)."
                        WHERE ".Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                            AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." = 1";
                $sql .= " AND ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)."
                            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$condition;
                
           }
           else{
                $sql = "SELECT * FROM ".Db::get("eve",null,null).",".Db::get("org",null,null);
                $sql .= " WHERE ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)."
                            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ";
                $sql .= $condition;
           }
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
        /**
    * Select toutes les evenements de la base
    * @return resource
    */
    public static function getNombreEvenements($condition,$organisateurValideFacultatif = null){

            if (!$organisateurValideFacultatif){
                    $sql = "SELECT count(".Db::get("eve","Id",null).") as 'nbEvenements' FROM ".Db::get("eve",null,null).",".Db::get("org",null,null); 
                    $sql .= " WHERE ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)."
                    AND ".Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                            AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." = 1
                            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ";
                    $sql .= $condition;
            
                
           }
           else{
                    $sql = "SELECT count(".Db::get("eve","Id",null).") as 'nbEvenements' FROM ".Db::get("eve",null,null).",".Db::get("org",null,null); 
                    $sql .= " WHERE ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)."
                            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ";
                    $sql .= $condition;
            
           }
           
           
           
           
           
        
        
        
            $sql = "SELECT count(".Db::get("eve","Id",null).") as 'nbEvenements' FROM ".Db::get("eve",null,null).",".Db::get("org",null,null); 
            $sql .= " WHERE ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)."
                    AND ".Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                            AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." = 1
                            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ";
                $sql .= $condition;
            
            return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
    * Renvoi les ID's des evenements pour le Lieu passé en param.
    * @param type $idLieu
    * @return type 
    */
    public static function getListeEvenementsPourUnOrganisateur($idLieu){
        $sql = "SELECT ".Db::get("eve","Id",null)."  FROM ".Db::get("eve",null,null)." WHERE ".Db::get("eve","LieuId",null)."=".$idLieu.";";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Mets à jour la table evenement
     * @param type $evenement
     * @return type
     */
    public static function modifierUnEvenement(Evenement $evenement){
//        $evenement->setId(8798);
        $sql = "UPDATE ".Db::get("eve",null,null)." SET 
                ".Db::get("eve","Nom",null)."='".$evenement->getNom()."', 
                ".Db::get("eve","Description",null)."='".$evenement->getDescription()."', 
                ".Db::get("eve","MailInscription",null)."='".$evenement->getMailInscription()."', 
                ".Db::get("eve","ContacInscription", null)."='".$evenement->getCoordInscription()."', 
                ".Db::get("eve","Datedebut",null)."='".$evenement->getDateDebut()."', 
                ".Db::get("eve","Datefin",null)."='".$evenement->getDateFin()."', 
                ".Db::get("eve","Mainphoto",null)."='".$evenement->getMainPhoto()."', 
                ".Db::get("eve","Prix",null)."='".$evenement->getPrix()."', 
                ".Db::get("eve","Garderie",null)."='".$evenement->getGarderie()."', 
                ".Db::get("eve","Hebergement",null)."='".$evenement->getHebergement()."', 
                ".Db::get("eve","TypeEvenement",null)."='".$evenement->getTypeEvenement()."',
                ".Db::get("eve","PlaceId",null)."='".$evenement->getPlace()."', 
                 ".Db::get("eve","DateEnregistrement",null)."= CURRENT_TIMESTAMP()
                WHERE  ".Db::get("eve","Id",null)."=".$evenement->getId()." ;";
        
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
    }
    
    /**
     * Supprime une evenement de la table evenement
     * @param type $idEvenement
     * @return type
     */
    public static function SupprimerUnEvenement($idEvenement){
        $sql = "DELETE FROM ".Db::get("eve",null,null)." WHERE ".Db::get("eve","Id",null)."=".$idEvenement." ;";
        
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
        
    }
    
    /**
     * Renvoi la liste des x types d'événements les plus référencés avec le nombre d'items associés
     * la colonne du nombre d'item s'appelle nbItems
     * @return type
     */
    public static function getListeTypesLesPlusUtilises($organisateurValideFacultatif = null){
        
        
        $limit = $_ENV['properties']['Home']['nbListe'];
        
        if (!$organisateurValideFacultatif){
            $sql = "SELECT ".Db::get("eve","TypeEvenement",null).",
                count(".Db::get("eve","Id",null).") as 'nbItems'
                FROM ".Db::get("eve",null,null).", ".Db::get("org",null,null)."
                WHERE ".Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." = 1
                AND ".Db::get("org","Nom",null)." <> 'SPIBOOK'
                AND ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)."
                GROUP BY ".Db::get("eve","TypeEvenement",null)."
                ORDER BY nbItems DESC
                LIMIT 0,".$limit.";"; 
       }
       else{
            $sql = "SELECT ".Db::get("eve","TypeEvenement",null).",count(".Db::get("eve","Id",null).") as 'nbItems'
                FROM ".Db::get("eve",null,null)."
                WHERE ".Db::get("eve","LieuId",null)." NOT IN (1)
                GROUP BY ".Db::get("eve","TypeEvenement",null)."
                ORDER BY nbItems DESC
                LIMIT 0,".$limit.";";           
        }     
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
}