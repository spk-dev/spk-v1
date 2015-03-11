<!--<div class="row">-->
        <div class="row"></div>
        <div class="two columns">
            <h5 class="subheader bottomContent bottomTitle"><a href="index.php?page=evenement" target="_self">Les événements près de chez vous</a></h5>
            <?php echo MenuAction::getRegions("ul","evenements");?>
        </div>
        <div class="two columns">
            
            <h5 class="subheader bottomContent bottomTitle"><a href="index.php?page=evenement" target="_self">Des événements pour tous les moments de la vie</a></h5>
            <?php echo MenuAction::getThemes(false,"ul");?>
            
        </div>
        <div class="two columns">
            <h5 class="subheader bottomContent bottomTitle"><a href="index.php?page=evenement" target="_self">Des événements qui vous ressemblent</a></h5>
             <?php echo MenuAction::getTypesEvenements(false,"ul"); ?>
        </div>
        <div class="two columns">
            <h5 class="subheader bottomContent bottomTitle"><a href="index.php?page=organisateur" target="_self">Les organisateurs</a></h5>
            <?php echo MenuAction::getLieux(false,"ul");?>
            
        </div>
        <div class="two columns">
            <h5 class="subheader bottomContent bottomTitle"><a href="http://blog.spibook.com/" target="_blank">Spibook</a></h5>
            <?php echo MenuAction::getSpibook("ul"); ?>
            
            <h5 class="subheader bottomContent bottomTitle">Les références</h5>
            <?php echo MenuAction::getLiensExternes("ul"); ?>
            
        </div>
        <div class="two columns">
            <h5 class="subheader bottomContent bottomTitle">Administration</h5>
            <?php // echo MenuAction::getSpibook("ul"); ?>
            <ul class='listMenu'><li><a href="admin.php">accéder à mon compte organisateur</a></li></ul>
     
        </div>

<!--</div>-->
<div class="row"></div>