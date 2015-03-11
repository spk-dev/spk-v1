<?php

class Type{
	
public function __construct($Argtypeid=null,$Argtypenom=null,$Argtypedescription=null,$Argtypephoto=null){
	$this->typeid = $Argtypeid;
	$this->typenom = $Argtypenom;
	$this->typedescription = $Argtypedescription;
	$this->typephoto = $Argtypephoto;	
}

//GETTERS
public function getid(){
	return $this->typeid;
}
public function getnom(){
	return $this->typenom;
}
public function getdescription(){
	return $this->typedescription;
}
public function getphoto(){
    return $this->typephoto;
}


//SETTERS
public function setid($id){
	$this->typeid=$id;
}
public function setnom($nom){
	$this->typenom=$nom;
}
public function setdescription($description){
	$this->typedescription=$description;
}
public function setphoto($photo){
	$this->typephoto=$photo;
}

//FIELDS
/**
 * @return Tableau de tous les champs de la DB
 */
public static function  dbFieldList(){
	$tabColIntervenant = array();
	$tabColIntervenant[0]='type-id';
	$tabColIntervenant[1]='type-nom';
	$tabColIntervenant[2]='type-description';
	$tabColIntervenant[3]='type-photo';

	return $tabColIntervenant;
	
}

}