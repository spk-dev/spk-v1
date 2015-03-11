<?php



/**
 * 
 * @author bteillard
 *
 */
class EvenementActionDao{

    
    /**
     * Liste toutes les retraites pour la page principale
     * @param EvenementSearchCriteria $filter
     * @return array 
     */
    public static function listerTousEvenementsold(EvenementSearchCriteria $filter){

        $req = EvenementQueryDao::getListeEvenements($filter->getCondition());
        $listeEvenement = array();
        foreach ($req as $data)
        {
            array_push($listeEvenement, $data);
        }
        return $listeEvenement;

    }

    public static function ListerTousEvenementsPourMap(EvenementSearchCriteria $filter, $lieuValideFacultatif = null){
        $req = EvenementQueryDao::getListeEvenements($filter, $lieuValideFacultatif);
        $tabAllEvenement = array();

        if($req){
            foreach ($req as $data){

                $idPlace = $data[Db::getParam("pla","Id")];
                $adr1Place = $data[Db::getParam("pla", "Adresse1")];
                $adr2Place = $data[Db::getParam("pla", "Adresse2")];
                $cpPlace  = $data[Db::getParam("pla", "Cp")];
                $villePlace  = $data[Db::getParam("pla", "Ville")];
                $paysPlace = $data[Db::getParam("pla", "Pays")];
                $latPlace = $data[Db::getParam("pla", "Lat")];
                $longPlace  = $data[Db::getParam("pla", "Long")];

                
                
                
                $IdEvenement = $data[Db::getParam("eve","Id")];
                $NomEvenement = TextStatic::htmlPropre($data[Db::getParam("eve","Nom")]);

                $idLieu = $data[Db::getParam("eve","LieuId")];
                $typeEvenement = $data[Db::getParam("eve","TypeEvenement")];
                $dateEnregistrement = $data[Db::getParam("eve","DateEnregistrement")];
                
                $theme = ThemeActionDao::recupererThemesForEvenement($IdEvenement);
                $tabIntervenants = IntervenantActionDao::recupererIntervenantsForEvenement($IdEvenement);
                
                $retraiteToAdd = new Evenement();
                
               
                
                $retraiteToAdd->setId($IdEvenement);
                $retraiteToAdd->setNom($NomEvenement);
                $retraiteToAdd->setDescription($descEvenement);
                $retraiteToAdd->setMailInscription($mailInscription);
                $retraiteToAdd->setCoordInscription($coordInscription);
                $retraiteToAdd->setDateDebut($dateEvenementDebut);
                $retraiteToAdd->setDateFin($dateEvenementFin);
                $retraiteToAdd->setMainPhoto($photoNom);
                $retraiteToAdd->setPrix($prixEvenement);
                $retraiteToAdd->setGarderie($booGarderie);
                $retraiteToAdd->setHebergement($booHebergement);
                $retraiteToAdd->setLieu($idLieu);
                $retraiteToAdd->setIntervenants($tabIntervenants);
                $retraiteToAdd->setTheme($theme);
                $retraiteToAdd->setTypeEvenement($typeEvenement);
                $retraiteToAdd->setDateEnregistrement($dateEnregistrement);
                
                $retraiteToAdd->setPlace($idPlace);
                
                array_push($tabAllEvenement, $retraiteToAdd);
            }
        }
    }
    
    /**
        * Renvoi une liste contenant toutes les retraites (1 objet Retraite par iteration)
        * @param EvenementSearchCriteria $filter
        * @return \Evenement 
        */
    public static function listerTousEvenements(EvenementSearchCriteria $filter,$lieuValideFacultatif = null){
        
        
        
        $req = EvenementQueryDao::getListeTousEvenements($filter->getCondition(),$lieuValideFacultatif);
        
        $tabAllEvenements = array();

        if($req){
            foreach ($req as $data){
                

                $IdRetraite = $data[Db::getParam("eve","Id")];
                $NomRetraite = TextStatic::htmlPropre($data[Db::getParam("eve","Nom")]);
                $descRetraite = $data[Db::getParam("eve","Description")];
                $mailInscription = $data[Db::getParam("eve","MailInscription")];
                $coordInscription = $data[Db::getParam("eve","ContacInscription")];
                $dateRetraiteDebut = $data[Db::getParam("eve","Datedebut")];
                $dateRetraiteFin = $data[Db::getParam("eve","Datefin")];
                $prixRetraite = $data[Db::getParam("eve","Prix")];
                $photoNom = $data[Db::getParam("eve","Mainphoto")];
                $booGarderie = $data[Db::getParam("eve","Garderie")];
                $booHebergement = $data[Db::getParam("eve","Hebergement")];
                $idLieu = $data[Db::getParam("eve","LieuId")];
                $typeEvenement = $data[Db::getParam("eve","TypeEvenement")];
                $dateEnregistrement = $data[Db::getParam("eve","DateEnregistrement")];
                $idPlace = $data[Db::getParam("eve","PlaceId")];
                $theme = ThemeActionDao::recupererThemesForRetraite($IdRetraite);
                $tabIntervenants = IntervenantActionDao::recupererIntervenantsForRetraite($IdRetraite);
                
                $evenementToAdd = new Evenement();
                
                
                $evenementToAdd->setId($IdRetraite);
                $evenementToAdd->setNom($NomRetraite);
                $evenementToAdd->setDescription($descRetraite);
                $evenementToAdd->setMailInscription($mailInscription);
                $evenementToAdd->setCoordInscription($coordInscription);
                $evenementToAdd->setDateDebut($dateRetraiteDebut);
                $evenementToAdd->setDateFin($dateRetraiteFin);
                $evenementToAdd->setMainPhoto($photoNom);
                $evenementToAdd->setPrix($prixRetraite);
                $evenementToAdd->setGarderie($booGarderie);
                $evenementToAdd->setHebergement($booHebergement);
                $evenementToAdd->setLieu($idLieu);
                $evenementToAdd->setIntervenants($tabIntervenants);
                $evenementToAdd->setTheme($theme);
                $evenementToAdd->setTypeEvenement($typeEvenement);
                $evenementToAdd->setDateEnregistrement($dateEnregistrement);
                $evenementToAdd->setPlace($idPlace);
                
                
                array_push($tabAllEvenements, $evenementToAdd);
            }
        }


    return $tabAllEvenements;	
    }

    /**
    * 
    * @param unknown_type $idRetraite
    * @return Evenement
    */
    public static function getEvenement($idRetraite,$lieuValideFacultatif = null){
            AppLog::ecrireLog("3-1-1 - dans EvenementActionDao - start", "debug");
            $req = EvenementQueryDao::getEvenement($idRetraite,$lieuValideFacultatif); 
            AppLog::ecrireLog("3-1-2 - dans EvenementActionDao - liste req recuperee", "debug");
            $evenementToDisplay = null;
            foreach ($req as $data)
            {
                $IdRetraite = $data[Db::getParam("eve","Id")];
                $NomRetraite = TextStatic::htmlPropre($data[Db::getParam("eve","Nom")]);
                $descRetraite = $data[Db::getParam("eve","Description")];
                $mailInscription = $data[Db::getParam("eve","MailInscription")];
                $coordInscription = $data[Db::getParam("eve","ContacInscription")];
                $dateRetraiteDebut = $data[Db::getParam("eve","Datedebut")];
                $dateRetraiteFin = $data[Db::getParam("eve","Datefin")];
                $prixRetraite = $data[Db::getParam("eve","Prix")];
                $photoNom = $data[Db::getParam("eve","Mainphoto")];
                $booGarderie = $data[Db::getParam("eve","Garderie")];
                $booHebergement = $data[Db::getParam("eve","Hebergement")];
                $idLieu = $data[Db::getParam("eve","LieuId")];
                $typeEvenement = $data[Db::getParam("eve","TypeEvenement")];
                $dateEnregistrement = $data[Db::getParam("eve","DateEnregistrement")];
                $idPlace = $data[Db::getParam("eve","PlaceId")];
                AppLog::ecrireLog("3-1-3 - dans EvenementActionDao - param recuperee de la base", "debug");
                
                $theme = ThemeActionDao::recupererThemesForRetraite($IdRetraite);
                AppLog::ecrireLog("3-1-4 - dans EvenementActionDao - Themes recuperees", "debug");
                $tabIntervenants = IntervenantActionDao::recupererIntervenantsForRetraite($IdRetraite);
                AppLog::ecrireLog("3-1-5 - dans EvenementActionDao - intervenants recuperee", "debug");

                $evenementToDisplay = new Evenement();
                $evenementToDisplay->setId($IdRetraite);
                $evenementToDisplay->setNom($NomRetraite);
                $evenementToDisplay->setDescription($descRetraite);
                $evenementToDisplay->setMailInscription($mailInscription);
                $evenementToDisplay->setCoordInscription($coordInscription);
                $evenementToDisplay->setDateDebut($dateRetraiteDebut);
                $evenementToDisplay->setDateFin($dateRetraiteFin);
                $evenementToDisplay->setMainPhoto($photoNom);
                $evenementToDisplay->setPrix($prixRetraite);
                $evenementToDisplay->setGarderie($booGarderie);
                $evenementToDisplay->setHebergement($booHebergement);
                $evenementToDisplay->setLieu($idLieu);
                $evenementToDisplay->setIntervenants($tabIntervenants);
                $evenementToDisplay->setTheme($theme);
                $evenementToDisplay->setTypeEvenement($typeEvenement);
                $evenementToDisplay->setDateEnregistrement($dateEnregistrement);
                $evenementToDisplay->setPlace($idPlace);
            }

            AppLog::ecrireLog("3-1-6 - dans EvenementActionDao - Avant le return", "debug");

            return $evenementToDisplay;
    }

   

    /**
    * 
    * @param Evenement $retraite
    */
    public static function creerUnEvenement(Evenement $retraite){
        Return EvenementQueryDao::creerEvenement($retraite);	
           

    }

    /**
    * 
    * @param Evenement $retraite
    */
    public static function modifierUnEvenement(Evenement $retraite){
            return EvenementQueryDao::modifierUnEvenement($retraite);      
    }

    /**
    * 
    * @param Evenement $retraite
    */
    public static function supprimerUnEvenement($idRetraite){
            return EvenementQueryDao::SupprimerUnEvenement($idRetraite);
    }

    /**
        *
        * @param type $idLieu 
        */
    public static function getNombreEvenementPourUnOrganisateur($idLieu){
        $req = EvenementQueryDao::getListeEvenementsPourUnOrganisateur($idLieu);
        $nbResult = 0;
        foreach ($req as $data){
            $nbResult++;
        }
        return $nbResult;
    }

    /**
        * Renvoi un array contenant les id des retraites pour le lieu 
        * @param type $idLieu
        * @return array 
        */
    public static function getListeEvenementsPourUnLieu($idLieu){
        $req = EvenementQueryDao::getListeEvenementsPourUnOrganisateur($idLieu);
        $listeEvenement = array();
        foreach ($req as $data){
            array_push($listeEvenement, $data[Db::getParam("eve","Id")]);
        }

        return $listeEvenement;
    }

    /**
    * Récupère la liste des Themes associées à une retraite
    * @param type $idRetraite
    * @return Liste d'ojet Theme 
    */
    public static function getThemesPourUnEvenement($idEvenement){
      
        $req = EvenementQueryDao::getListeThemePourUnEvenement($idEvenement);
        $tabTheme = array();
        
        foreach ($req as $data){
            $theme = new Theme($data[Db::getParam("the","Id")],$data[Db::getParam("the","Nom")],$data[Db::getParam("the","Description")],$data[Db::getParam("the","Image")]);
            array_push($tabTheme, $theme);
        }
        return $tabTheme;

    }
    
    /**
     * Recupère la liste des types à traiter en Home Page
     * @return array (0:idType , 1 : Nbvalues)
     */
    public static function getListeTypesEvenementsPlusUtilises(){
        
        $req = EvenementQueryDao::getListeTypesLesPlusUtilises();
        $liste = array();
        $limit = $_ENV['properties']['Home']['nbListe'];
        $i=1;
        foreach ($req as $data){
          if($i<$limit){
            $idType = $data[Db::getParam("eve","TypeEvenement")];
            $nbItems = $data['nbItems'];

            $item = array($idType,$nbItems);
            array_push($liste, $item);
          
            $i++;
          }
            
            
        }
        return $liste;
    }
    
    
    /**
     * Renvoi le nombre d'événement répondant aux critères
     * @param EvenementSearchCriteria $filter
     * @return int
     */
    public static function getNombreEvements(EvenementSearchCriteria $filter){
        $val=0;
        $req = EvenementQueryDao::getNombreEvenements($filter->getCondition(), false);
        
        foreach ($req as $data)
        {
            $val = $data['nbEvenements'];
        }
        return $val;

    }
        

}

?>