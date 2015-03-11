<div class="row">
    
<?php 
    $listeLieuxAdmin = AdministrateurAction::getAdministrateur(UtilSession::getSessionAdminId())->getLieux();
    $nombreLieux = count($listeLieuxAdmin);
    $aujourdhui = new DateTime();
    $aujourdhui->format('Y-m-d');
?>

<ul class="tabs-content contained">
    <li class="active" id="simpleContained1Tab">
        <div class="row">
            
            <div class='twelve columns'>
            
           <h3>Mes événements</h3>
            
            <?php if($nombreLieux<1){ ?>
                    <dl class="tabs evenements">
                      <dd class="active"><a href="#avenir">Evenements</a></dd>
                    </dl>
                    <ul class="tabs-content">
                      <li class="active evenements" id="avenirTab">
                          Aucun événement.

                      </li>


                    </ul>
             <?php }else{ ?>
           
            
                
                <?php
                $filter = new EvenementSearchCriteria();
                $aujourdhui = new DateTime();
                $aujourdhui->format('Y-m-d');
                $filter->setEvenementLieu($nombreLieux);
               
            ?>   
            
            <dl class="tabs evenements">
              <dd class="active"><a href="#avenir">Evenements à venir</a></dd>
              <dd><a href="#passes">Evenements passés</a></dd>
            </dl>
            <ul class="tabs-content">
              <li class="active evenements" id="avenirTab">
                  <?php
                        $filterMin = $filter;
                        $filterMin->setEvenementDateMin($aujourdhui->format('Y-m-d'));    
                        $filterMin->setEvenementDateMax("");
                        $filterMin->setEvenementLieu($listeLieuxAdmin);
                        echo EvenementAction::afficherTableEvenementsSynthese($filterMin, "toto",true);
                    ?>

              </li>
              <li id="passesTab">
                  <?php
                        $filterMax = $filter;
                        $filterMax->setEvenementDateMax($aujourdhui->format('Y-m-d'));    
                        $filterMax->setEvenementDateMin("");
                        $filterMax->setEvenementLieu($listeLieuxAdmin);
                        echo EvenementAction::afficherTableEvenementsSynthese($filterMax, "toto",true);
                    ?>
              </li>

            </ul>
             <?php } ?>
        </div>
        </div>
        <div class="row">
<!--            <div class="three columns">
                <ul class="twelve accordion">
                    <li class="active organisations">
                      <div class="title">
                        <h5>Organisations</h5>
                      </div>
                      <div class="content">
                          <p class="dashboardNumberBig">
                              <?php 
//                                echo $nombreLieux;
                              ?>
                          </p>

                        <p class="follow"><a>voir la suite</a></p>
                        </div>
                    </li>
                </ul>
            </div>-->
<hr/>
            <div class='twelve columns'>
                <h3>Fiche organisateur</h3>
            
<!--                <dl class="tabs evenements">
                  <dd class="active"><a>Mes organisations</a></dd>

                </dl>-->
<!--                <ul class="tabs-content">
                  <li class="active evenements" id="avenirTab">-->
                    <?php 
                        $filterLieu = new OrganisateurSearchCriteria();
                        $filterLieu->setOrganisateurAdministrateur(array(UtilSession::getSessionAdminId()));
                        echo LieuAction::afficherGridLieuxAdmin($filterLieu, 1,1); 
                    ?>
<!--                  </li>


                </ul>-->
            </div>
<!--            <div class="three columns">
                <ul class=" twelve accordion">
                <li class="evenements">
                  <div class="title">
                    <h5>Nombre d'événements</h5>
                  </div>
                  <div class="content">
                    
                      <div class="six columns dashboardNumberBig">
                            <?php 
//                            if($nombreLieux<1){
//                                echo 0;
//                            }else{
//                                $filter = new EvenementSearchCriteria();
//                                $filter->setEvenementLieu($listeLieuxAdmin);
//                                echo EvenementAction::compterNbEvenements($filter);
//                            }
                                
                            ?>
                      </div>
                      <div class="six columns">
                          <?php if($nombreLieux>0){?>
                            <p><span class="dashboardNumberSmall">
                                    <?php
//                                        $filter->setEvenementDateMax($aujourdhui->format('Y-m-d'));    
//                                        $filter->setEvenementDateMin("");
//                                        echo EvenementAction::compterNbEvenements($filter);
                                    ?>
                                </span> évèments passés </p>
                            <p><span class="dashboardNumberSmall">
                                    <?php
//                                        $filter->setEvenementDateMin($aujourdhui->format('Y-m-d'));    
//                                        $filter->setEvenementDateMax("");
//                                        echo EvenementAction::compterNbEvenements($filter);
                                    ?>
                                </span> événements à venir</p>
                          <?php } ?>
                      </div>
                      
                      
                    </div>
                </li>
            </ul>
             </div>-->
            <hr/>
            <div class="twelve columns">
                <ul class=" twelve accordion">
                    <li class="active assistance">
                      <div class="title">
                        <h3>Besoin d'aide</h3>
                      </div>
                      <div class="content">
                          <ul>
                            <li><a href=''>Lire la documentation</a></li>
                            <li><a href=''>Contacter l'assistance</a></li>
                          </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        
        
        
        <div class="row">
            
            
            
            
            
            
            
            
        </div>
    </li>



</div>