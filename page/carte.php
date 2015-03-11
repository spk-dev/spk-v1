<!DOCTYPE html>
<div class='row'><html> 
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>multi-marqueurs</title> 
  <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
</head> 
<body>
  <div id="map" style="width: 600px; height: 550px;"></div>

  <script type="text/javascript">
      
      <?php
      $lieuFilter = new OrganisateurSearchCriteria();
      
      $listeLieuPourMap = LieuAction::listerLieuxFiltered($lieuFilter, false);
      
      
      
      ?>
      
    var locations = [
        <?php
      
      foreach ($listeLieuPourMap as $lieu) {
        echo "['".$lieu->getNom()."', ".$lieu->getLat().",".$lieu->getLong().", 5],";
      }
        ?>
//      ['Jérôme et Catherine Blondel', 49.898729,3.13606, 5],
//      ['Laurent et Sabine Blondel', 50.684142,3.1360678, 4],
//      ['Noël et Anne Marie Blondel', 49.953802, 2.360237, 3],
//      ['Jean Luc et Catherine Blondel', 48.606369,2.886894, 2],
//      ['Patrice  et Marie Alix Blondel', 46.149513,6.410866, 1]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 6,
      center: new google.maps.LatLng(47.4,1.6),
      	  mapTypeControl: true,
    	mapTypeControlOptions: {
      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
    },
	navigationControl: true,
   	 navigationControlOptions: {
        style: google.maps.NavigationControlStyle.SMALL,
        position: google.maps.ControlPosition.TOP_RIGHT
    },
    	scaleControl: true,
 	streetViewControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

   for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

  </script>
</body>
</html>
</div>