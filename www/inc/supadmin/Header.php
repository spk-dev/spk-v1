<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8" />

  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>SPIBOOK - SuperADMIN</title>
  
  <!-- Included CSS Files (Uncompressed) -->
  <!--
  <link rel="stylesheet" href="stylesheets/foundation.css">
  -->
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="stylesheets/foundation.min.css"/>
  <link rel="stylesheet" href="stylesheets/app.css"/>
  <link rel="stylesheet" href="stylesheets/admstyle.css"/>
  <link rel="stylesheet" href="stylesheets/select2.css"/>
  <link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script type="text/javascript" src="adminJavascripts/ckeditor/ckeditor.js"></script> 

<!--    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>
-->    <script type="text/javascript" src="javascripts/jquery.js"></script><!--
     <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <script type="text/javascript" src="javascripts/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="javascripts/jquery-ui-sliderAccess.js"></script>
    <script type="text/javascript" src="javascripts/select2.min.js"></script>
    <script type="text/javascript" src="javascripts/jquery.validate.min.js"></script>
    <script type="text/javascript" src="adminJavascripts/valideForm.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->
  
    

  
  
<!--<script src="javascripts/modernizr.foundation.js"></script>-->

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  
  
</head>
<body>
    <!-- Header and Nav -->
  
  <div class="row">
    <div class="seven columns">
        <h3><a href="superadmin.php">SPIBOOK</a></h3><br/>
        <?php 
            if(UtilSession::isSessionLoaded()){
                echo AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId())->getMail();
            }
            ?>
            
    </div>
       <?php // if($_ENV['properties']['Infos']['plateforme'] != "prod"){?>
        
        <div class="two columns">
            <br/><br/>                
            <a href="#" data-reveal-id="bugTracker">
                <img class="two" src="images/spibook/bugtracker.png"/>Bug
            </a>
        </div>
            <?php // }?>
    <div class="three columns">
       
        <form action="" method="POST" class="custom">
            <?php if(UtilSession::isSessionLoaded()){?>
            <input type="submit" class="button small alert twelve " value="deconnexion" name="deconnexion"/>
            <?php } ?>
        </form>
        <a href="index.php" class="button small secondary twelve ">Retour sur le site</a>
    </div>
   
    
  </div>
<!--  FIN HEADER-->