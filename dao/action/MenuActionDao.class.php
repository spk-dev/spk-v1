<?php

class MenuActionDao{
    
        public static function recupererLesLiens(){
		// Récupére la liste de tous les champs de la table Lieu
		
		$req = MenuQueryDao::getLiens();
	
                $listelieux = array();
		foreach ($req as $data)
		{
                    $tab = array($data[Db::getParam("lis","Libelle")],$data[Db::getParam("lis","Lien")]);
                    array_push($listelieux, $tab);
                }
	
		return $listelieux;
	}    
}


?>
