<?php 
    $sugg="";
    $adh="";
    $annon="";
    $result="";
    $message = "";
    if(isset($_GET['action'])){
        $selected = "SELECTED";
        switch ($_GET['action']) {
            
            case 1:
                $sugg = $selected;
                break;
            case 2:
                $adh = $selected;
                break;
            case 3:
                $annon = $selected;
                break;
            default:
                break;
        }
    }
    
    // Vérification du formulaire et envoi du mail.
    if(isset($_POST['contact'])){
        $message = "alert";
        $err = "";
        $nom        ="";
        $mail       ="";
        $objet      ="";
        $message    ="";
        if(isset($_POST['nom'])){
            
            if(!is_null($_POST['nom']) && $_POST['nom']!=""){
                $nom = $_POST['nom'];
            }else{
                $err .= "Merci de saisir un nom<br/>";
            }
        }
        if(isset($_POST['mail'])){
            if(!is_null($_POST['mail']) && $_POST['mail']!=""){
                if(FormValidation::checkField('mail', $_POST['mail'], "mail") == ""){
                    $mail = $_POST['mail'];
                }else{
                    $err  .= "Format de l'adresse email incorrect<br/>";
                }
                
            }else{
                $err .= "Merci de saisir une adresse email<br/>";
            }
            
        }
        if(isset($_POST['objet'])){
            if(!is_null($_POST['objet']) && $_POST['objet']!=""){
                $objet = $_POST['objet'];
            }else{
                $err .= "Merci de sélectionner un objet<br/>";
            }
        }
        if(isset($_POST['message'])){
             if(!is_null($_POST['message']) && $_POST['message']!=""){
                $message = $_POST['message'];
            }else{
                $err .= "Merci de saisir un message<br/>";
            }
        }
        
        if($err ==""){
            $to = $_ENV['properties']['Contact']['mail'];
            if(UtilMail::envoyerMessage($to, $mail, $objet, $message)){
                UtilMail::envoyerMessage($mail, $to, "SPIBOOK, merci pour votre mesage", "Nous avons bien re&ccedil;u votre message et le prendrons en compte dans les meilleurs d&eacute;lais.  A bient&ocirc;t sur SPIBOOK.");
                $result = "Le message a bien &eacute;t&eacute; envoy&eacute;";
                $message = "success";
                
            }  else {
                $result = "Une erreur s'est produite, nous pr&eacute;sentons nos excuses pour ce d&eacutesagr&eacute;ment";
                
            }
        }else{
            $result = $err;
        }
        
    }
        
?>
<div class="row">    
            <div class="twelve columns">
                <?php
//                    echo "<h1>".TextStatic::getText("TitreContact")."</h1>";
//                    echo "<p class='justify'>".TextStatic::getText("DescriptionContact")."</p>";
                ?>
            </div>
            <div class="twelve columns">
                
                
                
                <div class="eight columns panel">
                    <?php if($message!=""){ ?>
                    <div class="alert-box <?php echo $message; ?>">
                        <?php echo $result; ?>
                        <a href="" class="close">&times;</a>
                    </div>
                <?php } ?>
                    
                    
                    <form action="" method="POST">
                        <label class='label' for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" class="contactItem contactField"/>
                        <label class='label' for="mail">Mail</label>
                        <input type="text" name="mail" id="mail" class="contactItem contactField"/>
                        <label class='label' for="objet">Objet</label>
                        <select name="objet" id="objet" class="contactItem medium contactField">
                            <option value="suggestion" <?php echo $sugg; ?>>Suggestions sur le fonctionnement du site</option>
                            <option value="Demande d'adhésion" <?php echo $adh; ?>>Je souhaite diffuser mes événements</option>
                            <option value="Annonceur" <?php echo $annon; ?>>Je souhaite communiquer via Spibook</option>
                        </select>
                        <label class='label' for="message">Message</label>
                        <textarea name="message" id="message" class="contactItem contactTextArea"></textarea>
                        <input class='button' type="submit" value="ok" name="contact"/>
                        <input class='button' type="reset" value="reset"/>
                    </form>
                </div>
                <div class="four columns">
                    <div class="twelve columns panel">
                        <p>Vous souhaitez intégrer le projet et diffuser vos événements sur Spibook</p>
                    </div>
                    <div class="twelve columns panel JustifyText">
                        <p>Spibook étant en perpétuelle amélioration, n'hésitez pas à nous faire part de vos suggestions.</p>
                    </div>
                    <div class="twelve columns panel justify">
                        <p>Vous êtes organisateur d'événements spirituels (pélerinage, université d'été, groupes de prières...)</p>
                        <p>Bénéficiez de l'audience de SPIBOOK pour faire connaitre votre activité</p>
                    </div>
                </div>
            </div>
           
        
         
         
    </div>
    <!-- FIN MAIN CONTENT SECTION--> 