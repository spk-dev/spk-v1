<?php

class IntervenantActionDao{
    
    /**
     * Recherche un ou plusieurs intervenants en fonction des mots clés saisis
     * Utilisé pour les recherche AJAX
     * @param type $text
     * @return array
     */
    public static function searchIntervenant($text){
        $req = IntervenantQueryDao::searchIntervenant($text);
        $arr = array();
        foreach ($req as $data) {
            $tab['id'] = $data[Db::getParam("int","Id")];
            $tab['nom'] = $data[Db::getParam("int","Prenom")]." ".$data[Db::getParam("int","Nom")];
//            $tab['nom'] = $data[Db::getParam("int","Nom")];
            array_push($arr,$tab);   
        }
        return $arr;
        
    }
    /**
     * Récupérer les intervenants pour une retraite donnée
     * @param type $idRetraite
     * @return array 
     */
    public static function recupererIntervenantsForRetraite($idRetraite){

    $req = IntervenantQueryDao::getIntervenantsForRetraite($idRetraite);
    $tabIntervenant = array();

    foreach ($req as $data){

        $Argintervenantid           =   $data[Db::getParam("int","Id")];
        $Argintervenantnom          =   $data[Db::getParam("int","Nom")];
        $Argintervenantphoto        =   $data[Db::getParam("int","Photo")];
        $Argintervenantdescription  =   $data[Db::getParam("int","Description")];
        $Argintervenantprenom       =   $data[Db::getParam("int","Prenom")];
        $Argintervenantmail         =   $data[Db::getParam("int","Mail")];
        $Argintervenantgenre        =   $data[Db::getParam("int","Genre")];
        $ArgIntervenanttitre        =   $data[Db::getParam("int","Titre")];

        
        $intervenant = new Intervenant($Argintervenantid,$Argintervenantnom,$Argintervenantphoto,$Argintervenantdescription,$Argintervenantprenom,$Argintervenantmail,$Argintervenantgenre,$ArgIntervenanttitre);

        array_push($tabIntervenant, $intervenant);

    }
    return $tabIntervenant;
}

    /**
        * Récupérer une liste d'ID retraites en fonction des IDs intervenants
        * @param type $idIntervenant
        * @return array 
        */
    public static function recupererRetraitesIntervenant($idIntervenant){
        $req = IntervenantQueryDao::getRetraitesForIntervenants($idIntervenant);
        $tabIdRetraiteInterv = array();
        foreach ($req as $data){
            array_push($tabIdRetraiteInterv, $data[Db::getParam("ire","RetraiteId")]);
        }
        return $tabIdRetraiteInterv;
    }

    /**
        * Liste des intervenants déjà associés à une ou plusieurs retraites
        * @return array 
        */
    public static function listerIntervenantsAttachedToRetraites(){
        
        $req = IntervenantQueryDao::getIntervenantsAttachedToRetraite();
        $tabListeIntervenants = array();

        
        foreach ($req as $data){
 
            $Argintervenantid           =   $data[Db::getParam("int","Id")];
            $Argintervenantnom          =   $data[Db::getParam("int","Nom")];
            $Argintervenantphoto        =   $data[Db::getParam("int","Photo")];
            $Argintervenantdescription  =   $data[Db::getParam("int","Description")];
            $Argintervenantprenom       =   $data[Db::getParam("int","Prenom")];
            $Argintervenantmail         =   $data[Db::getParam("int","Mail")];
            $Argintervenantgenre        =   $data[Db::getParam("int","Genre")];
            $ArgIntervenanttitre        =   $data[Db::getParam("int","Titre")];

            $intervenant = new Intervenant($Argintervenantid,$Argintervenantnom,$Argintervenantphoto,$Argintervenantdescription,$Argintervenantprenom,$Argintervenantmail,$Argintervenantgenre,$ArgIntervenanttitre);
            array_push($tabListeIntervenants, $intervenant);
        }

        return $tabListeIntervenants;
    }

   
    /**
    * Liste tous les intervants en renvoyant ID, PRENOM , NOM
    * @return array 
    */
    public static function listerIntervenants(){
        
        $req = IntervenantQueryDao::getAllIntervenants();
        $tabIntervenants = array();
        
        foreach($req as $data){ 
            $Argintervenantid               =   $data[Db::getParam("int","Id")];
            $Argintervenantnom              =   $data[Db::getParam("int","Nom")];
            $Argintervenantphoto            =   $data[Db::getParam("int","Photo")];
            $Argintervenantdescription      =   $data[Db::getParam("int","Description")];
            $Argintervenantprenom           =   $data[Db::getParam("int","Prenom")];
            $Argintervenantmail             =   $data[Db::getParam("int","Mail")];
            $Argintervenantgenre            =   $data[Db::getParam("int","Genre")];
            $ArgIntervenanttitre            =   $data[Db::getParam("int","Titre")];

            $intervenant = new Intervenant($Argintervenantid,$Argintervenantnom,$Argintervenantphoto,$Argintervenantdescription,$Argintervenantprenom,$Argintervenantmail,$Argintervenantgenre,$ArgIntervenanttitre);

            array_push($tabIntervenants, $intervenant);
        }
        return $tabIntervenants;   
    }      
       
    /**
        * Liste tous les intervenants présents dans les retraites listées
        * @param type $tabRetraites 
        */
    public static function listerIntervenantsFromSelectedRetraites($tabRetraites){

        $i=0;
        $nbRetraites = sizeof($tabRetraites);
        $listeRetraite ="";
        $tabIntervenants = array();


        while($i<$nbRetraites){
            $listeRetraite .= $tabRetraites[$i];
            if($i<$nbRetraites-1){
                $listeRetraite .=",";
            }
            $i++;
        }
       
        $req =  IntervenantQueryDao::listeIntervenantFromRetraite($listeRetraite);

        
        foreach($req as $data){    
            
            $Argintervenantid=$data[Db::getParam("int","Id")];
            $Argintervenantnom=$data[Db::getParam("int","Nom")];
            $Argintervenantphoto=$data[Db::getParam("int","Photo")];
            $Argintervenantdescription=$data[Db::getParam("int","Description")];
            $Argintervenantprenom=$data[Db::getParam("int", "Prenom")];
            $Argintervenantmail=$data[Db::getParam("int", "Mail")];
            $Argintervenantgenre=$data[Db::getParam("int", "Genre")];
            $ArgIntervenanttitre=$data[Db::getParam("int", "Titre")];

            $intervenant = new Intervenant($Argintervenantid,$Argintervenantnom,$Argintervenantphoto,$Argintervenantdescription,$Argintervenantprenom,$Argintervenantmail,$Argintervenantgenre,$ArgIntervenanttitre);

            array_push($tabIntervenants, $intervenant);
        }
        return $tabIntervenants; 
    }

    /**
        * Instancie 1 intervenant en fonction de l'ID passé en param et renvoi l'objet
        * @param type $idIntervenant 
        */
    public static function recupererIntervenant($idIntervenant){
        $req = IntervenantQueryDao::getOneIntervenant($idIntervenant);

        foreach ($req as $data){
            $Argintervenantid = $data[Db::getParam("int", "Id")];
            $Argintervenantnom = $data[Db::getParam("int", "Nom")];
            $Argintervenantphoto = $data[Db::getParam("int", "Photo")];
            $Argintervenantdescription = $data[Db::getParam("int", "Description")];
            $Argintervenantprenom = $data[Db::getParam("int", "Prenom")];
            $Argintervenantmail = $data[Db::getParam("int", "Mail")];
            $Argintervenantgenre = $data[Db::getParam("int", "Genre")];
            $ArgIntervenanttitre = $data[Db::getParam("int", "Titre")];

            $intervenant = new Intervenant($Argintervenantid, $Argintervenantnom, $Argintervenantphoto, $Argintervenantdescription, $Argintervenantprenom, $Argintervenantmail, $Argintervenantgenre, $ArgIntervenanttitre);

        }
        return $intervenant;
    }
    
    
    public static function ajouterIntervenant(Intervenant $intervenant, $idAdmin){
        
        return IntervenantQueryDao::addIntervenant($intervenant, $idAdmin);
        
    }
    
    /**
     * Associe un ou plusieurs intervenants à une retraite
     * @param type $idRetraite
     * @param type $idIntervenant
     * @return boolean
     */
    public static function associerIntervenantRetraite($idRetraite,$arrIdIntervenants){
        $boo = false;
        foreach ($arrIdIntervenants as $idIntervenant) {
            $boo = IntervenantQueryDao::associateIntervenantRetraite($idRetraite, $idIntervenant);
        
        }
        return $boo[0];
        
    }
    
    /**
     * Supprime les correspondances entre retraite et intervenant.
     * @param type $idRetraite
     * @param type $idIntervenant
     */
    public static function effacerAssociationIntervenantRetraite($idRetraite,$idIntervenant){
        IntervenantQueryDao::deleteAssociationIntervenantRetraite($idRetraite, $idIntervenant);
    }
   
}
?>