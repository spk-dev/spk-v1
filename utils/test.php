<?php

// RŽcupŽration des variables GET
$tabUrl = parse_url ( $_SERVER [ 'REQUEST_URI' ] ) ;
$listparam = explode ( "&" , $tabUrl [ 'query' ] ) ;
$nb_param = count ( $listparam ) ;

// on associe les valeurs
for ( $i=0 ; $i<$nb_param ; $i++)  {
	$param = explode ( '=' , $listparam[$i] ) ;
	$paramname = $param[0];
	$paramvalue = $param[1];
	$$paramname = $paramvalue;
}


// RŽcupŽration des variables POST
foreach ( $_POST as $post => $val )  {
	$$post = $val;
}


// affichage d'une variable post ou get
echo $mavariable ;

$_

?>