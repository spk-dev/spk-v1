<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Slide
 *
 * @author Ben
 */
class Slide {
    //put your code here
    
    private $id;
    private $evenementId;
    private $lien;
    private $ordre;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getEvenementId() {
        return $this->evenementId;
    }

    public function setEvenementId($evenementId) {
        $this->evenementId = $evenementId;
    }

    public function getLien(){
        return $this->lien;
    }
    public function getLienCustos() {
        if($this->lien=="" || is_null($this->lien)){
            $this->lien = "index.php?page=evenementDetail&id=".$this->evenementId;
        }
        return $this->lien;
    }

    public function setLien($lien) {
        $this->lien = $lien;
    }

    public function getOrdre() {
        return $this->ordre;
    }

    public function setOrdre($ordre) {
        $this->ordre = $ordre;
    }


}

?>
