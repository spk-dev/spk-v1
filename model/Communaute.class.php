<?php


class Communaute{
	
	
	private $idCommunaute;
	private $nomCommunaute;
	private $descriptionCommunaute;
	private $photoCommunaute;
	
	
	
	/**
	 * Constructeur d'une communaut�
	 * @param 
	 */
	public function __construct($argId, $argNom,$argDescription, $argPhoto ){
	
		$this->idCommunaute=$argId;
		$this->nomCommunaute=$argNom;
		$this->descriptionCommunaute=$argDescription;
		$this->photoCommunaute=$argPhoto;
	}
	
//GETTERS
	public function getId(){
		return $this->idCommunaute;
	}
	public function getNom(){
		return $this->nomCommunaute;
	}
	public function getDescription(){
		return $this->descriptionCommunaute;
	}
	public function getPhoto(){
		return $this->photoCommunaute;
	}

//SETTERS
	public function setId($id){
		$this->idCommunaute = $id;
	}
	
	public function setNom($nom){
		$this->nomCommunaute = $nom;
	}
	
	public function setDescription($desc){
		$this->descriptionCommunaute = $desc;
	}
	public function setPhoto($photo){
		$this->photoCommunaute =$photo;
	}
	
//DB FIELDS
	/**
	 * @return Tableau de tous les champs de la DB
	 */
	public static function  dbFieldList(){
		$tabColCommunaute = array();
		$tabColCommunaute[0] = "communaute-id";
		$tabColCommunaute[1] = "communaute-nom";
		$tabColCommunaute[2] = "communaute-description";
		$tabColCommunaute[3] = "communication-photo";
		
		return $tabColCommunaute;
	}	
	
}