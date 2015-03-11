<?php
/* Configure le limiteur de cache à 'private' */

//$cache_limiter = session_cache_limiter();

/* Configure le délai d'expiration à 30 minutes */
session_cache_expire(4);
//$cache_expire = session_cache_expire();
session_start();


include("../services/MainIndex.class.php");

$admin = new MainIndex();

$admin->setBooAdmin(true);
$admin->setDefault_page("organisateur");
$admin->setConnexion_page('connect');
$admin->setPage_dir("../page_superadmin/");
$admin->init();



if(isset($_GET['recover'])){
    $key = $_GET['recover'];
     if(AdministrateurAction::sendAdministratorNewPwd(urldecode($key))){
        $pageToRedirect .= "?page=connect&msg=".urlencode("Votre nouveau mot de passe vient de vous être envoyé par mail.<br/>Si vous ne recevez rien, pensez à vérifier dans les messages indésirables.");
    }else{
        $pageToRedirect .= "?page=connect&msg=".urlencode("Une erreur a eu lieu, l'envoi du mot de passe est impossible. <br/>Vous pouvez contacter directement le webmaster : <a mailto='contact@spibook.com'>contact@spibook.com</a>");
    }
    Redirect::header($pageToRedirect);
}


if(isset($_POST['deconnexion'])){
    UtilSession::logoutSession();
    Redirect::toPage($_ENV['Page']['defaultSuperAdmin']); 
}


if(isset($_POST['connexion'])){
    $mail = $_POST['mail'];
    $pass = $_POST['password'];

    $connexionStatus = AdministrateurAction::logIn($mail, $pass, true);

    $pageToRedirect = "superadmin.php";
    if(!$connexionStatus){
        $pageToRedirect .="?connexionResult=ko";
    }
    
    Redirect::header($pageToRedirect);
    
}
if(isset($_POST['sendPwd'])){
    
    $pageToRedirect = "superadmin.php";
    $mail = $_POST['mail'];
    if(AdministrateurAction::sendAdministratorRecoveryLink($mail)){
        $pageToRedirect .= "?msg=".urlencode("Un mail vient de vous être envoyé.<br/>Si vous ne recevez rien, pensez à vérifier dans les messages indésirables.");
    }else{
        $pageToRedirect .= "?msg=".urlencode("Une erreur a eu lieu, l'envoi du mot de passe est impossible. <br/>Vous pouvez contacter directement le webmaster : <a mailto='contact@spibook.com'>contact@spibook.com</a>");
    }
    
    Redirect::header($pageToRedirect);
}


require_once('inc/supadmin/Header.php');

if(UtilSession::isSessionLoaded()){
    require_once('inc/supadmin/Menu.php');  
}

$admin->run();
if($_ENV['properties']['Infos']['plateforme'] != "prod"){
    require_once('inc/bugTracker.php');
}
require_once('inc/supadmin/Footer.php');

   
?>