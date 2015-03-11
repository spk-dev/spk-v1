<?php

$plateforme = $_ENV['properties']['Infos']['plateforme'];
$boo = false;
if(in_array($plateforme, array("local","dev","re7"))){
    $boo = true;
}


if($boo){
?>
<style>
    li.log{
        font-size: 0.7em;
    }
</style>

<div class="row">
    <dl class="tabs">
      <dd class="active"><a href="#debug">Debug</a></dd>
      <dd><a href="#sql">Sql</a></dd>
      <dd><a href="#info">Info</a></dd>
      <dd><a href="#mail">Mail</a></dd>
    </dl>
    <ul class="tabs-content">
      <li class="active log" id="debugTab">
          
          <?php
            if(file_exists("../logs/DebugLogAppli.txt")){
                echo '<textarea  rows="100" cols="20" readonly="readonly">';
                include ("../logs/DebugLogAppli.txt");
                echo "</textarea>";

                
            }else{
                echo "pas de log debug";
            }
          ?>
      </li>
      <li class="log" id="sqlTab">
          <?php
            if(file_exists("../logs/SqlLogAppli.txt")){
                echo '<textarea  rows="100" cols="20" readonly="readonly">';
                include("../logs/SqlLogAppli.txt");
                echo "</textarea>";
                
            }else{
                echo "pas de log sql";
            }
          ?>
      </li>
      <li class="log" id="infoTab">
          <?php
            if(file_exists("../logs/InfoLogAppli.txt")){
                echo '<textarea  rows="100" cols="20" readonly="readonly">';
                include("../logs/InfoLogAppli.txt");
                echo "</textarea>";
            }else{
                echo "pas de log info";
            }
          ?>
      </li>
      <li class="log" id="mailTab">
            <?php
            if(file_exists("../logs/MailLogAppli.txt")){
                echo '<textarea  rows="100" cols="20" readonly="readonly">';
                include("../logs/MailLogAppli.txt");
                echo "</textarea>";
            }else{
                echo "pas de log mail";
            }
          ?>
      </li>
    </ul>
    
    
</div>




<?php    
}else{
    Redirect::frontError(404);
}