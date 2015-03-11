<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class UserAction{
    
      /**
     * Récupère les parametres passés en POST pour l'inscription ou la mise à jour d'un profil
     * Vérification de l'existence & Non vide (format vérifier en amont)
     * @param type $postValue
     * @return array(User,Tableau Des erreurs) 
     */
    private static function gatherUserParameters($postValue){
        
        $errorValue = array();
        // Si le USER est défini en session alors on le récupère et on met à jour l'objet, dans le cas contraire on créé un nouveau USER
        if(isset($_SESSION['adminProfile']) && $_SESSION['adminProfile'] instanceof Admin){
            $currentUser = $_SESSION['adminProfile'];
            $booUpdate = true;
        }else{
            $currentUser = new User(null,null,null,null,null,null,null,null,null,null,null);  
            $booUpdate = false;
        }
        
        // Vérification NOM
        if(isset($postValue['Nom']) && $postValue['Nom']!=""){
            $currentUser->setNom(mysql_real_escape_string($postValue['Nom']));   
        }else{
            array_push($errorValue, TextStatic::getText("Nom"));

        }
        
        
        //Vérification PRENOM
         if(isset($postValue['Prenom']) && $postValue['Prenom']!=""){
             $currentUser->setPrenom(mysql_real_escape_string($postValue['Prenom']));
        }else{
            array_push($errorValue,TextStatic::getText("Prenom"));
        }
        
        //Vérification MAIL
         if(isset($postValue['Mail']) && $postValue['Mail']!=""){
             $currentUser->setMail(mysql_real_escape_string($postValue['Mail']));
        }else{
             array_push($errorValue,TextStatic::getText("Mail"));
        }
        
        //Verification TEL1
        if(isset($postValue['Tel']) && $postValue['Tel']!=""){
             $currentUser->setTel1(mysql_real_escape_string($postValue['Tel']));
        }else{
            array_push($errorValue,TextStatic::getText("Tel"));
        }
        
        
        //Vérification du mot de passe et de la concordance entre les 2.
        if((isset($postValue['Password2']) && $postValue['Password2']!="")&& (isset($postValue['Password']) && $postValue['Password']!="")){
             if($postValue['Password2'] == $postValue['Password']){
                 $currentUser->setPassword(mysql_escape_string(md5($postValue['Password'])));
             }
        }else{
            array_push($errorValue,TextStatic::getText("Password"));
        }
        
        
        return array($currentUser,$errorValue);
    }
    
    /**
     * Vérifie si le couple Login Mot de passe existe et charge l'objet User correspondant en session
     * @param type $login
     * @param type $pass 
     */
    public static function logIn($login, $pass){
        
        $req = Admin::checkUsers($login, $pass);
        $nbLignes = mysql_num_rows($req); 
        $data = mysql_fetch_array($req);
   
        // S'il n'y a que 1 résultat alors OK
        if(!$data){
           
            echo utf8_decode("Pas de compte associé à ces logins / mot de passe");
            return false;
            
        }else{
           if($nbLignes==1){
                $userValues = array();
                $i=0;
                foreach (User::dbFieldList() as $value) {
                    array_push($userValues, $data[$value]);
                    $i++;
                }
                $currentUser = new User($userValues[0], $userValues[1],$userValues[2],$userValues[3],$userValues[4],$userValues[5],$userValues[6],$userValues[7],$userValues[8],$userValues[9],$userValues[10]);
                
                $_SESSION['user'] = $currentUser;
                    // Une fois loggué, redirection vers la page indiquée dans le fichier de config
                
                
                return true;     

            }elseif($nbLignes>1){
                // s'il y a plus qu'un cas : pas bon !!!
                AppLog::ecrireLog("Login : Il y a un doublon","debug");
                
                return false;
            }
        }
        
        
        
        
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
     *Suppression du compte utilisateur 
     */
    public function unSuscribe(){
        
    }
    
    /**
     * Inscription d'un nouvel utilisateur
     * @param type $postValue
     * @return string 
     */
    public static function suscribe($postValue){
        $returnValue = "Impossible d'enregistrer le profil";
        
        //Récupération des parametres
        $paramGathered = self::gatherUserParameters($postValue);
        $user = $paramGathered[0];
        $missingFields = $paramGathered[1];
        
        
        if(count($missingFields)==0){
            $req = UserDao::addUser($user);
            if($req){$returnValue = "Profil correctement enregistré";}
        }else{
            $returnValue="<b>Erreur</b><br/><br/>";
            // Si la valeur de retour est un tableau il contient les noms des champs manquants
            foreach ($paramGathered as $value) {
                $returnValue .= $value." manquant<br/>";
            }
        }
        
        return $returnValue;
    }
      
    /**
     * Mise à jour de l'utilisateur
     */
    public static function updateUser($postValue){
        $returnValue = "Impossible de modifier le profil";
        
        //Récupération des parametres
        $paramGathered = self::gatherUserParameters($postValue);
        $req = UserDao::updateUser($paramGathered[0]);
        if($req){
            $returnValue = "Modification ok";
        }
        
        return $returnValue;
        
    }
    
     /**
     * Mise à jour de l'utilisateur
     */
    public static function updateUserPassWord($postValue){
        
        $returnValue = "Impossible de modifier le mot de passe";
        
        //Récupération des parametres
        $paramGathered = self::gatherUserParameters($postValue);
        $req = UserDao::updateUser($paramGathered[0]);
        if($req){
            $returnValue = "Modification ok";
        }
        
        return $returnValue;
        
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
    
    
}
?>
