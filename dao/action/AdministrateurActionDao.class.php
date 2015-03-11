<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class AdministrateurActionDao{
    
    public static function listerAdministrateur($str){
        $req = AdministrateurQueryDao::getAllAdmin($str);
        $arr = array();
        foreach ($req as $data){  
                
                        
                $Id = $data[Db::getParam("adm","Id")];
                $Nom = $data[Db::getParam("adm","Nom")];
                $Prenom = $data[Db::getParam("adm","Prenom")];
                $AdrMail = $data[Db::getParam("adm","Mail")];
                $Tel = $data[Db::getParam("adm","Tel")];
                $Role = $data[Db::getParam("adm","RoleId")];
                $pwd = $data[Db::getParam("adm", "Password")];
                    
                $Lieux = LieuActionDao::recupererIdLieuForAdmin($Id);
                $dateLastConnection = $data[Db::getParam("adm","DateLastConnect")];
                
//                $adminReturnValue = new Administrateur($Id, $Nom, $Prenom, $AdrMail, $Tel, $Role, $Lieux, $dateLastConnection);
                $adminReturnValue = new Administrateur();
                $adminReturnValue->setId($Id);
                $adminReturnValue->setNom($Nom);
                $adminReturnValue->setPrenom($Prenom);
                $adminReturnValue->setMail($AdrMail);
                $adminReturnValue->setTel($Tel);
                $adminReturnValue->setRole($Role);
                $adminReturnValue->setLieux($Lieux);
                $adminReturnValue->setLastConnection($dateLastConnection);
                $adminReturnValue->setPassword($pwd);
                array_push($arr, $adminReturnValue);
                
            }
            return $arr;
    }
    
    /**
     * Vérifie si le couple mail & Mot de passe existe et charge l'objet Admin correspondant en session
     * @param type $admin
     * @param type $pass 
     */
    public static function logIn($mail, $pass, $booSuperAdmin){
        $adminReturnValue = null;
        $mail = SecurityUtil::securVarParam($mail);
        $pass = SecurityUtil::securPwd($pass);
        
        $req = AdministrateurQueryDao::checkAdmin($mail, $pass, $booSuperAdmin);
        
       if(count($req)>1 || count($req)<1){
            $adminReturnValue = false;
            
        }else{
           foreach ($req as $data){  
                $adminReturnValue = $data[Db::getParam("adm", "Id")];
            }
            if(!AdministrateurQueryDao::enregistrerDateConnexion($adminReturnValue)){
                AppLog::ecrireLog("ERREUR - Impossible d'enregistrer la date de connexion", "debug");
            }
        }
        AppLog::ecrireLog("Dans AdministrateurActionDao - Login - AdminReturnValue =".$adminReturnValue, "debug");
        return $adminReturnValue;   
        
    }
    
    /**
     * Vérifie si le couple mail & Mot de passe existe et charge l'objet Admin correspondant en session
     * @param type $admin
     * @param type $pass 
     */
    public static function getAdministrateur($idAdmin){
        
        $req = AdministrateurQueryDao::getOneAdmin($idAdmin);
        
       
        if(count($req)>1 || count($req) <1){
            $adminReturnValue = false;
            
        }else{
            foreach ($req as $data){  
                
                        
                $Id = $data[Db::getParam("adm","Id")];
                $Nom = $data[Db::getParam("adm","Nom")];
                $Prenom = $data[Db::getParam("adm","Prenom")];
                $AdrMail = $data[Db::getParam("adm","Mail")];
                $Tel = $data[Db::getParam("adm","Tel")];
                $Role = $data[Db::getParam("adm","RoleId")];
                $pwd = $data[Db::getParam("adm", "Password")];
                    
                $Lieux = LieuActionDao::recupererIdLieuForAdmin($Id);
                $dateLastConnection = $data[Db::getParam("adm","DateLastConnect")];
                
//                $adminReturnValue = new Administrateur($Id, $Nom, $Prenom, $AdrMail, $Tel, $Role, $Lieux, $dateLastConnection);
                $adminReturnValue = new Administrateur();
                $adminReturnValue->setId($Id);
                $adminReturnValue->setNom($Nom);
                $adminReturnValue->setPrenom($Prenom);
                $adminReturnValue->setMail($AdrMail);
                $adminReturnValue->setTel($Tel);
                $adminReturnValue->setRole($Role);
                $adminReturnValue->setLieux($Lieux);
                $adminReturnValue->setLastConnection($dateLastConnection);
                $adminReturnValue->setPassword($pwd);
                
                
            }
        }
        return $adminReturnValue;   
        
    }
    /**
     * Vérifie si un utilisateur est déjà loggué
     * @return boolean 
     */
    public static function isLogged(){
        $booConnected = false;
        if(isset($_SESSION['user'])){
            if($_SESSION['user']!=""){
                $booConnected = true;
            }
        }
        return $booConnected;
    }
    
    /**
     * Deconnexion 
     */
    public static function logOut($redirect){
        //session_start();
        session_unset();
        session_destroy();
        header('location:'.$redirect);
    }
    
    
      
    /**
     * Mise à jour de l'utilisateur
     */
    public static function updateAdministrateur(Administrateur $admin){
        return AdministrateurQueryDao::updateAdmin($admin);
      
        
    }
    
     /**
     * Mise à jour de l'utilisateur
     */
    public static function updatePwdAdministrateur(Administrateur $admin){
        
        //Récupération des parametres
        return AdministrateurQueryDao::updatePwd($admin);
        
        
    }
    
    /**
     * Ajouter l'email à la base Newsletter
     * 
     */
    public static function addEmailToNewsletter($email){
        $booAdd = NewsletterActionDao::addEmail($email);
        return $booAdd;
    }
   
    /**
     * Retirer l'email de la bd
     * @param type $email 
     */
    public static function removeEmailFromNewslette($email){
        $booRemove = NewsletterActionDao::removeEmail($email);
        return $booRemove;
    }
    
    /**
     * Check de l'existence dans la db.
     * @param type $email 
     */
    public static function isYetOnDatabase($email){
       $booExist = NewsletterActionDao::isEmailOnDatabase($email);
       return $booExist;
       
    }
    /**
     * 
     * @param Administrateur $admin
     * @param type $password
     * @return array(
     */
    public static function inscrireAdministrateur(Administrateur $admin, $password){    
        return AdministrateurQueryDao::inscriptionAdministrateur($admin, $password);       
    }
    
    
    public static function administrateurDejaExistant($email){
        $nb = AdministrateurQueryDao::checkEmailAdmin($email);
        $result = true;
        if($nb<1){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    
    /**
     * Renvoi l'id d'un email ID.
     * @param type $email
     * @return type
     */
    public static function getIdAdminFromEmail($email){
        $req = AdministrateurQueryDao::getAdminIdFromEmail($email);
        foreach ($req as $data){  
            $Id = $data[Db::getParam("adm","Id")];
        }
        return $Id;
        
    }
    /**
     * Renvoi l'id d'un email ID.
     * @param type $email
     * @return type
     */
    public static function getIdAdminFromKey($key){
        $req = AdministrateurQueryDao::getAdminIdFromKey($key);
        foreach ($req as $data){  
            $Id = $data[Db::getParam("adm","Id")];
        }
        return $Id;
        
    }
    
    /**
     * Renvoi la secretKey pour un mail
     * @param type $email
     * @return type
     */
    public static function getAdminSecretKeyByEmail($email){
        $req = AdministrateurQueryDao::getAdminSecretKeyByEmail($email);
        foreach ($req as $data){  
            $key = $data[Db::getParam("adm","Key")];
        }
        return $key;
    }
    
    
    public static function getAdminMailFromSecretKey($key){
        $req = AdministrateurQueryDao::getAdminMailFromSecretKey($key);
        foreach ($req as $data){  
            $key = $data[Db::getParam("adm","Mail")];
        }
        return $key;
    }
    
}
?>
