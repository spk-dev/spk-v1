<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdministrateurAction {

    public static function administrateurDejaExistant($mail){
        return AdministrateurActionDao::administrateurDejaExistant($mail);
        
    }
    
    
    
    public static function listerAdministrateurPourAjax($str){
        $answer = array();
        
//        $tab = LieuActionDao::listerLieuxFilter($filter, false);
        $str = SecurityUtil::securVarParam($str);
        $tab = AdministrateurActionDao::listerAdministrateur($str);
        
//         $tab = IntervenantActionDao::searchIntervenant($text);
          
         
        if(count($tab)==0){
            $answer[] = array("id"=>"0","text"=>"No Results Found..");
        }else{
            foreach ($tab as $value) {
                AppLog::ecrireLog("id = ".$value->getId()." , text = ".$value->getNomComplet(), "debug");
                $answer[] = array("id"=>$value->getId(),"text"=>$value->getNomComplet());
            }
        }
        return $answer;    
    }
    
    /**
     * Renvoi l'objet Administrateur de l'ID courant.
     * @param num $id
     * @return Administrateur
     */
    public static function getAdministrateur($id){
        AppLog::ecrireLog("Dans get Administrateur id = [".$id."]", "debug");
        if($id==""){
            
            $admin = new Administrateur();
        }else{
            $admin = AdministrateurActionDao::getAdministrateur($id);    
        }
        
        return $admin;
    }
    
    /**
     * 
     * @param type $var
     * @param type $admin
     */
    public static function updateAdministrateur($var, Administrateur $admin){
        
        $booValid = false;
        
        
         if($var['Nom']!="" && $var['Prenom']!=""&& $var['Mail']!=""){
            $admin->setNom($var['Nom']);
            $admin->setPrenom($var['Prenom']);
            $admin->setTel($var['Tel']);
            $admin->setMail($var['Mail']);
                    
            $booValid = AdministrateurActionDao::updateAdministrateur($admin);

            if($var['Password1'] != "" && $var['Password2'] != ""){
                if($var['Password1'] === $var['Password2']){
                    $admin->setPassword($var['Password1']);
                    $booValid = AdministrateurActionDao::updatePwdAdministrateur($admin);
                }else{
                    AppLog::ecrireLog("Dans AdministrateurAction - Les password sont différents", "debug");
                }
            }
        }
        return $booValid;
        
    }
    

    /**
     * Vérifie si le couple Login Mot de passe existe et charge l'objet User correspondant en session
     * @param type $login
     * @param type $pass 
     */
    public static function logIn($mail, $pass, $booSuperAdmin = false) {

        $returnValue = AdministrateurActionDao::logIn($mail, $pass, $booSuperAdmin);
        $booStatus = false;
        // Si c'est ok, on place l'objet Admin en mémoire et on renvoi le text de confirmation.
       if(is_numeric($returnValue)){
            $_SESSION['identSession'] = $returnValue;
            $booStatus = true;
        }
        
        return $booStatus;
               
        
    }
    
    /**
     * 
     * @param Administrateur $admin
     * @param Lieu $lieu
     * @return Array(boolean, string)
     */
    public static function inscrireAdministrateur(Administrateur $admin, Lieu $lieu){
        $booResult = false;
        $password = uniqid();      
        $result = AdministrateurActionDao::inscrireAdministrateur($admin, SecurityUtil::securPwd($password));
        
        $isNewAdmin = $result[0];
        $idNewAdmin = $result[1];   
        
        if ($isNewAdmin){
            $booResult = true;
            $strResult = "Votre compte administrateur a bien été créé.";
            $pwd = $password;
            
            $lieu->setAdmin($idNewAdmin);
            $recLieu = LieuActionDao::enregitrerLieu($lieu);
            if($recLieu != false){
                $strResult .= "<br/>Votre organisation a bien été enregistrée";
                $strResult .= "<br/><br/>Vous allez recevoir un email à l'adresse : ".$admin->getMail()." confirmant votre inscription.";
                $strResult .= "<br/><br/>Vous retrouverez dans ce mail toutes les informations nécessaires pour vous connexion sur SPIBOOK.";
                $strResult .= "<br/><br/>Si vous ne recevez pas l'email, n'hésitez pas à vérifier dans les 'courriers indésirables'";
                
            }else{
                $strResult .= "<br/>Votre organisation n'a pas été enregistrée";
                $pwd = null;
            }
            
        
            
            
        }else{
            $booResult = false;
            $pwd = null;
            $strResult .= "Une erreur a eu lieu, votre compte n'a pas pu être créé.'";
        }
        return array($booResult,$strResult,$password);
    }
  
    /**
     * Renvoi le mdp d'un admin en fonction de son mail.
     * @param type $mail
     * @return boo
     */
    public static function sendAdministratorRecoveryLink($mail){
       
        $boo = false;
        $key = AdministrateurActionDao::getAdminSecretKeyByEmail($mail);
        $sendMail = new UtilMail();
        
        if($sendMail->mailRecoverPwdSecretKey($mail, urlencode($key))){
            $boo = true;
            AppLog::ecrireLog("envoi OK sendAdministratorRecoveryLink mail : [".$mail."]", "debug");
        }else{
            AppLog::ecrireLog("envoi KO sendAdministratorRecoveryLink mail : [".$mail."]", "debug");
        }
                
        
        return $boo;
    }
    
    
     /**
     * Renvoi le mdp d'un admin en fonction de son mail.
     * @param type $mail
     * @return boo
     */
    public static function sendAdministratorNewPwd($key){
        $admin = self::getAdministrateur(AdministrateurActionDao::getIdAdminFromKey($key));
        $password = uniqid();
        $admin->setPassword(SecurityUtil::securPwd($password));
        if(AdministrateurActionDao::updatePwdAdministrateur($admin)){
            $sendMail = new UtilMail();
            if($sendMail->mailRecoverPwdNewPwd($admin->getMail(), $password)){
                $boo = true;
            }else{
                $boo = false;
            }
        }else{
            $boo = false;
        }
        return $boo;
    }

}

?>
