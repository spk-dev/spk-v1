$(document).ready(function() {
    
    var $form = $('#bugTrackerForm');

    $('#bugTrackerSubmit').on('click', function() {
       // alert('Le submit est capté');
            $form.trigger('submit');
            return false;
    });

    $form.on('submit', function() {
 
    //alert('rentre dans la soumission du form');
 
 
 
    var testeur = $('#testeur').val();
    var description = $('#description').val();
    
    if(testeur === '' || description === '') {
        
            alert('Nom et description obligatoire');
            $('#bugTracker').trigger('reveal:open');
    } else {
       // alert('tous les champs obligatoire du form sont ok');
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(json) {
               
                alert(json.reponse);
            }
             
        });
    }

        
//        remplirListeIntervenant(val);
        document.getElementById('bugTrackerForm').reset();
        
        $('#bugTrackerSubmit').trigger('reveal:close');
        return false;
    });
});
