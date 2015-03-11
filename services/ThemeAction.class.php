<?php

/**
 * 
 * @author bteillard
 *
 */
class ThemeAction{
	
    
    
        public static function recupererRetraiteFromTheme($idTheme){
            
//            $req = ThemeQueryDao::getRetraitesForTheme($idTheme);
//            $tabIdRetraiteTheme = array();
//            while($data = mysql_fetch_array($req)){
//                array_push($tabIdRetraiteTheme, $data[Db::get("tre","RetraiteId")]);
//            }
            $tabIdRetraiteTheme = ThemeActionDao::recupererRetraiteFromTheme($idTheme);
            
            return $tabIdRetraiteTheme;
        }
    
       
   
        /**
        * Récupérer un tableau contenant tous les themes 
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemesFromRetraites(){

            $tabTheme = ThemeActionDao::recupererThemesFromRetraites();
            return $tabTheme;
        }
    
        /**
        * Récupérer un tableau contenant tous les themes 
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemesFromRetraites2($start, $end, $order,$sens){
            
            $tabTheme = ThemeActionDao::recupererThemesFromRetraites2($start, $end, $order,$sens);
            return $tabTheme;
        }
        /**
        * Récupérer un tableau contenant tous les themes 
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemes(){

        $tabTheme = ThemeActionDao::recupererThemes();
        return $tabTheme;
    }
    
        /**
        * Récupérer les themes d'une retraite
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemesForRetraite($idRetraite){
            $tabTheme = EvenementActionDao::getThemesPourUnEvenement($idRetraite);
            return $tabTheme;
    }

	
	
	/**
         * Afficher la liste ou la grille des themes
         * @param int $gridNbCol (1 pour liste)
         * @param int $limit (ou null pour pas de limite)
         * @param int $idRetraites ou null;
         * @return html
         */
	public static function afficherTousLesThemes($gridNbCol,$limit,$idRetraites){
            
            if(is_null($idRetraites)){
                $listeTheme = ThemeActionDao::recupererThemes();
            }else{
                $listeTheme = ThemeActionDao::recupererThemesForRetraite($idRetraites);
            }
            
            
            // AFFICHAGE DE l'ENTETE
            
            $nbCol = array("one","two","three","four","five","six","seven","height","nine","ten","eleven","twelve");
            if(!is_null($gridNbCol)){
                $nbcolToDisplay = $nbCol[$gridNbCol];
            }else{
                $nbcolToDisplay = $nbCol[1];
            }

            //BOUCLE SUR LES LIGNES
            $display = "<ul class=\"block-grid ".$nbcolToDisplay."-up\"> ";
            $i=0;
            if(is_null($limit)){
                $limit = count($listeTheme);
            }
            foreach($listeTheme as $elementTheme)
            {
                if($i<$limit){
                    $img = HtmlUtilComponents::imageControl("themes", $elementTheme->getImage(), 1);
                    $display .="<li><a href=\"index.php?page=themeDetail&themeId=".$elementTheme->getId()."\">";
//                    $display .= $elementTheme->getnom();	
                    $display .="<img class='imgCaptionFixedTheme' src='".$img."' title='".$elementTheme->getnom()."' alt='".$elementTheme->getnom()."' />";
                    $display .="</a></li>";
                    $i++;
                }
                
                
                
            }
            $display .="</ul>";


            return $display;
		
	}
        
        
            
	/**
	 * 
	 * @param unknown_type $idRetraite
	 * @return Evenement
	 */
	public static function recupererUnTheme($idTheme){

	
                $Theme = ThemeActionDao::recupererUnTheme($idTheme);
                
		return $Theme;
	}	
	
	
         /**
        *  Affiche une liste de vignettes avec tous les intervenants
        * @param type $tabRetraites 
        */
    public static function afficherVignettesThemesFromRetraites($idRetraites){
        
        $display = "";

        $listeThemes = self::recupererThemesForRetraite($idRetraites);
        foreach ($listeThemes as $theme) {
            
            $img = HtmlUtilComponents::imageControl("themes", $theme->getimage(), 0);

            $display .="<div'>";
            $display .=" <a href='index.php?page=themeDetail&themeId=".$theme->getid()."'>";
            $display .="<img class='imgCaptionFixed' src='".$img."' alt = \"".$theme->getnom()."\"/>";
            $display .= "<p style='float:left;'>".$theme->getnom()."</p>";
            $display .="</a>";
            $display .="</div>";

        }

        return $display;
    }
        
	
}

?>