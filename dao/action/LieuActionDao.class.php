<?php


/**
 * 
 * @author bteillard
 *
 */
class LieuActionDao{
    
   /**
    * Activation d'un organisateur par son administrateur
    * @param int $idLieu
    * @param int $booActivation (0,1)
    * @return boo
    */
   public static function activate($idLieu,$booActivation){
       return LieuQueryDao::activate($idLieu,$booActivation);
   }
   /**
    * Activation d'un organisateur par le superAdmin SPibook
    * @param int $idLieu
    * @param int $booActivation (0,1)
    * @return boo
    */
   public static function activateSuperAdmin($idLieu,$booActivation){
       AppLog::ecrireLog("Rentre dans LieuActionDao.class - l 27", "debug");
       return LieuQueryDao::activateSuperAdmin($idLieu,$booActivation);
   }
   /**
    * Créer une nouvelle adresse dans place et l'associe à l'organisateur
    * @param int $idLieu
    * @param int $idPlace
    * @return boo
    */ 
   public static function updateOrganisateurPlace($idLieu, $idPlace){
       return LieuQueryDao::updatePlaceOrganisateur($idLieu, $idPlace);
   }

    /**
     * Récupérer la liste des images pour une lieu défini
     * @param type $idLieu
     * @return array 
     */
    public static function recupererListeImagesForLieu($lieu){
        $listeImage = array(); 
        
        $idLieu = $lieu->getId();
        $req = LieuQueryDao::getPhotosFromLieux($idLieu);
        foreach ($req as $data){
            
            array_push($listeImage, $data[Db::getParam("pli","Nom")]);
        }
        return $listeImage; 
    }

    /**
    * Liste de tous les lieux
    * @return array 
    */
    public static function listeTousLesLieuxPourSelect(OrganisateurSearchCriteria $filter, $toutAfficher){
        $req = LieuQueryDao::getAllLieuxPourSelect($filter->getCondition(), $toutAfficher);
        $tabListeLieux = array();
        foreach ($req as $data){
                array_push($tabListeLieux, $data);
        }
        return $tabListeLieux;
    }


    /**
    * Liste les lieux associés à des retraites existantes
    * @return array 
    */
    public static function listeLieuxFiltreRetraite(){
        
       $req = LieuQueryDao::getLieuxFromRetraite();
       
       $tabListeLieux = array();
        
        if($req != false){
            foreach ($req as $data){
                $lieu = self::recupererUnLieu($data[Db::getParam("eve","LieuId")]);
                
                array_push($tabListeLieux, $lieu);
            }
        }else{
             AppLog::ecrireLog("Aucun résultat pour LieuActionDao->listelieuxFiltreRetraite","debug");
        }
        return $tabListeLieux;
    }

    
    /**
    *  Lister les lieux
    */
    public static function listerLieuxFilter(OrganisateurSearchCriteria $filter, $lieuValideFacultatif=null){
        
        $req  = LieuQueryDao::getLieuxFiltered($filter, $lieuValideFacultatif);

        $tabAllLieu = array();
        
        foreach ($req as $data)
            {    
            
                $ArgId = $data[Db::getParam("org", "Id")];
                $ArgNom = TextStatic::htmlPropre($data[Db::getParam("org", "Nom")]);
                $ArgDesc = $data[Db::getParam("org", "Description")];
                $ArgHebergement = $data[Db::getParam("org", "Hebergement")];
                $ArgAdresse1 = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse1")]);
                $ArgAdresse2 = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse2")]);
                $ArgCp = TextStatic::htmlPropre($data[Db::getParam("pla", "Cp")]);
                $ArgVille = TextStatic::htmlPropre($data[Db::getParam("pla", "Ville")]);
                $ArgPays = TextStatic::htmlPropre($data[Db::getParam("pla", "Pays")]);
                $ArgLienSiteWeb = $data[Db::getParam("org", "LienSiteweb")];
                $ArgMail = $data[Db::getParam("org", "Mail")];
                $ArgTypeId = $data[Db::getParam("org", "TypeId")];
                $ArgCommunauteId =  $data[Db::getParam("org", "CommunauteId")];
                $ArgAccesAvion = $data[Db::getParam("org", "AccesAvion")];
                $ArgAccesTrain = $data[Db::getParam("org", "AccesTrain")];
                $ArgAccesVoiture = $data[Db::getParam("org", "AccesVoiture")];
                $ArgMainPhoto =  $data[Db::getParam("org", "Mainphoto")];
                $ArgTel = $data[Db::getParam("org", "Tel")];
                $ArgFax = $data[Db::getParam("org", "Fax")];
                $ArgDateEnregistrement = $data[Db::getParam("org", "AdministrateurId")];
                $ArgLat = $data[DB::getParam("pla","Lat")];
                $ArgLong = $data[DB::getParam("pla","Long")];
                $ArgValidationAdmin = $data[Db::getParam("org","ValidationAdmin")];
                $ArgValidationSuperAdmin = $data[Db::getParam("org","ValidationSuperAdmin")];
                $ArgAdminId = 1;
                $place = $data[Db::getParam("org","PlaceId")];
                $ArgDep = $data[DB::getParam("mde","Nom")];
                $ArgRegion = $data[DB::getParam("mre","Nom")];
                $nbEvent = $data[DB::getParam("vlc", "NbTotal")];
                $nbEventAVenir = $data[DB::getParam("vlc", "NbAVenir")];
                
                
                $lieu = new Lieu();
                $lieu->setAdmin($ArgAdminId);
                $lieu->setAdresse1($ArgAdresse1);
                $lieu->setAdresse2($ArgAdresse2);
                $lieu->setAvion($ArgAccesAvion);
                $lieu->setCommunaute($ArgCommunauteId);
                $lieu->setCp($ArgCp);
                $lieu->setDateEnregistrement($ArgDateEnregistrement);
                $lieu->setDescription($ArgDesc);                        //ok
                $lieu->setFax($ArgFax);
                $lieu->setHebergement($ArgHebergement);                 //ok
                $lieu->setId($ArgId);                                   //ok
                $lieu->setLat($ArgLat);
                $lieu->setLienSiteWeb($ArgLienSiteWeb);
                $lieu->setLong($ArgLong);
                $lieu->setMail($ArgMail);
                $lieu->setMainPhoto($ArgMainPhoto);
                $lieu->setNom($ArgNom);                                 //ok
                $lieu->setPays($ArgPays);
                $lieu->setTel($ArgTel);
                $lieu->setTrain($ArgAccesTrain);
                $lieu->setTypeId($ArgTypeId);
                $lieu->setValidationAdmin($ArgValidationAdmin);
                $lieu->setValidationSuperAdmin($ArgValidationSuperAdmin);
                $lieu->setVille($ArgVille);
                $lieu->setVoiture($ArgAccesVoiture);

                $lieu->setPlace($place);
                $lieu->setRegion($ArgRegion);
                $lieu->setNbEvent($nbEvent);
                $lieu->setNbEventAVenir($nbEventAVenir);
                $lieu->setDepartement($ArgDep);
                
                
                $ArgGalerie = self::recupererListeImagesForLieu($lieu);
                $lieu->setGalerie($ArgGalerie);
                
                
                array_push($tabAllLieu, $lieu);
            }
        return $tabAllLieu;    
    }
    
      /**
    *  Lister les lieux
    */
    public static function listerLieuxFilteredComplete(OrganisateurSearchCriteria $filter, $lieuValideFacultatif=null){
        
       
        $req  = LieuQueryDao::getLieuxFilteredComplete($filter, $lieuValideFacultatif);
        
        
        $tabAllLieu = array();
        
        foreach ($req as $data)
            {    
                $ArgId = $data[Db::getParam("org", "Id")];
                $ArgNom = TextStatic::htmlPropre($data[Db::getParam("org", "Nom")]);
                $ArgDesc = $data[Db::getParam("org", "Description")];
                $ArgHebergement = $data[Db::getParam("org", "Hebergement")];
                $ArgAdresse1 = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse1")]);
                $ArgAdresse2 = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse2")]);
                $ArgCp = TextStatic::htmlPropre($data[Db::getParam("pla", "Cp")]);
                $ArgVille = TextStatic::htmlPropre($data[Db::getParam("pla", "Ville")]);
                $ArgPays = TextStatic::htmlPropre($data[Db::getParam("pla", "Pays")]);
                $ArgLienSiteWeb = $data[Db::getParam("org", "LienSiteweb")];
                $ArgMail = $data[Db::getParam("org", "Mail")];
                $ArgTypeId = $data[Db::getParam("org", "TypeId")];
                $ArgCommunauteId =  $data[Db::getParam("org", "CommunauteId")];
                $ArgAccesAvion = $data[Db::getParam("org", "AccesAvion")];
                $ArgAccesTrain = $data[Db::getParam("org", "AccesTrain")];
                $ArgAccesVoiture = $data[Db::getParam("org", "AccesVoiture")];
                $ArgMainPhoto =  $data[Db::getParam("org", "Mainphoto")];
                $ArgTel = $data[Db::getParam("org", "Tel")];
                $ArgFax = $data[Db::getParam("org", "Fax")];
                $ArgDateEnregistrement = $data[Db::getParam("org", "AdministrateurId")];
                $ArgLat = $data[DB::getParam("pla","Lat")];
                $ArgLong = $data[DB::getParam("pla","Long")];
                $ArgValidationAdmin = $data[Db::getParam("org","ValidationAdmin")];
                $ArgValidationSuperAdmin = $data[Db::getParam("org","ValidationSuperAdmin")];
                $ArgAdminId = $data[Db::getParam("org","AdministrateurId")];
                $place = $data[DB::getParam("pla","Id")];
                $ArgDep = $data[DB::getParam("mde","Nom")];
                $ArgRegion = $data[DB::getParam("mre","Nom")];
                $nbEvent = $data[DB::getParam("vlc", "NbTotal")];
                $nbEventAVenir = $data[DB::getParam("vlc", "NbAVenir")];
               
                $lieu = new Lieu();
                $lieu->setAdmin($ArgAdminId);
                $lieu->setAdresse1($ArgAdresse1);
                $lieu->setAdresse2($ArgAdresse2);
                $lieu->setAvion($ArgAccesAvion);
                $lieu->setCommunaute($ArgCommunauteId);
                $lieu->setCp($ArgCp);
                $lieu->setDateEnregistrement($ArgDateEnregistrement);
                $lieu->setDescription($ArgDesc);                        //ok
                $lieu->setFax($ArgFax);
                $lieu->setHebergement($ArgHebergement);                 //ok
                $lieu->setId($ArgId);                                   //ok
                $lieu->setLat($ArgLat);
                $lieu->setLienSiteWeb($ArgLienSiteWeb);
                $lieu->setLong($ArgLong);
                $lieu->setMail($ArgMail);
                $lieu->setMainPhoto($ArgMainPhoto);
                $lieu->setNom($ArgNom);                                 //ok
                $lieu->setPays($ArgPays);
                $lieu->setTel($ArgTel);
                $lieu->setTrain($ArgAccesTrain);
                $lieu->setTypeId($ArgTypeId);
                $lieu->setValidationAdmin($ArgValidationAdmin);
                $lieu->setValidationSuperAdmin($ArgValidationSuperAdmin);
                $lieu->setVille($ArgVille);
                $lieu->setVoiture($ArgAccesVoiture);
                $lieu->setNbEventAVenir($nbEventAVenir);
                $lieu->setPlace($place);
                $lieu->setRegion($ArgRegion);
                $lieu->setNbEvent($nbEvent);
                $lieu->setDepartement($ArgDep);
//                $ArgGalerie = self::recupererListeImagesForLieu($lieu);
//                $lieu->setGalerie($ArgGalerie);

                array_push($tabAllLieu, $lieu);
            }
        return $tabAllLieu;    
    }
    
     /**
    *  Lister les lieux
    */
    public static function compterLieuxFilter(OrganisateurSearchCriteria $filter, $lieuValideFacultatif=null){
        
       
        $req  = LieuQueryDao::compterLieuxFiltered($filter, $lieuValideFacultatif);
                
        foreach ($req as $data)
            {    
                $nb = $data['nb'];
                
            }
        return $nb;    
    }
    
    /**
    *  Lister les lieux
    */
    public static function listerTousLieux($lieuValide = null){
        
       $req = LieuQueryDao::getAlllieux($lieuValide);
        
        $tabAllLieu = array();
        foreach ($req as $data)
            {    
                
                $ArgId = $data[Db::getParam("org", "Id")];
                $ArgNom = TextStatic::htmlPropre($data[Db::getParam("org", "Nom")]);
                $ArgDesc = $data[Db::getParam("org", "Description")];
                $ArgHebergement = $data[Db::getParam("org", "Hebergement")];
                $ArgAdresse1 = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse1")]);
                $ArgAdresse2 = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse2")]);
                $ArgCp = TextStatic::htmlPropre($data[Db::getParam("pla", "Cp")]);
                $ArgVille = TextStatic::htmlPropre($data[Db::getParam("pla", "Ville")]);
                $ArgPays = TextStatic::htmlPropre($data[Db::getParam("pla", "Pays")]);
                $ArgLienSiteWeb = $data[Db::getParam("org", "LienSiteweb")];
                $ArgMail = $data[Db::getParam("org", "Mail")];
                $ArgTypeId = $data[Db::getParam("org", "TypeId")];
                $ArgCommunauteId =  $data[Db::getParam("org", "CommunauteId")];
                $ArgAccesAvion = $data[Db::getParam("org", "AccesAvion")];
                $ArgAccesTrain = $data[Db::getParam("org", "AccesTrain")];
                $ArgAccesVoiture = $data[Db::getParam("org", "AccesVoiture")];
                $ArgMainPhoto =  $data[Db::getParam("org", "Mainphoto")];
                $ArgTel = $data[Db::getParam("org", "Tel")];
                $ArgFax = $data[Db::getParam("org", "Fax")];
                $ArgDateEnregistrement = $data[Db::getParam("org", "AdministrateurId")];
                $ArgLat = $data[DB::getParam("pla","Lat")];
                $ArgLong = $data[DB::getParam("pla","Long")];
                $ArgValidationAdmin = $data[Db::getParam("org","ValidationAdmin")];
                $ArgValidationSuperAdmin = $data[Db::getParam("org","ValidationSuperAdmin")];
                $ArgAdminId = 1;
//                $ArgGalerie = null;
                $nbEventAVenir = $data[DB::getParam("vlc", "NbAVenir")];
                $place = $data[DB::getParam("pla","Id")];
                $ArgDep = $data[DB::getParam("mde","Nom")];
                $ArgRegion = $data[DB::getParam("mre","Nom")];
                $nbEvent = $data[DB::getParam("vlc", "NbTotal")];
//              
//                $lieu = new Lieu($ArgId, $ArgNom, $ArgAdresse1, $ArgAdresse2, $ArgCp, $ArgVille, $ArgPays, $ArgDesc,
//                        $ArgHebergement, $ArgMainPhoto, $ArgAccesTrain, $ArgAccesVoiture, $ArgAccesAvion, $ArgLienSiteWeb,
//                        $ArgMail, $ArgTel, $ArgFax, $ArgTypeId, $ArgCommunauteId, $ArgAdminId, $ArgGalerie,
//                        $ArgDateEnregistrement,$ArgLat,$ArgLong,$ArgValidationAdmin,$ArgValidationSuperAdmin);
                $lieu = new Lieu();
                $lieu->setAdmin($ArgAdminId);
                $lieu->setAdresse1($ArgAdresse1);
                $lieu->setAdresse2($ArgAdresse2);
                $lieu->setAvion($ArgAccesAvion);
                $lieu->setCommunaute($ArgCommunauteId);
                $lieu->setCp($ArgCp);
                $lieu->setDateEnregistrement($ArgDateEnregistrement);
                $lieu->setDescription($ArgDesc);                        //ok
                $lieu->setFax($ArgFax);
                $lieu->setHebergement($ArgHebergement);                 //ok
                $lieu->setId($ArgId);                                   //ok
                $lieu->setLat($ArgLat);
                $lieu->setLienSiteWeb($ArgLienSiteWeb);
                $lieu->setLong($ArgLong);
                $lieu->setMail($ArgMail);
                $lieu->setMainPhoto($ArgMainPhoto);
                $lieu->setNom($ArgNom);                                 //ok
                $lieu->setPays($ArgPays);
                $lieu->setTel($ArgTel);
                $lieu->setTrain($ArgAccesTrain);
                $lieu->setTypeId($ArgTypeId);
                $lieu->setValidationAdmin($ArgValidationAdmin);
                $lieu->setValidationSuperAdmin($ArgValidationSuperAdmin);
                $lieu->setVille($ArgVille);
                $lieu->setVoiture($ArgAccesVoiture);

                $lieu->setPlace($place);
                $lieu->setRegion($ArgRegion);
                $lieu->setNbEvent($nbEvent);
                $lieu->setNbEventAVenir($nbEventAVenir);
                $lieu->setDepartement($ArgDep);
              
                $ArgGalerie = self::recupererListeImagesForLieu($lieu);
                $lieu->setGalerie($ArgGalerie);

                array_push($tabAllLieu, $lieu);
            }
        return $tabAllLieu;    
    }

    /**
    * 
    * @param unknown_theme $idRetraite
    * @return Lieu
    */
    public static function recupererUnLieu($idLieu, $lieuValideFacultatif = null){
        AppLog::ecrireLog("Dans LieuActionDao l.374", "debug");
        $idLieu = SecurityUtil::securNumParam($idLieu);
        $lieu = null;
        AppLog::ecrireLog("Dans LieuActionDao l.377", "debug");
        $req = LieuQueryDao::getOneLieu($idLieu, $lieuValideFacultatif);
        foreach ($req as $data)
        {
            
            $ArgId                  = $data[Db::getParam("org", "Id")];
            $ArgNom                 = TextStatic::htmlPropre($data[Db::getParam("org", "Nom")]);
            $ArgDesc                = $data[Db::getParam("org", "Description")];
            $ArgHebergement         = $data[Db::getParam("org", "Hebergement")];
            $ArgAdresse1            = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse1")]);
            $ArgAdresse2            = TextStatic::htmlPropre($data[Db::getParam("pla", "Adresse2")]);
            $ArgCp                  = TextStatic::htmlPropre($data[Db::getParam("pla", "Cp")]);
            $ArgVille               = TextStatic::htmlPropre($data[Db::getParam("pla", "Ville")]);
            $ArgPays                = TextStatic::htmlPropre($data[Db::getParam("pla", "Pays")]);
            $ArgLienSiteWeb         = $data[Db::getParam("org", "LienSiteweb")];
            $ArgMail                = $data[Db::getParam("org", "Mail")];
            $ArgTypeId              = $data[Db::getParam("org", "TypeId")];
            $ArgCommunauteId        =  $data[Db::getParam("org", "CommunauteId")];
            $ArgAccesAvion          = $data[Db::getParam("org", "AccesAvion")];
            $ArgAccesTrain          = $data[Db::getParam("org", "AccesTrain")];
            $ArgAccesVoiture        = $data[Db::getParam("org", "AccesVoiture")];
            $ArgMainPhoto           =  $data[Db::getParam("org", "Mainphoto")];
            $ArgTel                 = $data[Db::getParam("org", "Tel")];
            $ArgFax                 = $data[Db::getParam("org", "Fax")];
            $ArgDateEnregistrement  = $data[Db::getParam("org", "AdministrateurId")];
            $ArgLat                 = $data[DB::getParam("pla","Lat")];
            $ArgLong                = $data[DB::getParam("pla","Long")];
            $ArgValidationAdmin     = $data[Db::getParam("org","ValidationAdmin")];
            $ArgValidationSuperAdmin = $data[Db::getParam("org","ValidationSuperAdmin")];
            $ArgAdminId             = $data[Db::getParam("org", "AdministrateurId")];
            
            $place = $data[DB::getParam("pla","Id")];
            $ArgDep = $data[DB::getParam("mde","Nom")];
            $ArgRegion = $data[DB::getParam("mre","Nom")];
            $nbEvent = $data[DB::getParam("vlc", "NbTotal")];
            $nbEventAVenir = $data[DB::getParam("vlc", "NbAVenir")];
//              
//                $lieu = new Lieu($ArgId, $ArgNom, $ArgAdresse1, $ArgAdresse2, $ArgCp, $ArgVille, $ArgPays, $ArgDesc,
//                        $ArgHebergement, $ArgMainPhoto, $ArgAccesTrain, $ArgAccesVoiture, $ArgAccesAvion, $ArgLienSiteWeb,
//                        $ArgMail, $ArgTel, $ArgFax, $ArgTypeId, $ArgCommunauteId, $ArgAdminId, $ArgGalerie,
//                        $ArgDateEnregistrement,$ArgLat,$ArgLong,$ArgValidationAdmin,$ArgValidationSuperAdmin);
            $lieu = new Lieu();
            $lieu->setAdmin($ArgAdminId);
            $lieu->setAdresse1($ArgAdresse1);
            $lieu->setAdresse2($ArgAdresse2);
            $lieu->setAvion($ArgAccesAvion);
            $lieu->setCommunaute($ArgCommunauteId);
            $lieu->setCp($ArgCp);
            $lieu->setDateEnregistrement($ArgDateEnregistrement);
            $lieu->setDescription($ArgDesc);                        //ok
            $lieu->setFax($ArgFax);
            $lieu->setHebergement($ArgHebergement);                 //ok
            $lieu->setId($ArgId);                                   //ok
            $lieu->setLat($ArgLat);
            $lieu->setLienSiteWeb($ArgLienSiteWeb);
            $lieu->setLong($ArgLong);
            $lieu->setMail($ArgMail);
            $lieu->setMainPhoto($ArgMainPhoto);
            $lieu->setNom($ArgNom);                                 //ok
            $lieu->setPays($ArgPays);
            $lieu->setTel($ArgTel);
            $lieu->setTrain($ArgAccesTrain);
            $lieu->setTypeId($ArgTypeId);
            $lieu->setValidationAdmin($ArgValidationAdmin);
            $lieu->setValidationSuperAdmin($ArgValidationSuperAdmin);
            $lieu->setVille($ArgVille);
            $lieu->setVoiture($ArgAccesVoiture);
            $lieu->setLat($ArgLat);
            $lieu->setLong($ArgLong);
            $lieu->setPlace($place);
            $lieu->setRegion($ArgRegion);
            $lieu->setNbEvent($nbEvent);
            $lieu->setDepartement($ArgDep);
            $lieu->setNbEventAVenir($nbEventAVenir);

           
        }
        
        AppLog::ecrireLog("Dans LieuActionDao l.455", "debug");
        return $lieu;
    }

    /**
     * Enregistrer le lieu passé en parametre
     * @param Lieu $lieu
     * @return type 
     */
    public static function enregitrerLieu(Lieu $lieu){
        $booLieu = false;
        //$booPlace = false;
        $msgLieu = "";
        $msgPlace = "";
        $msgFinal = "";
        
//        $req = array(false,null);
        $coord = GeoLocalisation::getLatLongFromAdresse($lieu);
        $lieu->setLat($coord['Lat']);
        $lieu->setLong($coord['Long']);
        $place = GeolocalisationActionDao::enregistrerPlace($lieu);
        
        if($place[0]){
            //$booPlace = true;
            $msgPlace = "";
            
        }else{
            //$booPlace = false;
            $msgPlace .= "Une erreur a eu lieu dans l'enregistrement de l'adresse. Merci de bien vouloir vous connecter pour la mettre à jour.";
        }
        // enregistrement du lieu (si Place KO = Null, si Place OK = idPlace)
        $req = LieuQueryDao::addLieu($lieu, $place[1]);
        
        if($req[0]){
            $booLieu = true;
            $msgLieu .= $lieu->getNom()." a bien été enregistré.";
        }else{
            $booLieu = false;
            $msgLieu = "Une erreur a eu lieu, ".$lieu->getNom()." n'a pas été enregistré.";
            $msgPlace = "";
        }
        
        $msgFinal = $msgLieu."<br/>".$msgPlace;
        $returnedValue = array($booLieu, $msgFinal);
        
        return $returnedValue;
    }

    /**
     * Enregistrer une adresse dans la base des places.
     * @param Lieu $lieu
     * @return type
     */
    public static function enregistrerPlace(Lieu $lieu){
        $req = LieuQueryDao::addPlace($lieu);
        return $req;
    }
    /**
    * 
    * @param Evenement $retraite
    */
    public static function modifierLieu(Lieu $lieu){
        return LieuQueryDao::modifyLieu($lieu);

    }

    /**
    * 
    * @param Evenement $retraite
    */
    public static function effacerLieu($idLieu){
        LieuQueryDao::deleteLieu($idLieu);
    }

 

    
 
    /**
     * Récupère les ids des lieux pour un admin donné
     * @param type $idAmin
     * @return array 
     */
    public static function recupererIdLieuForAdmin($idAdmin){
        
        $req = LieuQueryDao::getIdLieuxForAdmin($idAdmin);
        
        $listIdLieux = array();
        foreach ($req as $data){
            array_push($listIdLieux, $data[Db::getParam("org", "Id")]);
        }
        return $listIdLieux;
    }
    
    /**
     * 
     * @param type $nbLieux 
     */
    public static function recupererLieuxAleatoires($nbLieux){
        $req = LieuQueryDao::getRandomLieux($nbLieux);
        $listIdLieux = array();
        foreach ($req as $data){
            $id = $data[Db::getParam("org", "Id")];
            array_push($listIdLieux, LieuActionDao::recupererUnLieu($id));
        }
        return $listIdLieux;
        
    }
    
    /**
     * Vérifie l'existence d'un lieu
     * @param int $idLieu
     * @return int - nb d'items
     */
    public static function exist($idLieu,$lieuValideFacultatif = null){
        $req = LieuQueryDao::compter($idLieu,$lieuValideFacultatif);
        foreach($req as $data){
            $nb = $data['nb'];
        }
        return $nb;
    }
    
}

?>