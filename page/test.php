<?php
$mail  = rand(1, 1000);
$email = "aaa".$mail."@gmail.com";
$id = 568849;

 $mj = new Mailjet();
 
 
 
 
  $params = array(
        'method' => 'POST',
        'contact' => $email,
        'id' => $id,
        'force' => true
    );
    # Call
    $response = $mj->listsAddContact($params);
    $response = json_encode($response);
    AppLog::ecrireLog("eighties".$response, "debug");
//    AppLog::ecrireLog("eighties status".$response['status'], "debug");
    
    foreach( $response as $key => $valeur)  
        { 
            AppLog::ecrireLog("eighties".$key." ".$valeur, "debug");
        }
    
            # Parameters
//$params = array(
//
//    'contact' => $email
//);
//
//$response = $mj->contactInfos($params);
////$response = json_encode($response);
////echo $response;
////echo "<br/>";
////echo "suite ";
////$response = json_decode($response);
//echo "<br/>";
//foreach( $response->lists as $valeur)  
//    { 
//            echo "active : ".$valeur->active."<br/>";
//            echo 'id : '.$valeur->list_id.'</br>';
//            
//// mettre ici ta "méthode qui compte les messages envoyés"
//    }
//    echo "fin";