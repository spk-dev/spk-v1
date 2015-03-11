<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class HtmlFormComponents{
   
     
    /**
     * * Methode qui renvoi le code HTML d'un select contenant la liste des Types d'événement
     * @param type $name
     * @param type $id
     * @param type $size
     * @param type $cssClass
     * @param type $multiple
     * @param type $valueSelected
     * @param type $existeEvenement
     * @return string
     */
    public static function SelectTypeEvenements($name,$id,$size,$cssClass,$multiple,$valueSelected,$existeEvenement){
         
        AppLog::ecrireLog("Rentre dans selectTypeEvent", "debug");
        
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        
        $liste = TypeEvenementActionDao::listerTousLesTypesEvenement($existeEvenement);
        
        foreach ($liste as $element) { 
            
            $htmlCode.= "<option value=".$element->getId();
            
            if(!is_null($valueSelected)){
                foreach ($valueSelected as $value) {
                    if($element->getId() == $value){
                        $htmlCode.=" selected ";
                    }
                }
            }
            
            
            $htmlCode.= ">".$element->getLibelle()."</option>";
        }
	$htmlCode.= "</select>";
        
        return $htmlCode;

    }
    
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectIntervenantsWithSelectedValue($name,$id,$size,$cssClass,$multiple,$valueSelected){
         
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $liste = IntervenantActionDao::listerIntervenants();
        
        foreach ($liste as $element) { 
            
            $htmlCode.= "<option value=".$element->getId();
            
         
            if(!is_null($valueSelected)){
                foreach ($valueSelected as $value) {
                if($element->getId() == $value){
                    $htmlCode.=" selected ";
                }
            }
            }
            
            
            $htmlCode.= ">".$element->getPrenom()." ".$element->getNom()."</option>";
        }
	$htmlCode.= "</select>";
       
        return $htmlCode;

    }
    
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectThemeFromEvenement($name,$id,$size,$cssClass,$multiple, $selectedValue){
//         switch ($context) {
//            case "retraite":
                $liste = ThemeAction::recupererThemesFromRetraites();
//                break;
//            
//            default:
//                
//                break;
//        }
        
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
       foreach ($liste as $element) { 
            
            $htmlCode.= "<option value=".$element->getId();
            if(in_array($element->getId(),$selectedValue)){
                $htmlCode .= " selected ";
            }
            $htmlCode.= ">".$element->getNom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectThemeWithSelectedValue($name,$id,$size,$cssClass,$multiple,$valueSelected){
         
      
        
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $listeTheme = ThemeAction::recupererThemes();
        
        
        foreach ($listeTheme as $theme) { 
            
            $htmlCode.= "<option value=".$theme->getId();
            
            if(!is_null($valueSelected)){
                foreach ($valueSelected as $value) {
                    if($theme->getId()== $value->getId()){
                        $htmlCode.=" selected ";
                    }
                }
            }
            
            
            $htmlCode.= ">".$theme->getNom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }

    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectPelerinageByPhotoName($name,$id,$size,$cssClass,$multiple){
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $filter = new PelerinageSearchCriteria();
        $liste = PelerinageAction::listerTousLesPelerinages($filter);
        
        foreach ($liste as $element) { 
            $htmlCode.= "<option value=".$element['pelerinagePhoto'].">".$element['pelerinageNom']."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
            
    /**
     *  Affiche OUI et NON et renvoi vers 1 ou 0
     * @param type $name
     * @param type $id
     * @param type $size
     * @param type $cssClass
     * @return string 
     */
    public static function selectOuiNon($name,$id,$size, $cssClass){
      
        $noSelect="";
        $yesSelect="";
        $blankSelect="";
        
        
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'>";
        $htmlCode .= "<option value=''".$blankSelect."></option>";
        $htmlCode .= "<option value=0 ".$noSelect.">Non</option>";
        $htmlCode .= "<option value=1 ".$yesSelect.">Oui</option>";
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Renvoi la liste des communautes
     * @param type $name
     * @param type $id
     * @param type $size
     * @param type $cssClass
     * @param type $multiple
     * @return string 
     */
    public static function selectCommunaute($name,$id,$size, $cssClass,$multiple,$selectedValue){
        
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $listeCommunaute = CommunauteActionDao::listerToutesCommunautes(false);
        foreach ($listeCommunaute as $communaute) { 
            
            $htmlCode.= "<option value=\"".$communaute->getId()."\"";
            foreach($selectedValue as $value){
                if($value==$communaute->getId()){
                    $htmlCode .=" selected ";
                }
            }
            $htmlCode.=">".$communaute->getNom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Renvoi la liste des types
     * @param type $name
     * @param type $id
     * @param type $size
     * @param type $cssClass
     * @param type $multiple
     * @return string 
     */
    public static function selectType($name,$id,$size, $cssClass,$multiple,$selectedValue){
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        $listeTypes = TypeActionDao::listerTousLesTypes();
        
        foreach ($listeTypes as $type) {      
            $htmlCode.= "<option value=\"".$type->getid()."\"";
            
            foreach($selectedValue as $value){
                if($value==$type->getid()){
                    $htmlCode .=" selected ";
                }
            }
            
            
            $htmlCode.=">".$type->getnom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Retraites
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectRetraitesId($name,$id,$size, $cssClass,$multiple,$filter,$javascript,$selectedValue){
        $htmlCode ="";
        $htmlCode.="<select onChange=\"".$javascript."\" name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        if(is_null($filter)){
            $filter = new EvenementSearchCriteria();
        }
        $listeEvenements = EvenementActionDao::listerTousEvenements($filter,false);
        
        $htmlCode .="<option value=\"\">---</option>";
        foreach ($listeEvenements as $retraite) { 
            $selected = "";
            if(!is_null($selectedValue) && $selectedValue == $retraite->getId()){
                $selected = "selected";
            }
            $htmlCode.= "<option value=".$retraite['IdRetraite']." ".$selected.">".$retraite['NomRetraite']."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
        
    }
    
   /**
    * Affiche la liste des retraites pour refactoring photo
    * @param type $name
    * @param type $id
    * @param type $size
    * @param type $cssClass
    * @param type $multiple
    * @return string 
    */
    public static function SelectRetraitesPhoto( $name,$id,$size, $cssClass,$multiple){
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $filter = new EvenementSearchCriteria();
        $listeEvenements = EvenementAction::listerToutesRetraites($filter);
        
        
        foreach ($listeEvenements as $retraite) { 
            $htmlCode.= "<option value=".$retraite['RetraiteMainPhoto'].">".$retraite['NomRetraite']."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }      
    
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectLieuxFromEvenement($context,$name,$id,$size,$cssClass,$multiple, $selectedValue){
        
        switch ($context) {
            case "retraite":
                $listeLieux = LieuActionDao::listeLieuxFiltreRetraite();
                break;
            default:
                
                break;
        }
        
        
        
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        
        
        foreach ($listeLieux as $Lieu) { 
            $selected = "";
            if(in_array($Lieu->getId(),$selectedValue)){
                $selected = "selected";
            }
            $htmlCode.= "<option value=".$Lieu->getId()." ".$selected.">".$Lieu->getNom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
        
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectLieuxByPhotoName($name,$id,$size,$cssClass,$multiple){
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $listeLieux = LieuAction::listeTousLesLieuxPourSelect();
        
        foreach ($listeLieux as $Lieu) { 
            $htmlCode.= "<option value=".$Lieu['lieuPhoto'].">".$Lieu['lieuNom']."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
      /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectLieuxFiltered($name,$id,$size,$cssClass,$multiple,$filterLieu,$javascript,$selectedValue,$lieuValideFacultatif=null){
        $htmlCode ="";
        $htmlCode.="<select onChange=\"".$javascript."\" name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $listeLieux = LieuAction::listerLieuxFiltered($filterLieu, $lieuValideFacultatif);
        
       $htmlCode .= "<option>---</option>";
        foreach ($listeLieux as $Lieu) { 
            
            $htmlCode.= "<option value=".$Lieu->getid();
            if($selectedValue==$Lieu->getid()){
                $htmlCode .= " selected";
            }
            $htmlCode .= ">".$Lieu->getnom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectLieuxByIdWithSelectedValue($name,$id,$size,$cssClass,$multiple,$selectedValue){
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        $listeLieux = LieuAction::listerTousLieux();
        $listeLieux = LieuAction::listeLieuxFiltreRetraite();
        foreach ($listeLieux as $Lieu) { 
            
            $htmlCode.= "<option value=".$Lieu->getid();
            if($selectedValue==$Lieu->getid()){
                $htmlCode .= " selected ";
            }
            $htmlCode .= ">".$Lieu->getnom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Methode qui renvoi le code HTML d'un select contenant la liste des Lieux référencant les Photos
 
     * @param type $name : Nom html de la liste
     * @param type $id : Id de la liste
     * @param type $cssClass  : Class css de la liste
     * @param type $size : Taille de la liste
     * @param boolean (1,0) $multiple : S'agit il d'une liste à selection multiple ou pas
     * @return string : Code HTML de la liste
     */
    public static function SelectLieuxById($name,$id,$size,$cssClass,$multiple){
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        $filter = new OrganisateurSearchCriteria();
        $listeLieux = LieuActionDao::listeTousLesLieuxPourSelect($filter, false);
        
        foreach ($listeLieux as $Lieu) { 
            $htmlCode.= "<option value=".$Lieu['lieuId'].">".$Lieu['lieuNom']."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Liste proposant les intervenants
     * @param type $name
     * @param type $id
     * @param type $size
     * @param type $cssClass
     * @param type $multiple
     * @return string 
     */
     public static function SelectIntervenants($context,$name,$id,$size,$cssClass,$multiple,$selectedValue){
        
         if(is_null($context)){
            $listeIntervenants = IntervenantActionDao::listerIntervenants();
         }else{
            switch ($context) {
                case "retraite":
                    $listeIntervenants = IntervenantActionDao::listerIntervenantsAttachedToRetraites();
                    break;
                
                default:
                    $listeIntervenants = IntervenantActionDao::listerIntervenants();
                    break;
                }
         }
        
        $htmlCode ="";
        $htmlCode.="<select name=\"".$name."\" size='".$size."' id='".$id."' class='".$cssClass."'";
       
        if($multiple == 1){
            $htmlCode .= " multiple='multiple' ";
        }
        $htmlCode.= ">";
        
        
        foreach ($listeIntervenants as $intervenant) { 
            $selected = "";
            if(in_array($intervenant->getId(), $selectedValue)){
                $selected = " SELECTED";
            }
            $htmlCode.= "<option value=".$intervenant->getId()." ".$selected.">".$intervenant->getPrenom()." ".$intervenant->getNom()."</option>";
        }
       
	$htmlCode.="</select>";
        
        return $htmlCode;
    }
    
    /**
     * Formulaire de connexion
     * @param type $divId
     * @return string 
     */
    public static function formConnect($divId,$action){
        
        
        
	
        $htmlCode ="<div id='".$divId."'>";
        
            $htmlCode .= "<form name='connect' id='connect' method='POST' action='".$action."'>";
            
            $htmlCode .="<table border='0' cellpadding='0' cellspacing='0'>
		<tr>
			<th>Mail</th>
			<td><input type='text' name='mail' id='mail' class='login-inp' /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type='password' name='password' id='password' value='************'  onfocus='this.value=''' class='login-inp' /></td>
		</tr>";
		/*$htmlCode .="<tr>
			<th></th>
			<td valign='top'><input type='checkbox' class='checkbox-size' id='login-check' /><label for='login-check'>Remember me</label></td>
		</tr>";*/
                
		$htmlCode .="<tr>
			<th></th>
			<td><input type='Submit' value='connection' name='connection' id='connection' class='submit-login'  /></td>
		</tr>
		</table>";
                $htmlCode .= "<input type='hidden' value='login' name='connection'>";
            
            
            $htmlCode .= "</form>";

        $htmlCode .="</div>";
        
        return $htmlCode;
        
    }
 
     /**
     * Mise à jour du USER
     * @return string 
     */
    public static function formCreateUser($hiddenFieldName,$mail){
       
        
        $htmlCode = "<form  method='POST' name='inscription' id='inscription'>
        <fieldset>
            <div id='modifyUser'>
                <label for='Nom'>".TextStatic::getText('Nom')."</label>
                <input type='text' name='Nom' id='Nom' class='text ui-widget-content ui-corner-all' value=''/>
                <br/>
                <label for='Prenom'>".TextStatic::getText('Prenom')."</label>
                <input type='text' name='Prenom' id='Prenom' class='text ui-widget-content ui-corner-all' value=''/>
                <br/>
                <label for='Mail'>".TextStatic::getText('Mail')."</label>
                <input type='text' name='Mail' id='Mail' class='text ui-widget-content ui-corner-all' value='".$mail."'/>
                <br/>

                <label for='Tel1'>".TextStatic::getText('Tel1')."</label>
                <input type='text' name='Tel1' id='Tel1' class='Tel1 text ui-widget-content ui-corner-all' value=''/>
                <br/>
                <label for='Tel2'>".TextStatic::getText('Tel2')."</label>
                <input type='text' name='Tel2' id='Tel2' class='Tel2 text ui-widget-content ui-corner-all' value=''/>
                <br/>
            </div>
            <div id='connect'>
                <label for='Login'>".TextStatic::getText('Login')."</label>
                <input type='text' name='Login' id='Login' class='Login text ui-widget-content ui-corner-all' value=''/>
                <br/>
                <label for='Password'>".TextStatic::getText('Password')."</label>
                <input type='password' name='Password' id='Password' class='Password text ui-widget-content ui-corner-all' value=''/>
                <br/>
                <label for='Password2'>".TextStatic::getText('PasswordVerif')."</label>
                <input type='password' name='Password2' id='Password2' class='Password text ui-widget-content ui-corner-all' value=''/>
                <br/>
            </div>
            <div id='valid'>
                <label for='newsletter'>".TextStatic::getText('Newsletter')."</label>
                <input type='checkbox' name='Newsletter' id='Newsletter' checked>
                <br/>
                <label for='OptIn'>".TextStatic::getText('Optin')."</label>
                <input type='checkbox' name='OptIn' id='OptIn' checked>
            </div>

            <input type='hidden' name='".$hiddenFieldName."' value='1' />
            </fieldset> 
            
            <input type='Submit' value=\"".TextStatic::getText('Submit')."\">
            </form>";
        return $htmlCode;
    } 
    
    /**
     *
     * @param type $hiddenFieldName
     * @param type $booSubmit
     * @param type $submitName
     * @return string 
     */
     public static function formModifyProfile($hiddenFieldName){
       
        $newsletter = "checked";
        $optin = "checked";
        $user = "";
        $nom = "";
        $login = "";
        $mail = "";
        $prenom = "";
        $tel1 = "";
        $tel2 = "";

        
        
        if(isset($_SESSION['user']) && $_SESSION['user'] instanceof User){
           $user = $_SESSION['user'];
           $nom = $user->getNom();
           $login = $user->getLogin();
           $mail = $user->getMail();
           if($user->getNewsletter()=="0"){
               $newsletter = "";
           }
           if($user->getOptIn()=="0"){
               $optin = "";
           }
           $prenom = $user->getPrenom();
           $tel1 = $user->getTel1();
           $tel2 = $user->getTel2();
           
        }
       
        $htmlCode = "<form  method='POST' name='inscription' id='inscription'>
        <fieldset>
            <div id='modifyUser'>
                <label for='Nom'>".TextStatic::getText('Nom')."</label>
                <input type='text' name='Nom' id='Nom' class='text ui-widget-content ui-corner-all' value='".$nom."'/>
                <br/>
                <label for='Prenom'>".TextStatic::getText('Prenom')."</label>
                <input type='text' name='Prenom' id='Prenom' class='text ui-widget-content ui-corner-all' value='".$prenom."'/>
                <br/>
                <label for='Mail'>".TextStatic::getText('Mail')."</label>
                <input type='text' name='Mail' id='Mail' class='text ui-widget-content ui-corner-all' value='".$mail."'/>
                <br/>

                <label for='Tel1'>".TextStatic::getText('Tel1')."</label>
                <input type='text' name='Tel1' id='Tel1' class='Tel1 text ui-widget-content ui-corner-all' value='".$tel1."'/>
                <br/>
                <label for='Tel2'>".TextStatic::getText('Tel2')."</label>
                <input type='text' name='Tel2' id='Tel2' class='Tel2 text ui-widget-content ui-corner-all' value='".$tel2."'/>
                <br/>
            </div>
            <div id='connect'>
                <label for='Login'>".TextStatic::getText('Login')."</label>
                <input type='text' name='Login' id='Login' class='Login text ui-widget-content ui-corner-all' value='".$login."'/>
                <br/>
            </div>
            <div id='valid'>
                <label for='newsletter'>".TextStatic::getText('Newsletter')."</label>
                <input type='checkbox' name='Newsletter' id='Newsletter' ".$newsletter.">
                <br/>
                <label for='OptIn'>".TextStatic::getText('Optin')."</label>
                <input type='checkbox' name='OptIn' id='OptIn' ".$optin.">
            </div>

            <input type='hidden' name='".$hiddenFieldName."' value='1' />
            <input type='Submit' name='".TextStatic::getText('ModifierTitre')."' value='save'/>
            </fieldset> </form>";
        return $htmlCode;
    }
    
    /**
     *
     * @param type $hiddenFieldName
     * @param type $booSubmit
     * @param type $submitName
     * @return string 
     */
     public static function formModifyPassWord($hiddenFieldName){
       
        $htmlCode = "<form  method='POST' name='inscription' id='inscription'>
        <fieldset>
            <div id='modifyPassWord'>
                <label for='Password'>".TextStatic::getText('Password')."</label>
                <input type='password' name='Password' id='Password' class='Password text ui-widget-content ui-corner-all' value=''/>
                <br/>
                <label for='Password2'>".TextStatic::getText('PasswordVerif')."</label>
                <input type='password' name='Password2' id='Password2' class='Password text ui-widget-content ui-corner-all' value=''/>
                <br/>
            </div>
           <input type='hidden' name='".$hiddenFieldName."' value='1' />
            <input type='Submit' name='".TextStatic::getText('ModifierTitre')."' value='save'/>
            </fieldset> </form>";
        return $htmlCode;
    } 
    
    /**
     * Form envoi de mail
     * @param type $mail
     * @return string 
     */
    public static function formContact($hiddenFieldName){
        $htmlCode = "";
        echo '<form name = "mail" action = "#" method = "POST">';
        echo "ICI FORMULAIRE DE CONTACT";
        $hiddenFieldName="";
        echo '</form>';
        
        return $htmlCode;
    }
    
    /**
     *  Inscription Newsletter 
     * @return String
     */
    public static function formNewsletter($hiddenFieldName){
        
        $htmlCode = "";
        $htmlCode .= TextStatic::getText('TitreNewsletter');
        $htmlCode .= "<form action='index.php?page=inscription' name='SuscribeNewsletter' method='POST'>";
        $htmlCode .= "<input name='email'>";
        $htmlCode .= "<input type='Submit' value='".TextStatic::getText('Submit')."'>";
        $htmlCode .= "</form>";
        
        return $htmlCode;
    }
    
    
    public static function SelectRegions($contientDesRetraites,$name,$id,$size,$cssClass,$multiple,$valueSelected){
       
        
        $listeRegion = GeoLocalisation::getListeRegions($contientDesRetraites);
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
            if($multiple == 1){$htmlCode .= " multiple='multiple' ";}
        $htmlCode.= ">";
        
        foreach ($listeRegion as $region) { 
            
            $htmlCode.= "<option value=".$region['Id'];
            if(!is_null($valueSelected)){
                foreach ($valueSelected as $value) {
                    if($region['Id'] == $value){
                        $htmlCode.=" selected ";
                    }
                }
            }    
            $htmlCode.= ">".$region['Nom']."</option>";
        }
	$htmlCode.="</select>";
        
        return $htmlCode;
    }

    public static function SelectDepartements($contientDesRetraites,$name,$id,$size,$cssClass,$multiple,$valueSelected,$type){
            
        
        $listeDepartements = GeoLocalisation::getListeDepartements($contientDesRetraites,$type);
        $htmlCode ="";
        $htmlCode.="<select name='".$name."' size='".$size."' id='".$id."' class='".$cssClass."'";
            if($multiple == 1){$htmlCode .= " multiple='multiple' ";}
        $htmlCode.= ">";

        foreach ($listeDepartements as $departement) { 
            $htmlCode.= "<option value=".$departement['Code'];
            if(!is_null($valueSelected)){
                foreach ($valueSelected as $value) {
                    if($departement['Code'] == $value){
                        $htmlCode.=" selected ";
                    }
                }
            }
            $htmlCode.=">".$departement['Nom']."</option>";
        }
        $htmlCode.="</select>";

        return $htmlCode;
    }
}
?>
