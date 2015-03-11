<?php


class GeolocQueryDao {

    /**
    * Renvoi toutes les régions
    * @return type
    */
    public static function getAllDepartements(){
        
        $sql = "select distinct ".Db::get("mde",null,null).".".Db::get("mde","Code",null).", ".Db::get("mde",null,null).".".Db::get("mde","Nom",null)."
                from ".Db::get("mde",null,null)."
                order by ".Db::get("mde","Nom",null).";";
        
        return UtilsDao::getInstance()->executeRequete($sql);    

    }
    
    
    /**
    * Renvoi les régions contenant des retraites
    * @return type
    */
    public static function getDepartementsContenantRetraites(){
        
        $sql = "select distinct ".Db::get("mde",null,null).".".Db::get("mde","Code",null).", ".Db::get("mde",null,null).".".Db::get("mde","Nom",null)."
                from ".Db::get("mde",null,null).", ".Db::get("vlc",null,null)."
                where ".Db::get("mde",null,null).".".Db::get("mde","Code",null)." = left(".Db::get("vlc",null,null).".".Db::get("pla","Cp",null).", 2) 
                AND ".Db::get("org","ValidationAdmin",null)." = 1 
                AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
                AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' 
                order by ".Db::get("mde","Nom",null).";";
        
        return UtilsDao::getInstance()->executeRequete($sql);
        

    }

   /**
    * Renvoi les régions contenant des retraites
    * @return type
    */
    public static function getRegionsContenantEvenements(){
        
        $sql = "select distinct ".Db::get("mre",null,null).".".Db::get("mre","Id",null).", ".Db::get("mre",null,null).".".Db::get("mre","Nom",null)."
                from ".Db::get("mre",null,null).", ".Db::get("mde",null,null).", ".Db::get("vlc",null,null)."
                where ".Db::get("mre",null,null).".".Db::get("mre","Id",null)." = ".Db::get("mde",null,null).".".Db::get("mde","RegionId",null)."
                and ".Db::get("mde",null,null).".".Db::get("mde","Code",null)." = left(".Db::get("vlc",null,null).".".Db::get("pla","Cp",null).", 2) 
                order by ".Db::get("mre","Nom",null).";";
        
        return UtilsDao::getInstance()->executeRequete($sql);
        

    }

    /**
    * Renvoi les régions contenant des retraites
    * @return type
    */
    public static function getRegionsContenantOrganisateurs(){
        
        $sql = "select distinct ".Db::get("mre",null,null).".".Db::get("mre","Id",null).", ".Db::get("mre",null,null).".".Db::get("mre","Nom",null)."
                from ".Db::get("mre",null,null).", ".Db::get("mde",null,null).", ".Db::get("vlc",null,null)."
                where ".Db::get("mre",null,null).".".Db::get("mre","Id",null)." = ".Db::get("mde",null,null).".".Db::get("mde","RegionId",null)."
                and ".Db::get("mde",null,null).".".Db::get("mde","Code",null)." = left(".Db::get("vlc",null,null).".".Db::get("pla","Cp",null).", 2)
                AND ".Db::get("org","ValidationAdmin",null)." = 1 
                AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
                AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' 
                order by ".Db::get("mre","Nom",null).";";
       
        return UtilsDao::getInstance()->executeRequete($sql);
        

    }
    
    /**
    * Renvoi toutes les régions
    * @return type
    */
    public static function getAllRegions(){
        
        $sql = "select distinct ".Db::get("mre",null,null).".".Db::get("mre","Id",null).", ".Db::get("mre",null,null).".".Db::get("mre","Nom",null)."
                from ".Db::get("mre",null,null)."
                order by ".Db::get("mre","Nom",null).";";
        
        
        return UtilsDao::getInstance()->executeRequete($sql);
        

    }
    
    
    /**
     * Renvoi la region du numéro de dep donné
     * @param type $codeDep
     * @return type
     */
    public static function getRegion($codeDep){
        
        $sql =  "Select ".Db::get("mre",null,null).".".Db::get("mre","Id",null).", ".Db::get("mre",null,null).".".Db::get("mre","Nom",null)." 
                from ".Db::get("mre",null,null).", ".Db::get("mde",null,null)." 
                where ".Db::get("mde","RegionId",null)."=".Db::get("mre","Id",null)."
                and ".Db::get("mde","Code",null)." = ".$codeDep.";";
                
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Renvoi le nom du departement du code donné.
     * @param type $codeDep
     * @return type
     */
    public static function getDepartement($codeDep){
        $sql =  "Select ".Db::get("mde",null,null).".".Db::get("mde","Nom",null)." 
                from  ".Db::get("mde",null,null)." 
                where ".Db::get("mde","Code",null)." = ".$codeDep.";";
                
        
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Renvoi tous les paramètres d'une 
     * @param type $id
     * @return type
     */
    public static function getPlace($id){
        $sql = "SELECT * FROM ".Db::get("pla",null,null)." WHERE ".Db::get("pla","Id",null)."=".$id.";";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    
    
    public static function addPlace($arrLieu){
      
        $sql = "INSERT INTO ".Db::get("pla",null,null);
        $sql .= "(".Db::get("pla","Adresse1",null).",".Db::get("pla","Adresse2",null).",".Db::get("pla","Cp",null).",".Db::get("pla","Ville",null).",".Db::get("pla","Pays",null).",".Db::get("pla","Lat",null).",".Db::get("pla","Long",null).")";
        $sql .= " VALUES ('".str_replace("'", "\'", $arrLieu['adresse1'])."','".str_replace("'", "\'", $arrLieu['adresse2'])."','".str_replace("'", "\'", $arrLieu['cp'])."','".str_replace("'", "\'", $arrLieu['ville'])."','".str_replace("'", "\'", $arrLieu['pays'])."','".$arrLieu['lat']."','".$arrLieu['long']."');";
        return UtilsDao::getInstance()->executeInsert($sql);
    }
 }
?>
