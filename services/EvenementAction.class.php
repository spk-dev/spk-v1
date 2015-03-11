<?php

/**
 * 
 * @author bteillard
 *
 */
class EvenementAction{

        
        /**
         * Renvoi la popup a afficher sur la map.
         * @param Evenement $evenement
         * @return string
         */
        public static function evenementPopUpOnMap(Evenement $evenement){
            $str = "";
            $str .="<br/>";
            $str .="<a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>";
            $str .= $evenement->getNom();
            $str .="</a>";
            $str .="<br/>";
            $str .="du ".$evenement->getDateDebutFormated();
             $str .="<br/>";
             $str .="du ".$evenement->getDateFinFormated();
            $str .="<br/>";
            
            return $str;
        }
        
        /**
         * Teste l'existence d'un événement
         * @param type $idEvent
         * @return boolean
         */
        public static function exist($idEvent){
            $filter = new EvenementSearchCriteria();
            $filter->setEvenementInclue(array($idEvent));
            if(EvenementActionDao::getNombreEvements($filter)>0){
                $boo = true;
            }
            return $boo;
        }
        
        
         public static function compterNbEvenements(EvenementSearchCriteria $filter){
             return EvenementActionDao::getNombreEvements($filter);
          }
    
    
        public static function getListeEvenements(EvenementSearchCriteria $filter){
              return EvenementActionDao::listerTousEvenements($filter,false);
          }
       
          
        public static function getListeEvenementsPourMap(EvenementSearchCriteria $filter){
            return EvenementActionDao::ListerTousEvenementsPourMap($filter, false);
        }
          
       /**
        * Affiche le tableau des retraites pour mises à jour
        * @param EvenementSearchCriteria $filter
        * @param type $cssId
        * @param type $cssClass
        * @param type $action
        * @return type 
        */
        public static function afficherTableEvenementsSynthese(EvenementSearchCriteria $filter, $tableCssId,$lieuValideFacultatif = null){
            
            
            
            $listeEvenements = EvenementActionDao::listerTousEvenements($filter,$lieuValideFacultatif);
            if(count($listeEvenements)>0){
            // TITLE HEADER
            $htmlCode ="<table class='twelve' id=\"$tableCssId\">";
            $htmlCode .="<thead>";
            $htmlCode .="<tr>";
            $htmlCode .="<th>Organisateur</th>";            
            $htmlCode .="<th>Nom</th>";
            $htmlCode .="<th>Dates</th>";
            $htmlCode .="<th>Action</th>";
            $htmlCode .="</tr>";
            $htmlCode .="</thead><tbody>";
            // FIN TITLE HEADER
            $i=0;
            foreach ($listeEvenements as $evenement) {
                $deb = new DateTime($evenement->getDateDebut());
                $fin = new DateTime($evenement->getDateFin());

                $htmlCode .="<tr>";
                $htmlCode .="<td>".LieuAction::recupererUnLieu($evenement->getLieu(),true)->getNom()."</td>";
                $htmlCode .="<td>".$evenement->getNom()."</td>";
                $htmlCode .="<td>".$deb->format('d/m/Y')."<br/>".$fin->format('d/m/Y')."</td>";
                
                $htmlCode .="<td><dl>";
                $htmlCode .="<a href=".$_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesLien")."&action=modif&idEvent=".$evenement->getId()."><dd>Modifier</dd></a>";
//                $htmlCode .="<a href=".$_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesLien")."&supprRetraite=".$evenement->getId()."><dd>Supprimer</dd></a>";
                $htmlCode .="</dl></td></tr>";
                $i++;
            }
            $htmlCode .="</tbody></table>";
            }else{
                $htmlCode = "Pas d'événement.";
            }
            
            return $htmlCode;
        }        
          
          
       /**
        * Affiche le tableau des retraites pour mises à jour
        * @param EvenementSearchCriteria $filter
        * @param type $cssId
        * @param type $cssClass
        * @param type $action
        * @return type 
        */
        public static function afficherTableEvenementAdministration(EvenementSearchCriteria $filter, $tableCssId,$lieuValideFacultatif = null){
            
            
            
            $listeEvenements = EvenementActionDao::listerTousEvenements($filter,$lieuValideFacultatif);
            
            // TITLE HEADER
            $htmlCode ="<table class=\"twelve\" id=\"$tableCssId\">";
            $htmlCode .="<thead>";
            $htmlCode .="<tr>";
            $htmlCode .="<th>TITRE</th>";
            $htmlCode .="<th>Date Debut</th>";
            $htmlCode .="<th>Date fin</th>";
            $htmlCode .="<th>Description</th>";
            $htmlCode .="<th>Action</th>";
            $htmlCode .="</tr>";
            $htmlCode .="</thead><tbody>";
            // FIN TITLE HEADER
            $i=0;
            foreach ($listeEvenements as $evenement) {
                
                $htmlCode .="<tr>";
                $htmlCode .="<td>".$evenement->getNom()."</td>";
                $htmlCode .="<td>".$evenement->getDateDebut()."</td>";
                $htmlCode .="<td>".$evenement->getDateFin()."</td>";
                $htmlCode .="<td>".TextStatic::ResumeText($evenement->getDescription(),50)."</td>";
                
                $htmlCode .="<td><dl>";
                $htmlCode .="<a href=".$_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesLien2")."&action=modif&idEvent=".$evenement->getId()."><dd>Modifier</dd></a>";
                
                $htmlCode .="</dl></td></tr>";
                $i++;
            }
            $htmlCode .="</tbody></table>";
            
            return $htmlCode;
        }     
        
        /**
         * Affiche la barre de pagination
         * @param type $nbPages
         * @param type $currentPage
         */
        public static function afficherPagination($nbPages,$currentPage){
            $html="<div>";
            for($i=1;$i<=$nbPages;$i++){
                $bold = "";
                $ebold = "";
                if($i==$currentPage){
                    $bold = "<b>";
                    $ebold = "</b>";
                }
                $html .= $bold."<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&numpage=".$i."'>".$i."</a>|".$ebold;
                
            }
            $html .="</div>";
            return $html;
            
        }
        
        /**
         * 
         * @param EvenementSearchCriteria $filter
         * @param type $cssId
         * @param type $cssClass
         * @param type $action = 0 (back: lien vers mise à jour) ou 1 (front: liste pour front office)
         * @return string 
         */
        public static function afficherListesRetraites(EvenementSearchCriteria $filter, $listeType, $gridNbCol,$idType){
            
            if(is_null($filter)){
                $filter = new EvenementSearchCriteria();
            }
            $nbItems = EvenementActionDao::getNombreEvements($filter);
            
            $start = 0;
            $nbItemByPage = $_ENV['properties']['Pagination']['evenements'];
            $numPage = 1;
            if(isset($_GET['numpage'])){
                $numPage = $_GET['numpage'];
                $start = ($nbItemByPage*$numPage)-$nbItemByPage;
                
            }
            $filter->setEvenementLimit($start, $nbItemByPage);
            $listeEvenements = EvenementActionDao::listerTousEvenements($filter,false);
            
            
            
            $nbPages = ceil($nbItems/$nbItemByPage);
            
            
            
            
            $display = "";
            if(!is_null($idType)){
                $display .= "<h6>".TypeEvenementAction::recupererUnType($idType)->getLibelle()."</h6>";
                if(!is_null($nbItems)){
                    $display .= "<a>Voir les ".$nbItems." autres</a>";
                }
            }
            
            
            
            
            
            $valueLongListe = 1;
            $valueGridListe = 0 ;
            $nbCol = array("one","two","three","four","five","six","seven","height","nine","ten","eleven","twelve");
            if(!is_null($gridNbCol)){
                $nbcolToDisplay = $nbCol[$gridNbCol];
            }else{
                $nbcolToDisplay = $nbCol[1];
            }
            
            
            
           
            
           
           if(count($listeEvenements)<1){
               $display .= "<div class=\"twelve columns\">";
               $display .="<div class='itemListe twelve columns noresult'>";
               $display .= "Désolé, il n'y a pas encore d'événement correspondant à votre recherche.";
               $display .= "<br/><br/>";
               $display .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"."'>Cliquer ici pour signaler un dysfonctionnement ou suggérer un événement.</a>";
               $display .="</div></div>";
           }else{
            
                switch ($listeType) {
                  case $valueLongListe:
                      $display .= "<div class=\"twelve columns\">";
                      $display .= "<div class='paginationBlock'>";
                      $display .= $nbItems." événements";
//                      $display .= self::afficherPagination($nbPages, $numPage);
                      $display .= HtmlUtilComponents::afficherPaginationJavascript($nbPages,$numPage);
                      $display .="</div>";

                      break;
                  case $valueGridListe:
                      $display .= "<ul class=\"block-grid ".$nbcolToDisplay."-up\"> ";

                      break;
                  default:
                      break;
              }  
               
            foreach ($listeEvenements as $evenement) {
                    
                    
                
                  $datedebut = new DateTime($evenement->getDateDebut());
                  $datefin = new DateTime($evenement->getDateFin());
                    
                    
                    $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(),0);
                    $lieu = LieuActionDao::recupererUnLieu($evenement->getLieu());
                    $map = HtmlUtilComponents::staticMapImageControl($lieu,130,85,3);
                    $evenement->getTypeEvenement();
//                    $typeEvent = TypeEvenementAction::recupererUnType(5);
                    switch ($listeType) {
                        // SI LONG LISTE POUR PAGE PRINCIPALE DES RETRAITES
                        case $valueLongListe:
                            $display .=    "<a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>";     
                            $display .=     "<div class='itemListe twelve columns'>";
                            $display .=     "<div class='four columns'>";
                            $display .=     "<p class='dateListeRetraite'>Du ".date_format($datedebut, 'd/m/Y')." au ".date_format($datefin, 'd/m/Y')."<p></a>";

                            $display .=     "<a href=\"index.php?page=organisateurDetail&id=".$lieu->getId()."\">";
                            $display .=     "<p class='lieuListeRetraite'>".$lieu->getNom()."<p>";  
                            $display .=     "<img src='".$map."' title='".$lieu->getNom()."' alt='<a href=\"index.php?page=organisateurDetail&id=".$lieu->getId()."\">".$lieu->getCp()."<br/>".$lieu->getVille()."</a>' class='imgCaptionSmallListe' />";
                            $display .=     "</a>";
                            $display .=     "</div>";
                            $display .=    "<a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>";  
                            $display .=     "<div class='eight columns'>";
                            $display .=     "<h6 class='titreListeRetraite'>";
                            $display .=     $evenement->getNom();
                            $display .=     "</h6>";
                            $display .=     "<p class='typeLieu'>".TypeEvenementAction::recupererUnType($evenement->getTypeEvenement())->getLibelle()."<p>";  
                            $display .=     "<img src='".$img."' title='".$evenement->getNom()."' alt='".TextStatic::ResumeText($evenement->getDescription(),100)." class='imgCaptionListe' />";
                            $display .=     "</div>";
                            $display .=     "</div>";
                            $display .=     "</a>";
                        
                        

                            break;

                        // SI SHORT LISTE POUR SUGGESTION DE BAS DE PAGE
                        case $valueGridListe:
                            $dates = "Du ".date_format($datedebut, 'd/m/Y')." <br/>";
                            $dates .= "au ".date_format($datefin, 'd/m/Y')."";
                            
                            $display .="<li>
                                <a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>
                                    <img src='".$img."' title='".$evenement->getNom()."' alt='<a href=\"index.php?page=evenementDetail&id=".$evenement->getId()."\">".$dates."</a>' class='imgCaptionSmallListe' />";
                            $display .="<p class=\"ParagraphlisteHome\">";
                                        $display .="<a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>".$evenement->getNom()."</a><br/>";
                                    $display .="</p>
                                </a>
                            </li>";
                            
                            break;
                        
                    }
                    
                    
            }
             switch ($listeType) {
                case $valueLongListe:
                    $display .= "<div class='paginationBlock'>";
                    $display .= self::afficherPagination($nbPages,$numPage);
                    $display .= "</div></div>";
                    break;
                case $valueGridListe:
                    $display .= "</ul>";
                    break;
                default:
                    break;
            }
           }
            // FIN FOREACH
            
           
            
            
            
            return $display;
        }
    
	/**
	 * 
	 * @param unknown_type $idRetraite
	 */
	public static function afficherUneRetraite($idRetraite){
            
            $evenementToDisplay = EvenementActionDao::getEvenement($idRetraite);
            $img = HtmlUtilComponents::imageControl("evenements", $evenementToDisplay->getMainPhoto(),1);

            $display =" <div class='twelve columns'>
                <h3 class='titreRetraite'>".$evenementToDisplay->getNom()."</h3>
            </div>

            <div class='six columns'>
                <img src='".$img."'/>
                
                ".HtmlUtilComponents::displaySocialBar($evenementToDisplay->getNom())."
                
            </div>
            <div class='six columns'>";
                
                $display .= "<div class='panel'>
                    <h7><a href=\"index.php?page=organisateurDetail&id=".$evenementToDisplay->getLieu()."\">".LieuActionDao::recupererUnLieu($evenementToDisplay->getLieu())->getNom()."</a></h7><br/>
                    <h7 class='subheader'>".TextStatic::ResumeText(LieuActionDao::recupererUnLieu($evenementToDisplay->getLieu())->getDescription(),200)."</h7>
                    </div>";
                                    
                $display .="
            </div>
            <div class='twelve columns'>
                <div class='row'>
                    <div class='six mobile-two columns'>
                        <div class=''>
                        <h5 class='titre'>Infos</h5>
                            <h5 class='subheader'>Début : ".$evenementToDisplay->getDateDebut()."<br/>
                                Fin : ".$evenementToDisplay->getDateFin()."<br/>
                                Possibilité de garderie : ".$evenementToDisplay->getGarderie()."<br/>
                                Possibilité d'hébergement : ".$evenementToDisplay->getHebergement()."<br/>
                                Participation : ".$evenementToDisplay->getPrix()."</h5>
                        </div>
                    </div>

                    <div class='six mobile-two columns'>
                        <div class=''>
                        <h5 class='titre'>Themes</h5>";
                        
                        $display .= ThemeAction::afficherVignettesThemesFromRetraites($evenementToDisplay->getId());
                        $display .= "</div>
                    </div>
                    <div class='six mobile-two columns'>
                        <div class=''>
                        <h5 class='titre'>Intervenants</h5>";
                
                $tabRetraite = array($evenementToDisplay->getId());
                $display .= IntervenantAction::afficherVignettesIntervenantsFromRetraites($tabRetraite);
      
                    
                
                       $display .=" </div>
                    </div>
                </div>
            </div>
            <div class='twelve columns'>
                <h5>Description</h5>
                <blockquote>";
                
                $display .= $evenementToDisplay->getDescription();
            
                $display .="</blockquote></div>";
            
            
		
		
		return $display;
		
	}
	   
	/**
	 * 
	 * @param Evenement $evenement
	 */
	public static function creerEvenement(array $arg){

            $context            = "evenement";
            $fileFieldName      = 'data-file-photo';
            $rootImg = $_ENV['properties']['Images']['imgPathRelative'];
            $prefixMiniature    = $_ENV['properties']['Images']['imgPathThumb'];
            $prefixOriginal = $_ENV['properties']['Images']['imgPathOriginal'];
            
            $dossierPrincipal = $rootImg.$_ENV['properties']['Images']['evenements'];
            $dossierOriginal = $dossierPrincipal.$prefixOriginal."/";
            $dossierMiniature = $dossierPrincipal.$prefixMiniature."/";
            
            
            
            
               
            
            
            if($_FILES['data-file-photo']['name']!=""){
                $booImage = true;
                $extension = strrchr($_FILES['data-file-photo']['name'], '.');
                $photo = "spk-".time().imageTreatment::renameImage(substr($arg['nom'], 0, 6)).$extension;
            }else{
                $booImage = false;
            }
            // on créé l'objet retraite

            $evenement = new Evenement();
            $evenement->setId(null);
            $evenement->setNom($arg['nom']);
            $evenement->setDescription($arg['description']);
            $evenement->setMailInscription($arg['mail']);
            $evenement->setCoordInscription($arg['contact']);
            $evenement->setDateDebut($arg['debut']);
            $evenement->setDateFin($arg['fin']);
            $evenement->setMainPhoto($photo);
            $evenement->setPrix($arg['prix']);
            $evenement->setGarderie($arg['garderie']);
            $evenement->setHebergement($arg['hebergement']);
            $evenement->setLieu($arg['lieu']);
            $evenement->setIntervenants(null);
            $evenement->setTheme(null);
            $evenement->setTypeEvenement($arg['type']);
            $evenement->setDateEnregistrement(null);
            $evenement->setPlace($arg['placeId']);

            // Enregistrement dans la table retraite.
            $resultTab = EvenementActionDao::creerUnEvenement($evenement);

                        
                        
            $booValid = $resultTab[0];
            $idRetraite = $resultTab[1];
            // On récupère l'ID de la retraite si elle a été convenablement enregistrée

            if($booValid){
                
                $booValid= IntervenantActionDao::associerIntervenantRetraite($idRetraite, $arg['intervenants']);
                $booValid= ThemeActionDao::associerThemeRetraite($idRetraite,$arg['themes']);
//                    imageTreatment::recupImageFromForm("retraite", "images/data/Retraite/", $photo, "small", "small", 'data-file-photo');
                if($booImage){
                    $booValid = imageTreatment::imageManage($context, $fileFieldName, $photo, $prefixMiniature, $dossierPrincipal, $dossierMiniature, $dossierOriginal);
                }
            }
            

            
            if($booValid){
                $returnedArr = $resultTab;
            }else{
                $returnedArr = array(false,null);
            }
        
            return $returnedArr;
        }
	
	/**
	 * 
	 * @param Evenement $evenement
	 */
	public static function modifierEvenement($evenement, array $arg){
            $context            = "evenement";
            $fileFieldName      = 'data-file-photo';
            $prefixMiniature    = $_ENV['properties']['Images']['imgPathThumb'];
            $dossierPrincipal   = $_ENV['properties']['Images']['imgPathRelative'].$_ENV['properties']['Images']['evenements'];
            $dossierMiniature   = $_ENV['properties']['Images']['imgPathRelative'].$_ENV['properties']['Images']['evenements'].$_ENV['properties']['Images']['imgPathThumb']."/";
            $dossierOriginal    = $_ENV['properties']['Images']['imgPathRelative'].$_ENV['properties']['Images']['evenements'].$_ENV['properties']['Images']['imgPathOriginal']."/";

            $photo = $evenement->getMainPhoto();
            
            
            // On supprime toutes les correspondances existantes entre la retraite et themes / intervenants
            IntervenantActionDao::effacerAssociationIntervenantRetraite($evenement->getId(), null);
            ThemeActionDao::effacerAssociationThemeRetraite($evenement->getId(), null);
            
            $booResult = IntervenantActionDao::associerIntervenantRetraite($evenement->getId(), $arg['intervenants']);
            $booResult = ThemeActionDao::associerThemeRetraite($evenement->getId(), $arg['themes']);

//            $updatedRetraite = new Retraite($evenement->getId(), $arg['nom'], $arg['description'], $arg['mail'], $arg['contact'], $arg['debut'], $arg['fin'], $photo, $arg['prix'], $arg['garderie'], $arg['hebergement'], $arg['lieu'], null, null, null);
//            
//                $updatedRetraite = new Retraite();
//                $updatedRetraite->setId(null);
                $evenement->setNom($arg['nom']);
                $evenement->setDescription($arg['description']);
                $evenement->setMailInscription($arg['mail']);
                $evenement->setCoordInscription($arg['contact']);
                $evenement->setDateDebut($arg['debut']);
                $evenement->setDateFin($arg['fin']);
                $evenement->setMainPhoto($photo);
                $evenement->setPrix($arg['prix']);
                $evenement->setGarderie($arg['garderie']);
                $evenement->setHebergement($arg['hebergement']);
                $evenement->setLieu($arg['lieu']);
//                $evenement->setIntervenants(null);
//                $evenement->setTheme(null);
                $evenement->setTypeEvenement($arg['type']);
//                $evenement->setDateEnregistrement(null);
                $evenement->setPlace($arg['placeId']);
            
            if($_FILES['data-file-photo']['name']!=""){
                                           
                $extension = strrchr($_FILES['data-file-photo']['name'], '.');               
                $photo = "spk-".time().imageTreatment::renameImage(substr($evenement->getNom(), 0, 6)).$extension;          
                        
//                imageTreatment::imageManage("evenement", 'data-file-photo', $photo, $_ENV['properties']['Images']['imgPathThumb'], $_ENV['properties']['Images']['evenements'], $_ENV['properties']['Images']['evenements'].$_ENV['properties']['Images']['imgPathThumb']."/", $_ENV['properties']['Images']['evenements'].$_ENV['properties']['Images']['imgPathOriginal']."/");
                $booValid = imageTreatment::imageManage($context, $fileFieldName, $photo, $prefixMiniature, $dossierPrincipal, $dossierMiniature, $dossierOriginal);
                $evenement->setMainPhoto($photo);      
            }
            
            $booResult =  EvenementActionDao::modifierUnEvenement($evenement); 
            
            return $booResult;
	}
	
       
	/**
	 * 
	 * @param Evenement $evenement
	 */
	public static function supprimerEvenement($idEvent){
                $booResult = false;
                $booResult = ThemeActionDao::effacerAssociationThemeRetraite($idEvent, null);
                $booResult = IntervenantActionDao::effacerAssociationIntervenantRetraite($idEvent, null);
		$booResult = DiaporamaActionDao::retirerEvenementDiaporama($idEvent);
                $booResult =  EvenementActionDao::supprimerUnEvenement($idEvent);
                return $booResult;
	}
	
        /**
         *
         * @param type $idLieu 
         */
//        public static function isRetraiteForThisLieu($idLieu){
//            $nbResult = EvenementActionDao::getNombreEvenementPourUnOrganisateur($idLieu);
//            return $nbResult;
//        }
        
        /**
         * Renvoi un array contenant les id des retraites pour le lieu 
         * @param type $idLieu
         * @return array 
         */
//        public static function recupererListeRetraiteForLieu($idLieu){
//            $listeRetraite = EvenementActionDao::getListeEvenementsPourUnLieu($idLieu);
//            
//            return $listeRetraite;
//        }
        
        /**
         * Renvoi l'objet Retraite
         * @param type $idRetraite
         * @return type 
         */
        public static function getEvenement($idRetraite,$lieuValideFacultatif = null){
            AppLog::ecrireLog("3-1 - dans EvenementActionDa - Static map récupéree", "debug");
            return EvenementActionDao::getEvenement($idRetraite,$lieuValideFacultatif);
        }
        
        
        /**
         * Affiche les x listes d'événement contenant le plus d'items 
         * Le nb de liste est défini en conf
         * @return type
         */
        public static function afficherListesEvenements(){
            
           
            
            
            $html = "";
            $listeTypes = EvenementActionDao::getListeTypesEvenementsPlusUtilises();
            $listeTyp = 1;
            $gridNbCol = 3;
            $listedl = array();
            $listeul = array();
            foreach ($listeTypes as $value) {
                
                

                
                    $filter = new  EvenementSearchCriteria();
                    $filter->setEvenementLimit(0,4);
                    $filter->setEvenementType(array($value[0]));
                    
                    
                    $html .= self::afficherListesRetraites($filter, $listeTyp, $gridNbCol,$value[0]);
                
                
                
                
            }
            
            return $html;
        }
        
        /**
         * 
         * @return string
         */
        public static function afficherTabsEvenementsPlusFrequents(){
           $html = "";
           
           
           $listeTypes = EvenementActionDao::getListeTypesEvenementsPlusUtilises();
           $listeTitre = $listeTypes;
           
           $html .="<dl class=\"tabs three-up\">";
           $i = 0;
           foreach ($listeTitre as $item) {
               $active = "";
               if($i==0){
                   $active = "active  homepageactivetab";
               }
               $html .= "<dd class=\"panel ".$active."\"><a href=\"#".$item[0]."\">".TypeEvenementAction::recupererUnType($item[0])->getLibelle()." <span class=\"numberItem\">(".$item[1].")</span></a></dd>";
           $i++;
           }
//            $html .= "<dd class=\"\"><a href=\"".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")    ."\">Voir tout...</a></dd>";
            $html .="</dl>";
              

          $html .="<ul class=\"tabs-content\">";
          $i=0;
          unset($item);
          foreach ($listeTypes as $item) {
              
            $filter = new  EvenementSearchCriteria();
            $filter->setEvenementLimit(0,4);
            $filter->setEvenementType(array($item[0]));
                    
              $active = "";
               if($i==0){
                   $active = "active";
               }
               
            $html .="<li class=\"".$active."\" id=\"".$item[0]."Tab\">".self::afficherListesRetraitesPourTabs($filter, 2)."</li>";
            $i++;
          }
          $html .= "</ul>";
           
           return $html;
            
            
        }
        
        
        
        
          /**
         * 
         * @param EvenementSearchCriteria $filter
         * @param type $cssId
         * @param type $cssClass
         * @param type $action = 0 (back: lien vers mise à jour) ou 1 (front: liste pour front office)
         * @return string 
         */
        public static function afficherListesRetraitesPourTabs(EvenementSearchCriteria $filter,$gridNbCol){
            
            
            $display = "";
            $listeEvenements = EvenementActionDao::listerTousEvenements($filter,false);
            
            $nbCol = array("one","two","three","four","five","six","seven","height","nine","ten","eleven","twelve");
            if(!is_null($gridNbCol)){
                $nbcolToDisplay = $nbCol[$gridNbCol];
            }else{
                $nbcolToDisplay = $nbCol[1];
            }
            
            
            $display .= "<ul class=\"block-grid ".$nbcolToDisplay."-up\"> ";
             
            
           
           
            foreach ($listeEvenements as $evenement) {
                    
                    
                
                  $datedebut = new DateTime($evenement->getDateDebut());
                  $datefin = new DateTime($evenement->getDateFin());
                    
                    
                    $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(),0);
                    $evenement->getTypeEvenement();
//                    $typeEvent = TypeEvenementAction::recupererUnType(5);
                    
                    $debut = date_format($datedebut, 'd/m/Y');
                    $fin = date_format($datefin, 'd/m/Y');
                    $dates = "";
                    if($debut==$fin){
                        $dates = $debut;
                    }else{
                        $dates = "Du ".date_format($datedebut, 'd/m/Y')." <br/>";
                        $dates .= "au ".date_format($datefin, 'd/m/Y')."";
                    }
                            
                            
                            
                            $display .="<li>
                                <a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>
                                    <img src='".$img."' title='".$evenement->getNom()."' alt='".$evenement->getNom()."' class='' />";
                            $display .="<p class=\"ParagraphlisteHome\">";
                                        $display .="<a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>".$evenement->getNom()."</a><br/>";
                                        $display .=$dates;
                                    $display .="</p>
                                </a>
                            </li>";
                    
                    
            }
            // FIN FOREACH
            
            $display .= "</ul>";
                 
            
            
            
            return $display;
        }
        
}

?>