<form id='filterFormID' name='filterFormName' method='post' action='<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites"); ?>'>
                    <input type="hidden" name="numpage" id="numpage" value=""/>
                    <div class="row">
                        <div id='typeResearch' class='twelve columns searchCriteria '>
                            <label for='Type[]' class='labelSearchField'>Type d'événement</label>
                            <div id='searchField'>
<!--                                <input type="hidden" name="Type" class="twelve" id="listeType" value="<?php // Util::getListeAvecVirgule($RetraiteTypeEvenement); ?>"/>-->
                            <?php echo HtmlFormComponents::SelectTypeEvenements("Type[]", "listeType", 6, "searchField twelve", 1, $RetraiteTypeEvenement,true); ?>
<!--                                <select id='listeType'></select>-->
                            </div>
                        </div>
                        <div id='themeResearch' class='twelve columns searchCriteria'>
                            <label for='theme[]' class='labelSearchField'>Themes</label>
<!--                            <input type="hidden" name="Theme" class="twelve" id="listeThemes" value="<?php // Util::getListeAvecVirgule($RetraiteTheme); ?>"/>-->
                             <?php echo HtmlFormComponents::SelectThemeFromEvenement("Theme[]","listeThemes", 6, "searchField twelve", 1, $RetraiteTheme); ?>
                        </div>
<!--                    </div>
                    <div class="row">-->
<!--                    <div id='dateResearch' class='searchCriteria'>-->
                        <div class="twelve columns searchCriteria">
                            <label for='DateMin' class='labelSearchField'>Date de début</label>
                            <input type='text' name='DateMin' id='DateMin' class='searchField' value='<?php echo $RetraiteDateMin; ?>'/>
                        </div>
                        <div class="twelve columns searchCriteria ">
                            <label for='DateMax' class='labelSearchField'>date de fin</label>
                            <input type='text' name='DateMax' id='DateMax' class='searchField' value ='<?php echo $RetraiteDateMax; ?>'/>
                        </div>

                        <div id='intervenantsResearch' class='twelve columns searchCriteria'>
                            <label for='Intervenant[]' class='labelSearchField'>Intervenants</label>
                            <?php echo HtmlFormComponents::SelectIntervenantsWithSelectedValue("Intervenant[]","listeIntervenants", 6, "searchField twelve", 1, $RetraiteIntervenants); ?>
<!--                            <div id='searchField'>-->
<!--                                <input type="hidden" name="Intervenant" class="twelve" id="listeIntervenants" value="<?php Util::getListeAvecVirgule($RetraiteIntervenants); ?>"/>-->
                            <?php // echo HtmlFormComponents::SelectIntervenants($type,"Intervenant[]","listeIntervenants", 6, "searchField twelve", 1, $RetraiteIntervenants);?>
<!--                            </div>-->
                        </div>


                        <div id='lieuxResearch' class='twelve columns searchCriteria'>
                            <label for='Lieu[]' class='labelSearchField'>Lieux</label>
                            <input type="hidden" name="Lieu" class="twelve" id="listeLieux" value="<?php Util::getListeAvecVirgule($RetraiteLieu); ?>"/>
                             <?php // echo HtmlFormComponents::SelectLieuxFromRetraite($type,"Lieu[]","listeLieux", 6, "searchField twelve", 1, $RetraiteLieu);  ?>        
                        </div>

                        <div id='keywordResearch' class='twelve columns searchCriteria'>
                            <label for='keywords' class='labelSearchField'>Mots cl&eacute;s </label>
                            <input type='text' name='keywords' id='keywords' class='searchField' value ='<?php echo $RetraiteMotsCles; ?>'/>
                        </div>
                        
                        <div id='buttonResearch' class='twelve columns searchCriteria'>
                            <input type="submit" name='filter' id='filter' class="ten button tiny" value="Rechercher" />

                        </div>    
                    </div>
                    
                </form>