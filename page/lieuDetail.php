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
          
                <?php echo HtmlUtilComponents::displaySocialBar($lieu->getNom())?>
          
         
            
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
             <h4 class="titreSectionOrganisateurDetail">Internet</h4>
            <div class="panel">
                <a href="<?php echo $lieu->getLienSiteWeb(); ?>" target="_blank"><?php echo $lieu->getLienSiteWeb(); ?></a>
                <br/>
                <a href="mailto:<?php echo $lieu->getMail(); ?>"><?php echo $lieu->getMail(); ?></a>
            </div>
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