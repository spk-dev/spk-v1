<?php

class DiaporamaQueryDao{

    public static function getItemsPourDiaporama(){
        
            $sql = "SELECT * FROM ".Db::get("dia",null,null)." ORDER BY ".Db::get("dia","Ordre",null).";";
            
            return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    public static function deleteEvenementDiapo($idEvenement){
        $sql = "DELETE FROM ".Db::get("dia",null,null)." WHERE ".Db::get("dia","EvenementId",null)." = ".$idEvenement.";";
        return UtilsDao::getInstance()->executeRequete($sql);
            
    }
   
}



?>
