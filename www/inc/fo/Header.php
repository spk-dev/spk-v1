
<body>
    <div id="fb-root"></div>
    <!-- SDK Facebook -->
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- FIN SDK Facebook -->

    <!-- Header and Nav -->
    <div class="containerSpk">
        <div class="row">
          <div class="four columns">
              <a href="index.php"><img src="images/spibook/SpibookLogo-9-2.png" /></a>
          </div>
            <div class="four columns"></div>
                <div class="five columns">
                     <br/>
                    <?php if($_ENV['properties']['Infos']['plateforme'] != "prod"){?>
                                    
                        <a href="#" data-reveal-id="bugTracker">
                            <img class="two" src="images/spibook/bugtracker.png"/>Signaler un bug
                        </a>
                    <?php }?>
                        <br/>   
                        <p class="titreDetailBlanc">retrouvez nous sur 
                        <a href="https://www.facebook.com/pages/Spibook/283290738383457" title="événements catholiques facebook" alt="Lien de la page Spibook sur facebook." target="_blank"><img src="images/spibook/facebook.png" /></a>&nbsp;
                        <a href="https://twitter.com/spibook" title="événements catholiques sur twitter" alt="Lien de la page Spibook sur twitter." target="_blank"><img src="images/spibook/twitter.png" /></a>&nbsp;
                        <a href="https://www.youtube.com/channel/UC_CZcfqlq06gWMwmqXYU3Eg" title="événements catholiques facebook" alt="Lien de la page Spibook sur youtube." target="_blank"><img src="images/spibook/youtube2.png" /></a>
                         </p>
                </div>
        </div>

<!--    </div>-->
<!--  FIN HEADER-->