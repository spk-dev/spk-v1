<?php 

if(isset($_GET['id'])){
   
    $idLieu = SecurityUtil::securNumParam($_GET['id']);
    $lieuExist = LieuAction::exist($idLieu,false);

    if (!$lieuExist){
        Redirect::frontError(404);
    }else{
        $lieu = LieuAction::recupererUnLieu($idLieu, false);
    }
}else{
    Redirect::frontError(404);
}
?>

<div class="row">
        <div class="twelve columns">
            
            <h3>
                <?php echo $lieu->getNom(); ?>
                <small>
                    <br/>                    
                        <?php 
                        if($lieu->getCommunaute() != 0){
                            echo CommunauteAction::recupererCommunaute($lieu->getCommunaute())->getNom();
                        }
                        ?>
                </small>
            </h3>
        </div>
        
        <div class="eight columns">
            
            <div id="slider_principal">
             
                <?php
                        $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 1);
                        echo "<img class='twelve' src=\"".$img."\"/>";
               
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
            
            <?php
                echo $lieu->getDescription();
            
            ?>
            <div class="twelve columns">
                    
                <h3 class="listeSousItem">
                    Les prochains événements
                    &nbsp;
                    <small><a href="">( Voir tous... )</a></small>
                </h3>

                <?php
                    $filter = new EvenementSearchCriteria();
                    $tabLieu = array($lieu->getId());
                    $filter->setEvenementLieu($tabLieu);
                    $filter->setEvenementAfterToday(true);
                    $filter->setEvenementLimit(0, 5);
                    $listeEvenements = EvenementAction::getListeEvenements($filter);
                    include('inc/gridEventOneColumn.php');
                ?>
                
               
            </div>
            <div class="twelve columns">
                    
                <h3 class="listeSousItem">
                    Les événements passés
                    &nbsp;
                    <small><a href="index.php?page=archives">( Voir les archives... )</a></small>
                </h3>

                <?php
                    $filter = new EvenementSearchCriteria();
                    $tabLieu = array($lieu->getId());
                    $filter->setEvenementLieu($tabLieu);
                    $filter->setEvenementAfterToday(false);
                    $filter->setEvenementLimit(0, 5);
                    $listeEvenements = EvenementAction::getListeEvenements($filter);
                    include('inc/gridEventOneColumn.php');
                ?>
                
               
            </div>
        </div>
        
        
        
        
        
        <div class="four columns">
            
            <?php
                
                $lat = $lieu->getLat();
                $long = $lieu->getLong();
            ?>
            <div id="mapSmall" class="map">
                
            </div>

            
           
            <h4 class="titreSectionOrganisateurDetail">L'adresse</h4>
            <div class="panel">
                <?php echo $lieu->getAdresse1(); ?><br/>
                <?php echo $lieu->getAdresse2(); ?><br/>
                <?php echo $lieu->getCp(); ?> <br/>
                <?php echo $lieu->getVille(); ?><br/>
                <?php echo $lieu->getPays(); ?><br/>
            </div>
            <h4 class="titreSectionOrganisateurDetail">Nous contacter</h4>
            <div class="panel">
                <?php if($lieu->getTel() != ""){
                    echo "tel: ".$lieu->getTel()."<br/>"; }
                ?>
                <?php if($lieu->getFax() != ""){
                    echo "fax: ".$lieu->getFax()."<br/>"; }
                ?>
                <a href="<?php echo $lieu->getLienSiteWeb(); ?>" target="_blank"><?php echo $lieu->getLienSiteWeb(); ?></a>
                <br/>
                <a href="mailto:<?php echo $lieu->getMail(); ?>"><?php echo $lieu->getMail(); ?></a>
            </div>
            <?php if(""!=($lieu->getVoiture().$lieu->getTrain().$lieu->getAvion())){?>
                <h4 class="titreSectionOrganisateurDetail">S'y rendre</h4>
                <div class="panel">
                <?php if(""!= $lieu->getVoiture() && !is_null($lieu->getVoiture())){?>
                    En voiture <br/>
                    <?php echo $lieu->getVoiture(); ?><br/>
                    <br/>
                <?php }
                if(""!= $lieu->getTrain() || !is_null($lieu->getTrain())){ ?>
                    En train<br/>
                    <?php echo $lieu->getTrain(); ?> <br/>  
                    <br/>
                <?php }
                if(""!= $lieu->getAvion()&& !is_null($lieu->getAvion())){ ?>
                    En avion<br/>
                    <?php echo $lieu->getAvion(); ?>
                <?php } ?>
                </div>
            <?php }?>
             
        </div>
             
        </div>
        
        <hr/>
        
        <div class="row">
   
              
        </div>
        <div class="three columns">
            
        </div>

        
        
        <?php
//            $count=1;
//            foreach (LieuAction::recupererGalerieLieu($lieu) as $image) {  
//                $img = HtmlUtilComponents::imageControl("lieux", $image, 1);
//                            
//                echo "<a class=\"close-reveal-modal\"><img src=\"".$img."\" id=\"myModal".$count."\" class=\"reveal-modal expand\"/></a>";
//                $count++;
//            }

        ?>

        
<script>
var map = new google.maps.Map(document.getElementById('mapSmall'), {
zoom: 5,
center: new google.maps.LatLng(<?php echo $lat; ?>,<?php echo $long; ?>),
mapTypeId: google.maps.MapTypeId.TERRAIN
});

var marker;


marker = new google.maps.Marker({
    position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $long; ?>),
    map: map
});

//marker.setIcon("http://www.spibook.com/images/spibook/gmarkers/spibookMarker1.png");


</script>