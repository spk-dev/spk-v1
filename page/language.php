<?php

//Formulaire servant à changer la langue du site
echo "<form name='changeLanguage' id='changeLanguage' method='POST' action='".$_SERVER["REQUEST_URI"]."'>";
echo "<input type='hidden' name='lang' id='lang' value=''>";
echo "</form>";

// Menu Langue (drapeaux). adressent une fonction javascript
echo "<a href=\"javascript:changeLanguage('fr');\"><img alt='drapeau Francais' src='img/site/icones/drapeau_fr.jpg'></a>";
echo " ";
echo "<a href=\"javascript:changeLanguage('en');\"><img alt='drapeau Anglais' src='img/site/icones/drapeau_en.jpg'></a>";
echo " ";
echo "<a href=\"javascript:changeLanguage('es');\"><img alt='drapeau Espagnol' src='img/site/icones/drapeau_es.jpg'></a>";
echo "<br/>";


?>
