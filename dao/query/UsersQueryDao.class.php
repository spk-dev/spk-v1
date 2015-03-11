<?php

/**
 * Requetes concernant le User 
 */
class UserQueryDao{
 
    /**
     * Ajout à la base le User passé en paramètre
     * @param User $user
     * @return resultset 
     */
    public static function addUser(User $user){
        $sql = "INSERT INTO ".Db::get("use",null,null)." (".Db::get("use","Id",null).", ".Db::get("use","Login",null).", ".Db::get("use","Nom",null).", ".Db::get("use","Prenom",null).", ".Db::get("use","Mail",null).", ".Db::get("use","Password",null).", ".Db::get("use","Tel1",null).", ".Db::get("use","Tel2",null).", ".Db::get("use","Optin",null).", ".Db::get("use","ProfilId",null).") ";
        $sql .= "VALUES (NULL, '".$user->getLogin()."','".$user->getNom()."', '".$user->getPrenom()."', '".$user->getMail()."', '".$user->getPassword()."', '".$user->getTel1()."', '".$user->getTel2()."', '".$user->getOptIn()."', '".$user->getProfil()."');";
    
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Mets à jour l'user passé en paramètre
     * @param User $user
     * @return resultset 
     */
    public static function updateUser(User $user){
        $sql  = "UPDATE ".Db::get("use",null,null)." SET ";
        $sql .= "".Db::get("use","Login",null)."='".$user->getLogin()."' ,".Db::get("use","Nom",null)."='".$user->getNom()."' , ".Db::get("use","Prenom",null)."='".$user->getPrenom()."', ".Db::get("use","Mail",null)."='".$user->getMail()."', ";
        $sql .= "".Db::get("use","Password",null)."='".$user->getPassword()."', ".Db::get("use","Tel1",null)."='".$user->getTel1()."', ".Db::get("use","Tel2",null)."='".$user->getTel2()."', ".Db::get("use","Optin",null)."='".$user->getOptin()."', ".Db::get("use","ProfilId",null)."='".$user->getProfil()."' ";
        $sql .= "WHERE ".Db::get("use",null,null).".".Db::get("use","Id",null)." = ".$user->getId()." ;";
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Supprime un utilisateur de la base
     * @param type $idUser
     * @return resultset 
     */
    public static function deleteUser($idUser){
        $sql = "DELETE FROM ".Db::get("use",null,null)." WHERE ".Db::get("use",null,null).".".Db::get("use","Id")." = ".$idUser;
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    /**
     * Récupère 1 user en fonction de son ID
     * @param type $idUser
     * @return resultset 
     */
    public static function getOneUser($idUser){
        $sql = "SELECT * FROM ".Db::get("use",null,null)." WHERE ".Db::get("use","Id")."=".$idUser;
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Renvoi tous les users en fonction de la condition passée en paramêtre
     * @param type $condition
     * @return resultset 
     */
    public static function getAllUsers($condition){
        $sql = "SELECT * FROM ".Db::get("use",null,null)." ".$condition;
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Check l'existence du user dans la base en fonction du binome User / Password
     * @param type $login
     * @param type $pass
     * @return Resultset 
     */
    public static function checkUsers($login, $pass){     
        $sql = "SELECT * FROM ".Db::get("use",null,null)." WHERE ".Db::get("use","Login")."='".mysql_escape_string($login)."' AND ".Db::get("use","Password")."='".mysql_escape_string($pass)."'";
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
}
 
 
 
?>
