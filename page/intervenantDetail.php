
    <?php 
    
    
        $intervenant = IntervenantActionDao::recupererIntervenant($_GET['Intervenant']); 

        $img = HtmlUtilComponents::imageControl("intervenants", $intervenant->getPhoto(), 1);
        
    ?>

<div class="row">
    <div class="twelve columns">

    <h5><?php echo IntervenantAction::afficherNomComplet($intervenant);?></h5>
        </div>

        <div class="three columns">
        
            <?php echo "<img src='".$img."' alt = \"".$intervenant->getNom()."\"/>";?>
            <?php
                if($intervenant->getMail()<>""){

                    echo "<div class=\"panel\">";
                    echo "<a href=\"mailto:".$intervenant->getMail()."\">".$intervenant->getMail()."</a>";
                    echo "</div>";
                }
                ?>


        </div>
        <div class="nine columns">
            
            <div>
                <h5 class="titre">Les événements associés.</h5>
        
                <?php 
                    $filter = new EvenementSearchCriteria();
                    $filter->setIntervenants(array($intervenant->getId()));
                    echo EvenementAction::afficherListesRetraites($filter, 0, 2,null,null); ?>

            </div>
            <div>
                <?php
                    $lieuFilter = new OrganisateurSearchCriteria();
                    $listeLieux = EvenementAction::getListeEvenements($filter);
                    $nbLieux = count($listeLieux);


                ?>
                <h5 class="titre">Retrouvez <?php echo IntervenantAction::afficherNomComplet($intervenant); ?> ici :</h5>
                <?php

                    $arrLieux = array();
                    foreach ($listeLieux as $lieu) {
                        if(!in_array($lieu->getLieu(), $arrLieux)){
                            array_push($arrLieux, $lieu->getLieu());
                        }

                    }
                    $lieuFilter->setOrganisateurId($arrLieux);
                     echo LieuAction::afficherGridLieux($lieuFilter,2);
                ?>
            
            </div>
            
        </div>
        <div class="twelve columns panel">
            <h5 class="subheader"><?php echo $intervenant->getDescription();?></h5>

        </div>
                
</div>


<div class="row">
    
    
</div>