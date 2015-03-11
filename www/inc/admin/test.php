<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_GET['test'])){
    echo "valeur passee en get : [".$_GET['test']."]";
}else{
    echo "aucune valeur passee en get";
}

echo $titre;

?>
