<?php


 
/**
 * Génération des blocs de menu de 2nd niveau.
 */
class MenuAction{
   
      /**
     * Renvoi la liste des régions 
     * si $contientDesRetraites = true : seules les régions contenant des retraites sont renvoyées
     * si $contientDesRetraites = false : Toutes les régions sont renvoyés
     * @param boolean $contientDesRetraites
     * @return string
     */
    public static function getCommunautes($contientDesRetraites,$typeAffichage){
        $html = "";
        $listeCommunautes = CommunauteActionDao::listerToutesCommunautes($contientDesRetraites);
        $counter = 1;
        $val = count($listeCommunautes);

        
        switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        
        $html .= $head;
        foreach ($listeCommunautes as $communaute) {
            $html.= $item; 
            $html.="<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&communaute=".$communaute->getId()."'>".$communaute->getNom()."</a>"; 
            if($counter<$val){
                $html .= $sep;
            }
            $counter++;    
            $html.= $endItem; 
        }
        $html .= $foot;
        
        
        return $html;
    }
    
    /**
     * Renvoi la liste des régions 
     * si $contientDesRetraites = true : seules les régions contenant des retraites sont renvoyées
     * si $contientDesRetraites = false : Toutes les régions sont renvoyés
     * @param boolean $contientDesRetraites
     * @param string $typeAffichage (ul, p )
     * @return string
     */
    public static function getRegions($typeAffichage,$type){
        $html = "";
        if($type=="evenements"){
            $listeRegion = GeolocalisationActionDao::getRegionsEvenement(true);
            $lien = "evenement&filter=1&region=";
        }else if($type=="organisateurs"){
            $listeRegion = GeolocalisationActionDao::getRegionsOrganisateur(true);
            $lien = "organisateur&filter=1&Regions=";
        }
        
        $counter = 1;
        
        $val = count($listeRegion);
        
        switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        
        $html .= $head;
        foreach ($listeRegion as $region) {
            $html.= $item; 
            $html.="<a href='".$_ENV['properties']['Page']['defaultSite']."?page=".$lien.$region['Id']."' alt='Evénements catholique en ".$region['Nom']." avec SPIBOOK' title='Evénements catholique en ".$region['Nom']." avec SPIBOOK'>".$region['Nom']."</a>";            
           
            if($counter<$val){
                $html .= $sep;
            }
            
            $counter++;
            $html .= $endItem; 
        }
        $html .= $foot;
        return $html;
    }
    
    
    
    /**
     * Renvoi la liste pour le menu des themes
     * @param boolean $contientDesRetraites
     * @return string
     */
    public static function getThemes($contientDesRetraites,$typeAffichage){
        $html = "";
        
        if($contientDesRetraites){
            $listeThemes = ThemeAction::recupererThemesFromRetraites();
        }else{
            $listeThemes = ThemeAction::recupererThemes();
        }
        $counter = 1;
        $val = count($listeThemes);
        
        switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        $html .= $head;
        foreach ($listeThemes as $theme) {
            $html .= $item;
            $html.="<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&theme=".$theme->getId()."' alt='Evénements catholiques sur le theme : ".$theme->getNom()." avec SPIBOOK' title='Evénements catholiques sur le theme : ".$theme->getNom()." avec SPIBOOK'>".$theme->getNom()."</a>"; 
            if($counter<$val){
                $html .= $sep;
            }
            $counter++;
            $html .= $endItem;
            
        }
        $html .= $foot;
        
            
        
        return $html;
    }
    
    /**
     * Renvoi la liste pour le menu des themes
     * @param boolean $contientDesRetraites
     * @return string
     */
    public static function getLieux($contientDesRetraites,$typeAffichage){
        $html = "";
        
        if($contientDesRetraites){
            $listeLieux = LieuActionDao::listeLieuxFiltreRetraite();
        }else{
            $listeLieux = LieuActionDao::listerTousLieux();
            
        }
        $counter = 1;
        $val = count($listeLieux);
        
        switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        
        
        
        $html .= $head;
        foreach ($listeLieux as $lieu) {

            $html .= $item;
            $html.="<a href='".$_ENV['properties']['Page']['defaultSite']."?page=organisateurDetail&id=".$lieu->getId()."' alt='Les événements catholiques proposees par ".$lieu->getNom()." avec SPIBOOK' title='Les événements catholique proposees par ".$lieu->getNom()." avec SPIBOOK'>".$lieu->getNom()."</a>"; 
            if($counter<$val){
                $html .= $sep;
            }
            $counter++;
            $html .= $endItem;
            
        }
        $html .= $foot;
        
            
        
        return $html;
    }
    
    /**
     * Renvoi la liste pour le menu des themes
     * @param boolean $contientDesRetraites
     * @return string
     */
    public static function getDates($typeAffichage){
       
        switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        
        
        $html = $head;
        
        $html .= $item;
        $html .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&time=".TextStatic::getText("LienMenuCalendrierSemaine")."'>".TextStatic::getText("TitreMenuCalendrierSemaine")."</a>";
        $html .= $endItem.$sep;
        $html .= $item;
        $html .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&time=".TextStatic::getText("LienMenuCalendrierMois")."'>".TextStatic::getText("TitreMenuCalendrierMois")."</a>";
        $html .= $endItem.$sep;
        $html .= $item;
        $html .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&time=".TextStatic::getText("LienMenuCalendrierNextPeriod")."'>".TextStatic::getText("TitreMenuCalendrierNextPeriod")."</a>";
        $html .= $endItem.$sep;
        $html .= $foot;
        
        return $html;
    }
    
    public static function getSpibook($typeAffichage){
        
         switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        
        $html = $head;
        
        $html .= $item;
        $html .= "<a href='http://blog.spibook.com' target='_blank'>Le blog</a>";
        $html .= $endItem.$sep;
        $html .= $item;
        $html .= "<a href='http://blog.spibook.com/charte-dutilisation/' target='_blank'>La charte Spibook</a>";
        $html .= $endItem.$sep;
        $html .= $item;
        $html .= "<a href='http://blog.spibook.com/presentation/' target='_blank'>Le concept</a>";
        $html .= $endItem.$sep;
        $html .= $item;
        $html .= "<a href='http://blog.spibook.com/spibook-team/' target='_blank'>Qui sommes nous</a>";
        $html .= $endItem.$sep;
        $html .= $item;
        $html .= "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."'>Nous contacter</a>";
        $html .= $foot;
        
        return $html;
    }
     
    /**
     * Renvoi la liste des régions 
     * si $contientDesRetraites = true : seules les régions contenant des retraites sont renvoyées
     * si $contientDesRetraites = false : Toutes les régions sont renvoyés
     * @param boolean $contientDesRetraites
     * @param string $typeAffichage (ul, p )
     * @return string
     */
    public static function getTypesEvenements($contientDesRetraites,$typeAffichage){
        $html = "";
        
        $liste = TypeEvenementAction::listerTousLesTypes($contientDesRetraites);
        $counter = 1;
        
        $val = count($liste);
        
        switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        
        $html .= $head;
        foreach ($liste as $typeEvenement) {
            $html.= $item; 
            $html.="<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&typeEvenement=".$typeEvenement->getId()."' alt='Vos ".$typeEvenement->getLibelle()." avec SPIBOOK' title='Vos ".$typeEvenement->getLibelle()." avec SPIBOOK'>".$typeEvenement->getLibelle()."</a>";            
           
            if($counter<$val){
                $html .= $sep;
            }
            
            $counter++;
            $html .= $endItem; 
        }
        $html .= $foot;
        return $html;
    }
    
    
    
     /**
     * Renvoi la liste des régions 
     * si $contientDesRetraites = true : seules les régions contenant des retraites sont renvoyées
     * si $contientDesRetraites = false : Toutes les régions sont renvoyés
     * @param boolean $contientDesRetraites
     * @param string $typeAffichage (ul, p )
     * @return string
     */
    public static function getLiensExternes($typeAffichage){
        $html = "";
        
        $liste = MenuActionDao::recupererLesLiens();
        $counter = 1;
        
        $val = count($liste);
        
        switch ($typeAffichage) {
            case "ul":
                $head = "<ul class='listMenu'>";
                $item = "<li>";
                $endItem = "</li>";
                $foot = "</ul>";
                $sep = "";
                break;
            
            case "p":
                $head = "<p class='subMenuJustify'>";
                $item = "";
                $endItem = "";
                $foot = "</p>";
                $sep = " <span class='separatorMenu' style='color:silver;'>|</span> ";
                break;
            default:
                break;
        }
        
        $html .= $head;
        foreach ($liste as $lien) {
            $html.= $item; 
            $html.="<a href='".$lien[1]."' alt='Les événements Catholiques en France '".$lien[0]."' title='Les événements Catholiques en France '".$lien[0]."' target='_blank'>".$lien[0]."</a>";            
           
            if($counter<$val){
                $html .= $sep;
            }
            
            $counter++;
            $html .= $endItem; 
        }
        $html .= $foot;
        return $html;
    }
    
    
}


?>
