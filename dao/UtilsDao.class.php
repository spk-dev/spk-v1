<?php


class UtilsDao{
    
       
    /** @var PDO */
    private $db = null;
    // singleton instance
    private static $instance;
//    private $startTime;
//    private $endTime;
    public $arrNb = array();
    
    public function __destruct() {
        
        $this->db = null;
    }

    /**
     * Cette méthode créé la connexion à la base de données
     * Attention : La durée de vie du singleton instance n'est que la durée du script PHP
     *             Ca ne sert donc que si on enchaine n requetes pour construire la page
     * 
     * La persistance complète de la connexion est géré dans l'attribut array(PDO::ATTR_PERSISTENT => true)
     * C'est alors le moteur APACHE qui gère le pool de connexion.....
     */
    private function getDb() {
        $host = $_ENV["properties"]['Bdd']['host'];
        $log = $_ENV["properties"]['Bdd']['login'];
        $pwd = $_ENV["properties"]['Bdd']['password'];
        $bdName = $_ENV["properties"]['Bdd']['bd'];
        
        if ($this->db !== null) {
            return $this->db;
        }
        
        try {
            
            $this->db = new PDO("mysql:host=".$host.";dbname=".$bdName, $log, $pwd,array(PDO::ATTR_PERSISTENT => true));
            $requete = $this->db->prepare("SET NAMES 'utf8'");
            $requete->execute();
            
        } catch (Exception $ex) {
            AppLog::ecrireLog("   -> Connexion KO : ".$ex->getMessage(), "sql");
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }
    
    



 
  

  /*
   * Récupère le singleton statique
   */
  public static function getInstance() { 
      
    if(self::$instance==null) { 
        
          self::$instance = new UtilsDao(); 
          self::$instance->getDb();
    } 

    return self::$instance; 

  } 
  
    
        
        
    /**
     *  Deconnexion à la bdd    
     */
    private function disconnect(){
            // on ferme la connexion � mysql
            mysql_close();
    }
        /**
        * Calcul le temps entre 2 marqueurs.
        * @return Number
        */ 
        private function getmicrotime(){  
            list($usec, $sec) = explode(" ",microtime());  
            return ((float)$usec + (float)$sec);  
        }
        /**
         * Execution de la requete
         * @param string $sql : requete
         * @return resultSet 
         */
    public function executeRequete($sql){
           

            $return = false;
            
            $requete = $this->getDb()->prepare($sql);
            $rq = $requete->execute();
            
            
            
            if($rq){
                $results_array = $requete->fetchAll(PDO::FETCH_ASSOC);
                AppLog::ecrireLog("Requete : [".$sql."] -- nb lignes affectées : [".$requete->rowCount()."]", "sql");
                $return = $results_array;
                
                
            }else{
                AppLog::ecrireLog("Requete : [".$sql."] -- erreur code : [".$requete->errorCode()."] -- erreur info : [".$requete->errorInfo()."]", "sql");

            }
            
            return $return;
    }
    
      /**
         * Execution de la requete
         * @param string $sql : requete
         * @return resultSet 
         */
    public function executeUpdateDelete($sql){
           

            $return = false;
            
            $requete = $this->getDb()->prepare($sql);
            $rq = $requete->execute();
            $nbrows = $requete->rowCount();
            
            
            if(!$rq || $nbrows < 1){
                AppLog::ecrireLog("Requete : [".$sql."] -- erreur code : [".$requete->errorCode()."] -- erreur info : [".$requete->errorInfo()."]", "sql");
                $return = false;
            }else{
                AppLog::ecrireLog("Requete : [".$sql."] -- nb lignes affectées : [".$nbrows."]", "sql");
                $return = true;
            }
            
            
            return $return;
    }
            
        /**
         * Execution de la requete
         * @param string $sql : requete
         * @return resultSet 
         */
    public function executeInsert($sql){
            $dbh = $this->getDb();
            $dbh->beginTransaction(); 
                $requete = $dbh->prepare($sql);
                $result = $requete->execute();
                $id = $dbh->lastInsertId();
            $dbh->commit(); 
            
            switch ($result) {
                case 0:
                    $results_array = array(false,null);
                    AppLog::ecrireLog("Erreur sur la requete ".$sql, "sql");
                    AppLog::ecrireLog($requete->errorCode()." : ".$requete->errorInfo(), "sql"); 
                    break;
                case 1:
                   $results_array = array(true,$id);
                    AppLog::ecrireLog("Requete OK :  id retourné : [".$id."]", "sql");
                    AppLog::ecrireLog("Requete OK :  sql : [".$sql."]", "sql");
                   break;
                default:
                    
                    break;
            }
            
            return $results_array;
            
    }
        
        
        /**
         * Compte le nombre de résultat
         * @param String $sql : requete Sql
         * @return Int : Nombre de résultat 
         */
        public function countResult($sql){
            
            $requete = $this->getDb()->prepare($sql);
            $rq = $requete->execute();
            
            return $requete->rowCount();
        }
    
        
       
        

}






?>