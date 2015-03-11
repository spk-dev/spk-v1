<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class User{
    
    private $id;
    private $login;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $tel1;
    private $tel2;
    private $optIn;
    private $profil;    
    private $newsletter;

        /**
     * Constructor
     * @param type $nom
     * @param type $prenom
     * @param type $mail
     * @param type $password
     * @param type $tel1
     * @param type $tel2
     * @param type $optIn
     * @param type $profil 
     */
    function __construct($id, $login, $nom, $prenom, $mail, $password, $tel1, $tel2, $optIn, $profil,$newsletter) {
        $this->id = $id;
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mail = $mail;
        $this->password = $password;
        $this->tel1 = $tel1;
        $this->tel2 = $tel2;
        $this->optIn = $optIn;
        $this->profil = $profil;
        $this->newsletter = $newsletter;
        
        
    }

    public function getNewsletter(){
        return $this->newsletter;
    }
    
    public function setNewsletter($newsletter){
        $this->newsletter = $newsletter;
    }
    
    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getId() {
        return $this->id;
    }
      
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function setMail($mail) {
        $this->mail = $mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getTel1() {
        return $this->tel1;
    }

    public function setTel1($tel1) {
        $this->tel1 = $tel1;
    }

    public function getTel2() {
        return $this->tel2;
    }

    public function setTel2($tel2) {
        $this->tel2 = $tel2;
    }

    public function getOptIn() {
        return $this->optIn;
    }

    public function setOptIn($optIn) {
        $this->optIn = $optIn;
    }

    public function getProfil() {
        return $this->profil;
    }

    public function setProfil($profil) {
        $this->profil = $profil;
    }


    //FIELDS
/**
 * @return Tableau de tous les champs de la DB
 */
public static function  dbFieldList(){
	$tabColUser = array();
        $tabColUser[0]= 'user-id';
        $tabColUser[1]= 'user-login';
        $tabColUser[2]= 'user-nom';
        $tabColUser[3]= 'user-prenom';
        $tabColUser[4]= 'user-mail';
        $tabColUser[5]= 'user-password';
        $tabColUser[6]= 'user-tel1';
        $tabColUser[7]= 'user-tel2';
        $tabColUser[8]= 'user-optin';
        $tabColUser[9]= 'Profil_profil-id';
        $tabColUser[10]= 'user-newsletter';
     return $tabColUser;
	
}

/**
 *
 * @return string 
 */
public function __toString() {
    
    $tostring = "Nom : ".$this->nom." <br/>Prenom : ".$this->prenom."<br/>Login : ".$this->login." <br/>Pass : ".$this->password."<br/>";
    $tostring .= "Mail : ".$this->mail;
    $tostring .= "Tel1 : ".$this->tel1." <br/>Tel2 : ".$this->tel2." <br/>";
    $tostring .= "OptIn : ".$this->optIn." <br/>Profil : ".$this->profil;
    $tostring .= "<br/>Newsletter : ".$this->newsletter;
    
    return $tostring;
}   

}




?>
