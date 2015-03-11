
<!-- ADMIN -->
<?php if(UtilSession::isSessionLoaded()){ ?>
<div id="footer1" class="footerDiv">
    <a href='admin.php?page=contact'><p class="footerText centerText">Vous avez une question sur la manière d'utiliser votre interface d'administration, n'hésitez pas à nous contacter.</p></a>
</div>
<?php }else{ ?>
<div id="footer1" class="footerDiv">
    <p class="footerText centerText">Zone d'administration SPIBOOK</p>
</div>
<?php } ?>
<div id="footer2" class="footerDiv">
    <p class="footerText centerText"><?php include("inc/admin/legals.php"); ?></p>
</div>    
    
<!-- Included JS Files (Compressed) -->
<script src="javascripts/jquery.js"></script>
<script src="javascripts/foundation.min.js"></script>

<!-- Initialize JS Plugins -->
<script src="javascripts/app.js"></script>
<!--<script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>-->
<script src="javascripts/jquery-ui.min.js"></script>
<script src="javascripts/modernizr.foundation.js"></script>
  
  <!-- Included JS Files (Uncompressed) -->
  <!--
  
  <script src="javascripts/jquery.js"></script>
  
  <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
  
  <script src="javascripts/jquery.foundation.forms.js"></script>
  
  <script src="javascripts/jquery.foundation.reveal.js"></script>
  
  <script src="javascripts/jquery.foundation.orbit.js"></script>
  
  <script src="javascripts/jquery.foundation.navigation.js"></script>
  
  <script src="javascripts/jquery.foundation.buttons.js"></script>
  
  <script src="javascripts/jquery.foundation.tabs.js"></script>
  
  <script src="javascripts/jquery.foundation.tooltips.js"></script>
  
  <script src="javascripts/jquery.foundation.accordion.js"></script>
  
  <script src="javascripts/jquery.placeholder.js"></script>
  
  <script src="javascripts/jquery.foundation.alerts.js"></script>
  
  <script src="javascripts/jquery.foundation.topbar.js"></script>
  
  <script src="javascripts/jquery.foundation.joyride.js"></script>
  
  <script src="javascripts/jquery.foundation.clearing.js"></script>
  
  <script src="javascripts/jquery.foundation.magellan.js"></script>
  
  -->
  

    
    <!-- OK -->

    <script type="text/javascript" src="javascripts/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="javascripts/jquery-ui-sliderAccess.js"></script>
    <script type="text/javascript" src="javascripts/select2.min.js"></script>
    <script type="text/javascript" src="adminJavascripts/manageEvenement.js"></script>
    <script type="text/javascript" src="javascript/spibook.js"></script>
    <?php if($_ENV['properties']['Infos']['plateforme'] != "prod"){ ?>
        <script type="text/javascript" src="adminJavascripts/bugTracker.js"></script>
    <?php }   ?>
        
    <script src="javascripts/nicEdit.js" type="text/javascript"></script>
    <script type="text/javascript" src="javascripts/jquery.capty.min.js"></script>
<!--    <script src= "http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyCXxPjgv1Omtx_rVlRSOOwhuPWTvcgfEps" type= "text/javascript"> </script>-->
    <script type="text/javascript" src="javascripts/jquery.joyride-2.0.3.js"></script>    
       
<!--    <script src="javascripts/masonry.pkgd.min.js"></script>     -->
        <?php echo "page affich&eacute;e en ".$executionTime." s.";?>  
<?php include_once('inc/analytics.php'); ?>

</body>
</html>
