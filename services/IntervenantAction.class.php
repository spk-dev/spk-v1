<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class IntervenantAction{

       
    /**
     * Afficher tous les intervenants
     * @return string
     */
    public static function afficherTousLesIntervenants(){
            
            $listeIntervenant = IntervenantActionDao::listerIntervenants();
            // AFFICHAGE DE l'ENTETE
            

            //BOUCLE SUR LES LIGNES
            $display = "<ul class=\"block-grid four-up\"> ";
            foreach($listeIntervenant as $elementIntervenant)
            {
                $img = HtmlUtilComponents::imageControl("intervenants", $elementIntervenant->getPhoto(), 1);
                
                $display .="<li><a href=\"index.php?page=intervenantDetail&Intervenant=".$elementIntervenant->getId()."\">";
                $display .= $elementIntervenant->getNomComplet();	
                $display .="<img src='".$img."' title='title1' alt='tag alt1' style=\"float:left;\"/>";
                $display .="</a></li>";
                
            }
            $display .="</ul>";


            return $display;
    }
    
    /**
        *  Affiche une liste de vignettes avec tous les intervenants
        * @param type $tabRetraites 
        */
    public static function afficherVignettesIntervenantsFromRetraites($tabRetraites){
        
        $display = "";

        if(sizeof($tabRetraites)>0){
            $intervenants = IntervenantActionDao::listerIntervenantsFromSelectedRetraites($tabRetraites);
            foreach ($intervenants as $intervenant) {
//                $intervenant = new Intervenant($Argintervenantid, $Argintervenantnom, $Argintervenantphoto, $Argintervenantdescription, $Argintervenantprenom, $Argintervenantmail, $Argintervenantgenre, $ArgIntervenanttitre);
                $img = HtmlUtilComponents::imageControl("intervenants", $intervenant->getPhoto(), 1);

                $display .="<div style='width:90px; float:left; margin:1%;'>";
                $display .=" <a href='index.php?page=intervenantDetail&Intervenant=".$intervenant->getId()."'>";
                $display .="<img class='mosaiqueInterv' src='".$img."' alt = \"".$intervenant->getNom()."\"/>";
                $display .= "<p style='float:left;'>".substr($intervenant->getPrenom(), 0,1).". ".$intervenant->getNom()."</p>";
                $display .="</a>";
                $display .="</div>";

            }
        }

        return $display;
    }

    /**
         * Afficher la liste ou la grille des themes
         * @param int $gridNbCol (1 pour liste)
         * @param int $limit (ou null pour pas de limite)
         * @param int $idRetraites ou null;
         * @return html
         */
	public static function afficherGridIntervenants($gridNbCol,$limit,$idRetraite){
            
            if(is_null($idRetraite)){
                $listeIntervenant = IntervenantActionDao::listerIntervenants();
            }else if(is_array ($idRetraite)){
                $listeIntervenant = IntervenantActionDao::listerIntervenantsFromSelectedRetraites($idRetraite);
            }else{
                $listeIntervenant = IntervenantActionDao::recupererIntervenantsForRetraite($idRetraite);
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
                $limit = count($listeIntervenant);
            }
            foreach($listeIntervenant as $elementIntervenant)
            {
                if($i<$limit){
                    
                    $img = HtmlUtilComponents::imageControl("intervenants", $elementIntervenant->getPhoto(), 1);
                    $display .="<li><a href=\"index.php?page=intervenantDetail&Intervenant=".$elementIntervenant->getId()."\">";
//                    $display .= $elementTheme->getnom();	
                    $display .="<img class='imgCaptionFixed' src='".$img."' title='".$elementIntervenant->getNomComplet()."' alt='".$elementIntervenant->getNomComplet()."' />";
                    $display .="</a></li>";
                    $i++;
                }
                
                
                
            }
            $display .="</ul>";


            return $display;
		
	}

    /**
     *  Affiche le nom complet de l'intervenant passé en parametre
     * @param Intervenant $intervenant
     * @return string 
     */
    public static function afficherNomComplet(Intervenant $intervenant){
            $display = "";
            $display .= $intervenant->getTitre()." ".$intervenant->getPrenom()." ".strtoupper($intervenant->getNom());
            return $display;
        }
        
        
    /**
     * Enregistre un intervenant dans la base
     * @param Intervenant $intervenant 
     */    
    public static function enregistrerIntervenant(array $tab, $idAdmin){
       
        $Argintervenantnom          = SecurityUtil::securVarParam($tab['nom']);
        $Argintervenantprenom       = SecurityUtil::securVarParam($tab['prenom']);
        $Argintervenantdescription  = SecurityUtil::securVarParam($tab['description']);
        $Argintervenantmail         = SecurityUtil::securVarParam($tab['mail']);
        $Argintervenantphoto        = SecurityUtil::securVarParam($tab['photo']['tmp_name']);
        $Argintervenantgenre        = SecurityUtil::securVarParam($tab['genre']);
        $ArgIntervenanttitre        = SecurityUtil::securVarParam($tab['titre']);
        $intervenant = new Intervenant(null, $Argintervenantnom, $Argintervenantphoto, $Argintervenantdescription, $Argintervenantprenom, $Argintervenantmail, $Argintervenantgenre, $ArgIntervenanttitre);
        
        
        return IntervenantActionDao::ajouterIntervenant($intervenant, $idAdmin);
    }    
    
    
    
    public static function getListeIntervenantJson($text){
        
        $tab = IntervenantActionDao::searchIntervenant($text);
        $answer = array();
        if(count($tab)==0){
            $answer[] = array("id"=>"0","text"=>"No Results Found..");
        }else{
            foreach ($tab as $value) {
                AppLog::ecrireLog("id = ".$value['id']." , text = ".$value['nom'], "debug");
                $answer[] = array("id"=>$value['id'],"text"=>$value['nom']);
            }
        }
        return $answer;
        
    }
    
}

?>
