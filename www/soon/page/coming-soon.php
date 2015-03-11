<?php include('../../inc/analytics.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class='no-js' lang='en'>
	<!--<![endif]-->
	<head>
		<meta charset='utf-8' />
		<meta content='IE=edge,chrome=1' http-equiv='X-UA-Compatible' />
		<title>SPIBOOK, bient&ocirc;t en ligne</title>
		
		<meta content='jQuery Plugin to make jQuery Cycle Plugin work as a fullscreen background image slideshow' name='description' />
		<meta content='Aaron Vanderzwan' name='author' />
		
		<meta name="distribution" content="global" />
		<meta name="language" content="en" />
		<meta content='width=device-width, initial-scale=1.0' name='viewport' />
		
		<link rel="shortcut icon" href="http://www.stylexseating.com/favicon.ico" />
		<link rel="apple-touch-icon" href="http://www.stylexseating.com/favicon.png" />
		
                <script type="text/javascript" src="../lib/js/compteur.js"></script>
                <link rel="stylesheet" type="text/css" href="../lib/css/compteur.css" />
		<link rel="stylesheet" href="../lib/css/jquery.maximage.css?v=1.2" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="../lib/css/screen.css?v=1.2" type="text/css" media="screen" charset="utf-8" />
		
		<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		
		<link rel="stylesheet" href="../lib/css/styleCusto.css" type="text/css" media="screen"/>
		
		
		<!--[if IE 6]>
			<style type="text/css" media="screen">
				/*I don't feel like messing with pngs for this browser... sorry*/
				#gradient {display:none;}
			</style>
		<![endif]-->
	</head>
	<body>
            
            <div id="MainContent">
                
<!--                <img id="cycle-loader" src="../lib/images/ajax-loader.gif" />-->
                <div id="maximage">
                        <?php
                        $arr_items = array();
                        $arr_items[1] = '<div>
                            <img src="../lib/images/spibook/1.jpg" alt="Coalesse" />
                            <div class="in-slide-content" style="display:none;">
                                    <p>Vous faites quoi ces prochains mois ?</p>	
                            </div>
                        </div>';
                        $arr_items[2] = '<div>
                            <img src="../lib/images/spibook/2.jpg" alt="Coalesse" />
                            <img id="gradient" src="../lib/images/demo/gradient.png" alt="" />
                            <div class="in-slide-content" style="display:none;">
                                    <p>Besoin de prendre l\'air ?</p>
                            </div>
                        </div>';
                        $arr_items[3] = '<div>
                            <img src="../lib/images/spibook/3.jpg" alt="Coalesse" />
                            <img id="gradient" src="../lib/images/demo/gradient.png" alt="" />
                            <div class="in-slide-content" style="display:none;">
                                    <p>Besoin de prendre de la hauteur ?</p>
                            </div>
                        </div>';
                         $arr_items[4] = '<div>
                            <img src="../lib/images/spibook/4.jpg" alt="Coalesse" />
                            <img id="gradient" src="../lib/images/demo/gradient.png" alt="" />
                            <div class="in-slide-content" style="display:none;">
                                    <p>Besoin de prendre des vacances ?</p>
                            </div>
                        </div>';
                         $arr_items[5] = '<div>
                            <img src="../lib/images/spibook/5.jpg" alt="Coalesse" />
                            <img id="gradient" src="../lib/images/demo/gradient.png" alt="" />
                            <div class="in-slide-content" style="display:none;">
                                    <p>Besoin de recharger les batteries ?</p>
                            </div>
                        </div>';
                         $arr_items[6] = '<div>
                            <img src="../lib/images/spibook/6.jpg" alt="Coalesse" />
                            <img id="gradient" src="../lib/images/demo/gradient.png" alt="" />
                            <div class="in-slide-content" style="display:none;">
                                    <p>Besoin de prendre du temps ?</p>
                            </div>
                        </div>';


                        $numbers = range(1, 6);
                        shuffle($numbers);
                        foreach ($numbers as $number) {
                           
                            echo $arr_items[$number];
                        }
                            ?>
                    </div>
                <div id="form-container">
                    <a href="#?w=500" rel="popup_name" class="poplight"><div id="divTitle">
                        <div id="imgLogo">
                            <img src="../lib/images/spibook/spibook.png" />
                        </div>
                    </div>
                     <div id='textIntro'>
                        <label>Bient&ocirc;t en ligne. 
                            Pour &ecirc;tre tenu inform&eacute; des nouveaut&eacute;s Spibook, inscrivez vous &agrave; la newsletter.</label>
                         <br/><label>
                              En savoir plus ... <img src="../lib/images/plus.png" width='30' height='30'/>
                         </label>
                     </div>
                        </a>
                    <div id='newsletter'>
                        
                            <?php
                                
                                if(isset($_GET["result"])){
                                    if($_GET["result"]=="ok"){
                                        echo '<div id="ok" class="NewsResult">';
                                        echo "Votre email a bien &eacute;t&eacute; enregistr&eacute;";
                                        echo ' </div>';
                                    }else{
                                        echo '<div id="ko" class="NewsResult">';
                                        echo "Une erreur a eu lieu, votre email n'a pas &eacute;t&eacute; enregistr&eacute;";
                                        echo ' </div>';
                                    }
                                }
                                
                                if(isset($_GET["erreur"])){
                                    echo '<div id="ErrorMessage">';
                                    echo $_GET['erreur'];
                                    echo ' </div>';
                                }
                            ?>
                       
                        <form id="contact-form" name="contact-form" method="post" action="../../index.php">
                            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                              <tr>
                                <td width="25%"><label for="newsletter_nom">Nom</label></td>
                                <td width="70%"><input type="text" class="" name="newsletter_nom" id="name" value="" /></td>
                                <td width="5%" id="errOffset">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="25%"><label for="newsletter_prenom">Prenom</label></td>
                                <td width="70%"><input type="text" class="" name="newsletter_prenom" id="surname" value="" /></td>
                                <td width="5%" id="errOffset">&nbsp;</td>
                              </tr>
                              <tr>
                                <td><label for="newsletter_email">Email</label></td>
                                <td><input type="text" class="" name="newsletter_email" id="email" value="" /></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                  <td><input type="checkbox" name="newsletter_stat" value="1" checked="checked" /></td>
                                <td><label class="smallLabel" for="newsletter_stat">J'accepte de recevoir les mails de spibook</label></td>
                                <td>&nbsp;</td>
                              </tr>
<!--                              <tr>
                                <td><input type="checkbox" name="newsletter_part" value="1" checked="checked" /></td>
                                <td><label class="smallLabel" for="newsletter_part">J'accepte de recevoir les informations des partenaires Spibook</label></td>
                                <td>&nbsp;</td>
                              </tr>-->
                              <tr>
                                <td valign="top">&nbsp;</td>
                                <td colspan="2"><input type="submit" name="newsletter_inscription" id="button" value="S'inscrire" />


                               </td>
                              </tr>
                            </table>
                         </form>
                    </div><div id="countdown"></div>
                    </div>
                
                </div>
            
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		<script src="../lib/js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="../lib/js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" >
			$(function(){
				$('#maximage').maximage({
//					cycleOptions: {
//						fx: 'fade',
//						speed: 1000, // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
//						timeout: 0,
//						prev: '#arrow_left',
//						next: '#arrow_right',
//						pause: 0,
//						before: function(last,current){
//							if(!$.browser.msie){
//								// Start HTML5 video when you arrive
//								if($(current).find('video').length > 0) $(current).find('video')[0].play();
//							}
//						},
//						after: function(last,current){
//							if(!$.browser.msie){
//								// Pauses HTML5 video when you leave it
//								if($(last).find('video').length > 0) $(last).find('video')[0].pause();
//							}
//						}
//					},
					onFirstImageLoaded: function(){
						jQuery('#cycle-loader').hide();
						jQuery('#maximage').fadeIn('fast');
					}
				});
	
//				// Helper function to Fill and Center the HTML5 Video
//				jQuery('video,object').maximage('maxcover');
	
				// To show it is dynamic html text
				jQuery('.in-slide-content').delay(300).fadeIn();
			});
		</script>
		
		<!-- DON'T USE THIS: Insert Google Analytics code here -->
		<script type="text/javascript">
			
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-733524-1']);
		  _gaq.push(['_trackPageview']);
			
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
                
                
                
                <script type='text/javascript'>
                
                $(document).ready(function() {

                    //Lorsque vous cliquez sur un lien de la classe poplight et que le href commence par #
                    $('a.poplight[href^=#]').click(function() {
                            var popID = $(this).attr('rel'); //Trouver la pop-up correspondante
                            var popURL = $(this).attr('href'); //Retrouver la largeur dans le href

                            //Récupérer les variables depuis le lien
                            var query= popURL.split('?');
                            var dim= query[1].split('&amp;');
                            var popWidth = dim[0].split('=')[1]; //La première valeur du lien

                            //Faire apparaitre la pop-up et ajouter le bouton de fermeture
                            $('#' + popID).fadeIn().css({
                                    'width': Number(popWidth)
                            })
                            .prepend('<a href="#" class="close"><img src="../lib/images/close_pop.png" class="btn_close" title="Fermer" alt="Fermer" /></a>');

                            //Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
                            var popMargTop = ($('#' + popID).height() + 80) / 2;
                            var popMargLeft = ($('#' + popID).width() + 80) / 2;

                            //On affecte le margin
                            $('#' + popID).css({
                                    'margin-top' : -popMargTop,
                                    'margin-left' : -popMargLeft
                            });

                            //Effet fade-in du fond opaque
                            $('body').append('<div id="fade"></div>'); //Ajout du fond opaque noir
                            //Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues de IE
                            $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();

                            return false;
                    });

                    //Fermeture de la pop-up et du fond
                    $('a.close, #fade').live('click', function() { //Au clic sur le bouton ou sur le calque...
                            $('#fade , .popup_block').fadeOut(function() {
                                    $('#fade, a.close').remove();  //...ils disparaissent ensemble
                            });
                            return false;
                    });
                });
                </script>
                    
                
                
<div id="popup_name" class="popup_block">
	<?php
            include('contentPopUp.html');
        ?>
</div>
  </body>
</html>
