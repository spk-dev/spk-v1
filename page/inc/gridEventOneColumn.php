 <?php
                        foreach($listeEvenements as $evenement){
                             
                        $datedebut = new DateTime($evenement->getDateDebut());
                        $datefin = new DateTime($evenement->getDateFin());
                        $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(),0);
                       
                        $lieu = LieuAction::recupererUnLieu($evenement->getLieu());
                        $listeTheme = ThemeAction::recupererThemesForRetraite($evenement->getId());
                        $region = GeoLocalisation::getRegion($lieu->getCp());
                        $dep = GeoLocalisation::getDepartement($lieu->getCp());
                    ?>
                        
                        <div class='ligneEvent row'>
                            <div class='four columns imgLigneEvent'>
                                <div class='row'>
                                    <a href='index.php?page=evenementDetail&id=<?php echo $evenement->getId(); ?>'> 
                                        <img src='<?php echo $img; ?>' title='<?php echo $evenement->getNom(); ?>' alt='<?php echo TextStatic::ResumeText($evenement->getDescription(),100); ?>'/>
                                    </a>
                                </div>
                            </div>
                            <div class='eight columns descriptionLigneEvent'>
                                <div class='twelve titreLigneEvent'>                                    
                                     <a href='index.php?page=evenementDetail&id=<?php echo $evenement->getId(); ?>'> 
                                        <?php echo $evenement->getNom(); ?>
                                     </a>
                                </div>
                                <div class='row'>
                                <div class='eight columns organisationLigneEvent'>
                                     <?php echo $region['Nom']; ?> /  <?php echo $dep['Nom']; ?>
                                    <br/>
                                    <a href="index.php?page=organisateurDetail&id=<?php echo $lieu->getId(); ?>">
                                        <?php echo $lieu->getNom(); ?>
                                    </a>
                                </div>
                                <div class='four columns dateLigneEvent'>
                                    du <?php echo date_format($datedebut, 'd/m/Y'); ?><br/>au <?php echo date_format($datefin, 'd/m/Y'); ?>
                                </div>
                                </div>
                                <div class='twelve'>
                                    <?php
                                    
                                        foreach($listeTheme as $theme){
                                            
                                            echo "<span class=\"tagThemeSmall\" >";
                                            echo "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&theme=".$theme->getId()."' alt='Evènements Catholiques : ".$theme->getNom()." avec Spibook' title='Evènements Catholiques : ".$theme->getNom()." avec Spibook' >";
                                            echo $theme->getNom();
                                            echo "</a>";
                                            echo "</span>";
                                            echo "&nbsp;";
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        
                    <?php
                        }

                    ?>