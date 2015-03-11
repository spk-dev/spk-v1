<?php
/**
 * 
 * @author bteillard
 *
 */
class TypeEvenementActionDao{
	
    
    
        /**
         * Récupérer une liste de tous les types
         * @return array 
         */
        public static function listerTousLesTypesEvenement($existeEvenements){
            AppLog::ecrireLog("Rentre dans selectTypeEvent", "debug");
            if($existeEvenements){
                $req = TypeEvenementQuery::listerTypesPourEvenementExistant();
            }else{
                $req = TypeEvenementQuery::listerTypes();
            }
            $tabListeType = array();
           
           foreach ($req as $data){
               
               $type= new TypeEvenement();
               $type->setId($data[Db::getParam("tev","Id")]);
               $type->setLibelle($data[Db::getParam("tev","Libelle")]);
               $type->setPhoto($data[Db::getParam("tev","Photo")]);
               $type->setDescription($data[Db::getParam("tev","Description")]);
               
               array_push($tabListeType, $type);
               
           }
           
           return $tabListeType;
        }
		
	/**
	 * Récupérer un type en fonction de son ID
	 * @param unknown_type $idRetraite
	 * @return Evenement
	 */
	public static function recupererUnType($idType){
		// R�cup�re la liste de tous les champs de la table Lieu
		
		$req = TypeEvenementQuery::recupererUnType($idType);
	
		foreach ($req as $data)
		{
                    $type= new TypeEvenement();
                    $type->setId($data[Db::getParam("tev","Id")]);
                    $type->setLibelle($data[Db::getParam("tev","Libelle")]);
                    $type->setPhoto($data[Db::getParam("tev","Photo")]);
                    $type->setDescription($data[Db::getParam("tev","Description")]);
		}
	
		return $type;
	}

	
}

?>