<?php
    $resultInscriptionNewsletter = "";
    
    $newsletterInfoStyle = "";
  /**
     * PENDANT LE COMING SOON
     */

    if(isset($_POST['newsletter_inscription2'])){

        $email = $_POST['newsletter_email'];
        $nom = $_POST['newsletter_nom'];
        $prenom = $_POST['newsletter_prenom'];
        $optin = $_POST['newsletter_part'];
        $status = $_POST['newsletter_stat'];

        $err = "";
        $checkMail = FormValidation::checkField("email", $email, "Mail");
        if($checkMail != ""){
            $err .= "<br/>".$checkMail;
        }
        $checkNom = "";
        
        if($checkNom != ""){
            $err .= "<br/>".$checkNom;
        }

        if($err == ""){

           
            $tab = NewsletterActionDao::addEmail($nom,$prenom, $email, $optin, $status);
             if($tab==1){
                 UtilMail::envoyerMessage($email, $_ENV['properties']['Contact']['mail'], "SPIBOOK - Enregistrement &agrav; la newsletter.", "Votre inscription &agrav; la newsletter &agrav; bien &eacute;&eacute enregistr&eacute;e"); 
                $resultInscriptionNewsletter = "Votre adresse email a bien &eacute;t&eacute; enregistr&eacute;e.";
                $newsletterInfoStyle = "success";
            }else{
                
                $resultInscriptionNewsletter = "Une erreur a eu lieu, votre email n'a pas &eacute;t&eacute; enregistr&eacute;";
                $newsletterInfoStyle = "alert";
            }
        }else{
            $resultInscriptionNewsletter = $err;
            $newsletterInfoStyle = "alert";
        }

    }
    
?>
