<!-- DEBUT MENU -->    
    <div class="row">
        <div class="twelve columns">
        <!-- Navigation -->
            <ul class="nav-bar">
                  
                  <li class="spibook_menu_item">
                      <b><a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienLieux");?>">Les destinations</a></b>
                        
                        <?php echo MenuAction::getRegions(true,"p"); ?>
                        <?php echo MenuAction::getCommunautes(true,"p"); ?>
                                
                            
                    </li>
                    <li class="spibook_menu_item">
                        <b><a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienThemes");?>">Les thématiques</a></b>
                        <?php echo MenuAction::getThemes(true,"p"); ?>
                        
                    </li>
                    <li class="spibook_menu_item">
                          <b><a>Le calendrier</a></b>
                        <?php echo MenuAction::getDates("p"); ?>
                    </li>
                  
                    <li class="spibook_menu_item">
                        <b><a href="#" class="">Spibook</a></b>
                        
                        <?php echo MenuAction::getSpibook("p"); ?>
                            
                    </li>
                    
            </ul>
        </div>
      <!-- End Navigation -->
     </div> 
<!-- FIN MENU -->  