





<?php

include("../services/MainIndex.class.php");

$index = new MainIndex();

$index->setBooAdmin(false);
$index->setDefault_page("home2");
$index->setPage_dir("../page/");
$index->init();



   
    $context = "";
    if (array_key_exists('page', $_GET)) {$context = $_GET['page'];}

    require_once('inc/fo/foHead.php');
    
    if($context == "" || $context == $index->getDefaultPage()){
        require_once('inc/fo/HomeHeader.php');
    }else{
        require_once('inc/fo/Header.php');

        if(UtilNavigateur::getNavigateur()=="IE6"){
            require_once('inc/fo/MainMenuIE6.php');
        }else{
            require_once('inc/fo/MainMenu.php');
        }
    }
    if($_ENV['properties']['Infos']['plateforme'] != "prod"){
        require_once('inc/bugTracker.php');
    }
    
//    echo "<div class='container'>";
    
    $index->run();
?>

<!-- UserVoice JavaScript SDK (only needed once on a page) -->
<script>(function(){var uv=document.createElement('script');uv.type='text/javascript';uv.async=true;uv.src='//widget.uservoice.com/DTbQzQuxhieQjAGWkTrAw.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(uv,s)})()</script>

<!-- A tab to launch the Classic Widget -->
<script>
UserVoice = window.UserVoice || [];
UserVoice.push(['showTab', 'classic_widget', {
  mode: 'full',
  primary_color: '#1b6b74',
  link_color: '#393c42',
  default_mode: 'support',
  forum_id: 259025,
  tab_label: 'Suggestions',
  tab_color: '#1b6b74',
  tab_position: 'middle-right',
  tab_inverted: false
}]);
</script>

<?php
//    echo "</div>";
    $executionTime = $index->getChrono();
    
    require_once('inc/fo/Footer.php');

  

?>
