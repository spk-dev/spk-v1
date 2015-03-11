<?php


/**
 * 
 * @author bteillard
 *
 */
class LieuAction{
    
    
    /**
     * Return true or false si l'id correspond à un lieu existant.
     * @param type $idLieu
     * @return boolean
     */
    public static function exist($idLieu,$lieuValideFacultatif = null){
        $boo = false;
        if(LieuActionDao::exist($idLieu,$lieuValideFacultatif)>0){
            $boo = true;
        }
        return $boo;
    }
    /**
     * Compte le nb d'événements pour un lieu
     * @param type $idLieu
     * @return int
     */
    public static function compterNbEvenement($idLieu){
        $nb = 0;
        $filter = new EvenementSearchCriteria();
        $filter->setEvenementLieu(array($idLieu));
        $nb = EvenementActionDao::getNombreEvements($filter);
        return $nb;
    }
        
    /**
    *  Affiche les photos de la galerie 
    */
    public static function afficherListeImagesForLieu($Lieu,$checkBoxName){

        $listeImage = LieuActionDao::recupererListeImagesForLieu($Lieu);
        if(sizeof($listeImage)>0){
            $display = "";
            $display .= "<ul style='display:inline; '>";
            foreach ($listeImage as $image) {
                $img = HtmlUtilComponents::imageControl("lieux", $image['img'], 0);
                $display .= "";
                $display .="<li style='list-style-type:none; float:left;'>";
                $display .="<img class='imgItem' src='".$img."'/><br/>";
                $display .= "<input type = 'checkbox' name = '".$checkBoxName."' value = '".$image['id']."' />cocher pour supprimer";
                $display .= "</li>";
            }
            $display .= "</ul>";
        }else{
            $display = "Pas d'images";
        }
        return $display;
    }

    /**
     * Liste tous les lieux
     * @return type
     */
    public static function compterLieuxFiltered(OrganisateurSearchCriteria $lieuFilter,$lieuValideFacultatif=null){
        return LieuActionDao::compterLieuxFilter($lieuFilter, $lieuValideFacultatif);
    } 
    
     /**
     * Liste tous les lieux
     * @return type
     */
    public static function listerLieuxFiltered(OrganisateurSearchCriteria $lieuFilter,$lieuValideFacultatif=null){
        return LieuActionDao::listerLieuxFilter($lieuFilter, $lieuValideFacultatif);
    }   
    
    
    /**
     * Liste tous les lieux
     * @return type
     */
    public static function listerLieuxFilteredComplete(OrganisateurSearchCriteria $lieuFilter,$lieuValideFacultatif=null){
        return LieuActionDao::listerLieuxFilteredComplete($lieuFilter, $lieuValideFacultatif);
    }   
    
    public static function listerLieuxContenantDesRetraites(){
       return LieuActionDao::listeLieuxFiltreRetraite(); 
    }
    
    /**
     * Liste tous les lieux
     * @return type
     */
    public static function listerTousLieux($lieuValide = null){
        return LieuActionDao::listerTousLieux($lieuValide);
    }
    
    /**
     * 
     * @param type $filter
     * @param type $gridNbCol
     * @return string
     */
     public static function afficherGridLieux($filter, $gridNbCol){
           
            $nbCol = array("one","two","three","four","five","six","seven","height","nine","ten","eleven","twelve");
            if(!is_null($gridNbCol)){
                $nbcolToDisplay = $nbCol[$gridNbCol];
            }else{
                $nbcolToDisplay = $nbCol[1];
            }
            
            $display = "<ul class=\"block-grid ".$nbcolToDisplay."-up\"> ";
            $listeLieux = LieuAction::listerLieuxFiltered($filter,true);
           
            foreach ($listeLieux as $lieu) {
                if ($lieu->getValidationAdmin() && $lieu->getValidationSuperAdmin())
                {
                    $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
                    $display .="<li>";
                    $display .="<a href='index.php?page=organisateurDetail&id=".$lieu->getId()."'>";
                    $display .= "<img class='imgCaptionFixed' src='".$img."' title='".$lieu->getNom()."' alt='".$lieu->getNom()."' />";
    //                $display .= $lieu->getNom();
                    $display .="</a>";
                    $display .="</li>";
                }
             }

            $display .= "</ul>";
                        
            return $display;
        }
    
    /**
         * 
         * @param EvenementSearchCriteria $filter
         * @param type $cssId
         * @param type $cssClass
         * @param type $action = 0 (back: lien vers mise à jour) ou 1 (front: liste pour front office)
         * @return string 
         */
    public static function afficherGridLieuxAdmin2($filter, $gridNbCol, $action){
           
            if($action==1){
                $lien = "<a href='".$_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText('MenuAdminLieuLien'); 
            }else if($action==2){
                $lien = "<a href='".$_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText('MenuAdminRetraitesLien2'); 
            }
         
            $nbCol = array("one","two","three","four","five","six","seven","height","nine","ten","eleven","twelve");
            if(!is_null($gridNbCol)){
                $nbcolToDisplay = $nbCol[$gridNbCol];
            }else{
                $nbcolToDisplay = $nbCol[1];
            }
            
            $display = "<ul class=\"block-grid ".$nbcolToDisplay."-up\"> ";
             $listeLieux = self::listerLieuxFiltered($filter, true);
             $typeBar = "secondary";
             
             
            foreach ($listeLieux as $lieu){
//                $lieu = new Lieu();
                $pourcentage = OrganisateurAnalyse::niveauPourcentage($lieu);
                if($pourcentage<=0.5){
                    $typeBar = "alert";
                }else{
                    $typeBar = "success";
                }
                $pourcentage = $pourcentage * 100;
                $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
                $display .="<li>";
                
                $display .=$lien."&idLieu=".$lieu->getId()."'>";
                $display .= "<img class='' src='".$img."' title='".$lieu->getNom()."' alt='".$lieu->getNom()."' />";//                $display .= $lieu->getNom();
                $display .= $lieu->getNom();
                $display .="</a>";
                $display .="<br/>";
                $display .= LieuAction::compterNbEvenement($lieu->getId())." evenement(s)";
                if(OrganisateurAnalyse::verificationNiveauMinimum($lieu)){
                    $display .= "<br/> Niveau min : OK";
                }else{
                    $display .= "<br/> Niveau min : KO";
                }
                $display .="<br/>";
                $display .= $pourcentage;
                $display .="%";
                $display .="<div class=\"progress ".$typeBar." twelve\"><span class=\"meter\" style=\"width:".$pourcentage."%\"></span></div>";
             $display .="</li>";

                }
             $display .= "</ul>";
                        
            return $display;
        }    
        
        
        
        
    /**
         * 
         * @param EvenementSearchCriteria $filter
         * @param type $cssId
         * @param type $cssClass
         * @param type $action = 0 (back: lien vers mise à jour) ou 1 (front: liste pour front office)
         * @return string 
         */
    public static function afficherGridLieuxAdmin($filter, $gridNbCol, $action){
           
            if($action==1){
                $lien = "<a href='".$_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText('MenuAdminLieuLien'); 
            }else if($action==2){
                $lien = "<a href='".$_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText('MenuAdminRetraitesLien2'); 
            }
         
            $listeLieux = self::listerLieuxFiltered($filter, true);
            
            $htmlCode ="<table class=\"twelve\" id=''>";
            $htmlCode .="<thead>";
            $htmlCode .="<tr>";
            $htmlCode .="<th></th>";
            $htmlCode .="<th>Nom</th>";
            $htmlCode .="<th>Evénements à venir</th>";
            $htmlCode .="<th>Evénements total</th>";

            $htmlCode .="</tr>";
            $htmlCode .="</thead><tbody>";
            
            
            foreach ($listeLieux as $lieu) {

                
                $htmlCode .="<tr>";
                $htmlCode .="<td>".$lien."&idLieu=".$lieu->getId()."'><img class='twelve columns' src='".HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0)."'/></a></td>";
                $htmlCode .="<td>".$lien."&idLieu=".$lieu->getId()."'>".$lieu->getNom()."</a></td>";
                $htmlCode .="<td>".$lien."&idLieu=".$lieu->getId()."'>".$lieu->getNbEventAVenir()."</a></td>";
                $htmlCode .="<td>".$lien."&idLieu=".$lieu->getId()."'>".$lieu->getNbEvent()."</a></td>";
                
                $htmlCode .="<td></tr>";
                
            }
            $htmlCode .="</tbody></table>";
            
            
            return $htmlCode;
            
            
        }
    
    /**
    *  Affiche toutes les retraites 
    */
    public static function afficherListesLieux($cssId, $cssClass){
        
        $listeLieux = self::listerTousLieux();

        
        if(count($listeLieux)<1){
               $display .= "<div class=\"itemListe twelve columns\">";
               $display .="<div class='itemListe twelve columns noresult'>";
               $display .= "Désolé, il n'y a pas encore d'événement correspondant à votre recherche.";
               $display .= "<br/><br/>";
               $display .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"."'>Cliquer ici pour signaler un dysfonctionnement ou suggérer un événement.</a>";
               $display .="</div></div>";
        }else{
        
        $display = "<div id=\"".$cssId."\" class=\"twelve columns ".$cssClass."\">";

        foreach ($listeLieux as $lieu) {
            
            $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
            
            
            $staticMap = HtmlUtilComponents::staticMapImageControl($lieu,60,50,7);
            
            $display .="<div class=\"itemListe twelve columns\">";
            $display .= "<a href='index.php?page=organisateurDetail&id=".$lieu->getId()."'>";
            $display .="    <h6 class=\"blocTitle\">".$lieu->getNom()."</h6>
                            </a>

                            <div class=\"three columns\">
                                <img src=\"".$staticMap."\"/>

                            </div>
                            <div class=\"height columns\">

                                <img src='".$img."' title='".$lieu->getNom()."' alt='".$lieu->getNom()."' class='right' />

                            </div>
                            <div class=\"twelve columns\">
                                <p class=\"JustifyText resumeListe\">".substr($lieu->getDescription(),0,100)."...</p>
                            </div>

                        </div>";
                
            
            
            
        }
        $display .= "</div>";
        }
        return $display;
        
        
        
        
        
    }    
    /**
    *  Affiche toutes les retraites 
    */
    public static function afficherListesLieux2($cssId, $cssClass){
        
        $listeLieux = self::listerTousLieux();

        
        if(count($listeLieux)<1){
               $display .= "<div class=\"itemListe twelve columns\">";
               $display .="<div class='itemListe twelve columns noresult'>";
               $display .= "Désolé, il n'y a pas encore d'événement correspondant à votre recherche.";
               $display .= "<br/><br/>";
               $display .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"."'>Cliquer ici pour signaler un dysfonctionnement ou suggérer un événement.</a>";
               $display .="</div></div>";
        }else{
        
        $display = "<div class=\"twelve columns\">";

        foreach ($listeLieux as $lieu) {
            
            $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
            
            
            $staticMap = HtmlUtilComponents::staticMapImageControl($lieu,60,50,7);
            
            $display .="<div class=\"itemListe six columns\">";
            $display .= "<a href='index.php?page=organisateurDetail&id=".$lieu->getId()."'>";
            $display .="    <h6 class=\"blocTitle\">".$lieu->getNom()."</h6>
                            </a>

                            <div class=\"three columns\">
                                <img src=\"".$staticMap."\"/>

                            </div>
                            <div class=\"height columns\">

                                <img src='".$img."' title='".$lieu->getNom()."' alt='".$lieu->getNom()."' class='right' />

                            </div>
                            <div class=\"twelve columns\">
                                <p class=\"JustifyText resumeListe\">".TextStatic::ResumeText($lieu->getDescription(),100)."</p>
                            </div>

                        </div>";
                
            
            
            
        }
        $display .= "</div>";
        }
        return $display;
        
        
        
        
        
    }

    /**
    * Affiche la galerie en haut d'une fiche détail
    * @param Lieu $lieuToDisplay
    * @return string 
    */
    public static function recupererGalerieLieu(Lieu $lieuToDisplay){

        $tabImage = array();
        if(sizeof($lieuToDisplay->getGalerie())>0){
            foreach ($lieuToDisplay->getGalerie() as $img) {
                array_push($tabImage, $img );
            }
            
        }   
        array_push($tabImage, $lieuToDisplay->getMainPhoto());
        
    return $tabImage;
    }

    /**
    * Affiche le bloc Contact web
    * @param Lieu $lieu 
    */
    public static function afficherContactWeb(Lieu $lieu){

        $urlSite = $lieu->getLienSiteWeb();

        if(substr($urlSite, 0, 7)!="http://"){
            $urlSite .= "http://".$urlSite;
        }

        $display = "";
        $display .= "<a href=\"mailto:".$lieu->getMail()."?subject=Mail envoy&eacute; depuis www.spibook.com\" target=\"_blank\">".$lieu->getMail()."</a>";
        $display .="<br/>";
        $display .= "<a href='".$urlSite."' target='_blank'>".$lieu->getLienSiteWeb()."</a>";

        return $display;
    }

    /**
    * Affiche le bloc Contact postal
    * @param Lieu $lieu 
    */
    public static function afficherContactPostale(Lieu $lieu){
        $adr1 = $lieu->getAdresse1();
        $adr2 = $lieu->getAdresse2();
        $cp = $lieu->getCp();
        $ville = $lieu->getVille();
        $pays = $lieu->getPays();
        $display ="";

        if($adr1!=""){$display .= $adr1."<br/>";}
        if($adr2!=""){$display .= $adr2."<br/>";}
        if($cp!=""){$display .=$cp."<br/>";}
        if($ville!=""){$display .= $ville."<br/>";}
        if($pays!=""){$display .=$pays."<br/>";}

        return $display;
    }

    /**
    * Affiche le bloc des acces
    * @param Lieu $lieu
    * @return string 
    */
    public static function afficherAcces(Lieu $lieu){

        $display ="<h3>Comment s'y rendre</h3><br/>";
        $voiture = $lieu->getVoiture();
        $avion = $lieu->getAvion();
        $train = $lieu->getTrain();

        if($voiture!=""){
            $display .= "En voiture<br/>";
            $display .= $voiture;
        }
        if($train!=""){
            $display .= "En train<br/>";
            $display .= $train;
        }
        if($avion!=""){
            $display .= "En avion<br/>";
            $display .= $avion;
        }            
        return $display;
    }

    /**
     * Modification d'un lieu
     * @param type $lieu
     * @param type $org
     * @return type
     */
    public static function modifierLieu($lieu,$org){

        
        $lieu->setNom($org['nom']);
//        $lieu->setAdresse1($org['adresse1']);
//        $lieu->setAdresse2($org['adresse2']);
//        $lieu->setCp($org['cp']);
//        $lieu->setVille($org['ville']);
//        $lieu->setPays($org['pays']);
        $lieu->setDescription($org['description']);
        $lieu->setHebergement($org['hebergement']);
        $lieu->setMail($org['mail']);
        $lieu->setTel($org['tel']);
        $lieu->setFax($org['fax']);
        $lieu->setLienSiteWeb($org['site']);
        $lieu->setTypeId($org['type']);
        $lieu->setCommunaute($org['communaute']);
        $lieu->setVoiture($org['voiture']);
        $lieu->setTrain($org['train']);
        $lieu->setAvion($org['avion']);
        
        AppLog::ecrireLog("Dans lieuaction - modifier lieu : [".$org['validationAdmin'].']', "debug");
        
//        $lieu->setValidationAdmin($org['validationAdmin']);
//        $lieu->setLat($org['lat']);
//        $lieu->setLong($org['long']);
        
        
        if($_FILES['mainPhoto']['name']!=""){
            
               $extension = strrchr($_FILES['mainPhoto']['name'], '.');
                                    AppLog::ecrireLog("Dans LieuAction::ModifierLieu", "debug");
                                    AppLog::ecrireLog("extension : [".$extension."]", "debug");
               
//                $photo = "spk-".time().imageTreatment::renameImage(substr($lieu->getNom(), 0, 6)).$extension;
                $photo = "spibook-".$lieu->getId()."-".time()."-".uniqid().$extension;
               
               
                                    AppLog::ecrireLog("Photo : [".$photo."]", "debug");
               $lieu->setMainPhoto($photo);
                                    AppLog::ecrireLog("PASSE APRES SETMAINPHOTO DANS LIEU ACTION", "debug");
//               $context,$fileFieldName,$nomDuFichier,$prefixMiniature,$dossierPrincipal, $dossierMiniature,$dossierOriginal
               $rootImg = $_ENV['properties']['Images']['imgPathRelative'];
               $prefixMiniature = $_ENV['properties']['Images']['imgPathThumb'];
               $dossierPrincipal = $rootImg.$_ENV['properties']['Images']['lieux'];
               $prefixOriginal = $_ENV['properties']['Images']['imgPathOriginal'];
               $dossierOriginal = $dossierPrincipal.$prefixOriginal."/";
               $dossierMiniature = $dossierPrincipal.$prefixMiniature."/";
                                    AppLog::ecrireLog("PASSE APRES DECLARATION DANS LIEU ACTION", "debug");
               imageTreatment::imageManage("lieu", 'mainPhoto', $photo, $prefixMiniature, $dossierPrincipal, $dossierMiniature, $dossierOriginal);
//               imageTreatment::imageManage("lieu", 'mainPhoto', $photo, $prefixMiniature, $dossierPrincipal, $_ENV['properties']['Images']['lieux'].$_ENV['properties']['Images']['imgPathThumb']."/", $_ENV['properties']['Images']['lieux'].$_ENV['properties']['Images']['imgPathOriginal']."/");
                                    AppLog::ecrireLog("PASSE APRES IMAGETREATMENT DANS LIEU ACTION", "debug");
        }

        return LieuActionDao::modifierLieu($lieu);
    }

    /**
     * Récupérer un lieu en fonction de son id.
     * @param type $idLieu
     * @return type 
     */
    public static function recupererUnLieu($idLieu, $lieuValideFacultatif = null){
        return LieuActionDao::recupererUnLieu($idLieu, $lieuValideFacultatif);
    }

    /**
     * Afficher le diaporama
     * @param type $nbLieux
     * @return array
     */
    public static function afficherDiaporamaLieu($nbLieux){

        $listeLieu = LieuActionDao::recupererLieuxAleatoires($nbLieux);
        $listeImg = array();
        $listeCaption = array();
        $i=1;
        foreach($listeLieu as $lieu){    
            $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 1);
              
            array_push($listeImg,"<img src=\"".$img."\" data-caption=\"#captionId".$i."\"/>");
            array_push($listeCaption,"<span class=\"orbit-caption\" id=\"captionId".$i."\"><a href=\"index.php?page=organisateurDetail&id=".$lieu->getId()."\"><h5 class='titreDiaporama'>".$lieu->getNom()."</h5></a></span>");
            $i++;
        }
        
        $display ="<div id=\"slider_principal\">";
        foreach ($listeImg as $value) {
            $display .= $value;
        }
        $display .= "</div>";
        foreach($listeCaption as $caption){
            $display .= $caption;
        }
        
        return $display;
    }
    
    /**
     * Afficher le texte du "capty" dans la page organisateur
     * @param type $idOrga
     * @return string
     */
    public static function captyForOrganisateur($idOrga,$nbEventTotal=null,$nbEventAVenir=null){
        $html = "<br/>";
        $html .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&idOrga=".$idOrga."'>".TextStatic::getText("ConsulterEvenements");
        if(!is_null($nbEventAVenir)){
            $html .= "<br/>";
            $html .= $nbEventAVenir." événements à venir";
        }
        if(!is_null($nbEventTotal)){
            $html .= "<br/>";
            $html .= $nbEventTotal." événements publiés";
        }
        $html .= "</a>";
        $html .= "<br/>";
        $html .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienLieuDetail")."&id=".$idOrga."'>".TextStatic::getText("ConsulterLaFiche")."</a>";
        $html .= "<br/>";
        
        
        
        return $html;
    }
    
    /**
     * Créer la popup à afficher sur la map
     * @param Lieu $lieu
     * @return string
     */   
    public static function popupformap(Lieu $lieu){
        $html = "";
        $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
        $html .= "<div class=\"\>";
            $html .="<img class=\"twelve columns\" src=\"".$img."\">";
            $html .= "<p class\"titreOrganisateur\">".$lieu->getNom()."</p>";
            $html .= "<a href=\"".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&idOrga=".$lieu->getId()."\">Voir les événements</a>";

        
        $html .= "</div>";
        return $html;
    }

    /**
     * Enregistre une nouvelle place et l'associe à l'organisateur
     * @param Lieu $lieu
     */
    public static function updatePlace(Lieu $lieu,$org){
        
        $lieu->setAdresse1($org['adresse1']);        
        $lieu->setAdresse2($org['adresse2']);        
        $lieu->setCp($org['cp']);          
        $lieu->setVille($org['ville']);           
        $lieu->setPays($org['pays']);
        $coord = GeoLocalisation::getLatLongFromAdresse($lieu);

        $lieu->setLat($coord['Lat']);
        $lieu->setLong($coord['Long']);
        $place = GeolocalisationActionDao::enregistrerPlace($lieu);
        if($place[0]){
            
            $result = LieuActionDao::updateOrganisateurPlace($lieu->getId(), $place[1]);
            AppLog::ecrireLog("la place ".$lieu->getVille()."a été enregistrée", "debug");
           
        }else{
            $result = false;
            AppLog::ecrireLog("la place ".$lieu->getVille()."n'a pas été enregistrée", "debug");
        }
        return $result;
    }
    
    /**
     * Active le lieu
     * @param type $idLieu
     * @param type $booActivation
     * @return type
     */
    public static function activate($idLieu,$booActivation){
        
        $result = false;
        if($booActivation==0 || $booActivation==1){
            $result = LieuActionDao::activate($idLieu,$booActivation);
        }else{
            AppLog::ecrireLog("ATTENTION LE BOOLEAN DE VALIDATION N'est pas un boo", "debug");    
        }
        return $result;
        
    }
    
    /**
     * Active le lieu
     * @param type $idLieu
     * @param type $booActivation
     * @return type
     */
    public static function activateSuperAdmin($idLieu,$booActivation){
        AppLog::ecrireLog("Rentre dans LieuAction.class - l 656", "debug");
        $result = false;
        if($booActivation==0 || $booActivation==1){
            $result = LieuActionDao::activateSuperAdmin($idLieu,$booActivation);
        }else{
            AppLog::ecrireLog("ATTENTION LE BOOLEAN DE VALIDATION N'est pas un boo", "debug");    
        }
        return $result;
        
    }
    
    
    
    public static function ajouterLieu(Lieu $lieu){
        return LieuActionDao::enregitrerLieu($lieu);
    }
    
    public static function listerLieuPourAjax($text){
        $answer = array();
        $filter = new OrganisateurSearchCriteria();
        
        if(is_numeric($text)){
            AppLog::ecrireLog("ENTIER :  [".$text."]", 'debug');
            $filter->setOrganisateurDepartement(array($text));
        }else{
            AppLog::ecrireLog("PAS ENTIER :  [".$text."]", 'debug');
            $filter->setOrganisateurMotsCles($text);
        }
        
        AppLog::ecrireLog("FILTER SUR AJAX : [".$filter->getCondition()."]", "debug");
        
        $tab = LieuActionDao::listerLieuxFilter($filter, false);
        
//         $tab = IntervenantActionDao::searchIntervenant($text);
          
         
        if(count($tab)==0){
            $answer[] = array("id"=>"0","text"=>"No Results Found..");
        }else{
            foreach ($tab as $value) {
                AppLog::ecrireLog("id = ".$value->getId()." , text = ".$value->getNom(), "debug");
                $answer[] = array("id"=>$value->getId(),"text"=>$value->getNom());
            }
        }
        return $answer;
        
        
        
    }
}
