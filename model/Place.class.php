<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Place
 *
 * @author phwu963
 */
class Place {
    private $id;
    private $adresse1;
    private $adresse2;
    private $cp;
    private $ville;
    private $pays;
    private $lat;
    private $long;
    private $departement;
    private $region;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAdresse1() {
        return $this->adresse1;
    }

    public function setAdresse1($adresse1) {
        $this->adresse1 = $adresse1;
    }

    public function getAdresse2() {
        return $this->adresse2;
    }

    public function setAdresse2($adresse2) {
        $this->adresse2 = $adresse2;
    }

    public function getCp() {
        return $this->cp;
    }

    public function setCp($cp) {
        $this->cp = $cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function setVille($ville) {
        $this->ville = $ville;
    }

    public function getPays() {
        return $this->pays;
    }

    public function setPays($pays) {
        $this->pays = $pays;
    }

    public function getLat() {
        return $this->lat;
    }

    public function setLat($lat) {
        $this->lat = $lat;
    }

    public function getLong() {
        return $this->long;
    }

    public function setLong($long) {
        $this->long = $long;
    }

    public function getDepartement() {
        return $this->departement;
    }

    public function setDepartement($depCode, $depNom) {
        $this->departement = array($depCode,$depNom);
    }

    public function getRegion() {
        return $this->region;
    }

    public function setRegion($regionId, $regionNom) {
        $this->region = array($regionId, $regionNom);
    }

    public function isLatAndLong(){
        if($this->lat != "" && $this->long != ""){
            $boo = true;
        }else{
            $boo = false;
        }
        return $boo;
    }
    
    

}

?>
