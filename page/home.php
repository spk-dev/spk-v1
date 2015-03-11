<!-- ROW 1-->

<div class="row">
    <div class="five columns">
        <div class="panel">
            <h4 class="blocTitle titre" id="rechercheBloc">Recherche rapide</h4>
           <?php echo HtmlUtilComponents::displayFilterOnHomePage("retraite",""); ?>
        </div>
    </div>
    <div class="seven columns diaporamaHomePage">
        <?php
            $filter = new EvenementSearchCriteria();
        ?>
        <blockquote style='text-align:justify;'>
            Toute l'équipe Spibook vous souhaite la bienvenue.<br/>
Ce nouveau site, lancé le 9 juin 2013, répertorie les événements catholique de France. <br/>
Le nombre de ces événements augmentera de jour en jour. <br/>

<a href="#newsletter">N'hésitez donc pas à vous inscrire à la newsletter pour être tenu informé des nouveautés.</a>
            
            
        </blockquote>
        <?php echo DiaporamaAction::getDiaporama();?>
    </div>
</div>

<!-- ROW 2-->
<div class="row">
    <div class="eight columns">
            <h3 class="titreHome">Les principaux événements</h3>
            <?php //
                echo EvenementAction::afficherTabsEvenementsPlusFrequents();
            ?>
 

            <h3 class="titreHome">Coup de projecteur sur:</h3>
            <h5 class="soustitreHome">les organisateurs...</h5>
            <?php 
                $lieuFilter = new OrganisateurSearchCriteria();
                echo LieuAction::afficherGridLieux($lieuFilter,2);
            ?>

            <h5  class="soustitreHome">Les thématiques...</h5>
            
            <?php
                echo ThemeAction::afficherTousLesThemes(4,3,null);
            ?>
<!--        </div>-->
        <br/>
        <hr/>
        <br/>
        <div class="row">
              
            <div class="six columns">
                <h4 class="titre blocTitle" id="communicationBloc">Communiquons...</h4>
                <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=2"; ?>">
                <h6 class="contactItemHomePage" id="diffuseur">Vous souhaitez diffusez vos événements sur Spibook ?</h6>
                </a>
                 <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=3"; ?>">
                <h6 class="contactItemHomePage" id="annonceur">Vous organisez un pélerinage, lancez un nouveau projet, laissez nous vous aider à le faire connaitre.</h6>
                 </a>
                 <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"; ?>">
                <h6 class="contactItemHomePage" id="suggestion">Des idées, des suggestions, n'hésitez pas à nous en faire part.</h6>
                </a>
            </div>
             <div class="fb-like-box six columns" data-href="https://www.facebook.com/pages/SpiBook/283290738383457" data-width="292" data-show-faces="true" data-stream="false" data-border-color="#fff" data-header="false"></div>
           
            
            
        </div>
    </div>
    <div class="four columns">
        <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites"); ?>">
            <div class="panel panelHomePage"><h4 class="blocTitle titre" id="retraiteBloc">Les événements</h4>
            <p class='textBlocHomePage'>Retrouvez la liste complète des événements recensés.</p>
            </div>
        </a>
        <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienTypeEvenement"); ?>">
            <div class="panel panelHomePage"><h4 class="blocTitle titre" id="typeEvenementBloc">Vous recherchez...</h4>
            <p class='textBlocHomePage'>... un type d'événement en particulier?</p>
            </div>
        </a>
        <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienThemes"); ?>">
            <div class="panel panelHomePage"><h4 class="blocTitle titre" id="thematiquesBloc">Thématiques</h4>
            <p class='textBlocHomePage'>Retrouvez tous les thèmes abordés.</p>
            </div>
        </a>
        
        <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienIntervenants"); ?>">
            <div class="panel panelHomePage"><h4 class="blocTitle titre" id="IntervenantBloc">Intervenants</h4>
                <p class='textBlocHomePage'>Trouvez un événement en fonction de son intervenant</p>
            </div>
        </a>
        <div class="panel panelHomePage">   
            
           
            <a name='newsletter'><h4 class="blocTitle titre" id="newsletterBloc">Newsletter</h4></a>
                
            <form id="contact-form" name="contact-form" method="post" action="">
                
            <p class='textBlocHomePage'>Restons en contact, et soyez informé des nouveautés.</p>
                <input type="text" class="" name="newsletter_nom" id="name" value="" placeholder="Nom" />
                <input type="text" class="" name="newsletter_prenom" id="email" value="" placeholder="Prenom"/>
                <input type="text" class="" name="newsletter_email" id="email" value="" placeholder="Email"/>
<!--                <input type="checkbox" name="newsletter_stat" value="1" checked="checked"/>-->

<!--                <p class='labelSearchField '>J'accepte de recevoir les informations des partenaires Spibook</p>
-->                <input type="checkbox" name="newsletter_part" value="1" checked="checked" />
                <p class='labelSearchField '>J'accepte de recevoir les mails de spibook</p>
                <input type="submit" name="newsletter_inscription2" id="button" value="Valider l'inscription" class='twelve newsletterSubmit' />
            </form>
        </div>
<!--        <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=2"; ?>">-->
<!--            <div class="panel panelHomePage">
                <h4 class="blocTitle titre">Diffusez vos retraites</h4>
            </div>
        </a>-->
        

        
<!--             <div class="">
                 <div class="panelHomePage panel">
                <h4 class="blocTitle titre ">Retrouvez nous sur Facebook</h4></div>
                <div class="fb-like-box" data-href="https://www.facebook.com/pages/SpiBook/283290738383457" data-width="292" data-show-faces="true" data-stream="false" data-border-color="#fff" data-header="false"></div>
            </div>-->
    </div>
</div>

