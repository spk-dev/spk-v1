<?php


/**
 * 
 */
class LieuQueryDao{

 

    
    /**
    * Récupérer la liste des photos d'un lieu
    * @param type $idRetraite
    * @return type 
    */
    public static function getPhotosFromLieux($idRetraite){
        $sql = "SELECT * FROM ".Db::get("pli",null,null)." WHERE ".Db::get("pli","LieuID",null)."=".$idRetraite;
        return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
     * Récupérer la liste des lieux pour batir le select
     * @return type 
     */
    public static function getAllLieuxPourSelect($condition, $lieuValideFacultatif = null){
        
        if (!$lieuValideFacultatif){
             $sql = "SELECT DISTINCT ".Db::get("org","Id",null).",".Db::get("org","Nom",null).",".Db::get("org","MainPhoto",null)." FROM ".Db::get("org",null,null)." 
                 WHERE ".Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                     AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." 
                         AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$condition;
        }
        else{
            $sql = "SELECT DISTINCT ".Db::get("org","Id",null).",".Db::get("org","Nom",null).",".Db::get("org","MainPhoto",null)." FROM ".Db::get("org",null,null)." WHERE ".Db::get("org","Nom",null)." <> 'SPIBOOK';";              
        }
        return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
    *  Liste des lieux pour liste principale
    * @return type 
    */
    public static function getAllLieuxPourListe($lieuValideFacultatif = null){
        if (!$lieuValideFacultatif){
            $sql = "SELECT DISTINCT ".Db::get("org","Id",null)." ,".Db::get("org","Nom",null).",".Db::get("pla","Adresse1",null)." ,".Db::get("pla","Adresse2",null)." ,".Db::get("pla","Cp",null)." ,".Db::get("pla","Ville",null)." ,".Db::get("pla","Pays",null)." ,".Db::get("org","MainPhoto",null)." ,".Db::get("org","TypeId",null)." ,".Db::get("org","CommunauteId",null)." ,".Db::get("org","DateEnregistrement",null)." , ".Db::get("typ",null,null).".".Db::get("typ","Nom",null).",".Db::get("com",null,null).".".Db::get("com","Nom",null)." FROM ".Db::get("vlc",null,null).",".Db::get("typ",null,null).", ".Db::get("com",null,null)." 
            WHERE ".Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." AND ".Db::get("org",null,null).".".Db::get("org","TypeId",null)."=".Db::get("typ",null,null).".".Db::get("typ","Id",null)." 
                    AND ".Db::get("com",null,null).".".Db::get("com","Id",null)." = ".Db::get("org","CommunauteId",null)." 
                        AND ".Db::get("org","Nom",null)." <> 'SPIBOOK';";
        }
        else{
            $sql = "SELECT DISTINCT ".Db::get("org","Id",null)." ,".Db::get("org","Nom",null).",".Db::get("pla","Adresse1",null)." ,".Db::get("pla","Adresse2",null)." ,".Db::get("pla","Cp",null)." ,".Db::get("pla","Ville",null)." ,".Db::get("pla","Pays",null)." ,".Db::get("org","MainPhoto",null)." ,".Db::get("org","TypeId",null)." ,".Db::get("org","CommunauteId",null)." ,".Db::get("org","DateEnregistrement",null)." , ".Db::get("typ",null,null).".".Db::get("typ","Nom",null).",".Db::get("com",null,null).".".Db::get("com","Nom",null)." FROM ".Db::get("vlc",null,null).",".Db::get("typ",null,null).", ".Db::get("com",null,null)." WHERE ".Db::get("org",null,null).".".Db::get("org","TypeId",null)."=".Db::get("typ",null,null).".".Db::get("typ","Id",null)." AND ".Db::get("com",null,null).".".Db::get("com","Id",null)." = ".Db::get("org","CommunauteId",null)." AND ".Db::get("org","Nom",null)." <> 'SPIBOOK';";                
        }
        return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
    * Liste des lieux pour les retraites
    * @return type 
    */
    public static function getLieuxFromRetraite($lieuValideFacultatif = null){
        if (!$lieuValideFacultatif){
            $sql = "SELECT DISTINCT ".Db::get("eve",null,null).".".Db::get("eve", "LieuId",null).",".Db::get("org",null,null).".".Db::get("org","Nom",null)."  FROM ".Db::get("eve",null,null).",".Db::get("org",null,null)." 
                WHERE ".Db::get("org",null,null).".".Db::get("org","ValidationAdmin",null)." = 1 
                    AND ".Db::get("org",null,null).".".Db::get("org","ValidationSuperAdmin",null)." 
                        AND ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)." 
                            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK';";
        }
        else{
            $sql = "SELECT DISTINCT ".Db::get("eve",null,null).".".Db::get("eve", "LieuId",null).",".Db::get("org",null,null).".".Db::get("org","Nom",null)."  FROM ".Db::get("eve",null,null).",".Db::get("org",null,null)." WHERE ".Db::get("org",null,null).".".Db::get("org","Id",null)."=".Db::get("eve",null,null).".".Db::get("eve","LieuId",null)." AND ".Db::get("org","Nom",null)." <> 'SPIBOOK';";           
        }
        
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }    

    /**
    *
    * @param type $idLieu
    * @return type 
    */
    public static function getOneLieu($idLieu, $lieuValideFacultatif = null){
       
        if (!$lieuValideFacultatif){
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)." WHERE ".Db::get("org","ValidationAdmin",null)." = 1 
                AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 AND ".Db::get("org","Id",null)."='".$idLieu."';";
        }
        else {
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)." WHERE ".Db::get("org","Id",null)."='".$idLieu."';";
        }
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
    * Select toutes les lieus de la base
    * @return resource
    */
    public static function getAlllieux($lieuValideFacultatif = null){
       
        if (!$lieuValideFacultatif){
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)." WHERE ".Db::get("org","ValidationAdmin",null)." = 1 
                AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
                    AND ".Db::get("org","Nom",null)." <> 'SPIBOOK';";
        }
        else {
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)." WHERE ".Db::get("org","Nom",null)." <> 'SPIBOOK';";
        }
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
    * Select toutes les lieus de la base
    * @return resource
    */
    public static function getLieuxFiltered(OrganisateurSearchCriteria $filter, $lieuValideFacultatif = null){
       
        if (!$lieuValideFacultatif){
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)." 
                WHERE ".Db::get("org","ValidationAdmin",null)." = 1 
                    AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
                        AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$filter->getCondition();            
        }
        else {
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)." WHERE ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$filter->getCondition();
        }
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    /**
    * Select toutes les lieus de la base
    * @return resource
    */
    public static function getLieuxFilteredComplete(OrganisateurSearchCriteria $filter, $lieuValideFacultatif = null){
       
        if (!$lieuValideFacultatif){
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)."
                WHERE ".Db::get("org","ValidationAdmin",null)." = 1 
                    AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
                        AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$filter->getCondition().";";
        }
        else {
            $sql = "SELECT * FROM ".Db::get("vlc",null,null)." WHERE ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$filter->getCondition();
        }
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
    *  Liste des lieux pour liste principale
    * @return type 
    */
    public static function getIdLieuxForAdmin($idAdmin){
        $sql = "SELECT DISTINCT ".Db::get("org","Id",null)." FROM ".Db::get("org",null,null)." WHERE ".Db::get("org","AdministrateurId",null)." = '".$idAdmin."'";
        
        
                
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    
    /**
     * Renvoi 3 lieux hazard
     * @param type $nbLieux
     * @return type 
     */
    public static function getRandomLieux($nbLieux, $lieuValideFacultatif = null){
    
        if (!$lieuValideFacultatif){
            $sql = "SELECT ".Db::get("org","Id",null)." FROM ".Db::get("org",null,null)." 
                WHERE ".Db::get("org","ValidationAdmin",null)." = 1 
                    AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
                        AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ORDER BY RAND() LIMIT ".$nbLieux;             
        }
        else {
            $sql = "SELECT ".Db::get("org","Id",null)." FROM ".Db::get("org",null,null)." WHERE ".Db::get("org","Nom",null)." <> 'SPIBOOK' ORDER BY RAND() LIMIT ".$nbLieux;   
        }
        return UtilsDao::getInstance()->executeRequete($sql);
        
    }
    
    /**
     * Modifier le lieu
     * @param type $lieu
     * @return type
     */
    public static function modifyLieu(Lieu $lieu){
         
        $sql = "UPDATE ".Db::get("org",null,null)."
                SET ".Db::get("org","Nom",null)." = \"".SecurityUtil::securVarParam($lieu->getNom())."\",
                ".Db::get("org","Description",null)." = \"".SecurityUtil::securVarParam($lieu->getDescription())."\",
                ".Db::get("org","Hebergement",null)." = \"".SecurityUtil::securVarParam($lieu->getHebergement())."\",
                ".Db::get("org","Mainphoto",null)." = \"".$lieu->getMainPhoto()."\",
                ".Db::get("org","AccesTrain",null)." = \"".SecurityUtil::securVarParam($lieu->getTrain())."\",
                ".Db::get("org","AccesVoiture",null)." = \"".SecurityUtil::securVarParam($lieu->getVoiture())."\",
                ".Db::get("org","AccesAvion",null)." = \"".SecurityUtil::securVarParam($lieu->getAvion())."\",
                ".Db::get("org","LienSiteweb",null)." = \"".$lieu->getLienSiteweb()."\",
                ".Db::get("org","Mail",null)." = \"".$lieu->getMail()."\",
                ".Db::get("org","Tel",null)." = \"".$lieu->getTel()."\",
                ".Db::get("org","Fax",null)." = \"".$lieu->getFax()."\",
                ".Db::get("org","TypeId",null)." = \"".$lieu->getTypeId()."\",
                ".Db::get("org","CommunauteId",null)." = \"".$lieu->getCommunaute()."\",
                ".Db::get("org","DateEnregistrement",null)." = CURRENT_DATE() ,
                ".Db::get("org","ValidationAdmin",null)." = \"".$lieu->getValidationAdmin()."\",
                ".Db::get("org","ValidationSuperAdmin",null)." = \"".$lieu->getValidationSuperAdmin()."\"
                    WHERE ".Db::get("org","Id",null)." = ".$lieu->getId().";";
            
        AppLog::ecrireLog($sql, "debug");
         return UtilsDao::getInstance()->executeUpdateDelete($sql);
    }
    
    public static function compter($idLieu, $lieuValideFacultatif = null){
        
        if (!$lieuValideFacultatif){
            $sql = "Select count(".Db::get("org","Id",null).") as 'nb' from ".Db::get("org",null,null)." 
                    Where ".Db::get("org","Id",null)."=".$idLieu."
                        AND ".Db::get("org","ValidationAdmin",null)." = 1 
                            AND ".Db::get("org","ValidationSuperAdmin",null)." = 1;";
        }else{
            $sql = "Select count(".Db::get("org","Id",null).") as 'nb' from ".Db::get("org",null,null)." 
                    Where ".Db::get("org","Id",null)."=".$idLieu.";";
        }
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    public static function compterLieuxFiltered(OrganisateurSearchCriteria $filter, $lieuValideFacultatif = null){
        if (!$lieuValideFacultatif){
                $sql = "SELECT count(".Db::get("org","Id",null).") as 'nb' FROM ".Db::get("org",null,null)." 
                    WHERE ".Db::get("org","ValidationAdmin",null)." = 1 
                        AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
                            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$filter->getCondition();            
            }
            else {
                $sql = "SELECT count(".Db::get("org","Id",null).") as 'nb' FROM ".Db::get("org",null,null)." WHERE ".Db::get("org","Nom",null)." <> 'SPIBOOK' ".$filter->getCondition();
            }
            
            return UtilsDao::getInstance()->executeRequete($sql);
        }
        
        
    public static function addLieu(Lieu $lieu, $placeId){      
        
        $sql  = "INSERT INTO ".Db::get("org",null,null);
        $sql .= "(".Db::get("org","Nom",null).",".Db::get("org","Mail",null).",".Db::get("org","Tel",null).",".Db::get("org","AdministrateurId",null).",".Db::get("org","ValidationAdmin",null).",".Db::get("org","ValidationSuperAdmin",null).",".Db::get("org","TypeId",null).",".Db::get("org","CommunauteId",null).",".Db::get("org","PlaceId",null).")";
        $sql .= " VALUES ('".str_replace("'", "\'", $lieu->getNom())."','".str_replace("'", "\'", $lieu->getMail())."','".str_replace("'", "\'", $lieu->getTel())."', ".str_replace("'", "\'", $lieu->getAdmin()).",1,1,8,0,".$placeId.");";   
        
        
        return UtilsDao::getInstance()->executeInsert($sql);
    }
    
//    
    
    public static function updatePlaceOrganisateur($idLieu, $idPlace){
        $sql = "UPDATE ".Db::get("org",null,null)." SET ".Db::get("org","PlaceId",null)." = ".$idPlace." WHERE ".Db::get("org","Id",null)." = ".$idLieu.";";
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
        
    }
    
    public static function activate($idLieu,$booActivation){
        $sql = "UPDATE ".Db::get("org",null,null)." SET ".Db::get("org","ValidationAdmin",null)." = ".$booActivation." WHERE ".Db::get("org","Id",null)." = ".$idLieu.";";
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
    }
    
    public static function activateSuperAdmin($idLieu,$booActivation){
        AppLog::ecrireLog("Rentre dans LieuQueryDao.class - l 267", "debug");
        $sql = "UPDATE ".Db::get("org",null,null)." SET ".Db::get("org","ValidationSuperAdmin",null)." = ".$booActivation." WHERE ".Db::get("org","Id",null)." = ".$idLieu.";";
        AppLog::ecrireLog("Requete : [".$sql."]", "debug");
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
    }
    
}   
