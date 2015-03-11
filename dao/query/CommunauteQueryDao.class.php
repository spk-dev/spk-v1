<?php

/**
 * 
 */
class CommunauteQueryDao{


	/**
         * Récupérer une communaute en fonction de son ID
         * @param type $idcommunaute
         * @return type 
         */
	public static function getOneCommunaute($idcommunaute){
		
		$sql = "SELECT * FROM ".Db::get("com",null,null)." WHERE ".Db::get("com", "Id",null)." = ".$idcommunaute.";";
		return UtilsDao::getInstance()->executeRequete($sql);
	}
	
	/**
	 * Select toutes les lieus de la base
	 * @return resource
	 */
	public static function getAllCommunautes(){
	
            $sql = "SELECT * FROM ".Db::get("com",null,null);
            return UtilsDao::getInstance()->executeRequete($sql);
	}
	
        /**
	 * Select toutes les lieus de la base
	 * @return resource
	 */
	public static function getCommunautesProposantRetraites(){
	
            $sql = "SELECT ".Db::get("com",null,null).".*  
            FROM ".Db::get("com",null,null)." LEFT JOIN ".Db::get("org",null,null)." ON ".Db::get("com","Id",null)."=".Db::get("org","CommunauteId",null)."
            RIGHT JOIN ".Db::get("eve",null,null)." ON ".Db::get("org","Id",null)."=".Db::get("eve","LieuId",null)."
            WHERE  ".Db::get("org","ValidationAdmin",null)." = 1 
            AND ".Db::get("org","ValidationSuperAdmin",null)." = 1 
            AND ".Db::get("org","Nom",null)." <> 'SPIBOOK' 
            GROUP BY ".Db::get("com","Id",null).";";
            
            return UtilsDao::getInstance()->executeRequete($sql);
	}
	
	

}