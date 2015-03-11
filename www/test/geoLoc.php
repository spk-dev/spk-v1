<form action="" method="POST" name="testAdresse">
<input type="text" name="adresse" />
<input type="text" name="nom" />
<input type="Submit">
</form>
<?php

if(isset($_POST['adresse'])){
    require_once '../../utils/DownloadBinaryFile.class.php';
    
    $adresse = $_POST['adresse'];
    $nom  = $_POST["nom"];
    $localImgNamePrefix = "img_map_small_";
    $id = "123";
    
    $fullurl = "http://maps.googleapis.com/maps/api/geocode/json?address=".htmlentities(urlencode($_POST['adresse']))."&sensor=true";
    
    
    
    $string .= file_get_contents($fullurl); // get json content
    $json_a = json_decode($string, true); //json decoder
    
    $lat = $json_a['results'][0]['geometry']['location']['lat'];
    $long = $json_a['results'][0]['geometry']['location']['lng'];

    echo "Lat : [".$json_a['results'][0]['geometry']['location']['lat']."]"; // get lat for json
    echo "<br/>";
    echo "Long : [".$json_a['results'][0]['geometry']['location']['lng']."]"; // get ing for json

    
    $urlImage = "http://maps.googleapis.com/maps/api/staticmap?center=".$lat.",".$long."&zoom=7&size=120x120&maptype=terrain&markers=color:blue%7Csize:mid%7Clabel:S%7C".$lat.",".$long."&".$lat.",".$long."&format=png&sensor=true";
    
    echo "<br/><a href='".$urlImage."'>".$urlImage."</a>";
    
    echo "<h2>from gmap</h2>";
    echo "<img src='".$urlImage."' />";
    
    
    $local= $localImgNamePrefix.$id.'.png';
    $remote = $urlImage;
    
    echo "AVANT DOWNLOADBINARY";
    $DownloadBinaryFile=new DownloadBinaryFile();
    
    if ($DownloadBinaryFile->load($remote)==TRUE) {
        $DownloadBinaryFile->saveTo($local);
        echo "download ok ";
    } else {
        echo 'download failed';
    }
    
    echo "<h2>from local</h2>";
    echo "<h3>IMAGE</h3>";
    echo "<img src='img_map_small_".$id.".png' />";
    
   
    echo "<h3>MAP</h3>";
?>

<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.fr/maps?q=<?php echo $lat;?>,<?php echo $long;?>&amp;num=1&amp;t=h&amp;ie=UTF8&amp;ll=<?php echo $lat;?>,<?php echo $long;?>&amp;spn=1.565378,2.469177&amp;z=9&amp;output=embed"></iframe><br /><small><a href="https://maps.google.fr/maps?q=43.961191,2.058838&amp;num=1&amp;t=h&amp;ie=UTF8&amp;ll=<?php echo $lat;?>,<?php echo $long;?>&amp;spn=<?php echo $lat;?>,<?php echo $long;?>&amp;z=9&amp;source=embed" style="color:#0000FF;text-align:left">Agrandir le plan</a></small>

<?php
}

?>
