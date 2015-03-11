
$(document).ready(function () {
    $('#affiliation').validate({ // initialize the plugin
        rules: {
            nom: {
                required: true,
                
            },
            prenom: {
                required: true,
                
            },
            mail: {
                required:true,
                email: true
                
            }
        }
    });

});