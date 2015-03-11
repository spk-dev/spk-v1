
<?php


$booResult = false;
$err = array(); // Stock les messages d'erreur
//$redfields=array(); // Stock les champs en erreur pour les afficher en rouge.
//$redfields['nom']="";
$redfields['prenom']="";
$redfields['mail']="";
$redfields['intitule']="";
$redfields['adresse1']="";
$redfields['adresse2']="";
$redfields['cp']="";
$redfields['ville']="";
$redfields['mailorga']="";

$nom = "";
$prenom = "";
$mail = "";
$nomOrganisateur = "";
$adresse1 = "";
$adresse2 = "";
$cp = "";
$ville = "";
$tel = "";
$mailorga = "";
$isNewEmail = false;



if(isset($_POST['affiliate'])){
   
    
     
     
    $nom = filter_input(INPUT_POST, "nom");
    $prenom = filter_input(INPUT_POST, "prenom");
    $mail = filter_input(INPUT_POST, "mail");
    
    $nomOrganisateur = filter_input(INPUT_POST, "intitule");
    $adresse1 = filter_input(INPUT_POST, "adresse1");
    $adresse2 = filter_input(INPUT_POST, "adresse2");
    $cp = filter_input(INPUT_POST, "cp");
    $ville = filter_input(INPUT_POST, "ville");
    $tel = filter_input(INPUT_POST, "tel");
    $mailorga = filter_input(INPUT_POST, "mailorga");
    
    if($nom==""){
        array_push($err, "Nom administrateur");
        $redfields['nom']="error";
    }
    if($prenom==""){
        array_push($err, "Prenom administrateur");
        $redfields['prenom']="error";
    }
    if($mail=="" ){
        array_push($err, "Adresse email administrateur");
        $redfields['mail']="error";
    }else if(!FormValidation::checkField($mail, "mail")){
        array_push($err, "Format de mail Administrateur incorrect, format attendu : xxxxx@xxxx.xx");
        $redfields['mail']="error";
    }else if(AdministrateurAction::administrateurDejaExistant($mail)){
         array_push($err, "Cette adresse email est déjà associé à un compte.");
        $redfields['mail']="error";
    }
    
    
    if($nomOrganisateur==""){
        array_push($err, "Nom organisateur");
        $redfields['intitule']="error";
    }      
    if($adresse1=="" && $adresse2==""){
        array_push($err, "Adresse (au moins un des 2 champs doit être complété)");
        $redfields['adresse1']="error";
        $redfields['adresse2']="error";
    }
    if($cp==""){
        array_push($err, "Code postal");
        $redfields['cp']="error";
    }
    if($ville==""){
        array_push($err, "Ville");
        $redfields['ville']="error";
    }
                        
    if($mailorga==""){
        array_push($err, "Adresse email Organisateur");
        $redfields['mailorga']="error";
    }else if(!FormValidation::checkField($mailorga, "mail")){
        array_push($err, "Format de mail Organisateur incorrect, format attendu : xxxxx@xxxx.xx");
        $redfields['mailorga']="error";
    }

    AppLog::ecrireLog("3 - Dans affiliation - avant controle des erreurs", "debug");
    if(count($err)==0){
        AppLog::ecrireLog("4 - Dans affiliation - Pas d'erreur", "debug");
        $admin = new Administrateur();
        $admin->setNom($nom);
        $admin->setPrenom($prenom);
        $admin->setMail($mail);
        
        AppLog::ecrireLog("5 - Dans affiliation - Objet Admin ok", "debug");
        
        $lieu = new Lieu();
        
        $lieu->setValidationAdmin(1);
        $lieu->setValidationSuperAdmin(0);
        $lieu->setNom($nomOrganisateur);
        $lieu->setAdresse1($adresse1);
        $lieu->setAdresse2($adresse2);
        $lieu->setCp($cp);
        $lieu->setVille($ville);
        $lieu->setMail($mailorga);
        $lieu->setTel($tel);
        AppLog::ecrireLog("6 - Dans affiliation - Objet Lieu ok", "debug");
        $result = AdministrateurAction::inscrireAdministrateur($admin,$lieu);      
        AppLog::ecrireLog("7 - Dans affiliation - Après Inscription", "debug");
        $booResult = $result[0];
        $messageResult = $result[1];
        AppLog::ecrireLog("8 - Dans affiliation - booresult : [".$booResult."]", "debug");
        AppLog::ecrireLog("9 - Dans affiliation - messageResult : [".$messageResult."]", "debug");
        $utilMail = new UtilMail();
        AppLog::ecrireLog("10 - Dans affiliation - Objet Util mail ok : [".$messageResult."]", "debug");
        if($booResult){
            
            AppLog::ecrireLog("11 - Dans affiliation - Inscription OK", "debug");
            $classAlert = "success";

            if(!NewsletterAction::addEmailToMailJet($admin->getMail())){
                AppLog::ecrireLog("12 - Dans Affiliation- Impossible d'ajouter le mail à Mailjet", "debug");
            }else{
                AppLog::ecrireLog("13 - Dans Affiliation- Mail ajouter à Mailjet", "debug");
            }
            AppLog::ecrireLog("14 - Dans Affiliation- Avant envoi mail confirmation inscription", "debug");
            if($utilMail->mailConfirmationInscription($admin, $result[2])){
                AppLog::ecrireLog("15 - Dans Affiliation- Mail confirmation inscription OK", "debug");
            }else{
                AppLog::ecrireLog("16 - Dans Affiliation- Mail confirmation inscription KO", "debug");
            }
            AppLog::ecrireLog("17 - Dans Affiliation- Avant envoi mail confirmation webmaster", "debug");
            if($utilMail->mailInfoInscriptionWebmaster($admin, $result[2], true)){
                AppLog::ecrireLog("18 - Dans Affiliation- Mail confirmation webmaster OK", "debug");
            }else{
                AppLog::ecrireLog("19 - Dans Affiliation- Mail confirmation webmaster KO", "debug");
            }
        }else{
            AppLog::ecrireLog("20 - Dans Affiliation - impossible d'enregistrer l'admin.","debug");
            $utilMail->mailInfoInscriptionWebmaster($admin, $result[2], false);
            $classAlert = "alert";
        }
        
    }else{
        AppLog::ecrireLog("21 - Dans affiliation - Erreur de formulaire", "debug");
        $classAlert = "alert";
         $messageResult = "<p>Attention, les champs suivants sont obligatoires :</p>";
        foreach ($err as $value){
            $messageResult .= "<br/>".$value;
        }
    }
}

if($booResult){
    AppLog::ecrireLog("22 - Dans affiliation - BOORESULT = True - affichage de la page", "debug");
?>

<div class="row">
    <div class="twelve alert-box <?php echo $classAlert; ?>">
        <?php echo $messageResult; ?>
    </div>
</div>
<div class="row">
   <div class="four columns">
       
       <img src="images/spibook/Success.png" alt="succes"/></div>
    <div class="eight columns">
        <p>Pour se connecter à votre espace personnel Spibook : </p>
    
    <br/>
    
        <a href="admin.php">www.spibook.com/admin.php</a>
    </div>
    <br/>
</div>
<?php }else{ ?>

<?php if($messageResult != ""){ ?>
<div class="row">
    <div class="twelve alert-box <?php echo $classAlert; ?>">
        <?php echo $messageResult; ?>
        
        
        <a href="" class="close">&times;</a>
    </div>
</div>
<?php } ?>
<div class="row">    
    
<!--    <div class="twelve columns">-->
 
    <div class="eight columns">
        
        <form name="affiliation" id="affiliation" method="POST">
            <div class="twelve columns panel" id="administrateur">
                <h2 class="titrePage">Administrateur</h2>
                <div id="nom"><label for="nom">Nom *</label><input type="text" name="nom" value="<?php echo $nom; ?>" class="<?php if (isset($redfields['nom'])) echo $redfields['nom'];?>" placeholder="Indiquez votre nom (différent du nom de l'entité que vous représentez)"/></div>
                <div id="prenom"><label for="prenom">Prenom *</label><input type="text" name="prenom" value="<?php echo $prenom; ?>" class="<?php echo $redfields['prenom'];?>" placeholder="Indiquez votre prénom"/></div>
                <div id="mail"><label for="mail">Mail *</label><input type="text" name="mail" value="<?php echo $mail; ?>"  class="<?php echo $redfields['mail'];?>" placeholder="Ce mail servira d'identifiant de connexion"/></div>

            </div>
            <div class="twelve columns panel" id="organisateur">
                <h2 class="titrePage">Mon compte Spibook</h2>
                <div id="intitule"><label for="intitule">Intitulé *</label><input type="text" name="intitule" value="<?php echo $nomOrganisateur; ?>" class="<?php echo $redfields['intitule'];?>" placeholder="Saisir le nom de la structure organisatrice (nom de la communauté, de l'asso...)"/></div>
                <div id="adresse"><label for="adresse1">Adresse 1 *</label><input type="text" name="adresse1" value="<?php echo $adresse1; ?>" class="<?php echo $redfields['adresse1'];?>" placeholder="Cette adresse sera utilisée pour la géolocalisation."/>
                <label for="adresse2">Adresse 2</label><input type="text" name="adresse2" value="<?php echo $adresse2; ?>"  class="<?php echo $redfields['adresse2'];?>"/>            
                <label for="cp">Code postal *</label><input type="text" name="cp" value="<?php echo $cp; ?>" class="<?php echo $redfields['cp'];?>" /> 
                <label for="ville">Ville *</label><input type="text" name="ville" value="<?php echo $ville; ?>" class="<?php echo $redfields['ville'];?>"/>  </div>
                <div id="coordonnees"><label for="tel">Telephone</label><input type="text" name="tel" value="<?php echo $tel; ?>" class="<?php if (isset($redfields['tel'])) echo $redfields['tel'];?>"/> 
                <label for="mailorga">Adresse email *</label><input type="text" name="mailorga" value="<?php echo $mailorga; ?>"  class="<?php echo $redfields['mailorga'];?>" placeholder="Saisir le mail de la structure organisatrice."/></div>
<!--                <div><p>J'ai pris connaissance de la charte Spibook.</p><input type="Checkbox" name="accept"/></div>-->
            </div>
            
            <input type="Submit" name="affiliate" value="Ok" id="valid" class="button"/>
            
        </form>
    </div> 
    <div class="four columns">
        <div class="twelve ">
            <p>Spibook est le portail internet des événements catholiques de France.</p>
            <a href="http://blog.spibook.com/charte-dutilisation/" target="_blank" alt="charte spibook" name="la charte de spibook"><p>Lire la charte Spibook.</p></a>
        </div>
        <p>Pour vous inscrire sur Spibook, rien de plus simple.</p>
<p>L’inscription comprend 2 parties : l’administrateur et le compte Spibook.</p>
<p>L’administrateur est la personne en charge du compte Spibook. Il publie les événements, les modifie ou les supprime à tout moment. </p>
<br/>
<p>Le compte Spibook est la structure organisatrice des événements.  Seul le compte Spibook sera visible par l’internaute. </p>
<br/>
<a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=2"; ?>">
<p>Un problème, une question, n’hésitez pas à nous contacter.</p> 
</a>

    </div>

</div>

<?php
}
?>