<?php
$booNewsletterSuscription = false;
$type = "retraite";
$err = array(); 
$redfields['mail']="";


if(isset($_POST['newsletter_inscription2'])){
    $booNewsletterSuscription = true;
    $email = $_POST['newsletter_email'];
    $nom = $_POST['newsletter_nom'];
    $prenom = $_POST['newsletter_prenom'];
    $optin = $_POST['newsletter_part'];
    
    if($email=="" ){
//        array_push($err, "Adresse email administrateur");
        $redfields['mail']="error";
        $returnNewsletter[1] = "alert";
        $returnNewsletter[0] = "email absent";
        
    }else if(!FormValidation::checkField($email, "mail")){
//        array_push($err, "Format de mail Administrateur incorrect, format attendu : xxxxx@xxxx.xx");
        $redfields['mail']="error";
        $returnNewsletter[1] = "alert";
        $returnNewsletter[0] = "Format de mail incorrect, format attendu : xxxxx@xxxx.xx";
    }else{
    
        $returnNewsletter = NewsletterAction::suscribe($email, $nom, $prenom, $optin);
    }
    
}
?>

<div id="homeBandeau1" class="twelve fondHomeBandeau">
    <div class="row" class="fondHomeBandeau" style="background-color:#393c42;">
       <div class="twelve columns">
            <p class="signature">Vivez les <span class="high1">événements</span> qui vous <span class="high2">ressemblent</span></p>
        </div>        
    </div>
</div>
<div id="homeBandeau2" class="homeBandeau2 twelve">
    <div class="row">
       <div class="twelve columns">
       
            <ul class="block-grid four-up HomeMenu">
            <li class="lienHomeEvent">
                <a href="<?php echo "index.php?page=evenement"; ?>" >
                    <div class='imgHomeMenu'><img src="images/spibook/calendar.png" class="imgMenuHome"/></div>
                    <div class='titreHomeMenu hide-for-small'>Evènements</div>
                </a>
            </li>
            <li class="lienHomeOrga">
                <a href="<?php echo "index.php?page=organisateur"; ?>" >
                    <div class='imgHomeMenu'><img src="images/spibook/organisateur.png" class="imgMenuHome"/></div>
                    <div class='titreHomeMenu hide-for-small'>Organisateurs</div>
                </a>
            </li>
            <li class="lienHomeThematiques">
               <a href="<?php echo "index.php?page=theme"; ?>" >
                    <div class='imgHomeMenu'><img src="images/spibook/thematique.png" class="imgMenuHome"/></div>
                    <div class='titreHomeMenu hide-for-small'>Thématiques</div>
               </a>
            </li>
            <li class="lienHomeCategories"   >
                <a href="<?php echo "index.php?page=inscription"; ?>">
                    <div class='imgHomeMenu'><img src="images/spibook/category.png" class="imgMenuHome"/></div>
                    <div class='titreHomeMenu hide-for-small'>Inscription</div>
                </a>
            </li>
          </ul>
            
       </div>        
    </div>
</div>

<div id='mapNSearchHomePage' class="twelve columns container">
     
    <div class="row">
        <div id="mapHome" class="map twelve columns hide-for-small">
            
        </div>
<!--        <div class='twelve columns' style="height:6em;">
            <form id='filterFormID' name='filterFormName' method='post' action='index.php?page=evenement'>
                <input type="hidden" name="numpage" id="numpage" value=""/>

                    <div id='typeResearch' class='three columns '>
                        <label for='Type[]' class='labelSearchField'>Type d'événement</label>
                        <div id='searchField'>
            
                        <?php echo HtmlFormComponents::SelectTypeEvenements("Type[]", "listeType", 6, "searchField twelve", 1, $RetraiteTypeEvenement, true); ?>
                        </div>
                    </div>
                    <div id='themeResearch' class='three columns'>
                        <label for='theme[]' class='labelSearchField'>Themes</label>
            
                         <?php echo HtmlFormComponents::SelectThemeFromEvenement("Theme[]","listeThemes", 6, "searchField twelve", 1, $RetraiteTheme); ?>
                    </div>

                    <div class="two columns">
                        <label for='DateMin' class='labelSearchField'>Date de début</label>
                        <input type="text" name="DateMin" value="" id="datetimepicker_dateMin" class="searchField twelve" placeholder="YYYY-mm-jj hh:mm"/>

                    </div>
                    <div class="two columns ">
                        <label for='DateMax' class='labelSearchField'>date de fin</label>
                        <input type="text" name="DateMax" value="" id="datetimepicker_dateMax" class="searchField twelve"/>

                    </div>

                    <div id='buttonResearch' class='two columns'>
                        <input type="submit" name='filter' id='filter' class="twelve tiny button" value="Rechercher" />

                    </div>    



            </form>
        </div>-->
    </div>
</div><!--
</div>
<div class="twelve columns ">-->
    <div class="row" >
        <div class=" one columns">
            <img src="images/spibook/calendar.png" class="imgMenuHome"/>
        </div>
        <div class=" eleven columns"><h1 class="titreHomeMenu evenementsHomePage">Des événements tout le temps</h1></div>
<!--        <div  class="twelve">-->
    </div>
          <div class="row">  
            <?php 
                
//                $RetraiteTheme = null;
//                $RetraiteLieu = null;
                
                $filterDate = new EvenementSearchCriteria();
                $filterDate->setEvenementAfterToday(true);   
                $filterDate->setEvenementLimit(0, 6);
                $listeEvenementsDate = EvenementAction::getListeEvenements($filterDate);
            ?>
            
            <ul class="block-grid two-up mobile-two-up" >
                <?php
//                    $listeRetraite = $listeEvenementsDate;
                     foreach($listeEvenementsDate as $evenement){

                    $datedebut = new DateTime($evenement->getDateDebut());
                    $datefin = new DateTime($evenement->getDateFin());
                    $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(),0);

                    $lieu = LieuAction::recupererUnLieu($evenement->getLieu());
                    $listeTheme = ThemeAction::recupererThemesForRetraite($evenement->getId());
                    $region = GeoLocalisation::getRegion($lieu->getCp());
                    $dep = GeoLocalisation::getDepartement($lieu->getCp());

                 ?>
                 <li>



                 <div class='ligneEvent twelve columns'>

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

                         </div>
                         <div class='twelve'>
                                 <?php

                                     foreach($listeTheme as $theme){

                                         echo "<span class=\"tagThemeSmall\" >";
                                         echo "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&theme=".$theme->getId()."' alt='Evènements Catholiques : ".$theme->getNom()." avec Spibook' title='Evénements Catholiques : ".$theme->getNom()." avec Spibook' >";
                                         echo $theme->getNom();
                                         echo "</a>";
                                         echo "</span>";
                                         echo "&nbsp;";
                                     }
                                 ?>

                             </div>
                     </div>
                 </li>

                 <?php
                     }

                 ?>
             </ul>
           
           
<!--        </div>  -->
         <div class="row text-right"><a href='index.php?page=evenement'>Voir tous les événements</a></div>
        
    </div>

<!--    <div class="row " id="dataHomePage">-->
    <div class="row" >
        <div class=" one columns">
            <img src="images/spibook/organisateur.png" class="imgMenuHome"/>
        </div>
        <div class=" eleven columns"><h1 class="titreHomeMenu organisateursHomePage">Des événements partout</h1></div>
<!--        <div  class="twelve">-->
    </div>
<div class="row">
        <div class="twelve columns" id="listOrgaHomePage">
<!--         <div  class="twelve columns borderTopDown" id="listOrgaHomePage">
             <div class=" one columns"><img src="images/spibook/organisateur.png" class="imgMenuHome"/></div>
             <div class=" eleven columns"><h1 class="titreHomeMenu">Des événements partout.</h1></div>-->
             <?php 
             
               $lieuFilter = new OrganisateurSearchCriteria();
               $lieuFilter->setOrganisateurLimit(0, 5);
               $lieuFilter->setOrganisateurOrder("nbEventTotal","desc");
               $listeOrganisateur = LieuAction::listerLieuxFilteredComplete($lieuFilter, false);
               ?>

             <ul class="block-grid five-up mobile-two-up"> 
             <?php foreach($listeOrganisateur as $lieu){ 
                      $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
                 ?>
                 <li>
                     <a href='index.php?page=organisateurDetail&id=<?php echo $lieu->getId(); ?>'>

                         <img class='imgCaptionFixed' src='<?php echo $img; ?>' alt='
                                <a href="index.php?page=organisateurDetail&id=<?php echo $lieu->getId(); ?>">
                                
                                <span class="nbEventVignetteHomePage"><?php echo $lieu->getNbEvent(); ?> événements </span>
                                </a>
                        ' title="<?php echo $lieu->getnom(); ?>" />
                        </a>
                     <div class='twelve columns titreSousVignette'>
                        <a href='index.php?page=organisateurDetail&id=<?php echo $lieu->getId(); ?>'>
                            <p class="titreOrganisateur"><?php echo $lieu->getnom(); ?></p></a>
                        </a>
                    </div>
                 </li>
             <?php } ?>
             </ul>
             <div class="row text-right"><a href='index.php?page=organisateur'>Voir tous les organisateurs</a></div>
        </div> 
</div>

    <div class="row" >
        <div class=" one columns">
            <img src="images/spibook/thematique.png" class="imgMenuHome"/>
        </div>
        <div class=" eleven columns"><h1 class="titreHomeMenu themesHomePage">Des événements pour tous</h1></div>
<!--        <div  class="twelve">-->
    </div>
        <div class="row">
            <br/>
<!--        <div  class="twelve columns" id="listThemeHomePage" >
            <div class=" one columns"><img src="images/spibook/thematique.png" class="imgMenuHome"/></div>
            <div class=" eleven columns"><h1 class="titreHomeMenu">Des événements pour tous</h1></div>-->
            <?php 
               $listeTheme = ThemeAction::recupererThemesFromRetraites2(0, 5, 'nb','desc'); ?>
             
             <ul class="block-grid five-up mobile-two-up "> 
             <?php foreach($listeTheme as $elementTheme){ 
                 $img = HtmlUtilComponents::imageControl("themes", $elementTheme->getImage(), 1);
                 
                 ?>
                 <li class=''>
                     <a href="index.php?page=themeDetail&themeId=<?php echo $elementTheme->getId(); ?>">
                         <img class='' src='<?php echo $img; ?>' alt='<?php echo $elementTheme->getNom(); ?>' title='<?php echo $elementTheme->getNom(); ?>' />
                         
                     </a>
                     <div class='twelve columns titreSousVignette'>
                        <a href="index.php?page=themeDetail&themeId=<?php echo $elementTheme->getId(); ?>">
                            <?php echo $elementTheme->getNom(); ?>
                        </a>
                         <br/>
                         <span class='hiddeninfo'><?php echo $elementTheme->getNbEvent();?> événements</span>
                    </div>
                 </li>
             <?php } ?>
             </ul>
            <div class="row text-right"><a href='index.php?page=theme'>Voir tous les themes</a></div>
        </div>
<!--    </div>-->
<div class='row ilsEnParlent'>
    <div class="twelve columns">
        <div class=" one columns"><img src="images/spibook/video.png" class="imgMenuHome"/></div>
        <div class=" eleven columns"><h1 class="titreHomeMenu videosHomePage">Ils en parlent</h1></div>
        

           
        
    </div>
    <div class="twelve columns">
        <div class="six columns">
          <iframe src="//www.youtube.com/embed/Hzy2NHHYxmk?rel=0" width="100%" height="300px" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="six columns">
<!--            <iframe width="640" height="360" src="//www.youtube.com/embed/MPjqSooIQmo?rel=0" frameborder="0" allowfullscreen></iframe>-->
          <iframe src="//www.youtube.com/embed/MPjqSooIQmo?rel=0" width="100%" height="300px" frameborder="0" allowfullscreen></iframe>
        </div>
                 
    </div>
    <a href="https://www.youtube.com/channel/UC_CZcfqlq06gWMwmqXYU3Eg/feed" alt="videos spibook" target="_blank"><div class="seven columns"></div><div class="cinq columns"><img src="images/spibook/youtube.png"/></div></a>
    
</div>

<div class="row borderTopDown">
    <div class="four columns">   
            
           
            <a name='newsletter'><h4 class="blocTitle titre" id="newsletterBloc">Newsletter</h4></a>
            
            <form id="contact-form" name="contact-form" method="post" action="index.php#newsletter">
            <?php if($booNewsletterSuscription){ ?>
                <div class="alert-box <?php echo $returnNewsletter[1]; ?>">
                        <?php echo $returnNewsletter[0]; ?>
                        <a href="" class="close">&times;</a>
                </div>
            <?php }else{ ?>
            <p class='textBlocHomePage'>Restons en contact, et soyez informé des nouveautés.</p>
            <?php } ?>
                <input type="text" class="" name="newsletter_nom" id="name" value="" placeholder="Nom" />
                <input type="text" class="" name="newsletter_prenom" id="email" value="" placeholder="Prenom"/>
                <input type="text" class="<?php echo $redfields['mail'];?>" name="newsletter_email" id="email" value="" placeholder="Email"/>
<!--                <input type="checkbox" name="newsletter_stat" value="1" checked="checked"/>-->

<!--                <p class='labelSearchField '>J'accepte de recevoir les informations des partenaires Spibook</p>
-->                <p class='labelSearchField '><input type="checkbox" name="newsletter_part" value="1" checked="checked" />
                J'accepte de recevoir les mails de spibook</p>
                <input type="submit" name="newsletter_inscription2" id="button" value="Valider l'inscription" class='twelve button round ' />
            </form>
        </div>
     <div class="four columns borderLeftRight">
            <h4 class="titre blocTitle" id="communicationBloc">Communiquons...</h4>
            <a href="index.php?page=inscription">
            <p class="contactItemHomePage" id="diffuseur">Vous souhaitez diffusez vos événements sur Spibook ?</p>
            
            <p class="contactItemHomePage" id="annonceur">Vous organisez un événement, lancez un nouveau projet, laissez nous vous aider à le faire connaitre.</p>
             </a>
             <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"; ?>">
            <p class="contactItemHomePage" id="suggestion">Des idées, des suggestions, n'hésitez pas à nous en faire part.</p>
            </a>
        </div>
<!--        <div class="four columns borderLeftRight">
            <h4 class="titre blocTitle" id="communicationBloc">Communiquons...</h4>
            <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=2"; ?>">
            <p class="contactItemHomePage" id="diffuseur">Vous souhaitez diffusez vos événements sur Spibook ?</p>
            </a>
             <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=3"; ?>">
            <p class="contactItemHomePage" id="annonceur">Vous organisez un pélerinage, lancez un nouveau projet, laissez nous vous aider à le faire connaitre.</p>
             </a>
             <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"; ?>">
            <p class="contactItemHomePage" id="suggestion">Des idées, des suggestions, n'hésitez pas à nous en faire part.</p>
            </a>
        </div>    -->
        
        <div class="fb-like-box" data-href="https://www.facebook.com/pages/Spibook/283290738383457"  data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
    </div>
</div>

<!--</div>-->
<?php $filter = new EvenementSearchCriteria();
$filter->setEvenementAfterToday(true);
//$listeEvenements = EvenementAction::getListeEvenements($filter);?>
    
<?php $listeEvenement = EvenementAction::getListeEvenements($filter) ?>


<script language="javascript">
    
var locations = [<?php 
    foreach ($listeEvenement as $evenement) {
    //                $lieu = LieuAction::recupererUnLieu($evenement->getLieu());
            $place = GeoLocalisation::getPlace($evenement->getPlace());
            $popup = HtmlUtilComponents::getPopUpEventForMap($evenement);
            if($place->isLatAndLong()){
                echo "[\"".$popup."\", ".$place->getLat().",".$place->getLong()."],";
            }

        } 
        ?>];
//var locations = [['toto', 44.72222962,1.616889,5],['taaa', 41.7995962,1.6145889,5]];
    var map = new google.maps.Map(document.getElementById('mapHome'), {
        zoom: 5,
        center: new google.maps.LatLng(47.4,1.6),
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR 
          },
	navigationControl: true,
   	navigationControlOptions: {
        style: google.maps.NavigationControlStyle.LARGE,
        position: google.maps.ControlPosition.TOP_RIGHT
    },
    	scaleControl: false,
 	streetViewControl: true,
      mapTypeId: google.maps.MapTypeId.TERRAIN
    });
    
    

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

   for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        draggable: false,
        map: map
      });
      
      
        marker.setIcon("http://www.spibook.com/images/spibook/gmarkers/spibook.png");

        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      setTimeout(function () { infowindow.close(); }, 2000);
      
      
    }
    
     
    
</script>