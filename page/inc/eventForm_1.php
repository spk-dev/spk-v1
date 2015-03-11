<form id='filterFormID' name='filterFormName' method='post' action='<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites"); ?>'>
                    <input type="hidden" name="numpage" id="numpage" value=""/>
                    <div class="row">
                        <div id='typeResearch' class='six columns searchCriteria '>
                            <label for='Type[]' class='labelSearchField'>Type d'événement</label>
                            <div id='searchField'>
                            <?php echo HtmlFormComponents::SelectTypeEvenements("Type[]", "listeType", 6, "searchField twelve", 1, $RetraiteTypeEvenement, true); ?>
                            </div>
                        </div>
                        <div id='themeResearch' class='six columns searchCriteria'>
                            <label for='theme[]' class='labelSearchField'>Themes</label>
                             <?php echo HtmlFormComponents::SelectThemeFromEvenement("Theme[]","listeThemes", 6, "searchField twelve", 1, $RetraiteTheme); ?>
                        </div>
                    </div>
                    <div class="row">
<!--                    <div id='dateResearch' class='searchCriteria'>-->
                        <div class="six columns">
                            <label for='DateMin' class='labelSearchField'>Date de début</label>
                            <input type='text' name='DateMin' id='DateMin' class='searchField' value='<?php echo $RetraiteDateMin; ?>'/>
                        </div>
                        <div class="six columns">
                            <label for='DateMax' class='labelSearchField'>date de fin</label>
                            <input type='text' name='DateMax' id='DateMax' class='searchField' value ='<?php echo $RetraiteDateMax; ?>'/>
                        </div>
<!--                    </div>-->
                    </div>
                    
                    <ul class="accordion">
                        <li>
                          <div class="rechercheAvancee">
                            <h5>Recherche avancée</h5>
                          </div>
                          <div class="content">
                            <div class="row">
                                <div id='intervenantsResearch' class='six columns searchCriteria '>
                                    <label for='Intervenant[]' class='labelSearchField'>Intervenants</label>
                                    <div id='searchField'>
                                    <?php echo HtmlFormComponents::SelectIntervenants($type,"Intervenant[]","listeIntervenants", 6, "searchField twelve", 1, $RetraiteIntervenants);?>
                                    </div>
                                </div>


                                <div id='lieuxResearch' class='six columns searchCriteria'>
                                    <label for='Lieu[]' class='labelSearchField'>Lieux</label>
                                     <?php echo HtmlFormComponents::SelectLieuxFromEvenement($type,"Lieu[]","listeLieux", 6, "searchField twelve", 1, $RetraiteLieu);  ?>        
                                </div>
                            </div>



                            <div class="row">
                                <div id='keywordResearch' class='six columns searchCriteria '>
                                    <label for='keywords' class='labelSearchField'>Mots cl&eacute;s </label>
                                    <input type='text' name='keywords' id='keywords' class='searchField' value ='<?php echo $RetraiteMotsCles; ?>'/>
                                </div>

                                <div class="six columns">
                                    <div id='garderieResearch' class='searchCriteria six columns'>
                                        <label for='Garderie' class='labelSearchField'>Garderie</label>
                                        <?php echo HtmlFormComponents::selectOuiNon("Garderie", "GarderieIDHome", 1, "twelve searchField");?>
                                    </div>

                                    <div id='hebergementResearch' class='searchCriteria six columns'>
                                        <label for='Hebergement' class='labelSearchField'>H&eacute;bergement</label>
                                        <?php echo HtmlFormComponents::selectOuiNon("Hebergement", "HebergementIDHome", 1, "twelve searchField");?>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </li>

                      </ul>
                    
                    
                    
                    <div class="row">
                        <div id='buttonResearch' class='searchCriteria'>
                            <input type="submit" name='filter' id='filter' class="six columns button tiny" value="Rechercher" />
                            <input type="button" class="four columns  secondary button tiny" id="resetFormEvent" value="Annuler">
                        </div>    
                    </div>
                    
                </form>