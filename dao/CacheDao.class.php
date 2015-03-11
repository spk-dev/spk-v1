<?php



/**
 * Gestion du cache des résultats SQL en mémoire.
 * @author bteillard
 */
class CacheDao{
    
    /**
     * Vérifie si le résultat de la requete est déjà en mêmoire, 
     * le cas échéant il renvoi le résultat, 
     * sinon il donne le go pour éxécuter la requete dont le résultat devra être stocké
     * 
     * @param String $strSql
     * @return ResultSet / False
     */
    public static function sqlCacheChecker($strSql){
        
        //if(key_exists($strSql, $_ENV["sqlCache"])){
        if(!empty($_ENV["sqlCache"][$strSql])) {   
            $resultSet = $_ENV["sqlCache"][$strSql];
        }else{
            $resultSet = false;
        }
        return $resultSet;
    }
    
    /**
     * Enregistre les resultSet en mémoire
     * @param String $strSql
     * @param ResultSet $resultSet
     * @return boolean
     */
    public static function sqlCacheStore($strSql, $result){
        
        $results_array = array();
        while($row = mysql_fetch_assoc($result)) {    
            array_push($results_array, $row);
        }
        $_ENV["sqlCache"][$strSql] = $results_array;    
    }
    
    /**
     * Vide le sqlCache
     */
    public static function sqlCacheFlush($key){
        if(is_null($key)){
            unset($_ENV['sqlCache']);
        }else{
            unset($_ENV['sqlCache'][$key]);
        }
        
    }
    
    
}

?>
