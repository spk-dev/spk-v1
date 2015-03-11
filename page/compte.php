<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_SESSION['user'])){
    Redirect::toPage("index.php");
    exit();
}else if(!is_object($_SESSION['user'])){
    Redirect::toPage("index.php");
    exit();    
}else{
    
    
$verifFieldMofifProfile = "modifProfile";    
$verifFieldModifPassword = "modifPassword";
    
if(isset($_POST[$verifFieldMofifProfile])){
    // Modification du profil
    echo UserAction::updateUser($_POST);
    
    echo "PROFILE UPDATE";
}elseif(isset($_POST[$verifFieldModifPassword])){
    echo UserAction::updateUserPassWord($_POST);
     echo "PASSWORD UPDATE";
}

    
    
    echo "<h1>Mon compte</h1>";

    $currentUser = $_SESSION['user'];
 
    echo "<div>";
    echo $currentUser;
    echo "</div>";

    echo "<div id='modifyProfile' class='UserModifPanel'>";
    echo "<h1>".TextStatic::getText("ModifierTitre")."</h1>";
    echo HtmlFormComponents::formModifyProfile($verifFieldMofifProfile);
    echo "</div>";
    
    echo "<div id='modifyPassword' class='UserModifPanel'>";
    echo "<h1>".TextStatic::getText("ModifierPassword")."</h1>";
    echo HtmlFormComponents::formModifyPassWord($verifFieldModifPassword);
    echo "</div>";




}

?>