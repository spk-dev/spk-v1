<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Administrateur{
    
 private $Id;
 private $Nom;
 private $Prenom;
 private $Mail;
 private $Tel;
 private $Role;
 private $Lieux;
 private $LastConnection;
 private $Password;
 
// function __construct($Id, $Nom, $Prenom, $Mail, $Tel, $Role, $Lieux, $dateLastConnection) {
//     $this->Id = $Id;
//     $this->Nom = $Nom;
//     $this->Prenom = $Prenom;
//     $this->Mail = $Mail;
//     $this->Tel = $Tel;
//     $this->Role = $Role;
//     $this->Lieux = $Lieux;
//     $this->LastConnection = $dateLastConnection;
// }

 public function getId() {
     return $this->Id;
 }

 public function setId($Id) {
     $this->Id = $Id;
 }

 public function getNom() {
     return $this->Nom;
 }

 public function setNom($Nom) {
     $this->Nom = $Nom;
 }

 public function getPrenom() {
     return $this->Prenom;
 }

 public function setPrenom($Prenom) {
     $this->Prenom = $Prenom;
 }

 public function getMail() {
     return $this->Mail;
 }

 public function setMail($Mail) {
     $this->Mail = $Mail;
 }

 public function getTel() {
     return $this->Tel;
 }

 public function setTel($Tel) {
     $this->Tel = $Tel;
 }

 public function getRole() {
     return $this->Role;
 }

 public function setRole($Role) {
     $this->Role = $Role;
 }

 public function getLieux() {
     return $this->Lieux;
 }

 public function setLieux($Lieux) {
     $this->Lieux = $Lieux;
 }
 
 public function getLastConnection() {
     return $this->LastConnection;
 }

 public function setLastConnection($LastConnection) {
     $this->LastConnection = $LastConnection;
 }

  
 public function getInfos() {
 
     $html = "(".$this->Id.") ".$this->Prenom." ".$this->Nom;
     $html .= "Last connect : ".$this->LastConnection;
     $html .= "<br/>Liste des lieux : <br/>";
     foreach ($this->Lieux as $lieu) {
         $html.=$lieu.", ";
         
     }
     return $html;
 }
 
 public function getNomComplet(){
     return $this->Prenom." ".$this->Nom;
 }

 public function getPassword() {
     return $this->Password;
 }

 public function setPassword($password) {
     $this->Password = $password;
 }



}
?>
