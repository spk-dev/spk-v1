<?php


class GeolocActionDao{
    
  
        /**
     * Recupere les régions
     * @param type $contientDesRetraites
     * @return array
     */
    public static function getDepartements($contientDesRetraites){
        
        if($contientDesRetraites){
            
            $req = GeolocQueryDao::getDepartementsContnenantRetraites();
        }else{
            $req = GeolocQueryDao::getAllDepartements();
        }
        
        $tab = array();

        foreach ($req as $data){
            $tabRegion = array();
            $tabRegion['Code']          =   $data[Db::getParam("mde","Code")];
            $tabRegion['Nom']         =   $data[Db::getParam("mde","Nom")];
            
           array_push($tab, $tabRegion);

        }
        return $tab;
        }
    /**
     * Recupere les régions
     * @param type $contientDesRetraites
     * @return array
     */
    public static function getRegions($contientDesRetraites){
        
        if($contientDesRetraites){
            $req = GeolocQueryDao::getRegionsContenantEvenements();
        }else{
            $req = GeolocQueryDao::getAllRegions();
        }
        
        $tab = array();

        foreach ($req as $data){
            $tabRegion = array();
            $tabRegion['Id']          =   $data[Db::getParam("mre","Id")];
            $tabRegion['Nom']         =   $data[Db::getParam("mre","Nom")];
            
           array_push($tab, $tabRegion);

        }
        return $tab;
        }
  
        
        
    public static function getNomRegion($cp){
        $cp = substr($cp, 0, 2);
        $req = GeolocQueryDao::getRegion($cp);
        foreach ($req as $data) {
            $tabRegion = array();
            $tabRegion['Id']          =   $data[Db::getParam("mre","Id")];
            $tabRegion['Nom']         =   $data[Db::getParam("mre","Nom")];
        }
        return $tabRegion;
    }
    
    public static function getNomDepartement($cp){
        $cp = substr($cp, 0, 2);
        $req = GeolocQueryDao::getDepartement($cp);
        foreach ($req as $data) {
            $tabDep = array();
            $tabDep['Nom']          =   $data[Db::getParam("mde","Nom")];
        }
        return $tabDep;
    }
        
}

?>
