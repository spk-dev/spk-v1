<?php



class CommunauteActionDao{

/**
 * Renvoi une liste d'objets Communauté.
 * @param boo $contientDesRetraites
 * @return array 
 */
public static function listerToutesCommunautes($contientDesRetraites){
  
    if($contientDesRetraites){
        $req = CommunauteQueryDao::getCommunautesProposantRetraites();
    }else{
        $req = CommunauteQueryDao::getAllCommunautes();
    }
    
    $tabAll = array();
    foreach ($req as $data)
    {
       $communaute = new Communaute($data[Db::getParam("com", "Id")], $data[Db::getParam("com", "Nom")], $data[Db::getParam("com", "Description")], $data[Db::getParam("com", "Photo")]);
       array_push($tabAll, $communaute);
    }


return $tabAll;	
}
    
/**
* 
* @param unknown_type $idRetraite
* @return Evenement
*/
public static function recupererUneCommunaute($idCommunaute){
    // R�cup�re la liste de tous les champs de la table Lieu
   
    $communaute = null;
    $req = CommunauteQueryDao::getOneCommunaute($idCommunaute);
    foreach ($req as $data)
    {
        $communaute = new Communaute($data[Db::getParam("com", "Id")], $data[Db::getParam("com", "Nom")], $data[Db::getParam("com", "Description")], $data[Db::getParam("com", "Photo")]);
    }
    return $communaute;
}

/**
    * 
    * @param Evenement $retraite
    */
public static function enregitrerCommunaute(Communaute $communaute){
        CommunauteQueryDao::addCommunaute($communaute);	
}

/**
    * 
    * @param Evenement $retraite
    */
public static function modifierCommunaute(Communaute $communaute){
        CommunauteQueryDao::modifyCommunaute($communaute);
}

/**
    * 
    * @param Evenement $retraite
    */
public static function effacerCommunaute($idCommunaute){

        // TESTER ICI S'Il RESTE DES LIEUX DE CETTE COMMUNAUTE
        // TESTER ICI S'IL RESTE DES INTERVENANTS DE CETTE COMMUNAUTE 

        // CommunauteQueryDao::deleteCommunaute($idCommunaute);
    return $idCommunaute;
}

     
}

?>
