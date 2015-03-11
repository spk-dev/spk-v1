 <!-- CONTIENT TOUTE LA PAGE -->
    <div id="container">
        
        <!-- Bandeau de haut de page -->
    	<div id="Header" class="standardBloc">
            
            <div id="Logo"><a href="<?php echo $_ENV['properties']['Path']['sitePath'] ?>">Spbk-adm</a></div>
            <div id="blocAddHeader">
                Zone d'administration du site
                <?php echo HtmlFormComponents::formConnect("div", "#"); ?>
                
            </div>
            
        </div>  <!-- Fin de header  -->
        