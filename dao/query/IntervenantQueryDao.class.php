<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 */

class IntervenantQueryDao{

    public static function searchIntervenant($text){
        $sql = "SELECT ".Db::get("int","Id",null).",".Db::get("int","Nom",null).",".Db::get("int","Prenom",null)." 
                FROM ".Db::get("int",null,null)."
                WHERE intervenantNom like ('%".$text."%') 
                OR intervenantPrenom like ('%".$text."%')";
         return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Liste les intervenants en fonction des num de retraites listés
     * @param type $listeRetraite
     * @return type 
     */
    public static function listeIntervenantFromRetraite($listeRetraite){
        $sql = "SELECT * FROM ".Db::get("int",null,null)." WHERE ".Db::get("int","Id",null)." IN (SELECT DISTINCT ".Db::get("ire","IntervenantId",null)." ";
        $sql .= "FROM ".Db::get("ire",null,null)." ";
        $sql .= "WHERE ".Db::get("ire","RetraiteId",null)." ";
        $sql .= "IN ( ".$listeRetraite." ) ) ";
         
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Récupérer tous les intervenant d'une retraite
     * @param type $idRetraite 
     */
    public static function getIntervenantsForRetraite($idRetraite){
        $sql = "SELECT * FROM ".Db::get("int",null,null)." WHERE ".Db::get("int","Id",null)." in (SELECT ".Db::get("ire","IntervenantId",null)." FROM ".Db::get("ire",null,null)." WHERE ".Db::get("ire","RetraiteId",null)."=".$idRetraite.")";
        return UtilsDao::getInstance()->executeRequete($sql);
        }
 
    /**
     * Liste des intervenants rattachés à une ou plusieurs retraites
     * @return type 
     */
    public static function getIntervenantsAttachedToRetraite(){
        
        $sql = "SELECT DISTINCT ".Db::get("ire",null,null).".".Db::get("ire","IntervenantId",null)." , ".Db::get("int",null,null).".".Db::get("int","Id",null).",".Db::get("int",null,null).".".Db::get("int","Prenom",null)." ,".Db::get("int",null,null).".".Db::get("int","Nom",null).",".Db::get("int",null,null).".".Db::get("int","Photo",null).",".Db::get("int",null,null).".".Db::get("int","Description",null).",".Db::get("int",null,null).".".Db::get("int","Mail",null).",".Db::get("int",null,null).".".Db::get("int","Genre",null).",".Db::get("int",null,null).".".Db::get("int","Titre",null)."  FROM ".Db::get("int",null,null).",".Db::get("ire",null,null)." WHERE ".Db::get("ire",null,null).".".Db::get("ire","IntervenantId",null)."=".Db::get("int",null,null).".".Db::get("int","Id",null)."";
        
        return UtilsDao::getInstance()->executeRequete($sql);
        
    }
    
    /**
     * Récupère un intervenant en fonction de son ID.
     * @param type $idIntervenant
     * @return resultSet 
     */
    public static function getOneIntervenant($idIntervenant){
        $sql = "SELECT * FROM ".Db::get("int",null,null)." WHERE ".Db::get("int","Id",null)."=".$idIntervenant.";";
        return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Récupère Tous les intervenants
     * @return resultSet 
     */
    public static function getAllIntervenants(){
        $sql = "SELECT * FROM ".Db::get("int",null,null)."";
         return UtilsDao::getInstance()->executeRequete($sql);
    }
    
    /**
     * Renvoi toutes les retraites auxquelles le ou les intervenants sont associés
     * @param Array $idIntervenants
     * @return resultset 
     */
    public static function getRetraitesForIntervenants($idIntervenants){
        
        $nbIntervenants = count($idIntervenants);
        
        if($nbIntervenants>1){
            $sql = "SELECT DISTINCT ".Db::get("ire","RetraiteId",null)." FROM ".Db::get("ire",null,null)." WHERE ".Db::get("ire","IntervenantId",null)." IN (";
            
            for ($i = 0; $i < $nbIntervenants; $i++) {
                $sql .= $idIntervenants[$i];
                if($i<$nbIntervenants-1){
                    $sql .=",";
                }
            }
            
            $sql .= ");";
        }else{
            $sql = "SELECT ".Db::get("ire","RetraiteId",null)." FROM ".Db::get("ire",null,null)." WHERE ".Db::get("ire","IntervenantId",null)."= ".$idIntervenants[0];
        }
                
        return UtilsDao::getInstance()->executeRequete($sql);
    }

    /**
     * 
     * @param type $idRetraite
     * @param type $arrIdIntervenants
     */
    public static function associateIntervenantRetraite($idRetraite,$idIntervenant){
            $sql ="INSERT INTO  ".Db::get("ire",null,null)." (
                    ".Db::get("ire","IntervenantId",null)." ,
                    ".Db::get("ire","RetraiteId",null)."
                    )VALUES (
                    ".$idIntervenant.",".$idRetraite."
                    );
                    ";
        
        
        return UtilsDao::getInstance()->executeInsert($sql);
        
    }
    
    /**
     * Ajoute un intervenant dans la base.
     * @param Intervenant $intervenant
     * @return boolean
     */
    public static function addIntervenant(Intervenant $intervenant,$idAdmin){
        $sql = "INSERT INTO  ".Db::get("int",null,null)." (
                    ".Db::get("int","Id",null)." ,
                    ".Db::get("int","Nom",null).",
                    ".Db::get("int","Prenom",null).",
                    ".Db::get("int","Description",null).",
                    ".Db::get("int","Mail",null).",
                    ".Db::get("int","Genre",null).",
                    ".Db::get("int","Titre",null).",
                    ".Db::get("int","Photo",null).",
                    ".Db::get("int","Valid",null).",
                    ".Db::get("int","Admin",null)."
                    )VALUES (null,
                        '".$intervenant->getNom()."','".$intervenant->getPrenom()."',
                        '".$intervenant->getDescription()."','".$intervenant->getMail()."',
                        '".$intervenant->getGenre()."','".$intervenant->getTitre()."',
                        '".$intervenant->getPhoto()."',1,".$idAdmin."
                    );
                    ";
        
        return UtilsDao::getInstance()->executeInsert($sql);
    }
    
    /**
     * Efface les correspondance entre un ou plusieurs intervenants et une retraite
     * @param int $idRetraite
     * @param int, array or null $idIntervenant
     */
    public static function deleteAssociationIntervenantRetraite($idRetraite,$idIntervenant){
        if(is_null($idIntervenant)){
            $sql = "DELETE FROM ".Db::get("ire",null,null)."
                WHERE ".Db::get("ire","RetraiteId",null)." = ".$idRetraite.";";
            
            
        }else if(is_array($idIntervenant)){
            $sql = "DELETE FROM ".Db::get("ire",null,null)."
                WHERE ".Db::get("ire","RetraiteId",null)." = ".$idRetraite."
                AND ".Db::get("ire","IntervenantId",null)." IN (";
            
                $i = 1;
                $nb = count($idIntervenant);
                foreach($idIntervenant as $id){
                    $sql .=$id;
                    if($i<$nb){
                        $sql .=",";
                    }
                    $i++;
                            
                }
                $sql .");";
            
        }else{
            $sql = "DELETE FROM ".Db::get("ire",null,null)."
                WHERE ".Db::get("ire","RetraiteId",null)." = ".$idRetraite."
                AND ".Db::get("ire","IntervenantId",null)." = ".$idTheme.";";
        }
        
        Return UtilsDao::getInstance()->executeRequete($sql);
        
        
        
    }
    
}


?>
