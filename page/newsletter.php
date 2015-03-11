

<div class="row">    
            <div class="twelve columns">
                <h3>Newsletter</h3>
            </div>
            <div class="twelve columns">
                
                
                <div class="two columns"></div>
                <div class="eight columns panel">
                   
                    <?php 
    
                    if(isset($_GET['unsuscript'])){
                       $key = $_GET['unsuscript'];
                       if(NewsletterAction::unsuscribe($key)){
                           echo "Vous avez bien été désinscrit de la newsletter";
                       }else{
                           echo "Une erreur a eu lieu, merci de bien vouloir contacter l'administrateur";
                       }
                    }else if(isset($_POST['mail'])){
                        
                        $mail = SecurityUtil::securVarParam($_POST['mail']);
                        NewsletterAction::sendUnsuscriptionMail($mail);    
                    ?>
                    <h4>La procédure de désinscription vient d'être envoyé à votre adresse email.</h4>
                    <h5 class='subtitle'>Si vous ne recevez pas les instructions d'ici une minute ou deux, vérifiez les filtres de spams et de courriers indésirables de votre compte.</h5>
                    <?php
                    }else{

                    ?>
                    
                    <form action="" method="POST">

                        <label class='label' for="mail">Pour vous désinscrire, saisissez ici votre adresse email.</label>
                        <input type="text" name="mail" id="mail" class="contactItem contactField"/>
                        
                        <input class='button' type="submit" value="ok" name="contact"/>
                        <input class='button' type="reset" value="reset"/>
                    </form>
                <?php } ?>
                </div>
               
            <div class="two columns"></div>

        
         
         
    </div>
</div>
    <!-- FIN MAIN CONTENT SECTION--> 