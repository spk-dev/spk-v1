 <ul class="block-grid four-up mobile-two-up" >
                   <?php
                        
                        foreach($listeRetraite as $evenement){
                             
                        $datedebut = new DateTime($evenement->getDateDebut());
                        $datefin = new DateTime($evenement->getDateFin());
                        $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(),0);
                       
                        $lieu = LieuAction::recupererUnLieu($evenement->getLieu());
                        $listeTheme = ThemeAction::recupererThemesForRetraite($evenement->getId());
                        $typeEvenement = TypeEvenementAction::recupererUnType($evenement->getTypeEvenement()); 
                    ?>
                    <li>
                        
                        
                    <div class="itemListeEvent">
                        <div class='twelve'>
                            <a href='index.php?page=evenementDe tail&id=<?php echo $evenement->getId(); ?>'> 
                                <img src='<?php echo $img; ?>' class='imgCaptionListe twelve' title='<?php echo $evenement->getNom(); ?>' alt='
                                        <br/>
                                     <?php echo $typeEvenement->getLibelle(); ?>
                                     <br/>
                                     <a href=\"index.php?page=organisateurDetail&id=<?php echo $lieu->getId(); ?>\"><?php echo $lieu->getNom(); ?></a>
                                     <br/>
                                     <?php echo date_format($datedebut, 'd/m/Y'); ?> - <?php echo date_format($datefin, 'd/m/Y'); ?>
                                     <br/>
                                    
                                '/>
                            </a>
                        </div>
                        <div class='twelve columns titreItemListeEvent'>
                            <a href='index.php?page=evenementDetail&id=<?php echo $evenement->getId(); ?>'> 
                                <?php echo $evenement->getNom(); ?>
                            </a>
                        </div>
                        &nbsp;
                            <?php
//                                        foreach ($listeTheme as $theme) {
//                                             echo "<a href=\"".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&theme=".$theme->getId()."\" >";
//                                             echo $theme->getnom();
//                                             echo "</a> |";
//                                        }
                                    ?>
                    </div>
                         
                        
                        

                    </li>
                    <?php
                        }
                   
                    ?>
                </ul>