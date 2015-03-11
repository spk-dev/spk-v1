

        <div class="row">    
<!--            <div class="twelve columns">-->
                <?php
//                    echo "<h1>".TextStatic::getText("TitreLieu")."</h1>";
//                    echo "<p class='justify'>".TextStatic::getText("DescriptionLieu")."</p>";
                ?>
<!--            </div>-->
            
<!--            Liste des retraites-->
            
<!--            FIn liste des retraites-->

            <!-- Nav Sidebar -->
            <!-- This is source ordered to be pulled to the left on larger screens -->
            <div class="four columns">
            <div class="panel">
                 <?php echo HtmlUtilComponents::displayFilterOnPage("lieu");?>
            </div>

            <!-- FIN BLOC PARTENAIRE 2 --> 
            </div>
            <div class="eight columns">
                
                <?php echo LieuAction::afficherListesLieux("listeLieux","listePrincipale"); ?>
            </div>

            <!-- Right Sidebar -->
            <!-- On small devices this column is hidden -->
<!--            <aside class="three columns hide-for-small">
                <p><img src="http://lorempixel.com/300/400/city/Pub-masqueSurMobile/" /></p>
                <p><img src="http://lorempixel.com/300/400/nature/Pub-masqueSurMobile/" /></p>
            </aside>-->

        
         
         
    </div>
    <!-- FIN MAIN CONTENT SECTION--> 