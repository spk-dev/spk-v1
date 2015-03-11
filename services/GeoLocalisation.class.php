<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class GeoLocalisation{
    
    
    /**
     * Récupère le flux XML en retour de la requete gmap
     * @param type $formatedAdr
     * @return array
     *  array['Lat']
     *  array['Long'] 
     */
    public static function getLatLongFromAdresse($lieu){

        
        $adr = self::formatAdr($lieu);

        
        $fullurl = "http://maps.googleapis.com/maps/api/geocode/json?address=".$adr."&sensor=true";
        
        $string = file_get_contents($fullurl); // get json content
        $json_a = json_decode($string, true); //json decoder
        
        if($json_a['status']=="ZERO_RESULTS"){
            AppLog::ecrireLog("Dans GeoLocalisation - getLatLongFromAdresse : Impossible de récupérer les coordonnées de l'adresse : [".$adr."]", "debug");
            return false;
        }else{

            foreach($json_a['results'] as $geo){
                $lat = $geo['geometry']['location']['lat'];
                $long = $geo['geometry']['location']['lng'];
            }
//            $lat = $json_a['results'][0]['geometry']['location']['lat'];
//            $long = $json_a['results'][0]['geometry']['location']['lng'];
            AppLog::ecrireLog("Dans GeoLocalisation - getLatLongFromAdresse :  Lat : [".$lat."] - Long : [".$long."]", "debug");

            $post_array['Lat'] = $lat;
            $post_array['Long']= $long;

            return $post_array;
        }
    }
    
    /**
     * Formater l'adresse pour la passer en param du flux xml   
     * @param type $adr
     * @return string 
     */
    private static function formatAdr($lieu){
        $formatedAdr="";
        //7+rue+montmorency,+Toulouse,+CA&
        
        $adr1 = $lieu->getAdresse1();
        $adr2 = $lieu->getAdresse2();
        $cp = $lieu->getCp();
        $ville = $lieu->getVille();
        
        if($adr1!=""){  $formatedAdr .= str_replace(" ", "+", $adr1).",";}
        if($adr2!=""){  $formatedAdr .= str_replace(" ", "+", $adr2).","; }
        if($cp!=""){    $formatedAdr .= str_replace(" ", "+", $cp).","; }
        if($ville!=""){ $formatedAdr .= str_replace(" ", "+", $ville).","; }
        
        
        return urlencode($formatedAdr);
        
    }

    /**
     * Renvoi le nom de la region
     * @param type int
     * @return array
     */
    public static function getRegion($cp){
        return GeolocalisationActionDao::getNomRegion($cp);
    }
    
    /**
     * Renvoi le nom du département
     * @param type int
     * @return array
     */
    public static function getDepartement($cp){
        return GeolocalisationActionDao::getNomDepartement($cp);
    }
    
    
    public static function getListeRegions($contientDesRetraites){
        
        return GeolocalisationActionDao::getRegionsOrganisateur($contientDesRetraites);
    }
    
    public static function getListeDepartements($contientDesEvenements, $type){
        if($type=="evenement"){
            $liste = GeolocalisationActionDao::getDepartementsEvenements($contientDesEvenements);
        }else if($type=="organisateur"){
            $liste = GeolocalisationActionDao::getDepartementsOrganisateurs($contientDesEvenements);
        }
        return $liste;
    }
 
    public static function getPlace($id){
        
        return GeolocalisationActionDao::getAdresseCompleteFromPlace($id);
    }
    
    public static function setPlace($pla){
        $lieu = new Lieu();
        $lieu->setAdresse1($pla['adresse1']);
        $lieu->setAdresse2($pla['adresse2']);
        $lieu->setCp($pla['cp']);
        $lieu->setVille($pla['ville']);
        $lieu->setPays($pla['pays']);
        
        $coord = GeoLocalisation::getLatLongFromAdresse($lieu);
        $lieu->setLat($coord['Lat']);
        $lieu->setLong($coord['Long']);
        return GeolocalisationActionDao::enregistrerPlace($lieu);
        
    }
    
}

?>
