<?php

/**
 * 
 * @author bteillard
 *
 */
class ThemeActionDao{
	
    
        /**
         * Récupérer les Retraites associés à un thème
         * @param type $idTheme
         * @return array 
         */
        public static function recupererRetraiteFromTheme($idTheme){
            
            $req = ThemeQueryDao::getRetraitesForTheme($idTheme);
            $tabIdRetraiteTheme = array();
            foreach ($req as $data){
                array_push($tabIdRetraiteTheme, EvenementActionDao::getEvenement($data[Db::getParam("tre","RetraiteId",null)]));
            }
            return $tabIdRetraiteTheme;
        }
    
            
        /**
        * Récupérer un tableau contenant tous les themes 
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemesFromRetraites2($start, $end, $order, $sens){
            $condition= "";
            if(!is_null($order) && !is_null($sens)){
                $condition .= " order by ".$order." ".$sens ;
            }
            if(!is_null($start) && !is_null($end)){
                $condition .=" limit ".$start.",".$end;
            }

    //        $req = ThemeQueryDao::getAllThemesFromRetraite($condition);
            $req = ThemeQueryDao::getThemesFromRetraites($condition);
            $tabTheme = array();
            foreach ($req as $data){
                $theme = new Theme($data[Db::getParam("the","Id",null)],$data[Db::getParam("the","Nom",null)],$data[Db::getParam("the","Description",null)],$data[Db::getParam("the","Image",null)]);
                $theme->setNbEvent($data['nb']);
                array_push($tabTheme, $theme);
            }
            return $tabTheme;
        }
        /**
        * Récupérer un tableau contenant tous les themes 
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemesFromRetraites(){
        $req = ThemeQueryDao::getAllThemesFromRetraite();
        $tabTheme = array();
        foreach ($req as $data){
            $theme = new Theme($data[Db::getParam("the","Id",null)],$data[Db::getParam("the","Nom",null)],$data[Db::getParam("the","Description",null)],$data[Db::getParam("the","Image",null)]);
            array_push($tabTheme, $theme);
        }
        return $tabTheme;
    }
    
    
        /**
        * Récupérer un tableau contenant tous les themes 
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemes(){
            
            $req = ThemeQueryDao::getAllThemes();
            $tabTheme = array();
            
            foreach ($req as $data){
                $theme = new Theme($data[Db::getParam("the","Id",null)],$data[Db::getParam("the","Nom",null)],$data[Db::getParam("the","Description",null)],$data[Db::getParam("the","Image",null)]);
                array_push($tabTheme, $theme);
            }
            return $tabTheme;
    }
    
        /**
        * Récupérer les themes d'une retraite
        * @param type $idRetraite
        * @return array 
        */
        public static function recupererThemesForRetraite($idRetraite){
            
            $tabTheme = array();
            $req = EvenementQueryDao::getListeThemePourUnEvenement($idRetraite);
            
            foreach ($req as $data){
                $theme = new Theme($data[Db::getParam("the","Id",null)],$data[Db::getParam("the","Nom",null)],$data[Db::getParam("the","Description",null)],$data[Db::getParam("the","Image",null)]);
                array_push($tabTheme, $theme);
            }
            
            return $tabTheme;
    }
	
	/**
	 * 
	 * @param unknown_type $idRetraite
	 * @return Evenement
	 */
	public static function recupererUnTheme($idTheme){
		
		$req = ThemeQueryDao::getOneTheme($idTheme);
               
                $Theme = null;
                        
		foreach ($req as $data)
		{
                    $Theme = new Theme($data[Db::getParam("the","Id",null)], $data[Db::getParam("the","Nom",null)], $data[Db::getParam("the","Description",null)], $data[Db::getParam("the","Image",null)]);	
		}
		return $Theme;
	}	
	
        
        /**
         * Association d'une retraite et de themes
         * @param type $idRetraite
         * @param type $arrThemeRetraite
         */
        public static function associerThemeRetraite($idRetraite, $arrThemeRetraite){
            $boo = false;
            foreach($arrThemeRetraite as $theme){
                $boo = ThemeQueryDao::associateThemeRetraite($idRetraite, $theme);
            }
            return $boo[0];
        }
	
        /**
         * Supprime les associations Theme retraite
         * @param type $idRetraite
         * @param type $idTheme
         */
        public static function effacerAssociationThemeRetraite($idRetraite, $idTheme){
            return ThemeQueryDao::deleteAssociationThemeRetraite($idRetraite, $idTheme);
        }
}

?>