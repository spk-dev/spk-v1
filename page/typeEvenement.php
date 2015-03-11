 <div class="row">    
            <div class="twelve columns">
                
            
            <?php // echo TypeEvenementAction::afficherTousLesTypesEvenements(3,null,false); ?>

                <?php 
                
                    $listeTypes = TypeEvenementAction::listerTousLesTypes(true);
                ?>
          

            <ul class="block-grid three-up mobile-two-up" >
                   <?php
                        
                        foreach($listeTypes as $type){

                            $img = HtmlUtilComponents::imageControl("categorie", $type->getPhoto(),0);
                            $filter =new EvenementSearchCriteria();
                            $filter->setEvenementType(array($type->getId()));
                    ?>
                    <li>
                        
                        
                    <div class="twelve columns">
                        <div class='twelve'>
                            <a href='index.php?page=evenement&filter&typeEvenement=<?php echo $type->getId(); ?>'> 
                                <img src='<?php echo $img; ?>' class=' twelve' title='<?php echo $type->getLibelle(); ?>' alt='<?php echo $type->getLibelle(); ?>'/>
                            </a>
                        </div>
                        <div class='twelve'>
                             <a href='index.php?page=evenement&filter&typeEvenement=<?php echo $type->getId(); ?>'>  
                                <?php echo $type->getLibelle(); ?>
                            </a>
                            <br/><?php echo EvenementAction::compterNbEvenements($filter); ?> événement(s)
                        </div>
                        &nbsp;
                       
                    </div>
                         
                        
                        

                    </li>
                    <?php
                        }
                   
                    ?>
                </ul>
        
           </div>
         
    </div>
    <!-- FIN MAIN CONTENT SECTION--> 