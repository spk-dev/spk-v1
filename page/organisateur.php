

<?php


    $lieuCommunaute     =null;
    $lieuCommune        =null;
    $lieuDepartement    =null;        
    $lieuId             =null;
    $lieuMotsCles       =null;
    $lieuRegion         =null;
    $lieuType           =null;
    $filtreOrganisateurs = new OrganisateurSearchCriteria();

    
                
    if(isset($_POST['Regions'])){       $lieuRegion = $_POST['Regions'];}
    if(isset($_POST['Departements'])){  $lieuDepartement = $_POST['Departements'];}
    if(isset($_POST['Communautes'])){   $lieuCommunaute = $_POST['Communautes'];}
    if(isset($_POST['Types'])){          $lieuType = $_POST['Types'];}
    if(isset($_POST['keywords'])){
        if("" != $_POST['keywords']){
            $lieuMotsCles = $_POST['keywords'];
        }
    }
    if(isset($_GET['Regions'])){$lieuRegion = array($_GET['Regions']);}
    if(isset($_GET['Departements'])){   $lieuDepartement = array($_GET['Departements']);}
    if(isset($_GET['Communautes'])){    $lieuCommunaute = array($_GET['Communautes']);}
    if(isset($_GET['Types'])){          $lieuType = array($_GET['Types']); }

    if(isset($_POST['Lieu'])){          $EvenementLieu = $_POST['Lieu'];    }



    $filtreOrganisateurs->setOrganisateurCommunaute($lieuCommunaute);
    $filtreOrganisateurs->setOrganisateurCommune($lieuCommune);
    $filtreOrganisateurs->setOrganisateurDepartement($lieuDepartement);
    $filtreOrganisateurs->setOrganisateurId($EvenementLieu);
    $filtreOrganisateurs->setOrganisateurMotsCles($lieuMotsCles);
    $filtreOrganisateurs->setOrganisateurRegion($lieuRegion);
    $filtreOrganisateurs->setOrganisateurType($lieuType);
    $nbItems  = LieuAction::compterLieuxFiltered($filtreOrganisateurs,false);

    $start = 0;
    $nbItemByPage = $_ENV['properties']['Pagination']['organisateurs'];
    $numPage = 1;
    $nbPages = ceil($nbItems/$nbItemByPage);

// récupération du numéro de la page           

    if(isset($_POST['numpage'])){
        if($_POST['numpage']!=""){
            $numPage = $_POST['numpage'];
            $start = ($nbItemByPage*$numPage)-$nbItemByPage;
        }                    
    }

    $filtreOrganisateurs->setOrganisateurLimit($start, $nbItemByPage);
    $filtreOrganisateurs->setOrganisateurOrder(DB::getParam("vlc", "NbAVenir"),"DESC");
    $listeLieux  = LieuAction::listerLieuxFilteredComplete($filtreOrganisateurs,false);




?>

<div class="row">
    <div class="three columns ">
        <div class='twelve columns panel'>
        <form id='filterFormID' name='filterFormName' method='POST' action='index.php?page=organisateur'>
<!--                <input type="hidden" name="page" value="organisateur"/>-->
                <input type="hidden" name="numpage" id="numpageId" value=""/>
                
                <div  class='searchCriteria'>
<!--                <label for='Lieu[]' class='labelSearchField'>Organisateur</label>
                
                <input type="hidden" name="Lieu" class="twelve" id="listeLieux" value="<?php echo Util::getListeAvecVirguleLieuGetId($lieuId); ?>"/>-->

                <label for='Lieu[]' class='labelSearchField'>Organisateurs</label>
                <?php echo HtmlFormComponents::SelectLieuxFromEvenement("retraite","Lieu[] ","listeLieux", 6, "searchField twelve", 1, $EvenementLieu);  ?>        

                </div>
                <br/>
                
                
                <div  class='searchCriteria'>
                <label for='Regions[]' class='labelSearchField'>Par région</label>
                <?php echo HtmlFormComponents::SelectRegions(true , "Regions[]",  "listeRegions",6, "contactItem twelve", 1,$lieuRegion); ?>
                </div>
                    
                <div  class='searchCriteria'>
                <label for='Departements[]' class='labelSearchField'>Par département</label>
                <?php echo HtmlFormComponents::SelectDepartements(true , "Departements[]",  "listeDepartements",6, "contactItem twelve", 1,$lieuDepartement,"evenement"); ?>
                </div>
            
                <div class='searchCriteria'>
                <label for='Communautes[]' class='labelSearchField'>Communautés / Ordres</label>
                <?php // HtmlFormComponents::SelectDepartements($contientDesRetraites, $name, $id, $size, $cssClass, $multiple)?>
                <?php echo HtmlFormComponents::selectCommunaute("Communautes[]", "listeCommunautes", 6, "contactItem twelve", 1, $lieuCommunaute); ?>
                
                </div>
            
                <div class='searchCriteria'>
                <label for='Types[]' class='labelSearchField'>Types</label>
                <?php // HtmlFormComponents::SelectDepartements($contientDesRetraites, $name, $id, $size, $cssClass, $multiple)?>
                <?php echo HtmlFormComponents::selectType("Types[]", "listeTypeOrga", 6, "contactItem twelve", 1, $lieuType); ?>
                
                </div>
    
                <div id='keywordResearch' class='searchCriteria'>
                <label for='keywords' class='labelSearchField'>Mots cl&eacute;s </label>
                <input type='text' name='keywords' id='keywords' class='searchField' value="<?php echo $lieuMotsCles; ?>"/>
                </div>
            

            
            <div id='buttonResearch' class='searchCriteria twelve'>
                <input type="submit" name='filter' id='filter' class="nine button tiny" value="Rechercher" />
                
            </div>    

            </form></div>
    </div>
   
    <div class="nine columns">
         <div id="map" class='map twelve'></div>
          <div class="twelve nbEventRecherches">
                <?php echo count($listeLieux) ?> organisateurs correspondent à votre recherche
            </div>
         <?php 
            $hiddenFieldId = "numpageId";
            $formName = "filterFormName";
            echo HtmlUtilComponents::afficherPaginationJavascript($hiddenFieldId, $formName,$nbPages,$numPage); 
        ?> 
       
       
       



        
        
        
    </div>
    <div class="twelve columns">
         
        <div class="twelve" >
         <?php 
                if(count($listeLieux)<1){
                    ?>
               <div class="twelve columns">
               <div class='itemListe twelve columns noresult'>
               Désolé, il n'y a pas encore d'organisateur d'événement correspondant à votre recherche
               <br/><br/>
               <a href='<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"; ?>'>Cliquer ici pour signaler un dysfonctionnement ou suggérer un organisateur.</a>";
               </div></div>
          <?php }else{ ?>     
        <ul class="block-grid three-up mobile" >
           <?php
                foreach($listeLieux as $lieu){
                     $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
                     $filter = new EvenementSearchCriteria();
                     $filter->setEvenementLieu(array($lieu->getid()));
                     
            ?>
            <li class="itemListe">
                
                <div class="itemOrga">
                    <div class="organisationLigneEvent ten columns"> 
                        <a href='index.php?page=organisateurDetail&id=<?php echo $lieu->getId(); ?>'>
                        <h1 class="titreOrganisateur"><?php echo $lieu->getnom(); ?></h1></a>
                        <div class='geoOrganisateur'>
                            <p class="villeOrganisateur"><?php echo $lieu->getVille(); ?></p>
                            <p class="regionsOrganisateur"><?php echo $lieu->getRegion()." | ".$lieu->getDepartement(); ?></p>
                        </div>
                        
                    </div>
                    <div class="zoneNbEvent two columns">
                        
                        <p class="nbEvenementOrganisateur"><?php echo $lieu->getNbEventAVenir(); ?></p>
<!--                    <p class="textEvenementOrganisateur">Evenements à venir</p>-->
                    </div>
<!--                    <img src="<?php echo $img; ?>" class="imgCaptionListe" alt="<a href=''>Voir les événements de <?php echo $lieu->getnom(); ?></a>"/>-->
                        <img src="<?php echo $img; ?>" class="imgCaptionListe twelve" alt="<?php echo LieuAction::captyForOrganisateur($lieu->getId(),$lieu->getNbEvent(),$lieu->getNbEventAVenir())?>"/>
                </div>
                
            </li>
            <?php
                }
           }
            ?>
        </ul>
        </div>
        <?php 

            echo HtmlUtilComponents::afficherPaginationJavascript($hiddenFieldId, $formName,$nbPages,$numPage); 
        ?>  
    </div>
    
</div>


<script language="javascript">
    
    function pagination(hiddenFieldId, formName, val){
        
        document.getElementById(hiddenFieldId).value = val;
        document.forms[formName].submit();

    }


    function resetForm(formId){
        alert(formId)
        var f = document.getElementById(formId);
        for (var i in f.elements) {
            f.elements.value = "";
        }
    }


      
      <?php
    $lieuFilter2 = new OrganisateurSearchCriteria();
    $lieuFilter2->setOrganisateurCommunaute($lieuCommunaute);
    $lieuFilter2->setOrganisateurCommune($lieuCommune);
    $lieuFilter2->setOrganisateurDepartement($lieuDepartement);
    $lieuFilter2->setOrganisateurId($lieuId);
    $lieuFilter2->setOrganisateurMotsCles($lieuMotsCles);
    $lieuFilter2->setOrganisateurRegion($lieuRegion);
    $lieuFilter2->setOrganisateurType($lieuType);
    $listeLieuPourMap = LieuAction::listerLieuxFilteredComplete($lieuFilter2, false);
    
      ?>
      
    var locations = [
    <?php 
        foreach ($listeLieuPourMap as $lieu) {
            $popup = HtmlUtilComponents::getPopUpOrganisateurForMap($lieu);
            $onpage = 0;
            if(in_array($lieu, $listeLieux)){
                $onpage = 1;
            }
            echo "[\"".$popup."\",".$lieu->getLat().",".$lieu->getLong()."],";
//            echo "['".LieuAction::popupformap($lieu)."', ".$lieu->getLat().",".$lieu->getLong().", ".$lieu->getCommunaute().",".$onpage."],";} 
        }
            ?>
                ];

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 5,
        center: new google.maps.LatLng(47.4,1.6)
 });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

   for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

//
        marker.setIcon("http://www.spibook.com/images/spibook/gmarkers/spibook.png");

      google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
        return function() {
//          infowindow.setContent(locations[i][0]+"<br/>"+locations[i][4]);
        infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

  </script>