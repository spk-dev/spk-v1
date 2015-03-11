 <div class="row">    
            <div class="twelve columns">
                <?php
                    echo "<h1>".TextStatic::getText("TitreIntervenant")."</h1>";
                    echo "<p class='justify'>".TextStatic::getText("DescriptionIntervenant")."</p>";
                ?>
            </div>
            <div class="twelve columns">
<!--            Liste des retraites-->
            <?php echo IntervenantAction::afficherTousLesIntervenants(); ?>
            
<!--            FIn liste des retraites-->
  
            </div>
            
            <div class="twelve columns " style="margin:3em 0 0 0;">
                <p><img src="http://lorempixel.com/728/90/city/Pub-masqueSurMobile/" /></p>
               
            </div>

        
         
         
    </div>
    <!-- FIN MAIN CONTENT SECTION--> 