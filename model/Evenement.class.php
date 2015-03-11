<?php


/**
 * 
 * @author Ben
 * @param 
 */


class Evenement{
	
	private $id;
	private $nom;
	private $description;
        private $mailInscription;
        private $coordInscription;
	private $dateDebut;
	private $dateFin;
	private $mainPhoto;
	private $prix;
	private $garderie;
	private $hebergement;
	private $lieu;
        private $intervenants = array();
        private $typeEvenement;
        private $dateEnregistrement;
	private $theme = array();
        private $place;

        
 
         public function getMailInscription() {
            return $this->mailInscription;
        }

        public function setMailInscription($mailInscription) {
            $this->mailInscription = $mailInscription;
        }

        public function getCoordInscription() {
            return $this->coordInscription;
        }

        public function setCoordInscription($coordInscription) {
            $this->coordInscription = $coordInscription;
        }

        public function getDateEnregistrement() {
            return $this->dateEnregistrement;
        }

        public function setDateEnregistrement($dateEnregistrement) {
            $this->dateEnregistrement = $dateEnregistrement;
        }

        public function getTheme() {
            return $this->theme;
        }

        public function setTheme($theme) {
            $this->theme = $theme;
        }



        		
	/*
	 *  GETTERS
	 */
	
	public function getId(){ 
		return $this->id;	
	}
	
	
	public function getNom(){
		return $this->nom;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function getDateDebut(){
		return $this->dateDebut;
	}

        
                
        public function getDateDebutFormated(){
                $ddeb = new DateTime($this->getDateDebut());
		$html = $ddeb->format("d/m/Y à H\hi:s");
                return $html;
        }
        
        public function getDateFinFormated(){
                $dfin = new DateTime($this->getDateFin());
                $html = $dfin->format("d/m/Y à H\hi:s");
                return $html;
        }
        
        public function getDateDebutFormatedCourt(){
                $ddeb = new DateTime($this->getDateDebut());
		$html = $ddeb->format("d/m/Y");
                return $html;
        }
        
        public function getDateFinFormatedCourt(){
                $dfin = new DateTime($this->getDateFin());
                $html = $dfin->format("d/m/Y");
                return $html;
        }
	
	public function getDateFin(){
		return $this->dateFin;
	}
        
	
        
	public function getMainPhoto(){
		return $this->mainPhoto;
	}
	
	public function getPrix(){
		return $this->prix;
	}
        
        public function getPrixFormated(){
                $html= "";
                $devise = "€";
                if($this->prix == "" || is_null($this->prix)){
                    $html = "Participation libre";
                }else if($this->prix === "0"){
                    $html = "Pas de participation financière requise";
                }else if(is_numeric($this->prix)){
                    $html = "Participation financière : ".$this->prix." ".$devise;
                }else{
                    $html = $this->prix;
                }
                return $html;
        }
        
	
	public function getGarderie(){
		return $this->garderie;
	}
        
        public function getGarderieFormated(){
                $html ="";
                if($this->garderie==1){
                    $html = "Garde d'enfant prévue sur place";
                }else{
                    $html = "";
                }
            return $html;
        }
	
	public function getHebergement(){
		return $this->hebergement;
	}
        
        public function getHebergementFormated(){
                $html ="";
                if($this->hebergement==1){
                    $html = "Hébergement sur place possible";
                }else{
                    $html = "Pas de possibilité d'hébergement sur place";
                }
            return $html;
        }
        
	
	public function getLieu(){
		return $this->lieu;
	}
	
        public function getIntervenants(){
                return $this->intervenants;
        }
	
	/*
	 * SETTERS
	 */
	
	/**
	 *
	 * @param String $NomRetraite
	 */
	public function setId($IdRetraite){
		$this->id = $IdRetraite;
	}
	
	/**
	 * 
	 * @param String $NomRetraite
	 */
	public function setNom($NomRetraite){
		$this->nom = $NomRetraite;
	}
	
	/**
	 * 
	 * @param String $descRetraite
	 */
	public function setDescription($descRetraite){
		$this->description = $descRetraite;
	}
	
	/**
	 * 
	 * @param Date $dateRetraiteDebut
	 */
	public function setDateDebut($dateRetraiteDebut){
                $this->dateDebut = $dateRetraiteDebut;

	}
	
	/**
	 * 
	 * @param Date $dateRetraiteFin
	 */
	public function setDateFin($dateRetraiteFin){

            $this->dateFin = $dateRetraiteFin;
	}
	
	/**
	 * 
	 * @param String $photoNom
	 */
	public function setMainPhoto($photoNom){
		$this->mainPhoto = $photoNom;
	}
	
	/**
	 * 
	 * @param Int $prixRetraite
	 */
	public function setPrix($prixRetraite){
	 	$this->prix = $prixRetraite;
	}
	
	/**
	 * 
	 * @param Boolean $booGarderie
	 */
	public function setGarderie($booGarderie){
		$this->garderie =$booGarderie;
	}
	
	/**
	 * 
	 * @param Boolean $booHebergement
	 */
	public function setHebergement($booHebergement){
		$this->hebergement = $booHebergement;
	}
	
	/**
	 * 
	 * @param Int $idLieu
	 */
	public function setLieu($idLieu){
		$this->lieu = $idLieu;
	}
	
	public function setIntervenants($interv){
                $this->intervenants = $interv;
        }
        
        
        public function getTypeEvenement() {
            return $this->typeEvenement;
        }

        public function setTypeEvenement($typeEvenement) {
            $this->typeEvenement = $typeEvenement;
        }

        public function __toString() {
            return $this->nom." ".$this->dateDebut." - ".$this->dateFin;
        }

        public function getPlace() {
            return $this->place;
        }

        public function setPlace($place) {
            $this->place = $place;
        }

        public function isPassed(){
            $booIsPassed = false;
            $dateFin = new DateTime($this->dateFin, new DateTimeZone('Europe/Paris'));
            $auj = new DateTime();
            if($dateFin->format('Y-m-d') < $auj->format('Y-m-d')){
                $booIsPassed = true;
            }
            return $booIsPassed;
        }
        
}
?>