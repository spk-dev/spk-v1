<?php


/**
 * 
 * @author Ben
 * @param 
 */


class Lieu{
	
	private $id;
	private $nom;
	private $adresse1;
	private $adresse2;
	private $cp;
	private $ville;
        private $pays;
	private $description;
        private $hebergement;
	private $mainphoto;
	private $accesVoiture;
        private $accesAvion;
        private $accesTrain;
	private $lienSiteweb;
	private $mail;
        private $tel;
        private $fax;
	private $Type_typeId;
	private $Communaute_communauteId;
	private $Administrateur_administrateurId;
        private $galerie;
        private $dateEnregistrement;
        private $lat;
        private $long;
        private $validationAdmin;
        private $validationSuperAdmin;
        private $departement;
        private $region;
        private $nbEvent;
        private $nbEventAVenir;
	private $place;
	
	/**
	 * Constructeur d'une Lieu
	 * @param Int id
	 */
//	public function __construct($ArgId,$ArgNom,$ArgAdresse1,$ArgAdresse2,$ArgCp,$ArgVille,$ArgPays,$ArgDesc,
//                $ArgHebergement,$ArgMainPhoto,$ArgAccesTrain,$ArgAccesVoiture,$ArgAccesAvion,$ArgLienSiteWeb,
//                $ArgMail,$ArgTel, $ArgFax, $ArgTypeId,$ArgCommunauteId,$ArgAdminId, $ArgGalerie,$ArgDateEnregistrement, 
//                $ArgLat, $ArgLong, $ArgValidationAdmin, $ArgValidationSuperAdmin){
//		
//		$this->id = $ArgId;
//		$this->nom = $ArgNom;
//		$this->adresse1 = $ArgAdresse1;
//		$this->adresse2 = $ArgAdresse2;
//		$this->cp = $ArgCp;
//		$this->ville = $ArgVille;
//                $this->pays = $ArgPays;
//		$this->description = $ArgDesc;
//                $this->hebergement = $ArgHebergement;
//		$this->mainphoto = $ArgMainPhoto;
//		$this->accesTrain = $ArgAccesTrain;
//		$this->accesVoiture = $ArgAccesVoiture;
//		$this->accesAvion = $ArgAccesAvion;
//		$this->lienSiteweb = $ArgLienSiteWeb;
//		$this->mail = $ArgMail;
//                $this->tel = $ArgTel;
//                $this->fax = $ArgFax;
//		$this->Type_typeId = $ArgTypeId;
//		$this->Communaute_communauteId = $ArgCommunauteId;
//		$this->Administrateur_administrateurId = $ArgAdminId;
//                $this->galerie = $ArgGalerie;
//                $this->dateEnregistrement = $ArgDateEnregistrement;
//                $this->lat = $ArgLat;
//                $this->long = $ArgLong;
//                $this->validationAdmin = $ArgValidationAdmin;
//		$this->validationSuperAdmin = $ArgValidationSuperAdmin;
//	}

		/*
	 *  GETTERS
	 */
	
	public function getId(){ 
		return $this->id;	
	}
	
	
	public function getNom(){
		return $this->nom;
	}
	
	public function getAdresse1(){
		return $this->adresse1;
	}

	public function getAdresse2(){
		return $this->adresse2;
	}
	
	
	public function getDescription(){
		return $this->description;
	}
	
	public function getCp(){
		return $this->cp;
	}
	
	public function getVille(){
		return $this->ville;
	}
	public function getHebergement() {
            return $this->hebergement;
        }

        public function setHebergement($hebergement) {
            $this->hebergement = $hebergement;
        }

        public function getTel() {
            return $this->tel;
        }

        public function setTel($tel) {
            $this->tel = $tel;
        }

        public function getFax() {
            return $this->fax;
        }

        public function setFax($fax) {
            $this->fax = $fax;
        }

        public function getGalerie() {
            return $this->galerie;
        }

        public function setGalerie($galerie) {
            $this->galerie = $galerie;
        }

        /**
	 * Get Train
	 * @return: String descAccesTrain
	 */
	public function getTrain(){
		return $this->accesTrain;
	}
	
	/**
	 * Get Avion
	 * @return: String descAccesTrain
	 */
	public function getAvion(){
		return $this->accesAvion;
	}

	public function getVoiture(){
		return $this->accesVoiture;
	}
	
	public function getMainPhoto(){
		return $this->mainphoto;
	}

	public function getAdmin(){
		return $this->Administrateur_administrateurId;
	}
	
	public function getCommunaute(){
		return $this->Communaute_communauteId;
	}

	public function getTypeId(){
		return $this->Type_typeId;
	}
	
		
	public function getMail(){
		return $this->mail;
	}
	
	public function getLienSiteWeb(){
		return $this->lienSiteweb;
	}
	
	public function getPays() {
            return $this->pays;
        }
        
        public function getValidationAdmin() {
            return $this->validationAdmin;
        }

        public function getValidationSuperAdmin() {
            return $this->validationSuperAdmin;
        }

        	
	/*
	 * SETTERS
	 */
	
	public function setPays($pays) {
            $this->pays = $pays;
        }
        
        
	public function setId($idLieu){
		$this->id = $idLieu;
	}
	
	
	public function setNom($nomLieu){
		$this->nom =$nomLieu;
	}
	
	public function setAdresse1($adresse1Lieu){
		$this->adresse1 = $adresse1Lieu;
	}
	
	public function setAdresse2($adresse2Lieu){
		$this->adresse2 = $adresse2Lieu;
	}
	
	
	public function setDescription($descLieu){
		$this->description = $descLieu;
	}
	
	public function setCp($cpLieu){
		$this->cp = $cpLieu;
	}
	
	public function setVille($villeLieu){
		$this->ville = $villeLieu;
	}
        
        public function setValidationAdmin($validationAdmin){
		$this->validationAdmin = $validationAdmin;
	}
	
        public function setValidationSuperAdmin($validationSuperAdmin){
		$this->validationSuperAdmin = $validationSuperAdmin;
	}
	/**
	 * Get Train
	 * @return: String descAccesTrain
	 */
	public function setTrain($descTrain){
		$this->accesTrain = $descTrain;
	}
	
        /**
         * Definir Avion
         * @param type $descAvion 
         */
	public function setAvion($descAvion){
		$this->accesAvion = $descAvion;
	}
	
	public function setVoiture($voitureLieu){
		$this->accesVoiture = $voitureLieu;
	}
	
	public function setMainPhoto($mainPhoto){
		$this->mainphoto = $mainPhoto;
	}
	
	public function setAdmin($adminID){
		$this->Administrateur_administrateurId = $adminID;
	}
	
	public function setCommunaute($idComm){
		$this->Communaute_communauteId = $idComm;
	}
	
	public function setTypeId($typeId){
		$this->Type_typeId = $typeId;
	}
	
	
	public function setMail($mailLieu){
		$this->mail = $mailLieu;
	}
	
	public function setLienSiteWeb($lienSiteWeb){
		$this->lienSiteweb = $lienSiteWeb;
	}
	
	
	public function getDateEnregistrement() {
            return $this->dateEnregistrement;
        }

        public function setDateEnregistrement($dateEnregistrement) {
            $this->dateEnregistrement = $dateEnregistrement;
        }

        	
	public function getAdresseComplete(){
              return $this->adresse1." ".$this->adresse2." ".$this->cp." ".$this->ville;
              
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

        public function setDepartement($departement) {
            $this->departement = $departement;
        }

        public function getRegion() {
            return $this->region;
        }

        public function setRegion($region) {
            $this->region = $region;
        }

        public function getNbEvent() {
            $nb = $this->nbEvent;
            if(is_null($this->nbEvent) || ""==$this->nbEvent){
               $nb = "0"; 
            }
            return $nb;
        }

        public function setNbEvent($nbEvent) {
            $this->nbEvent = $nbEvent;
        }

        public function getNbEventFormated(){
          if($this->nbEvent>1){
              $val = $this->nbEvent." événements"; 
          }else{
              $val = $this->nbEvent." événement";
          }  
          return $val;
        }
        
         public function __toString() {
                $str= "\n".$this->id;
                $str= "\n".$this->nom;
                $str= "\n".$this->adresse1;
                $str= "\n".$this->adresse2;
                $str= "\n".$this->cp;
                $str= "\n".$this->ville;
                $str= "\n".$this->pays;
                $str= "\n".$this->description;
                $str= "\n".$this->hebergement;
                $str= "\n".$this->mainphoto;
                $str= "\n".$this->accesVoiture;
                $str= "\n".$this->accesAvion;
                $str= "\n".$this->accesTrain;
                $str= "\n".$this->lienSiteweb;
                $str= "\n".$this->mail;
                $str= "\n".$this->tel;
                $str= "\n".$this->fax;
                $str= "\n".$this->Type_typeId;
                $str= "\n".$this->Communaute_communauteId;
                $str= "\n".$this->Administrateur_administrateurId;
                $str= "\n".$this->galerie;
                $str= "\n".$this->dateEnregistrement;
                $str= "\n".$this->lat;
                $str= "\n".$this->long;
                $str= "\n".$this->validationAdmin;
                $str= "\n".$this->validationSuperAdmin;
                $str= "\n".$this->departement;
                $str= "\n".$this->region;
                $str= "\n".$this->nbEvent;
                $str= "\n".$this->place;
             
             
            return $str;
        }
        
        public function getPlace() {
            return $this->place;
        }

        public function setPlace($place) {
            $this->place = $place;
        }

        public function getNbEventAVenir() {
            return $this->nbEventAVenir;
        }

        public function setNbEventAVenir($nbEventAVenir) {
            $this->nbEventAVenir = $nbEventAVenir;
        }


}

?>