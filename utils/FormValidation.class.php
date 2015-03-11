<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class FormValidation{
   
    /**
     * Renvoi le pattern associé au type de format
     * Renvoi false, si le format n'existe pas.
     * @param type $patternType
     * @return string / false
     */
    private static function getPattern($patternType){
        $patternArray = array();
        
        
        $atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';   // caractères autorisés avant l'arobase
        $domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // caractères autorisés après l'arobase (nom de domaine)

        $patternArray['mail'] = '/^' . $atom . '+' .   // Une ou plusieurs fois les caractères autorisés avant l'arobase
        '(\.' . $atom . '+)*' .         // Suivis par zéro point ou plus
                                        // séparés par des caractères autorisés avant l'arobase
        '@' .                           // Suivis d'un arobase
        '(' . $domain . '{1,63}\.)+' .  // Suivis par 1 à 63 caractères autorisés pour le nom de domaine
                                        // séparés par des points
        $domain . '{2,63}$/i';          // Suivi de 2 à 63 caractères autorisés pour le nom de domaine
        
        
//        $patternArray['mail'] = "/\S+@\S+\.\S+/";
//        $patternArray['mail'] = "^[a-zA-Z0-9]+([\-_.!~*'()][a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+([a-zA-Z0-9_-]+)*\.[a-zA-Z]{2,4}$";
        $patternArray['text'] = "^[a-zA-Z0-9àáâãäåòóôõöøèéêëçìíîïùúûüÿ]*$";
        $patternArray['phone'] = "`^(0[1-69][-.\s]?(\d{2}[-.\s]?){3}\d{2})$`";
        $patternArray['url'] = " \^(http|https|ftp):\/\/([\w]*)\.([\w]*)\.(com|net|org|biz|info|mobi|us|cc|bz|tv|ws|name|co|me)(\.[a-z]{1,3})?\z/i ";
        $patternArray['cp'] = "/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/";
        
        
        
        if(!key_exists($patternType, $patternArray)){
            $returnedValue = false; 
        }else{
            $returnedValue = $patternArray[$patternType];
        }
        
        
        return $returnedValue;
        
    }


    /**
     * Vérifie la conformité d'un résultat par rapport à un format attendu. 
     * @param type $field
     * @param type $expectedFormat
     * @return text
     */
    public static function checkField( $fieldValue, $expectedFormat){
//        $errMessage = "";
        $pattern = self::getPattern(strtolower($expectedFormat));
        
//        if($fieldValue == ""){
////            $errMessage = TextStatic::getText("FormEmptyMess");
////            $errMessage = str_replace("[###]", $fieldName, $errMessage);
//            $errMessage = "Le champ ".$fieldName." est obligatoire";
            
        if(!self::getPattern($expectedFormat)){
//                $errMessage = "";
                $boo = false;
        }else if(preg_match($pattern, $fieldValue)){
               $boo = true;
//            $errMessage = TextStatic::getText("FormErrMess".$expectedFormat);
//            $errMessage = str_replace("[###]", $fieldName, $errMessage);
//            $errMessage = "Le champ ".$fieldName." doit être au format : ".$expectedFormat;
        }        
        
        return $boo;
        
    }
    
    
    
}
?>
