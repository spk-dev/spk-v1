<!-- DEBUT MENU -->    
    <div class="row">
        
<!--        <div class="twelve columns">-->
        <!-- Navigation -->
            <ul class="nav-bar">
                <li class="three columns spibook_admin_menu_item menuAdmin3">
                    <a href="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminLieuLien"); ?>" class="textMenuAdmin">
                        <?php echo TextStatic::getText("MenuAdminLieu"); ?>
                    </a>
                </li>
                
                <li class="three columns spibook_admin_menu_item menuAdmin2">
                    <a href="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminRetraitesLien2"); ?>" class="textMenuAdmin">
                        <?php echo TextStatic::getText("MenuAdminRetraites"); ?>
                    </a>
                </li>
                
                <li class="three columns spibook_admin_menu_item menuAdmin4">
                    <a href="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAminContactLien"); ?>" class="textMenuAdmin">
                        <?php echo TextStatic::getText("MenuAminContact"); ?>
                    </a>
                </li>
                <li class="three columns spibook_admin_menu_item menuAdmin1">
                    <a href="<?php echo $_ENV['properties']['Page']['defaultAdmin']."?".TextStatic::getText("MenuAdminIdLien"); ?>" class="textMenuAdmin">
                        <?php echo TextStatic::getText("MenuAdminId"); ?>
                    </a>
                    
                </li>
                
            </ul>
<!--        </div>-->
      <!-- End Navigation -->
     </div> 
<!-- FIN MENU --> 