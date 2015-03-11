<?php

class TypeEvenementAction{
    
    /**
     * Récupère une liste d'objet TypeEvenement
     * @return type
     */
    public static function listerTousLesTypes($existeEvenements){
        return TypeEvenementActionDao::listerTousLesTypesEvenement($existeEvenements);
        
    }
    
    /**
     * Recupere en base un type
     * @param type $idType
     * @return type
     */
    public static function recupererUnType($idType){
        return TypeEvenementActionDao::recupererUnType($idType);
    }
    
    
//    public static function afficherTousLesTypesEvenements($gridNbCol,$limit,$withEvenements){
//            
//            $liste = self::listerTousLesTypes($withEvenements);
//            
//            
//            // AFFICHAGE DE l'ENTETE
//            
//            $nbCol = array("one","two","three","four","five","six","seven","height","nine","ten","eleven","twelve");
//            if(!is_null($gridNbCol)){
//                $nbcolToDisplay = $nbCol[$gridNbCol];
//            }else{
//                $nbcolToDisplay = $nbCol[1];
//            }
//
//            //BOUCLE SUR LES LIGNES
//            $display = "<ul class=\"block-grid ".$nbcolToDisplay."-up\"> ";
//            $i=0;
//            if(is_null($limit)){
//                $limit = count($liste);
//            }
//            foreach($liste as $type)
//            {
//                if($i<$limit){
//                    
//                    $display .="<li class='panel'>";
//                    $display.="<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&typeEvenement=".$type->getId()."' alt='Tous vos ".$type->getLibelle()." avec SPIBOOK' title='Tous vos ".$type->getLibelle()." avec SPIBOOK'>";
//                    $display .="<h5>".$type->getLibelle()."</h5>";            
//                    $filter = new RetraiteSearchCriteria();
//                    $filter->setEvenementType(array($type->getid()));
//                    $display .= "( ".RetraiteActionDao::getNbRetraites($filter)." événements liés)";
//                    $display .="</a></li>";
//                    $i++;
//                }
//                
//                
//                
//            }
//            $display .="</ul>";
//
//
//            return $display;
//		
//	}
}

?>
