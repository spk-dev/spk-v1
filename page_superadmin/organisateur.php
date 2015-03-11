

<?php
    
    if(UtilSession::isSessionLoaded() && UtilSession::isSuperAdmin()){
        
        
AppLog::ecrireLog("Rentre dans organisateur - l 5", "debug");

$textConfirmationValidation = "";
$alertConfirmationValidation = "";


if(isset($_GET['activ']) && isset($_GET['idOrga'])){
    if($_GET['activ'] == "spkvalid" || $_GET['activ'] == "spkinvalid"){
        $idLieu = $_GET['idOrga'];
        $activ = $_GET['activ'];
        if($activ == "spkvalid"){
            $booActivation = 1;
        }else if($activ == "spkinvalid"){
            $booActivation = 0;
        }
        AppLog::ecrireLog("Rentre dans organisateur - l 20", "debug");
        AppLog::ecrireLog("ID Lieu : [".$idLieu."]", "debug");
            $lieu = LieuAction::recupererUnLieu($idLieu, null);
         
            echo $lieu->getNom();
       
         $admin = AdministrateurAction::getAdministrateur($id);
        
        AppLog::ecrireLog("Rentre dans organisateur - l 22", "debug");
        
//        echo "Nom [".$lieu->getNom()."]";
//        $admin = AdministrateurAction::getAdministrateur($lieu->getAdmin());
//        
//        echo "ID [".$admin->getId()."]";
        
        
        AppLog::ecrireLog("Rentre dans organisateur - l 24", "debug");
        $validation = LieuAction::activateSuperAdmin($idLieu, $booActivation);
        AppLog::ecrireLog("Rentre dans organisateur - l 26", "debug");
        $result = true;
        if($validation){
            $mail = new UtilMail();
            if($activ == "spkvalid"){
                $mail->mailActivationSuperAdmin($admin, $lieu);
                $textConfirmationValidation = "Oranisateur activé.";
            }else{
                $mail->mailDesactivationSuperAdmin($admin, $lieu);
                $textConfirmationValidation = "Oranisateur désactivé.";
            }
            $alertConfirmationValidation = "success";
            
        }else{
            $alertConfirmationValidation = "alert";
            $textConfirmationValidation = "Erreur, l'organisateur n'est pas validé.";
        }
    }
}



    $lieuCommunaute     =null;
    $lieuCommune        =null;
    $lieuDepartement    =null;        
    $lieuId             =null;
    $lieuMotsCles       =null;
    $lieuRegion         =null;
    $lieuType           =null;
    $lieuAdministrateur =null;
    $filtreOrganisateurs = new OrganisateurSearchCriteria();
//Vérification de la soumission du formulaire
            
                if(isset($_POST['Lieu'])){
                    if($_POST['Lieu'] !=""){
                        $lieuId = explode(',',$_POST['Lieu']);
                    }
                }
                if(isset($_POST['Admin'])){
                    if($_POST['Admin'] != ""){
                        $lieuAdministrateur = explode(',',$_POST['Admin']);
                        $listeAdmin = $_POST['Admin'];
                    }
                        
                }
                
                
                if(isset($_POST['Regions'])){       $lieuRegion = $_POST['Regions'];}
                if(isset($_POST['Departements'])){  $lieuDepartement = $_POST['Departements'];}
                if(isset($_POST['Communautes'])){   $lieuCommunaute = $_POST['Communautes'];}
                if(isset($_POST['Types'])){          $lieuType = $_POST['Types'];}
                if(isset($_POST['keywords'])){
                    if("" != $_POST['keywords']){
                        $lieuMotsCles = $_POST['keywords'];
                    }
                }
//                if(isset($_GET['Regions'])){$lieuRegion = array($_GET['Regions']);}
//                if(isset($_GET['Departements'])){   $lieuDepartement = array($_GET['Departements']);}
//                if(isset($_GET['Communautes'])){    $lieuCommunaute = array($_GET['Communautes']);}
//                if(isset($_GET['Types'])){$lieuType = array($_GET['Types']); }
                
                
            $filtreOrganisateurs->setOrganisateurAdministrateur($lieuAdministrateur);
            $filtreOrganisateurs->setOrganisateurCommunaute($lieuCommunaute);
            $filtreOrganisateurs->setOrganisateurCommune($lieuCommune);
            $filtreOrganisateurs->setOrganisateurDepartement($lieuDepartement);
            $filtreOrganisateurs->setOrganisateurId($lieuId);
            $filtreOrganisateurs->setOrganisateurMotsCles($lieuMotsCles);
            $filtreOrganisateurs->setOrganisateurRegion($lieuRegion);
            $filtreOrganisateurs->setOrganisateurType($lieuType);
            $nbItems  = LieuAction::compterLieuxFiltered($filtreOrganisateurs,false);

            $start = 0;
            $nbItemByPage = $_ENV['properties']['Pagination']['organisateurs'];
            $numPage = 1;
            $nbPages = ceil($nbItems/$nbItemByPage);
            
// récupération du numéro de la page           

            if(isset($_POST['numpage'])){
                if($_POST['numpage']!=""){
                    $numPage = $_POST['numpage'];
                    $start = ($nbItemByPage*$numPage)-$nbItemByPage;
                }                    
            }
            
            $filtreOrganisateurs->setOrganisateurLimit($start, $nbItemByPage);
            $filtreOrganisateurs->setOrganisateurOrder(DB::getParam("vlc", "NbAVenir"),"DESC");
            $listeLieux  = LieuAction::listerLieuxFilteredComplete($filtreOrganisateurs,true);
            
            
            
            
        ?>

<div class="row">
    <div class="twelve ">
        <?php if($result){ ?>
            <div class="ten columns centered alert-box <?php echo $alertConfirmationValidation; ?>">
                <?php echo $textConfirmationValidation; ?>
                <a class="close">&times;</a>
            </div>
        <br/>
        <?php }?>
        
        <div class='twelve columns panel'>
        <form id='filterFormID' name='filterFormName' method='POST' action='superadmin.php?page=organisateur'>
<!--                <input type="hidden" name="page" value="organisateur"/>-->
                <input type="hidden" name="numpage" id="numpageId" value=""/>
                
                <div class='three columns searchCriteria'>
                <label for='Communautes[]' class='labelSearchField'>Communautés / Ordres</label>
                <?php // HtmlFormComponents::SelectDepartements($contientDesRetraites, $name, $id, $size, $cssClass, $multiple)?>
                <?php echo HtmlFormComponents::selectCommunaute("Communautes[]", "listeCommunautes", 6, "contactItem twelve", 1, $lieuCommunaute); ?>
                
                </div>
                <div class='three columns searchCriteria'>
                <label for='Types[]' class='labelSearchField'>Types</label>
                <?php // HtmlFormComponents::SelectDepartements($contientDesRetraites, $name, $id, $size, $cssClass, $multiple)?>
                <?php echo HtmlFormComponents::selectType("Types[]", "listeTypeOrga", 6, "contactItem twelve", 1, $lieuType); ?>
                
                </div>
                
                <div  class='three columns searchCriteria'>
                <label for='Regions[]' class='labelSearchField'>Par région</label>
                <?php echo HtmlFormComponents::SelectRegions(true , "Regions[]",  "listeRegions",6, "contactItem twelve", 1,$lieuRegion); ?>
                </div>
                    
                <div  class='three columns searchCriteria'>
                <label for='Departements[]' class='labelSearchField'>Par département</label>
                <?php echo HtmlFormComponents::SelectDepartements(true , "Departements[]",  "listeDepartements",6, "contactItem twelve", 1,$lieuDepartement,"evenement"); ?>
                </div>
            
                
                <div  class='six columns searchCriteria'>
                    <label for='Lieu' class='labelSearchField'>Rechercher un organisateur</label>
                    <?php // echo HtmlFormComponents::SelectLieuxFromRetraite("retraite","Lieu[]","listeLieux", 6, "contactItem twelve", 1); ?>          
                    <input type="hidden" name="Lieu" class="twelve" id="listeLieux" value="<?php echo Util::getListeAvecVirguleLieuGetId($lieuId); ?>"/>
                </div>
                <div  class='six columns searchCriteria'>
                    <label for='Admin' class='labelSearchField'>Administrateur</label>
                    <?php // echo HtmlFormComponents::SelectLieuxFromRetraite("retraite","Lieu[]","listeLieux", 6, "contactItem twelve", 1); ?>          
                    <input type="hidden" name="Admin" class="twelve" id="listeAdministrateur" value="<?php echo $listeAdmin; ?>"/>
                </div>
    
                <div id='keywordResearch' class='four columns searchCriteria'>
                    <label for='keywords' class='labelSearchField'>Mots cl&eacute;s </label>
                    <input type='text' name='keywords' id='keywords' class='searchField' value="<?php echo $lieuMotsCles; ?>"/>                    
                </div>
            
                <div id='buttonResearch' class='four columns searchCriteria'>
                    <input type="submit" name='filter' id='filter' class="nine button tiny" value="Rechercher" />
                </div> 
            
            

            </form></div>
    </div>
   
    <div class="twelve columns">
         <div class="twelve nbEventRecherches">
                <?php echo count($listeLieux) ?> organisateurs correspondent à votre recherche
            </div>
         <?php 
            $hiddenFieldId = "numpageId";
            $formName = "filterFormName";
            echo HtmlUtilComponents::afficherPaginationJavascript($hiddenFieldId, $formName,$nbPages,$numPage); 
        ?> 
        <div class="twelve " >
         <?php 
                if(count($listeLieux)<1){
                    ?>
               <div class="twelve">
               <div class='itemListe twelve columns noresult'>
               Désolé, il n'y a pas encore d'organisateur d'événement correspondant à votre recherche
               <br/><br/>
               <a href='<?php echo $_ENV['properties']['Page']['defaultSite']."?".TextStatic::getText("MenuLienContact")."&action=1"; ?>'>Cliquer ici pour signaler un dysfonctionnement ou suggérer un organisateur.</a>";
               </div></div>
          <?php }else{ ?>     
            <table class="">
                <thead>
                    <tr>
                      <th></th>
                      <th>Titre</th>
                      <th>Ville/Dep</th>
                      <th>Type / Ordre</th>
                      <th>Administrateur</th>
                      <th>Val admin</th>
                      <th>Val SPK</th>
                      <th>Nb event</th>
                      <th>Outil</th>
                    </tr>
                  </thead>
            
           <?php
                $tabDesc = array();
                $lieu = new Lieu();
                foreach($listeLieux as $lieu){
                    $lien = "superadmin.php?page=organisateur&idOrga=".$lieu->getId()."&activ=";
                    $act = "";
                    $textAct = "";
                    if($lieu->getValidationSuperAdmin()==0){
                        $act  = "spkvalid";
                        $textAct = "Activer";
                        $imgValid = "ko";
                    }else if($lieu->getValidationSuperAdmin() == 1){
                        $act = "spkinvalid";
                        $textAct = "Désactiver";
                        $imgValid = "ok";
                    }
                    
                    $lien .=$act;
                     $img = HtmlUtilComponents::imageControl("lieux", $lieu->getMainPhoto(), 0);
//                     $filter = new EvenementSearchCriteria();
//                     $filter->setEvenementLieu(array($lieu->getid()));
                   $tabDesc[$lieu->getId()] = $lieu->getDescription();
            ?>
                  <tr>
                      <td><img src="<?php echo $img; ?>" class="imgCaptionListe twelve" alt=""/></td>
                      <td>
                          <a href="#" data-reveal-id="description<?php echo $lieu->getId(); ?>"><?php echo $lieu->getnom(); ?></a></td>
                      <td><?php echo $lieu->getVille(); ?><br/><?php echo $lieu->getDepartement(); ?></td>
                      <td> </td>
                      <td><?php echo AdministrateurAction::getAdministrateur($lieu->getAdmin())->getNomComplet(); ?></td>
                      <td><?php echo $lieu->getValidationAdmin(); ?></td>
                      <td><img src="images/spibook/<?php echo $imgValid; ?>.png"</td>
                      <td><?php echo $lieu->getNbEvent(); ?></td>
                      <td><a href="<?php echo $lien; ?>"><?php echo $textAct; ?></a></td>
                </tr>
                
            <?php } ?>
                </table>
           <?php } ?>
        
        </div>
        <?php 

//            echo HtmlUtilComponents::afficherPaginationJavascript($hiddenFieldId, $formName,$nbPages,$numPage); 
        ?>  
    </div>
    <?php foreach ($tabDesc as $key => $value) { ?>
          
        <div id="description<?php echo $key; ?>" class="reveal-modal medium">
            <h2>Description</h2>
          <?php echo $value; ?>
             <a class="close-reveal-modal">&#215;</a>
        </div>
  
    <?php }?>
</div>

 
<?php
}else{
    Redirect::toPage($_ENV['properties']['Page']['defaultSuperAdmin']);
}

?>