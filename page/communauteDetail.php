
    <?php 
    
    if(isset($_GET['id'])){
        $idCommunaute = $_GET['id']; 
//        $intervenant = IntervenantActionDao::recupererIntervenant($_GET['id']); 
        $communaute = CommunauteAction::recupererCommunaute($idCommunaute);
        $img = HtmlUtilComponents::imageControl("communautes", $communaute->getPhoto(), 1);
        
    ?>

<div class="row">
    <div class="twelve columns">

        <h3><?php echo $communaute->getNom();?></h3>
            </div>

            <div class="three columns">
                <?php echo "<img src='".$img."' alt = \"".$communaute->getNom()."\"/>";?>
                
                
            </div>
            <div class="nine columns">
                <div class="panel">
                    <h5 class="subheader"><?php echo $communaute->getDescription();?></h5>
                    
                </div>
                <div>
                    <?php 
                        
                        $lieuFilter = new OrganisateurSearchCriteria();
                        $lieuFilter->setOrganisateurCommunaute($communaute->getId());
                        echo LieuAction::afficherGridLieux($lieuFilter, 4);
                    ?>
                    
                </div>
            </div>
                
</div>


<?php
    }else{
        echo "erreur";
    }
?>
    