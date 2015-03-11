<?php


class GeolocalisationActionDao{
    
  
        /**
     * Recupere les régions
     * @param type $contientDesEvenements
     * @return array
     */
    public static function getDepartementsEvenements($contientDesEvenements){
        
        if($contientDesEvenements){
            
            $req = GeolocQueryDao::getDepartementsContenantRetraites();
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
     * @param type $contientDesEvenements
     * @return array
     */
    public static function getDepartementsOrganisateurs($contientDesEvenements){
        
        if($contientDesEvenements){
            
            $req = GeolocQueryDao::getDepartementsContenantRetraites();
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
     * @param type $contientDesEvenements
     * @return array
     */
    public static function getRegionsEvenement($contientDesEvenements){
        
        if($contientDesEvenements){
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
  /**
     * Recupere les régions
     * @param type $contientDesEvenements
     * @return array
     */
    public static function getRegionsOrganisateur($contientDesEvenements){
        
        if($contientDesEvenements){
            $req = GeolocQueryDao::getRegionsContenantOrganisateurs();
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
        
    /**
     * Renvoi les infos d'adresses d'une place 
     * @param int $id place
     * @return Array
     *      $arr['Adresse1']   
     *      $arr['Adresse2'] 
     *      $arr['Cp']
     *      $arr['Ville']
     *      $arr['Pays']  
     */
    public static function getAdresseCompleteFromPlace($id){
        
         
        if($id == 0){ $id = 1; }
        $req = GeolocQueryDao::getPlace($id);
            foreach ($req as $data) {
                $place = new Place();
                $place->setId($data[Db::getParam("pla","Id")]);
                $place->setAdresse1($data[Db::getParam("pla","Adresse1")]);
                $place->setAdresse2($data[Db::getParam("pla","Adresse2")]);
                $place->setCp($data[Db::getParam("pla","Cp")]);
                $place->setVille($data[Db::getParam("pla","Ville")]);
                $place->setPays($data[Db::getParam("pla","Pays")]);
                $place->setLat($data[Db::getParam("pla","Lat")]);
                $place->setLong($data[Db::getParam("pla","Long")]);

    //            $arr['Id']          =  $data[Db::getParam("pla","Id")];
    //            $arr['Adresse1']    =   $data[Db::getParam("pla","Adresse1")];
    //            $arr['Adresse2']    =   $data[Db::getParam("pla","Adresse2")];
    //            $arr['Cp']          =   $data[Db::getParam("pla","Cp")];
    //            $arr['Ville']       =   $data[Db::getParam("pla","Ville")];
    //            $arr['Pays']        =   $data[Db::getParam("pla","Pays")];
    //            $arr['Lat']         =   $data[Db::getParam("pla","Lat")];
    //            $arr['Long']        =   $data[Db::getParam("pla","Long")];
            }
        
        return $place;
    }
    
    /**
     * Enregistrer une adresse dans la base des places.
     * @param Lieu $lieu
     * @return int (id de la place créée)
     */
    public static function enregistrerPlace(Lieu $lieu){
        
        $arrLieu = array();
        $arrLieu['adresse1']    = $lieu->getAdresse1();
        $arrLieu['adresse2']    = $lieu->getAdresse2();
        $arrLieu['cp']          = $lieu->getCp();
        $arrLieu['ville']       = $lieu->getville();
        $arrLieu['pays']        = $lieu->getPays();
        $arrLieu['lat']        = $lieu->getLat();
        $arrLieu['long']        = $lieu->getLong();
        
        $req = GeolocQueryDao::addPlace($arrLieu);
//        if($req[0]){
//            $req = $req[1];
//        }else{
//            $req = $req[0];
//        }
        return $req;
    }
}

?>
