<?php

/**
 * Requetes concernant le User 
 */
class UserActionDao{
 
    /**
     * Ajout à la base le User passé en paramètre
     * @param User $user
     * @return resultset 
     */
    public static function addUser(User $user){
//        $sql = "INSERT INTO `user` (`user-id`, `user-login`, `user-nom`, `user-prenom`, `user-mail`, `user-password`, `user-tel1`, `user-tel2`, `user-optin`, `Profil_profil-id`) ";
//        $sql .= "VALUES (NULL, '".$user->getLogin()."','".$user->getNom()."', '".$user->getPrenom()."', '".$user->getMail()."', '".$user->getPassword()."', '".$user->getTel1()."', '".$user->getTel2()."', '".$user->getOptIn()."', '".$user->getProfil()."');";
//    
//        return UtilsDao::getInstance()->executeRequete($sql);
        return UserQueryDao::addUser($user);
    }
    
    /**
     * Mets à jour l'user passé en paramètre
     * @param User $user
     * @return resultset 
     */
    public static function updateUser(User $user){
//        $sql  = "UPDATE `user` SET ";
//        $sql .= "`user-login`='".$user->getLogin()."' ,`user-nom`='".$user->getNom()."' , `user-prenom`='".$user->getPrenom()."', `user-mail`='".$user->getMail()."', ";
//        $sql .= "`user-password`='".$user->getPassword()."', `user-tel1`='".$user->getTel1()."', `user-tel2`='".$user->getTel2()."', `user-optin`='".$user->getOptin()."', `Profil_profil-id`='".$user->getProfil()."' ";
//        $sql .= "WHERE `user`.`user-id` = ".$user->getId()." ;";
//        
//        return UtilsDao::getInstance()->executeRequete($sql);
        return UserQueryDao::updateUser($user);
    }
    
    /**
     * Supprime un utilisateur de la base
     * @param type $idUser
     * @return resultset 
     */
    public static function deleteUser($idUser){
//        $sql = "DELETE FROM `user WHERE `user`.`user-id` = ".$idUser;
//        return UtilsDao::getInstance()->executeRequete($sql);
        return UserQueryDao::deleteUser($idUser);
    }
    /**
     * Récupère 1 user en fonction de son ID
     * @param type $idUser
     * @return resultset 
     */
    public static function getOneUser($idUser){
//        $sql = "SELECT * FROM `user` WHERE `user-id`=".$idUser;
//        return UtilsDao::getInstance()->executeRequete($sql);
        return UserQueryDao::getOneUser($idUser);
    }
    
    /**
     * Renvoi tous les users en fonction de la condition passée en paramêtre
     * @param type $condition
     * @return resultset 
     */
    public static function getAllUsers($condition){
//        $sql = "SELECT * FROM `user` ".$condition;
//        return UtilsDao::getInstance()->executeRequete($sql);
        return UserQueryDao::getAllUsers($condition);
    }
    
    /**
     * Check l'existence du user dans la base en fonction du binome User / Password
     * @param type $login
     * @param type $pass
     * @return Resultset 
     */
    public static function checkUsers($login, $pass){     

        return UserQueryDao::checkUsers($login, $pass);
    }
}
 
 
 
?>
