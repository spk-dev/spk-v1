<!-- DEBUT MENU -->    

    <div class="row">
        <div class="twelve columns">
        <!-- Navigation -->

            <ul class="nav-bar twelve hide-for-small">
                  
                  <li class="three columns has-flyout has-mega-flyout spibook_menu_item" id="menu_1stlevelEvenement">
                       <a href="<?php echo "index.php?page=evenement"; ?>" >Evenements</a>
                        <a href="#" class="flyout-toggle"><span> </span></a>
                        <div class="mega flyout" id="subDestinations">
                            <div class="two columns">
                                <img src="images/spibook/calendar.png" alt="destinations_large"/>
                            </div>
                            <div class="ten columns">
                                <h6>Agenda</h6>
                                    <?php echo MenuAction::getDates("p"); ?>
                                 <h6>Types d'événements</h6>
                                    <?php echo MenuAction::getTypesEvenements(true,"p"); ?>
                                <h6>Retrouvez les événements près de chez vous</h6>
                                    <?php echo MenuAction::getRegions("p","evenements"); ?>
                            </div>
                            
                            
                        </div>
                    </li>
                    <li class="three columns has-flyout has-mega-flyout spibook_menu_item" id="menu_1stlevelOrganisateur">
                        <a href="<?php echo "index.php?page=organisateur"; ?>" >Organisateurs</a>
                        <a href="#" class="flyout-toggle"><span> </span></a>
                        <div class="mega flyout">
                            <div class="two columns">
                            <img src="images/spibook/organisateur.png" alt="destinations_large"/>
                            </div>
                            <div class="ten columns">
                                <h6>Les organisateurs près de chez vous</h6>
                                    <?php echo MenuAction::getRegions("p","organisateurs"); ?>
                                
                            </div>
                        </div>
                    </li>
                    <li class="three columns has-flyout has-mega-flyout spibook_menu_item" id="menu_1stlevelThematiques">
                        <a href="<?php echo "index.php?page=theme"; ?>" >Thématiques</a>
                        <a href="#" class="flyout-toggle"><span> </span></a>
                        <div class="mega flyout">
                            <div class="two columns">
                            <img src="images/spibook/thematique.png" alt="destinations_large"/>
                            </div>
                            <div class="ten columns">
                                    <h6>Retrouvez les événements qui vous concernent</h6>
                                    <?php echo MenuAction::getThemes(true,"p");?>
                            </div>
                        </div>
                    </li>
<!--                  <li class="three columns has-flyout has-mega-flyout spibook_menu_item" id="menu_1stlevelCategories">-->
                  <li class="three columns spibook_menu_item" id="menu_1stlevelCategories">
                        <a href="<?php echo "index.php?page=inscription"; ?>">Inscription</a>
<!--                        <a href="#" class="flyout-toggle"><span> </span></a>
                        <div class="mega flyout">
                            <div class="two columns">
                            <img src="images/spibook/category.png" alt="destinations_large"/>
                            </div>
                            <div class="ten columns">
                                <h6>Pour les organisateurs d'événements</h6>
                                <p><a href="index.php?page=inscription">S'inscrire sur Spibook</a></p>
                                <p><a href="admin.php">Mon espace spibook</a></p>
                            </div>
                        </div>-->
                    </li>
                    
            </ul>
<!--            <ul class="nav-bar twelve show-for-small">

                 <li class="three columns spibook_menu_item" id="menu_1stlevelEvenement">
                      <a href="<?php echo "index.php?page=evenement"; ?>" >Evenements</a>

                   </li>
                   <li class="three columns spibook_menu_item" id="menu_1stlevelOrganisateur">
                       <a href="<?php echo "index.php?page=organisateur"; ?>" >Organisateurs</a>
                   </li>
                   <li class="three columns spibook_menu_item" id="menu_1stlevelThematiques">
                       <a href="<?php echo "index.php?page=theme"; ?>" >Thématiques</a>

                   </li>

                 <li class="three columns spibook_menu_item" id="menu_1stlevelCategories">
                       <a href="<?php echo "index.php?page=inscription"; ?>">Inscription</a>

                   </li>

           </ul>-->
        </div>
      <!-- End Navigation -->
     </div> 
<!-- FIN MENU --> 
</div>