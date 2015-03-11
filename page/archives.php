<?php
// Instancie un nouvel objet filtre
//$filter = new RetraiteSearchCriteria(null, null, null,null,null,null,null,null,null);

$dateMin = null;
$dateMax = null;
$valTime = false;
$EvenementIntervenants = null;
$EvenementTheme = null;
$EvenementLieu = null;
$EvenementGarderie = null;
$EvenementHebergement = null;
$EvenementDateMin = null;
$EvenementDateMax = null;
$EvenementMotsCles = null;
$EvenementPrix =  null;
$EvenementTypeEvenement = null;
$filterBoo = false;
$filterWeek = false;
$filterMonth = false;   
$filterPeriod = false;

// Vérification si un filtre est setté

//if(isset($_POST['filter'])){
    if(isset($_POST['Intervenant'])){       $EvenementIntervenants  = $_POST['Intervenant']; }
    if(isset($_POST['Theme'])){             $EvenementTheme         = $_POST['Theme'];}
    if(isset($_POST['Lieu'])){              $EvenementLieu          = $_POST['Lieu'];    }
    if(isset($_POST['Garderie'])){          $EvenementGarderie      = $_POST['Garderie'];}
    if(isset($_POST['Hebergement'])){       $EvenementHebergement   = $_POST['Hebergement'];}
    if(isset($_POST['DateMin'])){           $EvenementDateMin       = $_POST['DateMin'];}
    if(isset($_POST['DateMax'])){           $EvenementDateMax       = $_POST['DateMax'];}
    if(isset($_POST['keywords'])){          $EvenementMotsCles      = $_POST['keywords'];}  
    if(isset($_POST['Type'])){              $EvenementTypeEvenement = $_POST['Type'];}
    if(isset($_POST['filter'])){            $filterBoo = true;}
//}   

// Gestion des liens de menu (filter)
if(isset($_GET['filter'])){
    $filterBoo = true;
    //Menu Region
    if(isset($_GET['region'])){ 
        
        $filtreLieu = new OrganisateurSearchCriteria();
        $filtreLieu->setOrganisateurRegion(array(SecurityUtil::securNumParam($_GET['region'])));

        
        $listeLieu = LieuAction::listerLieuxFiltered($filtreLieu);
        $arrLieux = array();
        if(count($listeLieu)>0){
            foreach($listeLieu as $lieu){
                array_push($arrLieux, $lieu->getid());
            }
        }else{
            $arrLieux = array(null);
        }
        
        $EvenementLieu = $arrLieux;
        
    }
    // Menu thematique
    if(isset($_GET['theme'])){
        $EvenementTheme = array(SecurityUtil::securNumParam($_GET['theme']));
    }
    
     // Menu thematique
    if(isset($_GET['communaute'])){
        
        $communaute = SecurityUtil::securNumParam($_GET['communaute']);
        $filtreLieu = new OrganisateurSearchCriteria();
        $filtreLieu->setOrganisateurCommunaute(array($communaute));
        
        $listeLieu = LieuAction::listerLieuxFiltered($filtreLieu);
        $arrLieux = array();
        if(count($listeLieu)>0){
            foreach($listeLieu as $lieu){
                array_push($arrLieux, $lieu->getid());
            }
        }else{
            $arrLieux = array(null);
        }
        $EvenementLieu = $arrLieux;
    }
    
    // Menu calendrier
    if(isset($_GET['time'])){
        $valTime =true;
        $time = $_GET['time'];
       
        switch ($time) {
            case "semaine":
                $filterWeek = true;
                $dateMin = $today;
                $dateMax = new DateTime("+ 7 days");
                break;

            case "mois":
                $filterMonth = true;
                $dateMin = $today;
                $dateMax = new DateTime("+ 30 days");
                break;

            case "period":
                $filterPeriod = true;
                $dateMin = new DateTime($_ENV['properties']['Date']['dateMin'], new DateTimeZone('Europe/Paris'));
                $dateMax = new DateTime($_ENV['properties']['Date']['dateMax'], new DateTimeZone('Europe/Paris'));

                break;

            default:
                break;
        }
        
        
        
        $EvenementDateMin = $dateMin->format('Y-m-d');
        $EvenementDateMax = $dateMax->format('Y-m-d') ;
        
    }
    
    if(isset($_GET['typeEvenement'])){
        $EvenementTypeEvenement = array($_GET['typeEvenement']);
    }
    
    if(isset($_GET['idOrga'])){
        $EvenementLieu = array($_GET['idOrga']);
    }
    
}

 //$filter = new RetraiteSearchCriteria($EvenementIntervenants, $EvenementLieu,$EvenementTheme, $EvenementGarderie, $EvenementHebergement, $EvenementDateMin, $EvenementDateMax, $EvenementPrix, $EvenementMotsCles,null,null);                   
 $filter = new EvenementSearchCriteria();
 $filter->setEvenementAfterToday(false);
 $filter->setIntervenants($EvenementIntervenants);
 $filter->setEvenementDateMax($EvenementDateMax);
 $filter->setEvenementDateMin($EvenementDateMin);
 $filter->setEvenementGarderie($EvenementGarderie);
 $filter->setEvenementHebergement($EvenementHebergement);
 $filter->setEvenementLieu($EvenementLieu);
 $filter->setEvenementMotsCles($EvenementMotsCles);
 $filter->setEvenementTheme($EvenementTheme);
 $filter->setEvenementPrix($EvenementPrix);
 $filter->setEvenementType($EvenementTypeEvenement);
 $type = "retraite";
 
 
 
 
$nbItems = EvenementActionDao::getNombreEvements($filter);
            
$start = 0;
$nbItemByPage = $_ENV['properties']['Pagination']['evenements'];
$numPage = 1;
if(isset($_POST['numpage'])){
    if($_POST['numpage']!=""){
        $numPage = $_POST['numpage'];
        $start = ($nbItemByPage*$numPage)-$nbItemByPage;
    }                    
}
$filter->setEvenementLimit($start, $nbItemByPage);
$listeEvenements = EvenementAction::getListeEvenements($filter);
//$listeEvenements = RetraiteActionDao::listerToutesLesRetraites($filter);
//$nbItemOnThisPage = count($listeEvenements);
$nbPages = ceil($nbItems/$nbItemByPage);
            
 
 ?>

    <!-- End Header and Nav -->


        <div class="row">   
            
            
            <div class="three columns">
                <a href="#map">
                    <img src="images/spibook/gotomap.png" alt="Voir la carte"/>
                </a>
                
                <div class="panel">
                    
                <?php if(!$valTime){$EvenementDateMin = "";} ?>
                    
                    <form id='filterFormID' name='filterFormName' method='post' action='index.php?page=archives'>
                        <input type="hidden" name="numpage" id="numpage" value=""/>
                        <div class="row">
                            <div id='typeResearch' class='twelve columns searchCriteria '>
                                <label for='Type[]' class='labelSearchField'>Type d'événement</label>
                                <div id='searchField'>
    <!--                                <input type="hidden" name="Type" class="twelve" id="listeType" value="<?php // Util::getListeAvecVirgule($EvenementTypeEvenement); ?>"/>-->
                                <?php echo HtmlFormComponents::SelectTypeEvenements("Type[]", "listeType", 6, "searchField twelve", 1, $EvenementTypeEvenement,true); ?>
    <!--                                <select id='listeType'></select>-->
                                </div>
                            </div>
                            <div id='themeResearch' class='twelve columns searchCriteria'>
                                <label for='theme[]' class='labelSearchField'>Themes</label>
                                 <?php echo HtmlFormComponents::SelectThemeFromEvenement("Theme[]","listeThemes", 6, "searchField twelve", 1, $EvenementTheme); ?>
                            </div>

                            <div id='intervenantsResearch' class='twelve columns searchCriteria'>
                                <label for='Intervenant[]' class='labelSearchField'>Intervenants</label>
                                <?php echo HtmlFormComponents::SelectIntervenantsWithSelectedValue("Intervenant[]","listeIntervenants", 6, "searchField twelve", 1, $EvenementIntervenants); ?> 
                            </div>


                            <div id='lieuxResearch' class='twelve columns searchCriteria'>
                                <label for='Lieu[]' class='labelSearchField'>Organisateurs</label>
<!--                                <input type="hidden" name="Lieu" class="twelve" id="listeLieux" value="<?php Util::getListeAvecVirgule($EvenementLieu); ?>"/>-->
                                 <?php echo HtmlFormComponents::SelectLieuxFromEvenement($type,"Lieu[]","listeLieux", 6, "searchField twelve", 1, $EvenementLieu);  ?>        
                            </div>

                            <div id='keywordResearch' class='twelve columns searchCriteria'>
                                <label for='keywords' class='labelSearchField'>Mots cl&eacute;s </label>
                                <input type='text' name='keywords' id='keywords' class='searchField' value ='<?php echo $EvenementMotsCles; ?>'/>
                            </div>
                            <div class="twelve columns searchCriteria">
                                <label for='DateMin' class='labelSearchField'>Date de début</label>
                                    <input type="text" name="DateMin" value="<?php echo $EvenementDateMin; ?>" id="datetimepicker_dateMin" class="twelve columns"/>
                                
<!--                                <input type='text' name='DateMin' id='DateMin' class='searchField' value='<?php // echo $EvenementDateMin; ?>'/>-->
                            </div>
                            <div class="twelve columns searchCriteria ">
                                <label for='DateMax' class='labelSearchField'>date de fin</label>
<!--                                <input type='text' name='DateMax' id='DateMax' class='searchField' value ='<?php // echo $EvenementDateMax; ?>'/>-->
                                <input type="text" name="DateMax" value="<?php echo $EvenementDateMax; ?>" id="datetimepicker_dateMax" class="twelve columns"/>
                                
                            </div>
                            <div id='buttonResearch' class='twelve columns searchCriteria'>
                                <input type="submit" name='filter' id='filter' class="ten button tiny" value="Rechercher" />

                            </div>    
                        </div>
                    </form>
                </div>
            </div>
            

            <div class="nine columns">
                <div class="twelve">
                       
                    </div>
           
            <div class="twelve nbEventRecherches">
                <h3>Les archives Spibook
                <br/>
                <small>
                    Retrouvez ici les événements passés.
                </small>
                </h3>
                 <div class="twelve nbEventRecherches">
                <?php  if($nbItems > 0){ ?>
                    <?php echo $nbItems ?> événement(s) correspondant à votre recherche
                <?php } ?>
            </div>
            </div>
            
                 
                
                <div class="twelve">
                <?php  if($nbItems > 0){ 
                    echo HtmlUtilComponents::afficherPaginationJavascript("numpage","filterFormName",$nbPages,$numPage); 
                } ?> 
                </div>
                
                
                <div class="twelve columns" >
                <?php 
                       if(count($listeEvenements)<1){
                           ?>
                      <div class="twelve columns">
                        <div class='itemListe twelve columns noresult'>
                            <h4>Désolé, il n'y a pas d'événement correspondant à votre recherche dans nos archives
                                <br/><br/>
                                <small><a href="index.php?page=archives" class="">Retour aux archives</a>
                                <br/>
                                <a href="index.php?page=evenement" class="">Retour aux événements</a></small>
                            </h4>

                        </div>
                      </div>
                 <?php }else{ ?>      

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
                   }
                    ?>

               </div>
               <div class="twelve">
                <?php  if($nbItems > 0){ 
                    echo HtmlUtilComponents::afficherPaginationJavascript("numpage","filterFormName",$nbPages,$numPage); 
                } ?> 
                </div>
            </div>
         
        
         
         
    </div>
    <div class="row">
        <a name="map"></a>
        <div id="map" class="map"></div>
    </div>
    <div class="row">
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
                <input type="text" class="" name="newsletter_email" id="email" value="" placeholder="Email"/>
<!--                <input type="checkbox" name="newsletter_stat" value="1" checked="checked"/>-->

<!--                <p class='labelSearchField '>J'accepte de recevoir les informations des partenaires Spibook</p>
-->                <p class='labelSearchField '><input type="checkbox" name="newsletter_part" value="1" checked="checked" />
                J'accepte de recevoir les mails de spibook</p>
                <input type="submit" name="newsletter_inscription2" id="button" value="Valider l'inscription" class='twelve button round ' />
            </form>
        </div>
     <div class="four columns borderLeftRight">
            <h4 class="titre blocTitle" id="communicationBloc">Communiquons...</h4>
            <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=2"; ?>">
            <p class="contactItemHomePage" id="diffuseur">Vous souhaitez diffusez vos événements sur Spibook ?</p>
            </a>
             <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=3"; ?>">
            <p class="contactItemHomePage" id="annonceur">Vous organisez un événement, lancez un nouveau projet, laissez nous vous aider à le faire connaitre.</p>
             </a>
             <a href="<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"; ?>">
            <p class="contactItemHomePage" id="suggestion">Des idées, des suggestions, n'hésitez pas à nous en faire part.</p>
            </a>
        </div>
        <div class="fb-like-box four columns" data-href="https://www.facebook.com/pages/SpiBook/283290738383457" data-width="292" data-show-faces="true" data-stream="false" data-border-color="#fff" data-header="false">
            
        </div>
           
</div>
    </div>
    <!-- FIN MAIN CONTENT SECTION--> 
    
    <script language="javascript">
    
    function pagination(hiddenFieldId, formName, val){
        
        document.getElementById(hiddenFieldId).value = val;
        document.forms[formName].submit();
 
    }
    
    
    
     <?php
//    $lieuFilter = new LieuSearchCriteria();
//    $lieuFilter->setOrganisateurCommunaute($lieuCommunaute);
//    $lieuFilter->setOrganisateurCommune($lieuCommune);
//    $lieuFilter->setOrganisateurDepartement($lieuDepartement);
//    $lieuFilter->setOrganisateurId($lieuId);
//    $lieuFilter->setOrganisateurMotsCles($lieuMotsCles);
//    $lieuFilter->setOrganisateurRegion($lieuRegion);
//      
//    $listeLieuPourMap = LieuAction::listerLieuxFilteredComplete($lieuFilter, false);
    
    $filterMap = new EvenementSearchCriteria();
    $filterMap->setIntervenants($EvenementIntervenants);
    $filterMap->setEvenementDateMax($EvenementDateMax);
    $filterMap->setEvenementDateMin($EvenementDateMin);
    $filterMap->setEvenementGarderie($EvenementGarderie);
    $filterMap->setEvenementHebergement($EvenementHebergement);
    $filterMap->setEvenementLieu($EvenementLieu);
    $filterMap->setEvenementMotsCles($EvenementMotsCles);
    $filterMap->setEvenementTheme($EvenementTheme);
    $filterMap->setEvenementPrix($EvenementPrix);
    $filterMap->setEvenementType($EvenementTypeEvenement);

//    $listeEvenements = EvenementAction::getListeEvenements($filterMap);
//     $listeEvenements = $listeEvenements;
     
      ?>
     var locations = [<?php 
    foreach ($listeEvenements as $evenement) {
    //                $lieu = LieuAction::recupererUnLieu($evenement->getLieu());
            $place = GeoLocalisation::getPlace($evenement->getPlace());
            $popup = HtmlUtilComponents::getPopUpEventForMap($evenement);
            if($place->isLatAndLong()){
                echo "[\"".$popup."\", ".$place->getLat().",".$place->getLong()."],";
            }

        } 
        ?>];

    var map = new google.maps.Map(document.getElementById('map'), {
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
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

   for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });
//      marker.setIcon("http://www.spibook.com/images/spibook/gmarkers/spibookMarker1.png");

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    
     
    
    </script>
  