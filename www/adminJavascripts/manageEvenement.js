
    /* TIMEPICKER Retraite*/
    (function($) {
        $.timepicker.regional['fr'] = {
        timeOnlyTitle: 'Choisir une heure',
        timeText: 'Heure',
        hourText: 'Heures',
        minuteText: 'Minutes',
        secondText: 'Secondes',
        millisecText: 'Millisecondes',
        microsecText: 'Microsecondes',
        timezoneText: 'Fuseau horaire',
        currentText: 'Maintenant',
        timeFormat: 'HH:mm',
        amNames: ['AM', 'A'],
        pmNames: ['PM', 'P'],
        closeText: 'Ok',
        prevText: 'Précédent',
        nextText: 'Suivant',
        monthNames: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin','juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'],
        monthNamesShort: ['janv.', 'févr.', 'mars', 'avril', 'mai', 'juin','juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'],
        dayNames: ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'],
        dayNamesShort: ['dim.', 'lun.', 'mar.', 'mer.', 'jeu.', 'ven.', 'sam.'],
        dayNamesMin: ['D','L','M','M','J','V','S'],
        weekHeader: 'Sem.',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false
        };
        $.timepicker.setDefaults($.timepicker.regional['fr']);
        })(jQuery);

    /* TIMEPICKER */
    
    var startDateTextBox = $('#date_deb');
    var endDateTextBox = $('#date_fin');

    startDateTextBox.datetimepicker({ 
        
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        timeFormat: 'HH:mm:ss',
        stepHour: 1,
        stepMinute: 15,
        dateFormat: "yy-mm-dd",
        onClose: function(dateText, inst) {
                if (endDateTextBox.val() != '') {
                        var testStartDate = startDateTextBox.datetimepicker('getDate');
                        var testEndDate = endDateTextBox.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                                endDateTextBox.datetimepicker('setDate', testStartDate);
                }
                else {
                        endDateTextBox.val(dateText);
                }
        },
        onSelect: function (selectedDateTime){
                endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
        }
    });
    endDateTextBox.datetimepicker({ 
        addSliderAccess: true,
        sliderAccessArgs: { touchonly: false },
        timeFormat: 'HH:mm:ss',
        stepHour: 1,
        stepMinute: 15,
        dateFormat: "yy-mm-dd",
        onClose: function(dateText, inst) {
                if (startDateTextBox.val() != '') {
                        var testStartDate = startDateTextBox.datetimepicker('getDate');
                        var testEndDate = endDateTextBox.datetimepicker('getDate');
                        if (testStartDate > testEndDate)
                                startDateTextBox.datetimepicker('setDate', testEndDate);
                }
                else {
                        startDateTextBox.val(dateText);
                }
        },
        onSelect: function (selectedDateTime){
                startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
        }
    });


    /* EDITEUR WYSIWYG */
//    bkLib.onDomLoaded(function() {
//            new nicEditor({buttonList : ['fontFormat','bold','italic','underline','left','center','right','justify','ol','ul','strikeThrough','indent','outdent','hr','removeformat','link','unlink','html'], maxHeight : 300}).panelInstance('description');
//            new nicEditor({buttonList : ['fontFormat','bold','italic','underline'], maxHeight : 100}).panelInstance('contactInscription');
//    });
        
      $('#listeIntervenants').select2({

        multiple : true,
        minimumInputLength: 0,
        
         initSelection : function (element, callback) {
             
             
            var data = [];
            
            
            $(element.val().split(",")).each(function () {
                var selectedValue = this.split(":");
                
                data.push({id: selectedValue[0], text: selectedValue[1]});
            });
            document.getElementById('listeIntervenants').value = "";
//            $(element.val().split(",")).each(function () {
//                data.push({id: this, text: this});
//            });
            
            callback(data);
        },
        ajax: {
          url: "ajaxManagement.php?json=intervenants",
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }

      });
//        $("#listeIntervenants").select2({});
        $("#listeTheme").select2({});
        $("#listeType").select2({});
//        
        /**
         * TEST JQUERY LISTE INTERVENANT
         * @returns {undefined}
         */
       function populateIntervenantSelect(){
            $.get('../services/AjaxAction.class.php?loadIntervenantListe=1', function(data) {

                // On recupere du HTML donc on l'insere "as-is" dans la page
                $('#divlistIntervenants').html('').html(data);

              });
        } 
     
  
  $(document).ready(function() {

    var $form = $('#formAddIntervenant');

    $('#intervenant-submit').on('click', function() {
            $form.trigger('submit');
            return false;
    });

    $form.on('submit', function() {
 
    var nom = $('#intervenant-text-nom').val();
    var prenom = $('#intervenant-text-prenom').val();
    var genre = $('#intervenant-select-genre').val();
    var val = "";
    if(nom === '' || prenom === '' || genre==='Selectionner dans la liste ci-dessous') {
            alert('Les champs Genre, Nom et Prénom doivent être saisis.');
            $('#divAddIntervenant').trigger('reveal:open');
    } else {
        alert("Go");
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(json) {
               
                if(json.reponse === 'erreur dans l\'enregistrement') {
//                    document.getElementById('#divAddIntervenant').innerHTML = 'Erreur : '+ json.reponse ;
                    alert('Erreur : '+ json.reponse);
                } else {
//                    $('#divAddIntervenant').trigger('reveal:close');
//                    document.getElementById('#divAddIntervenant').innerHTML = 'Succes : ' + json.reponse ;
//                    val = json.reponse;
                    alert("Intervenant correctement enregistre. Vous pouvez le s&eacute;lectionner dans la liste.");
//                    document.getElementById("addedInterv").value = json.response;
                    
//                    val = json.reponse;
////                     alert(val);
//                     $('#addedInterv').text(val);
//                    alert("JSONREPONSE "+json.reponse);
//                    document.getElementById('#currentInterv').value = json.reponse;
//                   alert("document.getElementById('#currentInterv').value "+document.getElementById('#currentInterv').value);
                }
            }
             
        });
    }

        
//        remplirListeIntervenant(val);
        document.getElementById('formAddIntervenant').reset();
        $('#divAddIntervenant').trigger('reveal:close');
        return false;
    });
});


function readImage(file) {

    var reader = new FileReader();
    var image  = new Image();

    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        
        image.onload = function() {
            
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
            if(w >= 520 && h>=260){
                $('#uploadPreview').html("");
                $('#uploadPreview').append('<img src="'+ this.src +'"> '+w+'x'+h+' '+s+' '+n+'<br>');
                document.getElementById('currentImg').innerHTML = "";
                
            }else{
                $('#uploadPreview').html("");
                $('#uploadPreview').append("L'image est trop petite : dimension minimum 520px x 260px");
                $("#mainPhoto").val("");
            }
            
        };
        image.onerror= function() {
            $('#uploadPreview').html("");
            $("#mainPhoto").val("");
            alert('Format d\'image incorrect: '+ file.type);
        };      
    };

}
$("#mainPhoto").change(function (e) {
    if(this.disabled) return alert('Le fichier envoyé n\'est pas accepté!');
    var F = this.files;
    if(F && F[0]) for(var i=0; i<F.length; i++) readImage( F[i] );
});


$("#GarderieIDHome").select2({});    
    $("#HebergementIDHome").select2(); 
    $("#listeThemes").select2({});    
    $("#listeType").select2({});
    $("#listeRegions").select2({});
    $("#listeDepartements").select2({});
    $("#listeCommunautes").select2({});
    $("#listeTypeOrga").select2({});
    
    $('#listeLieux').select2({
        
        multiple : true,
        minimumInputLength: 0,
         initSelection : function (element, callback) {
//            var data = [];
//            $(element.val().split(",")).each(function () {
//                data.push({id: this, text: this});
//            });
//            
//           
            var data = [];
            
            
            $(element.val().split(",")).each(function () {
                var selectedValue = this.split(":");
                
                data.push({id: selectedValue[0], text: selectedValue[1]});
            });
//            $('#listeLieux').select2().val();
            document.getElementById('listeLieux').value = "";
             callback(data);
        },
        ajax: {
          url: "ajaxManagement.php?json=lieux",
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }

      });
    
    
    
//    $('#listeLieux').select2({
//
//        multiple : true,
//         initSelection : function (element, callback) {
//            var data = [];
//            $(element.val().split(",")).each(function () {
//                data.push({id: this, text: this});
//            });
//            
//            callback(data);
//        },
//        ajax: {
//          url: "ajaxManagement.php?json=lieux",
//          dataType: 'json',
//          data: function (term, page) {
//            return {
//              q: term
//            };
//          },
//          results: function (data, page) {
//            return { results: data };
//          }
//        }
//
//      });
      $('#listeAdministrateur').select2({

        multiple : true,
         initSelection : function (element, callback) {
            var data = [];
            $(element.val().split(",")).each(function () {
                data.push({id: this, text: this});
            });
            
            callback(data);
        },
        ajax: {
          url: "ajaxManagement.php?json=administrateur",
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },
          results: function (data, page) {
            return { results: data };
          }
        }

      });