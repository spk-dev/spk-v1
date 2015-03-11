<?php

class TypeEvenementQuery{
    
    
    /**
     * Liste tous les types d'evenement
     * @return type
     */
    public static function listerTypes(){
        AppLog::ecrireLog("Rentre dans listerTypes", "debug");
        $sql = "SELECT * FROM ".Db::get("tev",null,null).";";
        AppLog::ecrireLog("Requete dans typeEvenementQuery : [".$sql."]", "debug");
        return UtilsDao::getInstance()->executeRequete($sql);
    }  
    
        /**
     * Liste tous les types d'evenement
     * @return type
     */
    public static function listerTypesPourEvenementExistant(){
        AppLog::ecrireLog("Rentre dans listerTypesPourEvenementExistant", "debug");
//        $sql = "Select distinct(".Db::get("tev","Id",null)."),".Db::get("tev","Libelle",null)." From ".Db::get("tev",null,null).",".Db::get("eve",null,null)." Where ".Db::get("eve","TypeEvenement",null)."=".Db::get("tev","Id",null).";";
        
        $sql = "SELECT distinct(".Db::get("eve","TypeEvenement",null)."), ".Db::get("tev",null,null).".* FROM ".Db::get("tev",null,null).",".Db::get("eve",null,null)."
            where ".Db::get("eve","TypeEvenement",null)." = ".Db::get("tev","Id",null)."; ";
        AppLog::ecrireLog("Requete dans typeEvenementQuery : [".$sql."]", "debug");
        return UtilsDao::getInstance()->executeRequete($sql);
    }  
    
    
    
    /**
     * Recupère un type d'evenement
     * @param type $idType
     * @return type
     */
    public static function recupererUnType($idType){
        $sql = "SELECT * FROM ".Db::get("tev",null,null)." WHERE ".Db::get("tev","Id",null)."=".$idType;
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
}
?>
