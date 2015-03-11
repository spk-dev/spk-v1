<?php

/**
*
*/
class TypeQueryDao{

    /*
    * Récupérer 1 type
    * @param type $idType
    * @return type 
    */
    public static function getOneType($idType){
        $sql = "SELECT * FROM ".Db::get("typ",null,null)." WHERE ".Db::get("typ","Id",null)."=".$idType.";";
        return UtilsDao::getInstance()->executeRequete($sql);
    }

    /*
    * Récupérer tous les types
    * @return type 
    */
    public static function getAllTypes(){
        $sql = "SELECT * FROM ".Db::get("typ",null,null);
        return UtilsDao::getInstance()->executeRequete($sql);
    }

 
}

?>