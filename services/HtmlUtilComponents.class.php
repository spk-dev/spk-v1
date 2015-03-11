<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class HtmlUtilComponents{
 
    
    /**
     * Afficher le diaporama
     * @param type $nbLieux
     * @return array
     */
    public static function afficherDiaporama($nbLieux){

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
     * Affiche la barre de réseau sociaux
     * @param type $item
     * @return string
     */
    public static function displaySocialBar($item){
        $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
        $display ="";
       
        $display .='<div class="six columns fb-like" data-href="'.$monUrl.'" data-send="false" data-layout="button_count" data-show-faces="true" data-font="verdana" data-action="recommend"></div>';
        $display .="<div class='six columns'>";
        $display .= "<a href=\"https://twitter.com/share\" class=\"twitter-share-button\" data-via=\"spibook\" data-lang=\"fr\" data-related=\"spibook\" data-hashtags=\"spibook\">Tweeter</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>";
        
            $display .="<a href=\"http://pinterest.com/pin/create/button/?url=".$_SERVER['REQUEST_URI'] ."&amp;media=internet&amp;description=".$item."\" class=\"pin-it-button\" count-layout=\"horizontal\"><img border=\"0\" src=\"//assets.pinterest.com/images/PinExt.png\" title=\"Pin It\"></a>";
        $display .="</div>";

         
         
        return $display;
    }
    
    
    public static function displayLieuOnMap(Lieu $lieu){
        
        
        
        $display ="<script type=\"text/javascript\">
        $(function(){

            $('#test1').gmap3(
            { action: 'addMarker',
                address: \"".$lieu->getAdresseComplete()."\",
                map:{
                center: true,
                zoom: 8,
                mapTypeId: google.maps.MapTypeId.TERRAIN
                }
            }
            );
        });
        </script>";
       $display .= "<div id=\"test1\" class=\"gmap3\"></div>";
        
        return $display;
    }
    
    /**
     * Affiche le formulaire de filtre
     * @param type $type
     * @return string Html
     */
    public static function displayFilterOnPage($type){
        $booRetraite = false;
        $booLieu = false;
        
        
       switch ($type) {
            case "retraite":
                $booRetraite = true;
                break;
            case "lieu":
                $booLieu = true;
                break;
            default:
                break;
        }
 
        
        
        $display = "<form id='filterFormID' name='filterFormName' method='post' action='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."'>";
 
            if($booRetraite){
                $display .="<div id='typeResearch' class='searchCriteria '>";
                $display .="<label for='Type[]' class='labelSearchField'>Type d'événement</label>";
                $display .="<div id='searchField'>";
                $display .= HtmlFormComponents::SelectTypeEvenements("Type[]", "listeType", 6, "contactItem twelve", 1, null, true);
                $display .= "</div></div>";
            }
            
        
            if($booRetraite){
                $display .="<div id='intervenantsResearch' class='searchCriteria '>";
                $display .="<label for='Intervenant[]' class='labelSearchField'>Intervenants</label>";
                $display .="<div id='searchField'>";
                $display .= HtmlFormComponents::SelectIntervenants($type,"Intervenant[]","listeIntervenants", 6, "contactItem twelve", 1);
                $display .= "</div></div>";
            }
            

            if($booRetraite){
                $display .="<div id='lieuxResearch' class='searchCriteria'>";
                $display .="<label for='Lieu[] class='labelSearchField'>Lieux</label>";
                $display .= HtmlFormComponents::SelectLieuxFromEvenement($type,"Lieu[]","listeLieux", 6, "contactItem twelve", 1);          
                $display .="</div>";
            }
//
           if($booRetraite){            
                $display .="<div id='themeResearch' class='searchCriteria'>";
                $display .="<label for='theme[] class='labelSearchField'>Themes</label>";
                $display .= HtmlFormComponents::SelectThemeFromEvenement("Theme[]","listeThemes", 6, "contactItem twelve", 1); 
                $display .="</div>";
            }
            
            if($booRetraite){            
                $display .="<div id='dateResearch' class='searchCriteria'>";
                $display .="<label for='DateMin' class='labelSearchField'>Date min</label>";
                $display .="<input type='text' name='DateMin' id='DateMin' class='searchField' value=''/>";
            }

            if($booRetraite){                
                $display .="<label for='DateMax' class='labelSearchField'>Date max</label>";
                $display .="<input type='text' name='DateMax' id='DateMax' class='searchField'/>";
                $display .="</div>";
            }
            
            if($booRetraite){                
                $display .="<div id='garderieResearch' class='searchCriteria'>";
                $display .="<label for='Garderie' class='labelSearchField'>Garderie</label>";
                $display .= HtmlFormComponents::selectOuiNon("Garderie", "GarderieID", 1, "searchField", 3);
                $display .="</div>";
            }
//            
            if($booRetraite){                
                $display .="<div id='hebergementResearch' class='searchCriteria'>";
                $display .="<label for='Hebergement' class='labelSearchField'>H&eacute;bergement</label>";
                $display .= HtmlFormComponents::selectOuiNon("Hebergement", "HebergementID", 1, "searchField", 3);
                $display .="</div>";
            }
            
            if($booRetraite || $booLieu){    
                $display .="<div id='keywordResearch' class='searchCriteria'>";
                $display .="<label for='keywords' class='searchField'>Mots cl&eacute;s </label>";
                $display .="<input type='text' name='keywords' id='keywords' class='searchField'/>";
                $display .="</div>";
            }

            
            $display .="<div id='buttonResearch' class='searchCriteria'>";
            $display .="<input type='submit' name='filter' id='filter' value='Rechercher' />";
            $display .="<input type='reset' name='Reset' id='Reset' value='Reset' />";
            $display .="</div>";    

            $display .="</form>";
        
        
        return $display;
    }
    /**
     * Affiche le formulaire de filtre
     * @param type $type
     * @return string Html
     */
    public static function displayFilterOrganisateurs(){
        
        
        $display = "<div class='twelve columns panel'";
        $display .= "<form id='filterFormID' name='filterFormName' method='post' action='".Redirect::getCurrentUrl()."'>";
 
        
            
            
                $display .="<div id='lieuxResearch' class='searchCriteria'>";
                $display .="<label for='Lieu[] class='labelSearchField'>Rechercher un organisateur</label>";
                $display .= HtmlFormComponents::SelectLieuxFromEvenement("retraite","Lieu[]","listeLieux", 6, "contactItem twelve", 1);          
                $display .="</div>";
               
                $display .="<div id='garderieResearch' class='searchCriteria'>";
                $display .="<label for='Garderie' class='labelSearchField'>Garderie</label>";
                $display .= HtmlFormComponents::selectOuiNon("Garderie", "GarderieID", 1, "searchField", 3);
                $display .="</div>";
                           
                $display .="<div id='hebergementResearch' class='searchCriteria'>";
                $display .="<label for='Hebergement' class='labelSearchField'>H&eacute;bergement</label>";
                $display .= HtmlFormComponents::selectOuiNon("Hebergement", "HebergementID", 1, "searchField", 3);
                $display .="</div>";
             
                $display .="<div id='keywordResearch' class='searchCriteria'>";
                $display .="<label for='keywords' class='searchField'>Mots cl&eacute;s </label>";
                $display .="<input type='text' name='keywords' id='keywords' class='searchField'/>";
                $display .="</div>";
            

            
            $display .="<div id='buttonResearch' class='searchCriteria'>";
            $display .="<input type='submit' name='filter' id='filter' value='Rechercher' />";
            $display .="<input type='reset' name='Reset' id='Reset' value='Reset' />";
            $display .="</div>";    

            $display .="</form></div>";
        
        
        return $display;
    }
   
    /**
     * Affiche le formulaire de filtre
     * @param type $type
     * @return string Html
     */
    public static function displayFilterOnHomePage($type,$suffixeId){
        $booRetraite = false;
        $booLieu = false;
        
        
       switch ($type) {
            case "retraite":
                $booRetraite = true;
                break;
            case "lieu":
                $booLieu = true;
                break;
            default:
                break;
        }
 
        
        
        $display = "<form id='filterFormID' name='filterFormName' method='post' action='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."'>";
            if($booRetraite){
                $display .="<div class='row '>";
                $display .="<div class='twelve columns'>";
                $display .="<label for='Type[]' class='labelSearchField'>Type d'événement</label>";
                $display .="<div id='searchField'>";
                $display .= HtmlFormComponents::SelectTypeEvenements("Type[]", "listeType".$suffixeId, 6, "contactItem twelve", 1, null, true);
                $display .= "</div></div>";
                $display .= "</div>";
            }
            if($booRetraite){
                $display .="<div class='row '>";
                    $display .="<div class='six columns'>";
                        $display .="<label for='Intervenant' class='labelSearchField three columns'>Intervenants</label>";
                        $display .= HtmlFormComponents::SelectIntervenants($type,"Intervenant[]","listeIntervenants".$suffixeId, 6, "formField twelve", 1);
                    $display .="</div>";
                    $display .="<div class='six columns'>";
                        $display .="<label for='Lieu' class='labelSearchField'>Lieux</label>";
                        $display .= HtmlFormComponents::SelectLieuxFromEvenement($type,"Lieu[]","listeLieux".$suffixeId, 6, "contactItem twelve", 1);          
                    $display .= "</div>";
                $display .= "</div>";
            }
//
           if($booRetraite){ 
                $display .="<div class='row '>";
                $display .="<div class='six columns'>";
                $display .="<label for='theme' class='labelSearchField'>Themes</label>";
                $display .= HtmlFormComponents::SelectThemeFromEvenement("Theme[]","listeThemes".$suffixeId, 6, "contactItem twelve", 1); 
                
                $display .="</div>";
                $display .="<div class='six columns'>";                
                $display .="<label for='keywords' class='labelSearchField'>Mots cl&eacute;s </label>";
                $display .="<input type='text' name='keywords' id='keywords' class='searchField'/>";
                $display .="</div>";
                $display .="</div>";
            }
            
            if($booRetraite){
                $display .="<div class='row '>";
                    $display .="<div class='six columns'>";
                        $display .="<label for='DateMin' class='labelSearchField'>Date min</label>";
                        $display .="<input type='text' name='DateMin' id='DateMin".$suffixeId."' class='searchField' value=''/>";
                    $display .="</div>";
                    $display .="<div class='six columns'>";                
                        $display .="<label for='DateMax' class='labelSearchField'>Date max</label>";
                        $display .="<input type='text' name='DateMax' id='DateMax".$suffixeId."' class='searchField'/>";
                    $display .="</div>";
                $display .= "</div>";
            }

            
            if($booRetraite){ 
                $display .="<div class='row '>";
                $display .="<div class='six columns'>";
                $display .="<label for='Garderie' class='labelSearchField seven columns'>Garde d'enfant</label>";
                $display .= HtmlFormComponents::selectOuiNon("Garderie", "GarderieID".$suffixeId, 1, "searchField five columns", 3);
                $display .="</div>";
                $display .="<div class='six columns'>";                
                $display .="<label for='Hebergement' class='labelSearchField seven columns'>Logement sur place</label>";
                $display .= HtmlFormComponents::selectOuiNon("Hebergement", "HebergementID".$suffixeId, 1, "searchField five columns", 3);
                $display .="</div>";
                $display .="</div>";
            }
            $display .="<div class='row '>";
            $display .="<div id='buttonResearch' class='twelve columns'>";
            $display .="<input type='submit' name='filter' id='filter' value='Rechercher' class='twelve columns searchSubmit' />";
            $display .="</div>";    
            $display .="</div>";
            $display .="</form>";
        
        
        return $display;
    }
    
    
    /**
     * Affiche le formulaire de filtre
     * @param type $type
     * @return string Html
     */
    public static function displayFilterOnMenu($type){
        
        
        
        $display = "<form id='filterFormID' name='filterFormName' method='post' action='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."'>";
 
//                $display .="<div id='intervenantsResearch' class='searchCriteria'>";
                $display .= "<div class='row'>";
                $display .="<label for='Intervenant[]' class='four columns'>Intervenants</label>";
//                $display .="<div id='searchField'>";
                $display .= HtmlFormComponents::SelectIntervenants($type,"Intervenant[]","listeIntervenantsMenu", 6, "eight columns", 1);
//                $display .= "</div></div>";
                $display .="</div>";    
//                $display .="<div id='lieuxResearch' class='searchCriteria'>";
                $display .= "<div class='row'>";
                $display .="<label for='Lieu[] class='four columns'>Lieux</label>";
                $display .= HtmlFormComponents::SelectLieuxFromEvenement($type,"Lieu[]","listeLieuxMenu", 1, "eight columns", 1);          
                $display .="</div>";
           
                $display .= "<div class='row'>";
                $display .="<label for='theme[] class='four columns'>Themes</label>";
                $display .= HtmlFormComponents::SelectThemeFromEvenement("Theme[]","listeThemesMenu", 6, "contactItem eight columns", 1); 
                $display .="</div>";
           
//                $display .="<div id='dateResearch' class='searchCriteria'>";
                $display .= "<div class='row'>";
                $display .="<label for='DateMin' class='four columns'>Date min</label>";
                $display .="<input type='text' name='DateMin' id='DateMinMenu' class='searchField eight columns' value=''/>";
                $display .="</div>";    
                $display .= "<div class='row'>";
                $display .="<label for='DateMax' class='four columns'>Date max</label>";
                $display .="<input type='text' name='DateMax' id='DateMaxMenu' class='searchField eight columns'/>";
                $display .="</div>";
                
//                $display .="<div id='garderieResearch' class='searchCriteria'>";
                $display .= "<div class='row'>";
                $display .="<label for='Garderie' class='four columns'>Garderie</label>";
                $display .= HtmlFormComponents::selectOuiNon("Garderie", "GarderieID", 1, "searchField eight columns", 3);
                $display .="</div>";
             
//                $display .="<div id='hebergementResearch' class='searchCriteria'>";
                $display .= "<div class='row'>";
                $display .="<label for='Hebergement' class='four columns'>H&eacute;bergement</label>";
                $display .= HtmlFormComponents::selectOuiNon("Hebergement", "HebergementID", 1, "searchField eight columns", 3);
                $display .="</div>";
  
//                $display .="<div id='keywordResearch' class='searchCriteria'>";
                $display .= "<div class='row'>";
                $display .="<label for='keywords' class='four columns'>Mots cl&eacute;s </label>";
                $display .="<input type='text' name='keywords' id='keywords' class='searchField eight columns'/>";
                $display .="</div>";
                

            $display .= "<div class='row'>";
            $display .="<div id='buttonResearch' class='searchCriteria'>";
            $display .="<input type='submit' name='filter' id='filter' value='filter' />";
            $display .="<input type='reset' name='Reset' id='Reset' value='Reset' />";
            $display .="</div>";    
            $display .="</div>";    
            $display .="</form>";
        
        
        return $display;
    }
    
    /**
     * Création d'un menu wizard
     * @param type $tabMenu (Tableau contenant clé : lien - valeur : tab[] contenant: tab[0] titre, tab[1] soustitre, 
     * @param type $idMenu
     * @param type $classMenu
     * @param type $numCurrent
     * @param type $numLastDone
     * @return string 
     */
    public static function displayWizardMenu($tabMenu,$idMenu,$classMenu,$numCurrent){
     
      $numLastDone = $numCurrent-1;
        
      $display ="<ul id='".$idMenu."' class='".$classMenu."'>";
      
      $i=1;
      foreach ($tabMenu as $linkTextTab) {
          $linkOk=false;
          $class="";
          
          if($i==$numCurrent){
              $class="current";
              $linkOk = true;
          }
          if($i==$numLastDone){
              $class="lastDone";
              $linkOk = true;
          }
          if($i<$numLastDone){
              $class="done";
              $linkOk = true;
          }

          if($i==count($tabMenu)){
              $class="mainNavNoBg";
          }
          
          if($i==count($tabMenu) && $i==$numCurrent){
              $class="mainNavNoBg current";
              $linkOk = true;
          }
          
          $display .="<li class='".$class."'>";
          $display .="<a href='";
          if($linkOk){
              $display .=$linkTextTab[0];
          }
          $display .="'>";
          $display .="<em>".$linkTextTab[1]."</em>";
          $display .="<span>".$linkTextTab[2]."</span>";
          
          
          $display .="</li>";
          $i++;
      }
      
      
      $display .="</ul>";
    
    return $display;
    }
    
    /**
     * Vérifie l'existence de l'image et remplace par l'image par défaut si nécessaire.
     * @param string $action : retraites / lieux / communautes / intervenants / themes / types
     * @param string $imageName : getPhoto de l'objet
     * @param int  $size        0 = miniature / 1 = taille normale
     * @return string : Nom de l'image à utiliser.
     */
    public static function imageControl($action,$imageName,$size){
        
        
        $pathImage = $_ENV['properties']['Images']['imgPathRelative'];
        $pathThumb = $_ENV['properties']['Images']['imgPathThumb'];
        $specificFolder = $_ENV['properties']['Images'][$action];
        $path = "";
        switch ($size) {
            case 0:
                $path = $pathImage.$specificFolder.$pathThumb."/".$pathThumb."_";
                break;
            case 1 : 
                $path = $pathImage.$specificFolder;
            default:
                break;
        }
        
        if($_ENV['properties']['Infos']['plateforme']=='local'){
            $imgFullPath = "../www/".$path.$imageName;   
        }else{
            $imgFullPath = $path.$imageName;    
        }
        AppLog::ecrireLog("Dans HtmlUtilComponent - imgfullpath : [".$imgFullPath."]", "debug");
        
        if($imageName=="" || !file_exists($imgFullPath)){
            $img = $path."default_".$action.".png";  
        }else{
            $img = $path.$imageName;
        }
        return $img;
    }
    
    /**
     * Gère l'affichage et, le cas échéant la création des maps statics
     * @param Lieu $lieu
     * @param type $largeur
     * @param type $hauteur
     * @param type $zoom
     * @return string
     */
    public static function staticMapImageControl(Lieu $lieu,$largeur,$hauteur,$zoom){
        
        $pathStaticMap = $_ENV['properties']['Images']['imgStaticMap'];
        $pathStaticMapPrefix = $_ENV['properties']['Images']['imgStaticMapPrefix'];
        $pathStaticMapExtention = $_ENV['properties']['Images']['imgStaticMapExtension'];
        
        $imgSrc = $pathStaticMap.$pathStaticMapPrefix.$lieu->getId()."-larg".$largeur."-haut".$hauteur."-zoom".$zoom.$pathStaticMapExtention;
            
            if(!file_exists($imgSrc)){
                
                $urlImage = "http://maps.googleapis.com/maps/api/staticmap?center=".$lieu->getLat().",".$lieu->getLong()."&zoom=".$zoom."&size=".$largeur."x".$hauteur."&maptype=terrain&markers=color:0x1b6b74%7Csize:mid%7C".$lieu->getLat().",".$lieu->getLong()."&".$lieu->getLat().",".$lieu->getLong()."&format=png&sensor=true";
                
                $local= $imgSrc;
                $remote = $urlImage;

                $DownloadBinaryFile = new DownloadBinaryFile();

                if ($DownloadBinaryFile->load($remote)==TRUE) {
                    $DownloadBinaryFile->saveTo($local);
                   
                }else{
                    $imgSrc = $urlImage;
                }
                
                
            }
            return $imgSrc;
    }
    
    /**
     * Supprime une mini carte dans le cas d'une mise à jour de l'adresse d'un lieu
     * @param Lieu $lieu
     * @param type $largeur
     * @param type $hauteur
     * @param type $zoom
     */
    public static function staticMapImageReset(Lieu $lieu,$largeur,$hauteur,$zoom){
        
        $suppresion = false;
        $pathStaticMap = $_ENV['properties']['Images']['imgStaticMap'];
        $pathStaticMapPrefix = $_ENV['properties']['Images']['imgStaticMapPrefix'];
        $pathStaticMapExtention = $_ENV['properties']['Images']['imgStaticMapExtension'];
        
        $imgSrc = $pathStaticMap.$pathStaticMapPrefix.$lieu->getId()."-larg".$largeur."-haut".$hauteur."-zoom".$zoom.$pathStaticMapExtention;
            
            if(!file_exists($imgSrc)){
              
                $suppresion  = unlink($imgSrc);          
                
            }
            return $suppresion;
    
        
    }
    
    
    /**
     * 
     * @param type $idLieu
     */
    public static function staticMapSupprimerToutesLesMapsLieu($idLieu){
        
        $pathStaticMap = $_ENV['properties']['Images']['imgStaticMap'];
        $pathStaticMapPrefix = $_ENV['properties']['Images']['imgStaticMapPrefix'];
        
        self::suppression($pathStaticMap,$pathStaticMapPrefix, $idLieu);
    }
       
  
    /**
     * Boucle de suppression des images StaticMaps
     * @param type $dossier_traite
     * @param type $id
     */ 
    private static function suppression($dossier_traite ,$prefix, $id){
       
        // On ouvre le dossier.
        $repertoire = opendir($dossier_traite);
        $prefix = $prefix.$id;
        $nbCar = strlen($prefix);
        
// On lance notre boucle qui lira les fichiers un par un.
        while(false !== ($fichier = readdir($repertoire))){

            // On met le chemin du fichier dans une variable simple
            $chemin = $dossier_traite.$fichier;
            if(substr($fichier, 0, $nbCar) == $prefix){
                unlink($chemin);
            }
        }
        closedir($repertoire); // On ferme !
    }
    
    
    
    /**
         * Affiche la barre de pagination
         * @param type $nbPages
         * @param type $currentPage
         */
        public static function afficherPagination($nbPages,$currentPage,$url){
            $html="<div class='twelve columns'>";
            for($i=1;$i<=$nbPages;$i++){
                $bold = "";
                $ebold = "";
                if($i==$currentPage){
                    $bold = "<b>";
                    $ebold = "</b>";
                }
//                $html .= $bold."<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&numpage=".$i."'>".$i."</a>|".$ebold;
                $html .= $bold."<a href='".$url."&numpage=".$i."'>".$i."</a>|".$ebold;
            }
            $html .="</div>";
            return $html;
            
        }
        
        
        /**
         * Affiche la barre de pagination
         * @param type $nbPages
         * @param type $currentPage
         */
        public static function afficherPaginationJavascript($hiddenFieldId, $formName,$nbPages,$currentPage){
            
            $previous = $currentPage-1;
            $next = $currentPage+1;
            $html ='<ul class="pagination">';
            if($currentPage==1){
                $statusPrevious = "unavailable";
                $behaviourPrevious = "";
            }else{
                $statusPrevious = "";
                $behaviourPrevious = "onClick='javascript:pagination(\"".$hiddenFieldId."\",\"".$formName."\",".$previous.")'";
            }
            
            if($currentPage==$nbPages){
                $statusNext = "unavailable";
                $behaviourNext = "";
            }else{
                $statusNext = "";
                $behaviourNext =  "onClick='javascript:pagination(\"".$hiddenFieldId."\",\"".$formName."\",".$next.")'";
            }
            
            $html .='<li class="arrow '.$statusPrevious.'"><a '.$behaviourPrevious.'>&laquo;</a></li>';
            for($i=1;$i<=$nbPages;$i++){
                $class = "";
                if($i==$currentPage){
                    $class = 'class="current"';
                }
                $html .='<li '.$class.'><a onClick="javascript:pagination(\''.$hiddenFieldId.'\',\''.$formName.'\','.$i.');">'.$i.'</a></li>';
            }
             $html .='<li class="arrow '.$statusNext.'"><a '.$behaviourNext.'>&raquo;</a></li>';
            
            $html .="</ul>";
            return $html;
            
        }    
        
        
        
        public static function paginationPost($nbPages,$currentPage,$url,$name,$id,$cssClass){
            
            if($nbPages<=1){
                $htmlCode = "1";
            }else{
                                
                $htmlCode ="";
                $htmlCode.="<select onChange='submit()' name='".$name."' size='1' id='".$id."' class='".$cssClass."' >";
                

                for($i=1;$i<=$nbPages;$i++){
                    $htmlCode.= "<option value=".$i;
                    if($i==$currentPage){
                        $htmlCode .= " SELECTED ";                        
                    }
                    $htmlCode .= ">".$i."</option>";
                }
                $htmlCode.="</select>";
                
            }
            
            return $htmlCode;
        }
        
        public static function transformInLink($url,$target){
            
            $url = "<a href='".$url."' target='".$target."'>".$url."</a>";
            return $url;
        }
        
        public static function transformInMailto($email){
            $email = "<a href='mailto:".$email."?subject=Inscription depuis SPIBOOK&body=Bonjour,'>".$email."</a>";
            return $email;
        }
        
        /**
         * Retourne la popup pour les map google map
         * @param Evenement $evenement
         * @return string
         */
        public static function getPopUpEventPlaceForMap(Evenement $evenement, Place $place){
//            $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(),1);
            $linkMap = "http://maps.google.com/?q=".$place->getLat().",".$place->getLong();
            $linkTrain = "http://www.voyages-sncf.fr";
            $str = "";
            $str .="<div class='divPopUpGoogleMap popUpEvenement'>" ;
            $str .= "<h1><a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>".$evenement->getNom()."</a></h1>";  
//            $str .="<img style='float:left; margin-right:0.2em;' src='".$img."'/>";
            $str .= $place->getAdresse1();
            //<p><?php echo $place->getAdresse1(); ?><?php echo $place->getAdresse2(); ?><br/><?php echo $place->getCp(); ?> <?php echo $place->getVille();
            $str .= "<br/>";
            $str .= $place->getAdresse2();
            $str .= "<br/>";
            $str .= $place->getCp();
            $str .= "<br/>";
            $str .= $place->getVille();
            $str .= "<br/>";
            $str .= "<br/>";
            $str .= "<br/>";
    
            $str .= "<p><img src='images/spibook/externes/gmap.png' style='float:left;'/> &nbsp; <a href='".$linkMap."' target='_blank'>Itinéraire sur google map</a></p>";
            
            $str .= "<p><img src='images/spibook/externes/sncf.png' style='float:left;'/> &nbsp; <a href='".$linkTrain."' target='_blank'>Trouver un train sur voyage-sncf</a></p>";
    
            $str .= "</div>";
                        
            
            return $str;
        }
        
        /**
         * Retourne la popup pour les map google map
         * @param Evenement $evenement
         * @return string
         */
        public static function getPopUpEventForMap(Evenement $evenement){
            $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(),1);
            $str = "";
            $str .="<div class='divPopUpGoogleMap popUpEvenement'>" ;
            $str .= "<h1><a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>".$evenement->getNom()."</a></h1>";  
            $str .="<img class='vignette' src='".$img."'/>";
            $str .= "du ".$evenement->getDateDebutFormatedCourt();
            $str .= "<br/>";
            $str .= "au ".$evenement->getDateFinFormatedCourt();
            $str .= "<br/><br/><br/>";
            $str .= "<p style='text-align:right;'><a href='index.php?page=evenementDetail&id=".$evenement->getId()."'>En savoir plus</a></p>";
            $str .= "</div>";
                        
            
            return $str;
        }
        
        /**
         * Retourne la popup pour les map google map
         * @param Evenement $evenement
         * @return string
         */
        public static function getPopUpOrganisateurForMap(Lieu $lieu){
             $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
            $str = "";
            $str .="<div class='divPopUpGoogleMap popUpOrganisateur'>" ;
            $str .= "<h1><a href='index.php?page=organisateurDetail&id=".$lieu->getId()."'>".$lieu->getNom()."</a></h1>";  
            $str .="<img class='vignette' src='".$img."'/>";
            $str .= $lieu->getVille();
            $str .= "<br/>";
            $str .= $lieu->getDepartement();
            
            $str .= "<br/><br/><br/>";
            $str .= "<p style='text-align:right;'><a href='index.php?page=organisateurDetail&id=".$lieu->getId()."'>En savoir plus</a></p>";
            $str .= "</div>";
                        
            
            return $str;
        }
    
}
?>
