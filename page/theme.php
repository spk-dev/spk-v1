 <div class="row">    

    <div class="twelve columns">
    
        <?php 
               $listeTheme = ThemeAction::recupererThemesFromRetraites2(null, null, 'nb','desc'); ?>
            
             <ul class="block-grid two-up mobile-two-up"> 
             <?php foreach($listeTheme as $elementTheme){ 
                 $img = HtmlUtilComponents::imageControl("themes", $elementTheme->getImage(), 1);
                 
                 ?>
                 <li class=''>
                     <div class="twelve columns ">
                        <a href="index.php?page=themeDetail&themeId=<?php echo $elementTheme->getId(); ?>">
                        <h4 class="titreTheme" id=""><?php echo $elementTheme->getNom(); ?>
                            <small>: <?php echo $elementTheme->getNbEvent();?> 
                                <?php if($elementTheme->getNbEvent()>1){echo "événements";}else{echo "événement"; }?>   
                            </small>
                        </h4>
                        <img class='five columns' src='<?php echo $img; ?>' alt='<?php echo $elementTheme->getNom(); ?>' title='<?php echo $elementTheme->getNom(); ?>' />
                        </a>
                        <div class="seven columns descriptionTheme">
                            <?php echo TextStatic::lireLaSuite($elementTheme->getDescription(),"index.php?page=themeDetail&themeId=".$elementTheme->getId(),90); ?>
                        </div>
                     </div>
                     
                         
                 </li>
             <?php } ?>
             </ul>
        
    </div>
</div>
