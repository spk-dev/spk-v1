<?php

// To
$to = 'benjamin.teillard@labanquepostale.fr';
 
// Subject
$subject = 'Test mail spk';
 
// Message
$msg = 'Message tst spk';
 
// Function mail()
mail($to, $subject, $msg) or die("Erreur dans l'envoi de mail");

?>
