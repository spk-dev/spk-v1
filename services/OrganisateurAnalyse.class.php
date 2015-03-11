<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrganisateurAnalyse
 *
 * @author phwu963
 */
class OrganisateurAnalyse {
    
    
    /**
     * Détermine si le lieu contient le niveau min d'info pour pouvoir être validé
     * @param Lieu $lieu
     * @return boolean
     */
    public static function verificationNiveauMinimum(Lieu $lieu){
        $boo = true;
        $tabErreur = array();
        
        $tab = array();
        $tab['Nom'] = $lieu->getNom();
        $tab['Adresse'] = $lieu->getAdresseComplete();
        $tab['CodePostal'] = $lieu->getCp();
        $tab['Ville'] = $lieu->getVille();
        $tab['Description'] = $lieu->getDescription();
        $tab['Mail'] = $lieu->getMail();
        $tab['Photo'] = $lieu->getMainPhoto();
        
        
        foreach ($tab as $key => $value) {
            if($value=="" || is_null($value)){
                $boo=false;
                array_push($tabErreur, $key);
            }
        }
        
        if($boo){
            if(strlen($tab['Description'])<200){
               
                array_push($tabErreur, 'Description');
                $boo = false;
            }
        }
        
        
        return $boo;
        
    }
    
    /**
     * Renvoi le niveau de remplissage du dossier.
     * @param Lieu $lieu
     * @return int
     */
    public static function niveauPourcentage(Lieu $lieu){
        $val = 0;
        
        $tabCalcul = array();
        $tabCalcul['description']=0;
        $tabCalcul['Train']=0;
        $tabCalcul['Avion']=0;
        $tabCalcul['Voiture']=0;
        $tabCalcul['SiteWeb']=0;
        $tabCalcul['Hebergement']=0;
        $tabCalcul['Tel']=0;
        $tabCalcul['Fax']=0;
        $tabCalcul['Nom'] = 0;
        $tabCalcul['Adresse'] = 0;
        $tabCalcul['CodePostal'] = 0;
        $tabCalcul['Ville'] = 0;
        $tabCalcul['Description'] = 0;
        $tabCalcul['Mail'] = 0;
        $tabCalcul['Photo'] = 0;
        $tailleDescription = strlen($lieu->getDescription());

        if(!$lieu->getNom()==""             || !is_null($lieu->getNom()) || strlen(strip_tags($lieu->getNom(), '<p><br/>')>1)){ $tabCalcul['Nom']= 0.1;}
        if(!$lieu->getAdresseComplete()=="" || !is_null($lieu->getAdresseComplete()) || strlen(strip_tags($lieu->getAdresseComplete(), '<p><br/>')>1)){ $tabCalcul['Adresse']= 0.1;}
        if(!$lieu->getCp()==""              || !is_null($lieu->getCp()) || strlen(strip_tags($lieu->getCp(), '<p><br/>')>1)){ $tabCalcul['CodePostal']= 0.07;}
        if(!$lieu->getVille()==""           || !is_null($lieu->getVille()) || strlen(strip_tags($lieu->getVille(), '<p><br/>')>1)){ $tabCalcul['Ville']= 0.07;}
        if(!$lieu->getMail()==""            || !is_null($lieu->getMail()) || strlen(strip_tags($lieu->getMail(), '<p><br/>')>1)){ $tabCalcul['Mail']= 0.09;}
        if(!$lieu->getMainPhoto()==""       || !is_null($lieu->getMainPhoto()) || strlen(strip_tags($lieu->getMainPhoto(), '<p><br/>')>1)){ $tabCalcul['Photo']= 0.07;}
        if($tailleDescription > 600){
            $tabCalcul['description']=0.15;
        }else{
            $tabCalcul['description'] = ($tailleDescription/600)*0.15;
        }
        if(!$lieu->getTrain()==""           || !is_null($lieu->getTrain()) || strlen(strip_tags($lieu->getTrain(), '<p><br/>')>1)){ $tabCalcul['Train']= 0.05;}
        if(!$lieu->getAvion()==""           || !is_null($lieu->getAvion()) || strlen(strip_tags($lieu->getAvion(), '<p><br/>')>1)){$tabCalcul['Avion'] = 0.03;}
        if(!$lieu->getVoiture()==""         || !is_null($lieu->getVoiture()) || strlen(strip_tags($lieu->getVoiture(), '<p><br/>')>1)){$tabCalcul['Voiture'] = 0.08;}
        if(!$lieu->getLienSiteWeb()==""     || !is_null($lieu->getLienSiteWeb()) || strlen(strip_tags($lieu->getLienSiteWeb(), '<p><br/>')>1)){$tabCalcul['SiteWeb'] = 0.05;}
        if(!$lieu->getHebergement()==""     || !is_null($lieu->getHebergement()) || strlen(strip_tags($lieu->getHebergement(), '<p><br/>')>1)){ $tabCalcul['Hebergement']= 0.05;}
        if(!$lieu->getTel()==""             || !is_null($lieu->getTel()) || strlen(strip_tags($lieu->getTel(), '<p><br/>')>1)){$tabCalcul['Tel'] = 0.07;}
        if(!$lieu->getFax()==""             || !is_null($lieu->getFax()) || strlen(strip_tags($lieu->getFax(), '<p><br/>')>1)){$tabCalcul['Fax'] = 0.02;}

        foreach ($tabCalcul as $key => $value) {$val += $value;}
        
        
        return round($val,1);
    }
    
}

?>
