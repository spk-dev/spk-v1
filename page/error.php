  <?php
            if(isset($_GET['code'])){
                $code = $_GET['code'];
                 $cssId = "erreur".$code;
            }else{
                $code = "erreur";
                $cssId = "erreurGenerique";
            }
           
            
        ?>
<div class="row">
    
    <div class="twelve columns panel erreur" id="<?php echo $cssId; ?>">

        <?php echo TextStatic::getText($code); ?>
    </div>
    
</div>
<div class="row">
    
    <div class="twelve columns erreurliens" id="<?php echo $cssId; ?>">
        <a href="<?php echo $_ENV['properties']['Page']['defaultSite']; ?>">Retour à la page d'accueil</a>
        <br/><a href="javascript:history.back()">Page précédente</a>
        <br/>
        <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"; ?>">Nous contacter</a>
    </div>
    
</div>