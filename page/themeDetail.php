<?php 

if(isset($_GET['themeId'])){
  $themeId = $_GET['themeId'];
  $theme = ThemeAction::recupererUnTheme($themeId);
  if(is_null($theme)){
       Redirect::frontError(404);
  }
  
}else{
    Redirect::frontError(403);
}
?>


    


</div>



<div id="pubBottomList">
</div>


<div class="row">
        <div class="twelve columns">
            <h3><?php echo $theme->getnom(); ?></h3>
        </div>
        
            
            <div class="twelve columns">
                <div class="four columns">
                    <?php
                        $img = HtmlUtilComponents::imageControl("themes", $theme->getimage(), 1);
                        echo "<img src='".$img."' title='title1' alt='tag alt1' style=\"float:left; margin:1em;\"/>";
                    ?>
                </div>
                <div class="eight columns">
                    <?php echo $theme->getDescription();?>
                        <div class="twelve columns">
                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                            <a class="addthis_button_preferred_1"></a>
                            <a class="addthis_button_preferred_2"></a>
                            <a class="addthis_button_preferred_3"></a>
                            <a class="addthis_button_preferred_4"></a>
                            <a class="addthis_button_compact"></a>
                            <a class="addthis_counter addthis_bubble_style"></a>
                            </div>
                            <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-538f1cbb01e1612d"></script>
                            <!-- AddThis Button END -->
                         </div>
                </div>
            
                
            </div>

        </div>
 
        
        
        
        
        
        
            
        </div>
        
        <hr/>
        
        <div class="row">
                <div class="twelve columns">
                    
                        <h3 class="listeSousItem">
                            Les événements sur ce thème
                        </h3>
                        
                        <?php
                            $filter = new EvenementSearchCriteria();
                            $tabTheme = array($themeId);
                            $filter->setEvenementTheme($tabTheme);
                            $filter->setEvenementAfterToday(true);
                            $listeRetraite = EvenementAction::getListeEvenements($filter);
                            include('inc/gridEvent.php');
                            
                        ?>
                        
                            
                
                


                </div>
            
        </div>
        <div class="three columns">
            
        </div>