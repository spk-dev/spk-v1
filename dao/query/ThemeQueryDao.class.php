<?php


/**
 * 
 */
class ThemeQueryDao{

    
    /**
     * Renvoi toutes les retraites auxquelles le ou les intervenants sont associés
     * @param Array $idIntervenants
     * @return resultset 
     */
    public static function getRetraitesForTheme($idTheme){
        
        $nbTheme = count($idTheme);
        
        if($nbTheme>1){
            $sql = "SELECT DISTINCT ".Db::get("tre","RetraiteId",null)." FROM ".Db::get("tre",null,null)." WHERE ".Db::get("tre","ThemeId",null)." IN (";
            
            for ($i = 0; $i < $nbTheme; $i++) {
                $sql .= $idTheme[$i];
                if($i<$nbTheme-1){
                    $sql .=",";
                }
            }
            
            $sql .= ");";
        }else{
            $sql = "SELECT DISTINCT ".Db::get("tre","RetraiteId",null)." FROM ".Db::get("tre",null,null)." WHERE ".Db::get("tre","ThemeId",null)."= ".$idTheme[0];
        }
                
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
  
    /**
     * Récupérer un theme en fonction de son ID
     * @param type $idTheme
     * @return type 
     */
    public static function getOneTheme($idTheme){

            $sql = "SELECT * FROM ".Db::get("the",null,null)." WHERE ".Db::get("the","Id",null)."=".$idTheme.";";

            return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
        * Select toutes les lieus de la base
        * @return resource
        */
    public static function getAllThemes(){
            $sql = "SELECT * FROM ".Db::get("the",null,null)."";
            return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
        * Select toutes les lieus de la base
        * @return resource
        */
    public static function getAllThemesFromRetraite(){
            $sql = "SELECT * FROM ".Db::get("the",null,null).
                    " WHERE ".Db::get("the","Id",null)." IN (SELECT DISTINCT 
                        ".Db::get("tre","ThemeId",null).
                            " FROM ".Db::get("tre",null,null).");";
            return UtilsDao::getInstance()->executeRequete($sql);
    }

    
    public static function getThemesFromRetraites($condition){
        $sql = "Select distinct(".Db::get("tre","ThemeId",null)."), ".Db::get("the",null,null).".*, count( ".Db::get("tre","RetraiteId",null).") as 'nb'
                From ".Db::get("tre",null,null).",".Db::get("the",null,null).",".Db::get("vev",null,null)."
                where ".Db::get("tre","ThemeId",null)."=".Db::get("the","Id",null)."
                and ".Db::get("eve","Id",null)."=".Db::get("tre","RetraiteId",null)."
                and ".Db::get("org","ValidationAdmin",null)."= 1
                and ".Db::get("org","ValidationSuperAdmin",null)."= 1
                group by ".Db::get("tre","ThemeId",null)." ";
        $sql .= $condition.";";
       
        AppLog::ecrireLog("TOTO: [".$sql."]", "debug");
        
        return UtilsDao::getInstance()->executeRequete($sql);
                
    }
    
 
    /**
     * Association d'un theme et d'une retraite
     * @param type $idRetraite
     * @param type $idTheme
     */
    public static function associateThemeRetraite($idRetraite, $idTheme){
            $sql ="INSERT INTO  ".Db::get("tre",null,null)." (
                    ".Db::get("tre","ThemeId",null)." ,
                    ".Db::get("tre","RetraiteId",null)."
                    )VALUES (
                    ".$idTheme.",".$idRetraite."
                    );
                    ";
        
            
        return UtilsDao::getInstance()->executeInsert($sql);   
    }

    /**
     * Efface les correspondance entre un ou plusieurs themes et une retraite
     * @param int $idRetraite
     * @param int, array or null $idTheme
     */
    public static function deleteAssociationThemeRetraite($idRetraite, $idTheme){
     
        if(is_null($idTheme)){
            $sql = "DELETE FROM ".Db::get("tre",null,null)."
                WHERE ".Db::get("tre","RetraiteId",null)." = ".$idRetraite.";";
            
            
        }else if(is_array($idTheme)){
            $sql = "DELETE FROM ".Db::get("tre",null,null)."
                WHERE ".Db::get("tre","RetraiteId",null)." = ".$idRetraite."
                AND ".Db::get("tre","ThemeId",null)." IN (";
            
                $i = 1;
                $nbThemes = count($idTheme);
                foreach($idTheme as $id){
                    $sql .=$id;
                    if($i<$nbThemes){
                        $sql .=",";
                    }
                    $i++;
                }
                $sql .");";
            
        }else{
            $sql = "DELETE FROM ".Db::get("tre",null,null)."
                WHERE ".Db::get("tre","RetraiteId",null)." = ".$idRetraite."
                AND ".Db::get("tre","ThemeId",null)." = ".$idTheme.";";
        }
        
        Return UtilsDao::getInstance()->executeRequete($sql);
        
    }

}