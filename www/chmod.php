<?php

$dir = "../logs/";
echo "AVANT MODIF DE CHMOD";
$perm = fileperms($dir);
    echo substr(sprintf('%o', $perm ), -3);
    echo "suppression";
rmdir($dir);

echo "<br/>creation";
mkdir($dir,0644);
if(chmod($dir, 0644)){
    
    echo "Modif chmod de ".$dir. " ok.";
   
    echo "<br/><br/>";
    $perm = fileperms($dir);
    echo substr(sprintf('%o', $perm ), -3);
    
}else{
    
    echo "Modif chmod de ".$dir. " ko.";
   
    echo "<br/><br/>";
    $perm = fileperms($dir);
    echo substr(sprintf('%o', $perm ), -4);
}



?>
