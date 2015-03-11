




<?php
if(isset($_GET['delete'])){

rmdir('../logs/');
mkdir('../logs/',0777);

}

?>

<h1>Debug</h1>
<?php 
echo '<textarea cols="100" rows="20">';
    include('../logs/DebugLogAppli.txt'); 
echo '</textarea>';
?>



<h1>Info</h1>
<?php
echo '<textarea cols="100" rows="20">';
    include('../logs/InfoLogAppli.txt'); 
echo '</textarea>';
?>   

     
<h1>Sql</h1>
<?php
echo '<textarea cols="100" rows="20">';
    include('../logs/SqlLogAppli.txt'); 
echo '</textarea>';

?>


