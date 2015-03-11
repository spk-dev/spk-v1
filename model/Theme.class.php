<?php


class Theme{
	
private $themeid;
private $themenom;
private $themedescription;
private $themeimage;
private $nbEvent;


public function __construct($Argthemeid,$Argthemenom,$Argthemedescription,$Argthemeimage){
    
	$this->themeid = $Argthemeid;
	$this->themenom = $Argthemenom;
	$this->themedescription = $Argthemedescription;
	$this->themeimage = $Argthemeimage;
}

public function getid(){
	return $this->themeid;
}
public function getnom(){
	return $this->themenom;
}
public function getdescription(){
	return $this->themedescription;
}
public function getimage(){
	return $this->themeimage;
}


public function setid($id){
	$this->themeid=$id;
}
public function setnom($nom){
	$this->themenom=$nom;
}
public function setdescription($description){
	$this->themedescription=$description;
}
public function setimage($image){
	$this->themeimage=$image;
}
	
public function getNbEvent() {
    return $this->nbEvent;
}

public function setNbEvent($nbEvent) {
    $this->nbEvent = $nbEvent;
}



}