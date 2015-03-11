<?php

class DiaporamaActionDao{

    public static function getItemsPourDiaporama(){
        $req = DiaporamaQueryDao::getItemsPourDiaporama();
        $listeItem = array();
        $i=0;
        foreach ($req as $data)
        {
            $slide = new Slide();
            $slide->setId($data[Db::getParam("dia","Id")]);
            $slide->setEvenementId($data[Db::getParam("dia","EvenementId")]);
            $slide->setLien($data[Db::getParam("dia","Lien")]);
            $slide->setOrdre($data[Db::getParam("dia","Ordre")]);
            
            $listeItem[$i] = $slide;
            $i++;
        }
        return $listeItem;
    }
    
    
    public static function retirerEvenementDiaporama($idRetraite){
        return DiaporamaQueryDao::deleteEvenementDiapo($idRetraite);
    }
    
}



?>
