<?php

include("../services/MainIndex.class.php");

$AjaxAction = new MainIndex();

$AjaxAction->setBooAdmin(false);
$AjaxAction->setDefault_page("home2");
$AjaxAction->setPage_dir("../page/");
$AjaxAction->init();

//
//$AjaxAction = new AjaxAction();
//$AjaxAction->init();


if(isset($_POST['testeur'])){
    

        AppLog::ecrireLog("rentre dans ajaxAction bug tracker", "debug");
        
        
        $testeur            = $_POST['testeur'];
        $date               = $_POST['date'];
        $mailTesteur        = $_POST['mail'];
        $page               = $_POST['page'];  
        $navigateur         = $_POST['navigateur'];
        $description        = $_POST['description'];
        
        $mail = new UtilMail();
        if($mail->mailBugTracker($testeur,$date,$mailTesteur,$page,$navigateur, $description)){
            $reponse = "Le bug a bien été signalé;";
        }else{
            $reponse = "Une erreur a eu lieu, merci de bien vouloir utiliser le formulaire de contact";
        }
        
        
        $array['reponse'] = $reponse;
        echo json_encode($array);

}

if(isset($_POST['intervenant-text-nom'])){
    
//    $action = $_GET['ajaxAction']; 
//    
//    // Ajout d'un intervenant.
//    if($action == "addIntervenant"){
        
        
        $interv['nom']          = $_POST['intervenant-text-nom'];
        $interv['prenom']       = $_POST['intervenant-text-prenom'];
        $interv['description']  = $_POST['intervenant-html-description'];
        $interv['mail']         = $_POST['intervenant-mail-mail'];
        $interv['genre']        = $_POST['intervenant-select-genre'][0];
        $interv['photo']        = $_POST['intervenant-text-nom'];
        $interv['titre']        = $_POST['intervenant-text-titre'];
        $idAdmin                = $_POST['idAdmin'];
        
        $photo = $_FILES['data-file-photo']['name'];
        
        $boo = IntervenantAction::enregistrerIntervenant($interv,$idAdmin);
        if($boo[0]){
            $reponse = "OK intervenant enregistr&eacute;";

        }else{
            $reponse = "erreur dans l'enregistrement";
        }
        
        $array['reponse'] = $reponse;
        echo json_encode($array);

}


if(isset($_GET['json'])){
    $json = $_GET['json'];
    
    switch ($json) {
        case "intervenants":
            if(isset($_GET['q'])){
                $intervenants = $_GET['q'];
                $liste = IntervenantAction::getListeIntervenantJson($intervenants);
                
            }
            break;
        case "lieux":
            if(isset($_GET['q'])){
                $lieu= $_GET['q'];
                $liste = LieuAction::listerLieuPourAjax($lieu);

            }
            break;
        case "administrateur":
          if(isset($_GET['q'])){
            $admin= $_GET['q'];
            $liste = AdministrateurAction::listerAdministrateurPourAjax($admin);
//            $liste = LieuAction::listerLieuPourAjax($lieu);

        }
            break;  
        default :
            break;
    }
    echo json_encode($liste);
}


//
//if(isset($_GET['loadIntervenantListe'])){
//    $listeIntervenants = IntervenantActionDao::listerIntervenants();
//    
//    $json = array();
//    $i=0;
//      foreach ($listeIntervenants as $intervenant) {    
//          $json[$intervenant->getId()]=$intervenant->getNomComplet();
//      }
//    
    
//    
//    
//}

?>