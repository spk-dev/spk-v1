<?php


$listeLieu = LieuActionDao::listerTousLieux();

$lieu = new Lieu();
$listeAdresse = "";
foreach ($listeLieu as $lieu) {
    $listeAdresse .= "{address: \"".$lieu->getAdresseComplete()."\",data:\"".$lieu->getNom()."<br/>".$lieu->getAdresseComplete()."\"},";

    
}

?>


<script type="text/javascript">
        
      $(function(){
      
        $('#test1')
          .gmap3(
          { action:'init',
            options:{
              center:[46.578498,2.457275],
              zoom: 5
            }
          },
          { action: 'addMarkers',
            markers:[
             <?php echo $listeAdresse;?>
            ],
            marker:{
              options:{
                draggable: false
              },
              events:{
                mouseover: function(marker, event, data){
                  var map = $(this).gmap3('get'),
                      infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.open(map, marker);
                    infowindow.setContent(data);
                  } else {
                    $(this).gmap3({action:'addinfowindow', anchor:marker, options:{content: data}});
                  }
                },
                mouseout: function(){
                  var infowindow = $(this).gmap3({action:'get', name:'infowindow'});
                  if (infowindow){
                    infowindow.close();
                  }
                }
              }
            }
          }
        );
      });
    </script>
    
    
   
    
    
    
<div id="reseachRetraites">
    TOTO
</div>
 <div id="test1" class="gmapRegional"></div>


<div id="pubBottomList">

</div>
 
 <!--
  {address: "46000 Cahors",data:'TEST CAHORS'},
              {lat:48.8620722, lng:2.352047, data:'Paris !'},
              {lat:46.59433,lng:0.342236, data:'Poitiers : great city !'},
              {lat:42.704931, lng:2.894697, data:'Perpignan ! <br> GO USAP !'}
 -->