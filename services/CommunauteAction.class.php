<?php

/**
 * 
 * @author bteillard
 *
 */
class CommunauteAction{

    public static function recupererCommunaute($idCommunaute){
        return CommunauteActionDao::recupererUneCommunaute($idCommunaute);
        
    }

    /**
        * Afficher tous les lieux
        */
    public static function afficherToutesLesCommunautes($gridNbCol){
            
            $listeCommunaute = CommunauteActionDao::listerToutesCommunautes(false);
            
            $nbCol = array("one","two","three","four","five","six","seven","height","nine","ten","eleven","twelve");
            if(!is_null($gridNbCol)){
                $nbcolToDisplay = $nbCol[$gridNbCol];
            }else{
                $nbcolToDisplay = $nbCol[1];
            }
            $display = "<ul class=\"block-grid ".$nbcolToDisplay."-up\"> ";

            foreach ($listeCommunaute as $communaute) {
                $img = HtmlUtilComponents::imageControl("communautes", $communaute->getPhoto(), 0);
                //$communaute = new Communaute();
                $display .="<li>
                            <a href='index.php?page=communauteDetail&id=".$communaute->getId()."'>
                                <img src='".$img."' title='.$communaute->getNom().' alt='.$communaute->getNom().' class='right'/>
                                <p class=\"ParagraphlisteHome\">";
                                    $display .="<a href='index.php?page=communauteDetail&id=".$communaute->getId()."'>".$communaute->getNom()."</a><br/>";
                                $display .="</p>
                            </a>
                        </li>";
            }
            $display .= "</ul>";
                           

            return $display;

    }

    /**
        * 
        * @param unknown_type $idRetraite
        */
    public static function afficherUneCommunaute($idCommunaute){

            $communauteToDisplay = self::recupererCommunaute($idCommunaute);

            $display ="<div>";

            $display .= "Id: ".$communauteToDisplay->getId()."<br>";
            $display .= "Nom:".$communauteToDisplay->getNom()."<br>";
            $display .= "Description:".$communauteToDisplay->getDescription()."<br>";
            $display .= "Adresse2: ".$communauteToDisplay->getPhoto()."<br>";

            $display .= "</div>";


            return $display;

    }

    /**
        * 
        * @param Evenement $retraite
        */
    public static function enregitrerCommunaute(Communaute $communaute){
            CommunauteActionDao::addCommunaute($communaute);	
    }

    /**
        * 
        * @param Evenement $retraite
        */
    public static function modifierCommunaute(Communaute $communaute){
            CommunauteActionDao::modifyCommunaute($communaute);
    }

    /**
        * 
        * @param Evenement $retraite
        */
    public static function effacerCommunaute($idCommunaute){
        
            // TESTER ICI S'Il RESTE DES LIEUX DE CETTE COMMUNAUTE
            // TESTER ICI S'IL RESTE DES INTERVENANTS DE CETTE COMMUNAUTE 

            // CommunauteDao::deleteCommunaute($idCommunaute);
        return $idCommunaute;
    }
	
}

?>