<?php

/**
 * Requetes concernant le User 
 */
class AdministrateurQueryDao{
 
    
    /**
     * Récupère 1 user en fonction de son ID
     * @param type $idUser
     * @return resultset 
     */
    public static function getOneAdmin($idAdmin){
        $sql = "SELECT * FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Id",null)."=".$idAdmin;
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Renvoi tous les users en fonction de la condition passée en paramêtre
     * @param type $condition
     * @return resultset 
     */
    public static function getAllAdmin($str){
        $sql = "SELECT * FROM ".Db::get("adm",null,null)." 
                WHERE ".Db::get("adm","Nom",null)." like ('%".$str."%') 
                    OR ".Db::get("adm","Prenom",null)." like ('%".$str."%') 
                        OR ".Db::get("adm","Mail",null)." like ('%".$str."%') ;";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Check l'existence du user dans la base en fonction du binome User / Password
     * @param type $login
     * @param type $pass
     * @return Resultset 
     */
    public static function checkAdminOLD($mail, $pass){     
        $sql = "SELECT ".Db::get("adm","Id",null)." FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Mail",null)."='".$mail."' AND ".Db::get("adm","Password",null)."='".$pass."'";
       
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Check l'existence du user dans la base en fonction du binome User / Password
     * @param type $login
     * @param type $pass
     * @return Resultset 
     */
    public static function checkAdmin($mail, $pass, $booSuperAdmin){  
        
        if($booSuperAdmin){
            $sql = "SELECT ".Db::get("adm","Id",null)." FROM ".Db::get("adm",null,null)." 
                        WHERE ".Db::get("adm","Mail",null)."='".$mail."' 
                            AND ".Db::get("adm","Password",null)."='".$pass."' 
                                AND ".Db::get("adm","RoleId",null)."=1;";
        }else{
            $sql = "SELECT ".Db::get("adm","Id",null)." FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Mail",null)."='".$mail."' AND ".Db::get("adm","Password",null)."='".$pass."'";
        }
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Mets à jour l'admin (hors pwd)
     * @param Administrateur $admin
     * @return type
     */
    public static function updateAdmin(Administrateur $admin){
       
        $sql = "UPDATE ".Db::get("adm",null,null)." SET ".Db::get("adm","Nom",null)." = \"".$admin->getNom()."\", ".Db::get("adm","Prenom",null)." = \"".$admin->getPrenom()."\", ".Db::get("adm","Mail",null)." = \"".$admin->getMail()."\", ".Db::get("adm","Tel",null)." = \"".$admin->getTel()."\" WHERE ".Db::get("adm","Id",null)." = ".$admin->getId().";";
       
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
        
    }
    
    /**
     * Met à jour le pwd de l'admin
     * @param Administrateur $admin
     * @return type
     */
    public static function updatePwd(Administrateur $admin){
        $key = base64_encode(crypt(time().$admin->getMail()));
        $sql = "UPDATE ".Db::get("adm",null,null)." SET ".Db::get("adm","Key",null)." = \"".$key."\",".Db::get("adm","Password",null)." = \"".$admin->getPassword()."\" WHERE ".Db::get("adm","Id",null)." = ".$admin->getId().";";
        
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
    }
    
    /**
     * Enregistre la date de la connexion courante
     * @param Administrateur $admin
     * @return type
     */
    public static function enregistrerDateConnexion($id){
        $sql = "UPDATE ".Db::get("adm",null,null)." SET ".Db::get("adm","DateLastConnect",null)." = CURRENT_DATE() WHERE ".Db::get("adm","Id",null)." = ".$id.";";
       
        return UtilsDao::getInstance()->executeUpdateDelete($sql);
    }
    
    /**
     * Récupère la date de dernière connexion
     * @param Administrateur $admin
     * @return type
     */
    public static function lireDateConnexion(Administrateur $admin){
        $sql = "SELECT ".Db::get("adm","DateLastConnect",null)." FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Id",null)." = ".$admin->getId().";";
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
     /**
     * Ajouter un Administrateur
     * @param Administrateur $admin
     * @return type
     */
    public static function inscriptionAdministrateur(Administrateur $admin, $password){       
        $key = substr($admin->getId().base64_encode(crypt(time())),0,250);
        $sql = "INSERT INTO ".Db::get("adm",null,null)." (".Db::get("adm","Id",null).", ".Db::get("adm","Nom",null).", ".Db::get("adm","Prenom",null).", ".Db::get("adm","Mail",null).", ".Db::get("adm","Password",null).", ".Db::get("adm","Tel",null).", ".Db::get("adm","RoleId",null).", ".Db::get("adm","DateLastConnect",null).",".Db::get("adm","DateInscription",null).",".Db::get("adm","Key",null).") VALUES (NULL, '".$admin->getNom()."', '".$admin->getPrenom()."', '".$admin->getMail()."', '".$password."', NULL, '2', CURRENT_DATE(),CURRENT_DATE(),'".$key."');";
        return UtilsDao::getInstance()->executeInsert($sql);
    }
    
    /**
     * Verifier si l'email de l'admin qui s'inscrit est déjà dans la db.
     * @param type $email
     * @return type
     */
    public static function checkEmailAdmin($email){
        $sql = "SELECT ".Db::get("adm","Id",null)." from ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Mail",null)."='".$email."';";
        return UtilsDao::getInstance()->countResult($sql);
        
    }
    
    public static function getAdminIdFromEmail($email){
        $sql = "SELECT ".Db::get("adm","Id",null)." FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Mail",null)." = '".$email."';";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    public static function getAdminIdFromKey($key){
        $sql = "SELECT ".Db::get("adm","Id",null)." FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Key",null)." = '".$key."';";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    
    public static function getAdminSecretKeyByEmail($email){
        $sql = "SELECT ".Db::get("adm","Key",null)." FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Mail",null)." = '".$email."';";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    public static function getAdminMailFromSecretKey($key){
         $sql = "SELECT ".Db::get("adm","Mail",null)." FROM ".Db::get("adm",null,null)." WHERE ".Db::get("adm","Key",null)." = '".$key."';";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
}
 
 
 
?>
