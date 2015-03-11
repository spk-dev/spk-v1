<?php

class DiaporamaAction{

    /**
     * Prépare et diffuse le diaporama des événements
     * @return array
     */
    public static function getDiaporama(){

        
        $listeImg = array();
        $listeCaption = array();
        $listeSlides = DiaporamaActionDao::getItemsPourDiaporama();
        $i=1;
        
        foreach($listeSlides as $slide){    
            $evenement = EvenementAction::getEvenement($slide->getEvenementId());

            //Si l'evenement est lie a un lieu valide
            if ($evenement != null){
                $type = TypeEvenementAction::recupererUnType($evenement->getTypeEvenement())->getLibelle();
                $datedebut = new DateTime($evenement->getDateDebut());
                $datefin = new DateTime($evenement->getDateFin());


                  $debut = date_format($datedebut, 'd/m/Y');
                  $fin = date_format($datefin, 'd/m/Y');
                  $dates = "";
                  if($debut==$fin){
                      $dates = $debut;
                  }else{
                      $dates = "Du ".date_format($datedebut, 'd/m/Y')." <br/>";
                      $dates .= "au ".date_format($datefin, 'd/m/Y')."";
                  }


                $img = HtmlUtilComponents::imageControl("evenements", $evenement->getMainPhoto(), 1);

                array_push($listeImg,"<img src=\"".$img."\" data-caption=\"#captionId".$i."\"/>");
                if($slide->getLien()!="" || !is_null($slide->getLien())){
                     $caption =  "<span class=\"orbit-caption orbit-caption-com\" id=\"captionId".$i."\"><a href=\"".$slide->getLienCustos()."\"><h5 class='titreDiaporamaCom'>".$evenement->getNom()."</h5></a></span>";
                }else{
                 $caption =  "<span class=\"orbit-caption\" id=\"captionId".$i."\"><a href=\"".$slide->getLienCustos()."\"><h5 class='titreDiaporama'>".$evenement->getNom()."</h5><span class='typeDiaporama'>".$type."</span><span class='dateDiaporama'>".$dates."</span></a></span>";

                }

                array_push($listeCaption,$caption);
                $i++;
            }
        }
        
        $display ="<div id=\"slider_principal\">";
        foreach ($listeImg as $value) {
            $display .= $value;
        }
        $display .= "</div>";
        foreach($listeCaption as $caption){
            $display .= $caption;
        }
        
        return $display;
    }
    
    
    
}



?>
