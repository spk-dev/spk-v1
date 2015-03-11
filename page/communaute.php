<div class="row">    
            <div class="twelve columns">
                <?php
                    echo "<h1>".TextStatic::getText("TitreCommunaute")."</h1>";
                    echo "<p class='justify'>".TextStatic::getText("DescriptionCommunaute")."</p>";
                ?>
            </div>
    <div class ="twelve columns">
        
        

        
<?php

echo CommunauteAction::afficherToutesLesCommunautes(4);

//echo CommunauteAction::afficherUneCommunaute(1);

?>   