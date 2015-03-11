<?php


class Intervenant{
	
	
private $intervenantid;
private $intervenantnom;
private $intervenantphoto;
private $intervenantdescription;
private $intervenantprenom;
private $intervenantmail;
private $intervenantgenre;
private $Intervenanttitre;

	
	
    /**
        * Constructeur d'une communaut�
        * @param 
        */
    public function __construct($Argintervenantid,$Argintervenantnom,$Argintervenantphoto,$Argintervenantdescription,$Argintervenantprenom,$Argintervenantmail,$Argintervenantgenre,$ArgIntervenanttitre){

            $this->intervenantid = $Argintervenantid;
            $this->intervenantnom = $Argintervenantnom;
            $this->intervenantdescription = $Argintervenantdescription;
            $this->intervenantprenom = $Argintervenantprenom;
            $this->intervenantmail = $Argintervenantmail;
            $this->intervenantgenre = $Argintervenantgenre;
            $this->Intervenanttitre = $ArgIntervenanttitre;
            $this->intervenantphoto = $Argintervenantphoto;
    }
	
    //GETTERS
    public function getId(){ return $this->intervenantid; }
    public function getNom(){ return $this->intervenantnom; }
    public function getPhoto(){ return $this->intervenantphoto; }
    public function getDescription(){ return $this->intervenantdescription; }
    public function getPrenom(){ return $this->intervenantprenom; }
    public function getMail(){ return $this->intervenantmail; }
    public function getGenre(){ return $this->intervenantgenre; }
    public function getTitre(){ return $this->Intervenanttitre; }
    public function getNomComplet(){return $this->Intervenanttitre." ".$this->intervenantprenom." ".$this->intervenantnom;}

    //SETTERS
    public function setId($id){ $this->intervenantid=$id; }
    public function setNom($nom){ $this->intervenantnom=$nom; }
    public function setPhoto($photo){ $this->intervenantphoto=$photo; }
    public function setDescription($description){ $this->intervenantdescription=$description; }
    public function setPrenom($prenom){ $this->intervenantprenom=$prenom; }
    public function setMail($mail){ $this->intervenantmail=$mail; }
    public function setGenre($genre){ $this->intervenantgenre=$genre; }
    public function setTitre($titre){ $this->Intervenanttitre=$titre; }
    
	
    	
	
}