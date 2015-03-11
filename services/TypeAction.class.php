<?php
/**
 * 
 * @author bteillard
 *
 */
class TypeAction{
	
    
	
	/**
	 * Afficher tous les lieux
	 */
	public static function afficherTousLesTypes(){
		
		// R�cup�re la liste de tous les champs de la table Lieu
		$tabCol = Type::dbFieldList();
			
		$listeType = TypeActionDao::listerTousLesTypes();
		
		
		// AFFICHAGE DE l'ENTETE
		$display = "<table class='standard'><tr>";
		foreach($tabCol as $value){
			$display .= "<th class='standardTh'>".$value."</th>";
		}
		$display .= "</tr>";
		
		//BOUCLE SUR LES LIGNES
		foreach($listeType as $elementType)
		{
			$display = $display."<tr class='standardTr'>";

			
			$display .="<td>".$elementType->getid()."</td>";
			$display .="<td>".$elementType->getnom()."</td>";
			$display .="<td>".$elementType->getdescription()."</td>";
                        $display .="<td><img width='60%' height:'60%' src='".$_ENV['properties']['Path']['imgPath']."Type/".$elementType->getphoto()."'/></td>";
		
			$display .="</tr>";
		}
		$display .= "</table>";
		
		
		return $display;
		
	}
	
        /**
	 * 
	 * @param unknown_type $idRetraite
	 */
	public static function recupererType($idType){
		return TypeActionDao::recupererUnType($idType);
		
	}

	/**
	 * 
	 * @param unknown_type $idRetraite
	 */
	public static function afficherUneType($idType){
		
		$typeToDisplay = self::recupererType($idType);
		
		$display ="<div>";
		
		$display .= "Id: ".$typeToDisplay->getid()."<br>";
		$display .= "Nom:".$typeToDisplay->getnom()."<br>";
		$display .= "Description:".$typeToDisplay->getdescription()."<br>";
		$display .= "Photo: ".$typeToDisplay->getphoto()."<br>";
		
		$display .= "</div>";
		
		
		return $display;
		
	}

	
	/**
	 * 
	 * @param Evenement $retraite
	 */
	public static function enregitrerType(Type $type){
           
		TypeDao::addType($type);	
	}
	
	/**
	 * 
	 * @param Evenement $retraite
	 */
	public static function modifierType(Type $type){
		
		TypeDao::modifyType($type);
	}
	
	/**
	 * 
	 * @param Evenement $retraite
	 */
	public static function effacerType($idType){
		// TESTER ICI S'Il RESTE DES LIEUX DE CETTE COMMUNAUTE
		// TESTER ICI S'IL RESTE DES INTERVENANTS DE CETTE COMMUNAUTE 
		
		TypeDao::deleteType($idType);
	}
	
}

?>