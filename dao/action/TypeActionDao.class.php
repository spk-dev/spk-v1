<?php
/**
 * 
 * @author bteillard
 *
 */
class TypeActionDao{
	
        /**
         * Récupérer une liste de tous les types
         * @return array 
         */
        public static function listerTousLesTypes(){
            $req = TypeQueryDao::getAllTypes();
            $tabListeType = array();
           
           foreach ($req as $data){
               $type = new Type($data[Db::getParam("typ","Id")], $data[Db::getParam("typ","Nom")], $data[Db::getParam("typ","Description")], $data[Db::getParam("typ","Photo")]);     
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
		
		$req = TypeQueryDao::getOneType($idType);
	
		foreach ($req as $data)
		{
                    $type = new Type($data[Db::getParam("typ","Id")], $data[Db::getParam("typ","Nom")], $data[Db::getParam("typ","Description")], $data[Db::getParam("typ","Photo")]);
		}
	
		return $type;
	}

	/**
	 * 
	 * @param Retraite $retraite
	 */
//	public static function enregitrerType(Type $type){
//           
//		TypeDao::addType($type);	
//	}
	
	/**
	 * 
	 * @param Retraite $retraite
	 */
//	public static function modifierType(Type $type){
//		
//		TypeDao::modifyType($type);
//	}
	
	/**
	 * 
	 * @param Retraite $retraite
	 */
//	public static function effacerType($idType){
//		// TESTER ICI S'Il RESTE DES LIEUX DE CETTE COMMUNAUTE
//		// TESTER ICI S'IL RESTE DES INTERVENANTS DE CETTE COMMUNAUTE 
//		
//		TypeDao::deleteType($idType);
//	}
	
}

?>