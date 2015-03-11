<?php
    $nom = "";
    $readOnlyName = "";
    $readOnlyMail = "";
    $mail = "";
    $readOnlyPage = "";
    $page = "";
    $navigateur = "";
    $readOnlyNavigateur= "";
    
    if(UtilSession::isSessionLoaded()){
        AppLog::ecrireLog("Bug tracker, la session est active", "debug");
       
        $admin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId());
        $nom = $admin->getPrenom()." ".$admin->getNom();
        if($nom != ""){$readOnlyName = "readonly";}
        $mail = $admin->getMail();
        if($mail != ""){$readOnlyMail = "readonly";}
    }
    $navigateur = UtilNavigateur::getNavigateur();
    if($navigateur != ""){$readOnlyNavigateur = "readonly";}
    
    $page = Redirect::getCurrentUrl();
    if($page != ""){$readOnlyPage = "readonly";}
    
    $dateTime = new DateTime();
    $date = $dateTime->format('Y-m-d H:i:s');
   
?>

<div id="bugTracker" class="reveal-modal medium">
    
    
    <h1>Signaler un dysfonctionnement</h1>
    <a class="close-reveal-modal">&#215;</a>
    
    
    <form action="ajaxManagement.php" method="POST" id="bugTrackerForm" name="bugTrackerForm">
        <input type="hidden" name="date" id="date" value="<?php echo $date; ?>"/>
        <label for="testeur" >Votre nom</label>
        <input type="text" name="testeur" id="testeur" value="<?php echo $nom; ?>" <?php echo $readOnlyName; ?>/>
        <label for="mail" >Votre mail</label>
        <input type="text" name="mail"  id="mail" value="<?php echo $mail; ?>" <?php echo $readOnlyMail; ?>/>
        <label for="page" >Page</label>
        <input type="text" name="page"  id="page" value="<?php echo $page; ?>" <?php echo $readOnlyPage; ?>/>
        <label for="navigateur" >Navigateur</label>
        <input type="text" name="navigateur" id="navigateur" value="<?php echo $navigateur; ?>" <?php echo $readOnlyNavigateur; ?>/>
        <label for="description" >Description</label>
        <textarea name="description" id="description">
        </textarea>
        <input class="round button" type="Submit" id="bugTrackerSubmit" name="bugTrackerSubmit" value="Signaler"/>
    </form>
    
</div>
