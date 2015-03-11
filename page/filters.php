
<?php


class displayFilter{

    
    
}

?>

<?php
   $display .= "<form id='filterFormID' name='filterFormName' method='post' action='#'>";
 
    $display .="<div id='intervenantsResearch' class='searchCriteria'>";
    $display .="<label for='Intervenant[]'>Intervenants</label>";
    $display .= HtmlFormComponents::SelectIntervenants("Intervenant[]","Intervenant", 4, "cssClass", 1);
    $display .= "</div>";
   
   
    
    
    $display .="<div id='lieuxResearch' class='searchCriteria'>";
    $display .="<label for='Lieu[]>Lieux</label>";
    $display .= HtmlFormComponents::SelectLieuxFromEvenement("Lieu[]","Lieu", 4, "cssClass", 1);          
    $display .="</div>";
    
    
?>      
   

    <div id="lieuxResearch" class="searchCriteria">
        <label for="Lieu[]">Lieux</label><br/><?php echo HtmlFormComponents::SelectLieuxFromEvenement("Lieu[]","Lieu", 4, "cssClass", 1); ?> 
    </div>
    
    <div id="dateResearch" class="searchCriteria">
        <label for="DateMin">Date min</label><br/>
        <input type="text" name="DateMin" id="DateMin" class="dateClass" value=""/>
        <br />
        <label for="DateMax">Date max</label><br/>
        <input type="text" name="DateMax" id="DateMax" class="dateClass"/>
    </div>
    
    <div id="garderieResearch" class="searchCriteria">
        <label for="Garderie">Garderie</label><br/>
            <select name="Garderie" id="GarderieID">
                <option disabled selected></option>
                <option value=1>Oui</option>
                <option value=0>Non</option>
            </select>
    </div>
    
    
    <div id="hebergementResearch" class="searchCriteria">
        <label for="Hebergement">H&eacute;bergement</label><br/>
            <select name="Hebergement" id="HebergementID">
                <option disabled selected></option>
                <option value=1>Oui</option>
                <option value=0>Non</option>
            </select>
    </div>
    
    
    <div id="keywordResearch" class="searchCriteria">
        <label for="keywords">Mots cl&eacute;s </label><br/><input type="text" name="keywords" id="keywords" />
    </div>
    
    
    <div id="buttonResearch" class="searchCriteria">
        <input type="submit" name="filter" id="filter" value="filter" />
	<input type="reset" name="Reset" id="Reset" value="Reset" />
    </div>    
        
    </form>
