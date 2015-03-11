<?php

echo "<h1>".TextStatic::getText("TitreType")."</h1>";

echo TypeAction::afficherTousLesTypes();

echo TypeAction::afficherUneType(1);

?>