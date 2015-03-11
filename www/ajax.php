<?php

include('main.class.php');
$index = new Index();
$index->init();


if(isset($_GET['json'])){
    $json = $_GET['json'];
    
    switch ($json) {
        case "ci":
            if(isset($_GET['q'])){
                $ci = $_GET['q'];
                $liste = ProblemeAction::listerCi($ci);
            }
            break;
        
        case "probleme":
            
            if(isset($_GET['q'])){
                $id = $_GET['q'];
                $liste = ProblemeAction::getListeGDPJson($id);
            }
            break;
        case "groupe":
            $type = null;
            if(isset($_GET['type'])){
                $type = $_GET['type'];
             }else{
                  $type = null;
             }   
            if(isset($_GET['q'])){
                $groupe = $_GET['q'];
                $liste = ProblemeAction::getListeGroupeJson($groupe,$type);
            }  
                
            break;
        case "dir":
            AppLog::ecrireLog("rentre dans JSON DIR", "debug");
            if(isset($_GET['q'])){
                $dir = $_GET['q'];
                AppLog::ecrireLog("Q : ".$dir, "debug");
                $liste = InfosAction::getListeDir($dir);
                
            }
            break;
        case "dep":
            AppLog::ecrireLog("rentre dans JSON DEP", "debug");
            if(isset($_GET['q'])&& $_GET['dir']){
                
                $idDir = $_GET['dir'];
                $dep = $_GET['q'];
                $liste = InfosAction::getListeDep($idDir,$dep);
                
            }
            break;
        case "srv":
            AppLog::ecrireLog("rentre dans JSON SRV", "debug");
            if(isset($_GET['q'])&& $_GET['dep']){
                $idDep = $_GET['dep'];
                $srv = $_GET['q'];
                $liste = InfosAction::getListeSrv($idDep,$srv);
                
            }
            break;     
        case "phase":
        AppLog::ecrireLog("rentre dans JSON phase", "debug");
        if(isset($_GET['q'])){

            $phase = $_GET['q'];
            $liste = InfosAction::getListePhase($phase);

        }
        break;     
        case "etat":
        AppLog::ecrireLog("rentre dans JSON SRV", "debug");
        if(isset($_GET['q'])){

          
            $etat = $_GET['q'];
            $liste = InfosAction::getListeEtat($etat);

        }
        break;     
        default:
            $liste = array("erreur","erreur");
            break;
    
        
        
    }
    
    echo json_encode($liste);
    
    
    
    
    
    
    
    
    
}



?>
