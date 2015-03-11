<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NewsletterActionDao{
    
    /**
     * Vérifie si l'email passé en parametre existe dans la table newsletter
     * @param type $email
     * @return boolean 
     */
    public static function isEmailOnDatabase($email){
       
        
        $nb = NewsletterQueryDao::isEmailOnDataBase($email);
        $result = true;
        if($nb<1){
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }
    
    /**
     * AJoute l'email à la base
     * @param type $email
     * @return type 
     */
    public static function addEmail($nom, $prenom, $email,$optin){
        
        if(!self::isEmailOnDatabase($email)){
            $returnValue = NewsletterQueryDao::addNewsletterSuscriber($nom,$prenom, $email,$optin);        
        }else{
            $returnValue = array(false,null);
        }
        
        return $returnValue;
        }
        
     /**
      * Supprime l'email de la base
      * @param type $email
      * @return type 
      */   
     public static function emailOptOut($key){
         $emailRemoved = NewsletterQueryDao::emailOptOut($key);
        
         return $emailRemoved;
         
     }
     
     
     /**
      * Recupere la clé de desinscription
      * @param type $email
      * @return type
      */
     public static function getKey($email){
         
         $req = NewsletterQueryDao::selectNewsletterSuscribers($email);
         foreach($req as $data){
             $key = $data[Db::getParam("new","Key")];
         }
        return $key;
     }
    
}
?>
