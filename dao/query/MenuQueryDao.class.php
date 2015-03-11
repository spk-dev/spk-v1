<?php

class MenuQueryDao{

   /**
    * Recupere la liste des liens
    * @return type
    */ 
   public static function getLiens(){
        
        $sql = "SELECT * FROM `lis_liens` LIMIT 0, 30 ";
       return UtilsDao::getInstance()->executeRequete($sql);
   }
}

?>
