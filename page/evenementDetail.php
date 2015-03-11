  <div class="row">

<?php

if(isset($_GET['id'])){  

    
    $idEvenement = $_GET['id'];

    $evenementToDisplay = EvenementAction::getEvenement($idEvenement);
    
    if ($evenementToDisplay == null){

        Redirect::frontError(404);
    }
    else{
    
        $place = GeoLocalisation::getPlace($evenementToDisplay->getPlace());

        $img = HtmlUtilComponents::imageControl("evenements", $evenementToDisplay->getMainPhoto(),1);

        $lieu = LieuActionDao::recupererUnLieu($evenementToDisplay->getLieu());
        
        $type = TypeEvenementAction::recupererUnType($evenementToDisplay->getTypeEvenement())->getLibelle();

?>
      <div class="twelve columns">
          <div class="">   
              
                  <h5 class="subheader">
                      <?php echo  $type; ?>:
                  </h5>
                <h4 class="" id=''>
                  
                <?php echo $evenementToDisplay->getNom(); ?>
                </h4>
                 
              </div>
        </div>
      <div class="seven columns">
          
          
        <div class="twelve">
           
            <img src="<?php echo $img; ?>" class="twelve "/>
            <div class='twelve'>
                
                <?php 
                $listeTheme = $evenementToDisplay->getTheme();
                $nbTheme = count($listeTheme);
                if($nbTheme>0){
                    echo '<ul class="inline-list">';
                        foreach($listeTheme as $theme){

                            echo "<li class=\"tagThemeSmall\">";
                            echo "<a href='".$_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienRetraites")."&filter=1&theme=".$theme->getId()."' alt='Evènements Catholiques : ".$theme->getNom()." avec Spibook' title='Evènements Catholiques : ".$theme->getNom()." avec Spibook' >";
                            echo $theme->getNom();
                            echo "</a></li>";

                        }
                        echo '</ul>';

                    }
               
                ?>
            </div>
           
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
            <a class="addthis_button_preferred_1"></a>
            <a class="addthis_button_preferred_2"></a>
            <a class="addthis_button_preferred_3"></a>
            <a class="addthis_button_preferred_4"></a>
            <a class="addthis_button_compact"></a>
            <a class="addthis_counter addthis_bubble_style"></a>
            </div>
            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-538f1cbb01e1612d"></script>
            <!-- AddThis Button END -->
           
            <div class="descriptionRetraiteDetail"><?php echo $evenementToDisplay->getDescription(); ?></div>
             
        </div>
          

          
            <div class='twelve'>
                <h5 class="titre titreSectionRetraiteDetail" id='IntervenantBloc'>Les intervenants</h5>

                <?php
                    $listeIntervenants = $evenementToDisplay->getIntervenants();
                    $nbIntervenants = count($listeIntervenants);
                    if($nbIntervenants>0){
                        $intervenants = new Intervenant();
                        echo '<ul class="inline-list">';
                        foreach($listeIntervenants as $intervenants){

                            echo "<li class=\"tagIntervenantLarge\">";
                            echo "<a href='index.php?page=intervenantDetail&Intervenant=".$intervenants->getId()."'>";
                            echo $intervenants->getNomComplet();
                            echo "</a></li>";
                            
                        }
                        echo '</ul>';
 
                }else{
                    echo "Pas d'intervenants identifiés pour cette retraite";
                }
                ?>
            </div>


        

        
      </div>
      <div class="one columns"></div>
        <div class="four columns">
            <div class='twelve panel'>
                <div class="">
                    <h5 class="titre titreSectionRetraiteDetail" id='LieuRetraiteDetail'>Organisateur</h5>
                   <a href="index.php?page=organisateurDetail&id=<?php echo $evenementToDisplay->getLieu(); ?>">
                    <h5 class="subheader">
                   <?php echo $lieu->getNom(); ?>
                       <small><br/><?php echo $lieu->getRegion()."/".$lieu->getDepartement(); ?></small>
                    </h5>
                   </a>
                
                    <div class='twelve'>
                        <p><?php echo TextStatic::ResumeText($lieu->getDescription(),100); ?></p>
                        <p><a href="index.php?page=organisateurDetail&id=<?php echo $evenementToDisplay->getLieu(); ?>">En savoir plus ...</a></p>
                    </div>
                </div>
            </div>
             
            <div class='twelve '>
                <h5 class="titre titreSectionRetraiteDetail" id='InfosPratiquesRetraiteDetail'>Les informations pratiques</h5>
                <p>
                        du <?php echo $evenementToDisplay->getDateDebutFormated(); ?><br/>
                        au <?php echo $evenementToDisplay->getDateFinFormated(); ?><br/><br/>
                        <?php echo $evenementToDisplay->getGarderieFormated(); ?><br/>
                        <?php echo $evenementToDisplay->getHebergementFormated(); ?><br/>
                        <?php echo $evenementToDisplay->getPrixFormated(); ?>
                </p>
                
                <h5 class="titre titreSectionRetraiteDetail" id='InfosPratiquesRetraiteDetail'>Inscription</h5>
                <p>Adresse de contact : <?php echo HtmlUtilComponents::transformInMailto($evenementToDisplay->getMailInscription()); ?></p>
            <p>
            <?php echo $evenementToDisplay->getCoordInscription();?>    
            </p>
            </div>
         
            
        </div>

      
     
 <!-- End Header and Nav -->
        <hr/>
        <!-- NOUS REJOINDRE -->
        <div class="twelve columns">
            <div class="twelve"><h5 class="subheader" >Nous rejoindre</h5></div>
            <div class='eight columns'>
                
                <div class='row map' id="mapSmallEvent"></div>
                
            </div>
            <div class='four columns'>
                <iframe src="http://www.covoiturage.fr/widget/FR_WIDGET_PSGR?to=<?php echo $place->getVille(); ?>" height="270px" style="border:0px; padding:0px;"  frameborder="0" scrolling="no" class="twelve"></iframe>
                    
                </div>
            <div class='four columns'>
               <iframe src="http://www.covoiturage.fr/widget-conducteur/FR_WIDGET_DRVR?to=<?php echo $place->getVille(); ?>" style="border:0px; padding:0px;" height="270px" frameborder="0" scrolling="no" class="twelve"></iframe>
            </div>

        </div>
        
        <!-- LES AUTRES RETRAITES DE CE LIEU -->
        <div class="twelve columns hide-for-small">
            
            <?php 
            $retExcle = array($idEvenement);
            $nbMemeThemes = 0;
            $nbMemeIntervenants = 0;
            $classDiv = "four";
            
            // même organisateur
            $listeLieu = array($evenementToDisplay->getLieu());
            $critMemeOrga = new EvenementSearchCriteria();
            $critMemeOrga->setEvenementAfterToday(true);
            $critMemeOrga->setEvenementExclue($retExcle);
            $critMemeOrga->setEvenementLimit(0, 3);
            $critMemeOrga->setEvenementLieu($listeLieu);
            $nbMemeOrga = EvenementActionDao::getNombreEvements($critMemeOrga);
            
            // même themes
            if($nbTheme>0){
                $critMemeThemes = new EvenementSearchCriteria();
                $critMemeThemes->setEvenementAfterToday(true);
                $critMemeThemes->setEvenementLimit(0, 6);
                $critMemeThemes->setEvenementExclue($retExcle);
                $listeTheme = array();
                foreach (EvenementAction::getEvenement($idEvenement)->getTheme() as $theme) {
                    array_push($listeTheme, $theme->getid());
                }                            
                $critMemeThemes->setEvenementTheme($listeTheme);
                $nbMemeThemes = EvenementActionDao::getNombreEvements($critMemeThemes);
            }
            
            
            //même intervenants
            if($nbIntervenants>0){
                $critMemeInterv = new EvenementSearchCriteria();
                $critMemeInterv->setEvenementAfterToday(true);
                $critMemeInterv->setEvenementLimit(0,5);
                $critMemeInterv->setEvenementExclue($retExcle);
                $listeInterv = array();
                foreach (EvenementAction::getEvenement($idEvenement)->getIntervenants() as $intervenant) {
                    array_push($listeInterv, $intervenant->getId());
                }         


                $critMemeInterv->setIntervenants($listeInterv);
                $nbMemeIntervenants = EvenementActionDao::getNombreEvements($critMemeInterv);
            }         
            
            $arrNb = array($nbMemeOrga,$nbMemeThemes,$nbMemeIntervenants);
            $i = 0;
            foreach($arrNb as $nb){
                if($nb == 0){ $i++;}
            }
            
            if($i==0){
                $classDiv = "four";
            }else if($i == 1){
                $classDiv = "six";
            }else{
                $classDiv = "twelve";
            }
            
            ?>
            
            
            
            <hr/>
            
            
<!--                <div class="nine columns">-->
                <?php if($nbMemeOrga > 0){ ?>
                <div class="<?php echo $classDiv; ?> columns">
                    <h3 class="listeSousItem">Du même organisateur</h3>
                    <?php echo EvenementAction::afficherListesRetraites($critMemeOrga, 0,0,null,null); ?>
                </div> 
                <?php } ?>

                <?php if($nbMemeThemes > 0){ ?>
                <div class="<?php echo $classDiv; ?> columns"> 
                    <h3 class="listeSousItem">Du même thème</h3>
                    <?php echo EvenementAction::afficherListesRetraites($critMemeThemes, 0,0,null,null); ?>
                </div>
                <?php  } ?>


                <?php if($nbMemeIntervenants > 0){ ?>
                    <div class="<?php echo $classDiv; ?> columns">
                        <h3 class="listeSousItem">Du même intervenant</h3>
                        <?php echo EvenementAction::afficherListesRetraites($critMemeInterv, 0,0,null,null); ?>
                    </div>
                <?php  } ?>

                </div>
                <div class="three columns">
<!--                    <a href="http://donenligne.secours-catholique.org/abov/abovision2.php?P1=SCC&P2=SYRIE&PG=FAIRE1DON&typabo=1">
<img style="float: left;" src="ads/secoursCatholique/gif_sir.gif" alt="Faire un don Syrie" width="140" height="107" /></a>-->
                </div>
              
        </div>
        <div class="row">
<!--            <a href="http://www.secours-catholique.org/actualite/actualite-dossiers/noel-au-secours-catholique/" target="_blank"><img src="ads/secoursCatholique/10m2011-728.gif" width="728" height="90" border="0" alt="10 Millions d'étoiles du Secours-Catholique"></a> -->
        </div>
        <!-- FIN -- LES AUTRES RETRAITES DE CE LIEU -->        
    </div>
    <!-- FIN MAIN CONTENT SECTION--> 

<?php
    }
?>

<?php $popup = HtmlUtilComponents::getPopUpEventPlaceForMap($evenementToDisplay, $place); ?>    



<script>
function initialize() {
    var myLatLng = new google.maps.LatLng(<?php echo $place->getLat(); ?>, <?php echo $place->getLong(); ?>);
  var mapOptions = {
    zoom: 9,
    center: myLatLng
  };

  var map = new google.maps.Map(document.getElementById('mapSmallEvent'),
      mapOptions);



  var infowindow = new google.maps.InfoWindow({
    content: "<?php echo $popup; ?>",
    position: myLatLng
  });
  infowindow.open(map);

//  google.maps.event.addListener(map, 'zoom_changed', function() {
//    var zoomLevel = map.getZoom();
//    map.setCenter(myLatLng);
//    infowindow.setContent('Zoom: ' + zoomLevel);
//  });
}

google.maps.event.addDomListener(window, 'load', initialize);

        marker.setIcon("http://www.spibook.com/images/spibook/gmarkers/spibook.png");

</script>
<script>
    document.title = "SPIBOOK - <?php echo $type; ?> - <?php echo $evenementToDisplay->getNom();; ?>";
</script>


<?php 

}else{
    Redirect::frontError(401);
}

