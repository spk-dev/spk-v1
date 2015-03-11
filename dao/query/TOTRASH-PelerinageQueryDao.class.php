<?php //

/**
 * 
 */
class PelerinageQueryDao{


        /**
         * Recupération des pélerinages pour la liste principale
         * @return type 
         */
//        public static function getAllPelerinagePourListe($condition){
//           
//            
//           $sql = "SELECT DISTINCT `".Db::getTables("ret")."`.`".Db::getRet("Id")."` ,`".Db::getTables("ret")."`.`".Db::getRet("Nom")."` ,`".Db::getTables("ret")."`.`".Db::getRet("Description")."`,`".Db::getTables("ret")."`.`".Db::getRet("DateDebut")."` ,`".Db::getTables("ret")."`.`pelerinage-datefin` ,`".Db::getTables("ret")."`.`pelerinage-mainphoto` , `".Db::getTables("ret")."`.`pelerinage-prix`, `".Db::getTables("ret")."`.`pelerinage-contact`, `".Db::getTables("ret")."`.`Lieu_lieu-id`,`lieu`.`lieu-nom`, `".Db::getTables("ret")."`.`pelerinage-dateEnregistrement` FROM `".Db::getTables("ret")."`, `lieu` 
//                    WHERE `Lieu_lieu-id`=`lieu`.`lieu-id` ".$condition.";";
//          
//            AppLog::ecrireLog($sql, "sql");
//           return UtilsDao::getInstance()->executeRequete($sql);
//            
//        }
    
	/**
         * Récupération d'une pelerinage
         * @param type $idPelerinage
         * @return type 
         */
//	public static function getOnePelerinage($idPelerinage){
//		
//		$sql = "SELECT * FROM `".Db::getTables("ret")."` WHERE `".Db::getRet("Id")."`=".$idPelerinage.";";
//		return UtilsDao::getInstance()->executeRequete($sql);
//	}
//	
	/**
	 * Select toutes les pelerinages de la base
	 * @return resource
	 */
//	public static function getAllPelerinages($condition){
//                
//            
//		$sql = "SELECT * FROM `".Db::getTables("ret")."` ".$condition;
//                
//		return UtilsDao::getInstance()->executeRequete($sql);
//	}
	
	
	/**
	 * Ajouter une pelerinage dans la base
	 * @param Pelerinage $pelerinage
	 * @return resource
	 */
//	public static function addPelerinage(Pelerinage $pelerinage){		
//
//		$sqlRetr= "INSERT INTO `".Db::getTables("ret")."` (`".Db::getRet("Id")."` ,`".Db::getRet("Nom")."` ,`".Db::getRet("Description")."` ,`".Db::getRet("DateDebut")."` ,`pelerinage-datefin` ,`pelerinage-mainphoto` ,`pelerinage-prix` ,`pelerinage-contact`, `Lieu_lieu-id`, `pelerinage-dateEnregistrement`) VALUES (";
//                $sqlRetr .= "NULL , '".$pelerinage->getNom()."', '".$pelerinage->getDescription()."', '".$pelerinage->getDateDebut()."', '".$pelerinage->getDateFin()."', '".$pelerinage->getPhoto()."', '".$pelerinage->getPrix()."', '".$pelerinage->getContact()."', '".$pelerinage->getLieu()."', '".date("Y-m-d H:i:s")."');";
//
//   
//		return UtilsDao::getInstance()->executeRequete($sqlRetr);	
//                        
//	}
	
	
	/**
	 * Modifie la pelerinage passée en argument
         * 1 - Suppression dans la table Intervenants pelerinage
         * 2 - Màj de la pelerinage
         * 3 - Ajout dans la table Intervenants pelerinage des interv
	 * @param Pelerinage $pelerinage
	 * @return resource
	 */
//	public static function modifyPelerinage(Pelerinage $pelerinage){
//		$sqlPelerinage = "UPDATE `".Db::getTables("ret")."` SET `".Db::getRet("Nom")."` = '".$pelerinage->getNom()."', `".Db::getRet("Description")."` = '".$pelerinage->getDescription()."', `".Db::getRet("DateDebut")."` = '".$pelerinage->getDateDebut()."', `pelerinage-datefin` = '".$pelerinage->getDateFin()."', `pelerinage-prix` = '".$pelerinage->getPrix()."', `pelerinage-garderie` = '".$pelerinage->getGarderie()."', `pelerinage-hebergement` = '".$pelerinage->getHebergement()."' WHERE `".Db::getTables("ret")."`.`".Db::getRet("Id")."` = ".$pelerinage->getId().";";
//		
//                $intervenants = $pelerinage->getIntervenants;
//                
//                $i=1;
//                $nbval = sizeof($intervenants);
//                
//                $sqlDelIntervPelerinage = "DELETE FROM `intervenant_pelerinage` WHERE `intervenant_pelerinage`.`Pelerinage_pelerinage-id` = ".$pelerinage->getId().";";
//                $sqlIntervenants = "INSERT INTO `intervenant_pelerinage` (`Intervenants_intervenant-id`, `Pelerinage_pelerinage-id`) VALUES ";
//                foreach ($intervenants as $intervenant) {
//                    $sqlIntervenants .= "(".$intervenant.", ".$pelerinage->getId().")";
//                  // Ajouter une virgule à tous les
//                    if($i<$nbval){
//                        $sqlIntervenants.= ", ";
//                    }
//                    $i++; 
//                }
//                $sqlIntervenants = ";";
//                $reqDelIntervPelerinage = UtilsDao::getInstance()->executeRequete($sqlDelIntervPelerinage);
//                $reqPelerinage = UtilsDao::getInstance()->executeRequete($sqlPelerinage);
//		$reqAddIntervPelerinage =  UtilsDao::getInstance()->executeRequete($sqlIntervenants);
//	}
//	
	
	/**
	 * Supprimer une pelerinage
	 * @param Pelerinage $retraitre
	 * @return resource
	 */
//	public static function deletePelerinage($idPelerinage){
//		
//		/*$cleanCat = "DELETE FROM Categorie_Pelerinage WHERE `Pelerinage_pelerinage-id` = ".$idPelerinage.";";
//		$cleanPhoto = "DELETE FROM Photo_pelerinage WHERE `Pelerinage_pelerinage-id` = ".$idPelerinage.";";
//		$cleanIntervenant = "DELETE FROM Intervenant_Pelerinage WHERE `Pelerinage_pelerinage-id` = ".$idPelerinage.";";
//		
//		$sql = "DELETE FROM Pelerinage WHERE `".Db::getRet("Id")."`=".$idPelerinage.";";
//		
//		UtilsDao::getInstance()->executeRequete($cleanCat);
//		UtilsDao::getInstance()->executeRequete($cleanPhoto);
//		UtilsDao::getInstance()->executeRequete($cleanIntervenant);
//		
//		UtilsDao::getInstance()->executeRequete($sql);*/
//	}
//	
//        /**
//         * Renvoi le nb de pelerinage pour un lieu donné.
//         * @param type $idLieu
//         * @return type 
//         */
//        public static function countNbPelerinageWhithThisLieu($idLieu){
//            $sql = "SELECT `".Db::getRet("Id")."` FROM `".Db::getTables("ret")."` WHERE `Lieu_lieu-id`=".$idLieu.";";
//         
//            return UtilsDao::getInstance()->countResult($sql);
//        }
	

}